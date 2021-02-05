<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * xmnews module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */

use Xmf\Module\Admin;
use Xmf\Request;
use Xmf\Module\Helper;

require __DIR__ . '/admin_header.php';
$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('category.php');

// Get Action type
$op = Request::getCmd('op', 'list');
switch ($op) {
    case 'list':
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        $xoTheme->addScript('modules/system/js/admin.js');
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMNEWS_CATEGORY_ADD, 'category.php?op=add', 'add');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Get start pager
        $start = Request::getInt('start', 0);
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('category_weight ASC, category_name');
        $criteria->setOrder('ASC');
        $criteria->setStart($start);
        $criteria->setLimit($nb_limit);
        $category_arr = $categoryHandler->getall($criteria);
        $category_count = $categoryHandler->getCount($criteria);
        $xoopsTpl->assign('category_count', $category_count);
        if ($category_count > 0) {
            foreach (array_keys($category_arr) as $i) {
                $category_id                 = $category_arr[$i]->getVar('category_id');
                $category['id']              = $category_id;
                $category['name']            = $category_arr[$i]->getVar('category_name');
				if (strlen($category_arr[$i]->getVar('category_description', 'e')) > 300){
					$category['description'] = substr($category_arr[$i]->getVar('category_description', 'e'), 0, 300) . '...';
				} else {
					$category['description'] = $category_arr[$i]->getVar('category_description', 'e');
				}
				$color					     = $category_arr[$i]->getVar('category_color');
				if ($color == '#ffffff'){
					$category['color']	     = false;
				} else {
					$category['color']	     = $color;
				}
                $category['weight']          = $category_arr[$i]->getVar('category_weight');
                $category['status']          = $category_arr[$i]->getVar('category_status');
                $category_img                = $category_arr[$i]->getVar('category_logo');
				if ($category_img == ''){
					$category['logo']        = '';
				} else {
					$category['logo']        = $url_logo . $category_img;
				}
                $xoopsTpl->append_by_ref('category', $category);
                unset($category);
            }
            // Display Page Navigation
            if ($category_count > $nb_limit) {
                $nav = new XoopsPageNav($category_count, $nb_limit, $start, 'start');
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        } else {
            $xoopsTpl->assign('error_message', _MA_XMNEWS_ERROR_NOCATEGORY);
        }
        break;
    
    // Add
    case 'add':
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMNEWS_CATEGORY_LIST, 'category.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Form
        $obj  = $categoryHandler->create();
        $form = $obj->getForm();
        $xoopsTpl->assign('form', $form->render());
        break;
        
    // Edit
    case 'edit':
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMNEWS_CATEGORY_LIST, 'category.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Form
        $category_id = Request::getInt('category_id', 0);
        if ($category_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMNEWS_ERROR_NOCATEGORY);
        } else {
            $obj = $categoryHandler->get($category_id);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render()); 
        }

        break;
    // Save
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('category.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $category_id = Request::getInt('category_id', 0);
        if ($category_id == 0) {
            $obj = $categoryHandler->create();            
        } else {
            $obj = $categoryHandler->get($category_id);
        }
        $error_message = $obj->saveCategory($categoryHandler, 'category.php');
        if ($error_message != ''){
            $xoopsTpl->assign('error_message', $error_message);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }
        
        break;
        
    // del
    case 'del':    
        $category_id = Request::getInt('category_id', 0);
        if ($category_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMNEWS_ERROR_NOCATEGORY);
        } else {
            $surdel = Request::getBool('surdel', false);
            $obj  = $categoryHandler->get($category_id);
            if ($surdel === true) {
                if (!$GLOBALS['xoopsSecurity']->check()) {
                    redirect_header('category.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
                }
                if ($categoryHandler->delete($obj)) {
                    //Del logo
                    if ($obj->getVar('category_logo') != 'blank.gif') {
                        // Test if the image is used
                        $criteria = new CriteriaCompo();
                        $criteria->add(new Criteria('category_logo', $obj->getVar('category_logo')));
                        $category_count = $categoryHandler->getCount($criteria);
                        if ($category_count == 0){
							$urlfile = $path_logo . $obj->getVar('category_logo');
							if (is_file($urlfile)) {
								chmod($urlfile, 0777);
								unlink($urlfile);
							}
                        }
                    }
                    // Del permissions
                    $permHelper = new Helper\Permission();
                    $permHelper->deletePermissionForItem('xmnews_viewabstract', $category_id);
                    $permHelper->deletePermissionForItem('xmnews_viewnews', $category_id);
                    $permHelper->deletePermissionForItem('xmnews_submit', $category_id);
                    $permHelper->deletePermissionForItem('xmnews_editapprove', $category_id);
                    $permHelper->deletePermissionForItem('xmnews_delete', $category_id);
                    // Del news
                    $criteria = new CriteriaCompo();
                    $criteria->add(new Criteria('news_cid', $category_id));
                    $news_arr = $newsHandler->getall($criteria);
                    if (!empty($news_arr)){
                        foreach (array_keys($news_arr) as $i) {
                            $objnews = $newsHandler->get($news_arr[$i]->getVar('news_id'));
                            $newsHandler->delete($objnews) or $objnews->getHtmlErrors();
							//xmdoc
							if (xoops_isActiveModule('xmdoc') && $helper->getConfig('general_xmdoc', 0) == 1) {
								xoops_load('utility', 'xmdoc');
								$xoopsTpl->assign('error_message', XmdocUtility::delDocdata('xmnews', $i));
							}
							//xmsocial
							if (xoops_isActiveModule('xmsocial') && $helper->getConfig('general_xmsocial', 0) == 1) {
								xoops_load('utility', 'xmsocial');
								$xoopsTpl->assign('error_message', XmsocialUtility::delRatingdata('xmnews', $id));
								if ($helper->getConfig('general_xmsocial_social', 0) == 1) {
									$xoopsTpl->assign('error_message', XmsocialUtility::delSocialdata('xmnews', $id));
								}
							}							
							//Del Notification and comment
							$helper = Helper::getHelper('xmnews');
							$moduleid = $helper->getModule()->getVar('mid');
							xoops_notification_deletebyitem($moduleid, 'news', $i);
							xoops_comment_delete($moduleid, $i);
                        }
                    }
					
					//Del Notification
					xoops_notification_deletebyitem($moduleid, 'category', $category_id);
                    
                    redirect_header('category.php', 2, _MA_XMNEWS_REDIRECT_SAVE);
                } else {
                    $xoopsTpl->assign('error_message', $obj->getHtmlErrors());
                }
            } else {
                $category_img = $obj->getVar('category_logo') ?: 'blank.gif';
                xoops_confirm(['surdel' => true, 'category_id' => $category_id, 'op' => 'del'], $_SERVER['REQUEST_URI'], sprintf(_MA_XMNEWS_CATEGORY_SUREDEL, $obj->getVar('category_name')) . '<br>
                                    <img src="' . $url_logo . $category_img . '" title="' . $obj->getVar('category_name') . '" style="max-width:100px"><br>' . XmnewsUtility::newsNamePerCat($category_id));
            }
        }
        
        break;
        
    // Update status
    case 'category_update_status':
        $category_id = Request::getInt('category_id', 0);
        if ($category_id > 0) {
            $obj = $categoryHandler->get($category_id);
            $old = $obj->getVar('category_status');
            $obj->setVar('category_status', !$old);
            if ($categoryHandler->insert($obj)) {
                exit;
            }
            $xoopsTpl->assign('error_message', $obj->getHtmlErrors());
        }
        break;
}

$xoopsTpl->display("db:xmnews_admin_category.tpl");

require __DIR__ . '/admin_footer.php';

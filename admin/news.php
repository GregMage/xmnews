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

require __DIR__ . '/admin_header.php';
$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('news.php');

// Get Action type
$op = Request::getCmd('op', 'list');
switch ($op) {
    case 'list':
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
		$xoTheme->addStylesheet( XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/admin.css', null );
        $xoTheme->addScript('modules/system/js/admin.js');
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMNEWS_NEWS_ADD, 'news.php?op=add', 'add');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
		// Get start pager
        $start = Request::getInt('start', 0);
		$xoopsTpl->assign('start', $start);
        
        $xoopsTpl->assign('filter', true);
		// Category
		$news_cid = Request::getInt('news_cid', 0);
        $xoopsTpl->assign('news_cid', $news_cid);
		$criteria = new CriteriaCompo();
		$criteria->setSort('category_weight ASC, category_name');
		$criteria->setOrder('ASC');
		$category_arr = $categoryHandler->getall($criteria);		
		if (count($category_arr) > 0) {
			$news_cid_options = '<option value="0"' . ($news_cid == 0 ? ' selected="selected"' : '') . '>' . _ALL .'</option>';
			foreach (array_keys($category_arr) as $i) {
				$news_cid_options .= '<option value="' . $i . '"' . ($news_cid == $i ? ' selected="selected"' : '') . '>' . $category_arr[$i]->getVar('category_name') . '</option>';
			}
			$xoopsTpl->assign('news_cid_options', $news_cid_options);
		}
        // Status
        $news_status = Request::getInt('news_status', 10);
        $xoopsTpl->assign('news_status', $news_status);
        $status_options         = [1 => _MA_XMNEWS_STATUS_A, 0 => _MA_XMNEWS_STATUS_NA, 2 => _MA_XMNEWS_NEWS_WFV];
		$news_status_options = '<option value="10"' . ($news_status == 0 ? ' selected="selected"' : '') . '>' . _ALL .'</option>';
        foreach (array_keys($status_options) as $i) {
            $news_status_options .= '<option value="' . $i . '"' . ($news_status == $i ? ' selected="selected"' : '') . '>' . $status_options[$i] . '</option>';
        }
        $xoopsTpl->assign('news_status_options', $news_status_options);
		
		// Waiting news
        $criteria = new CriteriaCompo();
		$criteria->add(new Criteria('news_status', 2));
		$Waiting_news = $newsHandler->getCount($criteria);
		if ($Waiting_news > 0){
			$xoopsTpl->assign('warning_message', sprintf(_MA_XMNEWS_NEWS_WAITING, $Waiting_news));
		}		
        
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('news_title');
        $criteria->setOrder('ASC');
        $criteria->setStart($start);
        $criteria->setLimit($nb_limit);
		if ($news_cid != 0){
			$criteria->add(new Criteria('news_cid', $news_cid));
		}
        if ($news_status != 10){
			$criteria->add(new Criteria('news_status', $news_status));
		}    
        $newsHandler->table_link = $newsHandler->db->prefix("xmnews_category");
        $newsHandler->field_link = "category_id";
        $newsHandler->field_object = "news_cid";
        $news_arr = $newsHandler->getByLink($criteria);
        $news_count = $newsHandler->getCount($criteria);
        $xoopsTpl->assign('news_count', $news_count);
        if ($news_count > 0) {
            foreach (array_keys($news_arr) as $i) {
                $news_id                 = $news_arr[$i]->getVar('news_id');
                $news['id']              = $news_id;
                $news['category']        = $news_arr[$i]->getVar('category_name');
				$news['cid']             = $news_arr[$i]->getVar('news_cid');
                $news['title']           = $news_arr[$i]->getVar('news_title');
                $news['reference']       = $news_arr[$i]->getVar('news_reference');
                $news['description']     = \Xmf\Metagen::generateDescription($news_arr[$i]->getVar('news_description', 'show'), 30);
                $news['status']          = $news_arr[$i]->getVar('news_status');
                $news_img                = $news_arr[$i]->getVar('news_logo') ?: 'blank.gif';
                $news['logo']          = '<img src="' . $url_logo . $news_img . '" alt="' . $news_img . '">';
                $xoopsTpl->append_by_ref('news', $news);
                unset($news);
            }
            // Display Page Navigation
            if ($news_count > $nb_limit) {
                $nav = new XoopsPageNav($news_count, $nb_limit, $start, 'start', 'news_cid=' . $news_cid . '&news_status=' . $news_status);
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        } else {
            $xoopsTpl->assign('error_message', _MA_XMNEWS_ERROR_NONEWS);
        }
        break;
   
	// Add
	case 'add':
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMNEWS_NEWS_LIST, 'news.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('category_status', 1));
        $category_count = $categoryHandler->getCount($criteria);
        if ($category_count > 0) {
            // Form
            $obj  = $newsHandler->create();
            $form = $obj->getFormCategory();
            $xoopsTpl->assign('form', $form->render());
        } else {
            redirect_header('category.php?op=add', 2, _MA_XMNEWS_ERROR_NOCATEGORY);
        }
        break;	

    // Loadnews
    case 'loadnews':
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        $xoTheme->addScript('modules/system/js/admin.js');
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMNEWS_NEWS_LIST, 'news.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());  
        $news_category = Request::getInt('news_category', 0);
        if ($news_category == 0) {
            $xoopsTpl->assign('error_message', _MA_XMNEWS_ERROR_NOCATEGORY);
        } else {
            $category = $categoryHandler->get($news_category);
            $obj  = $newsHandler->create();
            $form = $obj->getForm($news_category);
            $xoopsTpl->assign('form', $form->render());
        }
        break;
        
    // Edit
    case 'edit':
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMNEWS_NEWS_LIST, 'news.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Form
        $news_id = Request::getInt('news_id', 0);
        if ($news_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMNEWS_ERROR_NONEWS);
        } else {
            $obj = $newsHandler->get($news_id);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render()); 
        }

        break;
	
	// Clone
    case 'clone':
        $news_id = Request::getInt('news_id', 0);
        if ($news_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMNEWS_ERROR_NONEWS);
        } else {
            $cloneobj = XmnewsUtility::cloneNews($news_id, 'news.php');
            $form = $cloneobj->getForm($cloneobj->getVar('news_cid'), 'news.php', true);
            $xoopsTpl->assign('form', $form->render());
        }
        break;
		
    // Save
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('news.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $news_id = Request::getInt('news_id', 0);
        if ($news_id == 0) {
            $obj = $newsHandler->create();
        } else {
            $obj = $newsHandler->get($news_id);
        }
        $error_message = $obj->saveNews($newsHandler, 'news.php');
        if ($error_message != ''){
            $xoopsTpl->assign('error_message', $error_message);
			$news_cid = Request::getInt('news_cid', 0);
			$form = $obj->getForm($news_cid);
            $xoopsTpl->assign('form', $form->render());
        }        
        break;
        
    // del
    case 'del':
        $news_id = Request::getInt('news_id', 0);
        if ($news_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMNEWS_ERROR_NONEWS);
        } else {
            $surdel = Request::getBool('surdel', false);
            $obj  = $newsHandler->get($news_id);
            if ($surdel === true) {
                if (!$GLOBALS['xoopsSecurity']->check()) {
                    redirect_header('news.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
                }
				$error_message = $obj->delNews($newsHandler, 'news.php');
				if ($error_message != ''){
					$xoopsTpl->assign('error_message', $error_message);
				}
            } else {
                $news_img = $obj->getVar('news_logo') ?: 'blank.gif';
                xoops_confirm(['surdel' => true, 'news_id' => $news_id, 'op' => 'del'], $_SERVER['REQUEST_URI'], 
                                    sprintf(_MA_XMNEWS_NEWS_SUREDEL, $obj->getVar('news_title')) . '<br>
                                    <img src="' . $url_logo . $news_img . '" title="' . 
                                    $obj->getVar('news_name') . '"><br>');
            }
        }        
        break;
        
    // Update status
    case 'news_update_status':
        $news_id = Request::getInt('news_id', 0);
        if ($news_id > 0) {
            $news_status = Request::getInt('news_status', 10);
            $obj = $newsHandler->get($news_id);
            if ($news_status == 0 || $news_status == 2){
                $obj->setVar('news_status', 1);
            } else {
                $obj->setVar('news_status', 0);
            }
            if ($newsHandler->insert($obj)) {
				//Notification news: approve_news
				$tags = [];
				$tags['NEWS_NAME'] = $obj->getVar('news_name');
				$tags['NEWS_URL'] = XOOPS_URL . '/modules/xmnews/viewnews.php?category_id=' . $obj->getVar('news_cid') . '&news_id=' . $news_id;
				$notificationHandler = xoops_getHandler('notification');
				$notificationHandler->triggerEvent('news', $news_id, 'approve_news', $tags);
                exit;
            }
            $xoopsTpl->assign('error_message', $obj->getHtmlErrors());
        }
        break;
}

$xoopsTpl->display("db:xmnews_admin_news.tpl");

require __DIR__ . '/admin_footer.php';

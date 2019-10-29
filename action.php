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

use \Xmf\Request;

include_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'xmnews_action.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

$op = Request::getCmd('op', '');
// Get start pager
$start = Request::getInt('start', 0);

if ($op == 'clone' || $op == 'edit' || $op == 'del' || $op == 'add' || $op == 'loadnews' || $op == 'save') {
    switch ($op) {
        // Add
        case 'add':           
			// Get Permission to submit
			$submitPermissionCat = XmnewsUtility::getPermissionCat('xmnews_submit');
			if (empty($submitPermissionCat)){
				redirect_header('index.php', 2, _NOPERM);
			}			
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('category_status', 1));
			$criteria->setSort('category_weight ASC, category_name');
			$criteria->setStart($start);
			$criteria->setLimit($nb_limit);
			$criteria->setOrder('ASC');
			$criteria->add(new Criteria('category_id', '(' . implode(',', $submitPermissionCat) . ')','IN'));
			$category_arr   = $categoryHandler->getall($criteria);
			$category_count = $categoryHandler->getCount($criteria);
			$xoopsTpl->assign('category_count', $category_count);
			if ($category_count > 0) {
				foreach (array_keys($category_arr) as $i) {
					$category_id              = $category_arr[$i]->getVar('category_id');
					$category['id']           = $category_id;
					$category['name']         = $category_arr[$i]->getVar('category_name');
					$category['description']  = $category_arr[$i]->getVar('category_description', 'show');					
					$category_img             = $category_arr[$i]->getVar('category_logo');
					if ($category_img == ''){
						$category['logo']        = '';
					} else {
						$category['logo']        = $url_logo . $category_img;
					}
					$xoopsTpl->append_by_ref('categories', $category);
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

        // Loadtype
        case 'loadnews':
			$category_id = Request::getInt('category_id', 0);		
			if ($category_id == 0) {
				$xoopsTpl->assign('error_message', _MA_XMNEWS_ERROR_NOCATEGORY);
			} else {
				// Get Permission to submit in category
				$submitPermissionCat = XmnewsUtility::getPermissionCat('xmnews_submit');			
				if (!in_array($category_id, $submitPermissionCat)) {
					redirect_header('action.php?op=add', 2, _NOPERM);
				}
                $obj  = $newsHandler->create();
                $form = $obj->getForm($category_id);
                $xoopsTpl->assign('form', $form->render());;
			}
            break;

        // Edit
        case 'edit':
			$news_id = Request::getInt('news_id', 0);
			if ($news_id == 0) {
                $xoopsTpl->assign('error_message', _MA_XMNEWS_ERROR_NONEWS);
            } else {
				$obj  = $newsHandler->get($news_id);
				// Get Permission to submit in category
				$submitPermissionCat = XmnewsUtility::getPermissionCat('xmnews_submit');
				if (!in_array($obj->getVar('news_cid'), $submitPermissionCat)) {
					redirect_header('index.php', 2, _NOPERM);
				}
                $form = $obj->getForm();
                $xoopsTpl->assign('form', $form->render());
            }
            break;

        // Clone
        case 'clone':
			// permission to clone
            $permHelper->checkPermissionRedirect('xmnews_other', 4, 'index.php', 2, _NOPERM);
            $news_id = Request::getInt('news_id', 0);
            if ($news_id == 0) {
                $xoopsTpl->assign('error_message', _MA_XMNEWS_ERROR_NONEWS);
            } else {
                $cloneobj = XmnewsUtility::cloneNews($news_id);
                $form     = $cloneobj->getForm($cloneobj->getVar('news_cid'), $news_id, 'action.php', true);
                $xoopsTpl->assign('form', $form->render());
            }
            break;

        // Save
        case 'save':
			$news_cid = Request::getInt('news_cid', 0);
			// Get Permission to submit in category
			$submitPermissionCat = XmnewsUtility::getPermissionCat('xmnews_submit');			
			if (!in_array($news_cid, $submitPermissionCat)) {
				redirect_header('index.php', 2, _NOPERM);
			}
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('index.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $news_id = Request::getInt('news_id', 0);
            if ($news_id == 0) {
                $obj = $newsHandler->create();
            } else {
                $obj = $newsHandler->get($news_id);
            }
            $error_message = $obj->saveNews($newsHandler, 'article.php');
            if ($error_message != '') {
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
				// Get Permission to delete in category
				$submitPermissionCat = XmnewsUtility::getPermissionCat('xmnews_delete');
				if (!in_array($obj->getVar('news_cid'), $submitPermissionCat)) {
					redirect_header('index.php', 2, _NOPERM);
				}		
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
										$obj->getVar('news_name') . '" style="max-width:100px"><br>');
				}
			}        
			break;
    }
} else {
    redirect_header('index.php', 2, _NOPERM);
}
include XOOPS_ROOT_PATH . '/footer.php';

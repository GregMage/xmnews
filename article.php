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
use \Xmf\Metagen;

include_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'xmnews_article.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

$news_id  = Request::getInt('news_id', 0);

if ($news_id == 0) {
    redirect_header('index.php', 2, _MA_XMNEWS_ERROR_NONEWS);
}
$news  = $newsHandler->get($news_id);
if (empty($news)) {
    redirect_header('index.php', 2, _MA_XMNEWS_ERROR_NONEWS);
}
$category_id = $news->getVar('news_cid');

if ($category_id == 0) {
    redirect_header('index.php', 2, _MA_XMNEWS_ERROR_NOCATEGORY);
}
$category = $categoryHandler->get($category_id);
if (empty($category)) {
    redirect_header('index.php', 2, _MA_XMNEWS_ERROR_NOCATEGORY);
}
// permission to view
if ($general_redirect == ''){
	$redirectUrl = 'index.php';
} else {
	$redirectUrl = $general_redirect;
}
if ($permHelper->checkPermission('xmnews_viewnews', $category_id) === false){
	redirect_header($redirectUrl,2, _NOPERM);
}

// permission edit and approve submitted news
$permission_editapprove = $permHelper->checkPermission('xmnews_editapprove', $category_id);

if ($permission_editapprove != true || $helper->isUserAdmin() != true){
	if ($category->getVar('category_status') == 0 || $news->getVar('news_status') != 1) {
		redirect_header('index.php', 2, _MA_XMNEWS_ERROR_NACTIVE);
	}
	// redirection si la news n'est pas encore publiée
	if ($news->getVar('news_date') > time()) {
		redirect_header('index.php', 2, _MA_XMNEWS_ERROR_NPUBLISHED);
	}	
}

//permission
$xoopsTpl->assign('perm_clone', $permHelper->checkPermission('xmnews_editapprove', $category_id));
$xoopsTpl->assign('perm_edit', $permHelper->checkPermission('xmnews_editapprove', $category_id));
$xoopsTpl->assign('perm_del', $permHelper->checkPermission('xmnews_delete', $category_id));

// Category
$xoopsTpl->assign('category_name', $category->getVar('category_name'));
$xoopsTpl->assign('category_id', $category_id);
$color = $category->getVar('category_color');
if ($color == '#ffffff'){
	$xoopsTpl->assign('category_color', false);
} else {
	$xoopsTpl->assign('category_color', $color);
}

// News
if ($news->getVar('news_date') > time()) {
	$xoopsTpl->assign('warning_date', true);
}
$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));
$xoopsTpl->assign('news_id', $news_id);
$xoopsTpl->assign('title', $news->getVar('news_title'));
$xoopsTpl->assign('news', $news->getVar('news_news'));
$xoopsTpl->assign('counter', $news->getVar('news_counter'));

$xoopsTpl->assign('date', formatTimestamp($news->getVar('news_date'), 'm'));
if ($news->getVar('news_mdate') != 0) {
    $xoopsTpl->assign('mdate', formatTimestamp($news->getVar('news_mdate'), 's'));
}
$xoopsTpl->assign('author', XoopsUser::getUnameFromId($news->getVar('news_userid')));
$news_img = $news->getVar('news_logo');
if ($news_img == ''){
	$xoopsTpl->assign('logo', '');
	$xoopsTpl->assign('CAT', false);
} elseif($news_img == 'CAT') {
	$xoopsTpl->assign('logo', $url_logo . $category->getVar('category_logo'));
	$xoopsTpl->assign('CAT', true);
} else {
	$xoopsTpl->assign('logo', $url_logo . $news_img);
	$xoopsTpl->assign('CAT', false);
}

$xoopsTpl->assign('status', $news->getVar('news_status'));
$xoopsTpl->assign('douser', $news->getVar('news_douser'));
$xoopsTpl->assign('dodate', $news->getVar('news_dodate'));
$xoopsTpl->assign('domdate', $news->getVar('news_domdate'));
$xoopsTpl->assign('dohits', $news->getVar('news_dohits'));
$xoopsTpl->assign('docomment', $news->getVar('news_docomment'));

//xmsocial
if (xoops_isActiveModule('xmsocial')){
	xoops_load('utility', 'xmsocial');
	if ($helper->getConfig('general_xmsocial', 0) == 1){
		$xmsocial_arr = XmsocialUtility::renderRating($xoTheme, 'xmnews', $news_id, 5, $news->getVar('news_rating'), $news->getVar('news_votes'));
		$xoopsTpl->assign('xmsocial_arr', $xmsocial_arr);
		$xoopsTpl->assign('dorating', $news->getVar('news_dorating'));
	} else {
		 $xoopsTpl->assign('dorating', 0);
	}
	if ($helper->getConfig('general_xmsocial_social', 0) == 1) {
		XmsocialUtility::renderSocial($xoopsTpl,'xmnews', $news_id, XOOPS_URL . '/modules/xmnews/article.php?news_id=' . $news_id);
		$xoopsTpl->assign('social', true);
	} else {
		$xoopsTpl->assign('social', false);
	}
}

//counter
$counterUpdate = false;
$options = array(
	'expires' => (time() + $helper->getConfig('general_countertime', 10) * 60),
	'path'     => '/',
	'domain'   => null,
	'secure'   => false,
	'httponly' => true,
	'samesite' => 'strict',
);
if (isset($_COOKIE['xmnewsCounterId'])) {
	$counterIds = unserialize($_COOKIE['xmnewsCounterId']);
	if (!in_array($news_id, $counterIds)){
		array_push($counterIds, $news_id);
		setcookie("xmnewsCounterId", serialize($counterIds), $options);
		$counterUpdate = true;
	}
} else {
	$counterId[] = $news_id;
	setcookie("xmnewsCounterId", serialize($counterId), $options);
	$counterUpdate = true;
}
if ($counterUpdate == true){
	$sql = 'UPDATE ' . $xoopsDB->prefix('xmnews_news') . ' SET news_counter=news_counter+1 WHERE news_id = ' . $news_id;
	$xoopsDB->queryF($sql);
}

//xmdoc
if (xoops_isActiveModule('xmdoc') && $helper->getConfig('general_xmdoc', 0) == 1) {
    xoops_load('utility', 'xmdoc');
    XmdocUtility::renderDocuments($xoopsTpl, $xoTheme, 'xmnews', $news_id);
} else {
    $xoopsTpl->assign('xmdoc_viewdocs', false);
}

//navigation
$navigation = $helper->getConfig('general_navigation', 0);
$orderNavigation = $helper->getConfig('general_ordernavigation', 0);
if ($navigation != 0){
	$xoopsTpl->assign('navigation', true);
	$viewPermissionCat = XmnewsUtility::getPermissionCat('xmnews_viewnews');
	//before
	$criteria = new CriteriaCompo();
	if (!empty($viewPermissionCat)){
		$criteria->add(new Criteria('news_cid', '(' . implode(',', $viewPermissionCat) . ')', 'IN'));
	}
	if ($navigation == 2){
		$criteria->add(new Criteria('news_cid', $news->getVar('news_cid')));
	}
	$criteria->add(new Criteria('news_status', 1));
	if ($orderNavigation == 0){
		$criteria->add(new Criteria('news_date', $news->getVar('news_date'),'<'));
	} else {
		$criteria->add(new Criteria('news_date', $news->getVar('news_date'),'>'));
	}
	$criteria->add(new Criteria('news_date', time(),'<='));
	$criteria->setSort('news_date');
	if ($orderNavigation == 0){
		$criteria->setOrder('DESC');
	} else {
		$criteria->setOrder('ASC');
	}
	$criteria->setLimit(1);
	$newsHandler->table_link = $newsHandler->db->prefix("xmnews_category");
	$newsHandler->field_link = "category_id";
	$newsHandler->field_object = "news_cid";
	$news_before_arr = $newsHandler->getByLink($criteria);	
	if (count($news_before_arr) == 0) {
		$xoopsTpl->assign('news_before_status', false);
	}else{
		$xoopsTpl->assign('news_before_status', true);
		foreach (array_keys($news_before_arr) as $i) {
			$xoopsTpl->assign('news_before_title', $news_before_arr[$i]->getVar('news_title'));
			$xoopsTpl->assign('news_before_id', $news_before_arr[$i]->getVar('news_id'));
			$color = $news_before_arr[$i]->getVar('category_color');
			if ($color == '#ffffff'){
				$xoopsTpl->assign('news_before_color', false);
			} else {
				$xoopsTpl->assign('news_before_color', $color);
			}
			if ($orderNavigation == 0){
				$xoopsTpl->assign('news_before_text', _MA_XMNEWS_NEWS_NAV_BEFORE);
			} else {
				$xoopsTpl->assign('news_before_text', _MA_XMNEWS_NEWS_NAV_AFTER);
			}
		}
	}
	//after
	$criteria = new CriteriaCompo();
	if (!empty($viewPermissionCat)){
		$criteria->add(new Criteria('news_cid', '(' . implode(',', $viewPermissionCat) . ')', 'IN'));
	}
	if ($navigation == 2){
		$criteria->add(new Criteria('news_cid', $news->getVar('news_cid')));
	}
	$criteria->add(new Criteria('news_status', 1));
	if ($orderNavigation == 0){
		$criteria->add(new Criteria('news_date', $news->getVar('news_date'),'>'));
	} else {
		$criteria->add(new Criteria('news_date', $news->getVar('news_date'),'<'));
	}
	$criteria->add(new Criteria('news_date', time(),'<='));
	$criteria->setSort('news_date');
	if ($orderNavigation == 0){
		$criteria->setOrder('ASC');
	} else {
		$criteria->setOrder('DESC');
	}
	$criteria->setLimit(1);
	$newsHandler->table_link = $newsHandler->db->prefix("xmnews_category");
	$newsHandler->field_link = "category_id";
	$newsHandler->field_object = "news_cid";
	$news_after_arr = $newsHandler->getByLink($criteria);	
	if (count($news_after_arr) == 0) {
		$xoopsTpl->assign('news_after_status', false);
	}else{
		$xoopsTpl->assign('news_after_status', true);
		foreach (array_keys($news_after_arr) as $i) {
			$xoopsTpl->assign('news_after_title', $news_after_arr[$i]->getVar('news_title'));
			$xoopsTpl->assign('news_after_id', $news_after_arr[$i]->getVar('news_id'));
			$color = $news_after_arr[$i]->getVar('category_color');
			if ($color == '#ffffff'){
				$xoopsTpl->assign('news_after_color', false);
			} else {
				$xoopsTpl->assign('news_after_color', $color);
			}
			if ($orderNavigation == 0){
				$xoopsTpl->assign('news_after_text', _MA_XMNEWS_NEWS_NAV_AFTER);
			} else {
				$xoopsTpl->assign('news_after_text', _MA_XMNEWS_NEWS_NAV_BEFORE);
			}
		}
	}
} else {
	$xoopsTpl->assign('navigation', false);
}

//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', strip_tags($news->getVar('news_title')) . '-' . $xoopsModule->name());
//description
$xoTheme->addMeta('meta', 'description', XmnewsUtility::generateDescriptionTagSafe($news->getVar('news_description'), 80));
//keywords
if ('' == $news->getVar('news_mkeyword')) {
    $keywords = Metagen::generateKeywords($news->getVar('news_news'), 10);    
    $xoTheme->addMeta('meta', 'keywords', implode(', ', $keywords));
} else {
    $xoTheme->addMeta('meta', 'keywords', $news->getVar('news_mkeyword'));
}

include XOOPS_ROOT_PATH.'/include/comment_view.php';
include XOOPS_ROOT_PATH . '/footer.php';

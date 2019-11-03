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
$GLOBALS['xoopsOption']['template_main'] = 'xmnews_article.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

$category_id = Request::getInt('category_id', 0);
$news_id  = Request::getInt('news_id', 0);

if ($news_id == 0) {
    redirect_header('index.php', 2, _MA_XMNEWS_ERROR_NONEWS);
}
$news  = $newsHandler->get($news_id);
if (empty($news)) {
    redirect_header('index.php', 2, _MA_XMNEWS_ERROR_NOARTICLE);
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
$permHelper->checkPermissionRedirect('xmnews_view', $category_id, 'index.php', 2, _NOPERM);

if ($helper->isUserAdmin() != true){
	if ($category->getVar('category_status') == 0 || $news->getVar('news_status') != 1) {
		redirect_header('index.php', 2, _MA_XMNEWS_ERROR_NACTIVE);
	}
	// redirection si la news n'est pas encore publiée
	if ($news->getVar('news_date') > time()) {
		redirect_header('index.php', 2, _MA_XMNEWS_ERROR_NPUBLISHED);
	}
	
}

//permission
$xoopsTpl->assign('perm_clone', $permHelper->checkPermission('xmnews_other', 4));
$xoopsTpl->assign('perm_edit', $permHelper->checkPermission('xmnews_submit', $category_id));
$xoopsTpl->assign('perm_del', $permHelper->checkPermission('xmnews_delete', $category_id));


// Category
$xoopsTpl->assign('category_name', $category->getVar('category_name'));
$xoopsTpl->assign('category_id', $category_id);

// News
$xoopsTpl->assign('news_id', $news_id);
$xoopsTpl->assign('title', $news->getVar('news_title'));
$xoopsTpl->assign('news', $news->getVar('news_news'));
$xoopsTpl->assign('counter', $news->getVar('news_counter'));
$xoopsTpl->assign('rating', number_format($news->getVar('news_rating'), 1));
$xoopsTpl->assign('votes', sprintf(_MA_XMNEWS_NEWS_VOTES, $news->getVar('news_votes')));
$xoopsTpl->assign('date', formatTimestamp($news->getVar('news_date'), 'm'));
if ($news->getVar('news_mdate') != 0) {
    $xoopsTpl->assign('mdate', formatTimestamp($news->getVar('news_mdate'), 's'));
}
$xoopsTpl->assign('author', XoopsUser::getUnameFromId($news->getVar('news_userid')));
$news_img = $news->getVar('news_logo');
if ($news_img == ''){
	$xoopsTpl->assign('logo', '');
} else {
	$xoopsTpl->assign('logo', $url_logo . $news_img);
}
$xoopsTpl->assign('status', $news->getVar('news_status'));
$xoopsTpl->assign('douser', $news->getVar('news_douser'));
$xoopsTpl->assign('dodate', $news->getVar('news_dodate'));
$xoopsTpl->assign('domdate', $news->getVar('news_domdate'));
$xoopsTpl->assign('dohits', $news->getVar('news_dohits'));
$xoopsTpl->assign('dodorating', $news->getVar('news_dorating'));
$xoopsTpl->assign('docomment', $news->getVar('news_docomment'));

//counter
$counterUpdate = false;
if (isset($_COOKIE['xmnewsCounterId'])) {
	$counterIds = unserialize($_COOKIE['xmnewsCounterId']);
	if (!in_array($news_id, $counterIds)){
		array_push($counterIds, $news_id);
		setcookie("xmnewsCounterId", serialize($counterIds), time() + $helper->getConfig('general_countertime', 10) * 60);
		$counterUpdate = true;
	}
} else {
	$counterId[] = $news_id;
	setcookie("xmnewsCounterId", serialize($counterId), time() + $helper->getConfig('general_countertime', 10) * 60);
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
//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', \Xmf\Metagen::generateSeoTitle($news->getVar('news_title') . '-' . $xoopsModule->name()));
//description
$xoTheme->addMeta('meta', 'description', \Xmf\Metagen::generateDescription($news->getVar('news_description'), 30));
//keywords
if ('' == $news->getVar('news_mkeyword')) {
    $keywords = \Xmf\Metagen::generateKeywords($news->getVar('news_news'), 10);    
    $xoTheme->addMeta('meta', 'keywords', implode(', ', $keywords));
} else {
    $xoTheme->addMeta('meta', 'keywords', $news->getVar('news_mkeyword'));
}

//include XOOPS_ROOT_PATH.'/include/comment_view.php';
include XOOPS_ROOT_PATH . '/footer.php';

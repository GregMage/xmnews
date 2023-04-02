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
use Xmf\Module\Helper;
require_once __DIR__ . '/header.php';

error_reporting(0);
$GLOBALS['xoopsLogger']->activated = false;

require_once $GLOBALS['xoops']->path('class/template.php');
if (function_exists('mb_http_output')) {
    mb_http_output('pass');
}

// Get Permission to view abstract
$viewPermissionCat = XmnewsUtility::getPermissionCat('xmnews_viewabstract');

$nb_limit = $helper->getConfig('general_perpage', 15);
$news_cid = Request::getInt('news_cid', 0);

header('Content-Type:text/xml; charset=' . _CHARSET);
$tpl          = new \XoopsTpl();
$tpl->caching = 2;
//$tpl->xoops_setCacheTime(0);
$tpl->cache_lifetime = 0;
$myts = \MyTextSanitizer::getInstance();
if (!$tpl->isCached('db:xmnews_rss.tpl')) {
	// Category
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('category_status', 1));
	$criteria->setSort('category_weight ASC, category_name');
	$criteria->setOrder('ASC');
	$category_arr = $categoryHandler->getall($criteria);

	// Criteria
	$criteria = new CriteriaCompo();
	$criteria->setSort('news_date');
	$criteria->setOrder('DESC');
	$criteria->setLimit($nb_limit);
	$criteria->add(new Criteria('news_status', 1));
	$criteria->add(new Criteria('news_date', time(),'<='));
	if (!empty($viewPermissionCat)){
		$criteria->add(new Criteria('news_cid', '(' . implode(',', $viewPermissionCat) . ')', 'IN'));
	}
	if ($news_cid != 0){
		// vérification si la categorie est activée
		$check_category = $categoryHandler->get($news_cid);
		if (!empty($check_category)) {
			if ($check_category->getVar('category_status') != 1){
				$criteria->add(new Criteria('news_cid', $news_cid));
			}
		}
	}
	$newsHandler->table_link = $newsHandler->db->prefix("xmnews_category");
	$newsHandler->field_link = "category_id";
	$newsHandler->field_object = "news_cid";
	$news_arr = $newsHandler->getByLink($criteria);
	$news_count = $newsHandler->getCount($criteria);
	if ($news_count > 0 && !empty($viewPermissionCat)) {
		$channel_category = $helper->getModule()->name();
		// Check if ML Hack is installed, and if yes, parse the $content in formatForML
		if (method_exists($myts, 'formatForML')) {
			$GLOBALS['xoopsConfig']['sitename'] = $myts->formatForML($GLOBALS['xoopsConfig']['sitename']);
			$GLOBALS['xoopsConfig']['slogan']   = $myts->formatForML($GLOBALS['xoopsConfig']['slogan']);
			$channel_category                   = $myts->formatForML($channel_category);
		}
		$tpl->assign('channel_charset', _CHARSET);
		$tpl->assign('channel_title', htmlspecialchars($GLOBALS['xoopsConfig']['sitename'], ENT_QUOTES | ENT_HTML5));
		$tpl->assign('channel_link', htmlspecialchars(XOOPS_URL . '/modules/xmnews', ENT_QUOTES | ENT_HTML5));
		$tpl->assign('channel_desc', htmlspecialchars($GLOBALS['xoopsConfig']['slogan'], ENT_QUOTES | ENT_HTML5));
		$tpl->assign('channel_lastbuild', formatTimestamp(time(), 'rss'));
		$tpl->assign('channel_webmaster', $GLOBALS['xoopsConfig']['adminmail'] . '( ' . htmlspecialchars($GLOBALS['xoopsConfig']['sitename'], ENT_QUOTES | ENT_HTML5) . ' )');
		$tpl->assign('channel_editor', $GLOBALS['xoopsConfig']['adminmail'] . '( ' . htmlspecialchars($GLOBALS['xoopsConfig']['sitename'], ENT_QUOTES | ENT_HTML5) . ' )');
		if ($news_cid != 0){
			$channel_category .= ' > ' . $category_arr[$news_cid]->getVar('category_name');
		}
		$tpl->assign('channel_category', htmlspecialchars($channel_category, ENT_QUOTES | ENT_HTML5));
		$tpl->assign('channel_generator', $helper->getModule()->name());
		$tpl->assign('channel_language', _LANGCODE);
		$tpl->assign('image_url', XOOPS_URL . '/images/logo.gif');
		$dimention = getimagesize($GLOBALS['xoops']->path('images/logo.gif'));
		if (empty($dimention[0])) {
			$width  = 140;
			$height = 140;
		} else {
			$width        = ($dimention[0] > 140) ? 140 : $dimention[0];
			$dimention[1] = $dimention[1] * $width / $dimention[0];
			$height       = ($dimention[1] > 140) ? $dimention[1] * $dimention[0] / 140 : $dimention[1];
		}
		$height = round($height, 0, PHP_ROUND_HALF_UP);
		$tpl->assign('image_width', $width);
		$tpl->assign('image_height', $height);
		foreach (array_keys($news_arr) as $i) {
            $tpl->append('items', [
                'title'       => htmlspecialchars($news_arr[$i]->getVar('news_title'), ENT_QUOTES | ENT_HTML5),
                'link'        => htmlspecialchars(XOOPS_URL . '/modules/xmnews/article.php?news_id=' . $news_arr[$i]->getVar('news_id'), ENT_QUOTES | ENT_HTML5),
                'guid'        => XOOPS_URL . '/modules/xmnews/article.php?news_id=' . $news_arr[$i]->getVar('news_id'),
                'pubdate'     => formatTimestamp($news_arr[$i]->getVar('news_date'), 'rss'),
                'description' => htmlspecialchars($news_arr[$i]->getVar('news_description'), ENT_QUOTES | ENT_HTML5)
            ]);
		}

	}
}
$tpl->display('db:xmnews_rss.tpl');
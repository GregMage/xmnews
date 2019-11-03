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

/**
 * @param $category
 * @param $item_id
 * @return mixed
 */
function xmnews_notify_iteminfo($category, $item_id)
{
    global $xoopsDB;
	switch ($category) {
		case 'global':
			$item['name'] = '';
			$item['url']  = '';
			return $item;
			break;
			
		case 'category':
			$sql          = 'SELECT category_name FROM ' . $xoopsDB->prefix('xmnews_category') . ' WHERE category_id = ' . $item_id;
			$result       = $xoopsDB->query($sql);
			$result_array = $xoopsDB->fetchArray($result);
			$item['name'] = $result_array['category_name'];
			$item['url']  = XOOPS_URL . '/modules/xmnews/index.php?news_cid=' . $item_id;
			return $item;
			break;

		case 'news':
			$sql          = 'SELECT news_title,news_cid FROM ' . $xoopsDB->prefix('xmnews_news') . ' WHERE news_id = ' . $item_id;
			$result       = $xoopsDB->query($sql);
			$result_array = $xoopsDB->fetchArray($result);
			$item['name'] = $result_array['news_title'];
			$item['url']  = XOOPS_URL . '/modules/xmnews/article.php?news_id=' . $item_id;			
			return $item;
			break;
	}
    return null;
}

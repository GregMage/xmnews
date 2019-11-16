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
use Xmf\Request;
use Xmf\Module\Helper;
include_once dirname(dirname(__DIR__)) . '/mainfile.php';
include_once __DIR__ . '/include/common.php';

$com_itemid = Request::getInt('com_itemid', 0, 'GET');
if ($com_itemid > 0) {
	$news = $newsHandler->get($com_itemid);
    // permission to view news
	$permHelper = new Helper\Permission();
	$permHelper->checkPermissionRedirect('xmnews_viewnews', $news->getVar('news_cid'), 'index.php', 2, _NOPERM);
    $gpermHandler = xoops_getHandler('groupperm');
        
    $com_replytitle = $news->getVar('news_title');

    include_once $GLOBALS['xoops']->path('include/comment_new.php');
}

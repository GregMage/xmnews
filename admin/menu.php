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
defined('XOOPS_ROOT_PATH') || die('XOOPS root path not defined');

// get path to icons
$pathIcon32 = Admin::menuIconPath('');

$adminmenu = [];
// Index
$adminmenu[] = [
    'title' => _MI_XMNEWS_MENU_HOME,
    'link'  => 'admin/index.php',
    'icon'  => $pathIcon32 . 'home.png'
];
// Category
$adminmenu[] = [
    'title' => _MI_XMNEWS_MENU_CATEGORY,
    'link'  => 'admin/category.php',
    'icon'  => $pathIcon32 . 'category.png'
];
// News
$adminmenu[] = [
    'title' => _MI_XMNEWS_MENU_NEWS,
    'link'  => 'admin/news.php',
    'icon'  => $pathIcon32 . 'folder_txt.png'
];
// Permission
$adminmenu[] = [
    'title' => _MI_XMNEWS_MENU_PERMISSION,
    'link'  => 'admin/permission.php',
    'icon'  => $pathIcon32 . 'permissions.png'
];
// About
$adminmenu[] = [
    'title' => _MI_XMNEWS_MENU_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => $pathIcon32 . 'about.png'
];

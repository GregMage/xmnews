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
$modversion['dirname']     = basename(__DIR__);
$modversion['name']        = ucfirst(basename(__DIR__));
$modversion['version']     = '0.1';
$modversion['description'] = _MI_XMNEWS_DESC;
$modversion['author']      = 'Grégory Mage (Mage)';
$modversion['url']         = 'https://github.com/GregMage';
$modversion['credits']     = 'Mage';

$modversion['help']        = 'page=help';
$modversion['license']     = 'GNU GPL 2 or later';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl-2.0.html';
$modversion['official']    = 0;
$modversion['image']       = 'assets/images/xmnews_logo.png';

// Menu
$modversion['hasMain'] = 1;
$modversion['sub'][]   = [
    'name' => _MI_XMNEWS_SUB_ADD,
    'url'  => 'action.php?op=add'
];

// Comments
/*$modversion['hasComments'] = 1;
$modversion['comments']['itemName']            = 'news_id';
$modversion['comments']['pageName']            = 'viewnews.php';
$modversion['comments']['extraParams']         = ['category_id'];
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'content_com_approve';
$modversion['comments']['callback']['update']  = 'content_com_update';*/

// Search
/*$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'xmnews_search';*/

// Admin things
$modversion['hasAdmin']    = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';

// Install and update
$modversion['onInstall']        = 'include/install.php';
//$modversion['onUpdate']         = 'include/update.php';

// Tables
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

$modversion['tables'][1] = 'xmnews_category';
$modversion['tables'][2] = 'xmnews_news';

// Admin Templates
$modversion['templates'][] = ['file' => 'xmnews_admin_category.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'xmnews_admin_news.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'xmnews_admin_permission.tpl', 'description' => '', 'type' => 'admin'];

// User Templates



// Configs
$modversion['config'] = [];

$modversion['config'][] = [
    'name'        => 'break',
    'title'       => '_MI_XMNEWS_PREF_HEAD_GENERAL',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'text',
    'default'     => 'head',
];

$modversion['config'][] = [
    'name'        => 'general_perpage',
    'title'       => '_MI_XMNEWS_PREF_GENERALITEMPERPAGE',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 15
];

xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'admin_editor',
    'title'       => '_MI_XMNEWS_PREF_EDITOR',
    'description' => '',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtmltextarea',
    'options'     => array_flip($editorHandler->getList())
];

$modversion['config'][] = [
    'name'        => 'general_xmdoc',
    'title'       => '_MI_XMNEWS_PREF_GENERALXMDOC',
    'description' => '',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'general_captcha',
    'title'       => '_MI_XMNEWS_PREF_CAPTCHA',
    'description' => '_MI_XMNEWS_PREF_CAPTCHA_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'general_countertime',
    'title'       => '_MI_XMNEWS_PREF_COUNTERTIME',
    'description' => '_MI_XMNEWS_PREF_COUNTERTIME_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10
];

$modversion['config'][] = [
    'name'        => 'break',
    'title'       => '_MI_XMNEWS_PREF_HEAD_ADMIN',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'text',
    'default'     => 'head',
];

$modversion['config'][] = [
    'name'        => 'admin_perpage',
    'title'       => '_MI_XMNEWS_PREF_ITEMPERPAGE',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 15
];
// ------------------- Notifications -------------------
$modversion['config'][] = [
    'name' => 'break',
    'title' => '_MI_XMNEWS_PREF_HEAD_COMNOTI',
    'description' => '',
    'formtype' => 'line_break',
    'valuetype' => 'textbox',
    'default' => 'head',
];
/*$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'xmarticle_notify_iteminfo';*/


// About stuff
$modversion['module_status'] = 'Alpha';
$modversion['release_date']  = '2019/10/26';

$modversion['developer_lead']      = 'Mage';
$modversion['module_website_url']  = 'github.com/GregMage';
$modversion['module_website_name'] = 'github.com/GregMage';

$modversion['min_xoops'] = '2.5.10';
$modversion['min_php']   = '7.0';

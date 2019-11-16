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
$modversion['version']     = '1.0';
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
$modversion['hasComments'] = 1;
$modversion['comments']['itemName']            = 'news_id';
$modversion['comments']['pageName']            = 'article.php';
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'content_com_approve';
$modversion['comments']['callback']['update']  = 'content_com_update';

// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'xmnews_search';

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
$modversion['templates'][] = ['file' => 'xmnews_index.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmnews_article.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmnews_action.tpl', 'description' => ''];

// Blocks
$modversion['blocks'][] = array(
    'file'        => 'xmnews_blocks.php',
    'name'        => _MI_XMNEWS_BLOCK_DATE,
    'description' => _MI_XMNEWS_BLOCK_DATE_DESC,
    'show_func'   => 'block_xmnews_show',
    'edit_func'   => 'block_xmnews_edit',
	'options'     => '0|5|date',
    'template'    => 'xmnews_block.tpl'
);
$modversion['blocks'][] = array(
    'file'        => 'xmnews_blocks.php',
    'name'        => _MI_XMNEWS_BLOCK_HITS,
    'description' => _MI_XMNEWS_BLOCK_HITS_DESC,
    'show_func'   => 'block_xmnews_show',
    'edit_func'   => 'block_xmnews_edit',
	'options'     => '0|5|hits',
    'template'    => 'xmnews_block.tpl'
);
$modversion['blocks'][] = array(
    'file'        => 'xmnews_blocks.php',
    'name'        => _MI_XMNEWS_BLOCK_RATING,
    'description' => _MI_XMNEWS_BLOCK_RATING_DESC,
    'show_func'   => 'block_xmnews_show',
    'edit_func'   => 'block_xmnews_edit',
	'options'     => '0|5|rating',
    'template'    => 'xmnews_block.tpl'
);
$modversion['blocks'][] = array(
    'file'        => 'xmnews_blocks.php',
    'name'        => _MI_XMNEWS_BLOCK_RANDOM,
    'description' => _MI_XMNEWS_BLOCK_RANDOM_DESC,
    'show_func'   => 'block_xmnews_show',
    'edit_func'   => 'block_xmnews_edit',
	'options'     => '0|5|random',
    'template'    => 'xmnews_block.tpl'
);
$modversion['blocks'][] = array(
    'file'        => 'xmnews_blocks.php',
    'name'        => _MI_XMNEWS_BLOCK_WAITING,
    'description' => _MI_XMNEWS_BLOCK_WAITING_DESC,
    'show_func'   => 'block_xmnews_show',
    'edit_func'   => 'block_xmnews_edit',
	'options'     => '0|5|waiting',
    'template'    => 'xmnews_block_waiting.tpl'
);

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
    'name'        => 'general_editor',
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

$optionMaxsize['0.1 ' . _MI_XMNEWS_PREF_MAXUPLOADSIZE_MBYTES] = 104858;
$optionMaxsize['0.5 ' . _MI_XMNEWS_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*0.5;
$optionMaxsize['1 ' . _MI_XMNEWS_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*1;
$optionMaxsize['1.5 ' . _MI_XMNEWS_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*1.5;
$optionMaxsize['2 ' . _MI_XMNEWS_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*2;
$optionMaxsize['5 ' . _MI_XMNEWS_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*5;
$optionMaxsize['10 ' . _MI_XMNEWS_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*10;
$modversion['config'][] = [
    'name'        => 'general_maxuploadsize',
    'title'       => '_MI_XMNEWS_PREF_MAXUPLOADSIZE',
    'description' => '_MI_XMNEWS_PREF_MAXUPLOADSIZE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 104858,
	'options' => $optionMaxsize,
];

$modversion['config'][] = [
    'name'        => 'general_redirect',
    'title'       => '_MI_XMNEWS_PREF_REDIRECT',
    'description' => '_MI_XMNEWS_PREF_REDIRECT_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'string',
    'default'     => ''
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
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'xmnews_notify_iteminfo';

$modversion['notification']['category'][] = [
    'name' => 'global',
    'title' => _MI_XMNEWS_NOTIFICATION_GLOBAL,
    'description' => _MI_XMNEWS_NOTIFICATION_GLOBAL_DESC,
    'subscribe_from' => ['index.php', 'article.php'],
];

$modversion['notification']['event'][] = [
    'name' => 'new_article',
    'category' => 'global',
    'title' =>  _MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS,
    'caption' => _MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_CAP,
    'description' => _MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_DESC,
    'mail_template' => 'global_newnews',
    'mail_subject' => _MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_SBJ,
];

$modversion['notification']['event'][] = [
    'name' => 'submit_news',
    'category' => 'global',
    'title' =>  _MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS,
    'caption' => _MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_CAP,
    'description' => _MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_DESC,
    'mail_template' => 'global_submitnews',
    'mail_subject' => _MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_SBJ,
    'admin_only' => 1,
];

$modversion['notification']['category'][] = [
    'name' => 'category',
    'title' => _MI_XMNEWS_NOTIFICATION_CATEGORY,
    'description' => _MI_XMNEWS_NOTIFICATION_CATEGORY_DESC,
    'subscribe_from' => ['index.php', 'article.php'],
    'item_name' => 'news_cid',
];

$modversion['notification']['event'][] = [
    'name' => 'new_news',
    'category' => 'category',
    'title' =>  _MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS,
    'caption' => _MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_CAP,
    'description' => _MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_DESC,
    'mail_template' => 'category_newnews',
    'mail_subject' => _MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_SBJ,
];

$modversion['notification']['category'][] = [
    'name' => 'news',
    'title' => _MI_XMNEWS_NOTIFICATION_NEWS,
    'description' => _MI_XMNEWS_NOTIFICATION_NEWS_DESC,
    'subscribe_from' => 'article.php',
    'item_name' => 'news_id',
    'allow_bookmark' => 1,
];

$modversion['notification']['event'][] = [
    'name' => 'modified_news',
    'category' => 'news',
    'title' =>  _MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS,
    'caption' => _MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_CAP,
    'description' => _MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_DESC,
    'mail_template' => 'news_modifiednews',
    'mail_subject' => _MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_SBJ,
];

$modversion['notification']['event'][] = [
    'name' => 'approve_news',
    'category' => 'news',
    'invisible' => 1,
    'title' =>  _MI_XMNEWS_NOTIFICATION_NEWS_APPROVE,
    'caption' => _MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_CAP,
    'description' => _MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_DESC,
    'mail_template' => 'news_approvenews',
    'mail_subject' => _MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_SBJ,
];

// About stuff
$modversion['module_status'] = 'Beta 1';
$modversion['release_date']  = '2019/11/15';

$modversion['developer_lead']      = 'Mage';
$modversion['module_website_url']  = 'github.com/GregMage';
$modversion['module_website_name'] = 'github.com/GregMage';

$modversion['min_xoops'] = '2.5.10';
$modversion['min_php']   = '7.0';

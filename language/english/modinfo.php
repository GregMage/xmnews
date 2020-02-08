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
// The name of this module
define('_MI_XMNEWS_NAME', 'News');
define('_MI_XMNEWS_DESC', 'Management news');

// Menu
define('_MI_XMNEWS_MENU_HOME', 'Index');
define('_MI_XMNEWS_MENU_CATEGORY', 'Categories');
define('_MI_XMNEWS_MENU_NEWS', 'News');
define('_MI_XMNEWS_MENU_PERMISSION', 'Permissions');
define('_MI_XMNEWS_MENU_ABOUT', 'About');

// Sub menu
define('_MI_XMNEWS_SUB_ADD', 'Submit a news');

// Block
define('_MI_XMNEWS_BLOCK_DATE', 'Recent News');
define('_MI_XMNEWS_BLOCK_DATE_DESC', 'Display Recent News');
define('_MI_XMNEWS_BLOCK_HITS', 'Top News (hits)');
define('_MI_XMNEWS_BLOCK_HITS_DESC', 'Display Top News (hits)');
define('_MI_XMNEWS_BLOCK_RATING', 'Top Rated News');
define('_MI_XMNEWS_BLOCK_RATING_DESC', 'Display Top Rated News');
define('_MI_XMNEWS_BLOCK_RANDOM', 'Random News');
define('_MI_XMNEWS_BLOCK_RANDOM_DESC', 'Display news randomly');
define('_MI_XMNEWS_BLOCK_WAITING', 'Waiting News');
define('_MI_XMNEWS_BLOCK_WAITING_DESC', 'Display waiting news');

// Pref
define('_MI_XMNEWS_PREF_HEAD_GENERAL', '<span style="font-size: large;  font-weight: bold;">General</span>');
define('_MI_XMNEWS_PREF_GENERALITEMPERPAGE', 'Number of items per page in the general view');
define('_MI_XMNEWS_PREF_GENERALXMDOC', 'Use xmdoc module to add document');
define('_MI_XMNEWS_PREF_CAPTCHA', 'Use Captcha?');
define('_MI_XMNEWS_PREF_CAPTCHA_DESC', 'Select Yes to use Captcha in the submit form');
define('_MI_XMNEWS_PREF_COUNTERTIME', 'Select the time before the news reading counter can be incremented by the same person. [min]');
define('_MI_XMNEWS_PREF_COUNTERTIME_DESC', 'Put "0" if you do not want to put any limitation');
define('_MI_XMNEWS_PREF_MAXUPLOADSIZE', 'Max uploaded files size');
define('_MI_XMNEWS_PREF_MAXUPLOADSIZE_DESC', 'This concerns the logos that are uploaded for categories and news');
define('_MI_XMNEWS_PREF_MAXUPLOADSIZE_MBYTES', 'MB');
define('_MI_XMNEWS_PREF_REDIRECT', 'Redirect URL if the visitor does not have access to a news');
define('_MI_XMNEWS_PREF_REDIRECT_DESC', 'Empty, the default redirection is used (index.php). This option can be useful to redirect the visitor to a premium account subscription page to get full access to the desired news.');
define('_MI_XMNEWS_PREF_HEAD_ADMIN', '<span style="font-size: large;  font-weight: bold;">Administration</span>');
define('_MI_XMNEWS_PREF_EDITOR', 'Text Editor');
define('_MI_XMNEWS_PREF_ITEMPERPAGE', 'Number of items per page in the administration view');
define('_MI_XMNEWS_PREF_HEAD_COMNOTI', '<span style="font-size: large;  font-weight: bold;">Comments and notifications</span>');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL', 'Global');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_DESC', 'Global notification options for news.');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS', 'New news');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_CAP', 'Notify me when a new news is posted.');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_DESC', 'Receive notification when a new news is posted.');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_NEWNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notify: New news');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS', 'News submitted');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_CAP', 'Notify me when a new news is submitted (awaiting approval).');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_DESC', 'Receive notification when a new news is submitted (awaiting approval).');
define('_MI_XMNEWS_NOTIFICATION_GLOBAL_SUBMITNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notify: New articleis submitted (awaiting approval)');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY', 'Category');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_DESC', 'Notification options that apply to the current news category.');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS', 'New news');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_CAP', 'Notify me when a new news is posted to the current category.');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_DESC', 'Receive notification when a new news is posted to the current category.');
define('_MI_XMNEWS_NOTIFICATION_CATEGORY_NEWNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notify: New news in category');
define('_MI_XMNEWS_NOTIFICATION_NEWS', 'News');
define('_MI_XMNEWS_NOTIFICATION_NEWS_DESC', 'Notification options that apply to the current news.');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS', 'Modified news');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_CAP', 'Notify me when this news is modified');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_DESC', 'Receive notification when this news is modified.');
define('_MI_XMNEWS_NOTIFICATION_NEWS_MODIFIEDNEWS_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notify: Modified news');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE', 'News approved');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_CAP', 'Notify me when this news is approved');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_DESC', 'Receive notification when this news is approved.');
define('_MI_XMNEWS_NOTIFICATION_NEWS_APPROVE_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notify: News approved');

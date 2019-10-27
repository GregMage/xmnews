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

// Button
define('_MA_XMNEWS_NEWS_ADD', 'Add news');
define('_MA_XMNEWS_NEWS_LIST', 'News list');
define('_MA_XMNEWS_CATEGORY_ADD', 'Add category');
define('_MA_XMNEWS_CATEGORY_LIST', 'Category list');
define('_MA_XMNEWS_REDIRECT_SAVE', 'Successfully saved');
 
// Admin
define('_MA_XMNEWS_INDEXCONFIG_XMDOC_WARNINGNOTINSTALLED', 'You have not installed the xmdoc module, this module is required if you want to add documents to the news');
define('_MA_XMNEWS_INDEXCONFIG_XMDOC_WARNINGNOTACTIVATE', 'You must enable in xmarticle preferences the use of xmdoc (if you want to add documents)');
 
// Error message
define('_MA_XMNEWS_ERROR', 'Error');
define('_MA_XMNEWS_ERROR_NACTIVE', 'Error: Disable content!');
define('_MA_XMNEWS_ERROR_NOACESSCATEGORY', 'You don\'t have access to any categories');
define('_MA_XMNEWS_ERROR_NONEWS', 'There are no news in the database');
define('_MA_XMNEWS_ERROR_NOCATEGORY', 'There are no categories in the database');
define('_MA_XMNEWS_ERROR_WEIGHT', 'Weight must be a number');

// Info message
define('_MA_XMNEWS_INFO_NEWSDISABLE', 'The news is disabled, you see it because you are allowed to change its status');
define('_MA_XMNEWS_INFO_NEWSWAITING', 'The news is pending validation, you see it because you are allowed to change its status');

// Shared
define('_MA_XMNEWS_ACTION', 'Action');
define('_MA_XMNEWS_ADD', 'Add');
define('_MA_XMNEWS_CLONE', 'Clone');
define('_MA_XMNEWS_DEL', 'Delete');
define('_MA_XMNEWS_EDIT', 'Edit');
define('_MA_XMNEWS_STATUS', 'Status');
define('_MA_XMNEWS_STATUS_A', 'Active');
define('_MA_XMNEWS_STATUS_NA', 'Disabled');
define('_MA_XMNEWS_VIEW', 'View');

// Category
define('_MA_XMNEWS_CATEGORY_DESC', 'Description');
define('_MA_XMNEWS_CATEGORY_FORMPATH', 'Files are in: %s');
define('_MA_XMNEWS_CATEGORY_LOGO', 'Logo');
define('_MA_XMNEWS_CATEGORY_LOGOFILE', 'Logo file');
define('_MA_XMNEWS_CATEGORY_LOGOFILE_DSC', 'Default logo for new news in this category');
define('_MA_XMNEWS_CATEGORY_NAME', 'Name');
define('_MA_XMNEWS_CATEGORY_SUREDEL', 'Sure to delete this category? %s');
define('_MA_XMNEWS_CATEGORY_THEREARENEWS', 'There are <strong>%s</strong> news in this category!');
define('_MA_XMNEWS_CATEGORY_UPLOAD', 'Upload');
define('_MA_XMNEWS_CATEGORY_UPLOADSIZE', 'Maximum size: %s kB');
define('_MA_XMNEWS_CATEGORY_WARNINGDELNEWS', '<strong>Warning, the following items will also be removed!</strong>');
define('_MA_XMNEWS_CATEGORY_WEIGHT', 'Weight');

define('_MA_XMNEWS_CATEGORY_DOUSER', 'View user');
define('_MA_XMNEWS_CATEGORY_DODATE', 'View date');
define('_MA_XMNEWS_CATEGORY_DOMDATE', 'View modified date');
define('_MA_XMNEWS_CATEGORY_DOHITS', 'View hits');
define('_MA_XMNEWS_CATEGORY_DORATING', 'View rating');
define('_MA_XMNEWS_CATEGORY_DOCOMMENT', 'View comment');
define('_MA_XMNEWS_CATEGORY_DODSC', 'Default value for new news in this category');


// News
define('_MA_XMNEWS_WFV', 'Waiting for validation');
define('_MA_XMNEWS_NEWS_CATEGORY', 'Category');
define('_MA_XMNEWS_NEWS_TITLE', 'Title');
define('_MA_XMNEWS_NEWS_DESC', 'Description');
define('_MA_XMNEWS_NEWS_NEWS', 'News');
define('_MA_XMNEWS_NEWS_FORMPATH', 'Files are in: %s');
define('_MA_XMNEWS_NEWS_UPLOAD', 'Upload');
define('_MA_XMNEWS_NEWS_UPLOADSIZE', 'Maximum size: %s kB');
define('_MA_XMNEWS_NEWS_LOGOFILE', 'Logo file');
define('_MA_XMNEWS_NEWS_KEYWORD', 'Meta keywords');
define('_MA_XMNEWS_NEWS_KEYWORD_DSC', 'The keywords meta tag is a series of keywords that represents the content of your news. Type in keywords with each separated by a comma or a space in between. (Ex. XOOPS, PHP, mySQL, portal system)');
define('_MA_XMNEWS_NEWS_USERID', 'Author');
define('_MA_XMNEWS_NEWS_DATEUPDATE', 'Update the publication date');
define('_MA_XMNEWS_NEWS_DATE', 'Publication date');
define('_MA_XMNEWS_NEWS_MDATEUPDATE', 'Update the modification date');
define('_MA_XMNEWS_NEWS_RESETMDATE', 'Reset (empty date)');

// permission
define('_MA_XMNEWS_PERMISSION_VIEW', 'View Permissions');
define('_MA_XMNEWS_PERMISSION_VIEW_DSC', 'Select groups that can view a news in categories');
define('_MA_XMNEWS_PERMISSION_VIEW_THIS', 'Select groups that can view in this category');
define('_MA_XMNEWS_PERMISSION_SUBMIT', 'Submit permission');
define('_MA_XMNEWS_PERMISSION_SUBMIT_DSC', 'Select groups that can submit a news in categories');
define('_MA_XMNEWS_PERMISSION_SUBMIT_THIS', 'Select groups that can submit in this category');
define('_MA_XMNEWS_PERMISSION_OTHER', 'Other permissions');
define('_MA_XMNEWS_PERMISSION_OTHER_DSC', 'Select groups that can:');
define('_MA_XMNEWS_PERMISSION_OTHER_4', 'Submit a news');
define('_MA_XMNEWS_PERMISSION_OTHER_8', 'Auto approve submitted news');
define('_MA_XMNEWS_PERMISSION_OTHER_16', 'Delete a news');


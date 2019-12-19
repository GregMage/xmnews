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
define('_MA_XMNEWS_CATEGORY_ADD', 'Add category');
define('_MA_XMNEWS_CATEGORY_LIST', 'Category list');
define('_MA_XMNEWS_NEWS_ADD', 'Add news');
define('_MA_XMNEWS_NEWS_LIST', 'News list');
define('_MA_XMNEWS_REDIRECT_SAVE', 'Successfully saved');
 
// Admin
define('_MA_XMNEWS_INDEXCONFIG_XMDOC_WARNINGNOTINSTALLED', 'You have not installed the xmdoc module, this module is required if you want to add documents to the news');
define('_MA_XMNEWS_INDEXCONFIG_XMDOC_WARNINGNOTACTIVATE', 'You must enable in xmnews preferences the use of xmdoc (if you want to add documents)');
 
// Error message
define('_MA_XMNEWS_ERROR', 'Error');
define('_MA_XMNEWS_ERROR_NACTIVE', 'Error: Disable content!');
define('_MA_XMNEWS_ERROR_NOACESSCATEGORY', 'You don\'t have access to any categories');
define('_MA_XMNEWS_ERROR_NOCATEGORY', 'There are no categories in the database');
define('_MA_XMNEWS_ERROR_NONEWS', 'There are no news in the database');
define('_MA_XMNEWS_ERROR_NPUBLISHED', 'This news is not published yet');
define('_MA_XMNEWS_ERROR_SIZE', "The size in préférence (Max uploaded files size) exceeds the maximum values defined in 'post_max_size' or 'upload_max_filesize' in your configuration in php.ini");
define('_MA_XMNEWS_ERROR_WEIGHT', 'Weight must be a number');

// Info message
define('_MA_XMNEWS_INFO_NEWSDISABLE', 'The news is disabled, you see it because you are allowed to change its status');
define('_MA_XMNEWS_INFO_NEWSWAITING', 'The news is pending validation, you see it because you are allowed to change its status');
define('_MA_XMNEWS_INFO_NEWSNOTPUBLISHED', 'The news is not yet published (the publication date is higher than the current date), you see it because you are authorized to modify its publication date');

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

//Index
define('_MA_XMNEWS_INDEX_IMAGEINFO', 'Server status');
define('_MA_XMNEWS_INDEX_SPHPINI', "<span style='font-weight: bold;'>Information taken from PHP ini file:</span>");
define('_MA_XMNEWS_INDEX_ON', "<span style='font-weight: bold;'>ON</span>");
define('_MA_XMNEWS_INDEX_OFF', "<span style='font-weight: bold;'>OFF</span>");
define('_MA_XMNEWS_INDEX_SERVERUPLOADSTATUS', 'Server uploads status: ');
define('_MA_XMNEWS_INDEX_MAXPOSTSIZE', 'Max post size permitted (post_max_size directive in php.ini): ');
define('_MA_XMNEWS_INDEX_MAXUPLOADSIZE', 'Max upload size permitted (upload_max_filesize directive in php.ini): ');
define('_MA_XMNEWS_INDEX_MEMORYLIMIT', 'Memory limit (memory_limit directive in php.ini): ');
define('_MA_XMNEWS_INDEXCONFIG_XMSOCIAL_WARNINGNOTINSTALLED', 'You have not installed the xmsocial module, this module is required if you want to rate news');
define('_MA_XMNEWS_INDEXCONFIG_XMSOCIAL_WARNINGNOTACTIVATE', 'You must enable in xmnews preferences the use of xmsocial (if you want to rate news)');

// Category
define('_MA_XMNEWS_CATEGORY_DESC', 'Description');
define('_MA_XMNEWS_CATEGORY_DOCOMMENT', 'View comments');
define('_MA_XMNEWS_CATEGORY_DODSC', 'Default value for new news in this category');
define('_MA_XMNEWS_CATEGORY_DODATE', 'View date');
define('_MA_XMNEWS_CATEGORY_DOHITS', 'View hits');
define('_MA_XMNEWS_CATEGORY_DOMDATE', 'View modified date');
define('_MA_XMNEWS_CATEGORY_DORATING', 'View rating');
define('_MA_XMNEWS_CATEGORY_DOUSER', 'View user');
define('_MA_XMNEWS_CATEGORY_EMPTY', 'Empty');
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

// News
define('_MA_XMNEWS_CLONE_NAME', 'CLONE');
define('_MA_XMNEWS_NEWS_CATEGORY', 'Category');
define('_MA_XMNEWS_NEWS_AUTHOR', 'Author');
define('_MA_XMNEWS_NEWS_DATE', 'Publication date');
define('_MA_XMNEWS_NEWS_DATEUPDATE', 'Update the publication date');
define('_MA_XMNEWS_NEWS_DESC', 'Abstract');
define('_MA_XMNEWS_GENINFORMATION', 'General informations');
define('_MA_XMNEWS_NEWS_KEYWORD', 'Meta keywords');
define('_MA_XMNEWS_NEWS_KEYWORD_DSC', 'The keywords meta tag is a series of keywords that represents the content of your news. Type in keywords with each separated by a comma in between. (Ex. XOOPS, PHP, mySQL, portal system)');
define('_MA_XMNEWS_NEWS_LOGO', 'Logo');
define('_MA_XMNEWS_NEWS_MDATE', 'Modification date');
define('_MA_XMNEWS_NEWS_MDATEUPDATE', 'Update the modification date');
define('_MA_XMNEWS_NEWS_MORE', 'Read the complete news');
define('_MA_XMNEWS_NEWS_NEWS', 'News');
define('_MA_XMNEWS_NEWS_ON', 'on');
define('_MA_XMNEWS_NEWS_PUBLISHEDBY', 'Published by');
define('_MA_XMNEWS_NEWS_RATING', 'Rating');
define('_MA_XMNEWS_NEWS_READING', 'Reading');
define('_MA_XMNEWS_NEWS_RESETMDATE', 'Reset (empty date)');
define('_MA_XMNEWS_NEWS_SELECTCATEGORY', 'Select a category to filter news');
define('_MA_XMNEWS_NEWS_SUREDEL', 'Sure to delete this news? %s');
define('_MA_XMNEWS_NEWS_TITLE', 'Title');
define('_MA_XMNEWS_NEWS_USERID', 'Author');
define('_MA_XMNEWS_NEWS_XMDOC', 'Documents');
define('_MA_XMNEWS_NEWS_VOTES', '(%s Votes)');
define('_MA_XMNEWS_NEWS_WAITING', 'There are <strong>%s</strong> news waiting for validation!');
define('_MA_XMNEWS_NEWS_WFV', 'Waiting for validation');

// blocks
define('_MA_XMNEWS_BLOCKS_DATE', 'Date');

// permission
define('_MA_XMNEWS_PERMISSION_VIEW_ABSTRACT', 'View abstract permissions');
define('_MA_XMNEWS_PERMISSION_VIEW_ABSTRACT_DSC', 'Select groups that can view abstract in categories');
define('_MA_XMNEWS_PERMISSION_VIEW_ABSTRACT_THIS', 'Select groups that can view abstract in this category');
define('_MA_XMNEWS_PERMISSION_VIEW_NEWS', 'View complet news permissions');
define('_MA_XMNEWS_PERMISSION_VIEW_NEWS_DSC', 'Select groups that can view complete news in categories');
define('_MA_XMNEWS_PERMISSION_VIEW_NEWS_THIS', 'Select groups that can view complete news in this category');
define('_MA_XMNEWS_PERMISSION_SUBMIT', 'Submit permission');
define('_MA_XMNEWS_PERMISSION_SUBMIT_DSC', 'Select groups that can submit a news in categories');
define('_MA_XMNEWS_PERMISSION_SUBMIT_THIS', 'Select groups that can submit in this category');
define('_MA_XMNEWS_PERMISSION_EDITAPPROVE', 'Edit and approve permission');
define('_MA_XMNEWS_PERMISSION_EDITAPPROVE_DSC', 'Select groups that can edit and approve a news in categories');
define('_MA_XMNEWS_PERMISSION_EDITAPPROVE_THIS', 'Select groups that can edit and approve in this category');
define('_MA_XMNEWS_PERMISSION_DELETE', 'Delete permission');
define('_MA_XMNEWS_PERMISSION_DELETE_DSC', 'Select groups that can delete a news in categories');
define('_MA_XMNEWS_PERMISSION_DELETE_THIS', 'Select groups that can delete in this category');

// user
define('_MA_XMNEWS_HOME', 'News home page');
define('_MA_XMNEWS_SELECTCATEGORY', 'Select a category to add an item to');


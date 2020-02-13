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
use Xmf\Module\Helper;
function block_xmnews_show($options) {
	include __DIR__ . '/../include/common.php';
	include_once __DIR__ . '/../class/utility.php';
	
	$helper = Helper::getHelper('xmnews');
	$helper->loadLanguage('main');
	
	// Get Permission to view abstract
	$viewPermissionCat = XmnewsUtility::getPermissionCat('xmnews_viewabstract');
	
	$permNewsHelper = new Helper\Permission('xmnews');
	
	$block = array();
	$block['full'] = $options[2];
	$criteria = new CriteriaCompo();
	switch ($options[3]) {
        case "date":
			$criteria->add(new Criteria('news_status', 1));
			$criteria->setSort('news_date DESC, news_title');
			$criteria->setOrder('ASC');
        break;

        case "hits":
			$criteria->add(new Criteria('news_status', 1));
			$criteria->setSort('news_counter DESC, news_title');
			$criteria->setOrder('ASC');
        break;

        case "rating":
			$criteria->add(new Criteria('news_status', 1));
			$criteria->setSort('news_rating DESC, news_title');
			$criteria->setOrder('ASC');
        break;

        case "random":
			$criteria->add(new Criteria('news_status', 1));
            $criteria->setSort('RAND()');
        break;
		
		case "waiting":
			$criteria->add(new Criteria('news_status', 2));
            $criteria->setSort('news_date DESC, news_title');
        break;
    }
	$category_ids = explode(',', $options[0]);
	if (!in_array(0, $category_ids)) {
        $criteria->add(new Criteria('category_id', '(' . $options[0] . ')', 'IN'));
    }
	$criteria->setLimit($options[1]);
	if (!empty($viewPermissionCat)) {
		$criteria->add(new Criteria('news_cid', '(' . implode(',', $viewPermissionCat) . ')', 'IN'));
	}
	$newsHandler->table_link = $newsHandler->db->prefix("xmnews_category");
	$newsHandler->field_link = "category_id";
	$newsHandler->field_object = "news_cid";
	$news_arr = $newsHandler->getByLink($criteria);
	if (count($news_arr) > 0 && !empty($viewPermissionCat)) {
		foreach (array_keys($news_arr) as $i) {
			$news_id                 = $news_arr[$i]->getVar('news_id');
			$news['id']              = $news_id;
			$news['cid']             = $news_arr[$i]->getVar('news_cid');
			$news['title']           = $news_arr[$i]->getVar('news_title');
			$news['description']     = $news_arr[$i]->getVar('news_description');
			$news['news']            = $news_arr[$i]->getVar('news_news');
			$news['date']            = formatTimestamp($news_arr[$i]->getVar('news_date'), 'm');
			if ($news_arr[$i]->getVar('news_mdate') != 0) {
				$news['mdate'] = formatTimestamp($news_arr[$i]->getVar('news_mdate'), 's');
			}
			$news['author']          = XoopsUser::getUnameFromId($news_arr[$i]->getVar('news_userid'));
			$news_img                = $news_arr[$i]->getVar('news_logo');
			$news['logo']        	 = $url_logo . $news_img;
			if ($news_img == ''){
				$news['logo']        = '';
			}
			if ($news_img == 'CAT'){
				$news['logo']        = $url_logo . $news_arr[$i]->getVar('category_logo');
			}
			
			$news['hits']            = $news_arr[$i]->getVar('news_counter');
			$news['rating']          = number_format($news_arr[$i]->getVar('news_rating'), 1);
			$news['votes']           = sprintf(_MA_XMNEWS_NEWS_VOTES, $news_arr[$i]->getVar('news_votes'));
			$news['douser']     	 = $news_arr[$i]->getVar('news_douser');
			$news['dodate']     	 = $news_arr[$i]->getVar('news_dodate');
			$news['domdate']    	 = $news_arr[$i]->getVar('news_domdate');
			$news['dohits']     	 = $news_arr[$i]->getVar('news_dohits');
			$news['dorating'] 		 = $news_arr[$i]->getVar('news_dorating');
			$news['perm_clone']      = $permNewsHelper->checkPermission('xmnews_editapprove', $news['cid']);
			$news['perm_edit']       = $permNewsHelper->checkPermission('xmnews_editapprove', $news['cid']);
			$news['perm_del']        = $permNewsHelper->checkPermission('xmnews_delete', $news['cid']);
			$news['type']            = $options[3];
			$block['news'][] = $news;
			unset($news);
		}
	}
	$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/modules/xmnews/assets/css/styles.css');
	return $block;
}

function block_xmnews_edit($options) {
	include __DIR__ . '/../include/common.php';

	// Criteria
	$criteria = new CriteriaCompo();
	$criteria->setSort('category_weight ASC, category_name');
	$criteria->setOrder('ASC');
	$criteria->add(new Criteria('category_status', 1));
	$category_arr = $categoryHandler->getall($criteria);
	
	include_once XOOPS_ROOT_PATH . '/modules/xmnews/class/blockform.php';
    xoops_load('XoopsFormLoader');

    $form = new XmnewsBlockForm();
	$category = new XoopsFormSelect(_MB_XMNEWS_CATEGORY, 'options[0]', $options[0], 5, true);
	$category->addOption(0, _MB_XMNEWS_ALLCATEGORY);
	foreach (array_keys($category_arr) as $i) {
		$category->addOption($category_arr[$i]->getVar('category_id'), $category_arr[$i]->getVar('category_name'));
	}
	
	$form->addElement($category);
	$form->addElement(new XoopsFormText(_MB_XMNEWS_NBNEWS, 'options[1]', 5, 5, $options[1]), true);
	if ($options[3] != 'waiting'){
		$form->addElement(new XoopsFormRadioYN(_MB_XMNEWS_FULL, 'options[2]', $options[2]), true);
	} else {
		$form->addElement(new XoopsFormHidden('options[2]', 0));
	}
	$form->addElement(new XoopsFormHidden('options[3]', $options[3]));

	return $form->render();
}
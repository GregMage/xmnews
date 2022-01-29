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
	
	$permNewsHelper = new Helper\Permission('xmnews');
	
	$block = array();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('news_date', time(),'<='));
	$nocat = false;
	switch ($options[4]) {
        case "date":
			$criteria->add(new Criteria('news_status', 1));
			$criteria->setSort('news_date DESC, news_title');
			$criteria->setOrder('ASC');
			$limit = $options[1];
			$block['full'] = $options[2];
			$block['desclenght'] = $options[3];
			break;

        case "hits":
			$criteria->add(new Criteria('news_status', 1));
			$criteria->setSort('news_counter DESC, news_title');
			$criteria->setOrder('ASC');
			$limit = $options[1];
			$block['full'] = $options[2];
			$block['desclenght'] = $options[3];
			break;

        case "rating":
			$criteria->add(new Criteria('news_status', 1));
			$criteria->setSort('news_rating DESC, news_title');
			$criteria->setOrder('ASC');
			$limit = $options[1];
			$block['desclenght'] = $options[3];
			break;

        case "random":
			$criteria->add(new Criteria('news_status', 1));
            $criteria->setSort('RAND()');
			$limit = $options[1];
			$block['full'] = $options[2];
			$block['desclenght'] = $options[3];
			break;

		case "waiting":
			$criteria->add(new Criteria('news_status', 2));
            $criteria->setSort('news_date DESC, news_title');
			$limit = $options[1];
			$block['desclenght'] = $options[3];
			break;

		case "onenews":
			$criteria->add(new Criteria('news_status', 1));
            $criteria->add(new Criteria('news_id', $options[0]));
			$block['full'] = 1;
			$nocat = true;
			break;

		case "title":
			$criteria->add(new Criteria('news_status', 1));
			switch ($options[1]) {
				case 0:
					$criteria->setSort('news_date DESC, news_title');
					$criteria->setOrder('ASC');
					break;
					
				case 1:
					$criteria->setSort('news_counter DESC, news_title');
					$criteria->setOrder('ASC');
					break;
					
				case 2:
					$criteria->setSort('news_rating DESC, news_title');
					$criteria->setOrder('ASC');
					break;
					
				case 3:
					$criteria->setSort('RAND()');
					break;	
			}
			$limit = $options[2];
			$block['logo'] = $options[5];
			$block['type'] = $options[1];
			$block['size'] = $options[3];
			break;
			
		case "carousel":
			$criteria->add(new Criteria('news_status', 1));
			switch ($options[1]) {
				case 0:
					$criteria->setSort('news_date DESC, news_title');
					$criteria->setOrder('ASC');
					break;
					
				case 1:
					$criteria->setSort('news_counter DESC, news_title');
					$criteria->setOrder('ASC');
					break;
					
				case 2:
					$criteria->setSort('news_rating DESC, news_title');
					$criteria->setOrder('ASC');
					break;
					
				case 3:
					$criteria->setSort('RAND()');
					break;	
			}
			$block['type'] = $options[1];
			$limit = $options[2];
			$block['desclenght'] = $options[3];
			$block['randid'] = rand();
			if(!in_array('0', explode(',', $options[5]))){
				$nocat = true;
				$criteria->add(new Criteria('news_id', '(' . $options[5] . ')', 'IN'));
			}
			break;
    }
	if ($nocat == false){
		$category_ids = explode(',', $options[0]);
		if (!in_array(0, $category_ids)) {
			$criteria->add(new Criteria('category_id', '(' . $options[0] . ')', 'IN'));
		}
		$criteria->setLimit($limit);
		// Get Permission to view abstract
		$viewPermissionCat = XmnewsUtility::getPermissionCat('xmnews_viewabstract');
		if (!empty($viewPermissionCat)) {
			$criteria->add(new Criteria('news_cid', '(' . implode(',', $viewPermissionCat) . ')', 'IN'));
		}
	} else {
		// Get Permission to view
		$viewPermissionCat = XmnewsUtility::getPermissionCat('xmnews_viewnews');
		if (!empty($viewPermissionCat)) {
			$criteria->add(new Criteria('news_cid', '(' . implode(',', $viewPermissionCat) . ')', 'IN'));
		}
	}
	$newsHandler->table_link = $newsHandler->db->prefix("xmnews_category");
	$newsHandler->field_link = "category_id";
	$newsHandler->field_object = "news_cid";
	$news_arr = $newsHandler->getByLink($criteria);
	//xmsocial
	if (xoops_isActiveModule('xmsocial') && $helper->getConfig('general_xmsocial', 0) == 1) {
		$block['xmsocial'] = true;
		xoops_load('utility', 'xmsocial');
	} else {
		$block['xmsocial'] = false;
	}
	if($options[4] == 'carousel'){
		for ($i = 0; $i < count($news_arr); $i++) {
			$block['carousel_indicators'][] = $i;
		}
	}
	if (count($news_arr) > 0 && !empty($viewPermissionCat)) {
		$active = true;
		foreach (array_keys($news_arr) as $i) {
			$news_id                 = $news_arr[$i]->getVar('news_id');
			$news['id']              = $news_id;
			$news['active']          = $active;
			$active 				 = false;
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
			$color = $news_arr[$i]->getVar('category_color');
			if ($color == '#ffffff'){
				$news['color'] = false;				
			} else {
				$news['color'] = $color;
			}			
			$news['hits']            = $news_arr[$i]->getVar('news_counter');
			if ($block['xmsocial'] == true){
				$news['rating'] = XmsocialUtility::renderVotes($news_arr[$i]->getVar('news_rating'), $news_arr[$i]->getVar('news_votes'));
			}
			$news['douser']     	 = $news_arr[$i]->getVar('news_douser');
			$news['dodate']     	 = $news_arr[$i]->getVar('news_dodate');
			$news['domdate']    	 = $news_arr[$i]->getVar('news_domdate');
			$news['dohits']     	 = $news_arr[$i]->getVar('news_dohits');
			$news['dorating'] 		 = $news_arr[$i]->getVar('news_dorating');
			$news['perm_clone']      = $permNewsHelper->checkPermission('xmnews_editapprove', $news['cid']);
			$news['perm_edit']       = $permNewsHelper->checkPermission('xmnews_editapprove', $news['cid']);
			$news['perm_del']        = $permNewsHelper->checkPermission('xmnews_delete', $news['cid']);
			
			$news['type']            = $options[4];
			$block['news'][] = $news;
			unset($news);
		}
	}
	$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/modules/xmnews/assets/css/styles.css');
	return $block;
}

function block_xmnews_edit($options) {
	include __DIR__ . '/../include/common.php';
	include_once XOOPS_ROOT_PATH . '/modules/xmnews/class/blockform.php';
	xoops_load('XoopsFormLoader');
	$form = new XmnewsBlockForm();
	switch ($options[4]) {
		case 'onenews':
				// Criteria
			$criteria = new CriteriaCompo();
			$criteria->setSort('news_title');
			$criteria->setOrder('ASC');
			$criteria->add(new Criteria('news_status', 1));
			$news_arr = $newsHandler->getall($criteria);
			$news = new XoopsFormSelect(_MB_XMNEWS_NEWS, 'options[0]', $options[0], 5, false);
			foreach (array_keys($news_arr) as $i) {
				$news->addOption($news_arr[$i]->getVar('news_id'), $news_arr[$i]->getVar('news_title'));
			}
			$form->addElement($news);
			$form->addElement(new XoopsFormHidden('options[1]', $options[1]));
			$form->addElement(new XoopsFormHidden('options[2]', $options[2]));
			$form->addElement(new XoopsFormHidden('options[3]', $options[3]));
			$form->addElement(new XoopsFormHidden('options[4]', $options[4]));
			$form->addElement(new XoopsFormHidden('options[5]', 0));
			break;
			
		case 'title':
			// Criteria
			$criteria = new CriteriaCompo();
			$criteria->setSort('category_weight ASC, category_name');
			$criteria->setOrder('ASC');
			$criteria->add(new Criteria('category_status', 1));
			$category_arr = $categoryHandler->getall($criteria);
			$category = new XoopsFormSelect(_MB_XMNEWS_CATEGORY, 'options[0]', explode(',', $options[0]), 5, true);
			$category->addOption(0, _MB_XMNEWS_ALLCATEGORY);
			foreach (array_keys($category_arr) as $i) {
				$category->addOption($category_arr[$i]->getVar('category_id'), $category_arr[$i]->getVar('category_name'));
			}			
			$form->addElement($category);
			$type = new XoopsFormSelect(_MB_XMNEWS_TYPE, 'options[1]', $options[1]);
			$type->addOption(0, _MB_XMNEWS_TYPE_DATE);
			$type->addOption(1, _MB_XMNEWS_TYPE_HITS);
			$type->addOption(2, _MB_XMNEWS_TYPE_RATING);
			$type->addOption(3, _MB_XMNEWS_TYPE_RANDOM);
			$form->addElement($type);
			$form->addElement(new XoopsFormText(_MB_XMNEWS_NBNEWS, 'options[2]', 5, 5, $options[2]), true);
			$form->addElement(new XoopsFormText(_MB_XMNEWS_SIZE, 'options[3]', 5, 5, $options[3]), true);
			$form->addElement(new XoopsFormHidden('options[4]', 'title'));
			$form->addElement(new XoopsFormRadioYN(_MB_XMNEWS_LOGO, 'options[5]', $options[5]), true);
			break;
			
		case 'carousel':
			// Criteria
			$criteria = new CriteriaCompo();
			$criteria->setSort('category_weight ASC, category_name');
			$criteria->setOrder('ASC');
			$criteria->add(new Criteria('category_status', 1));
			$category_arr = $categoryHandler->getall($criteria);
			$category = new XoopsFormSelect(_MB_XMNEWS_CATEGORY, 'options[0]', explode(',', $options[0]), 5, true);
			$category->addOption(0, _MB_XMNEWS_ALLCATEGORY);
			foreach (array_keys($category_arr) as $i) {
				$category->addOption($category_arr[$i]->getVar('category_id'), $category_arr[$i]->getVar('category_name'));
			}			
			$form->addElement($category);
			$type = new XoopsFormSelect(_MB_XMNEWS_TYPE, 'options[1]', $options[1]);
			$type->addOption(0, _MB_XMNEWS_TYPE_DATE);
			$type->addOption(1, _MB_XMNEWS_TYPE_HITS);
			$type->addOption(2, _MB_XMNEWS_TYPE_RATING);
			$type->addOption(3, _MB_XMNEWS_TYPE_RANDOM);
			$form->addElement($type);
			$form->addElement(new XoopsFormText(_MB_XMNEWS_NBNEWS, 'options[2]', 5, 5, $options[2]), true);
			$form->addElement(new XoopsFormText(_MB_XMNEWS_ABSTRACT . '<br><span style="font-weight: normal;">' . _MB_XMNEWS_ABSTRACT_DESC . '</span>', 'options[3]', 5, 5, $options[3]), true);
			$form->addElement(new XoopsFormHidden('options[4]', 'carousel'));
			// Criteria
			$criteria = new CriteriaCompo();
			$criteria->setSort('news_title');
			$criteria->setOrder('ASC');
			$criteria->add(new Criteria('news_status', 1));
			$news_arr = $newsHandler->getall($criteria);
			$news = new XoopsFormSelect(_MB_XMNEWS_NEWS . '<br><span style="font-weight: normal;">' . _MB_XMNEWS_NEWS_CAROUSEL_DESC . '</span>', 'options[5]', explode(',', $options[5]), 5, true);
			$news->addOption(0, _MB_XMNEWS_NEWS_CAROUSEL);
			foreach (array_keys($news_arr) as $i) {
				$news->addOption($news_arr[$i]->getVar('news_id'), $news_arr[$i]->getVar('news_title'));
			}
			$form->addElement($news);
			break;
		
		default:
			// Criteria
			$criteria = new CriteriaCompo();
			$criteria->setSort('category_weight ASC, category_name');
			$criteria->setOrder('ASC');
			$criteria->add(new Criteria('category_status', 1));
			$category_arr = $categoryHandler->getall($criteria);
			$category = new XoopsFormSelect(_MB_XMNEWS_CATEGORY, 'options[0]', explode(',', $options[0]), 5, true);
			$category->addOption(0, _MB_XMNEWS_ALLCATEGORY);
			foreach (array_keys($category_arr) as $i) {
				$category->addOption($category_arr[$i]->getVar('category_id'), $category_arr[$i]->getVar('category_name'));
			}
			$form->addElement($category);
			$form->addElement(new XoopsFormText(_MB_XMNEWS_NBNEWS, 'options[1]', 5, 5, $options[1]), true);
			if ($options[4] != 'waiting'){
				$form->addElement(new XoopsFormRadioYN(_MB_XMNEWS_FULL, 'options[2]', $options[2]), true);
			} else {
				$form->addElement(new XoopsFormHidden('options[2]', 0));
			}
			$form->addElement(new XoopsFormText(_MB_XMNEWS_ABSTRACT . '<br><span style="font-weight: normal;">' . _MB_XMNEWS_ABSTRACT_DESC . '</span>', 'options[3]', 5, 5, $options[3]), true);
			$form->addElement(new XoopsFormHidden('options[4]', $options[4]));
			$form->addElement(new XoopsFormHidden('options[5]', 0));			
	}
	return $form->render();
}
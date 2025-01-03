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

defined('XOOPS_ROOT_PATH') || exit('Restricted access.');

/**
 * Class xmnews_news
 */
class xmnews_news extends XoopsObject
{

    // constructor
    /**
     * xmnews_news constructor.
     */
    public function __construct()
    {
        $this->initVar('news_id', XOBJ_DTYPE_INT, null);
        $this->initVar('news_cid', XOBJ_DTYPE_INT, null);
        $this->initVar('news_title', XOBJ_DTYPE_TXTBOX, null);
        $this->initVar('news_description', XOBJ_DTYPE_TXTAREA);
        $this->initVar('news_news', XOBJ_DTYPE_TXTAREA);
		// use html
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('news_mkeyword', XOBJ_DTYPE_TXTAREA);
        $this->initVar('news_logo', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('news_userid', XOBJ_DTYPE_INT, 0);
		$this->initVar('news_date', XOBJ_DTYPE_INT, 0);
		$this->initVar('news_mdate', XOBJ_DTYPE_INT, 0);
		$this->initVar('news_rating', XOBJ_DTYPE_OTHER, null, false, 10);
        $this->initVar('news_votes', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('news_counter', XOBJ_DTYPE_INT, null, false, 8);
		$this->initVar('news_douser', XOBJ_DTYPE_INT, 1, false, 1);
		$this->initVar('news_dodate', XOBJ_DTYPE_INT, 1, false, 1);
		$this->initVar('news_domdate', XOBJ_DTYPE_INT, 1, false, 1);
		$this->initVar('news_dohits', XOBJ_DTYPE_INT, 1, false, 1);
		$this->initVar('news_dorating', XOBJ_DTYPE_INT, 1, false, 1);
		$this->initVar('news_docomment', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('news_status', XOBJ_DTYPE_INT, 1);
		$this->initVar('category_name', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('category_logo', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('category_color', XOBJ_DTYPE_TXTBOX, '#ffffff', false);
    }

    /**
     * @param bool $action
     * @return XoopsThemeForm
     */
    public function getFormCategory($action = false)
    {
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        include __DIR__ . '/../include/common.php';

        // Get Permission to submit
        $submitPermissionCat = XmnewsUtility::getPermissionCat('xmnews_submit');

        $form = new XoopsThemeForm(_MA_XMNEWS_ADD, 'form', $action, 'post', true);
        // category
        $category = new XoopsFormSelect(_MA_XMNEWS_NEWS_CATEGORY, 'news_category', $this->getVar('news_category'));
        $criteria = new CriteriaCompo();
		$criteria->add(new Criteria('category_status', 1));
        $criteria->setSort('category_weight ASC, category_name');
        $criteria->setOrder('ASC');
        if (!empty($submitPermissionCat)){
            $criteria->add(new Criteria('category_id', '(' . implode(',', $submitPermissionCat) . ')','IN'));
        }
        $category_arr = $categoryHandler->getall($criteria);
        if (count($category_arr) == 0 || empty($submitPermissionCat)){
            redirect_header('index.php', 3, _MA_XMNEWS_ERROR_NOACESSCATEGORY);
        }
        foreach (array_keys($category_arr) as $i) {
            $category->addOption($category_arr[$i]->getVar('category_id'), $category_arr[$i]->getVar('category_name'));
        }
        $form->addElement($category, true);

        $form->addElement(new XoopsFormHidden('op', 'loadnews'));
        // submit
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
        return $form;
    }

    /**
    * @param bool $action
    * @return XoopsThemeForm
    */
    public function getForm($category_id = 0, $action = false, $clone = false)
    {
        global $xoopsUser;
        $helper      = Helper::getHelper('xmnews');
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        include __DIR__ . '/../include/common.php';

        //form title
        $title = $this->isNew() ? sprintf(_MA_XMNEWS_ADD) : sprintf(_MA_XMNEWS_EDIT);

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        if (!$this->isNew() || $clone == true) {
            $form->addElement(new XoopsFormHidden('news_id', $this->getVar('news_id')));
            $category_id = $this->getVar('news_cid');
			// category
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('category_status', 1));
			$criteria->setSort('category_weight ASC, category_name');
			$criteria->setOrder('ASC');
			$category_arr = $categoryHandler->getall($criteria);
			$category_form = new XoopsFormSelect(_MA_XMNEWS_NEWS_CATEGORY, 'news_cid', $category_id);
			if (count($category_arr) > 0) {
				foreach (array_keys($category_arr) as $i) {
					$category_form->addOption($i, $category_arr[$i]->getVar('category_name'));
				}
			}
			$form->addElement($category_form);
			$category = $categoryHandler->get($this->getVar('news_cid'));

        } else {
			$category = $categoryHandler->get($category_id);
			// category
			$category_img = $category->getVar('category_logo');
			if ($category_img == ''){
				$category_logo = '';
			} else {
				$category_logo = '<img src="' . $url_logo .  $category_img . '" alt="' . $category_img . '" style="max-width:100px" /> ';
			}
			$form->addElement(new xoopsFormLabel (_MA_XMNEWS_NEWS_CATEGORY, $category_logo . '<strong>' . $category->getVar('category_name') . '</strong>'));
			$form->addElement(new XoopsFormHidden('news_cid', $category_id));
		}

        // title
        $form->addElement(new XoopsFormText(_MA_XMNEWS_NEWS_TITLE, 'news_title', 50, 255, $this->getVar('news_title')), true);

        // description
        $editor_configs           =array();
        $editor_configs['name']   = 'news_description';
        $editor_configs['value']  = $this->getVar('news_description', 'e');
        $editor_configs['rows']   = 5;
        $editor_configs['cols']   = 160;
        $editor_configs['width']  = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('general_editor', 'Plain Text');
        $form->addElement(new XoopsFormEditor(_MA_XMNEWS_NEWS_DESC, 'news_description', $editor_configs), false);

		// news
        $editor_configs           =array();
        $editor_configs['name']   = 'news_news';
        $editor_configs['value']  = $this->getVar('news_news', 'e');
        $editor_configs['rows']   = 20;
        $editor_configs['cols']   = 160;
        $editor_configs['width']  = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('general_editor', 'Plain Text');
        $form->addElement(new XoopsFormEditor(_MA_XMNEWS_NEWS_NEWS, 'news_news', $editor_configs), true);

        // logo
		$blank_img = $this->getVar('news_logo');
		$img_cat = $category->getVar('category_logo');
		if ($blank_img == ''){
			$blank_img = 'no-image.png';
		} elseif($blank_img == 'CAT'){
			$blank_img = $category->getVar('category_logo');
		}

		$uploadirectory      = str_replace(XOOPS_URL, '', $url_logo);
        $imgtray_img         = new XoopsFormElementTray(_MA_XMNEWS_NEWS_LOGO . '<br><br>' . sprintf(_MA_XMNEWS_CATEGORY_UPLOADSIZE, $upload_size / 1000), '<br>');
        $imgpath_img         = sprintf(_MA_XMNEWS_CATEGORY_FORMPATH, $uploadirectory);
        $imageselect_img     = new XoopsFormSelect($imgpath_img, 'news_logo', $blank_img);
        $image_array_img = XoopsLists::getImgListAsArray($path_logo . 'news/');
        $imageselect_img->addOption("no-image.png", _MA_XMNEWS_CATEGORY_EMPTY);

        $imageselect_img->addOption("$img_cat", _MA_XMNEWS_NEWS_USELOGOCATEGORY);
        foreach ($image_array_img as $image_img) {
			$image_tmp = 'news/' . $image_img;
            $imageselect_img->addOption("$image_tmp", $image_tmp);
        }
        $imageselect_img->setExtra("onchange='showImgSelected(\"image_img2\", \"news_logo\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'");
        $imgtray_img->addElement($imageselect_img, false);
        $imgtray_img->addElement(new XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadirectory . '/' . $blank_img . "' name='image_img2' id='image_img2' alt='' style='max-width:100px'>"));
        $fileseltray_img = new XoopsFormElementTray('<br>', '<br><br>');
        $fileseltray_img->addElement(new XoopsFormFile(_MA_XMNEWS_CATEGORY_UPLOAD, 'news_logo', $upload_size), false);
        $fileseltray_img->addElement(new XoopsFormLabel(''), false);
        $imgtray_img->addElement($fileseltray_img);
        $form->addElement($imgtray_img);

        // keyword
        $keyword = new XoopsFormTextArea(_MA_XMNEWS_NEWS_KEYWORD, 'news_mkeyword', $this->getVar('news_mkeyword', 'e'), 2, 60);
		$keyword->setDescription(_MA_XMNEWS_NEWS_KEYWORD_DSC);
		$form->addElement($keyword, false);

		//tag
        if (xoops_isActiveModule('tag') && $helper->getConfig('general_tag', 0) == 1) {
			XoopsLoad::load('formtag', 'tag');  // get the TagFormTag class
			$form->addElement(new \XoopsModules\Tag\FormTag('item_tag', 60, 255, $this->getVar('news_id'), $catid = 0));
        }

		//xmdoc
        if (xoops_isActiveModule('xmdoc') && $helper->getConfig('general_xmdoc', 0) == 1) {
            xoops_load('utility', 'xmdoc');
            XmdocUtility::renderDocForm($form, 'xmnews', $this->getVar('news_id'));
        }

		// xmsocial
		if (xoops_isActiveModule('xmsocial') && $helper->getConfig('general_xmsocial_social', 0) == 1) {
			xoops_load('utility', 'xmsocial');
			XmsocialUtility::renderSocialForm($form, 'xmnews', $this->getVar('news_id'));
		}

		if (!$this->isNew() || $clone == true) {
			// douser
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOUSER, 'news_douser', $this->getVar('news_douser')));
			// dodate
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DODATE, 'news_dodate', $this->getVar('news_dodate')));
			// domdate
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOMDATE, 'news_domdate', $this->getVar('news_domdate')));
			// dohits
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOHITS, 'news_dohits', $this->getVar('news_dohits')));
			// dorating
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DORATING, 'news_dorating', $this->getVar('news_dorating')));
			// docomment
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOCOMMENT, 'news_docomment', $this->getVar('news_docomment')));
		} else {
			// douser
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOUSER, 'news_douser', $category->getVar('category_douser')));
			// dodate
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DODATE, 'news_dodate', $category->getVar('category_dodate')));
			// domdate
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOMDATE, 'news_domdate', $category->getVar('category_domdate')));
			// dohits
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOHITS, 'news_dohits', $category->getVar('category_dohits')));
			// dorating
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DORATING, 'news_dorating', $category->getVar('category_dorating')));
			// docomment
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOCOMMENT, 'news_docomment', $category->getVar('category_docomment')));
		}

		if ($helper->isUserAdmin() == true){
			if ($this->isNew()) {
				$userid = !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0;
			} else {
				$userid = $this->getVar('news_userid');
			}
			// userid
			$form->addElement(new XoopsFormSelectUser(_MA_XMNEWS_NEWS_USERID, 'news_userid', true, $userid, 1, false), true);

			// date and mdate
			$time = time()-600;
			if (!$this->isNew()) {
				$selection_date = new XoopsFormElementTray(_MA_XMNEWS_NEWS_DATEUPDATE);
				$date = new XoopsFormRadio('', 'date_update', 'N');
                $options        = ['N' => _NO . ' (' . formatTimestamp($this->getVar('news_date'), 'm') . ')', 'Y' => _YES];
				$date->addOptionArray($options);
				$selection_date->addElement($date);
				$selection_date->addElement(new XoopsFormDateTime('', 'news_date', '', $time));
				$form->addElement($selection_date);
				if ($this->getVar('news_mdate') != 0){
					$selection_mdate = new XoopsFormElementTray(_MA_XMNEWS_NEWS_MDATEUPDATE);
					$mdate = new XoopsFormRadio('', 'mdate_update', 'N');
                    $options         = ['N' => _NO . ' (' . formatTimestamp($this->getVar('news_mdate'), 's') . ')', 'R' => _MA_XMNEWS_NEWS_RESETMDATE, 'Y' => _YES];
					$mdate->addOptionArray($options);
					$selection_mdate->addElement($mdate);
					$selection_mdate->addElement(new XoopsFormTextDateSelect('', 'news_mdate', '', time()));
					$form->addElement($selection_mdate);
				}
			} else {
				$form->addElement(new XoopsFormDateTime(_MA_XMNEWS_NEWS_DATE, 'news_tempdate', '', $time), false);
			}
			// reset hits
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_NEWS_RESETHITS, 'news_resethits', 0, _YES, _NO  . ' (' . $this->getVar('news_counter') . ')'));
		}
        // permission edit and approve submitted news
        $permHelper = new Helper\Permission();
		$permission = $permHelper->checkPermission('xmnews_editapprove', $category_id);
        if ($permission == true || $helper->isUserAdmin() == true){
            // status
            $form_status = new XoopsFormRadio(_MA_XMNEWS_STATUS, 'news_status', $this->getVar('news_status'));
            $options     = [1 => _MA_XMNEWS_STATUS_A, 0 => _MA_XMNEWS_STATUS_NA, 2 => _MA_XMNEWS_NEWS_WFV];
            $form_status->addOptionArray($options);
            $form->addElement($form_status);
        } else {
			// Notification news:approve_news
			$form->addElement(new XoopsFormRadioYN(_MA_XMNEWS_NEWS_NOTIFY, 'news_notify', true));
		}
		//captcha
		if ($helper->getConfig('general_captcha', 0) == 1) {
			$form->addElement(new XoopsFormCaptcha(), true);
		}

        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submit
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }

    /**
     * @return mixed
     */
    public function saveNews($newsHandler, $action = false)
    {
        global $xoopsUser;
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include __DIR__ . '/../include/common.php';
        $helper = Helper::getHelper('xmnews');
        $error_message = '';

        //logo
		$uploadirectory = $path_logo . '/news';
        if ($_FILES['news_logo']['error'] != UPLOAD_ERR_NO_FILE) {
            include_once XOOPS_ROOT_PATH . '/class/uploader.php';
            $uploader_news_img = new XoopsMediaUploader($uploadirectory, ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png'], $upload_size, null, null);
            if ($uploader_news_img->fetchMedia('news_logo')) {
                $uploader_news_img->setPrefix('news_');
                if (!$uploader_news_img->upload()) {
                    $error_message .= $uploader_news_img->getErrors() . '<br>';
                } else {
                    $this->setVar('news_logo', 'news/' . $uploader_news_img->getSavedFileName());
                }
            } else {
                $error_message .= $uploader_news_img->getErrors();
            }
        } else {
			$news_logo = Request::getString('news_logo', '');
			if ($news_logo == 'no-image.png'){
				$news_logo = '';
			}
			if (substr($news_logo, 0, 8) == 'category'){
				$news_logo = 'CAT';
			}
            $this->setVar('news_logo', $news_logo);
        }
        $this->setVar('news_title', Request::getString('news_title', ''));
        $this->setVar('news_description', Request::getText('news_description', ''));
        $this->setVar('news_news', Request::getText('news_news', ''));
        $this->setVar('news_mkeyword',Request::getString('news_mkeyword', ''));
        $this->setVar('news_douser', Request::getInt('news_douser', 1));
        $this->setVar('news_dodate', Request::getInt('news_dodate', 1));
        $this->setVar('news_domdate', Request::getInt('news_domdate', 1));
        $this->setVar('news_dohits', Request::getInt('news_dohits', 1));
        $this->setVar('news_dorating', Request::getInt('news_dorating', 1));
        $this->setVar('news_docomment', Request::getInt('news_docomment', 1));
        $news_cid = Request::getInt('news_cid', 0);
        $this->setVar('news_cid', $news_cid);
		if (isset($_POST['news_userid'])) {
            $this->setVar('news_userid', Request::getInt('news_userid', 0));
        } else {
            $this->setVar('news_userid', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0);
        }
		if (isset($_POST['news_tempdate'])) {
			$news_date = Request::getArray('news_tempdate', []);
			$this->setVar('news_date', strtotime($news_date['date']) + $news_date['time']);
        }
		if (isset($_POST['news_date'])) {
			if ($_POST['date_update'] == 'Y'){
				$news_date = Request::getArray('news_date', []);
				$this->setVar('news_date', strtotime($news_date['date']) + $news_date['time']);
			}
			$this->setVar('news_mdate', time());
        }
		if (isset($_POST['news_mdate'])) {
			if ($_POST['mdate_update'] == 'Y'){
				$this->setVar('news_mdate', strtotime(Request::getString('news_mdate', '')));
			}
			if ($_POST['mdate_update'] == 'R'){
				$this->setVar('news_mdate', 0);
			}
        }
		if (Request::getInt('news_resethits', 0) == 1){
			$this->setVar('news_counter', 0);
		}
		// permission edit and approve submitted news
        $permHelper = new Helper\Permission();
		$permission = $permHelper->checkPermission('xmnews_editapprove', $news_cid);
        if ($permission == false){
            $this->setVar('news_status', 2);
        } else {
            $this->setVar('news_status', Request::getInt('news_status', 1));
        }
		// Captcha
        if ($helper->getConfig('general_captcha', 0) == 1) {
            xoops_load('xoopscaptcha');
            $xoopsCaptcha = XoopsCaptcha::getInstance();
            if (! $xoopsCaptcha->verify() ) {
                $error_message .= $xoopsCaptcha->getMessage();
            }
        }
        if ($error_message == '') {
            if ($newsHandler->insert($this)) {
				if ($this->get_new_enreg() == 0){
					$news_id = $this->getVar('news_id');
				} else {
					$news_id = $this->get_new_enreg();
				}
				//tag
                if (xoops_isActiveModule('tag') && $helper->getConfig('general_tag', 0) == 1) {
					/** @var \XoopsModules\Tag\TagHandler $tagHandler */
					$tagHandler = \XoopsModules\Tag\Helper::getInstance()->getHandler('Tag');
					$tagHandler->updateByItem($_POST['item_tag'], $news_id, $GLOBALS['xoopsModule']->getVar('dirname'), $catid = 0);
                }

				//xmdoc
                if (xoops_isActiveModule('xmdoc') && $helper->getConfig('general_xmdoc', 0) == 1) {
                    xoops_load('utility', 'xmdoc');
                    $error_message .= XmdocUtility::saveDocuments('xmnews', $news_id);
                }
				// xmsocial
				if (xoops_isActiveModule('xmsocial') && $helper->getConfig('general_xmsocial_social', 0) == 1) {
					xoops_load('utility', 'xmsocial');
					$error_message .= XmsocialUtility::saveSocial('xmnews', $news_id);
				}
				//Notification global: new_news, category: new_news, news: approve_news
				$category = $categoryHandler->get($news_cid);
				$tags = [];
				$tags['NEWS_TITLE'] = Request::getString('news_title', '');
				$tags['NEWS_URL'] = XOOPS_URL . '/modules/xmnews/article.php?news_id=' . $news_id;
				$tags['CATEGORY_NAME'] = $category->getVar('category_name');
				$tags['CATEGORY_URL'] =  XOOPS_URL . '/modules/xmnews/index.php?news_cid=' . $news_cid;
				$notificationHandler = xoops_getHandler('notification');
				$notificationHandler->triggerEvent('global', 0, 'new_article', $tags);
				$notificationHandler->triggerEvent('category', $news_cid, 'new_news', $tags);
				$notificationHandler->triggerEvent('news', $news_id, 'approve_news', $tags);
				//Notification global: submit_news
				if ($this->getVar('news_status') == 2){
					$tags['WAITINGARTICLE_URL'] = XOOPS_URL . '/modules/xmnews/admin/news.php?news_status=2';
					$notificationHandler->triggerEvent('global', 0, 'submit_news', $tags);
				}
				//Notification news: modified_news
				if ($this->get_new_enreg() == 0){
					$notificationHandler->triggerEvent('news', $news_id, 'modified_news', $tags);
				}
				// Notification news: approve_news
				if (Request::getInt('news_notify', 0) == 1){
					$notificationHandler->subscribe('news', $news_id, 'approve_news', XOOPS_NOTIFICATION_MODE_SENDONCETHENDELETE);
				}

				if ($error_message == ''){
                    if ($action == 'article.php'){
                        redirect_header('article.php?news_id=' . $news_id, 2, _MA_XMNEWS_REDIRECT_SAVE);
                    } else {
                        redirect_header($action, 2, _MA_XMNEWS_REDIRECT_SAVE);
                    }
				}
            } else {
                $error_message =  $this->getHtmlErrors();
            }
        }

        return $error_message;
    }

	/**
     * @return mixed
     */
    public function delNews($newsHandler, $news_id, $action = false)
    {
		if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
		$error_message = '';
		include __DIR__ . '/../include/common.php';
		if ($newsHandler->delete($this)) {
			//tag
			if (xoops_isActiveModule('tag') && $helper->getConfig('general_tag', 0) == 1) {
				$tagHandler = \XoopsModules\Tag\Helper::getInstance()->getHandler('Tag');
				$tagHandler->updateByItem('', $news_id, $GLOBALS['xoopsModule']->getVar('dirname'), $catid = 0);
			}
			//xmdoc
			if (xoops_isActiveModule('xmdoc') && $helper->getConfig('general_xmdoc', 0) == 1) {
				xoops_load('utility', 'xmdoc');
				$error_message .= XmdocUtility::delDocdata('xmnews', $news_id);
			}
			//xmsocial
			if (xoops_isActiveModule('xmsocial') && $helper->getConfig('general_xmsocial', 0) == 1) {
				xoops_load('utility', 'xmsocial');
				$error_message .= XmsocialUtility::delRatingdata('xmnews', $news_id);
				if ($helper->getConfig('general_xmsocial_social', 0) == 1) {
					$error_message .= XmsocialUtility::delSocialdata('xmnews', $news_id);
				}
			}
			//Del logo
			if ($this->getVar('news_logo') != 'category/blank.gif') {
				if (strpos($this->getVar('news_logo'), 'category') === False){
					// Test if the image is used
					$criteria = new CriteriaCompo();
					$criteria->add(new Criteria('news_logo', $this->getVar('news_logo')));
					$news_count = $newsHandler->getCount($criteria);
					if ($news_count == 0){
						$urlfile = $path_logo . $this->getVar('news_logo');
						if (is_file($urlfile)) {
							chmod($urlfile, 0777);
							unlink($urlfile);
						}
					}
				}
			}
			//Del Notification and comment
			$helper = Helper::getHelper('xmnews');
			$moduleid = $helper->getModule()->getVar('mid');
			xoops_notification_deletebyitem($moduleid, 'news', $news_id);
			xoops_comment_delete($moduleid, $news_id);
			if ($error_message == ''){
				redirect_header($action, 2, _MA_XMNEWS_REDIRECT_SAVE);
			}
		} else {
			$error_message .= $obj->getHtmlErrors();
		}
		return $error_message;
	}

    /**
     * @return mixed
     */
    public function get_new_enreg()
    {
        global $xoopsDB;
        $new_enreg = $xoopsDB->getInsertId();

        return $new_enreg;
    }
}

/**
 * Class xmnewsxmnews_newsHandler
 */
class xmnewsxmnews_newsHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmnewsxmnews_newsHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xmnews_news', 'xmnews_news', 'news_id', 'news_name');
    }
}

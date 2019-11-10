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

defined('XOOPS_ROOT_PATH') || exit('Restricted access.');

/**
 * Class xmnews_category
 */
class xmnews_category extends XoopsObject
{
    // constructor
    /**
     * xmnews_category constructor.
     */
    public function __construct()
    {
        $this->initVar('category_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('category_name', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('category_description', XOBJ_DTYPE_TXTAREA, null, false);
        // use html
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('category_logo', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('category_douser', XOBJ_DTYPE_INT, 1, false, 1);
		$this->initVar('category_dodate', XOBJ_DTYPE_INT, 1, false, 1);
		$this->initVar('category_domdate', XOBJ_DTYPE_INT, 1, false, 1);
		$this->initVar('category_dohits', XOBJ_DTYPE_INT, 1, false, 1);
		$this->initVar('category_dorating', XOBJ_DTYPE_INT, 1, false, 1);
		$this->initVar('category_docomment', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('category_weight', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('category_status', XOBJ_DTYPE_INT, 1, false, 1);
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

    /**
     * @return mixed
     */
    public function saveCategory($categoryHandler, $action = false)
    {
		if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
		include __DIR__ . '/../include/common.php';
        $error_message = '';
        // test error
        if ((int)$_REQUEST['category_weight'] == 0 && $_REQUEST['category_weight'] != '0') {
            $error_message .= _MA_XMNEWS_ERROR_WEIGHT . '<br>';
            $this->setVar('category_weight', 0);
        }
        //logo
        $uploadirectory = $path_logo . '/category';		
        if ($_FILES['category_logo']['error'] != UPLOAD_ERR_NO_FILE) {
            include_once XOOPS_ROOT_PATH . '/class/uploader.php';
            $uploader_category_img = new XoopsMediaUploader($uploadirectory, ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png'], $upload_size, null, null);
            if ($uploader_category_img->fetchMedia('category_logo')) {
                $uploader_category_img->setPrefix('category_');
                if (!$uploader_category_img->upload()) {
                    $error_message .= $uploader_category_img->getErrors() . '<br>';
                } else {
                    $this->setVar('category_logo', 'category/' . $uploader_category_img->getSavedFileName());
                }
            } else {
                $error_message .= $uploader_category_img->getErrors();
            }
        } else {
            $this->setVar('category_logo', Xmf\Request::getString('category_logo', ''));
        }
        $this->setVar('category_name', Xmf\Request::getString('category_name', ''));
        $this->setVar('category_description', Xmf\Request::getText('category_description', ''));
        $this->setVar('category_douser', Xmf\Request::getInt('category_douser', 1));
        $this->setVar('category_dodate', Xmf\Request::getInt('category_dodate', 1));
        $this->setVar('category_domdate', Xmf\Request::getInt('category_domdate', 1));
        $this->setVar('category_dohits', Xmf\Request::getInt('category_dohits', 1));
        $this->setVar('category_dorating', Xmf\Request::getInt('category_dorating', 1));
        $this->setVar('category_docomment', Xmf\Request::getInt('category_docomment', 1));
        $this->setVar('category_status', Xmf\Request::getInt('category_status', 1));

         if ($error_message == '') {
            $this->setVar('category_weight', Xmf\Request::getInt('category_weight', 0));
            if ($categoryHandler->insert($this)) {
                // permissions
                if ($this->get_new_enreg() == 0) {
                    $perm_id = $this->getVar('category_id');
                } else {
                    $perm_id = $this->get_new_enreg();
                }
                $permHelper = new \Xmf\Module\Helper\Permission();
                // permission view
                $groups_view = \Xmf\Request::getArray('xmnews_view_perms', [], 'POST');
                $permHelper->savePermissionForItem('xmnews_view', $perm_id, $groups_view);
                // permission submit
                $groups_submit = \Xmf\Request::getArray('xmnews_submit_perms', [], 'POST');
                $permHelper->savePermissionForItem('xmnews_submit', $perm_id, $groups_submit);
				// permission edit and approve
                $groups_submit = \Xmf\Request::getArray('xmnews_editapprove_perms', [], 'POST');
                $permHelper->savePermissionForItem('xmnews_editapprove', $perm_id, $groups_submit);
				// permission delete
                $groups_submit = \Xmf\Request::getArray('xmnews_delete_perms', [], 'POST');
                $permHelper->savePermissionForItem('xmnews_delete', $perm_id, $groups_submit);
				redirect_header($action, 2, _MA_XMNEWS_REDIRECT_SAVE);
            } else {
                $error_message = $this->getHtmlErrors();
            }
        }

        return $error_message;
    }

    /**
     * @param bool $action
     * @return XoopsThemeForm
     */
    public function getForm($action = false)
    {
        $helper      = \Xmf\Module\Helper::getHelper('xmnews');
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        include __DIR__ . '/../include/common.php';

        //form title
        $title = $this->isNew() ? sprintf(_MA_XMNEWS_ADD) : sprintf(_MA_XMNEWS_EDIT);

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        if (!$this->isNew()) {
            $form->addElement(new XoopsFormHidden('category_id', $this->getVar('category_id')));
            $status = $this->getVar('category_status');
            $weight = $this->getVar('category_weight');
        } else {
            $status = 1;
            $weight = 0;
        }

        // title
        $form->addElement(new XoopsFormText(_MA_XMNEWS_CATEGORY_NAME, 'category_name', 50, 255, $this->getVar('category_name')), true);

        // description
        $editor_configs           = [];
        $editor_configs['name']   = 'category_description';
        $editor_configs['value']  = $this->getVar('category_description', 'e');
        $editor_configs['rows']   = 5;
        $editor_configs['cols']   = 160;
        $editor_configs['width']  = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('general_editor', 'Plain Text');
        $form->addElement(new XoopsFormEditor(_MA_XMNEWS_CATEGORY_DESC, 'category_description', $editor_configs), false);
        // logo
        $blank_img           = $this->getVar('category_logo');
		$uploadirectory      = str_replace(XOOPS_URL, '', $url_logo);
        $imgtray_img         = new XoopsFormElementTray(_MA_XMNEWS_CATEGORY_LOGOFILE . '<br><br>' . sprintf(_MA_XMNEWS_CATEGORY_UPLOADSIZE, $upload_size / 1000), '<br>');
        $imgpath_img         = sprintf(_MA_XMNEWS_CATEGORY_FORMPATH, $uploadirectory);
        $imageselect_img     = new XoopsFormSelect($imgpath_img, 'category_logo', $blank_img);
        $image_array_img = XoopsLists::getImgListAsArray($path_logo . 'category/');
		$imageselect_img->addOption("", _MA_XMNEWS_CATEGORY_EMPTY);
		if ($blank_img != ''){
			$imageselect_img->addOption("$blank_img", $blank_img);
		}
        foreach ($image_array_img as $image_img) {			
			$image_tmp = 'category/' . $image_img;
            $imageselect_img->addOption("$image_tmp", $image_tmp);
        }
        $imageselect_img->setExtra("onchange='showImgSelected(\"image_img2\", \"category_logo\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'");
        $imgtray_img->addElement($imageselect_img, false);
        $imgtray_img->addElement(new XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadirectory . '/' . $blank_img . "' name='image_img2' id='image_img2' alt='' style='max-width:100px'>"));
        $fileseltray_img = new XoopsFormElementTray('<br>', '<br><br>');
        $fileseltray_img->addElement(new XoopsFormFile(_MA_XMNEWS_CATEGORY_UPLOAD, 'category_logo', $upload_size), false);
        $fileseltray_img->addElement(new XoopsFormLabel(''), false);
        $imgtray_img->addElement($fileseltray_img);
		$imgtray_img->setDescription(_MA_XMNEWS_CATEGORY_LOGOFILE_DSC);
        $form->addElement($imgtray_img);
		
		// douser
		$douser = new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOUSER, 'category_douser', $this->getVar('category_douser'));
		$douser->setDescription(_MA_XMNEWS_CATEGORY_DODSC);
		$form->addElement($douser, false);
		
		// dodate
		$dodate = new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DODATE, 'category_dodate', $this->getVar('category_dodate'));
		$dodate->setDescription(_MA_XMNEWS_CATEGORY_DODSC);
		$form->addElement($dodate, false);
		
		// domdate
		$domdate = new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOMDATE, 'category_domdate', $this->getVar('category_domdate'));
		$domdate->setDescription(_MA_XMNEWS_CATEGORY_DODSC);
		$form->addElement($domdate, false);
		
		// dohits
		$dohits = new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOHITS, 'category_dohits', $this->getVar('category_dohits'));
		$dohits->setDescription(_MA_XMNEWS_CATEGORY_DODSC);
		$form->addElement($dohits, false);
		
		// dorating 
		/*$dorating = new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DORATING, 'category_dorating', $this->getVar('category_dorating'));
		$dorating->setDescription(_MA_XMNEWS_CATEGORY_DODSC);
		$form->addElement($dorating, false);*/
		$form->addElement(new XoopsFormHidden('category_dorating', 0));
		
		// docomment
		$docomment = new XoopsFormRadioYN(_MA_XMNEWS_CATEGORY_DOCOMMENT, 'category_docomment', $this->getVar('category_docomment'));
		$docomment->setDescription(_MA_XMNEWS_CATEGORY_DODSC);
		$form->addElement($docomment, false);		
		
        // weight
        $form->addElement(new XoopsFormText(_MA_XMNEWS_CATEGORY_WEIGHT, 'category_weight', 5, 5, $weight), true);

        // status
        $form_status = new XoopsFormRadio(_MA_XMNEWS_STATUS, 'category_status', $status);
        $options     = [1 => _MA_XMNEWS_STATUS_A, 0 => _MA_XMNEWS_STATUS_NA,];
        $form_status->addOptionArray($options);
        $form->addElement($form_status);

        // permission
        $permHelper = new \Xmf\Module\Helper\Permission();
        $form->addElement($permHelper->getGroupSelectFormForItem('xmnews_view', $this->getVar('category_id'), _MA_XMNEWS_PERMISSION_VIEW_THIS, 'xmnews_view_perms', true));
        $form->addElement($permHelper->getGroupSelectFormForItem('xmnews_submit', $this->getVar('category_id'), _MA_XMNEWS_PERMISSION_SUBMIT_THIS, 'xmnews_submit_perms', true));
        $form->addElement($permHelper->getGroupSelectFormForItem('xmnews_editapprove', $this->getVar('category_id'), _MA_XMNEWS_PERMISSION_EDITAPPROVE_THIS, 'xmnews_editapprove_perms', true));
        $form->addElement($permHelper->getGroupSelectFormForItem('xmnews_delete', $this->getVar('category_id'), _MA_XMNEWS_PERMISSION_DELETE_THIS, 'xmnews_delete_perms', true));

        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submit
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }
}

/**
 * Class xmnewsxmarticle_categoryHandler
 */
class xmnewsxmnews_categoryHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmnewsxmnews_categoryHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xmnews_category', 'xmnews_category', 'category_id', 'category_name');
    }
}

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
/**
 * Class XmnewsUtility
 */
class XmnewsUtility
{
	/**
     * Fonction qui liste les catégories qui respectent la permission demandée
     * @param string   $permtype	Type de permission
     * @return array   $cat		    Liste des catégorie qui correspondent à la permission
     */
	public static function getPermissionCat($permtype = 'xmnews_viewnews')
    {
        global $xoopsUser;
        $cat = array();
        $helper = Helper::getHelper('xmnews');
        $moduleHandler = $helper->getModule();
        $groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
        $gpermHandler = xoops_getHandler('groupperm');
        $cat = $gpermHandler->getItemIds($permtype, $groups, $moduleHandler->getVar('mid'));

        return $cat;
    }

	/**
     * Fonction qui clone une news
     * @param int      $news_id	    ID de la news
     * @return array   $action		Url de redirection
	 * @return obj   			    Vide ou message d'erreur.
     */	
	public static function cloneNews($news_id, $action = false)
    {
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include __DIR__ . '/../include/common.php';
        $news = $newsHandler->get($news_id);
        if (empty($news)) {
            redirect_header($action, 2, _MA_XMNEWS_ERROR_NONEWS);
        }
        $newobj  = $newsHandler->create();
        $rand_id = rand(1, 10000);
        $newobj->setVar('news_title', _MA_XMNEWS_CLONE_NAME . $rand_id . '- ' . $news->getVar('news_title'));
        $newobj->setVar('news_description', $news->getVar('news_description', 'n'));
        $newobj->setVar('news_news', $news->getVar('news_news', 'n'));
        $newobj->setVar('news_cid', $news->getVar('news_cid'));
        $newobj->setVar('news_logo', $news->getVar('news_logo'));
		$newobj->setVar('news_mkeyword', $news->getVar('news_mkeyword'));
        $newobj->setVar('news_douser', $news->getVar('news_douser'));
        $newobj->setVar('news_dodate', $news->getVar('news_dodate'));
        $newobj->setVar('news_domdate', $news->getVar('news_domdate'));
        $newobj->setVar('news_dohits', $news->getVar('news_dohits'));
        $newobj->setVar('news_dorating', $news->getVar('news_dorating'));
        $newobj->setVar('news_docomment', $news->getVar('news_docomment'));
        $newobj->setVar('news_userid', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0);
        $newobj->setVar('news_date', time());
        $newobj->setVar('news_status', 1);
		//xmdoc
		if (xoops_isActiveModule('xmdoc') && $helper->getConfig('general_xmdoc', 0) == 1) {
			xoops_load('utility', 'xmdoc');
			// A faire!!!
		}

        return $newobj;
    }

    public static function newsNamePerCat($category_id)
    {
        include __DIR__ . '/../include/common.php';
        $news_title = '';
        $criteria     = new CriteriaCompo();
        $criteria->setSort('news_title');
        $criteria->setOrder('ASC');
        $criteria->add(new Criteria('news_cid', $category_id));
        $news_arr = $newsHandler->getall($criteria);
        if (!empty($news_arr)) {
            $news_title .= _MA_XMNEWS_CATEGORY_WARNINGDELNEWS . '<br>';
            foreach (array_keys($news_arr) as $i) {
                $news_title .= $news_arr[$i]->getVar('news_title') . '<br>';
            }
        }

        return $news_title;
    }
	
	public static function getServerStats()
    {
        $moduleDirName      = basename(dirname(dirname(__DIR__)));
        $moduleDirNameUpper = mb_strtoupper($moduleDirName);
        xoops_loadLanguage('common', $moduleDirName);
        $html = '';
        $html .= "<fieldset><legend style='font-weight: bold; color: #900;'>" . _MA_XMNEWS_INDEX_IMAGEINFO . "</legend>\n";
        $html .= "<div style='padding: 8px;'>\n";
        $html .= '<div>' . _MA_XMNEWS_INDEX_SPHPINI . "</div>\n";
        $html .= "<ul>\n";
        $downloads = ini_get('file_uploads') ? '<span style="color: #008000;">' . _MA_XMNEWS_INDEX_ON . '</span>' : '<span style="color: #ff0000;">' . _MA_XMNEWS_INDEX_OFF . '</span>';
        $html      .= '<li>' . _MA_XMNEWS_INDEX_SERVERUPLOADSTATUS . $downloads;
        $html .= '<li>' . _MA_XMNEWS_INDEX_MAXUPLOADSIZE . ' <b><span style="color: #0000ff;">' . ini_get('upload_max_filesize') . "</span></b>\n";
        $html .= '<li>' . _MA_XMNEWS_INDEX_MAXPOSTSIZE . ' <b><span style="color: #0000ff;">' . ini_get('post_max_size') . "</span></b>\n";
        $html .= '<li>' . _MA_XMNEWS_INDEX_MEMORYLIMIT . ' <b><span style="color: #0000ff;">' . ini_get('memory_limit') . "</span></b>\n";
        $html .= "</ul>\n";
        $html .= '</div>';
        $html .= '</fieldset><br>';

        return $html;
    }
	
	public static function returnBytes($val)
	{
		switch (mb_substr($val, -1)) {
			case 'K':
			case 'k':
				return (int)$val * 1024;
			case 'M':
			case 'm':
				return (int)$val * 1048576;
			case 'G':
			case 'g':
				return (int)$val * 1073741824;
			default:
				return $val;
		}
	}
}

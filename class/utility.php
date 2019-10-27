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
	public static function getPermissionCat($permtype = 'xmnews_view')
    {
        global $xoopsUser;
        $cat = array();
        $helper = Xmf\Module\Helper::getHelper('xmnews');
        $moduleHandler = $helper->getModule();
        $groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
        $gpermHandler = xoops_getHandler('groupperm');
        $cat = $gpermHandler->getItemIds($permtype, $groups, $moduleHandler->getVar('mid'));

        return $cat;
    }

    public static function newsNamePerCat($category_id)
    {
        include __DIR__ . '/../include/common.php';
        $news_name = '';
        /*$criteria     = new CriteriaCompo();
        $criteria->setSort('news_name');
        $criteria->setOrder('ASC');
        $criteria->add(new Criteria('news_cid', $category_id));
        $news_arr = $newsHandler->getall($criteria);
        if (count($news_arr) > 0) {
            $news_name .= _MA_XMNEWS_CATEGORY_WARNINGDELNEWS . '<br>';
            foreach (array_keys($news_arr) as $i) {
                $news_name .= $news_arr[$i]->getVar('news_name') . '<br>';
            }
        }*/

        return $news_name;
    }
}

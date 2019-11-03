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

function xmnews_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;

    $sql = "SELECT news_id, news_cid, news_title, news_description, news_news, news_date, news_userid FROM " . $xoopsDB->prefix("xmnews_news") . " WHERE news_status = 1";

	if ( $userid != 0 ) {
        $sql .= " AND news_userid=" . intval($userid) . " ";
    }
	
    if ( is_array($queryarray) && $count = count($queryarray) )
    {
        $sql .= " AND ((news_title LIKE '%$queryarray[0]%' OR news_news LIKE '%$queryarray[0]%' OR news_description LIKE '%$queryarray[0]%')";

        for($i=1;$i<$count;$i++)
        {
            $sql .= " $andor ";
            $sql .= "(news_title LIKE '%$queryarray[$i]%' OR news_news LIKE '%$queryarray[$i]%' OR news_description LIKE '%$queryarray[$i]%')";
        }
        $sql .= ")";
    }

    $sql .= " ORDER BY news_date DESC";
    $result = $xoopsDB->query($sql,$limit,$offset);
    $ret = array();
    $i = 0;
    while($myrow = $xoopsDB->fetchArray($result))
    {
        $ret[$i]["image"] = "assets/images/xmnews_search.png";
        $ret[$i]["link"] = "article.php?news_id=" . $myrow["news_id"];
        $ret[$i]["title"] = $myrow["news_title"];
        $ret[$i]["time"] = $myrow["news_date"];
        $ret[$i]["uid"] = $myrow["news_userid"];
        $i++;
    }

    return $ret;
}
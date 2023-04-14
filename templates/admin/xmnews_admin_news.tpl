<script type="text/javascript">
    IMG_ON = "<{xoAdminIcons 'success.png'}>";
    IMG_OFF = "<{xoAdminIcons 'cancel.png'}>";
</script>
<div>
    <{$renderbutton|default:''}>
</div>
<{if $error_message|default:'' != ''}>
    <div class="errorMsg" style="text-align: left;">
        <{$error_message}>
    </div>
<{/if}>
<{if $warning_message|default:'' != ''}>
    <div class="xm-warning-msg xo-actions">
        <{$warning_message}>
		<a class="tooltip" href="news.php?fnews_status=2" title="<{$smarty.const._MA_XMNEWS_VIEW}>">
			<img src="<{xoAdminIcons 'view.png'}>" alt="<{$smarty.const._MA_XMNEWS_VIEW}>">
		</a>
    </div>
<{/if}>
<{if $form|default:false}>
    <div>
        <{$form}>
    </div>
<{/if}>
<{if $filter|default:false}>
	<div align="right">
		<form id="form_news_tri" name="form_news_tri" method="get" action="news.php">
			<{$smarty.const._MA_XMNEWS_NEWS_CATEGORY}>
			<select name="news_filter" id="news_filter" onchange="location='news.php?fnews_status=<{$fnews_status}>&fnews_cid='+this.options[this.selectedIndex].value">
				<{$news_cid_options|default:''}>
			<select>
			<{$smarty.const._MA_XMNEWS_STATUS}>
			<select name="news_filter" id="news_filter" onchange="location='news.php?fnews_cid=<{$fnews_cid}>&fnews_status='+this.options[this.selectedIndex].value">
				<{$news_status_options}>
			<select>
		</form>
	</div>
<{/if}>
<{if $news_count|default:0 != 0}>
    <table id="xo-xmcontact-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtcenter width10"><{$smarty.const._MA_XMNEWS_NEWS_LOGO}></th>
            <th class="txtleft width15"><{$smarty.const._MA_XMNEWS_NEWS_CATEGORY}></th>
            <th class="txtleft width15"><{$smarty.const._MA_XMNEWS_NEWS_TITLE}></th>
            <th class="txtleft"><{$smarty.const._MA_XMNEWS_NEWS_DESC}></th>
            <th class="txtcenter width5"><{$smarty.const._MA_XMNEWS_NEWS_READING}></th>
            <th class="txtcenter width10"><{$smarty.const._MA_XMNEWS_NEWS_DATE}></th>
            <th class="txtcenter width5"><{$smarty.const._MA_XMNEWS_STATUS}></th>
            <th class="txtcenter width10"><{$smarty.const._MA_XMNEWS_ACTION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach item=itemnews from=$news}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
				<td class="txtcenter">
					<{if $itemnews.logo != ''}>
					<img src="<{$itemnews.logo}>" alt="<{$itemnews.title}>" style="max-width:150px">
					<{/if}>
				</td>
                <td class="txtleft"><a href="../index.php?news_cid=<{$itemnews.cid}>" title="<{$itemnews.category}>"><{$itemnews.category}></a></td>
                <td class="txtleft"><a href="../article.php?news_id=<{$itemnews.id}>" title="<{$itemnews.title}>"><{$itemnews.title}></a></td>
                <td class="txtleft"><{$itemnews.description}></td>
				<td class="txtcenter"><{$itemnews.counter}></td>
				<td class="txtcenter"><{$itemnews.date}></td>
                <td class="xo-actions txtcenter">
                    <img id="loading_sml<{$itemnews.id}>" src="../assets/images/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>"
                    alt="<{$smarty.const._AM_SYSTEM_LOADING}>"><img class="cursorpointer tooltip" id="sml<{$itemnews.id}>"
                    onclick="system_setStatus( { op: 'news_update_status', news_id: <{$itemnews.id}>, news_status: <{$itemnews.status}> }, 'sml<{$itemnews.id}>', 'news.php' )"
                    src="<{if $itemnews.status == 1}><{xoAdminIcons 'success.png'}><{/if}><{if $itemnews.status == 0}><{xoAdminIcons 'cancel.png'}><{/if}><{if $itemnews.status == 2}><{xoAdminIcons 'messagebox_warning.png'}><{/if}>"
                    alt="<{if $itemnews.status == 1}><{$smarty.const._MA_XMNEWS_STATUS_NA}><{/if}><{if $itemnews.status == 0 || $itemnews.status == 2}><{$smarty.const._MA_XMNEWS_STATUS_A}><{/if}>"
                    title="<{if $itemnews.status == 1}><{$smarty.const._MA_XMNEWS_STATUS_NA}><{/if}><{if $itemnews.status == 0 || $itemnews.status == 2}><{$smarty.const._MA_XMNEWS_STATUS_A}><{/if}>">
                </td>
                <td class="xo-actions txtcenter">
					<a class="tooltip" href="../article.php?news_id=<{$itemnews.id}>" title="<{$smarty.const._MA_XMNEWS_VIEW}>">
                        <img src="<{xoAdminIcons 'view.png'}>" alt="<{$smarty.const._MA_XMNEWS_VIEW}>"></a>
					<a class="tooltip" href="news.php?op=clone&amp;news_id=<{$itemnews.id}>" title="<{$smarty.const._MA_XMNEWS_CLONE}>">
                        <img src="<{xoAdminIcons 'clone.png'}>" alt="<{$smarty.const._MA_XMNEWS_CLONE}>"></a>
                    <a class="tooltip" href="news.php?op=edit&amp;news_id=<{$itemnews.id}>&amp;fnews_status=<{$fnews_status}>&amp;&fnews_cid=<{$fnews_cid}>" title="<{$smarty.const._MA_XMNEWS_EDIT}>">
                        <img src="<{xoAdminIcons 'edit.png'}>" alt="<{$smarty.const._MA_XMNEWS_EDIT}>"></a>
                    <a class="tooltip" href="news.php?op=del&amp;news_id=<{$itemnews.id}>" title="<{$smarty.const._MA_XMNEWS_DEL}>">
                        <img src="<{xoAdminIcons 'delete.png'}>" alt="<{$smarty.const._MA_XMNEWS_DEL}>"></a>
                </td>
            </tr>
        <{/foreach}>
        </tbody>
    </table>
    <div class="clear spacer"></div>
    <{if $nav_menu|default:false}>
        <div class="floatright"><{$nav_menu|default:false}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>



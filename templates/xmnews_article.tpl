<div class="xmmews">
    <ol class="breadcrumb">
        <li><a href="index.php"><{$index_module}></a></li>
        <li><a href="index.php?news_cid=<{$category_id}>"><{$category_name}></a></li>
        <li class="active"><{$title}></li>
    </ol>
	<{if $status == 2}>
		<div class="alert alert-warning" role="alert">
			<{$smarty.const._MA_XMNEWS_INFO_NEWSWAITING}>
		</div>
	<{/if}>
	<{if $status == 0}>
		<div class="alert alert-danger" role="alert">
			<{$smarty.const._MA_XMNEWS_INFO_NEWSDISABLE}>
		</div>
	<{/if}>
	<{if $warning_date|default:false}>
		<div class="alert alert-warning" role="alert">
			<{$smarty.const._MA_XMNEWS_INFO_NEWSNOTPUBLISHED}>
		</div>
	<{/if}>
    <div class="media xmnews-border" <{if $category_color != false}>style="border-color : <{$category_color}>;"<{/if}>>
        <div class="media-left">
			<{if $logo != ''}>
			<{if $CAT == true}><a href="index.php?news_cid=<{$category_id}>"><{/if}><img class="media-object" src="<{$logo}>" alt="<{$title}>" style="max-width:150px"><{if $CAT == true}></a><{/if}>
			<{/if}>
        </div>
        <div class="media-body">
            <h2 class="media-heading"><{$title}></h2>
        </div>
    </div>
	<div>
		<{$news}>
	</div>
    <br>
	<{if $social == true}>
		<{include file="db:xmsocial_social.tpl"}>
		<br>
	<{/if}>
	<{if $xmdoc_viewdocs == true}>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><{$smarty.const._MA_XMNEWS_NEWS_XMDOC}></h3>
        </div>
        <div class="panel-body">
            <{include file="db:xmdoc_viewdoc.tpl"}>
        </div>
    </div>
    <{/if}>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><{$smarty.const._MA_XMNEWS_GENINFORMATION}></h3>
        </div>
        <div class="panel-body">
			<div class="row xmnews-general">
				<{if $dodate == 1}>
				<div class="col-xs-12 col-sm-6 col-md-6"><span class="glyphicon glyphicon-calendar" title="<{$smarty.const._MA_XMNEWS_NEWS_DATE}>"></span>
					<{$smarty.const._MA_XMNEWS_NEWS_DATE}>: <{$date}>
				</div>
				<{/if}>
				<{if $douser == 1}>
				<div class="col-xs-12 col-sm-6 col-md-6"><span class="glyphicon glyphicon-user" title="<{$smarty.const._MA_XMNEWS_NEWS_AUTHOR}>"></span>
					<{$smarty.const._MA_XMNEWS_NEWS_AUTHOR}>: <{$author}>
				</div>
				<{/if}>
			</div>
			<{if $domdate == 1}>
			<{if $mdate}>
			<div class="row xmnews-general">
				<div class="col-xs-12 col-sm-6 col-md-6"><span class="glyphicon glyphicon-calendar" title="<{$smarty.const._MA_XMNEWS_NEWS_MDATE}>"></span>
					<{$smarty.const._MA_XMNEWS_NEWS_MDATE}>: <{$mdate}>
				</div>
			</div>
			<{/if}>
			<{/if}>
			<div class="row xmnews-general">
				<{if $dohits == 1}>
				<div class="col-xs-12 col-sm-6 col-md-6"><span class="glyphicon glyphicon-repeat" title="<{$smarty.const._MA_XMNEWS_NEWS_READING}>"></span>
					<{$smarty.const._MA_XMNEWS_NEWS_READING}>: <{$counter}>
				</div>
				<{/if}>
				<{if $dorating == 1}>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<{include file="db:xmsocial_rating.tpl" down_xmsocial=$xmsocial_arr}>
				</div>
				<{/if}>
			</div>
			<div class="xmnews-general-button">
				<div class="btn-group" role="group" aria-label="...">
					<{if $perm_clone == true}>
					<a href="action.php?op=clone&amp;news_id=<{$news_id}>">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-duplicate"></span> <{$smarty.const._MA_XMNEWS_CLONE}></button>
                    </a>
					<{/if}>
					<{if $perm_edit == true}>
                    <a href="action.php?op=edit&amp;news_id=<{$news_id}>">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> <{$smarty.const._MA_XMNEWS_EDIT}></button>
                    </a>
					<{/if}>
					<{if $perm_del == true}>
                    <a href="action.php?op=del&amp;news_id=<{$news_id}>">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> <{$smarty.const._MA_XMNEWS_DEL}></button>
                    </a>
					<{/if}>
				</div>
			</div>
			
        </div>
    </div>
	<{if $docomment == 1}>
	<div style="text-align: center; padding: 3px; margin:3px;">
        <{$commentsnav}>
        <{$lang_notice}>
    </div>
    <div style="margin:3px; padding: 3px;">
        <{if $comment_mode == "flat"}>
        <{include file="db:system_comments_flat.tpl"}>
        <{elseif $comment_mode == "thread"}>
        <{include file="db:system_comments_thread.tpl"}>
        <{elseif $comment_mode == "nest"}>
        <{include file="db:system_comments_nest.tpl"}>
        <{/if}>
    </div>
	<{/if}>
	<div style="margin:3px; padding: 3px;">
		<{include file='db:system_notification_select.tpl'}>
    </div>
</div>
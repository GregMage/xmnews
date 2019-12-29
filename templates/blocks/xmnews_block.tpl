<{foreach item=news from=$block.news}>
	<{if $block.full == 0}>
	<div class="col-xs-12 col-sm-6 col-md-4 xmnews-minibox">		
		<div class="xmnews-logo">
			<{if $news.logo != ''}>		
			<img src="<{$news.logo}>" alt="<{$news.title}>">
			<{/if}>			
		</div>		
		<a class="xmnews-title" title="<{$news.title}>" href="<{$xoops_url}>/modules/xmnews/article.php?news_id=<{$news.id}>">
			<{$news.title|truncate:25:'...'}>
		</a>
		<div class="row xmnews-data">
			<{if $news.type == "date" || $news.type == "random"}>
			<div class="col-md-8"><span class="glyphicon glyphicon-calendar" title="<{$smarty.const._MA_XMNEWS_BLOCKS_DATE}>"></span>
				<{$smarty.const._MA_XMNEWS_BLOCKS_DATE}>: <{$news.date}>
			</div>
			<{/if}>
			<{if $news.type == "hits"}>
			<div class="col-md-8"><span class="glyphicon glyphicon-repeat" title="<{$smarty.const._MA_XMNEWS_NEWS_READING}>"></span>
				<{$smarty.const._MA_XMNEWS_NEWS_READING}>: <{$news.hits}>
			</div>
			<{/if}>
			<{if $news.type == "rating"}>
			<div class="col-md-8"><span class="glyphicon glyphicon-star-empty" title="<{$smarty.const._MA_XMNEWS_NEWS_RATING}>"></span>
				<{$smarty.const._MA_XMNEWS_NEWS_RATING}>: <{$news.rating}> <{$news.votes}>
			</div>
			<{/if}>
		</div>

		<div class="xmnews-short-description">
			<{$news.description|truncateHtml:20:'...'}>
		</div>

		<a class="btn btn-primary col-xs-12 col-sm-10 col-md-8" title="<{$news.title}>"
		   href="<{$xoops_url}>/modules/xmnews/article.php?news_id=<{$news.id}>">
			<{$smarty.const._MA_XMNEWS_NEWS_MORE}>
		</a>
	</div>
	<{else}>
    <div class="media">
        <div class="media-left">
			<{if $news.logo != ''}>
            <img class="media-object" src="<{$news.logo}>" alt="<{$news.title}>">
			<{/if}>
        </div>
        <div class="media-body">
            <h2 class="media-heading"><{$news.title}></h2>
        </div>
    </div>
	<div>
		<{$news.news}>
	</div>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><{$smarty.const._MA_XMNEWS_GENINFORMATION}></h3>
        </div>
        <div class="panel-body">
			<div class="row xmnews-general">
				<{if $news.dodate == 1}>
				<div class="col-xs-12 col-sm-6 col-md-6"><span class="glyphicon glyphicon-calendar" title="<{$smarty.const._MA_XMNEWS_NEWS_DATE}>"></span>
					<{$smarty.const._MA_XMNEWS_NEWS_DATE}>: <{$news.date}>
				</div>
				<{/if}>
				<{if $news.douser == 1}>
				<div class="col-xs-12 col-sm-6 col-md-6"><span class="glyphicon glyphicon-user" title="<{$smarty.const._MA_XMNEWS_NEWS_AUTHOR}>"></span>
					<{$smarty.const._MA_XMNEWS_NEWS_AUTHOR}>: <{$news.author}>
				</div>
				<{/if}>
			</div>
			<{if $news.domdate == 1}>
			<{if $news.mdate}>
			<div class="row xmnews-general">
				<div class="col-xs-12 col-sm-6 col-md-6"><span class="glyphicon glyphicon-calendar" title="<{$smarty.const._MA_XMNEWS_NEWS_MDATE}>"></span>
					<{$smarty.const._MA_XMNEWS_NEWS_MDATE}>: <{$news.mdate}>
				</div>
			</div>
			<{/if}>
			<{/if}>
			<div class="row xmnews-general">
				<{if $news.dohits == 1}>
				<div class="col-xs-12 col-sm-6 col-md-6"><span class="glyphicon glyphicon-repeat" title="<{$smarty.const._MA_XMNEWS_NEWS_READING}>"></span>
					<{$smarty.const._MA_XMNEWS_NEWS_READING}>: <{$news.hits}>
				</div>
				<{/if}>
				<{if $news.dorating == 1}>
				<div class="col-xs-12 col-sm-6 col-md-6"><span class="glyphicon glyphicon-star-empty" title="<{$smarty.const._MA_XMNEWS_NEWS_RATING}>"></span>
					<{$smarty.const._MA_XMNEWS_NEWS_RATING}>: <{$news.rating}> <{$news.votes}>
				</div>
				<{/if}>
			</div>
			<div class="xmnews-general-button">
				<div class="btn-group" role="group" aria-label="...">
					<{if $news.perm_clone == true}>
					<a href="<{$xoops_url}>/modules/xmnews/action.php?op=clone&amp;news_id=<{$news.id}>">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-duplicate"></span> <{$smarty.const._MA_XMNEWS_CLONE}></button>
                    </a>
					<{/if}>
					<{if $news.perm_edit == true}>
                    <a href="<{$xoops_url}>/modules/xmnews/action.php?op=edit&amp;news_id=<{$news.id}>">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> <{$smarty.const._MA_XMNEWS_EDIT}></button>
                    </a>
					<{/if}>
					<{if $news.perm_del == true}>
                    <a href="<{$xoops_url}>/modules/xmnews/action.php?op=del&amp;news_id=<{$news.id}>">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> <{$smarty.const._MA_XMNEWS_DEL}></button>
                    </a>
					<{/if}>
				</div>
			</div>
			
        </div>
    </div>	
	<{/if}>
<{/foreach}>
<div class="clearfix"></div>
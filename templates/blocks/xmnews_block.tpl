<{foreach item=news from=$block.news}>
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
				<{$smarty.const._MA_XMNEWS_NEWS_RATING}>: <{$news.rating}> (<{$news.votes}>)
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
<{/foreach}>
<div class="clearfix"></div>
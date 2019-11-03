<div class="xmnews">
	<{if $filter}>
	    <ol class="breadcrumb">
			<li class="active"><{$smarty.const._MA_XMNEWS_HOME}></li>
		</ol>
		<div align="center">
			<form class="form-inline" id="form_news_tri" name="form_news_tri" method="get" action="index.php">
				<div class="form-group">
					<label><{$smarty.const._MA_XMNEWS_NEWS_SELECTCATEGORY}></label>
					<select class="form-control" name="news_filter" id="news_filter" onchange="location='index.php?news_cid='+this.options[this.selectedIndex].value">
						<{$news_cid_options}>
					<select>
				</div>
			</form>
		</div>
		<br>		
		<br>
	<{else}>
		<ol class="breadcrumb">
			<li><a href="index.php"><{$smarty.const._MA_XMNEWS_HOME}></a></li>
			<li class="active"><{$category_name}></li>
		</ol>
		<div class="media">
			<div class="media-left">
				<{if $category_logo != ''}>
				<img class="media-object" src="<{$category_logo}>" alt="<{$category_name}>" style="max-width:150px">
				<{/if}>
			</div>
			<div class="media-body">
				<h2 class="media-heading"><{$category_name}></h2>
				<{$category_description}>
			</div>
		</div>
		<br>		
		<br>		
	<{/if}>
	<{if $news_count != 0}>
		<{foreach item=news from=$news}>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="media">
					<div class="media-left">
						<{if $news.logo != ''}>
						<img class="media-object" src="<{$news.logo}>" alt="<{$news.title}>" style="max-width:150px">
						<{/if}>
					</div>
					<div class="media-body">
						<h2 class="media-heading"><{$news.title}></h2>
						
						<div class="xm-news-index-info"><span class="glyphicon glyphicon-user" title="<{$smarty.const._MA_XMNEWS_NEWS_PUBLISHEDBY}>"></span>
							<{$smarty.const._MA_XMNEWS_NEWS_PUBLISHEDBY}> <{$news.author}>
						</div>
						<div class="xm-news-index-info"><span class="glyphicon glyphicon-calendar" title="<{$smarty.const._MA_XMNEWS_NEWS_DATE}>"></span>
							<{$smarty.const._MA_XMNEWS_NEWS_ON}> <{$news.date}>
						</div>
						<div class="xm-news-index-info"><span class="glyphicon glyphicon-repeat" title="<{$smarty.const._MA_XMNEWS_NEWS_READING}>"></span>
							<{$smarty.const._MA_XMNEWS_NEWS_READING}> <{$news.counter}>
						</div>
					</div>
					<{$news.description}>
				</div>		
				<div class="xm-news-index-button">
					<div class="btn-group" role="group" aria-label="...">
						<a href="article.php?news_id=<{$news.id}>">
							<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-menu-right"></span> <{$smarty.const._MA_XMNEWS_NEWS_MORE}></button>
						</a>
					</div>
				</div>				
			</div>
		</div>

		<{/foreach}>
		<div class="clear spacer"></div>
		<{if $nav_menu}>
			<div class="floatright"><{$nav_menu}></div>
			<div class="clear spacer"></div>
		<{/if}>
	<{else}>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<{$smarty.const._MA_XMNEWS_ERROR_NONEWS}>
		</div>
	<{/if}>	
</div><!-- .xmnews -->
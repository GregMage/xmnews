<div class="xmnews">
	<{if $cat|default:false}>
		<ol class="breadcrumb">
			<li><a href="index.php"><{$index_module}></a></li>
			<li class="active"><{$category_name}></li>
		</ol>
	<{else}>
		<ol class="breadcrumb">
			<li class="active"><{$index_module}></li>
		</ol>
	<{/if}>
	<{if $news_cid_options|default:false}>
		<div align="center">
			<form class="form-inline" id="form_news_tri" name="form_news_tri" method="get" action="index.php">
				<div class="form-group">
					<label><{$smarty.const._MA_XMNEWS_NEWS_SELECTCATEGORY}></label>
					<select class="form-control form-control-sm" name="news_filter" id="news_filter" onchange="location='index.php?news_cid='+this.options[this.selectedIndex].value">
						<{$news_cid_options}>
					</select>
				</div>
			</form>
		</div>
	<{/if}>
	<br>		
	<br>
	<{if $cat|default:false}>
		<div class="media xmnews-border" <{if $category_color != false}>style="border-color : <{$category_color}>;"<{/if}>>
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
		<div class="panel panel-default" <{if $news.color != false}>style="border-color : <{$news.color}>;"<{/if}>>
			<div class="panel-body">
				<div class="media">
					<div class="media-left">
						<{if $news.logo != ''}>
						<img class="media-object" src="<{$news.logo}>" alt="<{$news.title}>" style="max-width:150px">
						<{/if}>
					</div>
					<div class="media-body">
						<h2 class="media-heading"><{$news.title}><{if $news_cid == 0}> <span class="badge badge-pill badge-dark"><{$news.cat_name}></span><{/if}></h2>
						<{if $news.douser == 1}>
						<div class="xmnews-index-info"><span class="glyphicon glyphicon-user" title="<{$smarty.const._MA_XMNEWS_NEWS_PUBLISHEDBY}>"></span>
							<{$smarty.const._MA_XMNEWS_NEWS_PUBLISHEDBY}> <{$news.author}>
						</div>
						<{/if}>
						<{if $news.dodate == 1}>
						<div class="xmnews-index-info"><span class="glyphicon glyphicon-calendar" title="<{$smarty.const._MA_XMNEWS_NEWS_DATE}>"></span>
							<{$smarty.const._MA_XMNEWS_NEWS_ON}> <{$news.date}>
						</div>
						<{/if}>
						<{if $news.dohits == 1}>
						<div class="xmnews-index-info"><span class="glyphicon glyphicon-repeat" title="<{$smarty.const._MA_XMNEWS_NEWS_READING}>"></span>
							<{$smarty.const._MA_XMNEWS_NEWS_READING}> <{$news.counter}>
						</div>
						<{/if}>
						<{if $news.dorating == 1}>
						<{if $xmsocial == true}>
						<div class="xmnews-index-info"><span class="glyphicon glyphicon-star-empty" title="<{$smarty.const._MA_XMNEWS_NEWS_RATING}>"></span>
							<{$smarty.const._MA_XMNEWS_NEWS_RATING}>: <{$news.rating}>
						</div>
						<{/if}>
						<{/if}>						
					</div>
					<{$news.description}>
				</div>		
				<div class="xmnews-index-button">
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
		<{if $nav_menu|default:false}>
			<div class="floatright"><{$nav_menu}></div>
			<div class="clear spacer"></div>
		<{/if}>
	<{else}>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<{$smarty.const._MA_XMNEWS_ERROR_NONEWS}>
		</div>
	<{/if}>	
	<div style="margin:3px; padding: 3px;">
		<{include file='db:system_notification_select.tpl'}>
    </div>
</div><!-- .xmnews -->
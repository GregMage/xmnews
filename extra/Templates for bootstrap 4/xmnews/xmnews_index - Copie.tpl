<div class="xmnews">
	<{if $cat}>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
			<li class="breadcrumb-item active" aria-current="page"><{$category_name}></li>
		  </ol>
		</nav>
	<{else}>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
			<li class="breadcrumb-item active" aria-current="page"><{$index_module}></li>
		  </ol>
		</nav>
	<{/if}>
	<div align="center">
		<form class="form-inline" id="form_news_tri" name="form_news_tri" method="get" action="index.php">
			<div class="form-group">
				<label><{$smarty.const._MA_XMNEWS_NEWS_SELECTCATEGORY}>&nbsp;</label>
				<select class="form-control form-control-sm" name="news_filter" id="news_filter" onchange="location='index.php?news_cid='+this.options[this.selectedIndex].value">
					<{$news_cid_options}>
				</select>
			</div>
		</form>
	</div>
	<br>
	<br>
	<{if $cat}>
		<div class="row">
			<div class="col-3 col-md-4 col-lg-3 text-center">
				<img class="rounded img-fluid" src="<{$category_logo}>" alt="<{$category_name}>">
			</div>
			<div class="col-9 col-md-8 col-lg-9 " style="padding-bottom: 5px; padding-top: 5px;">
				<h4 class="mt-0"><{$category_name}></h4>
				<{$category_description}>
			</div>
		</div>
		<br>
	<{/if}>
	<{if $news_count != 0}>
		<{foreach item=news from=$news}>
			<div class="row mb-2">
				<div class="col-md-12">
					<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
						<div class="col-12 d-block d-lg-none pt-4 pl-4 pr-4">
							<{if $news.logo != ''}>
							En haut<img class="rounded img-fluid" src="<{$news.logo}>" alt="<{$news.title}>">
							<{/if}>
						</div>
						<div class="col p-4 d-flex flex-column position-static">

							<div class="card-header border-left border-top border-right d-flex justify-content-between">
								<h3 class="mb-0"><{$news.title}></h3>
								<{if $news.dohits == 1}>
									<div class="row align-items-center text-right">
										<div class="col ml-2 pl-2">
											<span class="badge badge-secondary fa-lg text-primary"><span class="fa fa-eye fa-lg text-primary" aria-hidden="true"></span><small> <{$news.counter}></small></span>
										</div>	
									</div>	
								<{/if}>
							</div>

							<{if ($news.douser == 1) || ($news.dodate == 1) || ($news.domdate == 1) || ($news.dorating) == 1}> 
								<div class="row border-bottom border-left border-right pl-1 mb-3 ml-0 mr-0">
									<{if $news.douser == 1}>
										<figure class="figure text-muted m-1 pr-2 border-right">
											  <span class="fa fa-user fa-fw" aria-hidden="true"></span> <{$smarty.const._MA_XMNEWS_NEWS_PUBLISHEDBY_BT}>
											  <figcaption class="figure-caption text-center"><{$news.author}></figcaption>
										</figure>
									<{/if}>

									<{if ($news.dodate == 1) && ($news.domdate == 1) && ($news.douser == 1)}>
										<span class="d-none d-md-block">
											<figure class="figure text-muted m-1 pr-2 border-right">
												  <span class="fa fa-newspaper-o fa-fw" aria-hidden="true"></span> <{$smarty.const._MA_XMNEWS_NEWS_PUBLISHED_BT}>
												  <figcaption class="figure-caption text-center"><{$news.date|replace:'-':'/'}></figcaption>
											</figure>
										</span>	
										<figure class="figure text-muted m-1 pr-2 border-right">
											<span class="d-md-block d-none">
												<span class="fa fa-calendar fa-fw" aria-hidden="true"></span> <{$smarty.const._MA_XMNEWS_NEWS_MDATE_BT}>
											</span>
											<span class="d-block d-md-none">
												<span class="fa fa-newspaper-o fa-fw" aria-hidden="true"></span> <{$smarty.const._MA_XMNEWS_NEWS_MDATE_BT}>
											</span>
											<figcaption class="figure-caption text-center"><{$news.mdate|replace:'-':'/'}></figcaption>
										</figure>
									<{else}>
										<{if $news.dodate == 1}>
											<figure class="figure text-muted m-1 pr-2 border-right">
												  <span class="fa fa-newspaper-o fa-fw" aria-hidden="true"></span> <{$smarty.const._MA_XMNEWS_NEWS_PUBLISHED_BT}>
												  <figcaption class="figure-caption text-center"><{$news.date|replace:'-':'/'}></figcaption>
											</figure>
										<{/if}>
										<{if $news.domdate == 1}>
											<{if $news.mdate}>
												<figure class="figure text-muted m-1 pr-2 border-right">
													<span class="fa fa-calendar fa-fw" aria-hidden="true"></span> <{$smarty.const._MA_XMNEWS_NEWS_MDATE}>
													<figcaption class="figure-caption text-center"><{$news.mdate|replace:'-':'/'}></figcaption>
												</figure>
											<{/if}>
										<{/if}>
									<{/if}>
									
<!--------------------------------- pourquoi ce test $news_dorating == 1 ne fonctionne pas sur la page index
----------------------------------- Si on met == 0, ça fonctionne... Etrange non ? 
 -->
									<{if $news.dorating == 1}>
										<figure class="text-muted m-1 pr-2 border-right">
											<span class="fa fa-star" aria-hidden="true"></span> <{$smarty.const._MA_XMNEWS_NEWS_RATING}>: <{$news.rating}> <{$news.votes}>
											<figcaption class="figure-caption text-center"></figcaption>	
										</span>	
									<{/if}>
								</div>
							<{/if}>

<!--
						<div class="col-12 d-block d-lg-none pt-4 pl-4 pr-4">
							<{if $news.logo != ''}>
							<img class="rounded img-fluid" src="<{$news.logo}>" alt="<{$news.title}>">
							<{/if}>
						</div>
-->


						
<hr />Au dessus de la news<hr />						
						<p class="card-text mb-auto"><{$news.description}></p>

						</div>
						

						
						<div class="col-12 d-block d-lg-none pt-4 pl-4 pr-4">
							HAUT HAUT<{if $news.logo != ''}>
							<img class="rounded img-fluid" src="<{$news.logo}>" alt="<{$news.title}>">
							<{/if}>
						</div>
						
						
						<div class="col-2 col-md-4 p-4 d-none d-lg-block">
							<{if $news.logo != ''}>
							A droite<img class="rounded img-fluid" src="<{$news.logo}>" alt="<{$news.title}>">
							<{/if}>
						</div>
						<div class="w-100"></div>
						<div class="col-12 pl-4 pb-4">
							<button type="button" class="btn btn-primary" onclick=window.location.href="article.php?news_id=<{$news.id}>"><span class="fa fa-book" aria-hidden="true"></span> <{$smarty.const._MA_XMNEWS_NEWS_MORE}></button>
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
	<div style="margin:3px; padding: 3px;">
		<{include file='db:system_notification_select.tpl'}>
    </div>
</div><!-- .xmnews -->
<div class="xmnews">
	<{if $cat|default:false}>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb" <{if $category_color != false}>style="border-color : <{$category_color}>;"<{/if}>>
			<li class="breadcrumb-item"><span class="fa fa-newspaper text-secondary fa-lg fa-fw mr-2 mt-1"></span><a href="index.php"><{$index_module}></a></li>
			<li class="breadcrumb-item active" aria-current="page"><{$category_name}></li>
		  </ol>
		</nav>
	<{else}>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
			<li class="breadcrumb-item active" aria-current="page"><span class="fa fa-newspaper text-secondary fa-lg fa-fw mr-2 mt-1"></span> <{$index_module}></li>
		  </ol>
		</nav>
	<{/if}>
		<{if $news_cid_options|default:false}>
			<form class="form-inline mb-3" id="form_news_tri" name="form_news_tri" method="get" action="index.php">
				<div class="form-group">
					<label><{$smarty.const._MA_XMNEWS_NEWS_SELECTCATEGORY}>&nbsp;</label>
					<select class="form-control form-control-sm" name="news_filter" id="news_filter" onchange="location='index.php?news_cid='+this.options[this.selectedIndex].value">
						<{$news_cid_options}>
					</select>
				</div>
			</form>
		<{/if}>
	<{if $cat|default:false}>
		<div class="row mb-2">
			<{if $category_logo != ''}>
			<div class="col-3 col-md-4 col-lg-3 text-center">
				<img class="rounded img-fluid" src="<{$category_logo}>" alt="<{$category_name}>">
			</div>
			<{/if}>
			<div class="col-9 col-md-8 col-lg-9 " style="padding-bottom: 5px; padding-top: 5px;">
				<h4 class="mt-0"><{$category_name}></h4>
				<{$category_description}>
			</div>
		</div>
	<{/if}>
	<{if $news_count != 0}>
		<{if $thumbnails == 1}>
		<div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 justify-content-center">
		<{/if}>
			<{foreach item=itemnews from=$news}>
				<div class="col mb-3">
					<div class="card h-100 xmnews-border" <{if $itemnews.color != false}>style="border-color : <{$itemnews.color}>;"<{/if}>>
						<div class="card-header" <{if $itemnews.color != false}>style="background-color : <{$itemnews.color}>;"<{/if}>>
							<div class="d-flex justify-content-center text-center">
								<h5 class="mb-0"><{$itemnews.title}><{if $news_cid == 0}><br /><a href="index.php?news_cid=<{$itemnews.cid}>"><span class="badge badge-pill badge-dark" style="font-weight: lighter;" ><{$itemnews.cat_name}></span><{/if}></a></h5>
							</div>
						</div>
						<div class="card-body">
								<{if $thumbnails == 1}>
									<{if $itemnews.logo != ''}>
										<{if $CAT|default:false == true}>
											<a href="index.php?news_cid=<{$category_id}>">
										<{/if}>
										<img class="img-fluid" src="<{$itemnews.logo}>" alt="<{$itemnews.title}>">
										<{if $CAT|default:false == true}>
											</a>
										<{/if}>
									<{/if}>
									<{$itemnews.description}>
								<{else}>
									<p class="card-text mb-auto">
										<div class="row">
											<div class="col">
												<{if $itemnews.logo != ''}>
													<{if $CAT|default:false == true}>
													<a href="index.php?news_cid=<{$category_id}>">
													<{/if}>
													<img class="rounded float-right d-none d-md-block" src="<{$itemnews.logo}>" alt="<{$itemnews.title}>">
													<{if $CAT|default:false == true}>
													</a>
													<{/if}>
												<{/if}>
												<p class="card-text mb-auto"><{$itemnews.description}></p>
											</div>
										</div>
									</p>
								<{/if}>
							<div class="text-right mt-1 ">
								<button type="button" class="btn btn-primary btn-sm text-right" onclick=window.location.href="article.php?news_id=<{$itemnews.id}>"><span class="fa fa-book" aria-hidden="true"></span> <{$smarty.const._MA_XMNEWS_NEWS_MORE}></button>
							</div>
						</div>

						<div class="card-footer text-secondary">
							<div class="row">
								<{if $itemnews.douser == 1}>
									<div class="col-5 text-left">
										<span class="fa fa-user fa-fw" aria-hidden="true"></span> <{$itemnews.author}>
									</div>
								<{/if}>
								<{if $itemnews.dodate == 1}>
									<div class="col-7 text-right">
										<span class="fa fa-calendar fa-fw" aria-hidden="true"></span> <{$itemnews.date}>
									</div>
								<{/if}>

							</div>
							<div class="row">
								<{if $itemnews.dohits == 1}>
									<div class="col-5 text-left">
										<span class="fa fa-eye fa-fw" aria-hidden="true"></span> <{$itemnews.counter}>
									</div>
								<{/if}>
								<{if $itemnews.domdate == 1}>
									<{if $itemnews.mdate|default:false}>
										<div class="col-7 text-right">
											<span class="fa fa-repeat fa-fw" aria-hidden="true"></span> <{$itemnews.mdate}>
										</div>
									<{/if}>
								<{/if}>
							</div>
							<{if $itemnews.dorating == 1}>
								<{if $xmsocial == true}>
									<div class="row">
										<div class="col">
											<span class="fa fa-star" aria-hidden="true"></span> <{$smarty.const._MA_XMNEWS_NEWS_RATING}> <{$itemnews.rating}>
										</div>
									</div>
								<{/if}>
							<{/if}>
						</div>
					</div>
				</div>

			<{/foreach}>
		<{if $thumbnails == 1}>
		</div>
		<{/if}>
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
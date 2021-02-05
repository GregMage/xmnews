<div id="xmnews-carousel<{$block.randid}>" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
	<{foreach item=indicators from=$block.carousel_indicators}>
    <li data-target="#xmnews-carousel<{$block.randid}>" data-slide-to="<{$indicators}>" <{if $indicators == 0}>class="active"<{/if}>></li>
	<{/foreach}>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
	<{foreach item=blocknews from=$block.news}>
    <div class="item <{if $blocknews.active == true}>active<{/if}>">
      <img src="<{$blocknews.logo}>" alt="<{$blocknews.title}>">
      <div class="carousel-caption">
		<h3><{$blocknews.title}></h3>
		<p>
			<{if $block.desclenght != '0'}>
			<{if $block.desclenght != 'all'}>
			<{$blocknews.description|default:false|truncateHtml:$block.desclenght:'...'}>
			<{else}>
			<{$blocknews.description}>
			<{/if}>
			<{/if}>
		</p>
      </div>
    </div>
	<{/foreach}>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#xmnews-carousel<{$block.randid}>" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#xmnews-carousel<{$block.randid}>" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
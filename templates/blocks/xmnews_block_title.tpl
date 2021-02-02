<ul>
<{foreach item=blocknews from=$block.news}>
	<li>
		<{if $block.logo == true}>
		<{if $blocknews.logo != ''}>
			<img src="<{$blocknews.logo}>" alt="<{$blocknews.title}>" style="max-width:120px">
		<{/if}>
		<{/if}>
		<{if $block.desclenght != 'all'}>
			<a class="" title="<{$blocknews.title}>" href="<{$xoops_url}>/modules/xmnews/article.php?news_id=<{$blocknews.id}>"><{$blocknews.title|truncateHtml:$block.desclenght:'...'}></a>
		<{else}>
			<a class="" title="<{$blocknews.title}>" href="<{$xoops_url}>/modules/xmnews/article.php?news_id=<{$blocknews.id}>"><{$blocknews.title}></a>
		<{/if}>
	</li>
<{/foreach}>
</ul>
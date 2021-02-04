<ul>
<{foreach item=blocknews from=$block.news}>
	<li>
		<{if $block.logo == true}>
		<{if $blocknews.logo != ''}>
			<img src="<{$blocknews.logo}>" alt="<{$blocknews.title}>" style="max-width:<{$block.size}>px">
		<{/if}>
		<{/if}>
		<a class="" title="<{$blocknews.title}>" href="<{$xoops_url}>/modules/xmnews/article.php?news_id=<{$blocknews.id}>"><{$blocknews.title}></a>
	</li>
<{/foreach}>
</ul>
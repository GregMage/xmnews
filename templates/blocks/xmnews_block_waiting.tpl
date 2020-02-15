<{if $block.news != ''}>
<table class="table table-striped">
	<thead class="thead-light">
		<tr>
			<th scope="col"><{$smarty.const._MA_XMNEWS_NEWS_TITLE}></th>
			<{if $block.desclenght != 0}>
			<th scope="col"><{$smarty.const._MA_XMNEWS_NEWS_DESC}></th>
			<{/if}>
			<th scope="col"><{$smarty.const._MA_XMNEWS_NEWS_USERID}></th>
			<th scope="col"><{$smarty.const._MA_XMNEWS_ACTION}></th>
		</tr>
	</thead>
	<tbody>
<{foreach item=waitingnews from=$block.news}>
	<tr>
		<td><{$waitingnews.title}></td>
		<{if $block.desclenght != '0'}>
		<td>
		<{if $block.desclenght != 'all'}>
		<{$waitingnews.description|truncateHtml:$block.desclenght:'...'}>
		<{else}>
		<{$waitingnews.description}>
		<{/if}>
		</td>
		<{/if}>
		<td><{$waitingnews.author}></td>
		<td>
			<a href="<{$xoops_url}>/modules/xmnews/action.php?op=edit&amp;news_id=<{$waitingnews.id}>">
				<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> <{$smarty.const._MA_XMNEWS_EDIT}></button>
			</a>
		</td>
	</tr>
<{/foreach}>
	</tbody>
</table>
<{else}>
	<div class="alert alert-warning"><{$smarty.const._MA_XMNEWS_BLOCKS_NOWAITING}></div>
<{/if}>
<table class="table table-striped">
	<thead class="thead-light">
		<tr>
			<th scope="col"><{$smarty.const._MA_XMNEWS_NEWS_TITLE}></th>
			<th scope="col"><{$smarty.const._MA_XMNEWS_NEWS_DESC}></th>
			<th scope="col"><{$smarty.const._MA_XMNEWS_NEWS_USERID}></th>
			<th scope="col"><{$smarty.const._MA_XMNEWS_ACTION}></th>
		</tr>
	</thead>
	<tbody>
<{foreach item=news from=$block.news}>
	<tr>
		<td><{$news.title}></td>
		<td><{$news.description|truncateHtml:50:'...'}></td>
		<td><{$news.author}></td>
		<td>
			<a href="<{$xoops_url}>/modules/xmnews/action.php?op=edit&amp;news_id=<{$news.id}>">
				<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> <{$smarty.const._MA_XMNEWS_EDIT}></button>
			</a>
		</td>
	</tr>
<{/foreach}>
	</tbody>
</table>
<dl{if $errorType.autoGroupJoinDays|isset} class="formError"{/if}>
	<dt><label for="autoGroupJoinDays">{lang}wcf.acp.group.autoGroupJoinDays{/lang}</label></dt>
	<dd>
		<input type="number" id="autoGroupJoinDays" name="autoGroupJoinDays" value="{$autoGroupJoinDays}" />
		{if $errorType.autoGroupJoinDays|isset}
			<small class="innerError">
				{lang}wcf.acp.group.autoGroupJoin.error.{@$errorType.autoGroupJoinDays}{/lang}
			</small>
		{/if}
		<small>{lang}wcf.acp.group.autoGroupJoinDays.description{/lang}</small>
	</dd>
</dl>

<dl{if $errorType.autoGroupJoinActivityPoints|isset} class="formError"{/if}>
	<dt><label for="autoGroupJoinActivityPoints">{lang}wcf.acp.group.autoGroupJoinActivityPoints{/lang}</label></dt>
	<dd>
		<input type="number" id="autoGroupJoinActivityPoints" name="autoGroupJoinActivityPoints" value="{$autoGroupJoinActivityPoints}" />
		{if $errorType.autoGroupJoinActivityPoints|isset}
			<small class="innerError">
				{lang}wcf.acp.group.autoGroupJoin.error.{@$errorType.autoGroupJoinActivityPoints}{/lang}
			</small>
		{/if}
		<small>{lang}wcf.acp.group.autoGroupJoinActivityPoints.description{/lang}</small>
	</dd>
</dl>
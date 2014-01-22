<dl{if $errorField == 'autoGroupJoinDays'} class="formError"{/if}>
	<dt><label for="autoGroupJoinDays">{lang}wcf.acp.group.autoGroupJoinDays{/lang}</label></dt>
	<dd>
		<input type="number" id="autoGroupJoinDays" name="autoGroupJoinDays" value="{$autoGroupJoinDays}" />
		{if !$errorType|empty && $errorField == 'autoGroupJoinDays'}
			<small class="innerError">
				{lang}wcf.acp.group.autoGroupJoin.error.{@$errorType}{/lang}
			</small>
		{/if}
		<small>{lang}wcf.acp.group.autoGroupJoinDays.description{/lang}</small>
	</dd>
</dl>

<dl{if $errorField == 'autoGroupJoinActivityPoints'} class="formError"{/if}>
	<dt><label for="autoGroupJoinActivityPoints">{lang}wcf.acp.group.autoGroupJoinActivityPoints{/lang}</label></dt>
	<dd>
		<input type="number" id="autoGroupJoinActivityPoints" name="autoGroupJoinActivityPoints" value="{$autoGroupJoinActivityPoints}" />
		{if !$errorType|empty && $errorField == 'autoGroupJoinActivityPoints'}
			<small class="innerError">
				{lang}wcf.acp.group.autoGroupJoin.error.{@$errorType}{/lang}
			</small>
		{/if}
		<small>{lang}wcf.acp.group.autoGroupJoinActivityPoints.description{/lang}</small>
	</dd>
</dl>
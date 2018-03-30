{if $dateIcon}

	{var $dayFormat = ''}
	{var $dayFormatSuffix = isset($dayFormatSuffix) ? $dayFormatSuffix : ''}
	{var $monthFormat = ''}
	{var $yearFormat = ''}


	<span class="entry-date updated {if $dateShort == 'yes'}short-date{/if}">

		{capture $dayFormat}{_x 'd', 'day date format'}{/capture}
		{capture $dayFormatSuffix}{if $currentLang->slug == 'en'}{_x 'S', 'english ordinal suffix for the day'}{else}.{/if}{/capture}

		{if $dateShort == 'yes'}	{capture $monthFormat}{_x 'M', 'month date short format'}{/capture}
		{else}						{capture $monthFormat}{_x 'F', 'month date long format'}{/capture} {/if}

		{capture $yearFormat}{_x 'Y',  'year date format'}{/capture}

		{if $dateLinks == 'yes'}

			<time class="date" datetime="{$dateIcon|date: 'c'}">
				<a class="link-day" href="{$post->dayArchiveUrl}" title="{__ 'Link to daily archives: %s'}{$dateIcon|dateI18n}">
					{$dateIcon|dateI18n: $dayFormat}{if !empty($dayFormatSuffix)}<small>{$dateIcon|dateI18n: $dayFormatSuffix}</small>{/if}
				</a>
				<a class="link-month" href="{$post->monthArchiveUrl}" title="{__ 'Link to monthly archives: %s'|printf:''}{$dateIcon|dateI18n: $monthFormat}">
					{$dateIcon|dateI18n: $monthFormat}
				</a>
				<a class="link-year" href="{$post->yearArchiveUrl}" title="{__ 'Link to yearly archives: %s'|printf:''}{$dateIcon|dateI18n: $yearFormat}">
					{$dateIcon|dateI18n: $yearFormat}
				</a>
			</time>

		{else}

			<time class="date" datetime="{$dateIcon|date: 'c'}">
				<span class="link-day">
					{$dateIcon|dateI18n: $dayFormat}{if !empty($dayFormatSuffix)}<small>{$dateIcon|dateI18n: $dayFormatSuffix}</small>{/if}
				</span>
				<span class="link-month">
					{$dateIcon|dateI18n: $monthFormat}
				</span>
				<span class="link-year">
					{$dateIcon|dateI18n: $yearFormat}
				</span>
			</time>

		{/if}

	</span>

{/if}

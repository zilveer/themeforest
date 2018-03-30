{* REQUIRED PARAMETERS *}
{*
	$item - wp entity of item
	$meta - meta data of item

	$layout - string
	$enableCarousel - bool
	$numOfColumns - number

	$noFeatured - default image
	$isFeatured - bool

	$addInfo - advanced info, bool
*}

{* GLOBAL VARIABLES *}

{var $maxCategories = !empty($maxCategories) ? $maxCategories : 3}

{* LAYOUT *}

{if $layout == 'box'}

	{* DEFAULTS *}
	{var $boxAlign     = !empty($boxAlign) ? $boxAlign : 'align-center'}
	{var $imgWidth     = !empty($imgWidth) ? $imgWidth : 640}
	{var $imageHeight  = !empty($imageHeight) ? $imageHeight : "4:3"}
	{var $textRows     = !empty($textRows) ? $textRows : 3}

	<div n:class='item, "item{$iterator->counter}", $enableCarousel ? carousel-item, $iterator->isFirst($numOfColumns) ? item-first, $iterator->isLast($numOfColumns) ? item-last, image-present, $boxAlign ? $boxAlign, $isFeatured ? item-featured, defined("AIT_REVIEWS_ENABLED") ? reviews-enabled, !$addInfo ? noinfo' data-id="{$iterator->counter}">

		{var $ratio = explode(":", $imageHeight)}
		{var $imgHeight = ($imgWidth / $ratio[0]) * $ratio[1]}
		<div class="item-thumbnail">
			<a href="{$item->permalink}">
				<div class="item-thumbnail-wrap">
					{if $item->hasImage}
					<img src="{imageUrl $item->imageUrl, width => $imgWidth, height => $imgHeight, crop => 1}" alt="{!$item->title}">
					{else}
					<img src="{imageUrl $noFeatured, width => $imgWidth, height => $imgHeight, crop => 1}" alt="{!$item->title}">
					{/if}
				</div>
				<div class="item-text-wrap">
					<div class="item-text">
						<div class="item-excerpt txtrows-{$textRows}"><p>{!$item->excerpt(200)|striptags}</p></div>
					</div>
				</div>
			</a>
		</div>

		<div class="item-box-content-wrap">

			{if $addInfo and $item->categories('ait-items')}
			<div class="item-categories">
				{includePart portal/parts/item-taxonomy, itemID => $item->id, taxonomy => 'ait-items', onlyParent => true, count => 3, wrapper => true}
			</div>
			{/if}

			<div class="item-title"><a href="{$item->permalink}"><h3>{!$item->title}</h3><span class="subtitle">{AitLangs::getCurrentLocaleText($meta->subtitle)}</span></a></div>

			<div class="item-location"><p class="txtrows-2">{$meta->map['address']}</p></div>

			{if $addInfo}
				{if defined('AIT_REVIEWS_ENABLED')}
					{includePart "portal/parts/carousel-reviews-stars", item => $item, showCount => false}
				{/if}
			{/if}
		</div>
	</div>

{else}

	{* DEFAULTS *}
	{var $imgWidth     = !empty($imgWidth) ? $imgWidth : 150}
	{var $imgHeight    = !empty($imgHeight) ? $imgHeight : 500}
	{var $textRows     = !empty($textRows) ? $textRows : 3}

	<div n:class='item, "item{$iterator->counter}", $enableCarousel ? carousel-item, $iterator->isFirst($numOfColumns) ? item-first, $iterator->isLast($numOfColumns) ? item-last, image-present, $isFeatured ? item-featured, defined("AIT_REVIEWS_ENABLED") ? reviews-enabled'	data-id="{$iterator->counter}">

		<div class="item-content-wrap{if !$addInfo} no-info{/if}">

			<div class="item-thumbnail">
				{var $imageUrl = $item->hasImage != '' ? $item->imageUrl : $noFeatured}
				<a href="{$item->permalink}">
					<div class="item-thumbnail-wrap" style="background-image: url('{imageUrl $imageUrl, width => $imgWidth, height => $imgHeight, crop => 1}')"></div>
				</a>
			</div>

			<div class="item-content">

				<div class="item-title">
					<a href="{$item->permalink}"><h3>{!$item->title}</h3>{if $meta->subtitle} <span class="subtitle">{AitLangs::getCurrentLocaleText($meta->subtitle)}</span>{/if}</a>
				</div>

				<div class="item-text">
					<div class="item-excerpt txtrows-{$textRows}"><p>{!$item->excerpt(200)|striptags}</p></div>
				</div>

				<div class="item-location"><p>{$meta->map['address']}</p></div>

			</div>

		</div>

		{if $addInfo}
		<div class="item-info-wrap">
			{if defined('AIT_REVIEWS_ENABLED')}
				{includePart "portal/parts/carousel-reviews-stars", item => $item, showCount => false}
			{/if}

			{capture $itemWeb}
				{if $meta->webLinkLabel}
					{$meta->webLinkLabel}
				{else}
					{$meta->web}
				{/if}
			{/capture}

			{if $meta->web}
			<div class="item-web icon-label">
				<i class="fa fa-home"></i> <a href="{$meta->web}">{$itemWeb}</a>
			</div>
			{/if}

			{if $meta->email and $meta->showEmail}
			<div class="item-mail icon-label">
				<i class="fa fa-envelope"></i> <a href="mailto:{$meta->email}" target="_top">{$meta->email}</a>
			</div>
			{/if}

			{if $item->categories('ait-items')}
			<div class="item-categories">
				{includePart portal/parts/item-taxonomy, itemID => $item->id, taxonomy => 'ait-items', onlyParent => true, count => $maxCategories, wrapper => true}
			</div>
			{/if}
		</div>
		{/if}

	</div>

{/if}

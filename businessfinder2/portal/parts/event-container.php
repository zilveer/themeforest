{var $item = $post}
{var $meta = $item->meta('event-pro-data')}
{var $layout = 'list'}

{var $enableCarousel = false}
{var $numOfColumns = 1}
{var $eventOptions = get_option('ait_events_pro_options', array())}
{var $noFeatured = $eventOptions['noFeatured']}

{var $itemExcerpt     = true}
{var $itemCategories  = true}
{var $itemLocation    = true}

{var $nextDates = aitGetNextDate($meta->dates)}
{var $date_timestamp = strtotime($nextDates['dateFrom'])}
{var $day = date('d', $date_timestamp)}
{var $month = date('M', $date_timestamp)}
{var $year = date('Y', $date_timestamp)}
{var $moreDates = count(aitGetRecurringDates($item)) - 1}

{* LAYOUT *}

{if $layout == 'box'}

{else}

	{* DEFAULTS *}
	{var $imgWidth     = 640}
	{var $imageHeight  = 640}
	{var $textRows     = 3}

	<div n:class='item, "item{$iterator->counter}", $enableCarousel ? carousel-item, $iterator->isFirst($numOfColumns) ? item-first, $iterator->isLast($numOfColumns) ? item-last, image-present'	data-id="{$iterator->counter}">

		<div class="item-content-wrap">

			<div class="item-thumbnail">
				{var $imageUrl = $item->imageUrl != '' ? $item->imageUrl : $noFeatured}
				<a href="{$item->permalink}">
					<div class="item-thumbnail-wrap" style="background-image: url('{imageUrl $imageUrl, width => $imgWidth, height => $imageHeight, crop => 1}')"></div>

					<div class="item-date">
						<span class="entry-date">
							<span class="day">{$day}</span>
							<span class="month">{$month}</span>
							<span class="month">{$year}</span>
						</span>

						{if $moreDates > 0}
							<span class="more">+{$moreDates}</span>
						{/if}
					</div>
				</a>

			</div>

			<div class="item-content">

				<div class="item-title">
					<a href="{$item->permalink}"><h3>{!$item->title}</h3></a>
				</div>

				{if $itemExcerpt}
				<div class="item-text">
					<div class="item-excerpt txtrows-{$textRows}"><p>{!$item->excerpt(200)|striptags}</p></div>
				</div>
				{/if}

				{if $itemCategories or $itemLocation}
				<div class="item-footer">
					{if $itemCategories}
					<div class="item-categories">{includePart "portal/parts/event-taxonomy", itemID => $item->id, taxonomy => 'ait-events-pro', onlyParent => true, count => 3}</div>
					{/if}
					{if $itemLocation}
					<div class="item-location">
						{foreach $item->categories('ait-locations') as $loc}
						<a href="{$loc->url()}" class="location">{!$loc->title}</a>
						{/foreach}
					</div>
					{/if}
				</div>
				{/if}

			</div>

		</div>

	</div>

{/if}

{block content}
{? global $wp_query}

{var $currentCategory = get_queried_object()}

{if $currentCategory->description}
<div class="entry-content">
	{!$currentCategory->description}
</div>
{/if}

<div n:class="items-container, !$wp->willPaginate($wp_query) ? 'pagination-disabled'">
	<div class="content">

		{if $wp_query->have_posts()}

		{includePart portal/parts/search-filters, taxonomy => "ait-items", current => $wp_query->post_count, max => $wp_query->found_posts}

		{if defined("AIT_ADVANCED_FILTERS_ENABLED")}
			{includePart portal/parts/advanced-filters, query => $wp_query}
		{/if}

		<div class="ajax-container">
			<div class="content">

				{var $layout = $options->theme->items->taxonomyLayout}
				{var $noFeatured = $options->theme->item->noFeatured}
				{var $numOfColumns = ($layout == 'box' ? '4' : '1')}
				{var $enableCarousel = false}
				{var $addInfo = true}

				<div class="items-container elm-item-organizer{if $layout == 'box'} organizer-alt{/if}">
					<div class="elm-item-organizer-container carousel-disabled layout-{$layout} column-{$numOfColumns}">

						{customLoop from $wp_query as $post}

							{var $item = $post}
							{var $meta = $item->meta('item-data')}

							{var $dbFeatured = get_post_meta($item->id, '_ait-item_item-featured', true)}
							{var $isFeatured = $dbFeatured != "" ? filter_var($dbFeatured, FILTER_VALIDATE_BOOLEAN) : false}

							{includePart "portal/parts/item-container", layout => $layout, noFeatured => $noFeatured}

						{/customLoop}

					</div>
				</div>

				{includePart parts/pagination, location => pagination-below, max => $wp_query->max_num_pages}

			</div>
		</div>

		{else}
			{includePart parts/none, message => empty-site}
		{/if}
	</div>
</div>

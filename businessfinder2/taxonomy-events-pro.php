{block content}
	{? global $wp_query}

	{var $currentCategory = get_queried_object()}

	{if $currentCategory->description}
	<div class="entry-content">
		{!$currentCategory->description}
	</div>
	{/if}


	<div n:class="events-pro-container, !$wp->willPaginate($wp_query) ? 'pagination-disabled'">
		<div class="content">

			{if $wp_query->have_posts()}

			{includePart portal/parts/search-filters, postType => 'ait-event-pro', taxonomy => "ait-events-pro", current => $wp_query->post_count, max => $wp_query->found_posts}

			{if defined("AIT_ADVANCED_FILTERS_ENABLED")}
				{includePart portal/parts/advanced-filters, query => $wp_query}
			{/if}

			<div class="ajax-container">
				<div class="events-container elm-item-organizer">
					<div class="elm-item-organizer-container carousel-disabled layout-list column-1">
						<div class="content">

							{customLoop from $wp_query as $post}
								{includePart portal/parts/event-container}
							{/customLoop}

						</div>
						<div class="loading hidden" style="display: none;"><span class="ait-preloader">{!__ 'Loading&hellip;'}</span></div>
					</div>
				</div>
			</div>

			{else}
				{includePart parts/none, message => empty-site}
			{/if}
		</div>
	</div>

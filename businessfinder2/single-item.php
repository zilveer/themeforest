{block content}

	{loop as $post}
		{* SETTINGS AND DATA *}
		{var $meta = $post->meta('item-data')}
		{var $settings = $options->theme->item}
		{* SETTINGS AND DATA *}

		{*RICH SNIPPET WRAP*}
		<div class="item-content-wrap" itemscope itemtype="http://schema.org/LocalBusiness">
			<meta itemprop="name" content="{$post->title}">
		{*RICH SNIPPET WRAP*}
			{*
				{var $wouldGalleryDisplay = false}
				{if $post->hasImage}
					{var $wouldGalleryDisplay = true}
				{/if}
				{if $meta->displayGallery && is_array($meta->gallery)}
					{var $wouldGalleryDisplay = true}
				{/if}
			*}

			{* CONTENT SECTION *}
			<div class="item-content">
				{if $meta->displayGallery && is_array($meta->gallery)}
					{* GALLERY SECTION *}
					{includePart portal/parts/single-item-gallery, meta => $meta}
					{* GALLERY SECTION *}
				{else}
					{includePart portal/parts/single-item-featured-img, meta => $meta}
				{/if}

				<div class="entry-content-wrap" itemprop="description">
					<div class="entry-content">
					{if $post->hasContent}
						{!$post->content}
					{else}
						{!$post->excerpt}
					{/if}
					</div>
				</div>
			</div>
			{* CONTENT SECTION *}


			<div class="column-grid column-grid-3">
				<div class="column column-span-1 column-narrow column-first">
					{* OPENING HOURS SECTION *}
					{includePart portal/parts/single-item-opening-hours}
					{* OPENING HOURS SECTION *}
				</div>

				<div class="column column-span-2 column-narrow column-last">
					{* ADDRESS SECTION *}
					{includePart portal/parts/single-item-address}
					{* ADDRESS SECTION *}

					{if ($meta->contactOwnerBtn and $meta->email) or (defined('AIT_GET_DIRECTIONS_ENABLED'))}
					<div class="contact-buttons-container">
					{* CONTACT OWNER SECTION *}
					{includePart portal/parts/single-item-contact-owner}
					{* CONTACT OWNER SECTION *}

					{* GET DIRECTIONS SECTION *}
					{if defined('AIT_GET_DIRECTIONS_ENABLED')}
						{includePart portal/parts/get-directions-button}
					{/if}
					{* GET DIRECTIONS SECTION *}
					</div>
					{/if}
				</div>
			</div>

			{* ITEM EXTENSION *}
			{if defined('AIT_EXTENSION_ENABLED')}
				{includePart portal/parts/item-extension}
			{/if}
			{* ITEM EXTENSION *}

			{* CLAIM LISTING SECTION *}
			{if defined('AIT_CLAIM_LISTING_ENABLED')}
				{includePart portal/parts/claim-listing}
			{/if}
			{* CLAIM LISTING SECTION *}

			{* MAP SECTION *}
			{includePart portal/parts/single-item-map}
			{* MAP SECTION *}

			{* GET DIRECTIONS SECTION *}
			{if defined('AIT_GET_DIRECTIONS_ENABLED')}
				{includePart portal/parts/get-directions-container}
			{/if}
			{* GET DIRECTIONS SECTION *}

			{* SOCIAL SECTION *}
			{includePart portal/parts/single-item-social}
			{* SOCIAL SECTION *}

			{* REVIEWS SECTION *}
			{if defined('AIT_REVIEWS_ENABLED')}
			{includePart portal/parts/single-item-reviews}
			{/if}
			{* REVIEWS SECTION *}

			{* SPECIAL OFFERS SECTION *}
			{if (defined('AIT_SPECIAL_OFFERS_ENABLED'))}
				{includePart parts/single-item-special-offers}
			{/if}
			{* SPECIAL OFFERS SECTION *}

			{* UPCOMING EVENTS SECTION *}
			{if (defined('AIT_EVENTS_PRO_ENABLED')) && aitItemRelatedEvents($post->id)->found_posts}
				{includePart portal/parts/single-item-events, itemId => $post->id}
			{/if}
			{* UPCOMING EVENTS SECTION *}

		{*RICH SNIPPET WRAP*}
		</div>
		{*RICH SNIPPET WRAP*}

	{/loop}

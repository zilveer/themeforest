{block content}
{? global $wp_query}

<div n:class="items-container, !$wp->willPaginate($wp_query) ? 'pagination-disabled'">
	<div class="content">

		{if $wp_query->have_posts()}

			{* LAYOUT VARIABLES *}
			{var $layout = 'list'}
			{var $enableCarousel = false}
			{var $numOfColumns = 1}
			{var $addInfo = true}
			{var $imgWidth = 300}
			{var $imgHeight = 500}
			{var $textRows = 3}

			<div class="items-container elm-item-organizer{if $layout == 'box'} organizer-alt{/if}">
				<div class="elm-item-organizer-container carousel-disabled layout-{$layout} column-{$numOfColumns}">

					{customLoop from $wp_query as $post}

						{* DATA VARIABLES *}
						{var $item = $post}
						{var $meta = get_post_meta($item->id, '_ait-special-offer_special-offer-data', true)}

						{* SPECIAL OFFERS DATA *}
						{var $offerImg = "default_offer_img.jpg"}
						{if $post->image}
							{var $offerImage = $post->imageUrl}
						{elseif aitUrl('img', "/$offerImg")}
							{var $offerImage = aitUrl('img', "/$offerImg")}
						{elseif file_exists(AitSpecialOffers::getPaths('design')."/img/$offerImg")}
							{var $offerImage = AitSpecialOffers::getPaths('design')."/img/$offerImg"}
						{/if}

						{var $dateFrom = isset($meta['dateFrom']) ? date_i18n(get_option('date_format'), strtotime($meta['dateFrom'])) : ''}
						{var $dateTo   = isset($meta['dateTo']) ? date_i18n(get_option('date_format'), strtotime($meta['dateTo'])) : ''}

						{var $itemUrl = get_permalink($meta['item'])}

						<div n:class='item, "item{$iterator->counter}", $enableCarousel ? carousel-item, $iterator->isFirst($numOfColumns) ? item-first, $iterator->isLast($numOfColumns) ? item-last, image-present, '	data-id="{$iterator->counter}">

							<div class="item-content-wrap{if !$addInfo} no-info{/if}">

								<div class="item-thumbnail">
									{if $meta['item']}
									<a href="{!$itemUrl}#single-item-special-offers">
									{/if}
										<div class="item-thumbnail-wrap" style="background-image: url('{imageUrl $offerImage, width => $imgWidth, height => $imgHeight, crop => 1}')"></div>
									{if $meta['item']}
									</a>
									{/if}
								</div>

								<div class="item-content">

									<div class="item-title">
										{if $meta['item']}<a href="{!$itemUrl}#single-item-special-offers">{/if}<h3>{!$item->title}</h3>{if $meta['item']}</a>{/if}
									</div>

									<div class="item-text">
										<div class="item-excerpt txtrows-{$textRows}"><p>{!$item->excerpt(200)|striptags}</p></div>
									</div>

									{if $meta['item']}
									<div class="item-location">
										<p><a href="{!$itemUrl}#single-item-special-offers">{!get_the_title($meta['item'])}</a></p>
									</div>
									{/if}

								</div>

							</div>

							{if $addInfo}
							<div class="item-info-wrap">
								{if $dateFrom}
								<div class="item-date icon-label">
									<i class="fa fa-calendar"></i><span>{__ 'From:'}</span> {$dateFrom}
								</div>
								{/if}

								{if $dateTo}
								<div class="item-date icon-label">
									<i class="fa fa-calendar"></i><span>{__ 'To:'}</span> {$dateTo}
								</div>
								{/if}

								<div class="item-price">
									<span>{currency $meta['price'], $meta['currency']}</span>
								</div>
							</div>
							{/if}

						</div>

					{/customLoop}

				</div>
			</div>

			{includePart parts/pagination, location => pagination-below, max => $wp_query->max_num_pages}

		{else}
			{includePart parts/none, message => empty-site}
		{/if}
	</div>
</div>

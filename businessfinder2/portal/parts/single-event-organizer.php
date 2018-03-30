{if !empty($meta->item)}

{var $relatedItemUrl = get_permalink($meta->item)}
{var $relatedItemFeaturedImage = wp_get_attachment_url(get_post_thumbnail_id($meta->item), 'thumbnail')}
{var $relatedItemThumbnail = $relatedItemFeaturedImage !="" ? $relatedItemFeaturedImage : $options->theme->item->noFeatured}

<div class="organizer-container">

	{* translators: Organizer as a person who organize events *}


	<div class="content">

		<div class="thumbnail">
			<a href="{$relatedItemUrl}">
				<h2 class="title">{__ 'Organizer'}</h2>
				<div class="thumbnail-wrap" style="background-image: url('{!$relatedItemThumbnail}')"></div>
			</a>
		</div>

		<div class="data-container">

			{includePart portal/parts/single-item-social-icons, meta => (object)$relatedItemMeta}

			<h3><a href="{$relatedItemUrl}">{get_the_title($meta->item)|noescape}</a></h3>
			{if $relatedItemMeta[subtitle]}
				<span class="subtitle">{$relatedItemMeta[subtitle]}</span>
			{/if}
			{if $relatedItem->post_content != ""}
				<div class="text-content">{!$relatedItem->post_content|trimWords: 30}</div>
			{/if}

			<div class="contact-wrapper">
				{if $relatedItemMeta[telephone]}
				<div class="contact data">
					<div class="label telephone-icon">{__ 'Telephone:'}</div>
					<div class="data-content">
						<p><a href="tel:{str_replace(' ', '', $relatedItemMeta[telephone])}" class="phone">{$relatedItemMeta[telephone]}</a></p>
					</div>
				</div>
				{/if}

				{if $relatedItemMeta[email] and $relatedItemMeta[showEmail]}
				<div class="contact data">
					<div class="label mail-icon">{__ 'Email:'}</div>
					<div class="data-content">
						<p><a href="mailto:{$relatedItemMeta[email]}" target="_top">{$relatedItemMeta[email]}</a></p>
					</div>
				</div>
				{/if}

				{if $relatedItemMeta[web]}
				<div class="contact data">
					<div class="label web-icon">{__ 'Web:'}</div>
					<div class="data-content">
						<p>
							<a href="{$relatedItemMeta[web]}" target="_blank" {if $options->theme->item->addressWebNofollow}rel="nofollow"{/if}>
							{if $relatedItemMeta[webLinkLabel]}
								{$relatedItemMeta[webLinkLabel]}
							{else}
								{$relatedItemMeta[web]}
							{/if}
							</a>
						</p>
					</div>
				</div>
				{/if}
			</div>

		</div>

	</div>

</div>

{/if}

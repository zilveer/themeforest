{block content}

	{* template for page title is in parts/page-title.php *}

	{loop as $post}

		<div class="event-test"></div>

							<div class="entry-thumbnail">
						{if $post->hasImage}
							<a href="{$post->imageUrl}" class="thumb-link">
								<span class="entry-thumbnail-icon">
									<img src="{imageUrl $post->imageUrl, width => 1000, height => 500, crop => 1}">
								</span>
							</a>
						{/if}
					</div>

		<div class="entry-content">
			{if $post->hasContent}
				{!$post->content}
			{else}
				{!$post->excerpt}
			{/if}

			{!$post->linkPages}
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			{if $wp->isSingular(event)}
				{var $meta = $post->meta('event-data')}
				{if $meta->location != ''}
					<div class="event-loc">
						<span class="event-loc-title"><strong>{__ 'Location:'}</strong></span>
						<span class="event-loc-text">{$meta->location}</span>
					</div>
				{/if}
			{/if}

			{*if $wp->isSingle and $post->author->bio and $post->author->isMulti*}
				{*includePart parts/author-bio*}
			{*/if*}
		</footer><!-- .entry-footer -->

		{includePart parts/pagination location => nav-below}
	{/loop}

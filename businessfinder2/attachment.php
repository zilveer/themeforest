{block content}

	{* template for page title is in parts/page-title.php *}

	{loop as $post}
		{var $mime = explode('/', $post->attachment->mimeType)}

		<div class="detail-half-content detail-attachment-content">
				<div class="detail-thumbnail">
					{if $post->attachment->isImage}
						<a href="{$post->attachment->url}">{!$post->attachment->image(array(960, 960))}</a>
					{elseif $post->attachment->isVideo}
						{*!do_shortcode('[video src="'.wp_get_attachment_url($post->attachment->id).'"]')*}
						{!=wp_video_shortcode(array('src' => $post->attachment->url))}
					{elseif $post->attachment->isAudio}
						{*!do_shortcode('[audio src="'.wp_get_attachment_url($post->attachment->id).'"]')*}
						{!=wp_audio_shortcode(array('src' => $post->attachment->url))}
					{else}
						OTHER
						<a href="{$post->attachment->url}"><span class="attachment-icon attachment-icon-{!$mime[1]}"></span></a>
					{/if}
				</div>
				<div class="detail-description">
					<!--<div class="detail-text entry-content">
						{if $post->hasContent}
							{!$post->content}
						{else}
							{!$post->excerpt}
						{/if}
					</div>-->
					<div class="detail-info">
						{if $post->hasContent}
						<p>
							<span class="info-title">Description:</span>
							<span class="info-value">{!$post->content|striptags}</span>
						</p>
						{/if}
						{if $post->attachment->isImage or $post->attachment->isVideo}
						<p>
							<span class="info-title">Dimensions:</span>
							<span class="info-value">{$post->attachment->width} x {$post->attachment->height}</span>
						</p>
						{/if}
						<p>
							<span class="info-title">File Type:</span>
							<span class="info-value">{!$mime[1]}</span>
						</p>
						<p>
							<span class="info-title">File Size:</span>
							<span class="info-value">{size_format(filesize(get_attached_file($post->attachment->id)))}</span>
						</p>

					</div>
				</div>
			{!$post->linkPages}
		</div><!-- .detail-content -->

		<footer class="entry-footer">
			{if $wp->isSingle and $post->author->bio and $post->author->isMulti}
				{includePart parts/author-bio}
			{/if}
		</footer><!-- .entry-footer -->

		{includePart parts/pagination location => nav-below}

	{/loop}

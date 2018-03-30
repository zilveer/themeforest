{block content}

	{* template for page title is in parts/page-title.php *}

	{loop as $post}

		<article {!$post->htmlId} class="content-block">
		
		{if $post->hasImage}
			<div class="entry-thumbnail">			
							<a href="{$post->imageUrl}" class="thumb-link">
								<span class="entry-thumbnail-icon">
									<img src="{imageUrl $post->imageUrl, width => 1000, height => 500, crop => 1}">
								</span>
							</a>	
					</div>
			{/if}			

			<div class="entry-content">
				{!$post->content}
				{!$post->linkPages}
			</div><!-- .entry-content -->

		</article><!-- #post -->
	{/loop}
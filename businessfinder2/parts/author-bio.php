{ifset $post} {var $author = $post->author} {/ifset}

<div class="author-info">
	<div class="author-avatar">
		{!$author->avatar(80)}
	</div><!-- #author-avatar -->
	<div class="author-description">
		<h2>{__ 'About %s'|printf: $author}</h2>
		<div>
			{!$author->bio}
			<div class="author-link-wrap">
				<a href="{$author->postsUrl}" rel="author" class="author-link">
					{!__ 'View all posts by %s <span class="meta-nav">&rarr;</span>'|printf: $author}
				</a>
			</div>
		</div>
	</div><!-- /.author-description -->
</div><!-- /.author-info -->
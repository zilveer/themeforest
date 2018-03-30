	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title">
			{if $wp->canCurrentUser(edit_posts) and $message == empty-site}
				{__ 'No posts to display'}
			{else}
				{__ 'Nothing Found'}
			{/if}
			</h1>
		</header>

		<div class="entry-content">
			<p>
			{if $wp->canCurrentUser(edit_posts) and $message == empty-site}

				{!__ 'Ready to publish your first post? <a href="%s">Get started here</a>.' |printf:$wp->adminUrl('post-new.php')}

			{elseif $message == nothing-found}

				{__ 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.'}

			{elseif $message == 'no-posts' or (!$wp->canCurrentUser(edit_posts) and $message == empty-site)}

				{__ 'Apologies, but no results were found. Perhaps searching will help find a related post.'}

			{/if}
			</p>

			{searchForm}

		</div><!-- .entry-content -->
	</article><!-- #post-0 -->

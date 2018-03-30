{block content}

	{* template for page title is in parts/page-title.php *}

	{if $wp->havePosts}

		{if $wp->isAuthor and $author->bio}
			{includePart parts/author-bio}
		{/if}

		{loop as $post}
			{includePart parts/post-content}
		{/loop}

		{includePart parts/pagination, location => pagination-below}

	{else}
		{includePart parts/none, message => no-posts}
	{/if}

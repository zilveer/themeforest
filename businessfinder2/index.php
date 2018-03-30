{block content}

	{if $wp->isBlog and $blog and $blog->content}
		<div class="entry-content blog-content">
			{!$blog->content}
		</div>
	{/if}

	{if $wp->havePosts}

		{loop as $post}
			{includePart parts/post-content}
		{/loop}

		{includePart parts/pagination, location => nav-below}

	{else}

		{includePart parts/none, message => empty-site}

	{/if}
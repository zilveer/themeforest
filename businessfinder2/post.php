{block content}

	{* template for page title is in parts/page-title.php *}

	{loop as $post}

		{includePart parts/post-content}

		{includePart parts/pagination location => nav-below}

	{/loop}

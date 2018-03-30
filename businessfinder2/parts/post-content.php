{* VARIABLES *}
{var $concreteTaxonomy = isset($taxonomy) && $taxonomy != "" ? $taxonomy : ''}
{var $maxCategories = $options->theme->items->maxDisplayedCategories}
{* VARIABLES *}


	{if !$wp->isSingular}

		{if $wp->isSearch}
			{var $isAdvanced = false}

			{if isset($_REQUEST['a']) && $_REQUEST['a'] != ""}
				{var $isAdvanced = true}
			{/if}

			{if $isAdvanced}
				{var $noFeatured = $options->theme->item->noFeatured}

				{var $item = $post}
				{var $meta = $item->meta('item-data')}

				{var $enableCarousel = false}

				{var $dbFeatured = get_post_meta($post->id, '_ait-item_item-featured', true)}
				{var $isFeatured = $dbFeatured != "" ? filter_var($dbFeatured, FILTER_VALIDATE_BOOLEAN) : false}

				{var $addInfo = true}

				{includePart portal/parts/item-container, layout => $layout, onlyFeaturedCat => true, noFeatured => $noFeatured}

			{else}
				{*** SEARCH RESULTS ONLY ***}

				<article {!$post->htmlId} {!$post->htmlClass('hentry')}>
					<header class="entry-header">

						<div class="entry-title">

							<div class="entry-title-wrap">
								{includePart parts/entry-date-format, dateIcon => $post->rawDate, dateLinks => 'no', dateShort => 'no'}
								<h2><a href="{$post->permalink}">{!$post->title}</a></h2>
								{if $post->type == post}
									{includePart parts/entry-author}
								{/if}
							</div><!-- /.entry-title-wrap -->
						</div><!-- /.entry-title -->
					</header><!-- /.entry-header -->

					<div class="entry-content loop">
						{!$post->excerpt}
						<a href="{$post->permalink}" class="more">{!__ 'read more'}</a>
					</div><!-- .entry-content -->

<!-- 					<footer class="entry-footer">
							{if $concreteTaxonomy}
								{includePart parts/entry-categories, taxonomy => $concreteTaxonomy}
							{else}
								{if $post->isInAnyCategory}
									{includePart parts/entry-categories, taxonomy => $concreteTaxonomy}
								{/if}
							{/if}
					</footer> --><!-- /.entry-footer -->
				</article>
			{/if}

		{else}

			{*** STANDARD LOOP ***}

			<article {!$post->htmlId} n:class="hentry , $post->htmlClass('', false), !$post->hasImage ? has-no-thumbnail">
				<div class="entry-wrap">
					<header class="entry-header {if !$post->hasImage}nothumbnail{/if}">

						<div class="entry-thumbnail-desc">

							{includePart parts/entry-date-format, dateIcon => $post->rawDate, dateLinks => 'no', dateShort => 'no'}
							<div class="entry-title-wrappper">
							<div class="entry-title">
								<div class="entry-title-wrap">
									<h2><a href="{$post->permalink}">{!$post->title}</a></h2>
								</div><!-- /.entry-title-wrap -->
							</div><!-- /.entry-title -->

							{if $post->type == post}
								{includePart parts/entry-author}
							{/if}
							</div>

							{if !$post->hasImage}
								{includePart parts/comments-link}
							{/if}
						</div>

						{if $post->hasImage}
							<div class="entry-thumbnail">
								<div class="entry-thumbnail-wrap entry-content" style="background-image: url('{imageUrl $post->imageUrl, width => 1000, height => 500, crop => 1}')"></div>
							</div>
						{/if}

						{if $post->isSticky and !$wp->isPaged and $wp->isHome}
							<div class="entry-meta">
									<span class="featured-post">{__ 'Featured post'}</span>
							</div>
						{/if}

					</header><!-- /.entry-header -->

					{if $post->hasImage}
					<footer class="entry-footer">
						<div class="entry-data">

							<a href="{$post->permalink}" class="more"></a>

							{capture $editLinkLabel}<span class="edit-link">{!__ 'Edit'}</span>{/capture}
							{!$post->editLink($editLinkLabel)}

							{if $post->isInAnyCategory}
								{includePart parts/entry-categories}
							{/if}

							{includePart parts/comments-link}

						</div>
					</footer><!-- .entry-footer -->
					{/if}
				</div>

				<div class="entry-content loop">
					{if $post->hasContent}
						{!$post->excerpt}
					{else}
						{!$post->content}
					{/if}
				</div><!-- .entry-content -->

				{if !$post->hasImage}
					<footer class="entry-footer">
						<div class="entry-data">

							{if $post->isInAnyCategory}
								{__ 'Posted in'} {includePart parts/entry-categories, separator => ", "}
							{/if}

							{capture $editLinkLabel}<span class="edit-link">{!__ 'Edit'}</span>{/capture}
							{!$post->editLink($editLinkLabel)}

						</div>
					</footer><!-- .entry-footer -->
				{/if}

			</article>
		{/if}

	{else}

		{*** POST DETAIL ***}

		<article {!$post->htmlId} class="content-block hentry">

			<div class="entry-title hidden-tag">
				<h2>{!$post->title}</h2>
			</div>

			<div class="entry-thumbnail">
					{if $post->hasImage}
						<div class="entry-thumbnail-wrap">
						 <a href="{$post->imageUrl}" class="thumb-link">
						  <span class="entry-thumbnail-icon">
							<img src="{imageUrl $post->imageUrl, width => 1000, height => 400, crop => 1}" alt="{!$post->title}">
						  </span>
						 </a>
						</div>
						{if $post->categoryList}
						{includePart parts/entry-categories, taxonomy => 'category'}
						{/if}
						{includePart parts/comments-link}
					{/if}
				</div>

			<div class="entry-content">
				{!$post->content}
				{!$post->linkPages}
			</div><!-- .entry-content -->

			<footer class="entry-footer single">



				{if $post->tagList}
					<span class="tags">
						<span class="tags-links">{!$post->tagList}</span>
					</span>
				{/if}


			</footer><!-- .entry-footer -->

			{includePart parts/author-bio}


		</article>

	{/if}

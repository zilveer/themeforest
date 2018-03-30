{* ********************************************************* *}
{* COMMON DATA                                               *}
{* ********************************************************* *}

	{capture $editLinkLabel}<span class="edit-link">{!__ 'Edit'}</span>{/capture}

	{var $titleClass = ''}
	{var $titleName = ''}
	{var $editButton = ''}
	{var $titleImage = ''}
	{var $dateIcon = ''}
	{var $dateLinks = ''}
	{var $dateShort = ''}
	{var $dateInterval = ''}
	{var $dayFormatSuffix = ''}
	{var $titleAuthor = ''}
	{var $titleCategory = ''}
	{var $titleComments = ''}
	{var $titleSubDesc = ''}
	{var $titleDesc = $el->option(description)}
	{var $pageShare = $el->option(pageShare)}
	{var $showPager = ''}
	{var $titleExcerpt = ''}
	{var $categoryColor = ''}

	{var $subtitle = ""}
	{var $subtext = ""}

	{if defined('AIT_EVENTS_PRO_ENABLED')}
		{var $eventOptions = get_option('ait_events_pro_options', array())}
	{/if}

	{var $itemExpired = ""}


{* ********************************************************* *}
{* for 404, SEARCH and WOOCOMMERCE                           *}
{* ********************************************************* *}

{if $wp->is404 or $wp->isSearch or $wp->isWoocommerce()}

	{* CLASS ********** *} {if $wp->is404}				{var $titleClass = "simple-title"} {/if}
	{* CLASS ********** *} {if $wp->isSearch}			{var $titleClass = "simple-title"} {/if}
	{* CLASS ********** *} {if $wp->isWoocommerce()}	{var $titleClass = "simple-title"} {/if}

	{* TITLE ********** *} {if $wp->is404}				{capture $titleName}{__ "This is somewhat embarrassing, isn't it?"}{/capture}			{/if}
	{* TITLE ********** *} {if $wp->isSearch}
								{if isset($_REQUEST['a']) && $_REQUEST['a'] != ""}
									{var $sString = array()}
									{if isset($_REQUEST['s']) && $_REQUEST['s'] != ""}{? array_push($sString, htmlspecialchars($_REQUEST['s']) )}{/if}
									{if isset($_REQUEST['category']) && $_REQUEST['category'] != ""}
										{var $dCategory = get_term($_REQUEST['category'], 'ait-items')}
										{if isset($dCategory)}{? array_push($sString, $dCategory->name)}{/if}
									{/if}
									{if isset($_REQUEST['location']) && $_REQUEST['location'] != ""}
										{var $dLocation = get_term($_REQUEST['location'], 'ait-locations')}
										{if isset($dLocation)}{? array_push($sString, $dLocation->name)}{/if}
									{/if}

									{capture $titleName}
										{capture $searchTitle}<span class="title-data">{!implode(", ", $sString)}</span>{/capture}
										{if count($sString) > 0}
										{!__ 'Search Results for: %s'|printf: $searchTitle}
										{else}
										{!__ 'Search Results: %s'|printf: $searchTitle}
										{/if}
									{/capture}
								{else}
									{capture $titleName}
										{capture $searchTitle}<span class="title-data">{$wp->searchQuery}</span>{/capture}
										{!__ 'Search Results for: %s'|printf: $searchTitle}
									{/capture}
								{/if}
							{/if}

	{* TITLE ********** *} {if $wp->isWoocommerce()}	{capture $titleName}{? woocommerce_page_title()}{/capture}								{/if}

{* ********************************************************* *}
{* for PAGES, POST DETAIL, IMAGE DETAIL and PORTFOLIO DETAIL *}
{* for LOOP pages only                                       *}
{* ********************************************************* *}

{elseif $wp->isPage or $wp->isSingular(post) or $wp->isSingular(portfolio-item) or $wp->isSingular(event) or $wp->isSingular(job-offer) or $wp->isSingular(item) or $wp->isSingular(event-pro) or $wp->isAttachment}
{loop as $post}

	{* CLASS ********** *} {if $wp->isPage} 					{var $titleClass = "standard-title"} 				{/if}
	{* CLASS ********** *} {if $wp->isSingular(post)} 			{var $titleClass = "post-title"} 					{/if}
	{* CLASS ********** *} {if $wp->isSingular(portfolio-item)} {var $titleClass = "post-title portfolio-title"} 	{/if}
	{* CLASS ********** *} {if $wp->isSingular(event)} 			{var $titleClass = "post-title event-title"} 		{/if}
	{* CLASS ********** *} {if $wp->isSingular(job-offer)} 		{var $titleClass = "post-title job-offer-title"}	{/if}
	{* CLASS ********** *} {if $wp->isAttachment}				{var $titleClass = "post-title attach-title"}		{/if}

	{* META DATA ****** *} {if $wp->isSingular(event)}			{var $meta = $post->meta(event-data)}
						   {elseif $wp->isSingular(job-offer)}	{var $meta = $post->meta(offer-data)}
						   {/if}

	{* TITLE ********** *} {var $titleName = $post->title}
	{* IMAGE ********** *} {var $titleImage = $post->imageUrl}
						   {if $wp->isAttachment or $wp->isSingular(portfolio-item) or $wp->isSingular(job-offer) or $wp->isSingular(post) or $wp->isPage or $wp->isSingular(event) or $wp->isSingular(item) or $wp->isSingular(event-pro)} {var $titleImage = ''} {/if}
	{* EDIT *********** *} {capture $editButton}{!$post->editLink($editLinkLabel)}{/capture}

	{* DATE ICON ****** *} {if $wp->isSingular(portfolio-item)} {var $dateIcon = FALSE} 			{var $dateLinks = 'no'} 	{var $dateShort = 'no'} {/if}
	{* DATE ICON ****** *} {if $wp->isSingular(event)} 			{var $dateIcon = FALSE} 			{var $dateLinks = 'no'} 	{var $dateShort = 'no'} {/if}
	{* DATE ICON ****** *} {if $wp->isSingular(job-offer)} 		{var $dateIcon = FALSE} 			{var $dateLinks = 'no'} 	{var $dateShort = 'no'} {/if}
	{* DATE ICON ****** *} {if $wp->isAttachment} 				{var $dateIcon = $post->rawDate}  	{var $dateLinks = 'no'}		{var $dateShort = 'no'} {var $dayFormatSuffix = true} {/if}
	{* DATE ICON ****** *} {if $wp->isSingular(post)} 			{var $dateIcon = $post->rawDate}  	{var $dateLinks = 'no'}		{var $dateShort = 'no'} {var $dayFormatSuffix = true} {/if}

	{* DATE INTERVAL ** *} {if $wp->isSingular(event)}			{capture $intLabel}{__ 'Duration:'}{/capture}
																{var $intFrom = $meta->dateFrom}
																{var $intTo = $meta->dateTo}
																{if $intTo}{var $dateInterval = 'yes'}{/if}
						   {/if}
	{* DATE INTERVAL ** *} {if $wp->isSingular(job-offer)}		{capture $intLabel}{__ 'Validity:'}{/capture}
																{var $intFrom = $meta->validFrom}
																{var $intTo = $meta->validTo}
																{var $dateInterval = 'yes'}
						   {/if}
	{* VALIDITY ******* *} {if $wp->isSingular(job-offer)}
								{if strtotime($meta->validTo) <= intval(date("U"))}
									{capture $itemExpired}<span class="expired">{__ 'Expired: '}</span>{/capture}
								{/if}
						   {/if}

	{* AUTHOR ********* *} {if $wp->isAttachment} 				{var $titleAuthor = 'yes'} {/if}
	{* AUTHOR ********* *} {if $wp->isSingular(post)} 			{var $titleAuthor = 'yes'} {/if}

	{* CATEGORY ******* *} {if $post->categoryList}				{var $titleCategory = 'no'} {/if}


	{* ITEM ICON ****** *} {if $wp->isSingular(item)}

								{var $taxonomies = $post->taxonomies}
								{var $terms = get_the_terms($post->id, 'ait-items')}
								{if $terms}
									{var $category = reset($terms)}
									{var $icons = get_option($category->taxonomy . "_category_" . $category->term_id)}
									{if isset($icons['icon']) && $icons['icon'] != ""}
										{capture $categoryIcon}
											{$icons['icon']}
										{/capture}
									{else}
										{if $category->parent != 0}
											{? global $wp_query}
											{var $category = get_term($category->parent, $category->taxonomy)}
											{var $icons = get_option($category->taxonomy . "_category_" . $category->term_id)}
											{if isset($icons['icon']) && $icons['icon'] != ""}
												{capture $categoryIcon}
													{$icons['icon']}
												{/capture}
											{else}
												{capture $categoryIcon}
													{if $category->taxonomy == "ait-items"}
													{$options->theme->items->categoryDefaultIcon}
													{else}
													{$options->theme->items->locationDefaultIcon}
													{/if}
												{/capture}
											{/if}
										{else}
											{capture $categoryIcon}
												{if $category->taxonomy == "ait-items"}
												{$options->theme->items->categoryDefaultIcon}
												{else}
												{$options->theme->items->locationDefaultIcon}
												{/if}
											{/capture}
										{/if}
									{/if}
								{/if}
							{/if}
	{* EVENT PRO ICON ****** *} {if $wp->isSingular(event-pro)}

									{var $eventProMeta = $post->meta('event-pro-data')}
									{var $nextDates = aitGetNextDate($eventProMeta->dates)}

									{var $dateIcon = $nextDates['dateFrom']} {var $dateLinks = 'no'} {var $dateShort = 'no'} {var $dayFormatSuffix = true}
								{/if}

	{* ITEM ICON ****** *} {if $wp->isSingular(job-offer)}
								{if $post->imageUrl}
									{var $categoryIcon = $post->imageUrl}
								{/if}
							{/if}

	{* SUBTITLE ****** *} {if $wp->isSingular(item)}
							{var $itemMeta = $post->meta('item-data')}
							{var $subtitle = AitLangs::getCurrentLocaleText($itemMeta->subtitle)}
						  {/if}

	{* TITLE EXCERPT ****** *}	{if $wp->isSingular(event-pro)}
									{var $titleExcerpt = $post->excerpt(16)|striptags}
							  	{/if}

{/loop}

{* ********************************************************* *}
{* for BLOG PAGE ONLY                                        *}
{* ********************************************************* *}

{elseif $wp->isBlog and $blog}

	{* CLASS ********** *} {var $titleClass = "blog-title"}
	{* TITLE ********** *} {var $titleName = $blog->title}
	{* IMAGE ********** *} {var $titleImage = $blog->imageUrl}
	{* EDIT *********** *} {capture $editButton}{!$blog->editLink($editLinkLabel)}{/capture}

{* ********************************************************* *}
{* for CATEGORY, ARCHIVE, TAG and AUTHOR                     *}
{* ********************************************************* *}

{elseif $wp->isCategory or $wp->isArchive or $wp->isTag or $wp->isAuthor or $wp->isTax(portfolios) or $wp->isTax(items) or $wp->isTax(events-pro) or $wp->isTax(locations)}



	{* CLASS ********** *} {var $titleClass = "archive-title"}

	{* TITLE ********** *} {if $wp->isCategory}					{capture $titleName}
																	{capture $categoryTitle}<span class="title-data">{!$category->title}</span>{/capture}
																	{!__ 'Category Archives: %s'|printf: $categoryTitle}
																{/capture}

	{* TITLE ********** *} {elseif $wp->isTax(items) or $wp->isTax(locations) or $wp->isTax(ait-events-pro)}
								{var $category = get_queried_object()}
								{capture $titleName}
									{capture $categoryTitle}<span class="title-data">{!$category->name}</span>{/capture}
									{!__ '%s'|printf: $categoryTitle}
								{/capture}

	{* TITLE ********** *} {elseif $wp->isTag}					{capture $titleName}
																	{capture $tagTitle}<span class="title-data">{$tag->title}</span>{/capture}
																	{!__ 'Tag Archives: %s'|printf: $tagTitle}
																{/capture}
	{* TITLE ********** *} {elseif $wp->isPostTypeArchive}		{capture $titleName}
																	{capture $archiveTitle}<span class="title-data">{$archive->title}</span>{/capture}
																	{!__ 'Archives: %s'|printf: $archiveTitle}
																{/capture}
	{* TITLE ********** *} {elseif $wp->isTax}					{capture $titleName}
																	{capture $taxonomyTitle}<span class="title-data">{$taxonomyTerm->title}</span>{/capture}
																	{!__ 'Category Archives: %s'|printf: $taxonomyTitle}
																{/capture}
	{* TITLE ********** *} {elseif $wp->isAuthor}				{capture $titleName}
																	{capture $authorTitle}<span class="title-data">{$author}</span>{/capture}
																	{!__ 'All posts by %s'|printf: $authorTitle}
																{/capture}
	{* TITLE ********** *} {elseif $wp->isArchive}
								{if $archive->isDay}			{capture $titleName}
																	{capture $dayTitle}<span class="title-data">{$archive->dateI18n}</span>{/capture}
																	{!__ 'Daily Archives: %s'|printf: $dayTitle}
																{/capture}
								{elseif $archive->isMonth}		{capture $titleName}
																	{capture $monthFormat}{_x 'F Y', 'monthly archives date format'}{/capture}
																	{capture $monthTitle}<span class="title-data">{$archive->dateI18n($monthFormat)}</span>{/capture}
																	{!__ 'Monthly Archives: %s'|printf: $monthTitle}
																{/capture}
								{elseif $archive->isYear}		{capture $titleName}
																	{capture $yearFormat}{_x 'Y',  'yearly archives date format'}{/capture}
																	{capture $yearTitle}<span class="title-data">{$archive->dateI18n($yearFormat)}</span>{/capture}
																	{!__ 'Yearly Archives: %s'|printf: $yearTitle}
																{/capture}
								{else}							{capture $titleName}{!__ 'Archives:'}{/capture}
								{/if}
						   {/if}

	{* CATEGORY COLOR ** *} {if $wp->isTax(ait-events-pro)}

								{var $icons = get_option($category->taxonomy . "_category_" . $category->term_id)}
								{if isset($icons['icon_color']) && $icons['icon_color'] != ""}
									{var $categoryColor = $icons['icon_color']}
								{else}
									{if $category->parent != 0}
										{? global $wp_query}
										{var $taxonomy = $wp_query->tax_query->queries[0]['taxonomy']}
										{var $category = get_term($category->parent, $taxonomy)}
										{var $icons = get_option($category->taxonomy . "_category_" . $category->term_id)}
										{if isset($icons['icon_color']) && $icons['icon_color'] != ""}
											{var $categoryColor = $icons['icon_color']}
										{/if}
									{/if}
								{/if}
							{/if}

	{* SUBDESC ******** *} {if $wp->isCategory}					{var $titleSubDesc = $category->description} 	{/if}
	{* SUBDESC ******** *} {if $wp->isTag}						{var $titleSubDesc = $tag->description} 		{/if}

{/if}


{* ********************* *}
{* RESULTS               *}
{* ********************* *}

{if $subtitle == '' and $titleSubDesc == '' and $titleDesc == '' and $titleExcerpt == ''}{var $subtext = 'disabled'}{/if}

<div n:class="'page-title', $pageShare ? 'share-enabled', $subtext == 'disabled' ? 'subtitle-missing' ">

	<div class="grid-main">
	<div class="grid-table">
	<div class="grid-row">
		{if defined('AIT_REVIEWS_ENABLED') && isset($post)}
		<header class="entry-header {AitItemReviews::itemHasReviews($post->id)}">
		{else}
		<header class="entry-header">
		{/if}
			<div class="entry-header-left">

			<div class="entry-title {$titleClass}">

				<div class="entry-title-wrap">

					<h1>{!$itemExpired}{!$titleName}</h1>
					{if defined('AIT_REVIEWS_ENABLED') and $wp->isSingular(item)}
						{includePart portal/parts/single-item-reviews-stars}
					{/if}
					{if $subtitle}<span class="subtitle">{$subtitle}</span>{/if}

					{if $dateInterval == 'yes' or $titleAuthor == 'yes' or $titleCategory == 'yes' or $titleComments == 'yes' or $titleSubDesc}
						<div class="entry-data">

							{if $dateInterval == 'yes'}
								<div class="date-interval">
									<span class="date-interval-title"><strong>{$intLabel}</strong></span>
									<time class="event-from" datetime="{$intFrom|date:'c'}">{$intFrom|dateI18n: 'd F Y'}</time>
									<span class="date-sep">-</span>
									<time class="event-to" datetime="{$intTo|date:'c'}">{$intTo|dateI18n: 'd F Y'}</time>
								</div>
							{/if}

							{includePart parts/entry-date-format, dateIcon => $dateIcon, dateLinks => $dateLinks, dateShort => $dateShort,  dayFormatSuffix => $dayFormatSuffix}

							{if $titleAuthor == 'yes'} 		{includePart parts/entry-author}		{/if}
							{if $titleCategory == 'yes'}	{includePart parts/entry-categories}	{/if}
							{if $titleComments == 'yes'}	{includePart parts/comments-link}		{/if}
							{if $titleSubDesc}				{!$titleSubDesc}						{/if}

						</div>
					{/if}

					{if $titleDesc}
						<div class="page-description">{!$titleDesc}</div>
					{/if}

					{if $titleExcerpt}
						<div class="page-description">
							{if $wp->isSingular(event-pro)}
								{includePart parts/entry-date-format, dateIcon => $dateIcon, dateLinks => $dateLinks, dateShort => $dateShort,  dayFormatSuffix => $dayFormatSuffix}
							{/if}
							{!$titleExcerpt|striptags|trimWords: 14}
						</div>
					{/if}

					{if $editButton}
						<div class="entry-meta">
							{!$editButton}
						</div>
					{/if}

				</div>
			</div>

			{if $titleImage}
				<div class="entry-thumbnail">
					<div class="entry-thumbnail-wrap">
						<a href="{$titleImage}" class="thumb-link">
							<span class="entry-thumbnail-icon">
								<img src="{imageUrl $titleImage, width => 1000, height => 500, crop => 1}" alt="{$titleName}">
							</span>
						</a>
					</div>
				</div>
			{/if}


			{if $showPager == 'yes'}
			<nav class="nav-single" role="navigation">
				{includePart parts/pagination arrow => left}
				{includePart parts/pagination arrow => right}
			</nav>
			{/if}

			</div>

		</header><!-- /.entry-header -->

		<!-- page title social icons -->
		{includePart parts/page-share, showShare => $pageShare}
		<!-- page title social icons -->

	</div>
	</div>
	</div>

	{includePart parts/breadcrumbs}

</div>




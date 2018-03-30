{var $type = isset($elements->unsortable["page-title"]->option->type) ? $elements->unsortable["page-title"]->option->type : 'standard'}

{var $shareUrl 				= ""}
{var $shareTitle 			= ""}
{var $shareImage 			= ""}
{var $shareDescription		= ""}
{var $twitterReferral       = ""}


{foreach array_filter((array) $options->theme->social->socIcons) as $icon}
	{if AitUtils::contains($icon->url, 'twitter')}
		{var $search = array('https', 'http', 'www.twitter.com/', 'twitter.com/', 't.co/')}
		{var $twitterReferral = str_replace($search, '', $icon->url)}
	{/if}
{/foreach}




{if $wp->isPage or $wp->isSingular(post) or $wp->isSingular(portfolio-item) or $wp->isSingular(event) or $wp->isSingular(job-offer) or $wp->isSingular(doc) or $wp->isSingular(theme) or $wp->isSingular(item)}
	{loop as $post}
		{var $shareUrl 			= $post->permalink}
		{var $shareTitle 		= $post->title}
		{var $shareImage 		= isset($post->ID) ? wp_get_attachment_url(get_post_thumbnail_id($post->ID)) : wp_get_attachment_url(get_post_thumbnail_id($post->id))}
		{var $shareDescription	= substr(strip_tags($post->excerpt), 0, 100)}

		{if $type == 'theme' && $wp->isPage}
			{customQuery as $query, id => $elements->unsortable["page-title"]->option->theme, type => 'theme'}
			{if $query->havePosts}
				{customLoop from $query as $item}
					{var $shareTitle 		= $item->meta('theme')->subtitle}
					{var $shareDescription 	= strip_tags($item->content)}
					{var $shareImage 		= $item->imageUrl}
				{/customLoop}
			{/if}
		{/if}

	{/loop}
{elseif $wp->isAuthor}
	{var $qobj = get_queried_object()}
	{if $qobj and isset($qobj->ID)}
		{var $shareUrl 				= get_author_posts_url( $qobj->ID )}
		{var $shareTitle 			= get_the_author_meta( 'display_name', $qobj->ID )}
		{var $shareDescription		= get_the_author_meta( 'description', $qobj->ID )}
	{/if}
{elseif $wp->isCategory or $wp->isTax('items') or $wp->isTax('locations')}
	{var $qobj = get_queried_object()}
	{if $qobj and isset($qobj->term_id)}
		{var $shareUrl 				= get_category_link(intval($qobj->term_id))}
		{var $shareTitle 			= $qobj->name}
		{var $shareDescription		= $qobj->description}
	{/if}
{else}
	{if AitWoocommerce::enabled()}
		{if AitWoocommerce::currentPageIs('shop')}
			{var $shareUrl 				= get_permalink( woocommerce_get_page_id( 'shop' ) )}
			{capture $shareTitle}{? woocommerce_page_title()}{/capture}
			{var $shareDescription		= ''}
		{else}
			{var $qobj = get_queried_object()}
			{if $qobj and isset($qobj->ID)}
				{var $shareUrl 				= get_permalink($qobj->ID)}
				{var $shareTitle 			= get_the_title($qobj->ID)}
				{var $shareDescription		= ''}
			{/if}
		{/if}
	{else}
		{var $qobj = get_queried_object()}
		{if $qobj and isset($qobj->ID)}
			{var $shareUrl 				= get_permalink($qobj->ID)}
			{var $shareTitle 			= get_the_title($qobj->ID)}
			{var $shareDescription		= ''}
		{/if}
	{/if}
{/if}

{* OVERRIDE BY SEO ELEMENT *}
	{var $SEOOptions = $elements->unsortable["seo"]->option}

	{if isset($SEOOptions->title) && $SEOOptions->title != ""}
		{var $shareTitle = $SEOOptions->title}
	{/if}
	{if isset($SEOOptions->description) && $SEOOptions->description != ""}
		{var $shareDescription 	= substr($SEOOptions->description, 0, 80)}
	{/if}
{* OVERRIDE BY SEO ELEMENT *}

{* PREPARE FOR SHARE
{var $strFind = array("&")}
{var $strReplace = array("and")}
{var $shareTitle = urlencode(str_replace($strFind, $strReplace, $shareTitle))}
PREPARE FOR SHARE *}

{if $showShare and $shareUrl and $shareTitle}
<div class="page-title-social">
	<div class="page-share">

		<ul class="share-icons">

			<li class="share-facebook">
				<a href="#" onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u={!$shareUrl}', '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<i class="fa fa-facebook"></i>
				</a>
			</li><li class="share-twitter">
				<a href="#" onclick="javascript:window.open('https://twitter.com/intent/tweet?text={!rawurlencode($shareTitle)}&amp;url={!$shareUrl}&amp;via={!$twitterReferral}', '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
					<i class="fa fa-twitter"></i>
				</a>
			</li><li class="share-gplus">
				<a href="#" onclick="javascript:window.open('https://plus.google.com/share?url={!$shareUrl}', '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
					<i class="fa fa-google-plus"></i>
				</a>
			</li>

		</ul>

		<div class="share-text">
			{!__ '<span class="title">Share</span> <span class="subtitle">this page</span>'}
		</div>


	</div>
</div>
{/if}
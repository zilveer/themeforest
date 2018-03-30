{var $currentCategory = get_term_by( 'slug', get_query_var($taxonomy), $taxonomy)}
{var $parentCategory = $currentCategory != false ? $currentCategory->term_id : 0}
{var $categories = $wp->categories(array('taxonomy' => $taxonomy, 'hide_empty' => 0, 'parent' => $parentCategory))}

{var $style = ""}
{var $bg    = $taxonomy == 'ait-events-pro' ?: false}

{if isset($categories) && count($categories) > 0}
	{var $columns = $options->theme->items->categoryColumns}
	<div class="categories-container">
		{if isset($gridMain)}
		<div class="grid-main">
		{/if}
		<div class="content">
			{* count missing boxes *}
			{var $missingCount = ( ceil( count($categories) / $columns ) * $columns ) - count($categories)}
			{* count missing boxes *}
			<ul n:class='"column-{$columns}",'><!--
			{foreach $categories as $category}
				{var $title = $category->title}
				{var $desc = $category->description}
				{var $link = get_term_link( $category->id, $category->taxonomy )}
				{var $icons = get_option($category->taxonomy . "_category_" . $category->id)}
				{var $icon = ""}

				{if isset($icons['icon']) && $icons['icon'] != ""}
					{var $icon = $icons['icon']}
				{else}
					{if $category->parentId != 0}
						{var $parent = get_term($category->parentId, $taxonomy)}
						{var $icons = get_option($parent->taxonomy . "_category_" . $parent->term_id)}
						{if isset($icons['icon']) && $icons['icon'] != ""}
							{var $icon = $icons['icon']}
						{else}
							{if $taxonomy == "ait-items"}
							{var $icon = $options->theme->items->categoryDefaultIcon}
							{else}
							{var $icon = $options->theme->items->locationDefaultIcon}
							{/if}
						{/if}
					{else}
						{if $taxonomy == "ait-items"}
						{var $icon = $options->theme->items->categoryDefaultIcon}
						{else}
						{var $icon = $options->theme->items->locationDefaultIcon}
						{/if}
					{/if}
				{/if}

				{if $bg}
					{var $iconColor = !empty($icons['icon_color']) ? $icons['icon_color'] : ""}
					{if !empty($iconColor)}
						{var $style = 'style="background: '.$iconColor.';"'}
					{/if}
				{/if}

				--><li n:class="$title ? 'has-title', $icon ? 'has-icon'">
					<a href="{$link}">
						<div class="cat-hdr">
							<span class="cat-ico{if $bg} has-bg{/if}"><img src="{$icon}" alt="icon" {!$style}></span>
							<span class="cat-ttl">{!$title}</span>
						</div>
						{if $desc}
						<div class="cat-desc txtrows-3">
							{!$desc|trimWords: 50}
						</div>
						{/if}
					</a>
				</li><!--
			{/foreach}
				{if $missingCount != 0}
				--><li class="empty-box-{$missingCount}"></li><!--
				{/if}
			--></ul>
		</div>
		{if isset($gridMain)}
		</div>
		{/if}
	</div>
{/if}

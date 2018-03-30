{if defined('WPSEO_VERSION')}
	<title>{title '|', true, right}</title>
{elseif isset($elements->unsortable['seo'])}
	{if $elements->unsortable[seo]->display}
		{if $elements->unsortable[seo]->option->keywords != ""}
			<meta name="keywords" content="{$elements->unsortable[seo]->option->keywords}">
		{/if}
		{if $elements->unsortable[seo]->option->description != ""}
			<meta name="description" content="{$elements->unsortable[seo]->option->description}">
		{/if}
		{if $elements->unsortable[seo]->option->title != ""}
			<title>{$elements->unsortable[seo]->option->title}</title>
		{else}
			<title>{title '|', true, right}</title>
		{/if}
	{else}
		<title>{title '|', true, right}</title>
	{/if}
{else}
	<title>{title '|', true, right}</title>
	{if $wp->isTax(items) or $wp->isTax(locations)}
		{var $category = get_queried_object()}
		{var $cOptions = get_option($category->taxonomy."_category_".$category->term_id)}
		{if $category->description}<meta name="description" content="{$category->description|truncate:150}">{/if}
		{if isset($cOptions['keywords']) && $cOptions['keywords']}<meta name="keywords" content="{$cOptions['keywords']}">{/if}
	{/if}
{/if}

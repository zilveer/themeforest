{var $terms = get_the_terms($itemID, $taxonomy)}
{var $eventOptions = get_option('ait_events_pro_options', array())}
{var $counter = 0}
{if $terms}
	{var $listedParents = array()}
	{if isset($wrapper)}
		<div class="event-taxonomy-icon-wrap">
	{/if}

	{foreach $terms as $category}
		{var $icons = get_option($category->taxonomy . "_category_" . $category->term_id)}

		{if isset($onlyParent)}

			{var $categoryParent = $category->parent}

			{if !in_array($categoryParent, $listedParents)}
				{if $categoryParent != 0}
					{var $icons = get_option($category->taxonomy . "_category_" . $categoryParent)}
					{var $category = get_term($categoryParent, $category->taxonomy)}
				{/if}

				{if !in_array($category->term_id, $listedParents)}

					{if isset($icons['icon']) && $icons['icon'] != ""}
						{capture $categoryIcon}
							{$icons['icon']}
						{/capture}
					{else}
						{capture $categoryIcon}
							{if $category->taxonomy == $taxonomy}
							{$eventOptions['categoryDefaultIcon']}
							{else}
							{$options->theme->items->locationDefaultIcon}
							{/if}
						{/capture}
					{/if}

					{var $iconColor = !empty($icons['icon_color']) ? $icons['icon_color'] : ""}
					{var $style = ""}
					{if !empty($iconColor)}
						{var $style = 'style="background: '.$iconColor.';"'}
					{/if}


						<a href="{get_term_link($category->term_id, $category->taxonomy)}" class="taxonomy-icon"  {!$style}>
							{if isset($categoryIcon)}
								<img src="{$categoryIcon}" alt="{!$category->name}">
							{/if}
							<div class="taxonomy-wrap">
								<div class="taxonomy-name">{!$category->name}</div>
							</div>
						</a>


					{var $listedParents[] = $category->term_id}

					{var $counter++}

				{/if}

				{if isset($count) and ($count === $counter)}
					{? break}
				{/if}
			{/if}

		{elseif isset($onlyChild)}

			{if $category->parent != 0}
				{var $counter = $iterator->counter}

				{if isset($icons['icon']) && $icons['icon'] != ""}
					{capture $categoryIcon}
						{$icons['icon']}
					{/capture}
				{else}
					{? global $wp_query}
					{var $categoryParent = get_term($category->parent, $category->taxonomy)}
					{var $icons = get_option($categoryParent->taxonomy . "_category_" . $categoryParent->term_id)}
					{if isset($icons['icon']) && $icons['icon'] != ""}
						{capture $categoryIcon}
							{$icons['icon']}
						{/capture}
					{else}
						{capture $categoryIcon}
							{if $categoryParent->taxonomy == $taxonomy}
							{$eventOptions['categoryDefaultIcon']}
							{else}
							{$options->theme->items->locationDefaultIcon}
							{/if}
						{/capture}
					{/if}
				{/if}

				{var $iconColor = !empty($icons['icon_color']) ? $icons['icon_color'] : ""}
				{var $style = ""}
				{if !empty($iconColor)}
					{var $style = 'style="background: '.$iconColor.';"'}
				{/if}

				<li class="has-title has-icon">
					<a href="{get_term_link($category->term_id, $category->taxonomy)}" {!$style}>
						{if isset($categoryIcon)}
							<img src="{$categoryIcon}" alt="{!$category->name}">
						{/if}
						<span>{!$category->name}</span>
					</a>
				</li>

				{if isset($count) and ($count === $counter)}
					{? break}
				{/if}
			{/if}

		{else}

			{var $counter = $iterator->counter}

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
							{if $category->taxonomy == $taxonomy}
							{$eventOptions['categoryDefaultIcon']}
							{else}
							{$options->theme->items->locationDefaultIcon}
							{/if}
						{/capture}
					{/if}
				{else}
					{capture $categoryIcon}
						{if $category->taxonomy == $taxonomy}
						{$eventOptions['categoryDefaultIcon']}
						{else}
						{$options->theme->items->locationDefaultIcon}
						{/if}
					{/capture}
				{/if}
			{/if}

			{var $iconColor = !empty($icons['icon_color']) ? $icons['icon_color'] : ""}
			{var $style = ""}
			{if !empty($iconColor)}
				{var $style = 'style="background: '.$iconColor.';"'}
			{/if}

			<a href="{get_term_link($category->term_id, $category->taxonomy)}" class="taxonomy-icon"  {!$style}>
				{if isset($categoryIcon)}
				<img src="{$categoryIcon}" alt="{!$category->name}">
				{/if}
				<div class="taxonomy-wrap">
					<div class="taxonomy-name">{!$category->name}</div>
				</div>
			</a>

			{if isset($count) and ($count === $counter)}
				{? break}
			{/if}

		{/if}

	{/foreach}
	{if isset($wrapper)}
	</div>
	{/if}
{/if}

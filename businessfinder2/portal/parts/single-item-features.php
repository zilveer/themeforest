{if $meta->displayFeatures}

	{if !is_array($meta->features)}
		{var $meta->features = array()}
	{/if}

	{if defined('AIT_ADVANCED_FILTERS_ENABLED')}
		{var $item_meta_filters = $post->meta('filters-options')}
		{if is_array($item_meta_filters->filters) && count($item_meta_filters->filters) > 0}
			{var $custom_features = array()}
			{foreach $item_meta_filters->filters as $filter_id}
				{var $filter_data = get_term($filter_id, 'ait-items_filters', "OBJECT")}
				{if $filter_data}
					{var $filter_meta = get_option( "ait-items_filters_category_".$filter_data->term_id )}
					{var $filter_icon = isset($filter_meta['icon']) ? $filter_meta['icon'] : ""}
					{? array_push($meta->features, array(
						"icon" => $filter_icon,
						"text" => $filter_data->name,
						"desc" => $filter_data->description
					))}
				{/if}
			{/foreach}
		{/if}
	{/if}

	{if !empty($meta->features)}
		{var $displayDesc = $settings->featuresDisplayDesc}
		<div n:class='features-container'>
			<h2>{__ 'Our Useful Features & Services'}</h2>
			<div class="content">
				{foreach $meta->features as $feature}
					{var $hasImage = $feature['icon'] != '' ? true : false}
					{var $hasTitle = $feature['text'] != '' ? true : false}
					{var $hasText = !empty($feature['desc']) ? true : false}

					{var $icon = isset($feature['icon']) && $feature['icon'] != "" ? $feature['icon'] : 'fa-info'}
					<div n:class='feature-container, "feature-{$iterator->counter}", $displayDesc ? desc-on : desc-off, $hasTitle ? has-title, $hasText ? has-text'>
						<div class="feature-icon">
							<i class="fa {$icon}"></i>
						</div>
						<div class="feature-data">
							{if $feature['text']}<h4>{!$feature['text']}</h4>{/if}
							{if $displayDesc and !empty($feature['desc'])}
							<div class="feature-desc">
								<p>{!$feature['desc']}</p>
							</div>
							{/if}
						</div>
					</div>
				{/foreach}
			</div>
		</div>
	{/if}
{/if}

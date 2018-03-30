<?php

final class MAD_WOOF_HELPER {

	public static function is_active_widget_displayed() {
		if ( is_active_widget( false, false, 'mad-widget-woof-filter', true ) ) {
			return true;
		} else {
			return false;
		}
	}

	public static function get_terms($taxonomy, $hide_empty = true, $get_childs = true, $selected = 0, $category_parent = 0)
	{
		static $collector = array();

		if (isset($collector[$taxonomy]))
		{
			return $collector[$taxonomy];
		}

		$args = array(
			'orderby' => 'name',
			'order' => 'ASC',
			'style' => 'list',
			'show_count' => 0,
			'hide_empty' => $hide_empty,
			'use_desc_for_title' => 1,
			'child_of' => 0,
			'hierarchical' => true,
			'title_li' => '',
			'show_option_none' => '',
			'number' => '',
			'echo' => 0,
			'depth' => 0,
			'current_category' => $selected,
			'pad_counts' => 0,
			'taxonomy' => $taxonomy,
			'walker' => 'Walker_Category');


		//WPML compatibility
		if (class_exists('SitePress'))
		{
			$args['lang'] = ICL_LANGUAGE_CODE;
		}

		$cats_objects = get_categories($args);

		$cats = array();
		if (!empty($cats_objects))
		{
			foreach ($cats_objects as $value)
			{
				if (is_object($value) AND $value->category_parent == $category_parent)
				{
					$cats[$value->term_id] = array();
					$cats[$value->term_id]['term_id'] = $value->term_id;
					$cats[$value->term_id]['slug'] = $value->slug;
					$cats[$value->term_id]['taxonomy'] = $value->taxonomy;
					$cats[$value->term_id]['name'] = $value->name;
					$cats[$value->term_id]['count'] = $value->count;
					$cats[$value->term_id]['parent'] = $value->parent;
					if ($get_childs)
					{
						$cats[$value->term_id]['childs'] = self::assemble_terms_childs($cats_objects, $value->term_id);
					}
				}
			}
		}

		$collector[$taxonomy] = $cats;
		return $cats;
	}

	private static function assemble_terms_childs($cats_objects, $parent_id)
	{
		$res = array();
		foreach ($cats_objects as $value)
		{
			if ($value->category_parent == $parent_id)
			{
				$res[$value->term_id]['term_id'] = $value->term_id;
				$res[$value->term_id]['name'] = $value->name;
				$res[$value->term_id]['slug'] = $value->slug;
				$res[$value->term_id]['count'] = $value->count;
				$res[$value->term_id]['taxonomy'] = $value->taxonomy;
				$res[$value->term_id]['parent'] = $value->parent;
				$res[$value->term_id]['childs'] = self::assemble_terms_childs($cats_objects, $value->term_id);
			}
		}

		return $res;
	}

	public static function wpml_translate($taxonomy_info, $string = '')
	{
		if (empty($string))
		{
			$string = $taxonomy_info->label;
		}

		$check_for_custom_label = false;
		if (class_exists('SitePress'))
		{
			$lang = ICL_LANGUAGE_CODE;
			$woof_settings = get_option('mad_woof_settings');
			if (isset($woof_settings['wpml_tax_labels']) AND ! empty($woof_settings['wpml_tax_labels'])) {
				$translations = $woof_settings['wpml_tax_labels'];


				if (isset($translations[$lang]))
				{
					if (isset($translations[$lang][$string]))
					{
						$string = $translations[$lang][$string];
					}
				}
			} else
			{
				$check_for_custom_label = TRUE;
			}
		} else
		{
			$check_for_custom_label = TRUE;
		}

		//+++
		if (!empty($string))
		{
			$check_for_custom_label = false;
		}
		//+++

		if ($check_for_custom_label)
		{
			global $WOOF;
			if (isset($WOOF->settings['custom_tax_label'][$taxonomy_info->name]) AND ! empty($WOOF->settings['custom_tax_label'][$taxonomy_info->name]))
			{
				$string = $WOOF->settings['custom_tax_label'][$taxonomy_info->name];
			}
		}

		return $string;
	}

	public function get_request_data()
	{
		return $_GET;
	}

	public function is_isset_in_request_data($key)
	{
		$request = $this->get_request_data();
		return isset($request[$key]);
	}

	public function price_filter()
	{
		global $_chosen_attributes, $wpdb, $wp, $MAD_WOOF;
		$request = $MAD_WOOF->get_request_data();

		$min_price = $this->is_isset_in_request_data('min_price') ? esc_attr($request['min_price']) : '';
		$max_price = $this->is_isset_in_request_data('max_price') ? esc_attr($request['max_price']) : '';

		$fields = '';

		if (get_search_query())
		{
			$fields .= '<input type="hidden" name="s" value="' . get_search_query() . '" />';
		}

		if (!empty($_GET['post_type']))
		{
			$fields .= '<input type="hidden" name="post_type" value="' . esc_attr($_GET['post_type']) . '" />';
		}

		if (!empty($_GET['product_cat']))
		{
			$fields .= '<input type="hidden" name="product_cat" value="' . esc_attr($_GET['product_cat']) . '" />';
		}

		if (!empty($_GET['product_tag']))
		{
			$fields .= '<input type="hidden" name="product_tag" value="' . esc_attr($_GET['product_tag']) . '" />';
		}

		if (!empty($_GET['orderby']))
		{
			$fields .= '<input type="hidden" name="orderby" value="' . esc_attr($_GET['orderby']) . '" />';
		}

		if ($_chosen_attributes)
		{
			foreach ($_chosen_attributes as $attribute => $data)
			{
				$taxonomy_filter = 'filter_' . str_replace('pa_', '', $attribute);

				$fields .= '<input type="hidden" name="' . esc_attr($taxonomy_filter) . '" value="' . esc_attr(implode(',', $data['terms'])) . '" />';

				if ('or' == $data['query_type'])
				{
					$fields .= '<input type="hidden" name="' . esc_attr(str_replace('pa_', 'query_type_', $attribute)) . '" value="or" />';
				}
			}
		}

		if (0 === sizeof(WC()->query->layered_nav_product_ids))
		{
			$min = floor($wpdb->get_var(
				$wpdb->prepare('
					SELECT min(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key IN ("' . implode('","', apply_filters('woocommerce_price_filter_meta_keys', array('_price', '_min_variation_price'))) . '")
					AND meta_value != ""
				', $wpdb->posts, $wpdb->postmeta)
			));
			$max = ceil($wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key IN ("' . implode('","', apply_filters('woocommerce_price_filter_meta_keys', array('_price'))) . '")
				', $wpdb->posts, $wpdb->postmeta, '_price')
			));
		} else
		{
			$min = floor($wpdb->get_var(
				$wpdb->prepare('
					SELECT min(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key IN ("' . implode('","', apply_filters('woocommerce_price_filter_meta_keys', array('_price', '_min_variation_price'))) . '")
					AND meta_value != ""
					AND (
						%1$s.ID IN (' . implode(',', array_map('absint', WC()->query->layered_nav_product_ids)) . ')
						OR (
							%1$s.post_parent IN (' . implode(',', array_map('absint', WC()->query->layered_nav_product_ids)) . ')
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta
				)));
			$max = ceil($wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key IN ("' . implode('","', apply_filters('woocommerce_price_filter_meta_keys', array('_price'))) . '")
					AND (
						%1$s.ID IN (' . implode(',', array_map('absint', WC()->query->layered_nav_product_ids)) . ')
						OR (
							%1$s.post_parent IN (' . implode(',', array_map('absint', WC()->query->layered_nav_product_ids)) . ')
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta
				)));
		}

		if ($min == $max)
		{
			return;
		}


		if ('' == get_option('permalink_structure'))
		{
			$form_action = remove_query_arg(array('page', 'paged'), add_query_arg($wp->query_string, '', home_url($wp->request)));
		} else
		{
			$form_action = preg_replace('%\/page/[0-9]+%', '', home_url(trailingslashit($wp->request)));
		}

		echo '<form method="get" action="' . esc_url($form_action) . '">
			<div class="price_slider_wrapper">
				<div class="price_slider" style="display:none;"></div>
				<div class="price_slider_amount">
					<input type="text" id="min_price" name="min_price" value="' . esc_attr($min_price) . '" data-min="' . esc_attr(apply_filters('woocommerce_price_filter_widget_amount', $min)) . '" placeholder="' . __('Min price', 'woocommerce') . '" />
					<input type="text" id="max_price" name="max_price" value="' . esc_attr($max_price) . '" data-max="' . esc_attr(apply_filters('woocommerce_price_filter_widget_amount', $max)) . '" placeholder="' . __('Max price', 'woocommerce') . '" />
					<button type="submit" class="button">' . __('Filter', 'woocommerce') . '</button>
					<div class="price_label" style="display:none;">
						' . __('Price:', 'woocommerce') . ' <span class="from"></span> &mdash; <span class="to"></span>
					</div>
					' . $fields . '
					<div class="clear"></div>
				</div>
			</div>
		</form>';
	}

}
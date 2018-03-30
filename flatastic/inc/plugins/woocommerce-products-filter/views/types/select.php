<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$collector = array();
$_REQUEST['additional_taxes'] = $additional_taxes;

if (!function_exists('woof_draw_select_childs'))
{

	function woof_draw_select_childs(&$collector, $taxonomy_info, $tax_slug, $childs, $level, $show_count)
	{
		global $MAD_WOOF;
		$request = $MAD_WOOF->get_request_data();

		$current_request = array();
		if ($MAD_WOOF->is_isset_in_request_data($tax_slug))
		{
			$current_request = $request[$tax_slug];
			$current_request = explode(',', urldecode($current_request));
		}
		?>
		<?php foreach ($childs as $term) : ?>

		<?php
		$count_string = "";
		$count = 0;

		if (!in_array($term['slug'], $current_request)) {

			if ($show_count) {
				$count = $MAD_WOOF->dynamic_count($term, 'select', $_REQUEST['additional_taxes']);
				$count_string = ' (' . $count . ')';
			}

		}

		?>
		<option class="level-<?php echo esc_attr($level) ?>" <?php if ($show_count AND $count == 0 AND ! in_array($term['slug'], $current_request)): ?>disabled=""<?php endif; ?> value="<?php echo $term['slug'] ?>" <?php echo selected(in_array($term['slug'], $current_request)) ?>><?php
			if (has_filter('woof_before_term_name')) {
				echo apply_filters('woof_before_term_name', $term, $taxonomy_info);
			} else {
				echo $term['name'];
			}
			?> <?php echo $count_string ?>
		</option>
		<?php

		if (!isset($collector[$tax_slug])) {
			$collector[$tax_slug] = array();
		}

		$collector[$tax_slug][] = array('name' => $term['name'], 'slug' => $term['slug']);

		if (!empty($term['childs'])) {
			woof_draw_select_childs($collector, $taxonomy_info, $tax_slug, $term['childs'], $level + 1, $show_count, $hide_dynamic_empty_pos);
		}
		?>
	<?php endforeach; ?>
		<?php
	}

}
?>
	<select class="mad_woof_select" name="<?php echo $tax_slug ?>">

		<option value="0"><?php echo MAD_WOOF_HELPER::wpml_translate($taxonomy_info) ?></option>

		<?php
		$woof_tax_values = array();
		$current_request = array();
		$request = $this->get_request_data();
		if ($this->is_isset_in_request_data($tax_slug)) {
			$current_request = $request[$tax_slug];
			$current_request = explode(',', urldecode($current_request));
		}

		$hidden_terms = array();
		if (isset($this->settings['excluded_terms'][$tax_slug])) {
			$hidden_terms = explode(',', $this->settings['excluded_terms'][$tax_slug]);
		}

		?>
		<?php foreach ($terms as $term): ?>

			<?php
			$count_string = "";
			$count = 0;

			if (!in_array($term['slug'], $current_request)) {
				if ($show_count) {
					$count = $this->dynamic_count($term, 'select', $_REQUEST['additional_taxes']);
					$count_string = ' (' . $count . ')';
				}

			}

			if (in_array($term['term_id'], $hidden_terms)) { continue; }

			?>

			<option <?php if ($show_count AND $count == 0 AND ! in_array($term['slug'], $current_request)): ?>disabled=""<?php endif; ?> value="<?php echo $term['slug'] ?>" <?php echo selected(in_array($term['slug'], $current_request)) ?>><?php
				if (has_filter('woof_before_term_name')) {
					echo apply_filters('woof_before_term_name', $term, $taxonomy_info);
				} else {
					echo $term['name'];
				}
				?><?php echo $count_string ?>
			</option>

			<?php
			if (!isset($collector[$tax_slug])) {
				$collector[$tax_slug] = array();
			}

			$collector[$tax_slug][] = array('name' => $term['name'], 'slug' => $term['slug']);

			if (!empty($term['childs'])) {
				woof_draw_select_childs($collector, $taxonomy_info, $tax_slug, $term['childs'], 1, $show_count);
			}
			?>
		<?php endforeach; ?>
	</select>



<?php
//this is for woof_products_top_panel
if (!empty($collector)) {
	foreach ($collector as $ts => $values) {
		if (!empty($values)) {
			foreach ($values as $value) {
				?>
				<input type="hidden" value="<?php echo $value['name'] ?>" class="woof_n_<?php echo $ts ?>_<?php echo $value['slug'] ?>" />
				<?php
			}
		}
	}
}

//we need it only here, and keep it in $_REQUEST for using in function for child items
unset($_REQUEST['additional_taxes']);



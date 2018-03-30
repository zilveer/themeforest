<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
	<ul class="woof_list woof_list_color">
		<?php
		$woof_tax_values = array();
		$current_request = array();
		$request = $this->get_request_data();
		$_REQUEST['additional_taxes'] = $additional_taxes;

		if ($this->is_isset_in_request_data($tax_slug)) {
			$current_request = (!empty($request[$tax_slug])) ? $request[$tax_slug] : '';
			$current_request = explode(',', urldecode($current_request));
		}

		//excluding hidden terms
		$hidden_terms = array();
		if (isset($this->settings['excluded_terms'][$tax_slug])) {
			$hidden_terms = explode(',', $this->settings['excluded_terms'][$tax_slug]);
		}
		?>
		<?php foreach ($terms as $term) : $inique_id = uniqid(); ?>
			<?php
			$count_string = "";
			$count = 0;

			if (!in_array($term['slug'], $current_request)) {

				if ($show_count) {
					$count = $this->dynamic_count($term, 'color', $_REQUEST['additional_taxes']);
					$count_string = ' <span>(' . $count . ')</span>';
				}

				if ($count == 0) { continue; }

			}

			$color = '#000000';
			if (isset($colors[$term['slug']])) {
				$color = $colors[$term['slug']];
			}

			//excluding hidden terms
			if (in_array($term['term_id'], $hidden_terms)) { continue; }

			?>
			<li class="woof_color_term_<?php echo sanitize_title($color) ?>">
				<input type="checkbox" id="<?php echo 'woof_' . $term['term_id'] . '_' . $inique_id ?>" class="woof_color_term" data-name="<?php echo $term['name'] ?>" data-color="<?php echo $color ?>" data-tax="<?php echo $tax_slug ?>" name="<?php echo $term['slug'] ?>" value="<?php echo $term['term_id'] ?>" <?php echo checked(in_array($term['slug'], $current_request)) ?> />
				<input type="hidden" value="<?php echo $term['name'] ?>" class="woof_n_<?php echo $tax_slug ?>_<?php echo $term['slug'] ?>" />
			</li>
		<?php endforeach; ?>
	</ul>
	<div style="clear: both;"></div>
<?php
//we need it only here, and keep it in $_REQUEST for using in function for child items
unset($_REQUEST['additional_taxes']);

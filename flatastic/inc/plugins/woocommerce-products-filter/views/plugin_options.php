<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div class="subsubsub_section">

	<br class="clear" />

	<div class="section">

		<?php woocommerce_admin_fields($this->get_options()); ?>

		<hr />

		<?php
		global $wpdb;

		$charset_collate = '';
		if (method_exists($wpdb, 'has_cap') AND $wpdb->has_cap('collation'))
		{
			if (!empty($wpdb->charset))
			{
				$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
			}
			if (!empty($wpdb->collate))
			{
				$charset_collate .= " COLLATE $wpdb->collate";
			}
		}
		//***
		$sql = "CREATE TABLE IF NOT EXISTS `" . MAD_WOOF::$query_cache_table . "` (
                                    `mkey` text NOT NULL,
                                    `mvalue` text NOT NULL
                                  ){$charset_collate}";

		if ($wpdb->query($sql) === false) {
			?>
			<p class="description"><?php _e("WOOF cannot create the database table! Make sure that your mysql user has the CREATE privilege! Do it manually using your host panel&phpmyadmin!", 'flatastic') ?></p>
			<code><?php echo $sql; ?></code>
			<?php
			echo $wpdb->last_error;
		}

		?>

		<a href="#" class="button-secondary js_cache_count_data_clear"><?php _e("Clear Cache", 'flatastic') ?></a>

		<hr />

		<ul id="mad_woof_options" class="mad_woof_options">

			<?php

			$items_order = array();
			$taxonomies = $this->get_taxonomies();
			$taxonomies_keys = array_keys($taxonomies);

			if (isset($mad_woof_settings['items_order']) AND ! empty($mad_woof_settings['items_order'])) {
				$items_order = explode(',', $mad_woof_settings['items_order']);
			} else {
				$items_order = array_merge($this->items_keys, $taxonomies_keys);
			}

			foreach (array_merge($this->items_keys, $taxonomies_keys) as $key) {
				if (!in_array($key, $items_order)) {
					$items_order[] = $key;
				}
			}

			foreach ($items_order as $key) {
				if (in_array($key, $this->items_keys)) {
					mad_woof_print_item_by_key($key, $mad_woof_settings);
				} else {
					mad_woof_print_tax($key, $taxonomies[$key], $mad_woof_settings);
				}
			}

			?>

		</ul><!--/ #woof_options-->

	</div><!--/ .section-->

	<input type="hidden" name="mad_woof_settings[items_order]" value="<?php echo @$mad_woof_settings['items_order'] ?>" />

</div><!--/ .subsubsub_section-->



<?php

function mad_woof_print_tax($key, $tax, $mad_woof_settings) {
	$nonce = wp_create_nonce('mad_woof_select_type');

	global $MAD_WOOF;
	?>

	<li data-key="<?php echo $key ?>">

		<a href="#" class="help_tip" data-tip="<?php esc_html_e("drag and drop", 'flatastic'); ?>"><img style="width: 22px; vertical-align: middle;" src="<?php echo MAD_WOOF_LINK ?>img/move.png" alt="<?php _e("move", 'flatastic'); ?>" /></a>&nbsp;

		<select name="mad_woof_settings[tax_type][<?php echo $key ?>]" class="mad_woof_select_type" data-nonce="<?php echo esc_attr($nonce) ?>" data-attribute="<?php echo $key ?>" data-id="[tax_type][<?php echo $key ?>]">
			<?php foreach ($MAD_WOOF->html_types as $type => $type_text) : ?>
				<option value="<?php echo esc_attr($type) ?>" <?php if (isset($mad_woof_settings['tax_type'][$key])) echo selected($mad_woof_settings['tax_type'][$key], $type) ?>><?php echo $type_text ?></option>
			<?php endforeach; ?>
		</select>

		<img class="help_tip" data-tip="<?php esc_html_e('View of the taxonomies terms on the front', 'flatastic') ?>" src="<?php echo WP_PLUGIN_URL ?>/woocommerce/assets/images/help.png" height="16" width="16" />&nbsp;

		<?php
		$excluded_terms = '';
		if (isset($mad_woof_settings['excluded_terms'][$key])) {
			$excluded_terms = $mad_woof_settings['excluded_terms'][$key];
		}
		?>
		<input type="text" style="width: 300px;" name="mad_woof_settings[excluded_terms][<?php echo esc_attr($key) ?>]" placeholder="<?php esc_html_e('excluded terms ids', 'flatastic') ?>" value="<?php echo $excluded_terms ?>" />&nbsp;<img class="help_tip" data-tip="<?php _e('If you want to exclude some current taxonomies terms from the searching at all! Example: 11,23,77', 'flatastic') ?>" src="<?php echo WP_PLUGIN_URL ?>/woocommerce/assets/images/help.png" height="16" width="16" />&nbsp;

		<input id="mad_woof_settings[tax][<?php echo esc_attr($key) ?>]" <?php echo(@in_array($key, @array_keys($MAD_WOOF->settings['tax'])) ? 'checked="checked"' : '') ?> type="checkbox" name="mad_woof_settings[tax][<?php echo esc_attr($key) ?>]" value="1" />
		<label for="mad_woof_settings[tax][<?php echo esc_attr($key) ?>]"><?php echo $tax->labels->name ?></label>

		<div class="mad_woof_placeholder" <?php if (@in_array($key, @array_keys($MAD_WOOF->settings['tax']))): ?>style="display: block"<?php endif; ?>>
			<?php
			if ($mad_woof_settings['tax_type'][$key] == 'color') {
				MAD_WOOF::attributes_table(
					$mad_woof_settings['tax_type'][$key],
					$key,
					$mad_woof_settings['colors'][$key]
				);
			} elseif ($mad_woof_settings['tax_type'][$key] == 'label') {
				MAD_WOOF::attributes_table(
					$mad_woof_settings['tax_type'][$key],
					$key,
					$mad_woof_settings['labels'][$key]
				);
			}
			?>
		</div><!--/ .mad_woof_placeholder-->

		<span class="spinner" style="display: none;"></span>

	</li>

	<?php
}


function mad_woof_print_item_by_key($key, $mad_woof_settings) {

	switch ($key) {
		case 'by_text': ?>
			<li data-key="<?php echo $key ?>">

				<?php
				$show = 0;
				if (isset($mad_woof_settings[$key]['show'])) {
					$show = $mad_woof_settings[$key]['show'];
				}
				?>

				<a href="#" class="help_tip" data-tip="<?php esc_html_e("drag and drop", 'flatastic'); ?>"><img style="width: 22px; vertical-align: middle;" src="<?php echo MAD_WOOF_LINK ?>img/move.png" alt="<?php _e("move", 'flatastic'); ?>" /></a>&nbsp;
				<img class="help_tip" data-tip="<?php _e('Show textinput for searching by products title', 'flatastic') ?>" src="<?php echo WP_PLUGIN_URL ?>/woocommerce/assets/images/help.png" height="16" width="16" />&nbsp;

				<input id="mad_woof_settings[<?php echo esc_attr($key) ?>][show]" <?php echo($show ? 'checked="checked"' : '') ?> type="checkbox" name="mad_woof_settings[<?php echo esc_attr($key) ?>][show]" value="1" />
				<label><?php _e("Search by Text", 'flatastic'); ?></label>

				<span class="spinner" style="display: none;"></span>

			</li>

			<?php

			break;
		case 'by_sku':
			?>
			<li data-key="<?php echo $key ?>">

				<?php
				$show = 0;
				if (isset($mad_woof_settings[$key]['show'])) {
					$show = $mad_woof_settings[$key]['show'];
				}
				?>

				<a href="#" class="help_tip" data-tip="<?php esc_html_e("drag and drop", 'flatastic'); ?>"><img style="width: 22px; vertical-align: middle;" src="<?php echo MAD_WOOF_LINK ?>img/move.png" alt="<?php _e("move", 'flatastic'); ?>" /></a>&nbsp;
				<img class="help_tip" data-tip="<?php _e('Show textinput for searching by products sku', 'flatastic') ?>" src="<?php echo WP_PLUGIN_URL ?>/woocommerce/assets/images/help.png" height="16" width="16" />&nbsp;

				<input id="mad_woof_settings[<?php echo esc_attr($key) ?>][show]" <?php echo($show ? 'checked="checked"' : '') ?> type="checkbox" name="mad_woof_settings[<?php echo esc_attr($key) ?>][show]" value="1" />
				<label><?php _e("Search by SKU", 'flatastic'); ?></label>

				<span class="spinner" style="display: none;"></span>

			</li>
			<?php
			break;
	}

}


?>





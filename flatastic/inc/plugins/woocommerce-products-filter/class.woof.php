<?php

if (!class_exists('MAD_WOOF')) {

	class MAD_WOOF {

		public $settings = array();
		public $version = '1.0.6';
		public $html_types = array(
			'checkbox' => 'Checkbox',
			'color' => 'Color',
			'label' => 'Label',
			'select' => 'Select'
		);
		public $items_keys = array(
			'by_text',
			'by_sku',
//			'by_price',
//			'by_author',
//			'by_instock',
//			'by_insales'
		);
		public static $query_cache_table = 'mad_woof_query_cache';
		private $session_rct_key = 'mad_woof_really_current_term';
		private $storage = null;
		private $storage_type = 'session';

		public function __construct() {

			global $wpdb;

			$this->init_settings();

			if (isset($this->settings['storage_type'])) {
				$this->storage_type = $this->settings['storage_type'];
			}

			$this->storage = new MAD_WOOF_STORAGE($this->storage_type);

			if (!defined('DOING_AJAX')) {
				global $wp_query;

				if (isset($wp_query->query_vars['taxonomy']) AND in_array($wp_query->query_vars['taxonomy'], get_object_taxonomies('product'))) {
					$this->set_really_current_term();
				}
			}

			$attribute_taxonomies = wc_get_attribute_taxonomies();

			set_transient('wc_attribute_taxonomies', $attribute_taxonomies);

			if (!empty($attribute_taxonomies) AND is_array($attribute_taxonomies)) {
				foreach ($attribute_taxonomies as $att)
				{
					add_filter("woocommerce_taxonomy_args_pa_{$att->attribute_name}", array($this, 'change_woo_att_data'));
				}
			}

			add_action('widgets_init', array($this, 'registerWidgets'));

		}

		public function init() {

			$first_init = (int) get_option('mad_woof_first_init');
			if ($first_init != 1) {
				update_option('mad_woof_first_init', 1);
				update_option('mad_woof_show_count', 1);
				update_option('mad_woof_checkboxes_slide', 1);
				update_option('mad_woof_show_reset', 1);
				update_option('mad_behavior', 'title');
			}

			add_action('woocommerce_settings_tabs_array', array($this, 'woocommerce_settings_tabs_array'), 50);
			add_action('woocommerce_settings_tabs_mad_woof', array($this, 'print_plugin_options'), 50);

			add_action('wp_enqueue_scripts', array($this, 'add_enqueue_scripts'), 1);

			add_action('wp_head', array($this, 'wp_head'), 999);

			add_filter('mad_woof_get_request_data', array($this, 'is_isset_in_request_data'));
			add_filter('woof_exclude_tax_key', array($this, 'woof_exclude_tax_key'));
			add_filter('woof_modify_query_args', array($this, 'woof_modify_query_args'), 1);

			add_filter('woocommerce_product_query', array($this, "woocommerce_product_query"), 9999);

			add_action('woocommerce_before_shop_loop', array($this, 'woocommerce_before_shop_loop'));
			add_action('woocommerce_after_shop_loop', array($this, 'woocommerce_after_shop_loop'));

			add_shortcode('mad_woof', array($this, 'woof_shortcode'));
			add_shortcode('mad_woof_products', array($this, 'woof_products'));
			add_shortcode('mad_woof_sku_filter', array($this, 'woof_sku_filter'));
			add_shortcode('mad_woof_text_filter', array($this, 'woof_text_filter'));

			add_action('wp_ajax_woof_draw_products', array($this, 'woof_draw_products'));
			add_action('wp_ajax_nopriv_woof_draw_products', array($this, 'woof_draw_products'));
			add_action('wp_ajax_woof_redraw_woof', array($this, 'woof_redraw_woof'));
			add_action('wp_ajax_nopriv_woof_redraw_woof', array($this, 'woof_redraw_woof'));

			add_action('wp_ajax_woof_cache_count_data_clear', array($this, 'cache_count_data_clear'));
			add_action('wp_ajax_mad_woof_select_type', array( $this, 'ajax_print_terms') );

	}

		public function registerWidgets() {
			register_widget('mad_woof_widget');
		}

		public function change_woo_att_data($taxonomy_data) {
			$taxonomy_data['query_var'] = true;
			return $taxonomy_data;
		}

		public function ajax_print_terms() {

			check_ajax_referer('mad_woof_select_type');

			$type = $_POST['value']; //'color'
			$attribute = $_POST['attribute']; // pa_color
			$return['content'] = $this->attributes_table(
				$type, $attribute, json_decode($_POST['value']), false
			);
			echo json_encode($return);
			die();
		}

		public function woocommerce_settings_tabs_array($tabs) {
			$tabs['mad_woof'] = esc_html__('Products Filter', 'flatastic');
			return $tabs;
		}

		public function add_enqueue_scripts() {

			if ( ! is_admin() ) {
				wp_enqueue_style(MAD_PREFIX . 'chosen-drop-down', MAD_WOOF_LINK . 'js/chosen/chosen.css' );
				wp_enqueue_script(MAD_PREFIX . 'chosen-drop-down', MAD_WOOF_LINK . 'js/chosen/chosen.jquery.min.js', array('jquery'), '', true );

				wp_enqueue_style(MAD_PREFIX . 'woof', MAD_WOOF_LINK . 'css/woof-front.css' );
				wp_enqueue_script(MAD_PREFIX . 'woof', MAD_WOOF_LINK . 'js/woof-front.js', array( 'jquery', MAD_PREFIX . 'woocommerce-mod' ), WC_VERSION, true );
			}

		}

		public function woof_shortcode($atts) {

			$args = array();

			if (isset($atts['taxonomies'])) {
				$args['additional_taxes'] = $atts['taxonomies'];
			} else {
				$args['additional_taxes'] = '';
			}

			$taxonomies = $this->get_taxonomies();
			$args['taxonomies'] = array();

			if (!empty($taxonomies)) {
				foreach ($taxonomies as $tax_key => $tax) {
					$args['mad_woof_settings'] = get_option('mad_woof_settings');
					$args['taxonomies_info'][$tax_key] = $tax;
					$args['taxonomies'][$tax_key] = MAD_WOOF_HELPER::get_terms($tax_key);
				}
			}

			if (isset($atts['autohide'])) {
				$args['autohide'] = $atts['autohide'];
			} else {
				$args['autohide'] = 0;
			}

			$args['show_woof_edit_view'] = 0;
			if (current_user_can('create_users')) {
				$args['show_woof_edit_view'] = 1;
			}
			return $this->render_html( MAD_WOOF_PATH . 'views/woof.php', $args );
		}

		public function woof_sku_filter($args = array()) {
			return $this->render_html( MAD_WOOF_PATH . 'views/shortcodes/woof_sku_filter.php', $args );
		}

		public function woof_text_filter($args = array()) {
			return $this->render_html( MAD_WOOF_PATH . 'views/shortcodes/woof_text_filter.php', $args );
		}

		public function print_plugin_options() {

			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('wp-color-picker');
			wp_enqueue_script(MAD_PREFIX . 'woof', MAD_WOOF_LINK . 'js/plugin_options.js', array( 'jquery' ) );
			wp_enqueue_style(MAD_PREFIX . 'woof', MAD_WOOF_LINK . 'css/plugin_options.css' );

			if (isset($_POST['mad_woof_settings'])) {

				WC_Admin_Settings::save_fields($this->get_options());

				if (class_exists('SitePress')) {
					$lang = ICL_LANGUAGE_CODE;
					if (isset($_POST['mad_woof_settings']['wpml_tax_labels']) AND ! empty($_POST['mad_woof_settings']['wpml_tax_labels'])) {
						$translations_string = $_POST['mad_woof_settings']['wpml_tax_labels'];
						$translations_string = explode(PHP_EOL, $translations_string);
						$translations = array();

						if (!empty($translations_string) AND is_array($translations_string)) {
							foreach ($translations_string as $line) {
								if (empty($line)) { continue; }

								$line = explode(':', $line);
								if (!isset($translations[$line[0]])) { $translations[$line[0]] = array(); }

								$tmp = explode('^', $line[1]);
								$translations[$line[0]][$tmp[0]] = $tmp[1];
							}
						}

						$_POST['mad_woof_settings']['wpml_tax_labels'] = $translations;
					}
				}
				update_option('mad_woof_settings', $_POST['mad_woof_settings']);
				$this->init_settings();
			}

			$args = array("mad_woof_settings" => get_option('mad_woof_settings'));
			echo $this->render_html(MAD_WOOF_PATH . 'views/plugin_options.php', $args);
		}

		private function init_settings() {
			$this->settings = get_option('mad_woof_settings', array());
		}

		private function get_taxonomies() {
			static $taxonomies = array();
			if (empty($taxonomies)) {
				$taxonomies = get_object_taxonomies('product', 'objects');
				unset($taxonomies['product_shipping_class']);
				unset($taxonomies['product_type']);
			}
			return $taxonomies;
		}

		public function wp_head() {

			global $wp_query;

			if (!isset($wp_query->query_vars['taxonomy']) AND !defined('DOING_AJAX')) {
				$this->set_really_current_term();
			}

			?>

			<script type="text/javascript">

				var mad_woof_is_permalink = <?php echo intval((bool) $this->is_permalink_activated()) ?>;

				var mad_woof_shop_page = "";
				<?php if (!$this->is_permalink_activated()): ?>
					mad_woof_shop_page = "<?php echo home_url('/?post_type=product'); ?>";
				<?php endif; ?>

				var mad_woof_really_curr_tax = {};
				var mad_swoof_search_slug = "<?php echo $this->get_swoof_search_slug(); ?>";
				var mad_woof_current_page_link = location.protocol + '//' + location.host + location.pathname;
					mad_woof_current_page_link = mad_woof_current_page_link.replace(/\page\/[0-9]/, "");

					<?php if (!isset($wp_query->query_vars['taxonomy']))  {

						$page_id = get_option('woocommerce_shop_page_id');

						if ($page_id > 0) {
							if (!$this->is_permalink_activated())  {
								$link = home_url('/?post_type=product');
							} else {
								$link = get_permalink($page_id);
							}
						}

						if (is_string($link) AND ! empty($link)) {
							?> mad_woof_current_page_link = "<?php echo $link ?>"; <?php
						}
					}

					if (!defined('DOING_AJAX') AND ! is_page()) {

						$request_data = $this->get_request_data();

						if (isset($wp_query->query_vars['taxonomy']) AND empty($request_data)) {

							$queried_obj = get_queried_object();

							if (is_object($queried_obj)) {
								$this->set_really_current_term($queried_obj);
								?>
								mad_woof_really_curr_tax = {term_id:<?php echo $queried_obj->term_id ?>, taxonomy: "<?php echo $queried_obj->taxonomy ?>"};
								<?php }

						}
					} else {
						if ($this->is_really_current_term_exists()) {
							$this->set_really_current_term();
						}
					}

				?>
					var mad_woof_current_values = '<?php echo json_encode($this->get_request_data()); ?>',
						mad_woof_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>",
						mad_woof_ajax_page_num =<?php echo ((get_query_var('page')) ? get_query_var('page') : 1) ?>,
						mad_woof_ajax_per_page = <?php echo mad_custom_get_option('woocommerce_product_count') ?>,
						mad_woof_ajax_order = 'desc',
						mad_woof_ajax_first_done = false;

					<?php if (isset($request_data['really_curr_tax'])): ?>
						<?php $tmp = explode('-', $request_data['really_curr_tax']); ?>
						mad_woof_really_curr_tax = {term_id:<?php echo $tmp[0] ?>, taxonomy: "<?php echo $tmp[1] ?>"};
					<?php endif; ?>

					jQuery(function () {
						mad_woof_current_values = jQuery.parseJSON(mad_woof_current_values);
						if (mad_woof_current_values.length == 0) { mad_woof_current_values = {}; }
					});

			</script>

			<?php

		}

		public function get_options() {
			$options = array(
				array(
					'name' => esc_html__('Products Filter Options', 'flatastic'),
					'type' => 'title',
					'desc' => '',
					'id' => 'mad_woof_general_settings'
				),
				array(
					'name' => __('Hide childs in checkboxes', 'flatastic'),
					'desc' => __('Hide childs in checkboxes. Near checkbox which has childs will be plus icon to show childs.', 'flatastic'),
					'id' => 'mad_woof_checkboxes_slide',
					'type' => 'select',
					'class' => 'chosen_select',
					'css' => 'min-width:300px;',
					'options' => array(
						0 => __('No', 'flatastic'),
						1 => __('Yes', 'flatastic')
					),
					'desc_tip' => true
				),
				array(
					'name' => __('Show count', 'flatastic'),
					'desc' => __('Show count of items near taxonomies terms on the front', 'flatastic'),
					'id' => 'mad_woof_show_count',
					'type' => 'select',
					'class' => 'chosen_select',
					'css' => 'min-width:300px;',
					'options' => array(
						0 => __('No', 'flatastic'),
						1 => __('Yes', 'flatastic')
					),
					'desc_tip' => true
				),
				array(
					'name' => esc_html__('Show reset', 'flatastic'),
					'desc' => esc_html__('Show reset products filter', 'flatastic'),
					'id' => 'mad_woof_show_reset',
					'type' => 'select',
					'class' => 'chosen_select',
					'css' => 'min-width:300px;',
					'options' => array(
						0 => esc_html__('No', 'flatastic'),
						1 => esc_html__('Yes', 'flatastic')
					),
					'default'  => 1,
					'desc_tip' => true
				),
				array(
					'name' => esc_html__('Behavior', 'flatastic'),
					'desc' => esc_html__('Behaviour of the text searching', 'flatastic'),
					'id' => 'mad_behavior',
					'type' => 'select',
					'class' => 'chosen_select',
					'css' => 'min-width:300px;',
					'options' => array(
						'title' => esc_html__("Search by title", 'flatastic'),
						'content' => esc_html__("Search by content", 'flatastic'),
						'excerpt' => esc_html__("Search by excerpt", 'flatastic'),
						'content_or_excerpt' => esc_html__("Search by content OR excerpt", 'flatastic'),
						'title_or_content_or_excerpt' => esc_html__("Search by title OR content OR excerpt", 'flatastic'),
						'title_or_content' => esc_html__("Search by title OR content", 'flatastic'),
						'title_and_content' => esc_html__("Search by title AND content", 'flatastic')
					),
					'default'  => 'title',
					'desc_tip' => true
				),
				array('type' => 'sectionend', 'id' => 'mad_woof_general_settings')
			);
			return apply_filters('wc_settings_tab_mad_woof_settings', $options);
		}

		//for dynamic count
		public function dynamic_count($curr_term, $type, $additional_taxes = '')
		{
			//global $wp_query;
			$request = $this->get_request_data();
			$opposition_terms = array();

			if (!empty($additional_taxes)) {
				$opposition_terms = $this->_expand_additional_taxes_string($additional_taxes);
			}

			if (!empty($opposition_terms)) {
				$tmp = array();
				foreach ($opposition_terms as $t) {
					$tmp[$t['taxonomy']] = $t['terms'];
				}
				$opposition_terms = $tmp;
				unset($tmp);
			}

			if ($this->is_really_current_term_exists()) {
				$o = $this->get_really_current_term();
				$opposition_terms[$o->taxonomy] = array($o->slug);
			}

			$in_query_terms = array();
			static $product_taxonomies = null;
			if (!$product_taxonomies) {
				$product_taxonomies = $this->get_taxonomies();
				$product_taxonomies = array_keys($product_taxonomies);
			}

			if (!empty($request) AND is_array($request)) {
				foreach ($request as $tax_slug => $terms_string) {
					if (in_array($tax_slug, $product_taxonomies)) {
						$in_query_terms[$tax_slug] = explode(',', $terms_string);
					}
				}
			}

			$term_is_in_query = false;
			if (isset($in_query_terms[$curr_term['taxonomy']])) {
				if (in_array($curr_term['slug'], $in_query_terms[$curr_term['taxonomy']])) {
					$term_is_in_query = true;
				}
			}

			if ($term_is_in_query) {
				return 0;
			}

			$terms_to_query = array();

			switch ($type) {
				case 'select':


					if (isset($in_query_terms[$curr_term['taxonomy']]))
					{
						$in_query_terms[$curr_term['taxonomy']] = array($curr_term['slug']);
					} else
					{
						$terms_to_query[$curr_term['taxonomy']] = array($curr_term['slug']);
					}


					break;
				case 'checkbox':
				case 'color':
				case 'label':

					if (isset($in_query_terms[$curr_term['taxonomy']])) {
						$in_query_terms[$curr_term['taxonomy']] = array($curr_term['slug']);
					} else {
						$terms_to_query[$curr_term['taxonomy']][] = $curr_term['slug'];
					}

					break;
			}

			$taxonomies = array();
			if (!empty($opposition_terms)) {
				foreach ($opposition_terms as $tax_slug => $terms) {
					if (!empty($terms)) {
						$taxonomies[] = array(
							'taxonomy' => $tax_slug,
							'terms' => $terms,
							'field' => 'slug',
							'operator' => 'IN',
							'include_children' => 1
						);
					}
				}
			}

			if (!empty($in_query_terms)) {
				foreach ($in_query_terms as $tax_slug => $terms) {
					if (!empty($terms)) {
						$taxonomies[] = array(
							'taxonomy' => $tax_slug,
							'terms' => $terms,
							'field' => 'slug',
							'operator' => 'IN',
							'include_children' => 1
						);
					}
				}
			}

			if (!empty($terms_to_query)) {
				foreach ($terms_to_query as $tax_slug => $terms) {
					if (!empty($terms)) {
						$taxonomies[] = array(
							'taxonomy' => $tax_slug,
							'terms' => $terms,
							'field' => 'slug',
							'operator' => 'IN',
							'include_children' => 1
						);
					}
				}
			}

			if (!empty($taxonomies))
			{
				$taxonomies['relation'] = 'AND';
			}

			$args = array(
				'nopaging' => true,
				'fields' => 'ids',
				'post_type' => 'product'
			);

			$args['tax_query'] = $taxonomies;
			if (isset($wp_query->meta_query->queries))
			{
				$args['meta_query'] = $wp_query->meta_query->queries;
			} else
			{
				$args['meta_query'] = array();
			}

			//check for price
			if ($this->is_isset_in_request_data('min_price') AND $this->is_isset_in_request_data('max_price'))
			{
				$this->assemble_price_params($args['meta_query']);
				$args['meta_query']['relation'] = 'AND';
			}

			//WPML compatibility
			if (class_exists('SitePress')) {
				$args['lang'] = ICL_LANGUAGE_CODE;
			}

			$atts = array();
			if (!isset($args['meta_query']))
			{
				$args['meta_query'] = array();
			}

			$this->assemble_sku_params($args['meta_query']);
			$args = apply_filters('woocommerce_shortcode_products_query', $args, $atts);

			$_REQUEST['woof_dyn_recount_going'] = 1;
			remove_filter('posts_clauses', array($this, 'order_by_popularity_post_clauses'));
			remove_filter('posts_clauses', array($this, 'order_by_rating_post_clauses'));

			if (get_option('woocommerce_hide_out_of_stock_items', 'no') == 'yes')
			{
				$args['meta_query'][] = array(
					'key' => '_stock_status',
					'value' => array('instock'),
					'compare' => 'IN'
				);
			}

			$query = new MAD_WP_QueryWoofCounter($args);

			unset($_REQUEST['woof_dyn_recount_going']);
			return $query->found_posts;
		}

		public static function attributes_table( $type, $attribute, $values = array(), $echo = true ) {

			$return = '';
			$terms = get_terms( array(
				'taxonomy' => $attribute,
				'hide_empty' => '0',
				'orderby' => 'slug'
			) );

			if ('color' == $type) {
				if (!empty($terms)) {
					$return = sprintf( '<table><tr><th>%s</th><th>%s</th></tr>', esc_html__( 'Term', 'flatastic' ), esc_html__( 'Color', 'flatastic' ) );
					foreach ( $terms as $term ) {
						$return .= "<tr><td><label for='{$attribute}_{$term->slug}'>{$term->name}</label></td><td><input type='text' id='{$attribute}_{$term->slug}' name='mad_woof_settings[colors][{$attribute}][{$term->slug}]' value='" . ( isset( $values[$term->slug] ) ? $values[$term->slug] : '' ) . "' size='3' class='mad-colorpicker' /></td></tr>";
					}
					$return .= '</table>';
				}
			} else if ('label' == $type) {
				if (!empty($terms)) {
					$return = sprintf( '<table><tr><th>%s</th><th>%s</th></tr>', esc_html__( 'Term', 'flatastic' ), esc_html__( 'Label', 'flatastic' ) );
					foreach ( $terms as $term ) {
						$return .= "<tr><td><label for='{$attribute}_{$term->slug}'>{$term->name}</label></td><td><input type='text' id='{$attribute}_{$term->slug}' name='mad_woof_settings[labels][{$attribute}][{$term->slug}]' value='" . ( isset( $values[$term->slug] ) ? $values[$term->slug] : '' ) . "' size='3' /></td></tr>";
					}
					$return .= '</table>';
				}
			}

			if ( $echo ) { echo $return; }
			return $return;
		}

		public function get_swoof_search_slug()
		{
			return 'mad_woof';
		}

		public function is_permalink_activated() {
			return get_option('permalink_structure', '');
		}

		private function assemble_sku_params(&$meta_query) {

			$request = $this->get_request_data();
			if (isset($request['mad_woof_sku'])) {
				if (!empty($request['mad_woof_sku'])) {
					$meta_query[] = array(
						'key' => '_sku',
						'value' => $request['mad_woof_sku']
					);
				}
			}

			return $meta_query;
		}

		public function woocommerce_before_shop_loop() {
			echo '<div class="woof_shortcode_output">';

				echo $this->woocommerce_pagination();

				$shortcode_txt = "mad_woof_products is_ajax=1";

				if (defined('wcv_plugin_dir')) {
					$vendor_shop = urldecode( get_query_var( 'vendor_shop' ) );
					$shortcode_txt = "mad_woof_products vendor_shop={$vendor_shop} is_ajax=1";
				}

				if ($this->is_really_current_term_exists()) {
					$o = $this->get_really_current_term();
					$shortcode_txt = "mad_woof_products taxonomies={$o->taxonomy}:{$o->term_id} is_ajax=1";
					$_REQUEST['WOOF_IS_TAX_PAGE'] = $o->taxonomy;
				}

			echo '<div id="woof_results_by_ajax" data-shortcode="' . $shortcode_txt . '">';
		}

		public function woocommerce_after_shop_loop() {
			echo '</div>';
			echo '</div>';
		}

		public function woocommerce_pagination() {
			echo mad_shop_corenavi();
		}

		public function get_request_data() {
			return apply_filters('mad_woof_get_request_data', $_GET);
		}

		public function is_isset_in_request_data($request) {
			if (isset($request['s'])) {
				$request['mad_woof_text'] = $request['s'];
			}
			return $request;
		}

		public function get_catalog_orderby($orderby = '', $order = '', $meta_key = '') {

			if (empty($orderby)) {
				$orderby = get_option('woocommerce_default_catalog_orderby');
			}

			$order = strtoupper( $order );

			global $wpdb;
			switch ($orderby)
			{
				case 'price-desc':
					$orderby = "meta_value_num {$wpdb->posts}.ID";
					$meta_key = '_price';
					break;
				case 'price':
					$orderby = "meta_value_num {$wpdb->posts}.ID";
					$order = $order == 'DESC' ? 'DESC' : 'ASC';
					$meta_key = '_price';
					break;
				case 'popularity' :
					$meta_key = 'total_sales';
					add_filter('posts_clauses', array($this, 'order_by_popularity_post_clauses'));
					break;
				case 'rating' :
					$orderby = '';
					$meta_key = '';
					add_filter('posts_clauses', array($this, 'order_by_rating_post_clauses'));
					break;
				case 'title' :
					$orderby = 'title';
					break;
				case 'rand' :
					$orderby = 'rand';
					break;
				case 'date' :
					$orderby = 'date';
					$order = $order == 'DESC' ? 'DESC' : 'ASC';
					break;
				case 'menu_order':
					$orderby = 'menu_order title';
					$meta_key = '';
					$order = $order == 'DESC' ? 'DESC' : 'ASC';
					break;
				default:
					break;
			}
			return compact('orderby', 'order', 'meta_key');
		}

		public function order_by_popularity_post_clauses( $args ) {
			global $wpdb;

			$data = $this->get_request_data();
			$catalog_order = isset($data['product_sort']) ? $data['product_sort'] : 'DESC';

			$args['orderby'] = "$wpdb->postmeta.meta_value+0 $catalog_order, $wpdb->posts.post_date $catalog_order";

			return $args;
		}

		public function order_by_rating_post_clauses( $args ) {
			global $wpdb;

			$data = $this->get_request_data();
			$catalog_order = isset($data['product_sort']) ? $data['product_sort'] : 'DESC';

			$args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";

			$args['where'] .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";

			$args['join'] .= "
			LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
			LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)";

			$args['orderby'] = "average_rating $catalog_order, $wpdb->posts.post_date $catalog_order";

			$args['groupby'] = "$wpdb->posts.ID";

			return $args;
		}

		private function assemble_price_params(&$meta_query) {
			$request = $this->get_request_data();
			if (isset($request['min_price']) AND isset($request['max_price']))
			{
				if ($request['min_price'] <= $request['max_price'])
				{
					$meta_query[] = array(
						'key' => '_price',
						'value' => array(floatval($request['min_price']), floatval($request['max_price'])),
						'type' => 'DECIMAL',
						'compare' => 'BETWEEN'
					);
				}
			}

			return $meta_query;
		}

		private function get_tax_query($additional_taxes = '')
		{
			$data = $this->get_request_data();
			$res = array();

			$woo_taxonomies = NULL;
			$woo_taxonomies = get_object_taxonomies('product');

			if (!empty($data) AND is_array($data)) {

				foreach ($data as $tax_slug => $value) {

					if (in_array($tax_slug, $woo_taxonomies)) {
						$value = explode(',', $value);
						$res[] = array(
							'taxonomy' => $tax_slug,
							'field' => 'slug',
							'terms' => $value
						);
					}

				}

			}

			$res = $this->_expand_additional_taxes_string($additional_taxes, $res);

			if (!empty($res)) {
				$res = array_merge(array('relation' => 'AND'), $res);
			}

			return $res;
		}

		private function _expand_additional_taxes_string($additional_taxes, $res = array()) {
			if (!empty($additional_taxes)) {

				$t = explode('+', $additional_taxes);

				if (!empty($t) AND is_array($t)) {

					foreach ($t as $string) {
						$tmp = explode(':', $string);
						$tax_slug = $tmp[0];
						$tax_terms = explode(',', $tmp[1]);
						$slugs = array();

						foreach ($tax_terms as $term_id) {
							$term = get_term(intval($term_id), $tax_slug);
							$slugs[] = $term->slug;
						}

						$res[] = array(
							'taxonomy' => $tax_slug,
							'field' => 'slug', //id
							'terms' => $slugs
						);
					}
				}
			}

			return $res;
		}

		public function woocommerce_product_query($q) {
			$meta_query = $q->get('meta_query');
			$q->set('meta_query', $this->assemble_text_params($meta_query));
			$q->set('meta_query', $this->assemble_sku_params($meta_query));
			return $q;
		}

		public function assemble_text_params(&$meta_query) {
			add_filter('posts_where', array($this, 'woof_post_text_filter'), 9999); //for searching by title
			return $meta_query;
		}

		public function woof_post_text_filter($where = '') {

			$request = $this->get_request_data();

			if ($this->is_isset_in_request_data('mad_woof_text') && !empty($request['mad_woof_text'])) {

				$woof_text = strtolower($request['mad_woof_text']);
				$behaviour = get_option('mad_behavior');

				switch ($behaviour) {
					case 'content':
						$where .= "AND post_content LIKE '%{$woof_text}%'";
						break;
					case 'title_or_content':
						$where .= "AND (post_title LIKE '%{$woof_text}%' OR post_content LIKE '%{$woof_text}%')";
						break;
					case 'title_and_content':
						$where .= "AND (post_title LIKE '%{$woof_text}%' AND post_content LIKE '%{$woof_text}%')";
						break;
					case 'excerpt':
						$where .= "AND post_excerpt LIKE '%{$woof_text}%'";
						break;
					case 'content_or_excerpt':
						$where .= "AND (post_excerpt LIKE '%{$woof_text}%' OR post_content LIKE '%{$woof_text}%')";
						break;
					case 'title_or_content_or_excerpt':
						$where .= "AND (post_title LIKE '%{$woof_text}%' OR post_excerpt LIKE '%{$woof_text}%' OR post_content LIKE '%{$woof_text}%')";
						break;
					default:
						$where .= "AND post_title LIKE '%{$woof_text}%'";
						break;
				}
			}

			return $where;
		}

		private function get_meta_query($args = array()) {
			$meta_query = WC()->query->get_meta_query();
			$meta_query = array_merge(array('relation' => 'AND'), $meta_query);

			$this->assemble_price_params($meta_query);
			$this->assemble_sku_params($meta_query);
			$this->assemble_text_params($meta_query);

			return $meta_query;
		}

		public function woof_products($atts) {

			$_REQUEST['woof_products_doing'] = 1;
			$shortcode_txt = 'mad_woof_products';

			if (!empty($atts)) {
				foreach ($atts as $key => $value) {
					$shortcode_txt.=' ' . $key . '=' . $value;
				}
			}

			$data = $this->get_request_data();
			$catalog_orderby = $this->get_catalog_orderby(isset($data['orderby']) ? $data['orderby'] : '', isset($data['product_sort']) ? $data['product_sort'] : '');

			extract(shortcode_atts(array(
				'columns' => apply_filters('loop_shop_columns', 4),
				'orderby' => 'no',
				'order' => 'no',
				'page' => 1,
				'per_page' => 0,
				'is_ajax' => 0,
				'vendor_shop' => '',
				'taxonomies' => '',
				'dp' => 0,
				'behaviour' => ''
			), $atts));

			$order_by_defined_in_atts = false;

			if ($orderby == 'no') {
				$orderby = $catalog_orderby['orderby'];
				$order = $catalog_orderby['order'];
			} else {
				$order_by_defined_in_atts = true;
			}

			$_REQUEST['woof_additional_taxonomies_string'] = $taxonomies;

			$args = array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'orderby' => $orderby,
				'order' => $order,
				'meta_query' => $this->get_meta_query(),
				'tax_query' => $this->get_tax_query($taxonomies)
			);

			if (defined('wcv_plugin_dir')) {
				$args['author'] = WCV_Vendors::get_vendor_id( $vendor_shop );
			}

			$args['posts_per_page'] = mad_custom_get_option('woocommerce_product_count');

			if ($per_page > 0) {
				$args['posts_per_page'] = $per_page;
			} else {
				if (WC()->session->__isset('products_per_page')) {
					$args['posts_per_page'] = WC()->session->__get('products_per_page');
				}
			}

			//Display Product for WooCommerce compatibility
			if (isset($_REQUEST['perpage'])) {
					$args['posts_per_page'] = $_REQUEST['perpage'];
			}

			//if smth wrong, set default per page option
			if (!$args['posts_per_page']) {
				$args['posts_per_page'] = $this->settings['per_page'];
			}

			if (!$order_by_defined_in_atts) {
				if (!empty($catalog_orderby['meta_key'])) {
					$args['meta_key'] = $catalog_orderby['meta_key'];
					$args['orderby'] = $catalog_orderby['orderby'];
					if (!empty($catalog_orderby['order'])) {
						$args['order'] = $catalog_orderby['order'];
					}
				} else {
					$args['orderby'] = $catalog_orderby['orderby'];
					if (!empty($catalog_orderby['order'])) {
						$args['order'] = $catalog_orderby['order'];
					}
				}
			}

			$pp = $page;

			if (get_query_var('page')) {
				$pp = get_query_var('page');
			}

			if (get_query_var('paged')) {
				$pp = get_query_var('paged');
			}

			if ($pp > 1) {
				$args['paged'] = $pp;
			} else {
				$args['paged'] = ((get_query_var('page')) ? get_query_var('page') : $page);
			}

			$wr = apply_filters('woocommerce_shortcode_products_query', $args, $atts);

			global $products, $wp_query;
			$_REQUEST['woof_wp_query'] = $wp_query = $products = new WP_Query($wr);
			$wp_query->is_post_type_archive = true;
			$_REQUEST['woof_wp_query_args'] = $wr;

			ob_start(); ?>

			<?php if ($products->have_posts()) :

					add_filter('post_class', array($this, 'woo_post_class'));
					$_REQUEST['woof_before_shop_loop_done'] = true;

					global $woocommerce_loop;
					$woocommerce_loop['columns'] = $columns;
					$woocommerce_loop['loop'] = 0; ?>

				<?php echo $this->woocommerce_pagination(); ?>

				<div id="woof_results_by_ajax" data-shortcode="<?php echo $shortcode_txt ?>">

					<?php
					woocommerce_product_loop_start();
					woocommerce_product_subcategories();

					if ($dp == 0) {
						while ($products->have_posts()) : $products->the_post();
							wc_get_template_part('content', 'product');
						endwhile;
					}
					woocommerce_product_loop_end(); ?>

				</div>

				<?php do_action('woocommerce_after_shop_loop'); ?>

			<?php else: ?>

				<div id="woof_results_by_ajax" data-shortcode="<?php echo $shortcode_txt ?>">
					<?php wc_get_template('loop/no-products-found.php'); ?>
				</div>

			<?php endif;

			wp_reset_postdata();

			unset($_REQUEST['woof_products_doing']);
			return ob_get_clean();
		}

		public function woo_post_class($classes) {
			global $post;
			$classes[] = 'product';
			$classes[] = 'type-product';
			$classes[] = 'status-publish';
			$classes[] = 'has-post-thumbnail';
			$classes[] = 'post-' . $post->ID;
			return $classes;
		}

		public function woof_draw_products() {
			$link = parse_url($_REQUEST['link'], PHP_URL_QUERY);
			parse_str($link, $_GET);
			$products = do_shortcode("[" . $_REQUEST['shortcode'] . " order=". $_REQUEST['order'] ."  per_page=". absint($_REQUEST['per_page']) ." page=" . $_REQUEST['page'] . " ]");
			$form = '';

			if (isset($_REQUEST['woof_shortcode'])) {
				if (empty($_REQUEST['woof_additional_taxonomies_string'])) {
					$form = do_shortcode("[" . $_REQUEST['woof_shortcode'] . "]");
				} else {
					$form = do_shortcode("[" . $_REQUEST['woof_shortcode'] . " taxonomies={$_REQUEST['woof_additional_taxonomies_string']}]");
				}
			}

			$data = array(
				'fragments' => $products,
				'form' => $form
			);
			wp_send_json( $data );
		}

		//redraw search form
		public function woof_redraw_woof() {
			$_REQUEST['woof_shortcode_txt'] = $_REQUEST['shortcode'];
			wp_die(do_shortcode("[" . $_REQUEST['shortcode'] . "]"));
		}

		public function woof_exclude_tax_key($terms) {
			{
				if ($this->is_really_current_term_exists()) {

					$queried_obj = $this->get_really_current_term();
					$current_term_id = $queried_obj->term_id;
					$parent_id = $queried_obj->parent;

					if ($parent_id == 0) {
						$terms = $terms[$current_term_id]['childs'];
					} else {
						foreach ($terms as $top_tid => $value) {
							if (!empty($value['childs'])) {

								$terms = $this->_woof_exclude_tax_key_util1($current_term_id, $top_tid, $value['childs']);

								if (!empty($terms)) {
									break;
								}
							}
						}

					}
				}
			}

			return $terms;
		}

		private function _woof_exclude_tax_key_util1($current_term_id, $top_tid, $child_terms) {
			$terms = array();

			if (!empty($child_terms)) {
				if (isset($child_terms[$current_term_id]['childs'])) {

					$terms = $child_terms[$current_term_id]['childs'];

				} else {

					foreach ($child_terms as $tid => $value) {
						$parent_keys[] = $top_tid;
						$terms = $this->_woof_exclude_tax_key_util1($current_term_id, $tid, $value['childs']);
						if (!empty($terms)) {
							break;
						}
					}

				}
			}

			return $terms;
		}

		private function get_really_current_term() {
			$res = NULL;
			$key = $this->session_rct_key;
			$request = $this->get_request_data();

			if ($this->storage->is_isset($key)) {
				$res = $this->storage->get_val($key);
			}

			if (!$res) {
				if (isset($request['really_curr_tax'])) {
					$tmp = explode('-', $request['really_curr_tax']);
					$res = get_term($tmp[0], $tmp[1]);
				}
			}

			return $res;
		}

		private function is_really_current_term_exists() {
			return (bool) $this->get_really_current_term();
		}

		private function set_really_current_term($queried_obj = NULL) 	{

			if (defined('DOING_AJAX')) { return false; }

			$request = $this->get_request_data();
			if (!$queried_obj) {
				if (isset($request['really_curr_tax'])) {
					return false;
				}
			}

			$key = $this->session_rct_key;

			if ($queried_obj === NULL) {
				$this->storage->unset_val($key);
			} else {
				$this->storage->set_val($key, $queried_obj);
			}

			return $queried_obj;
		}

		public function cache_count_data_clear() {
			global $wpdb;
			$wpdb->query("TRUNCATE TABLE " . self::$query_cache_table);
		}

		public function woof_modify_query_args($query_args) {

			if (isset($_REQUEST[$this->get_swoof_search_slug()])) {
				if (isset($_REQUEST['woof_wp_query_args'])) {
					$query_args['meta_query'] = $_REQUEST['woof_wp_query_args']['meta_query'];
					$query_args['tax_query'] = $_REQUEST['woof_wp_query_args']['tax_query'];
					$query_args['paged'] = $_REQUEST['woof_wp_query_args']['paged'];
				}
			}

			return $query_args;
		}

		public function render_html($pagepath, $data = array()) {
			@extract($data);
			ob_start();
			include($pagepath);
			return ob_get_clean();
		}

	}

}

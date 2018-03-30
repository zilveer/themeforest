<?php

if (!class_exists('MAD_CATALOG_ORDERING')) {

	class MAD_CATALOG_ORDERING {

		public $filter = true;

		function __construct($filter) {
			$this->filter = $filter;
		}

		public function woo_build_query_string ($params = array(), $key, $value) {
			$params[$key] = $value;
			$paged = (array_key_exists('product_count', $params)) ? 'paged=1&' : '';
			return "?" . $paged . http_build_query($params);
		}

		public function woo_active_class($key1, $key2) {
			if ($key1 == $key2) return " class='selected'";
		}

		public function woo_selected_option($key1, $key2) {
			if ($key1 == $key2) return " selected";
		}

		public function output_html_with_filter() {

			parse_str($_SERVER['QUERY_STRING'], $params);

			$per_page = mad_custom_get_option('woocommerce_product_count');

			if (!$per_page) {
				$per_page = get_option('posts_per_page');
			}

			$product_order = array();
			$product_order['menu_order'] = esc_html__("Default", 'flatastic');
			$product_order['popularity'] = esc_html__("Popularity", 'flatastic');
			$product_order['rating'] 	 = esc_html__("Rating", 'flatastic');
			$product_order['date'] 		 = esc_html__("Date", 'flatastic');
			$product_order['price'] 	 = esc_html__("Price", 'flatastic');

			$product_order_key = !empty($params['orderby']) ? $params['orderby'] : 'menu_order';
			$product_count_key = !empty($params['product_count']) ? $params['product_count'] : $per_page;

			$product_sort_key =  !empty($params['product_sort']) ? $params['product_sort'] : 'ASC';
			$product_sort_key = strtolower($product_sort_key);

			ob_start(); ?>

			<div class="sort-param sort-param-order">

				<label class="d_inline_middle f_size_medium"><?php esc_html_e('Sort by', 'flatastic') ?>:</label>

				<div class="custom-select">
					<div class="select-title"><?php echo $product_order[$product_order_key] ?></div>
					<ul class="select-list"></ul>
					<select name="param-count">
						<option data-href="menu_order" <?php echo $this->woo_selected_option($product_order_key, 'menu_order'); ?> value="menu_order">
							<?php echo $product_order['menu_order'] ?>
						</option>
						<option data-href="popularity" <?php echo $this->woo_selected_option($product_order_key, 'popularity'); ?> value="popularity">
							<?php echo $product_order['popularity'] ?>
						</option>

						<?php if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' ): ?>
							<option data-href="rating" <?php echo $this->woo_selected_option($product_order_key, 'rating'); ?> value="rating">
								<?php echo $product_order['rating'] ?>
							</option>
						<?php endif; ?>

						<option data-href="date" <?php echo $this->woo_selected_option($product_order_key, 'date'); ?> value="date">
							<?php echo $product_order['date'] ?>
						</option>
						<option data-href="price" <?php echo $this->woo_selected_option($product_order_key, 'price'); ?> value="price">
							<?php echo $product_order['price'] ?>
						</option>
					</select>
				</div><!--/ .custom-select-->

			</div>

			<div class="order-param-button">
				<a title="<?php esc_html_e('Click to order products', 'flatastic') ?>" data-sort="<?php echo esc_attr($product_sort_key) ?>" href="javascript:void(0)"></a>
			</div><!--/ .order-param-button-->

			<?php if (!mad_is_product_category()): ?>

				<div class="sort-param param-count sort-param-count">

					<label class="d_inline_middle f_size_medium"><?php _e('Show:', 'flatastic') ?></label>

					<div class="custom-select">
						<div class="select-title"><?php echo esc_html($product_count_key) ?></div>
						<ul class="select-list"></ul>
						<select name="param-count">
							<option <?php echo $this->woo_selected_option($product_count_key, $per_page); ?> data-href="<?php echo esc_attr($per_page) ?>">
								<?php echo (int) esc_html($per_page) ?>
							</option>
							<option <?php echo $this->woo_selected_option($product_count_key, $per_page * 2); ?> data-href="<?php echo esc_attr($per_page * 2) ?>">
								<?php echo (int) esc_html($per_page * 2) ?>
							</option>
							<option <?php echo $this->woo_selected_option($product_count_key, $per_page * 3); ?> data-href="<?php echo esc_attr($per_page * 3) ?>">
								<?php echo (int) esc_html($per_page * 3) ?>
							</option>
						</select>
					</div><!--/ .custom-select-->

					<label class="d_inline_middle f_size_medium"><?php _e('items per page', 'flatastic') ?></label>

				</div><!--/ .param-count-->

			<?php endif; ?>

			<?php return ob_get_clean();
		}

		public function output_html_without_filter() {

			global $mad_config;
			parse_str($_SERVER['QUERY_STRING'], $params);

			$per_page = mad_custom_get_option('woocommerce_product_count');

			if (!$per_page) {
				$per_page = get_option('posts_per_page');
			}

			$product_order = array();
			$product_order['menu_order'] = esc_html__("Default", 'flatastic');
			$product_order['popularity'] = esc_html__("Popularity", 'flatastic');
			$product_order['rating'] 	 = esc_html__("Rating", 'flatastic');
			$product_order['date'] 		 = esc_html__("Date", 'flatastic');
			$product_order['price'] 	 = esc_html__("Price", 'flatastic');

			$product_sort['asc'] = __("Click to order products ascending",  'flatastic');
			$product_sort['desc'] = __("Click to order products descending",  'flatastic');

			$product_order_key = !empty($mad_config['woocommerce']['product_order']) ? $mad_config['woocommerce']['product_order'] : 'menu_order';
			$product_sort_key = !empty($mad_config['woocommerce']['product_sort'])  ? $mad_config['woocommerce']['product_sort'] : 'DESC';
			$product_count_key = !empty($mad_config['woocommerce']['product_count']) ? $mad_config['woocommerce']['product_count'] : $per_page;

			$product_sort_key = strtolower($product_sort_key);

			ob_start(); ?>

			<div class="sort-param sort-param-order">

				<label class="d_inline_middle f_size_medium"><?php esc_html_e('Sort by', 'flatastic') ?>:</label>

				<div class="custom-select">
					<div class="select-title"><?php echo $product_order[$product_order_key] ?></div>
					<ul class="select-list"></ul>
					<select name="param-count">
						<option data-href="<?php echo $this->woo_build_query_string($params, 'product_order', 'menu_order') ?>" <?php echo $this->woo_selected_option($product_order_key, 'menu_order'); ?> value="menu_order">
							<?php echo $product_order['menu_order'] ?>
						</option>
						<option data-href="<?php echo $this->woo_build_query_string($params, 'product_order', 'popularity') ?>" <?php echo $this->woo_selected_option($product_order_key, 'popularity'); ?> value="popularity">
							<?php echo $product_order['popularity'] ?>
						</option>

						<?php if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' ): ?>
							<option data-href="<?php echo $this->woo_build_query_string($params, 'product_order', 'rating') ?>" <?php echo $this->woo_selected_option($product_order_key, 'rating'); ?> value="rating">
								<?php echo $product_order['rating'] ?>
							</option>
						<?php endif; ?>

						<option data-href="<?php echo $this->woo_build_query_string($params, 'product_order', 'date') ?>" <?php echo $this->woo_selected_option($product_order_key, 'date'); ?> value="date">
							<?php echo $product_order['date'] ?>
						</option>
						<option data-href="<?php echo $this->woo_build_query_string($params, 'product_order', 'price') ?>" <?php echo $this->woo_selected_option($product_order_key, 'price'); ?> value="price">
							<?php echo $product_order['price'] ?>
						</option>
					</select>
				</div><!--/ .custom-select-->

			</div>

			<div class="order-param-button">

				<?php if ($product_sort_key == 'desc'): ?>
					<a title="<?php esc_html_e('Click to order products', 'flatastic') ?>" href="<?php echo $this->woo_build_query_string($params, 'product_sort', 'asc') ?>"></a>
				<?php endif; ?>

				<?php if ($product_sort_key == 'asc'): ?>
					<a title="<?php esc_html_e('Click to order products', 'flatastic') ?>" href="<?php echo $this->woo_build_query_string($params, 'product_sort', 'desc') ?>"></a>
				<?php endif; ?>

			</div><!--/ .order-param-button-->

			<?php if (!mad_is_product_category()): ?>

				<div class="sort-param param-count sort-param-count">

					<label class="d_inline_middle f_size_medium"><?php _e('Show:', 'flatastic') ?></label>

					<div class="custom-select">
						<div class="select-title"><?php echo esc_html($product_count_key) ?></div>
						<ul class="select-list"></ul>
						<select name="param-count">
							<option <?php echo $this->woo_selected_option($product_count_key, $per_page); ?> data-href="<?php echo $this->woo_build_query_string($params, 'product_count', $per_page) ?>">
								<?php echo (int) esc_html($per_page) ?>
							</option>
							<option <?php echo $this->woo_selected_option($product_count_key, $per_page * 2); ?> data-href="<?php echo $this->woo_build_query_string($params, 'product_count', $per_page * 2) ?>">
								<?php echo (int) esc_html($per_page * 2) ?>
							</option>
							<option <?php echo $this->woo_selected_option($product_count_key, $per_page * 3); ?> data-href="<?php echo $this->woo_build_query_string($params, 'product_count', $per_page * 3) ?>">
								<?php echo (int) esc_html($per_page * 3) ?>
							</option>
						</select>
					</div><!--/ .custom-select-->

					<label class="d_inline_middle f_size_medium"><?php _e('items per page', 'flatastic') ?></label>

				</div><!--/ .param-count-->

			<?php endif; ?>

			<?php return ob_get_clean();
		}

		public function output() {

			global $woocommerce_loop;

			ob_start();
			?>

			<div class="shop-page-meta">

				<div class="row">

					<div class="col-sm-9">
						<?php echo ($this->filter == true) ? $this->output_html_with_filter() : $this->output_html_without_filter(); ?>
					</div>

					<div class="col-sm-3 t_align_r">

						<p class="list-or-grid">
							<?php _e( 'View as:', 'flatastic' ) ?>
							<a data-view="view-grid-center" class="view-grid<?php if ($woocommerce_loop['view'] == 'view-grid-center') echo ' active'; ?>" href="<?php echo add_query_arg( 'view', 'grid' ) ?>" title="<?php _e( 'Switch to grid view', 'flatastic' ) ?>">
								<?php _e( 'Grid', 'flatastic' ) ?>
							</a>
							<a data-view="view-list" class="view-list<?php if ($woocommerce_loop['view'] == 'view-list') echo ' active'; ?>" href="<?php echo add_query_arg( 'view', 'list' ) ?>" title="<?php _e( 'Switch to list view', 'flatastic' ) ?>">
								<?php _e( 'List', 'flatastic' ) ?>
							</a>
						</p><!--/ .list-or-grid-->

					</div>

				</div><!--/ .row-->

			</div><!--/ .shop-page-meta-->

			<?php return ob_get_clean();
		}

	}
}

?>

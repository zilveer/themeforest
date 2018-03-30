<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Shop Products Presentation
 Description: Create and display a Shop Products Presentation element
 Class: TH_ShopProductsPresentation
 Category: content
 Level: 3
 Scripts: true
 Dependency_class: WooCommerce
 Keywords: carousel, tabs, offers, shop, store, selling, featured, latest
*/
/**
 * Class TH_ShopProductsPresentation
 *
 * Create and display a Shop Products Presentation element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ShopProductsPresentation extends ZnElements
{
	public static function getName(){
		return __( 'Shop Products Presentation', 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		if( empty( $options ) ){
			return;
		}

		global $woocommerce;

		if (!isset($woocommerce) || empty( $woocommerce ) ) {
			return;
		}

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'spp--'.$color_scheme;

		$randId = rand( 1, 10000 );

		$layout = $this->opt('woo_spp_display','tabs');
		$layout_type = $layout == 'tabs' ? 'tabbable' : 'spp-products-rows';
		$types = array(
			'woo_fp_prod' => array(
				'wtitle' => $this->opt( 'woo_fp_title', __('FEATURED PRODUCTS', 'zn_framework' ) ),
				'wcarousel' => $this->opt('woo_fp_crs', '1'),
				'wcols' => $this->opt('woo_fp_perrow','4'),
				'wauto' => $this->opt( 'woo_fp_auto', '' ),
				'wtimeout' => $this->opt( 'woo_fp_timeout', '5000' ),
				'wcats' => $this->opt( 'woo_categories_fp', $this->opt('woo_categories', false) ),
				'wtags' => $this->opt( 'woo_tags_fp', $this->opt('woo_tags', false) ),
				'wload' => $this->opt( 'prods_per_page_fp', $this->opt('prods_per_page', '6') ),
			),
			'woo_lp_prod' => array(
				'wtitle' => $this->opt( 'woo_lp_title', __('LATEST PRODUCTS', 'zn_framework' ) ),
				'wcarousel' => $this->opt('woo_lp_crs', '1'),
				'wcols' => $this->opt('woo_lp_perrow','4'),
				'wauto' => $this->opt( 'woo_lp_auto', '' ),
				'wtimeout' => $this->opt( 'woo_lp_timeout', '5000' ),
				'wcats' => $this->opt( 'woo_categories_lp', $this->opt('woo_categories', false) ),
				'wtags' => $this->opt( 'woo_tags_lt', $this->opt('woo_tags', false) ),
				'wload' => $this->opt( 'prods_per_page_lp', $this->opt('prods_per_page', '6') ),
			),
			'woo_bs_prod' => array(
				'wtitle' => $this->opt( 'woo_bsp_title', __('BEST SELLING PRODUCTS', 'zn_framework' ) ),
				'wcarousel' => $this->opt('woo_bs_crs', '1'),
				'wcols' => $this->opt('woo_bs_perrow','4'),
				'wauto' => $this->opt( 'woo_bs_auto', '' ),
				'wtimeout' => $this->opt( 'woo_bs_timeout', '5000' ),
				'wcats' => $this->opt( 'woo_categories_bs', $this->opt('woo_categories', false) ),
				'wtags' => $this->opt( 'woo_tags_bs', $this->opt('woo_tags', false) ),
				'wload' => $this->opt( 'prods_per_page_bs', $this->opt('prods_per_page', '6') ),
			),
		);

		?>

			<div class="shop-latest spp-el <?php echo implode(' ', $elm_classes); ?>" <?php echo $attributes; ?>>
				<div class="<?php echo $layout_type; ?> spp-el-type">

				<?php
				// Disply tabs
				if($layout == 'tabs') { ?>
					<ul class=" spp-el-nav fixclear">
						<?php

						$i = 0;
						foreach ($types as $type => $name) {
							if ($this->opt($type) == 1) {
								$cls = '';
								if ($i == 0) {
									$cls = 'active';
								}
								echo '<li class="spp-el-item text-custom-parent-act ' . $cls . '"><a href="#tabpan_' . $randId . $i . '" data-toggle="tab" class="spp-el-nav-link text-custom-active kl-font-alt">' . $name['wtitle'] . '</a></li>';
								$i++;
							}
						}
						?>
					</ul>

					<div class="tab-content spp-el-tab-content">
					<?php
					}
						$i = 0;
						foreach ($types as $type => $name) {
							if ($this->opt($type) == 1) {
								$cls = '';
								if ($i == 0) {
									$cls = 'active';
								}

								// If layout == tabs
								if ($layout == 'tabs') {
									echo '<div class="tab-pane spp-el-tabpane ' . $cls . '" id="tabpan_' . $randId . $i . '">';
								} else {
									echo '<div class="row">';
									echo '<div class="col-sm-12">';
										echo '<h3 class="m_title m_title_ext text-custom ff-alternative spp-title spp-el-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $name['wtitle'] . '</h3>';
									echo '</div>';
									echo '<div class="col-sm-12">';
								}

								$product_query = $this->get_query($type, $name);

								// TODO: Decide wether to auto-disable carousel if less than 3 items are published
								// Knowing that there's already an option to disable the carousel.
								// Code:
								// $pcount = $product_query->post_count;
								// $isCarousel = $name['wcarousel'] == 1 && $pcount > 3;

								$isCarousel = $name['wcarousel'] == 1;

								echo '<div class="shop-latest-carousel spp-carousel '. ( $isCarousel ? 'spp-carousel--enabled': 'spp-carousel--disabled' ) .'">';

									if ($product_query->have_posts()) {
										echo '<ul class="featured_products spp-carousel-list spp-list--cols-'.$name['wcols'].' '.( $isCarousel != 1 ? 'clearfix': '' ).'" data-autoplay="'.$name['wauto'].'" data-timeout="'.$name['wtimeout'].'" data-visible="'.$name['wcols'].'">';

										while ($product_query->have_posts()) {
											$product_query->the_post();
											global $product;
											// bail
											if (!isset($product) || empty($product) || !is_object($product)) {
												continue;
											}
											wc_get_template_part( 'content', 'product' );
										}

										echo '</ul>';

										if( $isCarousel ){
											echo '<div class="spp-carousel-controls">';
												echo '<a href="#" class="prev spp-carousel-controls-nav"><span class="glyphicon glyphicon-chevron-left"></span></a>';
												echo '<a href="#" class="next spp-carousel-controls-nav"><span class="glyphicon glyphicon-chevron-right"></span></a>';
											echo '</div>';
										}
									}
									else {
										echo '<p>'. __('Sorry, no products matched your criteria.', 'zn_framework' ) .'</p>';
									}

								echo '</div>';

								if ($layout == 'tabs') {
									echo '</div>';
								} else {
									echo '</div>';
									echo '</div>';
								}

								$i++;
							}
						}

					if($layout == 'tabs') {
						echo '</div>'; // End tab-content
					}
					?>
			</div><!-- /.tabbable / spp-products-rows -->
		</div>
		<!-- end shop latest -->

	<?php
		wp_reset_query();
	}

	function get_query( $type, $name )
	{
		/*
		* Get all product category Ids.
		* They will be used if there are no categories selected in the Page Builder element.
		*/
		// $categories = $this->opt( 'woo_categories', false );
		$categories = $name['wcats'];
		//@since v4.1
		$tags = $name['wtags'];

		$hasCats = (! empty($categories));
		$hasTags = (! empty($tags));

		$query_args = array (
			'posts_per_page' => $name['wload'],
			'no_found_rows'  => 1,
			'post_status'    => 'publish',
			'post_type'      => 'product',
		);

		if( ! empty($categories) ){
			$query_args['tax_query'] = array (
				array (
					'taxonomy' => 'product_cat',
					'field'    => 'id',
					'terms'    => $categories,
				),
			);

		}

		//@since v4.1
		if ( $hasTags ) {
			if ( ! isset( $query_args['tax_query'] ) ) {
				$query_args['tax_query'] = array();
			}
			else{
				// This means we already have tax query set, just add the relation
				$query_args['tax_query']['relation'] = 'AND';
			}
			array_push( $query_args['tax_query'], array(
				'taxonomy' => 'product_tag',
				'field'    => 'term_id',
				'terms'    => $tags,
				'operator' => 'IN',
			) );
		}

		// Add meta key => value for the current type
		// Best selling
		if( $type == 'woo_bs_prod' ){
			$query_args['meta_key'] = 'total_sales';
			$query_args['ignore_sticky_posts'] = 1;
			$query_args['orderby'] = 'meta_value_num';
		}

		// Featured products
		if( $type == 'woo_fp_prod' ){
			$query_args['meta_key'] = '_featured';
			$query_args['meta_value'] = 'yes';
		}

		return new WP_Query( $query_args );
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		/*
		 * Get Shop categories
		 */
		$categories = WpkZn::getShopCategories();

		// Get product tags
		$tags = WpkZn::getShopTags();

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						'name'        => __( 'Display style', 'zn_framework' ),
						'description' => __( 'Select the display layout.', 'zn_framework' ),
						'id'          => 'woo_spp_display',
						'std'         => 'tabs',
						'options'     => array ( 'tabs' => __( 'Tabs', 'zn_framework' ), 'rows' => __( 'Simple Rows', 'zn_framework' ) ),
						'type'        => 'select',
					),

					array (
						'name'        => __( 'Shop Category', 'zn_framework' ),
						'description' => __( 'Select the shop category to show items', 'zn_framework' ),
						'id'          => 'woo_categories',
						'multiple'    => true,
						'std'         => '0',
						'type'        => 'select',
						'options'     => $categories,
					),
					array (
						'name'        => __( 'Product tags', 'zn_framework' ),
						'description' => __( 'Filter products by tags', 'zn_framework' ),
						'id'          => 'woo_tags',
						'multiple'    => true,
						'std'         => '0',
						'type'        => 'select',
						'options'     => $tags,
					),
					array (
						'name'        => __( 'Number of products to load', 'zn_framework' ),
						'description' => __( 'Please enter how many products you want to LOAD into the query.', 'zn_framework' ),
						'id'          => 'prods_per_page',
						'std'         => '6',
						'type'        => 'text',
					),
					array(
						'id'          => 'element_scheme',
						'name'        => 'Element Color Scheme',
						'description' => 'Select the color scheme of this element',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
							'light' => 'Light (default)',
							'dark' => 'Dark',
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'spp--',
								),
							),
						),
					),
				),
			),

			'featured' => array(
				'title' => 'Featured',
				'options' => array(

					array (
						'name'        => __( 'Show Featured Products?', 'zn_framework' ),
						'description' => __( 'Select yes if you want to show the featured products.', 'zn_framework' ),
						'id'          => 'woo_fp_prod',
						'std'         => '1',
						'options'     => array ( '1' => __( 'Yes', 'zn_framework' ), '0' => __( 'No', 'zn_framework' ) ),
						'type'        => 'zn_radio',
						"class"        => "zn_radio--yesno",
					),
					array (
						'name'        => __( 'Featured Products Title', 'zn_framework' ),
						'description' => __( 'Please enter a title for the featured products. If no title is set, the default title
									will be shown ( FEATURED PRODUCTS )', 'zn_framework' ),
						'id'          => 'woo_fp_title',
						'std'         => '',
						'type'        => 'text',
						'placeholder' => 'eg: FEATURED PRODUCTS',
						// 'dependency'  => array( 'element' => 'woo_fp_prod', 'value' => array('1') ),
					),

					array (
						'name'        => __( 'Products Per Row OR Visible in carousel', 'zn_framework' ),
						'description' => __( 'Please select how many products per row to display, or visible into the carousel.', 'zn_framework' ),
						'id'          => 'woo_fp_perrow',
						'std'         => '4',
						'type'        => 'select',
						'options'        => array(
							'1' => '1 per row',
							'2' => '2 per row',
							'3' => '3 per row',
							'4' => '4 per row',
							'5' => '5 per row',
							'6' => '6 per row',
						),
						// 'dependency'  => array( 'element' => 'woo_fp_crs', 'value' => array('0') ),
					),

					array (
						'name'        => __( 'Enable Carousel', 'zn_framework' ),
						'description' => __( 'Please select if you want the products to be wrapped into a carousel.', 'zn_framework' ),
						'id'          => 'woo_fp_crs',
						'std'         => '1',
						'options'     => array ( '1' => __( 'Yes', 'zn_framework' ), '0' => __( 'No', 'zn_framework' ) ),
						'type'        => 'zn_radio',
						"class"        => "zn_radio--yesno",
					),
					array (
						'name'        => __( 'Enable Autoplay?', 'zn_framework' ),
						'description' => __( 'Please select if you want the Featured Products panel to be auto-played.', 'zn_framework' ),
						'id'          => 'woo_fp_auto',
						'std'         => '',
						'value'         => 'yes',
						'type'        => 'toggle2',
						'dependency'  => array( 'element' => 'woo_fp_crs', 'value' => array('1') ),
					),
					array (
						'name'        => __( 'Autoplay timeout', 'zn_framework' ),
						'description' => __( 'If autoplay is enabled, please select the autoplay timeout, duration between the carousel will slide. Add in miliseconds, 5000ms = 5 seconds .', 'zn_framework' ),
						'id'          => 'woo_fp_timeout',
						'std'         => '5000',
						'type'        => 'text',
						'dependency'  => array( 'element' => 'woo_fp_crs', 'value' => array('1') ),
					),

					array(
						'id'          => 'title1',
						'name'        => 'Overrides',
						'description' => 'These options will override the defaults.',
						'type'        => 'zn_title',
						'class'        => 'zn_full zn-custom-title-large',
					),
					array (
						'name'        => __( 'Shop Category <strong>[Override default]</strong>', 'zn_framework' ),
						'description' => __( 'Select the shop category to show items', 'zn_framework' ),
						'id'          => 'woo_categories_fp',
						'multiple'    => true,
						'std'         => '0',
						'type'        => 'select',
						'options'     => $categories,
					),
					array (
						'name'        => __( 'Product tags <strong>[Override default]</strong>', 'zn_framework' ),
						'description' => __( 'Filter products by tags', 'zn_framework' ),
						'id'          => 'woo_tags_fp',
						'multiple'    => true,
						'std'         => '0',
						'type'        => 'select',
						'options'     => $tags,
					),
					array (
						'name'        => __( 'Number of products <strong>[Override default]</strong>', 'zn_framework' ),
						'description' => __( 'Please enter how many products you want to LOAD.', 'zn_framework' ),
						'id'          => 'prods_per_page_fp',
						'std'         => '',
						'type'        => 'text',
					),
				),
			),

			'latest' => array(
				'title' => 'Latest',
				'options' => array(

					array (
						'name'        => __( 'Show Latest Products?', 'zn_framework' ),
						'description' => __( 'Select yes if you want to show the latest products.', 'zn_framework' ),
						'id'          => 'woo_lp_prod',
						'std'         => '1',
						'options'     => array ( '1' => __( 'Yes', 'zn_framework' ), '0' => __( 'No', 'zn_framework' ) ),
						'type'        => 'zn_radio',
						"class"        => "zn_radio--yesno",
					),

					array (
						'name'        => __( 'Latest Products Title', 'zn_framework' ),
						'description' => __( 'Please enter a title for the latest products. If no title is set, the default title will be shown ( LATEST PRODUCTS )', 'zn_framework' ),
						'id'          => 'woo_lp_title',
						'std'         => '',
						'type'        => 'text',
						'placeholder' => 'eg: LATEST PRODUCTS',
					),

					array (
						'name'        => __( 'Products Per Row OR Visible in carousel', 'zn_framework' ),
						'description' => __( 'Please select how many products per row to display, or visible into the carousel.', 'zn_framework' ),
						'id'          => 'woo_lp_perrow',
						'std'         => '4',
						'type'        => 'select',
						'options'        => array(
							'1' => '1 per row',
							'2' => '2 per row',
							'3' => '3 per row',
							'4' => '4 per row',
							'5' => '5 per row',
							'6' => '6 per row',
						),
						// 'dependency'  => array( 'element' => 'woo_lp_crs', 'value' => array('0') ),
					),

					array (
						'name'        => __( 'Enable Carousel', 'zn_framework' ),
						'description' => __( 'Please select if you want the products to be wrapped into a carousel.', 'zn_framework' ),
						'id'          => 'woo_lp_crs',
						'std'         => '1',
						'options'     => array ( '1' => __( 'Yes', 'zn_framework' ), '0' => __( 'No', 'zn_framework' ) ),
						'type'        => 'zn_radio',
						"class"        => "zn_radio--yesno",
					),
					array (
						'name'        => __( 'Enable Autoplay?', 'zn_framework' ),
						'description' => __( 'Please select if you want the Latest Products panel to be auto-played.', 'zn_framework' ),
						'id'          => 'woo_lp_auto',
						'std'         => '',
						'value'         => 'yes',
						'type'        => 'toggle2',
						'dependency'  => array( 'element' => 'woo_lp_crs', 'value' => array('1') ),
					),
					array (
						'name'        => __( 'Autoplay timeout', 'zn_framework' ),
						'description' => __( 'If autoplay is enabled, please select the autoplay timeout, duration between the carousel will slide. Add in miliseconds, 5000ms = 5 seconds .', 'zn_framework' ),
						'id'          => 'woo_lp_timeout',
						'std'         => '5000',
						'type'        => 'text',
						'dependency'  => array( 'element' => 'woo_lp_crs', 'value' => array('1') ),
					),

					array(
						'id'          => 'title1',
						'name'        => 'Overrides',
						'description' => 'These options will override the defaults.',
						'type'        => 'zn_title',
						'class'        => 'zn_full zn-custom-title-large',
					),

					array (
						'name'        => __( 'Shop Category <strong>[Override default]</strong>', 'zn_framework' ),
						'description' => __( 'Select the shop category to show items', 'zn_framework' ),
						'id'          => 'woo_categories_lp',
						'multiple'    => true,
						'std'         => '0',
						'type'        => 'select',
						'options'     => $categories,
					),
					array (
						'name'        => __( 'Product tags <strong>[Override default]</strong>', 'zn_framework' ),
						'description' => __( 'Filter products by tags', 'zn_framework' ),
						'id'          => 'woo_tags_lt',
						'multiple'    => true,
						'std'         => '0',
						'type'        => 'select',
						'options'     => $tags,
					),
					array (
						'name'        => __( 'Number of products <strong>[Override default]</strong>', 'zn_framework' ),
						'description' => __( 'Please enter how many products you want to LOAD.', 'zn_framework' ),
						'id'          => 'prods_per_page_lp',
						'std'         => '',
						'type'        => 'text',
					),

				),
			),
			'best' => array(
				'title' => 'Best-Selling',
				'options' => array(

					array (
						'name'        => __( 'Show Best Selling Products', 'zn_framework' ),
						'description' => __( 'Select yes if you want to show the best selling products.', 'zn_framework' ),
						'id'          => 'woo_bs_prod',
						'std'         => '1',
						'options'     => array ( '1' => __( 'Yes', 'zn_framework' ), '0' => __( 'No', 'zn_framework' ) ),
						'type'        => 'zn_radio',
						"class"        => "zn_radio--yesno",
					),
					array (
						'name'        => __( 'Best Selling Title', 'zn_framework' ),
						'description' => __( 'Please enter a title for the best selling products. If no title is set , the default
									title will be shown ( BEST SELLING PRODUCTS )', 'zn_framework' ),
						'id'          => 'woo_bsp_title',
						'std'         => '',
						'type'        => 'text',
						'placeholder' => 'eg: BEST SELLING PRODUCTS',
						// 'dependency'  => array( 'element' => 'woo_bs_prod', 'value' => array('1') ),
					),

					array (
						'name'        => __( 'Products Per Row OR Visible in carousel', 'zn_framework' ),
						'description' => __( 'Please select how many products per row to display, or visible into the carousel.', 'zn_framework' ),
						'id'          => 'woo_bs_perrow',
						'std'         => '4',
						'type'        => 'select',
						'options'        => array(
							'1' => '1 per row',
							'2' => '2 per row',
							'3' => '3 per row',
							'4' => '4 per row',
							'5' => '5 per row',
							'6' => '6 per row',
						),
						// 'dependency'  => array( 'element' => 'woo_bs_crs', 'value' => array('0') ),
					),

					array (
						'name'        => __( 'Enable Carousel', 'zn_framework' ),
						'description' => __( 'Please select if you want the products to be wrapped into a carousel.', 'zn_framework' ),
						'id'          => 'woo_bs_crs',
						'std'         => '1',
						'options'     => array ( '1' => __( 'Yes', 'zn_framework' ), '0' => __( 'No', 'zn_framework' ) ),
						'type'        => 'zn_radio',
						"class"        => "zn_radio--yesno",
					),
					array (
						'name'        => __( 'Enable Autoplay?', 'zn_framework' ),
						'description' => __( 'Please select if you want the Best Selling panel to be auto-played.', 'zn_framework' ),
						'id'          => 'woo_bs_auto',
						'std'         => '',
						'value'         => 'yes',
						'type'        => 'toggle2',
						'dependency'  => array( 'element' => 'woo_bs_crs', 'value' => array('1') ),
					),
					array (
						'name'        => __( 'Autoplay timeout', 'zn_framework' ),
						'description' => __( 'If autoplay is enabled, please select the autoplay timeout, duration between the carousel will slide. Add in miliseconds, 5000ms = 5 seconds .', 'zn_framework' ),
						'id'          => 'woo_bs_timeout',
						'std'         => '5000',
						'type'        => 'text',
						'dependency'  => array( 'element' => 'woo_bs_crs', 'value' => array('1') ),
					),

					array(
						'id'          => 'title1',
						'name'        => 'Overrides',
						'description' => 'These options will override the defaults.',
						'type'        => 'zn_title',
						'class'        => 'zn_full zn-custom-title-large',
					),
					array (
						'name'        => __( 'Shop Category <strong>[Override default]</strong>', 'zn_framework' ),
						'description' => __( 'Select the shop category to show items', 'zn_framework' ),
						'id'          => 'woo_categories_bs',
						'multiple'    => true,
						'std'         => '0',
						'type'        => 'select',
						'options'     => $categories,
					),
					array (
						'name'        => __( 'Product tags <strong>[Override default]</strong>', 'zn_framework' ),
						'description' => __( 'Filter products by tags', 'zn_framework' ),
						'id'          => 'woo_tags_bs',
						'multiple'    => true,
						'std'         => '0',
						'type'        => 'select',
						'options'     => $tags,
					),
					array (
						'name'        => __( 'Number of products <strong>[Override default]</strong>', 'zn_framework' ),
						'description' => __( 'Please enter how many products you want to LOAD.', 'zn_framework' ),
						'id'          => 'prods_per_page_bs',
						'std'         => '',
						'type'        => 'text',
					),
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#hy-twTGcQ7c',
				'docs'    => 'http://support.hogash.com/documentation/shop-products-presentation/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}

<?php if(! defined('ABSPATH')){ return; }
/*
 Name: WooCommerce archive
 Description: Create and display the current post content
 Class: TH_ProductArchive
 Category: content
 Level: 3
 Dependency_class: WooCommerce
 Keywords: shop, category, store
*/

/**
 * Class TH_ProductArchive
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ProductArchive extends ZnElements
{
	public static function getName(){
		return __( "WooCommerce archive", 'zn_framework' );
	}

	// Notify WooCommerce we've changed the number of columns
	function zn_woo_loop_columns(){
		return $this->opt( 'num_columns', '4' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{

		$options = $this->data['options'];

		// Check if this is a normal page or the Shop archive page
		if( ! is_shop()  ){

			global $paged;

			$wc_query = new WC_Query();
			$categories = $this->opt('woo_categories', false);

			// Get the proper page - this resolves the pagination on static frontpage
			if( get_query_var('paged') ){ $paged = get_query_var('paged'); }
			elseif( get_query_var('page') ){ $paged = get_query_var('page'); }
			else{ $paged = 1; }

			$ordering = $wc_query->get_catalog_ordering_args();

			$queryArgs = array(
				'post_type' => 'product',
				'paged' => $paged,
				'orderby' => $ordering['orderby'],
				'order' => $ordering['order'],
			);

			// How many products to display per page
			$posts_per_page = $this->opt('posts_per_page');
			if( ! empty( $posts_per_page ) ){
				$queryArgs['posts_per_page'] = ( int )$posts_per_page;
			}

			if( ! empty( $categories ) ){
				$queryArgs['tax_query'] = array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'id',
						'terms' => $categories
					),
				);
			}


			if ( isset( $ordering['meta_key'] ) ) {
				$queryArgs['meta_key'] = $ordering['meta_key'];
			}

			query_posts($queryArgs);
		}

		// Notify WooCommerce we've overridden the default number of columns (in kallyas options)
		add_filter('loop_shop_columns', array( &$this,'zn_woo_loop_columns') , 999);
		$sidebar_tweak = $this->opt( 'num_columns', '4' ) == '3' ? 'left_sidebar' : '';

		echo '<div class="zn_woo_archive_elemenent woocommerce '.$this->data['uid'].' '.$sidebar_tweak.' '.zn_get_element_classes($options).'" '.zn_get_element_attributes($options).'>';
?>

		<?php if ( $this->opt( 'show_page_title', 'yes' ) == 'yes' ) : ?>
			<h1 class="page-title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>

		<?php
		/**
		 * woocommerce_archive_description hook
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

		<?php
		/**
		 * woocommerce_before_shop_loop hook
		 *
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action( 'woocommerce_before_shop_loop' );
		?>

		<?php woocommerce_product_loop_start(); ?>

		<?php woocommerce_product_subcategories(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'product' ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

		<?php
		/**
		 * woocommerce_after_shop_loop hook
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
		?>

	<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

		<?php wc_get_template( 'loop/no-products-found.php' ); ?>

	<?php endif; ?>

<?php
wp_reset_postdata();
wp_reset_query();

		echo '</div>';
	}

	 /**
	  * This method is used to display the output of the element.
	  * @return void
	  */
	 function element_edit()
	 {
		 echo '<div class="zn-pb-notification">This element will be rendered only in View Page Mode and not in PageBuilder Edit Mode.</div>';
	 }

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		/*
		 * Get Shop categories
		 */
		$categories = WpkZn::getShopCategories();

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						"name" => __("Number of columns", 'zn_framework'),
						"description" => __("Please choose how many columns you want to use.", 'zn_framework'),
						"id" => "num_columns",
						"std" => "4",
						"options" => array(
							'3' => __('3', 'zn_framework'),
							'4' => __('4', 'zn_framework'),
							'5' => __('5', 'zn_framework'),
							'6' => __('6', 'zn_framework'),
						),
						"type" => "select",
					),
					array(
						'id'          => 'posts_per_page',
						'name'        => 'Number of items per page',
						'description' => 'Please choose the desired number of items that will be shown on a page.',
						'type'        => 'slider',
						'std'		  => '10',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '1',
							'max' => '50',
							'step' => '1'
						),
					),
					array (
						"name"        => __( "Shop Category", 'zn_framework' ),
						"description" => __( "Select the shop category to show items. Please note that this won't work on the selected shop page.", 'zn_framework' ),
						"id"          => "woo_categories",
						"multiple"    => true,
						"std"         => "0",
						"type"        => "select",
						"options"     => $categories
					),
					array(
						"name" => __("Show page title ?", 'zn_framework'),
						"description" => __("Choose if you want to show the page title. Please note that if you select to only show products from specific categories, the title will show the first category name.", 'zn_framework'),
						"id" => "show_page_title",
						"std" => "yes",
						"type" => "toggle2",
						"value" => "yes",
					),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#a6Cr0PG3TFQ',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}


}

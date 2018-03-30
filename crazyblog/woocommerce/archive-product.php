<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
$catalog_orderby_options = array(
	'menu_order' => esc_html__( 'Default sorting', 'crazyblog' ),
	'popularity' => esc_html__( 'Sort by popularity', 'crazyblog' ),
	'rating' => esc_html__( 'Sort by average rating', 'crazyblog' ),
	'date' => esc_html__( 'Sort by newness', 'crazyblog' ),
	'price' => esc_html__( 'Sort by price: low to high', 'crazyblog' ),
	'price-desc' => esc_html__( 'Sort by price: high to low', 'crazyblog' ),
	'best_seller' => esc_html__( 'Best Seller', 'crazyblog' ),
	'featured' => esc_html__( 'Featured', 'crazyblog' ),
	'onsale' => esc_html__( 'On Sale', 'crazyblog' ),
);
$settings = crazyblog_opt();
$object = get_queried_object();
if ( is_product_category() ) {
	$sidebar = (crazyblog_set( $settings, 'shop_cat_sidebar' )) ? crazyblog_set( $settings, 'shop_cat_sidebar' ) : '';
	$layout = (crazyblog_set( $settings, 'shop_cat_sidebar_layout' )) ? crazyblog_set( $settings, 'shop_cat_sidebar_layout' ) : '';
	$show_banner = crazyblog_set( $settings, 'shop_cat_title_section' );
	$bg = (crazyblog_set( $settings, 'shop_cat_title_section_bg' )) ? 'style=background:url(' . crazyblog_set( $settings, 'shop_cat_title_section_bg' ) . ')' : "";
	$title = (crazyblog_set( $settings, 'shop_cate_title' )) ? crazyblog_set( $settings, 'shop_cate_title' ) : $object->name;
	$col = (!empty( $sidebar ) && !empty( $layout )) ? 'col-md-8' : 'col-md-12';
} else if ( is_product_tag() ) {
	$sidebar = (crazyblog_set( $settings, 'shop_tag_sidebar' )) ? crazyblog_set( $settings, 'shop_tag_sidebar' ) : '';
	$layout = (crazyblog_set( $settings, 'shop_tag_sidebar_layout' )) ? crazyblog_set( $settings, 'shop_tag_sidebar_layout' ) : '';
	$show_banner = crazyblog_set( $settings, 'shop_tag_title_section' );
	$bg = (crazyblog_set( $settings, 'shop_tag_title_section_bg' )) ? 'style=background:url(' . crazyblog_set( $settings, 'shop_tag_title_section_bg' ) . ')' : "";
	$title = (crazyblog_set( $settings, 'shop_tag_title' )) ? crazyblog_set( $settings, 'shop_tag_title' ) : $object->name;
	$col = (!empty( $sidebar ) && !empty( $layout )) ? 'col-md-8' : 'col-md-12';
} else {
	$sidebar = (crazyblog_set( $settings, 'shop_page_sidebar' )) ? crazyblog_set( $settings, 'shop_page_sidebar' ) : '';
	$layout = (crazyblog_set( $settings, 'shop_sidebar_layout' )) ? crazyblog_set( $settings, 'shop_sidebar_layout' ) : '';
	$show_banner = crazyblog_set( $settings, 'shop_page_title_section' );
	$bg = (crazyblog_set( $settings, 'shop_title_section_bg' )) ? 'style=background:url(' . crazyblog_set( $settings, 'shop_title_section_bg' ) . ')' : "";
	$title = (crazyblog_set( $settings, 'shop_page_title' )) ? crazyblog_set( $settings, 'shop_page_title' ) : woocommerce_page_title( false );
	$col = (!empty( $sidebar ) && !empty( $layout )) ? 'col-md-8' : 'col-md-12';
}
wp_enqueue_script( 'select2' );
if ( $show_banner ) :
	?>
	<div class="pagetop" <?php echo esc_attr( $bg ); ?>>
		<div class="page-name">
			<div class="container">
				<span><?php echo esc_html( $title ) ?></span>
				<?php echo crazyblog_get_breadcrumbs(); ?>
			</div>
		</div>
	</div>

	<?php
endif;
/**
 * woocommerce_archive_description hook.
 *
 * @hooked woocommerce_taxonomy_archive_description - 10
 * @hooked woocommerce_product_archive_description - 10
 */
crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-isotope', 'df-init-isotope', 'df-select2' ) );
?>
<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<?php if ( !empty( $sidebar ) && $layout == 'left' && is_active_sidebar( $sidebar ) ): ?>
					<aside class="col-md-4 column left-sidebar sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
				<div class="<?php echo esc_attr( $col ) ?>">
					<div class="shop-products">
						<?php if ( have_posts() ) : ?>
							<div class="woo-notices">
								<?php
								do_action( 'woocommerce_before_shop_loop' );
								?>
							</div>
							<div class="filter-bar">
								<div class="view-as-product">
									<label><?php echo esc_html_e( 'View as', 'crazyblog' ) ?></label>
									<a title="" class="grid-view"><i class="fa fa-th-large"></i></a>
									<a title="" class="list-view"><i class="fa fa-list-ul"></i></a>
								</div>
								<div class="sort-by">
									<label><?php echo esc_html_e( 'SORT BY', 'crazyblog' ) ?></label>
									<form class="woocommerce-ordering" method="get">
										<select name="orderby" class="orderby selectpicker" id="selectpicker3">
											<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
												<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
											<?php endforeach; ?>
										</select>
										<?php
										// Keep query string vars intact
										foreach ( $_GET as $key => $val ) {
											if ( 'orderby' === $key || 'submit' === $key ) {
												continue;
											}
											if ( is_array( $val ) ) {
												foreach ( $val as $innerVal ) {
													echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
												}
											} else {
												echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
											}
										}
										?>
									</form>
								</div>
							</div>

							<?php woocommerce_product_subcategories(); ?>
							<div class="row">
							<div class="shop">
									<?php while ( have_posts() ) : the_post(); ?>
										<?php wc_get_template_part( 'content', 'product' ); ?>
									<?php endwhile; ?>
							</div>
							</div>

							<?php
							/**
							 * woocommerce_after_shop_loop hook.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
							?>
						<?php elseif ( !woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
							<?php wc_get_template( 'loop/no-products-found.php' ); ?>	
						<?php endif; ?>
					</div>
				</div>
				<?php if ( !empty( $sidebar ) && $layout == 'right' && is_active_sidebar( $sidebar ) ): ?>
					<aside class="col-md-4 column right-sidebar sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php 
    
    $custom_script = 'jQuery(document).ready(function ($) {
        $("select#selectpicker3").select2();
    });';
    wp_add_inline_script('crazyblog_df-select2', $custom_script);   
?>
<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
get_footer();
?>

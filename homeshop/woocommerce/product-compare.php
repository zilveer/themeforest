<?php
/**
 * The Template for compare products
 *
 * Override this template by copying it to yourtheme/woocommerce/product-compare.php
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

		$woo_compare_logo = get_option('woo_compare_logo');
		$suffix	= defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		
		global $woocommerce, $woo_compare_page_style, $woo_compare_close_window_button_style, $woo_compare_viewcart_style;
		global $woo_compare_comparison_page_global_settings;
		global $woo_compare_print_page_settings;
		
		$wc_frontend_script_path = str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/js/frontend/';
		
		// Variables for JS scripts
		$woocommerce_params = array(
			'ajax_url'                         => WC()->ajax_url(),
			'ajax_loader_url'                  => apply_filters( 'woocommerce_ajax_loader_url', str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/images/ajax-loader@2x.gif' ),
			'i18n_view_cart'                   => $woo_compare_viewcart_style['viewcart_text'],
			'cart_url'                         => get_permalink( wc_get_page_id( 'cart' ) ),
			'is_cart'						   => false,
			'cart_redirect_after_add'          => get_option( 'woocommerce_cart_redirect_after_add' )
		);

		
get_header(); 		
?>




<!-- Banner -->
<section class="banner">

<?php dynamic_sidebar( 'Banner Top Sidebar' ); ?>

</section>
<!-- /Banner -->


<?php
		$sidebar_id = get_meta_option('custom_sidebar');
		$sidebar_position = get_meta_option('sidebar_position_meta_box');
		?>

	
	<!-- Content -->
	
		 <?php if( $sidebar_position == 'left' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">
	<?php }
	if( $sidebar_position == 'right' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9">
	<?php }
	if( $sidebar_position == 'full' ) { ?>
	<section class="main-content col-lg-12 col-md-12 col-sm-12">
	<?php }  ?>
   
   
   
   <div class="row">
                    
		<!-- Heading -->
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading">
				<h4><?php _e( 'Compare Products', 'homeshop' ); ?></h4>
				<div class="carousel-arrows">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="icons icon-reply"></i></a>
				</div>
			</div>
			
		</div>
		<!-- /Heading -->
		
	</div>	
   
   
   
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   
    <?php do_action('woocp_comparison_table_before'); ?>
   
    <div style="clear:both;"></div>
    <div class="popup_woo_compare_widget_loader" style="display:none;"><img src="<?php echo WOOCP_IMAGES_URL; ?>/ajax-loader.gif" border=0 /></div>
          
    <div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12 compare_popup_wrap">

		<?php echo get_compare_list_html_popup1();?>
		
		</div>
		
	</div>
   
   
    <?php do_action('woocp_comparison_table_after'); ?>
  

   <?php endwhile; ?>
   
    </section>
	<!-- /Main Content -->
   
   
   <?php 
	if( $sidebar_position != 'full' ) {
		if( $sidebar_position == 'left' ) { ?>
		<aside class="sidebar col-lg-3 col-md-3 col-sm-3  col-lg-pull-9 col-md-pull-9 col-sm-pull-9">
		<?php } if( $sidebar_position == 'right' ) { ?>
		<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } ?>
		
		<?php mm_sidebar('blog',$sidebar_id);?>
		</aside>
	<?php } ?>
   
    <?php
		$woocp_compare_events = wp_create_nonce("woocp-compare-events");
	?>
    <script type="text/javascript">
			jQuery(document).ready(function($) {
						var ajax_url = "<?php echo admin_url( 'admin-ajax.php', 'relative' );?>";
						<?php if ( $woo_compare_print_page_settings['enable_print_page_feature'] == 1 ) { ?>
						$(document).on("click", "#woo_compare_print", function(){
							$(".compare_print_container").printElement({
								printBodyOptions:{
								styleToAdd:"overflow:visible !important;",
								classNameToAdd : "compare_popup_print"
								}
							});
						});
						<?php } ?>
						$(document).on("click", ".woo_compare_popup_remove_product", function(){
							var popup_remove_product_id = $(this).attr("rel");
							$(".popup_woo_compare_widget_loader").show();
							//$(".compare_popup_wrap").html("");
							$("#bg-labels").remove();
							var data = {
								action: 		"woocp_remove_from_popup_compare",
								product_id: 	popup_remove_product_id,
								security: 		"<?php echo $woocp_compare_events; ?>"
							};
							$.post( ajax_url, data, function(response) {
								data = {
									action: 		"woocp_update_compare_popup",
									security: 		"<?php echo $woocp_compare_events; ?>"
								};
								$.post( ajax_url, data, function(response) {
									result = $.parseJSON( response );
									$(".popup_woo_compare_widget_loader").hide();
									//$(".compare_popup_wrap").html(result);
									location.reload();

								});
								
								data = {
									action: 		"woocp_update_compare_widget",
									security: 		"<?php echo $woocp_compare_events; ?>"
								};
								$.post( ajax_url, data, function(response) {
									new_widget = $.parseJSON( response );
									$(".woo_compare_widget_container").html(new_widget);
								});
							});
						});
						$(document).on( 'click', '.add_to_cart_button', function() {
							$(this).parent().find('.virtual_added_to_cart').remove();
							setTimeout(function(){ $(document).find('.added_to_cart').attr('target', 'parent'); }, 3000);
						});
			});
		</script>
   <?php do_action('woocp_comparison_page_footer'); ?>
        <script src="<?php echo WOOCP_JS_URL; ?>/fixedcolumntable/fixedcolumntable.js"></script>
        <script src="<?php echo $wc_frontend_script_path; ?>add-to-cart-variation<?php echo $suffix; ?>.js"></script>
        <script src="<?php echo $wc_frontend_script_path; ?>add-to-cart<?php echo $suffix; ?>.js"></script>
        <script src="<?php echo str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ); ?>/assets/js/jquery-blockui/jquery.blockUI<?php echo $suffix; ?>.js"></script>
<script type="text/javascript">
/* !![CDATA[ */
var wc_add_to_cart_params = <?php echo json_encode( $woocommerce_params, JSON_FORCE_OBJECT) ?>;
/* ]]> */
</script>

<?php get_footer(); ?>
	
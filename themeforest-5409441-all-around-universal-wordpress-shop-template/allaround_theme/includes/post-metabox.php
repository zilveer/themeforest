<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */
 
// Post metabox
if ( is_admin() ) :
function allaround_admin_post_enqueue_scripts( $hook_suffix ) {
	global $post;
	if ( $hook_suffix == 'post-new.php' || $hook_suffix == 'post.php' ) {
		allaround_page_style_only();
		allaround_page_load_only();
	}
}
add_action( 'admin_enqueue_scripts', 'allaround_admin_post_enqueue_scripts' );

// Metabox register
add_action( 'add_meta_boxes', 'allaround_create_metabox' );
add_action( 'save_post', 'allaround_save_meta', 10, 2 );
function allaround_create_metabox() {
	add_meta_box( 'allaround_featured_metabox', __( 'Page settings', 'allaround' ), 'allaround_featured_metabox', 'page', 'normal', 'high' );
	add_meta_box( 'allaround_products_metabox', __( 'Products settings', 'allaround' ), 'allaround_products_metabox', 'product', 'normal', 'low' );
}

// Metabox Pages
function allaround_featured_metabox() {
	global $page_options, $page_options_machine;
	$page_options_machine = new Page_Options_Machine($page_options);	
	include_once( ADMIN_PATH . 'front-end/options-page.php' );	
}

// Metabox Products
function allaround_products_metabox() {
	global $products_options, $products_options_machine;
	$products_options_machine = new Page_Options_Machine($products_options);	
	include_once( ADMIN_PATH . 'front-end/options-products.php' );	
}

// Save metadata
function allaround_save_meta( $post_id, $post ) {
	if( !defined( 'DOING_AJAX'  )) {
		if ( isset( $_POST[OPTIONS.'_default_meta'] ) ) { if ( $_POST[OPTIONS.'_default_meta'] OR $_POST[OPTIONS.'_default_meta'] == '' ) update_post_meta( $post_id, OPTIONS.'_default_meta', $_POST[OPTIONS.'_default_meta'] ); } else { update_post_meta( $post_id, OPTIONS.'_default_meta', 'none' ); }
	}
}
endif;

/**
 * Create Options page
 *
 * @uses wp_enqueue_style()
 *
 * @since 1.0.0
 */
function allaround_page_style_only(){
	wp_enqueue_style('admin-style', ADMIN_DIR . 'assets/css/admin-style.css');
	wp_enqueue_style('color-picker', ADMIN_DIR . 'assets/css/colorpicker.css');
	wp_enqueue_style('jquery-ui-custom-admin', ADMIN_DIR .'assets/css/jquery-ui-custom.css');
}	

/**
 * Create Options page
 *
 * @uses add_action()
 * @uses wp_enqueue_script()
 *
 * @since 1.0.0
 */
function allaround_page_load_only() 
{
	add_action('admin_head', 'allaround_page_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-input-mask', ADMIN_DIR .'assets/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('tipsy', ADMIN_DIR .'assets/js/jquery.tipsy.js', array( 'jquery' ));
	wp_enqueue_script('color-picker', ADMIN_DIR .'assets/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('ajaxupload', ADMIN_DIR .'assets/js/ajaxupload.js', array('jquery'));
	wp_enqueue_script('cookie', ADMIN_DIR . 'assets/js/cookie.js', 'jquery');
	wp_enqueue_script('livequery', ADMIN_DIR .'assets/js/jquery.livequery.js', array( 'jquery' ));
	wp_enqueue_script('smof-page', ADMIN_DIR .'assets/js/smof-page.js', array( 'jquery' ));
	wp_localize_script( 'smof-page', 'SmofPage', array( 'name' => OPTIONS . '_default_meta' ) );

}

/**
 * Front end inline jquery scripts
 *
 * @since 1.0.0
 */
function allaround_page_admin_head() { ?>
	<script type="text/javascript" language="javascript">
	jQuery.noConflict();
	jQuery(document).ready(function($){
		// COLOR Picker			
		$('.colorSelector').each(function(){
			var Othis = this; //cache a copy of the this variable for use inside nested function
			$(this).ColorPicker({
					color: '<?php if(isset($color)) echo $color; ?>',
					onShow: function (colpkr) {
						$(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						$(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						$(Othis).children('div').css('backgroundColor', '#' + hex);
						$(Othis).next('input').attr('value','#' + hex);
					}
			});
		}); //end color picker
	}); //end doc ready
	</script>
<?php } ?>
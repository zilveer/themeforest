<?php
/**
 * Site sub-header. Includes a slider, page title, etc.
 *
 * @package  wpv
 */

global $wpv_title;
if(!is_404()) {
	if(wpv_has_woocommerce() && is_woocommerce() && !is_single()) {
		if(is_product_category()) {
			$wpv_title = single_cat_title( '', false );
		} elseif(is_product_tag()) {
			$wpv_title = single_tag_title( '', false );
		} else {
			$wpv_title = woocommerce_get_page_id( 'shop' ) ? get_the_title(woocommerce_get_page_id( 'shop' )) : '';
		}
	}
}

if( ( ! WpvTemplates::has_breadcrumbs() && ! WpvTemplates::has_page_header() && ! WpvTemplates::has_post_siblings_buttons() ) || ( is_404() && ( ! function_exists( 'tribe_is_event_query' ) || ! tribe_is_event_query() ) ) ) return;
if(is_page_template('page-blank.php')) return;

$page_header_bg = WpvTemplates::page_header_background();
$global_page_header_bg = wpv_get_option('page-title-background-image') . wpv_get_option('page-title-background-color');

?>
<div id="sub-header" class="layout-<?php echo WpvTemplates::get_layout() ?> <?php if(!empty($page_header_bg) || !empty($global_page_header_bg)) echo 'has-background' ?>">
	<div class="meta-header" style="<?php echo $page_header_bg ?>">
		<div class="limit-wrapper">
			<div class="meta-header-inside">
				<?php
					WpvTemplates::breadcrumbs();
					WpvTemplates::page_header(false, $wpv_title);
				?>
			</div>
		</div>
	</div>
</div>
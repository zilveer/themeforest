<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	$post_type = get_post_type();
	if(is_category()) {
		//custom colors
		$catId = get_cat_id( single_cat_title("",false) );
		$titleColor = df_title_color($catId, "category", false);
	} else {
		//custom colors
		$titleColor = df_title_color(DF_page_id(),"page", false);
	}
?>					

<?php if (df_option_compare('show_single_title','show_single_title',$post->ID)==true) { ?>
	<div class="page_title">
		<h1 class="entry-title"><?php df_page_title(); ?></h1>
	    <?php 
		    if(df_get_option(THEME_NAME."_breadcrumb")=="on" || (df_get_option(THEME_NAME."_breadcrumb")=="on" && df_page_id()==get_option('page_for_posts'))) {
		        wp_reset_query();
		        if( ( class_exists( 'Woocommerce' ) && is_woocommerce() ) || ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) ) {
		            woocommerce_breadcrumb(array(
		                'wrap_before' => '<ul class="breadcrumb">',
		                'wrap_after' => '</ul>',
		                'before' => '<li>',
		                'after' => '</li>',
		                'delimiter' => ''
		            ));
		        } else if( class_exists( 'bbPress' ) && is_bbpress() ) {
		            remove_filter ('bbp_no_breadcrumb', 'bm_bbp_no_breadcrumb');
		            bbp_breadcrumb( array ( 'before' => '<ul class="breadcrumb">', 'after' => '</ul>', 'sep' => ' ', 'crumb_before' => '<li>', 'crumb_after' => '</li>', 'home_text' => __('Home', 'Avada')) );
		            add_filter ('bbp_no_breadcrumb', 'bm_bbp_no_breadcrumb');
		        } else {
		            df_breadcrumbs();
		        }
		    }

		?>
	</div>
<?php } ?>
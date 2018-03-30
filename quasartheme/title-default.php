<?php
/**
 * The default template for displaying title and breadcrumbs
 *
 * @package WordPress
 * @subpackage Quasar
 * @since Quasar 1.0
 */
?>
<?php
$full_width_title = true;
?>

<?php if($full_width_title): ?>
<!--Close the row-->
<?php endif; ?>

<div class="quasar-title-breadcrumbs">
	<?php 
	if(xr_get_option('title_area_top_shadow', true)):
    echo quasar_image_shadow_down(); 
	endif;
	?>
	<div class="row">
    	<?php if(xr_get_option('deactivate_breadcrumbs', false)): ?>
            <div class="large-12 medium-12 columns">
        <?php else: ?>
            <div class="large-7 medium-7 columns">
        <?php endif; ?>
            <h1 class="page-title centered-text-responsive-small">
			<?php 
			if(is_category()){
				printf( __( 'Category Archives: %s', 'quasar' ), single_cat_title( '', false ) );
			}elseif(is_tag()){
				printf( __( 'Tag Archives: %s', 'quasar' ), single_tag_title( '', false ) );
			}elseif(is_tax()){
				if(rockthemes_woocommerce_active() && (is_woocommerce() || is_product())){
					woocommerce_page_title();
					
					//Remove WooCommerce default page title
					function override_page_title() {
						return false;
					}
					add_filter('woocommerce_show_page_title', 'override_page_title');	
				}else{
					$queried = get_queried_object();
					$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );

					if($the_tax->name == "quasarproduct_cat"){
						_e("Quasar Products :", "quasar");
						echo " ".$queried->name;
					}else{
						printf( __( $the_tax->labels->name.': %s', 'quasar' ), $queried->name );
					}
				}
			}elseif(is_archive()){
				if ( is_day() ) :
					printf( __( 'Daily Archives: %s', 'quasar' ), get_the_date() );
				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: %s', 'quasar' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'quasar' ) ) );
				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: %s', 'quasar' ), get_the_date( _x( 'Y', 'yearly archives date format', 'quasar' ) ) );
				elseif(rockthemes_woocommerce_active() && is_woocommerce()):
					woocommerce_page_title();
					
					//Remove WooCommerce default page title
					function override_page_title() {
						return false;
					}
					add_filter('woocommerce_show_page_title', 'override_page_title');
				else :
					if(get_queried_object() && get_queried_object()->labels){
						echo get_queried_object()->labels->name;
					}else{
						_e( 'Archives', 'quasar' );
					}
				endif;
			}elseif(is_search()){
				printf( __( 'Search Results For: %s', 'quasar' ), get_search_query() );
			}else{
				if(is_single()){
					if(xr_get_option('show_post_name_on_title', false)){
						echo get_the_title(get_queried_object_id());
					}else{
						if(rockthemes_woocommerce_active() && is_product()){
							woocommerce_page_title();
							
							//Remove WooCommerce default page title
							function override_page_title() {
								return false;
							}
							add_filter('woocommerce_show_page_title', 'override_page_title');	
						}elseif(is_singular( 'quasarproducts' )){
							_e('Portfolio', 'quasar');
						}else{
							$posts_page_id = get_option( 'page_for_posts');
							$blog_page_html = '';
							if($posts_page_id){
								$posts_page = get_page( $posts_page_id);
								$posts_page_title = $posts_page->post_title;
								echo $posts_page_title;
							}else{
								_e('Blog', 'quasar');
							}
						}
					}
				}else{
					if(is_home()){
						_e('Blog', 'quasar');
					}else{
						echo get_the_title(get_queried_object_id());
					}
				}
			}
			?> 
            </h1>
        </div>
        <?php if(!xr_get_option('deactivate_breadcrumbs', false)): ?>
        <div class="large-5 medium-5 columns breadcrums-container right-text centered-text-responsive-small">
        	<p><br /></p>
            <?php 
			if(rockthemes_woocommerce_active() && is_woocommerce()):
				woocommerce_breadcrumb();
				//Remove WooCommerce Breadcrumb
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
			else:
			?>
            <?php quasar_breadcrumb(); ?>
            <?php endif; ?>
            <div class="clear"></div>
        </div>
        <?php endif; ?>
    </div>
	<?php 
	if(xr_get_option('title_area_bottom_shadow', true)):
    echo quasar_image_shadow_up();	
	endif
	?>
</div>
<?php 


?>


<?php if($full_width_title): ?>
<?php do_action('quasar_after_header_title'); ?>
<!--Reopen the closed row-->
<?php endif; ?>
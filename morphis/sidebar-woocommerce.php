<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */
 
if(is_woocommerce()):	
	$page_id = woocommerce_get_page_id( 'shop' ); 
	if(is_product()) :
		global $wp_query;
		$page_id = $wp_query->get_queried_object_id(); 
	endif;
else:
 	global $wp_query;
	$page_id = $wp_query->get_queried_object_id(); 
endif; 

// get the unique sidebar for this sidebar's page
$unique_sidebar_ID = get_post_meta($page_id,'_cmb_page_sidebar',TRUE); 
if(empty($unique_sidebar_ID)) :
	$unique_sidebar_ID = 'sidebar-1';
endif;

 
?>
		<aside id="secondary" class="<?php echo $unique_sidebar_ID . " " . $page_id; ?> widget-area four columns omega woocommerce-sidebar" role="complementary">
			<?php if ( ! dynamic_sidebar( $unique_sidebar_ID ) ) : ?>
				<?php //if ( ! dynamic_sidebar( 'woocommerce-widgets-sidebar' ) ) : ?>				
				<aside id="archives" class="container-frame sidebar-borders widget">
					<h6 class="widget-title"><?php _e( 'Archives', 'morphis' ); ?></h6>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget container-frame sidebar-borders ">
					<h6 class="widget-title"><?php _e( 'Meta', 'morphis' ); ?></h6>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

				<?php //endif; ?>
			<?php endif; // end sidebar widget area ?>
		</aside><!-- #secondary .widget-area -->
<?php //endif; ?>
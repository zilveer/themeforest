<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */

//$options = morphis_get_theme_options();
//$current_layout = $options['theme_layout'];


//if ( 'content' != $current_layout ) :

global $wp_query;
$page_id = $wp_query->get_queried_object_id(); 

// get the unique sidebar for this sidebar's page
$unique_sidebar_ID = get_post_meta($page_id,'_cmb_page_sidebar',TRUE); 
if(empty($unique_sidebar_ID)) :
	$unique_sidebar_ID = 'sidebar-1';
endif;
 
?>
		<aside id="secondary" class="widget-area four columns omega" role="complementary">
			<?php if ( ! dynamic_sidebar( $unique_sidebar_ID ) ) : ?>

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

			<?php endif; // end sidebar widget area ?>
		</aside><!-- #secondary .widget-area -->
<?php //endif; ?>
<?php if(! defined('ABSPATH')){ return; }
/**
 * This file contains helper functions for sensei plguin by WooThemes
 */

add_action( 'sensei_before_main_content', 'zn_sensei_before_main_content' );
add_action( 'sensei_after_main_content', 'zn_sensei_after_main_content' );
function zn_sensei_before_main_content(){

	$args = array();
	if( ! is_single() ){

		// SHOW THE HEADER
		if( empty( $args['title'] ) ){
			//** Put the header with title and breadcrumb
			$args['title'] = __( 'Courses', 'zn_framework' );
		}

		if( is_tax() ) {
			$args['title'] = get_the_archive_title();
			$args['subtitle'] = ''; // Reset the subtitle for categories and tags
		}
	}

	WpkPageHelper::zn_get_subheader( $args );

	global $zn_config;
	$zn_config['force_sidebar'] = 'blog_sidebar';
	$main_class = zn_get_sidebar_class( 'blog_sidebar' );
	if( strpos( $main_class , 'right_sidebar' ) !== false || strpos( $main_class , 'left_sidebar' ) !== false ) { $zn_config['sidebar'] = true; } else { $zn_config['sidebar'] = false; }
	$zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-8 col-md-9' : 'col-sm-12';

	?>
	<section id="content" class="site-content shop_page">
		<div class="container">
			<div class="row">
				<div class="<?php echo $main_class; ?>">
	<?php
}

function zn_sensei_after_main_content(){
	?>

				</div>
				<!-- sidebar -->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</section>
	<?php
}

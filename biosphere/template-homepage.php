<?php
/*
	Template Name: Homepage
*/

get_header(); 

	global $dd_sn;

	while ( have_posts() ) : the_post();

		if ( get_the_content() ) : ?>

			<div class="real-content home-section even">
				<div class="container">
					<?php the_content(); ?>
				</div>
			</div>

		<?php endif;

	endwhile;

	$home_sections = ot_get_option( $dd_sn . 'home_sections', false );	

	if ( $home_sections ) {

		$parity = 'even';

		foreach ( $home_sections as $home_section ) {

			if ( $parity == 'odd' ) { 
				$parity = 'even'; 
			} else {
				$parity = 'odd';
			}

			if ( ! isset( $home_section[ $dd_sn . 'module_blog_cat' ] ) ) {
				$home_section[ $dd_sn . 'module_blog_cat' ] = 'all';
			}

			if ( ! isset( $home_section[ $dd_sn . 'module_causes_cat' ] ) ) {
				$home_section[ $dd_sn . 'module_causes_cat' ] = 'all';
			}

			if ( ! isset( $home_section[ $dd_sn . 'module_post_width' ] ) ) {
				$home_section[ $dd_sn . 'module_post_width' ] = 'one_fourth';
			}

			if ( ! isset( $home_section[ $dd_sn . 'module_autoplay' ] ) )
				$home_section[ $dd_sn . 'module_autoplay' ] = '0';

			if ( ! isset( $home_section[ $dd_sn . 'module_type' ] ) )
				$home_section[ $dd_sn . 'module_type' ] = 'carousel';

			if ( 'tabs' == $home_section[ $dd_sn . 'module' ] ) {
				dd_home_section_tabs( array( 'parity' => $parity, 'title' => $home_section['title'] ) );
			} elseif ( 'causes' == $home_section[ $dd_sn . 'module' ] ) {
				dd_home_section_causes( array( 'type' => $home_section[ $dd_sn . 'module_type' ], 'autoplay' => $home_section[ $dd_sn . 'module_autoplay' ], 'parity' => $parity, 'title' => $home_section['title'], 'amount' => $home_section[ $dd_sn . 'module_amount_posts'], 'category' => $home_section[ $dd_sn . 'module_causes_cat' ], 'post_width' => $home_section[ $dd_sn . 'module_post_width' ] ) );
			} elseif ( 'news' == $home_section[ $dd_sn . 'module' ] ) {
				dd_home_section_blog( array( 'type' => $home_section[ $dd_sn . 'module_type' ], 'autoplay' => $home_section[ $dd_sn . 'module_autoplay' ], 'parity' => $parity, 'title' => $home_section['title'], 'amount' => $home_section[ $dd_sn . 'module_amount_posts'], 'category' => $home_section[ $dd_sn . 'module_blog_cat' ], 'post_width' => $home_section[ $dd_sn . 'module_post_width' ] ) );
			} elseif ( 'events' == $home_section[ $dd_sn . 'module' ] ) {
				dd_home_section_events( array( 'type' => $home_section[ $dd_sn . 'module_type' ], 'autoplay' => $home_section[ $dd_sn . 'module_autoplay' ], 'parity' => $parity, 'title' => $home_section['title'], 'amount' => $home_section[ $dd_sn . 'module_amount_posts'] ) );
			} elseif ( 'products' == $home_section[ $dd_sn . 'module' ] ) {
				dd_home_section_products( array( 'autoplay' => $home_section[ $dd_sn . 'module_autoplay' ], 'parity' => $parity, 'title' => $home_section['title'], 'amount' => $home_section[ $dd_sn . 'module_amount_posts'] ) );
			} elseif ( 'staff' == $home_section[ $dd_sn . 'module' ] ) {
				dd_home_section_staff( array( 'type' => $home_section[ $dd_sn . 'module_type' ], 'autoplay' => $home_section[ $dd_sn . 'module_autoplay' ], 'parity' => $parity, 'title' => $home_section['title'], 'amount' => $home_section[ $dd_sn . 'module_amount_posts'] ) );
			} elseif ( 'text' == $home_section[ $dd_sn . 'module' ] ) {
				dd_home_section_text( array( 'parity' => $parity, 'title' => $home_section['title'], 'content' => $home_section[ $dd_sn . 'module_text_content'] ) );
			} elseif ( 'sponsors' == $home_section[ $dd_sn . 'module' ] ) {
				dd_home_section_sponsors( array( 'type' => $home_section[ $dd_sn . 'module_type' ], 'autoplay' => $home_section[ $dd_sn . 'module_autoplay' ], 'parity' => $parity, 'title' => $home_section['title'], 'amount' => $home_section[ $dd_sn . 'module_amount_posts'], 'post_width' => $home_section[ $dd_sn . 'module_post_width' ] ) );
			} elseif ( 'events_no_cal' == $home_section[ $dd_sn . 'module' ] ) {
				dd_home_section_events_no_cal( array( 'type' => $home_section[ $dd_sn . 'module_type' ], 'autoplay' => $home_section[ $dd_sn . 'module_autoplay' ], 'parity' => $parity, 'title' => $home_section['title'], 'amount' => $home_section[ $dd_sn . 'module_amount_posts'], 'category' => $home_section[ $dd_sn . 'module_causes_cat' ], 'post_width' => $home_section[ $dd_sn . 'module_post_width' ] ) );
			}

		}

	} else {

		/* Default */

		dd_home_section_tabs( array( 'parity' => 'odd', 'title' => '' ) );
		dd_home_section_causes( array( 'type' => 'carousel', 'autoplay' => '0', 'parity' => 'even', 'title' => 'OUR CAUSES', 'amount' => 10, 'category' => 'all', 'post_width' => 'one_fourth' ) );
		dd_home_section_blog( array( 'type' => 'carousel', 'autoplay' => '0', 'parity' => 'odd', 'title' => 'BLOG', 'amount' => 10, 'category' => 'all', 'post_width' => 'one_fourth' ) );
		dd_home_section_events( array( 'type' => 'carousel', 'autoplay' => '0', 'parity' => 'even', 'title' => 'EVENTS', 'amount' => 10, 'category' => 'all', 'post_width' => 'one_fourth' ) );
		dd_home_section_products( array( 'autoplay' => '0', 'parity' => 'even', 'title' => 'PRODUCTS', 'amount' => 10, 'category' => 'all', 'post_width' => 'one_fourth' ) );

	}

get_footer(); 

?>
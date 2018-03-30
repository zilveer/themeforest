<?php
/**
 * The Homepage
 *
 * The section functions are located in function.php and can be overridden in a child theme.
 * 
 */

get_header(); 

global $dd_sn; ?>
	
	<?php 

		// For loop 4 times for 4 sections
		$real_count = 0;
		for ( $i = 1; $i < 5; $i++ ) {

			// Get the value for the section
			$show_section = ot_get_option( $dd_sn . 'home_row_' . $i, '' );

			// Use default if there are no values
			if ( $show_section == '' ) {
				switch ( $i ) {
					case 1:
						$show_section = 'gallery';
						break;
					case 2:
						$show_section = 'blog';
						break;
					case 3:
						$show_section = 'products';
						break;
					case 4:
						$show_section = 'disabled';
						break;
				}
			}

			if ( $show_section != 'disabled' )
				$real_count++;

			// Additional attributes for the sections
			if ( $real_count % 2 == 0 ) {
				$section_atts = array(
					'parity' => 'even'
				);
			} else {
				$section_atts = array(
					'parity' => 'odd'
				);
			}

			// Call appropriate functions
			if ( $show_section == 'gallery' )
				dd_home_section_gallery( $section_atts );
			elseif ( $show_section == 'blog' )
				dd_home_section_blog( $section_atts );
			elseif ( $show_section == 'products' )
				dd_home_section_products( $section_atts );
			elseif ( $show_section == 'custom' )
				dd_home_section_custom( $section_atts );

		}

	?>

<?php get_footer(); ?>
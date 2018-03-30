<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Idylle
 */


get_header(); 
require_once get_template_directory() .'/template-parts/header-slider.php';
?>

			<?php
			while ( have_posts() ) : the_post();
			if( function_exists('fw_get_db_settings_option') ) {
				if (fw_get_db_post_option(get_the_ID(),'page-builder/builder_active')=='true') {
					get_template_part( 'template-parts/content', 'page-builder' );
				}else {
					get_template_part( 'template-parts/content', 'page' );
				}
			}else {
				get_template_part( 'template-parts/content', 'page' );
			}


			endwhile; // End of the loop.
			?>



<?php
get_footer();

<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Idylle
 */

?>

<section class="idy_box idy_simple_page">
	<div class="container">
		
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'idylle' ),
				'after'  => '</div>',
			) );
		?>

		<?php 
		// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		 ?>

	</div>
</section>





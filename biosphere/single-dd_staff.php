<?php
/**
 * The Template for displaying staff member posts
 */

get_header();

$content_class = '';
$layout = get_post_meta( get_the_ID(), $dd_sn . 'layout', true );

if ( empty( $layout ) || $layout == 'cs' ) {
	$content_class = 'two-thirds column';
}

?>

	<div class="container clearfix">	

		<div id="content" class="<?php echo $content_class; ?>">

			<?php

				if ( have_posts()) : while ( have_posts()) : the_post();
					
					get_template_part( 'templates/staff-members' );

				endwhile; endif;

			?>

		</div><!-- #content -->

		<?php if ( empty( $layout ) || $layout == 'cs' ) { get_sidebar( 'staff' ); } ?>

	</div><!-- .container -->

<?php get_footer(); ?>
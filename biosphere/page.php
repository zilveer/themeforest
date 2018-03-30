<?php
/**
 * The Template for displaying pages.
 */

get_header();

// Layout
$layout = get_post_meta( get_the_ID(), $dd_sn . 'layout', true );
if ( empty ( $layout ) ) { $layout = 'cs'; }

// Content Class
$content_class = '';
if ( $layout == 'cs' ) { $content_class = 'two-thirds column'; }

?>
		
	<div class="container clearfix">

		<div id="content" class="<?php echo $content_class; ?>">

			<?php

				if (have_posts()) : while (have_posts()) : the_post();
						
					get_template_part( 'templates/page', '' );

				endwhile; endif;

			?>

		</div>

		<?php if ( $layout == 'cs' ) { get_sidebar( 'page' ); } ?>

	</div><!-- .container -->

<?php get_footer(); ?>
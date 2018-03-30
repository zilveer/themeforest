<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package quote
 */

get_header();

$layout = rwmb_meta( 'layout', 'type=image_select' );
if($layout == 'leftsb') { $pull = 'pull-right'; } else { $pull = ''; }
$col= 'col-md-9';

?>

	<div id="primary" class="container">
		<div class="gap"></div>

			<?php if ($layout == 'rightsb' || $layout == 'leftsb') { ?>
			<div class="<?php echo $col; ?> <?php echo $pull; ?>">
			<?php } ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

			<?php if ($layout == 'rightsb' || $layout == 'leftsb') { ?>
			</div>
			<?php } ?>	

			<?php if ($layout == 'rightsb' || $layout == 'leftsb') { ?>
			<div class="col-md-3">
			<?php get_sidebar(); ?>
			</div>
			<?php } ?>	

	</div><!-- #primary -->

<?php get_footer(); ?>

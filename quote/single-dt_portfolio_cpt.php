<?php
/**
 * The template for displaying all single posts.
 *
 * @package quote
 */

get_header('single-project'); 

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

				<?php get_template_part( 'content', 'single-portfolio' ); ?>

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
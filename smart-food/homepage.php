<?php
/**
 * Template Name: Homepage
 *
 * @package smartfood
 */
get_header('homepage'); 

get_template_part( 'templates/pages/content', 'slider' );

?>
<div class="row">
	<section id="page-content" <?php tdp_attr( 'content' ); ?>>
		<div class="container">
			<div class="row clearfix">
				<div class="col-md-12 column">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content();?>
					<?php endwhile; ?>
				<?php endif; ?>
				</div>
			</div>
		</div> <!-- end container -->
	</section> <!-- end page content -->
</div>
<?php get_footer(); ?>
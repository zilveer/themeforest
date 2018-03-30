<?php get_header(); ?>

<?php get_template_part('inc_section'); ?>

<div class="row main">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div class="nine columns content">
			<div class="content-inner">
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
		</div><!-- /twelve columns -->

		<aside class="three columns sidebar">

			<div class="widget widget-single-artist">
				<div class="widget-content">
					<?php $large_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'large', true); ?>
					<a href="<?php echo $large_url[0]; ?>" data-rel="prettyPhoto">
						<?php the_post_thumbnail('ci_rectangle'); ?>
					</a>
				</div><!-- widget-content -->
			</div><!-- /widget -->

			<div id="single-sidebar">
				<?php dynamic_sidebar('artist-sidebar'); ?>
			</div>

		</aside>

	<?php endwhile; endif; ?>

</div><!-- /row -->

<?php get_footer(); ?>
<?php get_header(); ?>
	<div class="content">
		
		<?php if ( ! have_posts() ) : ?>
			<?php get_template_part( 'framework/parts/not-found' ); ?>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('post-listing'); ?>>
			<div class="post-inner">
				<h1 class="name post-title entry-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing"><span itemprop="name"><?php the_title(); ?></span></h1>
				<div class="entry">
					<?php the_content(); ?>
				</div><!-- .entry /-->
			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php endwhile;?>

	</div><!-- .content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
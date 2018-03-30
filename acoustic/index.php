<?php get_header(); ?>

<?php get_template_part('inc_section'); ?>

<div class="row main">

	<aside class="three columns sidebar">
		<?php dynamic_sidebar('homepage-sidebar-one'); ?>
	</aside><!-- /sidebar -->

	<div class="six columns content">

		<h3 class="widget-title"><?php _e('LATEST NEWS','ci_theme'); ?></h3>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article <?php post_class('post'); ?>>
				<div class="post-featured">
					<?php the_post_thumbnail('ci_featured'); ?>

					<?php if ( has_post_thumbnail() ): ?>
						<time class="post-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><span class="day"><?php echo get_the_date('d'); ?></span> <span class="month"><?php echo strtoupper(get_the_date('M')); ?></span> <span class="year"><?php echo get_the_date('Y'); ?></span></time>
					<?php endif; ?>
				</div><!-- /post-featured -->

				<div class="post-body row">
					<div class="post-copy-wrap twelve columns">
						<div class="post-copy">
							<h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ci_theme' ), get_the_title() ) ); ?>"><?php the_title(); ?></a></h2>
							<p class="post-meta">
								<?php if ( ! has_post_thumbnail() ): ?>
									<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><span class="day"><?php echo get_the_date('d'); ?></span> <span class="month"><?php echo get_the_date('M'); ?></span> <span class="year"><?php echo get_the_date('Y'); ?></span></time> &mdash;
								<?php endif; ?>
								<?php _e('Filed Under:', 'ci_theme'); ?> <?php the_category(', '); ?>
							</p>
							<?php ci_e_content(); ?>
						</div><!-- /post-copy -->
					</div><!-- /post-copy-wrap -->
				</div><!-- /post-body -->
			</article><!-- /post -->
		<?php endwhile; endif; ?>

		<?php ci_pagination(); ?>

	</div>

	<aside class="three columns sidebar">
		<?php dynamic_sidebar('homepage-sidebar-two'); ?>
	</aside><!-- /sidebar -->

</div><!-- /row -->

<?php get_footer(); ?>
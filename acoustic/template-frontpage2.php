<?php
/*
Template Name: Homepage (Content / Sidebar #1 / Sidebar #2)
*/
?>
<?php get_header(); ?>

<?php get_template_part('inc_slider'); ?>
<?php get_template_part('inc_media'); ?>

<!-- ########################### MAIN ########################### -->
<div class="row main">

	<div class="six columns content">

		<h3 class="widget-title"><?php _e('LATEST NEWS','ci_theme'); ?></h3>

		<?php
			global $post;
			$args = array(
				'post_type'      => 'post',
				'paged'          => ci_get_page_var(),
				'posts_per_page' => ci_setting( 'news-no' ),
				'cat'            => ci_setting( 'news-cat' )
			);
			$news = new WP_Query( $args );
		?>
		<?php if ( $news->have_posts() ) : while ( $news->have_posts() ) : $news->the_post(); ?>
			<article class="post">
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
							<?php the_excerpt(); ?>
						</div><!-- /post-copy -->
					</div><!-- /post-copy-wrap -->
				</div><!-- /post-body -->
			</article><!-- /post -->
		<?php endwhile; endif; ?>

		<?php ci_pagination(array(), $news); wp_reset_postdata(); ?>

	</div>

	<aside class="three columns sidebar">
		<?php dynamic_sidebar('homepage-sidebar-one'); ?>
	</aside><!-- /sidebar -->

	<aside class="three columns sidebar">
		<?php dynamic_sidebar('homepage-sidebar-two'); ?>
	</aside><!-- /sidebar -->

</div><!-- /row -->

<?php get_footer(); ?>
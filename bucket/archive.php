<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Bucket
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); ?>

<div id="main" class="container container--main">

	<div class="grid">

		<div class="grid__item  two-thirds  palm-one-whole">
			<?php if (have_posts()): ?>
				<div class="heading  heading--main">
					<h2 class="hN"><?php

						$var = get_query_var('post_format');
						// POST FORMATS
						if ($var == 'post-format-aside') :
							_e('Aside Archives', 'bucket');
						elseif ($var == 'post-format-image') :
							_e('Image Archives', 'bucket');
						elseif ($var == 'post-format-link') :
							_e('Link Archives', 'bucket');
						elseif ($var == 'post-format-quote') :
							_e('Quote Archives', 'bucket');
						elseif ($var == 'post-format-status') :
							_e('Status Archives', 'bucket');
						elseif ($var == 'post-format-gallery') :
							_e('Gallery Archives', 'bucket');
						elseif ($var == 'post-format-video') :
							_e('Video Archives', 'bucket');
						elseif ($var == 'post-format-audio') :
							_e('Audio Archives', 'bucket');
						elseif ($var == 'post-format-chat') :
							_e('Chat Archives', 'bucket');
						endif;

						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'bucket' ), get_the_date() );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'bucket' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'bucket' ) ) );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'bucket' ), get_the_date( _x( 'Y', 'yearly archives date format', 'bucket' ) ) );
						else :
							_e( 'Archives', 'bucket' );
						endif;
					?></h2>
				</div>

				<?php if(wpgrade::option('blog_layout') == 'masonry') {
					$grid_class= 'class="grid  masonry" data-columns';
				} else {
					$grid_class = 'class="classic"';
				} ?>

				<div <?php echo $grid_class;?>>
					<?php while (have_posts()): the_post(); ?><!--
		                --><div class="<?php echo wpgrade::option('blog_layout')?>__item"><?php get_template_part('theme-partials/post-templates/content-'. wpgrade::option('blog_layout', 'masonry') ); ?></div><!--
		         --><?php endwhile; ?>
				</div>
				<?php echo wpgrade::pagination();
				else: get_template_part( 'no-results', 'index' ); endif; ?>
		</div><!--

     --><div class="grid__item  one-third  palm-one-whole  sidebar">
				<?php get_sidebar(); ?>
		</div>

	</div>
</div>

<?php get_footer(); ?>
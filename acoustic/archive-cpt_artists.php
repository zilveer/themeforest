<?php get_header(); ?>

<?php get_template_part('inc_section'); ?>

<div class="row main">
	<div class="twelve columns">

		<ol class="row listing">
			<?php ci_column_classes(ci_setting('archive_tpl'), 12, true); ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<li class="<?php echo ci_column_classes(ci_setting('archive_tpl'), 12); ?> columns">
					<div class="widget-content">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('ci_featured'); ?>
						</a>
						<div class="album-info">
							<h4 class="pair-title"><?php the_title(); ?></h4>
							<p class="pair-sub"><?php echo get_post_meta($post->ID, 'ci_cpt_artists_text', true); ?></p>
							<a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more','ci_theme'); ?></a>
						</div>
					</div><!-- widget-content -->
				</li>
			<?php endwhile; endif; ?>

		</ol><!-- /discography -->
		<?php ci_pagination(); ?>

	</div><!-- /twelve columns -->
</div><!-- /row -->

<?php get_footer(); ?>
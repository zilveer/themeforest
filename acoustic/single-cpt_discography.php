<?php get_header(); ?>

<?php get_template_part('inc_section'); ?>

<div class="row main">

	<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();

		// Album Details
		$album_date			= get_post_meta($post->ID, 'ci_cpt_discography_date', true);
		$album_label		= get_post_meta($post->ID, 'ci_cpt_discography_label', true);
		$album_cat_no		= get_post_meta($post->ID, 'ci_cpt_discography_cat_no', true);

		// Purchase Details
		$album_status		= get_post_meta($post->ID, 'ci_cpt_discography_status', true);
		$album_text			= get_post_meta($post->ID, 'ci_cpt_discography_purchase_text', true);
		$album_text_from1	= get_post_meta($post->ID, 'ci_cpt_discography_purchase_text_from1', true);
		$album_text_url1	= get_post_meta($post->ID, 'ci_cpt_discography_purchase_text_url1', true);
		$album_text_from2	= get_post_meta($post->ID, 'ci_cpt_discography_purchase_text_from2', true);
		$album_text_url2	= get_post_meta($post->ID, 'ci_cpt_discography_purchase_text_url2', true);

	?>

		<div class="nine columns">
			<div class="content-inner">
				<h2><?php the_title(); ?></h2>
				<div id="meta-wrap" class="group">
					<ul class="single-meta">
						<?php if ($album_date != ""): ?><li><span><?php _e('Release date:','ci_theme'); ?></span> <?php echo $album_date; ?></li><?php endif; ?>
						<?php if ($album_label != ""): ?><li><span><?php _e('Label:','ci_theme'); ?></span> <?php echo $album_label; ?></li><?php endif; ?>
						<?php if ($album_cat_no != ""): ?><li><span><?php _e('Catalog #:','ci_theme'); ?></span> <?php echo $album_cat_no; ?></li><?php endif; ?>
					</ul>
				</div><!-- /meta-wrap -->
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
		</div>

		<div class="three columns">
			<div class="widget widget_ci_discography_widget">
				<div class="widget-content">
					<?php $large_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large', true); ?>
					<a href="<?php echo $large_url[0]; ?>" data-rel="prettyPhoto">
						<?php the_post_thumbnail('ci_rectangle'); ?>
					</a>
					<div class="album-info title-pair">
						<h3 class="pair-title"><?php echo $album_status; ?></h3>
						<p class="pair-sub"><?php echo $album_text; ?></p>
						<?php if ($album_text_from1 != ""): ?>
							<a href="<?php echo $album_text_url1; ?>" class="btn"><?php echo $album_text_from1; ?></a>
						<?php endif; ?>
						<?php if ($album_text_from2 != ""): ?>
							<a href="<?php echo $album_text_url2; ?>" class="btn"><?php echo $album_text_from2; ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div><!-- /latest-album -->

			<div id="single-sidebar">
				<?php dynamic_sidebar('album-sidebar'); ?>
			</div>

		</div><!-- /three columns -->

	<?php endwhile; endif; ?>

</div><!-- /row -->

<?php get_footer(); ?>
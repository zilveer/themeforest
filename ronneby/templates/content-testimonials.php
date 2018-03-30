<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="six columns">
	<div class="testimonial-item">
		<div class="left">
			<div class="avatar">
				<?php
					if (has_post_thumbnail()) {
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
					} else {
						$img_url = get_template_directory_uri() . '/img/no-image-large.jpg';
					}

					$article_image = dfd_aq_resize($img_url, 180, 80, true, true, true);
					if(!$article_image) {
						$article_image = $img_url;
					}
				?>
				<img alt="<?php the_title(); ?>" src="<?php echo esc_url($article_image); ?>">
			</div>

			<div class="cite">
				<span class="quote-author box-name"><?php echo get_post_meta(get_the_ID(), 'crum_testimonial_autor', true); ?></span>
				<span class="quote-sub dopinfo"><?php echo get_post_meta(get_the_ID(), 'crum_testimonial_additional', true); ?></span>
			</div>
		</div>

		<div class="right">
			<blockquote>
				<?php the_excerpt(); ?>
			</blockquote>
		</div>
	</div>
</div>
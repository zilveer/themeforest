<?php

global $kowloonbay_blog_layout;
$is_masonry = ($kowloonbay_blog_layout === 'masonry');

global $kowloonbay_redux_opts;

$clickable = $kowloonbay_redux_opts['blog_clickable_block'] === '1';

$link_icon = $kowloonbay_redux_opts['blog_link_fa_icon'];
$quote_icon = $kowloonbay_redux_opts['blog_quote_fa_icon'];
$status_icon = $kowloonbay_redux_opts['blog_status_fa_icon'];

$format = get_post_format();
$is_mini_entry = ($format === 'status' || $format === 'quote' || $format === 'link');

$bg_color_style = '';
if ($is_mini_entry){
	$bg_color_style = rwmb_meta( 'kowloonbay_post_mini_entry_bg_color');
}

$label_continue_reading = $kowloonbay_redux_opts['blog_label_continue_reading'];
$animation_blog_post_title = $kowloonbay_redux_opts['animation_blog_post_title'];

global $kowloonbay_allowed_html;
?>

<li class="blog-item">

	<div <?php if ($is_mini_entry) echo ' style="background-color:'. esc_attr($bg_color_style) .';"'; ?> class="post-wrapper img-bg-cover-hover-effect-container <?php echo esc_attr($clickable || $is_mini_entry ? 'clickable-block' : '');?> <?php echo esc_attr($is_masonry? 'margin-b-1x':''); ?> <?php echo esc_attr($kowloonbay_blog_layout === 'no_sidebar_full_width'? 'no-page-padding':''); ?>">		
		<?php

		global $wp_embed;

		if ($format === 'video'):
			$video= rwmb_meta( 'kowloonbay_post_video');
			$video_ratio= rwmb_meta( 'kowloonbay_post_video_ratio');
			if (strpos($video, 'youtube') !== false):
		?>
			<div
				class="post-top-container embed-youtube embed-responsive embed-responsive-<?php echo esc_attr($video_ratio === '16-9' ? '16by9' : '4by3'); ?>"
				data-video-url = "<?php echo esc_url($video); ?>">
			</div>
		<?php
			elseif (strpos($video, 'vimeo') !== false):
				$video_embed = $wp_embed->run_shortcode('[embed]'. $video .'[/embed]');
		?>
			<div class="post-top-container embed-vimeo embed-responsive embed-responsive-<?php echo esc_attr($video_ratio === '16-9' ? '16by9' : '4by3'); ?>">
				<?php echo wp_kses($video_embed, $kowloonbay_allowed_html); ?>
			</div>
		<?php
			endif;
		endif;

		if ($format === 'gallery'):
			$gallery= rwmb_meta( 'kowloonbay_post_gallery', array('type'=>'image_advanced'));
			if (sizeof($gallery) > 0):
		?>
			<div class="post-top-container height-1x">
				<div class="owl-carousel carousel-blog-gallery margin-v-none">
					<?php foreach ($gallery as $img) : ?>
						<div class="item img-bg-cover height-1x">
							<img src="<?php echo esc_url( $img['full_url'] ); ?>" />
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php
			endif;
		endif;

		if ($format === 'audio'):
			$audio = rwmb_meta( 'kowloonbay_post_audio');
			if ($audio !== ''):
				$audio_embed = $wp_embed->run_shortcode('[embed]'. $audio .'[/embed]');
		?>
			<div class="post-top-container embed-responsive height-1x">
				<?php echo wp_kses($audio_embed, $kowloonbay_allowed_html); ?>
			</div>
		<?php
			endif;
		endif;

		if ($format === 'image'):
			$image = rwmb_meta( 'kowloonbay_post_image', array('type'=>'image_advanced'));
			$image = reset($image);
			if ($image !== false):
				if ($is_masonry) {
					$image = image_downsize( $image['ID'], 'large' );
				} else{
					$image = image_downsize( $image['ID'], 'full' );
				}
		?>
			<div class="post-top-container img-bg-cover height-1x parallax">
				<img src="<?php echo esc_attr( $image[0] ); ?>" alt="">
			</div>
		<?php
			endif;
		endif;

		if (has_post_thumbnail()):
		?>
			<div class="post-top-container img-bg-cover height-1x parallax">
				<?php the_post_thumbnail( $is_masonry?'large':'full' ); ?>
			</div>
		<?php
		endif;
		?>

		<div class="text-center <?php echo esc_attr($is_masonry? '':'margin-b-3x'); ?> padding-v-2x page-padding-h page-padding-h-sm">
			<div id="post-<?php the_ID(); ?>" <?php post_class();?> >

				<?php if (!$is_mini_entry): ?>

				<?php if (get_the_title() !== ''): ?>
				<h2 class="title"><a class="inline-block wow <?php echo esc_attr( $animation_blog_post_title ); ?>" href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h2>
				<?php endif; ?>

				<?php
					global $kowloonbay_cats;
					global $kowloonbay_post_url;

					$kowloonbay_cats = get_the_category( get_the_id() );
					$kowloonbay_post_url = get_permalink();
				?>
				<ul class="post-info list-inline title-font small-text margin-b-half wow-array">
					<?php
						get_template_part('inc/kowloonbay-blog','infobar');

						$tags = get_the_tags();
						if (is_array($tags)){
							echo '<li>';
							foreach ( $tags as $t)
							{
								echo '<a class="tl-tag" href="';
								echo esc_url(get_tag_link($t->term_id));
								echo '">'.$t->name.'</a>';
							}
							echo '</li>';
						}
					?>
				</ul>
				<?php endif; ?>

				<div class="entry text-left <?php echo esc_attr($is_mini_entry ? 'entry-mini':''); ?>">

				<?php if ($format === 'quote'): ?>
					<div class="pull-left"><i class="fa <?php echo esc_attr($quote_icon); ?> fa-custom-lg fa-custom-no-margin-right"></i></div>
					<blockquote class="padding-r-none padding-v-none margin-b-none margin-l-half">
						<?php the_content(); ?>
						<?php if ( rwmb_meta( 'kowloonbay_post_quote_source') !== '' ): ?>
						<footer><?php echo esc_html( rwmb_meta( 'kowloonbay_post_quote_source') ); ?></footer>
						<?php endif; ?>
					</blockquote>
				<?php elseif ($format === 'link'): ?>
					<div class="pull-left"><i class="fa <?php echo esc_attr($link_icon); ?> fa-custom-lg fa-custom-no-margin-right"></i></div>
					<div class="padding-l-2x margin-l-half quote-style">
						<?php the_content(); ?>
					</div>
				<?php elseif ($format === 'status'): ?>
					<div class="pull-left"><i class="fa <?php echo esc_attr($status_icon); ?> fa-custom-lg fa-custom-no-margin-right"></i></div>
					<div class="padding-l-2x margin-l-half quote-style">
						<?php the_content(); ?>
					</div>
				<?php else: ?>
					<?php
						if ( is_category() || is_archive() ) {
							the_excerpt();
						} else {
							global $more; $more = 0; the_content('', true);
						}
					?>
				<?php endif; ?>

				</div>

				<p><a href="<?php the_permalink(); ?>" class="btn btn-default clickable-block-link <?php echo esc_attr($is_mini_entry ? 'hidden' : ''); ?>"><i class="fa fa-arrow-right"></i><?php echo esc_html($label_continue_reading); ?></a></p>
			</div>
		</div>
	</div>

</li>

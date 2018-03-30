<?php 
/* Header */
get_header();

global $kowloonbay_blog_url;
global $kowloonbay_blog_title;
global $kowloonbay_blog_desc;

$blog_layout = get_query_var("blog_layout");
if ($blog_layout === '') $blog_layout = $kowloonbay_redux_opts['blog_layout'];

$no_sidebar = !($blog_layout === 'left_sidebar' || $blog_layout === 'right_sidebar');

the_post();
$format = get_post_format();
$is_mini_entry = ($format === 'status' || $format === 'quote' || $format === 'link');

global $kowloonbay_redux_opts;

$blog_post_full_width = ($kowloonbay_redux_opts['blog_post_full_width'] === '1');
$blog_link_fa_icon = $kowloonbay_redux_opts['blog_link_fa_icon'];
$blog_quote_fa_icon = $kowloonbay_redux_opts['blog_quote_fa_icon'];
$blog_status_fa_icon = $kowloonbay_redux_opts['blog_status_fa_icon'];

$gallery_slider_height = rwmb_meta('kowloonbay_post_gallery_slider_height');
$gallery_slider_custom_height = rwmb_meta('kowloonbay_post_gallery_slider_custom_height');

if ($gallery_slider_custom_height === '') $gallery_slider_custom_height = 'auto';

$gallery_slider_height_style = '';
$gallery_slider_height_class = 'height-1-plus-half-x';

switch ($gallery_slider_height) {
	case '1x':
		$gallery_slider_height_class = 'height-1x';
		break;
	case '1.5x':
		$gallery_slider_height_class = 'height-1-plus-half-x';
		break;
	case '2x':
		$gallery_slider_height_class = 'height-2x';
		break;
	case '3x':
		$gallery_slider_height_class = 'height-3x';
		break;
	case 'c':
		$gallery_slider_height_class = '';
		$gallery_slider_height_style = $gallery_slider_custom_height;
		break;
	default:
		$gallery_slider_height_class = 'height-1-plus-half-x';
		break;
}

$gallery_slider_bg_contain_class = '';
if (rwmb_meta('kowloonbay_post_gallery_slider_resize_mode') === 'contain'){
	$gallery_slider_bg_contain_class = 'img-bg-cover-contain';
}

$animation_blog_post_title = $kowloonbay_redux_opts['animation_blog_post_title'];

global $kowloonbay_allowed_html;
?>

<section>
	<div class="section-heading">
		<h2><a href="<?php echo esc_url( $kowloonbay_blog_url ); ?>"><?php echo esc_html( $kowloonbay_blog_title ); ?></a></h2>
		<div class="row">
			<div class="col-sm-4">
				<p class="section-desc"><?php echo esc_html( $kowloonbay_blog_desc ); ?></p>
			</div>
			<div class="col-sm-8">
				<?php if ($no_sidebar) get_template_part('inc/kowloonbay-blog', 'toolbar'); ?>
			</div>
		</div>
	</div>

	<?php if ($no_sidebar) get_template_part('inc/kowloonbay-blog', 'stackboxes'); ?>

	<?php if (!$no_sidebar): ?>
	<div class="row">
	<?php endif; ?>

		<?php if ($blog_layout === 'left_sidebar') get_sidebar(); ?>

		<?php if (!$no_sidebar): ?>
		<div class="col-md-8">
		<?php endif; ?>

			<div class="post-wrapper <?php echo esc_attr($no_sidebar && $blog_post_full_width ? 'no-page-padding': ''); ?>">

				<?php
				if ($format === 'video'):
					$video= rwmb_meta( 'kowloonbay_post_video');
					$video_ratio= rwmb_meta( 'kowloonbay_post_video_ratio');

					if (strpos($video, 'youtube') !== false):
				?>
					<div
						class="embed-youtube embed-responsive embed-responsive-<?php echo esc_attr($video_ratio === '16-9' ? '16by9' : '4by3'); ?>"
						data-video-url = "<?php echo esc_url( $video ); ?>">
					</div>
				<?php
					elseif (strpos($video, 'vimeo') !== false):
						$video_embed = $wp_embed->run_shortcode('[embed]'. $video .'[/embed]');
				?>
					<div class="embed-vimeo embed-responsive embed-responsive-<?php echo esc_attr($video_ratio === '16-9' ? '16by9' : '4by3'); ?>">
						<?php echo wp_kses($video_embed, $kowloonbay_allowed_html); ?>
					</div>
				<?php
					endif;
				endif;

				if ($format === 'gallery'):
					$gallery= rwmb_meta( 'kowloonbay_post_gallery', array('type'=>'image_advanced'));
					if (sizeof($gallery) > 0):
				?>
					<div class="<?php echo esc_attr( $gallery_slider_height_class ); ?>" <?php echo 'style="'. esc_attr($gallery_slider_height_style) .'"'; ?> >
						<div class="owl-carousel carousel-blog-gallery margin-v-none">
							<?php foreach ($gallery as $img) : ?>
								<div class="item img-bg-cover <?php echo esc_attr( $gallery_slider_bg_contain_class ); ?> <?php echo esc_attr( $gallery_slider_height_class ); ?>" <?php echo 'style="'. esc_attr($gallery_slider_height_style) .'"'; ?> >
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
					<div class="embed-responsive height-1-plus-half-x">
						<?php echo wp_kses($audio_embed, $kowloonbay_allowed_html); ?>
					</div>
				<?php
					endif;
				endif;

				if ($format === 'image'):
					$image = rwmb_meta( 'kowloonbay_post_image', array('type'=>'image_advanced'));
					$image = reset($image);
					$enableParallax = rwmb_meta( 'kowloonbay_post_enable_parallax') === '1';
					$displayFullImage = rwmb_meta( 'kowloonbay_post_display_full_image') === '1';

					if ($image !== false):
				?>
					<?php if ($displayFullImage): ?>

					<div><img src="<?php echo esc_url( $image['full_url'] ); ?>" alt="" style="width: 100%; height: auto;"></div>

					<?php else: ?>
					
					<div class="img-bg-cover <?php echo esc_attr($gallery_slider_height_class); ?> <?php echo esc_attr($enableParallax ? 'parallax' : ''); ?>" <?php echo 'style="'. esc_attr($gallery_slider_height_style) .'"'; ?> >
						<img src="<?php echo esc_url( $image['full_url'] ); ?>" alt="">
					</div>

					<?php endif; ?>
				<?php
					endif;
				endif;

				if (has_post_thumbnail()):
					$enableParallax = rwmb_meta( 'kowloonbay_post_enable_parallax') === '1';
					$displayFullImage = rwmb_meta( 'kowloonbay_post_display_full_image') === '1';
				?>
					<?php if ($displayFullImage): ?>

					<div><?php the_post_thumbnail( 'full', array('style' => 'width: 100%; height: auto;') ); ?></div>

					<?php else: ?>
					
					<div class="img-bg-cover <?php echo esc_attr( $gallery_slider_height_class ); ?> <?php echo esc_attr($enableParallax ? 'parallax' : ''); ?>" <?php echo 'style="'. esc_attr($gallery_slider_height_style) .'"'; ?> >
						<?php the_post_thumbnail( 'full' ); ?>
					</div>

					<?php endif; ?>
				<?php
				endif;
				?>

				<div class="margin-b-3x padding-t-1x padding-b-2x page-padding-h page-padding-h-sm">
					<div id="post-<?php the_ID(); ?>" <?php post_class('text-center');?> >
						<?php if ( get_the_title() !== '' ): ?>
						<h2 class="title"><span class="inline-block wow <?php echo esc_attr($animation_blog_post_title); ?>"><?php the_title(); ?></span></h2>
						<?php endif; ?>
						<?php
							global $kowloonbay_cats;

							$kowloonbay_cats = get_the_category( get_the_id() );
						?>
						<ul class="post-info list-inline title-font small-text margin-b-1x wow-array">
							<?php get_template_part('inc/kowloonbay-blog','infobar'); ?>
						</ul>
						<div class="post-content text-left">

							<?php if ($is_mini_entry): ?>
							<div class="pull-left">
								<i class="fa <?php 
									if ($format === 'quote') echo esc_attr( $blog_quote_fa_icon );
									if ($format === 'status') echo esc_attr( $blog_status_fa_icon );
									if ($format === 'link') echo esc_attr( $blog_link_fa_icon );
								?> fa-custom-lg fa-custom-no-margin-right"></i>
							</div>
							<?php endif; ?>

							<?php if ($is_mini_entry): ?>
							<div class="padding-l-2x margin-l-half quote-style">
							<?php endif; ?>

							<?php if ($format === 'quote'): ?>
							<blockquote class="padding-v-none padding-h-none margin-b-none">
							<?php endif; ?>

							<?php the_content(); ?>

							<?php if ($format === 'quote' && rwmb_meta( 'kowloonbay_post_quote_source') !== ''): ?>
							<footer><?php echo esc_html( rwmb_meta( 'kowloonbay_post_quote_source') ); ?></footer>
							</blockquote>
							<?php endif; ?>

							<?php if ($is_mini_entry): ?>
							</div>
							<?php endif; ?>

							<?php wp_link_pages(); ?>
						</div>
					</div>
					<?php if ($kowloonbay_redux_opts['blog_show_prev_next'] === '1'): ?>
					<div class="row prev-next margin-b-3x">
						<div class="col-sm-6 text-center text-left-sm">
							 <?php previous_post_link('<i class="fa fa-chevron-left primary-color fa-custom-sm"></i>%link'); ?> 
						</div>
						<div class="col-sm-6 text-center text-right-sm">
							 <?php next_post_link('%link<i class="fa fa-chevron-right primary-color fa-custom-sm fa-custom-margin-left"></i>'); ?> 
						</div>
					</div>
					<?php endif; ?>
					<?php
						$tags = get_the_tags();
						if (is_array($tags)){
							echo '<div class="post-tags"><h3>Tags</h3><p class="tags">';
							foreach ( $tags as $t)
							{
								echo '<a class="tl-tag" href="';
								echo esc_url(get_tag_link($t->term_id));
								echo '">'.$t->name.'</a>';
							}
							echo '</p></div>';
						}
					?>
					<?php 
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					?>
				</div>
			</div>

		<?php if (!$no_sidebar): ?>
		</div>
		<?php endif; ?>

		<?php if ($blog_layout === 'right_sidebar') get_sidebar(); ?>

	<?php if (!$no_sidebar): ?>
	</div>
	<?php endif; ?>

</section>

<?php
/* Footer */
get_footer();
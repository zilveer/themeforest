<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
$gallery_images_html = $gallery_thumbs_html = $data_atts = $single_gallery_style = '';//  data-slides-to-show="" data-autoplay="" data-slideshow-speed=""

$single_gallery_style = DfdMetaBoxSettings::compared('dfd_gallery_single_type', 'carousel');

$single_width = DfdMetaBoxSettings::compared('dfd_gallery_single_image_width', 900);

$single_height = DfdMetaBoxSettings::compared('dfd_gallery_single_image_height', 600);

$gallery_items_offset = DfdMetaBoxSettings::compared('dfd_gallery_single_items_offset', 0);

$show_title = DfdMetaBoxSettings::compared('dfd_gallery_single_show_title', false);

$show_meta = DfdMetaBoxSettings::compared('dfd_gallery_single_show_meta', false);

$show_fixed_share = DfdMetaBoxSettings::compared('dfd_gallery_single_show_fixed_share', false);

$show_read_more_share = DfdMetaBoxSettings::compared('dfd_gallery_single_show_read_more_share', false);

$share_style = DfdMetaBoxSettings::compared('dfd_gallery_single_share_style', false);
if($share_style) $share_style = 'dfd-share-'.$share_style;

if($gallery_items_offset) {
	$gallery_items_offset = (int) $gallery_items_offset / 2;
}

if(strcmp($single_gallery_style, 'masonry') === 0 || strcmp($single_gallery_style, 'fitRows') === 0) {
	wp_enqueue_script('isotope');
	wp_enqueue_script('dfd-isotope-gallery');
	$single_columns = DfdMetaBoxSettings::compared('dfd_gallery_single_columns', 1);
	
	$data_atts .= ' data-columns="'.esc_attr($single_columns).'"';
	$data_atts .= ' data-layout-style="'.esc_attr($single_gallery_style).'"';
} elseif(strcmp($single_gallery_style, 'carousel') === 0) {
	wp_enqueue_script('dfd-carousel-gallery');
	
	$single_autoplay = DfdMetaBoxSettings::compared('dfd_gallery_single_autoplay', 'true');
	$data_atts .= ' data-autoplay="'.esc_attr($single_autoplay).'"';
	
	$single_slideshow_speed = DfdMetaBoxSettings::compared('dfd_gallery_single_slideshow_speed', 3000);
	
	$data_atts .= ' data-slideshow-speed="'.esc_attr($single_slideshow_speed).'"';	
}

if (metadata_exists('post', $post->ID, '_gallery_image_gallery')) {
	$image_gallery = get_post_meta($post->ID, '_gallery_image_gallery', true);
} else {
	// Backwards compat
	$attachment_ids = get_posts('post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
	$attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
	$image_gallery = implode(',', $attachment_ids);
}
$attachments = array_filter(explode(',', $image_gallery));

$subtitle = DfdMetaBoxSettings::get('stunnig_headers_subtitle');

if($attachments) {
	foreach($attachments as $attachment_key => $attachment_id) {
		$image_src = wp_get_attachment_url($attachment_id, 'full');
		$image_url = $item_css = '';
		if(strcmp($single_gallery_style, 'masonry') !== 0) {
			$image_url = dfd_aq_resize($image_src, $single_width, $single_height, true, true, true);
		}
		if(!$image_url || empty($image_url)) {
			$image_url = $image_src;
		}
		if(!empty($gallery_items_offset)) {
			$item_css .= 'style="padding: '.esc_attr($gallery_items_offset).'px;"';
		}
		$thumb_url = wp_get_attachment_image_src($attachment_id, 'thumbnail');
				
		$thumb_data_attr = '';
		if(isset($thumb_url[0]) && !empty($thumb_url[0])) {
			$thumb_data_attr = 'data-thumb="'.esc_url($thumb_url[0]).'"';
			if(strcmp($single_gallery_style, 'carousel') === 0) {
				$gallery_thumbs_html .= '<div class="dfd-gallery-thumb-item">';
				$gallery_thumbs_html .= '<div class="cover" '.$item_css.'>';
				$gallery_thumbs_html .= '<img src="'.esc_url($thumb_url[0]).'"  alt="'.esc_attr(get_the_title()).'" />';
				$gallery_thumbs_html .= '</div>';
				$gallery_thumbs_html .= '</div>';
			}
		}
		$gallery_images_html .= '<div class="dfd-gallery-single-item">';
		$gallery_images_html .= '<div class="cover" '.$item_css.'>';
		$gallery_images_html .= '<a href="'.esc_url($image_src).'" '.$thumb_data_attr.' title="'.esc_attr($subtitle).'" data-rel="prettyPhoto[pp_gal]">';
		$gallery_images_html .= '<img src="'.esc_url($image_url).'"  alt="'.esc_attr(get_the_title()).'" />';
		$gallery_images_html .= '</a>';
		$gallery_images_html .= '</div>';
		$gallery_images_html .= '</div>';
	}
}
?>

<?php
if($show_fixed_share == 'on') {
	get_template_part('templates/entry-meta/mini','share-single');
}
?>
<div class="dfd-gallery-media">
	<?php if($show_title == 'on' || $show_meta == 'on')  : ?>
	<div class="dfd-single-gallery-heading">
		<?php if($show_title == 'on') : ?>
			<div class="dfd-folio-categories">
				<?php get_template_part('templates/gallery', 'term'); ?>
			</div>
			<div class="dfd-blog-title"><?php the_title(); ?></div>
		<?php endif; ?>
		<?php if($show_meta == 'on') : ?>
			<div class="subtitle"><?php echo esc_html($subtitle); ?></div>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<div class="dfd-gallery-wrap" <?php echo !empty($gallery_items_offset) ? 'style="margin: -'.esc_attr($gallery_items_offset).'px;"' : '' ?>>
		<div class="dfd-gallery dfd-gallery-<?php echo esc_attr($single_gallery_style) ?>" <?php echo $data_atts ?>>
			<?php echo $gallery_images_html ?>
		</div>
		<?php if(strcmp($single_gallery_style, 'carousel') === 0) echo '<div class="dfd-gallery-thumbnails" style="padding: 0 '.esc_attr($gallery_items_offset).'px;">'.$gallery_thumbs_html.'</div>'; ?>
	</div>

	<?php if(strcmp($single_gallery_style, 'advanced-gallery') === 0) : ?>
		<script type="text/javascript">
			(function($) {
				$(document).ready(function () {
					var container = $('.dfd-gallery');
					container.addClass('row collapse');
					$('> div', container).first().addClass('columns eight').end().not(':first, .clear').addClass('columns four');
				});
			})(jQuery);
		</script>
	<?php endif;
	if($show_read_more_share == 'on') : ?>
		<div class="dfd-meta-container">
			<div class="dfd-commentss-tags">
				<div class="post-comments-wrap">
					<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
					<span class="box-name"><?php _e('Comments','dfd') ?></span>
				</div>
				<div class="dfd-single-tags clearfix">
					<?php get_template_part('templates/entry-meta/mini', 'tags'); ?>
				</div>
			</div>
			<div class="dfd-like-share">
				<div class="post-like-wrap left">
					<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
				</div>
				<div class="dfd-share-cover <?php echo esc_attr($share_style);  ?>">
					<?php get_template_part('templates/entry-meta/mini','share-blog') ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
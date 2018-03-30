<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<?php hue_mikado_get_module_template_part('templates/lists/parts/image', 'blog', '', array('image_size' => $image_size)); ?>
	<div class="mkd-date-title">
		<?php hue_mikado_post_info(array('date' => 'yes')) ?>
		<?php hue_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
	</div>
	<?php
	$_video_type = get_post_meta(get_the_ID(), "mkd_video_type_meta", true);
	$_video_link_meta =  get_post_meta(get_the_ID(), "mkd_post_video_id_meta", true);
	$_video_link = $_video_link_meta !== '' ? $_video_link_meta : '#';

	if ($_video_type == "youtube") {
		$_video_link = 'https://www.youtube.com/watch?v=' . $_video_link_meta;
	} elseif ($_video_type == "vimeo") {
		$_video_link = 'https://www.vimeo.com/' . $_video_link_meta;
	} elseif ($_video_type == "self") {
		$_video_link = get_post_meta(get_the_ID(), "mkd_post_video_mp4_link_meta", true) . '?iframe=true&width50%&height=50%';
	}
	?>
	<a class="mkd-video-post-link" href="<?php echo esc_html($_video_link); ?>"
	   data-rel="prettyPhoto[<?php the_ID(); ?>]">
		<?php echo hue_mikado_icon_collections()->renderIcon('arrow_triangle-right_alt2', 'font_elegant', array('icon_attributes' => array('class' => 'mkd-vb-play-icon'))); ?>
	</a>
</article>
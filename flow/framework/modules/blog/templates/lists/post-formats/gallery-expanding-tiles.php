<?php 
$id = get_the_ID();
$image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large');
$image_gallery = get_post_meta($id, 'eltd_post_gallery_images_meta', true);
$gallery_urls = array();
if ($image_gallery != '') {
	$image_gallery_array = explode(',', $image_gallery);
	foreach ($image_gallery_array as $pic_id) {
		$temp = wp_get_attachment_image_src($pic_id, 'large');
		$gallery_urls[] = $temp[0];
	}
}
$params = array(
	'title_tag' => 'h4'
);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('sticky-slider eltd-blog-list-expandable-item eltd-blei-h-2 eltd-blei-post'); ?> data-importance="10000"> 
	<div class="eltd-blei-inner">
		<?php if($featured_class != ''){ ?>
			<div class="eltd-featured-triangle-holder">
				<div class="eltd-featured-triangle"></div>
				<span class="icon_star_alt"></span>
			</div>	
		<?php } ?>
		<div class="eltd-blei-upper-wrapper">
			<?php 
			if(!empty($gallery_urls)){ ?>
				<div class="slides">
					<?php 
						foreach($gallery_urls as $pic_url) { ?>
							
							<div class="eltd-blei-slide" style="background-image: url(' <?php echo esc_url($pic_url); ?> ')">
								<a class="eltd-blei-link" href="<?php echo get_the_permalink()?>"></a>
							</div>
					
						<?php }
					?>
				</div>
				<?php do_action( 'flow_elated_after_gallery_slide' ); ?>
				<div class="slides-cover"></div>
			<?php }else{ ?>	
				<div class="image-container eltd-bck-featured-image" style="background-image: url('<?php echo esc_url($image[0]); ?>')">
					<a href="<?php echo get_the_permalink()?>"></a>
				</div>
			<?php } ?>
			<?php flow_elated_get_module_template_part('templates/lists/parts/title', 'blog','',$params); ?>
		</div>
		<div class="eltd-blei-lower-wrapper">
			<div class="full-text-container"></div>
		</div>
		<div class="eltd-blei-collapse"><span class="icon_close"></span></div>
	</div>
</article>
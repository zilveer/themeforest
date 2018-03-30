<?php 
$id = get_the_ID();
$image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large');
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
			<div class="slides">
				<div class="eltd-blei-slide" style="background-image: url(' <?php echo esc_url($image[0]); ?> ')"></div>
			</div>
			<div class="eltd-blei-video-holder">
				<div class="eltd-blei-video-holder-inner">
					<?php flow_elated_get_module_template_part('templates/parts/video', 'blog'); ?>
				</div>
			</div>
			<a class="eltd-blei-link" href="<?php echo get_the_permalink()?>"><span class="eltd-play-button ion-play"></span></a>
			<div class="slides-cover"></div>
			<?php flow_elated_get_module_template_part('templates/lists/parts/title', 'blog','',$params); ?>
		</div>
		<div class="eltd-blei-lower-wrapper">
			<div class="full-text-container"></div>
		</div>
		<div class="eltd-blei-collapse"><span class="icon_close"></span></div>
	</div>
</article>
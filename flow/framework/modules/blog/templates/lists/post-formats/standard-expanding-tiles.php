<?php 
$id = get_the_ID();
$image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large');
$params = array(
	'title_tag' => 'h4'
);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('eltd-blog-list-expandable-item eltd-blei-h-1 eltd-blei-post'); ?> data-importance="10000">
	<div class="eltd-blei-inner">
		<div class="eltd-blei-upper-wrapper">
			<div class="image-container" style="background-image: url('<?php echo esc_url($image[0]); ?>')"><a href="<?php echo get_the_permalink()?>"></a></div>
			<?php if($featured_class != ''){ ?>
				<div class="eltd-featured-triangle-holder">
					<div class="eltd-featured-triangle"></div>
					<span class="icon_star_alt"></span>
				</div>	
			<?php } ?>
			<div class="description-container">
				<div class="latest-post">
					<div class="eltd-post-info eltd-category">
						<?php flow_elated_post_info(array(
							'category' => 'yes'
						))?>
					</div>
					<?php flow_elated_get_module_template_part('templates/lists/parts/title', 'blog','',$params); ?>
					<?php flow_elated_excerpt($excerpt_length); ?>
				</div>
				<?php flow_elated_read_more_button('', '', 'small');?>
				<div class="eltd-post-info">
					<?php flow_elated_post_info(array(
						'date' => 'yes',
						'comments' => 'yes',
						'like' => 'yes'
						))
					?>
				</div>
			</div>
		</div>
		<div class="eltd-blei-lower-wrapper">
			<div class="full-text-container"></div>
		</div>
		<div class="eltd-blei-collapse"><span class="icon_close"></span></div>
	</div>
</article>
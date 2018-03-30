<?php 
$id = get_the_ID();
$image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large');
$params = array(
	'title_tag' => 'h4'
);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('eltd-blog-list-expandable-item eltd-blei-h-1 eltd-blei-post'); ?> data-importance="10000">
	<div class="eltd-blei-inner">
		<?php if($featured_class != ''){ ?>
			<div class="eltd-featured-triangle-holder">
				<div class="eltd-featured-triangle"></div>
				<span class="icon_star_alt"></span>
			</div>	
		<?php } ?>
		<?php
			if ( get_post_meta(get_the_ID(), "eltd_post_soundcloud_link_meta", true) !== "" ) {
				flow_elated_get_module_template_part('templates/parts/soundcloud', 'blog');
			} else {
				?>
				<div class="eltd-blei-whole-bgnd" style="background-image: url(' <?php echo esc_url($image[0]); ?> ')"></div>
				<?php
				flow_elated_get_module_template_part('templates/parts/audio', 'blog','',$params);
			}
		?>
	</div>
</article>

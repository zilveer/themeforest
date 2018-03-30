<?php
$image_id = get_post_thumbnail_id();
$image_obj = wp_get_attachment_image_src( $image_id , 'full' );
$image = $image_obj[0];
?>
<div class="eltd-blog-slide-item" style="background-image: url( <?php echo esc_url( $image ); ?> )">
	<div class="eltd-blog-slide-post-info">
		<div class="eltd-blog-slide-categories">
			<?php the_category(', '); ?>
		</div>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_title('<h4 class="eltd-blog-slide-title">', '</h4>'); ?>
		</a>
		<?php
		flow_elated_post_info(array(
			'date' => 'yes'
		));
		echo flow_elated_get_button_html(array(
			'text' => esc_html__("Read More", "flow"),
			'link' => get_the_permalink()
		));
		?>
	</div>
</div>
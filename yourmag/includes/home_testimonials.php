
<div class="bxslider_container">
<div class="inner_10"> 
<ul class="bxslider">

	<?php 
    $featucat_test = get_option('op_test_cat');
	$slides_test = get_option('op_test_slides');
    $my_query = new WP_Query('showposts='. $slides_test .'&category_name='. $featucat_test .'');	
    if ($my_query->have_posts()) :
    ?>					
		
    <?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>	

    <li>
  
    <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
	<?php $image = aq_resize( $thumbnailSrc, 150, 150, true ); ?>
	<img alt="<?php the_title(); ?>" src="<?php echo $image ?>" />
  
    <?php $post_text = get_post_meta($post->ID, 'r_post_text', true); ?>
	<?php if($post_text !== '') { ?>
	<div class="bxslider_quote">
	    <?php echo $post_text; ?>
    </div>
	<?php } ?>

    <?php $custom_read_more = get_post_meta($post->ID, 'r_custom_read_more', true); ?>
	<?php if($custom_read_more !== '') { ?>
	<div class="custom_read_more">
	- <?php echo $custom_read_more; ?>
    </div>
	<?php } ?>
  
    </li>
	
    <?php endwhile; wp_reset_query(); ?> 
    <?php endif; ?> 
	
</ul>
</div> 
</div> 

<?php wp_enqueue_script('bxslider', BASE_URL . 'js/bxslider.min.js', false, '', true); ?>

<script type="text/javascript">
jQuery(document).ready(function($){  
$('.bxslider').bxSlider({
adaptiveHeight: true,
controls: false,
auto: true,
pause: 5000,
autoHover: true
});
});
</script>


<?php
/**
 * Slide Content
 *
 * @subpackage newidea
 * @since newidea 4.0
 */
global $page_id, $object_id, $default_background;

$post = get_page($object_id);
$bg = $default_background;

if( newidea_get_post_meta_key('default-image', $post->ID) != ""){
	$bg = newidea_get_post_meta_key('default-image', $post->ID);
}
?>
<!--Slide-->
<section id="<?php echo $page_id;?>" <?php post_class('contBg'); ?> data-bg="<?php echo $bg;?>"  >
	<span></span>
    <?php if(intval(newidea_get_post_meta_key('slider-layer-slide', $object_id)) > 0) { ?>
		<div class="newidea-layersider">
        	<?php echo do_shortcode('[layerslider id="'.(intval(newidea_get_post_meta_key('slider-layer-slide', $object_id))).'"]'); ?>
    	</div>
    <?php 
	}else{	
		echo __('Please first create your sliders then through edit page -> Page Options Setting choose slider.', 'newidea');
	} 
	?>
</section>
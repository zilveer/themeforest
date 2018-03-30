<?php
/**
 * About Content
 *
 * @subpackage newidea
 * @since newidea 4.0
 */
global $page_id,$object_id, $default_background;

$post = get_page($object_id);
$bg = $default_background;

if( newidea_get_post_meta_key('default-image', $post->ID) != ""){
	$bg = newidea_get_post_meta_key('default-image', $post->ID);
}
?>
<!--About-->
<section id="<?php echo $page_id;?>" <?php post_class('contBg'); ?> data-bg="<?php echo $bg;?>" >
	<span></span>
    <div class="about-container">
        <div class="aboutDes">
            <h2 class="title"><?php echo $post->post_title; ?></h2>
            <div class="scroll-pane">
            	<?php 
					$content = $post->post_content;
					$content = apply_filters( 'the_content', $content );
				?>
				<div><?php echo $content; ?></div>
            </div>
        </div>
        <div class="testimonials">
        	<h2 class="title"><?php echo newidea_get_post_meta_key('about-testimonials-title'); ?></h2>
           	<?php 
			if(has_post_thumbnail($post->ID) ){
			?>
            	<div class="testimonials-image">
            <?php echo get_the_post_thumbnail($post->ID, 'about-thumbnails' ,array('alt' => '','title' => ''));  ?>
            	</div>
            <?php
			}
			?>
            <div class="testimonials-container">
                <span class="test-quote-open"></span>
                <div class="testimonials-content">
                	<?php echo newidea_get_post_meta_key('about-testimonials-content'); ?>
                </div>
                <span class="test-quote-close"></span>
                <div class="testimonials-name"><?php echo __('- ','newidea').newidea_get_post_meta_key('about-testimonials-name'); ?></div>
            </div>
       </div>
    </div>
</section>
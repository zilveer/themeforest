<?php
global $masonry, $masonry_template_key, $image_size;

if ( has_post_thumbnail() ) { 
	$featured_img_attr = array('class'	=> "img-responsive",); ?>
    <?php 
	if (is_single()){ ?>
    	<?php 
		the_post_thumbnail($image_size,$featured_img_attr); ?>
	<?php }else{ ?>
    <?php
		$id = get_the_ID();
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'themo_full_width');
		echo '<a href="' . esc_url($large_image_url[0]) . '" title="' . the_title_attribute('echo=0') . '" data-toggle="lightbox" data-gallery="multiimages">';
		the_post_thumbnail($image_size,$featured_img_attr);
		echo '</a>';
	?>
    <?php } ?>
<?php } ?>
<div class="post-inner">
	<?php get_template_part('templates/entry-meta'.$masonry_template_key); ?>
	<?php 
	if (is_single()){
		$content = apply_filters( 'the_content', get_the_content() );
		$content = str_replace( ']]>', ']]&gt;', $content );
		if($content != ""){ ?>
            <div class="entry-content">
                <?php echo $content; ?>	
            </div>
     <?php } ?>
     <?php } ?>
	<?php get_template_part('templates/entry-meta-footer'.$masonry_template_key); ?>
</div>
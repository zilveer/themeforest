<?php
/**
 * Template for showing thumbnail
 */
global $mango_settings, $post, $thumbnail_size;

?>
<div class="entry-media">
    <figure>
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
            <?php 
			if(isset($thumbnail_size)){
				$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $thumbnail_size );
			?>
			
			<img src="<?php echo esc_url($url[0]); ?>" title="<?php the_title(); ?> " alt="<?php  esc_attr(the_title()); ?>"/>
			<?php 
				
			}else{
				the_post_thumbnail();
			}
			 ?>
        </a>
    </figure>
</div><!-- End .entry-media -->
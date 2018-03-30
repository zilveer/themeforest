<?php
/**
 * Single Content
 *
 * @subpackage newidea
 * @since newidea 4.0
 */
global $page_id, $default_background;
?>
<!--Single-->
<section id="<?php echo $page_id;?>" <?php post_class('contBg content-news'); ?> data-title="<?php echo get_the_title(); ?>" data-bg="<?php echo $default_background;?>"  >
	<span></span>
    <div class="services-container">
    	<?php 
		if(have_posts()) {
		?>
		<div class="single-post-content">
        	<?php
			// The Loop
			while ( have_posts() ) : the_post();
			?>
            <div <?php post_class('servicesList'); ?>>
            	<h5 class="title"><?php echo get_the_title(); ?></h5>
                <div class="clear"></div>
                <div class="item-image slidelite">
					<?php 
                    if(has_post_thumbnail(get_the_ID()) ){
                        echo get_the_post_thumbnail(get_the_ID(), 'services-thumbnails' ,array('alt' => get_the_title(),'title' => get_the_title())); 
                    }
                    
                    $gallery_images = newidea_get_post_meta_key('gallery-images', get_the_ID());
                    $img_list = newidea_get_post_gallery_ids($gallery_images);
                    
                    if(count($img_list) > 0){
                        foreach($img_list as $item_id){
                            $attachment_image = wp_get_attachment_image_src($item_id, "services-thumbnails"); 
                            $full_image = wp_get_attachment_image_src($item_id, 'full');
                            ?>
                            <img src="<?php echo esc_url($attachment_image[0]); ?>" alt="" title="<?php echo get_the_title(); ?>">
                            <?php
                        }
                    }
                    ?>                
                </div>
              	<div class="rhtCol">
					<div class="scroll-pane">
                    	<?php 
							$content = get_the_content();
							$content = apply_filters( 'the_content', $content );
						?>
						<div><?php echo $content; ?></div>
                    </div>
				</div>
          	</div>
			<?php endwhile; ?>
         </div>
        <?php 
			}else{
				echo __('Please open admin backend\'s <strong><em>Services -&gt; Add New</em></strong> add your services items.','newidea');
			}
		?>
	</div>
</section>
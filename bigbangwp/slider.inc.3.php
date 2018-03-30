<?php
  global $post, $wp_query;
  $extra_images_no = of_get_option(BRANKIC_VAR_PREFIX."extra_images_no");
  if ($extra_images_no == "") $extra_images_no = 20;
  $post_ID = $post->ID;
  
  $page_template = get_page_template();
  $path = pathinfo($page_template);
  $page_template = $path['filename'];
  
  $post_extra_images = array();
  $post_captions = array();
  $post_descriptions = array();
    
    for ($i = 1 ; $i <= $extra_images_no ; $i++)
        {
            
            if (get_post_meta($post_ID, BRANKIC_VAR_PREFIX."background_image", true) != "extra-image-" . $i)
            {
                if (class_exists('MultiPostThumbnails')  && MultiPostThumbnails::has_post_thumbnail('post', "extra-image-" . $i . "") ) :
                    $image_id = MultiPostThumbnails::get_post_thumbnail_id( 'post', "extra-image-" . $i . "", $post_ID );
                    
                    $image_feature_url = wp_get_attachment_image_src( $image_id, "blog-square" );
                    $post_extra_images[] = $image_feature_url[0];
                    
                    $post_url = "post_extra-image-" . $i . "_url";
                    $post_caption = "post_extra-image-" . $i . "_caption";  
                    $post_description = "post_extra-image-" . $i . "_description";
                    $post_captions[$i-1] = get_post_meta($post_ID, $post_caption, true);
                    $post_descriptions[$i-1] = get_post_meta($post_ID, $post_description, true);
                    $post_urls[$i-1] = get_post_meta($post_ID, $post_url, true);
                    
                endif;

            }
        }

        if (!empty($post_extra_images))
        {
        ?>        
            <div class="flexslider blog-slider" id="blog-slider">
                <ul class="slides">
            <?php
            for($i = 0 ; $i < $extra_images_no ; $i++)
            {
                if (isset($post_extra_images[$i]))
                {
                    if ($post_urls[$i] == "") $post_urls[$i] = "javascript:void()";
                     ?> 
                     <li>                     
                        <a href="<?php echo $post_urls[$i]; ?>">
                            <img src="<?php echo $post_extra_images[$i]; ?>" alt="<?php echo $post_captions[$i]; ?>">
                        </a>
                        <?php if ($post_captions[$i] != "" || $post_descriptions[$i] != "") { ?>
                        <p class="flex-caption">
                            <?php if ($post_captions[$i] != "") { echo $post_captions[$i]; } ?> 
                            <?php if ($post_descriptions[$i] != "") { ?><br><?php echo $post_descriptions[$i]; } ?>  
                        </p> 
                        <?php } ?>
                     </li><!--END SLIDE-->
                     <?php
                }
            }
            ?>
                </ul><!--END UL SLIDES-->
                
            </div><!--END FLEXSLIDER-->        
        <?php
        }
        
        ?>
<script type='text/javascript'>        
/***************************************************
    ADDITIONAL CODE FOR BLOG SLIDER
***************************************************/
jQuery(document).ready(function($){
        $('.blog-slider').flexslider({
        animation: "fade",  
        slideDirection: "horizontal",  
        slideshow: true,              
        slideshowSpeed: 3500,      
        animationDuration: 500,
        directionNav: true, 
        controlNav: false          
    });    
});
</script> 
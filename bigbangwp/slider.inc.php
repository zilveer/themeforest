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
                if (class_exists('MultiPostThumbnails')  && MultiPostThumbnails::has_post_thumbnail('page', "extra-image-" . $i . "") ) :
                    $image_id = MultiPostThumbnails::get_post_thumbnail_id( 'page', "extra-image-" . $i . "", $post_ID );
                                
                    $image_feature_url = wp_get_attachment_image_src( $image_id, "page_extra-image-" . $i . "" );
                    $page_extra_images[] = $image_feature_url[0];
                    
                    $page_url = "page_extra-image-" . $i . "_url";
                    $page_caption = "page_extra-image-" . $i . "_caption";  
                    $page_description = "page_extra-image-" . $i . "_description";
                    $page_captions[$i-1] = get_post_meta($post_ID, $page_caption, true);
                    $page_descriptions[$i-1] = get_post_meta($post_ID, $page_description, true);
                    $page_urls[$i-1] = get_post_meta($post_ID, $page_url, true);
                    
                endif;
                
                if (class_exists('MultiPostThumbnails')  && MultiPostThumbnails::has_post_thumbnail('post', "extra-image-" . $i . "") ) :
                    $image_id = MultiPostThumbnails::get_post_thumbnail_id( 'post', "extra-image-" . $i . "", $post_ID );
                    
                    $image_feature_url = wp_get_attachment_image_src( $image_id, "post_extra-image-" . $i . "" );
                    $post_extra_images[] = $image_feature_url[0];
                    
                    $post_url = "post_extra-image-" . $i . "_url";
                    $post_caption = "post_extra-image-" . $i . "_caption";  
                    $post_description = "post_extra-image-" . $i . "_description";
                    $post_captions[$i-1] = get_post_meta($post_ID, $post_caption, true);
                    $post_descriptions[$i-1] = get_post_meta($post_ID, $post_description, true);
                    $post_urls[$i-1] = get_post_meta($post_ID, $post_url, true);
                    
                endif;
                
                if (class_exists('MultiPostThumbnails')  && MultiPostThumbnails::has_post_thumbnail('portfolio_item', "extra-image-" . $i . "")  ) :
                    
					$image_id = MultiPostThumbnails::get_post_thumbnail_id( 'portfolio_item', "extra-image-" . $i . "", $post_ID );
                                
                    $image_feature_url = wp_get_attachment_image_src( $image_id, "portfolio_item_extra-image-" . $i . "" );
                    $portfolio_item_extra_images[] = $image_feature_url[0];
                    
                    $portfolio_item_url = "portfolio_item_extra-image-" . $i . "_url";
                    $portfolio_item_caption = "portfolio_item_extra-image-" . $i . "_caption";  
                    $portfolio_item_description = "portfolio_item_extra-image-" . $i . "_description";
                    $portfolio_item_captions[$i-1] = get_post_meta($post_ID, $portfolio_item_caption, true);
                    $portfolio_item_descriptions[$i-1] = get_post_meta($post_ID, $portfolio_item_description, true);
                    $portfolio_item_urls[$i-1] = get_post_meta($post_ID, $portfolio_item_url, true);
                    
                endif;
            }
        }
        if (isset($page_extra_images))
        {
        ?>
        <div class="slideshow-container">
        
            <div class="flexslider" id="index-slider">
                <ul class="slides">
            <?php
            for($i = 0 ; $i < $extra_images_no ; $i++)
            {
                if (isset($page_extra_images[$i]))
                {
                    if ($page_urls[$i] == "") $page_urls[$i] = "javascript:void()";
                     ?> 
                     <li>                     
                        <a href="<?php echo $page_urls[$i]; ?>">
                            <img src="<?php echo $page_extra_images[$i]; ?>" alt="<?php echo $page_captions[$i]; ?>">
                        </a>
                        <?php if ($page_captions[$i] != "" || $page_descriptions[$i] != "") { ?>
                        <p class="flex-caption">
                            <?php if ($page_captions[$i] != "") { echo $page_captions[$i]; } ?> 
                            <?php if ($page_descriptions[$i] != "") { ?><br><?php echo $page_descriptions[$i]; } ?>  
                        </p> 
                        <?php } ?>
                     </li><!--END SLIDE-->
                     <?php
                }
            }
            ?>
                </ul><!--END UL SLIDES-->
                
            </div><!--END FLEXSLIDER-->        
            
        </div><!--END SLIDESHOW-CONTAINER-->
        <?php
        }
        ?>
        <?php
        if (!empty($post_extra_images) && (get_post_format() != "chat"))
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
        <?php
        if (isset($portfolio_item_extra_images))
        {
            $twin_slides = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."twin_slides", true);
            $disable_slider = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."disable_slider", true);
            if ($disable_slider == "yes")
            {
                ?>
                <style type="text/css">
                <!--
                .postid-<?php echo get_the_ID(); ?> .flexslider .slides > li {
                  display: block;
                  margin-bottom:10px;
                }
                -->
                </style>
                
                <?php
            }  
        ?>     
            <div class="flexslider" id="portfolio-slider<?php if ($disable_slider == "yes") echo "_no_slider";?>">
                <ul class="slides">
            <?php
            if ($twin_slides == "yes")
            {
                ?>
<style type="text/css">
<!--
.flex-direction-nav li a {bottom: 4px;}
-->
</style>
                <?php
                $half_images = ceil($extra_images_no / 2);
                for($i = 0 ; $i < $half_images ; $i++)
                {
                    if (isset($portfolio_item_extra_images[2 * $i]))
                    {
                        if ($portfolio_item_urls[2 * $i] == "") $portfolio_item_urls[2 * $i] = "javascript:void()";
                        if ($portfolio_item_urls[2 * $i + 1] == "") $portfolio_item_urls[2 * $i + 1] = "javascript:void()";
                         ?> 
                         <li>                     
                            <a href="<?php echo $portfolio_item_urls[2 * $i]; ?>">
                                <img style="width:49%; display: inline" src="<?php echo $portfolio_item_extra_images[2 * $i]; ?>" alt="<?php echo $portfolio_item_captions[2 * $i]; ?>">
                            </a>
                            <?php if ($portfolio_item_captions[2 * $i] != "" || $portfolio_item_descriptions[2 * $i] != "") { ?>
                            <p class="flex-caption">
                                <?php if ($portfolio_item_captions[2 * $i] != "") { echo $portfolio_item_captions[2 * $i]; } ?> 
                                <?php if ($portfolio_item_descriptions[2 * $i] != "") { ?><br><?php echo $portfolio_item_descriptions[2 * $i]; } ?>  
                            </p> 
                            <?php } ?>
                            
                            <a href="<?php echo $portfolio_item_urls[2 * $i + 1]; ?>">
                                <img style="width:49%; display: inline" src="<?php echo $portfolio_item_extra_images[2 * $i + 1]; ?>" alt="<?php echo $portfolio_item_captions[2 * $i + 1]; ?>">
                            </a>
                            <?php if ($portfolio_item_captions[2 * $i + 1] != "" || $portfolio_item_descriptions[2 * $i + 1] != "") { ?>
                            <p class="flex-caption">
                                <?php if ($portfolio_item_captions[2 * $i + 1] != "") { echo $portfolio_item_captions[2 * $i + 1]; } ?> 
                                <?php if ($portfolio_item_descriptions[2 * $i + 1] != "") { ?><br><?php echo $portfolio_item_descriptions[2 * $i + 1]; } ?>  
                            </p> 
                            <?php } ?>
                         </li><!--END SLIDE-->
                         <?php
                    }
                }
                
            }
            else
            {
                for($i = 0 ; $i < $extra_images_no ; $i++)
                {
                    if (isset($portfolio_item_extra_images[$i]))
                    {
                        if ($portfolio_item_urls[$i] == "") $portfolio_item_urls[$i] = "javascript:void()";
                         ?> 
                         <li>                     
                            <a href="<?php echo $portfolio_item_urls[$i]; ?>">
                                <img src="<?php echo $portfolio_item_extra_images[$i]; ?>" alt="<?php echo $portfolio_item_captions[$i]; ?>">
                            </a>
                            <?php if ($portfolio_item_captions[$i] != "" || $portfolio_item_descriptions[$i] != "") { ?>
                            <p class="flex-caption">
                                <?php if ($portfolio_item_captions[$i] != "") { echo $portfolio_item_captions[$i]; } ?> 
                                <?php if ($portfolio_item_descriptions[$i] != "") { ?><br><?php echo $portfolio_item_descriptions[$i]; } ?>  
                            </p> 
                            <?php } ?>
                         </li><!--END SLIDE-->
                         <?php
                    }
                }
            }
            ?>
                </ul><!--END UL SLIDES-->
                
            </div><!--END FLEXSLIDER--> 

        <?php
        }
        ?>
        <?php
        if (isset($post_extra_images) && (get_post_format() == "chat"))
        {
            $twin_slides = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."twin_slides", true);
            $disable_slider = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."disable_slider", true);
            if ($disable_slider == "yes")
            {
                ?>
                <style type="text/css">
                <!--
                .postid-<?php echo get_the_ID(); ?> .flexslider .slides > li {
                  display: block;
                  margin-bottom:10px;
                }
                -->
                </style>
                
                <?php
            }  
        ?>     
            <div class="flexslider" id="portfolio-slider<?php if ($disable_slider == "yes") echo "_no_slider";?>">
                <ul class="slides">
            <?php
            if ($twin_slides == "yes")
            {
                ?>
<style type="text/css">
<!--
.flex-direction-nav li a {bottom: 4px;}
-->
</style>
                <?php
                $half_images = ceil($extra_images_no / 2);
                for($i = 0 ; $i < $half_images ; $i++)
                {
                    if (isset($post_extra_images[2 * $i]))
                    {
                        if ($post_urls[2 * $i] == "") $post_urls[2 * $i] = "javascript:void()";
                        if ($post_urls[2 * $i + 1] == "") $post_urls[2 * $i + 1] = "javascript:void()";
                         ?> 
                         <li>                     
                            <a href="<?php echo $post_urls[2 * $i]; ?>">
                                <img style="width:49%; display: inline" src="<?php echo $post_extra_images[2 * $i]; ?>" alt="<?php echo $post_captions[2 * $i]; ?>">
                            </a>
                            <?php if ($post_captions[2 * $i] != "" || $post_descriptions[2 * $i] != "") { ?>
                            <p class="flex-caption">
                                <?php if ($post_captions[2 * $i] != "") { echo $post_captions[2 * $i]; } ?> 
                                <?php if ($post_descriptions[2 * $i] != "") { ?><br><?php echo $post_descriptions[2 * $i]; } ?>  
                            </p> 
                            <?php } ?>
                            
                            <a href="<?php echo $post_urls[2 * $i + 1]; ?>">
                                <img style="width:49%; display: inline" src="<?php echo $post_extra_images[2 * $i + 1]; ?>" alt="<?php echo $post_captions[2 * $i + 1]; ?>">
                            </a>
                            <?php if ($post_captions[2 * $i + 1] != "" || $post_descriptions[2 * $i + 1] != "") { ?>
                            <p class="flex-caption">
                                <?php if ($post_captions[2 * $i + 1] != "") { echo $post_captions[2 * $i + 1]; } ?> 
                                <?php if ($post_descriptions[2 * $i + 1] != "") { ?><br><?php echo $post_descriptions[2 * $i + 1]; } ?>  
                            </p> 
                            <?php } ?>
                         </li><!--END SLIDE-->
                         <?php
                    }
                }
                
            }
            else
            {
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
            }
            ?>
                </ul><!--END UL SLIDES-->
                
            </div><!--END FLEXSLIDER--> 

        <?php
        }		
		?>
<script type='text/javascript'> 
/***************************************************
    ADDITIONAL CODE FOR PAGE SLIDER
***************************************************/
jQuery(document).ready(function($){
        $('#index-slider').flexslider({
        animation: "fade",  
        slideDirection: "horizontal",  
        slideshow: true,              
        slideshowSpeed: 3500,      
        animationDuration: 500,
        directionNav: true, 
        controlNav: false  
    });
});


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



/***************************************************
    ADDITIONAL CODE FOR PORTFOLIO SLIDER
***************************************************/
jQuery(document).ready(function($){
        $('#portfolio-slider').flexslider({
        animation: "slide",  
        slideDirection: "horizontal",  
        slideshow: true,              
        slideshowSpeed: 3500,      
        animationDuration: 500,
        directionNav: true, 
        controlNav: false          
    });    
});
</script> 
<script type='text/javascript'> 
jQuery(document).ready(function($) {
$(".flexslider img").each(function(){
var img_src = $(this).attr("src");
var img_href = $(this).parent("a").attr("href");

if (img_href == "#" || img_href=="javascript:void()") {
        $(this).parent("a").attr("href", img_src).attr("data-rel", "prettyPhoto[]")
}
})
}) 
</script>
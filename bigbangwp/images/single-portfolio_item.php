<?php
get_header(); 
wp_reset_query();
global $root; 
  
if ( have_posts() ) while ( have_posts() ) : the_post();
        $post_id = get_the_ID();
        
    for ($i = 1 ; $i <= 20 ; $i++)
        {
                                                                                          
            if (class_exists('MultiPostThumbnails')  && MultiPostThumbnails::has_post_thumbnail('portfolio_item', "extra-image-" . $i . "")) :
                $image_id = MultiPostThumbnails::get_post_thumbnail_id( 'portfolio_item', "extra-image-" . $i . "", $post_id );           
                $image_feature_url = wp_get_attachment_image_src( $image_id, "portfolio_item_extra-image-" . $i . "" );
                $page_extra_images[] = $image_feature_url[0];
                
                $page_url = "portfolio_item_extra-image-" . $i . "_url";
                $page_caption = "portfolio_item_extra-image-" . $i . "_caption";  
                $page_description = "portfolio_item_extra-image-" . $i . "_description";
                $page_captions[$i-1] = get_post_meta($post_id, $page_caption, true);
                $page_descriptions[$i-1] = get_post_meta($post_id, $page_description, true);
                $page_urls[$i-1] = get_post_meta($post_id, $page_url, true);
                
            endif;
        }
        
        // get additional HTML
        $additional_HTML = get_post_meta($post->ID, "bra_additional_content", true);

?>
<div class="dynamic-content-wrapper">    

    <div class="section-title">    
        
        <div class="two-third"><h3><?php the_title(); ?></h3></div>
                
        <div class="one-third last">
        
            <ul class="item-nav">
                <li class="prev"><?php //be_next_post_link("%link", "%title", true, "", 'portfolio_category') ?></li>
                <li class="next"><?php //be_previous_post_link("%link", "%title", true, "", 'portfolio_category') ?></li>
                <?php if (get_option($var_prefix."portfolio_inline") == "yes") { ?><li class="all"><a href="#">All</a></li><?php } ?>
            </ul><!--END ITEM-NAV-->
            
        </div><!--ONE-->    
                    
    </div><!--END SECTION TITLE-->
        
<div id="portfolio-item-wrapper">
    
        <div class="two-third">
        
            <div id="portfolio" class="portfolio-single slider">
             
                <div class="slides_container">
            <?php
            for($i = 0 ; $i < 20 ; $i++)
            {
                if (isset($page_extra_images[$i]))
                {
                    if ($page_urls[$i] == "") $page_urls[$i] = "#";
                     ?>
                     <div class="slide">
                         
                        <a href="<?php echo $page_urls[$i]; ?>">
                            <img src="<?php echo $page_extra_images[$i]; ?>" alt="<?php echo $page_captions[$i]; ?>">
                        </a>
                        <?php if ($page_captions[$i] != "" || $page_descriptions[$i] != "") { ?>
                        <div class="caption">
                            <?php if ($page_captions[$i] != "") { ?><p><?php echo $page_captions[$i]; ?></p><?php } ?> 
                            <?php if ($page_descriptions[$i] != "") { ?><span><?php echo $page_descriptions[$i]; ?></span><?php } ?>  
                        </div> 
                        <?php } ?>
                     </div><!--END SLIDE-->
                     <?php
                }
            }
            ?>                                  
                </div><!--END SLIDES_CONTAINER-->
                
            </div><!--END PORTFOLIO PORTFOLIO-SINGLE SLIDER-->
                
        </div><!--END TWO-THIRD-->        
    
        <div class="one-third last">
            
            <div class="item-details">
                <?php the_content(); ?>                    
            </div><!--END ITEM-DETAILS-->               
        
        </div><!--END PORTFOLIO-ITEM-DETAILS-->    
    
    </div><!--END PORTFOLIO-ITEM-WRAPPER-->            

</div><!--END DYNAMIC-CONTENT-WRAPPER-->
             
<?php 
endwhile;

$include_file = "portfolio_section.inc.php";
    //if (get_option($var_prefix."portfolio_behaviour") == "no_hover") $include_file = "portfolio_section_no_hover.inc.php";
    //if (get_option($var_prefix."portfolio_behaviour") == "no_hover_preview") $include_file = "portfolio_section_no_hover_preview.inc.php";
    //if (get_option($var_prefix."portfolio_behaviour") == "no_hover_with_icons") $include_file = "portfolio_section_no_hover_with_icons.inc.php"; 
    include($include_file);
?>             
</div><!--END WRAPPER-->                  
            


<?php get_footer(); ?>
<?php
$subtitle = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true);
$hide_title = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."hide_title", true); 
$centered_title = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."centered_title", true);
$sidebar = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."select_sidebar", true);
$hide_featured_image = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."hide_featured_image", true); 
$hide_no_of_comments = of_get_option(BRANKIC_VAR_PREFIX."hide_no_of_comments");
if ($hide_no_of_comments == "yes" && get_comments_number() == 0) $hide_no_of_comments = "yes"; else $hide_no_of_comments = "no";
$featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); 
if ($blog_single_page_style == 3) $featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-square' ); 
$featured_image = $featured_image_array[0];

if (of_get_option(BRANKIC_VAR_PREFIX."blog_single_page_style_fullwidth") != "no") $full_width = 1; else $full_width = 0;
?>
                <div class="post-info">                        
                    <div class="date"><span class="month"><?php the_time('M'); ?></span><span class="day"><?php the_time('d'); ?></span><span class="month"><?php the_time('Y'); ?></span></div>                    
                    <?php if ($hide_no_of_comments != "yes") { ?>
                    <div class="comments"><?php comments_popup_link( __('<span>0</span> Comments', BRANKIC_THEME_SHORT), __('<span>1</span> Comment', BRANKIC_THEME_SHORT), __('<span>%</span> Comments', BRANKIC_THEME_SHORT)); ?></div>                            
                    <?php } ?>                            
                </div><!--END POST-INFO-->        
                
                <div class="post-content">  
                
                    <div class="post-title">                
                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </div><!--END POST-TITLE-->
                    
                    <div class="post-meta">                
                        <ul>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_authors_blog_single_page") == "yes") { ?><li><span><?php _e('Posted by', BRANKIC_THEME_SHORT); ?></span> <?php the_author_link(); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_cats_blog_single_page") == "yes") { ?><li> <span><?php _e('in', BRANKIC_THEME_SHORT); ?></span> <?php the_category(', '); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_tags_blog_single_page") == "yes") { ?><li> <span><?php _e(' Tagged with', BRANKIC_THEME_SHORT); ?></span> <?php the_tags('', ', ', ''); ?></li><?php } ?>
                        </ul>
                    </div><!--END POST-META-->  
            
                    <div class="post-media">
                    <?php
                    $video_link = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."video_link", true);

                    if ($video_link != "")
                    {
                        if (bra_is_mov($video_link) || bra_is_swf($video_link))
                        {
                        ?>
                        <iframe src="<?php echo $video_link; ?>" width="100%" height="400" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                        <?php
                        }
                        if (bra_is_vimeo($video_link) || bra_is_youtube($video_link))
                        {
                            if (bra_is_vimeo($video_link))
                            {
                                $video_link = "http://player.vimeo.com/video/" . bra_get_vimeo_id($video_link);
                            }
                            if (bra_is_youtube($video_link))
                            {
                                $video_link = "http://www.youtube.com/embed/" . bra_get_youtube_id($video_link);
                            }
                            ?>
                            <iframe src="<?php echo $video_link; ?>" width="100%" height="400" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                            <?php
                        }
                    }
                    else
                    {
                        if ($full_width) $img_width = 850; else $img_width = 600;
                    ?>        
                        <?php if (extra_images_exists()) { include ("slider.inc.php"); } else { ?>
                            <?php if ($hide_featured_image != "yes") { ?>          
                            <img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" width="<?php echo $img_width; ?>" />
                            <?php } ?>
                        <?php } ?>
                    <?php } ?> 
                    </div><!--END POST-MEDIA-->		
                    <?php the_content(); ?>
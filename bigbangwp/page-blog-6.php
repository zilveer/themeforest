<?php
/*
Template Name: Blog 6
*/ 
get_header(); 
?>

<?php while ( have_posts() ) : the_post(); ?>
<?php
$subtitle = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true);
$hide_title = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."hide_title", true); 
$centered_title = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."centered_title", true);
$select_blog_category = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."select_blog_category", true); 
$sidebar = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."select_sidebar", true);
$featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); 
$featured_image = $featured_image_array[0]; 
$hide_featured_image = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."hide_featured_image", true); 
$sidebar = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."select_sidebar", true);

if ( get_query_var('paged') ) 
{
    $paged = get_query_var('paged');
} 
elseif ( get_query_var('page') ) 
{
    $paged = get_query_var('page');
} 
else 
{
    $paged = 1;
}
if ($paged > 1) $subtitle .= " - " . __("page", BRANKIC_THEME_SHORT) . " " . $paged; 

if ($hide_title != "yes")
{
?>
    <div class="section-title">
    
        <h1 class="title"><?php the_title(); if ($subtitle != "") { ?> <span><?php echo $subtitle; ?></span><?php } ?></h1>
                        
    </div><!--END SECTION TITLE-->
<?php
}
?>  

<?php
if ($centered_title != "")
{
?>
    <div class="section-title text-align-center">
    
        <h1 class="title"><?php echo $centered_title; ?></h1>
<?php if ($subtitle != "") { ?> <p><?php echo $subtitle; ?></p><?php } ?>
                        
    </div><!--END SECTION TITLE-->
<?php
}
if (!$sidebar)
{
?> 
    <div class="one blog6"> 
<?php
}
else
{
?>
    <div id="inner-content" class="blog6">  
<?php
}
?> 
    <?php
    if ($featured_image != "" && $hide_featured_image != "yes") 
    {
    ?> 
    <p><img src="<?php echo $featured_image; ?>" alt=""></p>
    <?php
    }
    if (extra_images_exists()) include ("slider.inc.php"); 
    the_content();
    ?>
<?php
    $args=array(
    'cat' => $select_blog_category,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged
    );
    $temp = $wp_query;
    $wp_query = new WP_Query( $args );

// The Loop
while ( $wp_query->have_posts() ) : $wp_query->the_post();
$featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); 
$featured_image = $featured_image_array[0];
$hide_no_of_comments = of_get_option(BRANKIC_VAR_PREFIX."hide_no_of_comments");
if ($hide_no_of_comments == "yes" && get_comments_number() == 0) $hide_no_of_comments = "yes"; else $hide_no_of_comments = "no";
?>

            <div class="post">
        
                <div class="post-title">                
                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div><!--END POST-TITLE-->
                
                <div class="post-meta">                
                    <ul>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_authors_blog_page") == "yes") { ?><li><span><?php _e('Posted by', BRANKIC_THEME_SHORT); ?></span> <?php the_author_link(); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_cats_blog_page") == "yes") { ?><li> <span><?php _e('in', BRANKIC_THEME_SHORT); ?></span> <?php the_category(', '); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_tags_blog_page") == "yes") { ?><li> <span><?php _e(' Tagged with', BRANKIC_THEME_SHORT); ?></span> <?php the_tags('', ', ', ''); ?></li><?php } ?>
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
                        if (!$sidebar) $img_width = 950; else $img_width = 700;
                    ?>
                        <?php if (extra_images_exists()) { include ("slider.inc.php"); } else { ?>         
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ; ?>" width="<?php echo $img_width; ?>" /></a>
                        <?php } ?>
                    <?php } ?> 
                </div><!--END POST-MEDIA-->
            
                <div class="post-info">                        
                    <div class="date"><span class="month"><?php the_time('M'); ?></span><span class="day"><?php the_time('d'); ?></span><span class="month"><?php the_time('Y'); ?></span></div>                    
                    <?php if ($hide_no_of_comments == "yes") { ?>
                    <div class="comments"><?php comments_popup_link( __('<span>0</span> Comments', BRANKIC_THEME_SHORT), __('<span>1</span> Comment', BRANKIC_THEME_SHORT), __('<span>%</span> Comments', BRANKIC_THEME_SHORT)); ?></div>                            
                    <?php } ?>                             
                </div><!--END POST-INFO-->        
                
                <div class="post-content">    
                
   
<?php
the_excerpt();
?>
<p><a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Continue reading &rarr;', BRANKIC_THEME_SHORT); ?></a></p>
                </div><!--END POST-CONTENT -->
                
            </div><!--END POST-->
<?php
endwhile;
if(function_exists('wp_pagenavi_bra')) { wp_pagenavi_bra(); }  
?>  
        
        </div><!--END INNER-CONTENT-->
<?php 

if ($sidebar) get_sidebar();  

$wp_query = $temp;  //reset back to original query
?>

<?php endwhile; // end of the loop. ?> 		
<?php get_footer(); ?>
			
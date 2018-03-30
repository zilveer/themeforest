<?php get_header(); ?>
<?php
$paged = (get_query_var("paged")) ? get_query_var("paged") : 1;
$category_page_style = of_get_option(BRANKIC_VAR_PREFIX."category_page_style", of_get_default(BRANKIC_VAR_PREFIX."category_page_style")); 
$category_page_style_fullwidth = of_get_option(BRANKIC_VAR_PREFIX."category_page_style_fullwidth", of_get_default(BRANKIC_VAR_PREFIX."category_page_style_fullwidth"));


//if ($category_page_style == "") $category_page_style = "1"; 
//if ($category_page_style_fullwidth == "") $category_page_style_fullwidth = "no"; 
              
if (is_month()) 
{
    $title = __("Monthly archive", BRANKIC_THEME_SHORT);
    $subtitle = __("for ", BRANKIC_THEME_SHORT) . single_month_title('', false);
    if ($paged > 1) $subtitle .= " - " . __("page", BRANKIC_THEME_SHORT) . " " . $paged;
}

if (is_tag()) 
{
    $title = __("Tag archive", BRANKIC_THEME_SHORT);
    $subtitle = __("for ", BRANKIC_THEME_SHORT) . single_tag_title('', false);
    if ($paged > 1) $subtitle .= " - " . __("page", BRANKIC_THEME_SHORT) . " " . $paged;
}
if (is_search()) 
{
    $title = __("Search results", BRANKIC_THEME_SHORT);
    $subtitle = __("for ", BRANKIC_THEME_SHORT) . get_search_query();
    if ($paged > 1) $subtitle .= " - " . __("page", BRANKIC_THEME_SHORT) . " " . $paged;
}
if (is_category()) 
{
    $title = __("Archive", BRANKIC_THEME_SHORT);
    $subtitle = __("for ", BRANKIC_THEME_SHORT) . single_cat_title('', false);
    if ($paged > 1) $subtitle .= " - " . __("page", BRANKIC_THEME_SHORT) . " " . $paged;
}
if (is_home()) 
{
    $title = get_option('blogname');
    $subtitle = get_option('blogdescription');
    if ($paged > 1) $subtitle .= " - " . __("page", BRANKIC_THEME_SHORT) . " " . $paged;
}
?>
    <div class="section-title">
    
        <h1 class="title"><?php echo $title; ?> <span><?php echo $subtitle; ?></span></h1>
                        
    </div><!--END SECTION TITLE-->
<?php
if ($category_page_style == 1) $inner_content_class = "blog1";
if ($category_page_style == 2) $inner_content_class = "blog1"; 
if ($category_page_style == 3) $inner_content_class = "blog3"; 
if ($category_page_style == 4) $inner_content_class = "blog1"; 
if ($category_page_style == 5) $inner_content_class = "blog5"; 
if ($category_page_style == 6) $inner_content_class = "blog6"; 
?>
    
<?php
if ($category_page_style_fullwidth == "yes")
{
?> 
    <div class="one <?php echo $inner_content_class; ?>"> 
<?php
}
else
{
?>
    <div id="inner-content" class="<?php echo $inner_content_class; ?>">  
<?php
}
?>
    
<?php if(have_posts()) : while ( have_posts() ) : the_post(); 
$hide_no_of_comments = of_get_option(BRANKIC_VAR_PREFIX."hide_no_of_comments", of_get_default(BRANKIC_VAR_PREFIX."hide_no_of_comments"));
if ($hide_no_of_comments == "yes" && get_comments_number() == 0) $hide_no_of_comments = "yes"; else $hide_no_of_comments = "no";
$featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' );
if ($category_page_style == 3) $featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-square' ); 
$featured_image = $featured_image_array[0];
?>

<?php
if ($category_page_style == "1")
{
?>
            <div class="post">
            
                <div class="post-info">                        
                    <div class="date"><span class="month"><?php the_time('M'); ?></span><span class="day"><?php the_time('d'); ?></span><span class="month"><?php the_time('Y'); ?></span></div>                    
                    <?php if ($hide_no_of_comments != "yes") { ?>
                    <div class="comments"><?php comments_popup_link( __('<span>0</span> Comments', BRANKIC_THEME_SHORT), __('<span>1</span> Comment', BRANKIC_THEME_SHORT), __('<span>%</span> Comments', BRANKIC_THEME_SHORT)); ?></div>                            
                    <?php } ?>                            
                </div><!--END POST-INFO-->        
                
                <div class="post-content">    
            
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
                        if ($category_page_style_fullwidth == "yes") $img_width = 850; else $img_width = 600;
                    ?>
                        <?php if (extra_images_exists()) { include ("slider.inc.php"); } else { ?>         
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ; ?>" width="<?php echo $img_width; ?>" /></a>
                        <?php } ?>
                    <?php
                    }
                    ?>
                    </div><!--END POST-MEDIA-->
                
                    <div class="post-title">                
                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </div><!--END POST-TITLE-->
                
                    <div class="post-meta">                
                        <ul>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_authors_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_authors_blog_page")) == "yes") { ?><li><span><?php _e('Posted by', BRANKIC_THEME_SHORT); ?></span> <?php the_author_link(); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_cats_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_cats_blog_page")) == "yes") { ?> <li> <span> <?php _e('in', BRANKIC_THEME_SHORT); ?></span> <?php the_category(', '); ?> </li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_tags_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_tags_blog_page")) == "yes") { ?> <li> <span> <?php _e(' Tagged with', BRANKIC_THEME_SHORT); ?></span> <?php the_tags('', ', ', ''); ?> </li><?php } ?>
                        </ul>
                    </div><!--END POST-META-->
<?php
}
?>

<?php
if ($category_page_style == "2")
{
?>
            <div class="post">
            
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
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_authors_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_authors_blog_page")) == "yes") { ?><li><span><?php _e('Posted by', BRANKIC_THEME_SHORT); ?></span> <?php the_author_link(); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_cats_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_cats_blog_page")) == "yes") { ?><li> <span><?php _e('in', BRANKIC_THEME_SHORT); ?></span> <?php the_category(', '); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_tags_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_tags_blog_page")) == "yes") { ?><li> <span><?php _e(' Tagged with', BRANKIC_THEME_SHORT); ?></span> <?php the_tags('', ', ', ''); ?></li><?php } ?>
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
                        if ($category_page_style_fullwidth == "yes") $img_width = 850; else $img_width = 600;
                    ?>
                        <?php if (extra_images_exists()) { include ("slider.inc.php"); } else { ?>        
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ; ?>" width="<?php echo $img_width; ?>" /></a>
                        <?php } ?>
                    <?php } ?> 
                    </div><!--END POST-MEDIA-->
<?php
}
?>

<?php
if ($category_page_style == "3")
{
?>
            <div class="post">
            
                <div class="post-info">                        
                    <div class="date"><span class="month"><?php the_time('M'); ?></span><span class="day"><?php the_time('d'); ?></span><span class="month"><?php the_time('Y'); ?></span></div>                    
                    <?php if ($hide_no_of_comments != "yes") { ?>
                    <div class="comments"><?php comments_popup_link( __('<span>0</span> Comments', BRANKIC_THEME_SHORT), __('<span>1</span> Comment', BRANKIC_THEME_SHORT), __('<span>%</span> Comments', BRANKIC_THEME_SHORT)); ?></div>                            
                    <?php } ?>                             
                </div><!--END POST-INFO-->          
            
                <div class="post-media">
                <?php
                    $video_link = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."video_link", true);

                    if ($video_link != "")
                    {
                        if (bra_is_mov($video_link) || bra_is_swf($video_link))
                        {
                        ?>
                        <iframe src="<?php echo $video_link; ?>" width="100%" height="200" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
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
                            <iframe src="<?php echo $video_link; ?>" width="100%" height="200" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                            <?php
                        }
                    }
                    else
                    {
                    ?>
                        <?php if (extra_images_exists()) { include ("slider.inc.3.php"); } else { ?>         
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ; ?>" width="270" height"270" /></a>
                        <?php } ?>
                    <?php } ?> 
                </div><!--END POST-MEDIA-->
                
                <div class="post-content">
                    
                    <div class="post-title">                
                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </div><!--END POST-TITLE-->
                
                    <div class="post-meta">                
                        <ul>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_authors_blog_page") == "yes") { ?><li> <span><?php _e('Posted by', BRANKIC_THEME_SHORT); ?></span> <?php the_author_link(); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_cats_blog_page") == "yes") { ?><li> <span><?php _e('in', BRANKIC_THEME_SHORT); ?></span> <?php the_category(', '); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_tags_blog_page") == "yes") { ?><li> <span><?php _e(' Tagged with', BRANKIC_THEME_SHORT); ?></span> <?php the_tags('', ', ', ''); ?></li><?php } ?>
                        </ul>
                    </div><!--END POST-META--> 
<?php
}
?>

<?php
if ($category_page_style == "4")
{
?>
            <div class="post">
            
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
                        if ($category_page_style_fullwidth == "yes") $img_width = 950; else $img_width = 700;
                    ?>
                        <?php if (extra_images_exists()) { include ("slider.inc.php"); } else { ?>         
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ; ?>" width="<?php echo $img_width; ?>" /></a>
                        <?php } ?>
                    <?php } ?> 
                </div><!--END POST-MEDIA-->
            
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
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_authors_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_authors_blog_page")) == "yes") { ?><li><span><?php _e('Posted by', BRANKIC_THEME_SHORT); ?></span> <?php the_author_link(); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_cats_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_cats_blog_page")) == "yes") { ?><li> <span><?php _e('in', BRANKIC_THEME_SHORT); ?></span> <?php the_category(', '); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_tags_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_tags_blog_page")) == "yes") { ?><li> <span><?php _e(' Tagged with', BRANKIC_THEME_SHORT); ?></span> <?php the_tags('', ', ', ''); ?></li><?php } ?>
                        </ul>
                    </div><!--END POST-META-->
<?php
}
?>

<?php
if ($category_page_style == "5")
{
?>
            <div class="post">
            
                <div class="post-title">                
                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div><!--END POST-TITLE-->
                
                <div class="post-meta">                
                    <ul>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_authors_blog_page", of_get_default(BRANKIC_VAR_PREFIX."")) == "yes") { ?><li><span><?php _e('Posted by', BRANKIC_THEME_SHORT); ?></span> <?php the_author_link(); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_cats_blog_page", of_get_default(BRANKIC_VAR_PREFIX."")) == "yes") { ?><li> <span><?php _e('in', BRANKIC_THEME_SHORT); ?></span> <?php the_category(', '); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_tags_blog_page", of_get_default(BRANKIC_VAR_PREFIX."")) == "yes") { ?><li> <span><?php _e(' Tagged with', BRANKIC_THEME_SHORT); ?></span> <?php the_tags('', ', ', ''); ?></li><?php } ?>
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
                        if ($category_page_style_fullwidth != "yes") $img_width = 950; else $img_width = 700;
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
}
?>

<?php
if ($category_page_style == "6")
{
?>
            <div class="post">
        
                <div class="post-title">                
                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div><!--END POST-TITLE-->
                
                <div class="post-meta">                
                    <ul>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_authors_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_authors_blog_page")) == "yes") { ?><li><span><?php _e('Posted by', BRANKIC_THEME_SHORT); ?></span> <?php the_author_link(); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_cats_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_cats_blog_page")) == "yes") { ?><li> <span><?php _e('in', BRANKIC_THEME_SHORT); ?></span> <?php the_category(', '); ?></li><?php } ?>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."show_tags_blog_page", of_get_default(BRANKIC_VAR_PREFIX."show_tags_blog_page")) == "yes") { ?><li> <span><?php _e(' Tagged with', BRANKIC_THEME_SHORT); ?></span> <?php the_tags('', ', ', ''); ?></li><?php } ?>
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
                        if ($category_page_style_fullwidth == "yes") $img_width = 950; else $img_width = 700;
                    ?>
                        <?php if (extra_images_exists()) { include ("slider.inc.php"); } else { ?>         
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ; ?>" width="<?php echo $img_width; ?>" /></a>
                        <?php } ?>
                    <?php } ?> 
                </div><!--END POST-MEDIA-->
            
                <div class="post-info">                        
                    <div class="date"><span class="month"><?php the_time('M'); ?></span><span class="day"><?php the_time('d'); ?></span><span class="month"><?php the_time('Y'); ?></span></div>                    
                    <?php if ($hide_no_of_comments != "yes") { ?>
                    <div class="comments"><?php comments_popup_link( __('<span>0</span> Comments', BRANKIC_THEME_SHORT), __('<span>1</span> Comment', BRANKIC_THEME_SHORT), __('<span>%</span> Comments', BRANKIC_THEME_SHORT)); ?></div>                            
                    <?php } ?>                             
                </div><!--END POST-INFO-->        
                
                <div class="post-content">    
<?php
}
?>




    
<?php
the_excerpt();
?>
<p><a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Continue reading &rarr;', BRANKIC_THEME_SHORT); ?></a></p>
                </div><!--END POST-CONTENT -->
                
            </div><!--END POST-->



<?php endwhile; // End the loop. Whew. ?>

<?php else: //If no posts are present ?>
    
                <div class="entry">                        
                    <p><?php _e('No posts were found.', BRANKIC_THEME_SHORT); ?></p>    
                </div>
                
<?php endif; ?>

<?php
if(function_exists('wp_pagenavi_bra')) { wp_pagenavi_bra(); }  
?>   
        </div><!--END INNER-CONTENT-->  
<?php
if ($category_page_style_fullwidth == "no") get_sidebar();
?> 
			
<?php get_footer(); ?>
			
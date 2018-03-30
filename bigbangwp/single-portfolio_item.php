<?php get_header(); ?>

			
<?php 
$comments = comments_open() && get_option("default_comment_status ") == "open"; 
$blog_single_page_style= of_get_option(BRANKIC_VAR_PREFIX."blog_single_page_style");

if (have_posts()) : while(have_posts()) : the_post(); 
$subtitle = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true);

$sidebar = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."select_sidebar", true); 


?>
    <div class="section-title">
    
        <h1 class="title"><?php the_title(); if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true) != "") { ?> <span><?php echo get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true); ?></span><?php } ?></h1>
                        
    </div><!--END SECTION TITLE-->  
    
    <div class="one-third">
            
        <?php
        the_content();
        //$all_link =  get_portfolio_page_link(get_the_ID());
        if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."parent", true) == "") $all_link =  get_portfolio_page_link(get_the_ID()); 
        else $all_link = get_page_link(get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."parent", true))
        ?>    
        
        <br /><br />                             
        <ul class="item-nav">
            <?php previous_post_link_plus(array('format' => "<li class='prev'> %link </li>", 'link' => '%title', 'in_same_tax' => TRUE )); ?>
            <li class="all"><a href="<?php echo $all_link; ?>" title="All items">All</a></li>
            <?php next_post_link_plus(array('format' => "<li class='next'> %link </li>", 'link' => '%title', 'in_same_tax' => TRUE )); ?>
        </ul><!--END ITEM-NAV-->        
        
    </div><!--END ONE-THIRD-->
<?php
if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."add_class_title", true) != "no")
{
?>
<script type='text/javascript'>
jQuery(document).ready(function($){
    $(".one-third h1, .one-third h2, .one-third h3, .one-third h4, .one-third h5, .one-third h6").addClass("title");
})    
    
</script>
<?php
}
?>     
    <div class="two-third last">
<?php
$additional_html = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."additional_html", true);   
if (extra_images_exists() && !post_password_required()) include ("slider.inc.php");

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
echo $additional_html; 
?> 
<?php 
if (of_get_option(BRANKIC_VAR_PREFIX."show_share") == "yes") 
{
?>
<div class="one">
<?php
    include("share.inc.php") ; 
?>
</div>
<?php
}

?> 
<?php if ($comments) 
{
?>
<div class="one">
<?php  
    comments_template();
?>
</div>
<?php 
}?>               
    </div><!--END TWO-THIRD-->    



          
<?php 




endwhile; ?>


<?php else: //If no posts are present ?>
	
				<div class="entry">						
					<p><?php _e('No posts were found.', BRANKIC_THEME_SHORT); ?></p>	
				</div>
				
<?php endif; ?>



			
<?php get_footer(); ?>
			
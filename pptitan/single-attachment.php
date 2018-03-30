<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header(); 

?>

<br class="clear"/>
</div>

<?php

/**
*	Get current page id
**/

$current_page_id = $post->ID;
$image_id = get_post_thumbnail_id($current_page_id); 
$image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
$pp_page_bg = $image_thumb[0];

wp_enqueue_script("script-static-bg", get_template_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_page_bg, false, THEMEVERSION, true);
?>

<?php
if(empty($bg_style) OR $bg_style == 'Static Image')
{
?>
<div class="page_control_static">
    <a id="page_minimize" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_zoom.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>
<?php
}
else
{
?>
<div class="page_control">
    <a id="page_minimize" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_minus.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>
<?php
}
?>

<div id="page_content_wrapper" class="fade-in two">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width nomargintop transparentbg">

    		<div class="sidebar_content">
					
<?php

global $more; $more = false; # some wordpress wtf logic

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
	$small_image_url = wp_get_attachment_image_src($image_id, 'blog', true);
?>
						
<!-- Begin each blog post -->
<div class="post_wrapper">

	<?php
    	if(isset($small_image_url[0]) && !empty($small_image_url[0]))
    	{
    ?>
    
    <div class="post_img">
    	<a href="<?php echo $image_thumb[0]; ?>" class="img_frame">
    		<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
    	</a>
    </div>
    <br class="clear"/>
    
    <?php
    	}
    ?>

	<div class="post_header">
		<div class="post_detail">
    	<?php echo _e( 'Posted by', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?> on <?php echo get_the_time('d M Y'); ?> /
    		<a href=""><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a>
    	</div>
    	<br class="clear"/>
    	<h5 class="cufon"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
    </div>
    
    <br class="clear"/>
    
    <?php
	    //Get social media sharing option
	    $pp_blog_social_sharing = get_option('pp_blog_social_sharing');
	    
	    if(!empty($pp_blog_social_sharing))
	    {
	?>
	<!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
	<a class="addthis_button_preferred_1"></a>
	<a class="addthis_button_preferred_2"></a>
	<a class="addthis_button_preferred_3"></a>
	<a class="addthis_button_preferred_4"></a>
	<a class="addthis_button_compact"></a>
	<a class="addthis_counter addthis_bubble_style"></a>
	</div>
	<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ppulpipatnan"></script>
	<!-- AddThis Button END -->
	<br class="clear"/>
	<?php
	    }
	?>
    
    <?php
    	the_content();
    ?>
    
</div>
<!-- End each blog post -->

<?php comments_template( '' ); ?>

<?php wp_link_pages(); ?>

<?php endwhile; endif; ?>
						
    	</div>

    		<div class="sidebar_wrapper">
    		
    			<div class="sidebar_top"></div>
    		
    			<div class="sidebar">
    			
    				<div class="content">
    			
    					<ul class="sidebar_widget">
    					<?php dynamic_sidebar('Single Image Page Sidebar'); ?>
    					</ul>
    				
    				</div>
    		
    			</div>
    			<br class="clear"/>
    	
    			<div class="sidebar_bottom"></div>
    		</div>
    	
    		</div>
    
    </div>
    <!-- End main content -->
   
</div> 

<?php get_footer(); ?>
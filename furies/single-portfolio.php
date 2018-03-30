<?php
/**
 * The main template file for display single post portfolio.
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

if(has_post_thumbnail($current_page_id, 'full'))
{
    $image_id = get_post_thumbnail_id($current_page_id); 
    $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
    $pp_page_bg = $image_thumb[0];

    wp_enqueue_script("script-static-bg", get_template_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_page_bg, false, THEMEVERSION, true);
}
?>

<?php
if(has_post_thumbnail($current_page_id, 'full'))
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
?>

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    		<div id="page_caption">
    			<h2 class="cufon"><?php the_title(); ?></h2>
    		</div>

	    	<div class="sidebar_content full_width transparentbg">
		    	<?php
					if (have_posts())
					{ 
						while (have_posts()) : the_post();
		
						the_content();
		    		    
		    		    endwhile; 
		    		}
		    	?>
    		</div>
    
    </div>
    <!-- End main content -->
   
</div> 

<?php get_footer(); ?>
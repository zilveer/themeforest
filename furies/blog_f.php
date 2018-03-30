<?php
/**
 * Template Name: Blog Fullwidth
 * The main template file for display blog page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

get_header(); 
?>

<br class="clear"/>
</div>

<?php
$page_style = 'Right Sidebar';
$add_sidebar = TRUE;
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

//If not select sidebar then select default one
if(empty($page_sidebar))
{
	$page_sidebar = 'Blog Sidebar';
}

//Get Page background style
$bg_style = get_post_meta($current_page_id, 'page_bg_style', true);

if($bg_style == 'Static Image')
{
    if(has_post_thumbnail($current_page_id, 'full'))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        $pp_page_bg = $image_thumb[0];
    }
    else
    {
    	$pp_page_bg = get_template_directory_uri().'/example/bg.jpg';
    }

    wp_enqueue_script("script-static-bg", get_template_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_page_bg, false, THEMEVERSION, true);
} // end if static image
else
{
    $page_bg_gallery_id = get_post_meta($current_page_id, 'page_bg_gallery_id', true);
    wp_enqueue_script("script-supersized-gallery", get_template_directory_uri()."/templates/script-supersized-gallery.php?gallery_id=".$page_bg_gallery_id, false, THEMEVERSION, true);
?>

<div id="thumb-tray" class="load-item">
    <div id="thumb-back"></div>
    <div id="thumb-forward"></div>
    <a id="prevslide" class="load-item"><img src="<?php echo get_template_directory_uri(); ?>/images/arrow_back.png" alt=""/></a>
    <a id="nextslide" class="load-item"><img src="<?php echo get_template_directory_uri(); ?>/images/arrow_forward.png" alt=""/></a>
</div>

<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_template_directory_uri(); ?>/images/"/>

<?php
}
?>

<!-- Begin content -->
<?php
if($bg_style == 'Static Image')
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

<?php
$page_audio = get_post_meta($current_page_id, 'page_audio', true);

if(!empty($page_audio))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$page_audio.'"]'); ?>
</div>
<?php
}
?>

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    		<div id="page_caption">
    			<h1 class="cufon"><?php the_title(); ?></h1>
    			
    			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		

	    		<?php the_content(); ?><br/>
	
	    	<?php endwhile; ?>
    		</div>
    		
    		<div class="sidebar_content full_width transparentbg">

					
<?php

global $more; $more = false; 

$query_string ="post_type=post&paged=$paged";
query_posts($query_string);

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	}
?>

<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper">
	
		<?php
	    	if(!empty($image_thumb))
	    	{
	    		$small_image_url = wp_get_attachment_image_src($image_id, 'blog_f', true);
	    ?>
	    
	    <div class="post_img">
	    	<a href="<?php the_permalink(); ?>">
	    		<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
	    	</a>
	    </div>
	    <br class="clear"/>
	    
	    <?php
	    	}
	    ?>
	
		<div class="post_date">
			<div class="date"><?php the_time('j'); ?></div>
		    <div class="month"><?php the_time('M'); ?></div>
		</div>
	    
	    <div class="post_header">
	    	<div class="post_detail">
	    	<?php echo _e( 'Posted by', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?> on <?php echo get_the_time('d M Y'); ?> /
	    		<a href="<?php the_permalink(); ?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a>
	    	</div>
	    	<br class="clear"/>
	    	<h5 class="cufon"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    </div>
	    <br class="clear"/><hr/><br class="clear"/>
	    
	    <?php
	    	$pp_blog_display_full = get_option('pp_blog_display_full');
	    	
	    	if(!empty($pp_blog_display_full))
	    	{
	    		the_content();
	    	}
	    	else
	    	{
	    		the_excerpt();
	    ?>
	    
	    		<br/><br/>
	    		<a class="button" href="<?php the_permalink(); ?>"><?php echo _e( 'Read more', THEMEDOMAIN ); ?> →</a>
	    
	    <?php
	    	}
	    ?>
	    
	</div>

</div>
<!-- End each blog post -->

<?php endwhile; endif; ?>

    	<?php
			if (function_exists("wpapi_pagination")) 
			{
			    wpapi_pagination($wp_query->max_num_pages);
			}
			else
			{
			?>
			    <div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
			<?php
			}
		?>
    		
    	</div>
    	
    </div>
    <!-- End main content -->

</div>  

<?php get_footer(); ?>
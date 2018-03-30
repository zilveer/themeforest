<?php
/**
 * Template Name: Blog Grid
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

<?php
    //Get Page LayerSlider
    $page_layerslider = get_post_meta($current_page_id, 'page_layerslider', true);
    
    if($page_layerslider > 0)
    {
    	echo '<div class="page_layerslider">'.do_shortcode('[layerslider id="'.$page_layerslider.'"]').'</div>';
    }
?>

<?php
//Get page header display setting
$page_hide_header = get_post_meta($current_page_id, 'page_hide_header', true);

if(empty($page_hide_header))
{
?>
<div id="page_caption">
	<div class="page_title_wrapper">
		<h1><?php the_title(); ?></h1>
		<?php echo dimox_breadcrumbs(); ?>
	</div>
</div>
<br class="clear"/>
<?php
}
else
{
?>
<br class="clear"/>
<?php
}
?>

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		
    		<div id="blog_grid_wrapper" class="sidebar_content full_width">

					
<?php

global $more; $more = false; 

$query_string ="post_type=post&paged=$paged";
query_posts($query_string);
$key = 0;

if (have_posts()) : while (have_posts()) : the_post();
	
	$animate_layer = $key+7;
	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	}
?>

<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper grid_layout">
	
		<?php
	    	if(!empty($image_thumb))
	    	{
	    		$small_image_url = wp_get_attachment_image_src($image_id, 'blog_g', true);
	    ?>
	    
	    <div class="post_img grid">
	    	<a href="<?php the_permalink(); ?>">
	    		<img src="<?php echo $small_image_url[0]; ?>" alt="" class="" style="width:<?php echo $small_image_url[1]; ?>px;height:<?php echo $small_image_url[2]; ?>px;"/>
	    		<div class="mask">
                	<div class="mask_circle">
		            	<i class="fa fa-share"/></i>
					</div>
	            </div>
	    	</a>
	    </div>
	    
	    <?php
	    	}
	    ?>
	    
	    <div style="width:100%;margin:auto;">
		    <div class="post_header grid">
		    	<h6><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
		    </div>
		    <div style="height:10px"></div>
		    
		    <?php
		    	echo pp_substr(get_the_excerpt(), 90);
		    ?>
		    
		    <br/><br/>
	    	<hr/>
		    <div class="post_detail">
			    <a href="<?php comments_link(); ?>"><?php comments_number(__('0 Comment', THEMEDOMAIN), __('1 Comment', THEMEDOMAIN), __('% Comments', THEMEDOMAIN)); ?></a> / <?php echo get_the_time(THEMEDATEFORMAT); ?>
			</div>
			<a class="read_more" href="<?php the_permalink(); ?>"><?php echo _e( 'Read More', THEMEDOMAIN ); ?></a>
			<br class="clear"/><hr/>
	    </div>
	    
	</div>

</div>
<!-- End each blog post -->

<?php $key++; ?>
<?php endwhile; endif; ?>
    		
    	</div>
    	
    </div>
    <!-- End main content -->
    <?php
	    if($wp_query->max_num_pages > 1)
	    {
	    	if (function_exists("wpapi_pagination")) 
	    	{
	?>
			<br class="clear"/><br/><br/>
	<?php
	    	    wpapi_pagination($wp_query->max_num_pages);
	    	}
	    	else
	    	{
	    	?>
	    	    <div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
	    	<?php
	    	}
	    ?>
	    <div class="pagination_detail">
	     	<?php
	     		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	     	?>
	     	<?php _e( 'Page', THEMEDOMAIN ); ?> <?php echo $paged; ?> <?php _e( 'of', THEMEDOMAIN ); ?> <?php echo $wp_query->max_num_pages; ?>
	     </div>
	     <?php
	     }
	?>

</div>  
<br class="clear"/><br/><br/>
<?php get_footer(); ?>
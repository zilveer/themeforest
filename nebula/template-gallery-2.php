<?php
/**
 * The main template file for display gallery 2 columns
 *
 * @package WordPress
 */

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Check if gallery template
global $page_gallery_id;
if(!empty($page_gallery_id))
{
	$current_page_id = $page_gallery_id;
}

//Check if password protected
$gallery_password = get_post_meta($current_page_id, 'gallery_password', true);
if(!empty($gallery_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		get_template_part("/templates/template-password");
		exit;
	}
}

//Get gallery images
$all_photo_arr = get_post_meta($current_page_id, 'wpsimplegallery_gallery', true);

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);

get_header(); 
?>

<input type="hidden" id="pp_portfolio_columns" name="pp_portfolio_columns" value="2"/>
<div id="page_caption">
	<div class="page_title_wrapper">
		<h1><?php the_title(); ?></h1>
		<?php echo dimox_breadcrumbs(); ?>
	</div>
</div>
<br class="clear"/>

<!-- Begin content -->
<div id="page_content_wrapper">
    
    <div class="inner">

    	<div class="inner_wrapper">
	    
	    <?php
			//Get Page LayerSlider
			$page_layerslider = get_post_meta($current_page_id, 'page_layerslider', true);
			
			if($page_layerslider > 0)
			{
				echo '<div class="page_layerslider">'.do_shortcode('[layerslider id="'.$page_layerslider.'"]').'</div>';
			}
		?>
    	
    	<?php 
    		//Get gallery content
    		$gallery_post_content = get_post_field('post_content', $current_page_id);
    		
    		if(!empty($gallery_post_content))
    		{
	    		echo $gallery_post_content;
    		}
    	?>
    	
    	<div id="page_main_content" class="sidebar_content full_width gallery">
    	
    	<div id="portfolio_filter_wrapper" class="gallery two_cols portfolio-content section content clearfix">
    	<?php
    		$key = 0;
    		foreach($all_photo_arr as $photo_id)
    		{
    			$small_image_url = '';
    			$hyperlink_url = get_permalink($photo_id);
    			
    			if(!empty($photo_id))
    			{
    				$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
    			    $small_image_url = wp_get_attachment_image_src($photo_id, 'gallery_2', true);
    			}
    			
    			$last_class = '';
    			if(($key+1)%4==0)
    			{
    				$last_class = 'last';
    			}
    			
    			$current_image_arr = wp_get_attachment_image_src($photo_id, 'gallery_2');
    			
    			//Get image meta data
    			$image_title = get_the_title($photo_id);
    			$image_caption = get_post_field('post_excerpt', $photo_id);
    			$image_desc = get_post_field('post_content', $photo_id);
    	?>
    	
    	<div class="element">
	    	
		    <div class="one_half gallery2 filterable gallery_type animated<?php echo $key+1; ?>" data-id="post-<?php echo $key+1; ?>">
		    	
    		<?php 
    			if(!empty($small_image_url))
    			{
    				$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
    				$pp_social_sharing = get_option('pp_social_sharing');
    		?>		
    				<a <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?>data-title="<strong><?php echo $image_title; ?></strong> <?php if(!empty($image_desc)) { ?><?php echo htmlentities($image_desc); ?><?php } ?><?php if(!empty($pp_social_sharing)) { ?><br/><br/><br/><br/><a class='button' href='<?php echo get_permalink($photo_id); ?>'><?php _e( 'Comment & share', THEMEDOMAIN ); ?></a><?php } ?>"<?php } ?> class="fancy-gallery" data-fancybox-group="fancybox-thumb" href="<?php echo $image_url[0]; ?>">
	    				<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>

	    				<div class="thumb_content">
			                <h3><?php echo $image_title; ?></h3>
			                <span><?php echo $image_caption; ?></span>
			            </div>
    				</a>
    		<?php
    			}		
    		?>	
    		
		    </div>		
    		
    	</div>
    	
    	<?php
    			$key++;
    		}
    	?>
    	</div>

		<div class="post_excerpt_full">
		<?php
		    //Get Social Share
		    get_template_part("/templates/template-share");
		?>
		</div>
    	
    	</div>
    </div>
    
</div>

<?php
$gallery_audio = get_post_meta($current_page_id, 'gallery_audio', true);

if(!empty($gallery_audio))
{
?>
<div class="gallery_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$gallery_audio.'"]'); ?>
</div>
<?php
}
?>
<br class="clear"/>
<?php get_footer(); ?>
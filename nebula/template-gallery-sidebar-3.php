<?php
/**
 * The main template file for display gallery page.
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

//Get page sidebar
$page_sidebar = get_post_meta($current_page_id, 'gallery_sidebar', true);

//If not select sidebar then select default one
if(empty($page_sidebar))
{
	$page_sidebar = 'Page Sidebar';
}

get_header();
?>
<input type="hidden" id="pp_wall_columns" name="pp_wall_columns" value="3"/>
<div id="page_caption">
	<div class="page_title_wrapper">
		<h1><?php the_title(); ?></h1>
		<?php echo dimox_breadcrumbs(); ?>
	</div>
</div>
<br class="clear"/>

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		
    		<div class="sidebar_content nomargintop">
    		
<!-- Begin content -->
<div id="photo_wall_wrapper" class="has_sidebar">
<?php
    $key = 0;
    foreach($all_photo_arr as $photo_id)
	{
	    $small_image_url = '';
	    $hyperlink_url = get_permalink($photo_id);
	    
	    if(!empty($photo_id))
	    {
	    	$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
	        $small_image_url = wp_get_attachment_image_src($photo_id, 'gallery_m_fh', true);
	    }
	    
	    $last_class = '';
	    if(($key+1)%4==0)
	    {
	    	$last_class = 'last';
	    }
	    
	    $current_image_arr = wp_get_attachment_image_src($photo_id, 'gallery_m_fh');
	    
	    //Get image meta data
	    $image_title = get_the_title($photo_id);
	    $image_caption = get_post_field('post_excerpt', $photo_id);
	    $image_desc = get_post_field('post_content', $photo_id);
?>

<div class="wall_entry three_cols">
    <?php 
    	if(!empty($small_image_url[0]))
    	{
    		$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
    		$pp_social_sharing = get_option('pp_social_sharing');
    ?>		
    	<div class="wall_thumbnail dynamic_height gallery_type animated<?php echo $key+1; ?>">
    		<a <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?>data-title="<strong><?php echo $image_title; ?></strong> <?php if(!empty($image_desc)) { ?><?php echo htmlentities($image_desc); ?><?php } ?><?php if(!empty($pp_social_sharing)) { ?><br/><br/><br/><br/><a class='button' href='<?php echo get_permalink($photo_id); ?>'><?php _e( 'Comment & share', THEMEDOMAIN ); ?></a><?php } ?>"<?php } ?> class="fancy-gallery" data-fancybox-group="fancybox-thumb" href="<?php echo $image_url[0]; ?>">
    			<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
    			<div class="thumb_content">
	                <h4><?php echo $image_title; ?></h4>
	            </div>
    		</a>
    	</div>
    <?php
    	}		
    ?>

</div>

<?php
		$key++;
    }
?>
</div>

<?php
    //Get Social Share
    get_template_part("/templates/template-share");
?>

</div>
    	
    		<div class="sidebar_wrapper">
    		
    			<div class="sidebar_top"></div>
    		
    			<div class="sidebar">
    			
    				<div class="content">
    			
    					<ul class="sidebar_widget">
    					<?php dynamic_sidebar($page_sidebar); ?>
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
<?php
	get_footer();
?>
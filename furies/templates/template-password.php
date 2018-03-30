<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/

if(session_id() == '') {
	session_start();
}

/**
*	Get current page id
**/
$current_page_id = '';

/**
*	Get Current page object
**/
$page = get_page($post->ID);

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

$notice_text = '';
if(isset($_POST['gallery_password']))
{
	//check gallery password
	$portfolio_password = get_post_meta($current_page_id, 'portfolio_password', true);
	
	if($_POST['gallery_password'] != $portfolio_password)
	{
		$notice_text = 'ERROR: Invalid password';
	}
	else
	{	
		if(session_id() == '') {
			session_start();
		}
		$_SESSION['gallery_page_'.$current_page_id] = $current_page_id;
		
		$permalink = get_permalink($current_page_id);
		header("Location: ".$permalink);
		exit;
	}
}

get_header(); 
?>

<br class="clear"/>
</div>

<?php

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
?>

<!-- Begin content -->
<div id="page_content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    		<div id="page_caption">
    			<h1 class="cufon"><?php _e( 'Private Gallery', THEMEDOMAIN ); ?></h1>
    		</div>
    		
    		<p><?php _e( 'This gallery is password protected. Please enter password. To view it please enter your password below', THEMEDOMAIN ); ?></p><br/>

    		<div id="page_main_content" class="sidebar_content full_width transparentbg">
    			
    			<?php 
    				if(!empty($notice_text))
    				{
    			?>
    					<span class="error"><?php echo $notice_text; ?></span>
    			<?php
    				}
    			?>
    			<form id="gallery_password_form" method="post" action="<?php echo curPageURL(); ?>">
    				<input id="gallery_password" name="gallery_password" type="password" style="width:30%"/><br/><br/>
    				<input type="submit" value="Login"/>
    			</form>

    		</div>
    		
    	</div>
    	
    </div>

    <?php get_footer(); ?>
</div>
<!-- End content -->
    	
</div>
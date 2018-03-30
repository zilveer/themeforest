<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/

/**
*	Get current page id
**/
$current_page_id = '';

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
	{	session_start();
		$_SESSION['gallery_page_'.$current_page_id] = $current_page_id;
		
		$permalink = get_permalink($current_page_id);
		header("Location: ".$permalink);
		exit;
	}
}

get_header(); 
?>

<div class="page_control">
    <a id="page_minimize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_minus.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>

<!-- Begin content -->
<div id="page_content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    		<div id="page_caption" class="sidebar_content full_width" style="padding-left:10px">
    			<h1 class="cufon"><?php _e( 'Private Gallery', THEMEDOMAIN ); ?></h1>
    		</div>

    		<div class="sidebar_content full_width">
    			
    			<p><?php _e( 'This gallery is password protected. Please enter password', THEMEDOMAIN ); ?>:</p><br/><br/>
    			<?php 
    				if(!empty($notice_text))
    				{
    			?>
    					<span class="error"><?php echo $notice_text; ?></span>
    			<?php
    				}
    			?>
    			<form id="gallery_password_form" method="post" action="<?php echo curPageURL(); ?>">
    				<input id="gallery_password" name="gallery_password" type="password" style="width:20%"/>
    				<input type="submit" value="Login"/>
    			</form>

    		</div>
    		
    	</div>
    	
    </div>
    <br class="clear"/>
    <?php get_footer(); ?>
</div>
<!-- End content -->
    	
</div>
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
	$gallery_password = get_post_meta($current_page_id, 'gallery_password', true);
	
	if($_POST['gallery_password'] != $gallery_password)
	{
		$notice_text = __( 'ERROR Invalid password', THEMEDOMAIN );
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

<input type="hidden" id="pp_portfolio_columns" name="pp_portfolio_columns" value="4"/>
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
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper" style="text-align:center">
    	
    		<h4 class="cufon"><?php _e( 'Private Gallery', THEMEDOMAIN ); ?></h4>
    		<div class="page_caption_desc"><?php _e( 'This gallery is password protected. Please enter password. To view it please enter your password below', THEMEDOMAIN ); ?></div>
    		
    		<br/>

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
    				<input id="gallery_password" name="gallery_password" type="password" style="width:50%"/>
    				<input type="submit" value="Login"/>
    			</form>
    			
    			<br/><br/><br/><br/>

    		</div>
    		
    	</div>
    	
    </div>

    <?php get_footer(); ?>
</div>
<!-- End content -->
    	
</div>
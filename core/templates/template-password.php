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
	$gallery_post = get_post();
	$page_gallery_password = get_post_meta($current_page_id, 'page_gallery_password', true);
	
	if($_POST['gallery_password'] != $page_gallery_password)
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
	<div class="page_caption">
		<h1 class="cufon"><?php echo $post->post_title; ?></h1>
	</div>

	<div id="content_wrapper">

		<!-- Begin content -->
		<div id="page_content_wrapper">
		
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">

					<div class="sidebar_content full_width">
			
						<h1 class="cufon"><?php _e( 'Password Protected Gallery', THEMEDOMAIN ); ?></h1><br/>
						
						<p><?php _e( 'This gallery is password protected. Please enter password:', THEMEDOMAIN ); ?></p><br/><br/>
						<?php 
							if(!empty($notice_text))
							{
						?>
								<span class="error"><?php echo $notice_text; ?></span>
						<?php
							}
						?>
						<form id="gallery_password_form" method="post" action="<?php echo curPageURL(); ?>">
							<input id="gallery_password" name="gallery_password" type="password" style="width:30%"/><br/>
							<input type="submit" value="<?php _e( 'Login', THEMEDOMAIN ); ?>" style="margin-top:10px"/>
						</form>

					</div>
					
				</div>
				
			</div>
			<br class="clear"/><br/>
		</div>
		<!-- End content -->
		
	</div>		

<?php get_footer(); ?>
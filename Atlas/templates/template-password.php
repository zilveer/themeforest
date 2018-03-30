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
		<?php
			if(has_post_thumbnail($current_page_id, 'full'))
			{
			    $image_id = get_post_thumbnail_id($current_page_id); 
			    $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
			    $pp_page_bg = $image_thumb[0];
			}
			else
			{
				$pp_page_bg = get_stylesheet_directory_uri().'/example/bg.jpg';
			}
		?>
		<script type="text/javascript"> 
			jQuery.backstretch( "<?php echo $pp_page_bg; ?>", {speed: 'slow'} );
		</script>

		<!-- Begin content -->
		<div id="page_content_wrapper">
		
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">

					<div class="sidebar_content full_width">
			
						<h1 class="cufon">Password Protected Gallery</h1><br/><hr/>
						
						<p>This gallery is password protected. Please enter password:</p><br/><br/>
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
		</div>
		<!-- End content -->
				

<?php get_footer(); ?>
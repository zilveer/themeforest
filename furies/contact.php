<?php
/**
 * Template Name: Contact
 * The main template file for display contact page.
 *
 * @package WordPress
*/


/**
*	if not submit form
**/
if(!isset($_POST['your_name']))
{

/**
*	Get Current page object
**/
$current_page = get_page($post->ID);
$current_page_id = '';

if(isset($current_page->ID))
{
    $current_page_id = $current_page->ID;
}

//Get Page Sidebar
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);
if(empty($page_sidebar))
{
	$page_sidebar = 'Contact Sidebar';
}

get_header(); 
?>

<br class="clear"/>
</div>

<?php
    $pp_contact_display_map = get_option('pp_contact_display_map');
    
    if(!empty($pp_contact_display_map))
    {	
    	wp_enqueue_script("script-contact-map", get_template_directory_uri()."/templates/script-contact-map.php?id=map_contact", false, THEMEVERSION, true);
?>
<div id="map_contact"></div>
<?php
	}
	else
	{ // if not display map then check if display slideshow or static image
?>

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
} //end if not display map
?>

<!-- Begin content -->
<?php
if(empty($pp_contact_display_map) && isset($bg_style) && $bg_style == 'Static Image')
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
elseif(empty($pp_contact_display_map))
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
else
{
?>
<div class="page_control">
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
    
    <div id="page_caption">
    	<h1 class="cufon"><?php the_title(); ?></h1>
    	
    	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		

    		<?php the_content(); ?><br/>

    	<?php endwhile; ?>
    </div>
    
    <div class="sidebar_content full_width transparentbg">
	    <div class="sidebar_content">
	    	
	    	<!-- Begin main content -->
    			
    			<?php
    				$pp_contact_form = unserialize(get_option('pp_contact_form_sort_data'));
    				wp_register_script("script-contact-form", get_stylesheet_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
					$params = array(
					  'ajaxurl' => get_permalink($current_page->ID),
					  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
					);
					wp_localize_script( 'script-contact-form', 'tgAjax', $params );
					wp_enqueue_script("script-contact-form", get_stylesheet_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
    			?>
    			<div id="reponse_msg"><ul></ul></div>
    			
    			<form id="contact_form" method="post" action="<?php echo get_permalink($current_page->ID); ?>">

    				<?php 
			    		if(is_array($pp_contact_form) && !empty($pp_contact_form))
			    		{
			    			foreach($pp_contact_form as $form_input)
			    			{
			    				switch($form_input)
			    				{
			    					case 1:
			    	?>
			    					<label for="your_name"><?php echo _e( 'Name', THEMEDOMAIN ); ?></label>
			        				<input id="your_name" name="your_name" type="text" class="required_field" title="<?php echo _e( 'Name', THEMEDOMAIN ); ?>*" style="width:47%"/>
			        				<br/><br/>			
			    	<?php
			    					break;
			    					
			    					case 2:
			    	?>
			    					
			    					<label for="email"><?php echo _e( 'Email', THEMEDOMAIN ); ?></label>
			        				<input id="email" name="email" type="text" class="required_field email" title="<?php echo _e( 'Email', THEMEDOMAIN ); ?>*" style="width:47%"/>
			        				<br/><br/>				
			    	<?php
			    					break;
			    					
			    					case 3:
			    	?>
			    					
			    					<label for="message"><?php echo _e( 'Message', THEMEDOMAIN ); ?></label>
			        				<textarea id="message" name="message" rows="7" cols="10" class="required_field" title="<?php echo _e( 'Message', THEMEDOMAIN ); ?>*" style="width:93%"></textarea>
			        				<br/><br/>				
			    	<?php
			    					break;
			    					
			    					case 4:
			    	?>
			    					
			    					<label for="address"><?php echo _e( 'Address', THEMEDOMAIN ); ?></label>
			        				<input id="address" name="address" type="text" title="<?php echo _e( 'Address', THEMEDOMAIN ); ?>" style="width:47%"/>
			        				<br/><br/>			
			    	<?php
			    					break;
			    					
			    					case 5:
			    	?>
			    					
			    					<label for="phone"><?php echo _e( 'Phone', THEMEDOMAIN ); ?></label>
			        				<input id="phone" name="phone" type="text" title="<?php echo _e( 'Phone', THEMEDOMAIN ); ?>" style="width:47%"/>
			        				<br/><br/>			
			    	<?php
			    					break;
			    					
			    					case 6:
			    	?>
			    					
			    					<label for="mobile"><?php echo _e( 'Mobile', THEMEDOMAIN ); ?></label>
			        				<input id="mobile" name="mobile" type="text" title="<?php echo _e( 'Mobile', THEMEDOMAIN ); ?>" style="width:47%"/>
			        				<br/><br/>				
			    	<?php
			    					break;
			    					
			    					case 7:
			    	?>
			    					
			    					<label for="company"><?php echo _e( 'Company Name', THEMEDOMAIN ); ?></label>
			        				<input id="company" name="company" type="text" title="<?php echo _e( 'Company Name', THEMEDOMAIN ); ?>" style="width:47%"/>
			        				<br/><br/>				
			    	<?php
			    					break;
			    					
			    					case 8:
			    	?>
			    					
			    					<label for="country"><?php echo _e( 'Country', THEMEDOMAIN ); ?></label>				
			        				<input id="country" name="country" type="text" title="<?php echo _e( 'Country', THEMEDOMAIN ); ?>" style="width:47%"/>
			        				<br/><br/>				
			    	<?php
			    					break;
			    				}
			    			}
			    		}
			    	?>
			    	
			    	<?php
			    		$pp_contact_enable_captcha = get_option('pp_contact_enable_captcha');
			    		
			    		if(!empty($pp_contact_enable_captcha))
			    		{
			    	?>
			    		
			    		<br class="clear"/>
			    		<div id="captcha-wrap">
							<div class="captcha-box">
								<img src="<?php echo get_template_directory_uri(); ?>/get_captcha.php" alt="" id="captcha" />
							</div>
							<div class="text-box">
								<label>Type the two words:</label>
								<input name="captcha-code" type="text" id="captcha-code">
							</div>
							<div class="captcha-action">
								<img src="<?php echo get_template_directory_uri(); ?>/images/refresh.jpg"  alt="" id="captcha-refresh" />
							</div>
						</div>
					
					<?php
					}
					?>
			    			    
			    	<p>
    					<input id="contact_submit_btn" type="submit" value="Send Message"/>
    					<?php
    					if(!empty($pp_contact_display_map))
    					{
    					?>
    					<input id="pp_contact_view_mape" type="button" class="primary" value="View Map"/>
    					<?php
    					}
    					?>
    				</p>
    			</form>
    	<!-- End main content -->
    	</div>
    	
    	<div class="sidebar_wrapper">
    	    <div class="sidebar">
    	    	
    	    	<div class="content">
    	    	
    	    		<ul class="sidebar_widget">
    	    			<?php dynamic_sidebar($page_sidebar); ?>
    	    		</ul>
    	    		
    	    	</div>
    	    
    	    </div>
    	    <br class="clear"/>
    
    	    </div>
    	</div>
    </div>

<?php get_footer(); ?>		
				
<?php
}

//if submit form
else
{
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );

	/*
	|--------------------------------------------------------------------------
	| Mailer module
	|--------------------------------------------------------------------------
	|
	| These module are used when sending email from contact form
	|
	*/
	
	//Get your email address
	$contact_email = get_option('pp_contact_email');
	
	//Enter your email address, email from contact form will send to this addresss. Please enter inside quotes ('myemail@email.com')
	$contact_email = get_option('pp_contact_email');
	
	$contact_subject = __( 'Email from contact form', THEMEDOMAIN );
	
	$pp_contact_thankyou = __( 'Thank you! We will get back to you as soon as possible', THEMEDOMAIN );
	
	//Error message when message can't send
	define('ERROR_MESSAGE', __( 'Oops! something went wrong, please try to submit later.', THEMEDOMAIN ));
	
	
	/*
	|
	| Begin sending mail
	|
	*/
	
	$from_name = $_POST['your_name'];
	$from_email = $_POST['email'];
	
	$headers = "";
   	$headers.= 'From: '.$from_name.'<'.$from_email.'>'.PHP_EOL;
   	$headers.= 'Reply-To: '.$from_name.'<'.$from_email.'>'.PHP_EOL;
   	$headers.= 'Return-Path: '.$from_name.'<'.$from_email.'>'.PHP_EOL;        // these two to set reply address
   	$headers.= "Message-ID: <".time()."webmaster@".$_SERVER['SERVER_NAME'].">".PHP_EOL;
   	$headers.= "X-Mailer: PHP v".phpversion().PHP_EOL;                  // These two to help avoid spam-filters
	
	$message = 'Name: '.$from_name.PHP_EOL;
	$message.= 'Email: '.$from_email.PHP_EOL.PHP_EOL;
	$message.= 'Message: '.PHP_EOL.$_POST['message'];
	
	if(isset($_POST['address']))
	{
		$message.= 'Address: '.$_POST['address'].PHP_EOL;
	}
	
	if(isset($_POST['phone']))
	{
		$message.= 'Phone: '.$_POST['phone'].PHP_EOL;
	}
	
	if(isset($_POST['mobile']))
	{
		$message.= 'Mobile: '.$_POST['mobile'].PHP_EOL;
	}
	
	if(isset($_POST['company']))
	{
		$message.= 'Company: '.$_POST['company'].PHP_EOL;
	}
	
	if(isset($_POST['country']))
	{
		$message.= 'Country: '.$_POST['country'].PHP_EOL;
	}
	    
	
	if(!empty($from_name) && !empty($from_email) && !empty($message))
	{
		wp_mail($contact_email, $contact_subject, $message, $headers);
		echo $pp_contact_thankyou;
		
		exit;
	}
	else
	{
		echo ERROR_MESSAGE;
		
		exit;
	}
	
	/*
	|
	| End sending mail
	|
	*/
}

?>
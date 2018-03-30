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

get_header(); 

?>
		<div class="page_caption">
			<h1 class="cufon"><?php echo $post->post_title; ?></h1>
		</div>
		
		<div id="content_wrapper">

		<!-- Begin content -->
		<div id="page_content_wrapper">
		
			<div class="inner">
			
			<div class="sidebar_content">
				
				<!-- Begin main content -->
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		

						<?php do_shortcode(the_content()); ?>

						<?php endwhile; ?>
						
						<?php
							$pp_contact_form = unserialize(get_option('pp_contact_form_sort_data'));
						?>
						<form id="contact_form" method="post" action="<?php echo $current_page->guid; ?>">
							<?php 
								if(is_array($pp_contact_form) && !empty($pp_contact_form))
								{
									foreach($pp_contact_form as $form_input)
									{
										switch($form_input)
										{
											case 1:
							?>
											 <p style="margin-top:0px">
						    					<input id="your_name" name="your_name" type="text" style="width:97%" title="<?php _e( 'Name', THEMEDOMAIN ); ?>*"/>
						    				</p>				
							<?php
											break;
											
											case 2:
							?>
											 <p style="margin-top:0px">
						    					<input id="email" name="email" type="text" style="width:97%" title="<?php _e( 'Email', THEMEDOMAIN ); ?>*"/>
						    				</p>				
							<?php
											break;
											
											case 3:
							?>
											 <p style="margin-top:0px">
						    					<textarea id="message" name="message" rows="7" cols="10" style="width:97%" title="<?php _e( 'Message', THEMEDOMAIN ); ?>*"></textarea>
						    				</p>				
							<?php
											break;
											
											case 4:
							?>
											 <p style="margin-top:0px">
						    					<input id="address" name="address" type="text" style="width:97%" title="<?php _e( 'Address', THEMEDOMAIN ); ?>"/>
						    				</p>				
							<?php
											break;
											
											case 5:
							?>
											 <p style="margin-top:0px">
						    					<input id="phone" name="phone" type="text" style="width:97%" title="<?php _e( 'Phone', THEMEDOMAIN ); ?>"/>
						    				</p>				
							<?php
											break;
											
											case 6:
							?>
											 <p style="margin-top:0px">
						    					<input id="mobile" name="mobile" type="text" style="width:97%" title="<?php _e( 'Mobile', THEMEDOMAIN ); ?>"/>
						    				</p>				
							<?php
											break;
											
											case 7:
							?>
											 <p style="margin-top:0px">
						    					<input id="company" name="company" type="text" style="width:97%" title="<?php _e( 'Company Name', THEMEDOMAIN ); ?>"/>
						    				</p>				
							<?php
											break;
											
											case 8:
							?>
											 <p style="margin-top:0px">
						    					<input id="country" name="country" type="text" style="width:97%" title="<?php _e( 'Country', THEMEDOMAIN ); ?>"/>
						    				</p>				
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
								<br class="clear"/>
							
							<?php
							}
							?>
							
						    <p style="margin-top:0px">
								<input type="submit" value="<?php _e( 'Send Message', THEMEDOMAIN ); ?>"/>
							</p>
						</form>
						<div id="reponse_msg"></div>
						<br/>
				<!-- End main content -->
				</div>
				
				<div class="sidebar_wrapper">
						<div class="sidebar">
							
							<div class="content">
							
								<ul class="sidebar_widget">
									<?php dynamic_sidebar('Contact Sidebar'); ?>
								</ul>
								
							</div>
						
						</div>
						<br class="clear"/>
			
			</div>
			</div>
			
			<br class="clear"/>
		</div>
		<!-- End content -->
				
		</div>	
		
<?php get_footer(); ?>
				
<?php
if(!isset($hide_header) OR !$hide_header)
{
?>	
			</div>
			<!-- End main content -->

			</div>
		</div>
		<!-- End content -->
				

<?php get_footer(); ?>

<?php
}
elseif(!$pp_homepage_hide_right_sidebar)
{
?>

</div>
			<!-- End main content -->
				
			<br class="clear"/>
				
			</div>
			
		</div>
		<!-- End content -->

<?php
}
?>
				
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
	$pp_contact_thankyou = get_option('pp_contact_thankyou');
	
	//Enter your email address, email from contact form will send to this addresss. Please enter inside quotes ('myemail@email.com')
	define('DEST_EMAIL', $contact_email);
	
	//Change email subject to something more meaningful
	define('SUBJECT_EMAIL', 'Email from contact form');
	
	//Thankyou message when message sent
	define('THANKYOU_MESSAGE', $pp_contact_thankyou);
	
	//Error message when message can't send
	define('ERROR_MESSAGE', 'Oops! something went wrong, please try to submit later.');
	
	
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
	$message.= 'Message: '.PHP_EOL.$_POST['message'].PHP_EOL.PHP_EOL;
	
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
		wp_mail(DEST_EMAIL, SUBJECT_EMAIL, $message, $headers);
	
		echo THANKYOU_MESSAGE;
		
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
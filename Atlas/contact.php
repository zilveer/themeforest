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
			
			<div class="sidebar_content full_width" style="padding-bottom:0">
				<h1 class="cufon"><?php the_title(); ?></h1><br/><hr/>
			</div>
			
			<div class="sidebar_content" style="width:43%;margin-top:-10px">
			
				<!-- Begin main content -->
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		

							<?php the_content(); ?>

						<?php endwhile; ?>
						
						<?php
							$pp_contact_form = unserialize(get_option('pp_contact_form_sort_data'));
						?>
						<form id="contact_form" method="post" action="<?php echo curPageURL(); ?>">
							<?php 
								if(is_array($pp_contact_form) && !empty($pp_contact_form))
								{
									foreach($pp_contact_form as $form_input)
									{
										switch($form_input)
										{
											case 1:
							?>
											 <p style="margin-top:20px">
						    					<input id="your_name" name="your_name" type="text" style="width:94%" title="Full Name"/>
						    				</p>				
							<?php
											break;
											
											case 2:
							?>
											 <p style="margin-top:20px">
						    					<input id="email" name="email" type="text" style="width:94%" title="Email*"/>
						    				</p>				
							<?php
											break;
											
											case 3:
							?>
											 <p style="margin-top:20px">
						    					<textarea id="message" name="message" rows="7" cols="10" style="width:94%" title="Message*"></textarea>
						    				</p>				
							<?php
											break;
											
											case 4:
							?>
											 <p style="margin-top:20px">
						    					<input id="address" name="address" type="text" style="width:94%" title="Location"/>
						    				</p>				
							<?php
											break;
											
											case 5:
							?>
											 <p style="margin-top:20px">
						    					<input id="phone" name="phone" type="text" style="width:94%" title="Phone Number"/>
						    				</p>				
							<?php
											break;
											
											case 6:
							?>
											 <p style="margin-top:20px">
						    					<input id="mobile" name="mobile" type="text" style="width:94%" title="How Did You Hear About Us?"/>
						    				</p>				
							<?php
											break;
											
											case 7:
							?>
											 <p style="margin-top:20px">
						    					<input id="company" name="company" type="text" style="width:94%" title="Number of Guests?"/>
						    				</p>				
							<?php
											break;
											
											case 8:
							?>
											 <p style="margin-top:20px">
						    					<input id="country" name="country" type="text" style="width:94%" title="Event Date"/>
						    				</p>				
							<?php
											break;
										}
									}
								}
							?>
						    <p style="margin-top:20px"><br/>
								<input type="submit" value="Send Message"/>
							</p>
						</form>
						<div id="reponse_msg"></div>
				<!-- End main content -->
				</div>
				
				<div class="sidebar_wrapper" style="width:40%;margin-top:-35px">
						<div class="sidebar" style="width:100%">
							
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
				
		<br class="clear"/><br/>
<?php get_footer(); ?>
				
				
<?php
}

//if submit form
else
{

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
	
	//Enter your email address, email from contact form will send to this addresss. Please enter inside quotes ('asuncion.93@gmail.com')
	define('DEST_EMAIL', $contact_email);
	
	//Change email subject to something more meaningful
	define('SUBJECT_EMAIL', 'Email from Danny Chung Website');
	
	//Thankyou message when message sent
	define('THANKYOU_MESSAGE', 'Thank you! We will get back to you as soon as possible');
	
	//Error message when message can't send
	define('ERROR_MESSAGE', 'Oops! Something went wrong, please try to submit later.');
	
	
	/*
	|
	| Begin sending mail
	|
	*/
	
	$from_name = $_POST['your_name'];
	$from_email = $_POST['email'];
	
	$mime_boundary_1 = md5(time());
    $mime_boundary_2 = "1_".$mime_boundary_1;
    $mail_sent = false;
 
    # Common Headers
    $headers = "";
    $headers .= 'From: '.$from_name.'<'.$from_email.'>'.PHP_EOL;
    $headers .= 'Reply-To: '.$from_name.'<'.$from_email.'>'.PHP_EOL;
    $headers .= 'Return-Path: '.$from_name.'<'.$from_email.'>'.PHP_EOL;        // these two to set reply address
    $headers .= "Message-ID: <".$now."webmaster@".$_SERVER['SERVER_NAME'].">";
    $headers .= "X-Mailer: PHP v".phpversion().PHP_EOL;                  // These two to help avoid spam-filters
	
	$message = 'Name: '.$from_name.PHP_EOL;
	$message.= 'Email: '.$from_email.PHP_EOL.PHP_EOL;
	$message.= 'Message: '.PHP_EOL.$_POST['message'].PHP_EOL.PHP_EOL;
	
	if(isset($_POST['address']))
	{
		$message.= 'Address: '.$_POST['address'].PHP_EOL.PHP_EOL;
	}
	
	if(isset($_POST['phone']))
	{
		$message.= 'Phone: '.$_POST['phone'].PHP_EOL.PHP_EOL;
	}
	
	if(isset($_POST['mobile']))
	{
		$message.= 'Mobile: '.$_POST['mobile'].PHP_EOL.PHP_EOL;
	}
	
	if(isset($_POST['company']))
	{
		$message.= 'Company: '.$_POST['company'].PHP_EOL.PHP_EOL;
	}
	
	if(isset($_POST['country']))
	{
		$message.= 'Country: '.$_POST['country'].PHP_EOL;
	}
	    
	
	if(!empty($from_name) && !empty($from_email) && !empty($message))
	{
		mail(DEST_EMAIL, SUBJECT_EMAIL, $message, $headers);
	
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
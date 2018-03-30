<?php
/*
Template Name: Contact Form
*/
?>
<?php 
//Email to send the form to - get it from theme options
$emailTo = of_get_option ( 'email' );
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure message were entered	
		if(trim($_POST['message']) === '') {
			$commentError = 'You forgot to enter your message.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$message = stripslashes(trim($_POST['message']));
			} else {
				$message = trim($_POST['message']);
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {

			$subject = 'Contact Form Submission from '.$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\nEmail: $email \n\nComments: $message";
			$headers = 'From: sitemail <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			wp_mail($emailTo, $subject, $body, $headers);

			$emailSent = true;

		}
	}
} ?>
<?php wp_enqueue_script( 'contactform', MTHEME_JS . '/contact-form.js', array( 'jquery' ), '' ); ?>
<?php get_header(); ?>

<div class="fullpage-contents-wrap">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		
		<div class="entry-content-wrapper">
		
			<!-- That's the title -->
			<?php if ( is_front_page() ) { ?>
				<h2 class="entry-title"><?php the_title(); ?></h2>
			<?php } else { ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php } ?>
		
			<div class="entry-content clearfix">
			
				<div class="contactinfo">
				<?php the_content() ?> <!-- Display Content -->
				</div>
			
			
				
			<?php if(isset($emailSent) && $emailSent == true) { ?>

				<div class="contactform-thanks">
					<h1>Thanks, <?php echo $name;?></h1>
					<p>Your email was successfully sent. I will be in touch soon.</p>
				</div>

			<?php } else { ?>

		
				<?php if(isset($hasError) || isset($captchaError)) { ?>
				<p class="contactform-error">There was an error submitting the form.<p>
				<?php } ?>
		


				<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
			
					<ol class="forms">
						<li><label for="contactName"><?php _e('Name','mthemelocal'); ?></label></li>
						<li class="inputbar">
							<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />
							<?php if (isset($nameError)) { ?>
								<span class="error"><?php echo $nameError;?></span> 
							<?php } ?>
						</li>
						
						<li><label for="email"><?php _e('Email','mthemelocal'); ?></label></li>
						<li class="inputbar">
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" />
							<?php if(isset($emailError)) { ?>
								<span class="error"><?php echo $emailError;?></span>
							<?php } ?>
						</li>
						
						<li class="textarea"><label for="commentsText"><?php _e('Message','mthemelocal'); ?></label></li>
						<li class="inputbar">
							<textarea name="message" id="commentsText" rows="20" cols="30" class="requiredField"><?php if(isset($_POST['message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message']); } else { echo $_POST['message']; } } ?></textarea>
							<?php if(isset($commentError)) { ?>
								<span class="error"><?php echo $commentError;?></span> 
							<?php } ?>
						</li>
						<li class="screenReader"><label for="checking" class="screenReader">If you want to submit this form, do not enter anything in this field</label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></li>
						<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit"><?php _e('Send','mthemelocal'); ?></button></li>
					</ol>
					
				</form>

				<?php } ?>
				<div class="clear"></div>	
				<?php edit_post_link( __('edit this entry','mthemelocal') ,'<p>','</p>'); ?>
			</div>
		</div>
	</div>

	
 <!-- Post Loop -->
<?php endwhile; ?>

<?php endif; ?>
</div>

<?php get_footer(); ?>
<?php
/*
Template Name: Contact
*/
?>

<?php
/* ---------------------------------------------------- */
/* Error Handling										*/
/* ---------------------------------------------------- */
$nameError ="";
$emailError ="";
$commentError ="";

if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = __('Please enter your name.', 'framework');
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = __('Please enter your email address.', 'framework');
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = __('You entered an invalid email address.', 'framework');
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = __('Please enter a message.', 'framework');
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = of_get_option('contact_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = 'Contact Form from '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>


<?php get_header(); ?>

<div id="page" class="border-top clearfix">

	<div class="color-hr2"></div>
	
	<div id="subtitle">
		
		<h2><span><?php the_title(); ?>.</span> <?php echo get_post_meta( get_the_ID( ), 'minti_subtitle', true ); ?></h2>
	</div>

	<div id="content-full">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
			<div id="post-<?php the_ID(); ?>" class="post">
	
				<?php if(isset($emailSent) && $emailSent == true) { ?>
								<h3><?php _e('Thanks, your email was sent successfully.', 'framework'); ?></h3>
						<?php } else { ?>
						
						<?php the_content(); ?>
						
						<div class="clear"></div>
						
						<div class="one_fourth">
						<?php echo of_get_option('contact_information'); ?>
						</div>
						
						<div class="three_fourth last">

						<form action="<?php the_permalink(); ?>" id="contactform" method="post">
							<p>
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
								<?php if($nameError != '') { ?>
									<label for="contactName"><span class="error"><?php echo $nameError; ?></span></label>
								<?php } else { ?>
									<label for="contactName"><?php _e('Name', 'framework'); ?></label>
								<?php } ?>
							</p>
							<p>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
								<?php if($emailError != '') { ?>
									<label for="email"><span class="error"><?php echo $emailError;?></span></label>
								<?php } else { ?>	
									<label for="email"><?php _e('Email', 'framework'); ?></label>
								<?php } ?>
							</p>
							<p>
								<?php if($commentError != '') { ?>
									<span class="error"><?php echo $commentError;?></span><br />
								<?php } ?>
								<textarea name="comments" id="commentsText" rows="10" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							</p>
							<p>
								<input type="submit" id="submit" value="<?php _e('Send Email', 'framework') ?>" />
							</p>
						</ul>
						<input type="hidden" name="submitted" id="submitted" value="true" />
					</form><br /><br /><br /><br />
					</div>
					
				<?php } ?>
			
			</div>
	
		<?php endwhile; endif; ?>
	
	</div>

</div>

<?php get_footer(); ?>

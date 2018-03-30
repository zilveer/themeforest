<?php
/**
 * Template Name: Contact Page
 *
 * A Fully Operational Contact Page
 * @package WordPress
 */

get_header(); ?>

<div class="full_container_page_title">	
	<div class="container animationStart">		
		<div class="row no_bm">
			<div class="sixteen columns">
			    <?php boc_breadcrumbs(); ?>
				<div class="page_heading"><h1><?php the_title(); ?></h1></div>
			</div>		
		</div>
	</div>
</div>



<?php

if(isset($_POST['submit'])) {

	if(trim($_POST['comment_name']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['comment_name']);
	}

	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comment']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comment']));
		} else {
			$comments = trim($_POST['comment']);
		}
	}
	
	
	// Send mail if no Errors
	if(!isset($hasError)) {		$emailTo = ot_get_option('contact_page_email');		if (!isset($emailTo) || ($emailTo == '') ){			$emailTo = get_option('admin_email');		}

		$body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nComments:\n $comments";
		$headers = 'From: '.get_bloginfo('name').' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		$emailSent = wp_mail($emailTo, $subject, $body, $headers);
	}
}
?>
	<?php if(ot_get_option('gmaps_address')): ?>

	<div class="container animationStart startNow">
		<div class="row">

			<div class="sixteen columns">
				<div id="google_map">
					<iframe src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=<?php echo urlencode(ot_get_option('gmaps_address')); ?>&aq=&ie=UTF8&hq=&hnear=<?php echo urlencode(ot_get_option('gmaps_address')); ?>&t=m&z=<?php echo ot_get_option('gmaps_zoom',14); ?>&output=embed&key=<?php echo ot_get_option('gmaps_API_key'); ?>"></iframe>	
				</div>
			</div>
			
		</div>	
	</div>

	<?php endif; ?>


	<div class="container animationStart startNow">	
	  <div class="row padded_block">
		<div class="two-thirds column">
		
		<?php while(have_posts()): the_post(); ?>
			<div id="post-<?php the_ID(); ?>">

				<h2 class="left_title"><span><?php _e('Contact Form', 'Terra'); ?></span></h2>
				
				<?php the_content(); ?>
				
				<?php if(isset($hasError)) { //If errors are found ?>
					<div class="warning closable"><?php _e("Please make sure all fields are correctly filled in!", 'Terra'); ?></div>
				<?php } ?>

				<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
					<div class="success closable"><?php _e('Your email was successfully sent! Thank you for contacting us!', 'Terra'); ?></div>
				<?php } ?>
	
				<form action="" method="post">
					<p>
						<label for="comment_name"><?php _e('Name', 'Terra'); ?><span class="required">*</span></label>
						<input id="comment_name" class="aqua_input" name="comment_name" type="text" value="">
					</p>
					<p>	
						<label for="email"><?php _e('Email', 'Terra'); ?><span class="required">*</span></label> 
						<input id="email" class="aqua_input" name="email" type="text" value="">
					</p>
					<p>	
						<label for="subject"><?php _e('Subject', 'Terra'); ?><span class="required">*</span></label> 
						<input id="subject" class="aqua_input" name="subject" type="text" value="">
					</p>
					<p>		
						<label for="comment"><?php _e('Message', 'Terra'); ?><span class="required">*</span></label>
						<textarea id="comment" rows="8" class="aqua_input" name="comment"></textarea>
					</p>
					<p class="form-submit">
						<input name="submit" type="submit" id="submit" value="<?php _e('Send', 'Terra'); ?>" class="button_hilite sm_button">
					</p>						
				</form>			
			
			
			
		</div>
		<?php endwhile; ?>
	  </div>

		<div class="one-third column">
			<?php if ( ! dynamic_sidebar('Terra Contact Sidebar') ) : ?>
			<?php endif; // end sidebar widget area ?>
		</div>
 
     </div> 
  </div>

<?php get_footer(); ?>
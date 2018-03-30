<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Contact Page
*/

get_header('contact');

$msgSubject = $_GET['msgSubject'];
if (empty($msgSubject)) {
	$subject = '';
	$message = '';
} else {
	$subject = 'I want to attend an event...';
	$message = 'Event: ' . get_the_title($msgSubject);
}

?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h2><?php the_title(); ?></h2>

<div id="contact"><div>

<div id="contactFormResult"></div>
<form action="<?php the_permalink(); ?>" method="post" id="contactForm">
 	<p>
	<label for="subject">Subject...</label>
	<input name="subject" id="subject" type="text" value="<?php echo $subject; ?>">
	</p>
	
	<p>
	<label for="email">Your Email Address...</label>
	<input name="email" id="email" type="text">
    <span class="sendingError">Valid Email Required!</span>
    </p>
	
 	<p>
	<label for="fname">Your First Name...</label>
	<input name="fname" type="text">
	</p>
	
 	<p>
	<label for="lname">Your Last Name...</label>
	<input name="lname" type="text">
	</p>
	
 	<p>
	<label for="phone">Phone Number...</label>
	<input name="phone" type="text">
	</p> 
	
    <p>
	<label for="message">Your Message...</label>
	<textarea name="message" id="message"><?php echo $message; ?></textarea>
    <span class="sendingError textarea">Required field!</span>
    </p>
    
    <input type="hidden" value="1" name="tbSendEmailYes">
    
    <div class="buttons">
    <input type="submit" class="bigButton right" value="Submit">
    <input type="reset" class="bigButton right" value="Reset">
    <div class="ajaxLoader"></div>
    </div>
    
</form>

<div id="contactExtra">

<h3 class="first">About Us</h3>


<?php the_content(); ?>


<?php if (get_option('tb_gmap_latitude') || get_option('tb_gmap_longitude')) { ?>
<div id="mapFrameContact">
	<div id="event_map"></div>
</div>
<?php } ?>

</div>

<?php endwhile; endif; ?>

</div></div>

<?php
get_footer();
?>
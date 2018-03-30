<?php
/*
Template Name: Contact
*/
?>

<?php
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = __('Please enter your email address.', 'eet_textdomain');
		$hasError = true;
	} else if (!is_email($_POST['email']) )  {
		$emailError = __('You entered an invalid email address.', 'eet_textdomain');
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = __('Please enter a message.', 'eet_textdomain');
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = $eet_option['eetcnt_email'];
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = __('New Email From ', 'eet_textdomain').$name;
		$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>

<?php if (!(isset($_POST["ishome"]) && $_POST["ishome"] == 1)) 
	$firmIsPage = true;


if ($firmIsPage) {
?>
	<?php get_header(); ?>
	
<?php }; ?>
<?php
if ((!isset($hasError)) && $emailSent) {
	?>
	<div id="messageemail">
	<img src="<?php echo get_template_directory_uri(); ?>/images/closew.png"  alt= "Close" class="closemesagio"  /> 
	<?php _e('Your message was successfully sent.', 'eet_textdomain'); ?>
	</div>
	<?php
} elseif (isset($hasError)) {
	?>
	<div id="messageemail">
	<img src="<?php echo get_template_directory_uri(); ?>/images/closew.png"  alt= "Close" class="closemesagio"  /> 
	<?php _e('Your message could not be sent. Please enter valid email address and name, all fields are required.', 'eet_textdomain'); ?>
	</div>
	<?php	
}
?>
<div class="homepostload pageinnerwrap contactpagesm" <?php if ( $eet_option['eetcnt_map'] == '' ) echo 'style="height: 250px !important;"' ?> >
<?php if (!$firmIsPage) { ?><img src="<?php echo get_template_directory_uri(); ?>/images/close.png"  alt= "Close" class="closecontact"  /> <?php }; ?>

<?php echo $eet_option['eetcnt_map']; ?>
<div id=formleft>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<h1><?php the_title(); ?></h1>
<?php the_content(); ?>
    <?php endwhile; else: ?>
    <?php endif; ?>
</div>
<div class="formwrap">
<form action="<?php the_permalink(); ?>" id="contactForm" method="post">

			<input type="text" name="contactName" value="<?php echo $eet_option['eetcnt_tr_nm']; ?>" id="contactName"  onblur="if (this.value == '') {this.value = '<?php echo $eet_option['eetcnt_tr_nm']; ?>';}" onfocus="if (this.value == '<?php echo $eet_option['eetcnt_tr_nm']; ?>') {this.value = '';}"  />

			<input type="text" name="email" id="email" value="<?php echo $eet_option['eetcnt_tr_em']; ?>"  onblur="if (this.value == '') {this.value = '<?php echo $eet_option['eetcnt_tr_em']; ?>';}" onfocus="if (this.value == '<?php echo $eet_option['eetcnt_tr_em']; ?>') {this.value = '';}" />

			<textarea name="comments" id="commentsText"></textarea>

			<button type="submit" id="contactsubmit"><span><?php echo $eet_option['eetcnt_tr_se']; ?></span></button>

	<input type="hidden" name="submitted" id="submitted" value="true" />
</form>
</div>
</div> 
<?php if ($firmIsPage) { ?>

	<?php get_footer(); ?>
<?php }; ?>

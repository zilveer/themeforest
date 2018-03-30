<?php
/**
 * Template Name: Contact
 * @package by ThemeRecord
 * @auther: MattMao
 */
get_header();

global $tr_config;

$lat = 0;
$lng = 0;
$address = $tr_config['map_address'];
$zoom = $tr_config['map_zoom'];
$height = $tr_config['map_height'];
$enable_google_map = $tr_config['enable_google_map']; 
$enable_recaptcha = $tr_config['enable_recaptcha']; 
$publickey = $tr_config['recaptcha_publickey']; 

if($enable_google_map) {
	echo '<div class="map-canvas" data-lat="'.$lat.'" data-lng="'.$lng.'" data-address="'.$address.'" data-zoom="'.$zoom.'" data-mapTitle="'.$address.'" style="width: 100%; height:'.$height.'px;"></div>';
}
?>

<div id="main" class="left-side clearfix tempate-contact">

<?php theme_sidebar('contact');?>

<!--Begin Content-->
<article id="content">

<?php 
	if (have_posts()) : the_post();  
	$content = get_the_content(); 
?>
<?php if($content) : ?>
	<div class="post-format">
	<?php the_content(); ?>
	</div>
<?php endif; ?>
<?php endif; ?>

<div class="contact-page">

	<div id="message"></div>
	<form method="post" action="<?php echo THEME_URI; ?>/functions/plugins/contact.php" name="contactform" id="contactform">

	<div class="box">
		<label for="name" accesskey="U"><span class="required">*</span><?php _e('Your Name', 'TR'); ?></label>
		<input name="name" type="text" id="name" size="30" value="" />
	</div>

	<div class="box">
		<label for="email" accesskey="E"><span class="required">*</span><?php _e('Email', 'TR'); ?></label>
		<input name="email" type="text" id="email" size="30" value="" />
	</div>

	<div class="box">
		<label for="phone" accesskey="P"><span class="required">*</span><?php _e('Phone', 'TR'); ?></label>
		<input name="phone" type="text" id="phone" size="30" value="" />
	</div>

	<div class="box">
		<label for="subject" accesskey="S"><span class="required">*</span><?php _e('Subject', 'TR'); ?></label>
		<input name="subject" type="text" id="subject" size="30" value="" />
	</div>

	<div class="box-content">
		<label for="comments" accesskey="C"><span class="required">*</span><?php _e('Your comments', 'TR'); ?></label>
		<textarea name="comments" cols="40" rows="3" id="comments" class="contact-content"></textarea>
	</div>

	<?php if($enable_recaptcha == true && $publickey) : ?>
	<div class="box-recaptcha">
		<?php echo recaptcha_get_html($publickey); ?>
	</div>
	<?php endif; ?>

	<div class="box-button">
		<input type="submit" class="submit" id="submit" value="<?php _e('Send Message', 'TR'); ?>" />
	</div>

	</form>

</div>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function(){

	jQuery('#contactform').submit(function(){

		var action = jQuery(this).attr('action');

		jQuery("#message").slideUp(750,function() {
		jQuery('#message').hide();

 		jQuery('#submit')
			.after('<img src="<?php echo ASSETS_URI; ?>/images/contact-loader.gif" class="loader" />')
			.attr('disabled','disabled');

		jQuery.post(action, {
			name: jQuery('#name').val(),
			email: jQuery('#email').val(),
			phone: jQuery('#phone').val(),
			subject: jQuery('#subject').val(),
			comments: jQuery('#comments').val(),
			recaptcha_challenge_field: jQuery('#recaptcha_challenge_field').val(),
			recaptcha_response_field: jQuery('#recaptcha_response_field').val(),
		},
			function(data){
				document.getElementById('message').innerHTML = data;
				jQuery('#message').slideDown('slow');
				jQuery('#contactform img.loader').fadeOut('slow',function(){jQuery(this).remove()});
				jQuery('#submit').removeAttr('disabled');
				if(data.match('success') != null) jQuery('#contactform').slideUp('slow');

			}
		);

		});

		return false;

	});

});
//]]>
</script>

</article>
<!--End Content-->


</div>
<!-- #main -->
<?php get_footer(); ?>
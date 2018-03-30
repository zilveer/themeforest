<?php 
/*
Template Name: Contact Page
*/ 
?>

<?php
global $wp_query;
$id = $wp_query->get_queried_object_id();
get_header();

$hide_contact_form_website = "";
if (isset($qode_options_theme13['hide_contact_form_website'])) $hide_contact_form_website = $qode_options_theme13['hide_contact_form_website'];

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = get_post_meta($id, "qode_page_background_color", true);
}else{
	$background_color = "";
}

if($qode_options_theme13['enable_google_map'] == "yes"){
	$container_class= " full_map";
} else {
	$container_class= "";
}

?>
	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
			
		<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
			<script>
			var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
			</script>
		<?php } ?>
		
		<?php get_template_part( 'title' ); ?>
		<?php if($qode_options_theme13['enable_google_map'] == "yes"){ ?>
			<div class="google_map" id="map_canvas"></div>
		<?php } ?>
		<div class="container"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
		<div class="container_inner<?php echo $container_class; ?> clearfix">
				<div class="contact_detail">
					
					<?php if($qode_options_theme13['enable_contact_form'] == "yes"){ ?>
					<div class="two_columns_33_66 clearfix grid2">
						<div class="column1">
							<div class="column_inner">
								<div class="contact_info">
									<?php the_content(); ?>
								</div>	
							</div>
						</div>
						<div class="column2">
							<div class="column_inner">
								<div class="contact_form">
									<h3><?php if($qode_options_theme13['contact_heading_above'] != "") { echo $qode_options_theme13['contact_heading_above'];  } else { ?><?php _e('Contact Us', 'qode'); ?><?php } ?></h3>
									<form id="contact-form" method="post" action="">
										<div class="two_columns_50_50 clearfix">
											<div class="column1">
												<div class="column_inner">
													<input type="text" class="requiredField" name="fname" id="fname" value="" placeholder="&#xf007;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('First Name *', 'qode'); ?>" />
													
												</div>
											</div>
											<div class="column2">
												<div class="column_inner">
													<input type="text" class="requiredField" name="lname" id="lname" value="" placeholder="&#xf007;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Last Name *', 'qode'); ?>" />
												</div>
											</div>
										</div>
										<?php if ($hide_contact_form_website == "yes") { ?>
											<input type="text" class="requiredField email" name="email" id="email" value="" placeholder="&#xf0e0;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Email *', 'qode'); ?>" />
											<input type="hidden" name="website" id="website" value="" />
										<?php } else { ?>
										<div class="two_columns_50_50 clearfix">
											<div class="column1">
												<div class="column_inner">
													<input type="text" class="requiredField email" name="email" id="email" value="" placeholder="&#xf0e0;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Email *', 'qode'); ?>" />
													
												</div>
											</div>
											<div class="column2">
												<div class="column_inner">
													<input type="text" name="website" id="website" value="" placeholder="&#xf0ac;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Website', 'qode'); ?>" />	
												</div>
											</div>
										</div>
										<?php }?>
										<textarea name="message" id="message" rows="10" placeholder="&#xf040;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Message', 'qode'); ?>"></textarea>
										
										<?php
										if($qode_options_theme13['use_recaptcha'] == "yes") :
											require_once('includes/recaptchalib.php');
											if($qode_options_theme13['recaptcha_public_key']) {
												$publickey = $qode_options_theme13['recaptcha_public_key'];
											} else {
												$publickey = "6Ld5VOASAAAAABUGCt9ZaNuw3IF-BjUFLujP6C8L";
											}
											if($qode_options_theme13['recaptcha_private_key']) {
												$privatekey = $qode_options_theme13['recaptcha_private_key'];
											} else {
												$privatekey = "6Ld5VOASAAAAAKQdKVcxZ321VM6lkhBsoT6lXe9Z";
											}

											if($qode_options_theme13['page_transitions'] != ""){ ?>
												<script type="text/javascript">
													var RecaptchaOptions = {theme: 'clean'};
													Recaptcha.create("<?php echo $publickey; ?>","captchaHolder",{theme: "clean",callback: Recaptcha.focus_response_field});
												</script>
											<?php } ?>
											<p id="captchaHolder"><?php echo recaptcha_get_html($publickey); ?></p>
											<p id="captchaStatus">&nbsp;</p>
										<?php endif; ?>
										
										<span class="submit_button_contact">
											<input class="qbutton" type="submit" value="<?php _e('Send', 'qode'); ?>" />
										</span>
									</form>	
								</div>
	
							</div>
						</div>
					</div>
					<?php }  else { ?>
						<div class="contact_info">
							<?php the_content(); ?>
						</div>
					<?php } ?>
				</div>	
		</div>	
	</div>	
		
<?php endwhile; ?>
<?php endif; ?>
<script type="text/javascript">
jQuery(document).ready(function($){
    $j('form#contact-form').submit(function(){
        $j('form#contact-form .contact-error').remove();
        var hasError = false;
        $j('form#contact-form .requiredField').each(function() {
            if(jQuery.trim($j(this).val()) == '' || jQuery.trim($j(this).val()) == jQuery.trim($j(this).attr('placeholder'))){
                var labelText = $j(this).prev('label').text();
                $j(this).parent().append('<strong class="contact-error"><?php _e('This is a required field', 'qode'); ?></strong>');
                $j(this).addClass('inputError');
                hasError = true;
            } else { //else 1 
                if($j(this).hasClass('email')) { //if hasClass('email')
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if(!emailReg.test(jQuery.trim($j(this).val()))){
                        var labelText = $j(this).prev('label').text();
                        $j(this).parent().append('<strong class="contact-error"><?php _e('Please enter a valid email address.', 'qode'); ?></strong>');
                        $j(this).addClass('inputError');
                        hasError = true;
                    } 
                } //end of if hasClass('email')

            } // end of else 1 
        }); //end of each()
        
        if(!hasError){
			challengeField = $j("input#recaptcha_challenge_field").val();
			responseField = $j("input#recaptcha_response_field").val();
			name =  $j("input#fname").val();
			lastname =  $j("input#lname").val();
			email =  $j("input#email").val();
			website =  $j("input#website").val();
			message =  $j("textarea#message").val();
			
			var form_post_data = "";
			
			var html = $j.ajax({
			type: "POST",
			url: "<?php echo QODE_ROOT; ?>/includes/ajax_mail.php",
			data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField + "&name=" + name + "&lastname=" + lastname + "&email=" + email + "&website=" + website + "&message=" + message,
			async: false
			}).responseText;
			
			if(html == "success"){
				var formInput = $j(this).serialize();
				
				$j("form#contact-form").before('<div class="contact-success"><strong><?php _e('THANK YOU!', 'qode'); ?></strong><p><?php _e('Your email was successfully sent. We will contact you as soon as possible.', 'qode'); ?></p></div>');
				$j("form#contact-form").hide();
				$j.post($j(this).attr('action'),formInput);
				hasError = false;
				return false; 
			} else {
				<?php
				if ($qode_options_theme13['use_recaptcha'] == "yes"){
				?>
					$j("#recaptcha_response_field").parent().append('<span class="contact-error extra-padding"><?php _e('Invalid Captcha', 'qode'); ?></span>');
					Recaptcha.reload();
				<?php
				} else {
				?>
					$j("form#contact-form").before('<div class="contact-success"><strong><?php _e("Email server problem", 'qode'); ?></strong></p></div>');
				<?php    
				}
				?>
				return false;
			}
        }
        return false;
    });
});
</script>   
	
<?php get_footer(); ?>			
<?php 
/*
Template Name: Contact Page
*/ 
?>

	<?php get_header(); ?>
  
	
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php if(!get_post_meta(get_the_ID(), "qode_show-page-title", true)) { ?>
						<div class="container">
							<div class="container_inner clearfix">
								<div class="title">
									<h1><?php the_title(); ?></h1>
									<?php if(get_post_meta(get_the_ID(), "qode_page-subtitle", true)) { ?><span><?php echo get_post_meta(get_the_ID(), "qode_page-subtitle", true) ?></span><?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>

					<?php if($qode_options_magnet['show_back_button'] == "yes") { ?>
						<a id='back_to_top' href='#'>
							<span class='back_to_top_inner'>
								<span>&nbsp;</span>
							</span>
						</a>
					<?php } ?>
					
					<?php
						$revslider = get_post_meta($id, "qode_revolution-slider", true);
						if (!empty($revslider)){
							echo do_shortcode($revslider);
						}
					?>
					<div class="container">
						<div class="container_inner clearfix">
						
						<?php if($qode_options_magnet['enable_google_map'] == "yes"){ ?>
							<div class="google_map">
								<?php echo $qode_options_magnet['google_maps_iframe']; ?>
							</div>
						<?php } ?>
						
						<div class="contact_detail">	
								
								<?php if($qode_options_magnet['enable_contact_form'] == "yes"){ ?>
								<div class="two_columns_50_50 clearfix">
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
												<h3><?php if($qode_options_magnet['contact_heading_above'] != "") { echo $qode_options_magnet['contact_heading_above'];  } else { ?><?php _e('Contact Form', 'qode'); ?><?php } ?></h3>										
												<form id="contact-form" method="post" action="">
													<div class="clearfix">
														<input type="text" class="requiredField" name="fname" id="fname" value="" placeholder="<?php _e('First Name *', 'qode'); ?>" />
														<input type="text" class="requiredField" name="lname" id="lname" value="" placeholder="<?php _e('Last Name *', 'qode'); ?>" />
														<input type="text" class="requiredField email" name="email" id="email" value="" placeholder="<?php _e('Email *', 'qode'); ?>" />
														<input type="text" name="website" id="website" value="" placeholder="<?php _e('Web site', 'qode'); ?>" />
														<textarea name="message" id="message" rows="10" placeholder="<?php _e('Message', 'qode'); ?>"></textarea>
													</div>

													<?php
														if($qode_options_magnet['use_recaptcha'] == "yes") :
															require_once('includes/recaptchalib.php');
															if($qode_options_magnet['recaptcha_public_key']) {
																$publickey = $qode_options_magnet['recaptcha_public_key'];
															} else {
																$publickey = "6LcKyN8SAAAAAKrNKSyqiYqQFuMEnOUq5VSaeh-1";
															}
															if($qode_options_magnet['recaptcha_private_key']) {
																$privatekey = $qode_options_magnet['recaptcha_private_key'];
															} else {
																$privatekey = "6LcKyN8SAAAAAMQ1WC0ge7gwimKFBFF8KXDvs_2I";
															}

															if($qode_options_magnet['page_transitions'] != ""){ ?>
																<script type="text/javascript">
																	var RecaptchaOptions = {theme: 'clean'};
																	Recaptcha.create("<?php echo $publickey; ?>","captchaHolder",{theme: "clean",callback: Recaptcha.focus_response_field});
																</script>
															<?php } ?>
															<p id="captchaHolder"><?php echo recaptcha_get_html($publickey); ?></p>
															<p id="captchaStatus">&nbsp;</p>
													<?php endif; ?>
													
													<span class="submit_button">
														<input type="submit" value="<?php _e('Send Message', 'qode'); ?>" />
													</span>
												</form>	
											</div>
										</div>
									</div>
								</div>	
								
								<?php }else{ ?>
									<?php the_content(); ?>
								<?php } ?>
							</div>	
						
						
					</div>
				</div>
<?php endwhile; ?>
<?php endif; ?>
<script type="text/javascript">
jQuery(document).ready(function($){

    $j('form#contact-form').submit(function() 
    {
        $j('form#contact-form .contact-error').remove();
        var hasError = false;
        $j('form#contact-form .requiredField').each(function() {
            if(jQuery.trim($j(this).val()) == '') 
            {
							$j(this).addClass('inputError');
							hasError = true;
            } 
            else 
            { //else 1 
                if($j(this).hasClass('email')) 
                { //if hasClass('email')
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if(!emailReg.test(jQuery.trim($j(this).val()))) 
                    {
											$j(this).addClass('inputError');
											hasError = true;
                    } 

                } //end of if hasClass('email')

            } // end of else 1 
        }); //end of each()
        
        if(!hasError) 
        {
          
					challengeField = $j("input#recaptcha_challenge_field").val();
					responseField = $j("input#recaptcha_response_field").val();
					fname =  $j("input#fname").val();
					lname =  $j("input#lname").val();
					email =  $j("input#email").val();
					website =  $j("input#website").val();
					message =  $j("textarea#message").val();
					
					var form_post_data = "";
					
					var html = $j.ajax({
					type: "POST",
					url: "<?php echo QODE_ROOT; ?>/includes/ajax_mail.php",
					data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField + "&fname=" + fname + "&lname=" + lname + "&email=" + email + "&website=" + website + "&message=" + message,
					async: false
					}).responseText;
					
					if(html == "success")
					{
							
							var formInput = $j(this).serialize();
							$j("form#contact-form .contact-success").remove();
							$j("form#contact-form").before('<div class="contact-success"><strong><?php _e('THANK YOU!', 'qode'); ?></strong><p><?php _e('Your email was successfully sent. We will contact you as soon as possible.', 'qode'); ?></p></div>');
							
							$j.post($j(this).attr('action'),formInput);
							hasError = false;
							return false; 
					}
					else
					{
							<?php
							if ($qode_options_magnet['use_recaptcha'] == "yes")
							{
							?>
							$j("form#contact-form .contact-error").remove();
							$j("#recaptcha_response_field").parent().append('<span class="contact-error extra-padding"><?php _e('Invalid Captcha', 'qode'); ?></span>');
							Recaptcha.reload();
							
							<?php
							}
							else
							{
							?>
							$j("form#contact-form .contact-success").remove();
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
<?php 
/*
Template Name: Contact Page
*/ 
?>

<?php
get_header();

$hide_contact_form_website = "";
if (isset($qode_options_passage['hide_contact_form_website'])) $hide_contact_form_website = $qode_options_passage['hide_contact_form_website'];

if(get_post_meta($id, "qode_responsive-title-image", true) != ""){
 $responsive_title_image = get_post_meta($id, "qode_responsive-title-image", true);
}else{
	$responsive_title_image = $qode_options_passage['responsive_title_image'];
}

if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
 $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options_passage['fixed_title_image'];
}

if(get_post_meta($id, "qode_title-image", true) != ""){
 $title_image = get_post_meta($id, "qode_title-image", true);
}else{
	$title_image = $qode_options_passage['title_image'];
}

if(get_post_meta($id, "qode_title-height", true) != ""){
 $title_height = get_post_meta($id, "qode_title-height", true);
}else{
	$title_height = $qode_options_passage['title_height'];
}

$title_in_grid = false;
if(isset($qode_options_passage['title_in_grid'])){
if ($qode_options_passage['title_in_grid'] == "yes") $title_in_grid = true;
}

if(get_post_meta($id, "qode_content-animation", true) != ""){
 $content_animation = get_post_meta($id, "qode_content-animation", true);
}else{
	if(isset($qode_options_passage['content_animation'])){
		$content_animation = $qode_options_passage['content_animation'];
	}else{
		$content_animation = 'yes';
	}
}


?>
  	
	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		
	<?php if($qode_options_passage['show_back_button'] == "yes") { ?>
		<a id='back_to_top' href='#'>
			<span class='back_to_top_inner'>
				<span>&nbsp;</span>
			</span>
		</a>
	<?php } ?>
	
	<?php if(!get_post_meta(get_the_ID(), "qode_show-page-title", true)) { ?>
		<div class="title animate <?php if($content_animation == 'no'){ echo 'no_entering_animation '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes"){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no"){ echo 'has_background'; } if($responsive_title_image == 'yes'){ echo 'with_image'; } ?>" <?php if($responsive_title_image == 'no' && $title_image != ""){ echo 'style="background-image:url('.$title_image.'); height:'.$title_height.'px;"'; }?>>
			<?php if($responsive_title_image == 'yes' && $title_image != ""){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
			<?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
				<?php if($title_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix">
				<?php } ?>
				<h1><?php the_title(); ?></h1>
				<?php if($title_in_grid){ ?>
					</div>
				</div>
				<?php } ?>
			<?php } ?>
		</div>
	<?php } ?>


	<?php
		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){
			echo do_shortcode($revslider);
		}
		?>
	<div class="container top_move <?php if($content_animation == 'no'){ echo 'no_entering_animation'; }  ?>">
		<div class="container_inner">
			<div class="container_inner2 clearfix">
				<div class="contact_detail">
					<div class="title_with_line_holder">
						<h5 class="title_with_line"><?php  _e('WHERE WE ARE','qode'); ?></h5>
						<div class="title_with_line_separator"></div>
					</div>
					<?php if($qode_options_passage['enable_google_map'] == "yes"){ ?>
					<div class="two_columns_50_50 clearfix">
						<div class="column1">
							<div class="column_inner">
								
									<div class="google_map" id="map_canvas">
						
									</div>
								
							</div>
						</div>
						<div class="column2">
							<div class="column_inner">
								<div class="contact_info">
									<?php the_content(); ?>
								</div>
								<?php if($qode_options_passage['enable_contact_form'] == "yes"){ ?>
								<div class="contact_form">
									<h4><?php if($qode_options_passage['contact_heading_above'] != "") { echo $qode_options_passage['contact_heading_above'];  } else { ?><?php _e('CONTACT FORM', 'qode'); ?><?php } ?></h4>										
									<form id="contact-form" method="post" action="">
										<div class="two_columns_50_50 clearfix">
											<div class="column1">
												<div class="column_inner">
													<input type="text" class="requiredField" name="fname" id="fname" value="" placeholder="<?php _e('First Name *', 'qode'); ?>" />
												</div>
											</div>
											<div class="column2">
												<div class="column_inner">
													<input type="text" class="requiredField" name="lname" id="lname" value="" placeholder="<?php _e('Last Name *', 'qode'); ?>" />
												</div>
											</div>
										</div>
										<?php if ($hide_contact_form_website == "yes") { ?>
											<input type="text" class="requiredField email" name="email" id="email" value="" placeholder="<?php _e('Email *', 'qode'); ?>" />
											<input type="hidden" name="website" id="website" value="" />
										<?php } else { ?>
											<div class="two_columns_50_50 clearfix">
												<div class="column1">
													<div class="column_inner">
														<input type="text" class="requiredField email" name="email" id="email" value="" placeholder="<?php _e('Email *', 'qode'); ?>" />
													</div>
												</div>
												<div class="column2">
													<div class="column_inner">
														<input type="text" name="website" id="website" value="" placeholder="<?php _e('Web site', 'qode'); ?>" />
													</div>
												</div>
											</div>
										<?php }?>
		
										<textarea name="message" id="message" rows="10" placeholder="<?php _e('Message', 'qode'); ?>"></textarea>

										<?php
											if($qode_options_passage['use_recaptcha'] == "yes") :
												require_once('includes/recaptchalib.php');
												if($qode_options_passage['recaptcha_public_key']) {
													$publickey = $qode_options_passage['recaptcha_public_key'];
												} else {
													$publickey = "6Ld5VOASAAAAABUGCt9ZaNuw3IF-BjUFLujP6C8L";
												}
												if($qode_options_passage['recaptcha_private_key']) {
													$privatekey = $qode_options_passage['recaptcha_private_key'];
												} else {
													$privatekey = "6Ld5VOASAAAAAKQdKVcxZ321VM6lkhBsoT6lXe9Z";
												}

												if($qode_options_passage['page_transitions'] != ""){ ?>
													<script type="text/javascript">
														var RecaptchaOptions = {theme: 'clean'};
														Recaptcha.create("<?php echo $publickey; ?>","captchaHolder",{theme: "clean",callback: Recaptcha.focus_response_field});
													</script>
												<?php } ?>
												<p id="captchaHolder"><?php echo recaptcha_get_html($publickey); ?></p>
												<p id="captchaStatus">&nbsp;</p>
										<?php endif; ?>
										
										<span class="submit_button">
											<input class="button small" type="submit" value="<?php _e('CONTACT US', 'qode'); ?>" />
										</span>
									</form>	
								</div>
								<?php } ?>
							</div>
						</div>
					</div>	
					<?php }  else { ?>
						<div class="contact_info">
							<?php the_content(); ?>
						</div>
						<?php if($qode_options_passage['enable_contact_form'] == "yes"){ ?>
						<div class="contact_form">
							<h4><?php if($qode_options_passage['contact_heading_above'] != "") { echo $qode_options_passage['contact_heading_above'];  } else { ?><?php _e('CONTACT FORM', 'qode'); ?><?php } ?></h4>										
							<form id="contact-form" method="post" action="">
								<div class="two_columns_50_50 clearfix">
									<div class="column1">
										<div class="column_inner">
											<input type="text" class="requiredField" name="fname" id="fname" value="" placeholder="<?php _e('First Name *', 'qode'); ?>" />
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
											<input type="text" class="requiredField" name="lname" id="lname" value="" placeholder="<?php _e('Last Name *', 'qode'); ?>" />
										</div>
									</div>
								</div>
								<?php if ($hide_contact_form_website == "yes") { ?>
									<input type="text" class="requiredField email" name="email" id="email" value="" placeholder="<?php _e('Email *', 'qode'); ?>" />
									<input type="hidden" name="website" id="website" value="" />
								<?php } else { ?>
									<div class="two_columns_50_50 clearfix">
										<div class="column1">
											<div class="column_inner">
												<input type="text" class="requiredField email" name="email" id="email" value="" placeholder="<?php _e('Email *', 'qode'); ?>" />
											</div>
										</div>
										<div class="column2">
											<div class="column_inner">
												<input type="text" name="website" id="website" value="" placeholder="<?php _e('Web site', 'qode'); ?>" />
											</div>
										</div>
									</div>
								<?php }?>

								<textarea name="message" id="message" rows="10" placeholder="<?php _e('Message', 'qode'); ?>"></textarea>
								
								<?php
									if($qode_options_passage['use_recaptcha'] == "yes") :
										require_once('includes/recaptchalib.php');
										if($qode_options_passage['recaptcha_public_key']) {
											$publickey = $qode_options_passage['recaptcha_public_key'];
										} else {
											$publickey = "6Ld5VOASAAAAABUGCt9ZaNuw3IF-BjUFLujP6C8L";
										}
										if($qode_options_passage['recaptcha_private_key']) {
											$privatekey = $qode_options_passage['recaptcha_private_key'];
										} else {
											$privatekey = "6Ld5VOASAAAAAKQdKVcxZ321VM6lkhBsoT6lXe9Z";
										}

										if($qode_options_passage['page_transitions'] != ""){ ?>
											<script type="text/javascript">
												var RecaptchaOptions = {theme: 'clean'};
												Recaptcha.create("<?php echo $publickey; ?>","captchaHolder",{theme: "clean",callback: Recaptcha.focus_response_field});
											</script>
										<?php } ?>
										<p id="captchaHolder"><?php echo recaptcha_get_html($publickey); ?></p>
										<p id="captchaStatus">&nbsp;</p>
								<?php endif; ?>
								
								<span class="submit_button">
									<input class="button small" type="submit" value="<?php _e('CONTACT US', 'qode'); ?>" />
								</span>
							</form>	
						</div>
						<?php } ?>
					<?php } ?>

				</div>
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
                var labelText = $j(this).prev('label').text();
                $j(this).parent().append('<strong class="contact-error"><?php _e(' Required', 'qode'); ?></strong>');
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
                        var labelText = $j(this).prev('label').text();
                        $j(this).parent().append('<strong class="contact-error"><?php _e(' Invalid', 'qode'); ?></strong>');
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
					
					if(html == "success")
					{
							
							var formInput = $j(this).serialize();
							
							$j("form#contact-form").before('<div class="contact-success"><strong><?php _e('THANK YOU!', 'qode'); ?></strong><p><?php _e('Your email was successfully sent. We will contact you as soon as possible.', 'qode'); ?></p></div>');
							
							$j.post($j(this).attr('action'),formInput);
							hasError = false;
							return false; 
					}
					else
					{
							<?php
							if ($qode_options_passage['use_recaptcha'] == "yes")
							{
							?>
							$j("#recaptcha_response_field").parent().append('<span class="contact-error extra-padding"><?php _e('Invalid Captcha', 'qode'); ?></span>');
							Recaptcha.reload();
							
							<?php
							}
							else
							{
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
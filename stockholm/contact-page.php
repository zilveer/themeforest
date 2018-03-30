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
if (isset($qode_options['hide_contact_form_website'])) $hide_contact_form_website = $qode_options['hide_contact_form_website'];

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = get_post_meta($id, "qode_page_background_color", true);
}else{
	$background_color = "";
}

$content_style = "";
if(get_post_meta($id, "qode_content-top-padding", true) != ""){
	if(get_post_meta($id, "qode_content-top-padding-mobile", true) == "yes"){
		$content_style = "style='padding-top:".get_post_meta($id, "qode_content-top-padding", true)."px !important'";
	}else{
		$content_style = "style='padding-top:".get_post_meta($id, "qode_content-top-padding", true)."px'";
	}
}

$google_map_position = "bottom_position";
if(isset($qode_options['google_map_position'])) {
	$google_map_position = $qode_options['google_map_position'];
}

if($qode_options['enable_google_map'] == "yes"){
	$container_class= " full_map";
} else {
	$container_class= "";
}
if($qode_options['enable_google_map'] == "yes" && ($google_map_position == "right_position" || $google_map_position == "left_position")) {
	$container_class .= ' map_lr map_' . $google_map_position;
}
$show_section = "yes";
if(isset($qode_options['section_between_map_form'])) {
	$show_section = $qode_options['section_between_map_form'];
}

$custom_style = "";
if(isset($qode_options['use_custom_style']) && $qode_options['use_custom_style'] == 'yes') {
	$custom_style .= ' cf7_custom_style_1';
}
?>
	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
			
		<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
			<script>
			var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
			</script>
		<?php } ?>
		
		<?php get_template_part( 'title' ); ?>

		<?php if($qode_options['enable_google_map'] == "yes" && $google_map_position == "top_position"){ ?>
            <div class="google_map_holder">
                <?php
                $google_maps_scroll_wheel = false;
                if(isset($qode_options['google_maps_scroll_wheel'])){
                    if ($qode_options['google_maps_scroll_wheel'] == "yes")
                        $google_maps_scroll_wheel = true;
                }
                if(!$google_maps_scroll_wheel){
                    ?>
                    <div class="google_map_ovrlay"></div>
                <?php } ?>
                <div class="q_google_map" id="map_canvas"></div>
            </div>
        <?php } ?>

        <div class="full_width"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
        	<div class="full_width_inner" <?php if($content_style != "") { echo wp_kses($content_style, array('style')); } ?>>
        		<div class="contact_info">
					<?php the_content(); ?>
				</div>
        	</div>
        </div>
        <?php if($show_section == "yes" || $qode_options['enable_contact_form'] == "yes") { ?>
		<div class="container"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
			<div class="container_inner<?php echo esc_attr($container_class); ?> clearfix q_contact_page default_template_holder">
				<div class="contact_detail">
					<?php if($show_section == "yes") { ?>
						<div class="contact_section <?php if(isset($qode_options['contact_section_text_align']) && !empty($qode_options['contact_section_text_align'])) { echo esc_attr($qode_options['contact_section_text_align']); }?>">
							<?php if(isset( $qode_options['contact_section_above_form_subtitle']) && $qode_options['contact_section_above_form_subtitle'] != "") { ?>
								<h4><?php echo esc_html($qode_options['contact_section_above_form_subtitle']); ?></h4>
							<?php } ?>

							<?php if(isset( $qode_options['contact_section_above_form_title']) && $qode_options['contact_section_above_form_title'] != "") { ?>
								<h2><?php echo esc_html($qode_options['contact_section_above_form_title']); ?></h2>
							<?php } ?>
						</div>
					<?php } ?>
					<?php if($qode_options['enable_contact_form'] == "yes"){ ?>
						<div class="contact_form <?php echo esc_attr($custom_style) ?>">
                            <?php if($qode_options['contact_heading_above'] != "") { ?><h5> <?php echo esc_html($qode_options['contact_heading_above']); ?> </h5> <?php } ?>
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
												<input type="text" name="website" id="website" value="" placeholder="<?php _e('Website', 'qode'); ?>" />	
											</div>
										</div>
									</div>
								<?php } ?>
								
								<textarea name="message" id="message" rows="10" placeholder="<?php _e('Message', 'qode'); ?>"></textarea>
								
								<?php
								if($qode_options['use_recaptcha'] == "yes") :
									require_once('includes/recaptchalib.php');
									if($qode_options['recaptcha_public_key']) {
										$publickey = $qode_options['recaptcha_public_key'];
									} else {
										$publickey = "6Ld5VOASAAAAABUGCt9ZaNuw3IF-BjUFLujP6C8L";
									}
									if($qode_options['recaptcha_private_key']) {
										$privatekey = $qode_options['recaptcha_private_key'];
									} else {
										$privatekey = "6Ld5VOASAAAAAKQdKVcxZ321VM6lkhBsoT6lXe9Z";
									}
									if($qode_options['page_transitions'] != ""){ ?>
										<script type="text/javascript">
											var RecaptchaOptions = {theme: 'clean'};
											Recaptcha.create("<?php echo esc_attr($publickey); ?>","captchaHolder",{theme: "clean",callback: Recaptcha.focus_response_field});
										</script>
									<?php } ?>
									<p id="captchaHolder"><?php echo recaptcha_get_html($publickey); ?></p>
									<p id="captchaStatus">&nbsp;</p>
								<?php endif; ?>
								
								<span class="submit_button_contact">
									<input class="qbutton contact_form_button" type="submit" value="<?php _e('Contact Us', 'qode'); ?>" />
								</span>
							</form>	
						</div>
					<?php } ?>
				</div>
				<!-- Contact form right/left -->
				<?php if($qode_options['enable_google_map'] == "yes" && ($google_map_position == "right_position" || $google_map_position == "left_position")){ ?>
				<div class="google_map_holder">
					<?php
					$google_maps_scroll_wheel = false;
					if(isset($qode_options['google_maps_scroll_wheel'])){
						if ($qode_options['google_maps_scroll_wheel'] == "yes")
							$google_maps_scroll_wheel = true;
					}
					if(!$google_maps_scroll_wheel){
						?>
						<div class="google_map_ovrlay"></div>
					<?php } ?>
					<div class="q_google_map" id="map_canvas"></div>
				</div>
				<?php } ?>
			</div>	
	    </div>
	    <?php } ?>
        <?php if($qode_options['enable_google_map'] == "yes" && $google_map_position == "bottom_position"){ ?>
            <div class="google_map_holder">
                <?php
                $google_maps_scroll_wheel = false;
                if(isset($qode_options['google_maps_scroll_wheel'])){
                    if ($qode_options['google_maps_scroll_wheel'] == "yes")
                        $google_maps_scroll_wheel = true;
                }
                if(!$google_maps_scroll_wheel){
                    ?>
                    <div class="google_map_ovrlay"></div>
                <?php } ?>
                <div class="q_google_map" id="map_canvas"></div>
            </div>
        <?php } ?>
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
                $j(this).parent().append("<strong class='contact-error'><?php _e('This is a required field', 'qode'); ?></strong>");
                $j(this).addClass('inputError');
                hasError = true;
            } else { //else 1 
                if($j(this).hasClass('email')) { //if hasClass('email')
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/;
                    if(!emailReg.test(jQuery.trim($j(this).val()))){
                        var labelText = $j(this).prev('label').text();
                        $j(this).parent().append("<strong class='contact-error'><?php _e('Please enter a valid email address.', 'qode'); ?></strong>");
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
				
				$j("form#contact-form").before("<div class='contact-success'><strong><?php _e('THANK YOU!', 'qode'); ?></strong><p><?php _e('Your email was successfully sent. We will contact you as soon as possible.', 'qode'); ?></p></div>");
				$j("form#contact-form").hide();
				$j.post($j(this).attr('action'),formInput);
				hasError = false;
				return false; 
			} else {
				<?php
				if ($qode_options['use_recaptcha'] == "yes"){
				?>
					$j("#recaptcha_response_field").parent().append("<span class='contact-error extra-padding'><?php _e('Invalid Captcha', 'qode'); ?></span>");
					Recaptcha.reload();
				<?php
				} else {
				?>
					$j("form#contact-form").before("<div class='contact-success'><strong><?php _e('Email server problem', 'qode'); ?></strong></p></div>");
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
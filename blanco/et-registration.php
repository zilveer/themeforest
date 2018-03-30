<?php
/**
 * Template Name: Custom Registration Page
 */
//Check whether the user is already logged in
if (!$user_ID) {
        get_header();
        $captcha_instance = new ReallySimpleCaptcha();
		$captcha_instance->bg = array( 244, 80, 80 );
		$word = $captcha_instance->generate_random_word();
		$prefix = mt_rand();
		$img_name = $captcha_instance->generate_image( $prefix, $word );
		$captcha_img = ETHEME_CODE_URL.'/inc/really-simple-captcha/tmp/'.$img_name;
        ?>
        <section id="main" class="columns2-left">
            <div class="content">
                <div class="entry-content">
                    <?php
                    if(get_option('users_can_register')) {
                        ?>
                        <h1><?php the_title(); ?></h1>
                        <div id="result"></div> 
                        
                        <form id="wp_signup_form" action="" method="post" class="login">
                            <div class="login-fields">
                    			<p class="form-row form-row-first">
                                    <label><?php _e( "Username", ETHEME_DOMAIN ) ?> <span class="required">*</span></label>
                    				<input type="text" name="username" class="text" value="" />
                    			</p>
                    			<p class="form-row">
                                    <label><?php _e( "Email address", ETHEME_DOMAIN ) ?> <span class="required">*</span></label>
                    				<input type="text" name="email" class="text" value="" />
                    			</p>
                    			<p class="form-row">
                                    <label><?php _e( "Password", ETHEME_DOMAIN ) ?> <span class="required">*</span></label>
                    				<input type="password" name="pass" class="text" value="" />
                    			</p>
                    			<p class="form-row form-row-last">
                                    <label><?php _e( "Re-enter password", ETHEME_DOMAIN ) ?> <span class="required">*</span></label>
                    				<input type="password" name="pass2" class="text" value="" />
                    			</p>
                    			<div class="clear"></div>
                			</div>
							<div class="captcha-block">
								<img src="<?php echo $captcha_img; ?>">
								<input type="text" name="captcha-word" class="captcha-input">
								<input type="hidden" name="captcha-prefix" value="<?php echo $prefix; ?>">
							</div>
                			<p class="form-row right">
                				<button class="button fl-r submitbtn" type="submit"><span><?php _e( "Register", ETHEME_DOMAIN ) ?></span></button>
                                <div class="clear"></div>
                			</p>
                        </form>
                        <script type="text/javascript">
                            jQuery(".submitbtn").click(function() {
                                jQuery('#result').html('<img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" class="loader" />').fadeIn();
                                var input_data = jQuery('#wp_signup_form').serialize();
                                input_data += '&action=et_register_action';
                                jQuery.ajax({
                                    type: "GET",
                                    dataType: "JSON",
                                    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                                    data: input_data,
                                    success: function(response){
                                        jQuery('.loader').remove();
                                        if(response.status == 'error') {
                                        	var msgHtml = '<span class="error">' + response.msg + '</span>';
                                            jQuery('<div>').html(msgHtml).appendTo('div#result').hide().fadeIn('slow');
                                            
                                        } else {
                                        	var msgHtml = '<span class="success">' + response.msg + '</span>';
                                            jQuery('<div>').html(msgHtml).appendTo('div#result').hide().fadeIn('slow');
                                            jQuery('#wp_signup_form').find("input[type=text], input[type=password], textarea").val("");
                                        }
                                    }
                                });
                                return false;
                            });
                        </script>
                        <?php
                    }
                    else _e( '<span class="error">Registration is currently disabled. Please try again later.<span>', ETHEME_DOMAIN );
                    ?>
                </div>
			</div><!-- #content -->
            <aside id="sidebar">
                <?php get_sidebar(); ?>
            </aside>
            <div class="clear"></div>
		</section><!-- #container -->
        <?php
        get_footer();
}
else {
    echo "<script type='text/javascript'>window.location='". home_url() ."'</script>";
}
?>
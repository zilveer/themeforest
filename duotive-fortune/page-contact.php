<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Page - Contact
 */
if ( !function_exists('_recaptcha_qsencode') ) require_once('includes/recaptchalib.php'); 
get_header(); ?>
    <section id="content" class="clearfix page-widh-sidebar">
    	<div class="content-header-sep"></div>
        <?php if (get_option('dt_ContactMap','no') == 'yes' && get_option('dt_ContactMapUrl')): ?>
        <iframe width="960" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo get_option('dt_ContactMapUrl'); ?>&amp;output=embed"></iframe>
        <div class="contact-page-map-sep"></div>
        <?php endif; ?>
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div class="page">                 	
	            <?php the_content(); ?>
                <div id="page-contact-confirmation-message"></div>
                <form id="page-contact" name="page-contact" action="<?php echo get_template_directory_uri(); ?>/page-contact-sender.php" method="POST">
                    <input type="hidden" name="recaptcha_usage" value="<?php echo get_option('dt_ContactRecaptcha', 'no');?>" />
                    <input type="hidden" name="destination_email" value="<?php echo get_option('dt_ContactDestination', get_option('admin_email')); ?>" />                            
                    <?php $dt_ContactField1 = get_option('dt_ContactField1', 'yes');?>
                    <?php $dt_ContactField2 = get_option('dt_ContactField2', 'yes');?>
                    <?php $dt_ContactField3 = get_option('dt_ContactField3', 'yes');?>
                    <?php $dt_ContactField4 = get_option('dt_ContactField4', 'yes');?>
                    <?php $dt_ContactField5 = get_option('dt_ContactField5', 'yes');?>
                    <div class="one-half one-half-margin">
                        <label for="full_name"><?php echo dt_ContactFormName; ?></label><?php if ( $dt_ContactField1 == 'yes' ) echo '<em>*</em>'; ?><br />
                        <div class="clear-content">
                            <span class="button"></span>
                            <input<?php if ( $dt_ContactField1 == 'yes' ) echo ' class="required"'; ?> type="text" value="" name="full_name" />                    
                        </div>
                    </div>
                    <div class="one-half">
                        <label for="company"><?php echo dt_ContactFormCompany ?></label><?php if ( $dt_ContactField2 == 'yes' ) echo '<em>*</em>'; ?><br />
                        <div class="clear-content">
                            <span class="button"></span>
                            <input<?php if ( $dt_ContactField2 == 'yes' ) echo ' class="required"'; ?> type="text" value="" name="company" />                     
                        </div>
                    </div>                    
                    <div class="one-half one-half-margin">
                        <label for="email"><?php echo dt_ContactFormEmail; ?></label><?php if ( $dt_ContactField3 == 'yes' ) echo '<em>*</em>'; ?><br />
                        <div class="clear-content">
                            <span class="button"></span>
                            <input<?php if ( $dt_ContactField3 == 'yes' ) echo ' class="required email"'; ?> type="text" value="" name="email" />
                        </div>                                
                    </div>
                    <div class="one-half">
                        <label for="phone"><?php echo dt_ContactFormPhone; ?></label><?php if ( $dt_ContactField4 == 'yes' ) echo '<em>*</em>'; ?><br />
                        <div class="clear-content">
                            <span class="button"></span>                               
                            <input<?php if ( $dt_ContactField4 == 'yes' ) echo ' class="required"'; ?> type="text" value="" name="phone" />
                        </div>                                
                    </div>
                    <div class="full-width">
                        <label><?php echo dt_ContactFormMessage; ?></label><?php if ( $dt_ContactField5 == 'yes' ) echo '<em>*</em>'; ?><br />
                        <div class="clear-content clear-content-textarea">
                            <span class="button"></span>                                 
                            <textarea<?php if ( $dt_ContactField5 == 'yes' ) echo ' class="required"'; ?> spellcheck="false" name="message"></textarea>                                                                                                             
                        </div>                                    
                    </div>
                    <?php if ( get_option('dt_ContactRecaptcha', 'no') == 'yes' ):?>
                        <div class="full-width">
                            <script type="text/javascript">
                                 var RecaptchaOptions = {
                                    theme : 'custom',
                                    custom_theme_widget: 'recaptcha_page'
                                 };
                            </script>                            
                            <div id="recaptcha_page" class="recaptcha_widget" style="display:none">
                            <div id="recaptcha_image_wrapper">
                                <label id="recaptcha_human_label"><?php echo dt_RecaptchaHuman; ?></label>
                                <div id="recaptcha_image"></div>
                            </div>
                            <div id="recaptcha_controls">
                               <div class="recaptcha_reload"><a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a></div>
                               <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
                               <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
                               <div class="recaptcha_help"><a href="javascript:Recaptcha.showhelp()">Help</a></div>
                            </div>
                            <div id="recaptcha_label_field">                               
                               <span class="recaptcha_only_if_image"><label for="recaptcha_response_field"><?php echo dt_RecaptchaWords; ?></label><em>*</em></span>
                               <span class="recaptcha_only_if_audio"><label for="recaptcha_response_field"><?php echo dt_RecaptchaAudio; ?></label><em>*</em></span>
                               <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                            </div>
                            </div>
                            <script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=<?php echo get_option('dt_recaptchapublickey'); ?>"></script>
                        </div>
                    <?php endif; ?>                        
                    <input type="submit" value="<?php echo dt_ContactFormSendMessage; ?>" />
                    <div id="page-contact-loader" style="display:none;">sending</div>
                </form>                
            <!-- end of page -->
            </div>
        <?php endwhile; ?>
        <?php get_sidebar(); ?>
    <!-- end of content -->
    </section>
<?php get_footer(); ?>

<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! contact_form
// **********************************************************************// 

add_shortcode('et_contact_form','etheme_contact_form_shortcode');

function etheme_contact_form_shortcode($atts, $content) {
    $output = '';
    extract(shortcode_atts(array(
    	'design' => '1',
        'class'  => '',
    ), $atts));

    $captcha_instance = new ReallySimpleCaptcha();
    $captcha_instance->bg = array( 190, 190, 190 );
    $word = $captcha_instance->generate_random_word();
    $prefix = mt_rand();
    $img_name = $captcha_instance->generate_image( $prefix, $word );
    $captcha_img = ET_BASE_URI . ET_CODE . 'tmp/' . $img_name;

    ob_start();
    ?>
        <div id="contactsMsgs"></div>
        <form action="<?php the_permalink(); ?>" method="get" id="contact-form" class="contact-form <?php echo $class; ?> design-<?php echo $design; ?>">
            
            <div class="form-group">
              <p class="form-name">
                <label for="name" class="control-label"><?php _e('Name and Surname', ET_DOMAIN) ?> <span class="required">*</span></label>
                <input type="text" name="contact-name" class="required-field form-control" id="contact-name">
              </p>
            </div>

            <div class="form-group">
                <p class="form-name">
                  <label for="contact-email" class="control-label"><?php _e('Email', ET_DOMAIN) ?> <span class="required">*</span></label>
                  <input type="text" name="contact-email" class="required-field form-control" id="contact-email">
                </p>
            </div>
            
            <div class="form-group">
              <p class="form-name">
                <label for="contact-website" class="control-label"><?php _e('Website', ET_DOMAIN) ?></label>
                <input type="text" name="contact-website" class="form-control" id="contact-website">
              </p>
            </div>
            

            <div class="form-group">
              <p class="form-textarea">
                <label for="contact_msg" class="control-label"><?php _e('Message', ET_DOMAIN); ?> <span class="required">*</span></label>
                <textarea name="contact-msg" id="contact-msg" class="required-field form-control" cols="30" rows="7"></textarea>
              </p>
            </div>
            
            <div class="captcha-block">
              <img src="<?php echo $captcha_img; ?>">
              <input type="text" name="captcha-word" class="captcha-input">
              <input type="hidden" name="captcha-prefix" value="<?php echo $prefix; ?>">
            </div>
            
            <p class="pull-right">
              <input type="hidden" name="contact-submit" id="contact-submit" value="true" >
              <span class="spinner"><?php _e('Sending...', ET_DOMAIN) ?></span>
              <button class="btn btn-black big" id="submit" type="submit"><?php _e('Send message', ET_DOMAIN) ?></button>
            </p>

            <div class="clearfix"></div>
        </form>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
}

// **********************************************************************// 
// ! Register New Element: contact_form
// **********************************************************************//
add_action( 'init', 'et_register_vc_contact_form');
if(!function_exists('et_register_vc_contact_form')) {
	function et_register_vc_contact_form() {
		if(!function_exists('vc_map')) return;
	    $params = array(
	      'name' => '[8THEME] Contact Form',
	      'base' => 'et_contact_form',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ET_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ET_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($params);
	}
}

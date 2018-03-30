<?php

/**
 * template part for footer quick contact. views/footer
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */

global $mk_options;
				
if ($mk_options['disable_quick_contact'] != 'true') return false;

if(is_singular(array('post', 'portfolio')) && $mk_options['quick_contact_on_single'] == 'false') return false;

$captcha = isset($mk_options['captcha_quick_contact']) ? $mk_options['captcha_quick_contact'] : 'true';

$id = mt_rand(99, 999);
$tabindex_1 = $id;
$tabindex_2 = $id + 1;
$tabindex_3 = $id + 2;
$tabindex_4 = $id + 3;

Mk_Send_Mail::update_contact_form_email(2342, 15, $mk_options['quick_contact_email']);

?>
	<div class="mk-quick-contact-wrapper  js-bottom-corner-btn js-bottom-corner-btn--contact">
			
		<a href="#" class="mk-quick-contact-link"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-icon-envelope'); ?></a>
		<div id="mk-quick-contact">
			<div class="mk-quick-contact-title"><?php
				echo $mk_options['quick_contact_title']; ?></div>
			<p><?php
				echo $mk_options['quick_contact_desc']; ?></p>
			<form class="mk-contact-form" method="post" novalidate="novalidate">
				<input type="text" placeholder="<?php _e('Name*', 'mk_framework'); ?>" required="required" id="name" name="name" class="text-input" value="" tabindex="<?php echo $tabindex_1; ?>" />
				<input type="email" data-type="email" required="required" placeholder="<?php _e('Email*', 'mk_framework'); ?>" id="email" name="email" class="text-input" value="" tabindex="<?php echo $tabindex_2; ?>"  />
				<textarea placeholder="<?php _e('Message*', 'mk_framework'); ?>" required="required" id="content" name="content" class="textarea" tabindex="<?php echo $tabindex_3; ?>"></textarea>
				<?php
				if ($captcha == 'true' && Mk_Theme_Captcha::is_plugin_active()) { ?>
				<input placeholder="<?php _e('Enter Captcha', 'mk_framework'); ?>" type="text" data-type="captcha" name="captcha" class="captcha-form text-input full" required="required" autocomplete="off" />
		            <a href="#" class="captcha-change-image"><?php _e('Not readable? Change text.', 'mk_framework'); ?></a>
		            <span class="captcha-image-holder"></span> <br/>
				<?php
				} ?>

				<div class="btn-cont">
                    <button tabindex="<?php echo $tabindex_4; ?>" class="mk-progress-button mk-contact-button shop-flat-btn shop-skin-btn" data-style="move-up">
                        <span class="mk-progress-button-content"><?php esc_html_e( 'Send', 'mk_framework' ); ?></span>
                        <span class="mk-progress">
                            <span class="mk-progress-inner"></span>
                        </span>
                        <span class="state-success"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-checkmark'); ?></span>
                        <span class="state-error"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-close'); ?></span>
                    </button>
                </div>
				<?php wp_nonce_field('mk-contact-form-security', 'security'); ?>
				<?php echo Mk_Send_Mail::contact_form_hidden_values(15, 2342); ?>
				<div class="contact-form-message clearfix"></div>  
			</form>
			<div class="bottom-arrow"></div>
		</div>
	</div>
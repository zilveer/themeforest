<?php
/**
 * template part for MailChimp Subscribe. views/header/toolbar
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */


global $mk_options;

if ($mk_options['header_toolbar_subscribe'] != 'true') return false;

?>
<div class="mk-header-signup">
	
	<a href="#" id="mk-header-subscribe-button" class="mk-subscribe-link mk-toggle-trigger"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-envelop') ?><?php _e('Subscribe', 'mk_framework');?></a>

	<div class="mk-header-subscribe mk-box-to-trigger">
		<form action="<?php echo esc_url( $mk_options['mailchimp_action_url'] ); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			<label for="mce-EMAIL"><?php _e('Subscribe to newsletter', 'mk_framework');?></label>
			<input type="email" value="" name="EMAIL" class="email text-input" id="mce-EMAIL" placeholder="<?php _e('Email Address', 'mk_framework');?>" required>
			<input type="submit" value="<?php _e('Subscribe', 'mk_framework');?>" name="subscribe" id="mc-embedded-subscribe" class="shop-flat-btn shop-skin-btn">
		</form>
	</div>

</div>
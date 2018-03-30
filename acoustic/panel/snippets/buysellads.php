<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	$ci_defaults['buysellads_code'] = '';

	add_action('after_open_body_tag', 'ci_register_bsa_script');
	if( !function_exists('ci_register_bsa_script') ):
		function ci_register_bsa_script()
		{
			// Load Buy Sell Ads code, if available.
			if(ci_setting('buysellads_code'))
			{
				echo html_entity_decode(ci_setting('buysellads_code'));
			}
		
		}
	endif;

?>
<?php else: ?>

	<fieldset id="ci-panel-buysellads" class="set">
		<legend><?php _e('BuySellAds', 'ci_theme'); ?></legend>
		<p class="guide"><?php echo sprintf(__('Paste here your BuySellAds.com <strong>Main Code</strong>, as given by the <a href="%s">BSA website</a>, and it will be automatically included on every page. Then use our BSA Widget for your sidebar code.', 'ci_theme'), 'http://support.buysellads.com/knowledge_base/topics/how-to-install-your-ad-code'); ?></p>
		<?php ci_panel_textarea( 'buysellads_code', __('BuySellAds.com Main Code', 'ci_theme') ); ?>
	</fieldset>

<?php endif; ?>
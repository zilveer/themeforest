<form method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div role="search">
		<input type="text" value="" placeholder="<?php esc_html_e('Enter Your Keywords', 'libero'); ?>" name="s" id="s" />
		<?php echo libero_mikado_execute_shortcode('mkd_button',array(
		'html_type' => 'input',
		'size' => 'medium',
		'text' => 'Search',
		'custom_class' => 'mkd-search-submit',
		'input_name' => "srch_sbmt"
		))?>
	</div>
</form>
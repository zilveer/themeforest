<?php if (TMM::get_option('show_donate_button') !== '0') {

	$donate_button_url = '';
	$donate_button_target = '';

	if (TMM::get_option('donate_button_target') !== '0') {
		$donate_button_target = ' target="_blank"';
	}

	if (TMM::get_option('donate_button_url_type') === '1') {
		$donate_button_url = (int) TMM::get_option('donate_button_page');
		if ($donate_button_url) {
			$donate_button_url = get_permalink($donate_button_url);
		}
	} else {
		$donate_button_url = TMM::get_option('donate_button_custom_link');
	}
	?>

	<a<?php echo $donate_button_target; ?> href="<?php echo esc_url($donate_button_url); ?>" class="button large donate"><?php echo TMM::get_option('donate_button_text') ? esc_html( TMM::get_option('donate_button_text') ) : __('Donate', 'diplomat'); ?></a>

<?php } ?>
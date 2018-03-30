<?php
global $zorka_data;
$show_language_selector =  isset($zorka_data['show-language-selector']) ? $zorka_data['show-language-selector'] : 0;
?>
<?php if (function_exists('icl_get_setting') && ($show_language_selector)):?>
	<ul class="language-selector">
		<li>
			<span><?php esc_html_e('Language','zorka'); ?></span> <i class="fa fa-angle-down"></i>
			<?php do_action('icl_language_selector'); ?>
		</li>
	</ul>
<?php endif;?>
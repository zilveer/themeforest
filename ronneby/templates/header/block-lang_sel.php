<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
if (isset($dfd_ronneby['wpml_lang_show']) && $dfd_ronneby['wpml_lang_show']): ?>
	<div class="lang-sel sel-dropdown">
		<?php

		if(!function_exists('dfd_language_selector_flags')) {
			function dfd_language_selector_flags() {
				global $dfd_ronneby;
				$switcher_html = $flag_html = $active_switcher_html = $active_item = $active_flag = '';
				if (function_exists('icl_get_languages')) {
					$languages = icl_get_languages('skip_missing=0&orderby=code');

					if (!empty($languages)) {
						foreach ($languages as $l) {
							if(strcmp($l['active'], '0') != 0){
								$active_item = $l['translated_name'];
								$active_flag = $l['country_flag_url'];
							}
							$active_switcher_html = '<a href="#"><span>'.$active_item.'</span></a>';
							if(isset($dfd_ronneby['extra_header_options']) && $dfd_ronneby['extra_header_options'] == 'on') {
								$flag_html = '<span class="flag" style="background: transparent url('.$l['country_flag_url'].') center center no-repeat;"></span>';
								$active_switcher_html = '<a href="'.esc_url($l['url']).'"><span class="flag" style="background: transparent url('.$active_flag.') center center no-repeat;"></span><span>'.$active_item.'</span></a>';
							}
							$switcher_html .= '<li>';
							$switcher_html .= '<a href="' . $l['url'] . '">';
							$switcher_html .= $flag_html;
							$switcher_html .= '<span>'.$l['translated_name'].'</span>';
							$switcher_html .= '</a>';
							$switcher_html .= '</li>';
						}
					}
				} ?>

				<?php echo $active_switcher_html ?>
				<ul>
					<?php echo $switcher_html ?>
				</ul>
			<?php }
		}

		dfd_language_selector_flags();
		?>
	</div>
<?php elseif (isset($dfd_ronneby['lang_shortcode']) && $dfd_ronneby['lang_shortcode']): ?>
	<?php echo do_shortcode($dfd_ronneby['lang_shortcode']); ?>
<?php endif; ?>

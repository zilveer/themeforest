		<!-- HEADER -->
		<?php
			
			// GET OPTIONS
			$canon_options = get_option('canon_options');
			$canon_options_frame = get_option('canon_options_frame');

            // DEV MODE OPTIONS
            if ($canon_options['dev_mode'] == "checked") {
                if (isset($_GET['header_pre_layout'])) { $canon_options_frame['header_pre_layout'] = wp_filter_nohtml_kses($_GET['header_pre_layout']); }
                if (isset($_GET['header_main_layout'])) { $canon_options_frame['header_main_layout'] = wp_filter_nohtml_kses($_GET['header_main_layout']); }
                if (isset($_GET['header_post_layout'])) { $canon_options_frame['header_post_layout'] = wp_filter_nohtml_kses($_GET['header_post_layout']); }
            }

            // STICKY-HEADER-WRAPPER
            echo '<div class="sticky-header-wrapper clearfix ">';

            if ($canon_options_frame['header_pre_layout'] != "off") { get_template_part('inc/templates/header/template_' . $canon_options_frame['header_pre_layout']); }
            if ($canon_options_frame['header_main_layout'] != "off") { get_template_part('inc/templates/header/template_' . $canon_options_frame['header_main_layout']); }
            if ($canon_options_frame['header_post_layout'] != "off") { get_template_part('inc/templates/header/template_' . $canon_options_frame['header_post_layout']); }
            get_template_part('inc/templates/header/template_header_search');

            echo '</div>';

		?>


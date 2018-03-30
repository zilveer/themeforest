        <!-- HEADER -->
        <?php
            
            // GET OPTIONS
            $canon_options = get_option('canon_options');
            $canon_options_frame = get_option('canon_options_frame');

            // DEV MODE OPTIONS
            if ($canon_options['dev_mode'] == "checked") {
                if (isset($_GET['pre_header_layout'])) { $canon_options_frame['pre_header_layout'] = wp_filter_nohtml_kses($_GET['pre_header_layout']); }
                if (isset($_GET['main_header_layout'])) { $canon_options_frame['main_header_layout'] = wp_filter_nohtml_kses($_GET['main_header_layout']); }
                if (isset($_GET['post_header_layout'])) { $canon_options_frame['post_header_layout'] = wp_filter_nohtml_kses($_GET['post_header_layout']); }
            }

            // var_dump('inc/templates/header/template_header_' . $canon_options_frame['header_1_layout']);

            // show header if this is not a placeholder page or if this is a placeholder page but user is logged in.
            if ( (is_page_template('page-placeholder.php') === false) || (is_page_template('page-placeholder.php') === true && is_user_logged_in() === true) ) { 

                // sticky-header-wrapper
                echo '<div class="sticky-header-wrapper clearfix">';

                if ($canon_options_frame['pre_header_layout'] != "off") { get_template_part('inc/templates/header/template_header_' . $canon_options_frame['pre_header_layout']); }
                if ($canon_options_frame['main_header_layout'] != "off") { get_template_part('inc/templates/header/template_header_' . $canon_options_frame['main_header_layout']); }
                if ($canon_options_frame['post_header_layout'] != "off") { get_template_part('inc/templates/header/template_header_' . $canon_options_frame['post_header_layout']); }
                get_template_part('inc/templates/header/template_header_search');

                echo '</div>';

            }
        
        ?>


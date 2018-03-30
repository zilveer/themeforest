<!-- TEMPLATE HEADER: HEADER_MAIN_CUSTOM_LEFT_RIGHT -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['header_main_custom_left'])) { $canon_options_frame['header_main_custom_left'] = wp_filter_nohtml_kses($_GET['header_main_custom_left']); }
        if (isset($_GET['header_main_custom_right'])) { $canon_options_frame['header_main_custom_right'] = wp_filter_nohtml_kses($_GET['header_main_custom_right']); }
        if (isset($_GET['use_sticky_header'])) { $canon_options_frame['use_sticky_header'] = wp_filter_nohtml_kses($_GET['use_sticky_header']); }
    }
?>

                    <!-- Start main Header Container -->
                    <div class="outter-wrapper header-container <?php if ($canon_options_frame['use_sticky_header'] == 'checked') { echo "canon_sticky"; } ?>">
                        <div class="wrapper">
                            <div class="clearfix">

                                <!-- MAIN HEADER LEFT SLOT -->
                                <div class="main-header left">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['header_main_custom_left']); ?>

                                </div>


                                <!-- MAIN HEADER RIGHT SLOT -->
                                <div class="main-header right">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['header_main_custom_right']); ?>

                                </div>


                            </div>  
                        </div>
                    </div>
                    <!-- End Outter Wrapper --> 

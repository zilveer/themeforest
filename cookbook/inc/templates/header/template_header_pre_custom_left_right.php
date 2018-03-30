<!-- TEMPLATE HEADER: PRE_CUSTOM_LEFT_RIGHT -->

<?php

    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['header_pre_custom_left'])) { $canon_options_frame['header_pre_custom_left'] = wp_filter_nohtml_kses($_GET['header_pre_custom_left']); }
        if (isset($_GET['header_pre_custom_right'])) { $canon_options_frame['header_pre_custom_right'] = wp_filter_nohtml_kses($_GET['header_pre_custom_right']); }
        if (isset($_GET['use_sticky_preheader'])) { $canon_options_frame['use_sticky_preheader'] = wp_filter_nohtml_kses($_GET['use_sticky_preheader']); }
    }

?>

                    <!-- Start Pre Header Container -->
                    <div class="outter-wrapper pre-header-container pre-head-lr <?php if ($canon_options_frame['use_sticky_preheader'] == 'checked') { echo "canon_sticky"; } ?>">
                        <div class="wrapper">
                            <div class="clearfix">

                                <!-- PREHEADER LEFT SLOT -->
                                <div class="pre-header left">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['header_pre_custom_left']); ?>

                                </div>


                                <!-- PREHEADER RIGHT SLOT -->
                                <div class="pre-header right">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['header_pre_custom_right']); ?>

                                </div>


                            </div>  
                        </div>
                    </div>
                    <!-- End Outter Wrapper --> 

<!-- TEMPLATE: TEMPLATE_FOOTER_PRE_CUSTOM_LEFT_RIGHT -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['footer_pre_custom_left'])) { $canon_options_frame['footer_pre_custom_left'] = wp_filter_nohtml_kses($_GET['footer_pre_custom_left']); }
        if (isset($_GET['footer_pre_custom_right'])) { $canon_options_frame['footer_pre_custom_right'] = wp_filter_nohtml_kses($_GET['footer_pre_custom_right']); }
    }

?>

                    <!-- PRE-FOOTER-CONTAINER -->
                    <div class="outter-wrapper pre-footer-container">

                        <div class="wrapper">

                            <div class="clearfix">

                                <!-- PRE-FOOTER LEFT SLOT -->
                                <div class="pre-footer left">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['footer_pre_custom_left']); ?>

                                </div>


                                <!-- PRE-FOOTER RIGHT SLOT -->
                                <div class="pre-footer right">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['footer_pre_custom_right']); ?>

                                </div>


                            </div>  

                        </div>

                    </div>
                    <!-- END PRE-FOOTER-CONTAINER --> 

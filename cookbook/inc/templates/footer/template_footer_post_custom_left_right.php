<!-- TEMPLATE: template_footer_post_custom_left_right -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['footer_post_custom_left'])) { $canon_options_frame['footer_post_custom_left'] = wp_filter_nohtml_kses($_GET['footer_post_custom_left']); }
        if (isset($_GET['footer_post_custom_right'])) { $canon_options_frame['footer_post_custom_right'] = wp_filter_nohtml_kses($_GET['footer_post_custom_right']); }
    }

?>

                    <!-- POST-FOOTER-CONTAINER -->
                    <div class="outter-wrapper post-footer-container">

                        <div class="wrapper">

                            <div class="clearfix">

                                <!-- POST FOOTER LEFT SLOT -->
                                <div class="post-footer left">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['footer_post_custom_left']); ?>

                                </div>


                                <!-- POST FOOTER RIGHT SLOT -->
                                <div class="post-footer right">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['footer_post_custom_right']); ?>

                                </div>


                            </div>  

                        </div>

                    </div>
                    <!-- END POST-FOOTER-CONTAINER --> 

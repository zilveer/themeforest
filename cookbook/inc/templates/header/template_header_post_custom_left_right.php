<!-- TEMPLATE: header_post_custom_left_right -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['header_post_custom_left'])) { $canon_options_frame['header_post_custom_left'] = wp_filter_nohtml_kses($_GET['header_post_custom_left']); }
        if (isset($_GET['header_post_custom_right'])) { $canon_options_frame['header_post_custom_right'] = wp_filter_nohtml_kses($_GET['header_post_custom_right']); }
        if (isset($_GET['use_sticky_postheader'])) { $canon_options_frame['use_sticky_postheader'] = wp_filter_nohtml_kses($_GET['use_sticky_postheader']); }
    }


?>

                    <!-- Start Post Header Container -->
                    <div class="outter-wrapper post-header-container <?php if ($canon_options_frame['use_sticky_postheader'] == 'checked') { echo "canon_sticky"; } ?>">
                        <div class="wrapper">
                            <div class="clearfix">

                                <!-- POST HEADER LEFT SLOT -->
                                <div class="post-header left">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['header_post_custom_left']); ?>

                                </div>


                                <!-- POST HEADER RIGHT SLOT -->
                                <div class="post-header right">

                                    <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['header_post_custom_right']); ?>

                                </div>


                            </div>  
                        </div>
                    </div>
                    <!-- End Outter Wrapper --> 

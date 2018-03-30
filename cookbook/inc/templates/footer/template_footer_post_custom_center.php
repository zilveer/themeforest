<!-- TEMPLATE: TEMPLATE_FOOTER_POST_CUSTOM_CENTER -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['footer_post_custom_center'])) { $canon_options_frame['footer_post_custom_center'] = wp_filter_nohtml_kses($_GET['footer_post_custom_center']); }
    }

?>

    <!-- POST-FOOTER-CONTAINER -->
    <div class="outter-wrapper post-footer-container">

        <div class="wrapper">

            <div class="clearfix post-footer centered">

                <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['footer_post_custom_center']); ?>

            </div>

        </div>

    </div>
    <!-- END POST-FOOTER-CONTAINER -->
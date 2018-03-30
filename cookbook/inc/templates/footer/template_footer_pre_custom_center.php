<!-- TEMPLATE: TEMPLATE_FOOTER_PRE_CUSTOM_CENTER -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['footer_pre_custom_center'])) { $canon_options_frame['footer_pre_custom_center'] = wp_filter_nohtml_kses($_GET['footer_pre_custom_center']); }
    }

?>

    <!-- PRE-FOOTER-CONTAINER -->
    <div class="outter-wrapper pre-footer-container">

        <div class="wrapper">

            <div class="clearfix pre-footer centered">

                <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['footer_pre_custom_center']); ?>

            </div>

        </div>

    </div>
    <!-- END PRE-FOOTER-CONTAINER -->
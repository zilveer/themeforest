<!-- TEMPLATE: header_post_custom_center -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['header_post_custom_center'])) { $canon_options_frame['header_post_custom_center'] = wp_filter_nohtml_kses($_GET['header_post_custom_center']); }
        if (isset($_GET['use_sticky_postheader'])) { $canon_options_frame['use_sticky_postheader'] = wp_filter_nohtml_kses($_GET['use_sticky_postheader']); }
    }
?>

    <!-- Start Outter Wrapper -->
    <div class="outter-wrapper post-header-container <?php if ($canon_options_frame['use_sticky_postheader'] == 'checked') { echo "canon_sticky"; } ?>">
        <!-- Start Main Navigation -->
        <div class="wrapper">
            <header class="clearfix centered">

                <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['header_post_custom_center']); ?>

            </header>
        </div>
        <!-- End Main Navigation -->
    </div>
    <!-- End Outter Wrapper -->
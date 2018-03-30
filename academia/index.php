<?php
if (isset($_REQUEST['custom-page']) && !empty($_REQUEST['custom-page'])) {
    if (G5Plus_Global::get_is_do_action_custom_page()) {
        do_action('custom-page/'.$_REQUEST['custom-page']);
    }
} else {
    get_header();
    g5plus_get_template( 'archive');
    get_footer();
}
<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('main-sidebar')) : ?>

    <?php _e('Add some widgets on this sidebar.', LANGUAGE_ZONE); ?>

<?php endif; ?>
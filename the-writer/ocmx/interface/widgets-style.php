<?php function obox_widgets_style() {
global $pagenow;
    if ( $pagenow == 'widgets.php' ) {

echo <<<EOF
<style type="text/css">

/* SOCIAL WIDGET */
.social-instruction{font-size: 14px; line-height: 24px; padding: 5px 10px; background: #f5f5f5; border-bottom: 2px solid #ccc; margin-bottom: 10px;}

</style>
EOF;
}

}

add_action('admin_print_styles-widgets.php', 'obox_widgets_style');

?>
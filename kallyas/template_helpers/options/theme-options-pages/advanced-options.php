<?php
/**
 * Theme options > General Options  > Favicon options
 */

$admin_options[] = array(
    'slug'        => 'advanced_options',
    'parent'      => 'advanced_options',
    'id'          => 'font_uploader',
    'name'        => 'Icon Font uploader',
    'description' => 'Please select a zip archive containing the font (generate it using http://fontello.com).',
    'type'        => 'upload',
    'supports'    => array
    (
        'file_extension' => 'zip',
        'file_type' => 'application/octet-stream, application/zip',
    )
);

$admin_options[] = array(
    'slug'        => 'advanced_options',
    'parent'      => 'advanced_options',
    'id'          => 'zn_refresh_pb',
    'name'        => 'Refresh page builder data',
    'description' => 'If you have made changes to the theme\'s page builder folder or files, you will need to press this button in order to refresh their css and folder structure.',
    'type'        => 'zn_ajax_call',
    'ajax_call_setup' => array(
        'action' => 'zn_refresh_pb',
        'button_text' => 'Refresh page builder data'
    )
);

$admin_options[] = array (
    'slug'        => 'advanced_options',
    'parent'      => 'advanced_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "advo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#F5bYMHBcHO0', __( 'Icon fonts uploader', 'zn_framework' ), array(
    'slug'        => 'advanced_options',
    'parent'      => 'advanced_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'advanced_options',
    'parent'      => 'advanced_options',
));

/************** */

$admin_options[] = array(
    'slug'        => 'custom_css',
    'parent'      => 'advanced_options',
    'id'          => 'custom_css',
    'name'        => 'Custom css',
    'description' => 'Here you can enter your custom css that will be used by the theme.',
    'type'        => 'custom_css',
    'class'       => 'zn_full'
);

$admin_options[] = array (
    'slug'        => 'custom_css',
    'parent'      => 'advanced_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "adv_css_o_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#d4D9lAV8NEs', __( 'Add custom CSS', 'zn_framework' ), array(
    'slug'        => 'custom_css',
    'parent'      => 'advanced_options'
));
$admin_options[] = zn_options_doc_link_option( 'http://support.hogash.com/documentation/adding-custom-css/', array(
    'slug'        => 'custom_css',
    'parent'      => 'advanced_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'custom_css',
    'parent'      => 'advanced_options',
));

$admin_options[] = array(
    'slug'        => 'custom_js',
    'parent'      => 'advanced_options',
    'id'          => 'custom_js',
    'name'        => 'Custom Javascript',
    'description' => 'Here you can enter your custom javascript that will be added on all pages. <strong>Do NOT include &lt;SCRIPT&gt; tags</strong>!! ',
    'type'        => 'custom_js',
    'editor_type' => 'javascript',
    'class'       => 'zn_full'
);

$admin_options[] = array (
    'slug'        => 'custom_js',
    'parent'      => 'advanced_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "adv_js_o_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = array(
    'slug'        => 'theme_export_import',
    'parent'      => 'advanced_options',
    'id'          => 'theme_export_import',
    'name'        => 'Import / Export the theme options',
    'description' => 'Here you can either import or export (Backup / Restore) the theme options.',
    'type'        => 'theme_import_export',
    'class'       => 'zn_full'
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#DIvUKRBQ3BM', __( 'Add custom JS', 'zn_framework' ), array(
    'slug'        => 'custom_js',
    'parent'      => 'advanced_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'custom_js',
    'parent'      => 'advanced_options',
));

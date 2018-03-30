<?php
/**
 * Theme options > Blog Options  > Archive options
 */
global $sidebar_option;

if(!isset($sidebar_option) || empty($sidebar_option)){
    $sidebar_option = WpkZn::getThemeSidebars();
}
$admin_options[] = array (
                'slug'        => 'blog_archive_options',
                'parent'      => 'blog_options',
                "name"        => __( 'Blog Layout and style', 'zn_framework' ),
                // "description" => __( "These options are applied to the subheader in blog pages.", 'zn_framework' ),
                "id"          => "hd_title1",
                "type"        => "zn_title",
                "class"       => "zn_full zn-custom-title-large zn-top-separator"
);

// Maintain backwards compatibility
$std_blog_layout = zget_option('blog_style_layout', 'blog_options', false, '1') == 1 ? 'def_classic' : 'cols';

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( "Blog Layout", 'zn_framework' ),
    "description" => __( "Select the blog layout.", 'zn_framework' ),
    "id"          => "blog_layout",
    "std"         => $std_blog_layout,
    "options"     => array(
        array(
            'value' => 'def_classic',
            'name'  => __( 'Generic Blog - Classic Style', 'zn_framework' ),
            'image' => THEME_BASE_URI .'/images/admin/blog_layouts/def.gif'
        ),
        array(
            'value' => 'def_modern',
            'name'  => __( 'Generic Blog - Modern Style', 'zn_framework' ),
            'image' => THEME_BASE_URI .'/images/admin/blog_layouts/def-modern.gif'
        ),
        array(
            'value' => 'cols',
            'name'  => __( 'Multi-columns blog', 'zn_framework' ),
            'image' => THEME_BASE_URI .'/images/admin/blog_layouts/multicols.gif'
        ),
    ),
    "type"        => "radio_image",
    "class"        => "ri-hover-line ri-3",
);


$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( "Blog Columns", 'zn_framework' ),
    "description" => __( "Select the number of columns you want to use.", 'zn_framework' ),
    "id"          => "blog_style_layout",
    "std"         => "1",
    "type"        => "select",
    "options"     => array (
        '1' => __( "1", 'zn_framework' ),
        '2' => __( "2", 'zn_framework' ),
        '3' => __( "3", 'zn_framework' ),
        '4' => __( "4", 'zn_framework' ),
        '5' => __( "5", 'zn_framework' ),
        '6' => __( "6", 'zn_framework' ),
    ),
    'dependency'   => array( "element" => 'blog_layout', 'value' => array( 'cols' ) ),
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( "Content to show", 'zn_framework' ),
    "description" => __( "Choose what content you want to show <b>Important : This only works for 1 column</b>", 'zn_framework' ),
    "id"          => "sb_archive_content_type",
    "std"         => "full",
    "type"        => "select",
    "options"     => array (
        'excerpt' => __( 'Excerpt', 'zn_framework' ),
        'full'  => __( 'Full content', 'zn_framework' ),
    ),
    'dependency'   => array( "element" => 'blog_layout', 'value' => array( 'def_classic', 'def_modern' ) ),
);

$admin_options[] = array(
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    'id'          => 'blog_style',
    'name'        => 'Blog color scheme',
    'description' => 'Select the style of the blog',
    'type'        => 'select',
    'std'         => '',
    'options'        => array(
        '' => 'Inherit from Global (Color options)',
        'light' => 'Light',
        'dark' => 'Dark'
    ),
);

$admin_options[] = array (
                'slug'        => 'blog_archive_options',
                'parent'      => 'blog_options',
                "name"        => __( 'Image options', 'zn_framework' ),
                // "description" => __( "These options are applied to the subheader in blog pages.", 'zn_framework' ),
                "id"          => "hd_title1",
                "type"        => "zn_title",
                "class"       => "zn_full zn-custom-title-large"
);
$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( "Use full width image", 'zn_framework' ),
    "description" => __( "Choose Use full width image option if you want the images to be full width rather then
        the default layout", 'zn_framework' ),
    "id"          => "sb_archive_use_full_image",
    "std"         => "no",
    "type"        => "select",
    "options"     => array (
        'yes' => __( 'Use full width image', 'zn_framework' ),
        'no'  => __( 'Use default layout', 'zn_framework' ),
    )
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( "Image Maximum Width (px)", 'zn_framework' ),
    "description" => __( "Add a custom maximum width for the blog-post images in the blog archive. Leave blank for default value.", 'zn_framework' ),
    "id"          => "sb_archive_def_cwidth",
    "std"         => "",
    "type"        => "text",
    "placeholder" => "eg: 400px",
    'dependency'   => array( "element" => 'sb_archive_use_full_image', 'value' => array( 'no' ) ),
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( "Use first attached image ?", 'zn_framework' ),
    "description" => __( "Choose yes if you want the theme to display the first image inside a page if no featured image is present", 'zn_framework' ),
    "id"          => "zn_use_first_image",
    "std"         => 'yes',
    "options"     => array ( 'yes' => __( "Yes", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
    "type"        => "zn_radio",
    "class"        => "zn_radio--yesno",
);

$admin_options[] = array (
                'slug'        => 'blog_archive_options',
                'parent'      => 'blog_options',
                "name"        => __( 'Blog Sub-header', 'zn_framework' ),
                "description" => __( "These options are applied to the subheader in blog pages.", 'zn_framework' ),
                "id"          => "hd_title1",
                "type"        => "zn_title",
                "class"       => "zn_full zn-custom-title-large zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"           => __( "Archive Page Title", 'zn_framework' ),
    "description"    => __( "Enter the desired page title for the blog archive page.", 'zn_framework' ),
    "id"             => "archive_page_title",
    "type"           => "text",
    "std"            => __( "BLOG & Gossip", 'zn_framework' ),
    "translate_name" => __( "Archive Page Title", 'zn_framework' ),
    "class"          => ""
);
$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"           => __( "Archive page subtitle", 'zn_framework' ),
    "description"    => __( "Enter the desired page subtitle for the blog archive page.", 'zn_framework' ),
    "id"             => "archive_page_subtitle",
    "type"           => "text",
    "std"            => __( "This would be the blog category page", 'zn_framework' ),
    "translate_name" => __( "Archive Page Subtitle", 'zn_framework' ),
    "class"          => ""
);

$header_option = WpkZn::getThemeHeaders(true);
$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( "Header Style for main blog page", 'zn_framework' ),
    "description" => __( 'Select the background style you want to use.Please note that the styles can be created from the "Unlimited Headers" options in the theme admin\'s page.', 'zn_framework' ),
    "id"          => "blog_sub_header",
    "std"         => "",
    "type"        => "select",
    "options"     => $header_option,
    "class"       => ""
);


$admin_options[] = array (
                'slug'        => 'blog_archive_options',
                'parent'      => 'blog_options',
                "name"        => __( 'Other options', 'zn_framework' ),
                // "description" => __( "These options are applied to the subheader in blog pages.", 'zn_framework' ),
                "id"          => "hd_title1",
                "type"        => "zn_title",
                "class"       => "zn_full zn-custom-title-large zn-top-separator"
);

$date_info = 'https://codex.wordpress.org/Formatting_Date_and_Time';
$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"           => __( "Blog date format", 'zn_framework' ),
    "description"    => __( "Enter your desired date format. More info about formatting the date can be found", 'zn_framework' ) .' <a target="_blank" href="'.$date_info.'">'.__('here', 'zn_framework').'</a>',
    "id"             => "blog_date_format",
    "type"           => "date_format",
    "std"            => 'l, d F Y',
);


$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "bgao_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#Kd0a0kDrg1s', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options'
));
$admin_options[] = zn_options_doc_link_option( 'http://support.hogash.com/documentation/setting-up-blog/', array(
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
));

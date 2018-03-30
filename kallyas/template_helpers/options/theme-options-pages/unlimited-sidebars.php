<?php
/**
 * Theme options > General Options  > Favicon options
 */

/*--------------------------------------------------------------------------------------------------
	Sidebar Generator
	--------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------
    Unlimited Sidebars
--------------------------------------------------------------------------------------------------*/
// Unlimited Sidebars

$admin_options[] = array(
    'slug'          => 'unlimited_sidebars', // subpage
    'parent'        => 'unlimited_sidebars', // master page
    'id'            => 'unlimited_sidebars',
    'name'          => 'Unlimited Sidebars',
    'description'   => 'Here you can create unlimited sidebars that you can use all over the theme.',
    'type'          => 'group',
    'sortable'      => false,
    'element_title' => 'sidebar_name',
    'subelements'   => array(
                            array(
                                'id'          => 'sidebar_name',
                                'name'        => 'Sidebar Name',
                                'description' => 'Please enter a name for this sidebar. Please note that the name should only contain alphanumeric characters',
                                'type'        => 'text',
                                'supports'    => 'block'
                            ),
                    )
);


$admin_options[] = array (
    'slug'          => 'unlimited_sidebars', // subpage
    'parent'        => 'unlimited_sidebars', // master page
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "usbo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#M7TcpipwAKw', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'unlimited_sidebars',
    'parent'      => 'unlimited_sidebars'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'unlimited_sidebars',
    'parent'      => 'unlimited_sidebars',
));

// Sidebars settings
$sidebar_options = array( 'right_sidebar' => 'Right sidebar' , 'left_sidebar' => 'Left sidebar' , 'no_sidebar' => 'No sidebar' );
$admin_options[] = array(
    'slug'        => 'sidebar_settings',
    'parent'      => 'unlimited_sidebars',
    'id'          => 'archive_sidebar',
    'name'        => 'Sidebar on archive pages',
    'description' => 'Please choose the sidebar position for the archive pages.',
    'type'        => 'sidebar',
    'class'     => 'zn_full',
    'std'       => array (
        'layout' => 'sidebar_right',
        'sidebar' => 'default_sidebar',
    ),
    'supports'  => array(
        'default_sidebar' => 'defaultsidebar',
        'sidebar_options' => $sidebar_options
    ),
);

$admin_options[] = array(
    'slug'        => 'sidebar_settings',
    'parent'      => 'unlimited_sidebars',
    'id'          => 'blog_sidebar',
    'name'        => 'Sidebar on Blog',
    'description' => 'Please choose the sidebar position for the blog page.',
    'type'        => 'sidebar',
    'class'     => 'zn_full',
    'std'       => array (
        'layout' => 'sidebar_right',
        'sidebar' => 'default_sidebar',
    ),
    'supports'  => array(
        'default_sidebar' => 'defaultsidebar',
        'sidebar_options' => $sidebar_options
    ),
);

$admin_options[] = array(
    'slug'        => 'sidebar_settings',
    'parent'      => 'unlimited_sidebars',
    'id'          => 'single_sidebar',
    'name'        => 'Sidebar on single blog post',
    'description' => 'Please choose the sidebar position for the single blog posts.',
    'type'        => 'sidebar',
    'class'     => 'zn_full',
    'std'       => array (
        'layout' => 'sidebar_right',
        'sidebar' => 'default_sidebar',
    ),
    'supports'  => array(
        'default_sidebar' => 'defaultsidebar',
        'sidebar_options' => $sidebar_options
    ),
);

$admin_options[] = array(
    'slug'        => 'sidebar_settings',
    'parent'      => 'unlimited_sidebars',
    'id'          => 'page_sidebar',
    'name'        => 'Sidebar on pages',
    'description' => 'Please choose the sidebar position for the pages.',
    'type'        => 'sidebar',
    'class'     => 'zn_full',
    'std'       => array (
        'layout' => 'sidebar_right',
        'sidebar' => 'default_sidebar',
    ),
    'supports'  => array(
        'default_sidebar' => 'defaultsidebar',
        'sidebar_options' => $sidebar_options
    ),
);

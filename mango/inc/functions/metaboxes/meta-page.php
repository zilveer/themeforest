<?php
//global $mango_sidebar;
$meta_boxes[ ] = array (
// Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'page_options',
// Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __ ( 'Page Options', 'mango' ),
// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array ( 'page' ),
// Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',
// Order of meta box: high (default), low. Optional.
    'priority' => 'high',
// Auto save: true, false (default). Optional.
    'autosave' => true,
// List of meta fields
    'fields' => array (
//Blog Template Options
// HEADING
        array (
            'type' => 'heading',
            'name' => __ ( 'Blog Page Options (Use in Blog template)<br /><small>Note: If this page is not selected for front page as Your latest posts under Settings -> Reading </small>', 'mango' ),
            'id' => 'blog_page_heading',
        ),
        array(
            'name' => __ ( 'Blog Page Type', 'mango' ),
            'id' => "{$prefix}blog_type",
            'type' => 'select_advanced',
            'options' => array (
                'classic' => __('Classic(Default)',"mango"),
                'timeline' => __('Timeline',"mango"),
                "blog-masonry"=>__("Blog Masonry","mango"),
                "blog-list" => __("Blog List","mango")
            ),
            'std' => 'classic'
        ),
        array(
            'id'=>"{$prefix}blog_masonry_columns",
            'type' => 'image_select',
            'name' => __('Select Blog Masonry Columns',"mango"),
            'options' => array(
			
				'' => mango_uri . '/images/default/default.png',
                '2' => mango_uri.'/images/default/2col.png',
                '3' => mango_uri.'/images/default/3col.png',
                '4' => mango_uri.'/images/default/4col.png',
                '5'=> mango_uri.'/images/default/5col.png',
                '6'=> mango_uri.'/images/default/6col.png',
            ),
            'std' => '3',
            'desc' => __("Used in Blog Masonry Only","mango")
        ),
        array (
            'name' => __ ( 'Posts Per Page', 'mango' ),
            'id' => "{$prefix}no_of_posts",
            'type' => 'number',
            'desc' => 'input posts per page number'
        ),
        array (
            'name' => __ ( 'Exclude posts', 'mango' ),
            'id' => "{$prefix}exclude_posts",
            'type' => 'text',
            'desc' => 'input ids comma seperated'
        ),
        array (
            'name' => __ ( 'Show Excerpt', 'mango' ),
            'id' => "{$prefix}blog_excerpt",
            'type' => 'select_advanced',
            'options' => array (
                '' => __ ( 'Use Default', 'mango' ),
                '1' => __ ( 'Show Excerpt', 'mango' ),
            ),
        ),
        array (
            'name' => __ ( 'Excerpt Length', 'mango' ),
            'id' => "{$prefix}blog_excerpt_length",
            'type' => 'number',
            'desc' => 'The number of words',
            'std' => '0'
        ),
        array (
            'name' => __ ( 'Blog Post Title', 'mango' ),
            'id' => "{$prefix}hide_blog_post_title",
            'type' => 'select_advanced',
            'options' => array (
                '' => __ ( 'Use Default', 'mango' ),
                '1' => __ ( 'Hide Blog Post Title', 'mango' ),
            ),
            //   'std' => '',
        ),
        array (
            'name' => __ ( 'Excerpt Type', 'mango' ),
            'id' => "{$prefix}excerpt_type",
            'type' => 'select_advanced',
            'options' => array (
                '' => __ ( 'Use Default', 'mango' ),
                'text' => __ ( 'Text', 'mango' ),
                'html' => __ ( 'HTML', 'mango' ),
            ),
        //   'std' => '',
        ),
        array (
            'name' => __ ( 'Blog Posts Author Name', 'mango' ),
            'id' => "{$prefix}hide_blog_post_author",
            'type' => 'select_advanced',
            'options' => array (
                '' => __ ( 'Use Default', 'mango' ),
                '1' => __ ( 'Hide Blog Posts Author Name', 'mango' ),
            ),
        ),
        array (
            'name' => __ ( 'Blog Posts Category', 'mango' ),
            'id' => "{$prefix}hide_blog_post_category",
            'type' => 'select_advanced',
            'options' => array (
                '' => __ ( 'Use Default', 'mango' ),
                '1' => __ ( 'Hide Blog Posts Category', 'mango' ),
            ),
        ),
        array (
            'name' => __ ( 'Blog Posts Tags', 'mango' ),
            'id' => "{$prefix}hide_blog_post_tags",
            'type' => 'select_advanced',
            'options' => array (
                '' => __ ( 'Use Default', 'mango' ),
                '1' => __ ( 'Hide Blog Posts Tags', 'mango' ),
            ),
        ),
        array (
            'name' => __ ( 'pagination Type', 'mango' ),
            'id' => "{$prefix}blog_pagination_type",
            'type' => 'select_advanced',
            'options' => array (
                '' => __ ( 'Use Default', 'mango' ),
                'pagination' => 'Pagination',
                'infinite_scroll' => 'Infinite Scroll',
            ),
        ),
        //portfolio archive page options
        array (
            'type' => 'heading',
            'name' => __ ( 'Portfolio Page Options (Use in Portfolio template)', 'mango' ),
            'id' => 'portfolio_page_heading',
        ),
        array(
            'name' => __ ( 'Portfolio Page Style', 'mango' ),
            'id' => "{$prefix}portfolio_page_style",
            'type' => 'select_advanced',
            'options' => array (
                '' => __('Use Default',"mango"),
                'grid' => __('Grid',"mango"),
                "masonry"=>__("Masonry","mango"),
            ),
            'std' => ''
        ),
        array(
            'name' => __ ( 'Portfolio Style', 'mango' ),
            'id' => "{$prefix}portfolio_style",
            'type' => 'select_advanced',
            'options' => array (
                '' => __('Use Default (From Theme Options)',"mango"),
                'default' => __('Default','mango'),
                'simple'  => __('Simple','mango'),
                'custom'  => __('Custom','mango'),
            ),
            'std' => ''
        ),
        array(
            'name' => __ ( 'Use Portfolio Full Width', 'mango' ),
            'id' => "{$prefix}portfolio_full_width",
            'type' => 'select_advanced',
            'options' => array (
                '' => __('Use Default (From Theme Options)',"mango"),
                'yes' => __('Yes','mango'),
                'no'  => __('No','mango'),
            ),
            'std' => '',
            'desc' => __('If this option is enabled then the sidebars will not work','mango'),
        ),
        array(
            'name' => __ ( 'Portfolio Columns', 'mango' ),
            'id'=>"{$prefix}portfolio_columns",
            'type' => 'image_select',
            'options' => array(
				'' => mango_uri . '/images/default/default.png',
                '2' => mango_uri.'/images/default/2col.png',
                '3' => mango_uri.'/images/default/3col.png',
                '4' => mango_uri.'/images/default/4col.png',
                '5'=> mango_uri.'/images/default/5col.png',
                '6'=> mango_uri.'/images/default/6col.png',
            ),
        ),
        //contact page options
        array (
            'type' => 'heading',
            'name' => __ ( 'Contact Page Options (Use in Contact template)', 'mango' ),
            'id' => 'contact_page_heading',
        ),
        array (
            'name' => __ ( 'Contact Page Version', 'mango' ),
            'id' => "{$prefix}contact_page_version",
            'type' => 'select_advanced',
            'options' => array (
                '1' => "Version 1",
                '2' => "Version 2",
                '3' => "Version 3",
                '4' => "Version 4",
            ),
        ),
        array(
            'name' => __( 'Address', 'reviver' ),
            'id'   => "{$prefix}contact_address",
            'type' => 'wysiwyg',
            // Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
            'raw'  => false,
            'std' => '<h3>Company address</h3><address>8808 Ave Dermentum, Onsectetur Adipiscing<br>Tortor Sagittis, CA 880986,<br>United States<br>CA 90896,<br>United States</address>',
            // Editor settings, see wp_editor() function: look4wp.com/wp_editor
            'options' => array(
                'textarea_rows' => 4,
                'teeny'         => false,
                'media_buttons' => false,
            ),
        ),
        array(
            'name' => __( 'Contact Information', 'reviver' ),
            'id'   => "{$prefix}contact_info",
            'type' => 'wysiwyg',
            // Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
            'raw'  => false,
            'std' => '<h3>Contact Informations</h3><address>Email: stores@domain.com<br>Toll-free: (1800) 000 8808</address>',
            // Editor settings, see wp_editor() function: look4wp.com/wp_editor
            'options' => array(
                'textarea_rows' => 4,
                'teeny'         => false,
                'media_buttons' => false,
            ),
        ),
        array(
            'name' => __( 'Contact Message', 'reviver' ),
            'id'   => "{$prefix}contact_message",
            'type' => 'wysiwyg',
            // Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
            'raw'  => false,
            'std' => "<h2 class='regular-title short'>Let's Stay in Touch</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.</p>",
            'options' => array(
                'textarea_rows' => 4,
                'teeny'         => false,
                'media_buttons' => false,
            ),
        ),
        //contact page options
        array (
            'type' => 'heading',
            'name' => __ ( 'Coming Soon Page Options.(Used in Coming Soon Template)', 'mango' ),
            'id' => 'coming_soon_page_heading',
            'desc' => __('To activate a particular page as coming soon go to theme settings > Page','mango')
        ),
        array (
            'name' => __ ( 'Coming Soon Page Version', 'mango' ),
            'id' => "{$prefix}coming_soon_page_version",
            'type' => 'select_advanced',
            'options' => array (
                '1' => "Version 1",
                '2' => "Version 2",
            ),
            'std' => '1'
        ),
        array(
            'name' => __( 'Coming Soon Date Time', 'mango' ),
            'id'   => "{$prefix}coming_soon_datetime",
            'type' => 'datetime',
            'placeholder' => __('Select Date Time','mango')
        ),
        array(
            'name' => __( 'Coming Soon Background Image', 'mango' ),
            'id'   => "{$prefix}coming_soon_bg_image",
            'type' => 'image_advanced',
            'max_file_uploads' => 1,
             'desc' => __('Only required when the coming soon page version is 1','mango'),
        ),
        array(
            'name' => __( 'Coming Soon Text After Timer', 'mango' ),
            'id'   => "{$prefix}coming_soon_after_timer",
            'type' => 'wysiwyg',
            // Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
            'raw'  => false,
            'options' => array(
                'textarea_rows' => 4,
                'teeny'         => false,
                'media_buttons' => true,
            ),
        ),
 )
);
?>
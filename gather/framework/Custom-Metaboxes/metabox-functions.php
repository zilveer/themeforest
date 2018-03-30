<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cththeme_gather_cmb_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cththeme_gather_cmb_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes[] = array(
		'id'         => 'post_options',
		'title'      => 'Post Options',
		'pages'      => array('post'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
            array(
                'name' => 'oEmbed for Post Format',
                'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
                'id'   => $prefix . 'embed_video',
                'type' => 'oembed',
            ),
           // array(
           //      'name' => 'Post Subtitle',
           //      'desc' => 'Post Subtitle show in header section',
           //      'id'   => $prefix . 'post_subtitle',
           //      'type' => 'textarea_small',
           //  ),
           // array(
           //      'name' => 'Post width',
           //      'desc' => 'Post width in blog list layout',
           //      'id'   => $prefix . 'post_width',
           //      'type'    => 'select',
           //      'options' => array(
           //          'half' => __( 'Half Size', 'cmb' ),
           //          'short' => __( 'Short Size', 'cmb' ),
           //          'full' => __( 'Full Size', 'cmb' ),
           //      ),
           //      'default'=>'half',
           //  ),
            // array(
            //     'name'    => 'Centered Layout',
            //     'desc'    => 'Set this to Yes if you want to use content fullwidth centered layout instead of 70% width in left side.',
            //     'id'      => $prefix . 'fullwidth_layout',
            //     'type'    => 'select',
            //     'options' => array(
            //         'no' => __( 'No', 'cmb' ),
            //         'yes'   => __( 'Yes', 'cmb' ),
                    
            //     ),
            //     'default' => 'no',
            // ),
            array(
                'name' => 'Header Subtitle',
                'desc' => '',
                'id'   => $prefix . 'single_header_subtitle',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Single Layout', 'cmb' ),
                'desc' => __( 'Choose display layout for this post', 'cmb' ),
                'id' => $prefix . 'single_layout',
                'type' => 'select',
                'options' => array(
                    'right_sidebar' => __( 'Right Sidebar', 'cmb' ),
                    'fullwidth' => __( 'Fullwidth', 'cmb' ),
                  
                    'left_sidebar' => __( 'Left Sidebar', 'cmb' ),
                    //'domik' => __( 'Domik Style', 'cmb' ),
                  ),
                'default' =>'right_sidebar',
            ),
		),
	);

    $meta_boxes[] = array(
        'id'         => 'portfolio_single_fields',
        'title'      => 'Portfolio Single Page Options',
        'pages'      => array('portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => __( 'Single Style', 'cmb' ),
                'desc' => __( 'Select style for this portfolio to display from front-end', 'cmb' ),
                'id' => $prefix . 'single_style',
                'type' => 'select',
                'options' => array(
                    'style-1' => __( 'Style 1', 'cmb' ),
                    'style-2' => __( 'Style 2', 'cmb' ),
                    'style-3' => __( 'Style 3', 'cmb' ),
                    'style-4' => __( 'Style 4', 'cmb' ),
                    'style-5' => __( 'Style 5', 'cmb' ),
                    'style-6' => __( 'Style 6', 'cmb' ),
                    //'style-7' => __( 'Style 7', 'cmb' ),
                ),
                'default' =>'style-1',
            ),
            array(
                'name' => 'Portfolio Subtitle',
                'desc' => '',
                'default' => '',
                'id' => $prefix . 'folio_subtitle',
                'type' => 'textarea_code'
            ),
            array(
                'name' => 'Portfolio Image',
                'desc' => 'This image will be used in Portfolio single style 1 and style 5 as the right parallax image. Or in Portfolio style 4 as video background image for mobile device.',
                'id'   => $prefix . 'right_parallax_bg',
                'type' => 'file',
            ),
            array(
                'name' => 'Portfolio Video or Audio Link',
                'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.<br>
                            This link will be used in Portfolio single style 1 and style 5 as main video or in portfolio single style 4 as video background. Note: for style 4 just enter Youtube video link only.',
                'id'   => $prefix . 'embed_video',
                'type' => 'oembed',
            ),

        )
    );

    $meta_boxes[] = array(
        'id'         => 'portfolio_single_fields',
        'title'      => 'Portfolio Single Page Options',
        'pages'      => array('member'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            // array(
            //     'name' => __( 'Single Style', 'cmb' ),
            //     'desc' => __( 'Select style for this portfolio to display from front-end', 'cmb' ),
            //     'id' => $prefix . 'single_style',
            //     'type' => 'select',
            //     'options' => array(
            //         'style-1' => __( 'Style 1', 'cmb' ),
            //         'style-2' => __( 'Style 2', 'cmb' ),
            //         'style-3' => __( 'Style 3', 'cmb' ),
            //         'style-4' => __( 'Style 4', 'cmb' ),
            //         'style-5' => __( 'Style 5', 'cmb' ),
            //         'style-6' => __( 'Style 6', 'cmb' ),
            //         //'style-7' => __( 'Style 7', 'cmb' ),
            //     ),
            //     'default' =>'style-1',
            // ),
            // array(
            //     'name' => 'Portfolio Subtitle',
            //     'desc' => '',
            //     'default' => '',
            //     'id' => $prefix . 'folio_subtitle',
            //     'type' => 'textarea_code'
            // ),
            // array(
            //     'name' => 'Portfolio Image',
            //     'desc' => 'This image will be used in Portfolio single style 1 and style 5 as the right parallax image. Or in Portfolio style 4 as video background image for mobile device.',
            //     'id'   => $prefix . 'right_parallax_bg',
            //     'type' => 'file',
            // ),
            // array(
            //     'name' => 'Portfolio Video or Audio Link',
            //     'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.<br>
            //                 This link will be used in Portfolio single style 1 and style 5 as main video or in portfolio single style 4 as video background. Note: for style 4 just enter Youtube video link only.',
            //     'id'   => $prefix . 'embed_video',
            //     'type' => 'oembed',
            // ),

            array(
                'name' => 'Job Description',
                'desc' => 'Job Description',
                'id'   => $prefix . 'mem_job',
                'type' => 'textarea',
            ),

        )
    );
    
    $meta_boxes[] = array(
        'id'         => 'masonry_fields',
        'title'      => 'Portfolio Masonry Options',
        'pages'      => array('portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => __( 'Masonry Size', 'cmb' ),
                'desc' => __( 'Choose the size of item thumbnail that show in portfolio list. You must select a Feature image for this portfolio item.', 'cmb' ),
                'id' => $prefix . 'masonry_size',
                'type' => 'select',
                'options' => array(
                  'one' => __( 'Size One', 'cmb' ),
                  'one-tall' => __( 'Size One - Two Tall', 'cmb' ),
                  'second' => __( 'Size Two', 'cmb' ),
                  'three' => __( 'Size Three', 'cmb' ),
                  ),
                'default' =>'one',
            ),

        )
    );

    

    $meta_boxes[] = array(
        'id'         => 'seo_fields',
        'title'      => 'SEO Fields',
        'pages'      => array('story'), // Post type
        'context'    => 'normal',
        'priority'   => 'core',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => 'Story Date',
                'desc' => 'Story Date',
                'type' => 'text',
                'id' => $prefix . 'story_date'
            ),
            array(
                'name'    => 'Additional Info Type',
                'desc'    => 'Select an additional info type to show.',
                'id'      => $prefix . 'show_info_type',
                'type'    => 'select',
                'options' => array(
                    'gallery' => __( 'Gallery Images', 'cmb' ),
                    'video'   => __( 'Video', 'cmb' ),
                    'none'     => __( 'None', 'cmb' ),
                ),
                'default' => 'none',
            ),
            array(
                'name' => 'Gallery Images for Gallery info',
                'desc' => '',
                'id' => $prefix . 'gallery_images',
                'type' => 'file_list',
                // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
            ),

            array(
                'name' => 'Enter Video Link for Video info',
                'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
                'id'   => $prefix . 'embed_video',
                'type' => 'oembed',
            ),
            

        )
    );

    $meta_boxes[] = array(
        'id'         => 'domik-page-fields',
        'title'      => 'Page Extra Fields',
        'pages'      => array( 'page'), // Post type
        'context'    => 'normal',
        'priority'   => 'core',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            // array(
            //     'name' => 'Page Description',
            //     'desc' => 'Page Description that display after page title',
            //     'default' => '<h3><span>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true .</span></h3>',
            //     'id' => $prefix . 'page_description',
            //     'type' => 'textarea'
            // ),

            
            // array(
            //     'name' => 'Right Parallax Background',
            //     'desc' => 'Select rotate background for this page. Will override the option from Theme Options panel.',
            //     'id'   => $prefix . 'right_parallax_bg',
            //     'type' => 'file',
            // ),
            // array(
            //     'name' => 'Rotate Background',
            //     'desc' => 'Select rotate background for this page. Will override the option from Theme Options panel.',
            //     'id'   => $prefix . 'rotate_bg',
            //     'type' => 'file',
            // ),

            

            // array(
            //     'name' => 'Test Taxonomy Select',
            //     'desc' => 'Description Goes Here',
            //     'id' => $prefix . 'portfolio_categories',
            //     'taxonomy' => 'skill', //Enter Taxonomy Slug
            //     'type' => 'taxonomy_select',    
            // ),

            array(
                'name' => 'Header Subtitle',
                'desc' => '',
                'id'   => $prefix . 'single_header_subtitle',
                'type' => 'text',
            ),
            array(
                'name'    => 'Navigation Type',
                'desc'    => '',
                'id'      => $prefix . 'navigation_type',
                'type'    => 'select',
                'options' => array(
                    'sticky' => __( 'Sticky', 'cmb' ),
                    'reveal'   => __( 'Reveal', 'cmb' ),
                    'static'   => __( 'Static', 'cmb' ),
                    
                ),
                'default' => 'sticky',
            ),
            
        )
    );

    
    
    // $meta_boxes[] = array(
    //     'id'         => 'portfolio_page',
    //     'title'      => 'Portfolio Page Template Fields',
    //     'pages'      => array('page'), // Post type
    //     'context'    => 'normal',
    //     'priority'   => 'core',
    //     'show_names' => true, // Show field names on the left
    //     'fields' => array(
    //        array(
    //             'name' => 'Portfolio Categories',
    //             'desc' => 'Select portfolio categories to get items from. For Portfolio page templates only.',
    //             'id' => $prefix . 'portfolio_categories',
    //             'taxonomy' => 'skill', //Enter Taxonomy Slug
    //             'type' => 'taxonomy_multicheck',    
    //         ),
    //     )
    // );

	// $meta_boxes[] = array(
	// 	'id'         => 'seo_fields',
	// 	'title'      => 'SEO Fields',
	// 	'pages'      => array( 'page', 'post','portfolio'), // Post type
	// 	'context'    => 'normal',
 //        'priority'   => 'core',
 //        'show_names' => true, // Show field names on the left
	// 	//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
	// 	'fields' => array(
	// 		array(
	// 			'name' => 'SEO title',
	// 			'desc' => 'Title for SEO (optional)',
	// 			'id'   => $prefix . 'seo_title',
	// 			'type' => 'text',
	// 		),
 //            array(
 //                'name' => 'SEO Keywords',
 //                'desc' => 'SEO keywords (optional)',
 //                'id'   => $prefix . 'seo_keywords',
 //                'type' => 'text',
 //            ),
 //            array(
 //                'name' => 'SEO Description',
 //                'desc' => 'SEO description (optional)',
 //                'id'   => $prefix . 'seo_description',
 //                'type' => 'text',
 //            ),
	// 	)
	// );

	


	/**
	 * Metabox for the user profile screen
	 */
	$meta_boxes['user_edit'] = array(
		'id'         => 'user_edit',
		'title'      => __( 'User Profile Metabox', 'cmb' ),
		'pages'      => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names' => true,
		'cmb_styles' => false, // Show cmb bundled styles.. not needed on user profile page
		'fields'     => array(
			array(
				'name'     => __( 'Extra Info', 'cmb' ),
				'desc'     => __( 'field description (optional)', 'cmb' ),
				'id'       => $prefix . 'exta_info',
				'type'     => 'title',
				'on_front' => false,
			),
			array(
				'name'    => __( 'Avatar', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'avatar',
				'type'    => 'file',
				'save_id' => true,
			),
			array(
				'name' => __( 'Facebook URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'facebookurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Twitter URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'twitterurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Google+ URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'googleplusurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Linkedin URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'linkedinurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'User Field', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'user_text_field',
				'type' => 'text',
			),
		)
	);

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb_metabox_form` helper function. See wiki for more info.
	 */
	$meta_boxes['options_page'] = array(
		'id'      => 'options_page',
		'title'   => __( 'Theme Options Metabox', 'cmb' ),
		'show_on' => array( 'key' => 'options-page', 'value' => array( $prefix . 'theme_options', ), ),
		'fields'  => array(
			array(
				'name'    => __( 'Site Background Color', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'bg_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
		)
	);
	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cththeme_gather_cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cththeme_gather_cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}

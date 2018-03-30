<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'RECIPE_META_';

global $meta_boxes;

$meta_boxes = array();


// Metabox for additional recipe information
$meta_boxes[] = array(
	'id'		=> 'recipe_additional',
	'title'		=> __('Recipe Information', 'woothemes'),
	'pages'		=> array( 'recipe' ),
	'priority' => 'low',
	'fields'	=> array(
 	      array(
            'name'      => __('Video Embed', 'woothemes'),
            'id'        => $prefix . 'video_embed_top',
            'desc'      => __('Insert your video embed code here.', 'woothemes'),
            'type'      => 'textarea',
            'std'       => ''
        ),
		array(
			'name'	=> __('Attach Images slider', 'woothemes'),
			'desc'	=> __('Upload images related to this this recipe. These Images will appear in slider on recipe page.', 'woothemes'),
			'id'	=> "{$prefix}more_images_recipe",
			'type'	=> 'plupload_image'
		),
		array(
			'name'		=> __('Yield', 'woothemes'),
			'id'		=> $prefix . 'yield',
			'desc'		=> __('How much/many does this recipe produce ?', 'woothemes'),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Servings', 'woothemes'),
			'id'		=> $prefix . 'servings',
			'desc'		=> __('How many servings?', 'woothemes'),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Prep Time', 'woothemes'),
			'id'		=> $prefix . 'prep_time',
			'desc'		=> __('How Many Minutes ?   ', 'woothemes'),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Cook Time', 'woothemes'),
			'id'		=> $prefix . 'cook_time',
			'desc'		=> __('How Many Minutes ?   ', 'woothemes'),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Ready In', 'woothemes'),
			'id'		=> $prefix . 'ready_in',
			'desc'		=> __('How Many Minutes ?   ', 'woothemes'),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Ingredients', 'woothemes'),
			'id'		=> $prefix . 'ingredients',
			'desc'		=> __('You can add list of ingredients here. To display the list you need to write [ingredients] short code in your content editor.', 'woothemes'),
			'clone'		=> true,
			'type'		=> 'text',
			'std'		=> ''
		)



	)
);

// Metabox for step information
$meta_boxes[] = array(

	'id' => 'method',
	'title' => __('Method', 'woothemes'),
	'pages' => array( 'recipe' ),
	'context' => 'normal',
	'priority' => 'high',
	'priority' => 'low',
	'fields' => array(
        array(
            'name'      => __('Video Embed', 'woothemes'),
            'id'        => $prefix . 'video_embed_method',
            'desc'      => __('Insert your video embed code here.', 'woothemes'),
            'type'      => 'textarea',
            'std'       => ''
        ),
 		array(
			'name'	=> __('Attach Images method slider', 'woothemes'),
			'desc'	=> __('Upload images related to this this recipe. These Images will appear in how to slider on recipe single post.', 'woothemes'),
			'id'	=> "{$prefix}images_method",
			'type'	=> 'plupload_image'
		),
		array(
			'name'		=> __('Method Steps', 'woothemes'),
			'id'		=> $prefix . 'method_steps',
			'desc'		=> __('You can add info image list of recipe method steps here.', 'woothemes'),
			'clone'		=> true,
			'type'		=> 'textarea',
			'std'		=> ''
		)
	)
);
// Metabox for nutritional information
$meta_boxes[] = array(

	'id' => 'nutritional',
	'title' => __('Nutritional Information: (Optional ) leaving it empty will not display Nutritional Info Box on Front End.', 'woothemes'),
	'pages' => array( 'recipe' ),
	'context' => 'normal',
	'priority' => 'high',
	'priority' => 'low',
	'fields' => array(
		array(
			'name'		=> __('Nutrient Name', 'woothemes'),
			'id'		=> $prefix . 'nut_name',
			'desc'		=> __('Enter the name of nutritional Item Name', 'woothemes'),
			'clone'		=> true,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Mass', 'woothemes'),
			'id'		=> $prefix . 'nut_mass',
			'desc'		=> __('Enter Nutrient Mass', 'woothemes'),
			'clone'		=> true,
			'type'		=> 'text',
			'std'		=> ''
		)
	)
);

/* ********************************************************* */
/* Header options                                            */
/* ********************************************************* */

$url = RWMB_URL . 'img/metaboxui/';

// Options Rev Slider & Layer Slider
$rev_sliders = array('none' => __('None', 'woothemes'));

if (class_exists('RevSlider')) {

    $rev = new RevSlider();

    $arrSliders = $rev->getArrSliders();
    foreach ((array) $arrSliders as $revSlider) {
        $rev_sliders[$revSlider->getAlias()] = $revSlider->getTitle();
    }
}

$meta_boxes[] = array(
    'title'     => __('Header Settings', 'woothemes'),
    'pages'     => array('page', 'post', 'product', 'recipe'),
    'context'   => 'normal',
    'priority'  => 'high',
    'autosave'  => true,
    'fields'    => array(
        array(
            'name'      => __('Header Style', 'woothemes'),
            'id'        => "df_metabox_header_style",
            'type'      => 'image_select',
            'options'   => array(
                                 'show'     => $url . 'show-title.png',
                                 'hide'     => $url . 'hide-title.png',
                                 'fancy'    => $url . 'fancy-title.png',
                                 'slider'   => $url . 'slideshow.png',
                           ),
            'std'       => 'show'
        ),
        array(
            'name'      => __('Header Alignment', 'woothemes'),
            'id'        => "df_metabox_header_align",
            'type'      => 'image_select',
            'options'   => array(
                                 'left'     => $url . 'fancy-align-left.png',
                                 'right'    => $url . 'fancy-align-right.png',
                                 'center'   => $url . 'fancy-align-center.png'
                           ),
            'std'       => 'left'
        ),
        array(
            'name'      => __('Title', 'woothemes'),
            'id'        => "df_metabox_title",
            'type'      => 'text',
            'std'       => ''
        ),
        array(
            'name'      => __('Title Color', 'woothemes'),
            'id'        => "df_metabox_title_color",
            'type'      => 'color'
        ),
        array(
            'name'      => __('Subtitle', 'woothemes'),
            'id'        => "df_metabox_subtitle",
            'type'      => 'text',
            'std'       => ''
        ),
        array(
            'name'      => __('Subtitle Color', 'woothemes'),
            'id'        => "df_metabox_subtitle_color",
            'type'      => 'color'
        ),
        array(
            'name'      => __('Background Options', 'woothemes'),
            'id'        => "df_metabox_background_options",
            'type'      => 'radio',
            'options'   => array(
                                 'normal'   => __('Normal Background', 'woothemes'),
                                 'parallax' => __('Parallax Background', 'woothemes'),
                           ),
            'std'       => 'normal'
        ),
        array(
            'name'      => __('Background Color', 'woothemes'),
            'id'        => "df_metabox_background_color",
            'type'      => 'color'
        ),
        array(
            'name'      => __('Upload Image', 'woothemes'),
            'id'        => "df_metabox_upload_image_fancy_title",
            'type'      => 'file_advanced',
            'max_file_uploads' => 4,
            'mime_type' => 'image'
        ),
        array(
            'name'      => __('Repeat Options', 'woothemes'),
            'id'        => "df_metabox_repeat_options",
            'type'      => 'select',
            'options'   => array(
                                'repeat'    => 'Repeat',
                                'repeat-x'  => 'Repeat X',
                                'repeat-y'  => 'Repeat Y',
                                'no-repeat' => 'No-Repeat',
                           ),
            'std'       => 'no-repeat'
        ),
        array(
            'name'      => __('Repeat X', 'woothemes'),
            'id'        => "df_metabox_repeat__",
            'type'      => 'select',
            'options'   => array(
                                'left'      => 'Left',
                                'right'     => 'Right',
                                'center'    => 'Center',
                           ),
            'std'       => 'center'
        ),
        array(
              'name' => __('Repeat Y', 'woothemes'),
              'id' => "df_metabox_repeat_y",
              'type' => 'select',
              'options' => array(
                                 'left' => 'Left',
                                 'right' => 'Right',
                                 'center' => 'Center',
                                 ),
              'std' => 'center'
              ),
        array(
              'name' => __('Parallax speed', 'woothemes'),
              'id' => "df_metabox_fancy_parallax_speed",
              'type' => 'text',
              'std' => ''
              ),
        array(
              'name' => __('Height (px)', 'woothemes'),
              'id' => "df_metabox_header_height_setting",
              'type' => 'text',
              'std' => ''
              ),
        array(
              'name' => __('Enable Header Border', 'woothemes'),
              'id' => "df_metabox_header_border",
              'type' => 'checkbox',
              'std' => 1
              ),
        array(
              'name' => __('Header Border Color Settings', 'woothemes'),
              'id' => "df_metabox_header_border_color_setting",
              'type' => 'color'
              ),
        // Slider Options
        array(
              'name' => __('Slider Options', 'woothemes'),
              'id' => "df_metabox_slider_options",
              'type' => 'image_select',
              'options' => array(
                                 'rev' => $url . 'slideshow-rev.png'

                                 ),
              'std' => 'rev'
              ),
        // Revolution slider
        array(
              'name' => __('Choose slider', 'woothemes'),
              'id' => "df_metabox_revolution_slider",
              'type' => 'select',
              'std' => 'none',
              'options' => $rev_sliders,
              'multiple' => false
              ),

        )
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function RECIPE_META_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded
//  before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'RECIPE_META_register_meta_boxes' );


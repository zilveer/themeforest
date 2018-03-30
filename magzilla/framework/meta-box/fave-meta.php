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
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'fave_';

global $meta_boxes;

$meta_boxes = array();


/* ===========================================================================================
*   Post Meta
* =============================================================================================*/

$meta_boxes[] = array(
    'id' => 'fave_format_gallery',
    'title' => 'Gallery Format',
    'pages' => array( 'post' ),
    'context' => 'normal',
    'priority' => 'high',

    'fields' => array(
        array(
            'name' => 'Upload Gallery Images: ',
            'desc' => '',
            'id' => $prefix . 'gallery_posts',
            'type' => 'image_advanced',
            'std' => ''
        )
    )
);

$meta_boxes[] = array(
    'id' => 'fave_format_video',
    'title' => 'Video Format',
    'pages' => array( 'post' ),
    'context' => 'normal',
    'priority' => 'high',

    'fields' => array(
        array(
            'name' => 'Add video page url: ',
            'desc' => '',
            'id' => $prefix . 'video_post',
            'type' => 'oembed',
            'std' => '',
            'desc'  => ' - For exmaple https://vimeo.com/121236335'
        ),
        array(
            'name'  => 'Video Embed Code',
            'id'    => $prefix . 'video_embed',
            'type'  => 'textarea',
            'desc'  => 'It will overwite video url option'
        ),
    )
);

$meta_boxes[] = array(
    'id' => 'fave_format_audio',
    'title' => 'Audio Format',
    'pages' => array( 'post' ),
    'context' => 'normal',
    'priority' => 'high',

    'fields' => array(
        array(
            'name' => 'Add SoundCloud Audio: ',
            'desc' => '',
            'id' => $prefix . 'audio_post',
            'type' => 'text',
            'std' => '',
            'desc'  => ' - Paste page URL from SoundCloud'
        )
    )
);


/* ===========================================================================================
*   Custom post type video
* =============================================================================================*/

$meta_boxes[] = array(
    'id' => 'fave_custom_post_video',
    'title' => 'Video Options',
    'pages' => array( 'video' ),
    'context' => 'normal',
    'priority' => 'high',

    'fields' => array(
        array(
            'name' => 'Featured Video?',
            'id'   => $prefix . 'video_featured',
            'type' => 'checkbox',
            'desc' => 'Featured Video ?',
            'std'  => 0,
        ),
        array(
            'name'     => 'Video Channel',
            'id'       => $prefix . 'video_channel',
            'type'     => 'select',
            // Array of 'value' => 'Label' pairs for select box
            'options'  => array(
                'vimeo' => 'Vimeo',
                'youtube' => 'Youtube',
                'dailymotion' => 'Dailymotion',
                'embed_code' => 'Embed Code'
            ),
            // Select multiple values, optional. Default is false.
            'multiple' => false,
            'std'   => 'vimeo',
        ),
        array(
            'name'  => 'Video ID',
            'id'    => $prefix . 'video_id',
            'type'  => 'textarea',
            'desc'  => ' - Add only video ID, for exmaple in this url  <br>
                        https://vimeo.com/121236335 you just need to add "121236335" <br>
                        For Dailymotion http://www.dailymotion.com/video/x2b0uid_the-baby-minecraft-animation-game-videos_shortfilms You just need to add x2b0uid_the-baby-minecraft-animation-game-videos_shortfilms'
        ),
        array(
            'name'  => 'Video Duration',
            'id'    => $prefix . 'video_duration',
            'type'  => 'text',
            'desc'  => ' - Add video duration. eg: 5:30'
        ),
    )
);

/* ===========================================================================================
*   Custom post type gallery options
* =============================================================================================*/

$meta_boxes[] = array(
    'id' => 'fave_custom_post_gallery',
    'title' => 'Gallery',
    'pages' => array( 'gallery' ),
    'context' => 'normal',
    'priority' => 'high',

    'fields' => array(
        array(
            'name' => 'Featured Gallery?',
            'id'   => $prefix . 'gallery_featured',
            'type' => 'checkbox',
            'desc' => 'Featured Gallery ?',
            'std'  => 0,
        ),
        array(
            'name'  => 'Gallery Title',
            'id'    => $prefix . 'gallery_title',
            'type'  => 'text',
        ),
        array(
            'name' => 'Upload Gallery Images: ',
            'desc' => '',
            'id' => $prefix . 'gallery_regular_posts',
            'type' => 'image_advanced',
            'std' => ''
        )
    )
);


/* ===========================================================================================
*   Review
* =============================================================================================*/

$meta_boxes[] = array(
    'id' => 'favethemes_review',
    'title' => 'Review System',
    'pages' => array( 'post' ),
    'context' => 'normal',
    'priority' => 'high',

    'fields' => array(
        // Enable Review
        array(
            'name' => 'Featured Post?',
            'id'   => $prefix . 'featured',
            'type' => 'checkbox',
            'desc' => 'Featured Posts ?',
            'std'  => 0,
        ),
        array(
            'name' => 'Include Review Box',
            'id' => $prefix . 'review_checkbox',
            'type' => 'checkbox',
            'desc' => 'Enable Review On This Post',
            'std'  => 0,
        ),
        // Type of review
        array(
            'name'     => 'Type',
            'id'       => $prefix . 'score_display_type',
            'type'     => 'select',
            // Array of 'value' => 'Label' pairs for select box
            'options'  => array(
                'percentage' => 'Percentage',
                /*'stars' => 'Stars',*/
                'points' => 'Points',
            ),
            // Select multiple values, optional. Default is false.
            'multiple' => false,
        ),
        // Location of review
        array(
            'name'     => 'Location',
            'id'       => $prefix . 'placement',
            'type'     => 'select',
            // Array of 'value' => 'Label' pairs for select box
            'options'  => array(
                'top' => 'Top',
                'top-half' => 'Top Half-Width',
                'bottom' => 'Bottom',
            ),
            // Select multiple values, optional. Default is false.
            'multiple' => false,
            'std'   => 'Select a location',
        ),               
       // Sub-title
        array(
            'name'  => 'Heading (optional)',
            'id'    => $prefix . 'heading',
            'type'  => 'text',
        ),
        array(
            'name'  => 'Verdict',
            'id'    => $prefix . 'verdict',
            'type'  => 'text',
            'std' => 'Awesome'
        ),
        // Criteria 1 Text & Score
        array(
            'name'  => 'Criteria 1 Title',
            'id'    => $prefix . 'ct1',
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 1 Score', 'rwmb' ),
            'id' => $prefix . 'cs1',
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 100,
                'step'  => 1,
            ),
        ),
        // Criteria 2 Text & Score
        array(
            'name'  => 'Criteria 2 Title',
            'id'    => $prefix . 'ct2',
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 2 Score', 'rwmb' ),
            'id' => $prefix . 'cs2',
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 100,
                'step'  => 1,
            ),
        ),    
        // Criteria 3 Text & Score
        array(
            'name'  => 'Criteria 3 Title',
            'id'    => $prefix . 'ct3',
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 3 Score', 'rwmb' ),
            'id' => $prefix . 'cs3',
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 100,
                'step'  => 1,
            ),
        ),
        // Criteria 4 Text & Score
        array(
            'name'  => 'Criteria 4 Title',
            'id'    => $prefix . 'ct4',
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 4 Score', 'rwmb' ),
            'id' => $prefix . 'cs4',
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 100,
                'step'  => 1,
            ),
        ),
        // Criteria 5 Text & Score
        array(
            'name'  => 'Criteria 5 Title',
            'id'    => $prefix . 'ct5',
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 5 Score', 'rwmb' ),
            'id' => $prefix . 'cs5',
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 100,
                'step'  => 1,
            ),
        ),    
        // Criteria 6 Text & Score
        array(
            'name'  => 'Criteria 6 Title',
            'id'    => $prefix . 'ct6',
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 6 Score', 'rwmb' ),
            'id' => $prefix . 'cs6',
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 100,
                'step'  => 1,
            ),
        ),
        // Summary
        array(
            'name' => __( 'Verdict Summary', 'rwmb' ),
            'id'   => $prefix . 'summary',
            'type' => 'textarea',
            'cols' => 20,
            'rows' => 3,
        ),
        
        // Final average
        array(
            'name'  => 'Final Average Score',
            'id'    => $prefix . 'final_score',
            'type'  => 'text',
        ),
        // Final average override
        array(
            'name'  => 'Final Score Override',
            'id'    => $prefix . 'final_score_override',
            'type'  => 'text',
        ),        
        
    )
);

$args = array(
'role' => 'author'
);
$authors = get_users();

$authors_array = array();
foreach($authors as $author ) {
   $author_role = implode(', ', $author->roles);
   $authors_array[$author->ID] = $author->display_name.'  -- ( '.$author_role.' )';
}


$meta_boxes[] = array(
    'id'        => 'fave_author_template',
    'title'     => 'Authors Options',
    'pages'     => array( 'page' ),
    'context' => 'normal',

    'fields'    => array(
        array(
            'name'      => 'Exclude Authors',
            'id'        => $prefix . 'exclude_authors',
            'type'      => 'checkbox_list',
            'options'   => $authors_array,
            'multiple'  => true,
            'std'       => array( 'no' ),
            'desc'      => __('Select the agents which you want to exclude from authors page','rwmb'),
        ),

        array(
            'name'      => 'Role',
            'id'        => $prefix . 'authors_role',
            'type'      => 'select',
            'std'       => 'post_count', 
            'options'   => array( '' => 'All', 'administrator' => 'Administrator', 'author' => 'Author', 'editor' => 'Editor', 'contributor' => 'Contributor', 'subscriber' => 'Subscriber'  ),
            'desc'      => '',
        ),

        array(
            'name'      => 'Order By',
            'id'        => $prefix . 'authors_orderby',
            'type'      => 'select',
            'std'       => 'post_count', 
            'options'   => array( 'ID' => 'ID', 'post_count' => 'Post Count', 'display_name' => 'Display Name' ),
            'desc'      => '',
        ),

        array(
            'name'      => 'Order',
            'id'        => $prefix . 'authors_order',
            'type'      => 'select',
            'std'       => 'desc',
            'options'   => array('asc' => 'ASC', 'desc' => 'DESC' ),
            'desc'      => '',
        ),

        array(
            'name'      => 'Number on Authors',
            'id'        => $prefix . 'authors_num',
            'type'      => 'text',
            'std'       => '10',
            'desc'      => '',
        )
    )
);



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function favethemes_register_meta_boxes()
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

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'favethemes_register_meta_boxes' );
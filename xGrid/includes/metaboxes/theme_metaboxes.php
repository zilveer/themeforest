<?php
/**
 *  RW_Meta_Box_Taxonomy
 */
class RW_Meta_Box_Taxonomy extends RW_Meta_Box
{

	function add_missed_values()
    {
		parent::add_missed_values();
		foreach ($this->_meta_box['fields'] as $key => $field)
        {
			if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type'])
            {
				$this->_meta_box['fields'][$key]['multiple'] = true;
			}
		}
	}

	// show taxonomy list
	function show_field_taxonomy($field, $meta)
    {
		global $post;

		if (!is_array($meta)) $meta = (array) $meta;

		$this->show_field_begin($field, $meta);

		$options = $field['options'];
		$terms = get_terms($options['taxonomy'], $options['args']);

		// checkbox_list
		if ('checkbox_list' == $options['type'])
        {
			foreach ($terms as $term) {
				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";
			}
		}
		// select
		else
        {
			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";

			foreach ($terms as $term)
            {
				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";
			}
			echo "</select>";
		}

		$this->show_field_end($field, $meta);
	}
}

/**
 *  Metabox
 */
$prefix = 'bd_';
$meta_boxes = array();

/**
 *  video
 */
$meta_boxes[] = array
(
    'id'                        => 'video_setting',
    'title'                     => 'video Options',
    'pages'                     => array('post','page'),
    'priority'                  => 'high',
    'context'                   => 'normal',
    'fields'                    => array(
        array(
            'name'              => __('Video Type', 'bd'),
            'id'                => $prefix . 'video_type',
            'type'              => 'select',
            'options'           => array(
                'youtube'       => __('Youtube', 'bd'),
                'vimeo'         => __('Vimeo', 'bd'),
                'daily'         => __('Dialymotion', 'bd')
            )
        ),
        array(
            'name'              => __('Video ID :', 'bd'),
            'id'                => $prefix . 'video_url',
            'type'              => 'text'
        ),
        array(	'name'          => 'Or Embed Code',
            'id'                => $prefix . 'embed_code',
            'type'              => 'textarea'
        ),

    )
);

/**
 *  Post Link Options
 */
$meta_boxes[] = array
(
    'id'                        => 'link_options',
    'title'                     => 'Post Link Options',
    'pages'                     => array('post','page'),
    'priority'                  => 'high',
    'context'                   => 'normal',
    'fields'                    => array(
        array(
            'name'              => __('Post Link Text', 'bd'),
            'id'                => $prefix . 'post_link_text',
            'type'              => 'text'
        ),
        array(
            'name'              => __('Post Link Url', 'bd'),
            'id'                => $prefix . 'post_link_url',
            'type'              => 'text',
        ),
    )
);

/**
 *  Post Quote Options
 */
$meta_boxes[] = array
(
    'id'                        => 'quote_options',
    'title'                     => 'Post Quote Options',
    'pages'                     => array('post','page'),
    'priority'                  => 'high',
    'context'                   => 'normal',
    'fields'                    => array(
        array(
            'name'              => __('Post Quote Text', 'bd'),
            'id'                => $prefix . 'post_quote_text',
            'type'              => 'textarea'
        ),
        array(
            'name'              => __('Post Quote Author', 'bd'),
            'id'                => $prefix . 'post_quote_author',
            'type'              => 'text'
        ),

    )
);


/**
 *  Post Chat Options
 */
$meta_boxes[] = array
(
    'id'                        => 'chat_options',
    'title'                     => 'Post Format Chat Options',
    'pages'                     => array('post','page'),
    'priority'                  => 'high',
    'context'                   => 'normal',
    'fields'                    => array(
        array(
            'name'              => __('Text Or EMBED', 'bd'),
            'id'                => $prefix . 'post_chat_code',
            'type'              => 'textarea'
        ),
    )
);


/**
 *  post options
 */
$meta_boxes[] = array
(
    'id'                        => 'post_options',
    'title'                     => 'Post Options',
    'pages'                     => array('post','page'),
    'priority'                  => 'high',
    'context'                   => 'normal',
    'fields'                    => array(
        array(
            'name'              => __('Post Type', 'bd'),
            'id'                => $prefix . 'post_type',
            'type'              => 'select',
            'options'           => array(
                ''              => __('None', 'bd'),
                'post_image'         => __('Posts Featured Image', 'bd'),
                'post_slider'        => __('Posts Slideshow', 'bd'),
                'post_grid_gallery'        => __('Posts Grid Type Gallery', 'bd'),
                'post_soundcloud'    => __('Posts SoundCloud', 'bd'),
                'post_video'         => __('Posts Video', 'bd'),
                'post_googlemap'     => __('Posts Google Map', 'bd')
            )
        ),
        array(
            'name'              => __('Google Map Url :', 'bd'),
            'id'                => $prefix . 'google_maps_url',
            'type'              => 'text'
        ),
        array(
            'name'              => __('Sound Cloud Url :', 'bd'),
            'id'                => $prefix . 'soundcloud_url',
            'type'              => 'text'
        ),

        array(
            'name'              => __('Sidebar Position', 'bd'),
            'id'                => $prefix . 'sidebar_position',
            'type'              => 'select',
            'options'           => array(
                ''              => __('Default', 'bd'),
                'right'         => __('Right', 'bd'),
                'left'          => __('Left', 'bd'),
            )
        ),
        array(
            'name'              => __('Full Width', 'bd'),
            'id'                => $prefix . 'full_width',
            'clone'		            => false,
            'type'		            => 'checkbox',
            'std'		            => false
        ),
        array(
            'name'              => __('Show / Hide The Post, Meta', 'bd'),
            'id'                => $prefix . 'hide_post_meta',
            'type'              => 'select',
            'options'           => array(
                ''              => '',
                'yes'           => __('Yes', 'bd'),
                'no'            => __('No', 'bd'),
            )
        ),


        array(
            'name'              => __('Show / Hide Above Post Advertising', 'bd'),
            'id'                => $prefix . 'above_post_adv',
            'type'              => 'select',
            'options'           => array(
                ''              => '',
                'yes'           => __('Yes', 'bd'),
                'no'            => __('No', 'bd'),
            )
        ),
        array(
            'name'              => __('Above Post Advertising Code ', 'bd'),
            'id'                => $prefix . 'above_post_adv_code',
            'type'		        => 'textarea',
            'cols'		        => "50",
            'rows'		        => "4"
        ),
        array(
            'name'              => __('Show / Hide Below  Post Advertising', 'bd'),
            'id'                => $prefix . 'below_post_adv',
            'type'              => 'select',
            'options'           => array(
                ''              => '',
                'yes'           => __('Yes', 'bd'),
                'no'            => __('No', 'bd'),
            )
        ),
        array(
            'name'              => __('Below Post Advertising Code', 'bd'),
            'id'                => $prefix . 'below_post_adv_code',
            'type'		        => 'textarea',
            'cols'		        => "50",
            'rows'		        => "4"
        ),

        array(
            'name'              => 'Background Color (Hex Code)',
            'id'                => $prefix . 'post_background_color',
            'type'              => 'color'
        ),
        array(
            'name'              => 'Background Image','bd',
            'id'                => $prefix . 'post_background_custom',
            'type'              => 'image'
        ),
        array(
            'name'              => 'Background repeat',
            'id'                => $prefix . 'post_background_repeat',
            'type'              => 'select',
            'options'           => array(
                'repeat'        => 'Tile',
                'no-repeat'     => 'No Repeat',
                'repeat-x'      => 'Tile Horizontally',
                'repeat-y'      => 'Tile Vertically'
            ),
        ),
        array(
            'name'              => 'Background attachment',
            'id'                => $prefix . 'post_background_attachment',
            'type'              => 'select',
            'options'           => array(
                'scroll'        => 'Scroll',
                'fixed'         => 'Fixed',
                'inherit'       => 'Inherit',
            )
        ),
        array(
            'name'              => 'Background horizontal position',
            'id'                => $prefix . 'post_background_x',
            'type'              => 'select',
            'options'           => array(
                'center'        => 'Center',
                'left'          => 'Left',
                'right'         => 'Right'
            )
        ),
        array(
            'name'              => 'Background vertical position',
            'id'                => $prefix . 'post_background_y',
            'type'              => 'select',
            'options'           => array(
                'center'        => 'Center',
                'top'           => 'Top',
                'bottom'        => 'Bottom'
            )
        ),


    )
);

/**
 *  Review
 */
$meta_boxes[] = array(
    'id'                        => 'review',
    'title'                     => 'Review Options',
    'pages'                     => array('post'),
    'context'                   => 'normal',
    'priority'                  => 'default',
    'fields'                    => array(
    array(
        'name'		            => 'Enable Review?',
        'id'		            => $prefix . 'review_enable',
        'clone'		            => false,
        'type'		            => 'checkbox',
        'std'		            => false
    ),
    array(
        'name'		            => 'Enable User Ratings?',
        'id'		            => $prefix . 'user_ratings_visibility',
        'type'		            => 'checkbox',
        'std'		            => false
    ),
    // CRITERIA ONE
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 1:</span> Description',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_add_criteria1 bd_c1 ",
        'id'		=> "{$prefix}c1_description",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 1:</span> Rating <em id=bd_preview_rating_1></em>',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_c1",
        'id'		=> "{$prefix}c1_rating",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    //CRITERIA TWO
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 2:</span> Description',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_add_criteria2  bd_c2",
        'id'		=> "{$prefix}c2_description",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 2:</span> Rating <em id=bd_preview_rating_2></em>',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_c2",
        'id'		=> "{$prefix}c2_rating",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    //CRITERIA THREE
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 3:</span> Description',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_add_criteria3  bd_c3",
        'id'		=> "{$prefix}c3_description",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 3:</span> Rating <em id=bd_preview_rating_3></em>',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_c3",
        'id'		=> "{$prefix}c3_rating",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    //CRITERIA FOUR
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 4:</span> Description',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_add_criteria4  bd_c4",
        'id'		=> "{$prefix}c4_description",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 4:</span> Rating  <em id=bd_preview_rating_4></em>',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_c4",
        'id'		=> "{$prefix}c4_rating",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    //CRITERIA FIVE
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 5:</span> Description',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_add_criteria5  bd_c5",
        'id'		=> "{$prefix}c5_description",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 5:</span> Rating <em id=bd_preview_rating_5></em>',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_c5",
        'id'		=> "{$prefix}c5_rating",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    //CRITERIA SIX
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 6:</span> Description',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_add_criteria6 bd_c6",
        'id'		=> "{$prefix}c6_description",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    array(
        'name'		=> '<span class="bd_get_bold">Criteria 6:</span> Rating <em id=bd_preview_rating_6></em>',
        'desc'		=> "",
        'class'		=> "bd_review_hide bd_c6",
        'id'		=> "{$prefix}c6_rating",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    array(
        'name'		=> 'Rating Type',
        'id'		=> "{$prefix}review_type",
        'class'		=> "bd_review_hide bd_clear_that_thang",
        'type'		=> 'radio',
        'options'	=> array(
            'stars'	  => 'Stars',
            'percent' => 'Percentage'
        ),
        'std'		=> 'stars',
        'desc'		=> ''
    ),
    array(
        'name'		=> 'Final Score',
        'desc'		=> "Total of <em>__</em>% will be displayed if percentage is selected",
        'class'		=> "bd_review_hide ",
        'id'		=> "{$prefix}final_score",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "1"
    ),
    array(
        'name'		=> 'Criteria Header',
        'desc'		=> "Leave empty if you don't want it",
        'class'		=> "bd_review_hide ",
        'id'		=> "{$prefix}criteria_header",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "4"
    ),
    array(
        'name'		=> 'Brief Summary',
        'desc'		=> "Just one or two words",
        'class'		=> "bd_review_hide ",
        'id'		=> "{$prefix}brief_summary",
        'type'		=> 'text',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "4"
    ),
    array(
        'name'		=> 'Longer Summary',
        'desc'		=> "Just a paragraph will do",
        'class'		=> "bd_review_hide ",
        'id'		=> "{$prefix}longer_summary",
        'type'		=> 'textarea',
        'std'		=> "",
        'cols'		=> "50",
        'rows'		=> "4"
    ),
    array(
        'name'		=> 'Criteria Display',
        'id'		=> "{$prefix}criteria_display",
        'type'		=> 'radio',
        'options'	=> array(
            't'			=> 'Top',
            'bottom'	=> 'Bottom',
        ),
        'std'		=> 't',
        'desc'		=> 'Where in the post do you want it to display?',
    ),
    )
);

/**
 *  RW_Meta_Box_Taxonomy
 */
foreach ($meta_boxes as $meta_box)
{
	new RW_Meta_Box_Taxonomy($meta_box);
}

/**
 *  RW_Meta_Box_Validate
 */
class RW_Meta_Box_Validate
{
	function check_name($text)
    {
		if ($text == 'Anh Tran')
        {
			return 'He is Rilwis';
		}
		return $text;
	}
}
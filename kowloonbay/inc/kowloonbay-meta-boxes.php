<?php

add_filter( 'rwmb_meta_boxes', 'kowloonbay_register_page_meta_boxes' );
add_filter( 'rwmb_meta_boxes', 'kowloonbay_register_post_meta_boxes' );
add_filter( 'rwmb_meta_boxes', 'kowloonbay_register_portfolio_meta_boxes' );
add_filter( 'rwmb_meta_boxes', 'kowloonbay_register_team_meta_boxes' );
add_filter( 'rwmb_meta_boxes', 'kowloonbay_register_service_meta_boxes' );
add_filter( 'rwmb_meta_boxes', 'kowloonbay_register_testimonial_meta_boxes' );

function kowloonbay_register_page_meta_boxes( $meta_boxes )
{
	$prefix = 'kowloonbay_page_';

	$meta_boxes[] = array(
		'id' => 'kowloonbay_page_meta_box',
		'title' => esc_html__( 'KowloonBay Page', 'KowloonBay' ),
		'pages' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Description', 'KowloonBay' ),
				'id'    => "{$prefix}desc",
				'desc'  => esc_html__( 'Enter the description of this page which will appear below the heading.', 'KowloonBay' ),
				'type'  => 'text',
			),
		),
	);

	$meta_boxes[] = array(
		'id' => 'kowloonbay_page_related_webpages_meta_box',
		'title' => esc_html__( 'KowloonBay Page: Related Webpages', 'KowloonBay' ),
		'pages' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'URLs', 'KowloonBay' ),
				'id'    => "{$prefix}related_urls",
				'desc'  => esc_html__( 'Specify the URLs of all related webpages.', 'KowloonBay' ),
				'type'  => 'text',
				'clone' => 'true',
				'placeholder' => 'http://',
			),
			array(
				'name'  => esc_html__( 'Background Images', 'KowloonBay' ),
				'id'    => "{$prefix}related_bg_imgs",
				'desc'  => esc_html__( 'Background images corresponding to the webpages specified above.', 'KowloonBay' ),
				'type'  => 'image_advanced',
			),
			array(
				'name'  => esc_html__( 'Descriptions', 'KowloonBay' ),
				'id'    => "{$prefix}related_descs",
				'desc'  => esc_html__( 'Descriptions corresponding to the webpages specified above.', 'KowloonBay' ),
				'type'  => 'text',
				'clone' => 'true'
			),
			array(
				'name'  => esc_html__( 'Labels for Link Buttons', 'KowloonBay' ),
				'id'    => "{$prefix}related_labels",
				'desc'  => esc_html__( 'Lables for link buttons corresponding to the webpages specified above. To add a Font Awesome icon before the label text, Use "|" to seperate the Font Awesome icon class name and the actual content.', 'KowloonBay' ),
				'type'  => 'text',
				'clone' => 'true'
			),
		),
	);

	return $meta_boxes;
}

function kowloonbay_register_post_meta_boxes( $meta_boxes )
{
	$prefix = 'kowloonbay_post_';

	$meta_boxes[] = array(
		'id' => 'kowloonbay_post_meta_box',
		'title' => esc_html__( 'KowloonBay Post', 'KowloonBay' ),
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'             => esc_html__( 'Gallery', 'KowloonBay' ),
				'id'               => "{$prefix}gallery",
				'type'             => 'image_advanced',
				'desc'             => 'Select multiple images to create a gallery. Effective only when the post format of gallery is used.',
			),
			array(
				'name'             => esc_html__( 'Image', 'KowloonBay' ),
				'id'               => "{$prefix}image",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'desc'             => 'Select a single image for an image post. Effective only when the post format of image is used.',
			),
			array(
				'name'             => esc_html__( 'Video', 'KowloonBay' ),
				'id'               => "{$prefix}video",
				'type'             => 'oembed',
				'desc'             => 'Enter the URL of a YouTube / Vimeo video here. Effective only when the post format of video is used.',
			),
			array(
				'name'             => esc_html__( 'Audio', 'KowloonBay' ),
				'id'               => "{$prefix}audio",
				'type'             => 'oembed',
				'desc'             => 'Enter the URL of a SoundCloud audio here. Effective only when the post format of audio is used.',
			),
			array(
				'name'             => esc_html__( 'Source of Quote', 'KowloonBay' ),
				'id'               => "{$prefix}quote_source",
				'type'             => 'text',
				'desc'             => 'Enter the source of quote here. Effective only when the post format of quote is used.',
			),
		),
	);

	$meta_boxes[] = array(
		'id' => 'kowloonbay_post_dim_meta_box',
		'title' => esc_html__( 'KowloonBay Post: Dimensions', 'KowloonBay' ),
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'             => esc_html__( 'Image Resize Mode of Gallery Slider (Details Page of Gallery Post Only)', 'TsingYi' ),
				'id'               => "{$prefix}gallery_slider_resize_mode",
				'type' => 'radio',
				'options' => array(
					'cover' => 'Cover (Images will fill the slider)',
					'contain' => 'Contain (Images will stay within the slider)',
				),
				'std' => 'cover',
			),
			array(
				'name'     => esc_html__( 'Height of Gallery / Image Area (Gallery / Image / Standard Post Only)', 'KowloonBay' ),
				'id'       => "{$prefix}gallery_slider_height",
				'desc'     => esc_html__( 'Select a Height for gallery slider / image area. Effective only when the post format of gallery / image / standard (with featured image) is used.', 'KowloonBay' ),
				'type'     => 'select',
				'options'  => array(
					'1x' => esc_html__( '1X', 'KowloonBay' ),
					'1.5x' => esc_html__( '1.5X', 'KowloonBay' ),
					'2x' => esc_html__( '2X', 'KowloonBay' ),
					'3x' => esc_html__( '3X', 'KowloonBay' ),
					'c' => esc_html__( 'Custom Height', 'KowloonBay' ),
				),
				'std'    => '1.5x',
				'multiple'    => false,
				'placeholder' => esc_html__( 'Choose a height', 'KowloonBay' ),
			),
			array(
				'name'     => esc_html__( 'Custom Height of Gallery / Image Area (Gallery / Image / Standard Post Only)', 'KowloonBay' ),
				'id'       => "{$prefix}gallery_slider_custom_height",
				'desc'     => esc_html__( 'Enter a custom height here. CSS height syntax used here. Example: 300px. Effective only when custom height is selected for gallery slider / image area.', 'KowloonBay' ),
				'type'     => 'text',
			),
			array(
				'name'     => esc_html__( 'Display Full Image (Image / Standard Post Only)', 'KowloonBay' ),
				'id'       => "{$prefix}display_full_image",
				'desc'     => esc_html__( 'This will override any predefined or custom height of the image area. Effective only when the post format of image or the post format of standard (with featured image) is used.', 'KowloonBay' ),
				'type'     => 'checkbox',
				'std'      => '0',
			),
			array(
				'name'     => esc_html__( 'Enable Parallax Effect (Image / Standard Post Only)', 'KowloonBay' ),
				'id'       => "{$prefix}enable_parallax",
				'desc'     => esc_html__( 'Effective only when the post format of image or the post format of standard (with featured image) is used. Will not be effective if full image is displayed.', 'KowloonBay' ),
				'type'     => 'checkbox',
				'std'      => '1',
			),
			array(
				'name'             => esc_html__( 'Video Aspect Ratio (Video Post Only)', 'KowloonBay' ),
				'id'               => "{$prefix}video_ratio",
				'type'             => 'radio',
				'desc'             => 'Select the aspect ratio of the embedded YouTube / Vimeo video. Effective only when the post format of video is used.',
				'options' => array(
					'16-9' => '16:9',
					'4-3' => '4:3',
				),
				'std' => '16-9',
			),
		),
	);

	$meta_boxes[] = array(
		'id' => 'kowloonbay_post_color_meta_box',
		'title' => esc_html__( 'KowloonBay Post: Color', 'KowloonBay' ),
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'     => esc_html__( 'Background Color in Index Pages (Link / Quote / Status Post Only)', 'KowloonBay' ),
				'id'       => "{$prefix}mini_entry_bg_color",
				'desc'     => esc_html__( 'Select a background color for this post in index pages. Light colors are recommended. Effective only when the post format of link, quote and status is used.', 'KowloonBay' ),
				'type'     => 'color',
			),
		)
	);

	return $meta_boxes;
}

function kowloonbay_register_portfolio_meta_boxes( $meta_boxes )
{
	$prefix = 'kowloonbay_portfolio_';

	$meta_boxes[] = array(
		'id' => 'kowloonbay_portfolio_meta_box',
		'title' => esc_html__( 'KowloonBay Portfolio', 'KowloonBay' ),
		'pages' => array( 'kowloonbay_portfolio' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Assign This Item to Portfolio', 'KowloonBay' ),
				'id'    => "{$prefix}assignment",
				'type'  => 'select',
				'options' => array(
					'1' => '#1', 
					'2' => '#2', 
					'3' => '#3', 
					'4' => '#4', 
					'5' => '#5', 
					'6' => '#6', 
					'7' => '#7', 
					'8' => '#8', 
					'9' => '#9', 
					'10' => '#10', 
				),
				'std' => '1',
			),
			array(
				'name'  => esc_html__( 'Description', 'KowloonBay' ),
				'id'    => "{$prefix}desc",
				'desc'  => esc_html__( 'Enter the description of this portfolio item which will appear below the heading.', 'KowloonBay' ),
				'type'  => 'text',
			),
			array(
				'name' => esc_html__( 'Cover Image', 'KowloonBay' ),
				'id'   => "{$prefix}cover_img",
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'name'     => esc_html__( 'Layout', 'KowloonBay' ),
				'id'       => "{$prefix}layout",
				'type'     => 'select',
				'options'  => array(
					'image_slider' => esc_html__( 'Image Slider', 'KowloonBay' ),
					'video_slider' => esc_html__( 'Video Slider', 'KowloonBay' ),
					'free_layout' => esc_html__( 'Free Layout', 'KowloonBay' ),
				),
				'multiple'    => false,
				'placeholder' => esc_html__( 'Choose a portfolio layout', 'KowloonBay' ),
			),
			array(
				'name'     => esc_html__( 'Slider Position', 'KowloonBay' ),
				'id'       => "{$prefix}slider_pos",
				'type'     => 'radio',
				'options'  => array(
					'top' => esc_html__( 'Top', 'KowloonBay' ),
					'left' => esc_html__( 'Left', 'KowloonBay' ),
					'right' => esc_html__( 'Right', 'KowloonBay' ),
					'lightbox' => esc_html__( 'Lightbox', 'KowloonBay' ),
					'stack' => esc_html__( 'Stack (For Image Slider Only)', 'KowloonBay' ),
				),
				'desc'  => esc_html__( 'Effective only when an image / video slider is used. When the lightbox option is selected, slider images / videos will be displayed in a lightbox.', 'KowloonBay' ),
			),
			array(
				'name' => esc_html__( 'Info Bar Content', 'KowloonBay' ),
				'id'   => "{$prefix}info_bar_content",
				'desc'  => esc_html__( 'Add an info bar item by clicking the "+" button. To add a Font Awesome icon before the item text, Use "|" to seperate the Font Awesome icon class name and the actual content.', 'KowloonBay' ),
				'type' => 'text',
				'clone' => true,
			),
			array(
				'name' => esc_html__( 'Columns', 'KowloonBay' ),
				'id'   => "{$prefix}cols",
				'desc'  => esc_html__( 'Number of columns for text. Effective only when an image / video slider is used.', 'KowloonBay' ),
				'type' => 'radio',
				'options' => array(
					'single' => 'Single',
					'double' => 'Double',
				),
				'std' => 'single',
			),
			array(
				'name' => esc_html__( 'End Mark', 'KowloonBay' ),
				'id'   => "{$prefix}end_mark",
				'desc'  => esc_html__( 'Add an end mark to the end of main content.', 'KowloonBay' ),
				'type' => 'radio',
				'options' => array(
					'show' => 'Show',
					'hide' => 'Hide',
				),
				'std' => 'show',
			),
			array(
				'name' => esc_html__( 'Related Portfolio Items', 'KowloonBay' ),
				'id'   => "{$prefix}related_items",
				'desc'  => esc_html__( 'Hold down Ctrl / Command to select / deselect multiple items.', 'KowloonBay' ),
				'type' => 'post',
				'field_type' => 'select',
				'post_type' => 'kowloonbay_portfolio',
				'multiple' => true,
			),
		),

		'validation' => array(
			'rules' => array(
				"{$prefix}cover_img" => array(
					'required'  => true,
				),
				"{$prefix}layout" => array(
					'required'  => true,
				),
				"{$prefix}slider_pos" => array(
					'required'  => true,
				),
			)
		)
	);

	$meta_boxes[] = array(
		'id' => 'kowloonbay_portfolio_image_slider_meta_box',
		'title' => esc_html__( 'KowloonBay Portfolio: Image Slider', 'KowloonBay' ),
		'pages' => array( 'kowloonbay_portfolio' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'             => esc_html__( 'Slider Images', 'KowloonBay' ),
				'id'               => "{$prefix}slider_images",
				'type'             => 'image_advanced',
				'desc'             => 'Effective only when the layout of image slider is used. Hold on the Shift / Ctrl / Command key and click to select multiple images.',
			),
			array(
				'name'             => esc_html__( 'Image Resize Mode', 'KowloonBay' ),
				'id'               => "{$prefix}slider_image_resize_mode",
				'desc'     => esc_html__( 'Effective only when slider position is top / left / right.', 'KowloonBay' ),
				'type' => 'radio',
				'options' => array(
					'cover' => 'Cover (Images will fill the slider)',
					'contain' => 'Contain (Images will stay within the slider)',
				),
				'std' => 'cover',
			),
			array(
				'name'     => esc_html__( 'Maximum Width of Image Stack', 'KowloonBay' ),
				'id'       => "{$prefix}dim_max_width_img_stack",
				'desc'     => esc_html__( 'CSS height syntax is used here. Use "none" to remove maximum width. Example: 300px / 100% / none. Effective only when slider position is stack.', 'KowloonBay' ),
				'type'     => 'text',
				'std' => '90%',
			),
		),
	);

	$meta_boxes[] = array(
		'id' => 'kowloonbay_portfolio_video_slider_meta_box',
		'title' => esc_html__( 'KowloonBay Portfolio: Video Slider', 'KowloonBay' ),
		'pages' => array( 'kowloonbay_portfolio' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'             => esc_html__( 'Slider Videos', 'KowloonBay' ),
				'id'               => "{$prefix}slider_videos",
				'type'             => 'oembed',
				'desc'             => 'Enter the URL of a YouTube / Vimeo video here. Effective only when the layout of video slider is used.',
				'clone'            => true,
			),
		),
		'validation' => array(
			'rules' => array(
				"{$prefix}slider_videos" => array(
					'url'  => true,
				),
			)
		)
	);

	$meta_boxes[] = array(
		'id' => 'kowloonbay_portfolio_masonry_meta_box',
		'title' => esc_html__( 'KowloonBay Portfolio: Masonry Layout', 'KowloonBay' ),
		'pages' => array( 'kowloonbay_portfolio' ),
		'context' => 'normal',
		'priority' => 'low',
		'autosave' => true,
		'fields' => array(
			array(
				'name'     => esc_html__( 'Width', 'KowloonBay' ),
				'id'       => "{$prefix}masonry_width",
				'desc'     => esc_html__( 'Masonry width for this portfolio item. Base width (1X) is equal to column width. Masonry width will not apply if it exceeds the full width.', 'KowloonBay' ),
				'type'     => 'select',
				'options'  => array(
					'1x' => esc_html__( '1X', 'KowloonBay' ),
					'2x' => esc_html__( '2X', 'KowloonBay' ),
					'3x' => esc_html__( '3X', 'KowloonBay' ),
					'4x' => esc_html__( '4X', 'KowloonBay' ),
				),
				'std'    => '1x',
				'multiple'    => false,
				'placeholder' => esc_html__( 'Choose a width', 'KowloonBay' ),
			),
			array(
				'name'     => esc_html__( 'Height', 'KowloonBay' ),
				'id'       => "{$prefix}masonry_height",
				'desc'     => esc_html__( 'Masonry height for this portfolio item.', 'KowloonBay' ),
				'type'     => 'select',
				'options'  => array(
					'1x' => esc_html__( '1X', 'KowloonBay' ),
					'1.5x' => esc_html__( '1.5X', 'KowloonBay' ),
					'2x' => esc_html__( '2X', 'KowloonBay' ),
					'3x' => esc_html__( '3X', 'KowloonBay' ),
				),
				'std'    => '1x',
				'multiple'    => false,
				'placeholder' => esc_html__( 'Choose a height', 'KowloonBay' ),
			),
		),
	);

	$meta_boxes[] = array(
		'id' => 'kowloonbay_portfolio_dim_meta_box',
		'title' => esc_html__( 'KowloonBay Portfolio: Dimensions', 'KowloonBay' ),
		'pages' => array( 'kowloonbay_portfolio' ),
		'context' => 'normal',
		'priority' => 'low',
		'autosave' => true,
		'fields' => array(
			array(
				'name'     => esc_html__( 'Height of Slider', 'KowloonBay' ),
				'id'       => "{$prefix}dim_slider_height",
				'desc'     => esc_html__( 'Select a Height for Slider. Effective only when image / video slider is used.', 'KowloonBay' ),
				'type'     => 'select',
				'options'  => array(
					'1x' => esc_html__( '1X', 'KowloonBay' ),
					'1.5x' => esc_html__( '1.5X', 'KowloonBay' ),
					'2x' => esc_html__( '2X', 'KowloonBay' ),
					'3x' => esc_html__( '3X', 'KowloonBay' ),
					'c' => esc_html__( 'Custom Height', 'KowloonBay' ),
				),
				'std'    => '1.5x',
				'multiple'    => false,
				'placeholder' => esc_html__( 'Choose a height', 'KowloonBay' ),
			),
			array(
				'name'     => esc_html__( 'Custom Height of Slider', 'KowloonBay' ),
				'id'       => "{$prefix}dim_slider_custom_height",
				'desc'     => esc_html__( 'Enter a custom height here. CSS height syntax used here. Example: 300px. Effective only when custom height is selected for slider.', 'KowloonBay' ),
				'type'     => 'text',
			),
			array(
				'name'     => esc_html__( 'Maintain Ratio of Video Slider', 'KowloonBay' ),
				'id'       => "{$prefix}dim_video_slider_ratio",
				'desc'     => esc_html__( 'If ratio of video slider is maintained, height of slider will not apply. Effective for video slider only.', 'KowloonBay' ),
				'type'     => 'radio',
				'options'	=> array(
					'n'		=> 'Do Not Maintain',
					'16by9'	=> '16:9',
					'4by3'	=> '4:3',
				),
				'std'    => '16by9',
			),
			array(
				'name' => esc_html__( 'Stretch Photo to Fit Text Height on Large Screen for Left / Right Slider', 'KowloonBay' ),
				'id'   => "{$prefix}dim_slider_stretch",
				'desc'  => esc_html__( 'This will let the left / right slider have the same height of the text area on large screen (width > 992px), giving the page a magazine look and feel. However, you may not have the best effect if there are too many or not enough texts. Effective for image slider only.', 'KowloonBay' ),
				'type' => 'checkbox',
				'std' => '1',
			),
		),
	);

	return $meta_boxes;
}

function kowloonbay_register_team_meta_boxes( $meta_boxes )
{
	$prefix = 'kowloonbay_team_';
	$meta_boxes[] = array(
		'id' => 'kowloonbay_team_meta_box',
		'title' => esc_html__( 'KowloonBay Team', 'KowloonBay' ),
		'pages' => array( 'kowloonbay_team' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name' => esc_html__( 'Position', 'rwmb' ),
				'id'   => "{$prefix}pos",
				'type' => 'text',
			),
			array(
				'name' => esc_html__( 'Photo', 'KowloonBay' ),
				'id'   => "{$prefix}photo",
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'name' => esc_html__( 'Photo Position', 'KowloonBay' ),
				'id'   => "{$prefix}photo_pos",
				'desc'  => esc_html__( 'Show photo on the left / right.', 'KowloonBay' ),
				'type' => 'radio',
				'options' => array(
					'left' => 'Left',
					'right' => 'Right',
				),
				'std' => 'left',
			),
			array(
				'name' => esc_html__( 'Stretch Photo to Fit Text Height on Large Screen', 'KowloonBay' ),
				'id'   => "{$prefix}photo_stretch",
				'desc'  => esc_html__( 'This will let the photo area have the same height of the text area on large screen (width > 992px), giving the page a magazine look and feel. However, you may not have the best effect if there are too many or not enough texts.', 'KowloonBay' ),
				'type' => 'checkbox',
				'std' => '1',
			),
		),
		'validation' => array(
			'rules' => array(
				"{$prefix}photo" => array(
					'required'  => true,
				),
				"{$prefix}photo_pos" => array(
					'required'  => true,
				),
			)
		)
	);

	return $meta_boxes;
}

function kowloonbay_register_service_meta_boxes( $meta_boxes )
{
	$prefix = 'kowloonbay_service_';
	$meta_boxes[] = array(
		'id' => 'kowloonbay_service_meta_box',
		'title' => esc_html__( 'KowloonBay Service', 'KowloonBay' ),
		'pages' => array( 'kowloonbay_service' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Description', 'KowloonBay' ),
				'id'    => "{$prefix}desc",
				'desc'  => esc_html__( 'A description of this service.', 'KowloonBay' ),
				'type'  => 'textarea',
			),
			array(
				'name'  => esc_html__( 'Description (Short)', 'KowloonBay' ),
				'id'    => "{$prefix}desc_short",
				'desc'  => esc_html__( 'A short description of this service which will appear below the heading in the service details page.', 'KowloonBay' ),
				'type'  => 'text',
			),
			array(
				'name' => esc_html__( 'Use Font Awesome / Image Icon', 'KowloonBay' ),
				'id'   => "{$prefix}use_icon",
				'desc'  => esc_html__( 'Specify whether to use a Font Awesome / image icon for this service.', 'KowloonBay' ),
				'type' => 'radio',
				'options' => array(
					'fa' => 'Font Awesome',
					'img' => 'Image',
				),
				'std' => 'fa',
			),
			array(
				'name'  => esc_html__( 'Icon (Font Awesome)', 'KowloonBay' ),
				'id'    => "{$prefix}icon_fa",
				'type'  => 'text',
				'placeholder'  => 'Font Awesome Icon Class',
			),
			array(
				'name' => esc_html__( 'Icon (Image)', 'KowloonBay' ),
				'id'   => "{$prefix}icon_img",
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Disable Service Details', 'KowloonBay' ),
				'id'    => "{$prefix}disable_service_details",
				'desc'  => esc_html__( 'The link to the details page of this service item will be removed if service details are disabled.', 'KowloonBay' ),
				'type'  => 'checkbox',
				'std' => 0,
			),
		),

		'validation' => array()
	);

	return $meta_boxes;
}

function kowloonbay_register_testimonial_meta_boxes( $meta_boxes )
{
	$prefix = 'kowloonbay_testimonial_';
	$meta_boxes[] = array(
		'id' => 'kowloonbay_testimonial_meta_box',
		'title' => esc_html__( 'KowloonBay Testimonial', 'KowloonBay' ),
		'pages' => array( 'kowloonbay_tmnl' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name' => esc_html__( 'Profile Picture', 'KowloonBay' ),
				'id'   => "{$prefix}profile_pic",
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Position', 'KowloonBay' ),
				'id'    => "{$prefix}position",
				'type'  => 'text',
			),
		),

		'validation' => array()
	);

	return $meta_boxes;
}
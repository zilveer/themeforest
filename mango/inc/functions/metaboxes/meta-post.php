<?php
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'blog_post_options',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Options', 'mango' ),
		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'advanced',
		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',
		// Auto save: true, false (default). Optional.
		'autosave' => true,
		// List of meta fields
        'fields' => array(
            array(
                'type' => 'heading',
                'name' => __( 'Post Meta Options', 'mango' ),
                'id'   => 'format_gallery_heading', // Not used but needed for plugin
            ),
            array (
                'name' => __ ( 'Posts Author Name', 'mango' ),
                'id' => "{$prefix}hide_post_author",
                'type' => 'select_advanced',
                'options' => array (
                    '' => __ ( 'Use Default', 'mango' ),
                    '1' => __ ( 'Hide Posts Author Name', 'mango' ),
                ),
            ),
            array (
                'name' => __ ( 'Posts Category', 'mango' ),
                'id' => "{$prefix}hide_post_category",
                'type' => 'select_advanced',
                'options' => array (
                    '' => __ ( 'Use Default', 'mango' ),
                    '1' => __ ( 'Hide Posts Category', 'mango' ),
                ),
            ),
            array (
                'name' => __ ( 'Posts Tags', 'mango' ),
                'id' => "{$prefix}hide_post_tags",
                'type' => 'select_advanced',
                'options' => array (
                    '' => __ ( 'Use Default', 'mango' ),
                    '1' => __ ( 'Hide Posts Tags', 'mango' ),
                ),
            ),
            array(
                'type' => 'heading',
                'name' => __( 'Gallery Fields (Use in Gallery Format)', 'mango' ),
                'id'   => 'format_gallery_heading', // Not used but needed for plugin
            ),
            array(
                'name'             => __( 'Slider Images', 'mango' ),
                'id'               => "{$prefix}option_image",
                'type'             => 'image_advanced',
                'max_file_uploads' => 6,
            ),
            array(
                'type' => 'heading',
                'name' => __( 'Video Fields (Use in Video Format)', 'mango' ),
                'id'   => 'format_video_heading', // Not used but needed for plugin
            ),
            array(
                'name' => __( 'Video URL', 'mango' ),
                'id'   => "{$prefix}video_embed",
                'type' => 'oembed',
                'desc' => 'Paste the URL of the Flash (YouTube or Vimeo etc). Only necessary when the post format is video.',
                //class="embed-responsive-item"
            ),
            array(
                'type' => 'heading',
                'name' => __( 'Audio Fields (Use in Audio Format)', 'mango' ),
                'id'   => 'format_audio_heading', // Not used but needed for plugin
            ),
            array(
                'name' => __( 'Audio file upload', 'mango' ),
                'id'   => "{$prefix}file_audio",
                'type' => 'file_advanced',
                'max_file_uploads' => 1,
                'mime_type' => 'audio', // Leave blank for all file types
            ),
            array(
                'type' => 'heading',
                'name' => __( 'Quote Fields (Use in Quote Format)', 'mango' ),
                'id'   => 'format_quote_heading', // Not used but needed for plugin
            ),
            array(
                'name' => __( 'Author', 'mango' ),
                'id'   => "{$prefix}quote_author",
                'type' => 'text',
            ),
            array(
                'name' => __( 'Quote', 'mango' ),
                'id'   => "{$prefix}quote_content",
                'type' => 'textarea',
            ),
            array(
                'name' => __( 'Quote Icon', 'mango' ),
                'id'   => "{$prefix}quote_icon",
                'type' => 'checkbox_list',
                'options' => array (
                    '1' => __( 'Use Blockquote Icon', 'mango' ),
                ),

            ),
            array(
                'type' => 'heading',
                'name' => __( 'Link Field (Use in Link Format)', 'mango' ),
                'id'   => 'format_link_heading', // Not used but needed for plugin
            ),

            array(
                'name' => __( 'Link', 'meta-box' ),
                'id'   => "{$prefix}post_external_link",
                'type' => 'url',
                'desc' => __('Enter URL for link format post.','mango')
            ),
        )
	);
?>
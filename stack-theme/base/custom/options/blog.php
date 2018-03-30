<?php 
	
// Option
$options = array(
	
	// Blog
	array(
		'title' 	=> __('Blog Page', 'theme_admin'),
		'options' 	=> array(
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'show_full_post_content',
				'title' 		=> __('Show Full Content', 'theme_admin'),
				'description' 	=> __('show full post content', 'theme_admin'),
				'default' 		=> 'off',
			),
			array(
				'type' 			=> 'text',
				'id' 			=> 'read_more_text',
				'title' 		=> __('Read More Text', 'theme_admin'),
				'description' 	=> __('string for "read more" link.<br />leave blank to disable "read more" link.', 'theme_admin'),
				'default' 		=> 'Continue Reading →'
			),
			
		)
	),
	
	// Single Blog Page
	array(
		'title' 	=> __('Single Blog Page', 'theme_admin'),
		'options' 	=> array(
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'single_featured_img',
				'title' 		=> __('Featured Image', 'theme_admin'),
				'description' 	=> __('turn on to show "Featured Image"', 'theme_admin'),
				'default' 		=> 'on',
			),
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'single_author_box',
				'title' 		=> __('Author Box', 'theme_admin'),
				'description' 	=> __('turn on to show "Author" box below post content', 'theme_admin'),
				'default' 		=> 'on',
			),
		)
	),
	
	// Meta Infos
	array(
		'title' 	=> __('Meta Infos', 'theme_admin'),
		'options' 	=> array(
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'meta_date',
				'title' 		=> __('Published Date', 'theme_admin'),
				'description' 	=> __('show post\'s published date', 'theme_admin'),
				'default' 		=> 'on',
			),
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'meta_author',
				'title' 		=> __('Author', 'theme_admin'),
				'description' 	=> __('show post\'s author', 'theme_admin'),
				'default' 		=> 'on',
			),
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'meta_category',
				'title' 		=> __('Category', 'theme_admin'),
				'description' 	=> __('show post\'s category', 'theme_admin'),
				'default' 		=> 'on',
			),
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'meta_comment',
				'title' 		=> __('Comment', 'theme_admin'),
				'description' 	=> __('show post\'s comment count', 'theme_admin'),
				'default'		=> 'on',
			),
		)
	)
);

$config = array(
	'title' 	=> __('Blog', 'theme_admin'),
	'group_id' 	=> 'blog'
);
	
return array( 'options' => $options, 'config' => $config );

?>
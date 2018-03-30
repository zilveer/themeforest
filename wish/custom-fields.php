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
 * @link http://metabox.io/docs/registering-meta-boxes/
 */
add_filter( 'rwmb_meta_boxes', 'wish_register_meta_boxes' );
/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
 
function wish_register_meta_boxes( $meta_boxes )
{
	
	$prefix = 'wish_';
	$meta_boxes[] = array(
		'id'         => 'team_fields',
		'title'      => __( 'Team member Details', 'wish' ),
		'post_types' => array( 'wish_team' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(
			array(
						'name'  => __( 'Check if you want to display it at top of Team Members?', 'wish' ),
						'id'    => "{$prefix}president_check",
						'desc'  => __( '', 'wish' ),
						'type'  => 'checkbox',
						'std'   => 0,
					),
			array(
				'name'  => __( 'Designation', 'wish' ),
				'id'    => "{$prefix}designation",
				'desc'  => __( 'Enter Designation', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'Email Address', 'wish' ),
				'id'    => "{$prefix}member_email",
				'desc'  => __( 'Enter Mermber\'s email address', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'Facebook', 'wish' ),
				'id'    => "{$prefix}member_fb",
				'desc'  => __( 'Enter member\'s Facebook id', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'Twitter', 'wish' ),
				'id'    => "{$prefix}member_tw",
				'desc'  => __( 'Enter member\'s twitter id', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'Google Plus', 'wish' ),
				'id'    => "{$prefix}member_goo",
				'desc'  => __( 'Enter member\'s Google plus id', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'Skype', 'wish' ),
				'id'    => "{$prefix}member_sk",
				'desc'  => __( 'Enter member\'s Skype id', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'LinkedIn', 'wish' ),
				'id'    => "{$prefix}member_li",
				'desc'  => __( 'Enter member\'s LinkedIn id', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
			
			
		),
	);
$meta_boxes[] = array(
		'title'  => __( 'Biodata', 'wish' ),
		'id'         => 'testimonials_fields',
		'post_types' => array( 'wish_testimonials'),
		
		'fields' => array(
		array(
				'name'  => __( 'Name', 'wish' ),
				'id'    => "{$prefix}test_name",
				'desc'  => __( '', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'Company name', 'wish' ),
				'id'    => "{$prefix}test_company",
				'desc'  => __( '', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
			
			
						  ),
		);



//post width
$meta_boxes[] = array(
		'title'  => __( 'Post Width', 'wish' ),
		'id'         => 'single_post_width',
		'post_types' => array( 'post'),
		
		'fields' => array(
							array(
								'name'  => __( 'Set post to full width?', 'wish' ),
								'id'    => "{$prefix}post_width",
								'desc'  => __( 'Featured image will hide, you can use banner as the featured image', 'wish' ),
								'type'  => 'checkbox',
								'std'   => 0,
							), 
		),
);






$meta_boxes[] = array(
		'title'  => __( 'Page Header', 'wish' ),
		'id'         => 'header_fields',
		'post_types' => array( 'page', 'post'),
		
		'fields' => array(
						array(
				'name'             => __( 'Page header Image', 'wish' ),
				'id'               => "{$prefix}header_bg",
				'type'             => 'thickbox_image',
			),  
						
						array(
				'name'  => __( 'Text to display under title', 'wish' ),
				'id'    => "{$prefix}under_title",
				'desc'  => __( '', 'wish' ),
				'type'  => 'textarea',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),


			array(
				'name'  => __( 'Show Banner?', 'wish' ),
				'id'    => "{$prefix}under_check",
				'desc'  => __( '', 'wish' ),
				'type'  => 'checkbox',
				'std'   => 0,
			),


			array(
				'name'  => __( 'Force Floating Menu?', 'wish' ),
				'id'    => "{$prefix}force_float_menu",
				'desc'  => __( '	floating main menu on this page. Make sure you have a banner image or slider on this page/post or else the layout wont look if you enable this field', 'wish' ),
				'type'  => 'checkbox',
				'std'   => 0,
			),


			array(
				'name'  => __( 'Force Different Footer?', 'wish' ),
				'id'    => "{$prefix}force_footer",
				'desc'  => __( 'Force the footer type on this page from the below field', 'wish' ),
				'type'  => 'select',
				'options'   => array(
									"0" => "Default",
									"1" => "Footer 1",
									"2" => "Footer 2",
									"3" => "Footer 3",
									"4" => "Footer 4",
									"5" => "Footer 5",
									"6" => "Footer 6",
								),
			),



						  
						  ),
		);




$meta_boxes[] = array(
		'title'  => __( 'Portfolio Details', 'wish' ),
		'id'         => 'portfolio_fields',
		'post_types' => array( 'wish_portfolio'),
		
		'fields' => array(
									array(
									'name' => __( 'Portfolio Url', 'wish' ),
									'id'   => "{$prefix}portfolio_url",
									'desc' => __( 'Enter Portfolio url', 'wish' ),
									'type' => 'url',
									'std'  => '',
								),	
									array(
									'name' => __( 'Double Height?', 'wish' ),
									'id'   => "{$prefix}portfolio_height",
									'desc' => __( 'Show Larger image in the portfolio', 'wish' ),
									'type' => 'checkbox',
								),


						  ),





		);
$meta_boxes[] = array(
		'title'  => __( 'Project Details', 'wish' ),
		'id'         => 'project_fields',
		'post_types' => array( 'wish_projects'),
		
		'fields' => array(
						array(
				'name'             => __( 'Uplod image for this project', 'wish' ),
				'id'               => "{$prefix}project_gal",
				'type'             => 'plupload_image',
				'max_file_uploads' => 100,
			), 
						array(
				'type' => 'divider',
				'id'   => 'fake_divider_id', // Not used, but needed
			),
						
						array(
				'name'  => __( 'Client', 'wish' ),
				'id'    => "{$prefix}project_client",
				'desc'  => __( 'Enter Client/company Name', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),

			array(
				'name'  => __( 'Subtitle', 'wish' ),
				'id'    => "{$prefix}project_subtitle",
				'desc'  => __( 'Enter Subtitle, will appear at the top of the project slider', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),


						array(
				'type' => 'divider',
				'id'   => 'fake_divider_id', // Not used, but needed
			),
						array(
				'name'       => __( 'Date', 'wish' ),
				'id'         => "{$prefix}project_date",
				'type'       => 'date',
				// jQuery date picker options. See here http://api.jqueryui.com/datepicker
				'js_options' => array(
					'appendText'      => __( '(yyyy-mm-dd)', 'wish' ),
					'dateFormat'      => __( 'yy-mm-dd', 'wish' ),
					'changeMonth'     => true,
					'changeYear'      => true,
					'showButtonPanel' => true,
				),
			),
						array(
				'type' => 'divider',
				'id'   => 'fake_divider_id', // Not used, but needed
			),
						array(
				'name' => __( 'Project Url', 'wish' ),
				'id'   => "{$prefix}project_url",
				'desc' => __( 'Enter project url', 'wish' ),
				'type' => 'url',
				'std'  => '',
			),
						array(
				'type' => 'divider',
				'id'   => 'fake_divider_id', // Not used, but needed
			),
						array(
				'name'    => __( 'About Project', 'wish' ),
				'id'      => "{$prefix}about_project",
				'type'    => 'wysiwyg',
				// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
				'raw'     => true,
				'std'     => __( 'Write few words about this project to show at the top of Project detail page.', 'wish' ),
				// Editor settings, see wp_editor() function: look4wp.com/wp_editor
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => true,
					'media_buttons' => false,
				),
			),
						array(
				'type' => 'divider',
				'id'   => 'fake_divider_id', // Not used, but needed
			),
						array(
				'name' => __( 'Featured', 'wish' ),
				'id'   => "{$prefix}is_project_featured",
				'type' => 'checkbox',
				'desc' => __( 'Do you want this post to be featured', 'wish' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
						  
						  ),
		);
$meta_boxes[] = array(
		'title'  => __( 'Post type Gallery', 'wish' ),
		'id'         => 'gallery_fields',
		'post_types' => array( 'post'),
		
		'fields' => array(
						array(
				'name'             => __( 'Uplod images for post type Gallery', 'wish' ),
				'id'               => "{$prefix}gallery_gal",
				'type'             => 'plupload_image',
				'max_file_uploads' => 100,
			), 
						  ),
		);
$meta_boxes[] = array(
		'title'  => __( 'Post type Video/Audio', 'wish' ),
		'id'         => 'video_fields',
		'post_types' => array( 'post'),
		
		'fields' => array(
						array(
				'name' => __( 'Enter a Video URL', 'wish' ),
				'id'   => "{$prefix}video",
				'desc' => __( 'Enter a youtube or vimeo URL. Supports services of Animoto, Blip, CollegeHumor, DailyMotion, Flickr, FunnyOrDie.com, Hulu, Imgur, Instagram, iSnare, Issuu, Meetup.com, EmbedArticles, Mixcloud, Photobucket, PollDaddy, Rdio, Revision3, Scribd, SlideShare, SmugMug, SoundCloud, Spotify, TED, Twitter, Vimeo, Vine, WordPress.tv, YouTube, Scribd<br /><i>Twitter - older versions of WordPress have issues with https embeds, just remove the s from the https to fix.</i><br /><i>YouTube - only public and "unlisted" videos and playlists - "private" videos will not embed.</i>', 'wish' ),
				'type' => 'oembed',
			),
						array(
				'name'  => __( 'Audio File', 'wish' ),
				'id'    => "{$prefix}audio",
				'desc'  => __( 'Enter url of your audio file for Audio post type e.g http://my.mp3s.com/cool/songs/coolest.mp3', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
						  ),
		);
	$meta_boxes[] = array(
		'title'  => __( 'Specific Comment to display below each post on detail page', 'wish' ),
		'id'         => 'specific_comment_field',
		'post_types' => array( 'posts'),
		
		'fields' => array(
						array(
				'name'    => __( 'Write Specific Comment here', 'wish' ),
				'id'      => "{$prefix}specific_comment",
				'type'    => 'wysiwyg',
				// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
				'raw'     => true,
				'std'     => __( '', 'wish' ),
				// Editor settings, see wp_editor() function: look4wp.com/wp_editor
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => true,
					'media_buttons' => false,
				),
			),
						array(
				'name'  => __( 'Comment Title', 'wish' ),
				'id'    => "{$prefix}comment_title",
				'desc'  => __( '', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
						array(
				'name'  => __( 'Comment Author Name', 'wish' ),
				'id'    => "{$prefix}comment_author",
				'desc'  => __( '', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
						array(
				'name'  => __( 'Company Name', 'wish' ),
				'id'    => "{$prefix}author_company",
				'desc'  => __( 'Enter company Name', 'wish' ),
				'type'  => 'text',
				'std'   => __( '', 'wish' ),
				'clone' => false,
			),
						  ),
		
		);		




		$meta_boxes[] = array(
								'title'  => __( 'Photography Images', 'wish' ),
								'id'         => 'photography_fields',
								'post_types' => array( 'wish_photography'),
								'fields' => array(
												array(
													'name'             => __( 'Uplod Photos', 'wish' ),
													'id'               => "{$prefix}photography_gal",
													'type'             => 'image_advanced',
													'max_file_uploads' => 100,
												), 
												array(
													'type' => 'divider',
													'id'   => 'fake_divider_id', // Not used, but needed
												),
											),
							);



					
	return $meta_boxes;
}

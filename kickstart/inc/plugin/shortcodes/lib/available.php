<?php

	/**
	 * List of available shortcodes
	 */
	function su_shortcodes( $shortcode = false ) {
	
	$menu_list = array();
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	foreach ( $menus as $menu ) {
		$menu_list[] = $menu->name;
	}
	
		$shortcodes = array(
			# basic shortcodes - start
			'basic-shortcodes-open' => array(
				'name' => __( 'Frequently Needed Shortcodes', 'mnky-admin' ),
				'type' => 'opengroup'
			),
				
				# column
				'column' => array(
					'name' => 'Columns',
					'type' => 'wrap',
					'atts' => array(
						'size' => array(
							'values' => array(
								'1-2',
								'1-3',
								'1-4',
								'1-5',
								'1-6',
								'2-3',
								'2-5',
								'3-4',
								'3-5',
								'4-5',
								'5-6'
							),
							'default' => '1-2',
							'desc' => __( 'Column width', 'mnky-admin' )
						),
						'last' => array(
							'values' => array(
								'0',
								'1'
							),
							'default' => '0',
							'desc' => __( 'Last column <span>(0 = false, 1 = true)</span>', 'mnky-admin' )
						)
					),
					'usage' => '[column size="1-2"] Content [/column]<br/>[column size="1-2" last="1"] Content [/column]',
					'content' => __( 'Column content', 'mnky-admin' ),
					'desc' => __( 'Flexible columns', 'mnky-admin' )
				),
				
				# heading
				'heading' => array(
					'name' => 'Heading',
					'type' => 'wrap',
					'atts' => array(
					),
					'usage' => '[heading] Content [/heading]',
					'content' => __( 'Heading text', 'mnky-admin' ),
					'desc' => __( 'Styled heading', 'mnky-admin' )
				),
								
				# spacer
				'spacer' => array(
					'name' => 'Spacer',
					'type' => 'single',
					'atts' => array(
						'size' => array(
							'values' => array( ),
							'default' => '20',
							'desc' => __( 'Spacer height in pixels', 'mnky-admin' )
						)
					),
					'usage' => '[spacer size="20"]',
					'desc' => __( 'Empty space with adjustable height (White space)', 'mnky-admin' )
				),
				
				# button
				'button' => array(
					'name' => 'Button',
					'type' => 'wrap',
					'atts' => array(
						'link' => array(
							'values' => array( ),
							'default' => '#',
							'desc' => __( 'Button link URL <span>(include http://)</span>', 'mnky-admin' )
						),
						'target' => array(
							'values' => array(
								'self',
								'blank'
							),
							'default' => 'self',
							'desc' => __( 'Button link target', 'mnky-admin' )
						),
						'icon' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Add icon <span>(optional)</span>', 'mnky-admin' ),
							'type' => 'icon'
						),
						'color' => array(
							'values' => array( ),
							'default' => ot_get_option('general_color'),
							'desc' => __( 'Button color <span>(clear to use "Primary theme color")</span>', 'mnky-admin' ),
							'type' => 'color'
						),
						'text' => array(
							'values' => array(
								'light',
								'dark'
							),
							'default' => 'light',
							'desc' => __( 'Text color', 'mnky-admin' )
						)
					),
					'usage' => '[button link="#" color="#b00" size="3" style="3" dark="1" square="1"] Button text [/button]',
					'content' => __( 'Button text', 'mnky-admin' ),
					'desc' => __( 'Styled button', 'mnky-admin' )
				),

				# service
				'service' => array(
					'name' => 'Service box',
					'type' => 'wrap',
					'atts' => array(
						'icon' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Add icon', 'mnky-admin' ),
							'type' => 'icon'
						),
						'size' => array(
							'values' => array( ),
							'default' => '25',
							'desc' => __( 'Icon size', 'mnky-admin' )
						),
						'color' => array(
							'values' => array( ),
							'default' => ot_get_option('general_color'),
							'desc' => __( 'Icon color <span>(clear to use "Primary theme color")</span>', 'mnky-admin' ),
							'type' => 'color'
						),
						'title' => array(
							'values' => array( ),
							'default' => 'Your service title',
							'desc' => __( 'Service title', 'mnky-admin' )
						),	
						'url' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'URL <span>(optional) (include http://)</span>', 'mnky-admin' )
						)
					),
					'usage' => '[service] Service text [/service]',
					'content' => __( 'Service description', 'mnky-admin' ),
					'desc' => __( 'Service box with custom icon', 'mnky-admin' )
				),
				
				# list
				'list' => array(
					'name' => 'List',
					'type' => 'wrap',
					'atts' => array(
						'icon' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Choose list item icon', 'mnky-admin' ),
							'type' => 'icon'
						),
						'color' => array(
							'values' => array( ),
							'default' => ot_get_option('general_color'),
							'desc' => __( 'Icon color <span>(clear to use "Primary theme color")</span>', 'mnky-admin' ),
							'type' => 'color'
						)
					),
					'usage' => '[list]',
					'content' => 'Item text',
					'desc' => __( 'List item with custom icon', 'mnky-admin' )
				),
				
				# fancy_link
				'fancy_link' => array(
					'name' => 'Fancy link',
					'type' => 'single',
					'atts' => array(
						'link_text' => array(
							'values' => array( ),
							'default' => 'Learn More',
							'desc' => __( 'Link text', 'mnky-admin' )
						),
						'url' => array(
							'values' => array( ),
							'default' => '#',
							'desc' => __( 'URL <span>(include http://)</span>', 'mnky-admin' )
						),
						'float' => array(
							'values' => array(
								'none',
								'left',
								'right'
							),
							'default' => 'none',
							'desc' => __( 'Choose left or right link position', 'mnky-admin' ),
						)
						
					),
					'usage' => '[fancy_link] Read more [/fancy_link]',
					'content' => __( 'Link text', 'mnky-admin' ),
					'desc' => __( 'Styled link', 'mnky-admin' )
				),
				
				# divider
				'divider' => array(
					'name' => 'Divider',
					'type' => 'single',
					'atts' => array(
						'style' => array(
							'values' => array(
								'default',
								'with-link-to-top',
								'with-bottom-pointer',
								'with-top-pointer'
							),
							'default' => 'default',
							'desc' => __( 'Choose divider style', 'mnky-admin' )
						),
						'color' => array(
								'values' => array( ),
								'default' => '#E7E7E7',
								'desc' => __( 'Divider color', 'mnky-admin' ),
								'type' => 'color'
						)				
					),
					'usage' => '[divider top="1"]',
					'desc' => __( 'Content divider with 4 styles', 'mnky-admin' )
				),
			
			# basic shortcodes - end
			'basic-shortcodes-close' => array(
				'type' => 'closegroup'
			),
			
			# slider shortcodes - start
			'slider-shortcodes-open' => array(
				'name' => __( 'Slider Shortcodes', 'mnky-admin' ),
				'type' => 'opengroup'
			),
				
	
				# Featured post carousel
				'fp_carousel' => array(
					'name' => 'Post carousel',
					'type' => 'single',
					'atts' => array(
						'width' => array(
							'values' => false,
							'default' => '940',
							'desc' => __( 'Slider width', 'mnky-admin' )
						),
						'height' => array(
							'values' => false,
							'default' => '200',
							'desc' => __( 'Slider height <span>(min = 130)</span>', 'mnky-admin' )
						),
						'items' => array(
							'values' => array(
								'3',
								'4',
								'5'
							),
							'default' => '5',
							'desc' => __( 'Number of items in one slide', 'mnky-admin' )
						),
						'num' => array(
							'values' => false,
							'default' => '-1',
							'desc' => __( 'How many post rotate <span>(-1 = all posts)</span>', 'mnky-admin' )
						),
						'speed' => array(
							'values' => false,
							'default' => '600',
							'desc' => __( 'Animation speed <span>(1000 = 1 second)</span>', 'mnky-admin' )
						),
						'cat' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Category <span>SLUG</span>', 'mnky-admin' )
						),
						'tag' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Tag <span>SLUG</span>', 'mnky-admin' )
						),
						'orderby' => array(
							'values' => array(
								'ID',
								'author',
								'title',
								'date',
								'modified',
								'parent',
								'rand',
								'comment_count'	
							),
							'default' => 'date',
							'desc' => __( 'Order by', 'mnky-admin' )
						),
						'post_type' => array(
							'values' => false,
							'default' => 'post',
							'desc' => __( 'Post type', 'mnky-admin' )
						),
						'include' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Include <span>(post IDs comma separated)</span>', 'mnky-admin' )
						),
						'exclude' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Exclude <span>(post IDs comma separated)</span>', 'mnky-admin' )
						)
					),
					'usage' => '[fp_carousel]',
					'desc' => __( 'Featured post slider', 'mnky-admin' )
				),
				
				# nivo_slider
				'nivo_slider' => array(
					'name' => 'Nivo slider',
					'type' => 'single',
					'atts' => array(
						'width' => array(
							'values' => false,
							'default' => '940',
							'desc' => __( 'Slider width', 'mnky-admin' )
						),
						'height' => array(
							'values' => false,
							'default' => '300',
							'desc' => __( 'Slider height', 'mnky-admin' )
						),
						'link' => array(
							'values' => array(
								'none',
								'file',
								'attachment',
								'caption'
							),
							'default' => 'none',
							'desc' => __( 'Slide link', 'mnky-admin' )
						),
						'speed' => array(
							'values' => false,
							'default' => '600',
							'desc' => __( 'Animation speed <span>(1000 = 1 second)</span>', 'mnky-admin' )
						),
						'delay' => array(
							'values' => false,
							'default' => '3000',
							'desc' => __( 'Animation delay <span>(1000 = 1 second)</span>', 'mnky-admin' )
						),
						'navigation' => array(
							'values' => array(
								'0',
								'1'
							),
							'default' => '1',
							'desc' => __( 'Show navigation? <span>(0 = false, 1 = true)</span>', 'mnky-admin' )
						),						
						'bullets' => array(
							'values' => array(
								'0',
								'1'
							),
							'default' => '1',
							'desc' => __( 'Show bullets? <span>(0 = false, 1 = true)</span>', 'mnky-admin' )
						),
						'pauseonhover' => array(
							'values' => array(
								'0',
								'1'
							),
							'default' => '0',
							'desc' => __( 'Stop animation on hover? <span>(0 = false, 1 = true)</span>', 'mnky-admin' )
						),
						'p' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Post/page ID <span>(Leave empty to use this page)</span>', 'mnky-admin' )
						),
						'effect' => array(
							'values' => array(
								'sliceDown',
								'sliceDownLeft',
								'sliceUp',
								'sliceUpLeft',
								'sliceUpDown',
								'sliceUpDownLeft',
								'fold',
								'fade',
								'random',
								'slideInRight',
								'slideInLeft',
								'boxRandom',
								'boxRain',
								'boxRainReverse',
								'boxRainGrow',
								'boxRainGrowReverse'
							),
							'default' => 'random',
							'desc' => __( 'Animation effect', 'mnky-admin' )
						)
					),
					'usage' => '[nivo_slider]<br/>[nivo_slider width="600" height="300" link="file" effect="boxRandom"]',
					'desc' => __( 'Nivo slider by attached to post images', 'mnky-admin' )
				),
							
			# slider shortcodes - end
			'slider-shortcodes-close' => array(
				'type' => 'closegroup'
			),
			
			
			# content shortcodes - start
			'content-shortcodes-open' => array(
				'name' => __( 'Other Shortcodes', 'mnky-admin' ),
				'type' => 'opengroup'
			),
			
				# background
				'background' => array(
					'name' => 'Background block',
					'type' => 'wrap',
					'atts' => array(
						'color' => array(
							'values' => array( ),
							'default' => ot_get_option('general_color'),
							'desc' => __( 'Background color <span>(clear to use "Primary theme color")</span>', 'mnky-admin' ),
							'type' => 'color'
						),
						'image' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Background image URL <span>(repeated pattern) (include http://)</span>', 'mnky-admin' ),
						),
						'align' => array(
							'values' => array(
								'center',
								'left',
								'right'
							),
							'default' => 'center',
							'desc' => __( 'Text align', 'mnky-admin' )
						),
						'margin_top' => array(
							'values' => array( ),
							'default' => __( '0', 'mnky-admin' ),
							'desc' => __( 'Margin from top<span>(Can be negative. Example: -40)</span>', 'mnky-admin' )
						),
						'margin_bottom' => array(
							'values' => array( ),
							'default' => __( '40', 'mnky-admin' ),
							'desc' => __( 'Margin from bottom<span>(Can be negative. Example: -40)</span>', 'mnky-admin' )
						),
						'padding_top' => array(
							'values' => array( ),
							'default' => __( '40', 'mnky-admin' ),
							'desc' => __( 'Padding top', 'mnky-admin' )
						),
						'padding_bottom' => array(
							'values' => array( ),
							'default' => __( '40', 'mnky-admin' ),
							'desc' => __( 'Padding bottom', 'mnky-admin' )
						)
					),
					'usage' => '[background color="#FFCC00"] Content [/background]',
					'content' => __( 'Content', 'mnky-admin' ),
					'desc' => __( 'Add custom background to content', 'mnky-admin' )
				),				
				# quote
				'quote' => array(
					'name' => 'Quote',
					'type' => 'wrap',
					'atts' => array(
						'author' => array(
								'values' => array( ),
								'default' => __( 'Author Name', 'mnky-admin' ),
								'desc' => __( 'Author of a Quote <span>(Can be empty)</span>', 'mnky-admin' )
						)
					),
					'usage' => '[quote] Content [/quote]',
					'content' => __( 'Quote text', 'mnky-admin' ),
					'desc' => __( 'Blockquote alternative', 'mnky-admin' )
				),
				# pullquote
				'pullquote' => array(
					'name' => 'Pullquote',
					'type' => 'wrap',
					'atts' => array(
						'align' => array(
							'values' => array(
								'left',
								'right'
							),
							'default' => 'left',
							'desc' => __( 'Pullquote alignment', 'mnky-admin' )
						)
					),
					'usage' => '[pullquote align="left"] Content [/pullquote]',
					'content' => __( 'Pullquote', 'mnky-admin' ),
					'desc' => __( 'Styled pullquote', 'mnky-admin' )
				),
				
				# testimonials
				'testimonials_slider' => array(
					'name' => 'Testimonials slider',
					'type' => 'wrap',
					'atts' => array(
					),
					'usage' => '[testimonials_slider][testimonial author="autrhor"] Tab content [/testimonial] [testimonials]',
					'content' => __( '[testimonial author=&quot;Author Name&quot;] Quote text [/testimonial][testimonial author=&quot;Author Name&quot;] Quote text 2[/testimonial]', 'mnky-admin' ),
					'desc' => __( 'Testimonials slider (used with "Testimonial" shortcode)', 'mnky-admin' )
				),
				# testimonial
				'testimonial' => array(
					'name' => 'Testimonial',
					'type' => 'wrap',
					'atts' => array(
						'author' => array(
							'values' => array( ),
							'default' => __( 'Author Name', 'mnky-admin' ),
							'desc' => __( 'Author', 'mnky-admin' )
						)
					),
					'usage' => '[testimonials] [testimonial author="autrhor"] content [/testimonial] [/testimonials]',
					'content' => __( 'Testimonial text', 'mnky-admin' ),
					'desc' => __( 'User testimonial', 'mnky-admin' )
				),
				# testimonial image
				'img_testimonial' => array(
					'name' => 'Testimonial with image',
					'type' => 'wrap',
					'atts' => array(
						'img' => array(
							'values' => array( ),
							'default' => __( '', 'mnky-admin' ),
							'desc' => __( 'Image URL <span>(include http://)</span>', 'mnky-admin' )
						),						
						'author' => array(
							'values' => array( ),
							'default' => __( 'Author Name', 'mnky-admin' ),
							'desc' => __( 'Author', 'mnky-admin' )
						)
					),
					'usage' => '[testimonials] [testimonial author="autrhor"] content [/testimonial] [/testimonials]',
					'content' => __( 'Testimonial text', 'mnky-admin' ),
					'desc' => __( 'Large testimonial with user photo', 'mnky-admin' )
				),
		
				
				# highlight
				'highlight' => array(
					'name' => 'Highlight',
					'type' => 'wrap',
					'atts' => array(
						'bg' => array(
							'values' => array( ),
							'default' => '#DDFF99',
							'desc' => __( 'Background color', 'mnky-admin' ),
							'type' => 'color'
						),
						'color' => array(
							'values' => array( ),
							'default' => '#000000',
							'desc' => __( 'Text color', 'mnky-admin' ),
							'type' => 'color'
						)
					),
					'usage' => '[highlight bg="#fc0" color="#000"] Content [/highlight]',
					'content' => __( 'Highlighted text', 'mnky-admin' ),
					'desc' => __( 'Highlighted text', 'mnky-admin' )
				),
				
				# dropcap
				'dropcap' => array(
					'name' => 'Dropcap',
					'type' => 'wrap',
					'atts' => array(
						'bg' => array(
							'values' => array( ),
							'default' => '#222222',
							'desc' => __( 'Background color', 'mnky-admin' ),
							'type' => 'color'
						),
						'color' => array(
							'values' => array( ),
							'default' => '#ffffff',
							'desc' => __( 'Text color', 'mnky-admin' ),
							'type' => 'color'
						)
					),
					'usage' => '[dropcap style=""] [/dropcap]',
					'content' => 'A',
					'desc' => __( 'Styled dropcaps', 'mnky-admin' )
				),
				

				# box
				'box' => array(
					'name' => 'Box',
					'type' => 'wrap',
					'atts' => array(
						'title' => array(
							'values' => array( ),
							'default' => __( 'Box title', 'mnky-admin' ),
							'desc' => __( 'Box title', 'mnky-admin' )
						),
						'color' => array(
							'values' => array( ),
							'default' => '#333333',
							'desc' => __( 'Box color', 'mnky-admin' ),
							'type' => 'color'
						)
					),
					'usage' => '[box title="Box title" color="#f00"] Content [/box]',
					'content' => __( 'Box content', 'mnky-admin' ),
					'desc' => __( 'Colored box with title', 'mnky-admin' )
				),
				# note
				'note' => array(
					'name' => 'Note',
					'type' => 'wrap',
					'atts' => array(
						'color' => array(
							'values' => array( ),
							'default' => '#FFCC00',
							'desc' => __( 'Note color', 'mnky-admin' ),
							'type' => 'color'
						)
					),
					'usage' => '[note color="#FFCC00"] Content [/note]',
					'content' => __( 'Note text', 'mnky-admin' ),
					'desc' => __( 'Colored note box', 'mnky-admin' )
				),
				# callout
				'callout' => array(
					'name' => 'Call Out',
					'type' => 'wrap',
					'atts' => array(
							'add_button' => array(
								'values' => array(
									'yes',
									'no'
								),
								'default' => 'no',
								'desc' => __( 'Show button?', 'mnky-admin' )
							),
							'button_text' => array(
								'values' => array( ),
								'default' => __( 'Learn More', 'mnky-admin' ),
								'desc' => __( 'Button text', 'mnky-admin' )
							),
							'button_url' => array(
								'values' => array( ),
								'default' => __( '#', 'mnky-admin' ),
								'desc' => __( 'Button URL <span>(include http://)</span>', 'mnky-admin' )
							),
							'button_icon' => array(
								'values' => array( ),
								'default' => '',
								'desc' => __( 'Button Icon <span>(optional)</span>', 'mnky-admin' ),
								'type' => 'icon'
							),
							'button_color' => array(
								'values' => array( ),
								'default' => ot_get_option('general_color'),
								'desc' => __( 'Button color <span>(clear to use "Primary theme color")</span>', 'mnky-admin' ),
								'type' => 'color'
							)
					),		
					'usage' => '[callout color="#FFCC00"] Content [/callout]',
					'content' => __( '<h4><strong>This is title</strong></h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur mollis nisl.', 'mnky-admin' ),
					'desc' => __( 'Call out box', 'mnky-admin' )
				),			
								
				# latest works
				'latest_works' => array(
					'name' => 'Latest works',
					'type' => 'single',
					'atts' => array(
						'category' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Category SLUG', 'mnky-admin' )
						),
						'num' => array(
							'values' => false,
							'default' => '4',
							'desc' => __( 'Number of posts', 'mnky-admin' )
						),
						'orderby' => array(
							'values' => array(
								'ID',
								'author',
								'title',
								'date',
								'modified',
								'parent',
								'rand'
							),
							'default' => 'date',
							'desc' => __( 'Order by', 'mnky-admin' )
						),
						'order' => array(
							'values' => array(
								'ASC',
								'DESC'
							),
							'default' => 'DESC',
							'desc' => __( 'Order', 'mnky-admin' )
						),
						'include' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Include <span>(comma separated IDs)</span>', 'mnky-admin' )
						),
						'exclude' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Exclude <span>(comma separated IDs)</span>', 'mnky-admin' )
						),
						'offset' => array(
							'values' => false,
							'default' => '0',
							'desc' => __( 'Offset', 'mnky-admin' )
						),
					),
					'usage' => '',
					'content' => '[spoiler]',
					'desc' => __( 'Show latest entries from portfolio', 'mnky-admin' )
				),
				
				# post shortcode
				'show_posts' => array(
					'name' => 'Show posts',
					'type' => 'single',
					'atts' => array(
						'category' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Category SLUG', 'mnky-admin' )
						),
						'tag' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Tag SLUG', 'mnky-admin' )
						),
						'type' => array(
							'values' => array(
								'excerpt',
								'thumbnail-excerpt',
								'full-content'
							),
							'default' => 'excerpt',
							'desc' => __( 'Content type', 'mnky-admin' )
						),	
						'excerpt_words' => array(
							'values' => false,
							'default' => '18',
							'desc' => __( 'Words in excerpt', 'mnky-admin' )
						),
						'limit' => array(
							'values' => false,
							'default' => '3',
							'desc' => __( 'Number of posts', 'mnky-admin' )
						),
						'paging' => array(
							'values' => array(
								'false',
								'true'
							),
							'default' => 'false',
							'desc' => __( 'Show paging?', 'mnky-admin' )
						),
						'orderby' => array(
							'values' => array(
								'ID',
								'author',
								'title',
								'date',
								'modified',
								'parent',
								'rand',
								'comment_count'	
							),
							'default' => 'date',
							'desc' => __( 'Order by', 'mnky-admin' )
						),
						'order' => array(
							'values' => array(
								'ASC',
								'DESC'
							),
							'default' => 'DESC',
							'desc' => __( 'Order', 'mnky-admin' )
						),	
						'offset' => array(
							'values' => false,
							'default' => '0',
							'desc' => __( 'Offset', 'mnky-admin' )
						),
						'post_type' => array(
							'values' => false,
							'default' => 'post',
							'desc' => __( 'Post type', 'mnky-admin' )
						),
						'id' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Post ID', 'mnky-admin' )
						)
					),
					'usage' => '[show_posts]',
					'desc' => __( 'Display your latest posts or posts from certain categories', 'mnky-admin' )
				),
				
				# accordion
				'accordion' => array(
					'name' => 'Accordion',
					'type' => 'wrap',
					'atts' => array( ),
					'usage' => '[accordion]<br/>[spoiler open="true"] content [/spoiler]<br/>[spoiler] content [/spoiler]<br/>[spoiler] content [/spoiler]<br/>[/accordion]',
					'content' => '[spoiler] content [/spoiler][spoiler] content 2 [/spoiler]',
					'desc' => __( 'Toggle view content / FAQ', 'mnky-admin' )
				),
						
				# spoiler
				'spoiler' => array(
					'name' => 'Spoiler',
					'type' => 'wrap',
					'atts' => array(
						'title' => array(
							'values' => array( ),
							'default' => __( 'Spoiler title', 'mnky-admin' ),
							'desc' => __( 'Spoiler title', 'mnky-admin' )
						),
						'open' => array(
							'values' => array(
								'0',
								'1'
							),
							'default' => '0',
							'desc' => __( 'Open by default? <span>(0 = false, 1 = true)</span>', 'mnky-admin' )
						),
						'style' => array(
							'values' => array(
								'1',
								'2'
							),
							'default' => '1',
							'desc' => __( 'Spoiler style', 'mnky-admin' )
						)
					),
					'usage' => '[spoiler title="Spoiler title"] Hidden text [/spoiler]',
					'content' => __( 'Hidden content', 'mnky-admin' ),
					'desc' => __( 'Toggle hidden text / FAQ', 'mnky-admin' )
				),
			
				# staff
				'staff' => array(
					'name' => 'Staff',
					'type' => 'wrap',
					'atts' => array(
						'name' => array(
							'values' => array( ),
							'default' => 'Full Name',
							'desc' => __( 'Persons Name', 'mnky-admin' )
						),				
						'position' => array(
							'values' => array( ),
							'default' => 'Designer',
							'desc' => __( 'Job title', 'mnky-admin' )
						),
						'img' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Image URL <span>(include http://)</span>', 'mnky-admin' )
						)
					),
					
					'usage' => '[staff name="Full Name" position="job position"] Content [/staff]',
					'content' => __( 'Description about staff member', 'mnky-admin' ),
					'desc' => __( 'Information about staff/team members', 'mnky-admin' )
				),
				
				# skillbar
				'skillbar' => array(
					'name' => 'Skillbar',
					'type' => 'single',
					'atts' => array(
						'title' => array(
							'values' => array( ),
							'default' => 'WordPress',
							'desc' => __( 'Bar title', 'mnky-admin' )
						),
						'level' => array(
							'values' => array( ),
							'default' => '80',
							'desc' => __( 'Level', 'mnky-admin' )
						)
					),
					'usage' => '[skill]',
					'desc' => __( 'Show skill level', 'mnky-admin' )
				),				
								
				# tabs
				'tabs' => array(
					'name' => 'Tabs',
					'type' => 'wrap',
					'atts' => array(
						'style' => array(
							'values' => array(
								'1',
								'2'
							),
							'default' => '1',
							'desc' => __( 'Tabs style', 'mnky-admin' )
						)
					),
					'usage' => '[tabs style="1"] [tab title="Tab name"] Tab content [/tab] [/tabs]',
					'content' => '[tab title=&quot;Tab name&quot;] Tab content [/tab][tab title=&quot;Tab name 2&quot;] Tab content 2[/tab]',
					'desc' => __( 'Tabs container (Use with TAB shortcode)', 'mnky-admin' )
				),
				# tab
				'tab' => array(
					'name' => 'Tab',
					'type' => 'wrap',
					'atts' => array(
						'title' => array(
							'values' => array( ),
							'default' => __( 'Title', 'mnky-admin' ),
							'desc' => __( 'Tab title', 'mnky-admin' )
						),
						'icon' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Icon', 'mnky-admin' ),
							'type' => 'icon'
						)
					),
					'usage' => '[tabs style="1"] [tab title="Tab name"] Tab content [/tab] [/tabs]',
					'content' => __( 'Tab content', 'mnky-admin' ),
					'desc' => __( 'Single tab', 'mnky-admin' )
				),
								
				# clients
				'client' => array(
					'name' => 'Client',
					'type' => 'single',
					'atts' => array(
						'logo' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Logo IMG URL<span>(min width: 280px) (include http://)</span>', 'mnky-admin' )
						),
						'link' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Client container URL <span>(optional) (include http://)</span>', 'mnky-admin' )
						),
						'align' => array(
							'values' => array(
								'center',
								'left',
								'right'
							),
							'default' => 'center',
							'desc' => __( 'Image align', 'mnky-admin' )
						)
					),
					'usage' => '[client]',
					'desc' => __( 'Add styled client or partner logo', 'mnky-admin' )
				),
				
				# pricing box
				'pricing' => array(
					'name' => 'Pricing box',
					'type' => 'wrap',
					'atts' => array(
						'color' => array(
							'values' => array( ),
							'default' => '#2b2b2b',
							'desc' => __( 'Background color', 'mnky-admin' ),
							'type' => 'color'
						),
						'title' => array(
							'values' => array( ),
							'default' => __( 'This is title', 'mnky-admin' ),
							'desc' => __( 'Box title', 'mnky-admin' )
						),
						'currency' => array(
							'values' => array( ),
							'default' => __( '$', 'mnky-admin' ),
							'desc' => __( 'Offer currency', 'mnky-admin' )
						),
						'price' => array(
							'values' => array( ),
							'default' => __( '10', 'mnky-admin' ),
							'desc' => __( 'Offer price', 'mnky-admin' )
						),
						'period' => array(
							'values' => array( ),
							'default' => __( '/mo', 'mnky-admin' ),
							'desc' => __( 'Offer period', 'mnky-admin' )
						),
						'slug' => array(
							'values' => array( ),
							'default' => __( '', 'mnky-admin' ),
							'desc' => __( 'Small info under price<span>(optional)</span>', 'mnky-admin' )
						)
					),
					'usage' => '[pricing] Content [/pricing]',
					'content' => '<ul><li>20GB Storage</li><li>1024MB Ram</li><li>C-panel</li><li>INSERT BUTTON HERE</li></ul>',
					'desc' => __( 'Styled pricing boxes', 'mnky-admin' )
				),

				# menu
				'sitemap' => array(
					'name' => 'Sitemap',
					'type' => 'single',
					'atts' => array(
						'name' => array(
							'values' => $menu_list,
							'default' => '',
							'desc' => __( 'Choose custom menu', 'mnky-admin' )
						)
					),
					'usage' => '[sitemap name="Main menu"]',
					'desc' => __( 'Sitemap style for custom menu', 'mnky-admin' )
				),

				# document
				'document' => array(
					'name' => 'Document',
					'type' => 'single',
					'atts' => array(
						'file' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Document URL <span>(include http://)</span>', 'mnky-admin' )
						),
						'width' => array(
							'values' => false,
							'default' => '600',
							'desc' => __( 'Width', 'mnky-admin' )
						),
						'height' => array(
							'values' => false,
							'default' => '400',
							'desc' => __( 'Height', 'mnky-admin' )
						)
					),
					'usage' => '[document file="file.doc" width="600" height="400"]',
					'desc' => __( '.doc, .xls, .pdf viewer by Google', 'mnky-admin' )
				),
				
				
				# gmap
				'gmap' => array(
					'name' => 'Gmap',
					'type' => 'single',
					'atts' => array(
						'width' => array(
							'values' => false,
							'default' => '600',
							'desc' => __( 'Width', 'mnky-admin' )
						),
						'height' => array(
							'values' => false,
							'default' => '400',
							'desc' => __( 'Height', 'mnky-admin' )
						),
						'address' => array(
							'values' => false,
							'default' => '',
							'desc' => __( 'Marker address', 'mnky-admin' )
						),
					),
					'usage' => '[gmap width="600" height="400" address="Russia, Moscow"]',
					'desc' => __( 'Maps by Google', 'mnky-admin' )
				),
			
				# clear
				'clear' => array(
					'name' => 'Clear',
					'type' => 'single',
					'atts' => array(),
					'usage' => '[clear]',
					'desc' => __( 'Clear floats after elements', 'mnky-admin' )
				),
			
			# content shortcodes - end
			'content-shortcodes-close' => array(
				'type' => 'closegroup'
			),
			
		);

		if ( $shortcode )
			return $shortcodes[$shortcode];
		else
			return $shortcodes;
	}

?>
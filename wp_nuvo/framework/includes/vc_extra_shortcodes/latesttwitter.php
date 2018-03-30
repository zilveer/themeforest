<?php
vc_map ( array (
		"name" => 'Latest Twitter',
		"base" => "cs-latest-twitter",
		"icon" => "cs_icon_for_vc",
		"category" => __ ( 'CS Hero', 'wp_nuvo' ),
		"description" => __ ('Latest Twitter Carousel (Horizontal & Vertical)','wp_nuvo'),
		"params" => array (
				array (
						"type" => "textfield",
						"value" => "",
						"heading" => __ ( 'Title', 'wp_nuvo' ),
						"param_name" => "twittertitle"
				),
				array (
						"type" => "dropdown",
						"heading" => __ ( "Heading size", 'wp_nuvo' ),
						"param_name" => "heading_size",
						"value" => array (
								"Heading 1" => "h1",
								"Heading 2" => "h2",
								"Heading 3" => "h3",
								"Heading 4" => "h4",
								"Heading 5" => "h5",
								"Heading 6" => "h6"
						),
						"description" => 'Select your heading size for title.'
				),
				array (
						"type" => "textfield",
						"value" => "2Jd4h7mTLRi7XHlWMpX4w",
						"heading" => __ ( 'Consumer key', 'wp_nuvo' ),
						"param_name" => "consumerkey"
				),
				array (
						"type" => "textfield",
						"value" => "M3n1cMi3HPSmpKUJNgdPFmzjlDkXIDRTf1oHZIkM",
						"heading" => __ ( 'Consumer secret', 'wp_nuvo' ),
						"param_name" => "consumersecret"
				),
				array (
						"type" => "textfield",
						"value" => "1406608410-6TbCsgWzjqWD2aagTslnPd4ShxbWP9ZoFyXbiEN",
						"heading" => __ ( 'Access token', 'wp_nuvo' ),
						"param_name" => "accesstoken"
				),
				array (
						"type" => "textfield",
						"value" => "bnd86DE8Rm8A93MlwnylOGlWc8dvmQHrjzQT8BaI",
						"heading" => __ ( 'Accesstoken secret', 'wp_nuvo' ),
						"param_name" => "accesstokensecret"
				),
				array (
						"type" => "textfield",
						"value" => "realjoomlaman",
						"heading" => __ ( 'Username', 'wp_nuvo' ),
						"param_name" => "username"
				),
				array (
						"type" => "dropdown",
						"value" => array (
								"1",
								"2",
								"3",
								"4",
								"5",
								"6",
								"7",
								"8",
								"9",
								"10"
						),
						"heading" => __ ( 'Tweets to show', 'wp_nuvo' ),
						"param_name" => "tweetstoshow"
				),
				array (
						"type" => "dropdown",
						"value" => array (
								"Yes"=>'yes',
								"No"=> 'no'
						),
						"heading" => __ ( 'Show Date', 'wp_nuvo' ),
						"param_name" => "showavatar"
				),
		)
) );
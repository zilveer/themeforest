<?php
/*
 * 
 */

 
function ntl_social_settings() {		
	$soclist = array("Facebook", "Twitter", "Google Plus", "Linkedin", "Digg", "Reddit", "RSS", "Stumbleupon", "Delicious");	
	$outputs = '<span class="lefter" style="width: 680px"><span class="lefterinner" style="width: 660px">';	
	$outputs .= '<h4><span>Fonts<span></h4>';		
	$outputs .= ntl_build_soc($soclist);	
	$outputs .= '<br class="clear"></span></span>';	
	echo $outputs;		
}
 
function ntl_slidepage_settings() {
	
	$outputs = '';	
	$outputs .= ntl_create_box(	
		'option', 														// TYPE: 		either post number or 'option'
		'options',														// INPUTTYPE:	type of input to create
		'<span class="lefter2">',										// BEFORE:		content before
		__('Transition Type', 'localize'), 								// HEADING: 	heading
		__('Select the transition type of the slideshow', 'localize'), 	// DESCRIPTION: description
		'ntl_trans_type',												// NAME: 		input name
		'',																// CLASS:		css class to add
		array("cube", "cubeRandom", "block", "cubeStop", "cubeHide", "cubeSize", "horizontal", "showBars", "showBarsRandom", "tube", "fade", "fadeFour", "paralell", "blind", "blindHeight", "blindWidth", "directionTop", "directionBottom", "directionRight","directionLeft", "cubeStopRandom", "cubeSpread", "cubeJelly", "glassCube", "glassBlock", "circles", "circlesInside","circlesRotate", "random", "randomSmart")
		// OPTION:		options and arrays		
	);	
	$outputs .= ntl_create_box(	
		'option', 														// TYPE: 		either post number or 'option'
		'value',														// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',								// BEFORE:		content before
		__('Transition Time', 'localize'), 								// HEADING: 	heading
		__('Time Between Slide Transitions in seconds', 'localize'), 	// DESCRIPTION: description
		'ntl_trans_time',												// NAME: 		input name
		'',																// CLASS:		css class to add
		''																// OPTION:		options and arrays		
	);			
	
	$outputs .= ntl_create_box(	
		'option', 															// TYPE: 		either post number or 'option'
		'options',															// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',									// BEFORE:		content before
		__('Slider Type', 'localize'), 										// HEADING: 	heading
		__('Click to select your slideshow type', 'localize'), 				// DESCRIPTION: description
		'ntl_slide_type',													// NAME: 		input name
		'',																	// CLASS:		css class to add
		array('image','content')											// OPTION:		options and arrays		
	);	
	
	
	$outputs .= '</span>';					
	echo $outputs;		
}

function ntl_mailmessage_settings() {
		
	$outputs = '';				
	$outputs .= ntl_create_box(	
		'option', 																								// TYPE: 		either post number or 'option'
		'header',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		'', 																									// HEADING: 	heading
		__('<strong>email sent to admin when a new person signs up for a newsletter</strong> ', 'localize'), 	// DESCRIPTION: description
		'',																										// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);	
	$outputs .= ntl_create_box(	
		'option', 										// TYPE: 		either post number or 'option'
		'textarea',										// INPUTTYPE:	type of input to create
		'',												// BEFORE:		content before
		__('Subjectline', 'localize'), 					// HEADING: 	heading
		__('Subjectline of the message', 'localize'), 	// DESCRIPTION: description
		'ntl_newssignup_admin_s',						// NAME: 		input name
		'lefterinnertop',								// CLASS:		css class to add
		2												// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 										// TYPE: 		either post number or 'option'
		'textarea',										// INPUTTYPE:	type of input to create
		'',												// BEFORE:		content before
		__('Body', 'localize'), 						// HEADING: 	heading
		__('Body of the message', 'localize'), 			// DESCRIPTION: description
		'ntl_newssignup_admin',							// NAME: 		input name
		'lefterinnertop',								// CLASS:		css class to add
		6												// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 																						// TYPE: 		either post number or 'option'
		'header',																						// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																// BEFORE:		content before
		'', 																							// HEADING: 	heading
		__('<strong>email sent to the person who signed up for the newsletter</strong> ', 'localize'), 	// DESCRIPTION: description
		'',																								// NAME: 		input name
		'',																								// CLASS:		css class to add
		''																								// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 										// TYPE: 		either post number or 'option'
		'textarea',										// INPUTTYPE:	type of input to create
		'',												// BEFORE:		content before
		__('Subjectline', 'localize'), 					// HEADING: 	heading
		__('Subjectline of the message', 'localize'), 	// DESCRIPTION: description
		'ntl_newssignup_customer_s',					// NAME: 		input name
		'lefterinnertop',								// CLASS:		css class to add
		2												// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 										// TYPE: 		either post number or 'option'
		'textarea',										// INPUTTYPE:	type of input to create
		'',												// BEFORE:		content before
		__('Body', 'localize'), 						// HEADING: 	heading
		__('Body of the message', 'localize'), 			// DESCRIPTION: description
		'ntl_newssignup_customer',						// NAME: 		input name
		'lefterinnertop',								// CLASS:		css class to add
		6												// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 																						// TYPE: 		either post number or 'option'
		'header',																						// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																// BEFORE:		content before
		'', 																							// HEADING: 	heading
		__('<strong>email sent to the person who signed up  for a reminder</strong> ', 'localize'), 	// DESCRIPTION: description
		'',																								// NAME: 		input name
		'',																								// CLASS:		css class to add
		''																								// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 										// TYPE: 		either post number or 'option'
		'textarea',										// INPUTTYPE:	type of input to create
		'',												// BEFORE:		content before
		__('Subjectline', 'localize'), 					// HEADING: 	heading
		__('Subjectline of the message', 'localize'), 	// DESCRIPTION: description
		'ntl_remindersignup_customer_s',				// NAME: 		input name
		'lefterinnertop',								// CLASS:		css class to add
		2												// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 										// TYPE: 		either post number or 'option'
		'textarea',										// INPUTTYPE:	type of input to create
		'',												// BEFORE:		content before
		__('Body', 'localize'), 						// HEADING: 	heading
		__('Body of the message', 'localize'), 			// DESCRIPTION: description
		'ntl_remindersignup_customer',					// NAME: 		input name
		'lefterinnertop',								// CLASS:		css class to add
		6												// OPTION:		options and arrays		
	);										
	$outputs .= '</span><br class="clear" /><span class="thehr">&nbsp;</span>';
	$outputs .= ntl_create_box(	
		'option', 														// TYPE: 		either post number or 'option'
		'header',														// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',								// BEFORE:		content before
		'', 															// HEADING: 	heading
		__('<strong>Reminder message sent out</strong>', 'localize'), 	// DESCRIPTION: description
		'',																// NAME: 		input name
		'',																// CLASS:		css class to add
		''																// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 										// TYPE: 		either post number or 'option'
		'textarea',										// INPUTTYPE:	type of input to create
		'',												// BEFORE:		content before
		__('Subjectline', 'localize'), 					// HEADING: 	heading
		__('Subjectline of the message', 'localize'), 	// DESCRIPTION: description
		'ntl_reminders_customer_s',						// NAME: 		input name
		'lefterinnertop',								// CLASS:		css class to add
		2												// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 										// TYPE: 		either post number or 'option'
		'textarea',										// INPUTTYPE:	type of input to create
		'',												// BEFORE:		content before
		__('Body', 'localize'), 						// HEADING: 	heading
		__('Body of the message', 'localize'), 			// DESCRIPTION: description
		'ntl_reminders_customer',						// NAME: 		input name
		'lefterinnertop',								// CLASS:		css class to add
		6												// OPTION:		options and arrays		
	);	
	$outputs .= '</span>';						
	echo $outputs;	
} 
 
function ntl_audiomap_settings() {
	
	$outputs = '';
	
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'options',																	// INPUTTYPE:	type of input to create
		'<span class="lefter2">',													// BEFORE:		content before
		__('Measurement settings', 'localize'), 									// HEADING: 	heading
		__('Click to select either metric or imperial measurements', 'localize'), 	// DESCRIPTION: description
		'ntl_map_metric',															// NAME: 		input name
		'',																			// CLASS:		css class to add
		array('metric','imperial')													// OPTION:		options and arrays		
	);	
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'selectlink',																// INPUTTYPE:	type of input to create
		'',																			// BEFORE:		content before
		__('Driving directions', 'localize'), 										// HEADING: 	heading
		__('Select the page you created for your driving directions', 'localize'), 	// DESCRIPTION: description
		'ntl_drivedir_page',														// NAME: 		input name
		'lefterinnertop',															// CLASS:		css class to add
		array('page')																// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'on_off',																	// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',											// BEFORE:		content before
		__('Show player', 'localize'), 											// HEADING: 	heading
		__('Select to enable or disable music player', 'localize'), 				// DESCRIPTION: description
		'ntl_disable_audio',														// NAME: 		input name
		'',																			// CLASS:		css class to add
		''																			// OPTION:		options and arrays		
	);			
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'selectlink',																// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',											// BEFORE:		content before
		__('Default Album', 'localize'), 											// HEADING: 	heading
		__('Select the default album for the player', 'localize'), 					// DESCRIPTION: description
		'ntl_default_album',														// NAME: 		input name
		'',																			// CLASS:		css class to add
		array('albums')																// OPTION:		options and arrays		
	);	
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'on_off',																	// INPUTTYPE:	type of input to create
		'',																			// BEFORE:		content before
		__('Autoplay', 'localize'), 												// HEADING: 	heading
		__('Select to enable or disable autoplay', 'localize'), 					// DESCRIPTION: description
		'ntl_auto_play',															// NAME: 		input name
		'lefterinnertop',															// CLASS:		css class to add
		''																			// OPTION:		options and arrays		
	);		
	$outputs .= '</span>';						
	echo $outputs;	
}


function ntl_facebookgeneral_settings() {
	
	$outputs = '';
	
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'input',																	// INPUTTYPE:	type of input to create
		'<span class="lefter2">',													// BEFORE:		content before
		__('Facebook APP ID', 'localize'), 											// HEADING: 	heading
		__('add your facebook APP ID key here', 'localize'), 							// DESCRIPTION: description
		'ntl_facebook_api',															// NAME: 		input name
		'',																			// CLASS:		css class to add
		''																			// OPTION:		options and arrays		
	);	
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'input',																	// INPUTTYPE:	type of input to create
		'',																			// BEFORE:		content before
		__('Facebook Secretkey', 'localize'), 										// HEADING: 	heading
		__('Add your facebook secret key here', 'localize'), 						// DESCRIPTION: description
		'ntl_facebook_secret',														// NAME: 		input name
		'lefterinnertop',															// CLASS:		css class to add
		''																			// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'on_off',																	// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',											// BEFORE:		content before
		__('Facebook previewmode', 'localize'), 									// HEADING: 	heading
		__('Select to activate or deactivate previewmode', 'localize'), 						// DESCRIPTION: description
		'ntl_facebook_previewmode',													// NAME: 		input name
		'',																			// CLASS:		css class to add
		''																			// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'selectlink',																// INPUTTYPE:	type of input to create
		'',																			// BEFORE:		content before
		__('Facebook secure page', 'localize'), 									// HEADING: 	heading
		__('Select your facebook secure page', 'localize'), 						// DESCRIPTION: description
		'ntl_facebook_secure',														// NAME: 		input name
		'lefterinnertop',															// CLASS:		css class to add
		array('page')																// OPTION:		options and arrays		
	);				
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'input',																	// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',											// BEFORE:		content before
		__('SSL address', 'localize'), 												// HEADING: 	heading
		__('Add your ssl address here', 'localize'), 								// DESCRIPTION: description
		'ntl_facebook_ssl',															// NAME: 		input name
		'',																			// CLASS:		css class to add
		''																			// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'on_off',																	// INPUTTYPE:	type of input to create
		'',																			// BEFORE:		content before
		__('Enable Musicplayer', 'localize'), 										// HEADING: 	heading
		__('Should the music player be enabled?', 'localize'), 						// DESCRIPTION: description
		'ntl_fb_showplayer',																// NAME: 		input name
		'lefterinnertop',															// CLASS:		css class to add
		array('albums')																// OPTION:		options and arrays		
	);		
	$outputs .= ntl_create_box(	
		'option', 																	// TYPE: 		either post number or 'option'
		'selectlink',																// INPUTTYPE:	type of input to create
		'',																			// BEFORE:		content before
		__('Featured album', 'localize'), 											// HEADING: 	heading
		__('Album to load in the music player', 'localize'), 						// DESCRIPTION: description
		'ntl_fb_album',																// NAME: 		input name
		'lefterinnertop',															// CLASS:		css class to add
		array('albums')																// OPTION:		options and arrays		
	);			
	$outputs .= '</span>';						
	echo $outputs;	
}

function ntl_general_settings() {
	
	$outputs = '';
	$outputs .= ntl_create_box(	
		'option', 															// TYPE: 		either post number or 'option'
		'uloader',															// INPUTTYPE:	type of input to create
		'<span class="lefter2">',											// BEFORE:		content before
		__('Upload Logo', 'localize'), 										// HEADING: 	heading
		__('Click the button to upload your logo', 'localize'), 			// DESCRIPTION: description
		'ntl_theme_logo',													// NAME: 		input name
		'',																	// CLASS:		css class to add
		''																	// OPTION:		options and arrays		
	);
	
	$outputs .= ntl_create_box(	
		'option',															// TYPE: 		either post number or 'option'
		'textarea',															// INPUTTYPE:	type of input to create
		'',																	// BEFORE:		content before
		__('Tagline', 'localize'), 											// HEADING: 	heading
		__('Frontpage tagline or album description', 'localize'), 			// DESCRIPTION: description
		'ntl_themetagline',														// NAME: 		input name
		'lefterinnertop',													// CLASS:		css class to add
		10																	// OPTION:		options and arrays		
	);	

	$outputs .= ntl_create_box(	
		'option', 															// TYPE: 		either post number or 'option'
		'input',															// INPUTTYPE:	type of input to create
		'',																	// BEFORE:		content before
		__('Next Show Label', 'localize'), 									// HEADING: 	heading
		__('Label for "Next Show" in countdown timer', 'localize'), 		// DESCRIPTION: description
		'ntl_calnext_label',												// NAME: 		input name
		'lefterinnertop',													// CLASS:		css class to add
		''																	// OPTION:		options and arrays		
	);	
	
	$outputs .= ntl_create_box(	
		'option', 															// TYPE: 		either post number or 'option'
		'colorpicker',														// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',									// BEFORE:		content before
		__('Theme color', 'localize'), 										// HEADING: 	heading
		__('Click to select your theme color', 'localize'), 				// DESCRIPTION: description
		'ntl_theme_color',													// NAME: 		input name
		'',																	// CLASS:		css class to add
		''																	// OPTION:		options and arrays		
	);		
	$outputs .= ntl_create_box(	
		'option', 															// TYPE: 		either post number or 'option'
		'options',															// INPUTTYPE:	type of input to create
		'',																	// BEFORE:		content before
		__('Background Color', 'localize'), 								// HEADING: 	heading
		__('Click to select your background color', 'localize'), 			// DESCRIPTION: description
		'ntl_theme_bg',														// NAME: 		input name
		'lefterinnertop',													// CLASS:		css class to add
		array('Brown','Black', 'Blue')												// OPTION:		options and arrays		
	);	

	$outputs .= ntl_create_box(	
		'option', 																								// TYPE: 		either post number or 'option'
		'on_off',																								// INPUTTYPE:	type of input to create
		'',																										// BEFORE:		content before
		__('Album Carousel', 'localize'), 																		// HEADING: 	heading
		__('Click to enable or disable the album carousel at the bottom of the frontpage', 'localize'), 		// DESCRIPTION: description
		'ntl_show_carousel',																					// NAME: 		input name
		'lefterinnertop',																						// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 																								// TYPE: 		either post number or 'option'
		'on_off',																								// INPUTTYPE:	type of input to create
		'',																										// BEFORE:		content before
		__('Countdown Timer', 'localize'), 																		// HEADING: 	heading
		__('Click to enable or disable the countdown timer', 'localize'), 		// DESCRIPTION: description
		'ntl_show_timer',																					// NAME: 		input name
		'lefterinnertop',																						// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);			
	
	$outputs .= ntl_create_box(	
		'option', 																								// TYPE: 		either post number or 'option'
		'input',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Twitter username', 'localize'), 																	// HEADING: 	heading
		__('Add your twitter name here (leave blank to deactivate the custom twitter widgets.)', 'localize'), 	// DESCRIPTION: description
		'ntl_twitter_name',																						// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 																								// TYPE: 		either post number or 'option'
		'input',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Twitter Consumer key', 'localize'), 																	// HEADING: 	heading
		__('Add your twitter Consumer key here (see helpfiles)', 'localize'), 	// DESCRIPTION: description
		'ntl_twitter_conskey',																						// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 																								// TYPE: 		either post number or 'option'
		'input',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Twitter Consumer secret', 'localize'), 																	// HEADING: 	heading
		__('Add your twitter Consumer secret here (see helpfiles)', 'localize'), 	// DESCRIPTION: description
		'ntl_twitter_consecret',																						// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 																								// TYPE: 		either post number or 'option'
		'input',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Twitter Access token', 'localize'), 																	// HEADING: 	heading
		__('Add your twitter access token here (see helpfiles)', 'localize'), 	// DESCRIPTION: description
		'ntl_twitter_acctoken',																						// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		'option', 																								// TYPE: 		either post number or 'option'
		'input',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Access token secret', 'localize'), 																	// HEADING: 	heading
		__('Add your twitter access token secret here (see helpfiles)', 'localize'), 	// DESCRIPTION: description
		'ntl_twitter_accsecret',																						// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);
	$outputs .= '</span>';						
	echo $outputs;
}


function ntl_get_postbody($postid) {
	
	
	$settings = get_option( "ntl_theme_settings" );
	
	if ($settings['ntl_slide_type'] == 'image'){
	
	$outputs = '';
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'textarea',																								// INPUTTYPE:	type of input to create
		'<form method="post" action="' .  admin_url( 'admin.php?page=slide-settings' ) . '"><span class="lefter2">',// BEFORE:		content before
		__('Slide Heading', 'localize'), 																		// HEADING: 	heading
		__('Heading of your slideshow item (can be left blank)', 'localize'), 									// DESCRIPTION: description
		'option1',																								// NAME: 		input name
		'',																										// CLASS:		css class to add
		2																										// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'textarea',																								// INPUTTYPE:	type of input to create
		'',																										// BEFORE:		content before
		__('Slide content', 'localize'), 																		// HEADING: 	heading
		__('Main content/description of the slideshow item', 'localize'), 										// DESCRIPTION: description
		'option2',																								// NAME: 		input name
		'lefterinnertop',																						// CLASS:		css class to add
		8																										// OPTION:		options and arrays		
	);	
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'input',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Slide Label', 'localize'), 																			// HEADING: 	heading
		__('Label of the slide link eg. "read more"', 'localize'), 												// DESCRIPTION: description
		'option3',																								// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);	
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'input',																								// INPUTTYPE:	type of input to create
		'',																										// BEFORE:		content before
		__('Custom link', 'localize'), 																			// HEADING: 	heading
		__('Use this input to add a custom link. If this field is filled, the links below will be ignored.', 'localize'), 												// DESCRIPTION: description
		'option4',																								// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);	
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'selectlink',																							// INPUTTYPE:	type of input to create
		'',																										// BEFORE:		content before
		__('Content link', 'localize'), 																		// HEADING: 	heading
		__('Use this input to add a link to any page, post or category.', 'localize'), 							// DESCRIPTION: description
		'option5',																								// NAME: 		input name
		'lefterinnertop',																						// CLASS:		css class to add
		array('page','post','albums','members')																										// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'uploader',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Slide Image', 'localize'), 																			// HEADING: 	heading
		__('<em class="redtag">Remember to set the image as a featured image</em><br/>Image size: 978 pixels wide and 360 pixels high', 'localize'), 				// DESCRIPTION: description
		'',																										// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'saver',																								// INPUTTYPE:	type of input to create
		'',																										// BEFORE:		content before
		__('Save slide', 'localize'), 																			// HEADING: 	heading
		__('Save information for this slideshow', 'localize'), 													// DESCRIPTION: description
		'',																										// NAME: 		input name
		'lefterinnertop',																						// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);			
	$outputs .= '</span><br class="clear" /></span></form>';	
	
	} else {
	
	$outputs = '';
	
	$c_type = get_post_meta($postid, 'c_type', true );
	
	switch($c_type) {
		case 't1':  
			$echo_type =  'Title & description';
			$outputs .= '<h3 class="contentslidedesc">' .  $echo_type  . '</h3>'; 
			
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'textarea',																								// INPUTTYPE:	type of input to create
				'<form method="post" action="' .  admin_url( 'admin.php?page=slide-settings' ) . '"><span class="lefter2">',// BEFORE:		content before
				__('Slide Heading', 'localize'), 																		// HEADING: 	heading
				__('Heading of your slideshow item (can be left blank)', 'localize'), 									// DESCRIPTION: description
				'option1',																								// NAME: 		input name
				'',																										// CLASS:		css class to add
				2																										// OPTION:		options and arrays		
			);
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'textarea',																								// INPUTTYPE:	type of input to create
				'',																										// BEFORE:		content before
				__('Slide content', 'localize'), 																		// HEADING: 	heading
				__('Main content/description of the slideshow item', 'localize'), 										// DESCRIPTION: description
				'option2',																								// NAME: 		input name
				'lefterinnertop',																						// CLASS:		css class to add
				8																										// OPTION:		options and arrays		
			);	
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'input',																								// INPUTTYPE:	type of input to create
				'</span><span class="lefter2">',																										// BEFORE:		content before
				__('Custom link', 'localize'), 																			// HEADING: 	heading
				__('Use this input to add a custom link. If this field is filled, the links below will be ignored.', 'localize'), 												// DESCRIPTION: description
				'option4',																								// NAME: 		input name
				'',																										// CLASS:		css class to add
				''																										// OPTION:		options and arrays		
			);	
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'selectlink',																							// INPUTTYPE:	type of input to create
				'',																										// BEFORE:		content before
				__('Content link', 'localize'), 																		// HEADING: 	heading
				__('Use this input to add a link to any page, post or category.', 'localize'), 							// DESCRIPTION: description
				'option5',																								// NAME: 		input name
				'lefterinnertop',																						// CLASS:		css class to add
				array('page','post','albums','members')																										// OPTION:		options and arrays		
			);
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'saver',																								// INPUTTYPE:	type of input to create
				'</span><span class="lefter2">',																										// BEFORE:		content before
				__('Save slide', 'localize'), 																			// HEADING: 	heading
				__('Save information for this slideshow', 'localize'), 													// DESCRIPTION: description
				'',																										// NAME: 		input name
				'',																						// CLASS:		css class to add
				''																										// OPTION:		options and arrays		
			);			
			$outputs .= '</span><br class="clear" /></span></form>';	
			
		break;
			
		case 't2':  
		
			$echo_type =  'Video';
			
			$outputs .= '<h3 class="contentslidedesc">' .  $echo_type  . '</h3>'; 
			
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'input',																								// INPUTTYPE:	type of input to create
				'<form method="post" action="' .  admin_url( 'admin.php?page=slide-settings' ) . '"><span class="lefter2">',// BEFORE:		content before
				__('Video number', 'localize'), 																		// HEADING: 	heading
				__('Video number of the video to add', 'localize'), 													// DESCRIPTION: description
				'option1',																								// NAME: 		input name
				'',																										// CLASS:		css class to add
				2																										// OPTION:		options and arrays		
			);
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'options',																								// INPUTTYPE:	type of input to create
				'',																										// BEFORE:		content before
				__('Video type', 'localize'), 																			// HEADING: 	heading
				__('Is it a Youtube or Vimeo slideshow', 'localize'), 													// DESCRIPTION: description
				'option2',																								// NAME: 		input name
				'lefterinnertop',																						// CLASS:		css class to add
				array('vimeo','youtube')																										// OPTION:		options and arrays		
			);	
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'selectlink',																								// INPUTTYPE:	type of input to create
				'</span><span class="lefter2">',																		// BEFORE:		content before
				__('Video Gallery', 'localize'), 																			// HEADING: 	heading
				__('If your video is already in the video gallery, you can leave the first colums open and just choose the video that you want to add from the selectbox', 'localize'), 												// DESCRIPTION: description
				'option3',																								// NAME: 		input name
				'',																										// CLASS:		css class to add
				array('videos')																										// OPTION:		options and arrays		
			);	
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'saver',																								// INPUTTYPE:	type of input to create
				'</span><span class="lefter2">',																										// BEFORE:		content before
				__('Save slide', 'localize'), 																			// HEADING: 	heading
				__('Save information for this slideshow', 'localize'), 													// DESCRIPTION: description
				'',																										// NAME: 		input name
				'',																						// CLASS:		css class to add
				''																										// OPTION:		options and arrays		
			);			
			$outputs .= '</span><br class="clear" /></span></form>';	 
			
			
		break;
		
		case 't3':  
			$echo_type =  'Large image'; 
			
			$outputs .= '<h3 class="contentslidedesc">' .  $echo_type  . '</h3>'; 
			
			
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'textarea',																								// INPUTTYPE:	type of input to create
				'<form method="post" action="' .  admin_url( 'admin.php?page=slide-settings' ) . '"><span class="lefter2">',// BEFORE:		content before
				__('Slide Heading', 'localize'), 																		// HEADING: 	heading
				__('Heading of your slideshow item (can be left blank)', 'localize'), 									// DESCRIPTION: description
				'option1',																								// NAME: 		input name
				'',																										// CLASS:		css class to add
				2																										// OPTION:		options and arrays		
			);
	
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'textarea',																								// INPUTTYPE:	type of input to create
				'',																										// BEFORE:		content before
				__('Slide content', 'localize'), 																		// HEADING: 	heading
				__('Main content/description of the slideshow item', 'localize'), 										// DESCRIPTION: description
				'option2',																								// NAME: 		input name
				'lefterinnertop',																						// CLASS:		css class to add
				8																										// OPTION:		options and arrays		
			);	
	
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'input',																								// INPUTTYPE:	type of input to create
				'</span><span class="lefter2">',																										// BEFORE:		content before
				__('Custom link', 'localize'), 																			// HEADING: 	heading
				__('Use this input to add a custom link. If this field is filled, the links below will be ignored.', 'localize'), 												// DESCRIPTION: description
				'option4',																								// NAME: 		input name
				'',																										// CLASS:		css class to add
				''																										// OPTION:		options and arrays		
			);	
	
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'selectlink',																							// INPUTTYPE:	type of input to create
				'',																										// BEFORE:		content before
				__('Content link', 'localize'), 																		// HEADING: 	heading
				__('Use this input to add a link to any page, post or category.', 'localize'), 							// DESCRIPTION: description
				'option5',																								// NAME: 		input name
				'lefterinnertop',																						// CLASS:		css class to add
				array('page','post','albums','members')																										// OPTION:		options and arrays		
			);
	
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'uploader',																								// INPUTTYPE:	type of input to create
				'</span><span class="lefter2">',																		// BEFORE:		content before
				__('Slide Image', 'localize'), 																			// HEADING: 	heading
				__('<em class="redtag">Remember to set the image as a featured image</em><br/>Image size: 465 pixels wide and 265 pixels high', 'localize'), 				// DESCRIPTION: description
				'',																										// NAME: 		input name
				'',																										// CLASS:		css class to add
				''																										// OPTION:		options and arrays		
			);
	
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'saver',																								// INPUTTYPE:	type of input to create
				'',																										// BEFORE:		content before
				__('Save slide', 'localize'), 																			// HEADING: 	heading
				__('Save information for this slideshow', 'localize'), 													// DESCRIPTION: description
				'',																										// NAME: 		input name
				'lefterinnertop',																						// CLASS:		css class to add
				''																										// OPTION:		options and arrays		
			);			
			$outputs .= '</span><br class="clear" /></span></form>';	
						
		break;
					
		case 't4':  
		
			$echo_type =  'Link to Album'; 
			
			$outputs .= '<h3 class="contentslidedesc">' .  $echo_type  . '</h3>'; 
			
			
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'selectlink',																								// INPUTTYPE:	type of input to create
				'<form method="post" action="' .  admin_url( 'admin.php?page=slide-settings' ) . '"><span class="lefter2">',// BEFORE:		content before
				__('Link to album', 'localize'), 																		// HEADING: 	heading
				__('Select the album to display', 'localize'), 									// DESCRIPTION: description
				'option1',																								// NAME: 		input name
				'',																										// CLASS:		css class to add
				array('albums')																										// OPTION:		options and arrays		
			);
	
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'textarea',																								// INPUTTYPE:	type of input to create
				'',																										// BEFORE:		content before
				__('Slide content', 'localize'), 																		// HEADING: 	heading
				__('Main content/description of the slideshow item', 'localize'), 										// DESCRIPTION: description
				'option2',																								// NAME: 		input name
				'lefterinnertop',																						// CLASS:		css class to add
				8																										// OPTION:		options and arrays		
			);	
	
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'textarea',																								// INPUTTYPE:	type of input to create
				'</span><span class="lefter2">',																		// BEFORE:		content before
				__('Slide Title', 'localize'), 																			// HEADING: 	heading
				__('Heading of the slide item', 'localize'), 												// DESCRIPTION: description
				'option3',																								// NAME: 		input name
				'',																										// CLASS:		css class to add
				2																										// OPTION:		options and arrays		
			);	
		
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'saver',																								// INPUTTYPE:	type of input to create
				'</span><span class="lefter2">',																		// BEFORE:		content before
				__('Save slide', 'localize'), 																			// HEADING: 	heading
				__('Save information for this slideshow', 'localize'), 													// DESCRIPTION: description
				'',																										// NAME: 		input name
				'',																										// CLASS:		css class to add
				''																										// OPTION:		options and arrays		
			);			
			$outputs .= '</span><br class="clear" /></span></form>';	
			
			
		break;
		
		
		case 't5':  
		
			$echo_type =  'Link to post'; 
			
			
			$outputs .= '<h3 class="contentslidedesc">' .  $echo_type  . '</h3>'; 
						
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'selectlink',																								// INPUTTYPE:	type of input to create
				'<form method="post" action="' .  admin_url( 'admin.php?page=slide-settings' ) . '"><span class="lefter2">',// BEFORE:		content before
				__('Link to post', 'localize'), 																		// HEADING: 	heading
				__('Select the item yo link to', 'localize'), 															// DESCRIPTION: description
				'option1',																								// NAME: 		input name
				'',																										// CLASS:		css class to add
				array('post', 'page', 'members')																										// OPTION:		options and arrays		
			);
		
			$outputs .= ntl_create_box(	
				$postid,  																								// TYPE: 		either post number or 'option'
				'saver',																								// INPUTTYPE:	type of input to create
				'</span><span class="lefter2">',																		// BEFORE:		content before
				__('Save slide', 'localize'), 																			// HEADING: 	heading
				__('Save information for this slideshow', 'localize'), 													// DESCRIPTION: description
				'',																										// NAME: 		input name
				'',																										// CLASS:		css class to add
				''																										// OPTION:		options and arrays		
			);			
			$outputs .= '</span><br class="clear" /></form>';	
					
		break;
		
	}
		
		
	}	
	return $outputs;	
}

function ntl_get_videobody($postid) {
	
	$outputs = '';
	$outputs .= ntl_create_box(	
		$postid,  																									// TYPE: 		either post number or 'option'
		'input',																									// INPUTTYPE:	type of input to create
		'<form method="post" action="' .  admin_url( 'admin.php?page=video-settings' ) . '"><span class="lefter2">',// BEFORE:		content before
		__('Video number', 'localize'), 																			// HEADING: 	heading
		__('The Youtube or Vimeo video number (see help video)', 'localize'), 										// DESCRIPTION: description
		'option1',																									// NAME: 		input name
		'',																											// CLASS:		css class to add
		2																											// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'options',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Video Type', 'localize'), 																			// HEADING: 	heading
		__('Select the type of video', 'localize'), 															// DESCRIPTION: description
		'option2',																								// NAME: 		input name
		'',																										// CLASS:		css class to add
		array('Youtube','Vimeo')																										// OPTION:		options and arrays		
	);	
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'saver',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Save video', 'localize'), 																			// HEADING: 	heading
		__('Save information for this video', 'localize'), 														// DESCRIPTION: description
		'',																										// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);			
	$outputs .= '</span></form>';		
	return $outputs;	
}

function ntl_get_feedbackbody($postid) {
	
	$outputs = '';
	$outputs .= ntl_create_box(	
		$postid,  																										// TYPE: 		either post number or 'option'
		'input',																										// INPUTTYPE:	type of input to create
		'<form method="post" action="' .  admin_url( 'admin.php?page=utility-settings' ) . '"><span class="lefter2">',	// BEFORE:		content before
		__('Feedback name', 'localize'), 																				// HEADING: 	heading
		__('Name or company name of the person who gave feedback', 'localize'), 										// DESCRIPTION: description
		'option1',																										// NAME: 		input name
		'',																												// CLASS:		css class to add
		2																												// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		$postid,  																																			// TYPE: 		either post number or 'option'
		'input',																																			// INPUTTYPE:	type of input to create
		'',																																					// BEFORE:		content before
		__('Feedback link', 'localize'), 																													// HEADING: 	heading
		__('If you wish to link the feedback image to a website of the person or company who gave feedback, add the address to link to here', 'localize'), 	// DESCRIPTION: description
		'option2',																																			// NAME: 		input name
		'lefterinnertop',																																		// CLASS:		css class to add
		2																																					// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'textarea',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Feedback Content', 'localize'), 																	// HEADING: 	heading
		__('Content of the feedback', 'localize'), 																// DESCRIPTION: description
		'option3',																								// NAME: 		input name
		'',																										// CLASS:		css class to add
		9																										// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'uploader',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Feedback Image', 'localize'), 																			// HEADING: 	heading
		__('<em class="redtag">Remember to set the image as a featured image</em><br /> Keep the image not larger than 80 px wide and 80 pixels high', 'localize'), 				// DESCRIPTION: description
		'',																										// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);	
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'saver',																								// INPUTTYPE:	type of input to create
		'',																		// BEFORE:		content before
		__('Save feedback', 'localize'), 																		// HEADING: 	heading
		__('Save information for this feedback item', 'localize'), 												// DESCRIPTION: description
		'',																										// NAME: 		input name
		'lefterinnertop',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);			
	$outputs .= '</span></form>';		
	return $outputs;	
}

function ntl_get_bannerlinkbody($postid) {
	
	$outputs = '';
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'uploader',																								// INPUTTYPE:	type of input to create
		'<form method="post" action="' .  admin_url( 'admin.php?page=utility-settings&tab=2' ) . '"><span class="lefter2">',																		// BEFORE:		content before
		__('Feedback Image', 'localize'), 																		// HEADING: 	heading
		__('<em class="redtag">Remember to set the image as a featured image</em><br /> Image size 286 pixels wide x 140 pixels high.', 'localize'), 				// DESCRIPTION: description
		'',																										// NAME: 		input name
		'',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);	
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'input',																								// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',																		// BEFORE:		content before
		__('Feedback custom link', 'localize'), 																// HEADING: 	heading
		__('A custom address to link to. If set, the link settings below will be ignored', 'localize'),			// DESCRIPTION: description
		'option2',																								// NAME: 		input name
		'',																										// CLASS:		css class to add
		9																										// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'selectlink',																							// INPUTTYPE:	type of input to create
		'',																										// BEFORE:		content before
		__('Content link', 'localize'), 																		// HEADING: 	heading
		__('Use this input to add a link to any page or post.', 'localize'), 									// DESCRIPTION: description
		'option3',																								// NAME: 		input name
		'lefterinnertop',																						// CLASS:		css class to add
		array('page','post','albums','members')																									// OPTION:		options and arrays		
	);
	
	$outputs .= ntl_create_box(	
		$postid,  																										// TYPE: 		either post number or 'option'
		'textarea',																										// INPUTTYPE:	type of input to create
		'</span><span class="lefter2">',	// BEFORE:		content before
		__('Bannerlink title', 'localize'), 																			// HEADING: 	heading
		__('Title for bannerlink', 'localize'), 																		// DESCRIPTION: description
		'option1',																										// NAME: 		input name
		'',																												// CLASS:		css class to add
		2																												// OPTION:		options and arrays		
	);
	$outputs .= ntl_create_box(	
		$postid,  																								// TYPE: 		either post number or 'option'
		'saver',																								// INPUTTYPE:	type of input to create
		'',																		// BEFORE:		content before
		__('Save feedback', 'localize'), 																		// HEADING: 	heading
		__('Save information for this feedback item', 'localize'), 												// DESCRIPTION: description
		'',																										// NAME: 		input name
		'lefterinnertop',																										// CLASS:		css class to add
		''																										// OPTION:		options and arrays		
	);			
	$outputs .= '</span></form>';		
	return $outputs;	
}

function ntl_font_settings() {
	$fontlist = array(
		"ABeeZee","Abel","Aclonica","Acme","Actor","Adamina","Advent Pro","Aguafina Script","Akronim","Aladin","Aldrich","Alegreya",
		"Alegreya SC","Alex Brush","Alfa Slab One","Alice","Alike","Alike Angular","Allan","Allerta","Allerta Stencil","Allura","Almendra",
		"Almendra Display","Almendra SC","Amarante","Amaranth","Amatic SC","Amethysta","Anaheim","Andada","Andika","Angkor",
		"Annie Use Your Telescope","Anonymous Pro","Antic","Antic Didone","Antic Slab","Anton","Arapey","Arbutus","Arbutus Slab",
		"Architects Daughter","Archivo Black","Archivo Narrow","Arimo","Arizonia","Armata","Artifika","Arvo","Asap","Asset","Astloch","Asul",
		"Atomic Age","Aubrey","Audiowide","Autour One","Average","Average Sans","Averia Gruesa Libre","Averia Libre","Averia Sans Libre",
		"Averia Serif Libre","Bad Script","Balthazar","Bangers","Basic","Battambang","Baumans","Bayon","Belgrano","Belleza","BenchNine",
		"Bentham","Berkshire Swash","Bevan","Bigelow Rules","Bigshot One","Bilbo","Bilbo Swash Caps","Bitter","Black Ops One","Bokor","Bonbon",
		"Boogaloo","Bowlby One","Bowlby One SC","Brawler","Bree Serif","Bubblegum Sans","Bubbler One","Buda","Buenard","Butcherman","Butterfly Kids",
		"Cabin","Cabin Condensed","Cabin Sketch","Caesar Dressing","Cagliostro","Calligraffitti","Cambo","Candal","Cantarell","Cantata One",
		"Cantora One","Capriola","Cardo","Carme","Carrois Gothic","Carrois Gothic SC","Carter One","Caudex","Cedarville Cursive","Ceviche One",
		"Changa One","Chango","Chau Philomene One","Chela One","Chelsea Market","Chenla","Cherry Cream Soda","Cherry Swash","Chewy","Chicle","Chivo",
		"Cinzel","Cinzel Decorative","Clicker Script","Coda","Coda Caption","Codystar","Combo","Comfortaa","Coming Soon","Concert One","Condiment",
		"Content","Contrail One","Convergence","Cookie","Copse","Corben","Courgette","Cousine","Coustard","Covered By Your Grace","Crafty Girls",
		"Creepster","Crete Round","Crimson Text","Croissant One","Crushed","Cuprum","Cutive","Cutive Mono","Damion","Dancing Script","Dangrek",
		"Dawning of a New Day","Days One","Delius","Delius Swash Caps","Delius Unicase","Della Respira","Denk One","Devonshire","Didact Gothic",
		"Diplomata","Diplomata SC","Domine","Donegal One","Doppio One","Dosis","Dr Sugiyama","Droid Sans","Droid Sans Mono","Droid Serif","Duru Sans",
		"Dynalight","EB Garamond","Eagle Lake","Eater","Economica","Electrolize","Elsie","Elsie Swash Caps","Emblema One","Emilys Candy",
		"Engagement","Englebert","Enriqueta","Erica One","Esteban","Euphoria Script","Ewert","Exo","Expletus Sans","Fanwood Text","Fascinate",
		"Fascinate Inline","Faster One","Fasthand","Federant","Federo","Felipa","Fenix","Finger Paint","Fjalla One","Fjord One","Flamenco","Flavors",
		"Fondamento","Fontdiner Swanky","Forum","Francois One","Freckle Face","Fredericka the Great","Fredoka One","Freehand","Fresca","Frijole",
		"Fruktur","Fugaz One","GFS Didot","GFS Neohellenic","Gafata","Galdeano","Galindo","Gentium Basic","Gentium Book Basic","Geo","Geostar",
		"Geostar Fill","Germania One","Gilda Display","Give You Glory","Glass Antiqua","Glegoo","Gloria Hallelujah","Goblin One","Gochi Hand",
		"Gorditas","Goudy Bookletter 1911","Graduate","Grand Hotel","Gravitas One","Great Vibes","Griffy","Gruppo","Gudea","Habibi","Hammersmith One",
		"Hanalei","Hanalei Fill","Handlee","Hanuman","Happy Monkey","Headland One","Henny Penny","Herr Von Muellerhoff","Holtwood One SC",
		"Homemade Apple","Homenaje","IM Fell DW Pica","IM Fell DW Pica SC","IM Fell Double Pica","IM Fell Double Pica SC","IM Fell English",
		"IM Fell English SC","IM Fell French Canon","IM Fell French Canon SC","IM Fell Great Primer","IM Fell Great Primer SC","Iceberg","Iceland",
		"Imprima","Inconsolata","Inder","Irish Grover","Istok Web","Italiana","Italianno","Jacques Francois","Jacques Francois Shadow","Jim Nightshade",
		"Jockey One","Jolly Lodger","Josefin Sans","Josefin Slab","Joti One","Judson","Julee","Julius Sans One","Junge","Jura","Just Another Hand",
		"Just Me Again Down Here","Kameron","Karla","Kaushan Script","Kavoon","Keania One","Kelly Slab","Kenia","Khmer","Kite One","Knewave","Kotta One",
		"Koulen","Kranky","Kreon","Kristi","Krona One","La Belle Aurore","Lancelot","Lato","League Script","Leckerli One","Ledger","Lekton","Lemon",
		"Libre Baskerville","Life Savers","Lilita One","Limelight","Linden Hill","Lobster","Lobster Two","Londrina Outline","Londrina Shadow",
		"Londrina Sketch","Londrina Solid","Lora","Love Ya Like A Sister","Loved by the King","Lovers Quarrel","Luckiest Guy","Lusitana","Lustria",
		"Macondo","Macondo Swash Caps","Magra","Maiden Orange","Mako","Marcellus","Marcellus SC","Marck Script","Margarine","Marko One","Marmelad",
		"Marvel","Mate","Mate SC","Maven Pro","McLaren","Meddon","MedievalSharp","Medula One","Megrim","Meie Script","Merienda","Merienda One",
		"Merriweather","Metal","Metal Mania","Metamorphous","Metrophobic","Michroma","Milonga","Miltonian","Miltonian Tattoo","Miniver",
		"Miss Fajardose","Modern Antiqua","Molengo","Molle","Monda","Monofett","Monoton","Monsieur La Doulaise","Montaga","Montez","Montserrat",
		"Montserrat Alternates","Montserrat Subrayada","Moul","Moulpali","Mountains of Christmas","Mouse Memoirs","Mr Bedfort","Mr Dafoe",
		"Mr De Haviland","Mrs Saint Delafield","Mrs Sheppards","Muli","Mystery Quest","Neucha","Neuton","New Rocker","News Cycle","Niconne","Nixie One",
		"Nobile","Nokora","Norican","Nosifer","Nothing You Could Do","Noticia Text","Nova Cut","Nova Flat","Nova Mono","Nova Oval","Nova Round","Nova Script",
		"Nova Slim","Nova Square","Numans","Nunito","Odor Mean Chey","Offside","Old Standard TT","Oldenburg","Oleo Script","Oleo Script Swash Caps",
		"Open Sans","Open Sans Condensed","Oranienbaum","Orbitron","Oregano","Orienta","Original Surfer","Oswald","Over the Rainbow","Overlock",
		"Overlock SC","Ovo","Oxygen","Oxygen Mono","PT Mono","PT Sans","PT Sans Caption","PT Sans Narrow","PT Serif","PT Serif Caption","Pacifico",
		"Paprika","Parisienne","Passero One","Passion One","Patrick Hand","Patua One","Paytone One","Peralta","Permanent Marker","Petit Formal Script",
		"Petrona","Philosopher","Piedra","Pinyon Script","Pirata One","Plaster","Play","Playball","Playfair Display","Playfair Display SC","Podkova",
		"Poiret One","Poller One","Poly","Pompiere","Pontano Sans","Port Lligat Sans","Port Lligat Slab","Prata","Preahvihear","Press Start 2P","Princess Sofia",
		"Prociono","Prosto One","Puritan","Purple Purse","Quando","Quantico","Quattrocento","Quattrocento Sans","Questrial","Quicksand","Quintessential",
		"Qwigley","Racing Sans One","Radley","Raleway","Raleway Dots","Rambla","Rammetto One","Ranchers","Rancho","Rationale","Redressed","Reenie Beanie",
		"Revalia","Ribeye","Ribeye Marrow","Righteous","Risque","Roboto","Roboto Condensed","Rochester","Rock Salt","Rokkitt","Romanesco","Ropa Sans","Rosario",
		"Rosarivo","Rouge Script","Ruda","Rufina","Ruge Boogie","Ruluko","Rum Raisin","Ruslan Display","Russo One","Ruthie","Rye","Sacramento","Sail","Salsa",
		"Sanchez","Sancreek","Sansita One","Sarina","Satisfy","Scada","Schoolbell","Seaweed Script","Sevillana","Seymour One","Shadows Into Light",
		"Shadows Into Light Two","Shanti","Share","Share Tech","Share Tech Mono","Shojumaru","Short Stack","Siemreap","Sigmar One","Signika",
		"Signika Negative","Simonetta","Sirin Stencil","Six Caps","Skranji","Slackey","Smokum","Smythe","Sniglet","Snippet","Snowburst One",
		"Sofadi One","Sofia","Sonsie One","Sorts Mill Goudy","Source Code Pro","Source Sans Pro","Special Elite","Spicy Rice","Spinnaker",
		"Spirax","Squada One","Stalemate","Stalinist One","Stardos Stencil","Stint Ultra Condensed","Stint Ultra Expanded","Stoke","Strait",
		"Sue Ellen Francisco","Sunshiney","Supermercado One","Suwannaphum","Swanky and Moo Moo","Syncopate","Tangerine","Taprom","Telex","Tenor Sans",
		"Text Me One","The Girl Next Door","Tienne","Tinos","Titan One","Titillium Web","Trade Winds","Trocchi","Trochut","Trykker","Tulpen One",
		"Ubuntu","Ubuntu Condensed","Ubuntu Mono","Ultra","Uncial Antiqua","Underdog","Unica One","UnifrakturCook","UnifrakturMaguntia","Unkempt",
		"Unlock","Unna","VT323","Vampiro One","Varela","Varela Round","Vast Shadow","Vibur","Vidaloka","Viga","Voces","Volkhov","Vollkorn","Voltaire",
		"Waiting for the Sunrise","Wallpoet","Walter Turncoat","Warnes","Wellfleet","Wendy One","Wire One","Yanone Kaffeesatz","Yellowtail","Yeseva One","Yesteryear","Zeyada");		
	$outputs = '';	
	$outputs .= '<span class="lefter" style="width: 680px">
				<span class="lefterinner" style="width: 660px">
				<h4><span>Fonts<span></h4>
	';		
	$outputs .= ntl_build_fonts('ntl_theme_font', $fontlist);	
	$outputs .= '<br class="clear"></span></span>';	
	echo $outputs;	
}


?>
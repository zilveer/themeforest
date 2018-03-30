<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * @package			BTP_Flare_Theme
 * @subpackage		BTP_Shortcodes
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* Add "Columns" subgroup to the global shortcode generator */
btp_shortgen_add_subgroup( 
	'misc', 
	array( 
		'label' => __( 'Misc', 'btp_theme' ),
	), 
	'general', 
	450
);



/* Add [audio] shortcode to the global shortcode generator */
btp_shortgen_add_item( 
	'audio',
	array(
		'label'			=> '[audio]',
		'atts'			=> array(
			'title' 			=> array( 
				'view' 			=> 'String',
				'hint'			=> __( 'The title of the audio file.', 'btp_theme' ),	 
			),
			'mp3' 		=> array( 
				'view'			=> 'String',
				'hint'			=> __( 'The source of the mp3 file', 'btp_theme' ), 
			),
		),
		'display'		=> 'block',
		'group'			=> 'general',
		'subgroup'		=> 'misc',	
		'position'		=> 10,
	)						 
); 
	


/**
 * [audio] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_audio($atts, $content = null) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
	
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',	
		'title'			=> '',
		'mp3' 			=> '#',
		), $atts ) );
	
	if ( !strlen( $mp3 ) ) {
		return '';
	}
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'media-audio-counter-' . $counter;
		
	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'media-audio ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
	
	
	/* Install jPlayer. Not every page needs to load additional javascrips */
	add_action('wp_footer', 'btp_shortcode_install_audio_player');
	
	/* Compose output */
	$out = '';
	$out .= '<figure id="' . esc_attr( $final_id ) . '" class="' . $final_class . '">'."\n";
		$out .= '<audio src="' . esc_url( $mp3 ) .'">'."\n";			
		$out .= '</audio>'."\n";
		if ( strlen( $title ) ) {
			$out .= '<figcaption>' . esc_html( $title ) . '</figcaption>'."\n";
		}
	$out .= '</figure>'."\n";
	
	return $out;
}
add_shortcode( 'audio', 'btp_shortcode_audio' );



/**
 * Enqueues javascripts required for the jPlayer to work
 */
function btp_shortcode_install_audio_player() {
	wp_enqueue_script('jplayer', get_template_directory_uri().'/js/jquery.jplayer/jquery.jplayer.min.js', array('jquery'));
	wp_print_scripts( 'jplayer' );		
}



/* Add [twitter] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'twitter', 
	array(
		'label' 	=> '[twitter]',
		'atts' 		=> array(
			'username' 	=> array( 
				'view' 		=> 'String' 
			),
			'max' 		=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'Maximum items to display', 'btp_theme' ), 
			),				    	
		),
		'display' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'misc',
		'position'	=> 500,			
	)	
);
	
	
/**
 * [twitter] shortcode callback function.
 * 
 * Based on http://www.zetalight.com/how-to-add-twitter-in-wordpress-using-a-simple-php-function/
 * Based on http://davidwalsh.name/linkify-twitter-feed
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_twitter( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'username' 	=> 'bringthepixel',
		'max' 		=> 1		
	    ), $atts 
	));

    $oauth_enabled = true;
	
	/* Sanitize arguments */
	$username = preg_replace( '/[^0-9a-zA-Z_-]/', '', $username );
	$max = absint( $max );
    $cache_duration = btp_theme_get_option_value( 'twitter_cache_duration', '');

    if (strlen($cache_duration) === 0) {
        $cache_duration = 3600;
    } else {
        $cache_duration = abs($cache_duration);
    }

    // build oAuth config
    $config['key'] =          btp_theme_get_option_value( 'twitter_customer_key', '' );
    $config['secret'] =       btp_theme_get_option_value( 'twitter_customer_secret', '' );
    $config['token'] =        btp_theme_get_option_value( 'twitter_access_token', '' );
    $config['token_secret'] = btp_theme_get_option_value( 'twitter_access_token_secret', '' );
    $config['screenname'] =   $username;
    $config['cache_expire'] = 0;

    $wp_upload_dir = wp_upload_dir();
    $config['directory'] = trailingslashit($wp_upload_dir['basedir']);

    $oauth_configured = !empty($config['key']) && !empty($config['secret']) && !empty($config['token']) && !empty($config['token_secret']);

    $use_oauth = ($oauth_enabled && $oauth_configured);

    // Compose the transient name
    if ($use_oauth) {
        $transient = 'g1_twitter_oauth_' . $config['screenname'] . '_' . $max;
    } else {
        $transient = 'g1_twitter_' . $username . '_' . $max;
    }

    $out = '';

    $tweets = $cache_duration > 0 ? get_transient( $transient ) : false;

    if ( false === $tweets ) {
        if ($use_oauth) {
            require_once('StormTwitter.class.php');

            $obj = new StormTwitter($config);
            $res = $obj->getTweets($max);

            if (empty($res)) {
                return $out;
            }

            $tweets = $res;
        }

        // Set transient
        if ($cache_duration > 0) {
            set_transient($transient, $tweets, $cache_duration);
        }
    }

    $secondsOffset = 0;

    $timezoneOffset = get_option('gmt_offset');
    if (is_numeric($timezoneOffset)) {
        $secondsOffset = $timezoneOffset * 3600;
    }

    $tweetsFetched = ($tweets !== false && (is_array($tweets) && !isset($tweets['error'])));

    if ( $tweetsFetched ) {
        /* Compose output */
        foreach ( (array) $tweets as $tweet) {
            if (is_array($tweet)) {
                $tweet = (object)$tweet;
            }

            $_out = "\t\t" . '<li>' . "\n" .
                "\t\t\t" . '<div class="tweet">' . "\n" .
                "\t\t\t\t" . '<p class="tweet-text">%tweet_text%</p>' . "\n" .
                "\t\t\t\t" . '<p class="meta"><a href="%tweet_href%" rel="bookmark">%tweet_time%, %tweet_date%</a></p>' . "\n" .
                "\t\t\t" . '</div>' . "\n" .
                "\t\t" . '</li>' . "\n";

            $_out = str_replace(
                array(
                    '%tweet_text%',
                    '%tweet_href%',
                    '%tweet_time%',
                    '%tweet_date%',
                ),
                array(
                    btp_twitter_linkify( $tweet->text ),
                    esc_url( 'http://twitter.com/' . $username . '/status/' . $tweet->id ),
                    date( get_option( 'time_format' ), strtotime( $tweet->created_at ) + $secondsOffset ),
                    date( get_option( 'date_format' ), strtotime( $tweet->created_at ) + $secondsOffset ),
                ),
                $_out
            );

            $out .= $_out;
        }
    }

    $out = 	'<div class="twitter">' . "\n" .
                "\t" . '<ul class="tweets">' . "\n" .
                    $out .
                "\t" . '</ul>' . "\n" .
                "\t" . '<p><a href="' . esc_url( 'http://twitter.com/' . $username ) . '"><span>' . sprintf( __( 'Follow @%s', 'btp_theme' ), esc_html( $username ) ) . '</span></a>' . '</p>' . "\n" .
            '</div>';

	return $out;
}
add_shortcode( 'twitter', 'btp_shortcode_twitter' );



/**
 * Linkifies twitter statuses
 * 
 * @param 			string $status_text
 * @return			string
 */
function btp_twitter_linkify( $status_text ) {
  	/* linkify URLs */
  	$status_text = preg_replace(
    	'/(https?:\/\/\S+)/',
    	'<a href="\1">\1</a>',
    	$status_text
  	);

  	/* linkify twitter users */
  	$status_text = preg_replace(
    	'/(^|\s)@(\w+)/',
    	'\1@<a href="http://twitter.com/\2">\2</a>',
    $status_text
  	);

	/* linkify tags */
  	$status_text = preg_replace(
    	'/(^|\s)#(\w+)/',
    	'\1#<a href="http://search.twitter.com/search?q=%23\2">\2</a>',
    $status_text
  	);

  	return $status_text;
}



/**
 * Encodes captcha 'secret' value 
 * 
 * @param 			string $v
 * @return			string
 */
function btp_captcha_encode( $v ) {
	return md5( $v . '41' );
}
	


/* Add [contact_form] shortcode to the global shortcode generator */
btp_shortgen_add_item( 
	'contact_form',
	array(
		'label'			=> '[contact_form]',
		'atts'			=> array(
			'email' 			=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'The recipient\'s email', 'btp_theme' ),
			),
			'name' 				=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'The recipient\'s name', 'btp_theme' ), 
			),
			'subject' 			=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'The subject of the email', 'btp_theme' ), 
			),
			'success_text'		=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'The text to display after sending an email successfully', 'btp_theme' ),
			),
			'failure_text'		=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'The text to display, if the contact  form has errors', 'btp_theme' ), 
			),
		),
		'display'		=> 'block',
		'group'			=> 'general',
		'subgroup'		=> 'misc',
		'position'		=> 90,	
	)			 
); 
	


/**
 * [contact_form] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_contact_form( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
		
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',			
		'email'			=> '',
		'name'			=> '',		
		'subject'		=> '',
		'success'		=> '',
		'failure'		=> '',								
		), $atts ) );
		
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'contact-form-counter-' . $counter;

	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'contact-form ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
	
		
	$email 		= strlen( $email ) ? $email : get_option( 'admin_email' );	
	$name 		= strlen( $name ) ? $name : get_option( 'blogname' );
	$subject 	= strlen( $subject ) ? $subject : __( 'Website Contact Form', 'btp_theme' );
	$success 	= strlen( $success ) ? $success : __( 'We have received your email. Thank you.', 'btp_theme' ); 	
	$failure 	= strlen( $failure ) ? $failure : __( 'Ooops, something has gone wrong.', 'btp_theme' );
	
	$errors = array();
	$email_sent = null;
	
	/* Captcha vars */
	$captcha_n1 = rand(1, 15);
	$captcha_n2 = rand(1, 15);
	$captcha_hidden_hash = btp_captcha_encode($captcha_n1 + $captcha_n2);


    // Default values
    $field_name = '';
    $field_email = '';
    $field_message = '';

    $field_ids = array(
        'name'          => 'contact_form_name_' . $counter,
        'email'         => 'contact_form_email_' . $counter,
        'message'       => 'contact_form_message_' . $counter,
        'captcha'       => 'contact_form_captcha_' . $counter ,
        'captcha_hash'  => 'contact_form_captcha_hash_' . $counter,
    );

	/* Check if form has been submitted */
	if( isset($_POST['contact_form_submit_'.$counter]) ) {
        // Strip input data (remove slashes added by WP)
        foreach ( $field_ids as $id => $name ) {
            if (isset($_POST[$name])) {
                $form_fields[ $id ] = stripslashes_deep( $_POST[$name] );
            }
        }

        // Sanitize input data
        $field_name 		= trim( $form_fields['name'] );
        $field_email 		= trim( $form_fields['email'] );
        $field_message 		= trim( $form_fields['message'] );
        $field_captcha 		= trim( $form_fields['captcha'] );
        $field_captcha_hash	= trim( $form_fields['captcha_hash'] );

		/* Validate input data */	
		if ( strlen( $field_name ) < 2 ) {
			$errors['name'] = true;
		}

        if (  is_email($field_email) !== $field_email ) {
            $errors['email'] = true;
		}

		if ( strlen( $field_message ) < 2 ) {
			$errors['message'] = true;
		}

		if ( btp_captcha_encode( $field_captcha ) != $field_captcha_hash ) {
			$errors['captcha'] = true;
		}	
	
		if ( !count( $errors ) ) {
            // Send email
            $headers = 'From: ' . sanitize_mail_header( $field_name ) . ' <'. sanitize_mail_header( $field_email ) . '>' . "\r\n";
            $email_sent = wp_mail( $email, $subject, $field_message, $headers);
		}
	}
	
	/* Compose output */
	$out = '';	

	$out .= '<form action="' . get_permalink() . '#' . esc_attr( $final_id ) . '" method="post" id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '">';
	
		/* Notification message */
		if ( $email_sent === true )
			$out .= btp_shortcode_message(array( 'type' => 'success' ), esc_html( $success ) );
		elseif( $email_sent === false )
			$out .= btp_shortcode_message(array( 'type' => 'error'), esc_html( $failure ) );
	
		if ( count( $errors ) ) 
			$out .= btp_shortcode_message(array( 'type' => 'warning'), esc_html( __( 'Please correct the errors on this form.', 'btp_theme' ) ) );
		
		/* Name field */
        $_class = array( 'form-row' );
        $_msg = '';
        if ( isset ( $errors['name'] ) ) {
            $_class[] = 'form-row-error';
            $_msg = '<div class="form-message">' .
                esc_html( __( 'Please enter your name', 'btp_theme' ) ) .
                '</div>';
        }

        $out .= '<div class="' . sanitize_html_classes( $_class ) . '">' .
            '<label for="' . esc_attr( $field_ids['name'] ) . '">' .
            esc_html( __( 'Name', 'btp_theme' ) ) . ' ' .
            '<em class="meta">' . __( '(required)', 'btp_theme' ) .
            '</em>' .
            '</label>' .
            $_msg .
            '<input type="text" id="' .esc_attr( $field_ids['name'] ) . '" name="' . esc_attr( $field_ids['name'] ) . '" value="' . esc_attr( $field_name ) . '" />' .
            '</div>';

		/* Email field */
        $_class = array( 'form-row' );
        $_msg = '';
        if ( isset ( $errors['email'] ) ) {
            $_class[] = 'form-row-error';
            $_msg = '<div class="form-message">' .
                esc_html( __('Please enter a valid email address', 'btp_theme') ) .
                '</div>';
        }

        $out .= '<div class="' . sanitize_html_classes( $_class ) . '">' .
            '<label for="' . esc_attr( $field_ids['email'] ) . '">' .
            esc_html( __( 'Email', 'btp_theme' ) ) . '  ' .
            '<em class="meta">' . __( '(required)', 'btp_theme' ) . '</em>' .
            '</label>' .
            $_msg .
            '<input type="text" id="' . esc_attr( $field_ids['email'] ) . '" name="' . esc_attr( $field_ids['email'] ) . '" value="' . esc_attr($field_email) . '" />' .
            '</div>';

		/* Message field */
        $_class = array( 'form-row' );
        $_msg = '';
        if ( isset ( $errors['message'] ) ) {
            $_class[] = 'form-row-error';
            $_msg = '<div class="form-message">' .
                esc_html( __('Please leave a message', 'btp_theme') ) .
                '</div>';
        }

        $out .= '<div class="' . sanitize_html_classes( $_class ) . '">' .
            '<label for="' . esc_attr( $field_ids['message'] ) . '">' .
            esc_html( __( 'Message', 'btp_theme' ) ) .
            '</label>' .
            $_msg .
            '<textarea id="' . esc_attr( $field_ids['message'] ) . '" name="' .  esc_attr( $field_ids['message'] ) . '" rows="5" cols="5">' . esc_textarea( $field_message ) . '</textarea>' .
            '</div>';

		/* Captcha field */
        $_class = array( 'form-row' );
        $_msg = '';
        if ( isset ( $errors['captcha'] ) ) {
            $_class[] = 'form-row-error';
            $_msg = '<div class="form-message">' .
                esc_html( __( 'Please enter a valid result', 'btp_theme') ) .
                '</div>';
        }

        $out .= '<div class="' . sanitize_html_classes( $_class ) . '">' .
            '<label for="' . esc_attr( $field_ids['captcha'] ) . '">' .
            esc_html( $captcha_n1 . ' + ' . $captcha_n2 . ' ? ') . ' ' .
            '<em class="meta">' . __( '(Are you human?)', 'btp_theme' ) . '</em>' .
            '</label>' .
            $_msg .
            '<input type="text" class="u-2" id="' . esc_attr( $field_ids['captcha'] ) . '" name="' . esc_attr( $field_ids['captcha'] ) . '" value="" />' .
            '</div>';

		/* Hidden captcha hash */
        $out .= '<fieldset>' .
            '<input type="hidden" id="' . esc_attr( $field_ids['captcha_hash'] ) . '" name="' . esc_attr( $field_ids['captcha_hash'] ) . '" value="' . esc_attr($captcha_hidden_hash) . '" />' .
            '</fieldset>';

        // Submit button
        $out .= '<div class="form-row">' .
            '<input type="submit" name="contact_form_submit_' . esc_attr( $counter ) . '" id="contact_form_submit_' . esc_attr( $counter ) . '" value="' . __( 'Submit', 'btp_theme' ) . '" />' .
            '</div>';

    $out .= '</form>';

	return $out;
}
add_shortcode( 'contact_form', 'btp_shortcode_contact_form' );




/* Add [box] shortcode to the global shortcode generator */
btp_shortgen_add_item( 
	'box',
	array(
		'label'			=> '[box]',
		'atts'			=> array(
			'id' 			=> array( 
				'view' 			=> 'String',
				'hint'			=> 
					__( 'The id attribute specifies an id for an HTML element.', 'btp_theme' ) . '<br />' .
					__( 'It must be unique within the HTML document.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),	 
			),
			'class'			=> array(
				'view'			=> 'String',
				'hint'			=> 
					__( 'The class attribute specifies a class name for an HTML element.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),
			),
		),
		'content'		=> array( 
			'view' 	=> 'Text',
			'hint'	=> __( 'This shortcode should be use along with the box_header and the box_content shortcodes', 'btp_theme' ), 
		),
		'type'			=> 'block',
		'group'			=> 'general',
		'subgroup'		=> 'basic',	
		'position'		=> 150,
	)						 
);
/* Add [box_header] shortcode to the global shortcode generator */
btp_shortgen_add_item( 
	'box_header',
	array(
		'label'			=> '[box_header]',
		'atts'			=> array(
			'id' 			=> array( 
				'view' 			=> 'String',
				'hint'			=> 
					__( 'The id attribute specifies an id for an HTML element.', 'btp_theme' ) . '<br />' .
					__( 'It must be unique within the HTML document.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),	 
			),
			'class'			=> array(
				'view'			=> 'String',
				'hint'			=> 
					__( 'The class attribute specifies a class name for an HTML element.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),
			),
		),
		'content'		=> array( 
			'view' 	=> 'Text',
			'hint'	=> __( 'This shortcode should be use along with the box and the box_content shortcodes', 'btp_theme' ), 
		),
		'group'			=> 'general',
		'subgroup'		=> 'basic',	
		'position'		=> 151,
	)						 
); 
/* Add [box_content] shortcode to the global shortcode generator */
btp_shortgen_add_item( 
	'box_content',
	array(
		'label'			=> '[box_content]',
		'atts'			=> array(
			'id' 			=> array( 
				'view' 			=> 'String',
				'hint'			=> 
					__( 'The id attribute specifies an id for an HTML element.', 'btp_theme' ) . '<br />' .
					__( 'It must be unique within the HTML document.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),	 
			),
			'class'			=> array(
				'view'			=> 'String',
				'hint'			=> 
					__( 'The class attribute specifies a class name for an HTML element.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),
			),
		),
		'content'		=> array( 
			'view' 	=> 'Text',
			'hint'	=> __( 'This shortcode should be use along with the box and the box_header shortcodes', 'btp_theme' ), 
		),
		'type'			=> 'block',	
		'group'			=> 'general',
		'subgroup'		=> 'basic',	
		'position'		=> 152,
	)						 
);   
/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Example Box 1',
	array(
		'label'		=> __('Example Box 1', 'btp_theme'),
		'result'	=> '[box]' . 
						"\n\n" .
						'[box_header]some header goes here...[/box_header]' .						 
						"\n\n" .
						'[box_content]' .
						"\n\n" .
						'some text goes here...' .
						"\n\n" .
						'[/box_content]' .
						"\n\n" .		
						'[/box]',
		'type'		=> 'block',	
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 153,														
	)
); 
/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** Example Box 2',
	array(
		'label'		=> __('Example Box 2', 'btp_theme'),
		'result'	=> '[box]' . 
						"\n\n" .
						'[box_header]' .
						"\n\n" .
						'<h3>some header goes here...</h3>' .
						"\n\n" .
						'[/box_header]' .						 
						"\n\n" .
						'[box_content]' .
						"\n\n" .
						'some text goes here...' .
						"\n\n" .
						'[/box_content]' .
						"\n\n" .		
						'[/box]',
		'type'		=> 'block',	
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 154,														
	)
); 




/**
 * [box] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_box( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
		
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',		
		), $atts ) );
		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'box-counter-' . $counter;

	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'box ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
		
	/* Compose output */
	$out = '';	
	
	$out .= '<div id="' . esc_attr( $final_id ) . '" ';
	$out .= 'class="' . esc_attr( $final_class ) . '" ';
	$out .= '>';
		$out .= do_shortcode(shortcode_unautop($content));
	$out .= '</div>';
	
	return $out;
}
add_shortcode( 'box', 'btp_shortcode_box' );



/**
 * [box_header] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_box_header( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
		
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',		
		), $atts ) );
		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'box-header-counter-' . $counter;

	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'box-header ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
		
	/* Compose output */
	$out = '';	
	
	$out .= '<div id="' . esc_attr( $final_id ) . '" ';
	$out .= 'class="' . esc_attr( $final_class ) . '" ';
	$out .= '>';
		$out .= do_shortcode(shortcode_unautop($content));
	$out .= '</div>';
	
	return $out;
}
add_shortcode( 'box_header', 'btp_shortcode_box_header' );



/**
 * [box_content] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_box_content( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
		
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',		
		), $atts ) );
		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'box-content-counter-' . $counter;

	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'box-content ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
		
	/* Compose output */
	$out = '';	
	
	$out .= '<div id="' . esc_attr( $final_id ) . '" class="' . esc_attr( $final_class ) . '" >'.
				'<div class="inner">' . 
					do_shortcode( shortcode_unautop( $content ) ) .
				'</div>' .
				'<div class="background"></div>' .		 
			'</div>';
	
	return $out;
}
add_shortcode( 'box_content', 'btp_shortcode_box_content' );







/* Add [button] shortcode to the global shortcode generator */
btp_shortgen_add_item( 
	'progress_bar',
	array(
		'label'			=> '[progress_bar]',
		'atts'			=> array(
			'id' 			=> array( 
				'view' 			=> 'String',
				'hint'			=> 
					__( 'The id attribute specifies an id for an HTML element.', 'btp_theme' ) . '<br />' .
					__( 'It must be unique within the HTML document.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),	 
			),
			'class'			=> array(
				'view'			=> 'String',
				'hint'			=> 
					__( 'The class attribute specifies a class name for an HTML element.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),
			),
			'value' 			=> array( 
				'view' 			=> 'String',
				'hint'			=> 
					__( '0-100 range', 'btp_theme' ),	 
			),
            'text_color'		=> array(
                'view' 			=> 'Color',
                'hint'			=> __( 'Text Color', 'btp_theme' ),
            ),
            'bg_color'		=> array(
                'view' 			=> 'Color',
                'hint'			=> __( 'Background Color', 'btp_theme' ),
            ),
		),
		'group'			=> 'general',
		'subgroup'		=> 'basic',	
		'position'		=> 1780,
	)						 
); 




/**
 * [progress_bar] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_progress_bar( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
		
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',	
		'value'			=> 50,
        'bg_color'      => '',
        'text_color'    => '',
		), $atts ) );
		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);

	$value = absint($value);
	if  ($value < 0 ) {
		$value = 0;
	}	

	if( $value > 100 ) {
		$value = 100;	
	}
		
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'progress-bar-counter-' . $counter;

	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'progress-bar ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class );


    /* Compose CSS */
    $css = '';
    if ( strlen( $text_color ) ) {
        $color = new BTP_Color($text_color);
        $css .= '#' . esc_attr($final_id) . '.progress-bar > .inner > span {' . "\n" .
            'color: #' . $color->get_hex() . ';' ."\n" .
            '}' ."\n";
    }

    if ( strlen( $bg_color ) ) {
        $color = new BTP_Color($bg_color);
        $hex = $color->get_hex();
        list($from, $to) = BTP_Colorgen::get_warm_gradient( $color );
        $from_hex = $from->get_hex();
        $to_hex = $to->get_hex();

        $css .= '#' . esc_attr($final_id) . '.progress-bar > .inner > span {' . "\n" .
            'background-color: #' . $to_hex . ';' . "\n" .
            '}' . "\n";

        $css .= '#' . esc_attr($final_id) . '.progress-bar > .inner {' . "\n" .
            'background-color: #' . $hex . ';' . "\n" .
            'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, startColorstr=#' . $from_hex . ', endColorstr=#ff' . $to_hex . ');' . "\n" .
            '-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=#' . $from_hex . ', endColorstr=#' . $to_hex. ')";' . "\n" .

            'background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#' . $from_hex . '), to(#'. $to_hex . '));' . "\n" .
            'background-image: -webkit-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
            'background-image:    -moz-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
            'background-image:     -ms-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
            'background-image:      -o-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
            'background-image:         linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
            '}' . "\n";

        $css .= '#' . esc_attr($final_id) . '.progress-bar > .inner > span:after {' . "\n" .
            'border-color: #' . $to_hex . ';' . "\n" .
            '}' . "\n";
    }
		
	/* Compose output */
	$out =  '%css%' .
            '<div id="%id%" class="%class%">' .
                '<div class="inner" style="width:%value%%;">' .
                    '<span>%value%</span>' .
                '</div>' .
            '</div>';

    $out = str_replace(
        array(
            '%css%',
            '%id%',
            '%class%',
            '%value%'
        ),
        array(
            strlen($css) ? "\n" . '<style type="text/css" scoped="scoped">' . $css . '</style>' . "\n" : '',
            esc_attr( $final_id ),
            esc_attr( $final_class ),
            $value
        ),
        $out
    );
	
	return $out;
}
add_shortcode( 'progress_bar', 'btp_shortcode_progress_bar' );

?>
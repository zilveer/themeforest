<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/**
 * Adds default elements for the current request.
 * 
 * @param 			array $elems
 * @return			array
 */
function btp_add_default_elements( $elems ) {
	$elems = array_multimerge( $elems, array(
		'title'			=> true,
		'breadcrumbs'	=> true,
		'sidebar_1'		=> 'primary',
	));
	
	return $elems;
}	
add_filter( 'btp_elements_defaults', 'btp_add_default_elements' );



/**
 * Inits localization mechanism
 */
function btp_init_localization() {	
	load_theme_textdomain( 'btp_theme', get_template_directory().'/languages' );

	$locale  = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable($locale_file) )
		require_once($locale_file);
}



/**
 * Registers and enqueues stylesheets
 */
function btp_theme_enqueue_styles() {
	if ( !is_admin() ) {
		$uri = get_template_directory_uri();
					
		wp_register_style( 'main', $uri.'/css/main.css', array(), false, 'screen' );
		wp_register_style( 'skin', $uri.'/css/skins/default.css?respondjs=no', array('main'), false, 'screen' );
		wp_register_style( 'style', get_bloginfo( 'stylesheet_url' ), array('main', 'skin'), false, 'screen' );
				
	    wp_register_style( 'prettyPhoto', $uri.'/js/prettyPhoto/css/prettyPhoto.css', array(), false, 'screen' );
		wp_register_style( 'helpmode', $uri.'/framework/css/help-mode.css', array(), false, 'screen' );
		
	    wp_enqueue_style( 'main' );
	    wp_enqueue_style( 'skin' );
	    
		if ( get_template_directory() !== get_stylesheet_directory() ) {
			wp_enqueue_style( 'style' );				
		}

	    wp_enqueue_style( 'prettyPhoto' );
	    
	    if ( current_user_can( 'administrator' ) && 'none' !== btp_theme_get_option_value( 'general_help_mode' ) ) {					
	    	wp_enqueue_style( 'helpmode' );
		}
		
		/* Print stylesheet */
		wp_register_style( 'print', $uri.'/css/print.css', array(), false, 'print' );
		wp_enqueue_style( 'print' );
	}
}


	
function btp_theme_enqueue_scripts() {
	if( !is_admin() ) {	    
		$uri = get_template_directory_uri();
        $child_uri = trailingslashit( get_stylesheet_directory_uri() );
		
		wp_register_script( 'metadata', $uri.'/js/jquery-metadata/jquery.metadata.js', array('jquery') );
		wp_register_script( 'easing', $uri.'/js/easing/jquery.easing.1.3.js', array('jquery') );
		wp_register_script( 'hoverintent', $uri.'/js/tools/jquery.hoverIntent.minified.js', array('jquery') );
		
		wp_register_script( 'prettyphoto', $uri.'/js/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery') );
		wp_register_script( 'main', $uri.'/js/main.js', array('jquery'), '1.0' );
		
		wp_register_script( 'simplemodal', $uri.'/framework/js/jquery.simplemodal/js/jquery.simplemodal.1.4.1.min.js', array('jquery'), '1.0' );
		wp_register_script( 'helpmode', $uri.'/framework/js/help-mode.js', array('jquery'), '1.0' );
		
		wp_register_script( 'jquery.isotope', $uri.'/js/jquery.isotope/jquery.isotope.min.js', array('jquery'), '1.0' );

        // Register child theme related scripts
        if ( $uri !== $child_uri ) {
            wp_register_script( 'child_main', $child_uri . 'modifications.js', array('main'), false, true );
        }
		
	    /* Enqueue javascripts */
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'metadata' );
		wp_enqueue_script( 'easing' );		
		wp_enqueue_script( 'hoverintent' );
		wp_enqueue_script( 'prettyphoto' );
		
		
		wp_enqueue_script( 'main' );
		
		$theme_data = array( 
			'uri' => $uri, 
		);
		wp_localize_script( 'main', 'btpTheme', $theme_data );
		
		if ( current_user_can( 'administrator' ) && 'none' !== btp_theme_get_option_value( 'general_help_mode' ) ) {
			wp_enqueue_script( 'simplemodal' );
			wp_enqueue_script( 'helpmode' );
		}

        if ( $uri !== $child_uri ) {
            wp_enqueue_script( 'child_main' );
        }
	}
}



/**
 * Init post thumbnails
 * 
 * This function should be fired after child theme setup. 
 * Child theme can customize some parameters
 */
function btp_init_post_thumbnails() {		
	global $_BTP;
	
	/* Compose defaults */
	$defaults = array(
		'name'		=> 'image',
		'width'		=> 100,
		'height' 	=> 100,
		'crop'		=> true
	);	
		
	foreach( $_BTP[ 'theme_option_holder' ]->hierarchy[ 'style' ][ 'subgroups' ][ 'postthumbnails' ][ 'items' ] as $item_id => $item_args ) {				
		$config = (array) btp_theme_get_option_value( $item_id );
		
		/* Merge defaults with the current configuration */
		$config = array_multimerge( $defaults, $config );
			
		add_image_size( $config[ 'name' ], $config[ 'width' ], $config[ 'height' ], $config[ 'crop' ] );
	}
}	



/**
 * Registers sidebars
 * 
 * Registers permanent sidebars and custom ones from the sidedar generator
 */
function btp_init_sidebars() {		
	$sidebars = explode( "\n", trim( btp_theme_get_option_value( 'sidebar_generator' ) ) );
    $sidebars = array_map( 'trim', $sidebars );

    /* Prepend default sidebar */
    array_unshift( 
    	$sidebars, 
    	'primary',
    	'preheader-1',
    	'preheader-2',
    	'preheader-3',
    	'preheader-4',
    	'prefooter-1',
    	'prefooter-2',
    	'prefooter-3',
    	'prefooter-4'
    );    

   	if ( count( $sidebars ) ) {    		
		foreach ( $sidebars as $sidebar) {
			if ( strlen( $sidebar ) ) {			
    			register_sidebar( array(
					'name'				=> $sidebar,
					'id'				=> $sidebar,
				    'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
			   		'after_widget' 		=> '</section>',
		   			'before_title'  	=> '<header><h3 class="widgettitle">',
					'after_title'   	=> '</h3></header>' 
			    ));
			}
		}		    
   	}
}


	
/**
 * Registers Custom Navigation Locations
 */
function btp_init_nav_menus() {
	register_nav_menus(
		array(
			'primary_nav' 			=> __( 'Primary Navigation', 'btp_theme' ),
			'secondary_nav' 		=> __( 'Secondary Navigation', 'btp_theme' ),
			'footer_nav'			=> __( 'Footer Navigation', 'btp_theme' ),
		)		
	);
}



/**
 * Inits shortcodes
 */
function btp_init_shortcodes() {
	require_once( BTP_LIB_DIR.'/shortcodes/basic.php' );
	require_once( BTP_LIB_DIR.'/shortcodes/grid.php' );
	require_once( BTP_LIB_DIR.'/shortcodes/panels.php' );
	require_once( BTP_LIB_DIR.'/shortcodes/misc.php' );
	require_once( BTP_LIB_DIR.'/shortcodes/_page_snippets.php' );
	
	//add_shortcode('wp_caption', 'btp_img_caption_shortcode');
	//add_shortcode('caption', 'btp_img_caption_shortcode');
}



/**
 * Inits widgets
 */
function btp_init_widgets() {
	if ( !is_admin() ) { 
		add_filter( 'widget_text', 'do_shortcode', 11 );
	}
	
	require_once( BTP_LIB_DIR.'/widgets/contact_form.php' );
	require_once( BTP_LIB_DIR.'/widgets/twitter.php' );
}



/**
 * Inits font-replacement mechanism
 */
function btp_init_fonts() {
	global $_BTP;

	if ( is_admin()) {
		return;
	}
	
	foreach( $_BTP[ 'theme_option_holder' ]->hierarchy[ 'style' ][ 'subgroups' ][ 'fonts' ][ 'items' ] as $id => $args ) {
		$val = btp_theme_get_option_value( $id );				
		
		if ( !is_array( $val ) || empty( $val[ 'font' ] ) ) {
			continue;
		}
		
		$def = $_BTP[ 'fonts' ][ $val[ 'font' ] ];
		$classname = 'BTP_Font_Engine_' . $def[ 'engine' ];
		
		if ( is_callable( array( $classname, 'init_font' ) ) ) {
			call_user_func( array( $classname, 'init_font' ), $def, $val );
		}
	}	
}




/**
 * Returns available choices for theme alignment
 * 
 * If you want to add/delete some choices, hook into the btp_theme_alignment_choices custom filter.
 * 
 * @return			array
 */
function btp_theme_alignment_get_choices() {
	$path = get_template_directory_uri();
	$path = $path . '/images/admin-assets';
	
	$choices = array(				
		'left'		=> $path.'/theme-alignment-left.png',	
		'center'	=> $path.'/theme-alignment-center.png',
		'right'		=> $path.'/theme-alignment-right.png',
	);
	
	return apply_filters( 'btp_theme_alignment_choices', $choices );
}



/**
 * Returns layout choices for preheader
 *
 * If you want to add/delete some choices, hook into the btp_preheader_layout_choices custom filter.
 *
 * @return			array
 */
function btp_preheader_get_layout_choices() {
	$path = get_template_directory_uri();
	$path = $path . '/images/admin-assets';
	
	$choices = array(				
		''					=> $path.'/none.png',
		'1/1'				=> $path.'/widgets-1-column.png',	
		'1/2_1/2'			=> $path.'/widgets-2-equal-columns.png',
		'1/3_1/3_1/3'		=> $path.'/widgets-3-equal-columns.png',
		'1/4_1/4_1/4_1/4'	=> $path.'/widgets-4-equal-columns.png',
		'1/2_1/4_1/4'		=> $path.'/widgets-1_2-1_4-1_4.png',
		'1/4_1/2_1/4'		=> $path.'/widgets-1_4-1_2-1_4.png',
		'1/4_1/4_1/2'		=> $path.'/widgets-1_4-1_4-1_2.png',
		'1/4_3/4'			=> $path.'/widgets-1_4-3_4.png',
		'3/4_1/4'			=> $path.'/widgets-3_4-1_4.png',
	);
	
	return apply_filters( 'btp_preheader_layout_choices', $choices );
}



/**
 * Returns layout choices for prefooter
 * 
 * If you want to add/delete some choices, hook into the btp_prefooter_layout_choices custom filter.
 * 
 * @return			array
 */
function btp_prefooter_get_layout_choices() {
	$path = get_template_directory_uri();
	$path = $path . '/images/admin-assets';
	
	$choices = array(				
		''					=> $path.'/none.png',
		'1/1'				=> $path.'/widgets-1-column.png',	
		'1/2_1/2'			=> $path.'/widgets-2-equal-columns.png',
		'1/3_1/3_1/3'		=> $path.'/widgets-3-equal-columns.png',
		'1/4_1/4_1/4_1/4'	=> $path.'/widgets-4-equal-columns.png',
		'1/2_1/4_1/4'		=> $path.'/widgets-1_2-1_4-1_4.png',
		'1/4_1/2_1/4'		=> $path.'/widgets-1_4-1_2-1_4.png',
		'1/4_1/4_1/2'		=> $path.'/widgets-1_4-1_4-1_2.png',
		'1/4_3/4'			=> $path.'/widgets-1_4-3_4.png',
		'3/4_1/4'			=> $path.'/widgets-3_4-1_4.png',
	);
	
	return apply_filters( 'btp_prefooter_layout_choices', $choices );
}



/**
 * Returns layout choices for footer
 * 
 * If you want to add/delete some choices, hook into the btp_footer_layout_choices custom filter.
 * 
 * @return			array
 */
function btp_footer_get_layout_choices() {
	$path = get_template_directory_uri();
	$path = $path . '/images/admin-assets';
	
	$choices = array(		
		'text-nav'			=> $path.'/footer-text-nav.png',	
		'nav-text'			=> $path.'/footer-nav-text.png',
	);
	
	return apply_filters( 'btp_footer_layout_choices', $choices );
}



/**
 * Determines asset type.
 * 
 * @version				1.0.0
 * 
 * @param 				string $asset
 */
function btp_asset_type( $asset ) { 	
	if ( strlen( $asset ) ) {
		if ( strpos( $asset, 'http://www.youtube.com/') === 0 )
			return 'video';
			
		if ( strpos( $asset, 'http://vimeo.com/') === 0 )
			return 'video';
			
		if ( strpos( $asset, '.jpg') == ( strlen($asset) - 1 - 3 ) )
			return 'image';	
		
		if ( strpos( $asset, '.jpeg') == ( strlen($asset) - 1 - 4 ) )
			return 'image';

		if ( strpos( $asset, '.png') == ( strlen($asset) - 1 - 3 ) )
			return 'image';	

		if ( strpos( $asset, '.gif') == ( strlen($asset) - 1 - 3 ) )
			return 'image';
			
		return 'unknown';				
	}
		
	return false;
}



/** 
 * Adding our custom fields to the $form_fields array 
 * 
 * @param array $form_fields 
 * @param object $attachment 
 * @return array 
 */  
function btp_attachment_image_fields_to_edit( $form_fields, $attachment ) {  
  
	if ( substr( $attachment->post_mime_type, 0, 5 ) == 'image' ){
	    $form_fields[ 'alt_link' ] = array();  
	    $form_fields[ 'alt_link' ][ 'label' ] = __( 'Alternative Link', 'btp_theme' );  
	    $form_fields[ 'alt_link' ][ 'input' ] = 'text';  
	    $form_fields[ 'alt_link' ][ 'value' ] = get_post_meta( $attachment->ID, '_btp_alt_link', true);
	    $form_fields[ 'alt_link' ][ 'helps' ] = __( 'Enter a YouTube video link, a Vimeo video link, an external link, etc.', 'btp_theme' );
	    
	    $form_fields[ 'alt_linking' ] = array();
	    $form_fields[ 'alt_linking' ][ 'label'  ] = __( 'Alternative Linking', 'btp_theme' );	      
		$form_fields[ 'alt_linking' ][ 'input' ] = 'html';
		$form_fields[ 'alt_linking' ][ 'helps' ] = __( 'What to do when user clicks the image?', 'btp_theme' );

		$linking = array( 
			'' 				=> '',
			'new-window'	=> __( 'open the image or the alternative link in a new window', 'btp_theme' ),
			'lightbox'		=> __( 'open the image or the alternative link in a lightbox', 'btp_theme' ),
	    	'none'			=> __( 'don\'t link', 'btp_theme' ),
		);
		$value = get_post_meta( $attachment->ID, '_btp_alt_linking', true);
		$html = '';
		$html .= '<select style="width:100%; max-width:100%;" name="attachments[' . $attachment->ID . '][alt_linking]" id="attachments[' . $attachment->ID .'][alt_linking]">';
		foreach( $linking as $option => $label ) {
			if( $value === $option )
				$html .= '<option selected="selected" value="' . esc_attr( $option ) . '">' . esc_html( $label ) . '</option>';
			else
				$html .= '<option value="' . esc_attr( $option ) . '">' . esc_html( $label ) . '</option>';
		}
		$html .= '</select>';
		$form_fields[ 'alt_linking'][ 'html' ] = $html;
	}
	
    return $form_fields;  
} 
add_filter( 'attachment_fields_to_edit', 'btp_attachment_image_fields_to_edit', null, 2 );




/** 
 * @param array $post 
 * @param array $attachment 
 * @return array 
 */  
function btp_attachment_image_fields_to_save( $post, $attachment ) {
    if ( isset( $attachment[ 'alt_link' ] ) ){ 
        update_post_meta( $post[ 'ID' ], '_btp_alt_link', $attachment[ 'alt_link' ] );  
    }  
    if ( isset( $attachment[ 'alt_linking' ] ) ){ 
        update_post_meta( $post[ 'ID' ], '_btp_alt_linking', $attachment[ 'alt_linking' ] );  
    } 
    return $post;  
} 
add_filter( 'attachment_fields_to_save', 'btp_attachment_image_fields_to_save', null, 2 );





function btp_get_post_type_index_page( $post_type ) {
	if ( 'btp_work' === $post_type ) {
		$id = intval( btp_theme_get_option_value( 'btp_work_index_page' ) );
		
		/* WPML fallback */
	 	if ( function_exists( 'icl_object_id' ) ) {
    		$id = icl_object_id( $id, 'page', true );
  	 	}
  	 	
  	 	return $id;
	} 
}




/**
 * Determines template.
 * 
 * @param 				string $template
 */
function btp_password_required_single_template( $template ) {	
	if ( !post_password_required() ) {
		return $template;
	}
	
	$templates = array();
	$templates[] = 'password-required.php';
	$new_template = locate_template( $templates );
		 
	if ( !empty( $new_template ) ) {			
		return $new_template;
	}
	
	return $template;
}
add_filter( 'single_template', 'btp_password_required_single_template', 999 );
add_filter( 'page_template', 'btp_password_required_single_template', 999 );




/**
 * Captures favicon HTML markup
 * 
 * @param 			string $src
 * @param 			bool $echo
 */
function btp_favicon_capture( $src = null ) {
	$src = empty( $src ) ? $src = btp_theme_get_option_value( 'general_favicon_src' ) : $src;
	
	if ( empty( $src ) ) {
		return;
	}

	$out = '';
	$out .= strlen( $src ) ? '<link rel="shortcut icon" href="' . esc_url( $src ) . '" />' : '';
		
	return $out;
}
function btp_favicon_render( $src = null ) {
	echo btp_favicon_capture($src);
}
add_action( 'wp_head', 'btp_favicon_render' );

/**
 * Captures Apple touch icon HTML markup
 *
 * @param 			string $src
 *
 * @return          string
 */
function btp_apple_touch_icon_capture($src = null) {
    $src = empty($src) ? $src = btp_theme_get_option_value('general_apple_touch_icon_src') : $src;

    if (empty($src)) {
        return;
    }

    $out = '';

    if (strlen($src)) {
        $out .= sprintf('<link rel="apple-touch-icon" href="%s" />', esc_url( $src ));
    }

    return $out;
}
function btp_apple_touch_icon_render($src = null) {
    echo btp_apple_touch_icon_capture($src);
}
add_action( 'wp_head', 'btp_apple_touch_icon_render' );


function btp_mediabox_get_choices() {
	$choices = array(
        'featured-media'    => 'featured-media',
		'list'				=> 'list',
		'none'				=> 'none',
	);
	
	return apply_filters( 'btp_mediabox_choices', $choices );
}



function btp_mediabox_get_help() {
	$out = '';

	$out .= '<p>' . __( 'A media box is a part of a template, that displays entry attachments.', 'btp_theme' ) . '</p>';
    $out .= '<p>' . __( 'The <strong>featured-media</strong> displays featured image. It tries to embed an attachment alternative link (if provided).', 'btp_theme' ) . '</p>';
	$out .= '<p>' . __( 'The <strong>list</strong> displays image &amp; audio attachments. It tries to embed an attachment alternative link (if provided).', 'btp_theme' ) . '</p>';
	$out .= '<p>' . __( 'The <strong>none</strong> displays nothing.', 'btp_theme' ) . '</p>';
		
	return apply_filters( 'btp_mediabox_help', $out );
}



function btp_loginlogo_capture() {
	$out = '';	
	$loginlogo = esc_url( btp_theme_get_option_value( 'general_loginlogo_src' ) );
	
	if ( !empty( $loginlogo ) ) {
		$out .= '<style type="text/css">';
            $out .= '.login h1 a { max-width:100%; width:100%; height:auto; padding-bottom:20px; text-indent:0; font-size:0; background:none; }';
            $out .= '.login h1 a:before { display:block; content: url(' . $loginlogo . '); }';
		$out .= '</style>';
	}

	return $out;
}
function btp_loginlogo_render() {
	echo btp_loginlogo_capture();
}
add_action('login_head', 'btp_loginlogo_render');




function btp_add_id_column( $columns ) {
	$new_columns = array();
	
	foreach ( $columns as $k => $v ) {
		$new_columns[ $k ] = $v;
		if ( 'cb' == $k ) {
			$new_columns[ 'id' ] = 'ID'; 
		}
	}
	
    return $new_columns;
}
add_filter( 'manage_posts_columns', 'btp_add_id_column' );


function btp_render_id_column( $name ) {
    global $post;
    
    if ( 'id' === $name ) {
        echo $post->ID;
    }
}
add_action('manage_posts_custom_column', 'btp_render_id_column' );





function btp_widget_title( $title ) {
	$title = trim( $title );
	$title = ( $title === "&nbsp;" ) ? '' : $title;
	
	
	return $title;
}
add_filter( 'widget_title', 'btp_widget_title', 9999 );



/**
 * Inserts spans into category listing
 * 
 * @param unknown_type $in
 */
function btp_insert_cat_count_span( $in ) {
	/* Flatten string and insert <span> */
	$out = str_replace( 
		array(
			"\r\n",
			"\n",
			"\t",
			'<a',
		),
		array(
			'',
			'',
			'',
			'<span><a',
		),
		$in 
	);
	
	/* Insert </span> when post counts */
	$out = str_replace(
		array(
			")</li>", 
			")<ul" 
		),
		array(
			")</span></li>", 
			")</span><ul" 
		),
		$out,
		$count
	);
	
	/* Insert </span> when no post counts */
	if ( !$count ) {
		$out = str_replace(
			array(
				"</a></li>",
				"</a><ul",
			),
			array(
				"</a></span></li>",
			 	"</a></span><ul",
				 
			),
			$out
		);		
	}
	
	return $out;
}
add_filter( 'wp_list_categories', 'btp_insert_cat_count_span' );




/**
 *  Custom function for displaying comments 
 */
function btp_wp_list_comments_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-wrapper">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
			</div><!-- .comment-author .vcard -->
			
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'btp_theme' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata meta">
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php printf( __( '%1$s at %2$s', 'btp_theme' ), get_comment_date(),  get_comment_time() ); ?>
				</a> 
				<?php edit_comment_link( __('(Edit)', 'btp_theme' ), ' ' ); ?>
			</div>

			<div class="comment-body"><?php comment_text(); ?></div>

			<footer class="reply meta">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</footer>
		</article><!-- END: #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><?php _e( 'Pingback:', 'btp_theme' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'btp_theme'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}



/**
 * Renders HTML|JavaScript with tracking code set up in Theme Options.
 */
function btp_tracking_code_render() {	
	$t_c = btp_theme_get_option_value( 'tracking_code' );
	if ( strlen( $t_c  ) ) {
		echo $t_c;
	}
}
add_action( 'wp_footer', 'btp_tracking_code_render' );


/**
 * 
 * @param unknown_type $area
 */
function btp_theme_capture_area_styles( $area ) {
	$selector = '#' . $area;
	$css = '';
	
	
	$temp = btp_theme_get_option_value( $area . '_cs_1_background' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();
		
		list($from, $to) = BTP_Colorgen::get_warm_gradient( $color );		
		$from_rgb = $from->get_rgb();
		$from_rgb = array_map( 'round', $from_rgb );
		$to_rgb = $to->get_rgb();
		$to_rgb = array_map( 'round', $to_rgb );
		
		$tone = BTP_Colorgen::get_tone_color( $color, 5, 90 );
		$tone_hex = $tone->get_hex();
		
		$border = BTP_Colorgen::get_tone_color( $color );
		$border_rgb = $border->get_rgb();
		$border_rgb = array_map( 'round', $border_rgb );
		$border_hex = $border->get_hex();
		if( $color->get_lightness() >= 50 ) {
			$border_start = 0;
			$border_end = 0.66;
		} else {
			$border_start = 0.66;
			$border_end = 0;
		}
		
		$css .= $selector . '-inner *,' . "\n" .
				$selector . ' .entry-nav > ul:after,' . "\n" .
				$selector . ' .entry-nav > ul:before {' . "\n" .
					'border-color: #' . $border_hex . '; ' . "\n" . 
				'}' . "\n";
		
		$css .= $selector . ' table.simple tbody tr:nth-child(even) td {' . "\n" .
					'background-color: rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', 0.33);'. "\n" .
				'}' . "\n";
				
		$css .= $selector . ' table.simple thead th,' . "\n" .
				$selector . ' .box-content > .background {' . "\n" .
					'background-color: #' . $tone_hex . ';' . "\n" .
					'background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', ' . $border_start .')), to(rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', ' . $border_end . ')));' . "\n" .
    				'background:-webkit-linear-gradient(top, rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', '. $border_start. '), rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', ' .$border_end . '));' . "\n" .
					'background:   -moz-linear-gradient(top, rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', '. $border_start. '), rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', ' .$border_end . '));' . "\n" .
					'background:    -ms-linear-gradient(top, rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', '. $border_start. '), rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', ' .$border_end . '));' . "\n" .
					'background:     -o-linear-gradient(top, rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', '. $border_start. '), rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', ' .$border_end . '));' . "\n" .
					'background:        linear-gradient(top, rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', '. $border_start. '), rgba(' . $border_rgb[0] . ',' . $border_rgb[1] . ',' . $border_rgb[2] . ', ' .$border_end . '));' . "\n" .
    			'}' . "\n";
		
		$css .= $selector . ' .testimonial.type-bubble > .inner:before,' . "\n" . 
				$selector . ' .tweets:before,' . "\n" .
				$selector . ' .entry-tags ul li a:after {' . "\n" .
					'border-color: #' . $tone_hex . '; ' . "\n" . 
				'}' . "\n";
		
		$css .= $selector . ' .pullquote.type-simple,' . "\n" .
				$selector . ' .testimonial.type-bubble > .inner,' . "\n" .		
				$selector . ' .tweets,' . "\n" .
				$selector . ' .entry-tags ul li a,' . "\n" .
				$selector . ' #author-info,' . "\n" .
				$selector . ' .bypostauthor > article > .comment-body,' . "\n" .
				$selector . ' .isotope-toolbar .filters > ul li a {' . "\n" .
					'background-color: #' . $tone_hex . '; ' . "\n" . 
				'}' . "\n";
	}
	
	
	
	$temp = btp_theme_get_option_value( $area . '_cs_1_heading' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();
		
		$css .= $selector . ' h1,' . "\n" . 
				$selector . ' h2,' . "\n" .
				$selector . ' h3,' . "\n" .
				$selector . ' h4,' . "\n" .
				$selector . ' h5,' . "\n" .
				$selector . ' h6 {' . "\n" . 
					'color: #' . $hex . '; ' . 
				'}' . "\n";
	}		

	$temp = btp_theme_get_option_value( $area . '_cs_1_text' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();
		
		$css .= $selector . ',' . "\n" .
				$selector . ' h1 + h3,' . "\n" . 
				$selector . ' h1 + h4,' . "\n" .
				$selector . ' h1 + h5,' . "\n" .
				$selector . ' h1 + h6,' . "\n" .
				$selector . ' h2 + h4,' . "\n" .
				$selector . ' h2 + h5,' . "\n" .
				$selector . ' h2 + h6,' . "\n" .
				$selector . ' h3 + h5,' . "\n" .
				$selector . ' h3 + h6,' . "\n" .
				$selector . ' h4 + h6,' . "\n" .
				$selector . ' .heading-1 + h3,' . "\n" .
				$selector . ' .heading-1 + h4,' . "\n" .
				$selector . ' .heading-1 + h5,' . "\n" .
				$selector . ' .heading-1 + h6,' . "\n" .
				$selector . ' .heading-2 + h4,' . "\n" .
				$selector . ' .heading-2 + h5,' . "\n" .
				$selector . ' .heading-2 + h6,' . "\n" .
				$selector . ' .heading-3 + h5,' . "\n" .
				$selector . ' .heading-3 + h6,' . "\n" .
				$selector . ' .heading-4 + h6 {' . "\n" .
					'color: #' . $hex . '; ' . 
				'}' . "\n";
	}		
		
	$temp = btp_theme_get_option_value( $area . '_cs_1_link' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex(); 
		
		$css .= $selector . ' a { color: #'. $hex . '; }'."\n";
		$css .= $selector . ' a.back-to:before,' . "\n" . 
				$selector . ' a.back-to:after {' . "\n" .
					'border-color: #'. $hex . ';' . "\n" . 
				'}' . "\n";
				
	}	
	$temp = btp_theme_get_option_value( $area . '_cs_1_link_hover' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex(); 
		
		$css .= $selector . ' a:hover { color: #' . $hex . '; }'."\n";
		$css .= $selector . ' a.back-to:hover:before,' . "\n" .
				$selector . ' a.back-to:hover:after {' . "\n" .
		 			'border-color: #'. $hex . ';' . "\n" . 
				'}' . "\n";
	}

	$temp = btp_theme_get_option_value( $area . '_cs_1_meta_text' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex(); 
				
		$css .= $selector . ' .meta {' . "\n" . 
					'color: #' . $hex . '; ' . 
				'}' . "\n";
	}
	$temp = btp_theme_get_option_value( $area . '_cs_1_meta_link' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex(); 
				
		$css .= $selector . ' .meta a {' . "\n" . 
					'color: #' . $hex . '; ' . 
				'}' . "\n";
	}
	$temp = btp_theme_get_option_value( $area . '_cs_1_meta_link_hover' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex(); 
			
		$css .= $selector . ' .meta a:hover {' . "\n" . 
					'color: #' . $hex . '; ' . 
				'}' . "\n";
	}	
	
	
	
	$temp = btp_theme_get_option_value( $area . '_cs_2_background' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex(); 
		
		list($from, $to) = BTP_Colorgen::get_warm_gradient( $color );
		$from_hex = $from->get_hex();
		$to_hex = $to->get_hex();

		
		$button = clone $from;
		$button_l = $button->get_lightness();
		$button_l += ( $button_l > 20 ) ? -20 : 20;
		$button->set_lightness( $button_l );
		$button_hex = $button->get_hex();

		$css .= $selector . ' mark,' . "\n" .
				$selector . ' .button {' . "\n" .
					'background-color: #' . $button_hex . ';' . "\n" . 
				'}' . "\n";
		
		$css .= $selector . ' .tabs.type-button .tabs-nav-item.current,' . "\n" .
				$selector . ' .progress-bar > .inner > span,' . "\n" .
				$selector . ' .slide[class*="layout-bubble-"] > .description,' . "\n" .
				$selector . ' .isotope-toolbar .filters > ul li.current a {' . "\n" .
					'background-color: #' . $to_hex . ';' . "\n" . 
				'}' . "\n";		
		
		$css .= $selector . ' .plus > span,' . "\n" .
				$selector . ' .minus > span,' . "\n" .
				$selector . ' .dropcap.type-square > span,' . "\n" .
				$selector . ' .button > span > span,' . "\n" .
				$selector . ' .pagination a,' . "\n" .	
				$selector . ' .entry-nav > ul > li > a,' . "\n" .
				$selector . ' .box-header,' . "\n" .
				$selector . ' .progress-bar > .inner {' . "\n" .
					'background-color: #' . $hex . ';' .

					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, startColorstr=#' . $from_hex . ', endColorstr=#ff' . $to_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=#' . $from_hex . ', endColorstr=#' . $to_hex. ')";' . "\n" .
				
					'background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#' . $from_hex . '), to(#'. $to_hex . '));' . "\n" .
    				'background-image: -webkit-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" . 
    				'background-image:    -moz-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
    				'background-image:     -ms-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
    				'background-image:      -o-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
    				'background-image:         linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
				'}' . "\n";	

		$css .=	$selector . ' .plus:hover > span,' . "\n" .
				$selector . ' .minus:hover > span,' . "\n" .
				$selector . ' .button:hover > span > span,' . "\n" .
				$selector . ' .pagination a:hover,' . "\n" .
				$selector . ' .entry-nav > ul > li > a:hover {' . "\n" .
					'background-color: #' . $hex . ';' .

					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, startColorstr=#' . $to_hex . ', endColorstr=#ff' . $from_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=#' . $to_hex . ', endColorstr=#' . $from_hex. ')";' . "\n" .
		
					'background-image: -webkit-gradient(linear, 0% 0%, 0% 200%, from(#' . $to_hex . '), to(#'. $from_hex . '));' . "\n" .
    				'background-image: -webkit-linear-gradient(top, #' . $to_hex . ' 0%, #' . $from_hex . ' 200%);' . "\n" . 
    				'background-image:    -moz-linear-gradient(top, #' . $to_hex . ' 0%, #' . $from_hex . ' 200%);' . "\n" .
    				'background-image:     -ms-linear-gradient(top, #' . $to_hex . ' 0%, #' . $from_hex . ' 200%);' . "\n" .
    				'background-image:      -o-linear-gradient(top, #' . $to_hex . ' 0%, #' . $from_hex . ' 200%);' . "\n" .
    				'background-image:         linear-gradient(top, #' . $to_hex . ' 0%, #' . $from_hex . ' 200%);' . "\n" .
				'}' . "\n";				

        
        $css .= $selector . ' .tabs.type-simple .tabs-nav-item.current,' . "\n" .
        		$selector . ' .side-nav li.current_page_item > a,' . "\n" . 
        		$selector . ' .tabs.type-button .tabs-nav-item.current:after,' . "\n" .
        		$selector . ' .tabs.type-simple .tabs-nav-item.current:after,' . "\n" .
        		$selector . ' .side-nav li.current_page_item > a:after,' . "\n" .        		 
        		$selector . ' .pagination strong.current,' . "\n" .
        		$selector . ' .pagination strong.current:after,' . "\n" .
        		$selector . ' .progress-bar > .inner > span:after,' . "\n" .
        		$selector . ' .slide[class*="layout-bubble-"] > .description:after,' . "\n" .
        		$selector . ' .isotope-toolbar .filters > ul li.current a:after {' . "\n" .        		
					'border-color: #' . $to_hex . ';' . "\n" .
	    		'}' . "\n";
	}	
	
	$temp = btp_theme_get_option_value( $area . '_cs_2_heading' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();		
		$css .= $selector . ' .box-header h1,' . "\n" .
				$selector . ' .box-header h2,' . "\n" .
				$selector . ' .box-header h3,' . "\n" .
				$selector . ' .box-header h4,' . "\n" .
				$selector . ' .box-header h5,' . "\n" .
				$selector . ' .box-header h6,' . "\n" .
				$selector . ' .slide > .description h1,' . "\n" .
				$selector . ' .slide > .description h2,' . "\n" .
				$selector . ' .slide > .description h3,' . "\n" .
				$selector . ' .slide > .description h4,' . "\n" .
				$selector . ' .slide > .description h5,' . "\n" .
				$selector . ' .slide > .description h6,' . "\n" .
				$selector . ' mark,' . "\n" .
				$selector . ' .dropcap.type-square,' . "\n" .
				$selector . ' .button > span > span,' . "\n" .
				$selector . ' .button:hover > span > span,' . "\n" .
				$selector . ' .pagination a,' . "\n" .
				$selector . ' .pagination a:hover,' . "\n" .
				$selector . ' .tabs.type-button .tabs-nav-item.current,' . "\n" .
				$selector . ' .isotope-toolbar .filters > ul li.current a {' . "\n" .				
					'color: #' . $hex . ';' . "\n" .
				'}' . "\n";
				
		$css .= $selector . ' .plus > span > span,' . "\n" .
				$selector . ' .minus > span > span {' . "\n" .
					'background-color: #' . $hex . ';' . "\n" .
				'}' . "\n";		
				
		$css .= $selector . ' .pagination a.next span,' . "\n" .
				$selector . ' .pagination a.prev span,' . "\n" .		
				$selector . ' .entry-nav > ul > li > a > span {' . "\n" .
					'border-color: #' . $hex .';' . "\n" .
				'}' . "\n";				
	}	
	

	$temp = btp_theme_get_option_value( $area . '_cs_2_text' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex(); 
		
		$css .= $selector . ' .progress-bar > .inner > span,' . "\n" .
				$selector . ' .box-header,' . "\n" .
				$selector . ' .slide > .description {' . "\n" .
					'color: #' . $hex . ';' . "\n" .
				'}' . "\n";
	}	
	
	$temp = btp_theme_get_option_value( $area . '_cs_2_link' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();
		
		$css .= $selector . ' .box-header a,' . "\n" .
				$selector . ' .slide > .description a {' . "\n" .				
					'color: #' . $hex . ';' . "\n" .
				'}' . "\n";
	}	
	
	$temp = btp_theme_get_option_value( $area . '_cs_2_link_hover' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();
		
		$css .= $selector . ' .box-header a:hover,' . "\n" .
				$selector . ' .slide > .description a:hover {' . "\n" .				
					'color: #' . $hex . ';' . "\n" .
				'}' . "\n";		
				
	}	
	

		
	return $css;
}



/**
 * Captures custom styles (set in Theme Options) compiled into css code.
 *
 * @return			string
 */
function btp_capture_custom_styles() {
	$css = '';	

	/* ----- PREHEADER ------------------------------------------------------------------------------ */
	$temp = btp_theme_get_option_value( 'preheader_cs_1_background' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();
		
		$css .= '#preheader > .background {' . "\n" . 
					'background-color: #' . $hex . '; ' ."\n" .
				'}' . "\n";
	}
	$css .= btp_theme_capture_area_styles( 'preheader' );

	

	/* ----- HEADER --------------------------------------------------------------------------------- */
	$temp = btp_theme_get_option_value( 'style_header_logo_margin_top' );	
	if ( is_numeric( $temp ) ) {
		$temp = absint( $temp );
		
		$css .= '#id {' . "\n" .
					'padding-top: ' . $temp . 'px;' ."\n" .
				'}' . "\n";
	}
	$temp = btp_theme_get_option_value( 'style_header_logo_margin_bottom' );	
	if ( is_numeric( $temp ) ) {
		$temp = absint( $temp );
		
		$css .= '#id {' . "\n" .
					'padding-bottom: ' . $temp . 'px;' ."\n" .
				'}' . "\n";
	}
	$temp = btp_theme_get_option_value( 'style_header_primary_nav_margin_top' );	
	if ( is_numeric( $temp ) ) {
		$temp = absint( $temp );
		
		$css .= '#primary-nav {' . "\n" .
					'margin-top: ' . $temp . 'px;' ."\n" .
				'}' . "\n";
	}
	
	$temp = btp_theme_get_option_value( 'header_cs_1_link_hover' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();

		$css .= '#primary-nav-menu > li > a:hover,' . "\n" . 
				'#primary-nav-menu > li > a.dd-path {' ."\n" .
					'color: #' . $hex . ';' . "\n" . 
				'}' . "\n";
	}
	
	
	$temp = btp_theme_get_option_value( 'header_cs_1_background' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();
		
		list($from, $to) = BTP_Colorgen::get_warm_gradient( $color );	
		$from_hex = $from->get_hex();
		$to_hex = $to->get_hex();	
		$from_rgb = $from->get_rgb();
		$from_rgb = array_map( 'round', $from_rgb );
		$to_rgb = $to->get_rgb();
		$to_rgb = array_map( 'round', $to_rgb );
		
		
		$css .= '#header > .background,' . "\n" .
				'#primary-nav-menu > li.current-menu-item > a,' . "\n" .
				'#primary-nav-menu > li.current-menu-ancestor > a,' . "\n" .
				'#primary-nav-menu > li.current_page_parent > a {'. "\n" .
					'background: #' . $to_hex . '; ' ."\n" .
				'}' . "\n";
		
		$css .= '#primary-bar > .background > div.flare > div:first-child {' . "\n" .
					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, startColorstr=#ff' . $from_hex . ', endColorstr=#00' . $from_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=#ff' . $from_hex . ', endColorstr=#00' . $from_hex. ')";' . "\n" .
				'}' . "\n";
				
		$css .= '#primary-bar > .background > div.flare {' . "\n" .
					'background-image:-webkit-gradient(linear,0% 0%,0% 100%,from(rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1)),to(rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0)));' . "\n" .
	    			'background-image:-webkit-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:   -moz-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:    -ms-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:     -o-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:        linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .

					'background-image:-webkit-radial-gradient(top center,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
    				'background-image:   -moz-radial-gradient(top center,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
					'background-image:    -ms-radial-gradient(top center,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
					'background-image:     -o-radial-gradient(top center,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
					'background-image:        radial-gradient(top center,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
				'}' . "\n";

		
		
	}
	$temp = btp_theme_get_option_value( 'header_cs_2_background' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();		

		$border = BTP_Colorgen::get_tone_color( $color );		
		$border_hex = $border->get_hex();
		
		$css .= '#secondary-bar #searchform {' . "\n" .
					'background: #' . $hex . '; ' ."\n" .
				'}' . "\n";
		$css .= '#secondary-bar #searchform #s {' . "\n" .
					'border-color: #' . $border_hex . '; ' ."\n" .
				'}' . "\n";		
		$css .= '#secondary-bar #searchform:after {' . "\n" .
					'border-color: #' . $hex . ';' . "\n" .
				'}' . "\n";
	}
	
	$css .= btp_theme_capture_area_styles( 'header' );

		
	/* ----- PRECONTENT --------------------------------------------------------------------------------- */
	$temp = btp_theme_get_option_value( 'precontent_cs_1_background' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();
		
		list($from, $to) = BTP_Colorgen::get_warm_gradient( $color );
		$from_hex = $from->get_hex();
		$to_hex = $to->get_hex();
		$from_rgb = $from->get_rgb();
		$from_rgb = array_map( 'round', $from_rgb );
		$to_rgb = $to->get_rgb();
		$to_rgb = array_map( 'round', $to_rgb );
		
		$css .= '#precontent > .background {' . "\n" . 
					'background-color: #' . $to_hex . '; ' ."\n" .
				'}' . "\n";		
		
		$css .= '#precontent > .background > div.flare > div:first-child {' . "\n" .
					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1, startColorstr=#00' . $from_hex . ', endColorstr=#ff' . $from_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=1, startColorstr=#00' . $from_hex . ', endColorstr=#ff' . $from_hex. ')";' . "\n" .
				'}' . "\n";
		$css .= '#precontent > .background > div.flare > div + div {' . "\n" .
					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1, startColorstr=#ff' . $from_hex . ', endColorstr=#00' . $from_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=1, startColorstr=#ff' . $from_hex . ', endColorstr=#00' . $from_hex. ')";' . "\n" .
				'}' . "\n";
				
		$css .= '#precontent > .background > div.flare {' . "\n" .
					'background-image:-webkit-gradient(linear,0% 0%,100% 0%, from(rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ', 0)),color-stop(50%,rgba( ' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ', 1)),to(rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0)));' .
	    			'background-image:-webkit-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:   -moz-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:    -ms-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:     -o-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:        linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .

					'background-image:-webkit-radial-gradient(top center,ellipse farthest-side,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
    				'background-image:   -moz-radial-gradient(top center,ellipse farthest-side,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
					'background-image:    -ms-radial-gradient(top center,ellipse farthest-side,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
					'background-image:     -o-radial-gradient(top center,ellipse farthest-side,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
					'background-image:        radial-gradient(top center,ellipse farthest-side,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
		
				'}' . "\n";
	}
	$css .= btp_theme_capture_area_styles( 'precontent' );
		
	
	
	/* ----- CONTENT --------------------------------------------------------------------------------- */
	$temp = btp_theme_get_option_value( 'content_cs_1_background' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();
		
		$border = BTP_Colorgen::get_tone_color( $color );
		
		$border_hex = $border->get_hex();
		
		$css .= '#content > .background {' . "\n" . 
					'background: #' . $hex . '; ' . "\n" . 
				'}' . "\n";
		
		$path = get_template_directory_uri();
		$path .= '/images';
		
		if ( $color->get_lightness() > 50 ) {
			
			$css .= '#content .sidebar.after > .helper {' . "\n" .
						'background-image: url(' . $path . '/sidebar_right_helper.png);' . 
					'}' . "\n";
			
			$css .=	'#content .sidebar.after > .inner { background-image: url(' . $path . '/sidebar_right_inner.png); }'. "\n";
			
			
			$css .=	'#content .sidebar.before > .helper {' . "\n" .
						'background-image: url(' . $path . '/sidebar_left_helper.png);' . 
					'}' . "\n";
			$css .=	'#content .sidebar.before > .inner { background-image: url(' . $path . '/sidebar_left_inner.png); }' . "\n";
		} else {
			$css .= '#content .sidebar.after > .helper { background-image: url(' . $path . '/sidebar_right_helper_lighter.png); }' . "\n";
			$css .=	'#content .sidebar.after > .inner { background-image: url(' . $path . '/sidebar_right_inner_lighter.png); }'. "\n";
			$css .=	'#content .sidebar.before > .helper { background-image: url(' . $path . '/sidebar_left_helper_lighter.png); }' . "\n";
			$css .=	'#content .sidebar.before > .inner { background-image: url(' . $path . '/sidebar_left_inner_lighter.png); }' . "\n";
		}
	}
	$css .= btp_theme_capture_area_styles( 'content' );		
	
	
	
	/* ----- PREFOOTER --------------------------------------------------------------------------------- */
	$temp = btp_theme_get_option_value( 'prefooter_cs_1_background' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();
		
		list($from, $to) = BTP_Colorgen::get_warm_gradient( $color );
		$from_hex = $from->get_hex();
		$to_hex = $to->get_hex();		
		$from_rgb = $from->get_rgb();
		$from_rgb = array_map( 'round', $from_rgb );
		$to_rgb = $to->get_rgb();
		$to_rgb = array_map( 'round', $to_rgb );
		
		
		$border = BTP_Colorgen::get_tone_color( $color );
		
		$border_hex = $border->get_hex();
		
		$css .= '#prefooter > .background {' . "\n" . 
					'background-color: #' . $hex . '; ' ."\n" .
				'}' . "\n";		
		
		$css .= '#prefooter > .background > div.flare > div:first-child {' . "\n" .
					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1, startColorstr=#00' . $from_hex . ', endColorstr=#ff' . $from_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=1, startColorstr=#00' . $from_hex . ', endColorstr=#ff' . $from_hex. ')";' . "\n" .
				'}' . "\n";
		$css .= '#prefooter > .background > div.flare > div + div {' . "\n" .
					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1, startColorstr=#ff' . $from_hex . ', endColorstr=#00' . $from_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=1, startColorstr=#ff' . $from_hex . ', endColorstr=#00' . $from_hex. ')";' . "\n" .
				'}' . "\n";
		
		$css .= '#prefooter > .background > div.flare {' . "\n" .
					'background-image:-webkit-gradient(linear,0% 0%,100% 0%,from(rgba('. $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0)),color-stop(50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1)),to(rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0)));' .
	    			'background-image:-webkit-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:   -moz-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:    -ms-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:     -o-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:        linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .

					'background-image:-webkit-radial-gradient(top center,ellipse farthest-side,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
    				'background-image:   -moz-radial-gradient(top center,ellipse farthest-side,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
					'background-image:    -ms-radial-gradient(top center,ellipse farthest-side,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
					'background-image:     -o-radial-gradient(top center,ellipse farthest-side,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
					'background-image:        radial-gradient(top center,ellipse farthest-side,rgba(' . $from_rgb[0] .',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1),rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0));' . "\n" .
				'}' . "\n";
	}
	$css .= btp_theme_capture_area_styles( 'prefooter' );		
	
	
	
	/* ----- FOOTER --------------------------------------------------------------------------------- */
	$temp = btp_theme_get_option_value( 'footer_cs_1_background' );	
	if ( !empty( $temp ) ) {
		$color = new BTP_Color( $temp );
		$hex = $color->get_hex();
		
		list($from, $to) = BTP_Colorgen::get_warm_gradient( $color );
		$from_hex = $from->get_hex();
		$to_hex = $to->get_hex();		
		$from_rgb = $from->get_rgb();
		$from_rgb = array_map( 'round', $from_rgb );
		$to_rgb = $to->get_rgb();
		$to_rgb = array_map( 'round', $to_rgb );
		
		$css .= '#footer > .background {' . "\n" . 
					'background-color: #' . $to_hex . '; ' ."\n" .
				'}' . "\n";		
		
		$css .= '#footer > .background > div.flare > div:first-child {' . "\n" .
					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1, startColorstr=#00' . $from_hex . ', endColorstr=#ff' . $from_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=1, startColorstr=#00' . $from_hex . ', endColorstr=#ff' . $from_hex. ')";' . "\n" .
				'}' . "\n";
		$css .= '#footer > .background > div.flare > div + div {' . "\n" .
					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1, startColorstr=#ff' . $from_hex . ', endColorstr=#00' . $from_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=1, startColorstr=#ff' . $from_hex . ', endColorstr=#00' . $from_hex. ')";' . "\n" .
				'}' . "\n";
		
		$css .= '#footer > .background > div.flare {' . "\n" .
					'background-image:-webkit-gradient(linear,0% 0%,100% 0%,from(rgba('. $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0)),color-stop(50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1)),to(rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0)));' .
	    			'background-image:-webkit-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:   -moz-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:    -ms-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:     -o-linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
					'background-image:        linear-gradient(left,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 0%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',1) 50%,rgba(' . $from_rgb[0] . ',' . $from_rgb[1] . ',' . $from_rgb[2] . ',0) 100%);' . "\n" .
				'}' . "\n";
		
		
		$border = BTP_Colorgen::get_tone_color( $color );		
		$border_hex = $border->get_hex();
		
		$css .= '#footer > .background > .pattern {' . "\n" .
					'border-color: #' . $border_hex . ';' . "\n" .
					'border-color: rgba(255,255,255,0.1);' . "\n" .
				'}' . "\n";
		
		
	}
	$css .= btp_theme_capture_area_styles( 'footer' );
	
	return $css;
}
function btp_render_custom_styles( $css ){
	$css .= btp_capture_custom_styles();
	return $css;
}
add_action( 'btp_theme_custom_styles', 'btp_render_custom_styles' );	


	




if ( ! function_exists( 'btp_site_id_capture' ) ) :
/**
 * Captures HTML with site identification.
 * 
 * @return			string
 */
function btp_site_id_capture() {
	$out = '';
	
	/* Get all required data */
	$name = get_bloginfo( 'name' );
	$description = get_bloginfo( 'description' ); 
	$src = btp_theme_get_option_value('general_logo_src');

	$out .= '<div id="id">';	
		if ( is_front_page() ) {		
			$out .= '<h1 class="site-title">';
				$out .= '<a href="' . home_url() . '">';
					if ( strlen( $src) ) {
                        $alt = !empty( $name ) ? esc_attr( $name ) : esc_url( $src );

                        $out .= '<img src="' . esc_url( $src ) . '" alt="' . $alt . '" />';
					} else {
						$out .= esc_html( $name );
					}
				$out .= '</a>';
			$out .= '</h1>';
		} else {
			$out .= '<p class="site-title">';
				$out .= '<a href="' . home_url() . '" title="' . __( 'Go back to the homepage', 'btp_theme' ) . '">';
					if ( strlen( $src) ) {
                        $alt = !empty( $name ) ? esc_attr( $name ) : esc_url( $src );

						$out .= '<img src="' . esc_url( $src ) . '" alt="' . $alt . '" />';
					} else {
						$out .= esc_html( $name );
					}
				$out .= '</a>';
			$out .= '</p>';
		}				
		
		/* Capture tagline */
		if ( 'none' !== btp_theme_get_option_value( 'style_header_tagline' ) && strlen( $description ) ) {
			if ( is_front_page() ) {
				$out .= '<p class="site-tagline"><strong>' . esc_html( $description ) . '</strong></p>';
			} else {
				$out .= '<p class="site-tagline">' . esc_html( $description ) . '</p>';
			}	
		}
	$out .= '</div><!-- #id -->';
	
	return $out;
}
endif;	
if ( ! function_exists( 'btp_site_id_render' ) ) :
function btp_site_id_render() {
	echo btp_site_id_capture();
}
endif;



function btp_filter_wp_link_pages_args($args) {
	$args = array_merge( 
		$args,
		array(
			'before'			=> '<nav class="pagination pagelinks"><p><strong>' . __( 'Pages:', 'btp_theme' ) . '</strong>',
			'after'				=> '</p></nav>',
			'current_before'	=> '<strong class="current">',
			'current_after' 	=> '</strong>',	
			'link_before'		=> '<span>',
			'link_after'		=> '</span>',
			'next_or_number' 	=> 'next_and_number',
			'nextpagelink' 		=> __( 'Next', 'btp_theme' ),
	    	'previouspagelink' 	=> __('Prev', 'btp_theme' ),
		) 
	);
	
	/* Based on: http://www.velvetblues.com/web-development-blog/wordpress-number-next-previous-links-wp_link_pages/ */
	if ( 'next_and_number' === $args[ 'next_or_number' ] ) {
        global $page, $numpages, $multipage, $more, $pagenow;
        $args[ 'next_or_number'] = 'number';
        $prev = '';
        $next = '';
        if ( $multipage ) {
            if ( $more ) {
                $i = $page - 1;
                if ( $i && $more ) {
                    $prev .= _wp_link_page($i);
                    $prev .= $args[ 'link_before' ] . $args[ 'previouspagelink' ] . $args[ 'link_after' ] . '</a>';
                    $prev = str_replace('<a ', '<a class="prev" ', $prev);
                    
                }
                $i = $page + 1;
                if ( $i <= $numpages && $more ) {
                    $next .= _wp_link_page($i);
                    $next .= $args[ 'link_before' ] . $args[ 'nextpagelink' ] . $args[ 'link_after' ] . '</a>';
                    $next = str_replace('<a ', '<a class="next" ', $next);
                }
            }
        }
        $args[ 'before' ] = $args[ 'before' ] . $prev;
        $args[ 'after' ] = $next . $args[ 'after' ];    
    }
    
    return $args;
}
add_filter( 'wp_link_pages_args', 'btp_filter_wp_link_pages_args' );



function btp_preheader_get_class(){ return ''; }
function btp_header_get_class(){ return ''; }
function btp_precontent_get_class(){ return ''; }
function btp_content_get_class(){ return ''; }
function btp_prefooter_get_class(){ return ''; }



/**
 * Gets the class attribute of the footer theme area
 * 
 * If you want to add/delete some classes, hook into the btp_footer_class custom filter.
 * 
 * @return			string
 */
function btp_footer_get_class(){
	$classes = array();
	
	/* Layout */
	$temp = btp_theme_get_option_value( 'style_footer_layout' );
	if ( strlen( $temp ) ) {
		$classes[] = 'layout-' . sanitize_html_class( $temp );
	}
	
	/* Custom filter */
	$classes = apply_filters( 'btp_footer_class', $classes); 
	
	return join(' ', $classes);
}



/**
 * Enqueues javascripts required for the Isotope Plugin
 * 
 * @since			1.1.0
 */
function btp_isotope_wp_footer() {	
	wp_enqueue_script( 'jquery.isotope' );	 
	wp_print_scripts( 'jquery.isotope' );	
}



/**
 * Proceed theme options with 'type' => 'CSS'
 *  
 * @since			1.1.0  
 */
function btp_theme_capture_css_options( $css ) {
	global $_BTP;
	
	$out = '';	
	
	if ( $_BTP[ 'theme_option_holder' ]->has_group( 'style' ) ) {		
		foreach( $_BTP[ 'theme_option_holder' ]->hierarchy['style']['subgroups'] as $subgroup_id => &$subgroup ) {
			foreach( $subgroup[ 'items' ] as $item_id => $item ) {							
				$option = $_BTP[ 'theme_option_holder' ]->get_item( $item_id );	
							
				if ( isset( $option['type'] ) && 'CSS' === $option['type'] ) {
					$value = btp_theme_get_option_value( $item_id );
					
					if ( strlen( $value ) ) {
						$out .= sprintf( $option['css'], $value ) . "\n";
					}
	        	}	
			}		
		}
		unset( $subgroup );	
	}	
	
	$css .= $out;
	
	return $css;
}
add_action( 'btp_theme_custom_styles', 'btp_theme_capture_css_options' );
?>
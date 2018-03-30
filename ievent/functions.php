<?php
	/**
	 * ievent functions and definitions
	 *
	 * @package ievent
	 */
	 	 
	/* ======================================================================== */
	/* Includes																	*/
	/* ======================================================================== */		
		
		/* ------------------------------------------------------ */
		/* Include php files								      */
		/* -------------------------------------------------------*/
		require get_template_directory() . '/inc/enqueue.php'; // Includse JS and CSS 
		require get_template_directory() . '/inc/multi-post-image/multiple-featured-images.php'; // Include Multi Featuered Image 		
		require get_template_directory() . '/inc/breadcrumb.php'; //Breadcrumbs
		require get_template_directory() . '/inc/class-tgm-plugin-activation.php'; //Plugins activator
		require get_template_directory() . '/inc/mobile-detect.php'; //Mobile Detect
		require get_template_directory() . '/inc/custom_js.php'; // Load Custom JS
		require get_template_directory() . '/inc/custom_css.php'; // Load Custom CSS
		require get_template_directory() . '/inc/mailchimp.php'; // Load Custom CSS
		require get_template_directory() . '/inc/menu-walker/walker_menu.php'; // Login & registeration

	
		/*------- Implement the Custom Header feature--------*/
		require get_template_directory() . '/inc/custom-header.php';
		
		/*------- Custom template tags for this theme-------*/
		require get_template_directory() . '/inc/template-tags.php';
		
		/*------- Custom functions that act independently of the theme templates -------*/
		require get_template_directory() . '/inc/extras.php';
		
		/*-------- Customizer additions --------------------*/
		require get_template_directory() . '/inc/customizer.php';
		
		/*-------- Load Jetpack compatibility file ----------*/
		require get_template_directory() . '/inc/jetpack.php';
		
		/*-------- Woocommerce ----------*/
		require get_template_directory() . '/woocommerce/woocommerce.php';	
				
		
		/* ------------------------------------------------------ */
		/* Include Meta Box Script 								  */
		/* -------------------------------------------------------*/
		define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/inc/meta-box' ) );
		define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/inc/meta-box' ) );
	
		require_once get_template_directory() . '/inc/meta-box/meta-box.php';
		require get_template_directory() .'/inc/meta-boxes.php'; // SMOF		
		
		/* ------------------------------------------------------ */
		/* Include Slightly Modified Options Framework (SMOF)     */
		/* -------------------------------------------------------*/
		require get_template_directory() .'/admin/index.php'; // SMOF		
		
		global $ievent_data; 
		
		/* Global Variables*/
		if (!function_exists('ievent_globals')) {
		function ievent_globals() {			
			global $ievent_data;				
			return $ievent_data;		
		}
		}
		
		
		
		/* ------------------------------------------------------ */
		/* Theme Updates 								  */
		/* -------------------------------------------------------*/
		
		if ((isset($ievent_data['envato_username'])) & (isset($ievent_data['envato_apikey']))): 
			$username = esc_attr($ievent_data['envato_username']);
			$apikey = esc_attr($ievent_data['envato_apikey']);
			
			require get_template_directory(). '/inc/updates/envato-wp-theme-updater.php';
			Envato_WP_Theme_Updater::init( $username, $apikey, 'janxcode' );
			
		endif;
	
		
	/* ======================================================================== */
	/* TGM Plugin Activation							   		      	        */
	/* ======================================================================== */		
	
	add_action( 'tgmpa_register', 'jx_ievent_register_required_plugins' );
	
	function jx_ievent_register_required_plugins() {
			/**
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$plugins = array(
		
				array(
					'name' 					=> esc_html__( 'iEvent Framework', 'ievent' ),
					'slug' 					=> 'ievent-framework',
					'source'				=> get_template_directory() . '/plugins/ievent-framework.zip',
					'required' 				=> true,
					'version'				=> '1.0.7',
					'force_activation' 		=> false,
					'force_deactivation'	=> false,
					'external_url' 			=> '',
				),
				array(
					'name' 					=> esc_html__( 'Revolution Slider', 'ievent' ),
					'slug' 					=> 'revslider',
					'source'				=> get_template_directory() . '/plugins/revslider.zip',
					'required' 				=> true,
					'version'				=> '5.2.6',
					'force_activation' 		=> false,
					'force_deactivation'	=> false,
					'external_url' 			=> '',
				),
				array(
					'name' 					=> esc_html__( 'Visual Composer', 'ievent' ),
					'slug' 					=> 'js-composer',
					'source'				=> get_template_directory() . '/plugins/js_composer.zip',
					'required' 				=> true,
					'version'				=> '4.12',
					'force_activation' 		=> false,
					'force_deactivation'	=> false,
					'external_url' 			=> '',
				),				
				array(
					'name' 					=> esc_html__( 'Templatera', 'ievent' ),
					'slug' 					=> 'templatera',
					'source'				=> get_template_directory() . '/plugins/templatera.zip',
					'required' 				=> true,
					'version'				=> '1.1.7',
					'force_activation' 		=> false,
					'force_deactivation'	=> false,
					'external_url' 			=> '',
				),
				array(
					'name' 					=> esc_html__( 'Contact Form 7', 'ievent' ),
					'slug' 					=> 'contact-form-7',
					'source'				=> get_template_directory() . '/plugins/contact-form.zip',
					'required' 				=> true,
					'version'				=> '4.5',
					'force_activation' 		=> false,
					'force_deactivation'	=> false,
					'external_url' 			=> '',
				),
				array(
					'name' 					=> esc_html__( 'Intuitive Custom Post Order', 'ievent' ),
					'slug' 					=> 'intuitive-custom-post-order',
					'source'				=> get_template_directory() . '/plugins/custom-post-order.zip',
					'required' 				=> true,
					'version'				=> '3.0.7',
					'force_activation' 		=> false,
					'force_deactivation'	=> false,
					'external_url' 			=> '',
				),
				
				array(
					'name'               	=> esc_html__('WooCommerce','ievent'),
					'slug'               	=> 'woocommerce', 
					'source'             	=> 'https://downloads.wordpress.org/plugin/woocommerce.2.5.5.zip', 
					'required'           	=> false, 
					'version'            	=> '2.5.2',
					'force_activation'   	=> false, 
					'force_deactivation' 	=> false, 
					'external_url'       	=> '', 
				),	
				
										
			);
		
		
			/**
			 * Array of configuration settings. Amend each line as needed.
			 * If you want the default strings to be available under your own theme domain,
			 * leave the strings uncommented.
			 * Some of the strings are added into a sprintf, so see the comments at the
			 * end of each line for what each argument will be.
			 */
			$config = array(
				'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
				'default_path' => '',                      // Default absolute path to bundled plugins.
				'menu'         => 'tgmpa-install-plugins', // Menu slug.
				'parent_slug'  => 'themes.php',            // Parent menu slug.
				'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
				'has_notices'  => true,                    // Show admin notices or not.
				'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => false,                   // Automatically activate plugins after installation or not.
				'message'      => '',                      // Message to output right before the plugins table.
				'strings'      		=> array(
					'page_title'                       			=> esc_html__( 'Install Required Plugins', 'ievent' ),
					'menu_title'                       			=> esc_html__( 'Install Plugins', 'ievent' ),
					'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'ievent' ), // %1$s = plugin name
					'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'ievent' ),
					'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'ievent'  ), // %1$s = plugin name(s)
					'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'ievent'), // %1$s = plugin name(s)
					'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'ievent'), // %1$s = plugin name(s)
					'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'ievent'), // %1$s = plugin name(s)
					'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'ievent'), // %1$s = plugin name(s)
					'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'ievent'), // %1$s = plugin name(s)
					'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'ievent'), // %1$s = plugin name(s)
					'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'ievent'), // %1$s = plugin name(s)
					'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'ievent'),
					'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'ievent'),
					'return'                           			=> esc_html__( 'Return to Required Plugins Installer','ievent'),
					'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'ievent'),
					'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'ievent'), // %1$s = dashboard link
					'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
				)
			);
		
			tgmpa( $plugins, $config );
		
		}
	
	
	/* ======================================================================== */
	/* Define Multiple Featuered Images			      	    					*/
	/* ======================================================================== */
		if (class_exists('kdMultipleFeaturedImages')) {
		
		$i = 2;
		$ievent_data['posts_slideshow_number'] = 3;
		
			while($i <= $ievent_data['posts_slideshow_number']) {
	        $args = array(
	                'post_type' => 'page',  
					'id' => 'featured-image-'.$i,    
	                'labels' => array(
	                    'name'      => esc_html__('Featured image ','ievent').$i,
	                    'set'       => 'Set featured image '.$i,
	                    'remove'    => 'Remove featured image '.$i,
	                    'use'       => 'Use as featured image '.$i,
	                )
	        );
	        new kdMultipleFeaturedImages($args);
	        $args = array(
	                'post_type' => 'post',
					'id' => 'featured-image-'.$i,      
	                'labels' => array(
	                    'name'      => esc_html__('Featured image ','ievent').$i,
	                    'set'       => 'Set featured image '.$i,
	                    'remove'    => 'Remove featured image '.$i,
	                    'use'       => 'Use as featured image '.$i,
	                )
	        );
	        new kdMultipleFeaturedImages($args);
	        $args = array(
	                'post_type' => 'portfolio',
					'id' => 'featured-image-'.$i,      
	                'labels' => array(
	                    'name'      => esc_html__('Featured image ','ievent').$i,
	                    'set'       => 'Set featured image '.$i,
	                    'remove'    => 'Remove featured image '.$i,
	                    'use'       => 'Use as featured image '.$i,
	                )
	        );
	        new kdMultipleFeaturedImages($args);
	        $i++;
    	}
		
					 
		};
		
		
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}
	if ( ! function_exists( 'jx_ievent_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */ 
	 
	function jx_ievent_setup() {	
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on expo-test, use a find and replace
	 * to change 'expo-test' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ievent', get_template_directory() . '/languages' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );	
	
	
	// Declare WooCommerce support
	add_theme_support( 'woocommerce' );	
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	
	
	/*----------- Add post thumbnail functionality-----------------*/
	if ( function_exists( 'add_image_size' ) ){add_theme_support( 'post-thumbnails' );}
	
	if ( function_exists( 'add_image_size' ) ) { 
		
		/*--------*/
		add_image_size( 'blog', 890, 439, true ); // Blog Image
		add_image_size( 'small-blog', 380, 223, true ); // Small Blog Image
		add_image_size( 'speaker-image', 234, 189, true ); // Small Blog Image
		add_image_size( 'speaker-image-lg', 384, 310, true ); // Small Blog Image
		add_image_size( 'speaker-bigimage', 446, 361, true ); // Small Blog Image
		add_image_size( 'testimonial', 176, 178, true ); // Testimonial
		add_image_size( 'port-1', 400, 400, true ); // Portfolio Big
		add_image_size( 'port-2', 200, 200, true ); // Portfolio Small
		
		
	}
	
	/*------------------ Register Navigation --------------------*/
	register_nav_menu('primary_navigation', 'Primary Navigation');
	register_nav_menu('onepage_navigation', 'OnePage Navigation');
	
	
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	add_theme_support( 'custom-background', apply_filters( 'jx_ievent_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
	
	}
	
	endif; // jx_ievent_setup
	
	add_action( 'after_setup_theme', 'jx_ievent_setup' );
	 
	 
		 
	 
	 function jx_ievent_comment( $comment, $args, $depth ) {
	   $GLOBALS['comment'] = $comment; ?>
	
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	   <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix"> 
	   		
	   		<div class="avatar"><?php echo get_avatar($comment, $size = '50'); ?></div>
	         
	         <div class="comment-text">
	         
				 <div class="author">
				 	
				 	<div class="date">
                    <span><?php printf( esc_html__( '%s', 'ievent'), get_comment_author_link() ) ?></span>
				 	<?php printf(esc_html__('%1$s at %2$s', 'ievent'), get_comment_date(),  get_comment_time() ) ?></a><?php edit_comment_link( esc_html__( '(Edit)', 'ievent'),'  ','' ) ?>
				   	&middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>  </div>  
				 </div>
				 
				 <div class="text"><?php comment_text() ?></div>
				 
				 
				 <?php if ( $comment->comment_approved == '0' ) : ?>
		         <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'ievent' ) ?></em>
		         <br />
		      	<?php endif; ?>
		      	
	      	</div>
	      
	   </div>
	<?php
	}
	
					
	/* ======================================================================== */
	/* Excerpt character limit									           	    */
	/* ======================================================================== */
	
		function excerpt($limit) {
			$excerpt = explode(' ', get_the_excerpt(), $limit);
			if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
			} else {
			$excerpt = implode(" ",$excerpt);
			}	
			$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
			return $excerpt;
			}
			 
			function content($limit) {
			$content = explode(' ', get_the_content(), $limit);
			if (count($content)>=$limit) {
			array_pop($content);
			$content = implode(" ",$content).'...';
			} else {
			$content = implode(" ",$content);
			}	
			$content = preg_replace('/\[.+\]/','', $content);
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			return $content.'<readmore class="cl-effect-1">
					<a href="'.esc_url(the_permalink()) .'" rel="bookmark" title="Permanent Link to '.the_title().'">'. esc_html_e('Read More', 'ievent').'</a>
					</readmore>';
		}
			
	
	/* ======================================================================== */
	/* Regsiter Widgets										           	        */
	/* ======================================================================== */	
	

	///////////////////////Footer Widgets ////////////////////////////
	function jx_ievent_register_sidebars() {		
	
			///////////////////////Sidebar Widgets ////////////////////////////
			register_sidebar( 
			array(
				'name'          =>  esc_html__('General Widget', 'ievent' ),
				'id'            => 'general-sidebar',
				'before_widget' => '<div class="jx-ievent-sidebar-widget"><div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<div class="sub"><header><h4>',
				'after_title'   => '</h4><div class="jx-ievent-right-pattern"></div></header></div>',
			)
			);
			
			register_sidebar( 
			array(
				'name'          =>  esc_html__('Shop Widget', 'ievent' ),
				'id'            => 'ievent-sidebar-shop',
				'before_widget' => '<div class="jx-ievent-sidebar-widget"><div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<div class="sub"><header><h4>',
				'after_title'   => '</h4><div class="jx-ievent-right-pattern"></div></header></div>',
			)
			);
			//////////////////////Footer Widgets////////////////////////////////
			register_sidebar( 
			array(
				'name'          =>  esc_html__('Footer Widget 01', 'ievent' ),
				'id'            => 'ievent-footer-1',
				'before_widget' => '<div class="jx-ievent-footersection-widget"><div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<div class="sub"><header><h4>',
				'after_title'   => '</h4><div class="jx-ievent-right-pattern"></div></header></div>',
			)
			);
			register_sidebar( 
			array(
				'name'          =>  esc_html__('Footer Widget 02', 'ievent' ),
				'id'            => 'ievent-footer-2',
				'before_widget' => '<div class="jx-ievent-footersection-widget"><div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<div class="sub"><header><h4>',
				'after_title'   => '</h4><div class="jx-ievent-right-pattern"></div></header></div>',
			)
			);
			register_sidebar( 
			array(
				'name'          =>  esc_html__('Footer Widget 03', 'ievent' ),
				'id'            => 'ievent-footer-3',
				'before_widget' => '<div class="jx-ievent-footersection-widget"><div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<div class="sub"><header><h4>',
				'after_title'   => '</h4><div class="jx-ievent-right-pattern"></div></header></div>',
			)
			);
			register_sidebar( 
			array(
				'name'          =>  esc_html__('Footer Widget 04', 'ievent' ),
				'id'            => 'ievent-footer-4',
				'before_widget' => '<div class="jx-ievent-footersection-widget"><div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<div class="sub"><header><h4>',
				'after_title'   => '</h4><div class="jx-ievent-right-pattern"></div></header></div>',
			)
			);			
	}

	add_action( 'widgets_init', 'jx_ievent_register_sidebars' );
	
	
	/* ====================================================== */
	/* Pagination 											  */
	/* ====================================================== */
	function pagination($pages = '', $range = 4) {
		$showitems = ($range * 2)+1;
		
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == '') {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages) {
				$pages = 1;
			}
		}
		
		if(1 != $pages) {
			
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; " . esc_html__('First', 'ievent') . "</a>";
			if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; " . esc_html__('Previous', 'ievent') . "</a>";
			
			echo "<ul>";
			
			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					echo ($paged == $i)? "<li class='current'><a href='".get_pagenum_link($i)."' >".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
				}
			}
			
			echo "</ul>";
		
			
		}
	}	
	
	
	//Retina Support
	add_filter( 'wp_generate_attachment_metadata', 'retina_support_attachment_meta', 10, 2 );
	/**
	 * Retina images
	 *
	 * This function is attached to the 'wp_generate_attachment_metadata' filter hook.
	 */
	function retina_support_attachment_meta( $metadata, $attachment_id ) {
		foreach ( $metadata as $key => $value ) {
			if ( is_array( $value ) ) {
				foreach ( $value as $image => $attr ) {
					if ( is_array( $attr ) )
					retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true);
				}
			}
		}
	 
		return $metadata;
	}
	
	/**
	 * Create retina-ready images
	 *
	 * Referenced via retina_support_attachment_meta().
	 */
	function retina_support_create_images( $file, $width, $height, $crop = false ) {
		if ( $width || $height ) {
			$resized_file = wp_get_image_editor( $file );
			if ( ! is_wp_error( $resized_file ) ) {
				$filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
	 
				$resized_file->resize( $width * 2, $height * 2, $crop );
				$resized_file->save( $filename );
	 
				$info = $resized_file->get_size();
	 
				return array(
					'file' => wp_basename( $filename ),
					'width' => $info['width'],
					'height' => $info['height'],
				);
			}
		}
		return false;
	}
	
	add_filter( 'delete_attachment', 'delete_retina_support_images' );
		/**
		 * Delete retina-ready images
		 *
		 * This function is attached to the 'delete_attachment' filter hook.
		 */
	function delete_retina_support_images( $attachment_id ) {
		$meta = wp_get_attachment_metadata( $attachment_id );
		if ( $meta ) {
		$upload_dir = wp_upload_dir();
		$path = pathinfo( $meta['file'] );
		foreach ( $meta as $key => $value ) {
			if ( 'sizes' === $key ) {
				foreach ( $value as $sizes => $size ) {
					$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
					$retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
					if ( file_exists( $retina_filename ) )
						unlink( $retina_filename );
					}
				}
			}
		}
	}
	
	/*====================HEX to RGBA =====================*/
	function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
		   if(strlen($hex) == 3) {
			  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
			  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
			  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
		   } else {
			  $r = hexdec(substr($hex,0,2));
			  $g = hexdec(substr($hex,2,2));
			  $b = hexdec(substr($hex,4,2));
		   }
		   $rgb = array($r, $g, $b);
		   //return implode(",", $rgb); // returns the rgb values separated by commas
		   return $rgb; // returns an array with the rgb values
	}
	
	
	//=========================================================================*//
	//						Ajax Contact Form 	
	//=========================================================================//
	function addme_ajaxurl() {
		?>
		<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		</script>
		<?php
		}
		add_action('wp_head','addme_ajaxurl');
		
		add_action('wp_ajax_submit_form', 'submit_form_callback');
		add_action('wp_ajax_nopriv_submit_form', 'submit_form_callback');
		
		function submit_form_callback(){
			
			$error='';
			$params = array();
			parse_str($_POST['data'], $params);
		
			$subject = 'New Registeration'; 
		
			$name = trim($params['tab_reg_name']);
			$email = $params['tab_reg_email'];
			$phone = $params['tab_reg_phone'];
			if(isset($params['tab_reg_ticket_type'])):
			$ticket = $params['tab_reg_ticket_type'];
			endif;
			
			if(isset($params['tab_reg_ticket_valid'])):
			$ticket_valid = $params['tab_reg_ticket_valid'];
			endif;
			
			
			$site_owners_email = get_option( 'admin_email' ); // Replace this with your own email address
		
			$body    = __('Name:', 'ievent')." $name \n\n"; 
			$body   .= __('Email:', 'ievent')." $email \n\n"; 
			$body   .= __('Phone:', 'ievent')." $phone \n\n"; 
			if(isset($ticket)):
			$body   .= __('Ticket Type:', 'ievent')."\n $ticket"; 
			endif;
			
			if(isset($ticket_valid)):
			$body   .= __('Ticket Valid:', 'ievent')."\n $ticket_valid"; 
			endif;
			
			$headers = 'Reply-To: ' . $name . ' <' . $email . '>' . "\r\n"; 
			
			if (!$error) {
			
				
				
				$mail = mail($site_owners_email, $subject, $body,$headers);
				$success['success'] = "<div class='success'>" . $name . ", We've received your email. We'll be in touch with you as soon as possible! </div>";
				
				echo json_encode($success);
				
			//Insert To POsts
				$post = array(
				'post_title'	=> $name,
				'post_status'	=> 'publish',
				'post_type'		=> 'participants'
				);
				
				$post_id = wp_insert_post($post);  // Pass  the value of $post to WordPress the insert function
										
				//wp_insert_post($post);
				
				// Do the wp_insert_post action to insert it
				do_action('wp_insert_post', 'wp_insert_post');
				
				add_post_meta($post_id, 'jx_ievent_reg_email', $email, true);
				add_post_meta($post_id, 'jx_ievent_reg_phone', $phone, true);
				if(isset($ticket)):
				add_post_meta($post_id, 'jx_ievent_reg_ticket', $ticket, true);
				endif;
				
				if(isset($ticket_valid)):
				add_post_meta($post_id, 'jx_ievent_reg_payment', $ticket_valid, true);
				endif;
				
				
				
			} # end if no error
			else {
		
				echo json_encode($error);
			} # end if there was an error sending
			
			die(); // this is required to return a proper result
		}
	
			
	
	//===========================================================================
	//======================Woocommerce
	//===========================================================================
	
	if ( class_exists( 'WooCommerce' ) ) {
	 	add_filter( 'loop_shop_columns', 'ievent_product_columns', 5);
		add_filter('body_class', 'ievent_body_class');
	}
	
	 
        function ievent_product_columns($columns) {
            if ( is_shop() || is_product_category() || is_product_tag() ) {
                
				global $ievent_data; 
								
				if(($ievent_data['woo_layout'] == 'no-sidebar') & ($ievent_data['woocoomerce_coulmns']=="3")):
				return 4;
				elseif (isset($ievent_data['woocoomerce_coulmns']) & $ievent_data['woocoomerce_coulmns']!='' ):
				return $ievent_data['woocoomerce_coulmns'];
				else:
				return 4;
				endif;
            }
        }
		
	
		function ievent_body_class($classes) {
			global $ievent_data;  
			
			if ( is_woocommerce()) {				
				if($ievent_data['woocoomerce_coulmns']=="3"):
					$classes[] = 'product-columns-3';				
				elseif ($ievent_data['woocoomerce_coulmns']=="4"):
					$classes[] = 'product-columns-4';
				endif;
				
				
				if( $ievent_data['woo_layout'] == 'no-sidebar' ):
					$classes[] = 'has-no-sidebar';
				elseif( $ievent_data['woo_layout'] == 'right-sidebar' ):
					$classes[] = 'has-right-sidebar';
				elseif( $ievent_data['woo_layout'] == 'left-sidebar' ):
					$classes[] = 'has-left-sidebar';
				endif;					
				
			}
			return $classes;
		}	

	
	
	//----------------------------------------------------------------------------
	//-----------Dynamic Generated css
	//----------------------------------------------------------------------------

	ob_start(); // Capture all output (output buffering)
	require get_template_directory() . '/inc/dynamic_skin.php'; // Generate CSS
	$css = ob_get_clean(); // Get generated CSS (output buffering)

	global $wp_filesystem;
		
	// Initialize the WP filesystem, no more using 'file-put-contents' function
	if (empty($wp_filesystem)) {
		require_once (ABSPATH . '/wp-admin/includes/file.php');
		WP_Filesystem();
	}
	
	if(!$wp_filesystem->put_contents( get_template_directory() . '/css/dynamic_ievent.css', $css, 0644)) {
		return esc_html__('Failed to create css file','ievent');
	}
	//EOF
	
	
	/* Remove Script Version*/
	function _remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
	}
	add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', '_remove_script_version', 15, 1 ); 
	
	/* Visual Composer */
	if(function_exists('vc_add_param')){
	
	  vc_add_param('vc_row',array(
			  "type" => "textfield",
			  "heading" => __('Section ID', 'TEXT_DOMAIN'),
			  "param_name" => "el_id",
			  "value" => "",
			  "description" => __("Set ID section", 'TEXT_DOMAIN'),   
		));  
		
		vc_add_param('vc_row',array(
			"type" => "dropdown",
			"heading" => __('Container', 'TEXT_DOMAIN'),
			"param_name" => "container",
			"value" => array(   
					__('Container', 'TEXT_DOMAIN') => 'container',  
					__('no Container', 'TEXT_DOMAIN') => 'no-container',
                                                                   
					),
			"description" => __("Select Container", 'TEXT_DOMAIN'),      
		  ) 
		); 
		
		vc_add_param('vc_row',array(
			"type" => "dropdown",
			"heading" => __('Padding', 'TEXT_DOMAIN'),
			"param_name" => "el_class",
			"value" => array(   
					__('Default Padding', 'TEXT_DOMAIN') => 'jx-ievent-padding',  
					__('Small Padding', 'TEXT_DOMAIN') => 'jx-ievent-padding-small',
					__('No Padding', 'TEXT_DOMAIN') => 'no-padding',
					__('Top Padding Only', 'TEXT_DOMAIN') => 'jx-ievent-padding no-bottom-padding',
					__('Bottom Padding Only', 'TEXT_DOMAIN') => 'jx-ievent-padding no-top-padding',                                                                                
					),
			"description" => __("Select Padding", 'TEXT_DOMAIN'),      
		  ) 
		); 
		
		
		vc_add_param('vc_row',array(
			"type" => "dropdown",
			"heading" => __('Overlayer', 'TEXT_DOMAIN'),
			"param_name" => "el_class_2",
			"value" => array(   
					__('No', 'TEXT_DOMAIN') => 'no',  
					__('Default', 'TEXT_DOMAIN') => 'jx-ievent-tint-default',
					__('Black', 'TEXT_DOMAIN') => 'jx-ievent-tint-black',                                                                                
					),
			"description" => __("Select Padding", 'TEXT_DOMAIN'),      
		  ) 
		); 
	
	}
		
	//EOF ---
?>
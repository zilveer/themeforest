<?php



/*-----------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ SETUP _-_-_-_-_-_-_-_-_-_-*/
/*-----------------------------------------------*/

	add_action( 'after_setup_theme', 'si_setup' );
	
	if ( ! function_exists( 'si_setup' ) ):
	 
	function si_setup() {
	
		add_theme_support('post-thumbnails');
		add_theme_support( 'automatic-feed-links' );
		
	}
	
	endif;



/*-----------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ TEXT DOMAIN _-_-_-_-_-_-_-_-_-_-*/
/*-----------------------------------------------------*/

	load_theme_textdomain('shorti');



/*--------------------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ LOAD FROM FUNCTIONS FOLDER _-_-_-_-_-_-_-_-_-_-*/
/*--------------------------------------------------------------------*/

	// Custom Functions
	include("functions/custom.php");
	// Posttypes
	include("functions/posttypes.php");
	// Shortcodes
	include("functions/shortcodes.php");
	// Theme Meta
	include("functions/meta-page.php");
	include("functions/meta-post.php");
	include("functions/meta-services.php");
	include("functions/meta-projects.php");
	// Widgets Areas
	include("functions/widgets.php");



/*-----------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ OPTIONS FRAMEWORK _-_-_-_-_-_-_-_-_-_-*/
/*-----------------------------------------------------------*/	

	if ( !function_exists( 'optionsframework_init' ) ) {
	
		if ( get_template_directory() == get_template_directory() ) {
			define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/admin/');
			define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
		} else {
			define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/admin/');
			define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/admin/');
		}
	
		require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
	
	}
	
	add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
	
	function optionsframework_custom_scripts() { ?>
	
	<script type="text/javascript">
	jQuery(document).ready(function() {
	
		jQuery('#example_showhidden').click(function() {
	  		jQuery('#section-example_text_hidden').fadeToggle(400);
		});
		
		if (jQuery('#example_showhidden:checked').val() !== undefined) {
			jQuery('#section-example_text_hidden').show();
		}
		
	});
	</script>
	
	<?php }



/*------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ POST FORMATS _-_-_-_-_-_-_-_-_-_-*/
/*------------------------------------------------------*/		

	add_theme_support( 'post-formats', array( 'image', 'video', 'quote' ) );



/*-----------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ LOAD JQUERY _-_-_-_-_-_-_-_-_-_-*/
/*-----------------------------------------------------*/	

	function si_enqueue_scripts() {
	
		if ( !is_admin() ) {
		
			wp_register_script('si_modernizr', get_template_directory_uri() . '/js/modernizr-transitions.js', 'jquery');
			wp_register_script('si_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', 'jquery');
			wp_register_script('si_infinite', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', 'jquery');
			wp_register_script('si_back', get_template_directory_uri() . '/js/jquery.backstretch.min.js', 'jquery');
			wp_register_script('si_pretty', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 'jquery');
			wp_register_script('si_maps', 'http://maps.google.com/maps/api/js?sensor=false', 'jquery', '1.5', TRUE);
			wp_register_script('si_settings', get_template_directory_uri() . '/js/settings.js', 'jquery', '1.5', TRUE);
			
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-effects-core');
			wp_enqueue_script('jquery-effects-fade');
			wp_enqueue_script('si_modernizr');
			wp_enqueue_script('si_isotope');
			wp_enqueue_script('si_infinite');
			wp_enqueue_script('si_back');
			wp_enqueue_script('si_pretty');
			wp_enqueue_script('si_maps');
			wp_enqueue_script('si_settings');
			
		}
	
	} 
	
	add_action('wp_enqueue_scripts', 'si_enqueue_scripts');



/*-----------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ LOAD STYLES _-_-_-_-_-_-_-_-_-_-*/
/*-----------------------------------------------------*/	

	function si_enqueue_styles() {
	
		wp_register_style('si_main_css', get_bloginfo( 'stylesheet_url' ));
		wp_register_style('si_pretty_css', get_template_directory_uri() . '/css/prettyPhoto.css');
		wp_register_style('si_respond_css', get_template_directory_uri() . '/css/responsive.css');
		wp_register_style('si_comments_css', get_template_directory_uri() . '/css/comments.css');
		wp_register_style('si_awesome_css', get_template_directory_uri() . '/css/font-awesome.min.css');
		
		wp_enqueue_style('si_main_css');
		wp_enqueue_style('si_pretty_css');
		wp_enqueue_style('si_respond_css');
		wp_enqueue_style('si_comments_css');
		wp_enqueue_style('si_awesome_css');
		
	}
	
	add_action('wp_enqueue_scripts', 'si_enqueue_styles');
	
	
	
/*-----------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ LOAD GOOGLE FONTS _-_-_-_-_-_-_-_-_-_-*/
/*-----------------------------------------------------------*/
	
    function si_enqueue_fonts() { 
    
        wp_register_style( 'si_droidserif', 'http://fonts.googleapis.com/css?family=Droid+Serif', array(), '', 'all' );
        wp_register_style( 'si_droidsans', 'http://fonts.googleapis.com/css?family=Droid+Sans', array(), '', 'all' );
        wp_register_style( 'si_opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,300,400,600,700,800', array(), '', 'all' );
        wp_register_style( 'si_montserrat', 'http://fonts.googleapis.com/css?family=Montserrat:400,700', array(), '', 'all' );
        wp_register_style( 'si_francoisone', 'http://fonts.googleapis.com/css?family=Francois+One', array(), '', 'all' );
        wp_register_style( 'si_voltaire', 'http://fonts.googleapis.com/css?family=Voltaire', array(), '', 'all' );
        
        wp_enqueue_style( 'si_droidserif' );
		wp_enqueue_style( 'si_droidsans' );
		wp_enqueue_style( 'si_opensans' );
		wp_enqueue_style( 'si_montserrat' );
		wp_enqueue_style( 'si_francoisone' );
		wp_enqueue_style( 'si_voltaire' );
        
    }
    
    add_action('wp_enqueue_scripts', 'si_enqueue_fonts');



/*---------------------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ QUEUE META SCRIPTS & STYlES _-_-_-_-_-_-_-_-_-_-*/
/*---------------------------------------------------------------------*/	

	function si_meta_scripts() {
	
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('si-upload', get_template_directory_uri() . '/functions/js/upload.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('si-upload');
		
	}
	
	function si_meta_styles() {
	
		wp_enqueue_style('thickbox');
		
	}
	
	add_action('admin_print_scripts', 'si_meta_scripts');
	add_action('admin_print_styles', 'si_meta_styles');



/*--------------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ COMMENT REPLY SCRIPT _-_-_-_-_-_-_-_-_-_-*/
/*--------------------------------------------------------------*/	

	function si_comment_reply(){
	
		if (!is_admin()){
		
			if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
			wp_enqueue_script( 'comment-reply' );
			
		}
	  	
	}
	add_action('get_header', 'si_comment_reply');



/*----------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ THUMBNAILS _-_-_-_-_-_-_-_-_-_-*/
/*----------------------------------------------------*/	

	if ( function_exists( "add_theme_support" ) ) {
		add_theme_support( "post-thumbnails" );
		add_image_size( "single-thumb", 660, "", true );
		add_image_size( "project_home", 540, "", true );
		add_image_size( "project_thumb", 120, 90, true );
		add_image_size( "fullsize", "", "", true );
	}



/*-------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ REGISTER MENU _-_-_-_-_-_-_-_-_-_-*/
/*-------------------------------------------------------*/	

	function register_menu() {
	
		register_nav_menu('main-menu', __('Main Menu', 'shorti'));
		
	}
	
	add_action('init', 'register_menu');



/*-----------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ COMMENTS FUNCTION _-_-_-_-_-_-_-_-_-_-*/
/*-----------------------------------------------------------*/	

	function si_comment($comment, $args, $depth) {

		$isByAuthor = false;
		
		if($comment->comment_author_email == get_the_author_meta('email')) {
		$isByAuthor = true;
		}
		
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		
		<div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
		
			<?php echo get_avatar($comment,$size='50'); ?>
			
			<div class="comment-author vcard">
			
				<?php if ($comment->user_id) {
				$user=get_userdata($comment->user_id);
				echo $user->display_name;
				} else { comment_author_link(); } ?>
				
				<?php if($isByAuthor) { ?><span class="author-tag"><?php _e('(Author)','shorti') ?></span><?php } ?>
			
			</div>
			
			<div class="comment-meta commentmetadata">
			
				<?php printf(__('%1$s at %2$s', 'shorti'), get_comment_date(),  get_comment_time()) ?>
				
				<?php edit_comment_link(__('(Edit)', 'shorti'),'  ','') ?> &middot; 
				
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				
			</div>
			
			<div class="comment-inner">
			
				<?php if ($comment->comment_approved == '0') : ?>
				<em class="moderation"><?php _e('Your comment is awaiting moderation.', 'shorti') ?></em>
				<br />
				<?php endif; ?>
				
				<?php comment_text() ?>
			
			</div>
		
		</div>

	<?php
	}



/*-------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ EXCERPT _-_-_-_-_-_-_-_-_-_-*/
/*-------------------------------------------------*/	

	function si_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'si_excerpt_length' );
	
	function new_excerpt_more($excerpt) {
		return str_replace('[...]', '...', $excerpt);
	}
	add_filter('wp_trim_excerpt', 'new_excerpt_more');



/*--------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ SHORTCODE MENU _-_-_-_-_-_-_-_-_-_-*/
/*--------------------------------------------------------*/	

	add_action('media_buttons','add_sc_select',11);
	function add_sc_select(){
	    global $shortcode_tags;
	    $exclude = array("wp_caption", "embed", "caption", "gallery");
	    echo '&nbsp;<select id="sc_select"><option>Shortcode</option>';
	
	    foreach ($shortcode_tags as $key => $val){
		    if(!in_array($key,$exclude)){
	            $shortcodes_list .= '<option value="['.$key.'][/'.$key.']">'.$key.'</option>';
	    	    }
	        }
	     echo $shortcodes_list;
	     echo '</select>';
	    echo '
	    
	    <style type="text/css">
	    
	    .wp-media-buttons {
	    	padding-top: 0;
	    }
	    
	    </style>
	    
	    ';
	}
	add_action('admin_head', 'button_js');
	function button_js() {
		echo '<script type="text/javascript">
		jQuery(document).ready(function(){
		   jQuery("#sc_select").change(function() {
				  send_to_editor(jQuery("#sc_select :selected").val());
	        		  return false;
			});
		});
		</script>';
	}



/*----------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ ADMIN MENU ICONS _-_-_-_-_-_-_-_-_-_-*/
/*----------------------------------------------------------*/	
 
	add_action( 'admin_head', 'custom_admin_styles' );
	 
	function custom_admin_styles() { ?>
	    
		<style type="text/css" media="screen">
		
		/* Skills */
		
			#menu-posts-service .wp-menu-image {
				background: url(<?php echo get_stylesheet_directory_uri() ?>/functions/images/service_menu_icon.png) top left no-repeat !important;
			}
			
			#menu-posts-service:hover .wp-menu-image, #menu-posts-service.wp-has-current-submenu .wp-menu-image {
				background-position: bottom left !important;
			}
			
			#icon-edit.icon32-posts-service {
				background: url(<?php echo get_stylesheet_directory_uri() ?>/functions/images/service_icon_32.png) no-repeat;
			}
		
		/* Projects */
		
			#menu-posts-project .wp-menu-image {
				background: url(<?php echo get_stylesheet_directory_uri() ?>/functions/images/project_menu_icon.png) top left no-repeat !important;
			}
			
			#menu-posts-project:hover .wp-menu-image, #menu-posts-project.wp-has-current-submenu .wp-menu-image {
				background-position: bottom left !important;
			}
			
			#icon-edit.icon32-posts-project {
				background: url(<?php echo get_stylesheet_directory_uri() ?>/functions/images/project_icon_32.png) no-repeat;
			}
			
		/* Thumbnail Column */
		
			th#thumbnail { width: 100px }
			
			th#title { width: 150px }
			
			.thumbnail img { max-width: 100px; height: auto; }
		
		</style>
		
	<?php }
	
	
	
/*----------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ THUMBNAIL COLUMN _-_-_-_-_-_-_-_-_-_-*/
/*----------------------------------------------------------*/
	
add_filter('manage_posts_columns', 'thumbnail_column');
function thumbnail_column($columns) {
    $column_thumbnail = array( 'thumbnail' => 'Thumbnail' );
	$columns = array_slice( $columns, 0, 2, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
    return $columns;
}

add_action('manage_posts_custom_column', 'show_thumbnail_column', 10, 1);
function show_thumbnail_column($name) {
    global $post;
    switch ($name) {
        case 'thumbnail':
            $thumbnail = get_the_post_thumbnail($post->ID);
            echo $thumbnail;
    }
}



/*--------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ REQUIRED _-_-_-_-_-_-_-_-_-_-*/
/*--------------------------------------------------*/	

	if ( ! isset( $content_width ) )
		$content_width = 660;
				
		
	
/*--------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ HIDE ADMIN BAR _-_-_-_-_-_-_-_-_-_-*/
/*--------------------------------------------------------*/	
		
	function my_function_admin_bar(){ return false; }
	add_filter( 'show_admin_bar' , 'my_function_admin_bar');
		
		
		
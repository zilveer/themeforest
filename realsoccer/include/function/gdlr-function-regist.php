<?php
	/*	
	*	Goodlayers Function Inclusion File
	*	---------------------------------------------------------------------
	*	This file contains the script to includes necessary function to the theme
	*	---------------------------------------------------------------------
	*/
	
	// include the shortcode support for the text widget
	add_filter('widget_text', 'do_shortcode');
	add_filter('widget_title', 'do_shortcode');

	// add support to post and comment RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// set up the content width based on the theme's design
	if ( !isset($content_width) ) $content_width = $theme_option['content-width'];	

	// rewrite permalink rule upon theme activation
	add_action( 'after_switch_theme', 'gdlr_flush_rewrite_rules' );
	if( !function_exists('gdlr_flush_rewrite_rules') ){
		function gdlr_flush_rewrite_rules() {
			global $pagenow, $wp_rewrite;
			if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ){
				$wp_rewrite->flush_rules();
			}
		}
	}
	
	// add tinymce editor style
	add_action( 'init', 'my_theme_add_editor_styles' );
	if( !function_exists('my_theme_add_editor_styles') ){
		function my_theme_add_editor_styles() {
			add_editor_style('/stylesheet/editor-style.css');
		}
	}
	
	// add script and style to header area
	add_action( 'wp_head', 'gdlr_head_script' );
	if( !function_exists('gdlr_head_script') ){
		function gdlr_head_script() {	
			global $theme_option;
			
			if( !empty($theme_option['favicon-id']) ){
				if( is_numeric($theme_option['favicon-id']) ){ 
					$favicon = wp_get_attachment_image_src($theme_option['favicon-id'], 'full');
					$theme_option['favicon-id'] = $favicon[0];
				}
				echo '<link rel="shortcut icon" href="' . $theme_option['favicon-id'] . '" type="image/x-icon" />';
			}
			if( !empty($theme_option['google-analytics']) ){
				echo $theme_option['google-analytics'];
			}	

?>
<!-- load the script for older ie version -->
<!--[if lt IE 9]>
<script src="<?php echo GDLR_PATH . '/javascript/html5.js'; ?>" type="text/javascript"></script>
<script src="<?php echo GDLR_PATH . '/plugins/easy-pie-chart/excanvas.js'; ?>" type="text/javascript"></script>
<![endif]-->
<?php			
		}
	}
	
	// add the additional script to footer area
	add_action( 'wp_footer', 'gdlr_additional_script' );
	if( !function_exists('gdlr_additional_script') ){
		function gdlr_additional_script() {
			global $theme_option;
			echo '<script type="text/javascript">' . $theme_option['additional-script'] . '</script>';
		}
	}
	
	// init the theme_option value and customizer value upon activation	
	add_action( 'after_switch_theme', 'gdlr_get_default_admin_option' );
	if( !function_exists('gdlr_get_default_admin_option') ){
		function gdlr_get_default_admin_option() {
			$theme_option = get_option(THEME_SHORT_NAME . '_admin_option', array());
			if(empty($theme_option)){
				$default_file = GDLR_LOCAL_PATH . '/include/function/gdlr-admin-default.txt';
				$default_admin_option = unserialize(file_get_contents($default_file));

				update_option(THEME_SHORT_NAME . '_admin_option', $default_admin_option);
			}
			
			$sidebar_option = get_option('gdlr_sidebar_name', array());
			if(empty($sidebar_option)){
				update_option('gdlr_sidebar_name', 
					array( 'blog', 'blog-left', 'portfolio', 'portfolio-left', 'shortcodes',  'woocommerce',  'Features', 'Archives', 'contact', 'Soccer')
				);
			}
			
			$google_font_list = get_option(THEME_SHORT_NAME . '_google_font_list', array());
			if( empty($google_font_list) ){
				$font_text  = 'a:3:{s:19:"Open Sans Condensed";a:2:{s:7:"subsets";a:7:{i:0;s:5:"greek";i:1;s:12:"cyrillic-ext";i:2;s:8:"cyrillic";i:3;s:5:"latin";i:4;s:9:"latin-ext";i:5;s:10:"vietnamese";i:6;s:9:"greek-ext";}s:8:"variants";a:3:{i:0;s:3:"300";i:1;s:9:"300italic";i:2;s:3:"700";}}s:9:"Open Sans";a:2:{s:7:"subsets";a:7:{i:0;s:5:"greek";i:1;s:12:"cyrillic-ext";i:2;s:8:"cyrillic";i:3;s:5:"latin";i:4;s:9:"latin-ext";i:5;s:10:"vietnamese";i:6;s:9:"greek-ext";}s:8:"variants";a:10:{i:0;s:3:"300";i:1;s:9:"300italic";i:2;s:7:"regular";i:3;s:6:"italic";i:4;s:3:"600";i:5;s:9:"600italic";i:6;s:3:"700";i:7;s:9:"700italic";i:8;s:3:"800";i:9;s:9:"800italic";}}s:7:"ABeeZee";a:2:{s:7:"subsets";a:1:{i:0;s:5:"latin";}s:8:"variants";a:2:{i:0;s:7:"regular";i:1;s:6:"italic";}}}';
				update_option(THEME_SHORT_NAME . '_google_font_list', unserialize($font_text));
			}
		}
	}
	// for printing default admin option
	// print_r( get_option('gdlr_sidebar_name', array()) );
	
	//$file_url = get_template_directory() . '/include/function/gdlr-admin-default.txt';
	//$file_stream = @fopen($file_url, 'w');
	//fwrite($file_stream, serialize($theme_option));
	//fclose($file_stream);
	
	//print_r( serialize(get_option(THEME_SHORT_NAME . '_google_font_list')) );
	
	// action to require the necessary wordpress function
 	add_action( 'after_setup_theme', 'gdlr_theme_setup' );
	if( !function_exists('gdlr_theme_setup') ){
		function gdlr_theme_setup(){
			
			// for translating the theme
			load_theme_textdomain( 'gdlr_translate', GDLR_LOCAL_PATH . '/languages' );
			
			// register main navigation menu 
			register_nav_menu( 'main_menu', __( 'Main Navigation Menu', 'gdlr_translate' ) );

			// adds RSS feed links to <head> for posts and comments.			
			add_theme_support( 'automatic-feed-links' );
			
			// This theme supports a variety of post formats.
			add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );			
		}
	}
	
	// turn the page comment off by default
	add_filter( 'wp_insert_post_data', 'page_default_comments_off' );
	if( !function_exists('page_default_comments_off') ){
		function page_default_comments_off( $data ) {
			if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
				$data['comment_status'] = 0;
			} 

			return $data;
		}
	}	
	
	// set the excerpt length of each item
	add_filter('excerpt_more', 'gdlr_excerpt_more');	
	if( !function_exists('gdlr_excerpt_more') ){
		function gdlr_excerpt_more( $more ) {
			global $gdlr_excerpt_read_more; if( !$gdlr_excerpt_read_more ) return '...';
			
			return '... <div class="clear"></div><a href="' . get_permalink() . '" class="excerpt-read-more">' . __( 'Read More', 'gdlr_translate' ) . '</a>';
		}
	}
	add_filter('get_the_excerpt', 'gdlr_strip_excerpt_link');	
	if( !function_exists('gdlr_strip_excerpt_link') ){
		function gdlr_strip_excerpt_link( $excerpt ) {
			return preg_replace('#^https?://\S+#', '', $excerpt);
		}
	}	
	if( !function_exists('gdlr_set_excerpt_length') ){
		function gdlr_set_excerpt_length( $length ){
			global $gdlr_excerpt_length; return $gdlr_excerpt_length ;
		}
	}	

	// modify a wordpress gallery style
	add_filter('gallery_style', 'gdlr_gallery_style');
	if( !function_exists('gdlr_gallery_style') ){
		function gdlr_gallery_style( $style ){
			return str_replace('border: 2px solid #cfcfcf;', 'border-width: 1px; border-style: solid;', $style);
		}
	}
	
	// a comment callback function to create comment list
	if ( !function_exists('gdlr_comment_list') ){
		function gdlr_comment_list( $comment, $args, $depth ){
			$GLOBALS['comment'] = $comment;
			switch ( $comment->comment_type ){
				case 'pingback' :
				case 'trackback' :
?>	
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	<p><?php _e( 'Pingback :', 'gdlr_translate' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'gdlr_translate' ), '<span class="edit-link">', '</span>' ); ?></p>
<?php break; ?>

<?php default : global $post; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="comment-article">
		<div class="comment-avatar"><?php echo get_avatar( $comment, 60 ); ?></div>
		<div class="comment-body">
			<header class="comment-meta">
				<div class="comment-author gdlr-title"><?php echo get_comment_author_link(); ?></div>
				<div class="comment-time">
					<i class="icon-time"></i>
					<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
						<time datetime="<?php echo get_comment_time('c'); ?>">
						<?php echo get_comment_date() . ' ' . __('at', 'gdlr_translate') . ' ' . get_comment_time(); ?>
						</time>
					</a>
				</div>
			<div class="comment-reply">
				<?php comment_reply_link( array_merge($args, array('before' => ' <i class="icon-mail-reply"></i>', 'reply_text' => __('Reply', 'gdlr_translate'), 'depth' => $depth, 'max_depth' => $args['max_depth'])) ); ?>
			</div><!-- reply -->					
			</header>

			<?php if( '0' == $comment->comment_approved ){ ?>
				<p class="comment-awaiting-moderation"><?php echo __( 'Your comment is awaiting moderation.', 'gdlr_translate' ); ?></p>
			<?php } ?>

			<section class="comment-content">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'gdlr_translate' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- comment-content -->

		</div><!-- comment-body -->
	</article><!-- comment-article -->
<?php
				break;
			}
		}
	}	
	
	// add login form to top left area
	// add_action('gdlr_top_left_menu', 'gdlr_create_login_form', 3);
	if ( !function_exists('gdlr_create_login_form') ){
		function gdlr_create_login_form(){
		global $theme_option; if($theme_option['top-bar-login'] == 'disable') return;
		
?>
<li class="gdlr-mega-menu">
	<?php 
		if(is_user_logged_in()){
			echo '<a href="' . wp_logout_url(get_permalink()) . '"><i class="icon-lock"></i>' . __('Logout', 'gdlr_translate') . '</a>';
		
			//$current_user = wp_get_current_user();
			//echo '<a href="#"><i class="icon-lock"></i>' . __('Welcome', 'gdlr_translate') . ' ';
			//echo $current_user->user_login;
			//echo '</a>';
		}else{
			echo '<a href="#"><i class="icon-lock"></i>' . __('Login', 'gdlr_translate') . '</a>';
	?>
	<div class="sf-mega">
		<div class="sf-mega-section gdlr-login-form">
		<?php 
			wp_login_form(array(
				'label_username' => __('Username', 'gdlr_translate'),
				'label_password' => __('Password', 'gdlr_translate'),
				'label_remember' => __('Remember Me', 'gdlr_translate'),
				'label_log_in' => __('Log In', 'gdlr_translate')
			));
		?>
		</div>
	</div>
	<?php }?>
</li>
<?php
		}
	}
	
	// add subscription form to top left area
	// add_action('gdlr_top_left_menu', 'gdlr_create_subscription_form', 2);
	if ( !function_exists('gdlr_create_subscription_form') ){
		function gdlr_create_subscription_form(){
		global $theme_option; if(empty($theme_option['top-bar-subscribtion'])) return;
		
?>
<li class="gdlr-mega-menu">
	<a href="#"><i class="icon-envelope"></i><?php echo __('Subscribe', 'gdlr_translate'); ?></a>
	<div class="sf-mega">
		<div class="sf-mega-section gdlr-mailchimp-form">
		<?php echo do_shortcode($theme_option['top-bar-subscribtion']); ?>
		</div>
	</div>
</li>
<?php
		}
	}	
	
?>
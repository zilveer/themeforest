<?php
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//DUOTIVE ADMIN INCLUDES
	if ( is_admin()	)
	{
		
		//GENERAL STYLES AND SCRIPTS
		wp_register_style('duotive-admin-css',get_template_directory_uri().'/includes/duotive-admin-skin/css/duotive-admin.css');
		wp_register_style('duotive-admin-jqtransform-css', get_template_directory_uri(). '/includes/duotive-admin-skin/css/jqtransform.css' );	
		wp_register_style('duotive-admin-colorpicker-css', get_template_directory_uri(). '/includes/duotive-admin-skin/css/colorpicker.css' );
		wp_register_style('duotive-admin-wordpress-css', get_template_directory_uri(). '/includes/duotive-admin-skin/css/duotive-wordpress.css' );
		wp_register_script( 'duotive-admin-colorpicker', get_template_directory_uri(). '/includes/duotive-admin-skin/js/jquery.colorpicker.js' );
		wp_register_script( 'duotive-admin-jquery-tools', get_template_directory_uri(). '/includes/duotive-admin-skin/js/jquery.tools.min.js' );
		wp_register_script( 'duotive-admin-wordpress-js', get_template_directory_uri(). '/includes/duotive-admin-skin/js/duotive-wordpress.js' );	
		wp_register_script( 'duotive-admin-jqtransform', get_template_directory_uri(). '/includes/duotive-admin-skin/js/jquery.jqtransform.js' );
		wp_register_script( 'duotive-admin-jquery-ui', get_template_directory_uri(). '/includes/duotive-admin-skin/js/jquery.ui.min.js' );	
		wp_register_script( 'duotive-admin-imgpreview', get_template_directory_uri(). '/includes/duotive-admin-skin/js/jquery.imgpreview.js' );					
		wp_register_script( 'duotive-admin-panel', get_template_directory_uri(). '/includes/duotive-admin-skin/js/duotive-admin-panel.js' );			
		wp_register_script( 'duotive-admin-blogs', get_template_directory_uri(). '/includes/duotive-admin-skin/js/duotive-admin-blogs.js' );			
		wp_register_script( 'duotive-admin-contact', get_template_directory_uri(). '/includes/duotive-admin-skin/js/duotive-admin-contact.js' );					
		wp_register_script( 'duotive-admin-frontpagemanager', get_template_directory_uri(). '/includes/duotive-admin-skin/js/duotive-admin-frontpagemanager.js' );							
		wp_register_script( 'duotive-admin-languages', get_template_directory_uri(). '/includes/duotive-admin-skin/js/duotive-admin-languages.js' );							
		wp_register_script( 'duotive-admin-portfolios', get_template_directory_uri(). '/includes/duotive-admin-skin/js/duotive-admin-portfolios.js' );									
		wp_register_script( 'duotive-admin-pricingtable', get_template_directory_uri(). '/includes/duotive-admin-skin/js/duotive-admin-pricingtable.js' );									
		wp_register_script( 'duotive-admin-sidebars', get_template_directory_uri(). '/includes/duotive-admin-skin/js/duotive-admin-sidebars.js' );
		wp_register_script( 'duotive-admin-slider', get_template_directory_uri(). '/includes/duotive-admin-skin/js/duotive-admin-slider.js' );											
	
		if ( isset($_GET['page']) ) $page = $_GET['page']; else $page = '';
	
		if (is_admin() && $page != 'duotive-slider' && $page != 'duotive-front-page-manager' && $page != 'duotive-language' && $page != 'duotive-panel' && $page != 'duotive-sidebars' && $page != 'duotive-portfolios' && $page != 'duotive-blogs'  && $page != 'duotive-pricing-table'  && $page != 'duotive-contact' ) {
			wp_enqueue_style('duotive-admin-wordpress-css');
			wp_enqueue_style('duotive-admin-colorpicker-css');
			wp_enqueue_style('duotive-admin-jqtransform-css');		
			wp_enqueue_script('duotive-admin-jquery-tools');			
			wp_enqueue_script('duotive-admin-jqtransform');
			wp_enqueue_script('duotive-admin-colorpicker');	
			wp_enqueue_script('duotive-admin-wordpress-js');
		}
		
		if (is_admin() && ( $page == 'duotive-blogs' || $page == 'duotive-panel' || $page == 'duotive-language' || $page == 'duotive-front-page-manager' || $page == 'duotive-slider' || $page == 'duotive-sidebars' || $page == 'duotive-portfolios' || $page == 'duotive-pricing-table' || $page == 'duotive-contact') )
		{
			wp_enqueue_style('duotive-admin-css');
			wp_enqueue_style('duotive-admin-jqtransform-css');		
			wp_enqueue_style('duotive-admin-colorpicker-css');		
			wp_enqueue_script('duotive-admin-colorpicker');
			wp_enqueue_script('duotive-admin-jqtransform');
			wp_enqueue_script('duotive-admin-jquery-tools');
			wp_enqueue_script('duotive-admin-jquery-ui');		
		}
		
		if (is_admin() && ( $page == 'duotive-panel') ) { wp_enqueue_script('duotive-admin-imgpreview'); wp_enqueue_script('duotive-admin-panel');  } 
		if (is_admin() && ( $page == 'duotive-blogs') ) wp_enqueue_script('duotive-admin-blogs');
		if (is_admin() && ( $page == 'duotive-contact') ) wp_enqueue_script('duotive-admin-contact');		
		if (is_admin() && ( $page == 'duotive-front-page-manager') ) wp_enqueue_script('duotive-admin-frontpagemanager');				
		if (is_admin() && ( $page == 'duotive-language') ) wp_enqueue_script('duotive-admin-languages');
		if (is_admin() && ( $page == 'duotive-portfolios') ) wp_enqueue_script('duotive-admin-portfolios');						
		if (is_admin() && ( $page == 'duotive-pricing-table') ) wp_enqueue_script('duotive-admin-pricingtable');		
		if (is_admin() && ( $page == 'duotive-sidebars') ) wp_enqueue_script('duotive-admin-sidebars');				
		if (is_admin() && ( $page == 'duotive-slider') ) wp_enqueue_script('duotive-admin-slider');						
	}
	//DUOTIVE THEME INCLUDES
	if ( !is_admin() ) {
		wp_register_style('duotive-modal-window',get_template_directory_uri().'/css/utilities/prettyphoto.css','', NULL);		
			
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri()."/js/jquery-1.7.1.min.js", false, null);
		wp_register_script('jquery-scripts', get_template_directory_uri()."/js/jquery.scripts.js", false, null);
		wp_register_script('jquery-easing', get_template_directory_uri()."/js/jquery.easing.js", false, null);
		wp_register_script('jquery-custom', get_template_directory_uri()."/js/jquery.custom.js", false, null);  
		wp_register_style('duotive-nivo-slider-style',get_template_directory_uri().'/css/slideshows/nivo-slider.css','', NULL);						
		wp_register_style('duotive-content-slider-style',get_template_directory_uri().'/css/slideshows/content-slider.css','', NULL);				
		wp_register_style('duotive-complex-slider-style',get_template_directory_uri().'/css/slideshows/complex-slider.css','', NULL);						
		wp_register_style('duotive-presentation-slider-style',get_template_directory_uri().'/css/slideshows/presentation-slider.css','', NULL);								
		wp_register_style('duotive-fullwidth-slider-style',get_template_directory_uri().'/css/slideshows/fullwidth-slider.css','', NULL);
		wp_register_style('duotive-fullscreen-slider-style',get_template_directory_uri().'/css/slideshows/fullscreen-slider.css','', NULL);								
		wp_register_style('duotive-gallery-slider-style',get_template_directory_uri().'/css/slideshows/gallery-slider.css','', NULL);										
		
		//GENERAL ENQUEUES
		wp_enqueue_style('duotive-modal-window');				
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-scripts');				
		wp_enqueue_script('jquery-custom');				
		
		//SLIDESHOW ENQUEUES
		function get_slider_scripts($type)
		{
			
			switch($type)
			{
				case 'content-slider':
					wp_enqueue_style('duotive-content-slider-style');
					wp_register_script('bx-slider', get_template_directory_uri()."/js/jquery.bxslider.js", false, null);							
					wp_enqueue_script('bx-slider');						
					wp_register_script('duotive-slider-calls', get_template_directory_uri()."/js/get-slideshow-js.php?type=content-slider", false, null);		
					wp_enqueue_script('duotive-slider-calls');				
				break;	
				case 'complex-slider':
					wp_enqueue_style('duotive-complex-slider-style');
					wp_register_script('duotive-complex-slider', get_template_directory_uri()."/js/duotive-slideshows/duotiveComplexSlider-2.1.min.js", false, null);							
					wp_enqueue_script('duotive-complex-slider');														
					wp_register_script('duotive-slider-calls', get_template_directory_uri()."/js/get-slideshow-js.php?type=complex-slider", false, null);		
					wp_enqueue_script('duotive-slider-calls');	
				break;
				case 'presentation-slider':
					wp_enqueue_style('duotive-presentation-slider-style');
					wp_register_script('duotive-presentation-slider', get_template_directory_uri()."/js/duotive-slideshows/duotivePresentationSlider-2.1.min.js", false, null);							
					wp_enqueue_script('duotive-presentation-slider');														
					wp_register_script('duotive-slider-calls', get_template_directory_uri()."/js/get-slideshow-js.php?type=presentation-slider", false, null);		
					wp_enqueue_script('duotive-slider-calls');	
				break;				
				case 'fullwidth-slider':
					wp_enqueue_style('duotive-fullwidth-slider-style');
					wp_register_script('duotive-fullwidth-slider', get_template_directory_uri()."/js/duotive-slideshows/duotiveFullWidthSlider-3.1.min.js", false, null);							
					wp_enqueue_script('duotive-fullwidth-slider');														
					wp_register_script('duotive-slider-calls', get_template_directory_uri()."/js/get-slideshow-js.php?type=fullwidth-slider", false, null);		
					wp_enqueue_script('duotive-slider-calls');	
				break;	
				case 'fullscreen-slider':
					wp_enqueue_style('duotive-fullscreen-slider-style');
					wp_enqueue_script('jquery-easing');						
					wp_register_script('duotive-fullscreen-slider', get_template_directory_uri()."/js/duotive-slideshows/duotiveFullScreenSlider-3.1.min.js", false, null);							
					wp_enqueue_script('duotive-fullscreen-slider');														
					wp_register_script('duotive-slider-calls', get_template_directory_uri()."/js/get-slideshow-js.php?type=fullscreen-slider", false, null);		
					wp_enqueue_script('duotive-slider-calls');	
				break;					
				case 'gallery-slider':
					wp_enqueue_style('duotive-gallery-slider-style');
					wp_register_script('duotive-gallery-slider', get_template_directory_uri()."/js/duotive-slideshows/duotiveGallerySlider-2.1.min.js", false, null);							
					wp_enqueue_script('duotive-gallery-slider');														
					wp_register_script('duotive-slider-calls', get_template_directory_uri()."/js/get-slideshow-js.php?type=gallery-slider", false, null);		
					wp_enqueue_script('duotive-slider-calls');	
				break;												
			}
			
		}		
	}	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//DUOTIVE ADMIN WARNINGS
	
	function dt_AdminWarnings () 
	{
		$warnings = '';
		if (!function_exists('bcn_display')) $warnings .= '"Breadcrumb NavXT" plugin is not installed or activated. Please install or activate.'; 
		if ( $warnings != '' ) $warnings .= '<br />';
		if (!function_exists('wp_pagenavi')) $warnings .= '"WP-PageNavi" plugin is not installed or activated. Please install or activate.';           
		if ( $warnings != '' ) $warnings .= '<br />';
		$absolute_path = __FILE__;
		$path_to_file = explode( 'wp-content', $absolute_path );
		$path_to_wp = $path_to_file[0];
		$theme_path = get_template_directory_uri();
		$website_url = site_url().'/';
		$theme_path = str_replace($website_url,'', $theme_path);
		$cache_path = $path_to_wp.$theme_path.'/includes/cache/';
		if (!is_writable($cache_path)) $warnings .= 'The cache folder is not writable! Please make the folder "wp-content/themes/duotive-theme/includes/cache" writable.';	
		return $warnings;
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//DEFINE WORDPRESS MENUS
	register_nav_menu('primary', 'Main Menu');
	register_nav_menu('secondary', 'Footer Menu');

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//DISPLAY THE TITLE OUTSIDE LOOP

	function get_title_outside_loop() { ?>    
    	<?php global $wp; ?>
    	<?php if ( is_post_type_archive('project') ): ?>
        	<?php echo dt_ProjectArchives; ?>
		<?php elseif(isset($wp->query_vars['portfolio'])): ?>           
			<?php $portfolio_slug = $wp->query_vars['portfolio']; ?>            
            <?php $portfolio_details = get_term_by('slug', $portfolio_slug, 'portfolio'); ?>
            <?php echo $portfolio_details->name; ?>            
        <?php else: ?>
			<?php if ( is_page() || is_single()): ?>
                <?php global $post; ?>
                <?php echo get_the_title($post->ID); ?>
            <?php elseif ( is_author() ): ?>
                <?php echo dt_AuthorArchives; ?>
                <?php $author_id = get_query_var('author'); ?>
                <?php $author = get_userdata($author_id); ?>
                <?php if ( $author->last_name != '' ) : ?>
                    <?php echo $author->last_name; ?>
                    <?php echo $author->first_name; ?>  
                <?php else: ?>
                    <?php echo $author->user_login; ?>                                  
                <?php endif; ?>          
            <?php elseif(is_category()): ?>   
                <?php echo dt_CategoryArchives.single_cat_title( '', false ); ?>
            <?php elseif (is_tag()): ?>
                <?php echo dt_TagArchives.single_tag_title( '', false ); ?>
            <?php elseif (is_search()): ?>
                <?php if(have_posts()): ?>
                    <?php echo dt_SearchResults.get_search_query(); ?>
                <?php else: ?>
                    <?php echo dt_NotFoundTitle; ?>
                <?php endif; ?>
            <?php elseif(is_archive()): ?>
                    <?php if ( is_day() ) :
                        echo dt_DailyArchives.get_the_date();
                            elseif ( is_month() ) :
                                echo dt_MonthlyArchives.get_the_date('F Y');
                                elseif ( is_year() ) :
                                    echo dt_YearlyArchives.get_the_date('Y');
                                    else :
                                        echo dt_BlogArchives;
                    endif; ?>                                
            <?php elseif(is_404()): ?>
                    <?php echo __('Not Found','duotive'); ?> 
            <?php elseif(is_home()): ?>
                    <?php echo get_bloginfo('name'); ?>                                            
            <?php endif; ?>
		<?php endif; ?>            
	<?php } 
		
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//THUMBNAIL RESIZE
	
	function resizeimage($imageurl,$width=100,$height=100,$crop='')
	{
		switch($crop)
		{
			case '': $croplocation = ''; break;
			case 'c': $croplocation = '&amp;a=c'; break;	
			case 't': $croplocation = '&amp;a=t'; break;
			case 'tr': $croplocation = '&amp;a=tr'; break;
			case 'tl': $croplocation = '&amp;a=tl'; break;
			case 'b': $croplocation = '&amp;a=b'; break;
			case 'br': $croplocation = '&amp;a=br'; break;
			case 'bl': $croplocation = '&amp;a=bl'; break;
			case 'l': $croplocation = '&amp;a=l'; break;			
			case 'r': $croplocation = '&amp;a=r'; break;					
		}
		$website_url = site_url(); 		
		$imageurl = str_replace($website_url,'', $imageurl);		
		global $blog_id;
		if (isset($blog_id) && $blog_id > 0) {
			$imageParts = explode('/files/', $imageurl);
			if (isset($imageParts[1])) {
				$imageurl = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
			}
		}		
		echo get_template_directory_uri().'/includes/timthumb.php?src='.$imageurl.'&amp;h='.$height.'&amp;w='.$width.$croplocation.'&amp;zc=1&amp;q=100';
	}
	
	function resizeimagenoecho($imageurl,$width=100,$height=100,$crop='')
	{
		switch($crop)
		{
			case '': $croplocation = ''; break;
			case 'c': $croplocation = '&amp;a=c'; break;	
			case 't': $croplocation = '&amp;a=t'; break;
			case 'tr': $croplocation = '&amp;a=tr'; break;
			case 'tl': $croplocation = '&amp;a=tl'; break;
			case 'b': $croplocation = '&amp;a=b'; break;
			case 'br': $croplocation = '&amp;a=br'; break;
			case 'bl': $croplocation = '&amp;a=bl'; break;
			case 'l': $croplocation = '&amp;a=l'; break;			
			case 'r': $croplocation = '&amp;a=r'; break;					
		}
		$website_url = site_url(); 		
		$imageurl = str_replace($website_url,'', $imageurl);		
		return get_template_directory_uri().'/includes/timthumb.php?src='.$imageurl.'&h='.$height.'&w='.$width.$croplocation.'&zc=1&q=100';
	}	
		
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//WORDPRESS COMMENT STRUCTURE REWRITE
	
	if ( ! function_exists( 'comment_callback' ) ) :
	function comment_callback( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-wrapper clearfix">
        	<span class="author-badge"></span>
			<div class="avatar-wrapper"><?php echo get_avatar( $comment, 81 ); ?></div>
            <div class="comment">
                <div class="author"><?php echo get_comment_author_link(); ?><span> <?php echo dt_CommentsSays; ?></span></div>
                <div class="comment-body"><?php comment_text(); ?></div>
                <div class="comment-footer">
                    <div class="date"><?php comment_time('g:i a'); ?> - <?php comment_time('F j, Y'); ?></div> 
                    <div class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
                </div>
            </div>
		</div>
	  <?php
				break;
			case 'pingback'  :
			case 'trackback' :
	  ?>
			<li class="post pingback">
			  <p>
				<?php __( 'Pingback:', 'duotive' ); ?>
				<?php comment_author_link(); ?>
				<?php edit_comment_link( __('Edit', 'duotive'), ' ' ); ?>
			  </p>
			  <?php
				break;
		endswitch;
	}
	endif;
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//REMOVE UGLY AND USELESS ADMIN BAR
	if ( !is_admin() ) add_filter( 'show_admin_bar', '__return_false' );
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//WORDPRESS EXCERPT REWRITES
	
	function new_excerpt_more($more) {
		return '';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
	
	function new_excerpt_length($length) {
		return 20;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
	
	function variable_excerpt($len=20, $trim="&hellip;"){
		$limit = $len+1;
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		$num_words = count($excerpt);
		if ($num_words >= $len){
			$last_item = array_pop($excerpt);
		}
		else{
			$trim = "";
		}
		$excerpt = implode(" ",$excerpt) . "$trim";
		echo '<p>'.$excerpt.'</p>';
	}	

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//ADD COMMENT FORM FILTERS
	
	add_filter('comment_form_default_fields', 'duotive_edit_comment_form');
	function duotive_edit_comment_form($arg) {
		if ( !isset($aria_req) ) $aria_req = '';
		$commenter = wp_get_current_commenter();
		$author_input_template = '<p class="comment-form-author">';
			$author_input_template .= '<label for="author">' . dt_CommentsFormName . '</label> ' . '<span class="required">*</span>';
			$author_input_template .= '<input class="required" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1"' . $aria_req . ' />';
		$author_input_template .= '</p>';
		$email_input_template = '<p class="comment-form-email">';
			$email_input_template .= '<label for="email">' . dt_CommentsFormEmail . '</label> ' . '<span class="required">*</span>';
			$email_input_template .= '<input class="required email" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2"' . $aria_req . ' />';
		$email_input_template .= '</p>';		
		$url_input_template = '<p class="comment-form-url">';
			$url_input_template .= '<label for="url">' . dt_CommentsFormWebsite . '</span></label>';
			$url_input_template .= '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />';
		$url_input_template .= '</p>';	
    	$arg['author'] = $author_input_template;
		$arg['email'] = $email_input_template;
    	$arg['url'] = $url_input_template;
    	return $arg;
	}	
	
	add_filter('comment_form_defaults', 'duotive_comment_field');
	function duotive_comment_field($arg) {
		$comment_field_template = '<p class="comment-form-comment">';
			$comment_field_template .= '<label for="comment">' . dt_CommentsFormComment . '</label>' . '<span class="required">*</span>';
			$comment_field_template .= '<textarea class="required" id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea>';
		$comment_field_template .= '</p>';	
		$arg['comment_field'] = $comment_field_template;
    	return $arg;
	}
	
	add_filter('comment_form_defaults', 'duotive_comment_labels');
	function duotive_comment_labels($arg) {
		$arg['title_reply'] = dt_CommentsLeaveReply;
		$arg['title_reply_to'] = dt_CommentsLeaveReplyTo.' %s';
		$arg['cancel_reply_link'] = dt_CommentsCancelReply;
		$arg['label_submit'] = dt_CommentsPostComment;
		$arg['comment_notes_before'] = '';
		$required_text = dt_CommentsRequired.'<span class="required">*</span>';
		$arg['comment_notes_after'] = '<p class="comment-notes">' . dt_CommentsPublish . $required_text . '</p>';
    	return $arg;
	}	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//ADD UPLOAD BUTTON TO THE THEME	
	
	function duotive_admin_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
	
	function duotive_admin_styles() {
		wp_enqueue_style('thickbox');
	}

	if (isset($_GET['page']) && ( $_GET['page'] == 'duotive-slider' || $_GET['page'] == 'duotive-panel' ) ) {
		add_action('admin_print_scripts', 'duotive_admin_scripts');
		add_action('admin_print_styles', 'duotive_admin_styles');
	}	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//WORDPRESS FILTERS

	function get_dynamic_sidebar($index = 1) 
	{
		$sidebar_contents = "";
		ob_start();
		dynamic_sidebar($index);
		$sidebar_contents = ob_get_clean();
		return $sidebar_contents;
	}
	
	add_theme_support('automatic-feed-links');	
	function add_oembed_div($html, $url, $attr) {
		return '<div class="duotive-video-embed">'.$html.'</div>';
	}
	add_filter('embed_oembed_html', 'add_oembed_div', 50, 3);
	
	add_theme_support( 'post-thumbnails' );
	add_filter('widget_text', 'do_shortcode');
	add_filter('widget_title', 'do_shortcode');
	
	function remove_pagenavi_styles() {
		wp_deregister_style( 'wp-pagenavi' );
	}
	add_action( 'wp_print_styles', 'remove_pagenavi_styles', 100 );
	
	
	function categories_add_span_cat_count($links) {
		$links = str_replace('</a> (', '</a> <span class="post-count">(', $links);
		$links = str_replace(')', ')</span>', $links);
		return $links;
	}
	add_filter('wp_list_categories', 'categories_add_span_cat_count');
		
	function archives_add_span_cat_count($link_html) {
		$link_html = str_replace('</a>', '</a><span class="post-count">', $link_html);
		$link_html = str_replace('</li>', '</span></li>', $link_html);
		return $link_html;
	}	
	add_filter('get_archives_link', 'archives_add_span_cat_count');	
	
	add_action( 'widgets_init', 'my_unregister_widgets' );
	
	function my_unregister_widgets() {
		unregister_widget( 'WP_Widget_Recent_Comments' );
	}
	
	add_editor_style('style.css');
	add_editor_style('css/main-theme-light.css');
	add_editor_style('css/skin.php');	
	add_editor_style('css/editor.css');
	
	function remove_wpcf7_stylesheet() {
		remove_action( 'wp_print_styles', 'wpcf7_enqueue_styles' );
	}
	add_action( 'init' , 'remove_wpcf7_stylesheet' );
	
	add_filter('wpcf7_ajax_loader', 'my_wpcf7_ajax_loader');
	function my_wpcf7_ajax_loader () {
		return  get_stylesheet_directory_uri(). '/images/main-theme-light/contact-loader.gif';
	}	
		
	$dt_FullWidthLoader = get_option('dt_FullWidthLoader','no');
	if ( $dt_FullWidthLoader == 'yes' )
	{	
		add_filter('body_class','load_body_class');
		function load_body_class($classes = '') {
			$classes[] = 'loader-active';
			return $classes;
		}
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//PORTFOLIO ICONS

	add_action('admin_head', 'plugin_header');
	function plugin_header() {
			global $post_type;
		?>
		<style>
		#adminmenu #menu-posts-project .wp-menu-image img {display:none;}
		#adminmenu #menu-posts-project div.wp-menu-image{background:transparent url("<?php echo get_template_directory_uri().'/includes/duotive-admin/ico-portfolio.png';?>") no-repeat 9px 9px;}		
		#adminmenu #menu-posts-project:hover div.wp-menu-image,#adminmenu #menu-posts-project .wp-has-current-submenu div.wp-menu-image{background:transparent url("<?php echo get_template_directory_uri().'/includes/duotive-admin/ico-portfolio.png';?>") no-repeat 9px -91px;}			
		<?php if (($_GET['post_type'] == 'project') || ($post_type == 'project')) : ?>
		#icon-edit { background:transparent url('<?php echo get_template_directory_uri().'/includes/duotive-admin/ico-portfolio-page.png';?>') no-repeat; }		
		<?php endif; ?>
		</style>
		<?php
	}	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//REMOVE CAPTION MARGINS FROM WORDPRESS
	
	class fixImageMargins{
		public $xs = 0; //change this to change the amount of extra spacing
	
		public function __construct(){
			add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
		}
		public function fixme($x=null, $attr, $content){
	
			extract(shortcode_atts(array(
					'id'    => '',
					'align'    => 'alignnone',
					'width'    => '',
					'caption' => ''
				), $attr));
	
			if ( 1 > (int) $width || empty($caption) ) {
				return $content;
			}
	
			if ( $id ) $id = 'id="' . $id . '" ';
	
		return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + $this->xs) . 'px">'
		. $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
		}
	}
	$fixImageMargins = new fixImageMargins();	
?>
<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/theme-functions.php
 * @file	 	1.2
 *
 *	1. Content
 * 	1.1	Sets the post excerpt length to 40 words
 * 	1.2	Adds a custom "Continue Reading" link to excerpts
 * 	1.3	Disable jump in "read more" link
 *  1.4 Comments layout
 *  1.5 Ajaxify comments
 *
 *	2. Images
 * 	2.1	Get featured image link
 * 	2.2	Remove extra margin - wp-caption
 *  2.3 Remove <p> around images
 *  2.4	Remove height/width attributes on images for responsivity
 *  2.5 Get attachment file
 *
 *	3. Navigation
 * 	3.1	Test if there are more pages for navigation
 * 	3.2	Previous/Next Posts Link
 *  3.3 Walker class for menu
 *  3.4 Any previous/next post link by id
 *  3.5 Numeric page navigation
 *  3.6 Rewrite search results permalink
 *  3.7 Default navigation
 *
 *	4. Various
 * 	4.1	Add the sidebar class to body class
 *  4.2	Better tag cloud widget
 *  4.3	Layout/modules
 *	4.4 Clean up the header
 *	4.5 RSS Url
 *	4.6 Admin redirect
 *	4.7 Custom posts query
 *	4.8 Custom portfolio query
 *  4.9 Check if plugin is active
 *  4.10 Check if post has embedded content
 *  4.11 Generate slug from name
 *  4.12 Read files from directory
 *  4.13 Check if is print version
 *  4.14 Custom products query
 *  4.15 Add browser detection to body class
 *
 */
?>
<?php

/**
 * ------------------------------------------------------------------------
 * 1.	Content
 * ------------------------------------------------------------------------
 */
    /*-------------------------------------
    //  1.1	Sets the post excerpt length to
    //		40 words.
    ---------------------------------------*/
	if ( ! function_exists( 'custom_excerpt_length' ) ) {
		function custom_excerpt_length( $length ) {
			global $data, $prefix;
			if($data[$prefix.'default_content_size']!="") {
				return $data[$prefix.'default_content_size'];
			} else {
				return 20;
			}
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	}

    /*-------------------------------------
    //  1.2	Adds a custom "Continue reading"
    //		link to excerpts
    ---------------------------------------*/
    if ( ! function_exists( 'new_excerpt_more' ) ) {
		function new_excerpt_more() {
		    global $post, $data, $prefix;
			$more=$data[$prefix."default_content_readmore"]!="" ? $data[$prefix."default_content_readmore"] : "Read More";
			return ' ... &nbsp;<a class="readmore" href="'. get_permalink($post->ID) . '">'. $more.'</a><br />';
		}
		add_filter('excerpt_more', 'new_excerpt_more');
	}

    /*-------------------------------------
    //  1.3	Disable jump in "read more" link
    ---------------------------------------*/
	if ( ! function_exists( 'remove_more_jump_link' ) ) {
		function remove_more_jump_link($link) {
			$offset = strpos($link, '#more-');
			if ($offset) {
				$end = strpos($link, '"',$offset);
			}
			if ($end) {
				$link = substr_replace($link, '', $offset, $end-$offset);
			}
			return $link;
		}
		add_filter('the_content_more_link', 'remove_more_jump_link');
	}

    /*-------------------------------------
    //  1.4	Comments layout
    ---------------------------------------*/
	if ( ! function_exists( 'prostore_comments' ) ) {
		function prostore_comments($comment, $args, $depth) {
		   $GLOBALS['comment'] = $comment; ?>

		   <li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
				<div id="comment-<?php comment_ID(); ?>" class="comment_container clearfix">

					<?php echo get_avatar( $GLOBALS['comment'], $size='64' ); ?>

					<div class="comment-text clearfix">

						<?php if ($GLOBALS['comment']->comment_approved == '0') : ?>
							<p class="meta label alert" style="color:#fff"><em><?php _e('Your comment is awaiting approval', 'woocommerce'); ?></em></p>

						<?php else : ?>
							<p class="meta">
								<strong itemprop="author">Posted by <?php comment_author(); ?></strong> on <time itemprop="datePublished" time datetime="<?php echo get_comment_date('c'); ?>"><?php echo get_comment_date(__('M jS Y', 'woocommerce')); ?></time>:
							</p>
						<?php endif; ?>

						<div itemprop="description clearfix" class="description"><?php comment_text(); ?></div>

						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
					</div>
				</div>
		     <!-- </li> is added by wordpress automatically -->
		<?php
		} // don't remove this bracket!
	}

	if ( ! function_exists( 'add_class_comments' ) ) {
		// Add grid classes to comments
		function add_class_comments($classes){
		    array_push($classes, "twelve", "columns");
		    return $classes;
		}
		add_filter('comment_class', 'add_class_comments');
	}
    /*-------------------------------------
    //  1.5	Ajaxify comments
    ---------------------------------------*/
	add_action('comment_post', 'ajaxify_comments',20, 2);
	if ( ! function_exists( 'ajaxify_comments' ) ) {
		function ajaxify_comments($comment_ID, $comment_status){
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			//If AJAX Request Then
				switch($comment_status){
					case '0':
					//notify moderator of unapproved comment
						wp_notify_moderator($comment_ID);
						break;
					case '1': //Approved comment
						echo "success";
						$commentdata=&get_comment($comment_ID, ARRAY_A);
						$post=&get_post($commentdata['comment_post_ID']);
						wp_notify_postauthor($comment_ID, $commentdata['comment_type']);
						break;
					default:
						echo "error";
						break;
				}
			exit;
			}
		}
	}

/**
 * ------------------------------------------------------------------------
 * 2.	Images
 * ------------------------------------------------------------------------
 */
    /*-------------------------------------
    //  2.1	Get featured image link
    ---------------------------------------*/
    if ( ! function_exists( 'featured_image_link_portf' ) ) {
		function featured_image_link_portf ($ID) {
			$image_id = get_post_thumbnail_id($ID, 'featured');
			$image_url = wp_get_attachment_image_src($image_id,'featured');
			$image_url = $image_url[0];
			return $image_url;
		}
	}
    if ( ! function_exists( 'featured_image_link_relatedp' ) ) {
		function featured_image_link_relatedp ($ID) {
			$image_id = get_post_thumbnail_id($ID, 'relatedp');
			$image_url = wp_get_attachment_image_src($image_id,'relatedp');
			$image_url = $image_url[0];
			return $image_url;
		}
	}

    /*-------------------------------------
    //  2.2	Remove extra magin - wp-caption
    ---------------------------------------*/
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

    /*-------------------------------------
    //  2.3	Remove <p> around images
    ---------------------------------------*/
	if ( ! function_exists( 'img_unautop' ) ) {
		// img unautop, Courtesy of Interconnectit http://interconnectit.com/2175/how-to-remove-p-tags-from-images-in-wordpress/
		function img_unautop($pee) {
		    $pee = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<figure>$1</figure>', $pee);
		    return $pee;
		}
		add_filter( 'the_content', 'img_unautop', 30 );
	}

    /*-------------------------------------
    //  2.4	Remove height/width attributes
    //		on images for responsivity
    ---------------------------------------*/
	if ( ! function_exists( 'remove_thumbnail_dimensions' ) ) {
		add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
		add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
		function remove_thumbnail_dimensions( $html ) {
	    	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		    return $html;
		}
	}

	/*-------------------------------------
    //  2.5 Get attachment file
    ---------------------------------------*/
	if ( !function_exists( 'wp_get_attachment' ) ) {
		function wp_get_attachment( $attachment_id ) {
			$attachment = get_post( $attachment_id );
			return array(
				'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
				'caption' => $attachment->post_excerpt,
				'description' => $attachment->post_content,
				'href' => get_permalink( $attachment->ID ),
				'src' => $attachment->guid,
				'title' => $attachment->post_title
			);
		}
	}

/**
 * ------------------------------------------------------------------------
 * 3.	Navigation
 * ------------------------------------------------------------------------
 */
    /*-------------------------------------
    //  3.1	Test if there are more pages
    //		for navigation
    ---------------------------------------*/
    if ( ! function_exists( 'show_posts_nav' ) ) {
		function show_posts_nav() {
			global $wp_query;
			return ($wp_query->max_num_pages > 1);
		}
	}

    /*-------------------------------------
    //  3.2	Previous/Next Posts Link
    ---------------------------------------*/
	if (!function_exists('get_previous_post_link')) {
		function get_previous_post_link($label1, $label2, $label3)
		{
			ob_start();
			previous_post_link($label1, $label2, $label3);
			return ob_get_clean();
		}
	}

	if (!function_exists('get_next_post_link')) {
		function get_next_post_link($label1, $label2, $label3)
		{
			ob_start();
			next_post_link($label1, $label2, $label3);
			return ob_get_clean();
		}
	}

	/*--------------------------------------
	//  3.3 Walker class for menu
	----------------------------------------*/
/*
	if ( ! function_exists( 'custom_wp_nav_menu' ) ) {
		// change the standard class that wordpress puts on the active menu item in the nav bar
		//Deletes all CSS classes and id's, except for those listed in the array below
		function custom_wp_nav_menu($var) {
		        return is_array($var) ? array_intersect($var, array(
		                //List of allowed menu classes
		                'current_page_item',
		                'current_page_parent',
		                'current_page_ancestor',
		                'first',
		                'last',
		                'vertical',
		                'horizontal'
		                )
		        ) : '';
		}
		add_filter('nav_menu_css_class', 'custom_wp_nav_menu');
		add_filter('nav_menu_item_id', 'custom_wp_nav_menu');
		add_filter('page_css_class', 'custom_wp_nav_menu');
	}
*/

	if ( ! function_exists( 'current_to_active' ) ) {
		//Replaces "current-menu-item" with "active"
	    function current_to_active($text){
		        $replace = array(
		                //List of menu item classes that should be changed to "active"
		                'current_page_item' => 'active',
		                'current_page_parent' => 'active',
		                'current_page_ancestor' => 'active',
		        );
		        $text = str_replace(array_keys($replace), $replace, $text);
		                return $text;
		        }
		add_filter ('wp_nav_menu','current_to_active');
	}

	if ( ! function_exists( 'strip_empty_classes' ) ) {
		//Deletes empty classes and removes the sub menu class
		function strip_empty_classes($menu) {
		    $menu = preg_replace('/ class=""| class="sub-menu"/','',$menu);
		    return $menu;
		}
		add_filter ('wp_nav_menu','strip_empty_classes');
	}

	// add the 'has-flyout' class to any li's that have children and add the arrows to li's with children
	class description_walker extends Walker_Nav_Menu
	{
	      function start_el(&$output, $item, $depth, $args)
	      {
	            global $wp_query;
	            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

	            $class_names = $value = '';

	            // If the item has children, add the dropdown class for foundation
	            if ( $args->has_children ) {
	                $class_names = "has-flyout ";
	            }

	            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

	            $class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	            $class_names = ' class="'. esc_attr( $class_names ) . '"';

	            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

	            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	            // if the item has children add these two attributes to the anchor tag
	            // if ( $args->has_children ) {
	            //     $attributes .= 'class="dropdown-toggle" data-toggle="dropdown"';
	            // }

	            $item_output = $args->before;
	            $item_output .= '<a'. $attributes .'>';
	            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
	            $item_output .= $args->link_after;
	            // if the item has children add the caret just before closing the anchor tag
	            if ( $args->has_children ) {
	            	if($item->menu_item_parent!="0") {
	            		$caret_icon = "icon-right-open";
	            	} else {
					if (stripos($_SERVER['HTTP_USER_AGENT'], "msie")) {
					$caret_icon = "icon-down";
 } else {
	            		$caret_icon = "icon-down-open";
}
        	}
	                $item_output .= '</a><a href="#" class="flyout-toggle"><em class="'.$caret_icon.'"></em></a>';
	            }
	            else{
	                $item_output .= '</a>';
	            }
	            $item_output .= $args->after;

	            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	            }

	        function start_lvl(&$output, $depth) {
	            $indent = str_repeat("\t", $depth);
	            $output .= "\n$indent<ul class=\"flyout\">\n";
	        }

	        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
	            {
	                $id_field = $this->db_fields['id'];
	                if ( is_object( $args[0] ) ) {
	                    $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
	                }
	                return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	            }
	}

	// Walker class to customize helper menu links
	class helper_menu_walker extends Walker_Nav_Menu
	{
		/**
		 * Start the element output.
		 *
		 * @param  string $output Passed by reference. Used to append additional content.
		 * @param  object $item   Menu item data object.
		 * @param  int $depth     Depth of menu item. May be used for padding.
		 * @param  array $args    Additional strings.
		 * @return void
		 */
		public function start_el( &$output, $item, $depth, $args )
		{
			$output     .= '<li class="show-for-custom-bp">';
			$attributes  = '';

			! empty ( $item->attr_title )
				// Avoid redundant titles
				and $item->attr_title !== $item->title
				and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';

			! empty ( $item->url )
				and $attributes .= ' href="' . esc_attr( $item->url ) .'"';

			$attributes  = trim( $attributes );
			$title       = apply_filters( 'the_title', $item->title, $item->ID );
			$item_output = "$args->before<a $attributes>$args->link_before$title</a>"
							. "$args->link_after$args->after";

			// Since $output is called by reference we don't need to return anything.
			$output .= apply_filters(
				'walker_nav_menu_start_el'
				,   $item_output
				,   $item
				,   $depth
				,   $args
			);
		}
	}

	// Walker class to customize footer links
	class footer_links_walker extends Walker_Nav_Menu
	{
	      function start_el(&$output, $item, $depth, $args)
	      {
	            global $wp_query;
	            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

	            $class_names = $value = '';

	            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

	            $class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	            $class_names = ' class="'. esc_attr( $class_names ) . '"';

	            $output .= $indent . '<li ' . $value . $class_names .'>';

	            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

	            $item_output = $args->before;
	            $item_output .= '<a'. $attributes .'>';
	            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
	            $item_output .= $args->link_after;

	            $item_output .= '</a>';
	            $item_output .= $args->after;

	            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	            }

	        function start_lvl(&$output, $depth) {
	            $indent = str_repeat("\t", $depth);
	            $output .= "\n$indent<ul class=\"flyout\">\n";
	        }

	        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
	            {
	                $id_field = $this->db_fields['id'];
	                if ( is_object( $args[0] ) ) {
	                    $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
	                }
	                return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	            }
	}

	if($data[$prefix."header_menu_search"]=="1") {
    	if ( ! function_exists( 'nav_search_icon' ) ) {
			add_filter( 'wp_nav_menu_items', 'nav_search_icon', 10, 2 );
			function nav_search_icon ( $items, $args ) {
			    if ($args->theme_location == 'main_nav') {
			    	global $data, $prefix;
					$search_icon = '<li class="search show-for-custom-bp"><a href="#">';
			 		if($data[$prefix."header_menu_search_icon"]=="1" && !empty($data[$prefix."header_menu_search_text"])) {
						$search_icon .= $data[$prefix."header_menu_search_text"];
					} else {
			 			$search_icon .= '<em class="icon-search icon-white"></em>';
					}
					$search_icon .= '</a></li>';
					$items = $items . $search_icon;
			    }
			    return $items;
			}
		}
	}

	if($data[$prefix."header_menu_home"]=="1") {
    	if ( ! function_exists( 'nav_home_icon' ) ) {
			add_filter( 'wp_nav_menu_items', 'nav_home_icon', 10, 2 );
			function nav_home_icon($items, $args) {
				if($args->theme_location == 'main_nav') {
			    	global $data, $prefix;
			 		$home_icon = '<li class="home"><a href="' . home_url( '/' ) . '" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'">';
			 		if($data[$prefix."header_menu_home_icon"]=="1" && !empty($data[$prefix."header_menu_home_text"])) {
						$home_icon .= $data[$prefix."header_menu_home_text"];
					} else {
			 			$home_icon .= '<em class="icon-home hide-for-small"></em> <span class="show-for-small">Home</span>';
					}
			 		$home_icon .= '</a></li>';
			 		$items = $home_icon . $items;
			 	}
			 	return $items;
			}
		}
	}

	if ( ! function_exists( 'prostore_main_nav' ) ) {
		function prostore_main_nav($menu_class,$menu_id) {
			// display the wp3 menu if available
		    wp_nav_menu(
		    	array(
		    		'menu' => 'main_nav', /* menu name */
		    		'menu_class' => $menu_class,
		    		'menu_id'=>$menu_id,
		    		'theme_location' => 'main_nav', /* where in the theme it's assigned */
		    		'container' => 'false', /* container tag */
		    		'fallback_cb' => 'prostore_main_nav_fallback', /* menu fallback */
		    		'depth' => '3',
		    		'walker' => new description_walker()
		    	)
		    );
		}
	}

	if ( ! function_exists( 'prostore_mobile_nav' ) ) {
		function prostore_mobile_nav() {
			// display the wp3 menu if available
		    wp_nav_menu(
		    	array(
		    		'menu' => 'mobile_nav', /* menu name */
		    		'menu_class' => 'side-nav tabs vertical',
		    		'theme_location' => 'main_nav', /* where in the theme it's assigned */
		    		'container_class' => 'mobile-nav-container', /* container tag */
		    		'fallback_cb' => 'prostore_main_nav_fallback', /* menu fallback */
		    		'depth' => '1'
		    	)
		    );
		}
	}

	if ( ! function_exists( 'prostore_footer_links' ) ) {
		function prostore_footer_links() {
			// display the wp3 menu if available
		    wp_nav_menu(
		    	array(
		    		'menu' => 'footer_links', /* menu name */
		    		'menu_class' => 'link-list',
		    		'theme_location' => 'footer_links', /* where in the theme it's assigned */
		    		'container_class' => 'footer-links clearfix', /* container class */
		    		'fallback_cb' => 'prostore_footer_links_fallback', /* menu fallback */
		    		'walker' => new footer_links_walker(),
		    		'depth' => '1'
		    	)
			);
		}
	}

	// this is the fallback for header menu

	if ( ! function_exists( 'prostore_main_nav_fallback' ) ) {
		function prostore_main_nav_fallback() {  }
	}

	// this is the fallback for footer menu
	if ( ! function_exists( 'prostore_footer_links_fallback' ) ) {
		function prostore_footer_links_fallback() {
			/* you can put a default here if you like */
		}
	}

    /*-------------------------------------
    //  3.4	Any previous/next post link by id
    ---------------------------------------*/
    if ( ! function_exists( 'get_next_post_id' ) ) {
		function get_next_post_id( $post_id ) {
		    global $post;
		    $oldGlobal = $post;
		    $post = get_post( $post_id );
		    $previous_post = get_previous_post();
		    $post = $oldGlobal;
		    if ( '' == $previous_post ) { return 0; }
		    return $previous_post->ID;
		}
	}
    if ( ! function_exists( 'get_previous_post_id' ) ) {
		function get_previous_post_id( $post_id ) {
		    global $post;
		    $oldGlobal = $post;
		    $post = get_post( $post_id );
		    $next_post = get_next_post();
		    $post = $oldGlobal;
		    if ( '' == $next_post ) { return 0; }
		    return $next_post->ID;
		}
	}

    /*-------------------------------------
    //  3.5	Numeric page navigation
    ---------------------------------------*/
    if ( ! function_exists( 'page_navi' ) ) {
		function page_navi($before = '', $after = '') {
			global $wpdb, $wp_query;
			$request = $wp_query->request;
			$posts_per_page = intval(get_query_var('posts_per_page'));
			$paged = intval(get_query_var('paged'));
			$numposts = $wp_query->found_posts;
			$max_page = $wp_query->max_num_pages;
			if ( $numposts <= $posts_per_page ) { return; }
			if(empty($paged) || $paged == 0) {
				$paged = 1;
			}
			$pages_to_show = 4;
			$pages_to_show_minus_1 = $pages_to_show-1;
			$half_page_start = floor($pages_to_show_minus_1/2);
			$half_page_end = ceil($pages_to_show_minus_1/2);
			$start_page = $paged - $half_page_start;
			if($start_page <= 0) {
				$start_page = 1;
			}
			$end_page = $paged + $half_page_end;
			if(($end_page - $start_page) != $pages_to_show_minus_1) {
				$end_page = $start_page + $pages_to_show_minus_1;
			}
			if($end_page > $max_page) {
				$start_page = $max_page - $pages_to_show_minus_1;
				$end_page = $max_page;
			}
			if($start_page <= 0) {
				$start_page = 1;
			}

			echo $before.'<ul class="pagination clearfix">'."";

			if ($paged > 1) {
				echo '<li class="first"><a href="'.get_pagenum_link().'" title="First"><em class="icon-left"></em></a></li>';
			}
			echo '<li class="prev">';
			previous_posts_link('<em class="icon-left-open"></em>');
			echo '</li>';

			for($i = $start_page; $i  <= $end_page; $i++) {
				if($i == $paged) {
					echo '<li class="current"><a>'.$i.'</a></li>';
				} else {
					echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
				}
			}
			echo '<li class="next">';
			next_posts_link('<em class="icon-right-open"></em>');
			echo '</li>';
			if ($end_page < $max_page) {
				$last_page_text = "&raquo;";
				echo '<li class="last"><a href="'.get_pagenum_link($max_page).'" title="Last"><em class="icon-right"></em></a></li>';
			}
			echo '</ul>'.$after."";
		}
	}

    /*-------------------------------------
    //  3.6	Rewrite search results permalinks
    ---------------------------------------*/
    if ( ! function_exists( 'search_url_rewrite_rule' ) ) {
		function search_url_rewrite_rule() {
			if ( is_search() && !empty($_GET['s']) && empty($_GET['post_type'])) {
				$search_query=$_GET['s'];
				wp_redirect(home_url("/search/").urlencode($search_query));
				exit();
			}
		}
		add_action('template_redirect', 'search_url_rewrite_rule');
	}

    /*-------------------------------------
    //  3.7 Default navigation
    ---------------------------------------*/
    if ( ! function_exists( 'default_nav' ) ) {
    	function default_nav() {
    	?>
			<nav class="wp-prev-next">
				<ul class="block-grid two-up clearfix">
					<li class="next-link"><?php previous_posts_link(); ?></li>
					<li class="prev-link text-right"><?php next_posts_link(); ?></li>
				</ul>
			</nav>
    	<?php
    	}
    }

/**
 * ------------------------------------------------------------------------
 * 4.	Various
 * ------------------------------------------------------------------------
 */
	/*-------------------------------------
    //  4.1	Add the sidebar class to body
    //		class
    ---------------------------------------*/
	add_action('wp_head', create_function("",'ob_start();') );

    if ( ! function_exists( 'my_sidebar_class' ) ) {
		add_action('get_sidebar', 'my_sidebar_class');
		function my_sidebar_class($name=''){
		  static $class="withsidebar";
		  if(!empty($name))$class.=" sidebar-{$name}";
		  my_sidebar_class_replace($class);
		}
	}
    if ( ! function_exists( 'my_sidebar_class_replace' ) ) {
		add_action('wp_footer', 'my_sidebar_class_replace');
		function my_sidebar_class_replace($c=''){
		  static $class='';
		  if(!empty($c)) $class=$c;
		  else {
		    echo str_replace('<body class="','<body class="'.$class.' ',ob_get_clean());
		    ob_start();
		  }
		}
	}

	/*-------------------------------------
    //  4.2	Better Tag Cloud Widget
    ---------------------------------------*/
	// filter tag clould output so that it can be styled by CSS
    if ( ! function_exists( 'add_tag_class' ) ) {
		function add_tag_class( $taglinks ) {
		    $tags = explode('</a>', $taglinks);
		    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";
		        foreach( $tags as $tag ) {
		            $tagn[] = preg_replace($regex, "('$1$2 label radius tag-'.get_tag($2)->slug.'$3')", $tag );
		        }
		    $taglinks = implode('</a>', $tagn);
		    return $taglinks;
		}

		add_action('wp_tag_cloud', 'add_tag_class');
		add_action('product_tag_cloud', 'add_tag_class');
	}

    if ( ! function_exists( 'my_widget_tag_cloud_args' ) ) {
		add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );
		add_filter( 'woocommerce_product_tag_cloud_widget_args', 'my_widget_tag_cloud_args' );

		function my_widget_tag_cloud_args( $args ) {
			$args['number'] = 20; // show less tags
			$args['largest'] = 12; // make largest and smallest the same - i don't like the varying font-size look
			$args['smallest'] = 12;
			$args['unit'] = 'px';
			return $args;
		}
	}

    if ( ! function_exists( 'wp_tag_cloud_filter' ) ) {
		add_filter('wp_tag_cloud','wp_tag_cloud_filter', 10, 2);
		add_filter('product_tag_cloud','wp_tag_cloud_filter', 10, 2);

		function wp_tag_cloud_filter($return, $args) {
		  return '<div id="tag-cloud"><p>'.$return.'</p></div>';
		}
	}

	/*-------------------------------------
    //	4.3 Layouts/Modules
    ---------------------------------------*/
    if ( ! function_exists( 'article_not_found' ) ) {
	    function article_not_found() {
	    ?>
			<article id="post-not-found">
			    <header>
			    	<h1>Not Found</h1>
			    </header>
			    <section class="post_content">
			    	<p>Sorry, but the requested resource was not found on this site.</p>
			    </section>
			    <footer></footer>
			</article>
		<?php
		}
	}

    if ( ! function_exists( 'show_search_form' ) ) {
		function show_search_form($class) {
		?>
			<div class="<?php echo $class; ?>">
				<div class="search_wrapper">
					<div class="icon">
						<div class="two mobile-one columns">
							<label for="search-input" class="right inline"><!--?xml version="1.0" encoding="utf-8"?-->
							<!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->

							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 99.988" enable-background="new 0 0 100 99.988" xml:space="preserve" class="svg-icon">
							<path d="M38.087,76.213c-10.179,0-19.748-3.963-26.945-11.162C-3.714,50.193-3.714,26.017,11.144,11.162
							C18.34,3.963,27.909,0,38.088,0c10.181,0,19.749,3.963,26.944,11.161c7.196,7.197,11.161,16.767,11.161,26.945
							c0,10.178-3.965,19.748-11.161,26.944C57.836,72.249,48.267,76.213,38.087,76.213L38.087,76.213z M38.087,9.927
							c-7.526,0-14.604,2.932-19.927,8.252c-5.323,5.324-8.255,12.399-8.255,19.927s2.932,14.605,8.254,19.929
							c5.323,5.321,12.399,8.252,19.927,8.252c7.529,0,14.604-2.931,19.928-8.252c10.988-10.988,10.988-28.867,0-39.855
							C52.691,12.856,45.615,9.927,38.087,9.927L38.087,9.927z"></path>
							<polygon points="92.257,99.988 99.999,92.248 72.07,64.319 64.329,72.06 "></polygon>
							</svg>
							</label>
						</div>
					</div>
					<?php get_search_form(); ?>
					<span class="press-enter">Press Enter</span>
					<span class="search-close"><em class="icon-cancel-circle"></em></span>
				</div>
			</div>
		<?php
		}
	}

    if ( ! function_exists( 'before_main_content_wrap' ) ) {
    	add_action('before_main_content','before_main_content_wrap',10);
		function before_main_content_wrap() {
			global $data, $prefix, $post;
			if(is_singular('post')) {
				$layout = $data[$prefix."default_layout_post"];
			} elseif(is_singular('page')) {
				$layout = $data[$prefix."default_layout_page"];
			} elseif(is_singular('portfolio')) {
				$layout = $data[$prefix."default_layout_portfolio"];
			} else {
				$layout = $data[$prefix."default_layout"];
			}
			if(is_singular()) {
				$layout = get_post_meta($post->ID,'sidebar_position',true) =="" ? $layout : get_post_meta($post->ID,'sidebar_position',true);
			}
			switch($layout) {
				case "left" :
					$layout_class = "eight push-four"; break;
				case "full" :
					$layout_class = "twelve"; break;
				default :
					$layout_class = "eight"; break;
			}
			?>
			<div class="row container">
				<div id="main" class="<?php echo $layout_class; ?> columns clearfix" role="main">
			<?php
		}
	}

    if ( ! function_exists( 'after_main_content_wrap' ) ) {
    	add_action('after_main_content','after_main_content_wrap',10);
		function after_main_content_wrap() {
			global $data, $prefix, $post;
			if(is_singular('post')) {
				$layout = $data[$prefix."default_layout_post"];
			} elseif(is_singular('page')) {
				$layout = $data[$prefix."default_layout_page"];
			} elseif(is_singular('portfolio')) {
				$layout = $data[$prefix."default_layout_portfolio"];
			} else {
				$layout = $data[$prefix."default_layout"];
			}
			if(is_singular()) {
				$layout = get_post_meta($post->ID,'sidebar_position',true) =="" ? $layout : get_post_meta($post->ID,'sidebar_position',true);
			}
			?>
				</div> <!-- end #main -->
				<?php if($layout != "full") { get_sidebar(); } ?>
			</div> <!-- end .row.container -->
			<?php
		}
	}

    /*-------------------------------------
    //  4.4	Clean up the header
    ---------------------------------------*/
	if ( ! function_exists( 'remove_head_links' ) ) {
		function remove_head_links() {
			global $data, $prefix;
			if($data[$prefix. 'rss_url' ]!="") {
				remove_action( 'wp_head', 'feed_links', 2 );
			}
			if($data[$prefix.'clean_header']=="1") {
				remove_action( 'wp_head', 'feed_links_extra', 3 );
				remove_action( 'wp_head', 'rsd_link' );
				remove_action( 'wp_head', 'wlwmanifest_link' );
				remove_action( 'wp_head', 'index_rel_link' );
				remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
				remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
				remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
				remove_action( 'wp_head', 'wp_generator' );
			}
		}
		add_action('init', 'remove_head_links');
	}
	if($data[$prefix.'clean_header']=="1") {
		remove_action('wp_head', 'wp_generator');
		//function bones_rss_version() { return ''; }
		//add_filter('the_generator', 'bones_rss_version');
	}

	/*-------------------------------------
    //  4.5	RSS Url
    ---------------------------------------*/
    if ( ! function_exists( 'rss_link' ) ) {
		add_filter( 'feed_link', 'rss_link', 10 );
		function rss_link ( $output, $feed = null ) {
			global $data, $prefix;
			$default = get_default_feed();
			if ( ! $feed ) $feed = $default;
			if ( $data[$prefix. 'rss_url' ]!="" && ( $feed == $default ) && ( ! stristr( $output, 'comments' ) ) ) $output = esc_url( $data[ $prefix.'rss_url' ] );
			return $output;
		}
	}

	/*-------------------------------------
    //  4.6	Admin redirect
    ---------------------------------------*/
	if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	    //Call action that sets
	    //add_action('admin_head','ct_option_setup');
	    //Do redirect
	    wp_redirect(admin_url("admin.php?page=optionsframework"));
	}

  	/*-------------------------------------
    //  4.7	Custom posts query
    ---------------------------------------*/
    if ( ! function_exists( 'custom_posts_query' ) ) {
		function custom_posts_query($args,$layout,$pagination) {
			query_posts($args);
			global $data,$prefix,$masonry;
			$masonry = $layout;
			$columns = ($data[$prefix."default_masonry_itemrow"]["two"] >= "2") ? "two" : "one";
			if ( have_posts() ) : ?>
				<section class="blog-<?php echo $masonry; ?> cols-<?php echo $columns; ?>">
					<?php while ( have_posts() ) : the_post();  ?>
						<?php get_template_part( 'library/loop/archive'); ?>
					<?php endwhile; // end of the loop. ?>
				</section>
				<?php if($pagination=="1") { ?>
					<footer>
						<?php get_template_part( 'library/loop/pagination'); ?>
					</footer>
				<?php } ?>
			<?php endif;
			wp_reset_query();
		}
	}

	/*-------------------------------------
    //  4.8	Custom portfolio query
    ---------------------------------------*/
    if ( ! function_exists( 'custom_portfolio_query' ) ) {
		function custom_portfolio_query($args,$layout) {
			query_posts($args);
			global $data,$prefix,$masonry;
			$masonry = $layout;
			if ( have_posts() ) : ?>
				<section class="portfolio-<?php echo $masonry; ?>">
					<?php while ( have_posts() ) : the_post();  ?>
						<?php get_template_part( 'library/loop/portfolio'); ?>
					<?php endwhile; // end of the loop. ?>
				</section>
			<?php endif;
			wp_reset_query();
		}
  	}

	/*-------------------------------------
    //  4.9 Check if plugin is active
    ---------------------------------------*/
	if ( ! function_exists( 'plugin_is_active' ) ) {
		function plugin_is_active($plugin_path) {
    		$return_var = in_array( $plugin_path, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
    		return $return_var = ($return_var == "1" ? "activated" : "inactive");
 		}
 	}

	/*-------------------------------------
    //  4.10 Check if post has embedded content
    ---------------------------------------*/
    if ( ! function_exists( 'has_embed' ) ) {
	 	function has_embed( $post_id = false ) {
			if( !$post_id )
				$post_id = get_the_ID();
			else
				$post_id = absint( $post_id );
			if( !$post_id )
				return false;

			$post_meta = get_post_custom_keys( $post_id );

			if(is_array($post_meta)) {
				foreach( $post_meta as $meta ) {
					if( '_oembed' != substr( trim( $meta ) , 0 , 7 ) )
						continue;
					return true;
				}
			}
			return false;
		}
  	}

	/*-------------------------------------
    //  4.11 Generate slug from name
    ---------------------------------------*/
	if ( ! function_exists( 'generate_slug' ) ) {
		function generate_slug($phrase, $maxLength) {
			$result = strtolower($phrase);
			$result = preg_replace("/[^a-z0-9\s-]/", "", $result);
			$result = trim(preg_replace("/[\s-]+/", " ", $result));
			$result = trim(substr($result, 0, $maxLength));
			$result = preg_replace("/\s/", "-", $result);
			return $result;
		}
	}

	/*-------------------------------------
    //  4.12 Read files from directory
    ---------------------------------------*/
	if ( !function_exists( 'stf_get_files' ) ) {
		function stf_get_files( $directory, $filter = array( "*" ) ){
			$results = array(); // Result array
			$filter = (array) $filter; // Cast to array if string given
			// Open directory
			$handler = opendir( $directory );
			// Loop through files
			while ( $file = readdir($handler) ) {
				// Jump over directories.
				if( is_dir( $file ) )
					continue;
				// Prepare file extension
				$extension = end( explode( ".", $file ) ); // Eg. "jpg"
				// If extension fits add it to array
				if ( $file != "." && $file != ".." && ( in_array( $extension, $filter ) || in_array( "*", $filter ) ) ) {
					$results[] = $file;
				}
			}
			// Close handler
			closedir($handler);
			// Return
			return $results;
		}
	}

	/*-------------------------------------
    //  4.13 Check if is print version
    ---------------------------------------*/
	if ( ! function_exists( 'is_print_version' ) ) {
		function is_printversion() {
			if(!isset($_REQUEST["disp"])) { $_REQUEST["disp"]=""; }
			if ($_REQUEST["disp"] == 'print') {
		    	return true;
		    } else {
		    	return false;
		    }
		}
	}

  	/*-------------------------------------
    //  4.14 Custom products query
    ---------------------------------------*/
	function print_carousel_script($params) {
		if(!$params) return;
?>
		<script type="text/javascript">
			/* Carousel script */
			/* <![CDATA[ */
			jQuery(window).load(function() {
				jQuery("#<?php echo $params[0]; ?>").flexslider({
					animation: "slide",
					animationLoop: false,
					smoothHeight : false,
					slideshow: false,
					itemWidth: 200,
					itemMargin: 0,
					minItems : 1,
					maxItems : <?php echo $params[1]; ?>,
					controlNav : false
				});
			});
		/* ]] */
		</script>
<?php
	}
	add_action( 'wp_footer', 'print_carousel_script' );

    function replace_ul_class($buffer) {
    	$buffer = str_replace( '<ul class="products', '<ul class="products slides', $buffer );
    	$buffer = str_replace( '<li class="product first', '<li class="product', $buffer );
    	$buffer = str_replace( '<li class="product last', '<li class="product', $buffer );
    	return $buffer;
    }

    if ( ! function_exists( 'shortcode_products' ) ) {
		function shortcode_products($args) {
			$defaults = array('type'=>'recent','count'=>'4','carousel'=>'false','title'=>'');
			$args = wp_parse_args($args,$defaults);

			if($args['title']!="") echo '<h5 class="product-cat-title">'.$args['title'].'</h5>';
			echo '<div class="home-products">';
			if($args['carousel'] == "true") {
				$pchID = "slider" . dechex(time()).dechex(mt_rand(1,65535));
				echo '<div class="flexslider product-cat clearfix" id="'.$pchID.'">';
				ob_start('replace_ul_class');
			} else {
				ob_start();
			}
			switch($args['type']) {
				case "recent" :
					echo do_shortcode('[recent_products per_page="'.$args['count'].'"]');
					break;
				case "featured" :
					echo do_shortcode('[featured_products per_page="'.$args['count'].'"]');
					break;
				case "sale" :
					if(plugin_is_active('woocommerce/woocommerce.php')=="activated") {
						echo sc_sale_products(array('per_page'=>$args['count']));
					}
					break;
				case "cat" :
					echo do_shortcode('[product_categories]');
					break;
			}
			ob_end_flush();
			if($args['carousel']=="true") {
				echo '</div>';
				print_carousel_script(array($pchID,'4'));
			}
			echo '</div>';
		}
	}


	if ( function_exists( 'get_taxonomies') ) :
		global $wp_query;
		$taxonomy_obj = $wp_query->get_queried_object();
		if ( ! empty( $taxonomy_obj->name ) && function_exists( 'is_post_type_archive' ) && ! is_post_type_archive() ) :
			$taxonomy_nice_name = $taxonomy_obj->name;
			$term_id = $taxonomy_obj->term_taxonomy_id;
			$taxonomy_short_name = $taxonomy_obj->taxonomy;
			$taxonomy_top_level_items = get_taxonomies(array( 'name' => $taxonomy_short_name), 'objects' );
			$taxonomy_top_level_item = $taxonomy_top_level_items[$taxonomy_short_name]->label;
		elseif ( ! empty( $taxonomy_obj->name ) && function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) :
			$archive_name = $taxonomy_obj->label;
		endif;
	endif;

  	/*-------------------------------------
    //  4.15 Add browser detection to
    //		 body class
    ---------------------------------------*/
	if ( !function_exists( 'browser_body_class' ) ) {
		function browser_body_classes($classes) {
		    // Add our browser class
			global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

			if($is_lynx) $classes[] = 'lynx';
			elseif($is_gecko) $classes[] = 'gecko';
			elseif($is_opera) $classes[] = 'opera';
			elseif($is_NS4) $classes[] = 'ns4';
			elseif($is_safari) $classes[] = 'safari';
			elseif($is_chrome) $classes[] = 'chrome';
			elseif($is_IE){
				$classes[] = 'ie';
				if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version)) $classes[] = 'ie'.$browser_version[1];
			} else $classes[] = 'unknown';

			if($is_iphone) $classes[] = 'iphone';

			// Add the post title
			if( is_singular() ) {
	    		global $post;
	    		array_push( $classes, "{$post->post_type}-{$post->post_name}" );
	    	}

	    	// Add 'prostore'
	    	array_push( $classes, "prostore" );

			return $classes;
		}
	}
	add_filter('body_class','browser_body_classes');
<?php

class TMM_Helper {    

    private static $mce_settings = null;
    private static $qt_settings = null;

    public static function quicktags_settings($qtInit, $editor_id) {
        self::$qt_settings = $qtInit;
        return $qtInit;
    }

    public static function tiny_mce_before_init($mceInit, $editor_id) {
        self::$mce_settings = $mceInit;
        return $mceInit;
    }

    public static function get_qt_init($editor_id) {
        if (!empty(self::$qt_settings)) {
            $options = self::_parse_init(self::$qt_settings);
            $qtInit .= "'$editor_id':{$options},";
            $qtInit = '{' . trim($qtInit, ',') . '}';
        } else {
            $qtInit = '{}';
        }
        return $qtInit;
    }

    public static function get_mce_init($editor_id) {
        if (!empty(self::$mce_settings)) {
            $options = self::_parse_init(self::$mce_settings);
            $mceInit = "'$editor_id':{$options},";
            $mceInit = '{' . trim($mceInit, ',') . '}';
        } else {
            $mceInit = '{}';
        }
        return $mceInit;
    }

    private static function _parse_init($init) {
        $options = '';

        foreach ($init as $k => $v) {
            if (is_bool($v)) {
                $val = $v ? 'true' : 'false';
                $options .= $k . ':' . $val . ',';
                continue;
            } elseif (!empty($v) && is_string($v) && ( ('{' == $v{0} && '}' == $v{strlen($v) - 1}) || ('[' == $v{0} && ']' == $v{strlen($v) - 1}) || preg_match('/^\(?function ?\(/', $v) )) {
                $options .= $k . ':' . $v . ',';
                continue;
            }
            $options .= $k . ':"' . $v . '",';
        }

        return '{' . trim($options, ' ,') . '}';
    }

    public static function setmenu_featured_image() {
        $id = $_REQUEST['id'];
        $response = array();
        $response['img'] = wp_get_attachment_image($id, array(376,186));
        $response['src'] = wp_get_attachment_image_src($id, '');
        wp_die(json_encode($response));
    }

    public static function get_social_buttons_list() {
        return array(
            'twitter' => __('Twitter', 'diplomat'),
            'facebook' => __('Facebook', 'diplomat'),
            'pinterest' => __('Pinterest', 'diplomat'),
            'google+' => __('Google+', 'diplomat'),
            'rss' => __('RSS', 'diplomat')
        );
    }
    public static function folio_get_share_buttons(){
                
        $buttons = array();
        if (TMM::get_option('folio_show_twitter')){
            $buttons[] = 'twitter';
        };
        if (TMM::get_option('folio_show_facebook')){
            $buttons[] = 'facebook';
        };
        if (TMM::get_option('folio_show_google')){
            $buttons[] = 'google+';
        };
        if (TMM::get_option('folio_show_pinterest')){
            $buttons[] = 'pinterest';
        };        
        return $buttons;
    }

    public static function display_share_buttons($style = '', $post_id, $buttons = array(), $place = '', $options = array()) {

        if (count($buttons)==0){
	        $buttons = self::get_social_buttons_list();
        }

        $default_options = array(
            'echo' => true,
            'class' => array(),
            'id' => null,
        );
        $options = wp_parse_args($options, $default_options);

        $class = $options['class'];
        if (!is_array($class)) {
            $class = explode(' ', $class);
        }

        $class[] = 'entry-share';

        // get title
        
        $_post = get_post($post_id);
        $t = isset($_post->post_title) ? $_post->post_title : '';
        

        // get permalink
        $u = get_permalink($post_id);

        $protocol = "http";
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
            $protocol = "https";

        $html = '';

        $html .= '<ul class="social-icons">';

        foreach ($buttons as $key => $button) {
            $classes = array();
            $url = '';
            $desc = $buttons[$key];
            $share_title = _x('share', 'share buttons', 'diplomat');
            $custom = '';

            switch ($key) {
                case 'twitter':

                    $classes[] = 'twitter';
                    $share_title = _x('tweet', 'share buttons', 'diplomat');
                    $url = add_query_arg(array('status' => urlencode($t . ' ' . $u)), $protocol . '://twitter.com/home');
                    break;
	            case 'rss':

		            $classes[] = 'rss';
		            $share_title = _x('rss', 'share buttons', 'diplomat');
		            $url = TMM::get_option('feedburner') ? TMM::get_option('feedburner') : get_bloginfo('rss2_url');
		            break;
                case 'facebook':

                    $url_args = array('s=100', urlencode('p[url]') . '=' . esc_url($u), urlencode('p[title]') . '=' . urlencode($t));
                    if (has_post_thumbnail($post_id)) {
                        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
                        if ($thumbnail) {
                            $url_args[] = urlencode('p[images][0]') . '=' . esc_url($thumbnail[0]);
                        }
                    }

                    $classes[] = 'facebook';                  
                   
                    $url = $protocol . '://www.facebook.com/sharer.php?' . implode('&', $url_args);
                    break;
                case 'google+':

                    $t = str_replace(' ', '+', $t);
                    $classes[] = 'gplus';
                    $url = add_query_arg(array('url' => $u, 'title' => $t), $protocol . '://plus.google.com/share');
                    break;
                case 'pinterest':

                    $url = '//pinterest.com/pin/create/button/';
                    $custom = ' data-pin-config="above" data-pin-do="buttonBookmark"';

                    // if image
                    if (wp_attachment_is_image($post_id)) {
                        $image = wp_get_attachment_image_src($post_id, 'full');

                        if (!empty($image)) {
                            $url = add_query_arg(array(
                                'url' => $u,
                                'media' => $image[0],
                                'description' => $t
                                ), $url
                            );

                            $custom = '';
                        }
                    }

                    $classes[] = 'pinterest';
                    $share_title = _x('pin it', 'share buttons', 'diplomat');

                    break;
            }

            $desc = esc_attr($desc);
            $share_title = esc_attr($share_title);
            $classes_str = esc_attr(implode(' ', $classes));
            $url = esc_url($url);

	        if($url){
		        $share_button = sprintf(
			        '<li class="%1$s"><a href="%2$s" target="_blank" title="%3$s"%5$s>%3$s</a></li>', $classes_str, $url, $desc, $share_title, $custom
		        );

		        $html .= apply_filters('presscore_share_button', $share_button, $button, $classes, $url, $desc, $share_title, $t, $u);
	        }

        }

        $html .= '</ul>';

        if ($options['echo']) {
            echo $html;
        }
        return $html;
    }

    public static function update_nav_menu($menu_id, $menu_item_db_id, $args) {        

        $mega_menu = isset($_POST['menu-item-mega'][$menu_item_db_id]) ? $_POST['menu-item-mega'][$menu_item_db_id] : "";
        if (!empty($mega_menu))
            update_post_meta($menu_item_db_id, 'tmm_mega_menu', $mega_menu);
        
        $hide_title = isset($_POST['hide-title-menu'][$menu_item_db_id]) ? $_POST['hide-title-menu'][$menu_item_db_id] : "";
        if (!empty($hide_title))
            update_post_meta($menu_item_db_id, 'tmm_hide_title_menu', $hide_title);       

        $item_icon = isset($_POST['menu-item-icon'][$menu_item_db_id]) ? $_POST['menu-item-icon'][$menu_item_db_id] : "";
        if (!empty($item_icon))
            update_post_meta($menu_item_db_id, 'tmm_menu_icon', $item_icon);
        
        $item_column = isset($_POST['menu-item-column'][$menu_item_db_id]) ? $_POST['menu-item-column'][$menu_item_db_id] : "";
        if (!empty($item_column))
            update_post_meta($menu_item_db_id, 'tmm_menu_column', $item_column);

        $item_image = isset($_POST['menu-item-image'][$menu_item_db_id]) ? $_POST['menu-item-image'][$menu_item_db_id] : "";
        if (!empty($item_image))
            update_post_meta($menu_item_db_id, 'tmm_menu_image', $item_image);

        $item_content = isset($_POST['menu-item-content'][$menu_item_db_id]) ? $_POST['menu-item-content'][$menu_item_db_id] : "";
        if (!empty($item_content))
            update_post_meta($menu_item_db_id, 'tmm_menu_content', $item_content);        
        
    }
    
    public static function editWalker($className) {
        return 'TMM_Menu_Walker';
    }

    public static $shortcodes_js_links = array();

    public static function get_post_featured_image($post_id, $alias, $show_cap = true) {
        $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'single-post-thumbnail');
        $img_src = $img_src[0];
        $url = self::get_image($img_src, $alias, $show_cap);
        return $url;
    }

    public static function resize_image($img_src, $alias, $show_cap = true) {
        return self::get_image($img_src, $alias, $show_cap);
    }

    public static function get_image($img_src, $alias, $show_cap = true) {
        if (empty($alias)) {
            return $img_src;
        }

        $al = explode('*', $alias);
        $new_img_src = aq_resize($img_src, $al[0], $al[1], true);

        if (!$new_img_src) {
            if ($show_cap) {
                return 'http://placehold.it/' . $al[0] . 'x' . $al[1] . '&amp;text=NO IMAGE';
            }
        }

        return $new_img_src;
    }
    
    public static function blog_classic_alias($type = 'image') {
        $alias = ($type == 'image' ? '745*450' : array(745, 600));
        $has_sidebar = $_REQUEST['sidebar_position'];

        if ($has_sidebar == 'no_sidebar') {
            $alias = ($type == 'image' ? '1130*595' : array(1130, 595));
        }
        return $alias;
    }
    
    public static function blog_medium_alias() {
        $alias = '320*246';
        $has_sidebar = $_REQUEST['sidebar_position'];

        if ($has_sidebar == 'no_sidebar') {
            $alias = '485*244';
        }
        return $alias;
    }    
    
    public static function is_file_url_exists($url) {
        $current_dome_count = substr_count($url, home_url());
        if (!$current_dome_count) {
            return FALSE;
        }
        //***
        $path_array = explode('wp-content', $url);
        if (file_exists(ABSPATH . 'wp-content' . $path_array[1])) {
            return TRUE;
        }

        return FALSE;
    }

    /*
     * Get type of video (vimeo,youtube) and images of site
     */

    public static function get_media_type($source_url) {
        $media_type = 'image';
        //***
        $allows_video_array = array('youtube.com', 'vimeo.com', 'mp4');
        foreach ($allows_video_array as $needle) {
            $count = strpos($source_url, $needle);
            if ($count !== FALSE) {
                $media_type = 'video';
                break;
            }
        }

        return $media_type;
    }
    
//Custom page navigation
    public static function pagenavi($query = null) {
        global $wp_query, $wp_rewrite;
        if (!$query)
            $query = $wp_query;
        $pages = '';
        $max = $query->max_num_pages;
        if (!$current = get_query_var('paged')) {
            $current = 1;
        }

        //$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
        $a['total'] = $max;
        $a['current'] = $current;

        $total = 1; //1 - display the text "Page N of N", 0 - not display
        $a['mid_size'] = 4; //how many links to show on the left and right of the current
        $a['end_size'] = 1; //how many links to show in the beginning and end
        $a['prev_text'] = ''; //text of the "Previous page" link
        $a['next_text'] = ''; //text of the "Next page" link
        $a['prev_next'] = false; //text of the "Next page" link

        echo $pages . paginate_links($a);
    }

    public function add_comment() {
        if (!empty($_REQUEST['comment_content'])) {
            $time = current_time('mysql');
            $user = get_userdata(get_current_user_id());
            $data = array(
                'comment_post_ID' => $_REQUEST['comment_post_ID'],
                'comment_author' => $user->data->user_nicename,
                'comment_author_email' => $user->data->user_email,
                'comment_author_url' => $user->data->user_url,
                'comment_content' => $_REQUEST['comment_content'],
                'comment_parent' => $_REQUEST['comment_parent'],
                'user_id' => $user->data->ID,
                'comment_date' => $time,
            );

            echo wp_insert_comment($data);
        }

        exit;
    }

    public static function get_monts_names($num) {
        $monthes = array(
            0 => __('January', 'diplomat'),
            1 => __('February', 'diplomat'),
            2 => __('March', 'diplomat'),
            3 => __('April', 'diplomat'),
            4 => __('May', 'diplomat'),
            5 => __('June', 'diplomat'),
            6 => __('July', 'diplomat'),
            7 => __('August', 'diplomat'),
            8 => __('September', 'diplomat'),
            9 => __('October', 'diplomat'),
            10 => __('November', 'diplomat'),
            11 => __('December', 'diplomat'),
        );

        return $monthes[$num];
    }

    public static function get_short_monts_names($num) {
        $monthes = array(
            0 => __('jan', 'diplomat'),
            1 => __('feb', 'diplomat'),
            2 => __('mar', 'diplomat'),
            3 => __('apr', 'diplomat'),
            4 => __('may', 'diplomat'),
            5 => __('jun', 'diplomat'),
            6 => __('jul', 'diplomat'),
            7 => __('aug', 'diplomat'),
            8 => __('sep', 'diplomat'),
            9 => __('oct', 'diplomat'),
            10 => __('nov', 'diplomat'),
            11 => __('dec', 'diplomat'),
        );

        return $monthes[$num];
    }

    public static function get_days_of_week($num) {
        $days = array(
            0 => __('Sunday', 'diplomat'),
            1 => __('Monday', 'diplomat'),
            2 => __('Tuesday', 'diplomat'),
            3 => __('Wednesday', 'diplomat'),
            4 => __('Thursday', 'diplomat'),
            5 => __('Friday', 'diplomat'),
            6 => __('Saturday', 'diplomat'),
        );

        return $days[$num];
    }
        
	function get_meta_info() {
		$comments_text = '';

		if (get_comments_number() == 1) {
			$comments_text =  __(' Comment', 'diplomat');
		} else {
			$comments_text =  __(' Comments', 'diplomat');
		}
		$output = '<span class="post-entry-date">' . get_the_date('M d, Y') .' ,</span>';
		$output .= '<span>' . __('by ', 'diplomat') . the_author() . ',</span>';
		$output .= '<span>' . __(' in ', 'diplomat') . get_the_category_list(', ') . ', ' . get_comments_number() . ' ' . $comments_text . '</span>';
		return $output;
	}
    
    public static function already_voted($post_id) {

		// Retrieve post votes IPs
		$meta_IP = get_post_meta($post_id, "voted_IP");

		$voted_IP = array();

		if (!empty($meta_IP[0]))
			$voted_IP = $meta_IP[0];

		// Retrieve current user IP
		$ip = $_SERVER['REMOTE_ADDR'];

		// If user has already voted
		if (in_array($ip, array_keys($voted_IP))) {
			return true;
		} else {
			return false;
		}
	}
    
    public static function get_post_like($post_id) {
        
		$vote_count = (int) get_post_meta($post_id, "votes_count", true);

		$voted = (self::already_voted($post_id)) ? ' voted' : '';

		$output = '<a class="post-like like-qty' . $voted . '" data-post_id="' . $post_id . '" href="#">';
		$output .= '<span class="vote-count">'.$vote_count.'</span>';
		$output .= '</a>';

		return $output;
	}

    public static function get_post_date_link($date){
        $date = explode('.', $date);
        $day = $date[0];
        $month = $date[1];
        $year = $date[2];
        $link = get_day_link( $year, $month, $day );
        return $link;
    }
    
    public static function wrap_styles ($post_id) {
		$wrap_styles = '';
		$bg_page_header = get_post_meta($post_id, 'bg_page_header', true);
		if (!empty($bg_page_header)) {
			$wrap_styles = 'style="background-image: url('. $bg_page_header .')"';
		}
		return $wrap_styles;
	}
    
    public static function db_quotes_shield($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = self::db_quotes_shield($value);
                } else {
                    $value = stripslashes($value);
                    $value = str_replace('\"', '"', $value);
                    $value = str_replace("\'", "'", $value);
                    $data[$key] = $value;
                }
            }
        }

        return $data;
    }

    public static function draw_breadcrumbs() {
	    $breadcrumbs = array();
	    $is_page_for_posts = false;

	    if (is_home() && get_option('page_for_posts')) {
		    $is_page_for_posts = true;
	    }

	    if ( is_single() || is_page() || is_archive() || $is_page_for_posts ) {
		    global $post;

		    /* replace breadcrumbs by custom breadcrumbs */
		    $breadcrumbs_custom_items = apply_filters('tmm_breadcrumbs_custom_items', '');

		    if ($breadcrumbs_custom_items) {
			    echo $breadcrumbs_custom_items;
			    return;
		    }

		    $breadcrumbs[] = array(
			    'href' => home_url(),
			    'text' => __("Home", 'diplomat'),
			    'title' => '',
		    );

		    if (is_category() || is_single() || is_tax()) {

			    if (is_object($post)) {

				    $categories = get_the_category($post->ID);

				    if (!empty($categories)) {
					    $categories = $categories[0];
					    $cat_url = esc_url(get_category_link($categories->term_id));

					    $breadcrumbs[] = array(
						    'href' => $cat_url,
						    'text' => $categories->name,
						    'title' => esc_attr(sprintf(__("View all posts in %s", 'diplomat'), $categories->name)),
					    );
				    } else {
					    $breadcrumbs[] = array(
						    'action' => 'tmm_breadcrumbs_category_item',
					    );
				    }

				    if (is_single()) {
					    $breadcrumbs[] = array(
						    'href' => '',
						    'text' => get_the_title(),
						    'title' => '',
					    );
				    }

				    if (is_tax()) {
					    $breadcrumbs[] = array(
						    'href' => '',
						    'text' => apply_filters('tmm_post_title', get_the_title()),
						    'title' => '',
					    );
				    }
			    }

		    } elseif (is_archive()) {
			    $queried_object = get_queried_object();
			    $text = '';

			    if (is_post_type_archive('post')) {
				    $text = __('Blog Archives', 'diplomat');
			    }

			    if (is_date()) {
				    if (is_day()) {
					    $text = get_the_date();
				    } else if (is_month()) {
					    $text = get_the_date('F Y');
				    } else {
					    $text = get_the_date('Y');
				    }
			    }

			    if (is_object($queried_object)) {

				    if (is_author()) {
					    $text = $queried_object->display_name;
				    }

				    if (is_tag()) {
					    $text = $queried_object->name;
				    }

			    }

			    if ($text) {

				    $breadcrumbs[] = array(
					    'href' => '',
					    'text' => $text,
					    'title' => '',
				    );

			    } else {

				    $breadcrumbs[] = array(
					    'action' => 'tmm_breadcrumbs_archive_item',
				    );

			    }

		    } elseif (is_page() || $is_page_for_posts) {

			    if ($is_page_for_posts) {
				    $post = get_post(get_option('page_for_posts'));
			    }

			    if ($post->post_parent) {
				    $breadcrumbs[] = array(
					    'href' => get_permalink($post->post_parent),
					    'text' => get_the_title($post->post_parent),
					    'title' => '',
				    );
			    }

			    $breadcrumbs[] = array(
				    'href' => '',
				    'text' => get_the_title(),
				    'title' => '',
			    );
		    }

		    $breadcrumbs_count = count($breadcrumbs);

		    foreach ($breadcrumbs as $key => $item) {

			    $output = '';
			    $is_link = true;

			    if ( $key === ($breadcrumbs_count-1) ) {
				    $is_link = false;
			    }

			    if (!empty($item['action'])) {
				    do_action( $item['action'], $is_link );
			    } else {
				    if ($item['href'] && $is_link) {
					    $output .= '<a href="' . esc_url($item['href']) . '" title="' . esc_attr($item['title']) . '">';
				    }

				    $output .= esc_html($item['text']);

				    if ($item['href'] && $is_link) {
					    $output .= '</a>';
				    }

				    $output .= ' ';
			    }

			    echo $output;

		    }

	    } else {
		    wp_nav_menu(array(
			    //'container' => '',
			    'theme_location' => 'primary',
			    'walker' => new SH_BreadCrumbWalker(),
			    'items_wrap' => '<div id="breadcrumb-%1$s" class="%2$s">%3$s</div>'
		    ));
	    }
    }

    public static function get_the_category_list($separator = '', $parents = '', $post_id = false) {
        global $wp_rewrite, $cat;
        if (!is_object_in_taxonomy(get_post_type($post_id), 'category'))
            return apply_filters('the_category', '', $separator, $parents);

        $categories = get_the_category($post_id);
        if (empty($categories))
            return apply_filters('the_category', __('Uncategorized', 'diplomat'), $separator, $parents);

        $rel = ( is_object($wp_rewrite) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

        $thelist = '';
        foreach ($categories as $category) {

            if ($cat == $category->term_id) {
                $thelist .= '&nbsp;' . $category->name;
                break;
            } else {
                $thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_attr(sprintf(__("View all posts in %s", 'diplomat'), $category->name)) . '" ' . $rel . '>' . $category->name . '</a></li>';
            }
        }

        return apply_filters('the_category', $thelist, $separator, $parents);
    }
    
    public static function get_footer_style($page_id){
        $footer_type = get_post_meta($page_id, 'footer_type', true);        
        $output = '';
        switch($footer_type){
            case 'dark':
                $output = 'class="dark-footer"';
                break;
            case 'light':
                $output = 'class="light-footer"';
                break;
            case 'color':
                $color = get_post_meta($page_id, 'footer_color', true);
                $output = 'style="background-color:' .$color . '"';
                break;
            case 'image':
                $image = get_post_meta($page_id, 'footer_image', true);
                $output = 'style="background-image:url(' .$image . ')"';
                break;
            default:
                $output = 'class="dark-footer"';
                break;
        }
        return $output;
    }

    public static function draw_body_bg() {
        $disable_body_bg = TMM::get_option('disable_body_bg');
        if (!$disable_body_bg) {
            $body_pattern = TMM::get_option('body_pattern');
            $body_pattern_custom_color = TMM::get_option('body_pattern_custom_color');
            $body_bg_color_selected = ( !get_theme_mod( 'background_color' ) && !get_background_image() ) ? TMM::get_option('body_bg_color')  : '';
            $body_pattern_selected = (int) TMM::get_option('body_pattern_selected');

            switch ($body_pattern_selected) {
                case 0:
                    return $body_bg_color_selected;
                    break;
                case 1:
                    return "url(" . esc_url($body_pattern) . ") repeat 0 0";
                    break;
                case 2:
                    return "url(" . esc_url($body_pattern) . ") repeat 0 0 " . $body_pattern_custom_color;
                    break;
                default:
                    return "";
                    break;
            }
        }

        return "";
    }
    
    public static function tmm_set_post_views($postID) {
	    $count_key = 'tmm_post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
                add_post_meta($postID, $count_key, '0');
            }else{
                $count++;
                update_post_meta($postID, $count_key, $count);
        }
	}

    public static function page_loader(){
        ?>
        <div class="tmm_loader">

	        <?php get_template_part('header', 'logo'); ?>
                       
            <div class="loader">
                <div id="spinningSquaresG">
                    <div id="spinningSquaresG_1" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_2" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_3" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_4" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_5" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_6" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_7" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_8" class="spinningSquaresG"></div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);

        foreach ($rgb as $key => $color) {
            if ($key > 0)
                echo ',';
            echo $color;
        }
    }

    public static function get_upload_folder() {
        $path = wp_upload_dir();
        $path = $path['basedir'];

        if (!file_exists($path)) {
            mkdir($path, 0775);
        }

        $path = $path . '/thememakers/';
        if (!file_exists($path)) {
            mkdir($path, 0775);
        }

        return $path;
    }

    public static function get_tmp_folder() {
        $path = self::get_upload_folder();
        $path = $path . '/tmp/';
        if (!file_exists($path)) {
            mkdir($path, 0775);
        }

        return $path;
    }

    public static function get_upload_folder_uri() {
        $link = wp_upload_dir();
        return $link['baseurl'] . '/thememakers/';
    }

    public static function get_fontello_icons(){
        $fontello_icons = array(
            'icon-adjust' => __('Icon Adjust', 'diplomat'),
            'icon-anchor' => __('Icon Anchor', 'diplomat'),
            'icon-asterisk' => __('Icon Asterisk', 'diplomat'),
            'icon-barcode' => __('Icon Barcode', 'diplomat'),
            'icon-beaker' => __('Icon Beaker', 'diplomat'),
            'icon-beer' => __('Icon Beer', 'diplomat'),
            'icon-bell' => __('Icon Bell', 'diplomat'),
            'icon-book' => __('Icon Book', 'diplomat'),
            'icon-bookmark-empty' => __('Icon Bookmark Empty', 'diplomat'),
            'icon-bookmark' => __('Icon Bookmark', 'diplomat'),
            'icon-briefcase' => __('Icon Briefcase', 'diplomat'),
            'icon-bullhorn' => __('Icon Bullhorn', 'diplomat'),
            'icon-bullseye' => __('Icon Bullseye', 'diplomat'),
            'icon-calendar-empty' => __('Icon Calendar Empty', 'diplomat'),
            'icon-calendar-inv' => __('Icon Calendar Inv', 'diplomat'),
            'icon-calendar' => __('Icon Calendar', 'diplomat'),
            'icon-camera' => __('Icon Camera', 'diplomat'),
            'icon-certificate' => __('Icon Certificate', 'diplomat'),
            'icon-check-empty' => __('Icon Check Empty', 'diplomat'),
            'icon-check' => __('Icon Check', 'diplomat'),
            'icon-circle' => __('Icon Circle', 'diplomat'),
            'icon-code' => __('Icon Code', 'diplomat'),
            'icon-coffee' => __('Icon Coffee', 'diplomat'),
            'icon-cog' => __('Icon Cog', 'diplomat'),
            'icon-cogs' => __('Icon Cogs', 'diplomat'),
            'icon-comment-alt' => __('Icon Comment Alt', 'diplomat'),
            'icon-comment' => __('Icon Comment', 'diplomat'),
            'icon-credit-card' => __('Icon Credit Card', 'diplomat'),
            'icon-crop' => __('Icon Crop', 'diplomat'),
            'icon-desktop' => __('Icon Desktop', 'diplomat'),
            'icon-download-alt' => __('Icon Download Alt', 'diplomat'),
            'icon-download' => __('Icon Download', 'diplomat'),
            'icon-edit' => __('Icon Edit', 'diplomat'),
            'icon-eraser' => __('Icon Eraser', 'diplomat'),
            'icon-exchange' => __('Icon Exchange', 'diplomat'),
            'icon-exclamation' => __('Icon Exclamation', 'diplomat'),
            'icon-fighter-jet' => __('Icon Fighter Jet', 'diplomat'),
            'icon-filter' => __('Icon Filter', 'diplomat'),
            'icon-fire' => __('Icon Fire', 'diplomat'),
            'icon-flag-checkered' => __('Icon Flag Checkered', 'diplomat'),
            'icon-flag' => __('Icon Flag', 'diplomat'),
            'icon-folder-close' => __('Icon Folder Close', 'diplomat'),
            'icon-folder-open' => __('Icon Folder Open', 'diplomat'),
            'icon-food' => __('Icon Food', 'diplomat'),
            'icon-frown' => __('Icon Frown', 'diplomat'),
            'icon-gamepad' => __('Icon Gamepad', 'diplomat'),
            'icon-gift' => __('Icon Gift', 'diplomat'),
            'icon-glass' => __('Icon Glass', 'diplomat'),
            'icon-globe' => __('Icon Globe', 'diplomat'),
            'icon-globe-6' => __('Icon Globe 6', 'diplomat'),
            'icon-group' => __('Icon Group', 'diplomat'),
            'icon-hdd' => __('Icon Hdd', 'diplomat'),
            'icon-headphones' => __('Icon Headphones', 'diplomat'),
            'icon-heart-empty' => __('Icon Heart Empty', 'diplomat'),
            'icon-heart' => __('Icon Heart', 'diplomat'),
            'icon-home' => __('Icon Home', 'diplomat'),
            'icon-inbox' => __('Icon Inbox', 'diplomat'),
            'icon-info' => __('Icon Info', 'diplomat'),
            'icon-key' => __('Icon Key', 'diplomat'),
            'icon-keyboard' => __('Icon Keyboard', 'diplomat'),
            'icon-laptop' => __('Icon Laptop', 'diplomat'),
            'icon-leaf' => __('Icon Leaf', 'diplomat'),
            'icon-lemon' => __('Icon Lemon', 'diplomat'),
            'icon-level-down' => __('Icon Level Down', 'diplomat'),
            'icon-level-up' => __('Icon Level Up', 'diplomat'),
            'icon-lightbulb' => __('Icon Lightbulb', 'diplomat'),
            'icon-lock' => __('Icon Lock', 'diplomat'),
            'icon-magic' => __('Icon Magic', 'diplomat'),
            'icon-magnet' => __('Icon Magnet', 'diplomat'),
            'icon-meh' => __('Icon Meh', 'diplomat'),
            'icon-megaphone' => __('Icon Megaphone', 'diplomat'),
            'icon-money' => __('Icon Money', 'diplomat'),
            'icon-move' => __('Icon Move', 'diplomat'),
            'icon-music' => __('Icon Music', 'diplomat'),
            'icon-off' => __('Icon Off', 'diplomat'),
            'icon-ok-circle' => __('Icon Ok Circle', 'diplomat'),
            'icon-ok' => __('Icon Ok', 'diplomat'),
            'icon-pencil' => __('Icon Pencil', 'diplomat'),
            'icon-picture' => __('Icon Picture', 'diplomat'),
            'icon-plane' => __('Icon Plane', 'diplomat'),
            'icon-paper-plane-2' => __('Icon Paper Plane 2', 'diplomat'),
            'icon-params' => __('Icon Params', 'diplomat'),
            'icon-pencil-7' => __('Icon Pencil 7', 'diplomat'),
            'icon-plus' => __('Icon Plus', 'diplomat'),
            'icon-print' => __('Icon Print', 'diplomat'),
            'icon-qrcode' => __('Icon Grcode', 'diplomat'),
            'icon-question' => __('Icon Question', 'diplomat'),
            'icon-quote-left' => __('Icon Quote Left', 'diplomat') ,
            'icon-quote-right' => __('Icon Quote Right', 'diplomat'),
            'icon-reply-all' => __('Icon Reply All', 'diplomat'),
            'icon-reply' => __('Icon Reply', 'diplomat'),
            'icon-resize-horizontal' => __('Icon Resize Horizontal', 'diplomat'),
            'icon-resize-vertical' => __('Icon Resize Vertical', 'diplomat'),
            'icon-retweet' => __('Icon Retweet', 'diplomat'),
            'icon-road' => __('Icon Road', 'diplomat'),
            'icon-rocket' => __('Icon Rocket', 'diplomat'),
            'icon-search' => __('Icon Search', 'diplomat'),
            'icon-share' => __('Icon Share', 'diplomat'),
            'icon-shield' => __('Icon Shield', 'diplomat'),
            'icon-signal' => __('Icon Signal', 'diplomat'),
            'icon-sitemap' => __('Icon Sitemap', 'diplomat'),
            'icon-smile' => __('Icon Smile', 'diplomat'),
            'icon-sort-down' => __('Icon Sort Down', 'diplomat'),
            'icon-sort-up' => __('Icon Sort Up', 'diplomat'),
            'icon-sort' => __('Icon Sort', 'diplomat'),
            'icon-spinner' => __('Icon Spinner', 'diplomat'),
            'icon-star-empty' => __('Icon Star Empty', 'diplomat'),
            'icon-star-half' => __('Icon Star Half', 'diplomat'),
            'icon-star' => __('Icon Star', 'diplomat'),
            'icon-tablet' => __('Icon Tablet', 'diplomat'),
            'icon-tag' => __('Icon Tag', 'diplomat'),
            'icon-tags' => __('Icon Tags', 'diplomat'),
            'icon-tasks' => __('Icon Tasks', 'diplomat'),
            'icon-terminal' => __('Icon Terminal', 'diplomat'),
            'icon-thumbs-down' => __('Icon Thumbs Down', 'diplomat'),
            'icon-thumbs-up' => __('Icon Thumbs Up', 'diplomat'),
            'icon-thumbs-up-4' => __('Icon Thumbs Up 4', 'diplomat'),
            'icon-thumbs-up-5' => __('Icon Thumbs Up 5', 'diplomat'),
            'icon-thumbs-up-alt' => __('Icon Thumbs Up Alt', 'diplomat'),
            'icon-ticket' => __('Icon Ticket', 'diplomat'),
            'icon-tint' => __('Icon Tin', 'diplomat'),
            'icon-trash' => __('Icon Trash', 'diplomat'),
            'icon-trophy' => __('Icon Trophy', 'diplomat'),
            'icon-truck' => __('Icon Truck', 'diplomat'),
            'icon-umbrella' => __('Icon Umbrella', 'diplomat'),
            'icon-upload' => __('Icon Upload', 'diplomat'),
            'icon-user-md' => __('Icon User Md', 'diplomat'),
            'icon-user' => __('Icon User', 'diplomat'),
            'icon-volume-down' => __('Icon Volume Down', 'diplomat'),
            'icon-volume-off' => __('Icon Volume Off', 'diplomat'),
            'icon-volume-up' => __('Icon Volume Up', 'diplomat'),
            'icon-wrench' => __('Icon Wrench', 'diplomat'),
            'icon-zoom-in' => __('Icon Zoom In', 'diplomat'),
            'icon-zoom-out' => __('Icon Zoom Out', 'diplomat')
        );
        return $fontello_icons;
    }

    public static function delete_dir($path) {
        try {
            if (is_dir($path)) {
                $it = new RecursiveDirectoryIterator($path);
                $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
                foreach ($files as $file) {
                    if ($file->isDir()) {
                        @rmdir($file->getRealPath());
                    } else {
                        try {
                            @unlink($file->getRealPath());
                        } catch (Exception $e) {
                            echo $e->getCode();
                        }
                    }
                }
                try {
                    @rmdir($path);
                } catch (Exception $e) {
                    echo $e->getCode();
                }
            }
        } catch (Exception $e) {
            echo $e->getCode();
        }
    }

    //ajax
    public static function get_resized_image_url() {
        echo TMM_Helper::resize_image($_REQUEST['imgurl'], $_REQUEST['alias']);
        exit;
    }

    /*
     * recursive copy of folders
     */

    public static function recursive_copy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst, 0775);
        while (false !== ( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if (is_dir($src . '/' . $file)) {
                    self::recursive_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    //ajax
    public static function update_allowed_alias() {
        $data = array();
        parse_str($_REQUEST['values'], $data);
        $data = TMM_Helper::db_quotes_shield($data);
        foreach ($data as $option => $newvalue) {
            if (is_array($newvalue)) {
                self::update_option($option, $newvalue);
            }
        }
    }

    public static function draw_html_option($data) {
        switch ($data['type']) {
            case 'textarea':
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo esc_attr($data['id']); ?>"><?php echo esc_html($data['title']); ?></h4>
                <?php endif; ?>

                <textarea id="<?php echo esc_attr($data['id']); ?>" class="js_shortcode_template_changer data-area" data-shortcode-field="<?php echo esc_attr($data['shortcode_field']); ?>"><?php echo esc_html($data['default_value']); ?></textarea>
                <span class="preset_description"><?php echo esc_html($data['description']); ?></span>
                <?php
                break;
            case 'select':
                if (!isset($data['display'])) {
                    $data['display'] = 1;
                }
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo esc_attr($data['id']); ?>"><?php echo esc_html($data['title']); ?></h4>
                <?php endif; ?>

                <?php if (!empty($data['options'])): ?>
                    <select <?php if ($data['display'] == 0): ?>style="display: none;"<?php endif; ?> class="js_shortcode_template_changer data-select <?php echo esc_attr(@$data['css_classes']); ?>" data-shortcode-field="<?php echo esc_attr($data['shortcode_field']); ?>" id="<?php echo esc_attr($data['id']); ?>">

                    <?php foreach ($data['options'] as $key => $text) : ?>
                            <option <?php if ($data['default_value'] == $key) echo 'selected' ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($text); ?></option>
                    <?php endforeach; ?>

                    </select>
                <?php endif; ?>
                    <?php
                    break;
                case 'text':
                    ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo esc_attr($data['id']); ?>"><?php echo esc_html($data['title']); ?></h4>
                <?php endif; ?>

                <input type="text" value="<?php echo esc_attr($data['default_value']); ?>" class="js_shortcode_template_changer data-input" data-shortcode-field="<?php echo esc_attr($data['shortcode_field']); ?>" id="<?php echo esc_attr($data['id']); ?>" />
                <span class="preset_description"><?php echo esc_html($data['description']); ?></span>
                <?php
                break;
            case 'color':
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo esc_attr($data['id']); ?>"><?php echo esc_html($data['title']); ?></h4>
                <?php endif; ?>

                <input type="text" data-shortcode-field="<?php echo esc_attr($data['shortcode_field']); ?>" value="<?php echo esc_attr($data['default_value']); ?>" class="bg_hex_color text small js_shortcode_template_changer" id="<?php echo esc_attr($data['id']); ?>">
                <div style="background-color: <?php echo $data['default_value'] ?>" class="bgpicker"></div>
                <span class="preset_description"><?php echo esc_html($data['description']); ?></span>
                <?php
                break;
            case 'upload':
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo esc_attr($data['id']); ?>"><?php echo esc_html($data['title']); ?></h4>
                <?php endif; ?>

                <input type="text" id="<?php echo esc_attr($data['id']); ?>" value="<?php echo esc_attr($data['default_value']); ?>" class="js_shortcode_template_changer data-input data-upload <?php echo esc_attr(@$data['css_classes']); ?>" data-shortcode-field="<?php echo esc_attr($data['shortcode_field']); ?>" />
                <a title="" class="button_upload button-primary" href="#">
                <?php esc_attr_e('Upload', 'diplomat'); ?>
                </a>
                <span class="preset_description"><?php echo esc_html($data['description']); ?></span>
                <?php
                break;
            case 'checkbox':
                ?>
                    <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo esc_attr($data['id']); ?>"><?php echo esc_html($data['title']); ?></h4>
                <?php endif; ?>

                <div class="radio-holder">
                    <input <?php if ($data['is_checked']): ?>checked=""<?php endif; ?> type="checkbox" value="<?php if ($data['is_checked']): ?>1<?php else: ?>0<?php endif; ?>" id="<?php echo esc_attr($data['id']); ?>" class="js_shortcode_template_changer js_shortcode_checkbox_self_update data-check" data-shortcode-field="<?php echo esc_attr($data['shortcode_field']); ?>">
                    <label for="<?php echo esc_attr($data['id']); ?>"><span></span><i class="description"><?php echo esc_html($data['description']); ?></i></label>
                    <span class="preset_description"><?php echo esc_html($data['description']); ?></span>
                </div><!--/ .radio-holder-->
                <?php
                break;
            case 'radio':
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo esc_attr($data['id']); ?>"><?php echo esc_html($data['title']); ?></h4>
                <?php endif; ?>

                <div class="radio-holder">
                    <input <?php if ($data['values'][0]['checked'] == 1): ?>checked=""<?php endif; ?> type="radio" name="<?php echo esc_attr($data['name']); ?>" id="<?php echo esc_attr($data['values'][0]['id']); ?>" value="<?php echo esc_attr($data['values'][0]['value']); ?>" class="js_shortcode_radio_self_update" />
                    <label for="<?php echo esc_attr($data['values'][0]['id']); ?>" class="label-form"><span></span><?php echo esc_html($data['values'][0]['title']); ?></label>

                    <input <?php if ($data['values'][1]['checked'] == 1): ?>checked=""<?php endif; ?> type="radio" name="<?php echo esc_attr($data['name']); ?>" id="<?php echo esc_attr($data['values'][1]['id']); ?>" value="<?php echo esc_attr($data['values'][1]['value']); ?>" class="js_shortcode_radio_self_update" />
                    <label for="<?php echo esc_attr($data['values'][1]['id']); ?>" class="label-form"><span></span><?php echo esc_attr($data['values'][1]['title']); ?></label>

                    <input type="hidden" id="<?php echo esc_attr(@$data['hidden_id']); ?>" value="<?php echo esc_attr($data['value']); ?>" class="js_shortcode_template_changer" data-shortcode-field="<?php echo esc_attr($data['shortcode_field']); ?>" />
                </div><!--/ .radio-holder-->
                <span class="preset_description"><?php echo esc_html($data['description']); ?></span>
                <?php
                break;
        }
    }

}

/**
 * Retrieve a post's terms as a list ordered by hierarchy.
 *
 * @param int $post_id Post ID.
 * @param string $taxonomy Taxonomy name.
 * @param string $term_divider Optional. Separate items using this.
 * @param string $reverse Optional. Reverse order of links in string.
 * @return string
 */
class GetTheTermList {

    public function get_the_term_list($post_id, $taxonomy, $term_divider = '/', $reverse = false) {
        $object_terms = wp_get_object_terms($post_id, $taxonomy);
        $parents_assembled_array = array();
        //***
        if (!empty($object_terms)) {
            foreach ($object_terms as $term) {
                $parents_assembled_array[$term->parent][] = $term;
            }
        }
        //***
        $sorting_array = $this->sort_taxonomies_by_parents($parents_assembled_array);
        $term_list = $this->get_the_term_list_links($taxonomy, $sorting_array);
        if ($reverse) {
            $term_list = array_reverse($term_list);
        }
        $result = implode($term_divider, $term_list);

        return $result;
    }

    private function sort_taxonomies_by_parents($data, $parent_id = 0) {
        if (isset($data[$parent_id])) {
            if (!empty($data[$parent_id])) {
                foreach ($data[$parent_id] as $key => $taxonomy_object) {
                    if (isset($data[$taxonomy_object->term_id])) {
                        $data[$parent_id][$key]->childs = $this->sort_taxonomies_by_parents($data, $taxonomy_object->term_id);
                    }
                }

                return $data[$parent_id];
            }
        }

        return array();
    }

    //only for taxonomies. returns array of term links
    private function get_the_term_list_links($taxonomy, $data, $result = array()) {
        if (!empty($data)) {
            foreach ($data as $term) {
                $result[] = '<a rel="tag" href="' . get_term_link($term->slug, $taxonomy) . '">' . $term->name . '</a>';
                if (!empty($term->childs)) {
                    //***
                    $res = $this->get_the_term_list_links($taxonomy, $term->childs, array());
                    if (!empty($res)) {
                        //***
                        foreach ($res as $val) {
                            if (!is_array($val)) {
                                $result[] = $val;
                            }
                        }
                        //***
                    }
                    //***
                }
            }
        }

        return $result;
    }

}

class SH_BreadCrumbWalker extends Walker {

    /**
     * @see Walker::$tree_type
     * @var string
     */
    var $tree_type = array('post_type', 'taxonomy', 'custom');

    /**
     * @see Walker::$db_fields
     * @var array
     */
    var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

    /**
     * delimiter for crumbs
     * @var string
     */
    var $delimiter = '';

    /**
     * @see Walker::start_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {

        //Check if menu item is an ancestor of the current page
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $current_identifiers = array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor');
        $ancestor_of_current = array_intersect($current_identifiers, $classes);


        if ($ancestor_of_current) {
            $title = apply_filters('the_title', $item->title, $item->ID);

            //Preceed with delimter for all but the first item.
            if (0 != $depth)
                $output .= $this->delimiter;

            //Link tag attributes
            $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

            //Add to the HTML output
            $output .= '<a' . $attributes . '>' . $title . '</a>';
        }
    }

}

<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * DFD Friday Components
 */

function dfd_kadabra_excerpt_length( $length ) {
    return 30;
}

function dfd_kadabra_posts_link_attributes_1() {
    return 'class="older"';
}

function dfd_kadabra_posts_link_attributes_2() {
    return 'class="newer"';
}

function dfd_next_page_button($buttons) {
	if (in_array('wp_page', $buttons)) {
		return $buttons;
	}
	
	$pos = array_search('wp_more',$buttons,true);
    if ($pos !== false) {
        $tmp_buttons = array_slice($buttons, 0, $pos+1);
        $tmp_buttons[] = 'wp_page';
        $buttons = array_merge($tmp_buttons, array_slice($buttons, $pos+1));
    }
    return $buttons;
}

function prev_next_post_format_icon($post_id) {
	$post_type_icon = '';
	if (has_post_format('video', $post_id)) {
		$post_type_icon = '<i class="dfd-icon-play_film"></i>';
	} elseif (has_post_format('audio', $post_id)) {
		$post_type_icon = '<i class="dfd-icon-play2"></i>';
	} elseif (has_post_format('gallery', $post_id)) {
		$post_type_icon = '<i class="dfd-icon-photos"></i>';	
	} elseif (has_post_format('quote', $post_id)) {
		$post_type_icon = '<i class="navicon-quote-left"></i>';	
	} else {
		$post_type_icon = '<i class="dfd-icon-document2"></i>';
	}
	return $post_type_icon;
}

/*---------------------------------------------------------
 * Paginate Archive Index Page Links
 ---------------------------------------------------------*/
function dfd_kadabra_pagination() {
    global $portfolio_pagination_type;
	
	if (strcmp($portfolio_pagination_type, '1') === 0) {
		dfd_ajax_pagination();
	} elseif(strcmp($portfolio_pagination_type, '2') === 0) {
		dfd_lazy_load_pagination();
	} else {
		dfd_default_pagination();
	}
}

function dfd_default_pagination() {
	global $wp_query, $dfd_pagination_style;

	$prev_link = $next_link = '';
	if(empty($dfd_pagination_style) || $dfd_pagination_style == '1') {
		$pagination_class = 'dfd-pagination-style-1';
		$prev_link = '<div class="prev-next-links">'. get_previous_posts_link( __('Prev.','dfd') ) . get_next_posts_link( __('Next','dfd') ).'</div>';
	} else {
		$prev_link = '<div class="prev-link">'. get_previous_posts_link( __('Prev.','dfd') ) .'</div>';
		$next_link = '<div class="next-link">'. get_next_posts_link( __('Next','dfd') ).'</div>';
		$pagination_class = 'dfd-pagination-style-'.$dfd_pagination_style;
	}
	
	$big = 999999999; // This needs to be an unlikely integer

    // For more options and info view the docs for paginate_links()
    // http://codex.wordpress.org/Function_Reference/paginate_links
    $paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'mid_size' => 5,
        'prev_next' => false,
        //'prev_text' => __('Previous', 'dfd'),
        //'next_text' => __('Next', 'dfd'),
        'type' => 'list'
    ) );

    // Display the pagination if more than one page is found
    if ( $paginate_links ) {
        echo '<div class="pagination '.esc_attr($pagination_class).'">';
		echo $prev_link;
        echo $paginate_links;
		echo $next_link;
        echo '</div><!--// end .pagination -->';
    }
}

function dfd_ajax_pagination() {
	global $wp_query;
	
	$max_num_pages = $wp_query->max_num_pages;
	$page = get_query_var('paged');
	$paged = ($page > 1) ? $page : 1;

	wp_localize_script(
		'ajax-pagination',
		'dfd_pagination_data',
		array(
			'startPage' => $paged,
			'maxPages' => $max_num_pages,
			'nextLink' => next_posts($max_num_pages, false),
			'container' => '#portfolio-page > .works-list, #grid-folio, #grid-posts, .dfd-news-layout #main-content .row, .dfd-portfolio-wrap #dfd-portfolio-loop, .dfd-blog-wrap #dfd-blog-loop, .dfd-gallery-wrap #dfd-gallery-loop',
		)
	);
	
	$post_type = get_post_type();
	
	if($post_type == 'post') {
		wp_enqueue_script('js-audio');
		wp_enqueue_style('dfd_zencdn_video_css');
		wp_enqueue_script('dfd_zencdn_video_js');
	}
	
	wp_enqueue_script('ajax-pagination');
	
	echo '<div class="pagination ajax-pagination"><a id="ajax-pagination-load-more" class="button" href="#">'.__('Load more', 'dfd').'</a></div><!--// end .pagination -->';
}
function dfd_lazy_load_pagination() {
	global $wp_query, $dfd_ronneby;
	
	$max_num_pages = $wp_query->max_num_pages;
	$page = get_query_var('paged');
	$paged = ($page > 1) ? $page : 1;

	wp_localize_script(
		'dfd-lazy-load',
		'dfd_pagination_data',
		array(
			'startPage' => $paged,
			'maxPages' => $max_num_pages,
			'nextLink' => next_posts($max_num_pages, false),
			'container' => '#portfolio-page > .works-list, #grid-folio, #grid-posts, .dfd-news-layout #main-content .row, .dfd-portfolio-wrap #dfd-portfolio-loop, .dfd-blog-wrap #dfd-blog-loop, .dfd-gallery-wrap #dfd-gallery-loop',
		)
	);
	
	wp_enqueue_script('dfd-lazy-load');
	
	$lazy_load_pagination_image_html = '';
	
	if(isset($dfd_ronneby['lazy_load_pagination_image']['url']) && !empty($dfd_ronneby['lazy_load_pagination_image']['url'])) {
		$lazy_load_pagination_image_html .= '<img src="'. esc_url($dfd_ronneby['lazy_load_pagination_image']['url']).'" alt="Lazy load image" />';
	}
	
	$post_type = get_post_type();
	
	if($post_type == 'post') {
		wp_enqueue_script('js-audio');
		wp_enqueue_style('dfd_zencdn_video_css');
		wp_enqueue_script('dfd_zencdn_video_js');
	}
	
	echo '<div class="dfd-lazy-load-pop-up box-name">'.$lazy_load_pagination_image_html.'</div><!--// end .pagination -->';
}

function dfd_kadabra_prettyadd ($content) {
	$content = preg_replace("/<a/","<a data-rel=\"prettyPhoto[slides]\"",$content,1);
	return $content;
}

/*---------------------------------------------------------
 * Paginate
 ---------------------------------------------------------*/
function dfd_link_pages() {
	wp_link_pages(array('before' => '<nav class="post-pagination">', 'after' => '</nav>'));
}

/* ----------------------------------------------------------
 *  Search form
 ----------------------------------------------------------*/

function crum_search_form($form) {
	ob_start();
	get_template_part('templates/searchform');
	$form = ob_get_clean();
	
    return $form;
}

add_filter('get_search_form', 'crum_search_form');

/* ----------------------------------------------------------
 *  Login form
 ----------------------------------------------------------*/

function crum_login_form($redirect)
{
    $args = array(
        'redirect' => $redirect, //Your url here
        'form_id' => 'loginform-custom',
		'label_username' => '',
		'label_password' => '',
    );
	
	add_filter('login_form_top', 'crum_login_form_top');
	
	if (class_exists('crum_login_widget')) {
		$args = array(
			'label_log_in' => __('Login on site', 'dfd'),
			'label_lost_password' => __('Remind the password', 'dfd'),
		);
		
		$crum_login_widget = new crum_login_widget();
		
		$crum_login_widget->wp_login_form($args);
	} else {
		wp_login_form($args);
	}
}

function crum_login_form_top() {
	echo '<h3 class="login_form_title">'.esc_html__('Login on site', 'dfd').'</h3>';
}
/* ----------------------------------------------------------
 *  Social networks icons for header and footer
 ----------------------------------------------------------*/

function crum_social_networks($only_show_in_header = false){
	global $dfd_ronneby;
    $social_networks = array(
        "de"=>"Devianart",
        "dg"=>"Digg",
        "dr"=>"Dribbble",
        "db"=>"Dropbox",
        "en"=>"Evernote",
        "fb"=>"Facebook",
        "flk"=>"Flickr",
        "fs"=>"Foursquare",
        "gp"=>"Google +",
        "in"=>"Instagram",
        "lf"=>"Last FM",
        "li"=>"LinkedIN",
        "lj"=>"Livejournal",
        "pi"=>"Picasa",
        "pt"=>"Pinterest",
        "rss"=>"RSS",
        "tu"=>"Tumblr",
        "tw"=>"Twitter",
        "vi"=>"Vimeo",
        //"vk"=>"Vkontakte",
        "wp"=>"Wordpress",
        "yt"=>"YouTube",
        "500px"=>"500px",
        "vb"=>"viewbug",
        "ml"=>"mail",
        "vk2"=>"vkontacte2",
        "xn"=>"xing",
        "sp"=>"spotify",
        "hz"=>"houzz",
        "sk"=>"skype",
        "ss"=>"slideshare",
        "bd"=>"bandcamp",
        "sd"=>"soundcloud",
        "mk"=>"meerkat",
        "ps"=>"periscope",
        "sc"=>"snapchat",
        "tc"=>"thechurch",
        "bh"=>"behance",
        "pp"=>"pinpoint",
        "vd"=>"viadeo",
        "ta"=>"tripadvisor",
    );
    $social_icons = array(
        "de" => "soc_icon-deviantart",
        "dg" => "soc_icon-digg",
        "dr" => "soc_icon-dribbble",
        "db" => "soc_icon-dropbox",
        "en" => "soc_icon-evernote",
        "fb" => "soc_icon-facebook",
        "flk" => "soc_icon-flickr",
        "fs" => "soc_icon-foursquare_2",
        "gp" => "soc_icon-google__x2B_",
        "in" => "soc_icon-instagram",
        "lf" => "soc_icon-last_fm",
        "li" => "soc_icon-linkedin",
        "lj" => "soc_icon-livejournal",
        "pi" => "soc_icon-picasa",
        "pt" => "soc_icon-pinterest",
        "rss" => "soc_icon-rss",
        "tu" => "soc_icon-tumblr",
        "tw" => "soc_icon-twitter-3",
        "vi" => "soc_icon-vimeo",
        //"vk" => "soc_icon-rus-vk-01",
        "wp" => "soc_icon-wordpress",
        "yt" => "soc_icon-youtube",
        "500px" => "dfd-added-font-icon-px-icon",
        "vb" => "dfd-added-font-icon-vb",
        "ml" => "soc_icon-mail",
        "vk2" => "soc_icon-rus-vk-02",
        "xn" => "dfd-added-font-icon-b_Xing-icon_bl",
        "sp" => "dfd-added-font-icon-c_spotify-512-black",
        "hz" => "dfd-added-font-icon-houzz-dark-icon",
        "sk" => "dfd-added-font-icon-skype",
        "ss" => "dfd-added-font-icon-slideshare",
        "bd" => "dfd-added-font-icon-bandcamp-logo",
        "sd" => "dfd-added-font-icon-soundcloud-logo",
        "mk" => "dfd-added-font-icon-Meerkat-color",
        "ps" => "dfd-added-font-icon-periscope-logo",
        "sc" => "dfd-added-font-icon-Snapchat-logo",
        "tc" => "dfd-added-font-icon-the-city",
        "bh" => "soc_icon-behance",
        "pp" => "dfd-added-font-icon-pinpoint",
        "vd" => "dfd-added-font-icon-viadeo",
        "ta" => "dfd-added-font-icon-tripadvisor",
    );

    if ($only_show_in_header){
        foreach($social_networks as $short=>$original) {

            $icon = $social_icons[$short];

            if (isset($dfd_ronneby[$short.'_link']) && $dfd_ronneby[$short.'_link']) {
                $link = $dfd_ronneby[$short.'_link'];
            } else {
				$link = false;
			}
/*
            if ($dfd_ronneby[$short.'_show']) {
                $show = $dfd_ronneby[$short.'_show'];
            } else {
				$show = false;
			}
*/			
            if ( $link && $link!='http://' /*&& $show*/ ) {
                echo '<a href="'.esc_url($link) .'" class="'.esc_attr($short) . ' ' . esc_attr($icon) . '" title="'.esc_attr($original).'" target="_blank"><span class="line-top-left '.esc_attr($icon).'"></span><span class="line-top-center '.esc_attr($icon).'"></span><span class="line-top-right '.esc_attr($icon).'"></span><span class="line-bottom-left '.esc_attr($icon).'"></span><span class="line-bottom-center '.esc_attr($icon).'"></span><span class="line-bottom-right '.esc_attr($icon).'"></span><i class="'.esc_attr($icon).'"></i></a>';
			}
        }

    } else {
        foreach($social_networks as $short=>$original){
            $link = $dfd_ronneby[$short.'_link'];
            $icon = $social_icons[$short];
            if( $link  !='' && $link  !='http://' )
                echo '<a href="'.esc_url($link) .'" class="'.esc_attr($icon).'" title="'.esc_attr($original).'" target="_blank"><span class="line-top-left '.esc_attr($icon).'"></span><span class="line-top-center '.esc_attr($icon).'"></span><span class="line-top-right '.esc_attr($icon).'"></span><span class="line-bottom-left '.esc_attr($icon).'"></span><span class="line-bottom-center '.esc_attr($icon).'"></span><span class="line-bottom-right '.esc_attr($icon).'"></span><i class="'.esc_attr($icon).'"></i></a>';
        }
    }
}

function author_contact_methods() {
	$contactmethods = array();
	$contactmethods['dfd_author_info'] = 'Author Info';
    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['googleplus'] = 'Google Plus';
    $contactmethods['linkedin'] = 'Linked In';
    $contactmethods['youtube'] = 'YouTube';
    $contactmethods['vimeo'] = 'Vimeo';
    $contactmethods['lastfm'] = 'LastFM';
    $contactmethods['tumblr'] = 'Tumblr';
    $contactmethods['skype'] = 'Skype';
    $contactmethods['cr_facebook'] = 'Facebook';
    $contactmethods['deviantart'] = 'Deviantart';
    $contactmethods['vkontakte'] = 'Vkontakte';
    $contactmethods['picasa'] = 'Picasa';
    $contactmethods['pinterest'] = 'Pinterest';
    $contactmethods['wordpress'] = 'Wordpress';
    $contactmethods['instagram'] = 'Instagram';
    $contactmethods['dropbox'] = 'Dropbox';
    $contactmethods['rss'] = 'RSS';
	
	return $contactmethods;
}

function author_social_networks() {
	$options = author_contact_methods();
	
	$social_icons = array(
        "cr_facebook" => "soc_icon-facebook",
        "googleplus" => "soc_icon-google__x2B_",
        "twitter" => "soc_icon-twitter-3",
        "instagram" => "soc_icon-instagram",
        "vimeo" => "soc_icon-vimeo",
        "lastfm" => "soc_icon-last_fm",
        "vkontakte" => "soc_icon-rus-vk-01",
        "youtube" => "soc_icon-youtube",
        "deviantart" => "soc_icon-deviantart",
        "linkedin" => "soc_icon-linkedin",
        "picasa" => "soc_icon-picasa",
        "pinterest" => "soc_icon-pinterest",
        "wordpress" => "soc_icon-wordpress",
        "dropbox" => "soc_icon-dropbox",
        "rss" => "soc_icon-rss",
    );
	
	ob_start();
	
	echo '<div class="widget soc-icons dfd-soc-icons-hover-style-26">';
	
	foreach($social_icons as $option=>$class) {
		$title = $options[$option];
		$link = get_the_author_meta($option);
		
		if (empty($link)) {
			continue;
		}
		
		echo '<a href="'.esc_url($link) .'" class="'.esc_attr($class).'" title="'.esc_attr($title).'"><span class="line-top-left '.esc_attr($class).'"></span><span class="line-top-center '.esc_attr($class).'"></span><span class="line-top-right '.esc_attr($class).'"></span><span class="line-bottom-left '.esc_attr($class).'"></span><span class="line-bottom-center '.esc_attr($class).'"></span><span class="line-bottom-right '.esc_attr($class).'"></span><i class="'.esc_attr($class).'"></i></a>';
	}
	
	echo '</div>';
	
	return ob_get_clean();
}

/* ----------------------------------------------------------
 *  Post vote counter for portfolio items
 ----------------------------------------------------------*/

add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');

function post_like() {
    // Check for nonce security
    $nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');

    if(isset($_POST['post_like']))
    {
        // Retrieve user IP address
        $ip = $_SERVER['REMOTE_ADDR'];
        $post_id = $_POST['post_id'];

        // Get voters'IPs for the current post
        $meta_IP = get_post_meta($post_id, "_voted_IP");
        $voted_IP = (isset($meta_IP[0]))?$meta_IP[0]:false;

        if(!is_array($voted_IP))
            $voted_IP = array();

        // Get votes count for the current post
        $meta_count = get_post_meta($post_id, "_votes_count", true);
		$reset = get_post_meta($post_id, "_votes_count", true);

        // Use has already voted ?
        if(!hasAlreadyVoted($post_id))
        {
            $voted_IP[$ip] = time();

            // Save IP and increase votes count
            update_post_meta($post_id, "_voted_IP", $voted_IP);
            update_post_meta($post_id, "_votes_count", ++$meta_count);

            // Display count (ie jQuery return value)
            echo $meta_count;
		} else {
            echo "already";
			
		}
    }
    exit;
}

function hasAlreadyVoted($post_id)
{
    $timebeforerevote = 60*60;

    // Retrieve post votes IPs
    $meta_IP = get_post_meta($post_id, "_voted_IP");
    $voted_IP = (isset($meta_IP[0])) ? $meta_IP[0] : '';

    if(!is_array($voted_IP))
        $voted_IP = array();

    // Retrieve current user IP
    $ip = $_SERVER['REMOTE_ADDR'];

    // If user has already voted
    if(in_array($ip, array_keys($voted_IP)))
    {
        $time = $voted_IP[$ip];
        $now = time();

        // Compare between current time and vote time
        if(round(($now - $time) / 60) > $timebeforerevote)
            return false;

        return true;
    }

    return false;
}

/**
 * Post Like. Social Share
 * @param integer $post_id Post ID
 * @return string Post like code
 */
function getPostLikeLink($post_id=null) {
	if (!$post_id) {
		global $post;
		
		$post_id = $post->ID;
	}
	
	$reset = get_post_meta($post_id, 'blog_single_reset_counter', true);

	if($reset) {
		update_post_meta($post_id, '_votes_count', 0);
		update_post_meta($post_id, 'blog_single_reset_counter', false);
	}
	
    $vote_count = intval(get_post_meta($post_id, "_votes_count", true));
	//$vote_count .= '&nbsp;'.__('Like(s)', 'dfd');
	
	
//	if ($vote_count > 10) {
//		$vote_count = '10+';
//	}

    $output = '';

    if(hasAlreadyVoted($post_id)) {
        $output .= '<i class="dfd-icon-heart2"></i><span title="'.esc_html__('I like this article', 'dfd').'" class="like alreadyvoted"><span class="count">'.esc_html__($vote_count).'</span></span>';
	} else {
        $output .= '<a class="post-like" href="#" data-post_id="'.esc_attr($post_id).'">
					<i class="dfd-icon-heart2"></i>
					<span class="count">'.esc_html__($vote_count).'</span>
					<span class="like-hover-title">'.esc_html__('Like!','dfd').'</span>
                </a>';
	}

    return $output;
}

/* ----------------------------------------------------------
 *  
 ----------------------------------------------------------*/
function dfd_get_folio_inside_template() {
//	$value = get_post_meta(get_the_id(), 'folio_inside_template', true);
//	if (empty($value)) {
//		$value = 'folio_inside_1';
//	}
	
	$value = 'folio_inside_1';
	
	return $value;
}

function dfd_get_folio_gallery_type() {
	$value = get_post_meta(get_the_id(), 'folio_gallery_type', true);
	if (empty($value)) {
		$value = 'default';
	}
	
	return $value;
}

function dfd_get_folio_description_align() {
	$value = get_post_meta(get_the_id(), 'folio_description_position', true);
	if (empty($value)) {
		$value = 'left';
	}
	
	return $value;
}

function dfd_get_header_style_option() {
	global $post, $dfd_ronneby;

	$headers_avail = array_keys(dfd_headers_type());
	
	if (isset($_POST['header_type']) && !empty($_POST['header_type'])) {
		if ( in_array($_POST['header_type'], $headers_avail) ) {
			return $_POST['header_type'];
		}
	}
	
	if (!empty($post) && is_object($post)) {
		$page_id = $post->ID;
		$selected_header = get_post_meta($page_id, 'dfd_headers_header_style', true);

		if ($selected_header && in_array($selected_header, $headers_avail)) {
			return $selected_header;
		}
	}

	$layouts = array('pages', 'archive', 'single', 'search', '404',);

	switch (true) {
		case is_404(): $layout = '404';
			break;
		case is_search(): $layout = 'search';
			break;
		case is_single(): $layout = 'single';
			break;
		case is_archive(): $layout = 'archive';
			break;
		case is_page(): $layout = 'pages';
			break;
		default:
			$layout = false;
	}

	if (!$layout || !in_array($layout, $layouts)) {
		$layout = $layouts[0];
	}

	if (!isset($dfd_ronneby["{$layout}_head_type"]) || !$dfd_ronneby["{$layout}_head_type"] || !in_array($dfd_ronneby["{$layout}_head_type"], $headers_avail)) {
		return false;
	}

	return $dfd_ronneby["{$layout}_head_type"];
}
/*
function dfd_get_show_top_header() {
	global $post;

	if (!empty($post) && is_object($post)) {
		$page_id = $post->ID;
		
		$selected_show_header_option = get_post_meta($page_id, 'dfd_headers_show_top_header', true);
		$selected_header_variant = !empty($selected_show_header_option) ? $selected_show_header_option : 'on';

		return $selected_header_variant;
	}
}
*/
function dfd_get_header_logo_position() {
	global $post;
	
	$logo_pos_avail = array_keys(dfd_logo_position());
	
	$selected_logo_position = '';
	
	if (isset($_POST['header_logo_position']) && !empty($_POST['header_logo_position'])) {
		if ( in_array($_POST['header_logo_position'], $logo_pos_avail) ) {
			return $_POST['header_logo_position'];
		}
	}

	if (!empty($post) && is_object($post)) {
		$page_id = $post->ID;
		
		$logo_position = get_post_meta($page_id, 'dfd_headers_logo_position', true);
		if(!empty($logo_position)) {
			$selected_logo_position = $logo_position;
		}
	}
	if(empty($selected_logo_position)) {
		$selected_logo_position = 'left';
	}
	
	return $selected_logo_position;
}

function dfd_get_header_menu_position() {
	global $post;
	
	$menu_pos_avail = array_keys(dfd_menu_position());
	
	$selected_menu_position = '';
	
	if (isset($_POST['header_menu_position']) && !empty($_POST['header_menu_position'])) {
		if ( in_array($_POST['header_menu_position'], $menu_pos_avail) ) {
			return $_POST['header_menu_position'];
		}
	}

	if (!empty($post) && is_object($post)) {
		$page_id = $post->ID;
		
		$menu_position = get_post_meta($page_id, 'dfd_headers_menu_position', true);
		if(!empty($menu_position)) {
			$selected_menu_position = $menu_position;
		}
	}
	if(empty($selected_menu_position)) {
		$selected_menu_position = 'top';
	}
	
	return $selected_menu_position;
}

function dfd_get_header_layout() {
	global $dfd_ronneby;
	$available = dfd_header_layouts();
	
	$header_layout = isset($dfd_ronneby['header_layout']) ? $dfd_ronneby['header_layout'] : '';
	
	if (empty($header_layout) || !isset($available[$header_layout])) {
		$available_keys = array_keys($available);
		$header_layout = array_shift($available_keys);
	}
	
	return $header_layout;
}

function dfd_sticky_header_animation() {
	global $dfd_ronneby;
	$available = dfd_sticky_header_animations();
	
	$enable_sticky_header = (!isset($dfd_ronneby['enable_sticky_header']) || strcmp($dfd_ronneby['enable_sticky_header'], 'off') !== 0);
	
	if(!$enable_sticky_header) return 'sticky-header-disabled';
	
	$sticky_header_classes = 'sticky-header-enabled';
	
	$sticky_header_animation = isset($dfd_ronneby['sticky_header_animation']) ? $dfd_ronneby['sticky_header_animation'] : 'simple';
	
	if (empty($sticky_header_animation) || !isset($available[$sticky_header_animation])) {
		$available_keys = array_keys($available);
		$sticky_header_animation = array_shift($available_keys);
	}
	
	$sticky_header_classes .= ' '.$sticky_header_animation;
	
	return $sticky_header_classes;
}

function dfd_get_header_style() {
	global $dfd_ronneby;
	
	$advanced_styles = '';
	
	$head_type = dfd_get_header_style_option();
	$header_layout = dfd_get_header_layout();
	//$show_top_header = dfd_get_show_top_header();
	$header_logo_position = dfd_get_header_logo_position();
	$header_menu_position = dfd_get_header_menu_position();
	$sticky_header_animation = '';
	if($head_type != '5' && $head_type != '8' && $head_type != '11')
		$sticky_header_animation = dfd_sticky_header_animation();
	
	if(isset($dfd_ronneby['extra_header_options']) && $dfd_ronneby['extra_header_options'] == 'on')
		$advanced_styles .= ' dfd-new-headers';
	
	if(isset($dfd_ronneby['highlight_has_submenu']) && $dfd_ronneby['highlight_has_submenu'] == 'on')
		$advanced_styles .= ' dfd-highlight-has-submenu';
	
	$customizable_headers = array('1', '2');
	
	if(in_array($head_type, $customizable_headers)) {
		return "header-style-{$head_type} header-layout-{$header_layout} {$sticky_header_animation} logo-position-{$header_logo_position} menu-position-{$header_menu_position} {$advanced_styles}"; //top-header-{$show_top_header}
	} else {
		return "header-style-{$head_type} header-layout-{$header_layout} {$sticky_header_animation} {$advanced_styles}"; //top-header-{$show_top_header}
	}
}

if (!function_exists('post_like_scripts')) {
	/**
	 * Post Like scripts
	 */
	function post_like_scripts() {
		wp_register_script('like_post', get_template_directory_uri().'/assets/js/post-like.min.js', array('jquery'), null, true );
		wp_localize_script('like_post', 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce')
		));
		wp_enqueue_script('like_post');
	}
}

/**
 * Portfolio Sort panel
 * @param array $categories
 */
function dfd_folio_sort_panel($categories) {
?>
<div class="sort-panel twelve columns">
	<ul class="filter filter-buttons">
		<li class="active">
			<a data-filter=".project" href="#"><?php echo __('All', 'dfd'); ?></a>
		</li>
		<?php foreach ($categories as $category): ?>
			<li>
				<a href="#" data-filter=".project[data-category~='<?php echo strtolower(preg_replace('/\s+/', '-', $category->slug)); ?>']">
					<?php echo $category->name; ?>
				<span class="anim-bg"></span></a>
			</li>
		<?php endforeach; ?>

	</ul>
</div>
<?php
}

if(!class_exists('Dfd_Taxonomies_Custom_Fields')) {
	class Dfd_Taxonomies_Custom_Fields {
		
		var $taxonomies = array('','my-product_','gallery_');
		
		function __construct() {
			add_action('admin_enqueue_scripts',array($this,'dfd_post_cat_reqister_scripts'));
			foreach($this->taxonomies as $tax) {
				add_action($tax.'category_add_form_fields',array($this,'dfd_taxonomy_add_new_meta_field'));
				add_action($tax.'category_edit_form_fields',array($this,'dfd_taxonomy_edit_meta_field'));
				add_action('edited_'.$tax.'category',array($this,'save_taxonomy_custom_meta'));
				add_action('create_'.$tax.'category',array($this,'save_taxonomy_custom_meta'));
			}
		}
		
		function dfd_taxonomy_add_new_meta_field() {
			?>
			<div class="form-field">
				<label for="term_meta[custom_term_meta]"><?php _e( 'Category&#0146;s icon', 'dfd' ); ?></label>
				<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" class="iconname" value="" style="width:50%;" />
				<a href="#" class="updateButton crum-icon-add"><?php _e('Add Icon', 'dfd'); ?></a>
			</div>
			<div class="form-field">
				<label for="term_meta[custom_term_meta_color]"><?php _e( 'Category&#0146;s color', 'dfd' ); ?></label>
				<input type="text" id="dfd-category-colorpicker" name="term_meta[custom_term_meta_color]" value="" />
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$("#dfd-category-colorpicker").wpColorPicker();
					});
				</script>
			</div>
		<?php
		}

		function dfd_taxonomy_edit_meta_field($term) {
			$t_id = $term->term_id;

			$term_meta = get_option( "taxonomy_$t_id" ); ?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Category&#0146;s icon', 'dfd' ); ?></label></th>
				<td>
					<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" class="iconname" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>" style="width:50%;" />
					<a href="#" class="updateButton crum-icon-add"><?php _e('Add Icon', 'dfd'); ?></a>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[custom_term_meta_color]"><?php _e( 'Category&#0146;s color', 'dfd' ); ?></label></th>
				<td>
					<input type="text" id="dfd-category-colorpicker" name="term_meta[custom_term_meta_color]" value="<?php echo esc_attr( $term_meta['custom_term_meta_color'] ) ? esc_attr( $term_meta['custom_term_meta_color'] ) : ''; ?>" />
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							$("#dfd-category-colorpicker").wpColorPicker();
						});
					</script>
				</td>
			</tr>
		<?php
		}
		
		function save_taxonomy_custom_meta( $term_id ) {
			if ( isset( $_POST['term_meta'] ) ) {
				$t_id = $term_id;
				$term_meta = get_option( "taxonomy_$t_id" );
				$cat_keys = array_keys( $_POST['term_meta'] );
				foreach ( $cat_keys as $key ) {
					if ( isset ( $_POST['term_meta'][$key] ) ) {
						$term_meta[$key] = $_POST['term_meta'][$key];
					}
				}
				update_option( "taxonomy_$t_id", $term_meta );
			}
		}
		
		function dfd_post_cat_reqister_scripts() {
			wp_enqueue_script('wp-color-picker');
			wp_enqueue_style('wp-color-picker');
		}
	}
	
	$Dfd_Taxonomies_Custom_Fields = new Dfd_Taxonomies_Custom_Fields();
}

/* Shortcode wrapper, added for VC nested shortcodes and maybe for somethng else in the future :) */
if(!class_exists('Dfd_Wrap_Shortcode')) {
	class Dfd_Wrap_Shortcode {
		public static $_shortcode_tags;
		public static function dfd_override_shortcodes($disabled_tags = array()) {
			global $shortcode_tags;

			self::$_shortcode_tags = $shortcode_tags;

			foreach ( $shortcode_tags as $tag => $cb ) {
				if ( in_array( $tag, $disabled_tags ) ) {
					continue;
				}

				$shortcode_tags[ $tag ] = 'dfd_wrap_shortcode_in_div';
			}
		}
		
		public static function dfd_restore_shortcodes() {
			global $shortcode_tags;

			if ( isset( self::$_shortcode_tags ) ) {
				$shortcode_tags = self::$_shortcode_tags;
			}
		}
	}
	function dfd_wrap_shortcode_in_div( $attr, $content = null, $tag ) {
		$_shortcode_tags = Dfd_Wrap_Shortcode::$_shortcode_tags;
		
		return '<div class="dfd-item-wrap"><div class="cover">' . call_user_func( $_shortcode_tags[ $tag ], $attr, $content, $tag ) . '</div></div>';
	}
}

add_filter( 'vc_iconpicker-type-dfd_icons', 'dfd_iconpicker_type_dfd_icons' );

/**
 * DFD Icons filter to add icnos field
 *
 * @param $icons - taken from filter - vc_map param field settings['source'] provided icons (default empty array).
 * If array categorized it will auto-enable category dropdown
 *
 * @since 4.4
 * @return array - of icons for iconpicker, can be categorized, or not.
 */
function dfd_iconpicker_type_dfd_icons( $icons ) {
	$dfd_icons = array(
		array('dfd-icon-celsius' => 'Dfd-Icon-Celsius'),
		array('dfd-icon-clear_day' => 'Dfd-Icon-Clear_day'),
		array('dfd-icon-clear_night' => 'Dfd-Icon-Clear_night'),
		array('dfd-icon-cloud_thunder' => 'Dfd-Icon-Cloud_thunder'),
		array('dfd-icon-cloud_wind' => 'Dfd-Icon-Cloud_wind'),
		array('dfd-icon-cloudy' => 'Dfd-Icon-Cloudy'),
		array('dfd-icon-cloudy_rain' => 'Dfd-Icon-Cloudy_rain'),
		array('dfd-icon-compass_east' => 'Dfd-Icon-Compass_east'),
		array('dfd-icon-compass_east_south' => 'Dfd-Icon-Compass_east_south'),
		array('dfd-icon-compass_north' => 'Dfd-Icon-Compass_north'),
		array('dfd-icon-compass_north_east' => 'Dfd-Icon-Compass_north_east'),
		array('dfd-icon-compass_south' => 'Dfd-Icon-Compass_south'),
		array('dfd-icon-compass_south_west' => 'Dfd-Icon-Compass_south_west'),
		array('dfd-icon-compass_west' => 'Dfd-Icon-Compass_west'),
		array('dfd-icon-compass_west_north' => 'Dfd-Icon-Compass_west_north'),
		array('dfd-icon-fahrenheit' => 'Dfd-Icon-Fahrenheit'),
		array('dfd-icon-hail' => 'Dfd-Icon-Hail'),
		array('dfd-icon-hail_snow' => 'Dfd-Icon-Hail_snow'),
		array('dfd-icon-hail_warning' => 'Dfd-Icon-Hail_warning'),
		array('dfd-icon-heavy_rain' => 'Dfd-Icon-Heavy_rain'),
		array('dfd-icon-heavy_rain_day' => 'Dfd-Icon-Heavy_rain_day'),
		array('dfd-icon-heavy_rain_night' => 'Dfd-Icon-Heavy_rain_night'),
		array('dfd-icon-heavy_rain_snow' => 'Dfd-Icon-Heavy_rain_snow'),
		array('dfd-icon-heavy_snow' => 'Dfd-Icon-Heavy_snow'),
		array('dfd-icon-humidity' => 'Dfd-Icon-Humidity'),
		array('dfd-icon-light_rain' => 'Dfd-Icon-Light_rain'),
		array('dfd-icon-light_rain_day' => 'Dfd-Icon-Light_rain_day'),
		array('dfd-icon-light_rain_night' => 'Dfd-Icon-Light_rain_night'),
		array('dfd-icon-light_snow' => 'Dfd-Icon-Light_snow'),
		array('dfd-icon-mist' => 'Dfd-Icon-Mist'),
		array('dfd-icon-moon_cloud' => 'Dfd-Icon-Moon_cloud'),
		array('dfd-icon-moon_rain' => 'Dfd-Icon-Moon_rain'),
		array('dfd-icon-rain_thunder' => 'Dfd-Icon-Rain_thunder'),
		array('dfd-icon-rain_warning' => 'Dfd-Icon-Rain_warning'),
		array('dfd-icon-rainbow' => 'Dfd-Icon-Rainbow'),
		array('dfd-icon-sleet' => 'Dfd-Icon-Sleet'),
		array('dfd-icon-small_humidity' => 'Dfd-Icon-Small_humidity'),
		array('dfd-icon-small_mist' => 'Dfd-Icon-Small_mist'),
		array('dfd-icon-snow' => 'Dfd-Icon-Snow'),
		array('dfd-icon-sun_cloud' => 'Dfd-Icon-Sun_cloud'),
		array('dfd-icon-sun_rain' => 'Dfd-Icon-Sun_rain'),
		array('dfd-icon-sunrise_1' => 'Dfd-Icon-Sunrise_1'),
		array('dfd-icon-sunrise_2' => 'Dfd-Icon-Sunrise_2'),
		array('dfd-icon-sunset_1' => 'Dfd-Icon-Sunset_1'),
		array('dfd-icon-sunset_2' => 'Dfd-Icon-Sunset_2'),
		array('dfd-icon-thermometer_0' => 'Dfd-Icon-Thermometer_0'),
		array('dfd-icon-thermometer_25' => 'Dfd-Icon-Thermometer_25'),
		array('dfd-icon-thermometer_50' => 'Dfd-Icon-Thermometer_50'),
		array('dfd-icon-thermometer_100' => 'Dfd-Icon-Thermometer_100'),
		array('dfd-icon-thunder' => 'Dfd-Icon-Thunder'),
		array('dfd-icon-thunder_warning' => 'Dfd-Icon-Thunder_warning'),
		array('dfd-icon-wind' => 'Dfd-Icon-Wind'),
		array('dfd-icon-wind_hail' => 'Dfd-Icon-Wind_hail'),
		array('dfd-icon-wind_rain' => 'Dfd-Icon-Wind_rain'),
		array('dfd-icon-axe' => 'Dfd-Icon-Axe'),
		array('dfd-icon-bomb_1' => 'Dfd-Icon-Bomb_1'),
		array('dfd-icon-bomb_2' => 'Dfd-Icon-Bomb_2'),
		array('dfd-icon-brass_knuckle' => 'Dfd-Icon-Brass_knuckle'),
		array('dfd-icon-bullet' => 'Dfd-Icon-Bullet'),
		array('dfd-icon-catapult' => 'Dfd-Icon-Catapult'),
		array('dfd-icon-flail' => 'Dfd-Icon-Flail'),
		array('dfd-icon-flashlight' => 'Dfd-Icon-Flashlight'),
		array('dfd-icon-gas_mask' => 'Dfd-Icon-Gas_mask'),
		array('dfd-icon-grenade' => 'Dfd-Icon-Grenade'),
		array('dfd-icon-gun_1' => 'Dfd-Icon-Gun_1'),
		array('dfd-icon-gun_2' => 'Dfd-Icon-Gun_2'),
		array('dfd-icon-hammer' => 'Dfd-Icon-Hammer'),
		array('dfd-icon-knife_1' => 'Dfd-Icon-Knife_1'),
		array('dfd-icon-knife_2' => 'Dfd-Icon-Knife_2'),
		array('dfd-icon-mace' => 'Dfd-Icon-Mace'),
		array('dfd-icon-molotov_cocktail' => 'Dfd-Icon-Molotov_cocktail'),
		array('dfd-icon-noode' => 'Dfd-Icon-Noode'),
		array('dfd-icon-nuclear_explosion' => 'Dfd-Icon-Nuclear_explosion'),
		array('dfd-icon-nunchucks' => 'Dfd-Icon-Nunchucks'),
		array('dfd-icon-raygun' => 'Dfd-Icon-Raygun'),
		array('dfd-icon-razor_blade' => 'Dfd-Icon-Razor_blade'),
		array('dfd-icon-sai' => 'Dfd-Icon-Sai'),
		array('dfd-icon-shuriken_1' => 'Dfd-Icon-Shuriken_1'),
		array('dfd-icon-shuriken_2' => 'Dfd-Icon-Shuriken_2'),
		array('dfd-icon-slingshot' => 'Dfd-Icon-Slingshot'),
		array('dfd-icon-swiss_army_knife' => 'Dfd-Icon-Swiss_army_knife'),
		array('dfd-icon-tank' => 'Dfd-Icon-Tank'),
		array('dfd-icon-target' => 'Dfd-Icon-Target'),
		array('dfd-icon-tnt' => 'Dfd-Icon-Tnt'),
		array('dfd-icon-builder' => 'Dfd-Icon-Builder'),
		array('dfd-icon-businessman' => 'Dfd-Icon-Businessman'),
		array('dfd-icon-chat' => 'Dfd-Icon-Chat'),
		array('dfd-icon-contact' => 'Dfd-Icon-Contact'),
		array('dfd-icon-diver' => 'Dfd-Icon-Diver'),
		array('dfd-icon-doctor' => 'Dfd-Icon-Doctor'),
		array('dfd-icon-gardener' => 'Dfd-Icon-Gardener'),
		array('dfd-icon-group_1' => 'Dfd-Icon-Group_1'),
		array('dfd-icon-group_2' => 'Dfd-Icon-Group_2'),
		array('dfd-icon-judge' => 'Dfd-Icon-Judge'),
		array('dfd-icon-mobile' => 'Dfd-Icon-Mobile'),
		array('dfd-icon-player' => 'Dfd-Icon-Player'),
		array('dfd-icon-policeman' => 'Dfd-Icon-Policeman'),
		array('dfd-icon-referee' => 'Dfd-Icon-Referee'),
		array('dfd-icon-student' => 'Dfd-Icon-Student'),
		array('dfd-icon-transfer_1' => 'Dfd-Icon-Transfer_1'),
		array('dfd-icon-transfer_2' => 'Dfd-Icon-Transfer_2'),
		array('dfd-icon-user' => 'Dfd-Icon-User'),
		array('dfd-icon-user_2' => 'Dfd-Icon-User_2'),
		array('dfd-icon-user_3' => 'Dfd-Icon-User_3'),
		array('dfd-icon-user_block' => 'Dfd-Icon-User_block'),
		array('dfd-icon-user_check' => 'Dfd-Icon-User_check'),
		array('dfd-icon-user_close' => 'Dfd-Icon-User_close'),
		array('dfd-icon-user_downgrade' => 'Dfd-Icon-User_downgrade'),
		array('dfd-icon-user_like' => 'Dfd-Icon-User_like'),
		array('dfd-icon-user_list' => 'Dfd-Icon-User_list'),
		array('dfd-icon-user_location' => 'Dfd-Icon-User_location'),
		array('dfd-icon-user_lock' => 'Dfd-Icon-User_lock'),
		array('dfd-icon-user_mail' => 'Dfd-Icon-User_mail'),
		array('dfd-icon-user_man' => 'Dfd-Icon-User_man'),
		array('dfd-icon-user_minus' => 'Dfd-Icon-User_minus'),
		array('dfd-icon-user_money' => 'Dfd-Icon-User_money'),
		array('dfd-icon-user_plus' => 'Dfd-Icon-User_plus'),
		array('dfd-icon-user_question' => 'Dfd-Icon-User_question'),
		array('dfd-icon-user_search' => 'Dfd-Icon-User_search'),
		array('dfd-icon-user_setting' => 'Dfd-Icon-User_setting'),
		array('dfd-icon-user_star' => 'Dfd-Icon-User_star'),
		array('dfd-icon-user_upgrade' => 'Dfd-Icon-User_upgrade'),
		array('dfd-icon-user_woman' => 'Dfd-Icon-User_woman'),
		array('dfd-icon-users' => 'Dfd-Icon-Users'),
		array('dfd-icon-acropolis' => 'Dfd-Icon-Acropolis'),
		array('dfd-icon-backpack' => 'Dfd-Icon-Backpack'),
		array('dfd-icon-baggage' => 'Dfd-Icon-Baggage'),
		array('dfd-icon-beach' => 'Dfd-Icon-Beach'),
		array('dfd-icon-big_ben' => 'Dfd-Icon-Big_ben'),
		array('dfd-icon-brandenburg_gate' => 'Dfd-Icon-Brandenburg_gate'),
		array('dfd-icon-bush_al_arab' => 'Dfd-Icon-Bush_al_arab'),
		array('dfd-icon-Capitol' => 'Dfd-Icon-Capitol'),
		array('dfd-icon-castle_1' => 'Dfd-Icon-Castle_1'),
		array('dfd-icon-castle_2' => 'Dfd-Icon-Castle_2'),
		array('dfd-icon-castle_3' => 'Dfd-Icon-Castle_3'),
		array('dfd-icon-christ_the_redeemer' => 'Dfd-Icon-Christ_the_redeemer'),
		array('dfd-icon-compass_1' => 'Dfd-Icon-Compass_1'),
		array('dfd-icon-compass_2' => 'Dfd-Icon-Compass_2'),
		array('dfd-icon-door_tag_1' => 'Dfd-Icon-Door_tag_1'),
		array('dfd-icon-door_tag_2' => 'Dfd-Icon-Door_tag_2'),
		array('dfd-icon-Eiffel_tower' => 'Dfd-Icon-Eiffel_tower'),
		array('dfd-icon-ferris_wheel' => 'Dfd-Icon-Ferris_wheel'),
		array('dfd-icon-grill' => 'Dfd-Icon-Grill'),
		array('dfd-icon-hagia_sophia' => 'Dfd-Icon-Hagia_sophia'),
		array('dfd-icon-hotel' => 'Dfd-Icon-Hotel'),
		array('dfd-icon-jellyfish' => 'Dfd-Icon-Jellyfish'),
		array('dfd-icon-life_jacket' => 'Dfd-Icon-Life_jacket'),
		array('dfd-icon-lighthouse' => 'Dfd-Icon-Lighthouse'),
		array('dfd-icon-lounge_chair' => 'Dfd-Icon-Lounge_chair'),
		array('dfd-icon-luggage_cart' => 'Dfd-Icon-Luggage_cart'),
		array('dfd-icon-mesoamerican_pyramids' => 'Dfd-Icon-Mesoamerican_pyramids'),
		array('dfd-icon-mountains' => 'Dfd-Icon-Mountains'),
		array('dfd-icon-palm' => 'Dfd-Icon-Palm'),
		array('dfd-icon-passport' => 'Dfd-Icon-Passport'),
		array('dfd-icon-petronas_towers' => 'Dfd-Icon-Petronas_towers'),
		array('dfd-icon-picnic_table' => 'Dfd-Icon-Picnic_table'),
		array('dfd-icon-pyramids' => 'Dfd-Icon-Pyramids'),
		array('dfd-icon-reception-bell' => 'Dfd-Icon-Reception-Bell'),
		array('dfd-icon-scuba_1' => 'Dfd-Icon-Scuba_1'),
		array('dfd-icon-scuba_2' => 'Dfd-Icon-Scuba_2'),
		array('dfd-icon-sheep_wheel' => 'Dfd-Icon-Sheep_wheel'),
		array('dfd-icon-shinto_shrine' => 'Dfd-Icon-Shinto_shrine'),
		array('dfd-icon-snorkel' => 'Dfd-Icon-Snorkel'),
		array('dfd-icon-sphinx' => 'Dfd-Icon-Sphinx'),
		array('dfd-icon-st_Basils_cathedral' => 'Dfd-Icon-St_Basils_cathedral'),
		array('dfd-icon-surf' => 'Dfd-Icon-Surf'),
		array('dfd-icon-swimfin' => 'Dfd-Icon-Swimfin'),
		array('dfd-icon-taj_mahal' => 'Dfd-Icon-Taj_mahal'),
		array('dfd-icon-tent' => 'Dfd-Icon-Tent'),
		array('dfd-icon-tipi' => 'Dfd-Icon-Tipi'),
		array('dfd-icon-towel' => 'Dfd-Icon-Towel'),
		array('dfd-icon-tower_bridge' => 'Dfd-Icon-Tower_bridge'),
		array('dfd-icon-trailer' => 'Dfd-Icon-Trailer'),
		array('dfd-icon-windsurf' => 'Dfd-Icon-Windsurf'),
		array('dfd-icon-battery_car' => 'Dfd-Icon-Battery_car'),
		array('dfd-icon-bicycle' => 'Dfd-Icon-Bicycle'),
		array('dfd-icon-bicycle_retro' => 'Dfd-Icon-Bicycle_retro'),
		array('dfd-icon-bus_1' => 'Dfd-Icon-Bus_1'),
		array('dfd-icon-bus_2' => 'Dfd-Icon-Bus_2'),
		array('dfd-icon-cableway' => 'Dfd-Icon-Cableway'),
		array('dfd-icon-car_1' => 'Dfd-Icon-Car_1'),
		array('dfd-icon-car_2' => 'Dfd-Icon-Car_2'),
		array('dfd-icon-chassis' => 'Dfd-Icon-Chassis'),
		array('dfd-icon-cone' => 'Dfd-Icon-Cone'),
		array('dfd-icon-helicopter' => 'Dfd-Icon-Helicopter'),
		array('dfd-icon-hot-air' => 'Dfd-Icon-Hot-Air'),
		array('dfd-icon-light' => 'Dfd-Icon-Light'),
		array('dfd-icon-lorry' => 'Dfd-Icon-Lorry'),
		array('dfd-icon-pickup' => 'Dfd-Icon-Pickup'),
		array('dfd-icon-plane_1' => 'Dfd-Icon-Plane_1'),
		array('dfd-icon-plane_2' => 'Dfd-Icon-Plane_2'),
		array('dfd-icon-plane_landing' => 'Dfd-Icon-Plane_landing'),
		array('dfd-icon-plane_take-off' => 'Dfd-Icon-Plane_take-Off'),
		array('dfd-icon-road' => 'Dfd-Icon-Road'),
		array('dfd-icon-rocket' => 'Dfd-Icon-Rocket'),
		array('dfd-icon-sailboat' => 'Dfd-Icon-Sailboat'),
		array('dfd-icon-satellite' => 'Dfd-Icon-Satellite'),
		array('dfd-icon-scooter_1' => 'Dfd-Icon-Scooter_1'),
		array('dfd-icon-scooter_2' => 'Dfd-Icon-Scooter_2'),
		array('dfd-icon-shift' => 'Dfd-Icon-Shift'),
		array('dfd-icon-ship_1' => 'Dfd-Icon-Ship_1'),
		array('dfd-icon-ship_2' => 'Dfd-Icon-Ship_2'),
		array('dfd-icon-speedometer' => 'Dfd-Icon-Speedometer'),
		array('dfd-icon-station_electric' => 'Dfd-Icon-Station_electric'),
		array('dfd-icon-station_oil' => 'Dfd-Icon-Station_oil'),
		array('dfd-icon-steering_wheel' => 'Dfd-Icon-Steering_wheel'),
		array('dfd-icon-submarine' => 'Dfd-Icon-Submarine'),
		array('dfd-icon-train_1' => 'Dfd-Icon-Train_1'),
		array('dfd-icon-train_2' => 'Dfd-Icon-Train_2'),
		array('dfd-icon-truck_1' => 'Dfd-Icon-Truck_1'),
		array('dfd-icon-truck_2' => 'Dfd-Icon-Truck_2'),
		array('dfd-icon-trum_1' => 'Dfd-Icon-Trum_1'),
		array('dfd-icon-trum_2' => 'Dfd-Icon-Trum_2'),
		array('dfd-icon-unicycle' => 'Dfd-Icon-Unicycle'),
		array('dfd-icon-alarm' => 'Dfd-Icon-Alarm'),
		array('dfd-icon-alarm_clock' => 'Dfd-Icon-Alarm_clock'),
		array('dfd-icon-alarm_off' => 'Dfd-Icon-Alarm_off'),
		array('dfd-icon-alarm_snooze' => 'Dfd-Icon-Alarm_snooze'),
		array('dfd-icon-calendar' => 'Dfd-Icon-Calendar'),
		array('dfd-icon-calendar_date' => 'Dfd-Icon-Calendar_date'),
		array('dfd-icon-calendar_month' => 'Dfd-Icon-Calendar_month'),
		array('dfd-icon-clock_1' => 'Dfd-Icon-Clock_1'),
		array('dfd-icon-clock_2' => 'Dfd-Icon-Clock_2'),
		array('dfd-icon-clock_3' => 'Dfd-Icon-Clock_3'),
		array('dfd-icon-cuckoo_clock' => 'Dfd-Icon-Cuckoo_clock'),
		array('dfd-icon-hour_glass_1' => 'Dfd-Icon-Hour_glass_1'),
		array('dfd-icon-hour_glass_2' => 'Dfd-Icon-Hour_glass_2'),
		array('dfd-icon-mobile_clock' => 'Dfd-Icon-Mobile_clock'),
		array('dfd-icon-watch_1' => 'Dfd-Icon-Watch_1'),
		array('dfd-icon-watch_2' => 'Dfd-Icon-Watch_2'),
		array('dfd-icon-watch_3_4' => 'Dfd-Icon-Watch_3_4'),
		array('dfd-icon-align_center' => 'Dfd-Icon-Align_center'),
		array('dfd-icon-align_left' => 'Dfd-Icon-Align_left'),
		array('dfd-icon-align_right' => 'Dfd-Icon-Align_right'),
		array('dfd-icon-all_caps' => 'Dfd-Icon-All_caps'),
		array('dfd-icon-baseline_shift' => 'Dfd-Icon-Baseline_shift'),
		array('dfd-icon-columns_2' => 'Dfd-Icon-Columns_2'),
		array('dfd-icon-columns_3' => 'Dfd-Icon-Columns_3'),
		array('dfd-icon-decrease_indent' => 'Dfd-Icon-Decrease_indent'),
		array('dfd-icon-grid_4' => 'Dfd-Icon-Grid_4'),
		array('dfd-icon-grid_9' => 'Dfd-Icon-Grid_9'),
		array('dfd-icon-increase_indent' => 'Dfd-Icon-Increase_indent'),
		array('dfd-icon-justify' => 'Dfd-Icon-Justify'),
		array('dfd-icon-leading' => 'Dfd-Icon-Leading'),
		array('dfd-icon-left_indent' => 'Dfd-Icon-Left_indent'),
		array('dfd-icon-list_bulleted' => 'Dfd-Icon-List_bulleted'),
		array('dfd-icon-list_check' => 'Dfd-Icon-List_check'),
		array('dfd-icon-list_numbered' => 'Dfd-Icon-List_numbered'),
		array('dfd-icon-pilcrow' => 'Dfd-Icon-Pilcrow'),
		array('dfd-icon-right_indent' => 'Dfd-Icon-Right_indent'),
		array('dfd-icon-small_caps' => 'Dfd-Icon-Small_caps'),
		array('dfd-icon-strikethrough' => 'Dfd-Icon-Strikethrough'),
		array('dfd-icon-subscript' => 'Dfd-Icon-Subscript'),
		array('dfd-icon-superscript' => 'Dfd-Icon-Superscript'),
		array('dfd-icon-underline' => 'Dfd-Icon-Underline'),
		array('dfd-icon-vertical_scale' => 'Dfd-Icon-Vertical_scale'),
		array('dfd-icon-archery' => 'Dfd-Icon-Archery'),
		array('dfd-icon-arena' => 'Dfd-Icon-Arena'),
		array('dfd-icon-barbell' => 'Dfd-Icon-Barbell'),
		array('dfd-icon-barbell_2' => 'Dfd-Icon-Barbell_2'),
		array('dfd-icon-baseball' => 'Dfd-Icon-Baseball'),
		array('dfd-icon-basketball' => 'Dfd-Icon-Basketball'),
		array('dfd-icon-basketball_court' => 'Dfd-Icon-Basketball_court'),
		array('dfd-icon-basketball_hoop' => 'Dfd-Icon-Basketball_hoop'),
		array('dfd-icon-billiards' => 'Dfd-Icon-Billiards'),
		array('dfd-icon-billiards_ball' => 'Dfd-Icon-Billiards_ball'),
		array('dfd-icon-bow_and_arrow' => 'Dfd-Icon-Bow_and_arrow'),
		array('dfd-icon-bowling_ball' => 'Dfd-Icon-Bowling_ball'),
		array('dfd-icon-bowling_pin' => 'Dfd-Icon-Bowling_pin'),
		array('dfd-icon-cards_clubs' => 'Dfd-Icon-Cards_clubs'),
		array('dfd-icon-cards_diamonds' => 'Dfd-Icon-Cards_diamonds'),
		array('dfd-icon-cards_hearts' => 'Dfd-Icon-Cards_hearts'),
		array('dfd-icon-cards_spades' => 'Dfd-Icon-Cards_spades'),
		array('dfd-icon-champion' => 'Dfd-Icon-Champion'),
		array('dfd-icon-champion_1_place' => 'Dfd-Icon-Champion_1_place'),
		array('dfd-icon-champion_star' => 'Dfd-Icon-Champion_star'),
		array('dfd-icon-chess_bishop' => 'Dfd-Icon-Chess_bishop'),
		array('dfd-icon-chess_king' => 'Dfd-Icon-Chess_king'),
		array('dfd-icon-chess_knight' => 'Dfd-Icon-Chess_knight'),
		array('dfd-icon-chess_pawn' => 'Dfd-Icon-Chess_pawn'),
		array('dfd-icon-chess_queen' => 'Dfd-Icon-Chess_queen'),
		array('dfd-icon-chess_rook' => 'Dfd-Icon-Chess_rook'),
		array('dfd-icon-cleat' => 'Dfd-Icon-Cleat'),
		array('dfd-icon-cricket' => 'Dfd-Icon-Cricket'),
		array('dfd-icon-cup' => 'Dfd-Icon-Cup'),
		array('dfd-icon-cup_1_place' => 'Dfd-Icon-Cup_1_place'),
		array('dfd-icon-cup_star' => 'Dfd-Icon-Cup_star'),
		array('dfd-icon-curling_stone' => 'Dfd-Icon-Curling_stone'),
		array('dfd-icon-dart' => 'Dfd-Icon-Dart'),
		array('dfd-icon-fencing' => 'Dfd-Icon-Fencing'),
		array('dfd-icon-field_goal' => 'Dfd-Icon-Field_goal'),
		array('dfd-icon-finish' => 'Dfd-Icon-Finish'),
		array('dfd-icon-goal' => 'Dfd-Icon-Goal'),
		array('dfd-icon-golf' => 'Dfd-Icon-Golf'),
		array('dfd-icon-golf_bag' => 'Dfd-Icon-Golf_bag'),
		array('dfd-icon-golfing' => 'Dfd-Icon-Golfing'),
		array('dfd-icon-hockey' => 'Dfd-Icon-Hockey'),
		array('dfd-icon-ice_skate' => 'Dfd-Icon-Ice_skate'),
		array('dfd-icon-kayak' => 'Dfd-Icon-Kayak'),
		array('dfd-icon-medal' => 'Dfd-Icon-Medal'),
		array('dfd-icon-medal_1_place' => 'Dfd-Icon-Medal_1_place'),
		array('dfd-icon-medal_2' => 'Dfd-Icon-Medal_2'),
		array('dfd-icon-medal_star' => 'Dfd-Icon-Medal_star'),
		array('dfd-icon-paddles' => 'Dfd-Icon-Paddles'),
		array('dfd-icon-ping_pong' => 'Dfd-Icon-Ping_pong'),
		array('dfd-icon-player2' => 'Dfd-Icon-Player2'),
		array('dfd-icon-podium' => 'Dfd-Icon-Podium'),
		array('dfd-icon-pogo-stick' => 'Dfd-Icon-Pogo-Stick'),
		array('dfd-icon-punch_bag' => 'Dfd-Icon-Punch_bag'),
		array('dfd-icon-referee2' => 'Dfd-Icon-Referee2'),
		array('dfd-icon-ribbon' => 'Dfd-Icon-Ribbon'),
		array('dfd-icon-ribbon_1_place' => 'Dfd-Icon-Ribbon_1_place'),
		array('dfd-icon-ribbon_star' => 'Dfd-Icon-Ribbon_star'),
		array('dfd-icon-rollerblade' => 'Dfd-Icon-Rollerblade'),
		array('dfd-icon-rugby_ball' => 'Dfd-Icon-Rugby_ball'),
		array('dfd-icon-sailboat2' => 'Dfd-Icon-Sailboat2'),
		array('dfd-icon-scoreboard' => 'Dfd-Icon-Scoreboard'),
		array('dfd-icon-shuttlecocks' => 'Dfd-Icon-Shuttlecocks'),
		array('dfd-icon-skateboard' => 'Dfd-Icon-Skateboard'),
		array('dfd-icon-skiing' => 'Dfd-Icon-Skiing'),
		array('dfd-icon-skipping' => 'Dfd-Icon-Skipping'),
		array('dfd-icon-soccer_ball' => 'Dfd-Icon-Soccer_ball'),
		array('dfd-icon-soccer_field' => 'Dfd-Icon-Soccer_field'),
		array('dfd-icon-star' => 'Dfd-Icon-Star'),
		array('dfd-icon-start' => 'Dfd-Icon-Start'),
		array('dfd-icon-stopwatch_1' => 'Dfd-Icon-Stopwatch_1'),
		array('dfd-icon-stopwatch_2' => 'Dfd-Icon-Stopwatch_2'),
		array('dfd-icon-target2' => 'Dfd-Icon-Target2'),
		array('dfd-icon-tennis_ball_1' => 'Dfd-Icon-Tennis_ball_1'),
		array('dfd-icon-tennis_ball_2' => 'Dfd-Icon-Tennis_ball_2'),
		array('dfd-icon-tennis_court' => 'Dfd-Icon-Tennis_court'),
		array('dfd-icon-tennis_raket' => 'Dfd-Icon-Tennis_raket'),
		array('dfd-icon-time_clock' => 'Dfd-Icon-Time_clock'),
		array('dfd-icon-water_bottle' => 'Dfd-Icon-Water_bottle'),
		array('dfd-icon-weight' => 'Dfd-Icon-Weight'),
		array('dfd-icon-whistle' => 'Dfd-Icon-Whistle'),
		array('dfd-icon-hours' => 'Dfd-Icon-Hours'),
		array('dfd-icon-airplane' => 'Dfd-Icon-Airplane'),
		array('dfd-icon-ATM_card' => 'Dfd-Icon-ATM_card'),
		array('dfd-icon-ATM_money' => 'Dfd-Icon-ATM_money'),
		array('dfd-icon-bag' => 'Dfd-Icon-Bag'),
		array('dfd-icon-bank' => 'Dfd-Icon-Bank'),
		array('dfd-icon-bank_card' => 'Dfd-Icon-Bank_card'),
		array('dfd-icon-bank_card_security' => 'Dfd-Icon-Bank_card_security'),
		array('dfd-icon-banknote' => 'Dfd-Icon-Banknote'),
		array('dfd-icon-banknotes' => 'Dfd-Icon-Banknotes'),
		array('dfd-icon-bar_graph_1' => 'Dfd-Icon-Bar_graph_1'),
		array('dfd-icon-bar_graph_2' => 'Dfd-Icon-Bar_graph_2'),
		array('dfd-icon-bar_graph_drop' => 'Dfd-Icon-Bar_graph_drop'),
		array('dfd-icon-bar_graph_growth' => 'Dfd-Icon-Bar_graph_growth'),
		array('dfd-icon-bar_graph_horizontal' => 'Dfd-Icon-Bar_graph_horizontal'),
		array('dfd-icon-bar_graph_vertical' => 'Dfd-Icon-Bar_graph_vertical'),
		array('dfd-icon-barcode' => 'Dfd-Icon-Barcode'),
		array('dfd-icon-barcode_search' => 'Dfd-Icon-Barcode_search'),
		array('dfd-icon-basket_1' => 'Dfd-Icon-Basket_1'),
		array('dfd-icon-basket_2' => 'Dfd-Icon-Basket_2'),
		array('dfd-icon-basket_3' => 'Dfd-Icon-Basket_3'),
		array('dfd-icon-basket_4' => 'Dfd-Icon-Basket_4'),
		array('dfd-icon-basket_5' => 'Dfd-Icon-Basket_5'),
		array('dfd-icon-basket_6' => 'Dfd-Icon-Basket_6'),
		array('dfd-icon-basket_full' => 'Dfd-Icon-Basket_full'),
		array('dfd-icon-box_1' => 'Dfd-Icon-Box_1'),
		array('dfd-icon-box_2' => 'Dfd-Icon-Box_2'),
		array('dfd-icon-box_3' => 'Dfd-Icon-Box_3'),
		array('dfd-icon-box_isometric' => 'Dfd-Icon-Box_isometric'),
		array('dfd-icon-box_search' => 'Dfd-Icon-Box_search'),
		array('dfd-icon-briefcase' => 'Dfd-Icon-Briefcase'),
		array('dfd-icon-buy' => 'Dfd-Icon-Buy'),
		array('dfd-icon-calculator' => 'Dfd-Icon-Calculator'),
		array('dfd-icon-candlestick_chart' => 'Dfd-Icon-Candlestick_chart'),
		array('dfd-icon-car_24' => 'Dfd-Icon-Car_24'),
		array('dfd-icon-car_express' => 'Dfd-Icon-Car_express'),
		array('dfd-icon-case' => 'Dfd-Icon-Case'),
		array('dfd-icon-cash_register' => 'Dfd-Icon-Cash_register'),
		array('dfd-icon-certificate' => 'Dfd-Icon-Certificate'),
		array('dfd-icon-check' => 'Dfd-Icon-Check'),
		array('dfd-icon-clipboard' => 'Dfd-Icon-Clipboard'),
		array('dfd-icon-close' => 'Dfd-Icon-Close'),
		array('dfd-icon-coins' => 'Dfd-Icon-Coins'),
		array('dfd-icon-coins_collect' => 'Dfd-Icon-Coins_collect'),
		array('dfd-icon-comb' => 'Dfd-Icon-Comb'),
		array('dfd-icon-cut' => 'Dfd-Icon-Cut'),
		array('dfd-icon-delivery_1' => 'Dfd-Icon-Delivery_1'),
		array('dfd-icon-delivery_2' => 'Dfd-Icon-Delivery_2'),
		array('dfd-icon-dollar' => 'Dfd-Icon-Dollar'),
		array('dfd-icon-dress' => 'Dfd-Icon-Dress'),
		array('dfd-icon-euro' => 'Dfd-Icon-Euro'),
		array('dfd-icon-eyeware' => 'Dfd-Icon-Eyeware'),
		array('dfd-icon-gift_wrap' => 'Dfd-Icon-Gift_wrap'),
		array('dfd-icon-graph' => 'Dfd-Icon-Graph'),
		array('dfd-icon-graph_growth' => 'Dfd-Icon-Graph_growth'),
		array('dfd-icon-hanger' => 'Dfd-Icon-Hanger'),
		array('dfd-icon-hanger_clothing' => 'Dfd-Icon-Hanger_clothing'),
		array('dfd-icon-headphones' => 'Dfd-Icon-Headphones'),
		array('dfd-icon-heart' => 'Dfd-Icon-Heart'),
		array('dfd-icon-high_heels' => 'Dfd-Icon-High_heels'),
		array('dfd-icon-insert_coin' => 'Dfd-Icon-Insert_coin'),
		array('dfd-icon-lipstick' => 'Dfd-Icon-Lipstick'),
		array('dfd-icon-mascara' => 'Dfd-Icon-Mascara'),
		array('dfd-icon-moneybag' => 'Dfd-Icon-Moneybag'),
		array('dfd-icon-moneybag_dollar' => 'Dfd-Icon-Moneybag_dollar'),
		array('dfd-icon-moneybag_euro' => 'Dfd-Icon-Moneybag_euro'),
		array('dfd-icon-new' => 'Dfd-Icon-New'),
		array('dfd-icon-open' => 'Dfd-Icon-Open'),
		array('dfd-icon-pants' => 'Dfd-Icon-Pants'),
		array('dfd-icon-paper' => 'Dfd-Icon-Paper'),
		array('dfd-icon-parfume' => 'Dfd-Icon-Parfume'),
		array('dfd-icon-pie_chart_1' => 'Dfd-Icon-Pie_chart_1'),
		array('dfd-icon-pie_chart_2' => 'Dfd-Icon-Pie_chart_2'),
		array('dfd-icon-pie_chart_3' => 'Dfd-Icon-Pie_chart_3'),
		array('dfd-icon-piggy_bank' => 'Dfd-Icon-Piggy_bank'),
		array('dfd-icon-piggy_bank_add' => 'Dfd-Icon-Piggy_bank_add'),
		array('dfd-icon-piggy_bank_coin' => 'Dfd-Icon-Piggy_bank_coin'),
		array('dfd-icon-piggy_bank_input' => 'Dfd-Icon-Piggy_bank_input'),
		array('dfd-icon-piggy_bank_output' => 'Dfd-Icon-Piggy_bank_output'),
		array('dfd-icon-piggy_bank_remove' => 'Dfd-Icon-Piggy_bank_remove'),
		array('dfd-icon-sale_1' => 'Dfd-Icon-Sale_1'),
		array('dfd-icon-sale_2' => 'Dfd-Icon-Sale_2'),
		array('dfd-icon-sale_3' => 'Dfd-Icon-Sale_3'),
		array('dfd-icon-scales' => 'Dfd-Icon-Scales'),
		array('dfd-icon-ship' => 'Dfd-Icon-Ship'),
		array('dfd-icon-shoes' => 'Dfd-Icon-Shoes'),
		array('dfd-icon-shop' => 'Dfd-Icon-Shop'),
		array('dfd-icon-shopping_bag_1' => 'Dfd-Icon-Shopping_bag_1'),
		array('dfd-icon-shopping_bag_2' => 'Dfd-Icon-Shopping_bag_2'),
		array('dfd-icon-star2' => 'Dfd-Icon-Star2'),
		array('dfd-icon-storage_box' => 'Dfd-Icon-Storage_box'),
		array('dfd-icon-strongbox' => 'Dfd-Icon-Strongbox'),
		array('dfd-icon-suit' => 'Dfd-Icon-Suit'),
		array('dfd-icon-tag' => 'Dfd-Icon-Tag'),
		array('dfd-icon-trash' => 'Dfd-Icon-Trash'),
		array('dfd-icon-trolley_1' => 'Dfd-Icon-Trolley_1'),
		array('dfd-icon-trolley_2' => 'Dfd-Icon-Trolley_2'),
		array('dfd-icon-trolley_3' => 'Dfd-Icon-Trolley_3'),
		array('dfd-icon-trolley_add' => 'Dfd-Icon-Trolley_add'),
		array('dfd-icon-trolley_check' => 'Dfd-Icon-Trolley_check'),
		array('dfd-icon-trolley_close' => 'Dfd-Icon-Trolley_close'),
		array('dfd-icon-trolley_full' => 'Dfd-Icon-Trolley_full'),
		array('dfd-icon-trolley_input' => 'Dfd-Icon-Trolley_input'),
		array('dfd-icon-trolley_like' => 'Dfd-Icon-Trolley_like'),
		array('dfd-icon-trolley_output' => 'Dfd-Icon-Trolley_output'),
		array('dfd-icon-trolley_remove' => 'Dfd-Icon-Trolley_remove'),
		array('dfd-icon-trolley_settings' => 'Dfd-Icon-Trolley_settings'),
		array('dfd-icon-t-shirt' => 'Dfd-Icon-T-Shirt'),
		array('dfd-icon-underware' => 'Dfd-Icon-Underware'),
		array('dfd-icon-wallet_1' => 'Dfd-Icon-Wallet_1'),
		array('dfd-icon-wallet_2' => 'Dfd-Icon-Wallet_2'),
		array('dfd-icon-warehouse' => 'Dfd-Icon-Warehouse'),
		array('dfd-icon-cloud' => 'Dfd-Icon-Cloud'),
		array('dfd-icon-cloud_block' => 'Dfd-Icon-Cloud_block'),
		array('dfd-icon-cloud_check' => 'Dfd-Icon-Cloud_check'),
		array('dfd-icon-cloud_close' => 'Dfd-Icon-Cloud_close'),
		array('dfd-icon-cloud_download' => 'Dfd-Icon-Cloud_download'),
		array('dfd-icon-cloud_edit' => 'Dfd-Icon-Cloud_edit'),
		array('dfd-icon-cloud_lock' => 'Dfd-Icon-Cloud_lock'),
		array('dfd-icon-cloud_minus' => 'Dfd-Icon-Cloud_minus'),
		array('dfd-icon-cloud_plus' => 'Dfd-Icon-Cloud_plus'),
		array('dfd-icon-cloud_refresh' => 'Dfd-Icon-Cloud_refresh'),
		array('dfd-icon-cloud_reload' => 'Dfd-Icon-Cloud_reload'),
		array('dfd-icon-cloud_settings' => 'Dfd-Icon-Cloud_settings'),
		array('dfd-icon-cloud_upload' => 'Dfd-Icon-Cloud_upload'),
		array('dfd-icon-database' => 'Dfd-Icon-Database'),
		array('dfd-icon-database_block' => 'Dfd-Icon-Database_block'),
		array('dfd-icon-database_check' => 'Dfd-Icon-Database_check'),
		array('dfd-icon-database_clock' => 'Dfd-Icon-Database_clock'),
		array('dfd-icon-database_close' => 'Dfd-Icon-Database_close'),
		array('dfd-icon-database_doengrade' => 'Dfd-Icon-Database_doengrade'),
		array('dfd-icon-database_edit' => 'Dfd-Icon-Database_edit'),
		array('dfd-icon-database_electric' => 'Dfd-Icon-Database_electric'),
		array('dfd-icon-database_error' => 'Dfd-Icon-Database_error'),
		array('dfd-icon-database_lock' => 'Dfd-Icon-Database_lock'),
		array('dfd-icon-database_minus' => 'Dfd-Icon-Database_minus'),
		array('dfd-icon-database_plus' => 'Dfd-Icon-Database_plus'),
		array('dfd-icon-database_repair' => 'Dfd-Icon-Database_repair'),
		array('dfd-icon-database_search' => 'Dfd-Icon-Database_search'),
		array('dfd-icon-database_settings' => 'Dfd-Icon-Database_settings'),
		array('dfd-icon-database_upgrade' => 'Dfd-Icon-Database_upgrade'),
		array('dfd-icon-server_1' => 'Dfd-Icon-Server_1'),
		array('dfd-icon-server_2' => 'Dfd-Icon-Server_2'),
		array('dfd-icon-server_block' => 'Dfd-Icon-Server_block'),
		array('dfd-icon-server_computer' => 'Dfd-Icon-Server_computer'),
		array('dfd-icon-server_downgrade' => 'Dfd-Icon-Server_downgrade'),
		array('dfd-icon-server_lock' => 'Dfd-Icon-Server_lock'),
		array('dfd-icon-server_repair' => 'Dfd-Icon-Server_repair'),
		array('dfd-icon-server_search' => 'Dfd-Icon-Server_search'),
		array('dfd-icon-server_settings' => 'Dfd-Icon-Server_settings'),
		array('dfd-icon-server_upgrade' => 'Dfd-Icon-Server_upgrade'),
		array('dfd-icon-servers' => 'Dfd-Icon-Servers'),
		array('dfd-icon-alien' => 'Dfd-Icon-Alien'),
		array('dfd-icon-anemometer' => 'Dfd-Icon-Anemometer'),
		array('dfd-icon-bacterium' => 'Dfd-Icon-Bacterium'),
		array('dfd-icon-biohazard' => 'Dfd-Icon-Biohazard'),
		array('dfd-icon-chemical_weapon' => 'Dfd-Icon-Chemical_weapon'),
		array('dfd-icon-deuterium' => 'Dfd-Icon-Deuterium'),
		array('dfd-icon-evolution' => 'Dfd-Icon-Evolution'),
		array('dfd-icon-hydrogen' => 'Dfd-Icon-Hydrogen'),
		array('dfd-icon-molecule' => 'Dfd-Icon-Molecule'),
		array('dfd-icon-mouse' => 'Dfd-Icon-Mouse'),
		array('dfd-icon-observatory_1' => 'Dfd-Icon-Observatory_1'),
		array('dfd-icon-observatory_2' => 'Dfd-Icon-Observatory_2'),
		array('dfd-icon-Petri_dish' => 'Dfd-Icon-Petri_dish'),
		array('dfd-icon-planet' => 'Dfd-Icon-Planet'),
		array('dfd-icon-quadcopter' => 'Dfd-Icon-Quadcopter'),
		array('dfd-icon-robot' => 'Dfd-Icon-Robot'),
		array('dfd-icon-skeleton' => 'Dfd-Icon-Skeleton'),
		array('dfd-icon-telescope' => 'Dfd-Icon-Telescope'),
		array('dfd-icon-ufo' => 'Dfd-Icon-Ufo'),
		array('dfd-icon-water_molecule' => 'Dfd-Icon-Water_molecule'),
		array('dfd-icon-area_1' => 'Dfd-Icon-Area_1'),
		array('dfd-icon-area_2' => 'Dfd-Icon-Area_2'),
		array('dfd-icon-armchair' => 'Dfd-Icon-Armchair'),
		array('dfd-icon-axe2' => 'Dfd-Icon-Axe2'),
		array('dfd-icon-bank2' => 'Dfd-Icon-Bank2'),
		array('dfd-icon-bath' => 'Dfd-Icon-Bath'),
		array('dfd-icon-bed' => 'Dfd-Icon-Bed'),
		array('dfd-icon-brush' => 'Dfd-Icon-Brush'),
		array('dfd-icon-building_1' => 'Dfd-Icon-Building_1'),
		array('dfd-icon-building_2' => 'Dfd-Icon-Building_2'),
		array('dfd-icon-building_office' => 'Dfd-Icon-Building_office'),
		array('dfd-icon-bulb' => 'Dfd-Icon-Bulb'),
		array('dfd-icon-cabinet' => 'Dfd-Icon-Cabinet'),
		array('dfd-icon-chair' => 'Dfd-Icon-Chair'),
		array('dfd-icon-church' => 'Dfd-Icon-Church'),
		array('dfd-icon-crane' => 'Dfd-Icon-Crane'),
		array('dfd-icon-curtains' => 'Dfd-Icon-Curtains'),
		array('dfd-icon-director_chair' => 'Dfd-Icon-Director_chair'),
		array('dfd-icon-door' => 'Dfd-Icon-Door'),
		array('dfd-icon-downstairs' => 'Dfd-Icon-Downstairs'),
		array('dfd-icon-factory' => 'Dfd-Icon-Factory'),
		array('dfd-icon-fence' => 'Dfd-Icon-Fence'),
		array('dfd-icon-floor_plan' => 'Dfd-Icon-Floor_plan'),
		array('dfd-icon-fridge' => 'Dfd-Icon-Fridge'),
		array('dfd-icon-hammer2' => 'Dfd-Icon-Hammer2'),
		array('dfd-icon-hanger_floor' => 'Dfd-Icon-Hanger_floor'),
		array('dfd-icon-hard_hat' => 'Dfd-Icon-Hard_hat'),
		array('dfd-icon-height' => 'Dfd-Icon-Height'),
		array('dfd-icon-house_1' => 'Dfd-Icon-House_1'),
		array('dfd-icon-house_2' => 'Dfd-Icon-House_2'),
		array('dfd-icon-house_lock' => 'Dfd-Icon-House_lock'),
		array('dfd-icon-house_love' => 'Dfd-Icon-House_love'),
		array('dfd-icon-house_plan' => 'Dfd-Icon-House_plan'),
		array('dfd-icon-house_sale' => 'Dfd-Icon-House_sale'),
		array('dfd-icon-house_search' => 'Dfd-Icon-House_search'),
		array('dfd-icon-house_sell' => 'Dfd-Icon-House_sell'),
		array('dfd-icon-house_window' => 'Dfd-Icon-House_window'),
		array('dfd-icon-lamp_1' => 'Dfd-Icon-Lamp_1'),
		array('dfd-icon-lamp_2' => 'Dfd-Icon-Lamp_2'),
		array('dfd-icon-mail_box' => 'Dfd-Icon-Mail_box'),
		array('dfd-icon-mirror' => 'Dfd-Icon-Mirror'),
		array('dfd-icon-moving' => 'Dfd-Icon-Moving'),
		array('dfd-icon-office_table' => 'Dfd-Icon-Office_table'),
		array('dfd-icon-paint_roller' => 'Dfd-Icon-Paint_roller'),
		array('dfd-icon-rent' => 'Dfd-Icon-Rent'),
		array('dfd-icon-sale' => 'Dfd-Icon-Sale'),
		array('dfd-icon-saw' => 'Dfd-Icon-Saw'),
		array('dfd-icon-screwdriver' => 'Dfd-Icon-Screwdriver'),
		array('dfd-icon-shop2' => 'Dfd-Icon-Shop2'),
		array('dfd-icon-shovel' => 'Dfd-Icon-Shovel'),
		array('dfd-icon-sofa' => 'Dfd-Icon-Sofa'),
		array('dfd-icon-sold' => 'Dfd-Icon-Sold'),
		array('dfd-icon-swiming_pool' => 'Dfd-Icon-Swiming_pool'),
		array('dfd-icon-table' => 'Dfd-Icon-Table'),
		array('dfd-icon-table_chair' => 'Dfd-Icon-Table_chair'),
		array('dfd-icon-tape_line' => 'Dfd-Icon-Tape_line'),
		array('dfd-icon-toilet' => 'Dfd-Icon-Toilet'),
		array('dfd-icon-toilet_paper' => 'Dfd-Icon-Toilet_paper'),
		array('dfd-icon-tree' => 'Dfd-Icon-Tree'),
		array('dfd-icon-trowel' => 'Dfd-Icon-Trowel'),
		array('dfd-icon-TV' => 'Dfd-Icon-TV'),
		array('dfd-icon-upstairs' => 'Dfd-Icon-Upstairs'),
		array('dfd-icon-warehouse2' => 'Dfd-Icon-Warehouse2'),
		array('dfd-icon-washer' => 'Dfd-Icon-Washer'),
		array('dfd-icon-clipboard2' => 'Dfd-Icon-Clipboard2'),
		array('dfd-icon-clipboard_block' => 'Dfd-Icon-Clipboard_block'),
		array('dfd-icon-clipboard_check' => 'Dfd-Icon-Clipboard_check'),
		array('dfd-icon-clipboard_close' => 'Dfd-Icon-Clipboard_close'),
		array('dfd-icon-clipboard_favorite' => 'Dfd-Icon-Clipboard_favorite'),
		array('dfd-icon-clipboard_minus' => 'Dfd-Icon-Clipboard_minus'),
		array('dfd-icon-clipboard_money' => 'Dfd-Icon-Clipboard_money'),
		array('dfd-icon-clipboard_plus' => 'Dfd-Icon-Clipboard_plus'),
		array('dfd-icon-clipboard_question' => 'Dfd-Icon-Clipboard_question'),
		array('dfd-icon-clipboard_settings' => 'Dfd-Icon-Clipboard_settings'),
		array('dfd-icon-note' => 'Dfd-Icon-Note'),
		array('dfd-icon-note_block' => 'Dfd-Icon-Note_block'),
		array('dfd-icon-note_check' => 'Dfd-Icon-Note_check'),
		array('dfd-icon-note_close' => 'Dfd-Icon-Note_close'),
		array('dfd-icon-note_favorite' => 'Dfd-Icon-Note_favorite'),
		array('dfd-icon-note_minus' => 'Dfd-Icon-Note_minus'),
		array('dfd-icon-note_money' => 'Dfd-Icon-Note_money'),
		array('dfd-icon-note_plus' => 'Dfd-Icon-Note_plus'),
		array('dfd-icon-note_question' => 'Dfd-Icon-Note_question'),
		array('dfd-icon-note_settings' => 'Dfd-Icon-Note_settings'),
		array('dfd-icon-ambulance' => 'Dfd-Icon-Ambulance'),
		array('dfd-icon-atom' => 'Dfd-Icon-Atom'),
		array('dfd-icon-band_aid_1' => 'Dfd-Icon-Band_aid_1'),
		array('dfd-icon-band_aid_2' => 'Dfd-Icon-Band_aid_2'),
		array('dfd-icon-blister_pack' => 'Dfd-Icon-Blister_pack'),
		array('dfd-icon-blood_minus' => 'Dfd-Icon-Blood_minus'),
		array('dfd-icon-blood_plus' => 'Dfd-Icon-Blood_plus'),
		array('dfd-icon-blood_pressure_meter' => 'Dfd-Icon-Blood_pressure_meter'),
		array('dfd-icon-book_med' => 'Dfd-Icon-Book_med'),
		array('dfd-icon-bottle_1' => 'Dfd-Icon-Bottle_1'),
		array('dfd-icon-bottle_2' => 'Dfd-Icon-Bottle_2'),
		array('dfd-icon-cardiograph' => 'Dfd-Icon-Cardiograph'),
		array('dfd-icon-case_med' => 'Dfd-Icon-Case_med'),
		array('dfd-icon-chemistry' => 'Dfd-Icon-Chemistry'),
		array('dfd-icon-clipboard3' => 'Dfd-Icon-Clipboard3'),
		array('dfd-icon-clipboard_pulse' => 'Dfd-Icon-Clipboard_pulse'),
		array('dfd-icon-cross' => 'Dfd-Icon-Cross'),
		array('dfd-icon-crutch' => 'Dfd-Icon-Crutch'),
		array('dfd-icon-DNA' => 'Dfd-Icon-DNA'),
		array('dfd-icon-doctor2' => 'Dfd-Icon-Doctor2'),
		array('dfd-icon-dropper' => 'Dfd-Icon-Dropper'),
		array('dfd-icon-eye' => 'Dfd-Icon-Eye'),
		array('dfd-icon-female' => 'Dfd-Icon-Female'),
		array('dfd-icon-flask' => 'Dfd-Icon-Flask'),
		array('dfd-icon-glasses' => 'Dfd-Icon-Glasses'),
		array('dfd-icon-heart_pulse' => 'Dfd-Icon-Heart_pulse'),
		array('dfd-icon-hospital_1' => 'Dfd-Icon-Hospital_1'),
		array('dfd-icon-hospital_2' => 'Dfd-Icon-Hospital_2'),
		array('dfd-icon-hospital_3' => 'Dfd-Icon-Hospital_3'),
		array('dfd-icon-hospital_bed' => 'Dfd-Icon-Hospital_bed'),
		array('dfd-icon-IV_bag_1' => 'Dfd-Icon-IV_bag_1'),
		array('dfd-icon-IV_bag_2' => 'Dfd-Icon-IV_bag_2'),
		array('dfd-icon-male' => 'Dfd-Icon-Male'),
		array('dfd-icon-med_monitor' => 'Dfd-Icon-Med_monitor'),
		array('dfd-icon-microscope' => 'Dfd-Icon-Microscope'),
		array('dfd-icon-nurse' => 'Dfd-Icon-Nurse'),
		array('dfd-icon-pill' => 'Dfd-Icon-Pill'),
		array('dfd-icon-round_flask' => 'Dfd-Icon-Round_flask'),
		array('dfd-icon-scales2' => 'Dfd-Icon-Scales2'),
		array('dfd-icon-stethoscope' => 'Dfd-Icon-Stethoscope'),
		array('dfd-icon-stretcher' => 'Dfd-Icon-Stretcher'),
		array('dfd-icon-syringe_1' => 'Dfd-Icon-Syringe_1'),
		array('dfd-icon-syringe_2' => 'Dfd-Icon-Syringe_2'),
		array('dfd-icon-tablet' => 'Dfd-Icon-Tablet'),
		array('dfd-icon-test_tube' => 'Dfd-Icon-Test_tube'),
		array('dfd-icon-thermometer' => 'Dfd-Icon-Thermometer'),
		array('dfd-icon-tooth' => 'Dfd-Icon-Tooth'),
		array('dfd-icon-toothbrush' => 'Dfd-Icon-Toothbrush'),
		array('dfd-icon-wheelchair_1' => 'Dfd-Icon-Wheelchair_1'),
		array('dfd-icon-wheelchair_2' => 'Dfd-Icon-Wheelchair_2'),
		array('dfd-icon-aperture' => 'Dfd-Icon-Aperture'),
		array('dfd-icon-cassette' => 'Dfd-Icon-Cassette'),
		array('dfd-icon-clapperboard' => 'Dfd-Icon-Clapperboard'),
		array('dfd-icon-dj_1' => 'Dfd-Icon-Dj_1'),
		array('dfd-icon-dj_2' => 'Dfd-Icon-Dj_2'),
		array('dfd-icon-drum' => 'Dfd-Icon-Drum'),
		array('dfd-icon-eject' => 'Dfd-Icon-Eject'),
		array('dfd-icon-eject2' => 'Dfd-Icon-Eject2'),
		array('dfd-icon-equalizer' => 'Dfd-Icon-Equalizer'),
		array('dfd-icon-film' => 'Dfd-Icon-Film'),
		array('dfd-icon-film_strip' => 'Dfd-Icon-Film_strip'),
		array('dfd-icon-first' => 'Dfd-Icon-First'),
		array('dfd-icon-first2' => 'Dfd-Icon-First2'),
		array('dfd-icon-gramophone' => 'Dfd-Icon-Gramophone'),
		array('dfd-icon-guitar' => 'Dfd-Icon-Guitar'),
		array('dfd-icon-headphones2' => 'Dfd-Icon-Headphones2'),
		array('dfd-icon-ipod_1' => 'Dfd-Icon-Ipod_1'),
		array('dfd-icon-ipod_2' => 'Dfd-Icon-Ipod_2'),
		array('dfd-icon-last' => 'Dfd-Icon-Last'),
		array('dfd-icon-last2' => 'Dfd-Icon-Last2'),
		array('dfd-icon-metronome' => 'Dfd-Icon-Metronome'),
		array('dfd-icon-microphone_1' => 'Dfd-Icon-Microphone_1'),
		array('dfd-icon-microphone_2' => 'Dfd-Icon-Microphone_2'),
		array('dfd-icon-microphone_3' => 'Dfd-Icon-Microphone_3'),
		array('dfd-icon-next' => 'Dfd-Icon-Next'),
		array('dfd-icon-next2' => 'Dfd-Icon-Next2'),
		array('dfd-icon-note_1' => 'Dfd-Icon-Note_1'),
		array('dfd-icon-note_2' => 'Dfd-Icon-Note_2'),
		array('dfd-icon-note_3' => 'Dfd-Icon-Note_3'),
		array('dfd-icon-note_4' => 'Dfd-Icon-Note_4'),
		array('dfd-icon-palaroid' => 'Dfd-Icon-Palaroid'),
		array('dfd-icon-pan_flute' => 'Dfd-Icon-Pan_flute'),
		array('dfd-icon-pause' => 'Dfd-Icon-Pause'),
		array('dfd-icon-pause2' => 'Dfd-Icon-Pause2'),
		array('dfd-icon-phone_note' => 'Dfd-Icon-Phone_note'),
		array('dfd-icon-photo' => 'Dfd-Icon-Photo'),
		array('dfd-icon-photo_block' => 'Dfd-Icon-Photo_block'),
		array('dfd-icon-photo_center' => 'Dfd-Icon-Photo_center'),
		array('dfd-icon-photo_download' => 'Dfd-Icon-Photo_download'),
		array('dfd-icon-photo_flower' => 'Dfd-Icon-Photo_flower'),
		array('dfd-icon-photo_landscape' => 'Dfd-Icon-Photo_landscape'),
		array('dfd-icon-photo_man' => 'Dfd-Icon-Photo_man'),
		array('dfd-icon-photo_trio' => 'Dfd-Icon-Photo_trio'),
		array('dfd-icon-photo_upload' => 'Dfd-Icon-Photo_upload'),
		array('dfd-icon-photocamera_1' => 'Dfd-Icon-Photocamera_1'),
		array('dfd-icon-photocamera_2' => 'Dfd-Icon-Photocamera_2'),
		array('dfd-icon-photocamera_3' => 'Dfd-Icon-Photocamera_3'),
		array('dfd-icon-photocamera_4' => 'Dfd-Icon-Photocamera_4'),
		array('dfd-icon-photocamera_light' => 'Dfd-Icon-Photocamera_light'),
		array('dfd-icon-photocamera_tripod' => 'Dfd-Icon-Photocamera_tripod'),
		array('dfd-icon-photocamera_upload' => 'Dfd-Icon-Photocamera_upload'),
		array('dfd-icon-photos' => 'Dfd-Icon-Photos'),
		array('dfd-icon-piano_1' => 'Dfd-Icon-Piano_1'),
		array('dfd-icon-piano_2' => 'Dfd-Icon-Piano_2'),
		array('dfd-icon-piano_chair' => 'Dfd-Icon-Piano_chair'),
		array('dfd-icon-play' => 'Dfd-Icon-Play'),
		array('dfd-icon-play2' => 'Dfd-Icon-Play2'),
		array('dfd-icon-play_film' => 'Dfd-Icon-Play_film'),
		array('dfd-icon-play_presentation' => 'Dfd-Icon-Play_presentation'),
		array('dfd-icon-player3' => 'Dfd-Icon-Player3'),
		array('dfd-icon-previous' => 'Dfd-Icon-Previous'),
		array('dfd-icon-previous2' => 'Dfd-Icon-Previous2'),
		array('dfd-icon-record' => 'Dfd-Icon-Record'),
		array('dfd-icon-recorder' => 'Dfd-Icon-Recorder'),
		array('dfd-icon-speaker_1' => 'Dfd-Icon-Speaker_1'),
		array('dfd-icon-speaker_2' => 'Dfd-Icon-Speaker_2'),
		array('dfd-icon-stop' => 'Dfd-Icon-Stop'),
		array('dfd-icon-ticket' => 'Dfd-Icon-Ticket'),
		array('dfd-icon-trumpet' => 'Dfd-Icon-Trumpet'),
		array('dfd-icon-tuning_fork' => 'Dfd-Icon-Tuning_fork'),
		array('dfd-icon-TV2' => 'Dfd-Icon-TV2'),
		array('dfd-icon-videocamera_1' => 'Dfd-Icon-Videocamera_1'),
		array('dfd-icon-videocamera_2' => 'Dfd-Icon-Videocamera_2'),
		array('dfd-icon-videocamera_3' => 'Dfd-Icon-Videocamera_3'),
		array('dfd-icon-videocamera_4' => 'Dfd-Icon-Videocamera_4'),
		array('dfd-icon-volume' => 'Dfd-Icon-Volume'),
		array('dfd-icon-volume_check' => 'Dfd-Icon-Volume_check'),
		array('dfd-icon-volume_max' => 'Dfd-Icon-Volume_max'),
		array('dfd-icon-volume_middle' => 'Dfd-Icon-Volume_middle'),
		array('dfd-icon-volume_min' => 'Dfd-Icon-Volume_min'),
		array('dfd-icon-volume_minus' => 'Dfd-Icon-Volume_minus'),
		array('dfd-icon-volume_mute' => 'Dfd-Icon-Volume_mute'),
		array('dfd-icon-volume_off' => 'Dfd-Icon-Volume_off'),
		array('dfd-icon-volume_plus' => 'Dfd-Icon-Volume_plus'),
		array('dfd-icon-compass' => 'Dfd-Icon-Compass'),
		array('dfd-icon-directions_1' => 'Dfd-Icon-Directions_1'),
		array('dfd-icon-directions_2' => 'Dfd-Icon-Directions_2'),
		array('dfd-icon-earth' => 'Dfd-Icon-Earth'),
		array('dfd-icon-flag' => 'Dfd-Icon-Flag'),
		array('dfd-icon-flag_location_1' => 'Dfd-Icon-Flag_location_1'),
		array('dfd-icon-flag_location_2' => 'Dfd-Icon-Flag_location_2'),
		array('dfd-icon-globe' => 'Dfd-Icon-Globe'),
		array('dfd-icon-map' => 'Dfd-Icon-Map'),
		array('dfd-icon-map_marker' => 'Dfd-Icon-Map_marker'),
		array('dfd-icon-map_pin' => 'Dfd-Icon-Map_pin'),
		array('dfd-icon-map_way' => 'Dfd-Icon-Map_way'),
		array('dfd-icon-marker' => 'Dfd-Icon-Marker'),
		array('dfd-icon-marker_close' => 'Dfd-Icon-Marker_close'),
		array('dfd-icon-marker_location_1' => 'Dfd-Icon-Marker_location_1'),
		array('dfd-icon-marker_location_2' => 'Dfd-Icon-Marker_location_2'),
		array('dfd-icon-marker_location_3' => 'Dfd-Icon-Marker_location_3'),
		array('dfd-icon-marker_minus' => 'Dfd-Icon-Marker_minus'),
		array('dfd-icon-marker_plus' => 'Dfd-Icon-Marker_plus'),
		array('dfd-icon-marker_star' => 'Dfd-Icon-Marker_star'),
		array('dfd-icon-navigation' => 'Dfd-Icon-Navigation'),
		array('dfd-icon-near_me' => 'Dfd-Icon-Near_me'),
		array('dfd-icon-pin' => 'Dfd-Icon-Pin'),
		array('dfd-icon-pin_location_1' => 'Dfd-Icon-Pin_location_1'),
		array('dfd-icon-pin_location_2' => 'Dfd-Icon-Pin_location_2'),
		array('dfd-icon-signpost_1' => 'Dfd-Icon-Signpost_1'),
		array('dfd-icon-signpost_2' => 'Dfd-Icon-Signpost_2'),
		array('dfd-icon-signpost_3' => 'Dfd-Icon-Signpost_3'),
		array('dfd-icon-target3' => 'Dfd-Icon-Target3'),
		array('dfd-icon-user_location2' => 'Dfd-Icon-User_location2'),
		array('dfd-icon-anchor' => 'Dfd-Icon-Anchor'),
		array('dfd-icon-ankh' => 'Dfd-Icon-Ankh'),
		array('dfd-icon-attention' => 'Dfd-Icon-Attention'),
		array('dfd-icon-ban' => 'Dfd-Icon-Ban'),
		array('dfd-icon-battery' => 'Dfd-Icon-Battery'),
		array('dfd-icon-battery_average' => 'Dfd-Icon-Battery_average'),
		array('dfd-icon-battery_full' => 'Dfd-Icon-Battery_full'),
		array('dfd-icon-battery_low' => 'Dfd-Icon-Battery_low'),
		array('dfd-icon-block' => 'Dfd-Icon-Block'),
		array('dfd-icon-book' => 'Dfd-Icon-Book'),
		array('dfd-icon-bookmark' => 'Dfd-Icon-Bookmark'),
		array('dfd-icon-briefcase2' => 'Dfd-Icon-Briefcase2'),
		array('dfd-icon-brouser_cursor' => 'Dfd-Icon-Brouser_cursor'),
		array('dfd-icon-browser' => 'Dfd-Icon-Browser'),
		array('dfd-icon-browser_404' => 'Dfd-Icon-Browser_404'),
		array('dfd-icon-browser_favorite' => 'Dfd-Icon-Browser_favorite'),
		array('dfd-icon-browser_html' => 'Dfd-Icon-Browser_html'),
		array('dfd-icon-browser_search' => 'Dfd-Icon-Browser_search'),
		array('dfd-icon-browser_settings' => 'Dfd-Icon-Browser_settings'),
		array('dfd-icon-browser_website' => 'Dfd-Icon-Browser_website'),
		array('dfd-icon-bulb_1' => 'Dfd-Icon-Bulb_1'),
		array('dfd-icon-bulb_2' => 'Dfd-Icon-Bulb_2'),
		array('dfd-icon-calculator2' => 'Dfd-Icon-Calculator2'),
		array('dfd-icon-calendar2' => 'Dfd-Icon-Calendar2'),
		array('dfd-icon-calendar_date2' => 'Dfd-Icon-Calendar_date2'),
		array('dfd-icon-call_end' => 'Dfd-Icon-Call_end'),
		array('dfd-icon-call_incoming' => 'Dfd-Icon-Call_incoming'),
		array('dfd-icon-call_outgoing' => 'Dfd-Icon-Call_outgoing'),
		array('dfd-icon-cigarette' => 'Dfd-Icon-Cigarette'),
		array('dfd-icon-circle_check' => 'Dfd-Icon-Circle_check'),
		array('dfd-icon-circle_delete' => 'Dfd-Icon-Circle_delete'),
		array('dfd-icon-circle_division' => 'Dfd-Icon-Circle_division'),
		array('dfd-icon-circle_down' => 'Dfd-Icon-Circle_down'),
		array('dfd-icon-circle_equal' => 'Dfd-Icon-Circle_equal'),
		array('dfd-icon-circle_left' => 'Dfd-Icon-Circle_left'),
		array('dfd-icon-circle_minus' => 'Dfd-Icon-Circle_minus'),
		array('dfd-icon-circle_plus' => 'Dfd-Icon-Circle_plus'),
		array('dfd-icon-circle_right' => 'Dfd-Icon-Circle_right'),
		array('dfd-icon-circle_up' => 'Dfd-Icon-Circle_up'),
		array('dfd-icon-click' => 'Dfd-Icon-Click'),
		array('dfd-icon-clip' => 'Dfd-Icon-Clip'),
		array('dfd-icon-code' => 'Dfd-Icon-Code'),
		array('dfd-icon-coding' => 'Dfd-Icon-Coding'),
		array('dfd-icon-compasses' => 'Dfd-Icon-Compasses'),
		array('dfd-icon-computer_1' => 'Dfd-Icon-Computer_1'),
		array('dfd-icon-computer_2' => 'Dfd-Icon-Computer_2'),
		array('dfd-icon-computer_analytics' => 'Dfd-Icon-Computer_analytics'),
		array('dfd-icon-computer_key' => 'Dfd-Icon-Computer_key'),
		array('dfd-icon-computer_music' => 'Dfd-Icon-Computer_music'),
		array('dfd-icon-computer_network' => 'Dfd-Icon-Computer_network'),
		array('dfd-icon-computer_phone' => 'Dfd-Icon-Computer_phone'),
		array('dfd-icon-computer_search' => 'Dfd-Icon-Computer_search'),
		array('dfd-icon-computer_settings' => 'Dfd-Icon-Computer_settings'),
		array('dfd-icon-condom_1' => 'Dfd-Icon-Condom_1'),
		array('dfd-icon-condom_2' => 'Dfd-Icon-Condom_2'),
		array('dfd-icon-contacts' => 'Dfd-Icon-Contacts'),
		array('dfd-icon-controller' => 'Dfd-Icon-Controller'),
		array('dfd-icon-court' => 'Dfd-Icon-Court'),
		array('dfd-icon-cross2' => 'Dfd-Icon-Cross2'),
		array('dfd-icon-diamond' => 'Dfd-Icon-Diamond'),
		array('dfd-icon-diamond_ring' => 'Dfd-Icon-Diamond_ring'),
		array('dfd-icon-diod' => 'Dfd-Icon-Diod'),
		array('dfd-icon-domino' => 'Dfd-Icon-Domino'),
		array('dfd-icon-earphones' => 'Dfd-Icon-Earphones'),
		array('dfd-icon-earphones_microphone' => 'Dfd-Icon-Earphones_microphone'),
		array('dfd-icon-eye2' => 'Dfd-Icon-Eye2'),
		array('dfd-icon-film2' => 'Dfd-Icon-Film2'),
		array('dfd-icon-funnel' => 'Dfd-Icon-Funnel'),
		array('dfd-icon-graduation_cap' => 'Dfd-Icon-Graduation_cap'),
		array('dfd-icon-image' => 'Dfd-Icon-Image'),
		array('dfd-icon-input' => 'Dfd-Icon-Input'),
		array('dfd-icon-key_1' => 'Dfd-Icon-Key_1'),
		array('dfd-icon-key_2' => 'Dfd-Icon-Key_2'),
		array('dfd-icon-key_3' => 'Dfd-Icon-Key_3'),
		array('dfd-icon-laptop' => 'Dfd-Icon-Laptop'),
		array('dfd-icon-lifebuoy' => 'Dfd-Icon-Lifebuoy'),
		array('dfd-icon-lock' => 'Dfd-Icon-Lock'),
		array('dfd-icon-lock_open' => 'Dfd-Icon-Lock_open'),
		array('dfd-icon-magnet' => 'Dfd-Icon-Magnet'),
		array('dfd-icon-mail_inbox' => 'Dfd-Icon-Mail_inbox'),
		array('dfd-icon-mail_outbox' => 'Dfd-Icon-Mail_outbox'),
		array('dfd-icon-megaphone' => 'Dfd-Icon-Megaphone'),
		array('dfd-icon-menorah' => 'Dfd-Icon-Menorah'),
		array('dfd-icon-microphone' => 'Dfd-Icon-Microphone'),
		array('dfd-icon-mouse2' => 'Dfd-Icon-Mouse2'),
		array('dfd-icon-network' => 'Dfd-Icon-Network'),
		array('dfd-icon-newspaper' => 'Dfd-Icon-Newspaper'),
		array('dfd-icon-no_smoking' => 'Dfd-Icon-No_smoking'),
		array('dfd-icon-open_book' => 'Dfd-Icon-Open_book'),
		array('dfd-icon-output' => 'Dfd-Icon-Output'),
		array('dfd-icon-peace' => 'Dfd-Icon-Peace'),
		array('dfd-icon-pen' => 'Dfd-Icon-Pen'),
		array('dfd-icon-pencil_1' => 'Dfd-Icon-Pencil_1'),
		array('dfd-icon-pencil_2' => 'Dfd-Icon-Pencil_2'),
		array('dfd-icon-phone' => 'Dfd-Icon-Phone'),
		array('dfd-icon-photo2' => 'Dfd-Icon-Photo2'),
		array('dfd-icon-pin2' => 'Dfd-Icon-Pin2'),
		array('dfd-icon-presentation_1' => 'Dfd-Icon-Presentation_1'),
		array('dfd-icon-presentation_2' => 'Dfd-Icon-Presentation_2'),
		array('dfd-icon-presentation_3' => 'Dfd-Icon-Presentation_3'),
		array('dfd-icon-price_tag' => 'Dfd-Icon-Price_tag'),
		array('dfd-icon-printer' => 'Dfd-Icon-Printer'),
		array('dfd-icon-printer_check' => 'Dfd-Icon-Printer_check'),
		array('dfd-icon-printer_error' => 'Dfd-Icon-Printer_error'),
		array('dfd-icon-radio' => 'Dfd-Icon-Radio'),
		array('dfd-icon-rook' => 'Dfd-Icon-Rook'),
		array('dfd-icon-school_bus' => 'Dfd-Icon-School_bus'),
		array('dfd-icon-settings_1' => 'Dfd-Icon-Settings_1'),
		array('dfd-icon-settings_2' => 'Dfd-Icon-Settings_2'),
		array('dfd-icon-star_of_David' => 'Dfd-Icon-Star_of_David'),
		array('dfd-icon-strategy' => 'Dfd-Icon-Strategy'),
		array('dfd-icon-tablet2' => 'Dfd-Icon-Tablet2'),
		array('dfd-icon-target4' => 'Dfd-Icon-Target4'),
		array('dfd-icon-targeting' => 'Dfd-Icon-Targeting'),
		array('dfd-icon-umbrella' => 'Dfd-Icon-Umbrella'),
		array('dfd-icon-user2' => 'Dfd-Icon-User2'),
		array('dfd-icon-yin_yang' => 'Dfd-Icon-Yin_yang'),
		array('dfd-icon-zoom' => 'Dfd-Icon-Zoom'),
		array('dfd-icon-zoom_in' => 'Dfd-Icon-Zoom_in'),
		array('dfd-icon-zoom_out' => 'Dfd-Icon-Zoom_out'),
		array('dfd-icon-bleach_any' => 'Dfd-Icon-Bleach_any'),
		array('dfd-icon-chlorine_allowed' => 'Dfd-Icon-Chlorine_allowed'),
		array('dfd-icon-do_not_bleach' => 'Dfd-Icon-Do_not_bleach'),
		array('dfd-icon-do_not_dry' => 'Dfd-Icon-Do_not_dry'),
		array('dfd-icon-do_not_dry_clean' => 'Dfd-Icon-Do_not_dry_clean'),
		array('dfd-icon-do_not_iron' => 'Dfd-Icon-Do_not_iron'),
		array('dfd-icon-do_not_steam' => 'Dfd-Icon-Do_not_steam'),
		array('dfd-icon-do_not_tumble_dry' => 'Dfd-Icon-Do_not_tumble_dry'),
		array('dfd-icon-do_not_wash' => 'Dfd-Icon-Do_not_wash'),
		array('dfd-icon-do_not_wring' => 'Dfd-Icon-Do_not_wring'),
		array('dfd-icon-drip_dry' => 'Dfd-Icon-Drip_dry'),
		array('dfd-icon-dry' => 'Dfd-Icon-Dry'),
		array('dfd-icon-dry_clean' => 'Dfd-Icon-Dry_clean'),
		array('dfd-icon-dry_clean_any_solvent' => 'Dfd-Icon-Dry_clean_any_solvent'),
		array('dfd-icon-dry_clean_any_solvent_exept_tetrachloroethylene' => 'Dfd-Icon-Dry_clean_any_solvent_exept_tetrachloroethylene'),
		array('dfd-icon-dry_clean_any_solvent_exept_tetrachloroethylene_gentle' => 'Dfd-Icon-Dry_clean_any_solvent_exept_tetrachloroethylene_gentle'),
		array('dfd-icon-dry_clean_petroleum_solvet_only' => 'Dfd-Icon-Dry_clean_petroleum_solvet_only'),
		array('dfd-icon-dry_clean_petroleum_solvet_only_gentle' => 'Dfd-Icon-Dry_clean_petroleum_solvet_only_gentle'),
		array('dfd-icon-dry_flat' => 'Dfd-Icon-Dry_flat'),
		array('dfd-icon-dry_in_shade' => 'Dfd-Icon-Dry_in_shade'),
		array('dfd-icon-hand_wash' => 'Dfd-Icon-Hand_wash'),
		array('dfd-icon-iron_any_temperature_steam_or_dry' => 'Dfd-Icon-Iron_any_temperature_steam_or_dry'),
		array('dfd-icon-iron_high_heat' => 'Dfd-Icon-Iron_high_heat'),
		array('dfd-icon-iron_low_heat' => 'Dfd-Icon-Iron_low_heat'),
		array('dfd-icon-iron_medium_heat' => 'Dfd-Icon-Iron_medium_heat'),
		array('dfd-icon-line_dry' => 'Dfd-Icon-Line_dry'),
		array('dfd-icon-machine_wash' => 'Dfd-Icon-Machine_wash'),
		array('dfd-icon-machine_wash_30' => 'Dfd-Icon-Machine_wash_30'),
		array('dfd-icon-machine_wash_40' => 'Dfd-Icon-Machine_wash_40'),
		array('dfd-icon-machine_wash_50' => 'Dfd-Icon-Machine_wash_50'),
		array('dfd-icon-machine_wash_60' => 'Dfd-Icon-Machine_wash_60'),
		array('dfd-icon-machine_wash_70' => 'Dfd-Icon-Machine_wash_70'),
		array('dfd-icon-machine_wash_95' => 'Dfd-Icon-Machine_wash_95'),
		array('dfd-icon-machine_wash_cold' => 'Dfd-Icon-Machine_wash_cold'),
		array('dfd-icon-machine_wash_gentle' => 'Dfd-Icon-Machine_wash_gentle'),
		array('dfd-icon-machine_wash_hot_1' => 'Dfd-Icon-Machine_wash_hot_1'),
		array('dfd-icon-machine_wash_hot_2' => 'Dfd-Icon-Machine_wash_hot_2'),
		array('dfd-icon-machine_wash_hot_3' => 'Dfd-Icon-Machine_wash_hot_3'),
		array('dfd-icon-machine_wash_hot_4' => 'Dfd-Icon-Machine_wash_hot_4'),
		array('dfd-icon-machine_wash_permanent_press' => 'Dfd-Icon-Machine_wash_permanent_press'),
		array('dfd-icon-machine_wash_warm' => 'Dfd-Icon-Machine_wash_warm'),
		array('dfd-icon-non-chlorine_bleach' => 'Dfd-Icon-Non-Chlorine_bleach'),
		array('dfd-icon-tumble_dry_gentle' => 'Dfd-Icon-Tumble_dry_gentle'),
		array('dfd-icon-tumble_dry_normal' => 'Dfd-Icon-Tumble_dry_normal'),
		array('dfd-icon-tumble_dry_normal_high_heat' => 'Dfd-Icon-Tumble_dry_normal_high_heat'),
		array('dfd-icon-tumble_dry_normal_low_heat' => 'Dfd-Icon-Tumble_dry_normal_low_heat'),
		array('dfd-icon-tumble_dry_normal_medium_heat' => 'Dfd-Icon-Tumble_dry_normal_medium_heat'),
		array('dfd-icon-tumble_dry_normal_no_heat' => 'Dfd-Icon-Tumble_dry_normal_no_heat'),
		array('dfd-icon-tumble_dry_permanent_press' => 'Dfd-Icon-Tumble_dry_permanent_press'),
		array('dfd-icon-wet_cleaning' => 'Dfd-Icon-Wet_cleaning'),
		array('dfd-icon-baby_mobile' => 'Dfd-Icon-Baby_mobile'),
		array('dfd-icon-baby_monitor' => 'Dfd-Icon-Baby_monitor'),
		array('dfd-icon-ballon' => 'Dfd-Icon-Ballon'),
		array('dfd-icon-bottle_12' => 'Dfd-Icon-Bottle_12'),
		array('dfd-icon-bottle_22' => 'Dfd-Icon-Bottle_22'),
		array('dfd-icon-crib' => 'Dfd-Icon-Crib'),
		array('dfd-icon-diaper_1' => 'Dfd-Icon-Diaper_1'),
		array('dfd-icon-diaper_2' => 'Dfd-Icon-Diaper_2'),
		array('dfd-icon-kid' => 'Dfd-Icon-Kid'),
		array('dfd-icon-kid_crying' => 'Dfd-Icon-Kid_crying'),
		array('dfd-icon-kid_happy_1' => 'Dfd-Icon-Kid_happy_1'),
		array('dfd-icon-kid_happy_2' => 'Dfd-Icon-Kid_happy_2'),
		array('dfd-icon-kid_sad' => 'Dfd-Icon-Kid_sad'),
		array('dfd-icon-onesie' => 'Dfd-Icon-Onesie'),
		array('dfd-icon-pacifier_1' => 'Dfd-Icon-Pacifier_1'),
		array('dfd-icon-pacifier_2' => 'Dfd-Icon-Pacifier_2'),
		array('dfd-icon-rattle' => 'Dfd-Icon-Rattle'),
		array('dfd-icon-safety_pin' => 'Dfd-Icon-Safety_pin'),
		array('dfd-icon-stroller' => 'Dfd-Icon-Stroller'),
		array('dfd-icon-tricycle' => 'Dfd-Icon-Tricycle'),
		array('dfd-icon-american_flag' => 'Dfd-Icon-American_flag'),
		array('dfd-icon-american_hat' => 'Dfd-Icon-American_hat'),
		array('dfd-icon-angel' => 'Dfd-Icon-Angel'),
		array('dfd-icon-angel_heart' => 'Dfd-Icon-Angel_heart'),
		array('dfd-icon-balloon' => 'Dfd-Icon-Balloon'),
		array('dfd-icon-barrel' => 'Dfd-Icon-Barrel'),
		array('dfd-icon-basket' => 'Dfd-Icon-Basket'),
		array('dfd-icon-bat' => 'Dfd-Icon-Bat'),
		array('dfd-icon-bible' => 'Dfd-Icon-Bible'),
		array('dfd-icon-bow' => 'Dfd-Icon-Bow'),
		array('dfd-icon-bow_and_arrow2' => 'Dfd-Icon-Bow_and_arrow2'),
		array('dfd-icon-broken_heart' => 'Dfd-Icon-Broken_heart'),
		array('dfd-icon-broken_heart_couple' => 'Dfd-Icon-Broken_heart_couple'),
		array('dfd-icon-broom' => 'Dfd-Icon-Broom'),
		array('dfd-icon-camera' => 'Dfd-Icon-Camera'),
		array('dfd-icon-candle_1' => 'Dfd-Icon-Candle_1'),
		array('dfd-icon-candle_2' => 'Dfd-Icon-Candle_2'),
		array('dfd-icon-candy' => 'Dfd-Icon-Candy'),
		array('dfd-icon-candy_cane_1' => 'Dfd-Icon-Candy_cane_1'),
		array('dfd-icon-candy_cane_2' => 'Dfd-Icon-Candy_cane_2'),
		array('dfd-icon-cauldron' => 'Dfd-Icon-Cauldron'),
		array('dfd-icon-cemetery' => 'Dfd-Icon-Cemetery'),
		array('dfd-icon-christmas_tree_1' => 'Dfd-Icon-Christmas_tree_1'),
		array('dfd-icon-christmas_tree_2' => 'Dfd-Icon-Christmas_tree_2'),
		array('dfd-icon-church2' => 'Dfd-Icon-Church2'),
		array('dfd-icon-clover' => 'Dfd-Icon-Clover'),
		array('dfd-icon-coffin' => 'Dfd-Icon-Coffin'),
		array('dfd-icon-couple' => 'Dfd-Icon-Couple'),
		array('dfd-icon-death' => 'Dfd-Icon-Death'),
		array('dfd-icon-devil_heart' => 'Dfd-Icon-Devil_heart'),
		array('dfd-icon-dinner' => 'Dfd-Icon-Dinner'),
		array('dfd-icon-dove' => 'Dfd-Icon-Dove'),
		array('dfd-icon-drumstick' => 'Dfd-Icon-Drumstick'),
		array('dfd-icon-egg_1' => 'Dfd-Icon-Egg_1'),
		array('dfd-icon-egg_2' => 'Dfd-Icon-Egg_2'),
		array('dfd-icon-egg_3' => 'Dfd-Icon-Egg_3'),
		array('dfd-icon-elf' => 'Dfd-Icon-Elf'),
		array('dfd-icon-email' => 'Dfd-Icon-Email'),
		array('dfd-icon-firework' => 'Dfd-Icon-Firework'),
		array('dfd-icon-fish_symbol' => 'Dfd-Icon-Fish_symbol'),
		array('dfd-icon-Frankensteins_monster' => 'Dfd-Icon-Frankensteins_monster'),
		array('dfd-icon-ghost_1' => 'Dfd-Icon-Ghost_1'),
		array('dfd-icon-ghost_2' => 'Dfd-Icon-Ghost_2'),
		array('dfd-icon-gift' => 'Dfd-Icon-Gift'),
		array('dfd-icon-gift_2' => 'Dfd-Icon-Gift_2'),
		array('dfd-icon-gift_3' => 'Dfd-Icon-Gift_3'),
		array('dfd-icon-gift_4' => 'Dfd-Icon-Gift_4'),
		array('dfd-icon-gift_5' => 'Dfd-Icon-Gift_5'),
		array('dfd-icon-gift_6' => 'Dfd-Icon-Gift_6'),
		array('dfd-icon-gingerbread_man' => 'Dfd-Icon-Gingerbread_man'),
		array('dfd-icon-grave' => 'Dfd-Icon-Grave'),
		array('dfd-icon-heart2' => 'Dfd-Icon-Heart2'),
		array('dfd-icon-heart_arrow' => 'Dfd-Icon-Heart_arrow'),
		array('dfd-icon-heart_block' => 'Dfd-Icon-Heart_block'),
		array('dfd-icon-heart_connecting' => 'Dfd-Icon-Heart_connecting'),
		array('dfd-icon-heart_couple' => 'Dfd-Icon-Heart_couple'),
		array('dfd-icon-heart_price' => 'Dfd-Icon-Heart_price'),
		array('dfd-icon-heart_search' => 'Dfd-Icon-Heart_search'),
		array('dfd-icon-hockey_mask' => 'Dfd-Icon-Hockey_mask'),
		array('dfd-icon-horseshoe' => 'Dfd-Icon-Horseshoe'),
		array('dfd-icon-inlove_couple' => 'Dfd-Icon-Inlove_couple'),
		array('dfd-icon-leprechaun_hat' => 'Dfd-Icon-Leprechaun_hat'),
		array('dfd-icon-lock_heart' => 'Dfd-Icon-Lock_heart'),
		array('dfd-icon-lollipop' => 'Dfd-Icon-Lollipop'),
		array('dfd-icon-love_calendar' => 'Dfd-Icon-Love_calendar'),
		array('dfd-icon-love_couple' => 'Dfd-Icon-Love_couple'),
		array('dfd-icon-love_flower' => 'Dfd-Icon-Love_flower'),
		array('dfd-icon-love_key' => 'Dfd-Icon-Love_key'),
		array('dfd-icon-love_man' => 'Dfd-Icon-Love_man'),
		array('dfd-icon-love_ring' => 'Dfd-Icon-Love_ring'),
		array('dfd-icon-love_search' => 'Dfd-Icon-Love_search'),
		array('dfd-icon-love_woman' => 'Dfd-Icon-Love_woman'),
		array('dfd-icon-marker_love' => 'Dfd-Icon-Marker_love'),
		array('dfd-icon-mistletoe' => 'Dfd-Icon-Mistletoe'),
		array('dfd-icon-mittens' => 'Dfd-Icon-Mittens'),
		array('dfd-icon-note2' => 'Dfd-Icon-Note2'),
		array('dfd-icon-ornament_1' => 'Dfd-Icon-Ornament_1'),
		array('dfd-icon-ornament_2' => 'Dfd-Icon-Ornament_2'),
		array('dfd-icon-ornament_3' => 'Dfd-Icon-Ornament_3'),
		array('dfd-icon-ornament_4' => 'Dfd-Icon-Ornament_4'),
		array('dfd-icon-ornament_5' => 'Dfd-Icon-Ornament_5'),
		array('dfd-icon-phone2' => 'Dfd-Icon-Phone2'),
		array('dfd-icon-photo3' => 'Dfd-Icon-Photo3'),
		array('dfd-icon-pilgrim_hat' => 'Dfd-Icon-Pilgrim_hat'),
		array('dfd-icon-presents' => 'Dfd-Icon-Presents'),
		array('dfd-icon-price_tag2' => 'Dfd-Icon-Price_tag2'),
		array('dfd-icon-pumpkin_1' => 'Dfd-Icon-Pumpkin_1'),
		array('dfd-icon-pumpkin_2' => 'Dfd-Icon-Pumpkin_2'),
		array('dfd-icon-rabbit' => 'Dfd-Icon-Rabbit'),
		array('dfd-icon-reindeer' => 'Dfd-Icon-Reindeer'),
		array('dfd-icon-rings' => 'Dfd-Icon-Rings'),
		array('dfd-icon-romantic_movie' => 'Dfd-Icon-Romantic_movie'),
		array('dfd-icon-rose' => 'Dfd-Icon-Rose'),
		array('dfd-icon-sad_heart' => 'Dfd-Icon-Sad_heart'),
		array('dfd-icon-santa_hat' => 'Dfd-Icon-Santa_hat'),
		array('dfd-icon-sants_claus' => 'Dfd-Icon-Sants_claus'),
		array('dfd-icon-skull' => 'Dfd-Icon-Skull'),
		array('dfd-icon-sleigh_1' => 'Dfd-Icon-Sleigh_1'),
		array('dfd-icon-sleigh_2' => 'Dfd-Icon-Sleigh_2'),
		array('dfd-icon-smile_heart' => 'Dfd-Icon-Smile_heart'),
		array('dfd-icon-snow_globe' => 'Dfd-Icon-Snow_globe'),
		array('dfd-icon-snowflake_1' => 'Dfd-Icon-Snowflake_1'),
		array('dfd-icon-snowflake_2' => 'Dfd-Icon-Snowflake_2'),
		array('dfd-icon-snowflake_3' => 'Dfd-Icon-Snowflake_3'),
		array('dfd-icon-snowflake_4' => 'Dfd-Icon-Snowflake_4'),
		array('dfd-icon-snowflake_5' => 'Dfd-Icon-Snowflake_5'),
		array('dfd-icon-snowman' => 'Dfd-Icon-Snowman'),
		array('dfd-icon-stemware' => 'Dfd-Icon-Stemware'),
		array('dfd-icon-stocking' => 'Dfd-Icon-Stocking'),
		array('dfd-icon-tulip' => 'Dfd-Icon-Tulip'),
		array('dfd-icon-user_heart' => 'Dfd-Icon-User_heart'),
		array('dfd-icon-vampire' => 'Dfd-Icon-Vampire'),
		array('dfd-icon-wings_heart' => 'Dfd-Icon-Wings_heart'),
		array('dfd-icon-witch_hat' => 'Dfd-Icon-Witch_hat'),
		array('dfd-icon-wreath' => 'Dfd-Icon-Wreath'),
		array('dfd-icon-zombie' => 'Dfd-Icon-Zombie'),
		array('dfd-icon-aluminum_can' => 'Dfd-Icon-Aluminum_can'),
		array('dfd-icon-apple' => 'Dfd-Icon-Apple'),
		array('dfd-icon-avocado' => 'Dfd-Icon-Avocado'),
		array('dfd-icon-beaker' => 'Dfd-Icon-Beaker'),
		array('dfd-icon-beer' => 'Dfd-Icon-Beer'),
		array('dfd-icon-blender' => 'Dfd-Icon-Blender'),
		array('dfd-icon-bottle' => 'Dfd-Icon-Bottle'),
		array('dfd-icon-bread' => 'Dfd-Icon-Bread'),
		array('dfd-icon-burger' => 'Dfd-Icon-Burger'),
		array('dfd-icon-cake' => 'Dfd-Icon-Cake'),
		array('dfd-icon-carrot' => 'Dfd-Icon-Carrot'),
		array('dfd-icon-champagne' => 'Dfd-Icon-Champagne'),
		array('dfd-icon-cheese' => 'Dfd-Icon-Cheese'),
		array('dfd-icon-chef_hat' => 'Dfd-Icon-Chef_hat'),
		array('dfd-icon-cherry' => 'Dfd-Icon-Cherry'),
		array('dfd-icon-chicken' => 'Dfd-Icon-Chicken'),
		array('dfd-icon-cleaver' => 'Dfd-Icon-Cleaver'),
		array('dfd-icon-cocktail' => 'Dfd-Icon-Cocktail'),
		array('dfd-icon-coffee' => 'Dfd-Icon-Coffee'),
		array('dfd-icon-coffee_grains' => 'Dfd-Icon-Coffee_grains'),
		array('dfd-icon-coffee_grinder' => 'Dfd-Icon-Coffee_grinder'),
		array('dfd-icon-coffee_pot' => 'Dfd-Icon-Coffee_pot'),
		array('dfd-icon-coffee_to_go' => 'Dfd-Icon-Coffee_to_go'),
		array('dfd-icon-corkscrew' => 'Dfd-Icon-Corkscrew'),
		array('dfd-icon-croissant' => 'Dfd-Icon-Croissant'),
		array('dfd-icon-cupcake' => 'Dfd-Icon-Cupcake'),
		array('dfd-icon-cutlery' => 'Dfd-Icon-Cutlery'),
		array('dfd-icon-drink' => 'Dfd-Icon-Drink'),
		array('dfd-icon-fish' => 'Dfd-Icon-Fish'),
		array('dfd-icon-french_press' => 'Dfd-Icon-French_press'),
		array('dfd-icon-fridge2' => 'Dfd-Icon-Fridge2'),
		array('dfd-icon-fried_egg' => 'Dfd-Icon-Fried_egg'),
		array('dfd-icon-fry_pan' => 'Dfd-Icon-Fry_pan'),
		array('dfd-icon-gingerbread_man2' => 'Dfd-Icon-Gingerbread_man2'),
		array('dfd-icon-glass' => 'Dfd-Icon-Glass'),
		array('dfd-icon-grape' => 'Dfd-Icon-Grape'),
		array('dfd-icon-grater' => 'Dfd-Icon-Grater'),
		array('dfd-icon-grinding_bowl' => 'Dfd-Icon-Grinding_bowl'),
		array('dfd-icon-ice_cream' => 'Dfd-Icon-Ice_cream'),
		array('dfd-icon-ice_cream_2' => 'Dfd-Icon-Ice_cream_2'),
		array('dfd-icon-juicer' => 'Dfd-Icon-Juicer'),
		array('dfd-icon-kettle' => 'Dfd-Icon-Kettle'),
		array('dfd-icon-ladle' => 'Dfd-Icon-Ladle'),
		array('dfd-icon-lemon' => 'Dfd-Icon-Lemon'),
		array('dfd-icon-martini' => 'Dfd-Icon-Martini'),
		array('dfd-icon-microwave' => 'Dfd-Icon-Microwave'),
		array('dfd-icon-mixer' => 'Dfd-Icon-Mixer'),
		array('dfd-icon-mushroom' => 'Dfd-Icon-Mushroom'),
		array('dfd-icon-onion' => 'Dfd-Icon-Onion'),
		array('dfd-icon-orange' => 'Dfd-Icon-Orange'),
		array('dfd-icon-piece_of_cake' => 'Dfd-Icon-Piece_of_cake'),
		array('dfd-icon-pizza' => 'Dfd-Icon-Pizza'),
		array('dfd-icon-plate' => 'Dfd-Icon-Plate'),
		array('dfd-icon-platter' => 'Dfd-Icon-Platter'),
		array('dfd-icon-pot' => 'Dfd-Icon-Pot'),
		array('dfd-icon-rolling_pin' => 'Dfd-Icon-Rolling_pin'),
		array('dfd-icon-salt_and_pepper' => 'Dfd-Icon-Salt_and_pepper'),
		array('dfd-icon-sausage_1' => 'Dfd-Icon-Sausage_1'),
		array('dfd-icon-sausage_2' => 'Dfd-Icon-Sausage_2'),
		array('dfd-icon-scale' => 'Dfd-Icon-Scale'),
		array('dfd-icon-shaker' => 'Dfd-Icon-Shaker'),
		array('dfd-icon-skewers' => 'Dfd-Icon-Skewers'),
		array('dfd-icon-slice_of_orange' => 'Dfd-Icon-Slice_of_orange'),
		array('dfd-icon-stove' => 'Dfd-Icon-Stove'),
		array('dfd-icon-strawberry' => 'Dfd-Icon-Strawberry'),
		array('dfd-icon-tea' => 'Dfd-Icon-Tea'),
		array('dfd-icon-toaster' => 'Dfd-Icon-Toaster'),
		array('dfd-icon-wheat' => 'Dfd-Icon-Wheat'),
		array('dfd-icon-whiskey' => 'Dfd-Icon-Whiskey'),
		array('dfd-icon-wine' => 'Dfd-Icon-Wine'),
		array('dfd-icon-angry' => 'Dfd-Icon-Angry'),
		array('dfd-icon-angry_2' => 'Dfd-Icon-Angry_2'),
		array('dfd-icon-child' => 'Dfd-Icon-Child'),
		array('dfd-icon-confused' => 'Dfd-Icon-Confused'),
		array('dfd-icon-crying' => 'Dfd-Icon-Crying'),
		array('dfd-icon-cyclopes' => 'Dfd-Icon-Cyclopes'),
		array('dfd-icon-dead' => 'Dfd-Icon-Dead'),
		array('dfd-icon-funny' => 'Dfd-Icon-Funny'),
		array('dfd-icon-greedy' => 'Dfd-Icon-Greedy'),
		array('dfd-icon-happy_1' => 'Dfd-Icon-Happy_1'),
		array('dfd-icon-happy_2' => 'Dfd-Icon-Happy_2'),
		array('dfd-icon-happy_3' => 'Dfd-Icon-Happy_3'),
		array('dfd-icon-lips_sealed' => 'Dfd-Icon-Lips_sealed'),
		array('dfd-icon-love' => 'Dfd-Icon-Love'),
		array('dfd-icon-relax' => 'Dfd-Icon-Relax'),
		array('dfd-icon-sad_1' => 'Dfd-Icon-Sad_1'),
		array('dfd-icon-sad_2' => 'Dfd-Icon-Sad_2'),
		array('dfd-icon-sad_3' => 'Dfd-Icon-Sad_3'),
		array('dfd-icon-sad_4' => 'Dfd-Icon-Sad_4'),
		array('dfd-icon-shock' => 'Dfd-Icon-Shock'),
		array('dfd-icon-silence' => 'Dfd-Icon-Silence'),
		array('dfd-icon-sleepy' => 'Dfd-Icon-Sleepy'),
		array('dfd-icon-smart' => 'Dfd-Icon-Smart'),
		array('dfd-icon-speechless' => 'Dfd-Icon-Speechless'),
		array('dfd-icon-star3' => 'Dfd-Icon-Star3'),
		array('dfd-icon-surprised' => 'Dfd-Icon-Surprised'),
		array('dfd-icon-tongue_1' => 'Dfd-Icon-Tongue_1'),
		array('dfd-icon-tongue_2' => 'Dfd-Icon-Tongue_2'),
		array('dfd-icon-wink' => 'Dfd-Icon-Wink'),
		array('dfd-icon-zombie2' => 'Dfd-Icon-Zombie2'),
		array('dfd-icon-email_1' => 'Dfd-Icon-Email_1'),
		array('dfd-icon-email_2' => 'Dfd-Icon-Email_2'),
		array('dfd-icon-email_3' => 'Dfd-Icon-Email_3'),
		array('dfd-icon-email_attention' => 'Dfd-Icon-Email_attention'),
		array('dfd-icon-email_block' => 'Dfd-Icon-Email_block'),
		array('dfd-icon-email_check' => 'Dfd-Icon-Email_check'),
		array('dfd-icon-email_clock' => 'Dfd-Icon-Email_clock'),
		array('dfd-icon-email_close' => 'Dfd-Icon-Email_close'),
		array('dfd-icon-email_doc' => 'Dfd-Icon-Email_doc'),
		array('dfd-icon-email_download' => 'Dfd-Icon-Email_download'),
		array('dfd-icon-email_edit' => 'Dfd-Icon-Email_edit'),
		array('dfd-icon-email_like' => 'Dfd-Icon-Email_like'),
		array('dfd-icon-email_lock' => 'Dfd-Icon-Email_lock'),
		array('dfd-icon-email_minus' => 'Dfd-Icon-Email_minus'),
		array('dfd-icon-email_open' => 'Dfd-Icon-Email_open'),
		array('dfd-icon-email_plus' => 'Dfd-Icon-Email_plus'),
		array('dfd-icon-email_reload' => 'Dfd-Icon-Email_reload'),
		array('dfd-icon-email_search' => 'Dfd-Icon-Email_search'),
		array('dfd-icon-email_send' => 'Dfd-Icon-Email_send'),
		array('dfd-icon-email_settings' => 'Dfd-Icon-Email_settings'),
		array('dfd-icon-email_star' => 'Dfd-Icon-Email_star'),
		array('dfd-icon-email_upload' => 'Dfd-Icon-Email_upload'),
		array('dfd-icon-mailbox_1' => 'Dfd-Icon-Mailbox_1'),
		array('dfd-icon-mailbox_2' => 'Dfd-Icon-Mailbox_2'),
		array('dfd-icon-send_mail' => 'Dfd-Icon-Send_mail'),
		array('dfd-icon-barrel_1' => 'Dfd-Icon-Barrel_1'),
		array('dfd-icon-barrel_2' => 'Dfd-Icon-Barrel_2'),
		array('dfd-icon-battery_1' => 'Dfd-Icon-Battery_1'),
		array('dfd-icon-battery_2' => 'Dfd-Icon-Battery_2'),
		array('dfd-icon-bulb_fluorescent' => 'Dfd-Icon-Bulb_fluorescent'),
		array('dfd-icon-bulb_fluorescent_2' => 'Dfd-Icon-Bulb_fluorescent_2'),
		array('dfd-icon-bulb_leaf' => 'Dfd-Icon-Bulb_leaf'),
		array('dfd-icon-bulb_sun' => 'Dfd-Icon-Bulb_sun'),
		array('dfd-icon-chemistry_leaf' => 'Dfd-Icon-Chemistry_leaf'),
		array('dfd-icon-CO2' => 'Dfd-Icon-CO2'),
		array('dfd-icon-eco' => 'Dfd-Icon-Eco'),
		array('dfd-icon-faucet_1' => 'Dfd-Icon-Faucet_1'),
		array('dfd-icon-faucet_2' => 'Dfd-Icon-Faucet_2'),
		array('dfd-icon-faucet_3' => 'Dfd-Icon-Faucet_3'),
		array('dfd-icon-flower_1' => 'Dfd-Icon-Flower_1'),
		array('dfd-icon-flower_2' => 'Dfd-Icon-Flower_2'),
		array('dfd-icon-flower_energy' => 'Dfd-Icon-Flower_energy'),
		array('dfd-icon-green_home_1' => 'Dfd-Icon-Green_home_1'),
		array('dfd-icon-green_home_2' => 'Dfd-Icon-Green_home_2'),
		array('dfd-icon-hand_globe' => 'Dfd-Icon-Hand_globe'),
		array('dfd-icon-hand_leaf' => 'Dfd-Icon-Hand_leaf'),
		array('dfd-icon-hand_leafs' => 'Dfd-Icon-Hand_leafs'),
		array('dfd-icon-hands_leaf' => 'Dfd-Icon-Hands_leaf'),
		array('dfd-icon-jerrycan' => 'Dfd-Icon-Jerrycan'),
		array('dfd-icon-leaf' => 'Dfd-Icon-Leaf'),
		array('dfd-icon-leaf_energy' => 'Dfd-Icon-Leaf_energy'),
		array('dfd-icon-leafs' => 'Dfd-Icon-Leafs'),
		array('dfd-icon-oil_rig' => 'Dfd-Icon-Oil_rig'),
		array('dfd-icon-outlet_1' => 'Dfd-Icon-Outlet_1'),
		array('dfd-icon-outlet_2' => 'Dfd-Icon-Outlet_2'),
		array('dfd-icon-power_plant_1' => 'Dfd-Icon-Power_plant_1'),
		array('dfd-icon-power_plant_2' => 'Dfd-Icon-Power_plant_2'),
		array('dfd-icon-radiation' => 'Dfd-Icon-Radiation'),
		array('dfd-icon-solar_energy' => 'Dfd-Icon-Solar_energy'),
		array('dfd-icon-sun_energy' => 'Dfd-Icon-Sun_energy'),
		array('dfd-icon-transmission_tower' => 'Dfd-Icon-Transmission_tower'),
		array('dfd-icon-trash_eco' => 'Dfd-Icon-Trash_eco'),
		array('dfd-icon-tree2' => 'Dfd-Icon-Tree2'),
		array('dfd-icon-watering_can' => 'Dfd-Icon-Watering_can'),
		array('dfd-icon-windmill' => 'Dfd-Icon-Windmill'),
		array('dfd-icon-check_folder' => 'Dfd-Icon-Check_folder'),
		array('dfd-icon-close_folder' => 'Dfd-Icon-Close_folder'),
		array('dfd-icon-cloud_folder' => 'Dfd-Icon-Cloud_folder'),
		array('dfd-icon-deleted_folder' => 'Dfd-Icon-Deleted_folder'),
		array('dfd-icon-favorite_folder' => 'Dfd-Icon-Favorite_folder'),
		array('dfd-icon-film_folder' => 'Dfd-Icon-Film_folder'),
		array('dfd-icon-folder' => 'Dfd-Icon-Folder'),
		array('dfd-icon-HTML_folder' => 'Dfd-Icon-HTML_folder'),
		array('dfd-icon-image_folder' => 'Dfd-Icon-Image_folder'),
		array('dfd-icon-incoming_folder' => 'Dfd-Icon-Incoming_folder'),
		array('dfd-icon-lock_folder' => 'Dfd-Icon-Lock_folder'),
		array('dfd-icon-love_folder' => 'Dfd-Icon-Love_folder'),
		array('dfd-icon-minus_folder' => 'Dfd-Icon-Minus_folder'),
		array('dfd-icon-music_folder' => 'Dfd-Icon-Music_folder'),
		array('dfd-icon-outgoing_folder' => 'Dfd-Icon-Outgoing_folder'),
		array('dfd-icon-plus_folder' => 'Dfd-Icon-Plus_folder'),
		array('dfd-icon-search_folder' => 'Dfd-Icon-Search_folder'),
		array('dfd-icon-settings_folder' => 'Dfd-Icon-Settings_folder'),
		array('dfd-icon-trash_folder' => 'Dfd-Icon-Trash_folder'),
		array('dfd-icon-unlock_folder' => 'Dfd-Icon-Unlock_folder'),
		array('dfd-icon-audio_doc' => 'Dfd-Icon-Audio_doc'),
		array('dfd-icon-contact_doc' => 'Dfd-Icon-Contact_doc'),
		array('dfd-icon-copy_doc' => 'Dfd-Icon-Copy_doc'),
		array('dfd-icon-deleted_doc' => 'Dfd-Icon-Deleted_doc'),
		array('dfd-icon-diagram_doc' => 'Dfd-Icon-Diagram_doc'),
		array('dfd-icon-doc_check' => 'Dfd-Icon-Doc_check'),
		array('dfd-icon-doc_close' => 'Dfd-Icon-Doc_close'),
		array('dfd-icon-doc_minus' => 'Dfd-Icon-Doc_minus'),
		array('dfd-icon-doc_money' => 'Dfd-Icon-Doc_money'),
		array('dfd-icon-doc_plus' => 'Dfd-Icon-Doc_plus'),
		array('dfd-icon-document' => 'Dfd-Icon-Document'),
		array('dfd-icon-favorite_doc' => 'Dfd-Icon-Favorite_doc'),
		array('dfd-icon-film_doc' => 'Dfd-Icon-Film_doc'),
		array('dfd-icon-HTML_doc' => 'Dfd-Icon-HTML_doc'),
		array('dfd-icon-image_doc' => 'Dfd-Icon-Image_doc'),
		array('dfd-icon-info_doc' => 'Dfd-Icon-Info_doc'),
		array('dfd-icon-key_doc' => 'Dfd-Icon-Key_doc'),
		array('dfd-icon-link_doc' => 'Dfd-Icon-Link_doc'),
		array('dfd-icon-list_doc' => 'Dfd-Icon-List_doc'),
		array('dfd-icon-lock_doc' => 'Dfd-Icon-Lock_doc'),
		array('dfd-icon-love_doc' => 'Dfd-Icon-Love_doc'),
		array('dfd-icon-play_doc' => 'Dfd-Icon-Play_doc'),
		array('dfd-icon-search_doc' => 'Dfd-Icon-Search_doc'),
		array('dfd-icon-settings_doc' => 'Dfd-Icon-Settings_doc'),
		array('dfd-icon-table_doc' => 'Dfd-Icon-Table_doc'),
		array('dfd-icon-unknown_doc' => 'Dfd-Icon-Unknown_doc'),
		array('dfd-icon-unlock_doc' => 'Dfd-Icon-Unlock_doc'),
		array('dfd-icon-warning_doc' => 'Dfd-Icon-Warning_doc'),
		array('dfd-icon-watch_doc' => 'Dfd-Icon-Watch_doc'),
		array('dfd-icon-zip_doc' => 'Dfd-Icon-Zip_doc'),
		array('dfd-icon-audio_doc2' => 'Dfd-Icon-Audio_doc2'),
		array('dfd-icon-contact_doc2' => 'Dfd-Icon-Contact_doc2'),
		array('dfd-icon-copy_doc2' => 'Dfd-Icon-Copy_doc2'),
		array('dfd-icon-deleted_doc2' => 'Dfd-Icon-Deleted_doc2'),
		array('dfd-icon-diagram_doc2' => 'Dfd-Icon-Diagram_doc2'),
		array('dfd-icon-doc_check2' => 'Dfd-Icon-Doc_check2'),
		array('dfd-icon-doc_close2' => 'Dfd-Icon-Doc_close2'),
		array('dfd-icon-doc_minus2' => 'Dfd-Icon-Doc_minus2'),
		array('dfd-icon-doc_money2' => 'Dfd-Icon-Doc_money2'),
		array('dfd-icon-doc_plus2' => 'Dfd-Icon-Doc_plus2'),
		array('dfd-icon-document2' => 'Dfd-Icon-Document2'),
		array('dfd-icon-favorite_doc2' => 'Dfd-Icon-Favorite_doc2'),
		array('dfd-icon-film_doc2' => 'Dfd-Icon-Film_doc2'),
		array('dfd-icon-HTML_doc2' => 'Dfd-Icon-HTML_doc2'),
		array('dfd-icon-image_doc2' => 'Dfd-Icon-Image_doc2'),
		array('dfd-icon-info_doc2' => 'Dfd-Icon-Info_doc2'),
		array('dfd-icon-key_doc2' => 'Dfd-Icon-Key_doc2'),
		array('dfd-icon-link_doc2' => 'Dfd-Icon-Link_doc2'),
		array('dfd-icon-list_doc2' => 'Dfd-Icon-List_doc2'),
		array('dfd-icon-lock_doc2' => 'Dfd-Icon-Lock_doc2'),
		array('dfd-icon-love_doc2' => 'Dfd-Icon-Love_doc2'),
		array('dfd-icon-play_doc2' => 'Dfd-Icon-Play_doc2'),
		array('dfd-icon-search_doc2' => 'Dfd-Icon-Search_doc2'),
		array('dfd-icon-settings_doc2' => 'Dfd-Icon-Settings_doc2'),
		array('dfd-icon-table_doc2' => 'Dfd-Icon-Table_doc2'),
		array('dfd-icon-unknown_doc2' => 'Dfd-Icon-Unknown_doc2'),
		array('dfd-icon-unlock_doc2' => 'Dfd-Icon-Unlock_doc2'),
		array('dfd-icon-warning_doc2' => 'Dfd-Icon-Warning_doc2'),
		array('dfd-icon-watch_doc2' => 'Dfd-Icon-Watch_doc2'),
		array('dfd-icon-zip_doc2' => 'Dfd-Icon-Zip_doc2'),
		array('dfd-icon-anchor_add' => 'Dfd-Icon-Anchor_add'),
		array('dfd-icon-anchor_delete' => 'Dfd-Icon-Anchor_delete'),
		array('dfd-icon-bounding_box_1' => 'Dfd-Icon-Bounding_box_1'),
		array('dfd-icon-bounding_box_2' => 'Dfd-Icon-Bounding_box_2'),
		array('dfd-icon-circle' => 'Dfd-Icon-Circle'),
		array('dfd-icon-crop' => 'Dfd-Icon-Crop'),
		array('dfd-icon-distribute_bottom' => 'Dfd-Icon-Distribute_bottom'),
		array('dfd-icon-distribute_center' => 'Dfd-Icon-Distribute_center'),
		array('dfd-icon-distribute_top' => 'Dfd-Icon-Distribute_top'),
		array('dfd-icon-flip_horizontal' => 'Dfd-Icon-Flip_horizontal'),
		array('dfd-icon-flip_vertical' => 'Dfd-Icon-Flip_vertical'),
		array('dfd-icon-magic_wand_1' => 'Dfd-Icon-Magic_wand_1'),
		array('dfd-icon-magic_wand_2' => 'Dfd-Icon-Magic_wand_2'),
		array('dfd-icon-palette' => 'Dfd-Icon-Palette'),
		array('dfd-icon-pen2' => 'Dfd-Icon-Pen2'),
		array('dfd-icon-pencil' => 'Dfd-Icon-Pencil'),
		array('dfd-icon-resize' => 'Dfd-Icon-Resize'),
		array('dfd-icon-ruler_1' => 'Dfd-Icon-Ruler_1'),
		array('dfd-icon-ruler_2' => 'Dfd-Icon-Ruler_2'),
		array('dfd-icon-scale_down' => 'Dfd-Icon-Scale_down'),
		array('dfd-icon-scale_up' => 'Dfd-Icon-Scale_up'),
		array('dfd-icon-spray_1' => 'Dfd-Icon-Spray_1'),
		array('dfd-icon-spray_2' => 'Dfd-Icon-Spray_2'),
		array('dfd-icon-stamp' => 'Dfd-Icon-Stamp'),
		array('dfd-icon-vector_1' => 'Dfd-Icon-Vector_1'),
		array('dfd-icon-vector_2' => 'Dfd-Icon-Vector_2'),
		array('dfd-icon-vector_3' => 'Dfd-Icon-Vector_3'),
		array('dfd-icon-vertical_align_bottom' => 'Dfd-Icon-Vertical_align_bottom'),
		array('dfd-icon-vertical_align_center' => 'Dfd-Icon-Vertical_align_center'),
		array('dfd-icon-vertical_align_top' => 'Dfd-Icon-Vertical_align_top'),
		array('dfd-icon-bluetooth' => 'Dfd-Icon-Bluetooth'),
		array('dfd-icon-ethernet' => 'Dfd-Icon-Ethernet'),
		array('dfd-icon-folder_network' => 'Dfd-Icon-Folder_network'),
		array('dfd-icon-hard_drive' => 'Dfd-Icon-Hard_drive'),
		array('dfd-icon-link' => 'Dfd-Icon-Link'),
		array('dfd-icon-link_broken' => 'Dfd-Icon-Link_broken'),
		array('dfd-icon-microchip_1' => 'Dfd-Icon-Microchip_1'),
		array('dfd-icon-microchip_2' => 'Dfd-Icon-Microchip_2'),
		array('dfd-icon-network2' => 'Dfd-Icon-Network2'),
		array('dfd-icon-notebook_network' => 'Dfd-Icon-Notebook_network'),
		array('dfd-icon-PC_connection_1' => 'Dfd-Icon-PC_connection_1'),
		array('dfd-icon-PC_connection_2' => 'Dfd-Icon-PC_connection_2'),
		array('dfd-icon-PC_connection_3' => 'Dfd-Icon-PC_connection_3'),
		array('dfd-icon-PC_network' => 'Dfd-Icon-PC_network'),
		array('dfd-icon-PC_no_connection' => 'Dfd-Icon-PC_no_connection'),
		array('dfd-icon-PC_phone_connection' => 'Dfd-Icon-PC_phone_connection'),
		array('dfd-icon-pc_wifi' => 'Dfd-Icon-Pc_wifi'),
		array('dfd-icon-phone_wifi_1' => 'Dfd-Icon-Phone_wifi_1'),
		array('dfd-icon-phone_wifi_2' => 'Dfd-Icon-Phone_wifi_2'),
		array('dfd-icon-plug_1' => 'Dfd-Icon-Plug_1'),
		array('dfd-icon-plug_2' => 'Dfd-Icon-Plug_2'),
		array('dfd-icon-projector_1' => 'Dfd-Icon-Projector_1'),
		array('dfd-icon-projector_2' => 'Dfd-Icon-Projector_2'),
		array('dfd-icon-ram' => 'Dfd-Icon-Ram'),
		array('dfd-icon-remote_control_1' => 'Dfd-Icon-Remote_control_1'),
		array('dfd-icon-remote_control_2' => 'Dfd-Icon-Remote_control_2'),
		array('dfd-icon-router_1' => 'Dfd-Icon-Router_1'),
		array('dfd-icon-router_2' => 'Dfd-Icon-Router_2'),
		array('dfd-icon-router_network' => 'Dfd-Icon-Router_network'),
		array('dfd-icon-satellite_1' => 'Dfd-Icon-Satellite_1'),
		array('dfd-icon-satellite_2' => 'Dfd-Icon-Satellite_2'),
		array('dfd-icon-satellite_dish_1' => 'Dfd-Icon-Satellite_dish_1'),
		array('dfd-icon-satellite_dish_2' => 'Dfd-Icon-Satellite_dish_2'),
		array('dfd-icon-satellite_PC_connection' => 'Dfd-Icon-Satellite_PC_connection'),
		array('dfd-icon-satellite_phone_connection' => 'Dfd-Icon-Satellite_phone_connection'),
		array('dfd-icon-settings_12' => 'Dfd-Icon-Settings_12'),
		array('dfd-icon-settings_22' => 'Dfd-Icon-Settings_22'),
		array('dfd-icon-signal_1' => 'Dfd-Icon-Signal_1'),
		array('dfd-icon-signal_2' => 'Dfd-Icon-Signal_2'),
		array('dfd-icon-signal_3' => 'Dfd-Icon-Signal_3'),
		array('dfd-icon-signal_4' => 'Dfd-Icon-Signal_4'),
		array('dfd-icon-signal_strength_1' => 'Dfd-Icon-Signal_strength_1'),
		array('dfd-icon-signal_strength_2' => 'Dfd-Icon-Signal_strength_2'),
		array('dfd-icon-signal_strength_3' => 'Dfd-Icon-Signal_strength_3'),
		array('dfd-icon-signal_strength_4' => 'Dfd-Icon-Signal_strength_4'),
		array('dfd-icon-signal_strength_5' => 'Dfd-Icon-Signal_strength_5'),
		array('dfd-icon-USB' => 'Dfd-Icon-USB'),
		array('dfd-icon-USB_flash_drive' => 'Dfd-Icon-USB_flash_drive'),
		array('dfd-icon-walkie_talkie' => 'Dfd-Icon-Walkie_talkie'),
		array('dfd-icon-wifi' => 'Dfd-Icon-Wifi'),
		array('dfd-icon-apron' => 'Dfd-Icon-Apron'),
		array('dfd-icon-babydoll' => 'Dfd-Icon-Babydoll'),
		array('dfd-icon-bag2' => 'Dfd-Icon-Bag2'),
		array('dfd-icon-bathrobe' => 'Dfd-Icon-Bathrobe'),
		array('dfd-icon-beanie' => 'Dfd-Icon-Beanie'),
		array('dfd-icon-belt' => 'Dfd-Icon-Belt'),
		array('dfd-icon-boots' => 'Dfd-Icon-Boots'),
		array('dfd-icon-bow_tie' => 'Dfd-Icon-Bow_tie'),
		array('dfd-icon-bowler' => 'Dfd-Icon-Bowler'),
		array('dfd-icon-bra' => 'Dfd-Icon-Bra'),
		array('dfd-icon-briefs' => 'Dfd-Icon-Briefs'),
		array('dfd-icon-cloche' => 'Dfd-Icon-Cloche'),
		array('dfd-icon-coat_1' => 'Dfd-Icon-Coat_1'),
		array('dfd-icon-coat_2' => 'Dfd-Icon-Coat_2'),
		array('dfd-icon-dress2' => 'Dfd-Icon-Dress2'),
		array('dfd-icon-dress_long_sleeves' => 'Dfd-Icon-Dress_long_sleeves'),
		array('dfd-icon-glasses_1' => 'Dfd-Icon-Glasses_1'),
		array('dfd-icon-glasses_2' => 'Dfd-Icon-Glasses_2'),
		array('dfd-icon-high_heel' => 'Dfd-Icon-High_heel'),
		array('dfd-icon-hoodi' => 'Dfd-Icon-Hoodi'),
		array('dfd-icon-jacket' => 'Dfd-Icon-Jacket'),
		array('dfd-icon-jersey' => 'Dfd-Icon-Jersey'),
		array('dfd-icon-long_sleeve' => 'Dfd-Icon-Long_sleeve'),
		array('dfd-icon-mexican_hat' => 'Dfd-Icon-Mexican_hat'),
		array('dfd-icon-mittens2' => 'Dfd-Icon-Mittens2'),
		array('dfd-icon-pants2' => 'Dfd-Icon-Pants2'),
		array('dfd-icon-polo' => 'Dfd-Icon-Polo'),
		array('dfd-icon-ranger_hat' => 'Dfd-Icon-Ranger_hat'),
		array('dfd-icon-scarf' => 'Dfd-Icon-Scarf'),
		array('dfd-icon-shirt_1' => 'Dfd-Icon-Shirt_1'),
		array('dfd-icon-shirt_2' => 'Dfd-Icon-Shirt_2'),
		array('dfd-icon-shirt_tie' => 'Dfd-Icon-Shirt_tie'),
		array('dfd-icon-shorts_1' => 'Dfd-Icon-Shorts_1'),
		array('dfd-icon-shorts_2' => 'Dfd-Icon-Shorts_2'),
		array('dfd-icon-skirt_pleat' => 'Dfd-Icon-Skirt_pleat'),
		array('dfd-icon-skirt_round' => 'Dfd-Icon-Skirt_round'),
		array('dfd-icon-sneaker' => 'Dfd-Icon-Sneaker'),
		array('dfd-icon-sock' => 'Dfd-Icon-Sock'),
		array('dfd-icon-strapless' => 'Dfd-Icon-Strapless'),
		array('dfd-icon-sunglasses' => 'Dfd-Icon-Sunglasses'),
		array('dfd-icon-sweatshirt' => 'Dfd-Icon-Sweatshirt'),
		array('dfd-icon-tank_top' => 'Dfd-Icon-Tank_top'),
		array('dfd-icon-teddy' => 'Dfd-Icon-Teddy'),
		array('dfd-icon-tie' => 'Dfd-Icon-Tie'),
		array('dfd-icon-top_hat' => 'Dfd-Icon-Top_hat'),
		array('dfd-icon-trapper' => 'Dfd-Icon-Trapper'),
		array('dfd-icon-umbrella2' => 'Dfd-Icon-Umbrella2'),
		array('dfd-icon-undergarments' => 'Dfd-Icon-Undergarments'),
		array('dfd-icon-waistcoat' => 'Dfd-Icon-Waistcoat'),
		array('dfd-icon-wallet' => 'Dfd-Icon-Wallet'),
		array('dfd-icon-chat_1' => 'Dfd-Icon-Chat_1'),
		array('dfd-icon-chat_2' => 'Dfd-Icon-Chat_2'),
		array('dfd-icon-chat_3' => 'Dfd-Icon-Chat_3'),
		array('dfd-icon-chat_alert' => 'Dfd-Icon-Chat_alert'),
		array('dfd-icon-chat_attention' => 'Dfd-Icon-Chat_attention'),
		array('dfd-icon-chat_block' => 'Dfd-Icon-Chat_block'),
		array('dfd-icon-chat_bubbles' => 'Dfd-Icon-Chat_bubbles'),
		array('dfd-icon-chat_check' => 'Dfd-Icon-Chat_check'),
		array('dfd-icon-chat_close' => 'Dfd-Icon-Chat_close'),
		array('dfd-icon-chat_edit' => 'Dfd-Icon-Chat_edit'),
		array('dfd-icon-chat_info' => 'Dfd-Icon-Chat_info'),
		array('dfd-icon-chat_like' => 'Dfd-Icon-Chat_like'),
		array('dfd-icon-chat_minus' => 'Dfd-Icon-Chat_minus'),
		array('dfd-icon-chat_plus' => 'Dfd-Icon-Chat_plus'),
		array('dfd-icon-chat_question' => 'Dfd-Icon-Chat_question'),
		array('dfd-icon-chat_quote' => 'Dfd-Icon-Chat_quote'),
		array('dfd-icon-chat_smile' => 'Dfd-Icon-Chat_smile'),
		array('dfd-icon-chat_star' => 'Dfd-Icon-Chat_star'),
		array('dfd-icon-cloud_chat_1' => 'Dfd-Icon-Cloud_chat_1'),
		array('dfd-icon-cloud_chat_2' => 'Dfd-Icon-Cloud_chat_2'),
		array('dfd-icon-comment_1' => 'Dfd-Icon-Comment_1'),
		array('dfd-icon-comment_2' => 'Dfd-Icon-Comment_2'),
		array('dfd-icon-comment_3' => 'Dfd-Icon-Comment_3'),
		array('dfd-icon-comment_alert' => 'Dfd-Icon-Comment_alert'),
		array('dfd-icon-comment_attention' => 'Dfd-Icon-Comment_attention'),
		array('dfd-icon-comment_block' => 'Dfd-Icon-Comment_block'),
		array('dfd-icon-comment_check' => 'Dfd-Icon-Comment_check'),
		array('dfd-icon-comment_close' => 'Dfd-Icon-Comment_close'),
		array('dfd-icon-comment_edit' => 'Dfd-Icon-Comment_edit'),
		array('dfd-icon-comment_info' => 'Dfd-Icon-Comment_info'),
		array('dfd-icon-comment_like' => 'Dfd-Icon-Comment_like'),
		array('dfd-icon-comment_minus' => 'Dfd-Icon-Comment_minus'),
		array('dfd-icon-comment_plus' => 'Dfd-Icon-Comment_plus'),
		array('dfd-icon-comment_question' => 'Dfd-Icon-Comment_question'),
		array('dfd-icon-comment_quote' => 'Dfd-Icon-Comment_quote'),
		array('dfd-icon-comment_smile' => 'Dfd-Icon-Comment_smile'),
		array('dfd-icon-comment_star' => 'Dfd-Icon-Comment_star'),
		array('dfd-icon-comments_1' => 'Dfd-Icon-Comments_1'),
		array('dfd-icon-comments_2' => 'Dfd-Icon-Comments_2'),
		array('dfd-icon-talking' => 'Dfd-Icon-Talking'),
		array('dfd-icon-blind' => 'Dfd-Icon-Blind'),
		array('dfd-icon-brain_1' => 'Dfd-Icon-Brain_1'),
		array('dfd-icon-brain_2' => 'Dfd-Icon-Brain_2'),
		array('dfd-icon-eay' => 'Dfd-Icon-Eay'),
		array('dfd-icon-eye3' => 'Dfd-Icon-Eye3'),
		array('dfd-icon-eye_closed' => 'Dfd-Icon-Eye_closed'),
		array('dfd-icon-finger' => 'Dfd-Icon-Finger'),
		array('dfd-icon-fingerprint' => 'Dfd-Icon-Fingerprint'),
		array('dfd-icon-fingerprint_block' => 'Dfd-Icon-Fingerprint_block'),
		array('dfd-icon-fingerprint_check' => 'Dfd-Icon-Fingerprint_check'),
		array('dfd-icon-fingerprint_cross' => 'Dfd-Icon-Fingerprint_cross'),
		array('dfd-icon-fingerprint_minus' => 'Dfd-Icon-Fingerprint_minus'),
		array('dfd-icon-fingerprint_plus' => 'Dfd-Icon-Fingerprint_plus'),
		array('dfd-icon-fingerprint_settings' => 'Dfd-Icon-Fingerprint_settings'),
		array('dfd-icon-foot' => 'Dfd-Icon-Foot'),
		array('dfd-icon-footprint' => 'Dfd-Icon-Footprint'),
		array('dfd-icon-hand' => 'Dfd-Icon-Hand'),
		array('dfd-icon-hand_middle_finger' => 'Dfd-Icon-Hand_middle_finger'),
		array('dfd-icon-hand_rock' => 'Dfd-Icon-Hand_rock'),
		array('dfd-icon-kidneys' => 'Dfd-Icon-Kidneys'),
		array('dfd-icon-lips' => 'Dfd-Icon-Lips'),
		array('dfd-icon-liver' => 'Dfd-Icon-Liver'),
		array('dfd-icon-lungs' => 'Dfd-Icon-Lungs'),
		array('dfd-icon-moustache_1' => 'Dfd-Icon-Moustache_1'),
		array('dfd-icon-moustache_2' => 'Dfd-Icon-Moustache_2'),
		array('dfd-icon-nose_1' => 'Dfd-Icon-Nose_1'),
		array('dfd-icon-nose_2' => 'Dfd-Icon-Nose_2'),
		array('dfd-icon-penis' => 'Dfd-Icon-Penis'),
		array('dfd-icon-stomach' => 'Dfd-Icon-Stomach'),
		array('dfd-icon-uterus' => 'Dfd-Icon-Uterus'),
		array('dfd-icon-aquarius' => 'Dfd-Icon-Aquarius'),
		array('dfd-icon-aries' => 'Dfd-Icon-Aries'),
		array('dfd-icon-cancer' => 'Dfd-Icon-Cancer'),
		array('dfd-icon-capricorn' => 'Dfd-Icon-Capricorn'),
		array('dfd-icon-ceres' => 'Dfd-Icon-Ceres'),
		array('dfd-icon-chiron' => 'Dfd-Icon-Chiron'),
		array('dfd-icon-earth2' => 'Dfd-Icon-Earth2'),
		array('dfd-icon-gemini' => 'Dfd-Icon-Gemini'),
		array('dfd-icon-juno' => 'Dfd-Icon-Juno'),
		array('dfd-icon-jupiter' => 'Dfd-Icon-Jupiter'),
		array('dfd-icon-leo' => 'Dfd-Icon-Leo'),
		array('dfd-icon-libra' => 'Dfd-Icon-Libra'),
		array('dfd-icon-mars' => 'Dfd-Icon-Mars'),
		array('dfd-icon-mercury' => 'Dfd-Icon-Mercury'),
		array('dfd-icon-moon' => 'Dfd-Icon-Moon'),
		array('dfd-icon-neptune' => 'Dfd-Icon-Neptune'),
		array('dfd-icon-node_north' => 'Dfd-Icon-Node_north'),
		array('dfd-icon-node_south' => 'Dfd-Icon-Node_south'),
		array('dfd-icon-pallas' => 'Dfd-Icon-Pallas'),
		array('dfd-icon-pisces' => 'Dfd-Icon-Pisces'),
		array('dfd-icon-pluto' => 'Dfd-Icon-Pluto'),
		array('dfd-icon-sagittarius' => 'Dfd-Icon-Sagittarius'),
		array('dfd-icon-saturn' => 'Dfd-Icon-Saturn'),
		array('dfd-icon-scorpio' => 'Dfd-Icon-Scorpio'),
		array('dfd-icon-sun' => 'Dfd-Icon-Sun'),
		array('dfd-icon-taurus' => 'Dfd-Icon-Taurus'),
		array('dfd-icon-uranus' => 'Dfd-Icon-Uranus'),
		array('dfd-icon-venus' => 'Dfd-Icon-Venus'),
		array('dfd-icon-vesta' => 'Dfd-Icon-Vesta'),
		array('dfd-icon-vigro' => 'Dfd-Icon-Vigro'),
		array('dfd-icon-actual_size' => 'Dfd-Icon-Actual_size'),
		array('dfd-icon-back_to_finish' => 'Dfd-Icon-Back_to_finish'),
		array('dfd-icon-back_to_start' => 'Dfd-Icon-Back_to_start'),
		array('dfd-icon-big_1' => 'Dfd-Icon-Big_1'),
		array('dfd-icon-big_2' => 'Dfd-Icon-Big_2'),
		array('dfd-icon-down_1' => 'Dfd-Icon-Down_1'),
		array('dfd-icon-down_2' => 'Dfd-Icon-Down_2'),
		array('dfd-icon-down_3' => 'Dfd-Icon-Down_3'),
		array('dfd-icon-down_4' => 'Dfd-Icon-Down_4'),
		array('dfd-icon-down_5' => 'Dfd-Icon-Down_5'),
		array('dfd-icon-down_6' => 'Dfd-Icon-Down_6'),
		array('dfd-icon-down_left' => 'Dfd-Icon-Down_left'),
		array('dfd-icon-down_right' => 'Dfd-Icon-Down_right'),
		array('dfd-icon-download_1' => 'Dfd-Icon-Download_1'),
		array('dfd-icon-download_2' => 'Dfd-Icon-Download_2'),
		array('dfd-icon-download_3' => 'Dfd-Icon-Download_3'),
		array('dfd-icon-exit' => 'Dfd-Icon-Exit'),
		array('dfd-icon-expand' => 'Dfd-Icon-Expand'),
		array('dfd-icon-fork' => 'Dfd-Icon-Fork'),
		array('dfd-icon-full_screen' => 'Dfd-Icon-Full_screen'),
		array('dfd-icon-infinity' => 'Dfd-Icon-Infinity'),
		array('dfd-icon-left_1' => 'Dfd-Icon-Left_1'),
		array('dfd-icon-left_2' => 'Dfd-Icon-Left_2'),
		array('dfd-icon-left_3' => 'Dfd-Icon-Left_3'),
		array('dfd-icon-left_4' => 'Dfd-Icon-Left_4'),
		array('dfd-icon-left_5' => 'Dfd-Icon-Left_5'),
		array('dfd-icon-left_6' => 'Dfd-Icon-Left_6'),
		array('dfd-icon-left_down_1' => 'Dfd-Icon-Left_down_1'),
		array('dfd-icon-left_down_2' => 'Dfd-Icon-Left_down_2'),
		array('dfd-icon-left_right_1' => 'Dfd-Icon-Left_right_1'),
		array('dfd-icon-left_right_2' => 'Dfd-Icon-Left_right_2'),
		array('dfd-icon-left_up_1' => 'Dfd-Icon-Left_up_1'),
		array('dfd-icon-left_up_2' => 'Dfd-Icon-Left_up_2'),
		array('dfd-icon-merge' => 'Dfd-Icon-Merge'),
		array('dfd-icon-move_1' => 'Dfd-Icon-Move_1'),
		array('dfd-icon-move_2' => 'Dfd-Icon-Move_2'),
		array('dfd-icon-move_3' => 'Dfd-Icon-Move_3'),
		array('dfd-icon-move_4' => 'Dfd-Icon-Move_4'),
		array('dfd-icon-move_5' => 'Dfd-Icon-Move_5'),
		array('dfd-icon-move_6' => 'Dfd-Icon-Move_6'),
		array('dfd-icon-move_7' => 'Dfd-Icon-Move_7'),
		array('dfd-icon-narrow' => 'Dfd-Icon-Narrow'),
		array('dfd-icon-recycle' => 'Dfd-Icon-Recycle'),
		array('dfd-icon-refresh' => 'Dfd-Icon-Refresh'),
		array('dfd-icon-reload' => 'Dfd-Icon-Reload'),
		array('dfd-icon-repeat_1' => 'Dfd-Icon-Repeat_1'),
		array('dfd-icon-repeat_2' => 'Dfd-Icon-Repeat_2'),
		array('dfd-icon-right_1' => 'Dfd-Icon-Right_1'),
		array('dfd-icon-right_2' => 'Dfd-Icon-Right_2'),
		array('dfd-icon-right_3' => 'Dfd-Icon-Right_3'),
		array('dfd-icon-right_4' => 'Dfd-Icon-Right_4'),
		array('dfd-icon-right_5' => 'Dfd-Icon-Right_5'),
		array('dfd-icon-right_6' => 'Dfd-Icon-Right_6'),
		array('dfd-icon-right_down_1' => 'Dfd-Icon-Right_down_1'),
		array('dfd-icon-right_down_2' => 'Dfd-Icon-Right_down_2'),
		array('dfd-icon-right_up_1' => 'Dfd-Icon-Right_up_1'),
		array('dfd-icon-right_up_2' => 'Dfd-Icon-Right_up_2'),
		array('dfd-icon-rotate_1' => 'Dfd-Icon-Rotate_1'),
		array('dfd-icon-rotate_2' => 'Dfd-Icon-Rotate_2'),
		array('dfd-icon-shuffle' => 'Dfd-Icon-Shuffle'),
		array('dfd-icon-small_1' => 'Dfd-Icon-Small_1'),
		array('dfd-icon-small_2' => 'Dfd-Icon-Small_2'),
		array('dfd-icon-swith' => 'Dfd-Icon-Swith'),
		array('dfd-icon-transfer_12' => 'Dfd-Icon-Transfer_12'),
		array('dfd-icon-transfer_22' => 'Dfd-Icon-Transfer_22'),
		array('dfd-icon-up_1' => 'Dfd-Icon-Up_1'),
		array('dfd-icon-up_2' => 'Dfd-Icon-Up_2'),
		array('dfd-icon-up_3' => 'Dfd-Icon-Up_3'),
		array('dfd-icon-up_4' => 'Dfd-Icon-Up_4'),
		array('dfd-icon-up_5' => 'Dfd-Icon-Up_5'),
		array('dfd-icon-up_6' => 'Dfd-Icon-Up_6'),
		array('dfd-icon-up_down_1' => 'Dfd-Icon-Up_down_1'),
		array('dfd-icon-up_down_2' => 'Dfd-Icon-Up_down_2'),
		array('dfd-icon-up_left_1' => 'Dfd-Icon-Up_left_1'),
		array('dfd-icon-up_left_2' => 'Dfd-Icon-Up_left_2'),
		array('dfd-icon-up_right_1' => 'Dfd-Icon-Up_right_1'),
		array('dfd-icon-up_right_2' => 'Dfd-Icon-Up_right_2'),
		array('dfd-icon-upload_1' => 'Dfd-Icon-Upload_1'),
		array('dfd-icon-upload_2' => 'Dfd-Icon-Upload_2'),
		array('dfd-icon-upload_3' => 'Dfd-Icon-Upload_3'),
		array('dfd-icon-ant' => 'Dfd-Icon-Ant'),
		array('dfd-icon-bear' => 'Dfd-Icon-Bear'),
		array('dfd-icon-beaver' => 'Dfd-Icon-Beaver'),
		array('dfd-icon-bee' => 'Dfd-Icon-Bee'),
		array('dfd-icon-birdcage' => 'Dfd-Icon-Birdcage'),
		array('dfd-icon-bone' => 'Dfd-Icon-Bone'),
		array('dfd-icon-butterfly' => 'Dfd-Icon-Butterfly'),
		array('dfd-icon-cat' => 'Dfd-Icon-Cat'),
		array('dfd-icon-cock' => 'Dfd-Icon-Cock'),
		array('dfd-icon-cow' => 'Dfd-Icon-Cow'),
		array('dfd-icon-crab' => 'Dfd-Icon-Crab'),
		array('dfd-icon-dog' => 'Dfd-Icon-Dog'),
		array('dfd-icon-fish2' => 'Dfd-Icon-Fish2'),
		array('dfd-icon-fishbowl' => 'Dfd-Icon-Fishbowl'),
		array('dfd-icon-goat' => 'Dfd-Icon-Goat'),
		array('dfd-icon-ladybug' => 'Dfd-Icon-Ladybug'),
		array('dfd-icon-lion' => 'Dfd-Icon-Lion'),
		array('dfd-icon-lizard_1' => 'Dfd-Icon-Lizard_1'),
		array('dfd-icon-lizard_2' => 'Dfd-Icon-Lizard_2'),
		array('dfd-icon-mouse3' => 'Dfd-Icon-Mouse3'),
		array('dfd-icon-panda' => 'Dfd-Icon-Panda'),
		array('dfd-icon-paw_print' => 'Dfd-Icon-Paw_print'),
		array('dfd-icon-pig_1' => 'Dfd-Icon-Pig_1'),
		array('dfd-icon-pig_2' => 'Dfd-Icon-Pig_2'),
		array('dfd-icon-scorpion' => 'Dfd-Icon-Scorpion'),
		array('dfd-icon-sheep' => 'Dfd-Icon-Sheep'),
		array('dfd-icon-shrimp' => 'Dfd-Icon-Shrimp'),
		array('dfd-icon-snake' => 'Dfd-Icon-Snake'),
		array('dfd-icon-spider' => 'Dfd-Icon-Spider'),
		array('dfd-icon-turtle' => 'Dfd-Icon-Turtle'),
	);

	return array_merge( $icons, $dfd_icons );
}

function dfd_posts_view_counter($post_ID) {
	
	if(!$post_ID) return false;
 
    $meta_id = 'dfd_views_counter';
	
	$reset = get_post_meta($post_ID, 'blog_single_reset_counter', true);
    
	if(!$reset) {
		$count = get_post_meta($post_ID, $meta_id, true);
	} else {
		$count = '';
		update_post_meta($post_ID, 'blog_single_reset_counter', false);
	}
     
    if($count == ''){
		
        $count = 0;
         
        delete_post_meta($post_ID, $meta_id);
         
        add_post_meta($post_ID, $meta_id, '0');
		
		return $count . ' '.esc_html__('View','dfd');
		
    } else {
		
        $count++;

        update_post_meta($post_ID, $meta_id, $count);
         
        if($count == '1'){
			return $count . ' '.esc_html__('View','dfd');
        } else {
			return $count . ' '.esc_html__('Views','dfd');
        }
    }
}

/*add_action('admin_notices', 'dfd_update_vc_notice');

function dfd_update_vc_notice() {
	if(get_bloginfo('version') == '4.5') {
		
		$plugin_file = get_home_path().'wp-content//plugins/js_composer/js_composer.php';
		if(file_exists($plugin_file)) {
			$vc_plugin_data = get_plugin_data($plugin_file);
			if(isset($vc_plugin_data['Version']) && $vc_plugin_data['Version'] != '4.11.2.1') {
				echo '<div class="settings-error notice notice-error"><h2 style="font-size: 26px;"><strong>The <span style="text-decoration: underline;">Visual Composer</span> version you have installed is out of date and <span style="text-decoration: underline;">doesn\'t work</span> with your current Wordpress version.</h2><h2 style="font-size: 26px;">We strongly recommend you to update this plugin to latest version following</strong> <a href="http://support.dfd.name/2016/04/16/visual-composer-plugin-update/" target="_blank">these instructions</a>.</h2></div>';
			}

		}
	}
	
}
if($_SERVER['SERVER_NAME'] != "themes.dfd.name" && $_SERVER['SERVER_NAME'] != "rnbtheme.com") {
	add_action('admin_notices', 'dfd_options_admin_notice');
}

function dfd_options_admin_notice() {
	echo '<div class="settings-error notice notice-warning is-dismissible"><h2 style="font-size: 26px;"><strong>You theme was updated successfully.</h2><h2 style="font-size: 26px;">Please visit <a href="'.admin_url().'admin.php?page=Ronneby&tab=0">Theme options page</a> section and click Save changes to apply all your customizations.</strong></h2></div>';
}
 */
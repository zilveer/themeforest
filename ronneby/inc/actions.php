<?php
/*
 * Pages layout select function
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
function set_layout($page, $open = true) {
	global $dfd_ronneby;
	$page = isset($dfd_ronneby[$page . '_layout']) && !empty($dfd_ronneby[$page . '_layout']) ? $dfd_ronneby[$page . '_layout'] : '1col-fixed';
	
	switch($page) {
		case '3c-l-fixed':
			$cr_layout = 'sidebar-left2';
			$cr_width = 'six dfd-eq-height';
			break;
		case '3c-r-fixed':
			$cr_layout = 'sidebar-right2';
			$cr_width = 'six dfd-eq-height';
			break;
		case '2c-l-fixed':
			$cr_layout = 'sidebar-left';
			$cr_width = 'nine dfd-eq-height';
			break;
		case '2c-r-fixed':
			$cr_layout = 'sidebar-right';
			$cr_width = 'nine dfd-eq-height';
			break;
		case '3c-fixed':
			$cr_layout = 'sidebar-both';
			$cr_width = 'six dfd-eq-height';
			break;
		case '1col-fixed':
		default:
			$cr_layout = '';
			$cr_width = 'twelve';
	}
	
    if ($open) {

        // Open content wrapper


        echo '<div class="blog-section ' . esc_attr($cr_layout) . '">';
        echo '<section id="main-content" role="main" class="' . $cr_width . ' columns">';


    } else {

        // Close content wrapper

        echo ' </section>';

        if (($page == "2c-l-fixed") || ($page == "3c-fixed")) {
            get_template_part('templates/sidebar', 'left');
            echo ' </div>';
        }
        if (($page == "3c-l-fixed")){
            get_template_part('templates/sidebar', 'right');
            echo ' </div>';
            get_template_part('templates/sidebar', 'left');
        }
        if ($page == "3c-r-fixed"){
            get_template_part('templates/sidebar', 'left');
            echo ' </div>';
        }
        if (($page == "2c-r-fixed") || ($page == "3c-fixed") || ($page == "3c-r-fixed") ) {
            get_template_part('templates/sidebar', 'right');
        }
		echo '</div>';
    }
}


/**
 * Add the RSS feed link in the <head> if there's posts
 */
function crum_feed_link() {
	$count = wp_count_posts('post'); if ($count->publish > 0) {
		echo "\n\t<link rel=\"alternate\" type=\"application/rss+xml\" title=\"". get_bloginfo('name') ." Feed\" href=\"". home_url() ."/feed/\">\n";
	}
}

add_action('wp_head', 'crum_feed_link', -2);


/**
 * Customization of login page
 */

function crum_custom_login_logo() {
	global $dfd_ronneby;
	
	$before_login_page_css = $login_page_css = $login_page_js = '';
	
	$title_color = '#242424';
	$text_color = '#565656';
	$form_bg = '#ffffff';
	$input_bg = 'transparent';
	$input_border = '#dddddd';
	
    if(isset($dfd_ronneby['custom_logo_image']['url']) && $dfd_ronneby['custom_logo_image']['url']){
        $custom_logo = $dfd_ronneby['custom_logo_image']['url'];
    } else {
        $custom_logo = get_template_directory_uri() .'/assets/img/logo.png';
    }
	
	$logo_width = (isset($dfd_ronneby['header_logo_width']) && !empty($dfd_ronneby['header_logo_width'])) ? $dfd_ronneby['header_logo_width'] : 206;
	
	$logo_height = (isset($dfd_ronneby['header_logo_height']) && !empty($dfd_ronneby['header_logo_height'])) ? $dfd_ronneby['header_logo_height'] : 42;

    $login_page_css .= 'body.login{background:#fff;}
			body.login #login {position: relative;top: 50%;margin: 0 auto;padding: 0;-webkit-transform: translateY(-50%);-moz-transform: translateY(-50%);-o-transform: translateY(-50%);transform: translateY(-50%);}';			
	
	if(isset($dfd_ronneby['custom_login_page']) && $dfd_ronneby['custom_login_page'] == 'on') {
		$before_login_page_css = '<style type="text/css">@font-face {font-family: "Montserrat";font-style: normal;font-weight: 400;src: local("Montserrat-Regular"), url(http://fonts.gstatic.com/s/montserrat/v6/zhcz-_WihjSQC0oHJ9TCYPk_vArhqVIZ0nv9q090hN8.woff2) format("woff2"); unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000; }@font-face {font-family: "Montserrat";font-style: normal;font-weight: 700;src: local("Montserrat-Bold"), url(http://fonts.gstatic.com/s/montserrat/v6/IQHow_FEYlDC4Gzy_m8fcoWiMMZ7xLd792ULpGE4W_Y.woff2) format("woff2");unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;}@font-face {font-family: "Lora";font-style: italic;font-weight: 400;src: local("Lora Italic"), local("Lora-Italic"), url(http://fonts.gstatic.com/s/lora/v9/_RSiB1sBuflZfa9fxV8cOg.woff2) format("woff2");unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;}@font-face {font-family: "Lora";font-style: normal;font-weight: 400;src: local("Lora"), local("Lora-Regular"), url(http://fonts.gstatic.com/s/lora/v9/4vqKRIwnQQGUQQh-PnvdMA.woff2) format("woff2");unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;}@font-face {font-family: "Raleway";font-style: normal;font-weight: 400;src: local("Raleway"), local("Raleway-Regular"), url(http://fonts.gstatic.com/s/raleway/v10/yQiAaD56cjx1AooMTSghGfY6323mHUZFJMgTvxaG2iE.woff2) format("woff2");unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;}@font-face {font-family: "Raleway";font-style: normal;font-weight: 400;src: local("Raleway"), local("Raleway-Regular"), url(http://fonts.gstatic.com/s/raleway/v10/0dTEPzkLWceF7z0koJaX1A.woff2) format("woff2");unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;}</style>';
		if(isset($dfd_ronneby['login_page_color_scheme']) && $dfd_ronneby['login_page_color_scheme'] == 'dark') {
			$title_color = '#ffffff';
			$text_color = 'rgba(255,255,255,.2)';
			$form_bg = '#2d2d2d';
			$input_bg = 'rgba(255,255,255,.05)';
			$input_border = 'rgba(255,255,255,.1)';
			if(isset($dfd_ronneby['custom_logo_image_second']['url']) && !empty($dfd_ronneby['custom_logo_image_second']['url']))
				$custom_logo = $dfd_ronneby['custom_logo_image_second']['url'];
		}
		if(isset($dfd_ronneby['custom_login_page_logo']) && $dfd_ronneby['custom_login_page_logo'] == 'off') {
			$login_page_css .= '.login h1 a {display: none !important;}';
		}
		if(isset($dfd_ronneby['login_page_bg_color']) && $dfd_ronneby['login_page_bg_color'] != '') {
			$login_page_css .= 'body.login{background-color:'.esc_attr($dfd_ronneby['login_page_bg_color']).';}';
		}
		if(isset($dfd_ronneby['login_page_bg_image']['url']) && $dfd_ronneby['login_page_bg_image']['url'] != '') {
			$background_size = (isset($dfd_ronneby['login_page_bg_image_size']) && $dfd_ronneby['login_page_bg_image_size'] != '') ? $dfd_ronneby['login_page_bg_image_size'] : 'initial';
			$login_page_css .= 'body.login{background-image:url('.esc_attr($dfd_ronneby['login_page_bg_image']['url']).');background-size: '.esc_attr($background_size).';background-position: center center;background-repeat: no-repeat;}';
		}
		$login_page_css .= '#login p.login-title {position: absolute;left: 0;bottom: 100%;margin-bottom: 10px;font-family: "Montserrat";font-weight: 700;font-size: 31px;letter-spacing:-2px;line-height: 1;color: '.esc_attr($title_color).';}';
		$login_page_css .= '#login p.login-title span {font-family: "Lora";font-weight: 400;font-style: italic;letter-spacing:0;color: inherit;}';
		$login_page_css .= 'body > .logo {display: block;text-indent: 9999em;position: relative;top: 50px;overflow: hidden; margin: 0 auto;color:transparent;}';
		$login_page_css .= 'body.login form {margin: 0;padding: 24px; background: '.esc_attr($form_bg).';border-radius: 2px;}';
		$login_page_css .= 'body.login form label {font-family: "Lora";font-size: 14px;font-style: normal;color: '.esc_attr($text_color).';}';
		$login_page_css .= 'body.login form .forgetmenot label {font-size: 14px;;}';
		$login_page_css .= 'body.login form input, body.login form input[type="text"], body.login form input[type="password"] {padding: 8px;background: '.esc_attr($input_bg).';color: '.esc_attr($title_color).';border-color: '.esc_attr($input_border).';border-radius: 2px;}';
		$login_page_css .= 'body.login #nav {color: '.esc_attr($title_color).';}';
		$login_page_css .= 'body.login #nav a {font-family: "Lora";font-size: 14px;font-style: normal;color: inherit;border-bottom: 1px dotted #c39f77;-webkit-transition: border .3s ease 0s;-moz-transition: border .3s ease 0s;-o-transition: border .3s ease 0s;transition: border .3s ease 0s;}';
		$login_page_css .= 'body.login #nav a:hover {color: inherit;border-bottom-style: solid;}';
		$login_page_css .= 'body.login #backtoblog {color: '.esc_attr($title_color).';}';
		$login_page_css .= 'body.login #backtoblog a {font-family: "Lora";font-size: 14px;font-style: normal;color: inherit;}';
		$login_page_css .= 'body.login #backtoblog a:hover {color: inherit;}';
		$login_page_css .= 'body.login form p.submit input[type="submit"] {font-family: "Lora";font-size: 14px;height: auto;line-height:48px;padding: 0 35px;color: '.esc_attr($title_color).';background: #c39f77;border: none;border-radius: 2px;box-shadow: none;text-shadow: none;}';
		$login_page_css .= 'body.login form .forgetmenot label {line-height: 48px;}';
		$login_page_css .= 'body.login form .forgetmenot label input[type="checkbox"] {position: relative;width: 20px; height: 20px;background: '.esc_attr($input_bg).';border-color: '.esc_attr($input_border).';border-radius: 0;}';
		$login_page_css .= 'body.login form .forgetmenot label input[type="checkbox"]:before {content: "";width: 12px;height: 12px;position: absolute; top: 50%;left: 50%;margin-top: -6px;margin-left: -6px;background: '.esc_attr($input_border).';-webkit-transform: scale(0);-moz-transform: scale(0);-o-transform: scale(0);transform: scale(0);-webkit-transition: all .3s ease 0s;-moz-transition: all .3s ease 0s;-o-transition: all .3s ease 0s;transition: all .3s ease 0s;}';
		$login_page_css .= 'body.login form .forgetmenot label input[type="checkbox"]:checked:before {-webkit-transform: scale(1);-moz-transform: scale(1);-o-transform: scale(1);transform: scale(1);}';
		$login_page_js .=	'<script type="text/javascript">
								(function($) {
									$(document).ready(function() {
										$("#loginform").prepend("<p class=\"login-title\">'.esc_html__('Log in on').' <span>'.esc_html__('site').'</span></p>");
										if($("#login > h1 > a")) {
											var $logo = $("#login > h1 > a"),
												$logoClone = $logo.clone();
											$logoClone.prependTo("body").addClass("logo");
											$logo.remove();
										}
									});
								})(jQuery);
							</script>';
	}
	
	$login_page_css .= '.logo, .login h1 a { background-repeat: no-repeat; background-image:url('. esc_url($custom_logo) .') !important; height: auto !important; min-height: '.esc_attr($logo_height).'px !important; width: '.esc_attr($logo_width).'px !important; background-size: contain !important;}';
	
	$login_page_css = '<style type="text/css">'.$login_page_css.'</style>';
	
	echo $before_login_page_css;
	echo $login_page_css;
	echo $login_page_js;
}

add_action('login_head', 'crum_custom_login_logo');

function crum_home_link() {
    return site_url();
}
add_filter('login_headerurl','crum_home_link');

function change_title_on_logo() {
    return get_bloginfo( 'name' );
}
add_filter('login_headertitle', 'change_title_on_logo');


// Add/Remove Contact Methods
function add_remove_contactmethods( $contactmethods ) {
	$contacts = author_contact_methods();
	
	foreach($contacts as $k=>$v) {
		$contactmethods[$k] = $v;
	}

    // Remove Contact Methods
    unset($contactmethods['aim']);
    unset($contactmethods['yim']);
    unset($contactmethods['jabber']);

    return $contactmethods;
}
add_filter('user_contactmethods','add_remove_contactmethods',10,1);


/**
 * Create pagination
 */

function crumin_pagination() {

    global $wp_query;

    $big = 999999999;

    $links = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'prev_next' => true,
            'prev_text' =>  __('Prev', 'dfd'), //text of the "Previous page" link
            'next_text' =>  __('Next', 'dfd'), //text of the "Next page" link

            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'type' => 'list'
        )
    );

    $pagination = str_replace('page-numbers','pagination',$links);

    echo $pagination;

}

/**
 * Breadcrumbs
 */
function dfd_breadcrumbs() {

    /* === OPTIONS === */
    $text['home']     = __('Home', 'dfd'); // text for the 'Home' link
    $text['category'] = __('Archive by Category "%s"', 'dfd'); // text for a category page
    $text['search']   = __('Search Results for "%s" Query', 'dfd'); // text for a search results page
    $text['tag']      = __('Posts Tagged "%s"', 'dfd'); // text for a tag page
    $text['author']   = __('Articles Posted by %s', 'dfd'); // text for an author page
    $text['404']      = __('Error 404', 'dfd'); // text for the 404 page

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = ' <span class="del"></span> '; // delimiter between crumbs
    $before      = '<span class="current">'; // tag before the current crumb
    $after       = '</span>'; // tag after the current crumb
    /* === END OF OPTIONS === */

    global $post;
    $homeLink = home_url() . '/';
    $linkBefore = '<span>';
    $linkAfter = '</span>';
    $link = $linkBefore . '<a href="%1$s">%2$s</a>' . $linkAfter;

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1) echo '<nav id="crumbs"><a href="' . esc_url($homeLink) . '">' . $text['home'] . '</a></nav>';

    } else {

        echo '<nav id="crumbs">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a', $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
            }
            echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

        } elseif ( is_search() ) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;


        }
        elseif (is_singular('topic') ){
            $post_type = get_post_type_object(get_post_type());
            printf($link, $homeLink . '/forums/', $post_type->labels->singular_name);
        }
        /* in forum, add link to support forum page template */
        elseif (is_singular('forum')){
            $post_type = get_post_type_object(get_post_type());
            printf($link, $homeLink . '/forums/', $post_type->labels->singular_name);
        }
        elseif (is_tax('topic-tag')){
            $post_type = get_post_type_object(get_post_type());
            printf($link, $homeLink . '/forums/', $post_type->labels->singular_name);
        }
        elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
				if(isset($cat[0])) {
					$cat =  $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $linkBefore . '<a', $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
					if ($showCurrent == 1) echo $before . get_the_title() . $after;
				}
            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
			if($cat) {
				$cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a', $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
				printf($link, get_permalink($parent), $parent->post_title);
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
			}
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo $before . get_the_title() . $after;

        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) echo $delimiter;
            }
            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

        } elseif ( is_tag() ) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;

        } elseif ( is_404() ) {
            echo $before . $text['404'] . $after;
        }

        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page', 'dfd') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

        echo '</nav>';

    }
}

function dfd_portfolio_breadcrumbs() {
	global $dfd_ronneby;
	$delimiter   = ' <span class="del"></span> ';
	
	$html = '';
	$html .= '<nav id="crumbs">';
	$html .= '<span><a href="' . esc_url(home_url()) . '">' . esc_html__('Home', 'dfd') . '</a></span>';
	$html .= $delimiter;
	
	if(isset($dfd_ronneby['folio_top_page_select']) && !empty($dfd_ronneby['folio_top_page_select'])) {
		$page = $dfd_ronneby['folio_top_page_select'];
		
		if(isset($dfd_ronneby['folio_top_page_title']) && !empty($dfd_ronneby['folio_top_page_title'])) {
			$title = $dfd_ronneby['folio_top_page_title'];
		} else {
			$title = get_the_title($page);
		}
		$slug = get_permalink($page);
	
		if (!empty($title) && !empty($slug)) {
			$html .= '<span><a href="' . esc_url($slug) . '">' . esc_html($title) . '</a></span>';
			$html .= $delimiter;
		}
	}
	
	$html .= '<span>'.esc_html(get_the_title()).'</span>';
	$html .= '</nav>';
	
	echo $html;
}

function custom_bbp_breadcrumb() {
	$args['before'] = '<nav id="crumbs"><span>';
	$args['after'] = '</span></nav>';
	$args['sep'] = '<span class="del"></span>';
	$args['pad_sep'] = 0;
	$args['sep_before'] = '</span>';
	$args['sep_after'] = '<span>';
	$args['current_before'] = '';
	$args['current_after'] = '';
	$args['home_text'] = __('Home', 'dfd');
	
	return $args;
}

add_filter('bbp_before_get_breadcrumb_parse_args', 'custom_bbp_breadcrumb');

function custom_woocommerce_breadcrumb_defaults($args=array()) {
	$args['delimiter'] = '<span class="del"></span>';
	$args['wrap_before'] = '<nav id="crumbs">';
	$args['wrap_after'] = '</nav>';
	$args['before'] = '<span>';
	$args['after'] = '</span>';
	
	return $args;
}

add_filter('woocommerce_breadcrumb_defaults', 'custom_woocommerce_breadcrumb_defaults');

/*
 * Seo additions
 */

/**
 * Add Google+ meta tags to header
 *
 * @uses	get_the_ID()  Get post ID
 * @uses	setup_postdata()  setup postdata to get the excerpt
 * @uses	wp_get_attachment_image_src()  Get thumbnail src
 * @uses	get_post_thumbnail_id  Get thumbnail ID
 * @uses	the_title()  Display the post title
 *
 * @author c.bavota
 */
//add_action( 'wp_head', 'add_google_plus_meta' );

function add_google_plus_meta() {

    if( is_single() ) {

        global $post;

        $post_id = get_the_ID();
        setup_postdata( $post );

        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
        $thumbnail = empty( $thumbnail ) ? '' : '<meta itemprop="image" content="' . esc_url( $thumbnail[0] ) . '">';
        ?>

    <!-- Google+ meta tags -->
    <meta itemprop="name" content="<?php esc_attr( the_title() ); ?>">
    <meta itemprop="description" content="<?php echo esc_attr( get_the_excerpt() ); ?>">
    <?php echo $thumbnail . "\n"; ?>

    <!-- eof Google+ meta tags -->
    <?php

    }

}

/*-----------------------------------------------------------------------------------*/
# Get Social Counter
/*-----------------------------------------------------------------------------------*/
global $dfd_ronneby;
$cachetime = (isset($dfd_ronneby['cachetime']) && $dfd_ronneby['cachetime']) ? ((int) $dfd_ronneby['cachetime'] * 60) : (60 * 60 * 1);

function tie_curl_subscribers_text_counter( $xml_url ) {
	$data_buf = wp_remote_get($xml_url, array('sslverify' => false));
	if (!is_wp_error($data_buf) && isset($data_buf['body'])) {
		return $data_buf['body'];
	}
}

function tie_rss_count( $fb_id ) {
    $feedburner['rss_count'] = get_option( 'rss_count');
    return $feedburner;
}

function tie_followers_count() {
	global $dfd_ronneby;
	$twitter_username = isset($dfd_ronneby['username']) ? $dfd_ronneby['username'] : '';
	
	$r['page_url'] = 'http://www.twitter.com/'.$twitter_username;
	
    try {
		require_once locate_template('/inc/lib/twitteroauth.php');
		$twitter = new DFDTwitter();
		$r['followers_count'] = $twitter->getFollowersCount();
    } catch (Exception $e) {
        $r['followers_count'] = 0;
    }

    return $r;
}

function tie_facebook_fans( $page_id ){/*
    $face_link = @parse_url($page_link);
	$fans = 0;
	
	if ( false === ( $fans = get_transient( 'facebook_fans_cache' ) ) ) {
		
		if( $face_link['host'] == 'www.facebook.com' || $face_link['host']  == 'facebook.com' ){
			try {
				$page_name = substr(@parse_url($page_link, PHP_URL_PATH), 1);
				$data = @json_decode(tie_curl_subscribers_text_counter("https://graph.facebook.com/".$page_name));
				if ($data && isset($data->likes)) {
					$fans = intval($data->likes);
				}
			} catch (Exception $e) {
				$fans = 0;
			}
			
		}
		
	}
	
	return $fans;*/
	global $cachetime;

	$fans = '';
    $xml = @simplexml_load_file("http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20page_id=".$page_id);
	if(!empty($xml) && is_object($xml)) {
		$fans = (string)$xml->page->fan_count;
	}
	if(empty($fans)) $fans = 0;
	set_transient( 'facebook_fans_cache', $fans, $cachetime );
    return $fans;
}


function tie_youtube_subs( $channel_link, $api_key ){
    $youtube_link = @parse_url($channel_link);
	$subs = 0;
	global $cachetime;
	
	if ( false === ( $subs = get_transient( 'youtube_subs_cache' ) ) ) {
		if( $youtube_link['host'] == 'www.youtube.com' || $youtube_link['host']  == 'youtube.com' ){
			try {
				$youtube_name = substr(@parse_url($channel_link, PHP_URL_PATH), 9);
				$json = @tie_curl_subscribers_text_counter("https://www.googleapis.com/youtube/v3/channels?part=statistics&id=".$youtube_name."&key=".$api_key);
				$data = json_decode($json, true);

				$subs = intval($data['items'][0]['statistics']['subscriberCount']);
			} catch (Exception $e) {
				$subs = 0;
			}

			set_transient( 'youtube_subs_cache', $subs, $cachetime );
		}
	}
	
    return $subs;
}


function tie_vimeo_count( $page_link ) {
    $face_link = @parse_url($page_link);

    if( $face_link['host'] == 'www.vimeo.com' || $face_link['host']  == 'vimeo.com' ){
        try {
            $page_name = substr(@parse_url($page_link, PHP_URL_PATH), 10);
            @$data = @json_decode(tie_curl_subscribers_text_counter( 'http://vimeo.com/api/v2/channel/' . $page_name  .'/info.json'));

            $vimeo = $data->total_subscribers;
        } catch (Exception $e) {
            $vimeo = 0;
        }

        if( !empty($vimeo) && get_option( 'vimeo_count') != $vimeo )
            update_option( 'vimeo_count' , $vimeo );

        if( $vimeo == 0 && get_option( 'vimeo_count') )
            $vimeo = get_option( 'vimeo_count');

        elseif( $vimeo == 0 && !get_option( 'vimeo_count') )
            $vimeo = 0;

        return $vimeo;
    }

}

function tie_dribbble_count( $page_link ) {
    $face_link = @parse_url($page_link);

    if( $face_link['host'] == 'www.dribbble.com' || $face_link['host']  == 'dribbble.com' ){
        try {
            $page_name = substr(@parse_url($page_link, PHP_URL_PATH), 1);
            @$data = @json_decode(tie_curl_subscribers_text_counter( 'http://api.dribbble.com/' . $page_name));

            $dribbble = $data->followers_count;
        } catch (Exception $e) {
            $dribbble = 0;
        }

        if( !empty($dribbble) && get_option( 'dribbble_count') != $dribbble )
            update_option( 'dribbble_count' , $dribbble );

        if( $dribbble == 0 && get_option( 'dribbble_count') )
            $dribbble = get_option( 'dribbble_count');

        elseif( $dribbble == 0 && !get_option( 'dribbble_count') )
            $dribbble = 0;

        return $dribbble;
    }
}

function dfd_get_multisite_option() {
	$dfd_multisite_file_option = '';
	if(is_multisite()) {
		$blog_details = get_blog_details();
		$blog_id = '';
		if(!empty($blog_details) && is_object($blog_details)) {
			$dfd_multisite_file_option .= '-'.$blog_details->blog_id;
		}
	}
	return $dfd_multisite_file_option;
}

/**
 * Return all files to compile
 */
function get_dfd_less_files(){
	
	global $dfd_ronneby;
	
	$dfd_multisite_file_option = dfd_get_multisite_option();
	
	$less_files = array(
		'admin-panel' => array(
			'src' => get_template_directory() . '/assets/less/admin-panel.less',
			'out' => get_template_directory() . '/assets/css/admin-panel.css',
		),
		
		'animate-custom' => array(///
			'src' => get_template_directory() . '/assets/less/animate-custom.less',
			'out' => get_template_directory() . '/assets/css/animate-custom.css',
		),
		/*
			/////app.css/////
		'framework' => array(
			'src' => get_template_directory() . '/assets/less/framework.less',
			'out' => get_template_directory() . '/assets/css/app'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		'main_layouts_part1' => array(
			'src' => get_template_directory() . '/assets/less/main_layouts_part1.less',
			'out' => get_template_directory() . '/assets/css/app'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		'main_layouts_part2' => array(
			'src' => get_template_directory() . '/assets/less/main_layouts_part2.less',
			'out' => get_template_directory() . '/assets/css/app'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		'theme_components_part1' => array(
			'src' => get_template_directory() . '/assets/less/theme_components_part1.less',
			'out' => get_template_directory() . '/assets/css/app'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		'theme_components_part2' => array(
			'src' => get_template_directory() . '/assets/less/theme_components_part2.less',
			'out' => get_template_directory() . '/assets/css/app'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		'theme_components_part3' => array(
			'src' => get_template_directory() . '/assets/less/theme_components_part3.less',
			'out' => get_template_directory() . '/assets/css/app'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		'pages' => array(
			'src' => get_template_directory() . '/assets/less/pages.less',
			'out' => get_template_directory() . '/assets/css/app'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		'widgets' => array(
			'src' => get_template_directory() . '/assets/less/widgets.less',
			'out' => get_template_directory() . '/assets/css/app'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		'woocommerce_widgets' => array(
			'src' => get_template_directory() . '/assets/less/woocommerce_widgets.less',
			'out' => get_template_directory() . '/assets/css/app'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		*/
		'app' => array(
			'src' => get_template_directory() . '/assets/less/app.less',
			'out' => get_template_directory() . '/assets/css/app'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		/*
		///////visual-composer.css/////
		'visual-composer-part1' => array(
			'src' => get_template_directory() . '/assets/less/visual-composer-part1.less',
			'out' => get_template_directory() . '/assets/css/visual-composer'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		'visual-composer-part2' => array(
			'src' => get_template_directory() . '/assets/less/visual-composer-part2.less',
			'out' => get_template_directory() . '/assets/css/visual-composer'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		'visual-composer-part3' => array(
			'src' => get_template_directory() . '/assets/less/visual-composer-part3.less',
			'out' => get_template_directory() . '/assets/css/visual-composer'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		'visual-composer-part4' => array(
			'src' => get_template_directory() . '/assets/less/visual-composer-part4.less',
			'out' => get_template_directory() . '/assets/css/visual-composer'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		*/
		'visual-composer' => array(
			'src' => get_template_directory() . '/assets/less/visual-composer.less',
			'out' => get_template_directory() . '/assets/css/visual-composer'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		////////////////
		'bbpress' => array(
			'src' => get_template_directory() . '/assets/less/bbpress.less',
			'out' => get_template_directory() . '/assets/css/bbpress'.$dfd_multisite_file_option.'.css',
		),
		
		'buddypress' => array(
			'src' => get_template_directory() . '/assets/less/buddypress.less',
			'out' => get_template_directory() . '/assets/css/buddypress'.$dfd_multisite_file_option.'.css',
		),
		/*
		'flexslider' => array(
			'src' => get_template_directory() . '/assets/less/flexslider.less',
			'out' => get_template_directory() . '/assets/css/flexslider.css',
		),
		*/
		'jquery.isotope' => array(
			'src' => get_template_directory() . '/assets/less/jquery.isotope.less',
			'out' => get_template_directory() . '/assets/css/jquery.isotope.css',
		),
		
		'mobile-responsive' => array(
			'src' => get_template_directory() . '/assets/less/mobile-responsive.less',
			'out' => get_template_directory() . '/assets/css/mobile-responsive.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		
		'multislider' => array(
			'src' => get_template_directory() . '/assets/less/multislider.less',
			'out' => get_template_directory() . '/assets/css/multislider.css',
		),
		/*
		'preloader' => array(
			'src' => get_template_directory() .'/assets/less/preloader.less',
			'out' => get_template_directory() . '/assets/css/preloader'.$dfd_multisite_file_option.'.css',
		),
		*/
		'prettyPhoto' => array(
			'src' => get_template_directory() . '/assets/less/prettyPhoto.less',
			'out' => get_template_directory() . '/assets/css/prettyPhoto.css',
		),
		
		'rtl' => array(
			'src' => get_template_directory() . '/assets/less/rtl.less',
			'out' => get_template_directory() . '/assets/css/rtl.css',
		),
		
		'site-preloader' => array(
			'src' => get_template_directory() .'/assets/less/site-preloader.less',
			'out' => get_template_directory() . '/assets/css/site-preloader'.$dfd_multisite_file_option.'.css',
		),

		'styled-button' => array(
			'src' => get_template_directory() .'/assets/less/styled-button.less', 
			'out' => get_template_directory() . '/assets/css/styled-button'.$dfd_multisite_file_option.'.css',
		),
		
		'woocommerce' => array(
			'src' => get_template_directory() . '/assets/less/woocommerce.less',
			'out' => get_template_directory() . '/assets/css/woocommerce'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,

		),
		
		'woocommerce_old' => array(
			'src' => get_template_directory() . '/assets/less/woocommerce_old.less',
			'out' => get_template_directory() . '/assets/css/woocommerce_old'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			//'redux_recompile'=>true,
		),
		/*
		'go_pricing_skin_blue' => array(
			'src' => get_template_directory() . '/assets/less/go_pricing_skin.less',
			'out' => get_template_directory() . '/assets/css/go_pricing_skin'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
		),
		
		'masterslider_default' => array(
			'src' => get_template_directory() . '/assets/less/masterslider.less',
			'out' => get_template_directory() . '/assets/css/masterslider'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
		),
		'custom_styles' => array(
			'src' => get_template_directory() . '/assets/less/custom-styles.less',
			'out' => get_template_directory() . '/assets/css/custom-styles'.$dfd_multisite_file_option.'.css',
			'autocompile' => true,
			'redux_recompile'=>true,
		),
		*/

	);
	
	/*
	$woo_custom_style = '';
	
	if(isset($dfd_ronneby['dfd_woocommerce_templates_path']) && $dfd_ronneby['dfd_woocommerce_templates_path'] == '_old') {
		$woo_custom_style = $dfd_ronneby['dfd_woocommerce_templates_path'];
	}
	$less_files['custom_styles_woocommerce'] = array(
		'src' => get_template_directory() . '/assets/less/woocommerce_custom'.$woo_custom_style.'.less',
		'out' => get_template_directory() . '/assets/css/custom-styles'.$dfd_multisite_file_option.'.css',
		'autocompile' => true,
		'redux_recompile'=>true,
	);
	*/
	$less_files = apply_filters('dfd_less_filter', $less_files);
	return $less_files;
}
/* * *
 * PHP Less
 */
function sb_auto_compile_less_init() {
	if (defined("DFD_ALWAYS_COMPILE")) {
		if (DFD_ALWAYS_COMPILE == true) {
			$com = new CompileLess();
			$com->setAllCompileStrategy();
			$com->runBackEndCompile();
		}
	}
}

function sb_auto_compile_less($inputFile, $outputFile) {
	if (!class_exists('lessc'))
		return false;

	$less = new lessc();
	try { 
		$less->setFormatter('compressed');//classic
		$less->compileFile($inputFile, $outputFile);
		unset($less);
	} catch (Exception $ex) {
		wp_die('Less compile error: '.$ex->getMessage());
	}
}

add_action('wp', 'sb_auto_compile_less_init');

/*
 * Saved theme options
 */

function sb_updated_theme_option( $option, $old_values ) {
	
	// Remove tab id	
	if(isset($old_values["last_tab"])){
		unset($old_values["last_tab"]);
	}
	/*Check if setting is changed*/
	if(empty($old_values)) return false;

	$checked_values = array('title_h1_typography_option', 'title_h2_typography_option', 'title_h3_typography_option', 'title_h4_typography_option', 'title_h5_typography_option', 'title_h6_typography_option', 'subtitle_h1_typography_option', 'subtitle_h2_typography_option', 'subtitle_h3_typography_option', 'subtitle_h4_typography_option', 'subtitle_h5_typography_option', 'subtitle_h6_typography_option', 'stunning_header_title_typography_option', 'blog_title_typography_option', 'widget_title_typography_option', 'block_title_typography_option', 'feature_title_typography_option', 'box_name_typography_option', 'subtitle_typography_option', 'text_typography_option', 'entry_meta_typography_option', 'menu_titles_typography_option', 'menu_dropdowns_typography_option', 'menu_dropdown_subtitles_typography_option', 'default_button_typography_option', 'link_typography_option', 'main_site_color', 'secondary_site_color', 'third_site_color', 'title_color', 'background_gray', 'subtitle_color', 'border_color', 'header_responsive_breakpoint', 'header_first_top_panel_background_color', 'header_first_top_panel_color', 'header_first_background_color', 'header_first_text_color', 'header_second_top_panel_background_color', 'header_second_top_panel_background_opacity', 'header_second_top_panel_color', 'header_second_background_color', 'header_second_background_opacity', 'header_second_text_color', 'header_third_top_panel_background_color', 'header_third_top_panel_color', 'header_third_background_color', 'header_third_text_color', 'header_fourth_top_panel_background_color', 'header_fourth_top_panel_background_opacity', 'header_fourth_top_panel_color', 'header_fourth_background_color', 'header_fourth_background_opacity', 'header_fourth_text_color', 'fifth_header_logo_background_color', 'header_fifth_top_panel_background_color', 'header_fifth_top_panel_color', 'header_fifth_background_color', 'header_fifth_bg_image', 'header_fifth_bg_img_position', 'header_fifth_text_color', 'header_sixth_text_color', 'header_seventh_background_color', 'header_seventh_background_opacity', 'header_seventh_text_color_active', 'header_seventh_text_color', 'eighth_header_logo_background_color', 'header_eighth_top_panel_background_color', 'header_eighth_top_panel_color', 'header_eighth_background_color', 'header_eighth_bg_image', 'header_eighth_bg_img_position', 'header_eighth_text_color', 'header_eighth_navbutton_color', 'header_eighth_navbutton_bg', 'header_eighth_navbutton_bg_opacity', 'header_ninth_top_panel_background_color', 'header_ninth_top_panel_color', 'header_ninth_background_color', 'header_ninth_text_color', 'header_ninth_banner_height', 'header_tenth_top_panel_background_color', 'header_tenth_top_panel_background_opacity', 'header_tenth_top_panel_color', 'header_tenth_background_color', 'header_tenth_background_opacity', 'header_tenth_text_color', 'header_tenth_banner_height', 'header_eleventh_top_panel_background_color', 'header_eleventh_top_panel_color', 'header_eleventh_background_color', 'header_eleventh_bg_image', 'header_eleventh_bg_img_position', 'header_eleventh_text_color', 'header_twelfth_top_panel_background_color', 'header_twelfth_top_panel_color', 'header_twelfth_background_color', 'header_twelfth_text_color', 'header_thirteenth_top_panel_background_color', 'header_thirteenth_top_panel_background_opacity', 'header_thirteenth_top_panel_color', 'header_thirteenth_background_color', 'header_thirteenth_background_opacity', 'header_thirteenth_text_color', 'header_fourteenth_background_color', 'header_fourteenth_background_opacity', 'header_fourteenth_text_color_active', 'header_fourteenth_text_color', 'sticky_header_logo_background_color', 'fixed_header_background_color', 'fixed_header_background_opacity', 'fixed_header_text_color', 'top_panel_inner_background', 'top_panel_inner_background_opacity', 'header_logo_height', 'top_menu_height', 'stunning_header_min_height', 'blog_smart_hover_text_color', 'blog_smart_hover_bg', 'blog_smart_hover_bg_opacity', 'folio_hover_text_color', 'folio_hover_bg', 'folio_hover_bg_opacity', 'dfd_gallery_hover_text_color', 'dfd_gallery_hover_bg', 'dfd_gallery_hover_bg_opacity', 'header_logo_width', 'default_button_hover_color', 'default_button_background', 'default_button_hover_bg', 'default_button_background_opacity', 'default_button_hover_bg_opacity', 'default_button_border', 'default_button_border_opacity', 'default_button_hover_border', 'default_button_hover_border_opacity', 'default_button_border_width', 'default_button_border_style', 'default_button_border_radius', 'default_button_padding_left', 'default_button_padding_right', 'to_top_button_font_size', 'to_top_button_size', 'to_top_button_color', 'to_top_button_hover_color', 'to_top_button_background', 'to_top_button_hover_bg', 'to_top_button_background_opacity', 'to_top_button_hover_bg_opacity', 'to_top_button_border', 'to_top_button_border_opacity', 'to_top_button_hover_border', 'to_top_button_hover_border_opacity', 'to_top_button_border_width', 'to_top_button_border_style', 'to_top_button_border_radius', 'menu_dropdowns_opacity', 'menu_dropdown_hover_color', 'menu_dropdown_background', 'menu_dropdown_background_opacity', 'menu_dropdown_hover_bg', 'menu_dropdown_hover_bg_opacity', 'mobile_header_bg', 'mobile_header_color', 'mobile_menu_bg', 'mobile_menu_color', 'mobile_menu_color_opacity', 'layout_whitespace_size', 'layout_whitespace_color', 'post_title_bottom_offset', 'link_hover_color', 'link_decoration', 'link_decoration_color', 'woo_star_rating_color', 'woo_products_hover_bg', 'woo_products_hover_bg_opacity', 'x_large_responsive_breakpoint', 'large_responsive_breakpoint', 'medium_responsive_breakpoint', 'small_responsive_breakpoint');

	if(is_array($old_values)) {
		$i = 0;
		foreach($old_values as $k => $v) {
			if(in_array($k, $checked_values))
				$i++;
		}
		if($i == 0) return false;
	}

	$com = new CompileLess();
	$com->setAutoGenerateVariables();
	$com->setSimpleCompileStrategy();
	$com->run();
	return false;
}

add_action('redux/'.DFD_THEME_SETTINGS_NAME.'/panel/after', 'sb_updated_theme_option', 10, 3);
//add_action('redux/options/'.DFD_THEME_SETTINGS_NAME.'/saved', 'sb_updated_theme_option', 10, 3);
//add_action('updated_option', 'sb_updated_theme_option', 10, 3);

function dfd_stylecharger_return_header() {
    get_template_part('templates/header/style', dfd_get_header_style_option());
    exit;
}

function feature_read_more_style() {
	$feature_read_more = array(
		'read-more-default' => __('Main style', 'mvb'),
		'read-more' => __('Alternative style', 'mvb')
	);
	
	return $feature_read_more;
}

if (!function_exists('dfd_num_to_string')) {
	function dfd_num_to_string( $str = 1){
		$arr = array(1 => 'twelve', 'six', 'four', 'three');

		if( isset($arr[$str]) ) {
			return $arr[$str];
		} else {
			return 'twelve';
		}
	}
}

if (!function_exists('dfd_num_to_string_full')) {
	function dfd_num_to_string_full( $str = 1, $reversal = false){
		$arr = array( 1 => 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', );

		if( isset($arr[$str]) && !$reversal ) {
			return $arr[$str];
		}elseif( isset($arr[$str]) && $reversal && 0 != 12 - $str ) {
			return $arr[12 - $str];
		} else {
			return 'twelve';
		}
	}
}

if (!function_exists('dfd_vc_delimiter_styles')) {
	function dfd_vc_delimiter_styles() {
		return array(
			__('None', 'dfd') => '',
			__('Default', 'dfd') => 1,
			__('With shadow above', 'dfd') => 2,
			__('With shadow below', 'dfd') => 3,
			__('Color triangle', 'dfd') => 4,
			__('Transparent triangle bottom', 'dfd') => 5,
			__('Transparent triangle top', 'dfd') => 6,
			__('Transparent triangle both top and bottom', 'dfd') => 7,
			__('Fade top', 'dfd') => 8,
			__('Fade bottom', 'dfd') => 9,
			__('Fade both top and bottom', 'dfd') => 10,
			__('Boxed border', 'dfd') => 11,
			__('Vertical line at the bottom', 'dfd') => 12,
		);
	}
}

if (!function_exists('dfd_folio_thumb_width')) {
	function dfd_folio_thumb_width() {
		$_thumb_width = array();
		
		for($i=1; $i<=4; $i++) {
			$_thumb_width[] = array(
								'value' => (string)$i,
								'name' => (string)$i,
							);
		}
		
		return $_thumb_width;
	}
}

if (!function_exists('dfd_folio_thumb_height')) {
	function dfd_folio_thumb_height() {
		$_thumb_height = array();
		
		for($i=1; $i<=4; $i++) {
			$_thumb_height[] = array(
								'value' => (string)$i,
								'name' => (string)$i,
							);
		}
		
		return $_thumb_height;
	}
}

if(!function_exists('column_class_maker')) {
	function column_class_maker($count = 1) {
		if($count % 3 == 0) {
			return 'third-size';
		} elseif($count % 2 == 0) {
			return 'half-size';
		} else {
			return 'full-width';
		}
	}
}

/*
 * AJAX Pagination
 */
if(!function_exists('dfd_template_redirect')) {
	function dfd_template_redirect() {
		global $post, $portfolio_pagination_type, $dfd_pagination_style, $dfd_left_sidebar, $dfd_right_sidebar;
		if ( isset($post) && isset($post->ID) ) {
			$dfd_left_sidebar = get_post_meta($post->ID, 'crum_sidebars_sidebar_1', true);
			$dfd_right_sidebar = get_post_meta($post->ID, 'crum_sidebars_sidebar_2', true);
			$portfolio_pagination_type = get_post_meta($post->ID, 'dfd_pagination_type', true);
			$dfd_pagination_style = DfdMetaBoxSettings::compared('dfd_pagination_style', '');
		}
	}
}
if(!function_exists('dfd_ajax_template')) {
	function dfd_ajax_template() {
		$template = locate_template(array('base-ajax.php'));
		return $template;
	}
}
if(!function_exists('dfd_is_ajax_request')) {
	function dfd_is_ajax_request() {
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
				&& strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') === 0) {
			add_filter( 'template_include', 'dfd_ajax_template', 100 );
		}
	}
}

add_action('template_redirect', 'dfd_template_redirect');
add_action('init', 'dfd_is_ajax_request');
/*
if($_SERVER['SERVER_NAME'] != "themes.dfd.name" && $_SERVER['SERVER_NAME'] != "rnbtheme.com") {
	add_action('after_setup_theme','dfd_remove_analitics_code');
}

if(!function_exists('dfd_remove_analitics_code')) {
	function dfd_remove_analitics_code() {
		global $dfd_ronneby, $reduxConfig;
		
		if(isset($dfd_ronneby['custom_js']) && !empty($dfd_ronneby['custom_js']) && (substr_count($dfd_ronneby['custom_js'],'var google_conversion_id = 949215361;') > 0 || substr_count($dfd_ronneby['custom_js'],'yaCounter36542445') > 0)) {
			update_option('dfd_temp_custom_js_backup', $dfd_ronneby['custom_js']);
			ReduxFramework::set('custom_js', '');
		}
	}
}
*/
if (!class_exists("dfd_hide_unsuport_module_frontend")) {

	class dfd_hide_unsuport_module_frontend {

		private $name;

		/**
		 * 
		 * @param string $name css class to hide element
		 */
		function __construct($name) {
			if (vc_is_inline()) {
				$this->name = $name;
				add_action("admin_enqueue_scripts", array ($this, "addScript"));
			}
		}

		public function addScript() {
			echo '<style type="text/css">
					
						.' . $this->name . '_o{
		display:none !important;
	}
				</style>';
		}

	}

}


if(!function_exists('dfd_show_unsuport_nested_module_frontend')) {
	/**
	 * 
	 * @param string $name Name of shortcode
	 */
	function dfd_show_unsuport_nested_module_frontend($name=""){
		if(vc_is_inline()){
			$text = sprintf(__("Module %s is not supported by frontend editor","dfd"), $name);
			echo $result = "<div class='dfd_unsuport_frontend_module'><div class='cell'>".$text."</div></div>";
			return true;
		}else{
			return false;
		}

	}
}
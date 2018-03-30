<?php

// Add Localization
load_theme_textdomain('webnus_framework', get_template_directory().'/languages');

// Includes
include_once get_template_directory(). '/inc/init.php';
include_once get_template_directory(). '/inc/visualcomposer/init.php';

add_action( 'after_setup_theme', 'webnus_theme_setup' );

function webnus_theme_setup() {

	add_theme_support('title-tag');
	add_theme_support('woocommerce');
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-formats', array( 'aside','gallery', 'link', 'quote','image','video','audio' ));

	add_action('init', 'webnus_register_menus');
	add_action('wp_enqueue_scripts', 'webnus_script_loader');
	add_action('wp_enqueue_scripts', 'webnus_api', 10);
	add_action('admin_enqueue_scripts', 'webnus_admin_enqueue' );
	add_action('wp_head', 'webnus_wphead_action');
	add_action('login_head', 'webnus_custom_login_logo' );
	add_action('wp_head', 'webnus_open_graph_tags');
	add_action('template_redirect', 'webnus_maintenance_mode');

	add_filter('excerpt_length', 'webnus_excerpt_length', 999);
	add_filter('excerpt_more', 'webnus_excerpt_more');
	add_filter('upload_mimes', 'webnus_custom_font_mimes');
	add_filter('the_content', 'webnus_fix_parallax');
	add_filter('widget_text', 'do_shortcode');

	update_option( 'image_default_link_type', 'file' );

}

// Globals should always be within a function
function webnus_options() {
	global $webnus_options;
	return $webnus_options;
}


/***************************************/
/*	    Maintenance Mode
/***************************************/
function webnus_maintenance_mode() {
	$webnus_options = webnus_options();
	$is_maintenance = isset( $webnus_options['webnus_maintenance_mode'] ) ? $webnus_options['webnus_maintenance_mode'] : '';
	$maintenance_page = isset($webnus_options['webnus_maintenance_page']) ? $webnus_options['webnus_maintenance_page'] : '';
	if (!is_page( $maintenance_page ) && $is_maintenance && $maintenance_page && !current_user_can('edit_posts') && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ))){
		wp_redirect( esc_url( home_url( 'index.php?page_id='.$maintenance_page) ) );
		exit();
	}
}


/***************************************/
/*	    Excerpt Length
/***************************************/

function webnus_excerpt_length($length) {
    return 300;
}

function webnus_excerpt($limit) {
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

function webnus_excerpt_more($more) {
	global $post;
	$webnus_options = webnus_options();
	$webnus_options['webnus_blog_readmore_text'] = isset( $webnus_options['webnus_blog_readmore_text'] ) ? $webnus_options['webnus_blog_readmore_text'] : '';
	return '... <br><br><a class="readmore" href="' . get_permalink($post->ID) . '">' . esc_html($webnus_options['webnus_blog_readmore_text']) . '</a>';
}


/*********************/
/*	    LOGIN
/*********************/

function webnus_login() {
	global $user_ID, $user_identity, $user_level;
	function webnus_logout_redirect($logouturl, $redir){
		return $logouturl . '&amp;redirect_to=http://'.esc_attr($_SERVER['HTTP_HOST']).esc_attr($_SERVER['REQUEST_URI']);
	}
	add_filter('logout_url', 'webnus_logout_redirect', 10, 2);;
	if ($user_ID) : ?>
		<div id="user-logged">
			<span class="author-avatar"><?php echo get_avatar( $user_ID, $size = '100'); ?></span>
			<div class="user-welcome"><?php _e('Welcome','webnus_framework'); ?> <strong><?php echo esc_html($user_identity) ?></strong></div>
			<ul class="logged-links">
				<li><a href="<?php echo esc_url(home_url()); ?>/wp-admin/"><?php _e('Dashboard','webnus_framework'); ?> </a></li>
				<li><a href="<?php echo esc_url(home_url()); ?>/wp-admin/profile.php"><?php _e('My Profile','webnus_framework'); ?> </a></li>
				<li><a href="<?php echo esc_url(wp_logout_url()); ?>"><?php _e('Logout','webnus_framework'); ?> </a></li>
			</ul>
			<div class="clear"></div>
		</div>
	<?php else: ?>
		<div id="user-login">
			<form name="loginform" id="loginform" action="<?php echo home_url() ?>/wp-login.php" method="post">
				<p id="login-user"><input type="text" name="log" id="log" value="<?php _e('Username','webnus_framework'); ?>" onfocus="if (this.value == '<?php _e('Username','webnus_framework'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Username','webnus_framework'); ?>';}"  size="33" /></p>
				<p id="login-pass"><input type="password" name="pwd" id="pwd" value="<?php _e('Password','webnus_framework'); ?>" onfocus="if (this.value == '<?php _e('Password','webnus_framework'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Password','webnus_framework'); ?>';}" size="33" /></p>
				<input type="submit" name="submit" value="<?php _e('Log in','webnus_framework') ?>" class="login-button" />
				<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> <?php _e('Remember Me','webnus_framework'); ?></label>
				<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>"/>
			</form>
			<ul class="login-links">
				<?php if ( get_option('users_can_register') ) : ?><?php echo wp_register() ?><?php endif; ?>
				<li><a href="<?php echo esc_url(home_url()); ?>/wp-login.php?action=lostpassword"><?php _e('Lost your password?','webnus_framework'); ?></a></li>
			</ul>
		</div>
	<?php endif;
}


/****************************/
/*	   Navigation Menu
/****************************/

/** Register Menus */
function webnus_register_menus() {
	register_nav_menus(
		array(
			'header-menu' => __('Header Menu', 'webnus_framework'),
			'duplex-menu-left' => __('Duplex Menu - Left', 'webnus_framework'),
			'duplex-menu-right' => __('Duplex Menu - Right', 'webnus_framework'),
			'footer-menu' => __('Footer Menu', 'webnus_framework'),
			'header-top-menu' => __('Topbar Menu', 'webnus_framework'),
			'onepage-header-menu' => __('Onepage Header Menu', 'webnus_framework'),
		)
	);
}

/** Walker Nav Menu */
class webnus_description_walker extends Walker_Nav_Menu{
	function start_el(&$output, $item, $depth=0, $args=array(),$current_object_id=0){
		$this->curItem = $item;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$is_mega_menu = '';
		if('page'  == $item->object){
			$post_obj = get_post( $item->object_id, 'OBJECT' );
			$is_mega = get_post_meta($item->object_id,'_is_mega_menu',true);
			if(!empty($is_mega) && $is_mega['is_mega_menu'] == 'yes')
				$is_mega_menu .= ' mega ';
		}
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
		$attributes = '';
		$item_output = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		if('page'  == $item->object){
			$post_obj = get_post( $item->object_id, 'OBJECT' );
			$is_mega = get_post_meta($item->object_id,'_is_mega_menu',true);
			if(!empty($is_mega) && $is_mega['is_mega_menu'] == 'yes')
				$item_output .= do_shortcode($post_obj->post_content);
			else {
				$item_output .= $args->before;

/** colorize categories in menu */
				$color ='';
				if ($item->object == 'category'){
					$cat_data = get_option("category_$item->object_id");
					$color = (!empty($cat_data['catBG']))?'style="color:'. $cat_data['catBG'] .'"':'';
				}
				$item_output .= '<a '. $color . $attributes. ' data-description="' .$item->description .'">';
				if(!empty($item->icon))
				$item_output .= '<i class="'.$item->icon.'"></i>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;
			}
		}
		else{
			$item_output .= $args->before;
			$item_output .= '<a '. $attributes. ' data-description="' .$item->description .'">';
			if(!empty($item->icon))
				$item_output .= '<i class="'.$item->icon.'"></i>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
		}

/** mega posts start */
		if ( $depth == 0 && $item->object == 'category' && $item->classes['0'] == "mega" ) {
			$item_output .= '<ul class="sub-posts">';
				global $post;
				$menuposts = get_posts( array( 'posts_per_page' => 4, 'category' => $item->object_id ) );
				foreach( $menuposts as $post ):
					$post_title = get_the_title();
					$post_link = get_permalink();
					$post_time = get_the_time('d M Y');
					$post_comments = get_comments_number();
					$post_views = webnus_getViews(get_the_ID());
					$post_image = wp_get_attachment_image_src( get_post_thumbnail_id(), "latestfromblog" );
					if ( $post_image != ''){
						$menu_post_image = '<img src="' . $post_image[0]. '" alt="' . $post_title . '" width="' . $post_image[1]. '" height="' . $post_image[2]. '" />';
					} else {
						$menu_post_image = esc_html__( 'No image','webnus_framework');
					}
					$item_output .= '
							<li>
								<figure>
									<a href="'  .$post_link . '">' . $menu_post_image . '</a>
								</figure>
								<h5><a href="' . $post_link . '">' . $post_title . '</a></h5>
							</li>';
				endforeach;
				wp_reset_postdata();
			$item_output .= '</ul>';
		}
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


/*******************************/
/*		Thumbnails Size
/******************************/

add_image_size("tabs-img",		164, 124, true);
add_image_size("blog3_thumb",	420, 280, true);
add_image_size("blog2_thumb",	420, 330, true);
add_image_size("square",		460, 460, true);
add_image_size("sermons-grid",	518, 294, true);
add_image_size("post_img",		670, 374, true);
add_image_size("latest-cover",	690, 460, true);
add_image_size("latestfromblog",720, 388, true);


/****************************/
/*		Enqueue Scripts
/***************************/

function webnus_script_loader(){
	$webnus_options = webnus_options();
	$w_theme = wp_get_theme();
	$w_version = $w_theme->get('Version');

// main style
	$webnus_options['webnus_css_minifier'] = isset( $webnus_options['webnus_css_minifier'] ) ? $webnus_options['webnus_css_minifier'] : '';
	$main_style_uri = ($webnus_options['webnus_css_minifier'])?get_template_directory_uri().'/css/master-min.php':get_template_directory_uri().'/css/master.css';
	wp_register_style( 'main-style', $main_style_uri,false,$w_version);
	wp_enqueue_style('main-style');


// dyncss
	include_once get_template_directory() . '/inc/dynamicfiles/dyncss.php';
	if ( $GLOBALS['webnus_dyncss'] ) {
		wp_enqueue_style('webnus-dynamic-styles',get_template_directory_uri() . '/css/dyncss.css');
		wp_add_inline_style( 'webnus-dynamic-styles', $GLOBALS['webnus_dyncss']);
	}


// Webnus Google Fonts
function webnus_google_fonts_url() {
	$webnus_options = webnus_options();
	$webnus_options['webnus_template_select'] = isset( $webnus_options['webnus_template_select'] ) ? $webnus_options['webnus_template_select'] : '';
	$w_template = $webnus_options['webnus_template_select'];
    $fonts_url = '';
    $roboto = _x( 'on', 'Roboto font: on or off', 'webnus_framework' );
    $lora = _x( 'on', 'Lora font: on or off', 'webnus_framework' );
    $dosis = _x( 'on', 'Dosis font: on or off', 'webnus_framework' );
    $montserrat = _x( 'on', 'Montserrat font: on or off', 'webnus_framework' );
	$playfairdisplay = _x( 'on', 'Playfair Display font: on or off', 'webnus_framework' );
	$asap = _x( 'on', 'Asap font: on or off', 'webnus_framework' );
    if ( 'off' !== $roboto || 'off' !== $lora || 'off' !== $dosis || 'off' !== $montserrat || 'off' !== $playfairdisplay || 'off' !== $dosis || 'off' !== $asap ) {
        $font_families = array();
        if ('off' !== $roboto) {
            $font_families[] = 'Roboto:100,300,400,400italic,500,700,700italic';
        }
        if ('off' !== $lora) {
            $font_families[] = 'Lora:400,400italic,700';
        }
		if ('off' !== $dosis) {
            $font_families[] = 'Dosis:300,400,400italic,500,600,700italic,700';
        }
		if ('pax' == $w_template && 'off' !== $montserrat){
            $font_families[] = 'Montserrat:400,700';
        }
		if ('solace' == $w_template && 'off' !== $playfairdisplay) {
            $font_families[] = 'Playfair+Display:400,700';
        }
		if ('trust' == $w_template  && 'off' !== $asap) {
            $font_families[] = 'Asap:400,700';
        }
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
    return esc_url_raw( $fonts_url );
}
wp_enqueue_style( 'webnus-google-fonts', webnus_google_fonts_url(), array(), null );


// Custom Google Fonts
	$webnus_options['webnus_get_google_fonts'] = isset( $webnus_options['webnus_get_google_fonts'] ) ? $webnus_options['webnus_get_google_fonts'] : '';
	wp_enqueue_style( 'custom-google-fonts', $webnus_options['webnus_get_google_fonts'] );


// Comment Reply JS
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

// Webnus JS
	$webnus_options['webnus_news_ticker'] = isset( $webnus_options['webnus_news_ticker'] ) ? $webnus_options['webnus_news_ticker'] : '';
	wp_enqueue_script('doubletab', get_template_directory_uri() . '>/js/jquery.plugins.js', array( 'jquery' ), null, true);
	wp_enqueue_script('mediaelement', get_template_directory_uri() . '/js/mediaelement-and-player.min.js', array( 'jquery' ), null, true);
	if(!is_single())
		wp_enqueue_script('msaonry', get_template_directory_uri() . '/js/jquery.masonry.min.js', array( 'jquery' ), null, true);
	if($webnus_options['webnus_news_ticker'])
		wp_enqueue_script('ticker', get_template_directory_uri() . '/js/jquery.ticker.js', array( 'jquery' ), null, true);
	wp_enqueue_script('custom_script', get_template_directory_uri() . '/js/church-custom.js', array( 'jquery' ), null, true);

// Woocommerce js error hack
	if (class_exists('Woocommerce')){
		global $post, $woocommerce;
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		if(file_exists($woocommerce->plugin_path() . '/assets/js/jquery-cookie/jquery.cookie'.$suffix.'.js')){
			rename($woocommerce->plugin_path() . '/assets/js/jquery-cookie/jquery.cookie'.$suffix.'.js', $woocommerce->plugin_path() . '/assets/js/jquery-cookie/jquery_cookie'.$suffix.'.js');
		}
		wp_deregister_script( 'jquery-cookie' );
		wp_register_script( 'jquery-cookie', $woocommerce->plugin_url() . '/assets/js/jquery-cookie/jquery_cookie'.$suffix.'.js', array( 'jquery' ), '1.3.1', true );
	}

}

function webnus_api() {
	// Google Map api
	$webnus_options = webnus_options();
	$api_code 		= ( isset( $webnus_options['google_map_api'] ) && $webnus_options['google_map_api'] ) ? 'key=' . $webnus_options['google_map_api'] : '';
	$sign_in 		= ( isset( $webnus_options['google_map_api_sign_in'] ) && $webnus_options['google_map_api_sign_in'] ) ? 'signed_in=true' : '';
	$init_query 	= ( $api_code || $sign_in ) ? '?' : '';
	$merge_query 	= $api_code ? '&' : '';
	wp_register_script( 'googlemap-api', 'https://maps.googleapis.com/maps/api/js' . $init_query . $api_code . $merge_query . $sign_in, array(), false, false );

	// youtube
	wp_register_script( 'youtube-api', get_template_directory_uri() . '/js/youtube-api.js', array(), false, false );
}


/****************************/
/*	Admin Enqueue Scripts
/****************************/

function webnus_admin_enqueue() {
	// IconFonts Style
	wp_enqueue_style( 'iconfonts-style', get_template_directory_uri() . '/css/iconfonts.css', null, null );
	wp_enqueue_style( 'sweetalert', get_template_directory_uri() . '/css/sweetalert.min.css', array(), 'all' );
	wp_enqueue_style( 'webnus-admin-style', get_template_directory_uri() .'/inc/webnus-admin-welcome/assets/css/webnus-admin.css', array(), 'all' );

	// Webnus Admin JS
	wp_enqueue_script( 'sweetalert', get_template_directory_uri() . '/js/sweetalert.min.js', array(), null, true );
}


/************************************************************/
/*	Add Page Background & Typekit & Header Area to Header
/************************************************************/

function webnus_page_background_override(){
	GLOBAL $webnus_page_options_meta;
	$meta = $webnus_page_options_meta->the_meta();
	if(!empty( $meta )){
		$bgcolor =  isset($meta['webnus_page_options'][0]['background_color'])?$meta['webnus_page_options'][0]['background_color']:null;
		$bgimage =  isset($meta['webnus_page_options'][0]['the_page_bg'])?$meta['webnus_page_options'][0]['the_page_bg']:null;
		$bgpercent =  isset($meta['webnus_page_options'][0]['bg_image_100'])?$meta['webnus_page_options'][0]['bg_image_100']:null;
		$bgrepeat =  isset($meta['webnus_page_options'][0]['bg_image_repeat'])?$meta['webnus_page_options'][0]['bg_image_repeat']:null;
				$out = "";
				$out .= '<style type="text/css" media="screen">body{ ';
				if(!empty($bgcolor)){
					$out .= "background-image:url('');background-color:{$bgcolor};";
				}
				if(!empty($bgimage))
				{
					if($bgrepeat == 1)
						$out .=  " background-image:url('{$bgimage}'); background-repeat:repeat;";
					else if($bgrepeat==2)
						$out .=  " background-image:url('{$bgimage}'); background-repeat:repeat-x;";
					else if($bgrepeat==3)
						$out .=  " background-image:url('{$bgimage}'); background-repeat:repeat-y;";
					else if($bgrepeat==0)
					{
						if($bgpercent)
							$out .=  " background-image:url('{$bgimage}'); background-repeat:no-repeat; background-size:100% auto; ";
						else
							$out .=  " background-image:url('{$bgimage}'); background-repeat:no-repeat; ";
					}
				}
		if($bgpercent == 'yes' && !empty($bgimage)){
			$out .= 'background-size:cover;-webkit-background-size: cover; -moz-background-size: cover;	-o-background-size: cover; background-attachment:fixed;	background-position:center; ';
		}
		$out .= ' } </style>';
		echo $out;
	}
}

function webnus_wphead_action(){

// Header Area
	$webnus_options = webnus_options();
	$webnus_options['webnus_background_image_style'] = isset( $webnus_options['webnus_background_image_style'] ) ? $webnus_options['webnus_background_image_style'] : '';
	$webnus_options['webnus_space_before_head'] = isset( $webnus_options['webnus_space_before_head'] ) ? $webnus_options['webnus_space_before_head'] : '';
	echo $webnus_options['webnus_background_image_style'];
	echo $webnus_options['webnus_space_before_head'];

// Page Background
	global $post;
	if(!is_404() && isset($post))
		webnus_page_background_override(); // referred to up

// Typekit
	$webnus_options['webnus_typekit_id'] = isset( $webnus_options['webnus_typekit_id'] ) ? $webnus_options['webnus_typekit_id'] : '';
	$w_adobe_typekit = ltrim ($webnus_options['webnus_typekit_id']);
    if(isset($w_adobe_typekit ) && !empty($w_adobe_typekit ))
        echo '<script src="//use.typekit.net/'.$w_adobe_typekit.'.js"></script><script>try{Typekit.load();}catch(e){}</script>';
}


/*******************************/
/*		Custom Admin Logo
/******************************/

function webnus_custom_login_logo() {
	$webnus_options = webnus_options();
    $logo = isset($webnus_options['webnus_admin_login_logo']['url'])? $webnus_options['webnus_admin_login_logo']['url'] : '' ;
    if(isset($logo) && !empty($logo))
		echo '<style type="text/css">h1 a { background-image:url('.$logo.') !important; }</style>';
}


/*************************/
/*		Open Graph
**************************/

function my_excerpt($text, $excerpt){
    if ($excerpt) return $excerpt;
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', 55);
    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $words = preg_split("/[\n
	 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
    } else {
            $text = implode(' ', $words);
    }
    return apply_filters('wp_trim_excerpt', $text, $excerpt);
}


function webnus_open_graph_tags() {
	if (is_single()) {
		global $post;
		if(get_the_post_thumbnail($post->ID, 'thumbnail')) {
			$thumbnail_id = get_post_thumbnail_id($post->ID);
			$thumbnail_object = get_post($thumbnail_id);
			$image = $thumbnail_object->guid;
		} else {
			$image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
		}
		$description = my_excerpt( $post->post_content, $post->post_excerpt );
		$description = strip_tags($description);
		$description = str_replace("\"", "'", $description);
		?>
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="<?php echo $image; ?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:description" content="<?php echo $description ?>" />
		<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
		<?php
	}
}


/**************************/
/*		Post View
/**************************/

function webnus_setViews($postID) {
    $count_key = 'webnus_views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
    return $count;
}
function webnus_getViews($postID) {
    $count_key = 'webnus_views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
	}
    return $count;
}


/********************************/
/*   	Custom Functions
/********************************/

// Modal Booking
function webnus_modal_booking($id,$form_id,$title) {
	return '<a class="booking-button inlinelb button" href="#w-book-'.$id.'" target="_self"><span class="media_label">'.__('REGISTER','webnus_framework').'</span></a><div style="display:none"><div class="w-modal modal-book" id="w-book-'.$id.'"><h3 class="modal-title">'.__('Book for ','webnus_framework').$title.'</h3><br>'.do_shortcode('[contact-form-7 id="'.$form_id.'" title="Booking"]').'</div></div>';
}

// Modal Donate
function webnus_modal_donate() {
	GLOBAL $post;
    $webnus_options = webnus_options();
    $webnus_options['webnus_donate_form'] = isset( $webnus_options['webnus_donate_form'] ) ? $webnus_options['webnus_donate_form'] : '';
	return '<a class="donate-button inlinelb" href="#w-donate-'.get_the_ID().'" target="_self"><span class="media_label">'.__('DONATE NOW','webnus_framework').'</span></a><div style="display:none"><div class="w-modal modal-donate" id="w-donate-'.get_the_ID().'"><h3 class="modal-title">'.__('Donate for ','webnus_framework').get_the_title().'</h3><br>'.do_shortcode('[contact-form-7 id="'.$webnus_options['webnus_donate_form'].'" title="Donate"]').'</div></div>';
}

// MIMETYPE fonts
function webnus_custom_font_mimes ( $existing_mimes=array() ) {
	$existing_mimes['woff'] = 'application/x-font-woff';
	$existing_mimes['ttf'] = 'application/x-font-ttf';
	$existing_mimes['eot'] = 'application/vnd.ms-fontobject"';
	$existing_mimes['svg'] = 'image/svg+xml"';
	return $existing_mimes;
}

// Validates a field's length.
if ( ! function_exists( 'webnus_validate_length' ) ) {
	function webnus_validate_length( $fieldValue, $minLength ) {
		return ( strlen( trim( $fieldValue ) ) > $minLength );
	}
}

// Fixes
function webnus_fix_parallax($content){
	$array = array ('<p>[' => '[', ']</p>' => ']', ']<br />' => ']');
	$content = strtr($content, $array);
	return $content;
}

if(function_exists('vc_set_as_theme')){
	add_action('init','webnus_set_vc_as_theme');
	function webnus_set_vc_as_theme(){vc_set_as_theme($notifier = false);}
}
if (!isset($content_width)){$content_width = 940;}
if(false){wp_link_pages(); posts_nav_link(); paginate_links(); the_tags();get_post_format(0);}

?>
<?php
/**
* All functions in this file are necessary for the template. 
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

/**
* Get Option From theme Panel
***********************************************/

function van_get_option( $name , $clean = false ) {
	$van_options = get_option('van_options');

	$result = "";

	if ( isset($van_options[$name]) ) {
		$result  = $van_options[$name];
	}
	if( $clean && $clean === true) {
		$result   = htmlspecialchars_decode($result);
	}

	return !empty($result) ? $result : false;
}

/**
* Custom Favicon
*************************************************/
add_action('wp_head', 'van_favicon');
add_action('admin_head', 'van_favicon');

function van_favicon() {
	$favicon  = van_get_option('favicon');
	$default  = get_template_directory_uri()."/favicon.ico";
	if ( $favicon ) {
		$favicon_val = $favicon;
	} else {
		$favicon_val = $default;
	}
	?>
	<link rel="shortcut icon" href="<?php echo $favicon_val; ?>" >	
	<?php
}
add_action('wp_head', 'van_apple_icons');
/**
*	Appel icons
*********************************************/
function van_apple_icons() {

	if ( van_get_option('iphone_icon') ) {
		echo '<link rel="apple-touch-icon" sizes="57x57" href="' . van_get_option('iphone_icon') . '">';	
	}
	if ( van_get_option('iphone_retina_icon') ) {
		echo '<link rel="apple-touch-icon" sizes="114x114" href="' . van_get_option('iphone_retina_icon') . '">';	
	}
	if ( van_get_option('ipad_icon') ) {
		echo '<link rel="apple-touch-icon" sizes="72x72" href="' . van_get_option('ipad_icon') . '">';	
	}
	if ( van_get_option('ipad_retina_icon') ) {
		echo '<link rel="apple-touch-icon" sizes="144x144" href="' . van_get_option('ipad_retina_icon') . '">';	
	}
}


/**
* Custom gravatar
*************************************************/
add_filter( 'avatar_defaults', 'van_gravatar' );
function van_gravatar( $avatar_defaults ) {
	$gravatar = van_get_option( 'gravatar' );
	if ( $gravatar ) {
		$avatar_defaults[$gravatar] = "Custom Gravatar";
	}
	return $avatar_defaults;
}

/**
* Footer Code
**************************************************/
add_action('wp_footer', 'van_wp_footer'); 
function van_wp_footer() { 
	$footer_code = van_get_option('footer-code',true);
	if( $footer_code ){ 
		echo $footer_code;
	}
}
/**
* Head Code
*****************************************************/
add_action('wp_head', 'van_wp_head');
function van_wp_head() {

	$header_code = van_get_option('header-code',true);

	if( $header_code ){
		echo $header_code, "\n";
	}

	#Meta description

	if ( van_get_option("meta_desc") ) {
		echo '<meta name="description" content="' . van_get_option("meta_desc") . '">' . "\n";
	}

	#Meta keywords

	if ( van_get_option("meta_key") ) {
		echo '<meta name="keywords" content="' . van_get_option("meta_key") . '">' . "\n";
	}


	#Social Metadata

	global $post;

	if( is_single() || is_page() ) {

		$meta_url    	=  get_permalink();
		$meta_title  	=  the_title_attribute( array('echo' => false) );
		$meta_desc   	=  van_get_excerpt_by_id( $post->ID );
		
		if ( van_get_option("twitter_md") ) {

			$twitter_site	= str_replace('@', '',van_get_option("twitter_username"));

			if ( preg_match("|https?://(www\.)?twitter\.com/(#!/)?@?([^/]*)|", get_the_author_meta('twitter', $post->post_author), $matches ) ) {
				$twitter_creator = $matches[3];
			}

			echo '<meta name="twitter:card" value="summary">' . "\n";
			echo '<meta name="twitter:url" value="' .  $meta_url . '">' . "\n";
			echo '<meta name="twitter:title" value="' . $meta_title . '">' . "\n";
			echo '<meta name="twitter:description" value="' . $meta_desc . '">' . "\n";
			echo '<meta name="twitter:site" value="' . $twitter_site . '">' . "\n";
			if( has_post_thumbnail() && '' != get_the_post_thumbnail() ){
				echo '<meta name="twitter:image:src" value="' . van_post_thumbnail("large") . '">' . "\n";
			}
			if( isset( $twitter_creator ) && !empty( $twitter_creator ) ) {
				echo '<meta name="twitter:creator" value="@' . $twitter_creator . '">' . "\n";
			}
		}

		if ( van_get_option("facebook_md") ) {

			echo '<meta property="og:type" content="article">' . "\n";
			echo '<meta property="og:title" content="' . $meta_title . '">' . "\n";
			echo '<meta property="og:description" content="' . $meta_desc . '">' . "\n";
			echo '<meta property="og:url" content="' . $meta_url . '">' . "\n";
			echo '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '">' . "\n";

			if( has_post_thumbnail() && '' != get_the_post_thumbnail() ){
				echo '<meta property="og:image" content="' . van_post_thumbnail("large") . '">' . "\n";
			}
		}
	
	}

}

/**
*	Get Excerpt by id
********************************************************/
function van_get_excerpt_by_id( $post_id ){

	$the_post 		= get_post($post_id); 
	$the_excerpt 	= $the_post->post_content; 
	$excerpt_length 	= 31;
	$the_excerpt 	= strip_tags(strip_shortcodes($the_excerpt));
	$words 		= explode(' ', $the_excerpt, $excerpt_length + 1);
	if( count($words) > $excerpt_length ) {
		array_pop($words);
		array_push($words, '...');
		$the_excerpt = implode(' ', $words);
	}
	$the_excerpt = preg_replace( "/\r|\n/", "", $the_excerpt );
	return esc_attr($the_excerpt);
}

/**
*	Respnsive
******************************************/

function van_responsive_class( $classes ) {
	$classes[] = 'responsive';
	return $classes;
}
/**
* Theme Logo
******************************************************/

function van_logo() {
	$van_logo         = van_get_option("logo-img");
	$logo_retina     = van_get_option("retina_logo");
	$default           = VAN_IMG . "/logo.png";
	$retina_default= VAN_IMG . "/logo@2x.png";
	$retina            = false;

	if ( van_get_option("logo-setting") == "logo" ) : 

		if ( $van_logo ) {
			$logo = $van_logo;
			if ( $logo_retina ) { $retina = $logo_retina; }
		} else {
			$logo = $default;	
			$retina = $retina_default;
		}
	?>
		<div id="logo">
			<h1>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
					<img src="<?php echo $logo ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" <?php if($retina){ echo 'class="retina" data-retina="' . $retina . '"'; }?> >
				</a>
			</h1>
		</div><!-- #logo -->

	<?php else: ?>

		<div id="logo">
			<h1>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
					<?php bloginfo('name'); ?>
				</a>
			</h1>
		</div><!-- #logo -->

	<?php endif; ?>

	<?php if ( van_get_option("sitedesc") ): ?>
		<div id="site-description">
			<p>
				<?php bloginfo( 'description' ); ?>
			</p>
		</div><!-- #site-description -->
	<?php endif ?>

<?php
}

/**
* Wp Title
*********************************************************/

add_filter( 'wp_title', 'van_wp_title', 10, 2 );

function van_wp_title( $title, $sep ) {

	global $page, $paged;

	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = $title . $sep . $site_description;
	}

	if ( $paged >= 2 || $page >= 2 )  {
		$title = $title . $sep . sprintf( __( 'Page %s', 'van' ), max( $paged, $page ) );
	}

	return $title;
}
/**
*	Add Custom Column in Posts admin page
***********************************************/

add_filter('manage_posts_columns', 'van_set_columns_names');  
function van_set_columns_names($defaults) {  
	$defaults['featured_image'] = __("Featured Image","van");  
	$defaults['views'] = __("Views","van");  
	$defaults['votes'] = __("Likes","van");  
	return $defaults;  
}  

add_action('manage_posts_custom_column', 'van_set_columns_contents', 10, 2);  
function van_set_columns_contents($column_name) {  

	global $post;

	if ( $column_name == 'featured_image' ) {  

		$featured_image = van_post_thumbnail(array(50,50));  

		if ( $featured_image )   
			echo '<img src="' . $featured_image . '"  width="50" height="50" >';  
		
	}elseif( $column_name == 'views' ){

		 echo van_post_view();

	}elseif( $column_name == 'votes' ){

		$vote_count     = ( get_post_meta( $post->ID,'van_votes_count',true ) ) ? get_post_meta( $post->ID,'van_votes_count',true ) : "0";
		 echo intval( $vote_count );

	}
}


/*
*    Login Form Ajax Verification
********************************************************/

add_action('wp_ajax_nopriv_van_login_verification', 'van_login_verification');
add_action('wp_ajax_van_login_verification', 'van_login_verification');

function van_login_verification(){

	$data_info = array(
				"user_login"       => $_POST["username"],
				"user_password" => $_POST["password"],
				"remember"        => $_POST["remember"]
			);
	
	$user_info = wp_signon($data_info);
	if ( is_wp_error($user_info) ) {
		echo $user_info->get_error_message();
		exit;	
	}else{
		echo "success";
		exit;
	}
}

/**
* Contact us Form
********************************************************/
add_action('wp_ajax_nopriv_van_contact_us', 'van_contact_us');
add_action('wp_ajax_van_contact_us', 'van_contact_us');
function van_contact_us(){

	ob_start();

	$msg_name   = ( isset( $_POST["msg_name"] ) ) ? htmlentities($_POST["msg_name"]) : "";
	$msg_email   = ( isset( $_POST["msg_email"] ) ) ? htmlentities($_POST["msg_email"]) : "";
	$msg_text    = ( isset( $_POST["msg_text"] ) ) ?  htmlentities($_POST["msg_text"]) : "";
	$msg_human  = ( isset( $_POST["msg_human"] ) ) ? htmlentities($_POST["msg_human"]) : "";
	$human1        = ( isset( $_POST["human1"] ) ) ? htmlentities($_POST["human1"]) : 0;
	$human2       = ( isset( $_POST["human2"] ) ) ? htmlentities($_POST["human2"]) : 0;
	$human         = $human1 + $human2;
	$error          = false;		
	if ( $msg_name  == "" || strlen($msg_name) < 2 ) {
		$error = true;
	}
	if ( $msg_email == ""  || !filter_var($msg_email, FILTER_VALIDATE_EMAIL) ) {
		$error = true;
	}
	if ( $msg_text  == "" || strlen($msg_text) < 4 ) {
		$error = true;
	}
	if ( $msg_human == ""  || $msg_human != $human ) {
		$error = true;
	}
	if ( !$error ) {
		if ( isset($_COOKIE['vanContact']) ){
			echo '<div class="error-msg msg-boxes">' . __("Spam messages not allowed here.", "van") . '</div>';	
			exit;
		}
		$to = ( van_get_option("contact_email") ) ? van_get_option("contact_email") : get_option('admin_email');
  		$subject = $msg_name . __(" Sent a message from ", "van") . get_bloginfo('name');
  		$headers = 'From: ' . $msg_email . "\r\n" .'Reply-To: ' . $msg_email . "\r\n";
  		$send = wp_mail($to, $subject, $msg_text, $headers);
  		if ( $send ){
			echo '<div class="success-msg msg-boxes">' .  __("Thanks! Your message has been sent.","van") . '</div>';
			@setcookie("vanContact", $msg_name, time()+3600);
		}else{
			echo '<div class="error-msg msg-boxes">' . __("Message was not sent. Try Again.", "van") . '</div>';
		}
		exit;
	}else{
		echo '<div class="error-msg msg-boxes">' . __("Please supply all information.", "van") .'</div>';
		exit;
	}
	ob_end_flush();
}


/**
* Sidebar Layout 
*********************************************************/
function van_sidebar_layout(){

	global $post;
	if(van_get_option("sidebar") == "left"){
		$sidebar_class = "left-sidebar";
	}else{
		$sidebar_class = "right-sidebar";
	}
	if( is_single() ){
		$meta 	      = get_post_custom($post->ID);
		$sidebar_layout = isset( $meta["van_sidebar"][0] ) ? $meta["van_sidebar"][0] : false;
		if($sidebar_layout and $sidebar_layout !== "default"){
			if($sidebar_layout == "left"){
				$sidebar_class = "left-sidebar";
			}elseif ($sidebar_layout == "full") {
				$sidebar_class = "full-width";
			}else{
				$sidebar_class = "right-sidebar";
			}
		}
	}elseif ( is_page() ) {
		$meta 	       = get_post_custom($post->ID);
		$sidebar_layout = isset( $meta["van_pagesidebar"][0] ) ? $meta["van_pagesidebar"][0] : false;
		if($sidebar_layout and $sidebar_layout !== "default"){
			if($sidebar_layout == "left"){
				$sidebar_class = "left-sidebar";
			}elseif ($sidebar_layout == "full") {
				$sidebar_class = "full-width";
			}else{
				$sidebar_class = "right-sidebar";
			}
		}
	}
	return $sidebar_class;
}

/**
* Page layout
***********************************************************/
function van_page_type(){

	$classes = array();

	if( !is_singular() ){
		if( "two_col_sid"  == van_get_option('post_layout') ){
			$classes['container'] = "columns";
			$classes['type'] = "two_col_sid";
			$classes['sidebar'] = true;
		}elseif ( "two_col_full"  == van_get_option('post_layout') ) {
			$classes['container'] = "columns";
			$classes['type'] = "two_col_full";
			$classes['sidebar'] = false;
		}elseif ( "three_col_full"  == van_get_option('post_layout') ) {
			$classes['container'] = "columns";
			$classes['type'] = "three_col_full two_col_sid";
			$classes['sidebar'] = false;
		}else{
			$classes['container'] = "container";
			$classes['type'] = "one_col_sid";
			$classes['sidebar'] = true;
		}
	}else{
		$classes['container'] = "";
		$classes['type']        = "";
		$classes['sidebar']    = true;
	}

	return $classes;
}

/**
*  Remove space from text
*********************************************************/
function van_item_id( $item ){
	$find = array(' ','_');
	$rep = array('-','-');
	return str_replace($find, $rep, strtolower($item));
}

/**
* Ajax Load More
*************************************************************/

add_action('wp_ajax_nopriv_van_ajax_load_more', 'van_ajax_load_more');
add_action('wp_ajax_van_ajax_load_more', 'van_ajax_load_more');
function van_ajax_load_more() {

	$posts_nonce = $_POST['postsnonce'];
	$pageNum      = $_POST['Pagenum'];

	if ( !wp_verify_nonce( $posts_nonce, "vanonce" ) ){ die; }

	$posts_cat  = "";

	if ( !empty( $_POST["postsCat"] ) ){
		$posts_cat = "cat=" . $_POST["postsCat"] . "&";
	}

	query_posts( $posts_cat . "post_status=publish&showposts=" . get_option('posts_per_page') . "&paged=" . $pageNum);
	
	if ( have_posts() ){

		while ( have_posts() ){

			the_post(); 

			get_template_part( 'partials/content', get_post_format() );
		}

	}

	exit;

}
function van_ajax_pagination() {
	?>
	<div id="ajax-load" class="content">
		<a href="#" class="load-more" ><?php _e("Load More Posts","van"); ?></a>
	</div>
	<?php
}

/**
* Simple Pagination
***********************************************/
function van_simple_pagination() {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="pagination">
			<div class="nav-previous"><?php next_posts_link( __( '&larr; Older posts', 'van' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'van' ) ); ?></div>
			<div class="clear"></div>
		</nav><!-- #pagination -->
	<?php endif;
}
/**
* Get Pagination
************************************************/
function van_get_pagination() {

	global $wp_query;

	if ( van_get_option("pagination") && van_get_option("pagination") == "ajax" ) {
		if( have_posts() ) { van_ajax_pagination(); }
	} else { 
		van_simple_pagination();
	}
}

/**
*           Voting System
***********************************************/
add_action( 'wp_footer', 'van_js_vars' );
function van_js_vars() {

	global $wp_query, $tmp_max, $tmp_cat;

	$max    = $wp_query->max_num_pages;
	$paged = ( get_query_var('paged') > 1) ? get_query_var('paged') : 1;

	$category = "";

	if ( is_category() ) {
		$categories = get_the_category();
		$category    = $categories[0]->cat_ID;
	}

	if ( isset( $tmp_max ) ){
		$max    = $tmp_max;
	}

	if ( isset( $tmp_cat ) ){
		$category  = $tmp_cat;  
	}

	?>
	<script type='text/javascript'>/* <![CDATA[ */var van = {"AjaxUrl":"<?php echo admin_url('admin-ajax.php') ;?>","VotedTitle":"<?php esc_attr_e('You are already like this post','van') ;?>","Nonce":"<?php echo wp_create_nonce('vanonce'); ?>","PageNum":"<?php echo $paged ;?>","MaxPages":"<?php echo $max; ?>","LoadText":"<?php _e('Load More Posts','van'); ?>","LoadingText":"<?php _e('Loading...','van'); ?>","NoPtsText":"<?php _e('No More Posts to load','van'); ?>", "postsCat":"<?php echo $category; ?>"};/* ]]> */</script>
	<?php
}

add_action('wp_ajax_nopriv_van_post_vote', 'van_post_vote');
add_action('wp_ajax_van_post_vote', 'van_post_vote');
function van_post_vote() {

	ob_start();

	if ( !isset( $_POST ) || empty($_POST) || !wp_verify_nonce( $_POST['nonce'], "vanonce" ) ) {
		die;
	}

	$post_id      = (int)$_POST['post_id'];
	$cookie_name = "vanVotes_" . $post_id;

	if (  van_check_voter( $post_id ) ) {

		echo "voted";

	} else {

		$votes_count = van_votes_count( $post_id );
		$cookie_time = 2592000; // 30 days
		$votes_count++;
		update_post_meta( $post_id, "van_votes_count", $votes_count );

		@setcookie( $cookie_name, $post_id, time()+$cookie_time, '/' );

		echo $votes_count;
		
	}
	exit;

	ob_end_flush();
}

// get votes
function van_votes_count( $post_id ){

	$vote_count     = get_post_meta( $post_id,'van_votes_count',true );

	if ( $vote_count ) {
		return intval( $vote_count );
	}
	else {
		return 0;
	}
}

// Check if user alrledy vote to post
function van_check_voter( $post_id ){

	$cookie_name = "vanVotes_" . $post_id;

	if (  isset( $_COOKIE[$cookie_name] ) && $_COOKIE[$cookie_name] == $post_id ) {
		
		return true;

	}
	return false;
}

/**
*     Post view 
**********************************************************/
function van_post_view() {
	global $post;

	$views_count = get_post_meta($post->ID, "van_post_view_count", true);

	if ( get_post_meta($post->ID, "van_viewers_ips") ) {
		delete_post_meta($post->ID ,"van_viewers_ips");
	}

	if ( empty( $views_count ) ) {
		update_post_meta($post->ID, "van_post_view_count", 0);
		$views_count = 0;
	}
	
	if (  is_singular() ) {

		$return = true;

	}
	if( isset( $return ) && $return === true ){
		$views_count++;
		update_post_meta($post->ID, "van_post_view_count",$views_count);
	}

	return intval( $views_count );
}
/**
* Mobile Menu
*************************************************************/
function van_menu_select( $args = array() ) {
	@extract($args);							
	if ( ( $menu_locations = get_nav_menu_locations() ) && isset( $menu_locations[ $menu_name ] ) ) :	
		$menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );						
		$menu_items = wp_get_nav_menu_items( $menu->term_id );
		?>
		<select id='<?php echo $id; ?>'>
		<option selected="selected"><?php  _e('Go to...', 'van');?></option>
		<?php
		foreach ( (array) $menu_items as $key => $menu_item ) :
		    $title = $menu_item->title;
		    if ( $menu_item->menu_item_parent ) {
				$title = ' - ' . $title;
		    }
		 ?>
		 <option value='<?php echo $menu_item->url; ?>'><?php echo $title; ?></option>
		<?php endforeach;?>
		</select>
		<?php
	endif;						
}

/**
* Menus fallback_cb
**************************************************************/
function van_nav_alert(){
	echo '<div class="nav-alert">'.__( 'You can use WP menu builder to build menus' , 'van' ).'</div>';
}

/**
* Change excerpt length
***********************************************************/
add_filter( 'excerpt_length', 'van_excerpt_length', 999 );
function van_excerpt_length(){

	if ( van_get_option("excerpt_length") && is_numeric( van_get_option("excerpt_length") ) ) {
		return van_get_option("excerpt_length");
	}

	return 45;
}

/**
* Change excerpt more
***********************************************************/

add_filter( 'wp_trim_excerpt', 'van_excerpt_read_more' );
function van_excerpt_read_more( $text ) {
	if ( strpos( $text, '[&hellip;]') ) {
		$excerpt = str_replace( '[&hellip;]', ' <a class="read-more" href="'. get_permalink() . '">' . __( 'Continue reading &rarr;', 'van' ) . '</a>', $text );
	} else {
		$excerpt = $text . ' <a class="read-more" href="'. get_permalink() . '">' . __( 'Continue reading &rarr;', 'van' ) . '</a>';
	}
	return $excerpt;
}

add_filter('excerpt_more', 'van_excerpt_more');
function van_excerpt_more( $more ) {
	return ' ';
}

/**
*	Empty Paragraph fix
**********************************************/

add_filter('the_content', 'van_shortcode_empty_paragraph_fix');
function van_shortcode_empty_paragraph_fix( $content ) {   
        $array = array(
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']',
            '<br />' => '<br>',
            '<p></p>' => ''
        );

        $content = strtr($content, $array);

        $array_two = array('[dropcap'=> '<p>[dropcap');

        $content = strtr($content, $array_two);

        return $content;
}


			
			
/**
*   Articles Banners
*******************************************************/
function van_above_post_ads(){

	$output = "";

	if ( van_get_option("ab_art_banner") ){
		 $banner_target = ( van_get_option("ab_art_banner_tab") ) ? "target='_blank'" : "";
		$output .= '<div class="post-banner above-post-banner">';
			if ( van_get_option("ab_art_banner_type") == "image" && van_get_option("ab_art_banner_img") ) {
				$output .= '<a href="' . esc_url( van_get_option("ab_art_banner_link") ) . '" ' . $banner_target . '><img src="' .  van_get_option("ab_art_banner_img") . '" alt="Above Post Banner"></a>';
			}elseif( van_get_option("ab_art_banner_type") == "ads_code" && van_get_option("ab_art_banner_ads",true) ){
				$output .= van_get_option("ab_art_banner_ads",true);
			}
		$output .= '</div><!-- .post-banner -->';
	}

	return $output;
}

function van_below_post_ads(){

	$output = "";

	if ( van_get_option("bl_art_banner") ){
		 $banner_target = ( van_get_option("bl_art_banner_tab") ) ? "target='_blank'" : "";
		$output .=  '<div class="post-banner below-post-banner">';
			if ( van_get_option("bl_art_banner_type") == "image" && van_get_option("bl_art_banner_img") ) {
				$output .=  '<a href="' . esc_url( van_get_option("bl_art_banner_link") ) . '" ' . $banner_target . '><img src="' .  van_get_option("bl_art_banner_img") . '" alt="Below Post Banner"></a>';
			}elseif( van_get_option("bl_art_banner_type") == "ads_code" && van_get_option("bl_art_banner_ads",true) ){
				$output .=  van_get_option("bl_art_banner_ads",true);
			}
		$output .=  '</div><!-- .post-banner -->';
	}

	return $output;
}


add_filter( 'the_content', 'van_above_content', 20 );
function van_above_content( $content ) {

	if ( is_single() ){

		$banner = get_post_meta(get_the_ID(), 'van_hideabovebanner', true);
		if( !$banner ) {$content = van_above_post_ads() . $content;}
	 
	}   
	return $content;
}

add_filter( 'the_content', 'van_below_content', 20 );
function van_below_content( $content ) {

	if ( is_single() ){

		$banner = get_post_meta(get_the_ID(), 'van_hideabelowbanner', true);
		if( !$banner ) { $content =  $content .  van_below_post_ads();}

   	}

   	return $content;
}
/**
* 	Main Banners
*******************************************************/
function van_main_banners( $type ){
	if($type == "header"){
		    $banner           = van_get_option("b_head_banner");
		    $banner_type   = van_get_option("b_head_banner_type");
		    $banner_img     = van_get_option("b_head_banner_img");
		    $banner_target = ( van_get_option("b_head_banner_tab") ) ? "target='_blank'" : "";
		    $banner_link     = van_get_option("b_head_banner_link");
		    $banner_code    = van_get_option("b_head_banner_ads",true);
		    $banner_class    = "above-art-ads";
	}elseif($type == "footer"){
		    $banner           = van_get_option("a_foot_banner");
		    $banner_type   = van_get_option("a_foot_banner_type");
		    $banner_img     = van_get_option("a_foot_banner_img");
		    $banner_target = ( van_get_option("a_foot_banner_tab") ) ? "target='_blank'" : "";
		    $banner_link     = van_get_option("a_foot_banner_link");
		    $banner_code    = van_get_option("bl_art_banner_ads",true);
		    $banner_class    = "below-art-ads";
	}
	if ( $banner ){
		echo '<div class="main-banner">';
			if ( $banner_type == "image" && $banner_img) {
				echo '<a href="' . esc_url( $banner_link ) . '" ' . $banner_target . '><img src="' . $banner_img . '" alt="main banner"></a>';
			}elseif( $banner_type == "ads_code" && $banner_code){
				echo $banner_code;
			}
		echo '</div><!-- .main-banner -->';
	}
}

/**
* 	Rel category validate
*******************************************************/
add_filter( 'the_category', 'van_rel_validate' );
function van_rel_validate( $text ) {
	$string = 'rel="tag"';
	$replace = array('rel="category tag"', 'rel="category"');
	$text = str_replace( $replace, $string, $text );

	return $text;
}

/*
*  Check if sidebar active
*******************************************/
function van_is_active_sidebar($value=''){
	ob_start();
	dynamic_sidebar($value);
	$sidebar = ob_get_clean();
	return $sidebar;
}

/**
* Wrap Widget Content
************************************************/
function van_wrap_widget_content( $title ) { 

	if ( empty( $title ) ) {
		
		$output = '<div class="content widget-container">';

	}else{

		$output = '<h3 class="widget-title">' . $title . '</h3><div class="content widget-container">';

	}
	return $output;

}
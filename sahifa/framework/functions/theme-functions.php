<?php

/*-----------------------------------------------------------------------------------*/
# Get Theme Options
/*-----------------------------------------------------------------------------------*/
function tie_get_option( $name ) {
	$get_options = get_option( 'tie_options' );

	if( !empty( $get_options[$name] ))
		 return $get_options[$name];

	return false ;
}

/*-----------------------------------------------------------------------------------*/
# Setup Theme
/*-----------------------------------------------------------------------------------*/
add_action( 'after_setup_theme', 'tie_setup' );
function tie_setup() {

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'post-thumbnails' );

	add_filter( 'enable_post_format_ui', '__return_false' );

	load_theme_textdomain( 'tie', get_template_directory() . '/languages' );

	register_nav_menus( array(
		'top-menu'	=> __( 'Top Menu Navigation', 'tie' ),
		'primary'	=> __( 'Primary Navigation', 'tie' )
	) );
}


/*-----------------------------------------------------------------------------------*/
# Post Thumbnails
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_image_size' ) ){
	add_image_size( 'tie-small'		,110,  75,  true );
	add_image_size( 'tie-medium'	,310,  165, true );
	add_image_size( 'tie-large'		,310,  205, true );
	add_image_size( 'slider'		  ,660,  330, true );
	add_image_size( 'big-slider'	,1050, 525, true );
}


/*-----------------------------------------------------------------------------------*/
# Get score
/*-----------------------------------------------------------------------------------*/
function tie_get_score( $post_id = false , $size = 'small'){
	if(function_exists('taqyeem_get_score')) {
		taqyeem_get_score( $post_id , $size );
	}
}


/*-----------------------------------------------------------------------------------*/
# Custom Dashboard login page logo
/*-----------------------------------------------------------------------------------*/
function tie_login_logo(){
	if( tie_get_option('dashboard_logo') )
    echo '<style  type="text/css"> .login h1 a {  background-image:url('.tie_get_option('dashboard_logo').')  !important; background-size: 274px 63px; width: 326px; height: 67px; } </style>';
}
add_action('login_head',  'tie_login_logo');

function tie_login_logo_url() {
   	 return tie_get_option('dashboard_logo_url');
}
if( tie_get_option('dashboard_logo_url') )
add_filter( 'login_headerurl', 'tie_login_logo_url' );


/*-----------------------------------------------------------------------------------*/
# Custom Gravatar
/*-----------------------------------------------------------------------------------*/
function tie_custom_gravatar ($avatar) {
	$tie_gravatar = tie_get_option( 'gravatar' );
	if($tie_gravatar){
		$custom_avatar = tie_get_option( 'gravatar' );
		$avatar[$custom_avatar] = "Custom Gravatar";
	}
	return $avatar;
}
add_filter( 'avatar_defaults', 'tie_custom_gravatar' );


/*-----------------------------------------------------------------------------------*/
# Custom Favicon
/*-----------------------------------------------------------------------------------*/
function tie_favicon() {
	$default_favicon = get_template_directory_uri()."/favicon.ico";
	$custom_favicon = tie_get_option('favicon');
	$favicon = (empty($custom_favicon)) ? $default_favicon : $custom_favicon;
	echo '<link rel="shortcut icon" href="'.$favicon.'" title="Favicon" />';
}
add_action('wp_head', 'tie_favicon');


/*-----------------------------------------------------------------------------------*/
# Exclude pages From Search
/*-----------------------------------------------------------------------------------*/
function tie_search_filter($query) {

	if( is_search() && $query->is_main_query() ){
		if ( tie_get_option( 'search_exclude_pages' ) && !is_admin() ){
			$post_types = get_post_types(array( 'public' => true, 'exclude_from_search' => false ));
			unset($post_types['page']);
			$query->set('post_type', $post_types );
		}
		if ( tie_get_option( 'search_cats' ) && !is_admin() )
			$query->set( 'cat', tie_get_option( 'search_cats' ));
	}
	return $query;
}
add_filter('pre_get_posts','tie_search_filter');


/*-----------------------------------------------------------------------------------*/
# Random article
/*-----------------------------------------------------------------------------------*/
add_action('init', 'tie_random_post');
function tie_random_post(){
	if ( isset($_GET['tierand']) ){

		$args = array(
			'posts_per_page'		 => 1,
			'orderby'				 => 'rand',
			'no_found_rows'          => true,
			'ignore_sticky_posts'	 => true
		);
$random = new WP_Query( $args );
if ($random->have_posts()) {
	while ($random->have_posts()) : $random->the_post();
		$URL = get_permalink();
	endwhile;
	wp_reset_query(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Refresh" content="0; url=<?php echo $URL; ?>">
</head>
<body>
</body>
</html>
<?php }
		die;
	}
}


/*-----------------------------------------------------------------------------------*/
#Author Box
/*-----------------------------------------------------------------------------------*/
function tie_author_box($avatar = true, $social = true, $name = false , $user_id = false  ){
	if( $avatar ) :
	?>
<div class="author-bio">
	<div class="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' , $user_id ), 90 ); ?>
	</div><!-- #author-avatar -->
	<?php endif; ?>
		<div class="author-description">
			<?php if( !empty( $name ) ): ?>
			<h3><a href="<?php echo get_author_posts_url( $user_id ); ?>"><?php echo $name ?> </a></h3>
			<?php endif; ?>
			<?php the_author_meta( 'description' , $user_id ); ?>
		</div><!-- #author-description -->
	<?php  if( $social ) :	?>
		<div class="author-social flat-social">
			<?php if ( get_the_author_meta( 'url' , $user_id ) ) : ?>
			<a class="social-site" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'url' , $user_id ) ); ?>"><i class="fa fa-home"></i></a>
			<?php endif ?>
			<?php if ( get_the_author_meta( 'facebook' , $user_id ) ) : ?>
			<a class="social-facebook" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'facebook' , $user_id ) ); ?>"><i class="fa fa-facebook"></i></a>
			<?php endif ?>
			<?php if ( get_the_author_meta( 'twitter' , $user_id  ) ) : ?>
			<a class="social-twitter" target="_blank" href="http://twitter.com/<?php the_author_meta( 'twitter' , $user_id ); ?>"><i class="fa fa-twitter"></i><span> @<?php the_author_meta( 'twitter' , $user_id ); ?></span></a>
			<?php endif ?>
			<?php if ( get_the_author_meta( 'google' , $user_id ) ) : ?>
			<a class="social-google-plus" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'google' , $user_id ) ); ?>"><i class="fa fa-google-plus"></i></a>
			<?php endif ?>
			<?php if ( get_the_author_meta( 'linkedin' , $user_id ) ) : ?>
			<a class="social-linkedin" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'linkedin' , $user_id ) ); ?>"><i class="fa fa-linkedin"></i></a>
			<?php endif ?>
			<?php if ( get_the_author_meta( 'flickr' , $user_id ) ) : ?>
			<a class="social-flickr" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'flickr' , $user_id ) ); ?>"><i class="fa fa-flickr"></i></a>
			<?php endif ?>
			<?php if ( get_the_author_meta( 'youtube' , $user_id ) ) : ?>
			<a class="social-youtube" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'youtube' , $user_id ) ); ?>"><i class="fa fa-youtube"></i></a>
			<?php endif ?>
			<?php if ( get_the_author_meta( 'pinterest' , $user_id ) ) : ?>
			<a class="social-pinterest" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'pinterest' , $user_id ) ); ?>"><i class="fa fa-pinterest"></i></a>
			<?php endif ?>
			<?php if ( get_the_author_meta( 'behance' , $user_id ) ) : ?>
			<a class="social-behance" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'behance' , $user_id ) ); ?>"><i class="fa fa-behance"></i></a>
			<?php endif ?>
			<?php if ( get_the_author_meta( 'instagram' , $user_id ) ) : ?>
			<a class="social-instagram" target="_blank" href="<?php echo esc_url( get_the_author_meta( 'instagram' , $user_id ) ); ?>"><i class="fa fa-instagram"></i></a>
			<?php endif ?>
		</div>
	<?php endif; ?>
	<div class="clear"></div>
</div>
	<?php
}

/*-----------------------------------------------------------------------------------*/
# Social
/*-----------------------------------------------------------------------------------*/
function tie_get_social( $newtab = true, $colored = true, $tooltip='ttip' ){
	$social = tie_get_option('social');

	if( !empty( $social ) && is_array( $social ) ){
		extract($social);
	}

	if ( !empty( $newtab ) ) $newtab = "target=\"_blank\"";
	else $newtab = '';

	if ( !empty( $colored ) ) $colored = " social-colored";
	else $colored = '';

		?>
		<div class="social-icons<?php echo $colored ?>">
		<?php
		// RSS
		if ( tie_get_option('rss_icon') ){
		if ( tie_get_option('rss_url') != '' && tie_get_option('rss_url') != ' ' ) $rss = tie_get_option('rss_url') ;
		else $rss = get_bloginfo('rss2_url');
			?><a class="<?php echo $tooltip; ?>" title="Rss" href="<?php echo esc_url( $rss ) ; ?>" <?php echo $newtab; ?>><i class="fa fa-rss"></i></a><?php
		}
		// Google+
		if ( !empty($google_plus) && $google_plus != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Google+" href="<?php echo esc_url( $google_plus ); ?>" <?php echo $newtab; ?>><i class="fa fa-google-plus"></i></a><?php
		}
		// Facebook
		if ( !empty($facebook) && $facebook != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Facebook" href="<?php echo esc_url( $facebook ); ?>" <?php echo $newtab; ?>><i class="fa fa-facebook"></i></a><?php
		}
		// Twitter
		if ( !empty($twitter) && $twitter != ' ') {
			?><a class="<?php echo $tooltip; ?>" title="Twitter" href="<?php echo esc_url( $twitter ); ?>" <?php echo $newtab; ?>><i class="fa fa-twitter"></i></a><?php
		}
		// Pinterest
		if ( !empty($Pinterest) && $Pinterest != ' ') {
			?><a class="<?php echo $tooltip; ?>" title="Pinterest" href="<?php echo esc_url( $Pinterest ); ?>" <?php echo $newtab; ?>><i class="fa fa-pinterest"></i></a><?php
		}
		// dribbble
		if ( !empty($dribbble) && $dribbble != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Dribbble" href="<?php echo esc_url( $dribbble ); ?>" <?php echo $newtab; ?>><i class="fa fa-dribbble"></i></a><?php
		}
		// LinkedIN
		if ( !empty($linkedin) && $linkedin != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="LinkedIn" href="<?php echo esc_url( $linkedin ); ?>" <?php echo $newtab; ?>><i class="fa fa-linkedin"></i></a><?php
		}
		// evernote
		if ( !empty($evernote) && $evernote != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Evernote" href="<?php echo esc_url( $evernote ); ?>" <?php echo $newtab; ?>><i class="tieicon-evernote"></i></a><?php
		}
		// Flickr
		if ( !empty($flickr) && $flickr != ' ') {
			?><a class="<?php echo $tooltip; ?>" title="Flickr" href="<?php echo esc_url( $flickr ); ?>" <?php echo $newtab; ?>><i class="tieicon-flickr"></i></a><?php
		}
		// Picasa
		if ( !empty($picasa) && $picasa != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Picasa" href="<?php echo esc_url( $picasa ); ?>" <?php echo $newtab; ?>><i class="tieicon-picasa"></i></a><?php
		}
		// YouTube
		if ( !empty($youtube) && $youtube != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Youtube" href="<?php echo esc_url( $youtube ); ?>" <?php echo $newtab; ?>><i class="fa fa-youtube"></i></a><?php
		}
		// Skype
		if ( !empty($skype) && $skype != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Skype" href="<?php echo esc_url( $skype ); ?>" <?php echo $newtab; ?>><i class="fa fa-skype"></i></a><?php
		}
		// Digg
		if ( !empty($digg) && $digg != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Digg" href="<?php echo esc_url( $digg ); ?>" <?php echo $newtab; ?>><i class="fa fa-digg"></i></a><?php
		}
		// Reddit
		if ( !empty($reddit) && $reddit != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Reddit" href="<?php echo esc_url( $reddit ); ?>" <?php echo $newtab; ?>><i class="fa fa-reddit"></i></a><?php
		}
		// Delicious
		if ( !empty($delicious) && $delicious != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Delicious" href="<?php echo esc_url( $delicious ); ?>" <?php echo $newtab; ?>><i class="fa fa-delicious"></i></a><?php
		}
		// stumbleuponUpon
		if ( !empty($stumbleupon) && $stumbleupon != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="StumbleUpon" href="<?php echo esc_url( $stumbleupon ); ?>" <?php echo $newtab; ?>><i class="fa fa-stumbleupon"></i></a><?php
		}
		// Tumblr
		if ( !empty($tumblr) && $tumblr != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Tumblr" href="<?php echo esc_url( $tumblr ); ?>" <?php echo $newtab; ?>><i class="fa fa-tumblr"></i></a><?php
		}
		// Vimeo
		if ( !empty($vimeo) && $vimeo != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Vimeo" href="<?php echo esc_url( $vimeo ); ?>" <?php echo $newtab; ?>><i class="tieicon-vimeo"></i></a><?php
		}
		// Blogger
		if ( !empty($blogger) && $blogger != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Blogger" href="<?php echo esc_url( $blogger ); ?>" <?php echo $newtab; ?>><i class="tieicon-blogger"></i></a><?php
		}
		// Wordpress
		if ( !empty($wordpress) && $wordpress != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="WordPress" href="<?php echo esc_url( $wordpress ); ?>" <?php echo $newtab; ?>><i class="fa fa-wordpress"></i></a><?php
		}
		// Yelp
		if ( !empty($yelp) && $yelp != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Yelp" href="<?php echo esc_url( $yelp ); ?>" <?php echo $newtab; ?>><i class="fa fa-yelp"></i></a><?php
		}
		// Last.fm
		if ( !empty($lastfm) && $lastfm != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Last.fm" href="<?php echo esc_url( $lastfm ); ?>" <?php echo $newtab; ?>><i class="fa fa-lastfm"></i></a><?php
		}
		// grooveshark
		if ( !empty($grooveshark) && $grooveshark != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Grooveshark" href="<?php echo esc_url( $grooveshark ); ?>" <?php echo $newtab; ?>><i class="tieicon-grooveshark"></i></a><?php
		}
		// sharethis
		if ( !empty($sharethis) && $sharethis != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="ShareThis" href="<?php echo esc_url( $sharethis ); ?>" <?php echo $newtab; ?>><i class="fa fa-share-alt"></i></a><?php
		}
		// dropbox
		if ( !empty($dropbox) && $dropbox != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Dropbox" href="<?php echo esc_url( $dropbox ); ?>" <?php echo $newtab; ?>><i class="fa fa-dropbox"></i></a><?php
		}
		// xing.me
		if ( !empty($xing) && $xing != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Xing" href="<?php echo esc_url( $xing ); ?>" <?php echo $newtab; ?>><i class="fa fa-xing"></i></a><?php
		}
		// DeviantArt
		if ( !empty($deviantart) && $deviantart != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="DeviantArt" href="<?php echo esc_url( $deviantart ); ?>" <?php echo $newtab; ?>><i class="tieicon-deviantart"></i></a><?php
		}
		// Apple
		if ( !empty($apple) && $apple != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Apple" href="<?php echo esc_url( $apple ); ?>" <?php echo $newtab; ?>><i class="fa fa-apple"></i></a><?php
		}
		// foursquare
		if ( !empty($foursquare) && $foursquare != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Foursquare" href="<?php echo esc_url( $foursquare ); ?>" <?php echo $newtab; ?>><i class="fa fa-foursquare"></i></a><?php
		}
		// github
		if ( !empty($github) && $github != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Github" href="<?php echo esc_url( $github ); ?>" <?php echo $newtab; ?>><i class="fa fa-github"></i></a><?php
		}
		// soundcloud
		if ( !empty($soundcloud) && $soundcloud != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="SoundCloud" href="<?php echo esc_url( $soundcloud ); ?>" <?php echo $newtab; ?>><i class="fa fa-soundcloud"></i></a><?php
		}
		// behance
		if ( !empty( $behance ) && $behance != '' && $behance != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Behance" href="<?php echo esc_url( $behance ); ?>" <?php echo $newtab; ?>><i class="fa fa-behance"></i></a><?php
		}
		// instagram
		if ( !empty( $instagram ) && $instagram != '' && $instagram != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="instagram" href="<?php echo esc_url( $instagram ); ?>" <?php echo $newtab; ?>><i class="fa fa-instagram"></i></a><?php
		}
		// paypal
		if ( !empty( $paypal ) && $paypal != '' && $paypal != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="paypal" href="<?php echo esc_url( $paypal ); ?>" <?php echo $newtab; ?>><i class="fa fa-paypal"></i></a><?php
		}
		// spotify
		if ( !empty( $spotify ) && $spotify != '' && $spotify != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="spotify" href="<?php echo esc_url( $spotify ); ?>" <?php echo $newtab; ?>><i class="fa fa-spotify"></i></a><?php
		}
		// viadeo
		if ( !empty( $viadeo ) && $viadeo != '' && $viadeo != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="viadeo" href="<?php echo esc_url( $viadeo ); ?>" <?php echo $newtab; ?>><i class="tieicon-viadeo"></i></a><?php
		}
		// Google Play
		if ( !empty( $google_play ) && $google_play != '' && $google_play != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Google Play" href="<?php echo esc_url( $google_play ); ?>" <?php echo $newtab; ?>><i class="fa fa-play"></i></a><?php
		}
		// 500PX
		if ( !empty($px500) && $px500 != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="500px" href="<?php echo esc_url( $px500 ); ?>" <?php echo $newtab; ?>><i class="tieicon-fivehundredpx"></i></a><?php
		}
		// Forrst
		if ( !empty($forrst) && $forrst != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="Forrst" href="<?php echo esc_url( $forrst ); ?>" <?php echo $newtab; ?>><i class="tieicon-forrst"></i></a><?php
		}
		// VK
		if ( !empty($vk) && $vk != ' ' ) {
			?><a class="<?php echo $tooltip; ?>" title="vk.com" href="<?php echo esc_url( $vk ); ?>" <?php echo $newtab; ?>><i class="fa fa-vk"></i></a><?php
		} ?>

		<?php //Custom Social Networking

		for( $i=1 ; $i<=5 ; $i++ ){
			if ( tie_get_option( "custom_social_icon_$i" )  && tie_get_option( "custom_social_url_$i" ) ) {
				?><a class="<?php echo $tooltip; ?>" <?php if ( tie_get_option( "custom_social_title_$i" ) ) echo ' title="'.tie_get_option( "custom_social_title_$i" ).'"'; ?> href="<?php echo esc_url( tie_get_option( 'custom_social_url_'.$i ) ) ?>" <?php echo $newtab; ?>><i class="fa <?php echo tie_get_option( "custom_social_icon_$i" ) ?>"></i></a><?php
			}
		}

		?>
	</div>

<?php
}

/*-----------------------------------------------------------------------------------*/
# Change The Default WordPress Excerpt Length
/*-----------------------------------------------------------------------------------*/
function tie_excerpt_global_length( $length ) {
	if( tie_get_option( 'exc_length' ) )
		return tie_get_option( 'exc_length' );
	else return 60;
}

function tie_excerpt_home_length( $length ) {
	global $get_meta;

	if( !empty( $get_meta[ 'home_exc_length' ][0] ) )
		return $get_meta[ 'home_exc_length' ][0];
	else
		return 15;
}

function tie_excerpt(){
	add_filter( 'excerpt_length', 'tie_excerpt_global_length', 999 );
	echo get_the_excerpt();
}

function tie_excerpt_home(){
	add_filter( 'excerpt_length', 'tie_excerpt_home_length', 999 );
	echo get_the_excerpt();
}


/*-----------------------------------------------------------------------------------*/
# Read More Functions
/*-----------------------------------------------------------------------------------*/
function tie_remove_excerpt( $more ) {
	return ' &hellip;';
}
add_filter('excerpt_more', 'tie_remove_excerpt');


/*-----------------------------------------------------------------------------------*/
# Page Navigation
/*-----------------------------------------------------------------------------------*/
function tie_pagenavi( $query = false, $num = false ){
	?>
	<div class="pagination">
		<?php tie_get_pagenavi( $query, $num ) ?>
	</div>
	<?php
}

/*-----------------------------------------------------------------------------------*/
# Get Post Audio
/*-----------------------------------------------------------------------------------*/
function tie_audio(){
	global $post;
	$get_meta = get_post_custom($post->ID);
	$mp3 = $get_meta["tie_audio_mp3"][0] ;
	$m4a = $get_meta["tie_audio_m4a"][0] ;
	$oga = $get_meta["tie_audio_oga"][0] ;
	echo do_shortcode('[audio mp3="'.$mp3.'" ogg="'.$oga.'" m4a="'.$m4a.'"]');
}

/*-----------------------------------------------------------------------------------*/
# Get Post Video
/*-----------------------------------------------------------------------------------*/
function tie_video(){
 $wp_embed = new WP_Embed();
	global $post;
	$get_meta = get_post_custom($post->ID);
	if( !empty( $get_meta["tie_video_url"][0] ) ){
		$video_url = $get_meta["tie_video_url"][0];

		$protocol = is_ssl() ? 'https' : 'http';
		if( !is_ssl() ){
			$video_url = str_replace ( 'https://', 'http://', $video_url );
		}
		$video_output = $wp_embed->run_shortcode('[embed width="660" height="371.25"]'.$video_url.'[/embed]');
		if( $video_output == '<a href="'.$video_url.'">'.$video_url.'</a>' ){
			$width  = '660' ;
			$height = '371.25';
			$video_link = @parse_url($video_url);
			if ( $video_link['host'] == 'www.youtube.com' || $video_link['host']  == 'youtube.com' ) {
				parse_str( @parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars );
				$video =  $my_array_of_vars['v'] ;
				$video_output ='<iframe width="'.$width.'" height="'.$height.'" src="'.$protocol.'://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>';
			}
			elseif( $video_link['host'] == 'www.youtu.be' || $video_link['host']  == 'youtu.be' ){
				$video = substr(@parse_url($video_url, PHP_URL_PATH), 1);
				$video_output ='<iframe width="'.$width.'" height="'.$height.'" src="'.$protocol.'://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>';
			}elseif( $video_link['host'] == 'www.vimeo.com' || $video_link['host']  == 'vimeo.com' ){
				$video = (int) substr(@parse_url($video_url, PHP_URL_PATH), 1);
				$video_output='<iframe src="'.$protocol.'://player.vimeo.com/video/'.$video.'?wmode=opaque" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			}
			elseif( $video_link['host'] == 'www.dailymotion.com' || $video_link['host']  == 'dailymotion.com' ){
				$video = substr(@parse_url($video_url, PHP_URL_PATH), 7);
				$video_id = strtok($video, '_');
				$video_output='<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="'.$protocol.'://www.dailymotion.com/embed/video/'.$video_id.'"></iframe>';
			}
			else{
				$video_output = do_shortcode( '[video width="1280" height="720" mp4="'. $video_url .'"][/video]' );
			}
		}
	}
	elseif( !empty( $get_meta["tie_embed_code"][0] ) ){
		$embed_code = $get_meta["tie_embed_code"][0];
		$video_output = htmlspecialchars_decode( $embed_code);
	}
	elseif( !empty( $get_meta["tie_video_self"][0] ) ){
		$video_self = $get_meta["tie_video_self"][0];
		$video_output = do_shortcode( '[video width="1280" height="720" mp4="'.$get_meta["tie_video_self"][0].'"][/video]' );
	}
	if( !empty($video_output) ) echo $video_output; ?>
<?php
}


/*-----------------------------------------------------------------------------------*/
# Post Video embed URL
/*-----------------------------------------------------------------------------------*/
function tie_video_embed(){
	global $post;
	$get_meta = get_post_custom($post->ID);
	if( !empty( $get_meta["tie_video_url"][0] ) ){
		$video_output = tie_get_video_embed( $get_meta["tie_video_url"][0] );
	}
	if( !empty($video_output) ) return $video_output;
	else return home_url( '/' ); ?>
<?php
}


/*-----------------------------------------------------------------------------------*/
# Get Video embed URL
/*-----------------------------------------------------------------------------------*/
function tie_get_video_embed( $video_url ){
	$protocol = is_ssl() ? 'https' : 'http';
	$video_link = @parse_url($video_url);
	if ( $video_link['host'] == 'www.youtube.com' || $video_link['host']  == 'youtube.com' ) {
		parse_str( @parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars );
		$video =  $my_array_of_vars['v'] ;
		$video_output = $protocol.'://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque&autohide=1&border=0&egm=0&showinfo=0';
	}
	elseif( $video_link['host'] == 'www.youtu.be' || $video_link['host']  == 'youtu.be' ){
		$video = substr(@parse_url($video_url, PHP_URL_PATH), 1);
		$video_output = $protocol.'://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque&autohide=1&border=0&egm=0&showinfo=0';
	}elseif( $video_link['host'] == 'www.vimeo.com' || $video_link['host']  == 'vimeo.com' ){
		$video = (int) substr(@parse_url($video_url, PHP_URL_PATH), 1);
		$video_output= $protocol.'://player.vimeo.com/video/'.$video.'?wmode=opaque';
	}else{
		$video_output = $video_url;
	}

	if( !empty($video_output) ) return $video_output; ?>
<?php
}


/*-----------------------------------------------------------------------------------*/
# Tie Excerpt
/*-----------------------------------------------------------------------------------*/
function tie_content_limit( $text, $chars = 120 ) {
	$text = wp_strip_all_tags( $text );
	$text = $text.' ';
	$text = mb_substr( $text , 0 , $chars , 'UTF-8');
	$text = $text.'&#8230;';
	return $text;
}


/*-----------------------------------------------------------------------------------*/
# Queue Comments reply js
/*-----------------------------------------------------------------------------------*/
function tie_comments_queue_js(){
if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
	wp_enqueue_script( 'comment-reply' );
}
add_action('wp_print_scripts', 'tie_comments_queue_js');


/*-----------------------------------------------------------------------------------*/
# Remove recent comments_ style
/*-----------------------------------------------------------------------------------*/
function tie_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'tie_remove_recent_comments_style' );


/*-----------------------------------------------------------------------------------*/
# tie Thumb SRC
/*-----------------------------------------------------------------------------------*/
function tie_thumb_src( $size = 'tie-small' ){
	global $post;
	$image_id 	= get_post_thumbnail_id($post->ID);
	$image_url 	= wp_get_attachment_image_src($image_id, $size );
	return $image_url[0];
}


/*-----------------------------------------------------------------------------------*/
# tie Thumb
/*-----------------------------------------------------------------------------------*/
function tie_slider_img_src( $image_id , $size ){
	global $post;
	$image_url = wp_get_attachment_image_src($image_id, $size );
	return $image_url[0];
}


/*-----------------------------------------------------------------------------------*/
# Add user's social accounts
/*-----------------------------------------------------------------------------------*/
add_action( 'show_user_profile', 'tie_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'tie_show_extra_profile_fields' );
function tie_show_extra_profile_fields( $user ) {
	wp_enqueue_media();
?>
	<h3><?php _e( 'Cover Image', 'tie' ) ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="author-cover-bg"><?php _e( 'Cover Image', 'tie' ) ?></label></th>
			<td>
				<?php $author_cover_bg = get_the_author_meta( 'author-cover-bg', $user->ID ) ; ?>
				<input id="author-cover-bg" class="img-path" type="text" size="56" style="direction:ltr; text-laign:left" name="author-cover-bg" value="<?php if( !empty( $author_cover_bg ) ) echo esc_attr( $author_cover_bg );  ?>" />
				<input id="upload_author-cover-bg_button" type="button" class="button" value="<?php _e( 'Upload', 'tie' ) ?>" />

				<div id="author-cover-bg-preview" class="img-preview" <?php if( empty( $author_cover_bg ) ) echo 'style="display:none;"' ?>>
					<img src="<?php if( !empty( $author_cover_bg ) ) echo $author_cover_bg ; else echo get_template_directory_uri().'/framework/admin/images/empty.png'; ?>" alt="" />
					<a class="del-img" title="Delete"></a>
				</div>

				<script type='text/javascript'>
					jQuery('#author-cover-bg').change(function(){
						jQuery('#author-cover-bg-preview').show();
						jQuery('#author-cover-bg-preview img').attr("src", jQuery(this).val());
					});
					tie_set_uploader( 'author-cover-bg' );
				</script>
			</td>
		</tr>
	</table>

	<h3><?php _e( 'Custom Author widget', 'tie' ) ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="author_widget_content"><?php _e( 'Custom Author widget content', 'tie' ) ?></label></th>
			<td>
				<textarea name="author_widget_content" id="author_widget_content" rows="5" cols="30"><?php echo esc_attr( get_the_author_meta( 'author_widget_content', $user->ID ) ); ?></textarea>
				<br /><span class="description"><?php _e( 'Supports: Text, HTML and Shortcodes.', 'tie' ) ?></span>
			</td>
		</tr>
	</table>
	<h3><?php _e( 'Social Networking', 'tie' ) ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="google"><?php _e( 'Google+ URL', 'tie' ) ?></label></th>
			<td>
				<input type="text" name="google" id="google" value="<?php echo esc_url( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="twitter"><?php _e( 'Twitter Username', 'tie' ) ?></label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="facebook"><?php _e( 'Facebook URL', 'tie' ) ?></label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_url( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="linkedin"><?php _e( 'LinkedIn URL', 'tie' ) ?></label></th>
			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_url( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="flickr"><?php _e( 'Flickr URL', 'tie' ) ?></label></th>
			<td>
				<input type="text" name="flickr" id="flickr" value="<?php echo esc_url( get_the_author_meta( 'flickr', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="youtube"><?php _e( 'YouTube URL', 'tie' ) ?></label></th>
			<td>
				<input type="text" name="youtube" id="youtube" value="<?php echo esc_url( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="pinterest"><?php _e( 'Pinterest URL', 'tie' ) ?></label></th>
			<td>
				<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_url( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="behance"><?php _e( 'Behance URL', 'tie' ) ?></label></th>
			<td>
				<input type="text" name="behance" id="behance" value="<?php echo esc_url( get_the_author_meta( 'behance', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="instagram"><?php _e( 'Instagram URL', 'tie' ) ?></label></th>
			<td>
				<input type="text" name="instagram" id="instagram" value="<?php echo esc_url( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>

	</table>
<?php }

## Save user's social accounts
add_action( 'personal_options_update', 'tie_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'tie_save_extra_profile_fields' );
function tie_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) return false;
	update_user_meta( $user_id, 'author_widget_content',	$_POST['author_widget_content'] );
	update_user_meta( $user_id, 'author-cover-bg', 			$_POST['author-cover-bg'] );
	update_user_meta( $user_id, 'google', 					$_POST['google'] );
	update_user_meta( $user_id, 'pinterest', 				$_POST['pinterest'] );
	update_user_meta( $user_id, 'twitter', 					$_POST['twitter'] );
	update_user_meta( $user_id, 'facebook', 				$_POST['facebook'] );
	update_user_meta( $user_id, 'linkedin', 				$_POST['linkedin'] );
	update_user_meta( $user_id, 'flickr', 					$_POST['flickr'] );
	update_user_meta( $user_id, 'youtube', 					$_POST['youtube'] );
	update_user_meta( $user_id, 'instagram', 				$_POST['instagram'] );
	update_user_meta( $user_id, 'behance', 					$_POST['behance'] );
}


/*-----------------------------------------------------------------------------------*/
# Get Feeds
/*-----------------------------------------------------------------------------------*/
function tie_get_feeds( $feed , $number = 10 ){
	include_once(ABSPATH . WPINC . '/feed.php');

	$rss = @fetch_feed( $feed );
	if (!is_wp_error( $rss ) ){
		$maxitems = $rss->get_item_quantity($number);
		$rss_items = $rss->get_items(0, $maxitems);
	}
	if ( empty( $maxitems ) ) {
		$out = "<ul><li>". __( 'No items.', 'tie' )."</li></ul>";
	}else{
		$out = "<ul>";

		foreach ( $rss_items as $item ) :
			$out .= '<li><a target="_blank" href="'. esc_url( $item->get_permalink() ) .'" title="'.  __( "Posted ", "tie" ).$item->get_date("j F Y | g:i a").'">'. esc_html( $item->get_title() ) .'</a></li>';
		endforeach;
		$out .='</ul>';
	}

	return $out;
}


/*-----------------------------------------------------------------------------------*/
# Tie Wp Footer
/*-----------------------------------------------------------------------------------*/
add_action('wp_footer', 'tie_wp_footer');
function tie_wp_footer() {
	if ( tie_get_option('footer_code')) echo htmlspecialchars_decode( stripslashes(tie_get_option('footer_code') ));

	//Reading Position Indicator
	if ( tie_get_option( 'reading_indicator' ) && is_singular() ) echo '<div id="reading-position-indicator"></div>';
}


/*-----------------------------------------------------------------------------------*/
# News In Picture
/*-----------------------------------------------------------------------------------*/
function tie_last_news_pic($order , $posts_number = 12 , $cats = 1 ){
	global $post;
	$original_post = $post;

	if( $order == 'random')
		$args = array(
			'posts_per_page'		 => $posts_number,
			'cat'					 => $cats,
			'orderby'				 => 'rand',
			'no_found_rows'          => true,
			'ignore_sticky_posts'	 => true
		);
	else
		$args = array(
			'posts_per_page'		 => $posts_number,
			'cat'					 => $cats,
			'no_found_rows'          => true,
			'ignore_sticky_posts'	 => true
		);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
		<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
				<div <?php tie_post_class( 'post-thumbnail' ); ?>>
					<a class="ttip" title="<?php the_title();?>" href="<?php the_permalink(); ?>" ><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
		<?php
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Get Most Recent posts
/*-----------------------------------------------------------------------------------*/
function tie_last_posts($posts_number = 5 , $thumb = true){
	global $post;
	$original_post = $post;

	$args = array(
		'posts_per_page'		 => $posts_number,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
		<li <?php tie_post_class(); ?>>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
			<?php tie_get_score(); ?> <?php tie_get_time(); ?>
		</li>
		<?php
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Get Most Recent posts from Category
/*-----------------------------------------------------------------------------------*/
function tie_last_posts_cat($posts_number = 5 , $thumb = true , $cats = 1){
	global $post;
	$original_post = $post;

	$args = array(
		'posts_per_page'		 => $posts_number,
		'cat'					 => $cats,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
		<li <?php tie_post_class(); ?>>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
			<?php tie_get_score(); ?> <?php tie_get_time() ?>
		</li>
		<?php
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}

/*-----------------------------------------------------------------------------------*/
# Get Most Recent posts from Category - Timeline
/*-----------------------------------------------------------------------------------*/
function tie_last_posts_cat_timeline($posts_number = 5 , $cats = 1){
	global $post;
	$original_post = $post;

	$args = array(
		'posts_per_page'		 => $posts_number,
		'cat'					 => $cats,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
		<li>
			<a href="<?php the_permalink(); ?>">
				<?php tie_get_time() ?>
				<h3><?php the_title();?></h3>
			</a>
		</li>
		<?php
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}

/*-----------------------------------------------------------------------------------*/
# Get Most Recent posts from Category with Authors
/*-----------------------------------------------------------------------------------*/
function tie_last_posts_cat_authors($posts_number = 5 , $thumb = true , $cats = 1){
	global $post;
	$original_post = $post;

	$args = array(
		'posts_per_page'		 => $posts_number,
		'cat'					 => $cats,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
		<li>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
				<div class="post-thumbnail">
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'MFW_author_bio_avatar_size', 50 ) ); ?></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
			<strong><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_the_author() ?> </a></strong>
		</li>
		<?php
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Get Random posts
/*-----------------------------------------------------------------------------------*/
function tie_random_posts($posts_number = 5 , $thumb = true){
	global $post;
	$original_post = $post;

	$args = array(
		'posts_per_page'		 => $posts_number,
		'orderby'				 => 'rand',
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
		<li <?php tie_post_class(); ?>>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php tie_get_score(); ?><?php tie_get_time(); ?>
		</li>
		<?php
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Get Popular posts
/*-----------------------------------------------------------------------------------*/
function tie_popular_posts( $posts_number = 5 , $thumb = true){
	global $post;
	$original_post = $post;

	$args = array(
		'orderby'				 => 'comment_count',
		'order'					 => 'DESC',
		'posts_per_page'		 => $posts_number,
		'post_status'			 => 'publish',
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$popularposts = new WP_Query( $args );
	if ( $popularposts->have_posts() ):
		while ( $popularposts->have_posts() ) : $popularposts->the_post()?>
			<li <?php tie_post_class(); ?>>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
				<div class="post-thumbnail">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute( ) ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
				<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
				<?php tie_get_score(); ?> <?php tie_get_time(); ?>
				<?php if ( get_comments_number() != 0 ) : ?>
				<span class="post-comments post-comments-widget"><i class="fa fa-comments"></i><?php comments_popup_link( '0' , '1' , '%' ); ?></span>
				<?php endif; ?>
			</li>
	<?php
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}

/*-----------------------------------------------------------------------------------*/
# Get Popular posts / Views
/*-----------------------------------------------------------------------------------*/
function tie_most_viewed( $posts_number = 5 , $thumb = true){
	global $post;
	$original_post = $post;

	$args = array(
		'orderby'				 => 'meta_value_num',
		'meta_key'				 => 'tie_views',
		'posts_per_page'		 => $posts_number,
		'post_status'			 => 'publish',
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$popularposts = new WP_Query( $args );
	if ( $popularposts->have_posts() ):
		while ( $popularposts->have_posts() ) : $popularposts->the_post()?>
			<li <?php tie_post_class(); ?>>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
				<div class="post-thumbnail">
					<a href="<?php echo get_permalink( $post->ID ) ?>" title="<?php the_title_attribute() ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
				<h3><a href="<?php echo get_permalink( $post->ID ) ?>"><?php the_title(); ?></a></h3>
				<?php tie_get_score(); ?> <?php tie_get_time(); ?>
				<?php if( tie_get_option( 'post_views' ) ): ?>
					<span class="post-views-widget"><?php echo tie_views(); ?><span>
				<?php endif; ?>
			</li>
	<?php
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Get Most commented posts
/*-----------------------------------------------------------------------------------*/
function tie_most_commented($comment_posts = 5 , $avatar_size = 55){
$comments = get_comments('status=approve&number='.$comment_posts);
foreach ($comments as $comment) { ?>
	<li>
		<div class="post-thumbnail" style="width:<?php echo $avatar_size ?>px">
			<?php echo get_avatar( $comment, $avatar_size ); ?>
		</div>
		<a href="<?php echo get_permalink($comment->comment_post_ID ); ?>#comment-<?php echo $comment->comment_ID; ?>">
		<?php echo strip_tags($comment->comment_author); ?>: <?php echo wp_html_excerpt( $comment->comment_content, 80 ); ?>... </a>
	</li>
<?php }
}

/*-----------------------------------------------------------------------------------*/
# Get Best Reviews posts
/*-----------------------------------------------------------------------------------*/
function tie_best_reviews_posts( $posts_number = 5 , $thumb = true){
	global $post;
	$original_post = $post;

	$args = array(
		'orderby'				 => 'meta_value_num',
		'meta_key'				 => 'taq_review_score',
		'posts_per_page'		 => $posts_number,
		'post_status'			 => 'publish',
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$best_views = new WP_Query( $args );

	if ( $best_views->have_posts() ):
		while ( $best_views->have_posts() ) : $best_views->the_post()?>
<li <?php tie_post_class(); ?>>
	<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
		</div><!-- post-thumbnail /-->
	<?php endif; ?>
	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<?php tie_get_score(); ?> <?php tie_get_time(); ?>
</li>
<?php
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Google Map Function
/*-----------------------------------------------------------------------------------*/
function tie_google_maps($src , $width = 610 , $height = 440 , $class="") {
	return '<div class="google-map '.$class.'"><iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed"></iframe></div>';
}

/*-----------------------------------------------------------------------------------*/
# Soundcloud Function
/*-----------------------------------------------------------------------------------*/
function tie_soundcloud($url, $autoplay = 'false', $visual = 'false' ) {
	global $post;

	$color = $tie_post_color = $cat_id = '';

	$height = '166';
	if(	$visual != 'false' ){
		$height = '350';
	}

	if( is_singular() ){
		$get_meta = get_post_custom($post->ID);

		if( !empty( $get_meta["post_color"][0] ) )
			$tie_post_color = $get_meta["post_color"][0];
	}
	if( empty($tie_post_color) ){
		if( is_category() ){
			$cat_id = get_query_var('cat');
		}
		elseif( is_single() ){
			$category = get_the_category($post->ID);

			if( !empty( $category[0]->cat_ID ) )
				$cat_id = $category[0]->cat_ID;
		}

		$tie_cats_options = get_option( 'tie_cats_options' );
		if( !empty( $tie_cats_options[ $cat_id ] ) )
			$cat_option = $tie_cats_options[ $cat_id ];

		if( !empty( $cat_option['cat_color'] ) )
			$tie_post_color = $cat_option['cat_color'];
	}
	if( empty($tie_post_color) && tie_get_option( 'theme_skin' ) && !tie_get_option( 'global_color' ) ) $tie_post_color = tie_get_option( 'theme_skin' );
	if( empty($tie_post_color) && tie_get_option( 'global_color' ) ) $tie_post_color = tie_get_option( 'global_color' );

	if( !empty( $tie_post_color ) ){
		$tie_post_color = str_replace ( '#' , '' , $tie_post_color );
		$color = '&amp;color='.$tie_post_color;
	}

	return '<iframe width="100%" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.$url.$color.'&amp;auto_play='.$autoplay.'&amp;show_artwork=true&amp;visual='.$visual.'"></iframe>';
}

/*-----------------------------------------------------------------------------------*/
# Login Form
/*-----------------------------------------------------------------------------------*/
function tie_login_form( $login_only  = 0 ) {
	global $user_ID, $user_identity, $user_level;
	$redirect = site_url();

	if ( $user_ID ) : ?>
		<?php if( empty( $login_only ) ): ?>
		<div id="user-login">
			<span class="author-avatar"><?php echo get_avatar( $user_ID, $size = '90'); ?></span>
			<p class="welcome-text"><?php _eti( 'Welcome' ) ?> <strong><?php echo $user_identity ?></strong> .</p>
			<ul>
				<li><a href="<?php echo admin_url() ?>"><?php _eti( 'Dashboard' ) ?> </a></li>
				<li><a href="<?php echo admin_url() ?>profile.php"><?php _eti( 'Your Profile' ) ?> </a></li>
				<li><a href="<?php echo wp_logout_url($redirect); ?>"><?php _eti( 'Logout' ) ?> </a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<?php endif; ?>
	<?php else: ?>
		<div id="login-form">
			<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ) ?>" method="post">
				<p id="log-username"><input type="text" name="log" id="log" title="<?php _eti( 'Username' ) ?>" value="<?php _eti( 'Username' ) ?>" onfocus="if (this.value == '<?php _eti( 'Username' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _eti( 'Username' ) ?>';}"  size="33" /></p>
				<p id="log-pass"><input type="password" name="pwd" id="pwd" title="<?php _eti( 'Password' ) ?>" value="<?php _eti( 'Password' ) ?>" onfocus="if (this.value == '<?php _eti( 'Password' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _eti( 'Password' ) ?>';}" size="33" /></p>
				<input type="submit" name="submit" value="<?php _eti( 'Log in' ) ?>" class="login-button" />
				<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> <?php _eti( 'Remember Me' ) ?></label>
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
			</form>
			<ul class="login-links">
				<?php echo wp_register() ?>
				<li><a href="<?php echo wp_lostpassword_url($redirect) ?>"><?php _eti( 'Lost your password?' ) ?></a></li>
			</ul>
		</div>
	<?php endif;
}


/*-----------------------------------------------------------------------------------*/
# OG Meta for posts
/*-----------------------------------------------------------------------------------*/
function tie_og_data() {
	global $post ;

	if ( function_exists("has_post_thumbnail") && has_post_thumbnail() )
		$post_thumb = tie_thumb_src( 'slider' ) ;
	else{
		$protocol = is_ssl() ? 'https' : 'http';
		$get_meta = get_post_custom($post->ID);
		if( !empty( $get_meta["tie_video_url"][0] ) ){
			$video_url = $get_meta["tie_video_url"][0];
			$video_link = @parse_url($video_url);
			if ( $video_link['host'] == 'www.youtube.com' || $video_link['host']  == 'youtube.com' ) {
				parse_str( @parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars );
				$video =  $my_array_of_vars['v'] ;
				$post_thumb = $protocol.'://img.youtube.com/vi/'.$video.'/0.jpg';
			}
			elseif( $video_link['host'] == 'www.vimeo.com' || $video_link['host']  == 'vimeo.com' ){
				$video = (int) substr(@parse_url($video_url, PHP_URL_PATH), 1);
				$url = $protocol.'://vimeo.com/api/v2/video/'.$video.'.php';;
				$contents = @file_get_contents($url);
				$thumb = @unserialize(trim($contents));
				$post_thumb = $thumb[0]['thumbnail_large'];
			}
		}
	}

$og_title 		= strip_shortcodes(strip_tags(( get_the_title() ))) .' - '. get_bloginfo('name') ;
$og_description = strip_tags(strip_shortcodes( apply_filters('tie_exclude_content', $post->post_content) ) );
$og_type 		= 'article';

if( is_home() || is_front_page() ){
	$og_title 		= get_bloginfo('name');
	$og_description = get_bloginfo( 'description' );
	$og_type 		= 'website';
}

?>
<meta property="og:title" content="<?php echo $og_title ?>"/>
<meta property="og:type" content="<?php echo $og_type ?>"/>
<meta property="og:description" content="<?php echo wp_html_excerpt( $og_description , 100 ) ?>"/>
<meta property="og:url" content="<?php the_permalink(); ?>"/>
<meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ) ?>"/>
<?php
if( !empty($post_thumb) )
	echo '<meta property="og:image" content="'. $post_thumb .'" />'."\n";
}


/*-----------------------------------------------------------------------------------*/
# For Empty Widgets Titles
/*-----------------------------------------------------------------------------------*/
function tie_widget_title($title){
	if( empty( $title ) )
		return ' ';
	else return $title;
}
add_filter('widget_title', 'tie_widget_title');


/*-----------------------------------------------------------------------------------*/
# Get the post time
/*-----------------------------------------------------------------------------------*/
function tie_get_time( $return = false ){
	global $post ;

	if( tie_get_option( 'time_format' ) == 'none' ){
		return false;

	}elseif( tie_get_option( 'time_format' ) == 'modern' ){

		$time_now  = current_time('timestamp');
		$post_time = get_the_time('U') ;

		if ( $post_time > $time_now - ( 60 * 60 * 24 * 30 ) ) {
			$since = sprintf( __ti( '%s ago' ), human_time_diff( $post_time, $time_now ) );
		} else {
			$since = get_the_time(get_option('date_format'));
		}

	}else{
		$since = get_the_time(get_option('date_format'));
	}

	$post_time = '<span class="tie-date"><i class="fa fa-clock-o"></i>'.$since.'</span>';

	if( $return ){
		return $post_time;
	}else{
		echo $post_time;
	}
}

/*-----------------------------------------------------------------------------------*/
# Custom Classes for body
/*-----------------------------------------------------------------------------------*/
add_filter('body_class','tie_body_custom_class');
function tie_body_custom_class($classes) {
	if( tie_get_option('dark_skin') )
		$classes[] = 'dark-skin';

	if( tie_get_option('lazy_load') )
		$classes[] = 'lazy-enabled';
	return $classes;
}

/*-----------------------------------------------------------------------------------*/
# Fix Shortcodes
/*-----------------------------------------------------------------------------------*/
function tie_fix_shortcodes($content){
    $array = array (
        '[raw]' 		=> '',
        '[/raw]' 		=> '',
        '<p>[raw]' 		=> '',
        '[/raw]</p>' 	=> '',
        '[/raw]<br />' 	=> '',
        '<p>[' 			=> '[',
        ']</p>' 		=> ']',
        ']<br />' 		=> ']'
    );

    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'tie_fix_shortcodes');

/*-----------------------------------------------------------------------------------*/
# Check if the current page is wp-login.php or wp-register.php
/*-----------------------------------------------------------------------------------*/
function tie_is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}


/*-----------------------------------------------------------------------------------*/
# Posts Classes
/*-----------------------------------------------------------------------------------*/
function tie_post_class( $classes = false ) {
    global $post;

	$post_format = get_post_meta($post->ID, 'tie_post_head', true);
	if( !empty($post_format) ){
		if( !empty($classes) ) $classes .= ' ';
		$classes .= 'tie_'.$post_format;
	}
	if( !empty($classes) )
		echo 'class="'.$classes.'"';
}

function tie_get_post_class( $classes = false ) {
    global $post;

	$post_format = get_post_meta($post->ID, 'tie_post_head', true);
	if( !empty($post_format) ){
		if( !empty($classes) ) $classes .= ' ';
		$classes .= 'tie_'.$post_format;
	}
	if( !empty($classes) )
		return 'class="'.$classes.'"';
}


/*-----------------------------------------------------------------------------------*/
# Languages Switcher
/*-----------------------------------------------------------------------------------*/
function tie_language_selector_flags(){
	if( function_exists( 'icl_get_languages' )){
		$languages = icl_get_languages('skip_missing=0&orderby=code');
		if(!empty($languages)){
			echo '<div id="tie_lang_switcher">';
			foreach($languages as $l){
				if(!$l['active']) echo '<a href="'.$l['url'].'">';
					echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
				if(!$l['active']) echo '</a>';
			}
			echo '</div>';
		}
	}
}


/*-----------------------------------------------------------------------------------*/
# Modify excerpts
/*-----------------------------------------------------------------------------------*/
function tie_modify_post_excerpt($text = '') {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');

		$text = apply_filters('tie_exclude_content', $text);

		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);

		$excerpt_length = apply_filters('excerpt_length', 55);
		$excerpt_more 	= apply_filters('excerpt_more', ' ' . '[&hellip;]');
		$text 			= wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
add_filter( 'get_the_excerpt', 'tie_modify_post_excerpt', 9 );


/*-----------------------------------------------------------------------------------*/
# Remove Shortcodes code and Keep the content
/*-----------------------------------------------------------------------------------*/
function tie_remove_shortcodes($text = '') {
	$text = preg_replace( '/(\[(padding)\s?.*?\])/' , '' , $text);
	$text = str_replace( array ( '[/padding]', '[dropcap]', '[/dropcap]', '[highlight]', '[/highlight]', '[tie_slideshow]', '[/tie_slideshow]', '[tie_slide]', '[/tie_slide]'), '', $text);
	return $text;
}
add_filter( 'tie_exclude_content', 		'tie_remove_shortcodes' );
add_filter( 'taqyeem_exclude_content',	'tie_remove_shortcodes' );


/*-----------------------------------------------------------------------------------*/
# WP 3.6.0
/*-----------------------------------------------------------------------------------*/
// For old theme versions Video shortcode
function tie_video_fix_shortcodes($content){
	$v = '/(\[(video)\s?.*?\])(.+?)(\[(\/video)\])/';
	$content = preg_replace( $v , '[embed]$3[/embed]' , $content);
    return $content;
}
add_filter('the_content', 'tie_video_fix_shortcodes', 0);


/*-----------------------------------------------------------------------------------*/
# Custom Comments Template
/*-----------------------------------------------------------------------------------*/
function tie_custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment ;
	?>
	<li id="comment-<?php comment_ID(); ?>">
		<div  <?php comment_class('comment-wrap'); ?> >
			<div class="comment-avatar"><?php echo get_avatar( $comment, 65 ); ?></div>

			<div class="comment-content">
				<div class="author-comment">
					<?php printf( '%s ', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">	<?php printf( __ti( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __ti( 'Edit' ), ' ' ); ?></div><!-- .comment-meta .commentmetadata -->
					<div class="clear"></div>
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _eti( 'Your comment is awaiting moderation.' ); ?></em>
					<br />
				<?php endif; ?>

				<?php comment_text(); ?>
			</div>
			<div class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div><!-- .reply -->
		</div><!-- #comment-##  -->

	<?php
}


/*-----------------------------------------------------------------------------------*/
# Custom Pings Template
/*-----------------------------------------------------------------------------------*/
function tie_custom_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
	<li class="comment pingback">
		<p><?php _eti( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __ti( 'Edit' ), ' ' ); ?></p>
<?php
}


/*-----------------------------------------------------------------------------------*/
# TGM ACTIVATION PLUGIN
/*-----------------------------------------------------------------------------------*/
add_action( 'tgmpa_register', 'tie_theme_register_required_plugins' );
function tie_theme_register_required_plugins() {

    $plugins = array(

        array(
            'name'               => 'InstaNOW',
            'slug'               => 'instanow',
            'source'             => get_template_directory_uri() . '/framework/plugins/instanow.zip',
            'required'           => true,
            'version'            => '2.1.1',
            'force_activation'   => false,
            'force_deactivation' => true,
            'external_url'       => '',
        ),

        array(
            'name'               => 'Taqyeem',
            'slug'               => 'taqyeem',
            'source'             => get_template_directory_uri() . '/framework/plugins/taqyeem.zip',
            'required'           => true,
            'version'            => '2.1.5',
            'force_activation'   => false,
            'force_deactivation' => true,
            'external_url'       => '',
        ),

        array(
            'name'               => 'Taqyeem - Buttons Addon',
            'slug'               => 'taqyeem-buttons',
            'source'             => get_template_directory_uri() . '/framework/plugins/taqyeem-buttons.zip',
            'required'           => true,
            'version'            => '1.0.3',
            'force_activation'   => false,
            'force_deactivation' => true,
            'external_url'       => '',
        ),

        array(
            'name'               => 'Taqyeem - Predefined Criteria Addon',
            'slug'               => 'taqyeem-predefined',
            'source'             => get_template_directory_uri() . '/framework/plugins/taqyeem-predefined.zip',
            'required'           => true,
            'version'            => '1.0.1',
            'force_activation'   => false,
            'force_deactivation' => true,
            'external_url'       => '',
        ),
	/*
        array(
            'name'      => 'Animated Gif Resize',
            'slug'      => 'animated-gif-resize',
            'required'  => false,
        ),
	*/
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),

        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => false,
        ),

    );


    $config = array(
    	'id'           => 'tie'.THEME_NAME,			// Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',						// Default absolute path to pre-packaged plugins.
        'has_notices'  => true,						// Show admin notices or not.
        'dismissable'  => true,						// If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',						// If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,					// Automatically activate plugins after installation or not.
        'message'      => '',						// Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'tie' ),
			'menu_title'                      => __( 'Install Plugins', 'tie' ),
			'installing'                      => __( 'Installing Plugin: %s', 'tie' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'tie' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tie' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tie' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tie' ), // %s = dashboard link.
        )
    );

    tgmpa( $plugins, $config );

}

/* Remove TGM notice for users without permissions to install/update plugins */
add_filter( 'get_user_metadata', 'tie_remove_tgm_notice', 10, 4);
function tie_remove_tgm_notice($val, $object_id, $meta_key, $single){
	if( $meta_key === 'tgmpa_dismissed_notice_tie'.THEME_NAME && !current_user_can( 'edit_theme_options' ) ){
		return true;
	}else{
		return null;
	}
}


/*-----------------------------------------------------------------------------------*/
# BANNERS
/*-----------------------------------------------------------------------------------*/
function tie_banner( $banner , $before= false , $after = false){
	if(tie_get_option( $banner )):
		echo $before;
		$protocol = is_ssl() ? 'https' : 'http';
		if(tie_get_option( $banner.'_img' )):
			$target = $nofollow ="";
			if( tie_get_option( $banner.'_tab' )) $target='target="_blank"';
			if( tie_get_option( $banner.'_nofollow' )) $nofollow='rel="nofollow"';?>

			<a href="<?php echo tie_get_option( $banner.'_url' ) ?>" title="<?php echo tie_get_option( $banner.'_alt') ?>" <?php echo $target; echo $nofollow ?>>
				<img src="<?php echo tie_get_option( $banner.'_img' ) ?>" alt="<?php echo tie_get_option( $banner.'_alt') ?>" />
			</a>
		<?php

			elseif( tie_get_option( $banner.'_publisher' ) ):

				$mobile_width = 300;
				$mobile_height = 250;

				if( $banner == 'banner_top' || $banner == 'banner_below_header' ){
					$mobile_width = 320;
					$mobile_height = 100;
				}

		?>
		<script type="text/javascript">
			var adWidth = jQuery(document).width();
			google_ad_client = "<?php echo tie_get_option( $banner.'_publisher' ) ?>";
			<?php if( $banner != 'banner_above' && $banner != 'banner_below' ){ ?>if ( adWidth >= 768 ) {
			  google_ad_slot	= "<?php echo tie_get_option( $banner.'_728' ) ?>";
			  google_ad_width	= 728;
			  google_ad_height 	= 90;
			} else <?php } ?> if ( adWidth >= 468 ) {
			  google_ad_slot	= "<?php echo tie_get_option( $banner.'_468' ) ?>";
			  google_ad_width 	= 468;
			  google_ad_height 	= 60;
			}else {
			  google_ad_slot 	= "<?php echo tie_get_option( $banner.'_300' ) ?>";
			  google_ad_width 	= <?php echo $mobile_width ?>;
			  google_ad_height 	= <?php echo $mobile_height ?>;
			}
		</script>

		<script async src="<?php echo $protocol ?>://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
		<?php elseif(tie_get_option( $banner.'_adsense' )): ?>
			<?php echo do_shortcode(htmlspecialchars_decode(tie_get_option( $banner.'_adsense' ))) ?>
		<?php
		endif;
		?>
		<?php
		echo $after;
	endif;
}


/*-----------------------------------------------------------------------------------*/
# Get All Categories IDs
/*-----------------------------------------------------------------------------------*/
function tie_get_all_category_ids(){
	$categories = array();
	$get_cats = get_terms( 'category' );
	if ( ! empty( $get_cats ) && ! is_wp_error( $get_cats ) ){
		foreach ( $get_cats as $cat )
			$categories[] = $cat->term_id;
	}
	return $categories;
}


/*-----------------------------------------------------------------------------------*/
# WOOCOMMERCE
/*-----------------------------------------------------------------------------------*/
add_action('woocommerce_before_main_content', 'tie_woocommerce_wrapper_start', 22);
function tie_woocommerce_wrapper_start() {
	echo '<div class="post-listing"><div class="post-inner">';
}

add_action('woocommerce_after_main_content', 'tie_woocommerce_wrapper_start2', 11);
function tie_woocommerce_wrapper_start2() {
  echo '</div></div>';
}

add_action('woocommerce_before_shop_loop', 'tie_woocommerce_wrapper_start3', 33);
function tie_woocommerce_wrapper_start3() {
  echo '<div class="clear"></div>';
}

add_action('woocommerce_before_shop_loop_item_title', 'tie_woocommerce_wrapper_product_img_start', 9);
function tie_woocommerce_wrapper_product_img_start() {
  echo '<div class="product-img">';
}

add_action('woocommerce_before_shop_loop_item_title', 'tie_woocommerce_wrapper_product_img_end', 11);
function tie_woocommerce_wrapper_product_img_end() {
  echo '</div>';
}

add_filter('woocommerce_single_product_image_html', 'tie_woocommerce_single_product_image_html', 99, 1);
add_filter('woocommerce_single_product_image_thumbnail_html', 'tie_woocommerce_single_product_image_html', 99, 1);
function tie_woocommerce_single_product_image_html($html) {
    $html = str_replace('data-rel="prettyPhoto', 'rel="lightbox-enabled', $html);
    return $html;
}

add_filter('loop_shop_columns', 'tie_woocommerce_loop_shop_columns', 99, 1);
function tie_woocommerce_loop_shop_columns() {
    return 3;
}


/*-----------------------------------------------------------------------------------*/
# Remove Query Strings From Static Resources
/*-----------------------------------------------------------------------------------*/
function tie_remove_query_strings_1( $src ){
	$rqs = explode( '?ver', $src );
		return $rqs[0];

}
function tie_remove_query_strings_2( $src ){
	$rqs = explode( '&ver', $src );
		return $rqs[0];
}

if ( !is_admin() ) {
	add_filter( 'script_loader_src', 	'tie_remove_query_strings_1', 15, 1 );
	add_filter( 'style_loader_src', 	'tie_remove_query_strings_1', 15, 1 );
	add_filter( 'script_loader_src', 	'tie_remove_query_strings_2', 15, 1 );
	add_filter( 'style_loader_src', 	'tie_remove_query_strings_2', 15, 1 );
}


/*-----------------------------------------------------------------------------------*/
# WooCommerce Cart
/*-----------------------------------------------------------------------------------*/
add_filter('add_to_cart_fragments', 'tie_woocommerce_header_add_to_cart_fragment');
function tie_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();
	?>
	<span class="shooping-count-outer"><?php if( isset( $woocommerce->cart->cart_contents_count ) && ( $woocommerce->cart->cart_contents_count != 0 ) ){ ?><span class="shooping-count"><?php echo $woocommerce->cart->cart_contents_count ?></span><?php } ?><i class="fa fa-shopping-cart"></i></span>
	<?php

	$fragments['.shooping-count-outer'] = ob_get_clean();

	return $fragments;
}


/*-----------------------------------------------------------------------------------*/
# Titles for WordPress before 4.1
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function tie_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
    }
    add_action( 'wp_head', 'tie_slug_render_title' );
endif;


/*-----------------------------------------------------------------------------------*/
# Sanitizes a title, replacing whitespace and a few other characters with dashes.
/*-----------------------------------------------------------------------------------*/
function tie_sanitize_title( $title ){
	$title = strip_tags($title);
	$title = preg_replace('/&.+?;/', '', $title);
	$title = str_replace('.', '-', $title);
	$title = strtolower($title);
	$title = preg_replace('/[^%a-z0-9 :-]/', '', $title);
	$title = preg_replace('/\s+/', '-', $title);
	$title = preg_replace('|-+|', '-', $title);
	$title = trim($title, '-');

	return $title;
}


/*-----------------------------------------------------------------------------------*/
# Compatibility With Taqyeem Plugin | Change the custom fields names
/*-----------------------------------------------------------------------------------*/
add_action( 'load-post.php', 'tie_update_reviews_info' );
function tie_update_reviews_info( ){
	global $post;

	$post_id = false ;

	if( !empty( $post->ID ) ) $post_id = $post->ID;
	elseif( !empty($_GET['post']) ) $post_id = $_GET['post'];

	if( !empty( $post_id ) ){

		$current_post_data = get_post_meta($post_id);

		if( !empty( $current_post_data ) && is_array($current_post_data) )
			extract($current_post_data);

		// There is no title feature in the theme so we check if one of other fields exists to execute the code one time
		if( !empty( $tie_review_position[0] ) && empty( $taq_review_title[0] ) ){
			$update_new_title  = update_post_meta($post_id, 'taq_review_title' ,  __( "Review Overview" , "tie" ) );
		}

		if( !empty( $tie_review_position[0] ) && empty( $taq_review_position[0] ) ){
			if( $tie_review_position[0] == 'both' ){
				$update_new_position  = update_post_meta($post_id, 'taq_review_position' , 'top' );
			}else{
				$update_new_position  = update_post_meta($post_id, 'taq_review_position' , $tie_review_position[0] );
			}
			if( $update_new_position ) delete_post_meta($post_id, 'tie_review_position');
		}

		if( !empty( $tie_review_style[0] ) && empty( $taq_review_style[0] ) ){
			$update_new_style  = update_post_meta($post_id, 'taq_review_style' , $tie_review_style[0] );
			if( $update_new_style ) delete_post_meta($post_id, 'tie_review_style');
		}

		if( !empty( $tie_review_summary[0] ) && empty( $taq_review_summary[0] ) ){
			$update_new_summary  = update_post_meta($post_id, 'taq_review_summary' , $tie_review_summary[0] );
			if( $update_new_summary ) delete_post_meta($post_id, 'tie_review_summary');
		}

		if( !empty( $tie_review_total[0] ) && empty( $taq_review_total[0] ) ){
			$update_new_total  = update_post_meta($post_id, 'taq_review_total' , $tie_review_total[0] );
			if( $update_new_total ) delete_post_meta($post_id, 'tie_review_total');
		}

		if( !empty( $tie_review_criteria[0] ) && empty( $taq_review_criteria[0] ) ){
			$update_new_criteria  = update_post_meta($post_id, 'taq_review_criteria' , unserialize ( $tie_review_criteria[0] ) );
			if( $update_new_criteria ) delete_post_meta($post_id, 'tie_review_criteria');
		}

		if( !empty( $tie_review_score[0] ) && empty( $taq_review_score[0] ) ){
			$update_new_score  = update_post_meta($post_id, 'taq_review_score' , $tie_review_score[0] );
			if( $update_new_score ) delete_post_meta($post_id, 'tie_review_score');
		}
	}
}

/* Old Review Shortcode */
add_shortcode('review', 'taqyeem_shortcode_review');

?>

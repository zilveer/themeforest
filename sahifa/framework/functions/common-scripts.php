<?php
/*-----------------------------------------------------------------------------------*/
# Register main Scripts and Styles
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'tie_register' ); 
function tie_register() {
	## Register Main style.css file
	wp_register_style( 'tie-style', get_stylesheet_uri() , array(), '', 'all' );
	wp_enqueue_style ( 'tie-style' );
	
	## Register All Scripts
    wp_register_script( 'tie-scripts',		get_template_directory_uri() . '/js/tie-scripts.js',		array( 'jquery' ), 	false, true );  
    wp_register_script( 'tie-tabs',			get_template_directory_uri() . '/js/tabs.min.js',			array( 'jquery' ),	false, true );  
    wp_register_script( 'tie-cycle',		get_template_directory_uri() . '/js/jquery.cycle.all.js',	array( 'jquery' ),	false, true );
    wp_register_script( 'tie-validation',	get_template_directory_uri() . '/js/validation.js',			array( 'jquery' ),	false, true );  
    wp_register_script( 'tie-masonry',		get_template_directory_uri() . '/js/isotope.js',			array( 'jquery' ),	false, true );
	wp_register_script( 'tie-ilightbox',	get_template_directory_uri() . '/js/ilightbox.packed.js',	array( 'jquery' ),	false, true );  
	
	## Get Global Scripts
    wp_enqueue_script( 'tie-scripts' );
	wp_enqueue_script( 'tie-ilightbox' );
	
	## Register WooCommerce css file
	wp_register_style( 'tie-woocommerce', get_template_directory_uri().'/css/woocommerce.css' , array(), '', 'all' );
	if (class_exists('Woocommerce')) 
		wp_enqueue_style( 'tie-woocommerce' );
		
	## Register bbPress css file
	wp_register_style( 'tie-bbpress', get_template_directory_uri().'/css/bbpress.css' , array(), '', 'all' );
	if ( class_exists( 'bbpress' ) ) 
		wp_enqueue_style( 'tie-bbpress' );
		
	## Register buddyPress css file
	wp_register_style( 'tie-buddypress', get_template_directory_uri().'/css/buddypress.css' , array(), '', 'all' );
	if ( class_exists( 'buddypress' ) ) 
		wp_enqueue_style( 'tie-buddypress' );
		
	## Get Validation Script
	if( tie_get_option('comment_validation') && is_singular() && comments_open() )
		wp_enqueue_script( 'tie-validation' );
	
	
	$lightbox_skin = 'dark';
	if( tie_get_option( 'lightbox_skin' ) ) $lightbox_skin = tie_get_option( 'lightbox_skin' );
	wp_enqueue_style('tie-ilightbox-skin',  get_template_directory_uri() . '/css/ilightbox/'.$lightbox_skin.'-skin/skin.css' );
		
	## For facebook & Google + share
	if( is_singular() && tie_get_option('post_og_cards') && ( !function_exists('bp_current_component') || (function_exists('bp_current_component') && !bp_current_component() ) ) ) tie_og_data();

	## Sticky Sidebars
	$sticky_sidebar = false ;
	if( tie_get_option( 'sticky_sidebar' ) ) {
		$sticky_sidebar = true ;

		if(
		( ( is_home() || is_front_page() ) && tie_get_option( 'sticky_sidebar_disable_homepage' ) ) ||
		(   is_page() && tie_get_option( 'sticky_sidebar_disable_pages' ) ) ||
		(   is_single() && tie_get_option( 'sticky_sidebar_disable_posts' ) ) ||
		(   is_tag() && tie_get_option( 'sticky_sidebar_disable_tag' ) ) ||
		(   is_category() && tie_get_option( 'sticky_sidebar_disable_cat' ) ) ) $sticky_sidebar = false ;
	}
	
	## Inline Vars
	$tie_js_vars = array(
		"mobile_menu_active"	=> tie_get_option( 'mobile_menu_active' ), 
		"mobile_menu_top"		=> tie_get_option( 'mobile_menu_top' ), 
		"lightbox_all"			=> tie_get_option( 'lightbox_all' ), 
		"lightbox_gallery"		=> tie_get_option( 'lightbox_gallery' ), 
		"woocommerce_lightbox"	=> get_option( 'woocommerce_enable_lightbox' ), 
		"lightbox_skin"			=> $lightbox_skin, 
		"lightbox_thumb"		=> tie_get_option( 'lightbox_thumbs' ), 
		"lightbox_arrows"		=> tie_get_option( 'lightbox_arrows' ), 
		"sticky_sidebar"		=> $sticky_sidebar, 
		"is_singular"			=> is_singular(), 
		"SmothScroll"			=> tie_get_option( 'smoth_scroll' ), 
		"reading_indicator"		=> tie_get_option( 'reading_indicator' ),
		"lang_no_results"		=> __ti( 'No Results' ), 
		"lang_results_found"	=> __ti( 'Results Found' ), 
	);
	wp_localize_script( 'tie-scripts', 'tie', $tie_js_vars );
	
}

/*-----------------------------------------------------------------------------------*/
# Enqueue WooCommerce & bbPress & buddyPress
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'tie_remove_plugins_js_css', 99 );
function tie_remove_plugins_js_css() {
	//WooCommerce
	wp_dequeue_style ( 'woocommerce-layout' );
	wp_dequeue_style ( 'woocommerce-smallscreen' );
	wp_dequeue_style ( 'woocommerce-general' );
	wp_dequeue_style ( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
	
	//BuddyPress
	wp_dequeue_style( 'bp-parent-css' );
	wp_dequeue_style( 'bp-parent-css-rtl' );
	wp_dequeue_style( 'bp-legacy-css' );
	
	//bbPress
	wp_dequeue_style( 'bbp-default' );
	wp_dequeue_style( 'bbp-default-rtl' );
	
	//Taqyeem
	//wp_dequeue_style( 'taqyeem-style' );
	if( !is_admin() )
		wp_dequeue_style( 'taqyeem-fontawesome' );
	
	//Instagramy
	wp_dequeue_style( 'tie-insta-ilightbox-skin' );

}


/*-----------------------------------------------------------------------------------*/
# Avoid Instagramy Plugin from loading IlightBox
/*-----------------------------------------------------------------------------------*/
function tie_instagram_plugin_force_avoid_ilightbox(){
	return false;
}
add_filter('tie_instagram_force_avoid_ilightbox', 'tie_instagram_plugin_force_avoid_ilightbox');


/*-----------------------------------------------------------------------------------*/
# Enqueue Fonts From Google
/*-----------------------------------------------------------------------------------*/
function tie_enqueue_font ( $got_font) {
	if ($got_font) {
	
		$char_set = '';
		if( tie_get_option('typography_latin_extended') || tie_get_option('typography_cyrillic') ||
		tie_get_option('typography_cyrillic_extended') || tie_get_option('typography_greek') ||
		tie_get_option('typography_greek_extended') || tie_get_option('typography_vietnamese') || tie_get_option('typography_khmer') ){

		
			$char_set = '&subset=latin';
			if( tie_get_option('typography_latin_extended') ) 
				$char_set .= ',latin-ext';
			if( tie_get_option('typography_cyrillic') )
				$char_set .= ',cyrillic';
			if( tie_get_option('typography_cyrillic_extended') )
				$char_set .= ',cyrillic-ext';
			if( tie_get_option('typography_greek') )
				$char_set .= ',greek';
			if( tie_get_option('typography_greek_extended') )
				$char_set .= ',greek-ext';
			if( tie_get_option('typography_khmer') )
				$char_set .= ',khmer';
			if( tie_get_option('typography_vietnamese') )
				$char_set .= ',vietnamese';
		}
		
		$font_pieces = explode(":", $got_font);
		
		$font_name = $font_pieces[0];
		$font_type = $font_pieces[1];
		
		if( $font_type == 'non-google' ){
		
			// Do Nothing :)
			
		}elseif( $font_type == 'early-google'){
			$font_name = str_replace (" ","", $font_pieces[0] );
			$protocol = is_ssl() ? 'https' : 'http';
			wp_enqueue_style( $font_name , $protocol.'://fonts.googleapis.com/earlyaccess/'.$font_name);
			
		}else{
			$font_name = str_replace (" ","+", $font_pieces[0] );
			$font_variants = str_replace ("|",",", $font_pieces[1] );
			$protocol = is_ssl() ? 'https' : 'http';
			wp_enqueue_style( $font_name , $protocol.'://fonts.googleapis.com/css?family='.$font_name . ':' . $font_variants.$char_set );
		}
	}
}


/*-----------------------------------------------------------------------------------*/
# Get Font Name
/*-----------------------------------------------------------------------------------*/
function tie_get_font ( $got_font ) {
	if ($got_font) {
		$font_pieces = explode(":", $got_font);
		$font_name = $font_pieces[0];
		$font_name = str_replace('&quot;' , '"' , $font_pieces[0] );
		if (strpos($font_name, ',') !== false) 
			return $font_name;
		else
			return "'".$font_name."'";
	}
}


/*-----------------------------------------------------------------------------------*/
# Typography Elements Array
/*-----------------------------------------------------------------------------------*/
$custom_typography = array(
	"body"												=>		"typography_general",
	".logo h1 a, .logo h2 a"							=>		"typography_site_title",
	".logo span"										=>		"typography_tagline",
	".top-nav, .top-nav ul li a "						=>		"typography_top_menu",
	"#main-nav, #main-nav ul li a"						=>		"typography_main_nav",
	".breaking-news span.breaking-news-title"			=>		"typography_breaking_news",
	".page-title"										=>		"typography_page_title",
	".post-title"										=> 		"typography_post_title",
	"h2.post-box-title, h2.post-box-title a"			=> 		"typography_post_title_boxes",
	"h3.post-box-title, h3.post-box-title a"			=> 		"typography_post_title2_boxes",
	"p.post-meta, p.post-meta a"						=> 		"typography_post_meta",
	"body.single .entry, body.page .entry"				=> 		"typography_post_entry",
	"blockquote p"										=> 		"typography_blockquotes",
	".widget-top h4, .widget-top h4 a"					=> 		"typography_widgets_title",
	".footer-widget-top h4, .footer-widget-top h4 a"	=> 		"typography_footer_widgets_title",
	"#featured-posts .featured-title h2 a"				=> 		"typography_grid_slider_title",
	".ei-title h2, .slider-caption h2 a, .content .slider-caption h2 a, .slider-caption h2, .content .slider-caption h2, .content .ei-title h2"				=> 		"typography_slider_title",
	".cat-box-title h2, .cat-box-title h2 a, .block-head h3, #respond h3, #comments-title, h2.review-box-header, .woocommerce-tabs .entry-content h2, .woocommerce .related.products h2, .entry .woocommerce h2, .woocommerce-billing-fields h3, .woocommerce-shipping-fields h3, #order_review_heading, #bbpress-forums fieldset.bbp-form legend, #buddypress .item-body h4, #buddypress #item-body h4"			=> 		"typography_boxes_title"
);
	
	
/*-----------------------------------------------------------------------------------*/
# Get Custom Typography
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'tie_typography');
function tie_typography(){
	global $custom_typography;

	foreach( $custom_typography as $selector => $value){
		$option = tie_get_option( $value );
		if( !empty($option['font']))
			tie_enqueue_font( $option['font'] );
	}
	
	tie_enqueue_font( 'Droid Sans:regular|700' );

}


/*-----------------------------------------------------------------------------------*/
# Custom Theme Color
/*-----------------------------------------------------------------------------------*/
function tie_theme_color( $color ){ ?>
#main-nav,
.cat-box-content,
#sidebar .widget-container,
.post-listing,
#commentform {
	border-bottom-color: <?php echo $color; ?>;
}
	
.search-block .search-button,
#topcontrol,
#main-nav ul li.current-menu-item a,
#main-nav ul li.current-menu-item a:hover,
#main-nav ul li.current_page_parent a,
#main-nav ul li.current_page_parent a:hover,
#main-nav ul li.current-menu-parent a,
#main-nav ul li.current-menu-parent a:hover,
#main-nav ul li.current-page-ancestor a,
#main-nav ul li.current-page-ancestor a:hover,
.pagination span.current,
.share-post span.share-text,
.flex-control-paging li a.flex-active,
.ei-slider-thumbs li.ei-slider-element,
.review-percentage .review-item span span,
.review-final-score,
.button,
a.button,
a.more-link,
#main-content input[type="submit"],
.form-submit #submit,
#login-form .login-button,
.widget-feedburner .feedburner-subscribe,
input[type="submit"],
#buddypress button,
#buddypress a.button,
#buddypress input[type=submit],
#buddypress input[type=reset],
#buddypress ul.button-nav li a,
#buddypress div.generic-button a,
#buddypress .comment-reply-link,
#buddypress div.item-list-tabs ul li a span,
#buddypress div.item-list-tabs ul li.selected a,
#buddypress div.item-list-tabs ul li.current a,
#buddypress #members-directory-form div.item-list-tabs ul li.selected span,
#members-list-options a.selected,
#groups-list-options a.selected,
body.dark-skin #buddypress div.item-list-tabs ul li a span,
body.dark-skin #buddypress div.item-list-tabs ul li.selected a,
body.dark-skin #buddypress div.item-list-tabs ul li.current a,
body.dark-skin #members-list-options a.selected,
body.dark-skin #groups-list-options a.selected,
.search-block-large .search-button,
#featured-posts .flex-next:hover,
#featured-posts .flex-prev:hover,
a.tie-cart span.shooping-count,
.woocommerce span.onsale,
.woocommerce-page span.onsale ,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
#check-also-close,
a.post-slideshow-next,
a.post-slideshow-prev,
.widget_price_filter .ui-slider .ui-slider-handle,
.quantity .minus:hover,
.quantity .plus:hover,
.mejs-container .mejs-controls .mejs-time-rail .mejs-time-current,
#reading-position-indicator  {
	background-color:<?php echo $color; ?>;
}

::-webkit-scrollbar-thumb{
	background-color:<?php echo $color; ?> !important;
}
	
#theme-footer,
#theme-header,
.top-nav ul li.current-menu-item:before,
#main-nav .menu-sub-content ,
#main-nav ul ul,
#check-also-box { 
	border-top-color: <?php echo $color; ?>;
}
	
.search-block:after {
	border-right-color:<?php echo $color; ?>;
}

body.rtl .search-block:after {
	border-left-color:<?php echo $color; ?>;
}

#main-nav ul > li.menu-item-has-children:hover > a:after,
#main-nav ul > li.mega-menu:hover > a:after {
	border-color:transparent transparent <?php echo $color; ?>;
}
	
.widget.timeline-posts li a:hover,
.widget.timeline-posts li a:hover span.tie-date {
	color: <?php echo $color; ?>;
}

.widget.timeline-posts li a:hover span.tie-date:before {
	background: <?php echo $color; ?>;
	border-color: <?php echo $color; ?>;
}

#order_review,
#order_review_heading {
	border-color: <?php echo $color; ?>;
}

<?php
}


/*-----------------------------------------------------------------------------------*/
# Tie Wp Head
/*-----------------------------------------------------------------------------------*/
add_action('wp_head', 'tie_wp_head');
function tie_wp_head() {
	global $custom_typography, $is_IE; 
	?>
	
<!--[if IE]>
<script type="text/javascript">jQuery(document).ready(function (){ jQuery(".menu-item").has("ul").children("a").attr("aria-haspopup", "true");});</script>
<![endif]-->	
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() ?>/js/html5.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/selectivizr-min.js"></script>
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() ?>/css/ie9.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() ?>/css/ie8.css" />
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() ?>/css/ie7.css" />
<![endif]-->

<?php
if( $is_IE ){
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
}
?>

<?php
if( tie_get_option( 'disable_responsive' ) ){
	echo '<meta name="viewport" content="width=1045" />';
}else{
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0" />';
}
?>

<?php if( tie_get_option('apple_iPad_retina') ) : ?>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo tie_get_option('apple_iPad_retina') ?>" />
<?php endif; ?>
<?php if( tie_get_option('apple_iphone_retina') ) : ?>
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo tie_get_option('apple_iphone_retina') ?>" />
<?php endif; ?>
<?php if( tie_get_option('apple_iPad') ) : ?>
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo tie_get_option('apple_iPad') ?>" />
<?php endif; ?>
<?php if( tie_get_option('apple_iphone') ) : ?>
<link rel="apple-touch-icon-precomposed" href="<?php echo tie_get_option('apple_iphone') ?>" />
<?php endif; ?>

<?php
// Custom Header Code
echo htmlspecialchars_decode( tie_get_option('header_code') ) , "\n";

?>

<style type="text/css" media="screen"> 

<?php //Fonts
foreach( $custom_typography as $selector => $value){
	$option = tie_get_option( $value );
	if( !empty( $option['font'] ) || !empty( $option['color'] ) || !empty( $option['size'] ) || !empty( $option['weight'] ) || !empty( $option['style'] ) ) {
	
	echo $selector."{\n"; ?>
<?php if( !empty( $option['font'] ) )
	echo "	font-family: ". tie_get_font( $option['font']  ).";\n"?>
<?php if( !empty( $option['color'] ) )
	echo "	color :". $option['color'].";\n"?>
<?php if( !empty( $option['size'] ) )
	echo "	font-size : ".$option['size']."px;\n"?>
<?php if( !empty( $option['weight'] ) )
	echo "	font-weight: ".$option['weight'].";\n"?>
<?php if( !empty( $option['style'] ) )
	echo "	font-style: ". $option['style'].";\n"?>
}

<?php }
}



// Modern Scrollbar  -------------------------------------------------------------- */
if(tie_get_option('modern_scrollbar')) : ?>
::-webkit-scrollbar {
	width: 8px;
	height:8px;
}

<?php endif;



//highlighted color  --------------------------------------------------------------------------- */
if( tie_get_option( 'highlighted_color' ) ): ?>

::-moz-selection { background: <?php echo tie_get_option( 'highlighted_color' ) ?>;}
::selection { background: <?php echo tie_get_option( 'highlighted_color' ) ?>; }
<?php endif;



// Theme Skin --------------------------------------------------------------------- */
if( tie_get_option( 'global_color' ) )
	tie_theme_color( tie_get_option( 'global_color' ) );

elseif(tie_get_option('theme_skin'))
	tie_theme_color(tie_get_option('theme_skin'));
	


// Bg Pattern  ------------------------------------------------------------------------- */
if( tie_get_option('background_type') == 'pattern' ):

	if( tie_get_option('background_pattern') || tie_get_option('background_pattern_color') ) : ?>
	
body {
<?php if( tie_get_option('background_pattern_color') ){ ?>
	background-color: <?php echo tie_get_option('background_pattern_color') ?> !important;
<?php } if( tie_get_option('background_pattern') ){ ?>
	background-image : url(<?php echo get_template_directory_uri(); ?>/images/patterns/<?php echo tie_get_option('background_pattern') ?>.png);
<?php } ?>
	background-position: top center;
}
<?php 
	endif;


	
// Custom Bg  ------------------------------------------------------------------------- */
elseif( tie_get_option('background_type') == 'custom' ):
	$bg = tie_get_option( 'background' ); 
	
	if( tie_get_option('background_full') ): ?>
	
.background-cover{ 
	background-color:<?php echo $bg['color'] ?> !important;
	background-image : url('<?php echo $bg['img'] ?>') !important;<?php echo "\n"; ?>
	filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $bg['img'] ?>',sizingMethod='scale') !important;<?php echo "\n"; ?>
	-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $bg['img'] ?>',sizingMethod='scale')" !important;<?php echo "\n"; ?>
}
	<?php else: ?>

body{
	<?php if( !empty( $bg['color'] ) ){ ?>background-color:<?php echo $bg['color'] ?> !important; <?php echo "\n"; } ?>
	<?php if( !empty( $bg['img'] ) ){ ?>background-image: url('<?php echo $bg['img'] ?>') !important; <?php echo "\n"; } ?>
	<?php if( !empty( $bg['repeat'] ) ){ ?>background-repeat:<?php echo $bg['repeat'] ?> !important; <?php echo "\n"; } ?>
	<?php if( !empty( $bg['attachment'] ) ){ ?>background-attachment:<?php echo $bg['attachment'] ?> !important; <?php echo "\n"; } ?>
	<?php if( !empty( $bg['hor'] ) || !empty( $bg['ver'] ) ){ ?>background-position:<?php echo $bg['hor'] ?> <?php echo $bg['ver'] ?> !important; <?php echo "\n"; } ?>
}
	<?php endif;
endif; 



// Links  ------------------------------------------------------------------------- */
$links_styling = array (
	"a"			=>	array (	'color' => 'links_color', 'decoration'=> 'links_decoration'	),
	"a:hover"	=>	array (	'color' => 'links_color_hover', 'decoration'=> 'links_decoration_hover'),
	"body.single .post .entry a, body.page .post .entry a"				=>	array ( 'color' => 'post_links_color', 'decoration'=> 'post_links_decoration' ),
	"body.single .post .entry a:hover, body.page .post .entry a:hover"	=>	array ( 'color' => 'post_links_color_hover', 'decoration'=> 'post_links_decoration_hover' )
);

foreach ( $links_styling as $selector => $values ){
	if( tie_get_option( $values[ "color" ] ) || tie_get_option( $values[ "decoration" ] ) ){
	
		echo "\n".$selector." {\n";
		if( tie_get_option( $values[ "color" ] ) ) echo "	color: ".tie_get_option( $values[ "color" ] ).";\n";
		if( tie_get_option( $values[ "decoration" ] ) ) echo "	text-decoration: ".tie_get_option( $values[ "decoration" ] ).";\n";
		echo '}
		';
		
	}
}



// Colors  ------------------------------------------------------------------------- */
$colors_styling = array (
	".top-nav ul li a:hover, .top-nav ul li:hover > a, .top-nav ul :hover > a , .top-nav ul li.current-menu-item a"	 => 'topbar_links_color_hover',
	"#main-nav ul li a:hover, #main-nav ul li:hover > a, #main-nav ul :hover > a , #main-nav  ul ul li:hover > a, #main-nav  ul ul :hover > a"														 => 'nav_links_color_hover',
	"#main-nav ul li a, #main-nav ul ul a, #main-nav ul.sub-menu a, #main-nav ul li.current_page_parent ul a, #main-nav ul li.current-menu-item ul a, #main-nav ul li.current-menu-parent ul a, #main-nav ul li.current-page-ancestor ul a" => 'nav_links_color',
	"#main-nav ul li.current-menu-item a, #main-nav ul li.current_page_parent a"			=> 'nav_current_links_color',
	".today-date "									=> 'todaydate_color',
	".top-nav ul li a , .top-nav ul ul a"			=> 'topbar_links_color',
	".footer-widget-top h4"							=> 'footer_title_color',
	"#theme-footer a"							=> 'footer_links_color',
	"#theme-footer a:hover"					=> 'footer_links_color_hover',
);

foreach ( $colors_styling as $selector => $values ){
	if( tie_get_option( $values) ){
		echo "\n".$selector." {\n";
		echo "	color: ".tie_get_option( $values ).";\n";
		echo '}
		';
	}
}



// Background  ------------------------------------------------------------------------- */
$bg_styling = array (
	".top-nav, .top-nav ul ul"	 => 'topbar_background',
	"#theme-header"		 => 'header_background',
	"#theme-footer"		 => 'footer_background',
	".cat-box-content, #sidebar .widget-container, .post-listing, .column2 li.first-news, .wide-box li.first-news, #commentform " => 'boxes_bg',

);

foreach ( $bg_styling as $selector => $values ){
	$item_bg = tie_get_option( $values );
	if( !empty( $item_bg['img']) || !empty( $item_bg['color'] ) ) {
echo "\n".$selector." {\n"; ?>
	<?php if( !empty( $item_bg['color'] ) ){ ?>background-color:<?php echo $item_bg['color'] ?> !important; <?php echo "\n"; } ?>
	<?php if( !empty( $item_bg['img'] ) ){ ?>background-image: url('<?php echo $item_bg['img'] ?>') !important; <?php echo "\n"; } ?>
	<?php if( !empty( $item_bg['repeat'] ) ){ ?>background-repeat:<?php echo $item_bg['repeat'] ?> !important; <?php echo "\n"; } ?>
	<?php if( !empty( $item_bg['attachment'] ) ){ ?>background-attachment:<?php echo $item_bg['attachment'] ?> !important; <?php echo "\n"; } ?>
	<?php if( !empty( $item_bg['hor'] ) || !empty( $item_bg['ver'] ) ){ ?>background-position:<?php echo $item_bg['hor'] ?> <?php echo $item_bg['ver'] ?> !important; <?php echo "\n"; } ?>
}

<?php
	}
}



// Custom Social Networks colors  ----------------------------------------------------------------- */
for( $i=1 ; $i<=5 ; $i++ ){ 
	if ( tie_get_option( "custom_social_icon_$i" ) && tie_get_option( "custom_social_url_$i" ) && tie_get_option( "custom_social_color_$i" ) ) {?>

.social-icons.social-colored .<?php echo tie_get_option( "custom_social_icon_$i" ) ?>:before {
	background: <?php echo tie_get_option( "custom_social_color_$i" ) ?> ;
}
<?php
	}
}	
		
		
// Main Nav Styles  ----------------------------------------------------------------- */
if( tie_get_option( 'main_nav_background' ) || tie_get_option( 'main_nav_border' ) ): ?>
#main-nav {
	<?php if( tie_get_option( 'main_nav_background' ) ) echo 'background: '.tie_get_option( 'main_nav_background' ).';'; ?>
	
	<?php if( tie_get_option( 'main_nav_border' ) ) echo 'box-shadow: inset -1px -5px 0px -1px '.tie_get_option( 'main_nav_border' ).';'; ?>
	
}
<?php endif;



// Main Nav Sub menus  -------------------------------------------------------------- */
if( tie_get_option( 'sub_nav_background' )): ?>

#main-nav ul ul, #main-nav ul li.mega-menu .mega-menu-block { background-color:<?php echo tie_get_option( 'sub_nav_background' ).' !important;';?>}<?php echo "\n"; ?>
<?php endif; 


// Separators  --------------------------------------------------------------------- */
if( tie_get_option( 'nav_sep1' ) ): ?>

#main-nav ul li {
	border-color: <?php echo tie_get_option( 'nav_sep1' ); ?>;
}

#main-nav ul ul li, #main-nav ul ul li:first-child {
	border-top-color: <?php echo tie_get_option( 'nav_sep1' ); ?>;
}

#main-nav ul li .mega-menu-block ul.sub-menu {
	border-bottom-color: <?php echo tie_get_option( 'nav_sep1' ); ?>;
}

<?php endif;

if( tie_get_option( 'nav_sep2' ) ): ?>
#main-nav ul li a {
	border-left-color: <?php echo tie_get_option( 'nav_sep2' ); ?>;
}

#main-nav ul ul li, #main-nav ul ul li:first-child {
	border-bottom-color: <?php echo tie_get_option( 'nav_sep2' ); ?>;
}
<?php endif; 



// Content Bg  --------------------------------------------------------------------- */
$content_bg = tie_get_option( 'main_content_bg' ); 
if( !empty( $content_bg['img']) || !empty( $content_bg['color'] ) ): 
	$content_class = "\n#wrapper, #wrapper.wide-layout, #wrapper.boxed-all";
	if( tie_get_option( 'theme_layout' ) == 'boxed' ) $content_class = "\n#main-content" ;
	
	echo $content_class ?> { background:<?php if( !empty($content_bg['color']) ) echo $content_bg['color'] ?> <?php if( !empty($content_bg['img']) ){ ?>url('<?php echo $content_bg['img'] ?>')<?php } ?> <?php if( !empty($content_bg['repeat']) ) echo $content_bg['repeat'] ?> <?php if( !empty($content_bg['attachment']) ) echo $content_bg['attachment'] ?> <?php if( !empty($content_bg['hor']) ) echo $content_bg['hor'] ?> <?php if( !empty($content_bg['ver']) ) echo $content_bg['ver'] ?>;}<?php echo "\n";
endif;



// Breaking News  --------------------------------------------------------------------- */
if( tie_get_option( 'breaking_title_bg' ) ): ?>

.breaking-news span.breaking-news-title {<?php if( tie_get_option( 'breaking_title_bg' ) ) echo 'background: '.tie_get_option( 'breaking_title_bg' ).';'; ?>}
<?php endif;




// Show Cat Colors in the News Blocks  -------------------------------------------------- */ 
if( tie_get_option('homepage_cats_colors') ){

	$tie_cats_options = get_option( 'tie_cats_options' );
	if( !empty( $tie_cats_options ) && is_array( $tie_cats_options ) ){
		foreach ( $tie_cats_options as $cat => $options) {
			if( !empty( $options[ 'cat_color' ] ) ){
				$cat_custom_color = $options[ 'cat_color' ] ; ?>
			
.tie-cat-<?php echo $cat ?> a.more-link {background-color:<?php echo $cat_custom_color; ?>;}
.tie-cat-<?php echo $cat ?> .cat-box-content {border-bottom-color:<?php echo $cat_custom_color;?>; }
			<?php
			}
		}
	}
}



// Categories Custom Bg and color  ----------------------------------------------------- */
global $post ;
if( is_category() || is_singular() || ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ): 
	if( is_category() ){

		$tie_cats_options = get_option( 'tie_cats_options' );
		$category_id	  = get_query_var('cat') ;

		if( !empty( $tie_cats_options[ $category_id ] ) )
			$cat_options	  = $tie_cats_options[ $category_id ];
		
		if( !empty($cat_options['cat_background']) )
			$cat_bg = $cat_options['cat_background'];
		
		if( !empty($cat_options['cat_color']) )
			$cat_color = $cat_options['cat_color'];
		
		if( !empty($cat_options['cat_background_full']) )
			$cat_full = $cat_options['cat_background_full'];
	}
	if( is_singular() || ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ){
		$current_ID = $post->ID;
		if( function_exists( 'is_woocommerce' ) && is_woocommerce() ) $current_ID = woocommerce_get_page_id('shop');
		
		$get_meta = get_post_custom( $current_ID );
		
		if( !empty( $get_meta["post_color"][0] ) )
			$cat_color = $get_meta["post_color"][0];
		
		if( !empty( $get_meta["post_background"][0] ) )
			$cat_bg = unserialize($get_meta["post_background"][0]);
		
		if( !empty( $get_meta["post_background_full"][0] ) )
			$cat_full = $get_meta['post_background_full'];
		
		if( is_single() ){
			$tie_cats_options = get_option( 'tie_cats_options' );
			$categories 	  = get_the_category( $current_ID );
			$category_id	  = $categories[0]->term_id;

			if( !empty($tie_cats_options[ $category_id ]) )
				$cat_options	  = $tie_cats_options[ $category_id ];

			if( empty($cat_color) && !empty( $cat_options['cat_color'] ) ) $cat_color = $cat_options['cat_color'];
			if( empty($cat_full) && !empty( $cat_options['cat_background_full'] ) ) $cat_full = $cat_options['cat_background_full'];
			if( empty($cat_bg['color']) && empty($cat_bg['img']) && !empty( $cat_options['cat_background'] ) )  $cat_bg = $cat_options['cat_background'];
		}
	}

if( !empty( $cat_bg['color'] ) || !empty( $cat_bg['img'] ) ):
	if( $cat_full  ): ?>
.background-cover{<?php echo "\n"; ?>
	background-color:<?php echo $cat_bg['color'] ?> !important;
	background-image : url('<?php echo $cat_bg['img'] ?>') !important;<?php echo "\n"; ?>
	filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $cat_bg['img'] ?>',sizingMethod='scale') !important;<?php echo "\n"; ?>
	-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $cat_bg['img'] ?>',sizingMethod='scale')" !important;<?php echo "\n"; ?>
}
<?php else: ?>
body{
<?php if( !empty( $cat_bg['color'] ) ){ ?>background-color:<?php echo $cat_bg['color'] ?> !important; <?php echo "\n"; } ?>
<?php if( !empty( $cat_bg['img'] ) ){ ?>background-image: url('<?php echo $cat_bg['img'] ?>') !important; <?php echo "\n"; } ?>
<?php if( !empty( $cat_bg['repeat'] ) ){ ?>background-repeat:<?php echo $cat_bg['repeat'] ?> !important; <?php echo "\n"; } ?>
<?php if( !empty( $cat_bg['attachment'] ) ){ ?>background-attachment:<?php echo $cat_bg['attachment'] ?> !important; <?php echo "\n"; } ?>
<?php if( !empty( $cat_bg['hor'] ) || !empty( $cat_bg['ver'] ) ){ ?>background-position:<?php echo $cat_bg['hor'] ?> <?php echo $cat_bg['ver'] ?> !important; <?php echo "\n"; } ?>
}<?php echo "\n"; ?>
<?php endif;
endif; 
if( !empty($cat_color) ) tie_theme_color( $cat_color ); ?>
<?php endif; 




$pre_code = array("<pre>", "</pre>");

// Custom CSS Codes  ----------------------------------------------------- */
echo "\n".str_replace( $pre_code , "", htmlspecialchars_decode( tie_get_option('css')) ); 

if( tie_get_option('css_tablets') ) : ?>


@media only screen and (max-width: 985px) and (min-width: 768px){
<?php
	echo "\t".str_replace( $pre_code , "", htmlspecialchars_decode( tie_get_option('css_tablets')) ); 
?>

}

<?php endif;

if( tie_get_option('css_wide_phones') ) : ?>
@media only screen and (max-width: 767px) and (min-width: 480px){
<?php
	echo "\t".str_replace( $pre_code , "", htmlspecialchars_decode( tie_get_option('css_wide_phones')) ); 
?>

}

<?php endif;

if( tie_get_option('css_phones') ) : ?>
@media only screen and (max-width: 479px) and (min-width: 320px){
<?php
	echo "\t".str_replace( $pre_code , "", htmlspecialchars_decode( tie_get_option('css_phones')) ); 
?>

}

<?php endif; ?>
</style> 

<?php 

}

?>

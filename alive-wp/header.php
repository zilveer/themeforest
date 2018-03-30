<?php
/**
 * The Header for our theme.
 *
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<link rel="icon" href="<?php echo of_get_option("favicon_url"); ?>" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo of_get_option("favicon_url"); ?>" type="image/x-icon">

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=1000" />
<title><?php wp_title(''); ?><?php if ( is_front_page() || is_home() ) { bloginfo('name');?> | <?php bloginfo('description');} else { ?> | <?php bloginfo('name'); } ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script type="text/javascript">
//THEME SETUP//////////////////////////////////////////////////////////////
/*init-------------------------------------------------------------------*/
var hoverIconWidth = 115; 
var homePageURL = "<?php echo home_url(); ?>";
var themeURL = "<?php echo get_stylesheet_directory_uri(); ?>";
var firstPaginate = true;
var isMobile = <?php echo IS_MOBILE; ?>;
var isMusic = <?php echo of_get_option("music_toggle"); ?>;
var musicAutoplay = <?php echo of_get_option("music_autoplay"); ?>;
<?php 

$music_array = array();
for($i = 1; $i <= of_get_option("music_num"); $i++)
{
	$music_array[] = '{ mp3 :"' . of_get_option("music_url_mp3" . $i) . '", oga: "' . of_get_option("music_url_ogg" . $i) . '"}';
}

$music_array_string = implode("," , $music_array);
?>
var musicArray = [<?php echo $music_array_string; ?>];

/*tiles-------------------------------------------------------------------*/
var tileSlideSpeed = <?php echo of_get_option("tile_slide_speed"); ?>;
var tileSpeed = <?php echo of_get_option("tile_update_speed"); ?>;
var tileSmall = 100; 
var tileLarge = <?php echo of_get_option("home_tile_height"); ?>;
var tileLargeFont = 30;
var tileSmallFont = 14;
var animateTiles = <?php echo of_get_option("tile_animate"); ?>;

/*supersized-------------------------------------------------------------*/
var pauseOnContent = <?php echo of_get_option("slider_pause"); ?>; 

/*twitter details--------------------------------------------------------*/
var twitterAccount = "<?php echo of_get_option("twitter_username"); ?>"; 
var numTweets = "<?php echo of_get_option("twitter_posts"); ?>"; 

/*Fancybox details----------------------------------------------------------*/
var lightboxTransition = 'fade'; 
var overlayOpacity = 0.8; 
var overlayColor = '#000'; //Fancybox overlay color	
var videoWidth = 750; 
var videoHeight = 385; 

/*toggle/fade speeds-----------------------------------------------------*/
var hoverFadeSpeed = <?php echo of_get_option("hover_fade"); ?>; 
var pageFadeSpeed = <?php echo of_get_option("page_fade"); ?>; 
var menuToggleSpeed = <?php echo of_get_option("menu_speed"); ?>; 
var menuEase = '<?php echo of_get_option("menu_easing"); ?>';
var pageEase = '<?php echo of_get_option("page_easing"); ?>'; 

/*Contact form messages----------------------------------------------------*/
var formError = "<?php echo of_get_option("form_error"); ?>";
var formWarning = "<?php echo of_get_option("form_warning"); ?>";
var formSuccess = "<?php echo of_get_option("form_success"); ?>";
var formReload = "<?php echo of_get_option("form_message"); ?>";

//END SETUP//////////////////////////////////////////////////////////////////
</script>


<?php
	wp_head();
?>

<style type="text/css">
#preloader-logo{background: url("<?php echo of_get_option("preloader_image"); ?>")  top center no-repeat;}
#ajaxloader-logo{background: url("<?php echo of_get_option("preloader_image"); ?>")  top center no-repeat;}
#contentWrapper a,div.product span.price, #content div.product span.price, div.product p.price, #content div.product p.price,ul.products li.product .price {color: <?php echo of_get_option("theme_color") ?>; }
#reviews a.button {color: <?php echo of_get_option("theme_color") ?> !important; }
.product .onsale {background:<?php echo of_get_option("theme_color") ?>;}
ul.jp-controls li a:hover {background-color: <?php echo of_get_option("theme_color") ?>; }
<?php  $menu_count = count_menu_items(); 
		$nav_menu_height = ceil($menu_count / 2) * 110  + 210; ?>
#tileBlock.nav {height:<?php echo $nav_menu_height; ?>px; }		
#tileBlock .tile.home {width:<?php echo of_get_option("home_tile_width"); ?>px; height:<?php echo of_get_option("home_tile_height"); ?>px;}
#tileBlock .tile img.home { width:<?php echo of_get_option("home_tile_width"); ?>px; height:<?php echo of_get_option("home_tile_height"); ?>px;}
<?php
if($menu_count > 0) {
	for ($i=1; $i <= $menu_count; $i++){
		echo '#tileBlock #tile'.$i.'.home {top:'. of_get_option("nav_tile_".$i."_top") .'px; left:'.of_get_option("nav_tile_".$i."_left").'px;}';
		echo "\n";
	}		
}
?>
<?php echo of_get_option("custom_css"); ?>
</style>


<script type='text/javascript'>
jQuery(document).ready(function($) {
	
	<?php 
	$args = array( 	'post_type' => 'gallery',
					'meta_key' => THEME_METABOX . 'homepage_gallery',
					'meta_value' => 'on',
					'posts_per_page' => 1);
	
	query_posts($args); 
	
	//global $wp_query;
		
	if (have_posts()) : 
	?>
	$.supersized({

            slide_interval: <?php echo of_get_option("slider_interval"); ?>,
            transition: <?php echo of_get_option("slider_transition"); ?>,
            transition_speed: <?php echo of_get_option("slider_speed"); ?>,
            performance: 1,

            slides 	:  	[			// Slideshow Images
	
	<?php
	
	while (have_posts()) : the_post(); 
	
	$attachments = get_children(array('post_parent' => $post->ID,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'menu_order',
					'numberposts' => -1));
	
	$slide_count = 1;
	$number_of_slides = ($attachments) ? sizeof($attachments) : 0;				
	
	
	foreach($attachments as $att_id => $attachment) :
	
		$image_url = wp_get_attachment_image_src($attachment->ID, 'full');
	?>	
	{image : '<?php echo $image_url[0] ?>'}<?php if ($slide_count != $number_of_slides) : ?>,<?php endif; ?>
	<?php $slide_count++; endforeach; ?> ]
	
	<?php endwhile; ?>
	});
	<?php 
	
	endif; 
	
	wp_reset_query(); ?>
	
});
</script>
</head>

<body>
<?php if(of_get_option("image_overlay") == 1): ?><div id="overlay" class="bkgPattern<?php echo of_get_option("image_overlay_pattern");?>"></div><?php endif;?>
<div id="preloader"><div id="preloader-logo"></div></div>
<noscript>
	<style type="text/css">
	#wrapper {display:none;}
	</style>
  	<div id="noscript">
  		<h1>Please enable javascript</h1>
  		<p>It appears that your web browser does not support JavaScript, or you have temporarily disabled scripting. Either way, this site won't work without it. Please consult your web browser's documentation or IT administrator to enable javascript.
  	</div>
</noscript>
<!--start wrapper-->

		
<div id="wrapper" style="display:none;">
	<!--start tileBlock-->
	<div id="tileBlock">
		<!--start inner-->
		<div class="inner">
			<div id="logo">
				<a href="<?php echo home_url(); ?>">
					<img src="<?php echo of_get_option("logo_url"); ?>" alt="<?php bloginfo(''); ?>" />
					<p class="slogan">
						<?php echo of_get_option("slogan"); ?>
					</p>
				</a>
			</div>
			<?php 
  					
  					if(has_nav_menu("main-menu")) : echo theme_menu_output(); endif; 
				?>

	
		</div>
		<!--end inner-->
	</div>
	<!--end tileBlock-->




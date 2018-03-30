<?php
/**
 * The template for displaying about page with members
 *
 *
 */

/**
 Template Name: facebookpage
 */

 if (!class_exists('FacebookApiException')) {
	include_once('facebook.php');
}

$settings = get_option( "ntl_theme_settings" );

$facebook = new Facebook(array(
  'appId'  => $settings['ntl_facebook_api'],
  'secret' => $settings['ntl_facebook_secret'],
  'cookie' => true,
));

?>


<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title><?php wp_title(); ?></title>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/fstyle.css?<?php echo time()?>" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/musicstyles/musicplayer.css" />
    <link class="schanger" rel="stylesheet"  href="<?php echo get_template_directory_uri(); ?>/styles/f<?php echo $settings['ntl_theme_bg']; ?>.css" type="text/css" />
    
    <?php if ($settings['ntl_disable_audio'] != 'off') { ?>

	<script type="text/javascript">
		var CromaplaySettings = {
 				color 		: "#5692BC",
        		swfPath 	: "http://localhost:8888/player/js",
        		colorscheme : "Blue"
 			};
 	</script>

	<?php } ?>
       
    <script src="<?php echo home_url(); ?>/wp-includes/js/jquery/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.jplayer.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/m-app.js"></script>

    
    
    <?php
    $thevfont = str_replace(' ','+', $settings['ntl_font_primary']);
	$thesfont = str_replace(' ','+', $settings['ntl_font_secondary']);	
	$familycode = $settings['ntl_font_primary'];
	$familycode2 = $settings['ntl_font_secondary']; 
	?>
	<link href="http://fonts.googleapis.com/css?family=<?php echo $thevfont; ?>&v2" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=<?php echo $thesfont; ?>&v2" rel="stylesheet" type="text/css">
	<style>
	.smallfont, .songname, .songartist, .widget_netlabs_fpnews_widget h4, .widget_netlabs_fpnews_widget a, .singletweet_widget a{ font-family: '<?php echo $familycode2; ?>', arial, serif; font-weight: bold; }
	ul#header_menu a, .vfont, span.cdayname{ font-family: '<?php echo $familycode; ?>', arial, serif; font-weight: bold; }
	</style>
	
	<style>

		
		ul.morenews li a:hover, ul.morenews li a.current, ul.xoxo .widget-title, .latestnews_widget a, .singletweet_widget p a, div.jp-play-time, .latestnews_widget a
		{color: <?php echo $settings['ntl_theme_color']; ?>;}
		 .btitle, .gotocal a{background: <?php echo $settings['ntl_theme_color']; ?>;}
			
	</style>
	
	<!--[if IE 7.0]>
	<style>
		ul.morenews li a{line-height: 30px;}
	</style>
 	<![endif]-->
	
	<?php if ($settings['ntl_facebook_previewmode'] == "off") { ?>
	<style>html {height: 100%;overflow: hidden; /* Hides scrollbar in IE */}</style>
	<?php } ?>
		
  </head>
<body>
<div id="outer">
	
	
	<div id="menubg" class="clear">
		<div class="fbmenu">
			<?php if(has_nav_menu('facebook')){		
				wp_nav_menu( array( 'menu_class' => 'menu', 'menu_id' => 'header_menu', 'theme_location' => 'facebook', 'container' => '' ) );
			} ?>
			<div class="clear"></div>
		</div>		
	</div>
	
	
	<?php  $post_thumbnail_id = get_post_thumbnail_id( $post_id ); 
	$aimg = wp_get_attachment_image_src( $post_thumbnail_id, 'full', $icon );?> 
	
	
	
	<div id="fbbody" style="background: url(<?php echo $aimg[0]; ?>) top center;">
		<div class="clear"></div>
		<a class="logo clear" href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img class="logoimg" src="<?php echo $settings['ntl_theme_logo']; ?>"></a>	
		<div class="clear"></div>
		<ul class="morenews"></ul>				
	</div>
	
	
	<div id="fbbottomouter">
		<div id="fbbottom">
		<div class="fbleft">
			<?php if ( is_active_sidebar( 'fbleft' ) ) : ?>	
				<div id="primary" class="fbleft widget-area" role="complementary">					
					<ul class="xoxo">	
						<?php dynamic_sidebar( 'fbleft' ); ?>
					</ul>
				</div>
			<?php endif; ?>	
		</div>
		<div class="fbright">
			<?php if($settings['ntl_fb_showplayer']!= 'off'){ ?>
				<?php echo lets_get_musicplayer();  ?>
			<?php } ?>	
		</div>	
		<div class="clear"></div>		
		</div>
	</div>
</div>


<div id="fb-root"></div>


<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
	FB.init({
 		appId  : '<?php echo $settings['ntl_facebook_api']; ?>',
 		status : true, // check login status
 		cookie : true, // enable cookies to allow the server to access the session
 		xfbml  : true// parse XFBML
 	});
 	FB.Canvas.setAutoResize(7);
</script>
 
 
<script type="text/javascript">
	jQuery(document).ready(function($) {
		ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
		base_url = '<?php echo home_url(); ?>';
		ssl_url = '<?php echo $settings['ntl_facebook_ssl']; ?>';
		btpath = '<?php echo get_template_directory_uri(); ?>/images/';
		surl = '<?php echo get_template_directory_uri(); ?>/js/';
		<?php if ( $settings['ntl_auto_play'] != 'off') { ?>
		autop = true;
		<?php } else { ?>
		autop = false;	
		<?php } ?>	
	});			
</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/fcustoms.js" type="text/javascript"></script>



</body>
</html>
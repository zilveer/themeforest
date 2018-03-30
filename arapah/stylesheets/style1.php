<?php 

	header('Content-type: text/css'); 
	
	// Setup location of WordPress
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];

	// Access WordPress
	require_once( $path_to_wp.'/wp-load.php' );
	
	
	// ----------------------------------------------------
	//	Custom Style
	//-----------------------------------------------------
	$predefine_colors = of_get_option('predefine-colors');
	$predefine_color = of_get_option('predefine-color');
	
	// Color
	$default_font_color = of_get_option('default-font-color');
	$default_link_color = of_get_option('default-link-color');
	$default_hover_color = of_get_option('default-hover-color');
	$default_bg_color = of_get_option('default-bg-color');
	$tb_bg_color = of_get_option('tb-bg-color');
	$top_bg_image = of_get_option('top-bg-image');
	$bot_bg_image = of_get_option('bot-bg-image');
	$boxw_bg_color = of_get_option('boxw-bg-color');
	$submenu_bor_color = of_get_option('submenu-bor-color');
	$but_hov_bor_color = of_get_option('but-hov-bor-color');
	$but_big_bg = of_get_option('but-big-bg');
	$but_hov_bg = of_get_option('but-hov-bg');
	
	// Bottom
	$other_bottom_width = of_get_option('other-bottom-width');
	$special_bottom_width = of_get_option('special-bottom-width');
	$bottom_widget_float = of_get_option('bottom-widget-float');
	
?>	
@charset "UTF-8";
<?php if ( $predefine_colors ) : ?>
	@import "color-<?php echo $predefine_color ?>.css";
<?php else : ?>
	/* Basic ========================================= */
	body {
		background: <?php echo $default_bg_color ?>;
		font: 14px/22px "Trebuchet MS",Helvetica,sans-serif;
		color: <?php echo $default_font_color ?>;
	}

	/* #Header
	================================================== */
	.logo { font: 42px/50px 'AvantGarGotItcTEEDemRegular', "Trebuchet MS",Helvetica,sans-serif; }
	.logo span.logo:first-letter { font-size:130%; }
	.logo .desc { font:bold 11px/42px "Trebuchet MS",Helvetica,sans-serif; }
	h1.logo a { 
		display: block; 
		width: 346px; 	/*width of your logo image*/
		height: 75px; 	/*height of your logo image*/
		background: url(../images/logo.png) no-repeat;
	}
	h1.logo a.no-bg { display:inline; background:none; width:auto; height:auto; }
	#navigation, #promo .container { 
		background:#f8f8f8;
		box-shadow: 0 0 10px #ccc;
		-moz-box-shadow: 0 0 10px #ccc;
		-webkit-box-shadow: 0 0 10px #ccc;
	}

	/* #Font
	================================================== */
	h1, h2, h3, h4, h5, h6, #arapah-carousel a.Car-PostTitle, .carousel-widget a.Car-PostTitle, #promo .bigbutton a, h3.page-title, h2.page-title, .title a, .sidebar h3, 
	h2.post-title, h1.contentheading, .post-title a { font-family: 'AvantGarGotItcTEEDemRegular'; }
	#arapah-slider .info h2, #arapah-slider .ui-tabs-nav-item .title, #promo .text, #bottom h3, #navigation ul.menu > li > a, h1.page-title { font-family: 'AvianRegular'; }
	#arapah-carousel .post-meta { font-family: "Trebuchet MS",Helvetica,sans-serif; }
	#navigation a, #navigation ul.menu > li.active > a { color:<?php echo $default_font_color ?>; text-shadow:0 0 0 #000; }
	#time .time, #topest ul li a, #search-form .inputbox, #arapah-slider, #arapah-slider  .ui-tabs-nav-item .title, #bottom, #bottom a, #bottom h3, 
	#topest, article a.more-link span:hover, .widget_wysija_cont .wysija-submit:hover, #footer, #footer a, .sidebar .widget_wmp_widget h3, .container .button a:hover, 
	.sidebar .recent-posts-plus h3, #promo .bigbutton a, #nav-below .button a:hover, #navigation ul li:hover a, #navigation ul.menu ul.sub-menu a, 
	#nav-below .wp-pagenavi a:hover, #commentform input[type="submit"]:hover, .wpcf7  input[type="submit"]:hover, #slider .da-slide .da-link:hover { color:#fff; text-shadow:1px 1px 1px #000; }
	#arapah-carousel a.Car-PostTitle, h3.page-title, .title a, .sidebar h3, .widget_wysija_cont .form-valid-sub input.defaultlabels,
	article a.more-link span, .widget_wysija_cont .wysija-submit { text-shadow: 1px 1px 1px #fff; }
	.container a, #arapah-carousel a, #promo .text .like, h1.contentheading, p.trigger a, p.trigger a:hover,p.trigger.active a:hover, .portf h1.page-title { color:<?php echo $default_link_color ?>; }
	.container a:hover, #arapah-carousel a:hover, h1.contentheading:hover { color:<?php echo $default_hover_color ?>; }

	/* Background */ 
	#topest { background: url(../images/bg-topest.png) 50% 0 repeat-x; }
	#topest .justbg { background: <?php echo $top_bg_image ?>; }
	#promo .bigbutton a { background:<?php echo $but_big_bg ?>; }
	#promo .bigbutton a:hover { background-position: 50% 100%; }
	.sidebar .widget_wmp_widget h3, .sidebar .recent-posts-plus h3, #arapah-slider ul.ui-tabs-nav li.ui-tabs-selected a, #slider .da-slide .da-link, 
		#arapah-slider ul.ui-tabs-nav li.ui-tabs-active a, #slider .da-dots span, #slider .da-arrows span { background-color: <?php echo $boxw_bg_color ?>; }
	#bottom {background-image: <?php echo $bot_bg_image ?>;}
	#bottom .padding { background: url(../images/gradient.png) 0 100% repeat-x; }
	article a.more-link span, .widget_wysija_cont .wysija-submit, .button a, .wp-pagenavi span, .wp-pagenavi a, #commentform input[type="submit"], .wpcf7  input[type="submit"] { 
		background:#f7f6f4 url(../images/readon.png) 0 100% repeat-x; 
		border:1px solid #c6c6c6; }
	article a.more-link span:hover, .widget_wysija_cont .wysija-submit:hover, .button a:hover, #nav-below .wp-pagenavi a:hover, #commentform input[type="submit"]:hover, 
	.wpcf7  input[type="submit"]:hover { 
		background:<?php echo $but_hov_bg ?>; 
		border:1px solid <?php echo $but_hov_bor_color ?>; }
	#footer { background: url(../images/bg-footer.jpg) 50% 0 no-repeat; }
	#navigation ul li:hover, #navigation ul.sub-menu, #topest, #bottom, #footer, #arapah-slider li.ui-tabs-nav-item a:hover, #slider .da-slide .da-link:hover { background-color: <?php echo $tb_bg_color ?>;}
	#navigation ul.sub-menu li a:hover, #arapah-slider li.ui-tabs-nav-item a { background-color:#36291d; }
	#navigation > ul > li.current-menu-item > a, #navigation > ul > li.active > a { background: <?php echo $default_bg_color ?>; }
	h2.post-title, ul.post-data, h1.contentheading, .portf h1.page-title { background:url(../images/line.png) 100% 100% repeat-x; }

	#navigation ul.sub-menu li { border-top: 1px solid #2c2116; }
	#navigation ul.sub-menu li:first-child { border-top:none; }
		
<?php endif; ?>

	/* Width */
	#bottom .widget-1, #bottom .widget-2, #bottom .widget-3, #bottom .widget-4, #bottom .widget-5 { float:<?php echo $bottom_widget_float ?>; width:<?php echo $other_bottom_width ?>%; }
	#bottom .widget-last { width:<?php echo $special_bottom_width ?>%; }

	/* CSS3 Animation Effect */
	.ui-tabs-panel .slider_image{
	transition: all 0.5s linier 0.1s;
	-moz-transition: all 0.5s linier 0.1s; /* Firefox 4 */
	-webkit-transition: all 0.5s linier 0.1s; /* Safari and Chrome */
	-o-transition: all 0.5s linier 0.1s; /* Opera */
	}

	/*  #Mobile (Portrait)
	================================================== */

		/* Note: Design for a width of 320px */

		@media only screen and (max-width: 767px) {
		
			#bottom .widget-1, #bottom .widget-2, #bottom .widget-3, #bottom .widget-4, #bottom .widget-5 { width:100%; }

		}


	/* #Mobile (Landscape)
	================================================== */

		/* Note: Design for a width of 480px */

		@media only screen and (min-width: 480px) and (max-width: 767px) {
		
		<?php if ( $other_bottom_width > 50 ) : ?> 
			#bottom .widget-1, #bottom .widget-2, #bottom .widget-3, #bottom .widget-4, #bottom .widget-5 { width:100%; }
		<?php else : ?>
			#bottom .widget-1, #bottom .widget-2, #bottom .widget-3, #bottom .widget-4, #bottom .widget-5 { width:50%; }
		<?php endif; ?>
		
		}
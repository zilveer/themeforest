<?php
/**
 * @package WordPress
 * @subpackage CreativeZodiac_theme
 */
?>

 <?php 
   global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] =get_option( $value['id'] ); }
     $$value['id'] = stripslashes($$value['id']);
    } 
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php wp_head(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url');?>/style.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url');?>/jScrollPane.css"/>
<link type="text/css" media="screen" rel="stylesheet" href="<?php echo get_bloginfo('template_url');?>/colorbox.css" />
<title><?php bloginfo('name'); ?></title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/adress.js"></script>
<script type="text/javascript">
freshsettings = new Object();
freshsettings.introbox1_link = "<?php echo $cz_introbox1_link ?>";
freshsettings.introbox2_link = "<?php echo $cz_introbox2_link ?>";
freshsettings.introbox3_link = "<?php echo $cz_introbox3_link ?>";
freshsettings.landing_check = "<?php echo $cz_landing_check ?>";
freshsettings.landing_link = "<?php  echo $cz_landing_link ?>"; 
freshsettings.get_post = "<?php  echo $cz_getpost_link ?>";

freshsettings.prf_blognav = "<?php  echo $cz_prf_blognavthumb ?>";
freshsettings.prf_blogmedium = "<?php  echo $cz_prf_blogmedium ?>";
freshsettings.prf_galleryshine = "<?php  echo $cz_prf_galleryshine ?>";
freshsettings.prf_gallerybump = "<?php  echo $cz_prf_gallerybump ?>";
freshsettings.template_url = "<?php echo get_bloginfo('template_url'); ?>";
freshsettings.blog_url = "<?php echo get_bloginfo('url'); ?>";
var actual_location = window.location+"";

//var have_to_change = actual_location.indexOf('/#/') > -1;

</script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/disable.js"></script>


<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/jquery.colorbox.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/jScrollPane.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/jquery.preload.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/freshwork.js"></script>

<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/portfolio.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/tooltip.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/introboxes.js"></script>

<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/easing.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/jquery.livequery.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/changer.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/shine.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/navigation.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/cufon.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/custom_regular.font.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/custom.font.js"></script>

<script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/css_browser_selector.js"></script>



<script type="text/javascript">             //MyriadPro-Bold
Cufon.replace('.tooltip, h1, h2, h3, h4, h5, h6, h7, .comments_number, .meta_data, .blog_search_result_meta_data', { fontFamily: 'Myriad Pro Bold' });
Cufon.replace('#footer', {
fontFamily: 'Myriad Pro Bold',
	textShadow: '#000 1px 1px',
	hover:'true'
});
Cufon.replace('.nav_right, .port_prev_text, .port_next_text, .blog_menu_category_title, .go_btn_wrapper', {
	fontFamily: 'Myriad Pro Bold',
  textShadow: '#FFF 1px 1px',
	hover:'true'
});
Cufon.replace('.icon_desc, .blog_menu_category_title, .blog_menu_post_title', { fontFamily: 'Myriad Pro Regular' });
</script>
<!--[if lt IE 7.]>
    <script ype="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/DD_belatedPNG.js"></script>
    <script>
    DD_belatedPNG.fix('#content .introbox_about_shadow, #content .introbox_about, #content .introbox_about_active, #content .introbox_works_shadow, #content .introbox_works, #content .introbox_works_active, #content .introbox_contact_shadow, #content .introbox_contact, #content .introbox_contact_active, img, body, #bgimg, #header, #header .logo, #footer, .blur_left, .blur_right, #content_bg, .tooltip_left, .tooltip_center, .tooltip_right');
    </script>
<![endif]-->

</head>
<body>
	<div id="bgimg">
		<div id="wrapper">
			<div id="header">
				<div class="logo">
					<a href="<?php if($cz_landing_check == "true") echo $cz_landing_link; else echo "#";?>"><img src="<?php echo $cz_logo_url;?>" alt="Creative Zodiac" /></a>
				</div><!-- END "logo" -->
				      <?php 
              $styleaa = "";
            
                 if($cz_tooltip_vcardchb == false) $styleaa = 'style="display:none"';
             
               ?>
                <a href="<?php echo $cz_tooltip_link; ?>" class="vcard_header" <?php echo $styleaa?>>
                <?php if($cz_tooltip_iconlink == "") $sourceaa = get_bloginfo('template_url')."/gfx/vcard.png";
                      else $sourceaa =  $cz_tooltip_iconlink;
                 ?>
                	<img id="download_vcard" src="<?php echo $sourceaa; ?>" alt="Download My VCard" />
                </a><!-- END "vcard_header" -->
                <div class="tooltip" <?php echo $stylebb?>>
                    <div class="tooltip_left"></div>
                    <div class="tooltip_center">
                    <p><?php echo $cz_tooltip_text; ?></p>
                    </div>
                    <div class="tooltip_right"></div>
                </div><!-- END "tooltip" -->
         
			</div><!-- END "header" -->
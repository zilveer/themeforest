<?php
/**
 * Custom Layout,Font,Css
 *
 * @subpackage NewIdea
 * @since newidea 1.0
 */

 	global $newidea_options,$google_custom_fonts;
	
	if($google_custom_fonts == null) newidea_get_custom_font();
	
    header("Content-type: text/css; charset: UTF-8");

?>
    /* ----------------------------------------- */
    /*				CUSTOM COLOR
    /* ----------------------------------------- */
    
	/* selection */
    ::-moz-selection { background:<?php echo newidea_get_options_key('theme-bg-color') == "" ? '#000000' : '#'.newidea_get_options_key('theme-bg-color'); ?>; color: <?php echo newidea_get_options_key('theme-color') == "" ? '#ffffff' : '#'.newidea_get_options_key('theme-color'); ?>; text-shadow: none; }
	::selection { background:<?php echo newidea_get_options_key('theme-bg-color') == "" ? '#000000' : '#'.newidea_get_options_key('theme-bg-color'); ?>; color: <?php echo newidea_get_options_key('theme-color') == "" ? '#ffffff' : '#'.newidea_get_options_key('theme-color'); ?>; text-shadow: none; }
	
	/* General */
    body {
    	color: <?php echo newidea_get_options_key('custom-general-color') == "" ? '#ffffff' : '#'.newidea_get_options_key('custom-general-color'); ?>;
    }
    
    h1, h2, h3, h4, h5, h6 {
    	color: <?php echo newidea_get_options_key('custom-title-color') == "" ? '#ffffff' : '#'.newidea_get_options_key('custom-title-color'); ?>;
    }
    
    a {
    	color: <?php echo newidea_get_options_key('custom-links-color') == "" ? '#FF3600' : '#'.newidea_get_options_key('custom-links-color'); ?>;
    }
    
    a:hover {
    	color: <?php echo newidea_get_options_key('custom-links-hover-color') == "" ? '#FFC700' : '#'.newidea_get_options_key('custom-links-hover-color'); ?>;
    }

    #loading-bg {
		background:<?php echo newidea_get_options_key('theme-bg-color') == "" ? '#000000' : '#'.newidea_get_options_key('theme-bg-color'); ?>;
    }

	/* Header */
    header {height:<?php echo intval($newidea_options['header-height']).'px';?>;	}
    
    <?php if(newidea_get_options_key('header-enable-bg') == "on") : ?>
    	header > span {background-color: <?php echo newidea_get_options_key('header-bg-color') == "" ? '#000000' : '#'.newidea_get_options_key('header-bg-color'); ?> ;}
		<?php if(newidea_get_options_key('header-bg-image') != "") : ?>	
        	header > span {background-image: url(<?php echo newidea_get_options_key('header-bg-image'); ?>);	}
        <?php endif; ?>
        header > span {
                opacity:<?php echo intval(newidea_get_options_key('header-background-alpha'))/100; ?>;
                filter:alpha(opacity=<?php echo intval(newidea_get_options_key('header-background-alpha')); ?>); /* For IE8 and earlier */
            }
    <?php endif; ?>
    
    /* Footer */
    footer {height:<?php echo intval($newidea_options['footer-height']).'px';?>;	}
	<?php if(newidea_get_options_key('footer-enable-bg') == "on") : ?>	
         footer > span {background-color: <?php echo newidea_get_options_key('footer-bg-color') == "" ? '#000000' : '#'.newidea_get_options_key('footer-bg-color'); ?> ;}
        <?php if(newidea_get_options_key('footer-bg-image') != "") : ?>	
            footer > span {background-image: url(<?php echo newidea_get_options_key('footer-bg-image'); ?>);	}
        <?php endif; ?>
         footer > span {
                opacity:<?php echo intval(newidea_get_options_key('footer-background-alpha'))/100; ?>;
                filter:alpha(opacity=<?php echo intval(newidea_get_options_key('footer-background-alpha')); ?>); /* For IE8 and earlier */
            }
    <?php endif; ?>
	
    /* Logo */
    #logo a {
		width:<?php echo intval(newidea_get_options_key('logo-image-width')).'px'?>;
		height:<?php echo intval(newidea_get_options_key('logo-image-height')).'px'?>;
		background:url(<?php echo newidea_get_options_key('logo-image') == "" ? "../images/logo.png" : $newidea_options['logo-image'];?>) no-repeat;
	}
    
    <?php if(intval(newidea_get_options_key('logo-image-align')) == 0){ ?>
    	#logo {
        	left:<?php echo intval(newidea_get_options_key('logo-padding-left')).'px';?>;
            margin-top: <?php echo intval(newidea_get_options_key('logo-padding-top')).'px';?>;
        }
    <?php } else if(intval(newidea_get_options_key('logo-image-align')) == 1){ ?>
    	#logo {
        	left:50%;
            margin-left: <?php echo ((-intval(newidea_get_options_key('logo-image-width'))/2) + intval(newidea_get_options_key('logo-padding-left'))).'px';?>;
            margin-top: <?php echo intval(newidea_get_options_key('logo-padding-top')).'px';?>;
        }
    <?php } else { ?>
    	#logo {
        	right:<?php echo intval(newidea_get_options_key('logo-padding-left')).'px';?>;
            margin-top: <?php echo intval(newidea_get_options_key('logo-padding-top')).'px';?>;
        }
    <?php } ?>
	
    /* Menu */
    #navBg {
    	margin-top: <?php echo intval(newidea_get_options_key('menu-padding-top')).'px'; ?>;
        background-color: <?php echo newidea_get_options_key('menu-area-bg-color') == "" ? '#0D0D0D' : '#'.newidea_get_options_key('menu-area-bg-color'); ?>;
    }
    
    #nav a ,.portfolio-list-back a , .news-back a{
    	color: <?php echo newidea_get_options_key('menu-color') == "" ? '#ffffff' : '#'.newidea_get_options_key('menu-color'); ?>;
    }
    
     #nav a:hover ,.portfolio-list-back a , .news-back a{
    	color: <?php echo newidea_get_options_key('menu-over-color') == "" ? '#ffffff' : '#'.newidea_get_options_key('menu-over-color'); ?>;
    }   
    
    #nav a.navActv {
    	color: <?php echo newidea_get_options_key('menu-active-color') == "" ? '#ffffff' : '#'.newidea_get_options_key('menu-active-color'); ?>;
        background-color: <?php echo newidea_get_options_key('menu-active-bg-color') == "" ? '#000000' : '#'.newidea_get_options_key('menu-active-bg-color'); ?>;
        -webkit-transition: 500ms;
        -moz-transition: 500ms;
        -o-transition: 500ms;
        transition: 500ms;
    }

    .nav-bg {
    	 background-color: <?php echo newidea_get_options_key('menu-bg-color') == "" ? '#000000' : '#'.newidea_get_options_key('menu-bg-color'); ?>;
    }
    
    /* Background */
    <?php if(newidea_get_options_key('home-background-alpha') != "") : ?>	
    .bg-for-image {
    	background:<?php echo newidea_get_options_key('theme-bg-color') == "" ? '#000000' : '#'.newidea_get_options_key('theme-bg-color'); ?>;
		opacity:<?php echo (1-intval(newidea_get_options_key('home-background-alpha'))/100); ?>;
        filter:alpha(opacity=<?php echo (100-intval(newidea_get_options_key('home-background-alpha'))); ?>); /* For IE8 and earlier */
	}
    <?php endif; ?>
    	
    /* Other */
    
    .item-image,.ps_slider .ps_album .albumCont ,.portfolio-list-item {
    	border: solid 1px <?php echo newidea_get_options_key('theme-border-color') == "" ? '#e8e8e8' : '#'.newidea_get_options_key('theme-border-color'); ?>;
    }
    
    .item-image:hover,.ps_slider .ps_album .albumCont:hover, .portfolio-list-item:hover {
        border:solid 1px <?php echo newidea_get_options_key('theme-border-over-color') == "" ? '#ffffff' : '#'.newidea_get_options_key('theme-border-over-color'); ?>;
    }

    .newsDate,.newsCategory, .site-info a {
    	color: <?php echo newidea_get_options_key('theme-color') == "" ? '#333' : '#'.newidea_get_options_key('theme-color'); ?>;
    }
    
    .portfolio-list-back a ,.news-back a {
    	background-color: <?php echo newidea_get_options_key('theme-color') == "" ? '#0D0D0D' : '#'.newidea_get_options_key('theme-color'); ?>;
    }
    
    .ps_slider .albumCont:hover > .ps_desc h6  , .news-container h6:hover {
		color:<?php echo newidea_get_options_key('theme-color') == "" ? '#0D0D0D' : '#'.newidea_get_options_key('theme-color'); ?>;
    }
    
    .single-post-content h6:hover {color: <?php echo newidea_get_options_key('custom-title-color') == "" ? '#ffffff' : '#'.newidea_get_options_key('custom-title-color'); ?>;}
    
    /* Scroll bar */
    
    .jspTrack {
    	background-color: <?php echo newidea_get_options_key('custom-scroll-bg-color') == "" ? '#ffffff' : '#'.newidea_get_options_key('custom-scroll-bg-color'); ?>;
    }
    
    .jspDrag {
    	background-color: <?php echo newidea_get_options_key('custom-scroll-color') == "" ? '#000000' : '#'.newidea_get_options_key('custom-scroll-color'); ?>;
    }
    
    /* Social */
    <?php if(intval(newidea_get_options_key('social-align')) == 0){ ?>
    	.social {
        	left:<?php echo intval(newidea_get_options_key('social-padding-left')).'px';?>;
            margin-top: <?php echo intval(newidea_get_options_key('social-padding-top')).'px';?>;
        }
    <?php } else if(intval(newidea_get_options_key('social-align')) == 1){ ?>
    	.social {
        	left:50%;
            margin-left: <?php echo intval(newidea_get_options_key('social-padding-left')).'px';?>;
            margin-top: <?php echo intval(newidea_get_options_key('social-padding-top')).'px';?>;
        }
    <?php } else { ?>
    	.social {
        	right:<?php echo intval(newidea_get_options_key('social-padding-left')).'px';?>;
            margin-top: <?php echo intval(newidea_get_options_key('social-padding-top')).'px';?>;
        }
    <?php } ?>
    
    #contact-form .error {
        color:<?php echo newidea_get_options_key('theme-color') == "" ? '#ff0000' : '#'.newidea_get_options_key('theme-color'); ?>;
    }
    
    #contact-form .success {
        color:#0C0;
    }
 
    /* ----------------------------------------- */
    /*				CUSTOM FONT
    /* ----------------------------------------- */

	 /* general */
	body , p , input, select, textarea {
        font-family: <?php echo $google_custom_fonts['general_font'] == "" ? 'Helvetica Neue' : $google_custom_fonts['general_font']; ?>, sans-serif;
        font-size: <?php echo $google_custom_fonts['general_font_size'] == "" ? '12px' : $google_custom_fonts['general_font_size']; ?>
    }
    
	/* h1 - h6 */
	h1,h2,h3,h4,h5,h6,.testimonials-content p,.testimonials2 .testimonials-details .testimonials-name {
        font-family: <?php echo $google_custom_fonts['title_font'] == "" ? 'Ropa Sans' : $google_custom_fonts['title_font']; ?>, Arial, Helvetica, sans-serif;
    }
    
	/* menu */
	#nav a ,.portfolio-list-back a , .news-back a {
        font-family: <?php echo $google_custom_fonts['menu_font'] == "" ? 'Ropa Sans' : $google_custom_fonts['menu_font']; ?>, Arial, Helvetica, sans-serif;
        font-size: <?php echo $google_custom_fonts['menu_font_size'] == "" ? '16px' : $google_custom_fonts['menu_font_size']; ?>
    }
    
    /* footer */
	.site-info, .site-info a {
        font-family: <?php echo $google_custom_fonts['footer_menu_font'] == "" ? 'Helvetica' : $google_custom_fonts['footer_menu_font']; ?>, Arial, Helvetica, sans-serif;
        font-size: <?php echo $google_custom_fonts['footer_menu_font_size'] == "" ? '10px' : $google_custom_fonts['footer_menu_font_size']; ?>
    }

/* Landscape phones and down */
@media (max-width: 767px) {
	header > span,
    footer > span {background:none !important;}
    
    <?php if(intval(newidea_get_options_key('logo-image-position')) == 1){ ?>
	footer > span {
		max-height: <?php echo (intval(newidea_get_options_key('logo-image-height')) + 80); ?>px !important;
	}
     #logo {
    	margin-top: 20px;
    }
    <?php }else{ ?>
    header {
		height: <?php echo (intval(newidea_get_options_key('logo-image-height')) + 60); ?>px !important;
	}
    #logo {
    	margin-top: 50px;
    }
    footer .container,
    footer > span {
		height: 90px !important;
	}
	<?php } ?>
    .menu-select .menu-select-top {
    	background:<?php echo newidea_get_options_key('theme-color') == "" ? '#0D0D0D' : '#'.newidea_get_options_key('theme-color'); ?>;
    }
    
    .menu-select ul li:hover , .menu-select ul li.active{
    	color:<?php echo newidea_get_options_key('theme-color') == "" ? '#0D0D0D' : '#'.newidea_get_options_key('theme-color'); ?>;
    }
    
}
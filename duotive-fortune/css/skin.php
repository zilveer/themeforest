<?php header("Content-type: text/css"); ?>
<?php
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
?>
/*--------------------------------------------------*/
/*--------------------------------------------------*/    
/*--------------- BACKGROUND IMAGES ----------------*/    
/*--------------------------------------------------*/
/*--------------------------------------------------*/
<?php $dt_generalBackgroundColor =  get_option('dt_generalBackgroundColor', '444');  ?>

<?php $dt_generalBackground =  get_option('dt_predefinedBackground', get_template_directory_uri().'/images/bgs/bgs/18-liliac-green/02.jpg');  ?>
<?php $dt_generalBackgroundOver =  get_option('dt_generalBackground', '');  ?>
<?php if ( $dt_generalBackgroundOver != '' ) $dt_generalBackground = $dt_generalBackgroundOver; ?>
<?php $dt_generalBackgroundPosition =  get_option('dt_generalBackgroundPosition', 'center top');  ?>
<?php $dt_generalBackgroundRepeat =  get_option('dt_generalBackgroundRepeat', 'no-repeat');  ?>

<?php $dt_generalBackgroundColorLocal = get_post_meta($_GET['postid'], "background-color", true); if ( isset($dt_generalBackgroundColorLocal) && $dt_generalBackgroundColorLocal != '' ) $dt_generalBackgroundColor = $dt_generalBackgroundColorLocal;?>
<?php $dt_generalBackgroundLocal = get_post_meta($_GET['postid'], "background-image", true); if ( isset($dt_generalBackgroundLocal) && $dt_generalBackgroundLocal != '' ) $dt_generalBackground = $dt_generalBackgroundLocal;?>
<?php $dt_generalBackgroundPositionLocal = get_post_meta($_GET['postid'], "background-position", true); if ( isset($dt_generalBackgroundPositionLocal) && $dt_generalBackgroundPositionLocal != '' && $dt_generalBackgroundPositionLocal != 'inherit' ) $dt_generalBackgroundPosition = $dt_generalBackgroundPositionLocal;?>
<?php $dt_generalBackgroundRepeatLocal = get_post_meta($_GET['postid'], "background-repeat", true); if ( isset($dt_generalBackgroundRepeatLocal) && $dt_generalBackgroundRepeatLocal != '' && $dt_generalBackgroundRepeatLocal != 'inherit' ) $dt_generalBackgroundRepeat = $dt_generalBackgroundRepeatLocal;?>

#background-container ul li.static-image {
<?php if ( $dt_generalBackground != '' ) : ?>background-image:url(<?php echo $dt_generalBackground; ?>);<?php else: ?>background-image:none;<?php endif; ?>
<?php if ( $dt_generalBackgroundPosition != '' ) : ?>background-position:<?php echo $dt_generalBackgroundPosition; ?>;<?php endif; ?>
<?php if ( $dt_generalBackgroundRepeat != '' ) : ?>background-repeat:<?php echo $dt_generalBackgroundRepeat; ?>;<?php endif; ?>
}
<?php if ( $dt_generalBackgroundColor != '' ) : ?>
#background-container {
	background-color:#<?php echo $dt_generalBackgroundColor; ?>;
    <?php if ( $dt_generalBackground == '' ) echo 'background-image:none;'; ?>
}
<?php endif; ?>
/*--------------------------------------------------*/
/*--------------------------------------------------*/    
/*------------------ FONT FAMILY -------------------*/    
/*--------------------------------------------------*/
/*--------------------------------------------------*/
<?php $dt_FontFamily = get_option('dt_FontFamily'); ?>
<?php if ( $dt_FontFamily != '' ): ?>
<?php if ( $dt_FontFamily != 'Georgia' && $dt_FontFamily != 'Tahoma' && $dt_FontFamily != 'Times New Roman' && $dt_FontFamily != 'Lucida Sans Unicode' && $dt_FontFamily != 'Trebuchet MS' && $dt_FontFamily != 'Microsoft Sans Serif' && $dt_FontFamily != 'Verdana' ) : ?>
<?php $fontfamily = str_replace('custom/','',$dt_FontFamily); ?>
@font-face {
    font-family: '<?php echo $fontfamily; ?>';
    src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $dt_FontFamily; ?>-webfont.eot');
    src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $dt_FontFamily; ?>-webfont.eot?iefix') format('eot'),
         url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $dt_FontFamily; ?>-webfont.woff') format('woff'),
         url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $dt_FontFamily; ?>-webfont.ttf') format('truetype'),
         url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $dt_FontFamily; ?>-webfont.svg#<?php echo $fontfamily; ?>') format('svg');
    font-weight: normal;
    font-style: normal;
}
<?php endif; ?>
<?php endif; ?>
#mainmenu ul > li a:link,
#mainmenu ul > li a:visited,
.more-link span,
.dt-more-link span,
table th,
h1,h2,h3,h4,h5,h6,
h1 a:link,h1 a:visited,h2 a:link,h2 a:visited,h3 a:link,h3 a:visited,h4 a:link,h4 a:visited,h5 a:link,h5 a:visited,h6 a:link,h6 a:visited,
h1 span,h2 span,h3 span,h4 span,h5 span,h6 span,
h1 strong,h2 strong,h3 strong,h4 strong,h5 strong,h6 strong,
h1 sup,h2 sup,h3 sup,h4 sup,h5 sup,h6 sup,
h1 sub,h2 sub,h3 sub,h4 sub,h5 sub,h6 sub,
input[type="submit"], input[type="reset"], button,
.widget_tag_cloud a,
.dt-tagcould a,
#wp-calendar caption,
.dt-tabs .ui-tabs-nav li a,
.dt-tabs-shortcode .ui-tabs-nav li a,
.dt-tabs-vertical .ui-tabs-nav li a,
.dt-button:link,
.dt-button:visited,
.dt-button-large span,
.dt-button-x-large span,
.dt_presentationslider .slider-gallery a .nr,
.dt_presentationslider .slider-gallery a .title,
.dt-twitter .tweet-heading .name,
.dt-twitter .tweet-content,
.dt-twitter .tweet-content a,
.portfolio-filter ul li a,
#frontpage-intro p.main-intro a:link,
#frontpage-intro p.main-intro a:visited,
#frontpage-intro p.main-intro em,
#content-wrapper .more-link span span,
.dt-more-link span span,
.dt-tour .ui-tabs-nav li a:link,
.dt-tour .ui-tabs-nav li a:visited,
#author-info h6 span,
#comments .commentlist li .comment-wrapper .author,
#comments .commentlist li .comment-wrapper .author span,
#frontpage-intro p.main-intro,
#frontpage .front-page-tabs .ui-tabs-nav li a:link,
#frontpage .front-page-tabs .ui-tabs-nav li a:visited,
#footer-sharing a.social-item:link,
#footer-sharing a.social-item:visited,
#footer-sharing-wrapper .st_sharethis .stButton span.sharethis
{
<?php if ( $dt_FontFamily != 'Tahoma' && $dt_FontFamily != 'Georgia' && $dt_FontFamily != 'Times New Roman' && $dt_FontFamily != 'Lucida Sans Unicode' && $dt_FontFamily != 'Trebuchet MS' && $dt_FontFamily != 'Microsoft Sans Serif' && $dt_FontFamily != 'Verdana' ) : ?>
	font-family:<?php if ( $dt_FontFamily != '' ) echo $fontfamily.','; ?> Tahoma, Helvetica, Arial, sans-serif;   
<?php else: ?>    
	<?php if ( $dt_FontFamily == 'Tahoma' ) echo 'font-family:Tahoma, Geneva, sans-serif;'; ?>
	<?php if ( $dt_FontFamily == 'Georgia' ) echo 'font-family:Georgia, "Times New Roman", Times, serif;'; ?>
	<?php if ( $dt_FontFamily == 'Times New Roman' ) echo 'font-family:"Times New Roman", Times, serif;'; ?>    
	<?php if ( $dt_FontFamily == 'Lucida Sans Unicode' ) echo '"Lucida Sans Unicode", "Lucida Grande", sans-serif;'; ?>    
	<?php if ( $dt_FontFamily == 'Trebuchet MS' ) echo 'font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;'; ?>    
	<?php if ( $dt_FontFamily == 'Microsoft Sans Serif' ) echo 'font-family:"Microsoft Sans Serif", Arial, "sans-serif";'; ?>    
	<?php if ( $dt_FontFamily == 'Verdana' ) echo 'font-family:Verdana, Geneva, sans-serif;'; ?>    
<?php endif; ?>    
}


/*--------------------------------------------------*/
/*--------------------------------------------------*/    
/*----------------- COLOR SCHEMES ------------------*/    
/*--------------------------------------------------*/
/*--------------------------------------------------*/

<?php $dt_primaryColor =  get_option('dt_primaryColor', 'adbb42');  ?>
<?php $dt_secondaryColor =  get_option('dt_secondayColor', 'ebf732');  ?>
<?php $dt_primaryColorLocal = get_post_meta($_GET['postid'], "primary-color", true); if ( isset($dt_primaryColorLocal) && $dt_primaryColorLocal != '' ) $dt_primaryColor = $dt_primaryColorLocal;?>
<?php $dt_secondaryColorLocal = get_post_meta($_GET['postid'], "secondary-color", true); if ( isset($dt_secondaryColorLocal) && $dt_secondaryColorLocal != '' ) $dt_secondaryColor = $dt_secondaryColorLocal;?>
::-moz-selection{ background: #<?php echo $dt_primaryColor; ?>; color:#fff; text-shadow: none; }
::selection { background:#<?php echo $dt_primaryColor; ?>; color:#fff; text-shadow: none; }
#mainmenu ul > li a:link,
#mainmenu ul > li a:visited,
#mainmenu ul.sub-menu a:hover,
#mainmenu ul.sub-menu a:active,
.more-link span,
.dt-more-link span,
table th,
h1,h2,h3,h4,h5,h6,
h1 a:link,h1 a:visited,h2 a:link,h2 a:visited,h3 a:link,h3 a:visited,h4 a:link,h4 a:visited,h5 a:link,h5 a:visited,h6 a:link,h6 a:visited,
h1 span,h2 span,h3 span,h4 span,h5 span,h6 span,
h1 strong,h2 strong,h3 strong,h4 strong,h5 strong,h6 strong,
h1 sup,h2 sup,h3 sup,h4 sup,h5 sup,h6 sup,
h1 sub,h2 sub,h3 sub,h4 sub,h5 sub,h6 sub,
input[type="submit"], input[type="reset"], button,
#dt-questions-answers #table-of-content ul li a:hover,
#dt-questions-answers #table-of-content ul li a:active,
#question-answers-content div.content-item-sep .scroll:hover,
#question-answers-content div.content-item-sep .scroll:active,
#content-wrapper a:link,#content-wrapper a:visited,
#comments .commentlist li .comment-wrapper .author,
#frontpage .front-page-latest-news .accordion h6:hover a,
#frontpage .front-page-tabs .ui-tabs-nav li a:hover,
#frontpage .front-page-tabs .ui-tabs-nav li a:active,
#frontpage .front-page-tabs .ui-tabs-nav li.ui-state-active a:link,
#frontpage .front-page-tabs .ui-tabs-nav li.ui-state-active a:visited,
#frontpage .front-page-from-the-blog .blog-item span.date span.month,
#frontpage .front-page-from-the-blog .blog-item span.date span.day,
#content-slider .content a:link,
#content-slider .content a:visited,
.galleria-info-title,
.jp-type-single .jp-title ul li,
.dt-button-large:link span,
.dt-button-large:visited span,
.dt-button-x-large:link span,
.dt-button-x-large:visited span,
.dt_fullwidthslider .slider-descriptions li h6,
.dt_fullwidthslider .slider-descriptions li a,
.dt_presentationslider .slider-gallery ul li a .nr,
.dt_presentationslider .slider-gallery.single-content li.active a .nr,
.dt_presentationslider .slider-gallery ul li.active a .title,
.dt_fullscreenslider .more-link .mid 
{color:#<?php echo $dt_primaryColor; ?>}
#mainmenu ul.sub-menu a:hover,
#mainmenu ul.sub-menu a:active,
#mainmenu li.current-menu-item ul.sub-menu a:hover,
#mainmenu li.current-menu-item ul.sub-menu a:active,
.widget-container ul li a:hover,
.widget-container ul li a:active,
.widget_tag_cloud a:hover,
.widget_tag_cloud a:active,
.dt-tagcould a:hover,
.dt-tagcould a:active,
.dt-tabs .ui-tabs-nav li.ui-state-active a:link,
.dt-tabs .ui-tabs-nav li.ui-state-active a:visited,
.dt-tour .ui-tabs-nav li.ui-state-active a:link,
.dt-tour .ui-tabs-nav li.ui-state-active a:visited,
.dt-pricing .dt-pricing-column-featured h4,
.jqTransformSelectWrapper ul li a:hover,
.jqTransformSelectWrapper ul li a:active,
.jqTransformSelectWrapper ul li a.selected:link,
.jqTransformSelectWrapper ul li a.selected:visited,
.dt-tour .ui-tabs-nav li a:hover,
.dt-tour .ui-tabs-nav li a:active,
.dt-newsflash .post-content a.more-link:link,
.dt-newsflash .post-content a.more-link:visited
{color:#<?php echo $dt_primaryColor; ?> !important;}
#page-title h1,
#frontpage-intro h1,
#frontpage .front-page-projects li .project-content h6,
#sub-footer a:hover,
#sub-footer a:active,
#frontpage-intro p.main-intro a:hover,
#frontpage-intro p.main-intro a:active,
.portfolio-masonry .project-content h6,
.dt_galleryslider .slider-images .mainparent .description h6,
.dt_galleryslider .slider-images .mainparent .description a,
.dt_fullscreenslider .slider-descriptions li h3,
#footer-tabs input[type="submit"], #footer-tabs input[type="reset"], #footer-tabs button
{color:#<?php echo $dt_secondaryColor; ?>}
#footer-tabs h1,
#footer-tabs h2,
#footer-tabs h3,
#footer-tabs h4,
#footer-tabs h5,
#footer-tabs h6,
#footer-tabs #wp-calendar a:hover,
#footer-tabs #wp-calendar a:active,
#footer-tabs #wp-calendar tr th,
#footer-tabs .widget-container ul li a:hover,
#footer-tabs .widget-container ul li a:active,
#footer-tabs .dt-tagcould a:hover,
#footer-tabs .dt-tagcould a:active,
#footer-tabs .dt-tabs .ui-tabs-nav .ui-state-active a:link,
#footer-tabs .dt-tabs .ui-tabs-nav .ui-state-active a:visited,
#footer-tabs .dt-tabs .ui-tabs-nav .ui-state-active a:hover,
#footer-tabs .dt-tabs .ui-tabs-nav .ui-state-active a:active,
.dt_presentationslider .slider-descriptions li h6 
{color:#<?php echo $dt_secondaryColor; ?> !important;}
#dt-loader-bar .inner,
#project-nav span,
#wp-calendar #today,
#single .post-metabox span.tags a:hover,
#single .post-metabox span.tags a:active,
#single-full-width .post-metabox span.tags a:hover,
#single-full-width .post-metabox span.tags a:active,
.portfolio-filter ul li.active a:link,
.portfolio-filter ul li.active a:visited,
.portfolio-masonry .project-text-only .project-content,
.galleriffic-content .galleriffic-controls a:link,
.galleriffic-content .galleriffic-controls a:visited,
.galleriffic-navigation .pagination a:link,
.galleriffic-navigation .pagination a:visited,
.jp-type-single .jp-interface .jp-progress .jp-seek-bar .jp-play-bar,
.jp-type-single .jp-interface .jp-volume-bar-value,
.portfolio-fullwidth-slideshow article .project-content ul.slideshow-controls li a:hover,
.portfolio-fullwidth-slideshow article .project-content ul.slideshow-controls li a:active,
.portfolio-fullwidth-slideshow article .project-content ul.slideshow-controls li a.active,
.dt_complexslider .slider-timer .timer,
.dt_galleryslider .slider-scroll .slider-scroll-left:link,
.dt_galleryslider .slider-scroll .slider-scroll-left:visited,
.dt_galleryslider .slider-scroll .slider-scroll-right:link,
.dt_galleryslider .slider-scroll .slider-scroll-right:visited,
.dt_complexslider .slider-timer .timer,
.dt_presentationslider .slider-scroll .slider-scroll-left:link,
.dt_presentationslider .slider-scroll .slider-scroll-left:visited,
.dt_presentationslider .slider-scroll .slider-scroll-right:link,
.dt_presentationslider .slider-scroll .slider-scroll-right:visited,
.dt_presentationslider .slider-timer .timer {
background-color:#<?php echo $dt_primaryColor; ?>; 
}
.dt_complexslider .slider-gallery a.active span,
.dt_fullwidthslider .slider-gallery a.active span {
	border-color:#<?php echo $dt_primaryColor; ?>; 
}
.dt_fullscreenslider .slider-gallery ul li .border {
	border-color:#<?php echo $dt_secondaryColor; ?>; 
}
#footer-tabs #wp-calendar #today,
.dt-highlight
{background-color:#<?php echo $dt_secondaryColor; ?> !important;}


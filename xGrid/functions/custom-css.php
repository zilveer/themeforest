<?php global $bd_data; ?>
<style type="text/css">
body {
<?php global $bd_data; if($bd_data['background_displays'] == 'bg_cutsom') : ; ?>
<?php $bg =$bd_data['custom_background']; ?>
<?php if( !empty( $bg['color'] ) ){ ?>background-color:<?php echo $bg['color'] ?>; <?php echo "\n"; } ?>
<?php if( !empty( $bg['img'] ) ){ ?>background-image: url('<?php echo $bg['img'] ?>'); <?php echo "\n"; } ?>
<?php if( !empty( $bg['repeat'] ) ){ ?>background-repeat:<?php echo $bg['repeat'] ?>; <?php echo "\n"; } ?>
<?php if( !empty( $bg['attachment'] ) ){ ?>background-attachment:<?php echo $bg['attachment'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $bg['hor'] ) || !empty( $bg['ver'] ) ){ ?>background-position:<?php echo $bg['hor'] ?> <?php echo $bg['ver'] ?>; <?php echo "\n"; } ?>
<?php if($bd_data['custom_background_full']): ?>
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
<?php endif; ?>
<?php elseif($bd_data['background_displays'] == 'bg_pattren') : ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'none'){ ?><?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat1'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-1.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat2'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-2.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat3'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-3.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat4'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-4.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat5'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-5.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat6'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-6.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat7'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-7.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat8'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-8.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat9'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-9.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat10'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-10.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat11'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-11.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat12'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-12.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat13'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-13.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat14'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-14.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat15'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-15.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat16'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-16.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat17'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-17.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat18'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-18.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat19'){ ?><?php if( !empty( $bd_data['custom_pattrens_color'] ) ){ ?>background-color:<?php echo $bd_data['custom_pattrens_color'] ?>; <?php } ?> background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-19.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php if(array_key_exists('pattrens_bg',$bd_data)){ if($bd_data['pattrens_bg'] == 'pat20'){ ?>background-image: url("<?php echo get_template_directory_uri() ?>/images/pattrens/pat-20.png"); background-position: center center; background-repeat: repeat; <?php echo "\n"; }} ?>
<?php endif; ?>
}
<?php if(array_key_exists('custom_css',$bd_data)){ $css_var = $bd_data['custom_css'];}else{$css_var = '';} $css_code =  str_replace("<pre>", "", stripslashes($css_var));  echo $css_code = str_replace("</pre>", "", $css_code )  , "\n";?>
<?php if( bdayh_get_option('css_tablets') ) { ?>
@media only screen and (max-width: 985px) and (min-width: 768px){
<?php echo stripslashes( bdayh_get_option( 'css_tablets' ) ) , "\n";?>
}
<?php } ?>
<?php if( bdayh_get_option('css_wide_phones') ) { ?>
@media only screen and (max-width: 767px) and (min-width: 480px){
<?php echo stripslashes( bdayh_get_option( 'css_wide_phones' ) ) , "\n";?>
}
<?php } ?>
<?php if( bdayh_get_option('css_phones') ) { ?>
@media only screen and (max-width: 479px) and (min-width: 320px){
<?php echo stripslashes( bdayh_get_option( 'css_phones' ) ) , "\n";?>
}
<?php } ?>
<?php if( !empty( $bd_data['main_text_color'] ) ){ ?>
    body {color: <?php echo $bd_data['main_text_color'] ?> ;}
<?php } ?>
<?php if( !empty( $bd_data['links_color'] ) ){ ?>
    a {color: <?php echo $bd_data['links_color'] ?> ;}
<?php } ?>
<?php if( !empty( $bd_data['links_decoration'] ) ){ ?>
    a {text-decoration: <?php echo $bd_data['links_decoration'] ?> ;}
<?php } ?>
<?php if( !empty( $bd_data['links_color_hover'] ) ){ ?>
    a:hover {color: <?php echo $bd_data['links_color_hover'] ?> ;}
<?php } ?>
<?php if( !empty( $bd_data['links_decoration_hover'] ) ){ ?>
    a:hover {text-decoration: <?php echo $bd_data['links_decoration_hover'] ?> ;}
<?php } ?>

<?php if( !empty( $bd_data['links_decoration_hover'] ) ){ ?>
a:hover {text-decoration: <?php echo $bd_data['links_decoration_hover'] ?> ;}
<?php } ?>
<?php
/* topbar */
if(array_key_exists('s_top',$bd_data))
{
	$topbar =$bd_data['s_top'];
}
if( !empty($topbar['color']) || !empty($topbar['img']) ) :
?>
.top-bar
{
<?php if( !empty( $topbar['color'] ) ){ ?>background-color:<?php echo $topbar['color'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $topbar['img'] ) ){ ?>background-image: url('<?php echo $topbar['img'] ?>') ; <?php echo "\n"; } ?>
<?php if( !empty( $topbar['repeat'] ) ){ ?>background-repeat:<?php echo $topbar['repeat'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $topbar['attachment'] ) ){ ?>background-attachment:<?php echo $topbar['attachment'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $topbar['hor'] ) || !empty( $topbar['ver'] ) ){ ?>background-position:<?php echo $topbar['hor'] ?> <?php echo $topbar['ver'] ?> ; <?php echo "\n"; } ?>
}
<?php endif; ?>
<?php
/* header */
if(array_key_exists('s_header',$bd_data))
{
	$header =$bd_data['s_header'];
}
if( !empty($header['color']) || !empty($header['img']) ) :
?>
.header
{
<?php if( !empty( $header['color'] ) ){ ?>background-color:<?php echo $header['color'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $header['img'] ) ){ ?>background-image: url('<?php echo $header['img'] ?>') ; <?php echo "\n"; } ?>
<?php if( !empty( $header['repeat'] ) ){ ?>background-repeat:<?php echo $header['repeat'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $header['attachment'] ) ){ ?>background-attachment:<?php echo $header['attachment'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $header['hor'] ) || !empty( $header['ver'] ) ){ ?>background-position:<?php echo $header['hor'] ?> <?php echo $header['ver'] ?> ; <?php echo "\n"; } ?>
}
<?php endif; ?>
<?php
/* widget */
if(array_key_exists('s_widget',$bd_data))
{
	$widget =$bd_data['s_widget'];
}
if( !empty($widget['color']) || !empty($widget['img']) ) :
?>
.widget
{
    <?php if( !empty( $widget['color'] ) ){ ?>background-color:<?php echo $widget['color'] ?> ; <?php echo "\n"; } ?>
    <?php if( !empty( $widget['img'] ) ){ ?>background-image: url('<?php echo $widget['img'] ?>') ; <?php echo "\n"; } ?>
    <?php if( !empty( $widget['repeat'] ) ){ ?>background-repeat:<?php echo $widget['repeat'] ?> ; <?php echo "\n"; } ?>
    <?php if( !empty( $widget['attachment'] ) ){ ?>background-attachment:<?php echo $widget['attachment'] ?> ; <?php echo "\n"; } ?>
    <?php if( !empty( $widget['hor'] ) || !empty( $widget['ver'] ) ){ ?>background-position:<?php echo $widget['hor'] ?> <?php echo $widget['ver'] ?> ; <?php echo "\n"; } ?>
}
<?php endif; ?>
<?php
/* widget */
if(array_key_exists('s_footer',$bd_data))
{
	$foot = $bd_data['s_footer'];
}
if( !empty($foot['color']) || !empty($foot['img']) ) :
?>
.footer
{
    <?php if( !empty( $foot['color'] ) ){ ?>background-color:<?php echo $foot['color'] ?> ; <?php echo "\n"; } ?>
    <?php if( !empty( $foot['img'] ) ){ ?>background-image: url('<?php echo $foot['img'] ?>') ; <?php echo "\n"; } ?>
    <?php if( !empty( $foot['repeat'] ) ){ ?>background-repeat:<?php echo $foot['repeat'] ?> ; <?php echo "\n"; } ?>
    <?php if( !empty( $foot['attachment'] ) ){ ?>background-attachment:<?php echo $foot['attachment'] ?> ; <?php echo "\n"; } ?>
    <?php if( !empty( $foot['hor'] ) || !empty( $foot['ver'] ) ){ ?>background-position:<?php echo $foot['hor'] ?> <?php echo $foot['ver'] ?> ; <?php echo "\n"; } ?>
}
<?php endif; ?>
<?php
/* post */
if(array_key_exists('s_post',$bd_data))
{
	$footer =$bd_data['s_post'];
}
if( !empty($footer['color']) || !empty($footer['img']) ) :
?>
.blog-v1 article
{
<?php if( !empty( $footer['color'] ) ){ ?>background-color:<?php echo $footer['color'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $footer['img'] ) ){ ?>background-image: url('<?php echo $footer['img'] ?>') ; <?php echo "\n"; } ?>
<?php if( !empty( $footer['repeat'] ) ){ ?>background-repeat:<?php echo $footer['repeat'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $footer['attachment'] ) ){ ?>background-attachment:<?php echo $footer['attachment'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $footer['hor'] ) || !empty( $footer['ver'] ) ){ ?>background-position:<?php echo $footer['hor'] ?> <?php echo $footer['ver'] ?> ; <?php echo "\n"; } ?>
}
<?php if( !empty( $footer['color'] ) ){ ?>#footer-widgets .widget .post-warpper{ border-color: <?php echo $footer['color'] ?> ; }<?php echo "\n"; } ?>
<?php endif; ?>
<?php
/* Begin Typo */
global $custom_typography;
foreach( $custom_typography as $selector => $input ){
$option = bdayh_get_option( $input );
if( $option['font'] || $option['color'] || $option['size'] || $option['lineheight'] || $option['weight'] || $option['style'] || $option['texttransform'] ):
echo $selector."{\n"; ?>
<?php if($option['font'] )
echo "font-family: ". stripslashes( bd_get_font( $option['font'] ) ).";\n"?>
<?php if($option['color'] )
echo "color :". $option['color'].";\n"?>
<?php if($option['size'] )
echo "font-size : ".$option['size']."px;\n"?>
<?php if($option['lineheight'] )
echo "line-height : ".$option['lineheight']."px;\n"?>
<?php if($option['weight'] )
echo "font-weight: ".$option['weight'].";\n"?>
<?php if($option['style'] )
echo "font-style: ". $option['style'].";\n"?>
<?php if($option['texttransform'] )
echo "text-transform: ". $option['texttransform'].";\n"?>
}
<?php endif; } /* End Typo */ ?>
<?php
/* Begin Tagline color */
if( bdayh_get_option( 'tagline_color' ) ){ ?>
span.site-tagline { color:<?php echo bdayh_get_option( 'tagline_color' ) ?> }
<?php } /* End Tagline color */ ?>
<?php /* Nav Text Transform */ if( bdayh_get_option('main_nav_tt') ) { ?>#navigation ul#menu-nav > li > a { text-transform: <?php echo bdayh_get_option('main_nav_tt') ?> ; }<?php } ?>
<?php /* Page Text Transform */ if( bdayh_get_option('page_tt') ) { ?>.page-title h2 { text-transform: <?php echo bdayh_get_option('page_tt') ?> ; }<?php } ?>
<?php /* Post Text Transform */ if( bdayh_get_option('singel_tt') ) { ?>.blog-v1 article h1.entry-title { text-transform: <?php echo bdayh_get_option('singel_tt') ?> ; }<?php } ?>
<?php /* Widget Text Transform */ if( bdayh_get_option('widgets_tt') ) { ?>.widget .widget-title h2, ul.tabs_nav li a { text-transform: <?php echo bdayh_get_option('widgets_tt') ?> ; }<?php } ?>
<?php /* Boxes Text Transform */ if( bdayh_get_option('boxes_tt') ) { ?>.box-title h2 { text-transform: <?php echo bdayh_get_option('boxes_tt') ?> ; }<?php } ?>
<?php
if(array_key_exists('read_btn',$bd_data)){
	$read_btn =   $bd_data['read_btn'];
}
if( !empty($read_btn['color']) || !empty($read_btn['img']) ) {
?>
a.more-link, button, .btn-link, input[type="button"], input[type="reset"], input[type="submit"] {
<?php if( !empty( $read_btn['color'] ) ){ ?>background-color:<?php echo $read_btn['color'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $read_btn['img'] ) ){ ?>background-image: url('<?php echo $read_btn['img'] ?>') ; <?php echo "\n"; } ?>
<?php if( !empty( $read_btn['repeat'] ) ){ ?>background-repeat:<?php echo $read_btn['repeat'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $read_btn['attachment'] ) ){ ?>background-attachment:<?php echo $read_btn['attachment'] ?> ; <?php echo "\n"; } ?>
<?php if( !empty( $read_btn['hor'] ) || !empty( $read_btn['ver'] ) ){ ?>background-position:<?php echo $read_btn['hor'] ?> <?php echo $read_btn['ver'] ?> ; <?php echo "\n"; } ?>
}
<?php } ?>
<?php if( bdayh_get_option( 'read_btn_text_color' ) ) { ?>
a.more-link, button, .btn-link, input[type="button"], input[type="reset"], input[type="submit"] {
    color: <?php echo bdayh_get_option( 'read_btn_text_color' ) ?> ;
}
<?php } ?>
<?php if( bdayh_get_option( 'custom_theme_color' ) ) { ?>
a:hover { color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
button, .btn-link, input[type="button"], input[type="reset"], input[type="submit"] { background-color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>;}
button:active, .btn-link:active, input[type="button"]:active, input[type="reset"]:active, input[type="submit"]:active { background-color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.gotop:hover { background-color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
#navigation ul#menu-nav > li:hover, #navigation ul#menu-nav > li.current_page_item, #navigation ul#menu-nav > li.current-menu-item, #navigation ul#menu-nav > li.current-menu-paren, #navigation ul#menu-nav > li.current-menu-ancestor > a { background-color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
span.bd-criteria-percentage { background: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?> !important;}
.divider-colors { background: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.blog-v1 article .entry-meta a { color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.cat-links {  background-color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.pagenavi span.pagenavi-current { border: 1px solid <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; background-color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.pagenavi a:hover { border: 1px solid <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.widget a:hover { color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.tagcloud a:hover, div.slide-set div#slide-set ul.flex-direction-nav li a { background: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
ul.tabs_nav li.active a { color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.bd-tweets ul.tweet_list li.twitter-item a { color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.widget.bd-login .login_user .bio-author-desc a { color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.comment-reply-link, .comment-reply-link:link, .comment-reply-link:active { color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.gallery-caption, .btn-nav-out { background-color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
.slider-flex ol.flex-control-paging li a.flex-active { background: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
#folio-main ul#filters li a.selected { background: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>;}
article a.more-link,
.footer-light.footer-inner .post-warpper h3.post-title a:hover,
.footer-light .widget-slide-out a:hover,
.footer-light.footer-inner ul.tabs_nav li.active a{ color: <?php echo bdayh_get_option( 'custom_theme_color' ) ?>; }
<?php } ?>
<?php if( !empty( $bd_data['post_text_color'] ) ){ ?>
article .entry-content {color: <?php echo $bd_data['post_text_color'] ?> ;}
<?php } ?>
<?php if( !empty( $bd_data['post_links_color'] ) ){ ?>
article .entry-content a {color: <?php echo $bd_data['post_links_color'] ?> ;}
<?php } ?>
<?php if( !empty( $bd_data['post_links_decoration'] ) ){ ?>
article .entry-content a {text-decoration: <?php echo $bd_data['post_links_decoration'] ?> ;}
<?php } ?>
<?php if( !empty( $bd_data['post_links_color_hover'] ) ){ ?>
article .entry-content a:hover {color: <?php echo $bd_data['post_links_color_hover'] ?> ;}
<?php } ?>
<?php if( !empty( $bd_data['post_links_decoration_hover'] ) ){ ?>
article .entry-content a:hover {text-decoration: <?php echo $bd_data['post_links_decoration_hover'] ?> ;}
<?php } ?>
<?php if( !empty( $bd_data['post_links_decoration_hover'] ) ){ ?>
article .entry-content a:hover {text-decoration: <?php echo $bd_data['post_links_decoration_hover'] ?> ;}
<?php } ?>
<?php if( bdayh_get_option( 'slide_out_about_mw' ) ){ ?>
.slide-out-info-row2 img { max-width: <?php echo bdayh_get_option( 'slide_out_about_mw' ) ?>% }
<?php } ?>
<?php if( bdayh_get_option( 'slide_out_about_mt' ) ){ ?>
.slide-out-info-row2 { margin-top: <?php echo bdayh_get_option( 'slide_out_about_mt' ) ?>px }
<?php } ?>
<?php if( bdayh_get_option( 'slide_out_about_mb' ) ){ ?>
.slide-out-info-row2 { margin-bottom: <?php echo bdayh_get_option( 'slide_out_about_mb' ) ?>px }
<?php } ?>
</style>
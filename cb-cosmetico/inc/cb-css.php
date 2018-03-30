<style media="screen">
<?php ob_start();
require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');
require(get_template_directory().'/inc/cb-little-head.php');
if($add_css!='') echo $add_css; ?>




<?php
if($hfoot=='yes') { ?> 
.footer,.footer-lower,.bg_mid_alpha{display:none!important;}
<?php } 

if($logomt!=''){ ?>.logo {
margin-top:<?php echo $logomt;?>;
}<?php } 
if($mheadertype=='center') { ?>
.top_l,.top_r {
margin:0 auto;
float:inherit!important;
}.top_l {
text-align:center;
}.top_r {
margin-top:-20px!important;
}
.top_header{
padding-top:0px;
padding-bottom:0px;
}
.slider_top .wrapper_p {padding-top:80px;}
.menu-lou .wrapper_p {width:inherit;display:table;}
.below_header {top:20px;}
<?php } 
if($mheadertype=='left') { ?>
.top_header {
padding-top:12px!important;
padding-bottom:12px!important;
}ul#cb-menu > li {
padding-bottom: 5px!important;
padding-top: 5px!important;
}
ul#cb-menu li a.cb-menu-search i {line-height:67px!important;}
<?php } 
if($mheadertype=='right') { ?>
.top_l,.top_r{height:150px;}
<?php }
if($mheadertype=='center') { ?>
ul#cb-menu li a.cb-menu-search i {line-height:67px!important;}
<?php } ?>

<?php
if($pfilter_color!='') { ?>
.port_sorter a {color:<?php echo $pfilter_color;?>!important;}
<?php } ?>

<?php
if($pfilter_bgcolor!='') { ?>
.port_sorter {background:<?php echo $pfilter_bgcolor;?>!important;}
<?php } ?>


<?php 
if($slider_home=='revo'||($slide_type=='revo'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$slide_home=='yes' ) )) { ?>
.slider_top .rev_slider_wrapper {
zoom: 1;
position: relative;
}
<?php } ?>


<?php if( ($full_slider=='yes'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$full_slider_where=='yes' ) )||$slider_home=='full'){ ?>
#middle,.footer,.footer-lower {
display:none;
}
html {
height:85%;
}
<?php }

if($htb_background!='') { ?>
.slider_top{
background:<?php echo $htb_background; ?>!important;
}
<?php } 
if(!isset($sloganpc)) $sloganpc='';
if(!isset($sloganph)) $sloganph='';
if(!isset($header_color)) $header_color='';
if(!isset($ht_backgroundp)) $ht_backgroundp='';

if($sloganpc!='') { ?>
.slider_top_slogan,.slider_top_slogan h1,.slider_top_slogan h2,.slider_top_slogan h3,.slider_top_slogan h4,.slider_top_slogan h5,.slider_top_slogan h6,
.slider_top_slogan h1 a,.slider_top_slogan h2 a,.slider_top_slogan h3 a,.slider_top_slogan h4 a,.slider_top_slogan h5 a,.slider_top_slogan h6 a
{
color:<?php echo $sloganpc; ?>!important;
}
<?php } if($sloganph!='') { ?>
.slider_top_slogan{
margin-top:<?php echo $sloganph; ?>px!important;
}
<?php } ?>




<?php if ( in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { $cb5_woo_cols=get_option('cb5_woo_cols');
$cwcs=690-(($cb5_woo_cols-1)*28);
$cwcs=$cwcs/$cb5_woo_cols;
$cwcs2=980-(($cb5_woo_cols-1)*28);
$cwcs2=$cwcs2/$cb5_woo_cols;
?>
.woo .products .product {
width:<?php echo $cwcs2; ?>px;
}
.woo .side .products .product {
width:<?php echo $cwcs; ?>px;
}
<?php } ?>



















<?php
/**************************************************************************/

if(!isset($_GET['s'])) $_GET['s']='';
if($slider_home=='none'||$slider_home==''||$header_type!='slider_head'||esc_attr($_GET['s'])!=''){ ?>
.slider_top {
padding-top:0px;
padding-bottom:0px;
} 
<?php } ?>
.slider_top .anythingSlider li {
padding-top:100px;
padding-bottom: 20px;
}

<?php if(!isset($header_bg_color)) $header_bg_color='';
if($header_bg_color!='') { ?>
.slider_top {
background-color:<?php echo $header_bg_color;?>!important;
}
<?php } if(!isset($bread_color))$bread_color='';
if($bread_color!='') { ?>
#breadcrumbs,#breadcrumbs a {
color:<?php echo $bread_color;?>!important;
}
<?php }
if($cb_type=='portfolio'&&is_single()) { ?>
.slider_top {
padding-top:350px;
}
<?php }
if($header_type=='map') { ?>
.slider_top {
padding-top: 0;
padding-bottom: 400px;
}
<?php }
if($h1fts!='') { $h1fts2=substr($h1fts,0,-2); $h1fts2=$h1fts2+5; if($h1fts2>20)$h1fts2='20'; }
if($h1fs!='') echo 'h1,h1 a, a h1 {font-size:'.$h1fs.';line-height:'.$h1fs.';}';
if($bodyfs!='') echo 'html, body {font-size:'.$bodyfs.';}';
if($h1fts!='') echo 'h1.title,h1.title a, a h1.title {font-size:'.$h1fts.';line-height:'.$h1fts.';}';
if($h1fts!='') echo 'h1.title i {font-size:'.$h1fts2.'px;line-height:'.$h1fts2.'px;}';
if($h1fts!='') echo '.cb_slash {font-size:'.$h1fts2.'px;line-height:'.$h1fts2.'px;}';
if($h2fs!='') echo 'h2,h2 a, a h2 {font-size:'.$h2fs.';line-height:'.$h2fs.';}';
if($h3fs!='') echo 'h3,h3 a, a h3 {font-size:'.$h3fs.';line-height:'.$h3fs.';}';
if($h4fs!='') echo 'h4,h4 a, a h4 {font-size:'.$h4fs.';line-height:'.$h4fs.';}';
if($h5fs!='') echo 'h5,h5 a, a h5 {font-size:'.$h5fs.';line-height:'.$h5fs.';}';
if($h6fs!='') echo 'h6,h6 a, a h6 {font-size:'.$h6fs.';line-height:'.$h6fs.';}';
?>
.round,.bttn, #sidebar img {
-webkit-border-radius:5px;
-moz-border-radius:5px;
border-radius:5px;
behavior: url(<?php echo WP_THEME_URL; ?>/css/PIE.htc);
position:relative;
}
.roundfix,.circle_skin_bg_alt,.facebook, .twitter, .skype, .rss,.load_more_products,a.bttn:hover, .bttn:hover, .submit:hover, .bttn_big:hover, button:hover, input.bttn:hover, .submit:hover, a.more_cat:hover, .button:hover,.woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button,.woocommerce a.button:hover, .woocommerce-page a.button:hover, .woocommerce button.button:hover, .woocommerce-page button.button:hover, .woocommerce input.button:hover, .woocommerce-page input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page #content input.button:hover,.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale,.product_in,.caretos_brown:hover,.caretos_brown{
position:relative;
behavior: url(<?php echo WP_THEME_URL; ?>/css/PIE.htc);
}
.circle {
-webkit-border-radius:100px;
-moz-border-radius:100px;
border-radius:100px;
behavior: url(<?php echo WP_THEME_URL; ?>/css/PIE.htc);
position:relative;
}
.round,.bttn, #sidebar img, input,textarea,.icon_wrap .cb_icon,i.large_rounded,i.medium_rounded,i.small_rounded,i.large_rounded:hover,i.medium_rounded:hover,i.small_rounded:hover {
behavior: url(<?php echo WP_THEME_URL; ?>/css/PIE.htc);
position:relative;
}
.icon_wrap {
position:relative;
}
<?php
/**************************************************************************/

if($headh!=''){?>
<?php $headhsub=substr($headh,0,-2); ?>
.head_title h1.title {
padding-bottom:<?php echo $headhsub;?>px!important;
}
<?php } ?>
<?php if($headhc!=''){?>
.head_title h1.title,.head_title h1.title a,.head_title h1.title i,.cb_slash {
color:<?php echo $headhc;?>!important;
}
<?php } ?>

<?php if(!isset($headhp)) $headhp=''; ?>
<?php if(!isset($headhcp)) $headhcp=''; ?>

<?php if($headhp!=''){?>
.head_title h1.title,.head_title h1.title i {
line-height:<?php echo $headh;?>!important;
}
<?php } ?>
<?php if($headhcp!=''){?>
.head_title h1.title,.head_title h1.title a,.head_title h1.title i,.cb_slash  {
color:<?php echo $headhc;?>!important;
}
<?php } 

if($icons_bottom_margin!='') { ?>
.slider_top .icons {margin-bottom:<?php echo $icons_bottom_margin;?>;}
<?php } 

if($header_color!='') {?>
.slider_top h1,.slider_top h1 a {
color:<?php echo $header_color;?>!important;
} 
<?php 
}
if(!isset($header_shadow_color)) $header_shadow_color='';
if($header_shadow_color!='') {?>
.head_title h1.title,.head_title h1.title a,.head_title h1.title i,.cb_slash {
text-shadow:1px 1px <?php echo $header_color;?>!important;
} 
<?php
}

/**************************************************************************/

if($font_family_google!='------') { $font_g=$font_family_google;
$font_g=str_replace(' ','%20',$font_g);$font_g=str_replace('+','%20',$font_g);
$font_gg=str_replace('%20',' ',$font_g);
?>
body,html {
font-family:"<?php echo $font_gg; ?>",Arial,sans-serif,sans;
}
<?php }
else { ?>
body,html {
font-family:"<?php echo $font_family; ?>",Arial,sans-serif,sans;
}
<?php }
if($font_family_google_head!='------') { $font_g_head=$font_family_google_head;
$font_g_head=str_replace(' ','%20',$font_g_head);$font_g_head=str_replace('+','%20',$font_g_head);
$font_gg_head=str_replace('%20',' ',$font_g_head);
?>
h1,h2,h3,h4,h5,h6,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,table th,table th a,.footer,.footer a,.footer li,.footer-lower,.footer-lower a,.footer-top-lower,.footer-top-lower a,
.tp-caption.big_white,.tp-caption.big_orange,.tp-caption.big_black,.tp-caption.large_text,.tp-caption.large_text_light,
.tp-caption.very_large_text,.tp-caption.large_text_black,.tp-caption.large_text_light_black,.tp-caption.very_big_white,.tp-caption.very_big_black
{
font-family:"<?php echo $font_gg_head; ?>",Arial,sans-serif,sans;
}<?php }
else { ?>
h1,h2,h3,h4,h5,h6,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,
.tp-caption.big_white,.tp-caption.big_orange,.tp-caption.big_black,.tp-caption.large_text,.tp-caption.large_text_light,
.tp-caption.very_large_text,.tp-caption.large_text_black,.tp-caption.large_text_light_black,.tp-caption.very_big_white,.tp-caption.very_big_black {
font-family:<"?php echo $font_family_head; ?>",Arial,sans-serif,sans;
}
<?php } 
if($font_family_google_head_title!='------') { $font_g_head_title=$font_family_google_head_title;
$font_g_head_title=str_replace(' ','%20',$font_g_head_title);$font_g_head_title=str_replace('+','%20',$font_g_head_title);
$font_gg_head_title=str_replace('%20',' ',$font_g_head_title);
?>
h1.title,h1.title a,.large_text_light,.large_text,.titles{
font-family:"<?php echo $font_gg_head_title; ?>",Arial,sans-serif,sans!important;
}
#breadcrumbs,#breadcrumbs a{
font-family:"<?php echo $font_gg_head_title; ?>",Arial,sans-serif,sans!important;
}
<?php }
/**************************************************************************/
if($font_family_google_head_title2!='------') { $font_g_head_title2=$font_family_google_head_title2;
$font_g_head_title2=str_replace(' ','%20',$font_g_head_title2);$font_g_head_title2=str_replace('+','%20',$font_g_head_title2);
$font_gg_head_title2=str_replace('%20',' ',$font_g_head_title2);
?>
.large_text_light,.large_text,.titles{
font-family:"<?php echo $font_gg_head_title2; ?>",Arial,sans-serif,sans!important;
}
<?php }
/**************************************************************************/
?>


<?php
//demo addition
if($color_master=='') { $color_master=$color_style;
$get_color='';

if($get_color=='white') $get_color='';
if($get_color!='') $color_style=$get_color;

switch($color_style) {
case 'grey': $color_master='#767676'; break;
case 'bright_red': $color_master='#d53838'; break;
case 'blue': $color_master='#0f7ca9'; break;
case 'cocoa': $color_master='#9e625c'; break;
case 'dark_brown': $color_master='#5e392b'; break;
case 'white_coffee': $color_master='#c9a789'; break;
case 'brown_coffee': $color_master='#a1866d'; break;
case 'magenta': $color_master='#881d98'; break;
case 'bordo': $color_master='#b3293b'; break;
case 'orange': $color_master='#e37f08'; break;
case 'green': $color_master='#4AAD1F'; break;
case 'green_lemon': $color_master='#94bc09'; break;
case 'paradise': $color_master='#008f87'; break;
case 'violet': $color_master='#ad5fa0'; break;
case 'purple_pink': $color_master='#c72486'; break;
case 'raspberry_pink': $color_master='#ed186d'; break;
case 'barbie_pink': $color_master='#ed0992'; break;
}
}



function adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));
    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));  
    $b = max(0,min(255,$b + $steps));
    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
    return '#'.$r_hex.$g_hex.$b_hex;
}
if($ht_background!='') { 
$ht_background_w=adjustBrightness($ht_background,'35');
$ht_background_w2=adjustBrightness($ht_background,'65');
$ht_background_d=adjustBrightness($ht_background,'-25');
$ht_background_d2=adjustBrightness($ht_background,'-45');
$ht_background_d1=adjustBrightness($ht_background,'-9');
}
if($menu_color!='') { 
$menu_color_w=adjustBrightness($menu_color,'35');
$menu_color_w2=adjustBrightness($menu_color,'65');
$menu_color_d=adjustBrightness($menu_color,'-25');
}

$color_master_w3=adjustBrightness($color_master,'85');
$color_master_w2=adjustBrightness($color_master,'65');
$color_master_w=adjustBrightness($color_master,'35');
$color_master_d=adjustBrightness($color_master,'-25');
$color_master_d2=adjustBrightness($color_master,'-45');
$color_master_d3=adjustBrightness($color_master,'-85');


if($ht_background!='') { ?>
.head_top_container{
background:<?php echo $ht_background; ?>!important;
position:relative;
}
.head_top_container {
border-bottom:<?php echo $ht_background_d; ?>!important;
}
.top_header_widget input#s {
background:<?php echo $ht_background_d; ?>!important;
border:1px solid <?php echo $ht_background_d2; ?>!important;
}
.top_header_widget input#s:focus {
border:1px solid <?php echo $ht_background_w; ?>!important;
}
ul#cb-menu li a:hover {
color:#000!important;
}
ul#cb-menu li.current-menu-item a:hover, ul#cb-menu li.current_page_item a:hover {
color:#000!important;
}
<?php } ?>

<?php if($menu_color!='') { ?>
ul#cb-menu li a {
color:<?php echo $menu_color; ?>!important;
}
ul#cb-menu li ul li a {
color:<?php echo $menu_color; ?>!important;
}
ul#cb-menu li a:hover {
color:#000!important;
}
<?php } 


if($color_master!='') { 
$color_master_w2=adjustBrightness($color_master,'65');
$color_master_w=adjustBrightness($color_master,'35');
$color_master_d=adjustBrightness($color_master,'-25');
$color_master_d2=adjustBrightness($color_master,'-45');
$color_master_d3=adjustBrightness($color_master,'-85');
?>

ul#cb-menu li a.cb-menu-search i {color:<?php echo $color_master; ?>!important;}
.bttn_big, a.bttn_big, input.bttn, .submit, a.more_cat {
color: #fff!important;
background-color: <?php echo $color_master; ?>;
}

.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover {
	background: <?php echo $color_master; ?>!important;	
	opacity:0.7;
}
a:hover,.req {
color:<?php echo $color_master;?>;
}
.footer i.small_rounded:hover, .footer i.medium_rounded:hover, .footer i.large_rounded:hover,
i.small_rounded, i.medium_rounded,i.large_rounded{
background:<?php echo $color_master;?>!important;
}
.skin,.skin a {
color:<?php echo $color_master;?>!important;
}
.sticky {
border-bottom:3px solid <?php echo $color_master;?>!important;
}
.skin-border{border-bottom:10px solid <?php echo $color_master;?>!important; }

.htop_widgets .ui-tabs .ui-tabs-nav li.ui-state-default.ui-state-active, .htop_widgets .ui-tabs li.ui-state-active, .htop_widgets .ui-state-active{
background:<?php echo $color_master_w; ?>!important;
}
.bttn, a.bttn, .submit, button, .button,.top_search .submit {
color: #fff;
background-color: <?php echo $color_master; ?>;
}
.wp-pagenavi a:hover, .wp-pagenavi span.current {
border: 1px solid #<?php echo $color_master;?>!important;
background: <?php echo $color_master;?>!important;
}
.wp-pagenavi span.current {
border: 1px solid <?php echo $color_master;?>!important;
background: <?php echo $color_master;?>!important;
}
.bttn_big:hover, a.bttn_big:hover, input.bttn:hover, .submit:hover, a.more_cat:hover {
color: #fff;
background-color: <?php echo $color_master_d; ?>;
}
.bttn:hover, a.bttn:hover, .submit:hover, button:hover, .button:hover {
color: #fff;
background-color: <?php echo $color_master_d; ?>;
}
.footer input.bttn:hover, .footer .submit:hover {
background-color: <?php echo $color_master_d; ?>;
border-bottom: 3px solid <?php echo $color_master_d2; ?>;
}
.footer input.bttn, .footer .submit {
background-color: <?php echo $color_master; ?>;
border-bottom: 3px solid <?php echo $color_master_d; ?>;
color: #FFF;
}
ul#cb-menu li a {
color:#4B4B4B!important;
}
ul#cb-menu li ul li a:hover {
background:#FFF!important;
color:<?php echo $color_master_d2; ?>!important;
}
ul#cb-menu li.current-menu-item a, ul#cb-menu li.current_page_item a {
background:#FFF!important;
color:<?php echo $color_master; ?>!important;
}
ul#cb-menu li.current-menu-item, ul#cb-menu li.current_page_item,.footer .cb-tweets li i {
color:<?php echo $color_master; ?>!important;
}
ul#cb-menu li.current-menu-item a:hover, ul#cb-menu li.current_page_item a:hover, ul#cb-menu li.current_page_item:hover a {
background:#FFF!important;
color:<?php echo $color_master; ?>!important;
}
ul#cb-menu li.current-menu-item ul li a, ul#cb-menu li.current_page_item ul li a,
ul#cb-menu li.current_page_item:hover ul li a {
color:#111!important;
}.load_more_products {
background-color: #FFFFFF;
color: #70726A!important;
}
.tp-caption.desc_skin_alt,.tp-caption.large_skin_alt,.tp-caption.vlarge_skin_alt,.products .price,.skin-text, .skin-text a, a.skin-text,.wp-pagenavi a, .wp-pagenavi span,.head_title.product_category_def h1.title,.term-description,.woocommerce div.product span.price, .woocommerce-page div.product span.price, .woocommerce #content div.product span.price, .woocommerce-page #content div.product span.price, .woocommerce div.product p.price, .woocommerce-page div.product p.price, .woocommerce #content div.product p.price, .woocommerce-page #content div.product p.price,#order_review .amount, #order_review .shipping td,.product-price .amount, .product-subtotal .amount, .shop_table .amount {
color:<?php echo $color_master_d3; ?>!important;
}
ul#cb-menu li.current-menu-item ul li a:hover, ul#cb-menu li.current_page_item ul li a:hover,#breadcrumbs i,.tp-caption.desc_skin,.woocommerce ul.products li.product .price del, .woocommerce-page ul.products li.product .price del,.cart_top .amount,.woocommerce div.product span.price del, .woocommerce-page div.product span.price del, .woocommerce #content div.product span.price del, .woocommerce-page #content div.product span.price del, .woocommerce div.product p.price del, .woocommerce-page div.product p.price del, .woocommerce #content div.product p.price del, .woocommerce-page #content div.product p.price del,.woo_step h1:hover,.woocommerce #payment label {
color:<?php echo $color_master; ?>!important;
}
.wp-pagenavi,a.nextpostslink,a.previouspostslink,.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range {
background:<?php echo $color_master_d3; ?>!important;
}
.skin_bg_alt,#middle .wn .widrig_left,mark,.woocommerce span.onsale, .woocommerce-page span.onsale,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
.tagcloud a,.widrig,.blog_end,.post_item:hover,#mobile-menu .sub-menu a:hover, .tagcloud a:hover,.cb5_recent_posts h4:hover,.skin_bg,.bline-line,.logo_demo,.woocommerce a.button.alt, .woocommerce-page a.button.alt, .woocommerce button.button.alt, .woocommerce-page button.button.alt, .woocommerce input.button.alt, .woocommerce-page input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce-page #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page #content input.button.alt,.facebook:hover, .twitter:hover, .skype:hover, .rss:hover,.woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button,.email.submit:hover,.postbox .bttn_big, .postbox .bttn, .view_all,input.submit,i.caretos_brown,.cat_read_more,.current-cat .caretos, .product-categories li > a:hover .caretos,.chzn-container .chzn-results .highlighted,.thanks  {
background:<?php echo $color_master; ?>!important;
}
.nav-mobile {
background: url(<?php echo WP_THEME_URL;?>/img/menu.png) center top no-repeat <?php echo $color_master; ?>!important;
}
.email.submit {
background-color: #fff!important;
color:<?php echo $color_master; ?>!important;
}
.tagcloud a {color:#FFF!important;}
.view_all,a.alt,.bttn.alt,.bttn_big.alt {
background:#d6d8cb!important;
color:#FFF!important;
}.woocommerce-info {
border-top: 3px solid <?php echo $color_master; ?>!important;
}.woocommerce-info:before {
background-color: <?php echo $color_master; ?>!important;
}
.email.submit:hover {
background-color:<?php echo $color_master; ?>!important;
color:#fff!important;
}
.cart_top .cart-contents {
background: url(<?php echo WP_THEME_URL;?>/img/icons/icon-basket_grey.png) 0px 27px no-repeat transparent;
}
.load_more_products:hover {
color:#FFF!important;
background:<?php echo $color_master_d3; ?>!important;
}.fade_woo.hover {
border: 4px solid <?php echo $color_master; ?>!important;
}
.tp-caption.skin_bttn,.circle_skin_bg_alt {
background-color:<?php echo $color_master; ?>!important;
}.slider_top,.bread_wrap {
border-bottom: 4px solid <?php echo $color_master; ?>!important;
}.email_submit input:focus {
border: 2px solid <?php echo $color_master; ?>!important;
}input:focus, textearea:focus {
border: 1px solid <?php echo $color_master; ?>!important;
}

.skin-text{
color:<?php echo $color_master_d2; ?>!important;
}

.bbot,.borderb {
border-bottom:3px solid <?php echo $color_master; ?>!important;
}
#sidebar_r .menu li.current_page_item a, #sidebar_l .menu li.current_page_item a, #sidebar_r .menu li.current-menu-item a, #sidebar_l .menu li.current-menu-item a {
border-left: 3px solid <?php echo $color_master; ?>!important;
}


ul#cb-menu ul li a:hover {
	color: #fff!important;
	background: <?php echo $color_master; ?>!important;
}

ul#cb-menu li.current-menu-item ul li a:hover,ul#cb-menu li.current_page_item ul li a:hover
	{
	color: #fff!important;
	background: <?php echo $color_master; ?>!important;
}

.products_style a i{
color:#888!important;
}
.products_style a.active i{
color:<?php echo $color_master; ?>!important;
}
.cart_top {
line-height: 72px;
}
.fade_border {-moz-box-shadow: inset 0 0 0px 4px <?php echo $color_master; ?>!important;
-webkit-box-shadow: inset 0 0 0px 4px<?php echo $color_master; ?>!important;
box-shadow: inner 0 0 0px 4px <?php echo $color_master; ?>!important; }
<?php } //## COLOR MASTER END ##









?>

.divider5 {
border-top:1px solid <?php echo $shad; ?>;
}

#middle .date,.aq-block-aq_team_block .frame{
border:3px solid #dbdfe0;
border-radius:2px;
-webkit-border-radius:2px;
-moz-border-radius:2px;
}
.col1.post-cat .ddd {border:0;border-radius:0;-moz-border-radius:0;-webkit-border-radius:0;}
.aq-block-aq_team_block .frame{
border:0;
}
.aq-block .post-cat.col1.ddd{
border:0!important;
}
.date .day {
border-bottom:1px solid <?php echo $shad; ?>;
}


<?php if($logo_font!='') { ?>
.logo a {
font-size:<?php echo $logo_font; ?>;
}<?php } ?>
<?php if($menu_font_size!='') { ?>
#cb-menu li a {
font-size:<?php echo $menu_font_size; ?>!important;
}<?php } ?>

<?php if($logo_color!='') { ?>
.logo h1 a {
color:<?php echo $logo_color; ?>!important;
}
<?php } ?>

<?php if($slogan_color!='') { ?>
.blog-description {
color:<?php echo $slogan_color; ?>!important;
}
<?php } ?>

<?php if($logo_shad!='') { ?>
.logo h1 a {
text-shadow:1px 1px <?php echo $logo_shad; ?>!important;
}
<?php } ?>

<?php if($text_color!='') { ?>
body,html,.post-front-inner,.footer,.footer h2 {
color:<?php echo $text_color; ?>
}
<?php } ?>

<?php  if($headings_color!='') { ?>
a.more,
h1,h2,h3,h4,h5,h6,
h1 a,h1 a:link,h1 a:visited,h1 a:active,
h2 a,h2 a:link,h2 a:visited,h2 a:active,
h4 a,h4 a:link,h4 a:visited,h4 a:active,
h5 a,h5 a:link,h5 a:visited,h5 a:active,
h3 a,h3 a:link,h3 a:visited,h3 a:active,
h6 a,h6 a:link,h6 a:visited,h6 a:active {
color:<?php echo $headings_color; ?>!important;
}<?php } ?>
<?php  if($links_color!='') { ?>
a,a:link,a:visited {
color:<?php echo $links_color; ?>;
}<?php } ?>
<?php if($links_hover_color!='') { ?>
a:hover {
color:<?php echo $links_hover_color; ?>;
}<?php } ?>



<?php if($stripes_bg_schema!=''&&$stripes_bg_schema!='none') { ?>
 <?php if($stripes_bg_schema!='1.png'&&$stripes_bg_schema!='1.png'&&$stripes_bg_schema!='1.png'&&
 $stripes_bg_schema!='1.png'&&$stripes_bg_schema!='2.png'&&$stripes_bg_schema!='3.jpg'&&
 $stripes_bg_schema!='4.png'&&$stripes_bg_schema!='5.png'&&$stripes_bg_schema!='6.png'&&
 $stripes_bg_schema!='7.png'&&$stripes_bg_schema!='8.png'&&$stripes_bg_schema!='9.png'&&
 $stripes_bg_schema!='10.png'&&$stripes_bg_schema!='11.png'&&$stripes_bg_schema!='12.png'&&
 $stripes_bg_schema!='13.png'&&$stripes_bg_schema!='14.png'&&$stripes_bg_schema!='15.png'&&
 $stripes_bg_schema!='16.png'){ ?>
body {
background:url(<?php echo WP_THEME_URL; ?>/img/bg/<?php echo $stripes_bg_schema; ?>) center top repeat <?php if($background_color!='') { echo $background_color; } else echo'transparent';?>;
}
 <?php } else { ?>
body {
background:url(<?php echo WP_THEME_URL; ?>/img/bg/<?php echo $stripes_bg_schema; ?>) center top repeat <?php if($background_color!='') { echo $background_color; } else echo'transparent';?>;
<?php if($bg_str=='yes') {?>background-size:100%;<?php } ?>
}
.bg_mid_alpha {
background:url(<?php echo WP_THEME_URL; ?>/img/bg/<?php echo $stripes_bg_schema; ?>) center top repeat <?php if($background_color!='') { echo $background_color; } else echo'transparent';?>;
<?php if($bgf_str=='yes') {?>background-size:100%;<?php } ?>
}
<?php } } ?>


<?php if($middle_background!='') { ?>
#middle {
background:<?php echo $middle_background; ?>;
}<?php } ?>

<?php if($middle_backgroundi!='') { ?>
.bg_mid_alpha {
background:url(<?php echo $middle_backgroundi; ?>) center center repeat;
<?php if($bgf_str=='yes'){ ?>background-size:100%;<?php } ?>
}<?php } ?>

<?php if($middle_backgroundc!='') { ?>
.bg_mid_alpha {
background-color:<?php echo $middle_backgroundc; ?>;
}<?php } ?>

<?php if($upload_bg!=''){ ?>
#bg {
background:url("<?php echo $upload_bg; ?>") center top no-repeat <?php if($bg_fixed=='yes') {?>fixed<?php } ?><?php if($background_color!='') { echo $background_color; } else { ?> transparent<?php } ?>;
<?php if($bg_str=='yes'){ ?>background-size:100%;<?php } ?>
} <?php } ?>
<?php if($background!=''&&$background!='0'&&$upload_bg==''){ ?>
#bg { 
background:url("<?php echo WP_THEME_URL.'/img/bg/'.$background; ?>.jpg") center top no-repeat <?php if($bg_fixed=='yes') {?>fixed<?php } ?> <?php if($background_color!='') { echo $background_color; } else { ?> transparent<?php } ?>;
<?php if($bg_str=='yes'){ ?>background-size:100%;<?php } ?>
}
<?php } ?>

<?php if($mwid!=''&&$mwid!='none') { ?>
.bg_mid_alpha {
background:url(<?php echo WP_THEME_URL; ?>/img/bg/<?php echo $mwid; ?>) center top repeat <?php if($background_color!='') { echo $background_color; } else echo'transparent';?>;
}
<?php } ?>

<?php if($background_color!='') { ?>
body {
background-color:<?php echo $background_color; ?>;
}
<?php } 


if(!isset($dfixed))$dfixed='';  if($wid=='fixed'||$dfixed=='true') { ?>

.slider_top {
width: 1034px;
margin: 0 auto;
<?php if($cb_type!='home'&&(!is_home()||!is_front_page())) { ?>top:0px;<?php } ?>
}

.widget_top {
width: 1034px;
margin:0 auto;
}
.head_top {
border:0px solid <?php echo $shad; ?>;
border-top:0;
width:974px;
margin:0 auto;
margin-left:-28px;
left:auto;
}

.head_top .wrapper_p {
width:auto!important;
}

.bg_mid_alpha,#middle{
padding-left:27px;
padding-right:27px;
width:980px;
margin:0 auto;
border:0px solid <?php echo $shad; ?>;
}
.footer {
padding-left:27px;
padding-right:27px;
width:980px;
margin:0 auto;
}
.top_header_left,.top_header_left_widget {
width:980px;
}
.head_top_container {
width: 1034px;
margin: 0 auto;
position: relative;
-webkit-border-bottom-right-radius: 2px;
-webkit-border-bottom-left-radius: 2px;
-moz-border-radius-bottomright: 2px;
-moz-border-radius-bottomleft: 2px;
border-bottom-right-radius: 2px;
border-bottom-left-radius: 2px;
}.bg_mid_alpha .wrapper_p {
background: transparent;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
padding-top: 30px;
padding-bottom: 20px;
}
.footer {
-webkit-border-bottom-right-radius: 10px;
-webkit-border-bottom-left-radius: 10px;
-moz-border-radius-bottomright: 10px;
-moz-border-radius-bottomleft: 10px;
border-bottom-right-radius: 10px;
border-bottom-left-radius: 10px;
}
<?php if($shad2!='') { ?>
.head_top_container,#middle,.footer,.footer-lower {
-webkit-box-shadow: 2px 0 10px  <?php echo $shad2; ?>,  -2px 0 10px <?php echo $shad2; ?>;   
-moz-box-shadow: 2px 0 10px <?php echo $shad2; ?>,  -2px 0 10px <?php echo $shad2; ?>;   
box-shadow: 2px 0 10px <?php echo $shad2; ?>,  -2px 0 10px <?php echo $shad2; ?>; 
}
<?php } ?>

.footer-lower {
<?php if($bors=='no') { ?>
padding-left:27px;
padding-right:27px;
<?php } else { ?>
padding-left:27px;
padding-right:27px;
border:0;
<?php } ?>
width:980px;
margin:0 auto;
}

.bg_mid_alpha {
border:0;
}
.footer {
border-bottom:0;
}

.bg_mid_alpha .wrapper_p, .footer .wrapper_p {
padding:0px;
width:980px;
}
.bread_wrap {width:1034px;margin:0 auto;}
.port_sorter {width:1175px!important;margin:0 auto!important;left:auto!important;border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;}
#middle {
-webkit-border-top-left-radius: 2px;
-webkit-border-top-right-radius: 2px;
-moz-border-radius-topleft: 2px;
-moz-border-radius-topright: 2px;
border-top-left-radius: 2px;
border-top-right-radius: 2px;
}
<?php } ?>


<?php if(($showtopwidget=='no'&&(is_front_page()||is_home()))||$hide_top=='yes'){?>
.widget_top {display:none!important;}
<?php } ?>


<?php if($iconspos=='bottom'&&$mheadertype!='left'){?>
.bg_head{
position:relative!important;
}
<?php if((is_home()||is_front_page())||($header_type=='slider_head'||$header_type=='bg_head'||$header_type=='map')){ ?> 
.below_header{
<?php if($header_type=='bg_head'){?>
bottom:10px;
color:#FFF!important;
<?php } else { ?>
bottom:50px;
<?php } ?>
}
<?php if($header_type=='bg_head'){?>
.below_header i {
color:#FFF!important;
}
<?php } ?>

<?php } ?>
.below_header{z-index:24;}
<?php } ?>

<?php if($iconspos=='bottom'){?>
.below_header{bottom:0;}
<?php } ?>




<?php 

if($fixed_top=='yes') { ?>
.head_top_container,.widget_top{
position:fixed!important;
width:100%;
margin:0 auto;
z-index:21;
margin-top:0px;
}
.head_title,.below_header {
padding-top: 40px;
}
ul#cb-menu li > a {color:#FFF;}
<?php if(!isset($dfixed))$dfixed='';  if($wid=='fixed'||$dfixed=='true') { ?>
.head_top_container {width:1034px;}
.below_header{width:1034px;}
.widget_top{width:1034px;}

<?php } ?>
<?php if(is_active_sidebar('top-widget')&&$hide_top!='yes'){?>.head_top_container {
<?php if($showtopwidget=='no'&&(is_home()||is_front_page())){}else{ ?>margin-top:30px<?php } ?>
}<?php } ?>
<?php if(is_active_sidebar('top-widget')&&$hide_top!='yes'){?>.widget_top {
<?php if($showtopwidget=='no'&&(is_home()||is_front_page())){}else{ ?>margin-top:0px<?php } ?>
}<?php } ?>

.fixed_top {
height:70px; <?php if($headertransparent=='yes'){ ?> height:0px;<?php } ?>
}

<?php if(is_active_sidebar('top-widget')&&$hide_top!='yes'){?>.fixed_top {
<?php if($showtopwidget=='no'&&(is_home()||is_front_page())){}else{ ?>height:100px<?php } ?>
}<?php } ?>



<?php } else if($fixed_top=='yes') { ?>
.head_top_container,#top_widget {
position:fixed!important;
width:100%;
z-index:999;
margin-top:0px;
}
.slider_top {
padding-top:55px;
}
.head_top {
left:0;
}
.below_header {
<?php if($mheadertype!='left') { ?>top:120px;<?php } else { ?>
top:160px;<?php } ?>
}
.slider_top {
<?php if($cb_type!='home'&&(!is_not_home||!is_front_page())) { ?>top: -16px;margin-bottom:-16px!important;<?php } ?>
}

<?php } ?>











<?php if($bors=='no') { ?>
#middle,.head_top,.footer {
border:0px!important;
}
<?php } ?>
<?php if($bors_h=='no') { ?>
.head_top {
border-bottom:0px!important;
}
<?php } ?>
<?php if($bors_f=='no') { ?>
.footer {
border-top:0px!important;
}
<?php } ?>
<?php if($mwh!='') { ?>
.bg_mid_alpha .more,
.bg_mid_alpha h1,.bg_mid_alpha h2,.bg_mid_alpha h3,.bg_mid_alpha h4,.bg_mid_alpha h5,.bg_mid_alpha h6,
.bg_mid_alpha h1 a,.bg_mid_alpha h2 a,.bg_mid_alpha h3 a,.bg_mid_alpha h4 a,.bg_mid_alpha h5 a,.bg_mid_alpha h6 a,
.bg_mid_alpha h1 a:link,.bg_mid_alpha h2 a:link,.bg_mid_alpha h3 a:link,.bg_mid_alpha h4 a:link,.bg_mid_alpha h5 a:link,.bg_mid_alpha h6 a:link {
color:<?php echo $mwh; ?>!important;
}
<?php } ?>
<?php if($mw!='') { ?>
.bg_mid_alpha {
color:<?php echo $mw; ?>!important;
}
<?php } ?>
<?php if($o_foot=='half') { ?> .footer { background:url(<?php echo WP_THEME_URL;?>/img/opacity/b_50.png) repeat transparent!important; } <?php } ?>
<?php if($o_foot=='not') { ?> .footer { background:none!important; } <?php } ?>
<?php if($o_mid=='half') { ?> .bg_mid_alpha { background:url(<?php echo WP_THEME_URL;?>/img/opacity/w_50.png) repeat transparent!important; } <?php } ?>
<?php if($o_mid=='not') { ?> .bg_mid_alpha { background:none!important; } <?php } ?>
<?php if($o_con=='half') { ?> #middle { background:url(<?php echo WP_THEME_URL;?>/img/opacity/w_50.png) repeat transparent!important; } <?php } ?>
<?php if($o_con=='not') { ?> #middle { background:none!important; } <?php } ?>
<?php if($color_schema=='black.css') { ?>
<?php if($o_foot=='half') { ?> .footer { background:url(<?php echo WP_THEME_URL;?>/img/opacity/b_50.png) repeat transparent!important; } <?php } ?>
<?php if($o_foot=='not') { ?> .footer { background:none!important; } <?php } ?>
<?php if($o_head=='half') { ?> .head_top { background:url(<?php echo WP_THEME_URL;?>/img/opacity/b_50.png) repeat transparent!important; } <?php } ?>
<?php if($o_head=='not') { ?> .head_top { background:none!important; } <?php } ?>
<?php if($o_mid=='half') { ?> .bg_mid_alpha { background:url(<?php echo WP_THEME_URL;?>/img/opacity/b_50.png) repeat transparent!important; } <?php } ?>
<?php if($o_mid=='not') { ?> .bg_mid_alpha { background:none!important; } <?php } ?>
<?php if($o_con=='half') { ?> #middle { background:url(<?php echo WP_THEME_URL;?>/img/opacity/b_50.png) repeat transparent!important; } <?php } ?>
<?php if($o_con=='not') { ?> #middle { background:none!important; } <?php } ?>
<?php } ?>

<?php if($logo_f!='------') { 
$logo_f=str_replace(' ','%20',$logo_f);$logo_f=str_replace('+','%20',$logo_f);
$logo_f2=str_replace('%20',' ',$logo_f);
?>
.logo h1 a {
font-family:<?php echo $logo_f2; ?>,sans-serif,sans;
}
<?php }
?>

<?php if($menu_f!='------') { 
$menu_f=str_replace(' ','%20',$menu_f);$menu_f=str_replace('+','%20',$menu_f);
$menu_f2=str_replace('+','%20',$menu_f);
$menu_f2=str_replace('%20',' ',$menu_f);
?>
#cb-menu li a {
font-family:<?php echo $menu_f2; ?>,sans-serif,sans;
}
<?php }
?>

<?php  if($headings_up=='uppercase') { ?>
h1,h2,h3,h4,h5,h6,
h1 a,h1 a:link,h1 a:visited,h1 a:active,
h2 a,h2 a:link,h2 a:visited,h2 a:active,
h4 a,h4 a:link,h4 a:visited,h4 a:active,
h5 a,h5 a:link,h5 a:visited,h5 a:active,
h3 a,h3 a:link,h3 a:visited,h3 a:active,
h6 a,h6 a:link,h6 a:visited,h6 a:active {
text-transform:uppercase;
}
<?php } ?>



<?php if($color_master=='') $color_master='#27a4c8'; ?>
.skinimp {
/*background:<?php echo $color_master;?>!important;*/
background:rgba(0,0,0,0.5)!important;
}
<?php 
preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
if (count($matches)>1){
  $version = $matches[1];
  switch(true){
    case ($version<=8):
?>
.skinimp {background:#111!important;}
<?php
    break;
    default:
  }
}

?>



<?php if($ht_backgroundp!=''){?>
.head_top_container{background:<?php echo $ht_backgroundp;?>!important;}
<?php } ?>






h1,h2,h3,h4,h5,h6,
h1 a,h1 a:link,h1 a:visited,h1 a:active,
h2 a,h2 a:link,h2 a:visited,h2 a:active,
h4 a,h4 a:link,h4 a:visited,h4 a:active,
h5 a,h5 a:link,h5 a:visited,h5 a:active,
h3 a,h3 a:link,h3 a:visited,h3 a:active,
h6 a,h6 a:link,h6 a:visited,h6 a:active {
font-weight:<?php echo $headings_upw; ?>;
}
h1.tit,h2.tit,h3.tit,h4.tit,h5.tit,h6.tit,
h1.tit a,h1.tit a:link,h1.tit a:visited,h1.tit a:active,
h2.tit a,h2.tit a:link,h2.tit a:visited,h2.tit a:active,
h4.tit a,h4.tit a:link,h4.tit a:visited,h4.tit a:active,
h5.tit a,h5.tit a:link,h5.tit a:visited,h5.tit a:active,
h3.tit a,h3.tit a:link,h3.tit a:visited,h3.tit a:active,
h6.tit a,h6.tit a:link,h6.tit a:visited,h6.tit a:active {
font-weight:<?php echo $headings_upw_t; ?>;
}

h1.title,.h1.title a,h1.title a:link {
text-transform:none!important;
font-weight:bold!important;
}

<?php $buffer = ob_get_contents();
ob_end_clean();
echo str_replace("\n",null,$buffer);?>
</style>

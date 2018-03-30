<style type="text/css" media="screen">
<?php ob_start();

if ( in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
if(is_shop())$post->ID=woocommerce_get_page_id('shop');
}

$cb_get_css_generate=cb_get_css_generate_options($post->ID);


/* ================================================
 * SKIN GENERATOR
 * ================================================ */
if($cb_get_css_generate['skinimp']=='white'){?>
.is_anim ul.cb-menu li a{color:#222;}
<?php } 
if($cb_get_css_generate['cap_bg']!=''){?>
.featured_image .caption,.featured_image .contain{background:<?php echo $cb_get_css_generate['cap_bg'];?>!important;}
<?php } 



if($cb_get_css_generate['color_master']==''||$cb_get_css_generate['flat']=='yes') { 
$cb_get_css_generate['color_master']=$cb_get_css_generate['color_style'];
$get_color='';
if($get_color=='white') $get_color='';
if($get_color!='') $cb_get_css_generate['color_style']=$get_color;


	switch($cb_get_css_generate['color_style']) {
		case 'red': $cb_get_css_generate['color_master']='#d12c2c'; break;
		case 'black': $cb_get_css_generate['color_master']='#141414'; break;
		case 'blue': $cb_get_css_generate['color_master']='#27a4c8'; break;
		case 'green': $cb_get_css_generate['color_master']='#7dac2a'; break;
		case 'grey': $cb_get_css_generate['color_master']='#767676'; break;
		case 'brown': $cb_get_css_generate['color_master']='#553939'; break;
		case 'orange': $cb_get_css_generate['color_master']='#e8aa04'; break;
		case 'gold': $cb_get_css_generate['color_master']='#d1ae72'; break;
		case 'magenta': $cb_get_css_generate['color_master']='#a0479f'; break;
		case 'dark_red': $cb_get_css_generate['color_master']='#8e0a0a'; break;
		case 'lemon': $cb_get_css_generate['color_master']='#88bf12'; break;
}
}
function adjustBrightness($hex, $steps) {
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
if($cb_get_css_generate['ht_background']!='') {
	$ht_background_w=adjustBrightness($cb_get_css_generate['ht_background'],'35');
	$ht_background_w2=adjustBrightness($cb_get_css_generate['ht_background'],'65');
	$ht_background_d=adjustBrightness($cb_get_css_generate['ht_background'],'-25');
	$ht_background_d2=adjustBrightness($cb_get_css_generate['ht_background'],'-45');
	$ht_background_d1=adjustBrightness($cb_get_css_generate['ht_background'],'-9');
}

$color_master=$cb_get_css_generate['color_master'];
$color_master_w=adjustBrightness($cb_get_css_generate['color_master'],'35');
$color_master_w2=adjustBrightness($cb_get_css_generate['color_master'],'65');
$color_master_w3=adjustBrightness($cb_get_css_generate['color_master'],'85');
$color_master_d=adjustBrightness($cb_get_css_generate['color_master'],'-25');
$color_master_d2=adjustBrightness($cb_get_css_generate['color_master'],'-45');
$color_master_d3=adjustBrightness($cb_get_css_generate['color_master'],'-85');


if($cb_get_css_generate['ht_background']!='') {
?>
.head_tope{
background:<?php echo $cb_get_css_generate['ht_background']; ?>!important;
position:relative;
}<?php
//menu text color
if($cb_get_css_generate['m_color']!='') { ?>
.cb-menu > li > a,ul.cb-menu li.current-menu-item ul li a:hover, ul.cb-menu li.current_page_item ul li a:hover,ul.cb-menu ul li a:hover {
color:<?php echo $cb_get_css_generate['m_color'].'!important;' ?>;
}ul.cb-menu li.current-menu-item > a, ul.cb-menu li.current_page_item > a {
background:<?php echo $cb_get_css_generate['m_color'].'!important;' ?>;
}ul.cb-menu ul{border:3px solid <?php echo $cb_get_css_generate['m_color'].'!important;' ?>;}
<?php } ?>

<?php }

if($cb_get_css_generate['menu_color_ac']!='') { ?>
 .top-menu li.current_page_item > a,.top-menu li.current-menu-item > a{
color:<?php echo $cb_get_css_generate['menu_color_ac']; ?>!important;
}
<?php } 
if($cb_get_css_generate['menu_color']!='') { ?>
 .bg_head ul.cb-menu > .mega > ul > li > a {
color:<?php echo $cb_get_css_generate['menu_color']; ?>!important;
}
<?php } 
else {
?>
.bg_head ul.cb-menu > .mega > ul > li > a {
color:#111!important;
}
<?php
}
if($cb_get_css_generate['menu_color']!='') { ?>
.top-menu li >a {
	color:<?php echo $cb_get_css_generate['menu_color']; ?>!important;
}
<?php }
if($cb_get_css_generate['menu_color_hover']!='') { ?>
.top-menu li >a:hover,.mega .sub-menu li a:hover {
	color:<?php echo $cb_get_css_generate['menu_color_hover']; ?>!important;
}
<?php }
if($cb_get_css_generate['menu_color_active']!='') { ?>
.top-menu .current-menu-item,.top-menu .current_page_item > a {
	color:<?php echo $cb_get_css_generate['menu_color_active']; ?>!important;
}
<?php }


if($cb_get_css_generate['menu_up']!='') { 
if($cb_get_css_generate['menu_up']=='normal') $cb_get_css_generate['menu_up']='none';?>
.top-menu > ul > li > a{
text-transform:<?php echo $cb_get_css_generate['menu_up']; ?>;
}
<?php } 
if($cb_get_css_generate['menu_upw']!='') {
if($cb_get_css_generate['menu_upw']=='bold') $cb_get_css_generate['menu_upw']='600';?>
.top-menu > ul > li > a{
font-weight:<?php echo $cb_get_css_generate['menu_upw']; ?>;
}
<?php } 


if($cb_get_css_generate['color_master']!='') {
$color_master_w2=adjustBrightness($cb_get_css_generate['color_master'],'65');
$color_master_w=adjustBrightness($cb_get_css_generate['color_master'],'35');
$color_master_d=adjustBrightness($cb_get_css_generate['color_master'],'-25');
$color_master_d2=adjustBrightness($cb_get_css_generate['color_master'],'-45');
$color_master_d3=adjustBrightness($cb_get_css_generate['color_master'],'-85');
?>
a.tweet{
color:#111!important;
}
ul.cb-menu li.current-menu-item > a, ul.cb-menu li.current_page_item > a,ul.cb-menu li.current-menu-item>a, ul.cb-menu li.current_page_item>a,
.footer a:hover i,.team_position,.team_icons a:hover,.team_icons i:hover,
.woocommerce div.product span.price del, .woocommerce-page div.product span.price del, .woocommerce #content div.product span.price del, .woocommerce-page #content div.product span.price del, .woocommerce div.product p.price del, .woocommerce-page div.product p.price del, .woocommerce #content div.product p.price del,
.woocommerce-page #content div.product p.price del,.tweet_date,.woocommerce .widget .amount,.totaly td,.product-price .amount,
 #order_review .shipping td,.woo_step h1:hover,
.bar_cont_in .menu li:hover a,.widget_search i,ul.cb-menu li ul li a:hover,.cb-twitter .tweet:hover,.woocommerce .star-rating span,
.woocommerce-page .star-rating span,#mobile-menu a:hover,#mobile-menu .sub-menu a:hover,#mobile-menu .sub-menu .current-menu-item a,
#mobile-menu .sub-menu .current_page_item a{
color:<?php echo $color_master;?>!important;
}
.tagcloud a:hover,.reply a:hover,.select2-results .select2-highlighted,.icons a:hover,.select2-results .select2-highlighted,
.content_wrap.masonry-brick .more:hover,.col1 .more:hover,ul.bar-socials li a:hover i,.menu-icon-bottom i,
.load_more_products:hover, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button,
.woocommerce-page #content input.button,.shipping-calculator-button:hover,.thanks,.animate.fullbg-after_skin:hover,#sidebar_r .clients-container .clients-slide-controls img,
#sidebar_l .clients-container .clients-slide-controls img,.tagcloud a,img.testimonial-image:hover,
.prod_icons a:hover,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,a.shipping-calculator-button{
background: <?php echo $color_master;?>!important;
}
.woocommerce-message {
border-top: 3px solid <?php echo $color_master;?>!important;
}
.footer a,ul.cb-menu li:hover>a,ul.cb-menu li:hover,ul.cb-menu li a:hover,a:hover,.normal li a:hover, .widget_rss li a:hover, .widget_links li a:hover, .widget_categories li a:hover, .product-categories li a:hover,
.widget_archive li a:hover, .widget_pages li a:hover, .widget_meta li a:hover, .widget_recent_comments li a:hover, .widget_recent_entries li a:hover,
.bg_head ul.cb-menu > .mega > ul > li > a,.products .price del,.products .price,.top-cart-price,.grid-list-buttons li.active i,
.section-contact-page .contact-info-holder .contact-info-holder p a,.section-stats .stat-item .value,.content-holder.about-us p a,.content-holder.about-us p a
{
color:<?php echo $color_master;?>;
}.mini-prev:hover, .mini-next:hover {
border-color:<?php echo $color_master;?>;
}
.bttn_big,a.bttn_big,.cart-contents i {
background: <?php echo $color_master;?>;
}
input.bttn, .submit,.total-buble,header:after,.sale-product,.add_to_cart_button, .product .button, a.add_to_cart_button,.woocommerce .woocommerce-info:before,
.woocommerce-page .woocommerce-info:before,.md-button{
background-color: <?php echo $color_master;?>!important;
}.woocommerce .woocommerce-info:before, .woocommerce-page .woocommerce-info:before {
background: none!important;
color: <?php echo $color_master;?>!important;
}
.add_to_cart_button:hover, .product .button:hover,a.shipping-calculator-button:hover,.md-button:hover {
background-color: <?php echo $color_master_d2;?>!important;
}
.woocommerce a.button:hover, .woocommerce-page a.button:hover, .woocommerce button.button:hover, .woocommerce-page button.button:hover, .woocommerce input.button:hover,.woocommerce input.button.alt:hover, .woocommerce-page input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page #content input.button:hover {
background: <?php echo $color_master_d3;?>!important;
}
.woocommerce-page a.button.alt, .woocommerce button.button.alt, .woocommerce-page button.button.alt, .woocommerce input.button.alt, .woocommerce-page input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce-page #respond input#submit.alt, .woocommerce #content input.button.alt,
 .woocommerce-page #content input.button.alt,.single-product-info-holder .chosen-container .chosen-results li.highlighted{
background: <?php echo $color_master;?>!important;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle {
border:2px solid  <?php echo $color_master;?>!important;
}
.woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info {
border-top: 3px solid <?php echo $color_master;?>!important;
}
.section-contact-page .contact-info-holder .contact-info-holder p a,.content-holder.about-us p a,.content-holder.about-us p a {
border-bottom:1px solid  <?php echo $color_master;?>!important;
}.quantity input.qty:hover, .quantity input.qty:focus, input:focus {
border:1px solid  <?php echo $color_master;?>!important;
}
.mega-icon > ul::after{
background: none!important;
}.tp-bullets.simplebullets.round .bullet {
background: url(<?php echo WP_THEME_URL; ?>/img/modello/slider-btns-grey.png) no-repeat 1px 0;
}
.pagination-buttons li.current a, .pagination-buttons li a:hover, nav.woocommerce-pagination ul li span.current, nav.woocommerce-pagination ul li a:hover, .wp-pagenavi a:hover, .wp-pagenavi span.current {
background: url(<?php echo WP_THEME_URL; ?>/img/modello/paginations-btns-grey.png) no-repeat -54px 3px !important;
}
.section-contact-page .contact-info-holder {
background-image: url(<?php echo WP_THEME_URL; ?>/img/contactus-middle-holder-grey.png);
}
textarea:focus, input:focus {
border: 1px solid <?php echo $color_master;?>!important;
}
.footer.black a i,.footer.green a i,.footer.red a i,.footer.blue a i{
color:#FFF!important;
}
.footer.black a,.footer.green a,.footer.red a,.footer.blue a{
color:#FFF!important;
}
.footer.black a:hover i,.footer.green a:hover i,.footer.red a:hover i,.footer.blue a:hover i{
color:#F9F9F9!important;
}
i.grid_left {
background: <?php echo $color_master;?>!important;
}i.grid_left:hover,.grid_left.animate.ani_color_after_blue:hover,.woocommerce ul.products li.product .price del,
.woocommerce-page ul.products li.product .price del,.products .price del,.mega .sub-menu li a:hover {
color: <?php echo $color_master;?>!important;
}
.fullbg-red .products .price del{color:#eee!important}
.fullbg-red .products .price,.fullbg-black .product .price,.fullbg-red .product .price{color:#FFF!important;}
.bttn_big:hover,a.bttn_big:hover,.cb-twitter .user:hover img,.cart-contents:hover i {
background: <?php echo $color_master_w;?>;
}.bttn_big.cb_load_more:hover,.footer.red .tagcloud a,.foot_icons a:hover {
background: <?php echo $color_master_w;?>!important;
}.woocommerce a.button, .woocommerce-page a.button,.woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button{
background: <?php echo $color_master;?>;
}.bttn:hover,a.bttn:hover,.bttn_big:hover{color:#FFF;}
ul.cb-menu ul {
border:3px solid <?php echo $color_master;?>!important;
}.wp-pagenavi a:hover,.wp-pagenavi span.current {
border: 1px solid <?php echo $color_master;?>;
background: <?php echo $color_master;?>;
}.wp-pagenavi span.current {
border: 1px solid <?php echo $color_master;?>;
background: <?php echo $color_master;?>;
}.navi_full .fullb.fullbg-black .wp-pagenavi span.current,.navi_full .fullb.fullbg-black .wp-pagenavi a:hover {
border: 1px solid <?php echo $color_master;?>!important;
background: <?php echo $color_master_w;?>!important;
}#sidebar_r .menu li a:hover,#sidebar_l .menu li a:hover {
background: <?php echo $color_master;?>!important;
border-top:1px solid <?php echo $color_master;?>!important;
}.post_item a:hover,.list_style .col1 .bttn.more i {
color:<?php echo $color_master;?>!important;
}.progressBar div {
background-color: <?php echo $color_master;?>!important;
}.bttn, a.bttn, .submit, button, .button,a.bttn:hover,
.bttn:hover, .submit:hover, .bttn_big:hover, button:hover, input.bttn:hover, .submit:hover, a.more_cat:hover, .button:hover {
background-color: <?php echo $color_master;?>;
}.select2-drop-active {
border: 1px solid <?php echo $color_master;?>!important;
}.select2-container-active .select2-choice, .select2-container-active .select2-choices,.select2-drop-active,
.select2-container-active .select2-choice, .select2-container-active .select2-choices,.select2-container-active .select2-choice,
.select2-container-active .select2-choices {
border: 1px solid <?php echo $color_master;?>!important;
}#sidebar_r .widget > h3::after, #sidebar_l .widget > h3::after, .testimonials-container > h3.tit::after {
border-bottom: 1px solid <?php echo $color_master;?>!important;
}.cart_container .alt:hover {
background: <?php echo $color_master;?>!important;
border: 1px solid <?php echo $color_master;?>!important;
}.animate.fullbg-after_skin:after {
box-shadow: 0 0 0 4px <?php echo $color_master;?>!important;
}#sidebar_r .menu li.current_page_item a, #sidebar_l .menu li.current_page_item a, #sidebar_r .menu li.current-menu-item a, #sidebar_l .menu li.current-menu-item a {
border-left: 3px solid <?php echo $color_master;?>!important;
}


::-moz-selection {
    background-color: <?php echo $color_master;?>!important;
    color: #fff;
    text-shadow: none;
    -webkit-text-shadow: none;
}
::selection {
    background-color: <?php echo $color_master;?>!important;
    background: <?php echo $color_master;?>!important;
    color: #fff;
    text-shadow: none;
    -webkit-text-shadow: none;
}


<?php 

if($cb_get_css_generate['color_style']=='black') { ?>
.lang-bar {
padding: 10px 0;
background-color: #edeced;
width: 200%;
margin-left: -50%;
}
.total-buble {
background-color:#eb4c4c!important;
}
header.position_left:after{
border:0!important;
background:none!important;
}
.top-menu {
border-bottom:6px solid #626262!important;
}.footer-payment-icons {
background-color: #edeced;
margin: 50px 0 0px 0;
padding: 20px 0 20px 0;
width: 200%;
margin-left: -50%;
}
.wrapper {
background-color:#FFF;
}div.homepage-banner img {
width: 100%;
}section.homepage2-banners-holder .container {
padding-left: 7px;
}.section-newsletter {
padding: 15px 0;
margin-top: 0;
}.section-banners .container {
padding: 0!important;
margin-left: -9px;
}

@media only screen and (max-width: 950px) {
.lang-bar {
width: 100%;
margin-left: 0;
}
.position_left .nav-mobile {
z-index: 999999999999999;
}.footer-payment-icons {
width: 122%;
margin-left: -24px;
padding: 20px 20px;
padding-bottom: 50px;
}
}

<?php
} 

if($cb_get_css_generate['color_style']=='gold') { ?>
.lang-bar {
padding: 10px 0;
background-color: #edeced;
width: 200%;
margin-left: -50%;
}
.total-buble {
background-color:#111!important;
}
header.position_center:after,header.position_left:after{
border:0!important;
background:none!important;
}div.top-menu.visible-md.visible-lg {
padding-top: 9px;
padding-bottom: 13px;
margin-left: -15px;
margin-right: -15px;
}
div.top-menu.visible-md.visible-lg:after {
content: '';
position: absolute;
background: #333;
width: 152%;
margin-left: -26%;
height: 50px;
margin-top: -37px;
}
.top-menu > ul > li > a {
color: #FFF!important;
}
.top-menu {
border-bottom:6px solid #626262!important;
}@media only screen and (max-width:769px) {
.top-logo-holder {
height: 140px;
}
}
@media only screen and (max-width: 950px) {
.lang-bar {
width: 100%;
margin-left: 0;
}
.position_left .nav-mobile {
z-index: 999999999999999;
}.footer-payment-icons {
width: 122%;
margin-left: -24px;
padding: 20px 20px;
padding-bottom: 50px;
}
}

<?php
} 



if($cb_get_css_generate['flat']=='yes') { ?>
.r_w_i.blue,.footer_corners.blue {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-blue-up.png) center top no-repeat transparent;
}
.r_w_i.red,.footer_corners.red {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-red-up.png) center top no-repeat transparent;
}
.r_w_i.black,.footer_corners.black {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-black-up.png) center top no-repeat transparent;
}
.r_w_i.green,.footer_corners.green {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-green-up.png) center top no-repeat transparent;
}
.footer.red .foot_bg {
background:#df4b3c!important;
}
.footer.green .foot_bg {
background:#4cbd8d!important;
}
.footer.blue .foot_bg {
background:#39566e!important;
}
.footer.black .foot_bg {
background:#363636!important;
}

.r_w_i.red .full_icon i {
color:#df4b3c!important;
}.r_w_i.white .full_icon i {
color:#FFF!important;
}.r_w_i.blue .full_icon i {
color:#39566e!important;
}.r_w_i.black .full_icon i {
color:#363636!important;
}.r_w_i.green .full_icon i {
color:#4cbd8d!important;
}
.r_wo_i.blue {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-blue-up-noicon.png) center top no-repeat transparent;
}
.r_wo_i.green {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-green-up-noicon.png) center top no-repeat transparent;
}
.r_wo_i.red {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-red-up-noicon.png) center top no-repeat transparent;
}
.r_wo_i.black {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-black-up-noicon.png) center top no-repeat transparent;
}
.slice_top.red {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/slice-red-up.png) center top no-repeat transparent;
}
.slice_top.black {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/slice-black-up.png) center top no-repeat transparent;
}.slice_top.green {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/slice-green-up.png) center top no-repeat transparent;
}.slice_top.blue {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/slice-blue-up.png) center top no-repeat transparent;
}
.slice_top.red .full_icon i {
background: #df4b3c;
color:#FFF!important;
}.slice_top.black .full_icon i {
background: #363636;
color:#FFF!important;
}.slice_top.white .full_icon i {
background: #fff;
color:#111!important;
}.slice_top.green .full_icon i {
background: #4cbd8d;
color:#FFF!important;
}.slice_top.blue .full_icon i {
background: #39566e;
color:#FFF!important;
}
.r_w_i_d.red {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-red-down.png) center top no-repeat transparent;
}
.r_w_i_d.black {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-black-down.png) center top no-repeat transparent;
}.r_w_i_d.green {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-green-down.png) center top no-repeat transparent;
}.r_w_i_d.blue {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-blue-down.png) center top no-repeat transparent;
}
.r_w_i_d.red .full_icon i {
background: #df4b3c;
color:#FFF!important;
}.r_w_i_d.black .full_icon i {
background: #363636;
color:#FFF!important;
}.r_w_i_d.white .full_icon i {
background: #fff;
color:#111!important;
}.r_w_i_d.green .full_icon i {
background: #4cbd8d;
color:#FFF!important;
}.r_w_i_d.blue .full_icon i {
background: #39566e;
color:#FFF!important;
}
.r_wo_i_d {
background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-white-down-noicon.png) center top no-repeat transparent;
width: 100%;
height: 103px;
position: absolute;
margin-top: -103px;
left: 0;
z-index: 22;
}
.r_wo_i_d.blue {
background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-blue-down-noicon.png) center top no-repeat transparent;
}
.r_wo_i_d.green{
background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-green-down-noicon.png) center top no-repeat transparent;
}
.r_wo_i_d.black {
background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-black-down-noicon.png) center top no-repeat transparent;
}
.r_wo_i_d.red{
background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/round-red-down-noicon.png) center top no-repeat transparent;
}.f_w_i.blue {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/blue-top-down.png) center top no-repeat transparent;
}
.f_w_i.red {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/red-top-down.png) center top no-repeat transparent;
}
.f_w_i.black {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/black-top-down.png) center top no-repeat transparent;
}
.f_w_i.green {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/top/green-top-down.png) center top no-repeat transparent;
}
.f_w_i.red .full_icon i {
background:#df4b3c!important;
color:#fff!important;
}.f_w_i.white .full_icon i {
background:#FFF!important;
color:#333!important;
}.f_w_i.blue .full_icon i {
background:#39566e!important;
color:#fff!important;
}.f_w_i.black .full_icon i {
background:#363636!important;
color:#fff!important;
}.f_w_i.green .full_icon i {
background:#4cbd8d!important;
color:#fff!important;
}.fb_w_i.blue {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/blue_bottom_down.png) center top no-repeat transparent;
}
.fb_w_i.red {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/red_bottom_down.png) center top no-repeat transparent;
}
.fb_w_i.black {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/black_bottom_down.png) center top no-repeat transparent;
}
.fb_w_i.green {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/green_bottom_down.png) center top no-repeat transparent;
}
.fb_w_i.red .full_icon i {
color:#df4b3c!important;
}.fb_w_i.white .full_icon i {
color:#FFF!important;
}.fb_w_i.blue .full_icon i {
color:#39566e!important;
}.fb_w_i.black .full_icon i {
color:#363636!important;
}.fb_w_i.green .full_icon i {
color:#4cbd8d!important;
}
.rb_w_i.blue {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-blue-up.png) center top no-repeat transparent;
}
.rb_w_i.red {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-red-up.png) center top no-repeat transparent;
}
.rb_w_i.black {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-black-up.png) center top no-repeat transparent;
}
.rb_w_i.green {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-green-up.png) center top no-repeat transparent;
}
.rb_w_i.red .full_icon i {
color:#df4b3c!important;
}.rb_w_i.white .full_icon i {
color:#FFF!important;
}.rb_w_i.blue .full_icon i {
color:#39566e!important;
}.rb_w_i.black .full_icon i {
color:#363636!important;
}.rb_w_i.green .full_icon i {
color:#4cbd8d!important;
}
.rb_wo_i.blue {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-blue-up-noicon.png) center top no-repeat transparent;
}
.rb_wo_i.green {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-green-up-noicon.png) center top no-repeat transparent;
}
.rb_wo_i.red {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-red-up-noicon.png) center top no-repeat transparent;
}
.rb_wo_i.black {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-black-up-noicon.png) center top no-repeat transparent;
}
.slice_b.red {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/slice-red-down.png) center top no-repeat transparent;
}
.slice_b.black {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/slice-black-down.png) center top no-repeat transparent;
}
.slice_b.blue {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/slice-blue-down.png) center top no-repeat transparent;
}
.slice_b.green {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/slice-green-down.png) center top no-repeat transparent;
}
.slice_b.red .full_icon i {
background: #df4b3c;
color:#FFF!important;
}.slice_b.black .full_icon i {
background: #363636;
color:#FFF!important;
}.slice_b.white .full_icon i {
background: #fff;
color:#111!important;
}.slice_b.green .full_icon i {
background: #4cbd8d;
color:#FFF!important;
}.slice_b.blue .full_icon i {
background: #39566e;
color:#FFF!important;
}
.rb_w_i_d.red {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-red-down.png) center top no-repeat transparent;
}
.rb_w_i_d.black {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-black-down.png) center top no-repeat transparent;
}
.rb_w_i_d.blue {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-blue-down.png) center top no-repeat transparent;
}
.rb_w_i_d.green {
	background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-green-down.png) center top no-repeat transparent;
}
.rb_w_i_d.red .full_icon i {
color: #df4b3c!important;
}.rb_w_i_d.black .full_icon i {
color: #363636!important;
}.rb_w_i_d.white .full_icon i {
color: #fff!important;
}.rb_w_i_d.green .full_icon i {
color: #4cbd8d!important;
}.rb_w_i_d.blue .full_icon i {
color: #39566e!important;
}.rb_wo_i_d.black {
background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-black-down-noicon.png) center top no-repeat transparent;
}.rb_wo_i_d.blue {
background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-blue-down-noicon.png) center top no-repeat transparent;
}.rb_wo_i_d.green {
background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-green-down-noicon.png) center top no-repeat transparent;
}.rb_wo_i_d.red {
background: url(<?php echo WP_THEME_URL;?>/img/corners/flat/bottom/round-red-down-noicon.png) center top no-repeat transparent;
}

.blue,.tp-caption.blue {color: #39566e!important;}
.red,.tp-caption.red{color:#df4b3c!important;}
.black,.tp-caption.black{color:#363636!important;}
.green.tp-caption.green{color:#4cbd8d!important;}
.callout.blue, .fullbg-blue {background: #39566e!important;}
.callout.black, .fullbg-black {background: #363636!important;}
.callout.green, .fullbg-green {background: #4cbd8d!important;}
.callout.red, .fullbg-red {background: #df4b3c!important;}

.animate.ani_color_after_white:hover {color:#fff!important;}
.animate.ani_color_after_blue:hover {color:#39566e!important;}
.animate.ani_color_after_black:hover {color:#363636!important;}
.animate.ani_color_after_red:hover {color:#df4b3c!important;}
.animate.ani_color_after_green:hover {color:#4cbd8d!important;}

.animate.fullbg-after_white:hover {background:#fff!important;}
.animate.fullbg-after_blue:hover{background:#39566e!important;}
.animate.fullbg-after_black:hover {background:#363636!important;}
.animate.fullbg-after_green:hover {background:#4cbd8d!important;}
.animate.fullbg-after_red:hover {background:#df4b3c!important;}

.animate.fullbg-white.background_inner,.animate.fullbg-white.background_outer{
box-shadow: 0 0 0 3px #fff!important;
}.animate.fullbg-blue.background_inner,.animate.fullbg-blue.background_outer{
box-shadow: 0 0 0 3px #39566e!important;
}.animate.fullbg-black.background_inner,.animate.fullbg-black.background_outer{
box-shadow: 0 0 0 3px #363636!important;
}.animate.fullbg-green.background_inner,.animate.fullbg-green.background_outer{
box-shadow: 0 0 0 3px #4cbd8d!important;
}.animate.fullbg-red.background_inner,.animate.fullbg-red.background_outer{
box-shadow: 0 0 0 3px #df4b3c!important;
}

.animate.fullbg-after_white:after {box-shadow: 0 0 0 4px #fff!important;}
.animate.fullbg-after_blue:after {box-shadow: 0 0 0 4px #39566e!important;}
.animate.fullbg-after_skin:after{box-shadow: 0 0 0 4px <?php echo $color_master;?>!important;}
.animate.fullbg-after_black:after {box-shadow: 0 0 0 4px #363636!important;}
.animate.fullbg-after_green:after {box-shadow: 0 0 0 4px #4cbd8d!important;}
.animate.fullbg-after_red:after {box-shadow: 0 0 0 4px #df4b3c!important;}

.animate.background_inner:hover,.animate.background_outer:hover {background:none!important;}
.animate.background_inner:after,.animate.background_outer:after {box-shadow:none!important;}
.animate.fullbg-after_blue.background_inner:hover:after,.animate.fullbg-after_blue.background_outer:hover:after,
.animate.fullbg-after_skin.background_inner:hover:after,.animate.fullbg-after_skin.background_outer:hover:after {background:#39566e!important;}
.animate.fullbg-after_white.background_inner:hover:after,.animate.fullbg-after_white.background_outer:hover:after {background:#fff!important;}
.animate.fullbg-after_black.background_inner:hover:after,.animate.fullbg-after_black.background_outer:hover:after {background:#363636!important;}
.animate.fullbg-after_green.background_inner:hover:after,.animate.fullbg-after_green.background_outer:hover:after {background:#4cbd8d!important;}
.animate.fullbg-after_red.background_inner:hover:after,.animate.fullbg-after_red.background_outer:hover:after {background:#df4b3c!important;}

.fullbg-white .heading_span {background:#FFF;}
.fullbg-red .heading_span {background:#df4b3c;}
.fullbg-black .heading_span {background:#363636;}
.fullbg-blue .heading_span {background:#39566e;}
.fullbg-green .heading_span {background:#4cbd8d;}
.fullbg-blue .pshape-hexagon {background:url(<?php echo WP_THEME_URL;?>/img/opacity/flat/hexagonbl.png) center center repeat-y transparent;background-size:100%;}
.fullbg-black .pshape-hexagon {background:url(<?php echo WP_THEME_URL;?>/img/opacity/flat/hexagonb.png) center center repeat-y transparent;background-size:100%;}
.fullbg-red .pshape-hexagon {background:url(<?php echo WP_THEME_URL;?>/img/opacity/flat/hexagonr.png) center center repeat-y transparent;background-size:100%;}
.fullbg-green .pshape-hexagon {background:url(<?php echo WP_THEME_URL;?>/img/opacity/flat/hexagongr.png) center center repeat-y transparent;background-size:100%;}

.fullbg-blue .pshape-circle {background:url(<?php echo WP_THEME_URL;?>/img/opacity/flat/circlebl.png) center center repeat-y transparent;background-size:100%;}
.fullbg-black .pshape-circle {background:url(<?php echo WP_THEME_URL;?>/img/opacity/flat/circleb.png) center center repeat-y transparent;background-size:100%;}
.fullbg-red .pshape-circle {background:url(<?php echo WP_THEME_URL;?>/img/opacity/flat/circler.png) center center repeat-y transparent;background-size:100%;}
.fullbg-green .pshape-circle {background:url(<?php echo WP_THEME_URL;?>/img/opacity/flat/circlegr.png) center center repeat-y transparent;background-size:100%;}
.bttn_big, a.bttn_big, input.bttn, .submit, a.more_cat,.bttn_big, a.bttn_big, input.bttn, .submit, a.more_cat {
background: <?php echo $color_master;?>;
}.footer a {
color: <?php echo $color_master;?>;
}
.woocommerce ul.products li.product .price del, .woocommerce-page ul.products li.product .price del,
.products .price del,.products .price{
color: <?php echo $color_master;?>!important;
}
  
<?php } //end flat?>

<?php } 
/* ================================================
 * END SKIN GENERATOR
 * ================================================ */





/* Global custom CSS */
if($cb_get_css_generate['add_css']!='') echo $cb_get_css_generate['add_css']; 
/* Page custom CSS */
if($cb_get_css_generate['ccss']!='') echo $cb_get_css_generate['ccss'];


/* ================================================
 * ROUNDED CORNERS
 * ================================================ */

?>
.round,.bttn, #sidebar img {
-webkit-border-radius:0px;
-moz-border-radius:0px;
border-radius:0px;
behavior: url(<?php echo WP_THEME_URL; ?>/css/PIE.htc);
position:relative;
}
.round,.bttn, #sidebar img,.icon_wrap .modello_icon,ul.cb-menu li.current-menu-item ul li.current-menu-item, ul.cb-menu li.current_page_item, ul.cb-menu li.current-menu-item ul li:hover, ul.cb-menu li ul li.current-menu-item,i.large_rounded,i.medium_rounded,i.small_rounded,i.large_rounded:hover,i.medium_rounded:hover,i.small_rounded:hover {
behavior: url(<?php echo WP_THEME_URL; ?>/css/PIE.htc);
position:relative;
}
.icon_wrap {
position:relative;
}

<?php
/* ================================================
 * HEADINGS AND TEXT, TYPOGRAPHY, TEXT COLORS
 * ================================================ */
//font weight
?>
h1,h2,h3,h4,h5,h6,
h1 a,h1 a:link,h1 a:visited,h1 a:active,
h2 a,h2 a:link,h2 a:visited,h2 a:active,
h4 a,h4 a:link,h4 a:visited,h4 a:active,
h5 a,h5 a:link,h5 a:visited,h5 a:active,
h3 a,h3 a:link,h3 a:visited,h3 a:active,
h6 a,h6 a:link,h6 a:visited,h6 a:active{
font-weight:<?php echo $cb_get_css_generate['headings_upw']; ?>;
}
h1.title,h1.title a,.head_title h1.title a,.head_title h1.title  {
font-weight:<?php echo $cb_get_css_generate['headings_upwt']; ?>!important;
}
<?php 
//headings transform
if($cb_get_css_generate['headings_up']=='uppercase') { ?>
h1,h2,h3,h4,h5,h6,
h1 a,h1 a:link,h1 a:visited,h1 a:active,
h2 a,h2 a:link,h2 a:visited,h2 a:active,
h4 a,h4 a:link,h4 a:visited,h4 a:active,
h5 a,h5 a:link,h5 a:visited,h5 a:active,
h3 a,h3 a:link,h3 a:visited,h3 a:active,
h6 a,h6 a:link,h6 a:visited,h6 a:active {
text-transform:uppercase;
}
<?php } 
//font size and line height
if($cb_get_css_generate['h1fs']!='') echo 'h1,h1 a, a h1 {font-size:'.$cb_get_css_generate['h1fs'].'px;line-height:'.$cb_get_css_generate['h1fs'].'px;}';
if($cb_get_css_generate['bodyfs']!='') echo 'html, body {font-size:'.$cb_get_css_generate['bodyfs'].'px;}';
if($cb_get_css_generate['h1fts']!='') echo 'h1.title,h1.title a, a h1.title {font-size:'.$cb_get_css_generate['h1fts'].'px;line-height:'.$cb_get_css_generate['h1fts'].'px;}';
if($cb_get_css_generate['h1fts']!='') echo '.cb_slash {font-size:'.$cb_get_css_generate['h1fts'].'px;line-height:'.$cb_get_css_generate['h1fts'].'px;}';
if($cb_get_css_generate['h2fs']!='') echo 'h2,h2 a, a h2 {font-size:'.$cb_get_css_generate['h2fs'].'px;line-height:'.$cb_get_css_generate['h2fs'].'px;}';
if($cb_get_css_generate['h3fs']!='') echo 'h3,h3 a, a h3 {font-size:'.$cb_get_css_generate['h3fs'].'px;line-height:'.$cb_get_css_generate['h3fs'].'px;}';
if($cb_get_css_generate['h4fs']!='') echo 'h4,h4 a, a h4 {font-size:'.$cb_get_css_generate['h4fs'].'px;line-height:'.$cb_get_css_generate['h4fs'].'px;}';
if($cb_get_css_generate['h5fs']!='') echo 'h5,h5 a, a h5 {font-size:'.$cb_get_css_generate['h5fs'].'px;line-height:'.$cb_get_css_generate['h5fs'].'px;}';
if($cb_get_css_generate['h6fs']!='') echo 'h6,h6 a, a h6 {font-size:'.$cb_get_css_generate['h6fs'].'px;line-height:'.$cb_get_css_generate['h6fs'].'px;}';

if($cb_get_css_generate['fhfs']!='') echo '.footer h3,.footer h3 a {font-size:'.$cb_get_css_generate['fhfs'].'px;line-height:'.$cb_get_css_generate['fhfs'].'px;}';
if($cb_get_css_generate['footer_h_color']!='') echo '.footer h3,.footer h3 a {color:'.$cb_get_css_generate['footer_h_color'].'!important;}';
if($cb_get_css_generate['footer_text_color']!='') echo '.footer,.footer a {color:'.$cb_get_css_generate['footer_text_color'].';}';

//title headings
if($cb_get_css_generate['headh']!=''){ ?>
<?php $headhsub=$cb_get_css_generate['headh'];
$headhss=$headhsub;
if($cb_get_css_generate['mheadertype']=='left') $headhss=$headhss+15;
if($cb_get_css_generate['mheadertype']=='center') $headhss=$headhss+10;
if($cb_get_css_generate['fixed_top']=='yes') $headhss=$headhss+5; 
$cb_post_options['title']=cb_get_value(get_post_meta($post->ID, '_cb5_post_options', true), 'show_title');
if($cb_post_options['title']=='yes') { ?>
.head_title {
height:<?php echo $headhsub;?>px!important;
}
<?php } ?>
#middle .head_title {
height:auto!important;
}.head_title h1 {
line-height:<?php echo $headhss;?>px!important;
}.slider_top_slogan {
padding-top:<?php echo $headhss;?>px;
padding-bottom:<?php echo $headhsub/2;?>px;
}.below_header .icons, .below_header .text {
float:right;
height:<?php echo $headhsub;?>px!important;
line-height:<?php echo $headhss+20;?>px!important;
}
.head_title_imp {
height:auto!important;
}
<?php }
if($cb_get_css_generate['top_padding']!=''&&$cb_get_css_generate['top_padding']!='0'){ ?>
<?php $top_padding=$cb_get_css_generate['top_padding'];
$top_pas=$top_padding;
if($cb_get_css_generate['fixed_top']=='yes') $top_pas=$top_pas+40;  ?>
.head_title {
height:<?php echo $top_padding;?>px!important;
}.head_title h1 {
line-height:<?php echo $top_pas;?>px!important;
}.below_header .icons, .below_header .text {
float:right;
height:<?php echo $top_padding;?>px!important;
line-height:<?php echo $top_pas+20;?>px!important;
}
<?php }
if($cb_get_css_generate['top_padding']=='0'&&$cb_get_css_generate['hide_h']=='yes') { ?>
.below_header .icons, .below_header .text,.head_title h1,.head_title {
height:0px!important;
line-height:0px!important;
}
<?php 
}
if($cb_get_css_generate['hide_h']=='yes'){?>
section.style-one-header.top-area,div.lang-bar {
display: none;
}
.slider_top {
padding:0!important;
}.icons_con{display:none!important;}
<?php }
if($cb_get_css_generate['hide_h']=='yes'&&$cb_get_css_generate['hide_f']=='yes'){?>
.slider_top {
margin-bottom:-20px!important;
}
<?php }
if($cb_get_css_generate['hide_h']=='yes'&&$cb_get_css_generate['hide_f']=='yes'){?>
#middle {
padding:0!important;
}
<?php }
if($cb_get_css_generate['hide_f']=='yes'){?>
.section-footer{display:none;}
#middle {
padding:0px!important;
}.slider_top{margin-bottom: -20px!important;}
<?php }
//title headings color
if($cb_get_css_generate['headhc']!=''){?>
.head_title h1.title,.head_title h1.title a {
color:<?php echo $cb_get_css_generate['headhc'];?>!important;
}.cb_slash,#breadcrumbs,#breadcrumbs a,#breadcrumbs i,.woocommerce-breadcrumb,.woocommerce-breadcrumb i,.woocommerce-breadcrumb a {
color:#ddd!important;
}
<?php } /*
//title heading line height page
if($cb_get_css_generate['headhp']!=''){?>
.head_title h1.title,.head_title h1.title i {
line-height:<?php echo $cb_get_css_generate['headhp'];?>!important;
}
<?php } 
//title headings color page
if($cb_get_css_generate['headhcp']!=''){?>
.head_title h1.title,.head_title h1.title a,.head_title h1.title i,.cb_slash  {
color:<?php echo $cb_get_css_generate['headhc'];?>!important;
}
<?php } */
//title heading page color
if($cb_get_css_generate['header_color']!='') { ?>
.head_title h1.title,.head_title h1.title a,.head_title h1.title i,.cb_slash {
color:<?php echo $cb_get_css_generate['header_color'];?>!important;
} 
<?php } 
if($cb_get_css_generate['header_shadow_color']!='') {?>
.head_title h1.title,.head_title h1.title a,.head_title h1.title i,.cb_slash {
text-shadow:1px 1px <?php echo $cb_get_css_generate['header_shadow_color'];?>!important;
} 
<?php
}
//font families
if($cb_get_css_generate['font_family_google']!='------') { $font_g=$cb_get_css_generate['font_family_google'];
$font_g=str_replace(' ','%20',$font_g);$font_g=str_replace('+','%20',$font_g);
$font_gg=str_replace('%20',' ',$font_g);
?>
body,html {
font-family:"<?php echo $font_gg; ?>",Arial,sans-serif,sans;
}
<?php } else { ?>
body,html {
font-family:"<?php echo $cb_get_css_generate['font_family']; ?>",Arial,sans-serif,sans;
}
<?php }
if($cb_get_css_generate['font_family_google_head']!='------') { $font_g_head=$cb_get_css_generate['font_family_google_head'];
$font_g_head=str_replace(' ','%20',$font_g_head);$font_g_head=str_replace('+','%20',$font_g_head);
$font_gg_head=str_replace('%20',' ',$font_g_head);
?>
h1,h2,h3,h4,h5,h6,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,table th,table th a,.tp-caption,.text_large,.skill_circle bold,.testimonial_content,.footer,
.tp-caption.big_white,.tp-caption.big_orange,.tp-caption.big_black,.tp-caption.large_text,.tp-caption.large_text_light,.skill,.skill_circle,
.tp-caption.very_large_text,.tp-caption.large_text_black,.tp-caption.large_text_light_black,.tp-caption.very_big_white,.tp-caption.very_big_black
{
font-family:"<?php echo $font_gg_head; ?>",Arial,sans-serif,sans;
}<?php } else { ?>
h1,h2,h3,h4,h5,h6,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,.tp-caption,.text_large,.skill_circle bold,.testimonial_content,.footer,
.tp-caption.big_white,.tp-caption.big_orange,.tp-caption.big_black,.tp-caption.large_text,.tp-caption.large_text_light,.skill,.skill_circle,
.tp-caption.very_large_text,.tp-caption.large_text_black,.tp-caption.large_text_light_black,.tp-caption.very_big_white,.tp-caption.very_big_black {
font-family:"<?php echo $font_family_head; ?>",Arial,sans-serif,sans;
}
<?php } 
if($cb_get_css_generate['font_family_google_head_title']!='------') { $font_g_head_title=$cb_get_css_generate['font_family_google_head_title'];
$font_g_head_title=str_replace(' ','%20',$font_g_head_title);$font_g_head_title=str_replace('+','%20',$font_g_head_title);
$font_gg_head_title=str_replace('%20',' ',$font_g_head_title);
?>
h1.title,h1.title a,.large_text_light,.large_text,.titles{
font-family:"<?php echo $font_gg_head_title; ?>",Arial,sans-serif,sans!important;
}
#breadcrumbs,#breadcrumbs a,.woocommerce-breadcrumb,.woocommerce-breadcrumb a{
font-family:"<?php echo $font_gg_head_title; ?>",Arial,sans-serif,sans!important;
}
<?php }
if($cb_get_css_generate['font_family_google_head_title2']!='------') { $font_g_head_title2=$cb_get_css_generate['font_family_google_head_title2'];
$font_g_head_title2=str_replace(' ','%20',$font_g_head_title2);$font_g_head_title2=str_replace('+','%20',$font_g_head_title2);
$font_gg_head_title2=str_replace('%20',' ',$font_g_head_title2);
?>
.large_text_light,.large_text,.titles{
font-family:"<?php echo $font_gg_head_title2; ?>",Arial,sans-serif,sans!important;
}
<?php }
if($cb_get_css_generate['logo_f']!='------') {
$logo_f=str_replace(' ','%20',$cb_get_css_generate['logo_f']);$logo_f=str_replace('+','%20',$logo_f);
$logo_f2=str_replace('%20',' ',$logo_f);
?>
.logo h1 a {
font-family:<?php echo $logo_f2; ?>,sans-serif,sans;
}
<?php }
if($font_gg!='------') { 
?>
.cb-menu li a {
font-family:"<?php echo $font_gg; ?>",Arial,sans-serif,sans;
}
<?php }
//logo font
if($cb_get_css_generate['logo_font']!='') { ?>
.logo a {
font-size:<?php echo $cb_get_css_generate['logo_font']; ?>;
}<?php }
if($cb_get_css_generate['menu_font_size']!='') { ?>
.top-menu > ul > li > a {
font-size:<?php echo $cb_get_css_generate['menu_font_size']; ?>px!important;
color:#595959;
}<?php }
if($cb_get_css_generate['logo_color']!='') { ?>
.logo h1 a {
color:<?php echo $cb_get_css_generate['logo_color']; ?>!important;
}
<?php }
if($cb_get_css_generate['slogan_color']!='') { ?>
.blog-description {
color:<?php echo $cb_get_css_generate['slogan_color']; ?>!important;
}
<?php }
if($cb_get_css_generate['logo_shad']!='') { ?>
.logo h1 a {
text-shadow:1px 1px <?php echo $cb_get_css_generate['logo_shad']; ?>!important;
}
<?php }
//body text color
if($cb_get_css_generate['text_color']!='') { ?>
body,html,.post-front-inner,.footer,.footer h2 {
color:<?php echo $cb_get_css_generate['text_color']; ?>
}
<?php }
//headings color
if($cb_get_css_generate['headings_color']!='') { ?>
a.more,
h1,h2,h3,h4,h5,h6,
h1 a,h1 a:link,h1 a:visited,h1 a:active,
h2 a,h2 a:link,h2 a:visited,h2 a:active,
h4 a,h4 a:link,h4 a:visited,h4 a:active,
h5 a,h5 a:link,h5 a:visited,h5 a:active,
h3 a,h3 a:link,h3 a:visited,h3 a:active,
h6 a,h6 a:link,h6 a:visited,h6 a:active {
color:<?php echo $cb_get_css_generate['headings_color']; ?>!important;
}<?php }
//links color
if($cb_get_css_generate['links_color']!='') { ?>
a,a:link,a:visited {
color:<?php echo $cb_get_css_generate['links_color']; ?>;
}<?php } 
if($cb_get_css_generate['links_hover_color']!='') { ?>
a:hover {
color:<?php echo $cb_get_css_generate['links_hover_color']; ?>;
}<?php } 

/* ================================================
 * MENU/HEADER TYPES
* ================================================ */

if($cb_get_css_generate['mheadertype']=='center') { ?>
.top_l,.top_r {
margin:0 auto;
float:inherit!important;
}.top_l {
text-align:center;
}.top_r {
margin-top:-20px!important;
}.top_header{
padding-top:0px;
padding-bottom:0px;
}/*.slider_top .wrapme {padding-top:80px;}
.slider_top .wrapme h1.title {text-align:center;}
*/.menu-lou .wrapme {width:inherit;display:table;}
.below_header {top:20px;}
<?php } 

if($cb_get_css_generate['mheadertype']=='left') { ?>
.top_header {
padding-top:12px!important;
padding-bottom:12px!important;
}ul.cb-menu li {
padding-bottom: 5px!important;
padding-top: 5px!important;
}
<?php } 

if($cb_get_css_generate['mheadertype']=='right') { ?>
.top_l,.top_r{height:76px;}
<?php }

if(($cb_get_css_generate['showtopwidget']=='no'&&(is_front_page()||is_home()))||$cb_get_css_generate['hide_top']=='yes'){?>
.widget_top {display:none!important;}
<?php }
if($cb_get_css_generate['iconspos']=='bottom'&&$cb_get_css_generate['mheadertype']!='left'){?>
.bg_head{
position:relative!important;
}
<?php if((is_home()||is_front_page())||($cb_get_css_generate['header_type']=='slider_head'||$cb_get_css_generate['header_type']=='bg_head'||$cb_get_css_generate['header_type']=='map')){ ?> 
.below_header{
<?php if($cb_get_css_generate['header_type']=='bg_head'){?>
bottom:10px;
color:#FFF!important;
<?php } else { ?>
bottom:50px;
<?php } ?>
}
<?php 
} ?>
.below_header{z-index:24;}
<?php }
if($cb_get_css_generate['iconspos']=='bottom'){?>
.below_header{top:0;}
<?php } 

if($cb_get_css_generate['header_type']=='bg_head'||$cb_get_css_generate['header_type']=='slider_head'||$cb_get_css_generate['header_type']=='map'){?>
.below_header .icons, .below_header .text {
float: right;
height: 100px!important;
line-height: 100px!important;
}.below_header {
height: 100px;
bottom: 62px;
line-height: 100px;
top: auto;
}
<?php }


/* ================================================
 * BACKGROUNDS
 * ================================================ */

if($cb_get_css_generate['stripes_bg_schema']!=''&&$cb_get_css_generate['stripes_bg_schema']!='none') {
if($cb_get_css_generate['stripes_bg_schema']!='1.png'&&$cb_get_css_generate['stripes_bg_schema']!='1.png'&&$cb_get_css_generate['stripes_bg_schema']!='1.png'&&
 $cb_get_css_generate['stripes_bg_schema']!='1.png'&&$cb_get_css_generate['stripes_bg_schema']!='2.png'&&$cb_get_css_generate['stripes_bg_schema']!='3.jpg'&&
 $cb_get_css_generate['stripes_bg_schema']!='4.png'&&$cb_get_css_generate['stripes_bg_schema']!='5.png'&&$cb_get_css_generate['stripes_bg_schema']!='6.png'&&
 $cb_get_css_generate['stripes_bg_schema']!='7.png'&&$cb_get_css_generate['stripes_bg_schema']!='8.png'&&$cb_get_css_generate['stripes_bg_schema']!='9.png'&&
 $cb_get_css_generate['stripes_bg_schema']!='10.png'&&$cb_get_css_generate['stripes_bg_schema']!='11.png'&&$cb_get_css_generate['stripes_bg_schema']!='12.png'&&
 $cb_get_css_generate['stripes_bg_schema']!='13.png'&&$cb_get_css_generate['stripes_bg_schema']!='14.png'&&$cb_get_css_generate['stripes_bg_schema']!='15.png'&&
 $cb_get_css_generate['stripes_bg_schema']!='16.png'){ ?>
body {
background:url(<?php echo WP_THEME_URL; ?>/img/bg/<?php echo $cb_get_css_generate['stripes_bg_schema']; ?>) center top repeat <?php if($cb_get_css_generate['background_color']!='') { echo $cb_get_css_generate['background_color']; } else echo'transparent';?>;
}
<?php } else { ?>
body {
background:url(<?php echo WP_THEME_URL; ?>/img/bg/<?php echo $cb_get_css_generate['stripes_bg_schema']; ?>) center top repeat <?php if($cb_get_css_generate['background_color']!='') { echo $cb_get_css_generate['background_color']; } else echo'transparent';?>;
<?php if($cb_get_css_generate['bg_str']=='yes') {?>background-size:100%;<?php } ?>
}
.above-footer {
background:url(<?php echo WP_THEME_URL; ?>/img/bg/<?php echo $cb_get_css_generate['stripes_bg_schema']; ?>) center top repeat <?php if($cb_get_css_generate['background_color']!='') { echo $cb_get_css_generate['background_color']; } else echo'transparent';?>;
<?php if($bgf_str=='yes') {?>background-size:100%;<?php } ?>
}
<?php } }
if($cb_get_css_generate['middle_background']!='') { ?>
#middle {
background:<?php echo $cb_get_css_generate['middle_background']; ?>;
}
.heading_span {
background:<?php echo $cb_get_css_generate['middle_background']; ?>;
}.pshape-diamond {
background: url(<?php echo WP_THEME_URL;?>/img/opacity/dia.png) center center repeat-y transparent;background-size: 100% 100%;
}.checkout_actions h1 span {background:<?php echo $cb_get_css_generate['middle_background']; ?>;}
.checkout_actions h1{background-color:<?php echo $cb_get_css_generate['middle_background']; ?>;}
<?php }
if($cb_get_css_generate['upload_bg']!=''){ ?>
body {
background:url("<?php echo $cb_get_css_generate['upload_bg']; ?>") center top no-repeat <?php if($cb_get_css_generate['bg_fixed']=='yes') {?>fixed<?php } ?><?php if($cb_get_css_generate['background_color']!='') { echo $cb_get_css_generate['background_color']; } else { ?> transparent<?php } ?>;
<?php if($cb_get_css_generate['bg_str']=='yes'){ ?>background-size:100%;<?php } ?>
} <?php }
if($cb_get_css_generate['background']!=''&&$cb_get_css_generate['background']!='0'&&$cb_get_css_generate['upload_bg']==''){ ?>
body { 
background:url("<?php echo WP_THEME_URL.'/img/bg/'.$cb_get_css_generate['background']; ?>.jpg") center top no-repeat <?php if($cb_get_css_generate['bg_fixed']=='yes') {?>fixed<?php } ?> <?php if($cb_get_css_generate['background_color']!='') { echo $cb_get_css_generate['background_color']; } else { ?> transparent<?php } ?>;
<?php if($cb_get_css_generate['bg_str']=='yes'){ ?>background-size:100%;<?php } ?>
}
<?php }
if($cb_get_css_generate['background_color']!='') { ?>
body {
background-color:<?php echo $cb_get_css_generate['background_color']; ?>;
}
<?php } 

if($cb_get_css_generate['ht_backgroundp']!=''){?>
.head_top_container{background:<?php echo $cb_get_css_generate['ht_backgroundp'];?>!important;}
<?php }

if( ($cb_get_css_generate['full_slider']=='yes'&&($cb_get_css_generate['home_slider']==''||$cb_get_css_generate['home_slider']=='none')&&( is_front_page()||is_home()||$cb_get_css_generate['full_slider_where']=='yes' ) )||$cb_get_css_generate['home_slider']=='full'){ ?>
#middle,.footer,.footer-lower {
display:none;
}
html {
height:85%;
}
<?php }
if($cb_get_css_generate['htb_background']!='') { ?>
.slider_top{
background:<?php echo $cb_get_css_generate['htb_background']; ?>!important;
}
<?php } 
if($cb_get_css_generate['sloganpc']!='') { ?>
.slider_top_slogan,.slider_top_slogan h1,.slider_top_slogan h2,.slider_top_slogan h3,.slider_top_slogan h4,.slider_top_slogan h5,.slider_top_slogan h6,
.slider_top_slogan h1 a,.slider_top_slogan h2 a,.slider_top_slogan h3 a,.slider_top_slogan h4 a,.slider_top_slogan h5 a,.slider_top_slogan h6 a
{
color:<?php echo $cb_get_css_generate['sloganpc']; ?>!important;
}
<?php } if($cb_get_css_generate['sloganph']!='') { ?>
.slider_top_slogan{
padding-top:<?php echo $cb_get_css_generate['sloganph']; ?>px!important;
}
<?php }
if($cb_get_css_generate['header_bg_color']!='') { ?>
.slider_top {
background-color:<?php echo $cb_get_css_generate['header_bg_color'];?>!important;
}
<?php } 
if($cb_get_css_generate['bread_color']!='') { ?>
#breadcrumbs,#breadcrumbs a,#breadcrumbs i,.woocommerce-breadcrumb,.woocommerce-breadcrumb i,.woocommerce-breadcrumb a {
color:<?php echo $cb_get_css_generate['bread_color'];?>!important;
}
<?php }
if($cb_get_css_generate['cb_type']=='portfolio'&&is_single()) { ?>
.slider_top {
padding-top:350px;
}
<?php }
if($cb_get_css_generate['header_type']=='map') { ?>
.slider_top {
padding-top: 0;
padding-bottom: 400px;
}
<?php }

$foot_op=cb_get_foot_options();
if($foot_op['fstyle']=='normal'){?>
.foot_bg {bottom:0!important;}.footer .wrapme{margin-top:0!important;}
<?php } 







/* ================================================
 * BOXED LAYOUT
* ================================================ */

if($cb_get_css_generate['wid']=='fixed'||$cb_get_css_generate['dfixed']=='true') { ?>
@media only screen and (min-width: 1031px) {
.wrapper,#middle,.section-footer{
display:table!important;
margin:0 auto!important;
}
}

<?php } 

/* ================================================
 * FLOATING HEADER
* ================================================ */

if($cb_get_css_generate['fixed_top']=='yes') { ?>
.head_top_container,.widget_top{
position:fixed!important;
width:100%;
margin:0 auto;
z-index: 101;
margin-top:0px;
}
.below_header{
<?php if($cb_get_css_generate['mheadertype']!='left'&&($cb_get_css_generate['mheadertype']!='right'&&$cb_get_css_generate['iconspos']!='bottom')) { ?>top:130px;<?php } else if($cb_get_css_generate['mheadertype']!='right'&&$cb_get_css_generate['iconspos']!='bottom'){ ?>
top:170px;<?php } ?>
<?php if($cb_get_css_generate['mheadertype']=='center') { ?>top:37px;<?php } ?>
<?php if($cb_get_css_generate['mheadertype']=='left') { ?>top:10px;<?php } ?>
<?php if($cb_get_css_generate['mheadertype']=='left'&&$cb_get_css_generate['showtopwidget']=='yes') { ?>top:68px;<?php } ?>
<?php if($cb_get_css_generate['mheadertype']=='center'&&$cb_get_css_generate['showtopwidget']=='yes') { ?>top:95px;<?php } ?>
<?php if($cb_get_css_generate['mheadertype']=='right'&&$cb_get_css_generate['showtopwidget']=='yes') { ?>top:162px;<?php } ?>
}

.head_top {
height:55px;
}<?php if($cb_get_css_generate['mheadertype']!='left') { ?>.top_l {
height:72px;
}<?php } ?>
.top_r {
height:70px;
}.fixed_top {
height:70px;<?php if($cb_get_css_generate['headertransparent']=='yes'){ ?> height:0px;<?php } ?>
}
<?php
if($cb_get_css_generate['mheadertype']!='center') { ?>ul.cb-menu li {
padding-bottom: 15px;
padding-top: 15px;
}<?php } else { ?>
ul.cb-menu li {
padding-bottom:15px;
padding-top:15px;
}
<?php } ?>
.top_header {
<?php if($cb_get_css_generate['mheadertype']!='left') { ?>height:72px;<?php } ?>
}
<?php } else if($cb_get_css_generate['fixed_top']=='yes') { ?>
.head_top_container,#top_widget {
position:fixed!important;
width:100%;
z-index:999;
margin-top:0px;
}.slider_top {
padding-top:55px;
}.head_top {
left:0;
}.below_header {
<?php if($cb_get_css_generate['mheadertype']!='left') { ?>top:120px;<?php } else { ?>
top:160px;<?php } ?>
}.slider_top {
<?php if($cb_get_css_generate['cb_type']!='home'&&(!is_not_home||!is_front_page())) { ?>top: -16px;margin-bottom:-16px!important;<?php } ?>
}
<?php }

/* ================================================
 * BORDERS
 * ================================================ */

if($cb_get_css_generate['bors']=='no') { ?>
#middle,.head_top,.footer {
border:0px!important;
}
<?php }
if($cb_get_css_generate['bors_h']=='no') { ?>
.head_top {
border-bottom:0px!important;
}
<?php }
if($cb_get_css_generate['bors_f']=='no') { ?>
.footer {
border-top:0px!important;
}
<?php }
if($cb_get_css_generate['mwh']!='') { ?>
.above-footer .more,
.above-footer h1,.above-footer h2,.above-footer h3,.above-footer h4,.above-footer h5,.above-footer h6,
.above-footer h1 a,.above-footer h2 a,.above-footer h3 a,.above-footer h4 a,.above-footer h5 a,.above-footer h6 a,
.above-footer h1 a:link,.above-footer h2 a:link,.above-footer h3 a:link,.above-footer h4 a:link,.above-footer h5 a:link,.above-footer h6 a:link {
color:<?php echo $cb_get_css_generate['mwh']; ?>!important;
}
<?php }
if($cb_get_css_generate['mw']!='') { ?>
.above-footer {
color:<?php echo $cb_get_css_generate['mw']; ?>!important;
}
<?php }

/* ================================================
 * SKIN DEFAULTS- COLORS,BACKGROUNDS
 * ================================================ */
if($cb_get_css_generate['color_master']=='') { $cb_get_css_generate['color_master']=$cb_get_css_generate['color_style']; }
if($cb_get_css_generate['color_master']=='') $cb_get_css_generate['color_master']='27a4c8'; /* default color */
$skin_color=$cb_get_css_generate['color_master'];
$tint_skin_parent=hex2rgb($cb_get_css_generate['color_master']);
$tint_skin='rgba('.$tint_skin_parent.',0.85)';
$tint_skin_light='rgba('.$tint_skin_parent.',0.65)';
$tint_team=hex2rgb($cb_get_css_generate['color_master']);
$tint_team='rgba('.$tint_team.',0.2)';
?>
.tint_skin {
background:<?php echo $tint_skin; ?>;
}
.tint_skin_light {
background:<?php echo $tint_skin_light; ?>;
}
.rounded .team_image img {
border: 20px solid <?php echo $tint_team; ?>;
}

<?php

/* ================================================
 * GRID VERSIONS
* ================================================ */

if($cb_get_css_generate['grid']=='1170') { ?>
.wrapme,.footer_contact > .wrapper_p,.navi_full .wrapme,.above-footer .wrapme, .footer .wrapme,.og-expander,
#middle,.section-footer {
margin:0 25px;
}.wrapme .wrapme {
margin: 0;
}.port_sorter .framein {
width: 100%!important;
}

<?php
}

if($cb_get_css_generate['header_line']=='yes') { ?>
.position_left .top-area:after {
background:none!important;
}
<?php }

/* ================================================
 * SOME FIXES
 * ================================================ */

if($cb_get_css_generate['color_master']=='') $cb_get_css_generate['color_master']='#27a4c8'; ?>
.skinimp {
/*background:<?php echo $cb_get_css_generate['color_master'];?>!important;*/
background:rgba(0,0,0,0.5)!important;
<?php if($cb_get_css_generate['skinimp']=='white'){?>
background:rgba(255,255,255,0.7)!important;}
<?php } ?>
<?php if($cb_get_css_generate['ht_backgroundp']!=''){?>
background:<?php echo $cb_get_css_generate['ht_backgroundp'];?>!important;}
<?php } ?>
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
.error404 .head_top_container {
background:rgba(0,0,0,0.5)!important;
}

<?php if($cb_get_css_generate['hidegr']=='yes'){?>
.grid-list-buttons {
visibility: hidden!important;
}
<?php } ?>

<?php if($cb_get_css_generate['remhov']!=''){?>
@media only screen and (max-width: 1030px) {
a.mini-prev {
left: 0!important;
}
a.mini-next {
right: 0px!important;
}
.mini-next, .mini-prev {
opacity: 1!important;
}.buttons-holder {
opacity: 1!important;
}.buttons-holder {
opacity: 1!important;
margin: 10px 0 0 0!important;
}
}
@media only screen and (min-width: 750px) and (max-width: 1030px) {
a.mini-prev {
left: 10px!important;
}
a.mini-next {
right: 10px!important;
}
}
<?php } ?>
<?php if($cb_get_css_generate['disca']=='yes'){?>
.caption, .cap_shad, .opa {
display: none!important;
}
<?php } ?>
<?php if($cb_get_css_generate['hidereca']=='yes'){?>
.widget_recently_viewed_products .amount {
display: none!important;
}
<?php } ?>
<?php $buffer = ob_get_contents();
ob_end_clean();
echo str_replace("\n",null,$buffer);?>
</style>
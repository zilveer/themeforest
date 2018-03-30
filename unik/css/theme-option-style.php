<?php
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	
	//Access WordPress
	require_once( $path_to_wp.'/wp-load.php' );	
	global $unik_data;

	
 
	function hex2rgb( $colour ) {
			if ( $colour[0] == '#' ) {
					$colour = substr( $colour, 1 );
			}
			if ( strlen( $colour ) == 6 ) {
					list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
			} elseif ( strlen( $colour ) == 3 ) {
					list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
			} else {
					return false;
			}
			$r = hexdec( $r );
			$g = hexdec( $g );
			$b = hexdec( $b );
			return  $r.','. $g.',' . $b;
	}
	
	function dark2light( $colour ) {
			if ( $colour[0] == '#' ) {
					$colour = substr( $colour, 1 );
			}
			if ( strlen( $colour ) == 6 ) {
					list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
			} elseif ( strlen( $colour ) == 3 ) {
					list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
			} else {
					return false;
			}
			$r = hexdec( $r )+70;
			$g = hexdec( $g )+70;
			$b = hexdec( $b )+70;
			return  $r.','. $g.',' . $b;
	}
header("Content-type: text/css; charset: UTF-8");	
 ?>
@charset "utf-8";


/* Active bg 
---------------------------------------------------------------------------------------------*/
::selection{
     background: <?php echo $unik_data['active_bg_color']; ?>;
	 color: <?php echo $unik_data['active_color']; ?>;
}
::-moz-selection{
     background: <?php echo $unik_data['active_bg_color']; ?>;
	 color: <?php echo $unik_data['active_color']; ?>;
}
.button, #submit, [type="submit"],.wrap .wpdevbk .btn,.gig_date:after,.btn-primary,.product-img .onsale,.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,.audio-post-sticker {
     background: <?php echo $unik_data['active_bg_color']; ?>!important;
}

.post.sticky,blockquote,.comment-list li ul .comment-body{
	border-color: <?php echo $unik_data['active_bg_color']; ?>;
	background-color: rgb(<?php echo hex2rgb($unik_data['active_bg_color']); ?>);
	background-color: rgba(<?php echo hex2rgb($unik_data['active_bg_color']); ?>,0.2);
}

.comment-body{
	border-color: <?php echo $unik_data['active_bg_color']; ?>;
}

.share {
	background: rgb(0,0,0);
	background: rgba(0,0,0,0.5);
    border-left: 2px solid <?php echo $unik_data['active_bg_color'];?>;
}

.unik-accordion h5.active{
	background-color: rgb(<?php echo hex2rgb($unik_data['active_bg_color']); ?>);
	background-color: rgba(<?php echo hex2rgb($unik_data['active_bg_color']); ?>,0.3)
}
.shows .view:hover,.sm-border:hover,.block-title{
	border-color: rgb(<?php echo hex2rgb($unik_data['active_bg_color']); ?>);
	border-color: rgba(<?php echo hex2rgb($unik_data['active_bg_color']); ?>,0.5);
}

.hover-border-wrap:hover .hover-border {
	box-shadow: inset 0 0 0 3px rgb(<?php echo hex2rgb($unik_data['active_bg_color']); ?>) ;
	box-shadow: inset 0 0 0 3px rgba(<?php echo hex2rgb($unik_data['active_bg_color']); ?>,0.8) ;
}

.tparrows:hover:before,.product-btn-box .added:before{
	color: <?php echo $unik_data['active_bg_color'];?>;
}

.datepick-inline .datepick-one-month .datepick .datepick-current-day {
	background-color: rgb(<?php echo hex2rgb($unik_data['active_bg_color']); ?>) !important;
	background-color: rgba(<?php echo hex2rgb($unik_data['active_bg_color']); ?>,0.6) !important;
}

.datepick-inline .date2approve a, .date2approve{
     color: <?php echo $unik_data['active_bg_color']; ?> !important;
 }
 
/* Active color 
---------------------------------------------------------------------------------------------*/
.button, #submit, [type="submit"],.wrap .wpdevbk .btn,.gig_date,#reservation-toggle,.unik-accordion h5.active,.audio-post-sticker{
     color: <?php echo $unik_data['active_color']; ?> !important;
}

/* Link 
---------------------------------------------------------------------------------------------*/
 
a,.unik-accordion h5,.site-footer .wpdevbk a,.woocommerce .add_to_cart_button{
     color: <?php echo $unik_data['link_color']; ?>;
}

a:active, a:hover,.view .info a:hover, #back-to-top:hover,.effect-2 .info i:hover,.site-footer .wpdevbk a:hover,.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,.add_to_cart_button:hover{
     color: <?php echo $unik_data['link_hover_color']; ?>;
}
.woocommerce p.stars a.active:after, .woocommerce p.stars a:hover:after, .woocommerce-page p.stars a.active:hover:after,.woocommerce .star-rating span, .woocommerce-page .star-rating span{
	color: <?php echo $unik_data['link_hover_color']; ?> !important;
}
div.jp-play-bar{
	background: rgb(<?php echo hex2rgb($unik_data['link_hover_color']); ?>);
	background: rgba(<?php echo hex2rgb($unik_data['link_hover_color']); ?>,0.85);
}


/* Header
---------------------------------------------------------------------------------------------*/



/* Content color
---------------------------------------------------------------------------------------------*/
.secondary-title, body, a.gig_link, a.gig_link:hover,.woocommerce ul.products li.product .price del, .woocommerce-page ul.products li.product .price del,.price del .amount,#reply-title{
	color: <?php echo $unik_data['content_color']; ?>;
}
.woocommerce-page div.product .stock{
	color: <?php echo $unik_data['content_color']; ?> !important;
}

hr,tr,.price-box .price,.single_variation .price,.woocommerce-page #reviews #comments ol.commentlist li .comment-text,.woocommerce-tabs > .tabs{
	border-color: rgb(<?php echo hex2rgb($unik_data['content_color']); ?>);
	border-color: rgba(<?php echo hex2rgb($unik_data['content_color']); ?>,0.3);
}

.page-title{
	border-bottom: 1px solid rgb(<?php echo hex2rgb($unik_data['content_color']); ?>);
	border-bottom: 1px solid rgba(<?php echo hex2rgb($unik_data['content_color']); ?>,0.3);
}

.unik-accordion h5,.entry-header .date,.thumbnail,.pagination > a, .pagination > span, .pagination > li > a, .pagination > li > span{
	border: 1px solid rgb(<?php echo hex2rgb($unik_data['content_color']); ?>);
	border: 1px solid rgba(<?php echo hex2rgb($unik_data['content_color']); ?>,0.3);
}

.thumbnail {
     background-color: rgb(0,0,0);
     background-color: rgba(0,0,0,0.3);
}

article.post,.comment-list > li {
	border-bottom-color: rgb(<?php echo hex2rgb($unik_data['content_color']); ?>);
	border-bottom-color: rgba(<?php echo hex2rgb($unik_data['content_color']); ?>,0.5);
}

select{
	border-color: rgb(<?php echo hex2rgb($unik_data['content_color']); ?>);
	border-color: rgba(<?php echo hex2rgb($unik_data['content_color']); ?>,0.5);
}	

/* Body
---------------------------------------------------------------------------------------------*/
body{
	background-color: <?php echo $unik_data['body_bg_color']; ?> ; 
	font-family: <?php echo $unik_data['google_body_font']; ?>;
	font-size: <?php echo $unik_data['body_font_size']; ?>px;
	font-weight: <?php echo $unik_data['body_font_weight']; ?>;
	<?php if($unik_data['body_bg_image']): ?>
	background-image: url("<?php echo $unik_data['body_bg_image']; ?>");
	background-repeat: <?php echo $unik_data['body_bg_repeat']; ?>;

	<?php if($unik_data['body_bg_repeat']=='no-repeat'): ?>
		background-size: cover;	
	<?php endif; ?>
	
	background-attachment:fixed;
	<?php endif; ?>
}


/* Headings
---------------------------------------------------------------------------------------------*/
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6{
	color: <?php echo $unik_data['heading_color']; ?> ; 
	font-family: <?php echo $unik_data['google_heading_font']; ?>;
	font-weight: <?php echo $unik_data['heading_font_weight']; ?>;
}
.woocommerce-tabs .active{
	color: <?php echo $unik_data['heading_color']; ?> ; 
}
h1,.h1{
	font-size: <?php echo $unik_data['h1_font_size']; ?>px;
}

h2,.h2{
	font-size: <?php echo $unik_data['h2_font_size']; ?>px;
}

h3,.h3{
	font-size: <?php echo $unik_data['h3_font_size']; ?>px;
}

h4,.h4,.woocommerce-tabs #reviews h2{
	font-size: <?php echo $unik_data['h4_font_size']; ?>px;
}

h5,.h5{
	font-size: <?php echo $unik_data['h5_font_size']; ?>px;
}

h6,.h6{
	font-size: <?php echo $unik_data['h6_font_size']; ?>px;
}

.wpdevbk label, .wpdevbk input, .wpdevbk button, .wpdevbk select, .wpdevbk textarea{
	font-family: <?php echo $unik_data['google_body_font']; ?>;
}

.price ins{
	color: <?php echo $unik_data['heading_color']; ?> ; 
}

/* Content bg
---------------------------------------------------------------------------------------------*/

#reservation-widget{
     background-color: rgb(<?php echo hex2rgb($unik_data['content_bg']); ?>);
     background-color: rgba(<?php echo hex2rgb($unik_data['content_bg']); ?>, <?php echo intval($unik_data['content_bg_opacity'])/100 ; ?>);
	 -webkit-box-shadow: 0 0 0 2px rgb(<?php echo hex2rgb($unik_data['content_bg']); ?>);
	box-shadow: 0 0 0 2px rgb(<?php echo hex2rgb($unik_data['content_bg']); ?>);
	-webkit-box-shadow: 0 0 0 2px rgba(<?php echo hex2rgb($unik_data['content_bg']); ?>,0.5);
	box-shadow: 0 0 0 2px rgba(<?php echo hex2rgb($unik_data['content_bg']); ?>,0.5);
}

.bg-block-1:after,.comment-body:after,header.main-top:after {
	background: <?php echo $unik_data['content_bg']; ?>;
	opacity: <?php echo intval($unik_data['content_bg_opacity'])/100 ; ?>;
}

.shows .view,.promo-bg,.sm-border{
	border:2px solid rgb(<?php echo hex2rgb($unik_data['content_bg']); ?>);
}


/* MENU
---------------------------------------------------------------------------------------------*/
.menu{
	color: <?php echo $unik_data['menu_color']; ?> ; 
	font-family: <?php echo $unik_data['google_menu_font']; ?>;
	font-size: <?php echo $unik_data['nav_font_size']; ?>px;
	font-weight: <?php echo $unik_data['menu_font_weight']; ?>;
}

#menu > li > a {
	color: <?php echo $unik_data['menu_color']; ?>;
}

.sf-menu ul:before, #menu li li a:before {
	background: <?php echo $unik_data['menu_bg']; ?>;
}
.sf-menu ul {
	-webkit-box-shadow: 0px -1px 0px <?php echo $unik_data['active_bg_color']; ?>;
	box-shadow: 0px -1px 0px <?php echo $unik_data['active_bg_color']; ?>;
}

#menu li a:hover, #menu li.sfHover > a, #menu [class*="current-"] > a,#menu li:hover:after, #menu [class*="current-"]:after{
     color: <?php echo $unik_data['menu_hover_color']; ?>;
}
#menu > .back{
	background-color: <?php echo $unik_data['menu_hover_color']; ?>;
}

#menu li li a:hover, #menu li li.current-menu-item > a {
	 background-color: <?php echo $unik_data['menu_hover_bg']; ?>;
}


/* EXTRAS
---------------------------------------------------------------------------------------------*/
#ajax-loader {
     background: rgb(0,0,0);
     background: rgba(0,0,0,0.5);
}

.pattern_overlay{
	<?php if( $unik_data['pattern_overlay_image']): ?>background: url(<?php echo $unik_data['pattern_overlay_image']; ?>) repeat top left;<?php endif; ?>
}

.button:hover, #submit:hover,.wrap .wpdevbk .btn:hover,.btn-primary:hover,.btn-primary:focus,.btn-primary:active,.btn-primary.disabled, .btn-primary[disabled], fieldset[disabled] .btn-primary, .btn-primary.disabled:hover, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary:hover, .btn-primary.disabled:focus, .btn-primary[disabled]:focus, fieldset[disabled] .btn-primary:focus, .btn-primary.disabled:active, .btn-primary[disabled]:active, fieldset[disabled] .btn-primary:active, .btn-primary.disabled.active, .btn-primary[disabled].active, fieldset[disabled] .btn-primary.active,.audio-post-sticker:hover{
     color: <?php echo $unik_data['active_hover_color']; ?> !important;
     background-color: <?php echo $unik_data['active_bg_hover']; ?>;
}


/* Form
---------------------------------------------------------------------------------------------*/
.form-control, textarea, input[type=text], input[type=date], input[type=search], input[type=tel], input[type=email], input[type=number], input[type=url],input[type="text"], input[type="number"],input[type="url"],input[type="password"],input[type="email"],select,.comment-author{
	background-color: <?php echo $unik_data['input_bg']; ?> !important;
}

.form-control, textarea, input[type=text], input[type=date], input[type=search], input[type=tel], input[type=email], input[type=number], input[type=url],input[type="text"], input[type="number"],input[type="url"],input[type="password"],input[type="email"],select,.comment-author{
	color: <?php echo $unik_data['input_color']; ?>;
}

.form-control::-webkit-input-placeholder, textarea::-webkit-input-placeholder, input[type=text]::-webkit-input-placeholder, input[type=email]::-webkit-input-placeholder, input[type=number]::-webkit-input-placeholder, input[type=url]::-webkit-input-placeholder,.form-control::-moz-placeholder,textarea::-moz-placeholder, input[type=text]::-moz-placeholder, input[type=email]::-moz-placeholder, input[type=number]::-moz-placeholder, input[type=url]::-moz-placeholder,.form-control:-ms-input-placeholder,textarea:-ms-input-placeholder, input[type=text]:-ms-input-placeholder, input[type=email]:-ms-input-placeholder, input[type=number]:-ms-input-placeholder, input[type=url]:-ms-input-placeholder {
   color: <?php echo $unik_data['input_color']; ?>;
}



/* FOOTER
---------------------------------------------------------------------------------------------*/
footer .jplayer {
	color: #fff;
}
.footer-player:before {
	background: <?php  echo $unik_data['footer_player_bg']; ?> url(<?php  echo $unik_data['footer_player_bg_img']; ?>);
}
#jp_footer_container div.jp-interface{
	color: <?php  echo $unik_data['footer_player_color']; ?> ;
}

/* WIDGETS
---------------------------------------------------------------------------------------------*/

.tagcloud a {
     background-color: #666666;
	 color: #ffffff;
}

.tagcloud a:hover {
     background-color: #dddddd;
	 color: #333333;
}

.tooltip.top .tooltip-arrow{
	border-top-color: #333;
}

.tooltip-inner {
	color: #fff;
	background-color: #333;
}
/* Other
---------------------------------------------------------------------------------------------*/
<?php if(!empty($unik_data['block_title_bg'])): ?>
.block-title{
	background-image: url("<?php echo $unik_data['block_title_bg']; ?>");
}
<?php endif; ?>

/* BLOG
---------------------------------------------------------------------------------------------*/
.copyright{
	font-size: <?php echo $unik_data['copyright_font_size']; ?>px;
}

.form-control{
	background-color: <?php echo $unik_data['input_bg']; ?> ;
}

/* FOOTER 
---------------------------------------------------------------------------------------------*/
.site-footer {
	background: <?php echo $unik_data['footer_bg']; ?>;
	color:  <?php echo $unik_data['footer_color']; ?>;
}

div.jp-seek-bar{
	background: rgb(<?php echo dark2light($unik_data['footer_bg']); ?>);
	background: rgba(<?php echo dark2light($unik_data['footer_bg']); ?>,0.6);
}

footer .social{
	color:  <?php echo $unik_data['footer_color']; ?>;
}

<?php echo $unik_data['custom_css']; ?>

@media only screen and (max-width: 768px){
		
	header.main-top .selectnav option{
		color: #fff;
		background-color: #000;
	}
}
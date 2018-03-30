<?php 
global $ievent_data; 
		
$theme_color=esc_attr($ievent_data['theme_color']);
$theme_color_hex=hex2rgb($theme_color);

// ----------- STYLES -----------
if($theme_color && $theme_color!="#EE163A"): ?>

.jx-ievent-info-content .info-title , .jx-ievent-section-title-1 .jx-ievent-title-icon i , .jx-ievent-servicebox-1 .jx-ievent-service-item .service-icon i , .jx-ievent-event-schedule .date ,.jx-ievent-event-schedule .date i , .jx-ievent-media-center .date i , .jx-ievent-btn-default.jx-ievent-outline , .jx-ievent-testimonial-details .jx-ievent-testimonial-icon i , .jx-ievent-testimonial-content .jx-ievent-testimonial-name , .jx-ievent-price-item.jx-ievent-white .jx-ievent-package-feature , .jx-ievent-btn-default.jx-ievent-outline i , .jx-ievent-readmore a , .jx-ievent-speaker-details .jx-ievent-speaker-social ul li:hover i,.jx-ievent-servicebox-2 .service-icon i,.speaker-social li i,.jx-ievent-title-3 .jx-ievent-title
{
	color:<?php  echo $theme_color ?> !important ;
}


.jx-ievent-page-titlebar .jx-ievent-page-titlebar-items .jx-ievent-breadcrumb a:hover , .jx-ievent-section-title-1 .jx-ievent-title-icon i , .jx-ievent-info-content .info-title,.jx-ievent-testimonial-item .jx-ievent-testimonial-content .jx-ievent-name i,.jx-ievent-speaker-item.jx-ievent-speaker-box-content .jx-ievent-title span {
	color:<?php  echo $theme_color ?>;
}

a:hover {
	color:#000000 !important;
}


.jx-ievent-btn-default {
	color: #ffffff !important;
}
.jx-ievent-btn-default:hover {
	color:#ffffff !important;
}
.jx-ievent-btn-default.jx-ievent-outline {
	color:<?php  echo $theme_color ?> !important;
}
.jx-ievent-btn-default.jx-ievent-outline:hover {
	color:#ffffff !important;
}


/* ------------------------------------------------------------------------ */
/* Background
/* ------------------------------------------------------------------------ */
::selection 
{
	background:<?php  echo $theme_color ?> !important;
}
::-moz-selection   
{
	background:<?php  echo $theme_color ?> !important;
}
.loader,.jx-ievent-servicebox-1 .jx-ievent-service-item .service-title-border , .jx-ievent-event-schedule .image i , .jx-ievent-speaker-details , .grid-item ,
.jx-ievent-newsletter .jx-ievent-form-wrapper button , .jx-ievent-single-point > a  , .jx-ievent-countdown .counter-wrapper li  , .jx-ievent-faq .jx-ievent-faq-head .jx-ievent-faq-title , .jx-ievent-contact-form input.jx-ievent-submit, .jx-ievent-main-slider .flex-direction-nav a  , .jx-ievent-menu .main-menu li a.mPS2id-highlight , .jx-ievent-page-titlebar .jx-ievent-page-titlebar-items .jx-ievent-breadcrumb span.current , .jx-ievent-image-container .jx-ievent-post-format , .jx-ievent-sidebar-widget .jx-ievent-right-pattern , .jx-ievent-blog-item .flex-control-paging li a.flex-active , .jx-ievent-page-search.wide .jx-ievent-form-wrapper button , .jx-ievent-ticket-form .jx-ievent-btn-default , .jx-ievent-price-table .jx-ievent-price-item , .jx-ievent-pagination span.current , #comment-submit , .jx-ievent-event-box-register .jx-ievent-event-register .jx-ievent-btn-default,.jx-ievent-grid-item .jx-ievent-date-box,.jx-ievent-footersection-widget .jx-ievent-right-pattern,.jx-ievent-summary-info,.jx-ievent-testimonial-item .jx-ievent-testimonial-content .jx-ievent-name,.jx-ievent-grid-item .jx-ievent-date-box,.jx-ievent-hr-title,.jx-ievent-servicebox-2 .jx-ievent-service-item .service-title-border,.jx-ievent-blog-head .jx-ievent-post-format i,.jx-ievent-price-table .jx-ievent-price-item.jx-ievent-white .jx-ievent-price,.jx-ievent-price-table .jx-ievent-price-item.jx-ievent-white .jx-ievent-package-name,.menu .submenu li:hover > a
{
	background:<?php  echo $theme_color ?> !important;
}

.jx-ievent-sponsor .flex-control-nav.flex-control-paging li a , .jx-ievent-testimonial .flex-control-nav.flex-control-paging li a , .jx-ievent-price-table .jx-ievent-price-item , .jx-ievent-btn-default,.jx-ievent-accordion .head,.jx-ievent-testimonial-item .jx-ievent-testimonial-content .jx-ievent-name,.jx-ievent-blog-head .jx-ievent-post-format i
{
	background-color:<?php  echo $theme_color ?>;
}
.jx-ievent-price-item.jx-ievent-white{
  background:#fff !important;   
}
	
/* ------------------------------------------------------------------------ */
/* Background Color
/* ------------------------------------------------------------------------ */

.jx-ievent-default-bg , .jx-ievent-pricing-switcher .jx-ievent-switch , table th , .page-title span , .jx-ievent-sidebar-widget .widget_search input.search-submit , .shortcode_tab_e.jx-ievent-white-tab.jx-ievent-arrow-tab li.resp-tab-active
{
	background-color:<?php  echo $theme_color ?> !important;
}

/* ------------------------------------------------------------------------ */
/* Background RGBA Color
/* ------------------------------------------------------------------------ */

.jx-ievent-event-box .jx-ievent-event-date , .jx-ievent-event-play,.jx-ievent-event-box-a .pre-title {
	background: rgba(<?php echo $theme_color_hex[0]; ?>, <?php echo $theme_color_hex[1]; ?>, <?php echo $theme_color_hex[2]; ?>, 0.90) !important;
}
.grid-item .jx-ievent-portfolio-hoverlayer  , .jx-ievent-media-center .jx-ievent-image-wrapper .jx-ievent-image-overlay , .jx-ievent-blog .jx-ievent-image-wrapper .jx-ievent-image-overlay,.jx-ievent-image-wrapper .jx-ievent-image-overlayer {
	background: rgba(<?php echo $theme_color_hex[0]; ?>, <?php echo $theme_color_hex[1]; ?>, <?php echo $theme_color_hex[2]; ?>, 0.80) !important;	
}

.jx-ievent-header.jx-ievent-sticky.fixed {
	background: rgba(<?php echo $theme_color_hex[0]; ?>, <?php echo $theme_color_hex[1]; ?>, <?php echo $theme_color_hex[2]; ?>, 0.95) !important;
}

/* ------------------------------------------------------------------------ */
/* Border Color
/* ------------------------------------------------------------------------ */

.jx-ievent-btn-default.jx-ievent-outline , .jx-ievent-testimonial .flex-control-nav.flex-control-paging li a.flex-active , .jx-ievent-sponsor .flex-control-nav.flex-control-paging li a.flex-active , .jx-ievent-price-item.jx-ievent-white .jx-ievent-package-feature li , .jx-ievent-blog-item .flex-control-paging li a , .jx-ievent-ticket-form .jx-ievent-btn-default:hover , .jx-ievent-pagination span.current , .jx-ievent-pagination a.page-numbers
	{
		border-color:<?php  echo $theme_color ?> !important;
	}
.jx-ievent-faq .jx-ievent-faq-head .jx-ievent-faq-title::after 
	{
	border-color: <?php  echo $theme_color ?> transparent !important;
	}
.shortcode_tab_e.jx-ievent-white-tab.jx-ievent-arrow-tab ul li.resp-tab-active::after,.jx-ievent-summary-info::after 
{
	border-color: <?php  echo $theme_color ?> transparent;
}
.jx-ievent-btn-default {
	border-color:<?php  echo $theme_color ?> !important;
}
/* ------------------------------------------------------------------------ */
/* Border Left Color
/* ------------------------------------------------------------------------ */

.page-title span::before {
	border-left-color:<?php  echo $theme_color ?> !important;
}
/* ------------------------------------------------------------------------ */
/* Border Bottom Color
/* ------------------------------------------------------------------------ */
.resp-tab-item.childtab_1.resp-tab-active , .resp-tab-item.childtab_2.resp-tab-active , .resp-tab-item.childtab_3.resp-tab-active
 {
	border-bottom-color:<?php  echo $theme_color ?> !important;
 }
 
 
<?php		
endif;
?>

 
 
<?php 

$theme_base_color=$ievent_data['theme_base_color'];
$theme_base_color_hex=hex2rgb($theme_base_color); 
 
if($theme_base_color && ($theme_base_color!="#333" or $theme_base_color!="#333333")): ?>
 
/* ------------------------------------------------------------------------ */
/* Grey Base Color
/* ------------------------------------------------------------------------ */
 
strong , select , .jx-ievent-blog-tag li a , #commentform input[type=text],#commentform textarea , .comment-heading , .commentlist li .author span , .jx-ievent-blog-tag i , input[type="text"],input[type="password"],input[type="email"],textarea , .jx-ievent-speaker-item .speaker-social li i:hover , .resp-tabs-list li , .jx-ievent-contact-form input , .jx-ievent-contact-form textarea , .jx-ievent-contact-info h2 , .jx-ievent-price-table.jx-ievent-price-2 , .jx-ievent-price-table.jx-ievent-price-2 .jx-ievent-price-btn a , .jx-ievent-event-register .sbSelector:link,.jx-ievent-event-register .sbSelector:visited,.jx-ievent-event-register .sbSelector:hover , .jx-ievent-more-info p , .jx-skillsbar-3 .skillbar-title , .jx-skillsbar-3 .skillbar-title span , .jx-skillsbar-3 .percenttext , .jx-skillsbar-4 .skillbar-title , .jx-skillsbar-4 .percenttext , .jx-skillsbar-6 .skillbar-title , .jx-skillsbar-6 .percenttext , .jx-icon-box .title , .jx-grid-image-btns a:hover div , .woocommerce ul.products .item-product .add_to_cart_button , .woocommerce .pagination .page-numbers li span.current , .woocommerce .pagination .page-numbers li .page-numbers.current , .woocommerce .pagination .page-numbers li:hover a , , .single-product.woocommerce div.product p.price, .woocommerce div.product span.price , .single-product .woocommerce-variation-price .price .amount , .shop_attributes th , .woocommerce-page #sidebar .product-categories li a:hover 
{
	color: <?php echo esc_attr( $theme_base_color ) ?>!important;
} 
 


/* ------------------------------------------------------------------------ */
/* Grey Base Background 
/* ------------------------------------------------------------------------ */

.jx-ievent-blog-tag li:hover , .jx-ievent-servicebox-2 .service-title , .jx-ievent-speaker-item .speaker-social li i , .jx-ievent-venue-box , .jx-ievent-price-btn a , .jx-ievent-price-table.jx-ievent-price-2 .jx-ievent-head , .jx-ievent-price-table.jx-ievent-price-3 .jx-ievent-price-btn a , .jx-ievent-price-table.jx-ievent-price-4 .jx-ievent-price-btn a , .jx-ievent-pricing-switcher .fieldset , .jx-accordion .none  .title .jx-accordion-icon::after , .jx-ievent-grid li .title , .woocommerce-page.woocommerce ul.products li.product .price , .woocommerce .pagination .page-numbers li .page-numbers , .item-product .added_to_cart:hover , #sidebar .widget_product_search input[type="submit"]:hover , .woocommerce-page.woocommerce-checkout .woocommerce #respond input#submit:hover, .woocommerce-page.woocommerce-checkout .woocommerce a.button:hover, .woocommerce-page.woocommerce-checkout .woocommerce button.button:hover, .woocommerce-page.woocommerce-checkout .woocommerce input.button:hover
{
	background: <?php echo esc_attr( $theme_base_color ) ?>!important;
}

 
 
/* ------------------------------------------------------------------------ */
/* Grey Base Background Color
/* ------------------------------------------------------------------------ */

.jx-ievent-price-table .jx-ievent-price-item.jx-ievent-white 
{
	background-color:  <?php echo esc_attr( $theme_base_color ) ?>!important;
}
 
 
/* ------------------------------------------------------------------------ */
/* Grey Base Border Color
/* ------------------------------------------------------------------------ */
 
.jx-ievent-post-footer li i , .woocommerce-page .flexslider li .glass-wrapper 
{
	border-color: <?php echo esc_attr( $theme_base_color ) ?>!important;
} 
 
 

<?php		
endif;
?>







<?php 

$theme_base_color=$ievent_data['theme_base_color'];
$theme_base_color_hex=hex2rgb($theme_base_color); 
 
if($theme_base_color && ($theme_base_color!="#333" or $theme_base_color!="#333333")): ?>
 

/* ------------------------------------------------------------------------ */
/* Black Base Color
/* ------------------------------------------------------------------------ */


h1,h2,h3,h4,h5,h6 , blockquote,blockquote p , a:hover , .jx-ievent-fontawesome-icon-list i , .jx-ievent-fontawesome-icon-list i , .jx-ievent-icon-listing-1 .line-icon , .jx-ievent-dark .line-icon , .black , .jx-ievent-black , .sticky:after , .jx-ievent-section-title-1 .jx-ievent-title , .jx-ievent-title-2 .jx-ievent-title , .jx-ievent-section-title-1.jx-ievent-dark p,.jx-ievent-section-title-1.jx-ievent-dark div.jx-ievent-title , 
.header-3 .jx-ievent-menu .main-menu li a , .header-4 .jx-ievent-menu .main-menu li a , .header-5 .jx-ievent-menu .main-menu li a , .header-6 .jx-ievent-menu .main-menu li a , .header-7 .jx-ievent-menu .main-menu li a , .header-8 .jx-ievent-menu .main-menu li a , .header-9 .jx-ievent-menu .main-menu li .sub-menu li a , .header-10 .jx-ievent-menu .main-menu li a , .header-2 .jx-ievent-menu .main-menu li a , .jx-ievent-placeholder-head.title_style-1 h2 , 
.jx-ievent-placeholder-head.title_style-1 a h2 , .jx-ievent-blog-head .jx-ievent-event-date , .jx-ievent-blog-head .title a , .jx-ievent-blog .title , .jx-ievent-blog-meta div.jx-ievent-event-cat , .jx-ievent-blog-meta div.jx-ievent-event-cat a , .jx-ievent-blog .date i , .jx-ievent-black , .jx-ievent-pagination a.next:hover , .jx-ievent-pagination .prev.page-numbers:hover , .commentlist li .date a:hover , .nav-links div.nav-previous:before , 
.nav-links div.nav-next:after , .jx-ievent-error .jx-ievent-error-msg , .jx-ievent-error .jx-ievent-error-code , .jx-ievent-footer-copyright a:hover , .jx-ievent-servicebox-1 .jx-ievent-service-item .service-title a ,.jx-ievent-servicebox-2 .jx-ievent-service-item .service-title a , .jx-ievent-servicebox-3 .jx-ievent-service-item .service-title a , .jx-ievent-dark .jx-ievent-counter-item .jx-ievent-counter-info .jx-ievent-counter-text , 
.jx-ievent-dark .jx-ievent-counter-item .jx-ievent-counter-info .jx-ievent-counter-number , .jx-ievent-speaker-item.jx-ievent-speaker-box-content .jx-ievent-title , .jx-ievent-speaker .speaker-name , .jx-ievent-price-table.jx-ievent-price-3 .jx-ievent-package-name , 
.jx-ievent-price-table.jx-ievent-price-3 .jx-ievent-price , .jx-ievent-media-center .title a , .jx-accordion .none .title , .jx-accordion.jx-accordion-border .title , .percenttext.jx-grey-bg , .percenttext.jx-white-bg , .jx-icon-box .icon , .jx-icon-box .icon i , .item-product .added_to_cart , .woocommerce ul.products li.product .onsale:after , .woocommerce-page .product .onsale , .woocommerce-page .product .onsale:after , .woocommerce-page ul.product_list_widget li a , .woocommerce-page ul.product-categories li a 
{
	color: <?php echo esc_attr( $theme_base_color ) ?>!important;
}





/* ------------------------------------------------------------------------ */
/* Black Base Background
/* ------------------------------------------------------------------------ */


.jx-ievent-newsletter .jx-ievent-form-wrapper button:hover , .jx-ievent-btn-default:hover , .jx-ievent-btn-default.jx-ievent-outline:hover , .resp-tabs-list.jx-ievent-subtab , .shortcode_tab_e.jx-ievent-white-tab.jx-ievent-arrow-tab ul.jx-ievent-subtab li , .jx-ievent-faq-description , 
.jx-ievent-testimonial-item .jx-ievent-testimonial-content .jx-ievent-name , .jx-ievent-btn-default.jx-ievent-outline.jx-ievent-white-btn:hover , .jx-ievent-media-center .jx-ievent-image-wrapper .jx-ievent-blog-more i , .jx-ievent-summary-info li .jx-ievent-newsletter-submit input , .wpcf7-form .wpcf7-submit:hover , .jx-skillsbar-2 .percenttext , .jx-ievent-section-title-1 .jx-ievent-title-border , .jx-ievent-section-title-1.jx-ievent-dark div.jx-ievent-title-border , .header-8 .jx-ievent-topbar , .header-9 .jx-ievent-topbar , .jx-ievent-menu .main-menu li ul.sub-menu > li > ul , .fixed .jx-ievent-menu > .main-menu > li:hover a , .jx-ievent-event-register .jx-ievent-btn-default:hover , .jx-ievent-ticket-form .jx-ievent-btn-default:hover , .jx-ievent-blog .jx-ievent-image-wrapper .jx-ievent-blog-more i , .jx-ievent-pagination a:hover , #comment-submit:hover , .jx-ievent-page-search.wide .jx-ievent-form-wrapper button:hover ,  .jx-ievent-sidebar-widget .widget_search input.search-submit:hover , .jx-ievent-sidebar-widget .widget_calendar caption , .tagcloud a:hover , .jx-ievent-footersection-widget .widget_search input.search-submit:hover , .jx-ievent-footersection-widget .widget_calendar caption
{
	background: <?php echo esc_attr( $theme_base_color ) ?>!important;
}



/* ------------------------------------------------------------------------ */
/* Black Base Background Color
/* ------------------------------------------------------------------------ */

.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt , .jx-ievent-black-bg 
{
	background-color: <?php echo esc_attr( $theme_base_color ) ?>!important;
}

/* ------------------------------------------------------------------------ */
/* Black Base Border Right
/* ------------------------------------------------------------------------ */


.jx-ievent-counter-item .jx-ievent-counter-icon , .jx-ievent-newsletter .jx-ievent-form-wrapper button:hover:before 
{
	border-right-color: <?php echo esc_attr( $theme_base_color ) ?>!important;
}





 
 
<?php		
endif;
?>

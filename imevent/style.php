<?php
$root = dirname(dirname(dirname(dirname(__FILE__))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}

header("Content-type: text/css; charset=utf-8");

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values
}

global $theme_option;

$parallax_overlay = hex2rgb($theme_option['theme_color']);

$main_color= $theme_option['theme_color'];



?>

/* RED 2 */
#preloader {
  background-color: #ffffff;
}
.spinner {
  background: #ffffff;
  box-shadow: inset 0 0 0 0.12em rgba(0, 0, 0, 0.2);
  background: -webkit-linear-gradient(<?php echo esc_attr($main_color); ?> 50%, #353535 50%), -webkit-linear-gradient(#353535 50%, <?php echo esc_attr($main_color); ?> 50%);
  background: linear-gradient(<?php echo esc_attr($main_color); ?> 50%, #353535 50%), linear-gradient(#353535 50%, <?php echo esc_attr($main_color); ?> 50%);
}
.spinner:after {
  border: 0.9em solid #ffffff;
}
body {
  background: #fbfbfb;
  color: #6d7a83;
}
.wide .page-section.light,
.boxednew .page-section.light {
  background-color: #f5f5f5;
  color: #435469;
}
.wide .page-section.color,
.boxednew .page-section.color {
  background-color: <?php echo esc_attr($main_color); ?>;
  color: #ffffff;
}
h1,
h2,
h3,
h4,
h5,
h6 {
  color: #141f23;
}
h1 .fa,
h2 .fa,
h3 .fa,
h4 .fa,
h5 .fa,
h6 .fa,
h1 .glyphicon,
h2 .glyphicon,
h3 .glyphicon,
h4 .glyphicon,
h5 .glyphicon,
h6 .glyphicon {
  color: #e71f16;
}
.section-title {
  color: #0d1d31;
}
.section-title small {
  color: #374146;
}
.dark .section-title,
.dark .section-title small,
.color .section-title,
.color .section-title small {
  color: #ffffff;
}
.body-dark .color .section-title small{
  color: #435469;
}
.color .section-title:after {
  color: #141f23;
}
.section-title .fa-stack .fa {
  color: #ffffff;
}
.color .section-title .fa-stack .fa {
  color: <?php echo esc_attr($main_color); ?>;
}
.section-title .rhex {
  background-color: <?php echo esc_attr($main_color); ?>;
}
.color .section-title .rhex {
  background-color: #ffffff;
}
.rhex {
  background-color: <?php echo esc_attr($main_color); ?>;
}
a {
  color: <?php echo esc_attr($main_color); ?>;
}
a:hover,
a:active,
a:focus {
  color: #000000;
}
.color a {
  color: #ffffff;
}
.color a:hover,
.color a:active,
.color a:focus {
  color: #000000;
}
.dropcap {
  color: #e71f16;
}
.text-lg {
  color: #141f23;
}
.page-header {
  color: #515151;
}
.page-header h1 {
  color: #515151;
}
.page-header h1 small {
  color: #6f6f6f;
}
hr.page-divider {
  border-color: #eeeeee;
}
hr.page-divider:after {
  border-bottom: solid 1px #eeeeee;
}
hr.page-divider.single {
  border-color: #646464;
}
.btn-theme {
  color: #ffffff;
  background-color: <?php echo esc_attr($main_color); ?>;
  border-color: <?php echo esc_attr($main_color); ?>;
}
.btn-theme:hover {
  background-color: #435469;
  border-color: #435469;
  color: #ffffff;
}
.color .btn-theme {
  color: <?php echo esc_attr($main_color); ?>;
  background-color: #ffffff;
  border-color: #ffffff;
}
.color .btn-theme:hover {
  background-color: #435469;
  border-color: #435469;
  color: #ffffff;
}
.btn-theme-transparent,
.btn-theme-transparent:focus,
.btn-theme-transparent:active {
  background-color: transparent;
  border-color: <?php echo esc_attr($main_color); ?>;
  color: <?php echo esc_attr($main_color); ?>;
}
.btn-theme-transparent:hover {
  background-color: #435469;
  border-color: #435469;
  color: #ffffff;
}
.btn-theme-transparent-grey,
.btn-theme-transparent-grey:focus,
.btn-theme-transparent-grey:active {
  background-color: transparent;
  border-color: #435469;
  color: #435469;
}
.btn-theme-transparent-grey:hover {
  background-color: #435469;
  border-color: #435469;
  color: #ffffff;
}
.btn-theme-transparent-white,
.btn-theme-transparent-white:focus,
.btn-theme-transparent-white:active {
  background-color: transparent;
  border-color: #ffffff;
  color: #ffffff;
}
.btn-theme-transparent-white:hover {
  background-color: #435469;
  border-color: #435469;
  color: #ffffff;
}
.btn-theme-grey {
  background-color: #f5f5f5;
  border-color: #e8e8e8;
  color: #e71f16;
}
.btn-theme-grey:hover,
.btn-theme-grey:focus,
.btn-theme-grey:active {
  background-color: #435469;
  border-color: #435469;
  color: #ffffff;
}
.form-control {
  border: 1px solid #c8cdd2;
  color: #6d7a83;
}
.form-control:focus {
  border-color: <?php echo esc_attr($main_color); ?>;
}
.bootstrap-select > .selectpicker {
  border: 1px solid #c8cdd2;
  color: #6d7a83 !important;
  background-color: #ffffff !important;
}
.bootstrap-select > .selectpicker:focus {
  border-color: <?php echo esc_attr($main_color); ?>;
}
.registration-form .tooltip-inner {
  background-color: <?php echo esc_attr($main_color); ?>;
}
.registration-form .tooltip-arrow {
  border-top-color: <?php echo esc_attr($main_color); ?>;
}
.registration-form .tooltip.top .tooltip-arrow {
  border-top-color: <?php echo esc_attr($main_color); ?>;
}
.sub-page .header {
  background-color: #81868c;
}
.home.sub-page .header{
  background-color: transparent;
}
.home.blog .header{
  background-color: #81868c;
}

.wide .header.shrink,
.boxednew .header.shrink  {
  background-color: rgba(129, 134, 140, 0.8);
}
.logo a {
  color: #ffffff;
}
.logo a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.logo a .logo-hex {
  background-color: <?php echo esc_attr($main_color); ?>;
}
.logo a:hover .logo-hex {
  background-color: #ffffff;
}
.logo a .logo-fa {
  color: #ffffff;
}
.logo a:hover .logo-fa {
  color: <?php echo esc_attr($main_color); ?>;
}
.sf-menu a {
  color: #ffffff;
}
.sf-menu a:hover {
  color: #ffffff;
}
.sf-menu li.active {
  background-color: rgba(13, 29, 49, 0.3);
}
.sf-menu li.active > a {
  color: #ffffff;
}
.sf-menu ul li {
  background: #f2f2f2;
}
.sf-arrows .sf-with-ul:after {
  border-top-color: #9e9e9e;
}
.sf-arrows > li > .sf-with-ul:focus:after,
.sf-arrows > li:hover > .sf-with-ul:after,
.sf-arrows > .sfHover > .sf-with-ul:after {
  border-top-color: <?php echo esc_attr($main_color); ?>;
}
.sf-arrows ul .sf-with-ul:after {
  border-left-color: #9e9e9e;
}
.sf-arrows ul li > .sf-with-ul:focus:after,
.sf-arrows ul li:hover > .sf-with-ul:after,
.sf-arrows ul .sfHover > .sf-with-ul:after {
  border-left-color: <?php echo esc_attr($main_color); ?>;
}
.menu-toggle {
  color: #ffffff !important;
}
@media (max-width: 991px) {
  .navigation {
    background-color: rgba(13, 29, 49, 0.95);
  }
}
@media (max-width: 991px) {
  .mobile-submenu {
    background-color: <?php echo esc_attr($main_color); ?>;
  }
}
#main-slider.owl-theme .owl-controls .owl-buttons .owl-prev,
#main-slider.owl-theme .owl-controls .owl-buttons .owl-next {
  color: #ffffff;
  text-shadow: 1px 1px 0 #141f23;
}
#main-slider.owl-theme .owl-controls .owl-buttons .owl-prev:hover,
#main-slider.owl-theme .owl-controls .owl-buttons .owl-next:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
#main-slider .caption-title {
  color: #ffffff;
  text-shadow: 1px 1px #000000;
}
#main-slider .caption-title span:before,
#main-slider .caption-title span:after {
  border-top: solid 1px #ffffff;
  border-bottom: solid 1px #ffffff;
}
#main-slider .caption-subtitle {
  color: #ffffff;
  text-shadow: 1px 1px #000000;
}
#main-slider .caption-subtitle .fa {
  color: #ffffff;
}
#main-slider .caption-subtitle span {
  color: #253239;
}
#main-slider .caption-text {
  color: #8c8e93;
}
.form-background {
  background-color: #0d1d31;
}
.form-header {
  background-color: <?php echo esc_attr($main_color); ?>;
}
.text-holder:before,
.text-holder:after {
  border-top: solid 1px #ffffff;
  border-bottom: solid 1px #ffffff;
}
.btn-play {
  border: solid 1px #ffffff;
  background-color: rgba(255, 255, 255, 0.3);
}
.btn-play .fa {
  background-color: #ffffff;
  color: <?php echo esc_attr($main_color); ?>;
}
.btn-play:hover {
  border-color: <?php echo esc_attr($main_color); ?>;
}
.btn-play:hover .fa {
  background-color: <?php echo esc_attr($main_color); ?>;
}
.btn-play:hover .fa {
  color: #ffffff;
}

.event-background {
  background-color: #0d1d31;
}
.event-description {
  color: #ffffff;
}
.event-description .media-heading {
  color: #d01c14;
}
.img-carousel .owl-controls .owl-page span,
.img-carousel .owl-controls .owl-buttons div {
  background-color: <?php echo esc_attr($main_color); ?>;
}
/* 3.4 - Partners carousel / Owl carousel
/* ========================================================================== */
.partners-carousel .owl-carousel div a {
  background-color: #f3f4f5;
}
.partners-carousel .owl-prev,
.partners-carousel .owl-next {
  border: solid 1px #435469;
  color: #435469;
}
.partners-carousel .owl-prev .fa,
.partners-carousel .owl-next .fa {
  color: #435469;
}
.partners-carousel .owl-prev:hover,
.partners-carousel .owl-next:hover {
  border-color: <?php echo esc_attr($main_color); ?>;
  color: <?php echo esc_attr($main_color); ?>;
}
.partners-carousel .owl-prev:hover .fa,
.partners-carousel .owl-next:hover .fa {
  color: <?php echo esc_attr($main_color); ?>;
}
.page-section.breadcrumbs {
  background-color: #f9f9f9;
}
.breadcrumbs .breadcrumb:after {
  background-color: #e1e1e1;
}
.schedule-wrapper {
  border: solid 1px #435469;
  border-bottom-width: 10px;
}
.schedule-tabs.lv1 {
  background-color: #435469;
  color: #ffffff;
}
.schedule-tabs.lv2 {
  border: solid 1px #8598b0;
  background-color: #ffffff;
}
.schedule-wrapper .schedule-tabs.lv1 .nav > li > a {
  color: #ffffff;
}
.schedule-wrapper .schedule-tabs.lv1 .nav > li.active:before {
  border-top: 7px solid #435469;
}
.schedule-wrapper .schedule-tabs.lv2 .nav > li > a {
  color: #293239;
}
.schedule-wrapper .schedule-tabs.lv2 .nav > li.active > a {
  color: <?php echo esc_attr($main_color); ?>;
}
.schedule-wrapper .schedule-tabs.lv2 .nav > li.active:before {
  background-color: <?php echo esc_attr($main_color); ?>;
}
.row.faq .tab-content {
  border: solid 1px #435469;
  background-color: #fdfdfd;
}
@media (min-width: 768px) {
  .row.faq .tab-content:before {
    border-right: 10px solid #435469;
  }
  .row.faq .tab-content:after {
    border-right: 10px solid #fdfdfd;
  }
}
.row.faq .nav li a {
  border: solid 1px #435469;
  background-color: #fdfdfd;
  color: #374146;
}
.row.faq .nav li.active a,
.row.faq .nav li a:hover {
  background-color: <?php echo esc_attr($main_color); ?>;
  border-color: <?php echo esc_attr($main_color); ?>;
  color: #ffffff;
}
.post-title {
  color: #0d1d31;
}
.post-title a {
  color: #0d1d31;
}
.post-title a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.post-header .post-meta {
  color: <?php echo esc_attr($main_color); ?>;
}
.post-header .post-meta a,
.post-header .post-meta .fa {
  color: #435469;
}
.post-header .post-meta a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.post-readmore .btn {
  border-color: #435469;
  color: #435469;
}
.post-readmore .btn:hover,
.post-readmore .btn:focus {
  background-color: #435469;
  border-color: #435469;
  color: #ffffff;
}
.post-meta-author a {
  color: #464c4e;
}
.post-meta-author a:hover {
  color: #000000;
}
.post-type {
  background-color: rgba(255, 255, 255, 0.8);
}
.post + .post {
  border-top: solid 1px #efefef;
}
.about-the-author {
  border-top: solid 1px #efefef;
}
.timeline .media-body {
  background-color: #ffffff;
}
.timeline .post-media {
  border: solid 8px #afb4ba;
}
.timeline .post-title {
  color: <?php echo esc_attr($main_color); ?>;
  border-bottom: solid 1px #d2d2dc;
}
.timeline .post-title a {
  color: <?php echo esc_attr($main_color); ?>;
}
.body-dark .timeline .post-title a{
  color: #fff;
}
.timeline .post-title a:hover {
  color: #000000;
}
.timeline .post-meta a .fa {
  color: <?php echo esc_attr($main_color); ?>;
}
.timeline .post-meta a:hover .fa {
  color: #293239;
}
.timeline .post-readmore {
  color: #293239;
}
.timeline .post-readmore a {
  color: #293239;
}
.timeline .post-readmore a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.comments {
  border-top: solid 1px #efefef;
}
.comment-date {
  color: #b0afaf;
}
.comment-reply {
  border-bottom: solid 1px #efefef;
}
.comments-form {
  border-top: solid 1px #efefef;
}
.pagination-wrapper {
  border-top: solid 1px #efefef;
}
.pagination > li > a {
  background-color: #f5f5f5;
  color: #253239;
}
.pagination > li > a:hover,
.pagination > li > span:hover,
.pagination > li > a:focus,
.pagination > li > span:focus {
  background-color: <?php echo esc_attr($main_color); ?>;
  color: #ffffff;
}
.pagination > .active > a,
.pagination > .active > span,
.pagination > .active > a:hover,
.pagination > .active > span:hover,
.pagination > .active > a:focus,
.pagination > .active > span:focus {
  background-color: <?php echo esc_attr($main_color); ?>!important;
  border-color: <?php echo esc_attr($main_color); ?>!important;
}

.project-details .dl-horizontal dt {
  color: #3c4547;
}
.thumbnail.hover,
.thumbnail:hover {
  border: solid 1px <?php echo esc_attr($main_color); ?>;
}
.thumbnail .caption.hovered {
  background-color: rgba(<?php echo esc_attr($parallax_overlay[0]); ?>,<?php echo esc_attr($parallax_overlay[1]); ?>, <?php echo esc_attr($parallax_overlay[2]); ?>, 0.5);  
  color: #ffffff;
}
.caption-title {
  color: #0d1d31;
}
.hovered .caption-title {
  color: #ffffff;
}
.caption-buttons .btn {
  color: #ffffff;
}
.caption-category {
  color: <?php echo esc_attr($main_color); ?>;
}
.caption-redmore {
  color: #c4334b;
}
.caption-redmore:hover {
  color: #000000;
}
.testimonial .media-heading {
  color: #0d1d31;
}
.color .testimonials.owl-theme .owl-dots .owl-dot span {
  background-color: <?php echo esc_attr($main_color); ?>;
  border: solid 2px #ffffff;
}
.color .testimonials.owl-theme .owl-dots .owl-dot.active span,
.color .testimonials.owl-theme .owl-dots .owl-dot:hover span {
  background-color: #ffffff;
}
.wide .footer-meta,
.boxednew .footer-meta  {
  background-color: #f5f5f5;
  color: #414650;
}
.footer .widget-title {
  color: #ffffff;
}
.sidebar .widget-title small {
  color: #999999;
}
.footer .widget-title small {
  color: #818181;
}
.widget-title:before {
  background-color: <?php echo esc_attr($main_color); ?>;
}
#af-form .form-control {
  background-color: #ffffff;
  border-color: #ffffff;
  color: #ffffff;
}
#af-form .form-control:focus {
  border-color: <?php echo esc_attr($main_color); ?>;
}
#af-form .alert {
  border-color: <?php echo esc_attr($main_color); ?>;
  background-color: <?php echo esc_attr($main_color); ?>;
  color: #ffffff;
}
#af-form .tooltip-inner {
  background-color: #000000;
}
#af-form .tooltip-arrow {
  border-top-color: #000000;
}
.form-button-reset {
  color: #253239;
  background-color: #f5f5f5;
  border-color: #e8e8e8;
}
.form-button-reset:focus,
.form-button-reset:hover {
  color: #ffffff;
  background-color: #999999;
  border-color: #999999;
}
.color #af-form .form-control {
  border-color: #ffffff;
  background-color: rgba(2, 2, 2, 0.2);
}
.color #af-form .form-control:focus {
  background-color: rgba(2, 2, 2, 0.5);
}
.social-line a {
  background-color: #c3c3c3;
  color: #ffffff;
}
.social-line a:before {
  border-bottom: 10px solid #c3c3c3;
}
.social-line a:after {
  border-top: 10px solid #c3c3c3;
}
.price-table {
  border: solid 1px #0d1d31;
}
.price-label {
  background-color: #f5f5f5;
  color: #475056;
}
.price-label-title {
  color: #475056;
}
.price-value {
  color: <?php echo esc_attr($main_color); ?>;
}
.price-table-row {
  color: #6d7a83;
  border-top: solid 1px #c5c7c9;
}
.price-table-row-bottom {
  border-top: solid 1px #c5c7c9;
}
.price-table.featured {
  border-color: <?php echo esc_attr($main_color); ?>;
}
.price-table.featured:before {
  background-color: <?php echo esc_attr($main_color); ?>;
  color: #ffffff;
}
.container.gmap-background .on-gmap.color {
  background-color: <?php echo esc_attr($main_color); ?>;
  color: #fefefe;
}
.parallax h1,
.parallax h2,
.parallax h3,
.parallax h4,
.parallax h5,
.parallax h6 {
  color: #ffffff;
}
.parallax .block-text {
  color: #ffffff;
}
.parallax-inner {
  color: #ffffff;
}
.error-number {
  color: #0d1d31;
}
.to-top {
  background-color: #373737;
  color: #9f9197;
}
.to-top:hover {
  background-color: <?php echo esc_attr($main_color); ?>;
  color: #ffffff;
}
.btn-preview-light,
.btn-preview-light:hover {
  border-color: #f5f5f5;
  background-color: <?php echo esc_attr($main_color); ?>;
}
.btn-preview-dark,
.btn-preview-dark:hover {
  border-color: #f5f5f5;
  background-color: #0d1d31;
}
.sidebar .widget-title {
  color: <?php echo esc_attr($main_color); ?>;
}
.widget.categories li.active a,
.widget.categories li a:hover {
  background-color: <?php echo esc_attr($main_color); ?>;
  color: #ffffff;
}
.about-the-author .media-heading {
  color: <?php echo esc_attr($main_color); ?>;
}
.comments-form .block-title {
  color: <?php echo esc_attr($main_color); ?> !important;
}
.error-page .logo a,
.error-page .logo a:hover {
  color: #ffffff;
}
.error-page .logo a .logo-hex,
.error-page .logo a:hover .logo-hex {
  background-color: #ffffff;
}
.error-page .logo a .logo-fa,
.error-page .logo a:hover .logo-fa {
  color: <?php echo esc_attr($main_color); ?>;
}
/* dark version */
.body-dark .section-title .rhex {
  background-color: <?php echo esc_attr($main_color); ?>;
}
.body-dark .color .section-title .rhex {
  background-color: <?php echo esc_attr($main_color); ?>;
}
.body-dark .form-background .section-title .rhex {
  background-color: #ffffff;
}
.body-dark .form-background .section-title .fa-stack-1x {
  color: <?php echo esc_attr($main_color); ?> !important;
}
.body-dark .color .btn-theme {
  background-color: <?php echo esc_attr($main_color); ?>;
  border-color: <?php echo esc_attr($main_color); ?>;
}
.body-dark .form-control:focus {
  border-color: #e71f16;
}
.body-dark .event-background {
  background-color: <?php echo esc_attr($main_color); ?>;
}
.body-dark .post-header .post-meta {
  color: <?php echo esc_attr($main_color); ?>;
}
.body-dark .pagination-wrapper {
  border-top: solid 1px #435469;
}
.body-dark .pagination > li > a {
  background-color: #435469 ;
  color: #f5f5f5;
}
.body-dark .pagination > li > a:hover,
.body-dark .pagination > li > span:hover,
.body-dark .pagination > li > a:focus,
.body-dark .pagination > li > span:focus {
  background-color: <?php echo esc_attr($main_color); ?>;
  color: #ffffff;
}
.body-dark .pagination > .active > a,
.body-dark .pagination > .active > span,
.body-dark .pagination > .active > a:hover,
.body-dark .pagination > .active > span:hover,
.body-dark .pagination > .active > a:focus,
.body-dark .pagination > .active > span:focus {
  background-color: <?php echo esc_attr($main_color); ?>;
  border-color: <?php echo esc_attr($main_color); ?>;
}
.body-dark .widget.categories li a {
  background-color: #435469;
  color: #f5f5f5;
}
.body-dark .widget.categories li.active a,
.body-dark .widget.categories li a:hover {
  background-color: <?php echo esc_attr($main_color); ?>;
  color: #ffffff;
}

.tagcloud a:hover{
  background-color: <?php echo esc_attr($main_color); ?>;
  border-color: <?php echo esc_attr($main_color); ?>;
}

.speaker .caption-title a:hover{
 color: <?php echo esc_attr($main_color); ?>; 
}
.body-dark .speaker .caption-title a{
  color: #fff!important;
}

.error404.sub-page .header{
  background-color: <?php echo esc_attr($main_color); ?>;
  border-bottom: 1px solid #fff;
}

.error404 #preloader{
  display:none;
}
.error404 .logo a:hover{
  color:#fff;

}
.error404 .logo a .logo-hex{
  background-color:#fff;
}
.error404 .logo a .logo-fa{
  color: <?php echo esc_attr($main_color); ?>;
}
.error404 footer, .error404 .to-top{
  display:none;
}

.social-line a:hover{
  background-color: <?php echo esc_attr($main_color); ?>!important;
}
.social-line a:hover:before{
border-bottom-color: <?php echo esc_attr($main_color); ?>!important;
}
.social-line a:hover:after{
  border-top-color: <?php echo esc_attr($main_color); ?>!important;
}

.single-schedule .post-readmore{
text-align: left;
}

#sidebar ul,#sidebar li{
  list-style-type:none;
  padding-left: 0;
  margin-left:0;

}
.page-section.with-sidebar{
  padding-top: 170px;
}


/*************** Update css for version 2.0 ************************/
.event-description .media-heading{
  color: <?php echo esc_attr($main_color); ?>!important;
}

/* fix for icon style of heading */

.wohex, .crcle, .rhex {
background-color: <?php echo esc_attr($main_color); ?>;
}

.color .wohex,.color .crcle {
background-color: #fff;
}

.body-dark  .wohex, .body-dark .crcle, .body-dark  .rhex {
background-color: <?php echo esc_attr($main_color); ?>;
}


#main-slider.owl-theme .owl-controls .owl-nav [class*=owl-]:hover{
  border-color: <?php echo esc_attr($main_color); ?>!important;
  background: <?php echo esc_attr($main_color); ?>!important;  
}

ul.pagination li span.current{
    background-color: <?php echo esc_attr($main_color); ?>;
  }

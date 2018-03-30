<?php
    $custom_color_1 = get_theme_mod('custom_color_1');
	$custom_color_1_without_hash = str_replace('#', '', $custom_color_1);	
    $custom_color_2 = get_theme_mod('custom_color_2');
	$custom_color_3 = get_theme_mod('custom_color_3');
	$custom_color_4 = get_theme_mod('custom_color_4');
	
	$custom_color_5 = get_theme_mod('custom_color_5');

	function multipurpose_hex2rgb($hex) {
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
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
	$custom_color_1_rgb = multipurpose_hex2rgb($custom_color_1);
	
	$images_path = get_template_directory_uri() . '/images/';
?>
.color-custom .required,
.color-custom a:hover, .color-custom header p.title a:hover,
.color-custom .directory h2 a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .top nav > ul > li.current-menu-item > a,
.color-custom .top nav > ul > li.current-menu-item:hover > a,
.color-custom .top nav > ul > li.current_page_item > a,
.color-custom .top nav > ul > li.current_page_item:hover > a,
.color-custom .top nav > ul > li.current-menu-ancestor > a {background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom header .top ul ul a {color: #3f3f3f;}
.color-custom .main-header a {color: #3f3f3f;}
.color-custom blockquote {border-left-color: <?php echo $custom_color_1; ?>;}
.color-custom nav.mainmenu>ul>li:hover>a {color: <?php echo $custom_color_1; ?>;}
.color-custom nav.mainmenu>ul>li.current-menu-item>a {color: <?php echo $custom_color_1; ?>;}
.color-custom.t03 h2.underline, .color-custom.t01 h3.underline span, .color-custom h2 span, .color-custom h2:first-child span, .color-custom h2.underline span, .color-custom h3 span, .color-custom.t03 .widget h3 {border-color: <?php echo $custom_color_1; ?>;}
.color-custom .more a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom h2.alt span {border-bottom: 2px solid <?php echo $custom_color_1; ?>;}
.color-custom .dc-alt {color: <?php echo $custom_color_1; ?>;}
.color-custom ul.tabs a.selected {border: 1px solid <?php echo $custom_color_1; ?>; border-bottom: 3px solid <?php echo $custom_color_2; ?>; background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom a:hover .circle {border-color: <?php echo $custom_color_2; ?>; background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom .wp-pagenavi span.current {color: <?php echo $custom_color_1; ?>;}
.color-custom .wp-pagenavi a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom ul.accordion li>a:before {color: <?php echo $custom_color_1; ?>;}
.color-custom .content-slider article h3 a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom ul.hp-services li h3 a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .hp-recent-work article h3 a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .filters ul a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .filters ul a.selected {background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom .portfolio article h3 a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .project p.copyright a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .project dl {border-left: 2px solid <?php echo $custom_color_1; ?>;}
.color-custom .project-nav a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .postlist article h2 a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .post-meta a:hover, .tags a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .post-author h3 a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .comment-author a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .popular-objects a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .events .rss-link a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .events-head a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .calendar td a.day:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .sidebar a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom p.progress>span.fill {background: <?php echo $custom_color_1; ?>;}
.color-custom .tooltip-dark {position: relative; background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom span.tooltip.dark {background: <?php echo $custom_color_1;?>;}
.color-custom .testimonial>div>p:first-child {background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="13px"><g><g><path fill="%23<?php echo $custom_color_1_without_hash;?>" d="M6.034,4.205l0.841-1.458c0.514-0.891,0.209-2.028-0.681-2.543 C5.304-0.31,4.165-0.005,3.651,0.886L0.549,6.259C0.496,6.351,0.457,6.447,0.421,6.544c-0.277,0.588-0.444,1.237-0.444,1.93 c0,2.512,2.036,4.547,4.546,4.547c2.511,0,4.547-2.035,4.547-4.547C9.07,6.495,7.798,4.829,6.034,4.205z M17.034,4.205 l0.841-1.458c0.514-0.891,0.209-2.028-0.682-2.543c-0.89-0.514-2.028-0.209-2.542,0.682l-3.103,5.373 c-0.054,0.093-0.094,0.191-0.13,0.289c-0.276,0.586-0.442,1.235-0.442,1.926c0,2.512,2.035,4.547,4.547,4.547 c2.511,0,4.547-2.035,4.547-4.547C20.07,6.495,18.799,4.829,17.034,4.205z"/></g></g></svg>');}
.color-custom table.alt th {border-bottom: 3px solid <?php echo $custom_color_2; ?>; background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom .pricing-plan:hover {border-top: 2px solid <?php echo $custom_color_1; ?>;}
.color-custom .pricing-plan:hover p.price strong {color: <?php echo $custom_color_1; ?>;}
.color-custom .pricing-plan:hover h2 {color: <?php echo $custom_color_1; ?>;}
.color-custom table.pricing tr.action td:first-child a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .why-us ul li {background-image: url("<?php echo $images_path;?>tick-gray.png");}
.color-custom ul.tick li {background: url("<?php echo $images_path;?>tick-gray.png") 0 0 no-repeat;}
.color-custom footer {padding: 25px 0 0; color: #aeaeae;}
.color-custom footer a {color: #ebebeb;}
.color-custom footer a:hover {color: #aeaeae;}
.color-custom p.more a {color: #3f3f3f;}
.color-custom p.more a:hover {color: <?php echo $custom_color_1; ?>;}
@media (max-width: 980px) {
	.color-custom footer {margin: 0 -20px; padding: 25px 20px 0;}
}

.color-custom button[type="submit"], .color-custom input[type="submit"], .color-custom a.button, .color-custom .pricing-plan a.button, .color-custom table.pricing a.button, .color-custom .directory .searchform button {border-color: <?php echo $custom_color_4; ?>; border-top-color: <?php echo $custom_color_5; ?>;background: <?php echo $custom_color_3; ?>;
background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1 1" preserveAspectRatio="none"><linearGradient id="grad-ucgg-generated" gradientUnits="userSpaceOnUse" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="<?php echo $custom_color_3; ?>" stop-opacity="1"/><stop offset="100%" stop-color="<?php echo $custom_color_4; ?>" stop-opacity="1"/></linearGradient><rect x="0" y="0" width="1" height="1" fill="url(#grad-ucgg-generated)" /></svg>');
background: -moz-linear-gradient(top,  <?php echo $custom_color_3; ?> 0%, <?php echo $custom_color_4; ?> 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $custom_color_3; ?>), color-stop(100%,<?php echo $custom_color_4; ?>));
background: -webkit-linear-gradient(top,  <?php echo $custom_color_3; ?> 0%,<?php echo $custom_color_4; ?> 100%);
background: -o-linear-gradient(top,  <?php echo $custom_color_3; ?> 0%,<?php echo $custom_color_4; ?> 100%);
background: -ms-linear-gradient(top,  <?php echo $custom_color_3; ?> 0%,<?php echo $custom_color_4; ?> 100%);
background: linear-gradient(to bottom,  <?php echo $custom_color_3; ?> 0%,<?php echo $custom_color_4; ?> 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $custom_color_3; ?>', endColorstr='<?php echo $custom_color_4; ?>',GradientType=0 );
color: #fff; text-shadow: 0 -1px 0 <?php echo $custom_color_5; ?>;}
.color-custom button[type="submit"]:hover, .color-custom input[type="submit"]:hover, .color-custom a.button:hover, .color-custom table.pricing a.button:hover, .color-custom .directory .searchform button:hover {background: <?php echo $custom_color_4; ?>;
background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1 1" preserveAspectRatio="none"><linearGradient id="grad-ucgg-generated" gradientUnits="userSpaceOnUse" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="<?php echo $custom_color_4; ?>" stop-opacity="1"/><stop offset="100%" stop-color="<?php echo $custom_color_3; ?>" stop-opacity="1"/></linearGradient><rect x="0" y="0" width="1" height="1" fill="url(#grad-ucgg-generated)" /></svg>');

background: -moz-linear-gradient(top,  <?php echo $custom_color_4; ?> 0%, <?php echo $custom_color_3; ?> 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $custom_color_4; ?>), color-stop(100%,<?php echo $custom_color_3; ?>));
background: -webkit-linear-gradient(top,  <?php echo $custom_color_4; ?> 0%,<?php echo $custom_color_3; ?> 100%);
background: -o-linear-gradient(top,  <?php echo $custom_color_4; ?> 0%,<?php echo $custom_color_3; ?> 100%);
background: -ms-linear-gradient(top,  <?php echo $custom_color_4; ?> 0%,<?php echo $custom_color_3; ?> 100%);
background: linear-gradient(to bottom,  <?php echo $custom_color_4; ?> 0%,<?php echo $custom_color_3; ?> 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $custom_color_4; ?>', endColorstr='<?php echo $custom_color_3; ?>',GradientType=0 );
color: #fff;}

.color-custom .slider-pager a {background-image: url("<?php echo $images_path;?>paginator-gray.png");}
.color-custom .slider1 article h3 strong {color: <?php echo $custom_color_1; ?>;}

.color-custom header.h1 nav.mainmenu>ul>li:hover>a {color: #3f3f3f;}
.color-custom header.h1 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h1 nav.mainmenu>ul>li.current-menu-ancestor>a {color: <?php echo $custom_color_1; ?>;}
.color-custom header.h2 nav.mainmenu>ul>li:hover>a {border-bottom: 3px solid <?php echo $custom_color_1; ?>; color: #3f3f3f;}
.color-custom header.h2 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h2 nav.mainmenu>ul>li.current-menu-ancestor>a {border-bottom: 3px solid <?php echo $custom_color_1; ?>; color: #3f3f3f;}
.color-custom header.h3 nav.mainmenu>ul>li:hover>a {border-bottom: 3px solid <?php echo $custom_color_2; ?>; background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom header.h3 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h3 nav.mainmenu>ul>li.current-menu-ancestor>a {border-bottom: 3px solid <?php echo $custom_color_2; ?>; background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom header.h4 nav.mainmenu>ul>li>a:active {color: <?php echo $custom_color_1; ?>;}
.color-custom header.h4 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h4 nav.mainmenu>ul>li.current-menu-ancestor>a {color: #fff; background: <?php echo $custom_color_1;?> url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="7px" height="5px"><g><g><polygon fill="%23<?php echo $custom_color_1_without_hash;?>" points="0,0 0,5 7,0"/></g></g></svg>') 0% 32px no-repeat;}
.color-custom header.h4 nav.mainmenu>ul>li.current-menu-ancestor.parent,
.color-custom header.h4 nav.mainmenu>ul>li.current-menu-ancestor.parent:hover,
.color-custom header.h4 nav.mainmenu>ul>li.current-menu-item.parent,
.color-custom header.h4 nav.mainmenu>ul>li.current-menu-item.parent:hover {background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="7px" height="5px"><g><g><polygon fill="%23<?php echo $custom_color_1_without_hash;?>" points="0,0 0,5 7,0"/></g></g></svg>') 0% 32px no-repeat;}
.color-custom header.h5 {border-bottom: 2px solid <?php echo $custom_color_1; ?>;}
.color-custom header.h5 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h5 nav.mainmenu>ul>li.current-menu-ancestor>a,
.color-custom header.h5 nav.mainmenu>ul>li:hover>a {border-bottom: 1px solid <?php echo $custom_color_1; ?>; background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom header.h6 {border-bottom: 2px solid <?php echo $custom_color_1; ?>;}
.color-custom header.h6 nav.mainmenu>ul>li.current-menu-item>a, 
.color-custom header.h6 nav.mainmenu>ul>li.current-menu-ancestor>a,
.color-custom header.h6 nav.mainmenu>ul>li:hover>a {background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom header.h7 nav.mainmenu>ul>li:hover>a,
.color-custom header.h7 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h7 nav.mainmenu>ul>li.current-menu-ancestor>a {background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom header.h7 nav.mainmenu>ul>li.parent:hover,
.color-custom header.h7 nav.mainmenu>ul>li.current-menu-item.parent:hover,
.color-custom header.h7 nav.mainmenu>ul>li.current-menu-ancestor.parent:hover {background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="9px" height="5px" viewBox="0 0 9 5"><g><g><polygon fill="%23<?php echo $custom_color_1_without_hash;?>" points="0,0 4.5,5 9,0"/></g></g></svg>');}
.color-custom header.h8 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h8 nav.mainmenu>ul>li.current-menu-ancestor>a {background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom header.h8 nav ul ul li a:hover {color: #3f3f3f;}
.color-custom header.h9 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h9 nav.mainmenu>ul>li.current-menu-ancestor>a {background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom header.h9 nav ul ul li a:hover {color: #3f3f3f;}
.color-custom header.h10 nav.mainmenu>ul>li:hover>a {border-bottom: 3px solid <?php echo $custom_color_1; ?>;}
.color-custom header.h10 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h10 nav.mainmenu>ul>li.current-menu-ancestor>a {border-bottom: 3px solid <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom header.h10 nav ul ul li a:hover {color: #3f3f3f;}
.color-custom header.h11 nav.mainmenu>ul>li>a:active {color: <?php echo $custom_color_1; ?>;}
.color-custom header.h11 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h11 nav.mainmenu>ul>li.current-menu-ancestor>a {background: <?php echo $custom_color_1; ?>; color: #fff;}
.color-custom header.h12 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h12 nav.mainmenu>ul>li.current-menu-ancestor>a {border-bottom: 3px solid <?php echo $custom_color_1; ?>;}
.color-custom header.h13 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h13 nav.mainmenu>ul>li.current-menu-ancestor>a {background: <?php echo $custom_color_1; ?>;}
.color-custom header.h13 nav.mainmenu>ul>li.current-menu-ancestor.parent:hover,
.color-custom header.h13 nav.mainmenu>ul>li.current-menu-item.parent:hover {background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="9px" height="5px"><g><g><polygon fill="%23<?php echo $custom_color_1_without_hash;?>" points="0,0 4.5,5 9,0"/></g></g></svg>');}}
.color-custom header.h14 nav.mainmenu>ul>li.current-menu-item>a,
.color-custom header.h14 nav.mainmenu>ul>li.current-menu-ancestor>a {background-color: <?php echo $custom_color_1; ?>; background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="9px" height="5px"><g><g><polygon fill="%23<?php echo $custom_color_1_without_hash;?>" points="0,0 4.5,5 9,0"/></g></g></svg>');}
.color-custom header.h14 nav.mainmenu>ul>li.current-menu-item>a, 
.color-custom header.h14 nav.mainmenu>ul>li.current-menu-ancestor>a {background: <?php echo $custom_color_1; ?>;}
.color-custom header.h14 nav.mainmenu>ul>li.current-menu-ancestor.parent,
.color-custom header.h14 nav.mainmenu>ul>li.current-menu-ancestor.parent:hover,
.color-custom header.h14 nav.mainmenu>ul>li.current-menu-item.parent,
.color-custom header.h14 nav.mainmenu>ul>li.current-menu-item.parent:hover {background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="9px" height="5px"><g><g><polygon fill="%23<?php echo $custom_color_1_without_hash;?>" points="0,0 4.5,5 9,0"/></g></g></svg>');}
header.h15 nav.mainmenu>ul>li>a:active {color: <?php echo $custom_color_1; ?>;}
header.h15 nav.mainmenu>ul>li.current-menu-item>a,
header.h15 nav.mainmenu>ul>li.current-menu-ancestor>a {background: <?php echo $custom_color_1; ?>;}
header.h15 nav.mainmenu>ul>li.current-menu-item>a:before,
header.h15 nav.mainmenu>ul>li.current-menu-ancestor>a:before {border: 3px solid <?php echo $custom_color_1; ?>; border-width: 3px 4px; border-bottom-color: transparent; border-right-color: transparent; content: " ";}
.color-custom .landing-form button {border-color: <?php echo $custom_color_5; ?>;}
.color-custom .columns h2:first-child span, .color-custom .columns .more:first-child + h2 span, .color-custom section h2:first-child span {border-color: <?php echo $custom_color_1; ?>;}
.color-custom .col3 h3 span, 
.color-custom .home .col3 h3 span,
.color-custom .divider.d2 {border-color: <?php echo $custom_color_1; ?>;}
.color-custom a.go-top {background-color: <?php echo $custom_color_1; ?>;}
.color-custom h2.t01 span {border-color: <?php echo $custom_color_1; ?>;}
.color-custom .content > aside h3.t01 span {border-color: <?php echo $custom_color_1; ?>;}
.color-custom .content > aside h3.t03 {border-color: <?php echo $custom_color_1; ?>;}
.color-custom h2.t03 {border-color: <?php echo $custom_color_1; ?>;}
.color-custom footer h3.t03 {border-color: <?php echo $custom_color_1; ?>;}
.color-custom ul.event-list p.date span:first-child {background-color: <?php echo $custom_color_1; ?>;}
.color-custom .cat-archive > section > h3:first-child {background-color: <?php echo $custom_color_1; ?>;}
.color-custom .cat-archive > section > h3:before {border-right-color: #7c5c36; border-top-color: #7c5c36;}
.color-custom .slider7 .controls ul .active a:before {background-color: <?php echo $custom_color_1; ?>;}
.color-custom .content-slider.related article div div, .color-custom .hp-recent-work article div div, .color-custom .portfolio article div div 
{background: rgba(<?php echo $custom_color_1_rgb[0] . ', ' . $custom_color_1_rgb[1] . ', ' . $custom_color_1_rgb[2];?>, 0.8);}
.color-custom .slider8 .slider-pager a {background-image: url("<?php echo $images_path;?>paginator.png");}
.color-custom .slider12 .slider-pager a {background-image: url("<?php echo $images_path;?>paginator-slider12.png");}
.color-custom .latest h3 a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .col4 h3 a:hover, .color-custom .col3 h3 a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .col2 h2 a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .intro h1 strong {color: <?php echo $custom_color_1; ?>;}
.color-custom .slider5 h2 strong {color: <?php echo $custom_color_1; ?>;}
.color-custom .cat-archive ul li a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .slider9 .slider-titles a:hover {color: #fff;}
.color-custom .product-list-full ul li h3 a:hover {color: <?php echo $custom_color_1; ?>;}
.color-custom .pricing-plan:hover p.price strong, .color-custom .pricing-plan.selected p.price strong {color: <?php echo $custom_color_1; ?>;}
.color-custom .pricing-plan:hover h2, .color-custom .pricing-plan.selected h2 {color: <?php echo $custom_color_1; ?>;}
.color-custom .pricing-plan.selected {border-top: 2px solid <?php echo $custom_color_1; ?>;}
.color-custom .sidebar .widget > div > ul.menu li.current-menu-item>a, 
.color-custom .sidebar .widget > div > ul.menu li.current_page_item>a,
.color-custom .sidebar .widget.menu > ul li.current-menu-item > a {background-color: <?php echo $custom_color_1; ?>;}
.color-custom .404 button {background: #fff url("<?php echo $images_path;?>search-large.png") no-repeat scroll 50% 50% #FFFFFF;}
.color-custom .post-meta a.comment-link {background-image: url('data:image/svg+xml;utf8, <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="11px"><g><g><polygon fill="%23<?php echo $custom_color_1_without_hash;?>" points="0,0 0,8 2,8 2,11 3,11 3,10 4,10 4,9 5,9 5,8 10,8 10,0"/></g></g></svg>');}
.color-custom a.btn:hover {color:#fff;}
.color-custom a.btn.light-gray:hover {color:#555;}
.color-custom .e404 button, .color-custom .e404 button:hover, .color-custom .searchform button, .color-custom .searchform button:hover {background: url("<?php echo $images_path;?>search-large.png") no-repeat scroll 50% 50% #FFFFFF;}
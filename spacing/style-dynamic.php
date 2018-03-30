<?php
//
// Spacing Theme Dynamic Stylesheet
//

header("Content-type: text/css;");

$current_url = dirname(__FILE__);
$wp_content_pos = strpos($current_url, 'wp-content');
$wp_content = substr($current_url, 0, $wp_content_pos);

require_once($wp_content . 'wp-load.php');
	
$prefix = "st_";

//
// Font Sizes
//
?>
body 									{ font-size:<?php echo $of_option[$prefix.'fontsize_body']['size'] ?>; color:<?php echo $of_option[$prefix.'color_body'] ?>; }
#navigation ul li 						{ font-size:<?php echo $of_option[$prefix.'fontsize_navigation']['size'] ?>; }
#tagline h1 							{ font-size:<?php echo $of_option[$prefix.'fontsize_hometagline']['size'] ?>; }
#page-title h1 							{ font-size:<?php echo $of_option[$prefix.'fontsize_pagetitle']['size'] ?>; }
#page-title span 						{ font-size:<?php echo $of_option[$prefix.'fontsize_pagetagline']['size'] ?>; }
h1 										{ font-size:<?php echo $of_option[$prefix.'fontsize_h1']['size'] ?>; }
h2 										{ font-size:<?php echo $of_option[$prefix.'fontsize_h2']['size'] ?>; }
h3 										{ font-size:<?php echo $of_option[$prefix.'fontsize_h3']['size'] ?>; }
h4 										{ font-size:<?php echo $of_option[$prefix.'fontsize_h4']['size'] ?>; }
h5 										{ font-size:<?php echo $of_option[$prefix.'fontsize_h5']['size'] ?>; }
h6										{ font-size:<?php echo $of_option[$prefix.'fontsize_h6']['size'] ?>; }

<?php
//
// Font Family
//
?>

#navigation,h1,h2,h3,h4,#tagline h1 span{ 
	<?php	
	echo 'font-family:'.str_replace('+',' ',$of_option[$prefix.'font_heading']).',Arial;';
	?>	
}

#tagline h1,#page-title h1{ 
	<?php	
	echo 'font-family:'.str_replace('+',' ',$of_option[$prefix.'font_page_title']).',Arial;';
	?>	
}

body{ 
	<?php	
	echo 'font-family:'.str_replace('+',' ',$of_option[$prefix.'font_body']).',Arial;';
	?>	
}

<?php
//
// Colors
//
?>

a,#navigation li.current-menu-item > a,
#navigation li.current_page_item > a,
#navigation li.current-menu-parent > a,
#navigation li.current_page_parent > a,
#navigation ul li:hover > a,
ul.sorting-menu a.selected,
a.rp-holder:hover .rp-title span,
.sidebar-widget ul li a:hover,
.post-meta-box a:hover,
.classic-meta-section span a:hover,
.testimonial-quote,
.divider.title a:hover,
.breadcrumb li a:hover,
.tweet .twitter-content a				{ color:<?php echo $of_option[$prefix.'color_main'] ?>;  }
.homepage-post-title a:hover,
.portfolio-summary a:hover,	
.post-title a:hover,
.portfolio-nav a:hover					{ color:<?php echo $of_option[$prefix.'color_hover_title'] ?>;  }
a:hover,
.tweet .twitter-content a:hover			{ color:<?php echo $of_option[$prefix.'color_hover_links'] ?>; }
.copyright								{ color:<?php echo $of_option[$prefix.'color_copyright'] ?>; }
.pagination span,
.pagination a:hover,
#navigation ul li#magic-line,
span.overlay-link span,
span.overlay-link-alt span,
.post-cn-box:hover						{ background-color:<?php echo $of_option[$prefix.'color_main'] ?>;  }
#footer a:hover,
#footer .tweet .twitter-content a:hover,	
#footer .sidebar-widget ul li a:hover,
#subfooter a:hover						{ color:<?php echo $of_option[$prefix.'color_hover_flinks'] ?>; }

h1,h2,h3,h4,h5,h6,
h1.post-title a,
.portfolio-summary h4 a,
.post-meta-box span,
.pagination a,
.classic-meta-section span,
.classic-meta-section span a,
.homepage-post-title a,
.post-meta-box a,
.portfolio-nav a						{ color:<?php echo $of_option[$prefix.'color_headings'] ?>; }

#page-title h1 							{ color:<?php echo $of_option[$prefix.'color_pagetitle'] ?>; }

.post-entry-holder,
#comments .comments-holder,
#navigation ul li ul li,
.post-content-holder,
.classic-content-holder,
.classic-post-holder,
.avatar-holder img,
.tabdiv,
.toggle-container h6,
blockquote,
.pullquote,
.line,.top,
.post-date-box, .post-cn-box,
.testimonial-content,
.pricing-price h1						{ border-color:<?php echo $of_option[$prefix.'color_borders'] ?>; }

.twitter-content						{ background-color:<?php echo $of_option[$prefix.'color_borders'] ?>; }

<?php
//
// Background Colors
//
?>

#header,#navigation ul li ul				{ background-color:<?php echo $of_option[$prefix.'background_header'] ?>; }
#page-title								{ background-color:<?php echo $of_option[$prefix.'background_pagetitle'] ?>; }
.main-container 						{ background-color:<?php echo $of_option[$prefix.'background_content'] ?>; }
#tagline 								{ background-color:<?php echo $of_option[$prefix.'background_hometagline'] ?>; }
#footer 									{ background-color:<?php echo $of_option[$prefix.'background_footer'] ?>; }
<?php if($of_option[$prefix.'background_copyright']){ ?>
#subfooter 								{ background-color:<?php echo $of_option[$prefix.'background_copyright'] ?>; }	
<?php
}
if($of_option[$prefix.'background_wrapper']){ ?>
#wrapper 								{ background-color:<?php echo $of_option[$prefix.'background_wrapper'] ?>; }	
<?php
}
//
// Header
//
?>
#navigation ul li a 					{ padding-top:<?php echo $of_option[$prefix.'header_navspace'] ?>px; }
#navigation ul li ul 					{ top:<?php echo $of_option[$prefix.'header_navspace']+30 ?>px; }

<?php if($of_option[$prefix.'header_style'] == "2"){?>
#logo 									{ float:none; padding-bottom:0; }
#logo img 								{ display:block; margin-left:auto; margin-right:auto; padding-right:20px; }
#navigation 							{ float:none; width:100%; text-align:center; }
#navigation ul 							{ margin-left:-30px; }
#navigation ul li 						{ float:none; display:inline-block; position:relative;}
#navigation ul li 						{ padding-bottom:<?php echo $of_option[$prefix.'header_navspace'] ?>px; }
#navigation ul li ul 					{ text-align:left; }
#navigation ul li ul li:first-child 	{ margin-left:15px; }

<?php } ?>
<?php
header("Content-type: text/css; charset: UTF-8");
$uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $uri[0] . 'wp-load.php' );

 $patterns_style = of_get_option('patterns');
 $imagepatterns =  get_stylesheet_directory_uri() . '/images/patterns/';
 $image_style = of_get_option('background_upload');
 $type = of_get_option('type_background');
 $fixed = of_get_option('background_position');

switch ($type ) {
		 case "pattern": 
		 echo 'body {
		       background: url("'.$imagepatterns.''.$patterns_style.'.png");
                       '.$fixed.'
                       }';

	         break;
		
		}
?>

<?php
$font = of_get_option('font_pred');



echo 'body,
h1, h2, h3, h4, h5, h6 {
font-family: "'. $font .'", sans-serif;
}';


?>


<?php

 $color = of_get_option('color');

echo 'a,
h2.blog-arc-heading a:hover,
h2.event-arc-title a:hover,
.title-home h3,
.sidebarnav h3,
.event-past h3,
.event-upcoming h3,
.footer-col h3,
.event-w-title a:hover, 
.list-nav ul li a:hover, 
.sidebar .widget_calendar table#wp-calendar>tbody>tr>td>a, 
.sidebar .widget_calendar tfoot>tr>td>a, tfoot>tr>td>a:link, tfoot>tr>td>a:visited, tfoot>tr>td>a:hover, tfoot>tr>td>a:active, .widget_calendar table#wp-calendar>tbody>tr>td>a, 
.blog-h-title a:hover, 
.footer-col a:hover,
.blog-home-title a:hover,
.widget-audio-title a:hover,
.button-link a,
ul.tabs li a,
.comment-meta a:active, .comment-meta a:hover,
.widget_calendar tfoot>tr>td#prev a:hover, 
.widget_calendar tfoot>tr>td#next a:hover,
#footer .blog-w ul li a:hover,
#footer .event-w-title a:hover,
#footer .widget-audio-title a:hover {
color:#'.$color.';
}

.blog-home-more a, 
.blog-arc-more a:hover, 
.event-tickets a:hover,
.event-tickets2 a:hover,  
.audiojsZ .loadedZ,
.audiojsW .progressW,
.pagination a:hover, 
.pagination .current, 
.event-home-title h2 a,
.event-home-more a,
.tagcloud a:hover, 
.audio-buy a:hover,
.reply a:hover,
.widget-audio-buy a:hover,
.button-send#submitmail:hover,
.highlight,
.button-link a,
ul.tabs li a,
a.pp_download,
p.form-submit input#submit:hover,
#footer .tagcloud a:hover,
#clubbmenu > ul > li:hover > a, 
#clubbmenu > ul > li.active > a, 
#clubbmenu > ul > li > a:active, 
#clubbmenu > ul ul li a:hover,
#search-button:hover {
background:#'.$color.';
}

#footer {
border-top:10px solid #'.$color.';
}
';

?>

<?php

$imagecolor =  get_stylesheet_directory_uri() . '/admin/theme_options/images/color-style/';

echo '
.slide-title {
background: url("'.$imagecolor.'trans'.$color.'.png");
}';

?>

<?php
echo of_get_option('custom_css');
?>
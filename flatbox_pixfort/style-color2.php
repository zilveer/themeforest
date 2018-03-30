<?php
header('Content-Type: text/css; charset: UTF-8');
if (!empty($_GET["color_link"])) :
	$color2 = rawurldecode($_GET["color_link"]); 
?>


input[type=submit], input[type=reset], input[type=button] {background: <?php echo $color2; ?>;}
#calendar_wrap{background: <?php echo $color2; ?>;}
.car_full, .car_fullport, .car_more,.introlink, .introlink, .pagination .current, .price-item.special .price-title, #calendar_wrap td , .searchform input[type="submit"]:hover ,.accordion .active .accordion-title:before, .accordion .accordion-title:hover:before,.highlight,.dropcap.color{
    background-color: <?php echo $color2; ?>;
}
#calendar_wrap th {background: <?php echo $color2; ?>;border:1px solid <?php echo $color2; ?>;}
#wp-calendar tr td {border:1px solid <?php echo $color2; ?>;}


.introlink:hover, .introlink:hover  {
    color: <?php echo $color2; ?>;
}
.simple .slides .info .flexlink:hover , .detailed .slides .info2 .flexlink:hover {
    border:2px solid <?php echo $color2; ?>;
}
.commentlist .bypostauthor { border-top: 3px solid <?php echo $color2; ?>; }
#menu a:hover, #menu li:hover a, #menu li.hover a, #menu li.current_page_item a {  border-top: 6px solid <?php echo $color2; ?>; }

.alert{  border-left: 3px solid <?php echo $color2; ?>; }
.tabs li.active a { border-top: 3px solid <?php echo $color2; ?>;}
.button, button, input[type=submit], input[type=reset], input[type=button] { background: <?php echo $color2; ?>;}


::-webkit-scrollbar-thumb {background: <?php echo $color2; ?>;}
::-moz-selection { background-color: <?php echo $color2; ?> }
::selection { background-color: <?php echo $color2; ?> }

.morestyle, #footer .widget_tag_cloud a:hover, .button, button, .widget_tag_cloud a:hover,.pagination .page-numbers:hover, div.sep-big {background: <?php echo $color2; ?>;}
.flatintro {background: <?php echo $color2; ?>;}
<?php endif; ?>
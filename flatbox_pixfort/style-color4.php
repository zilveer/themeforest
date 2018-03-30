<?php
header('Content-Type: text/css; charset: UTF-8');
if (!empty($_GET["color_base"])) :
	$color = rawurldecode($_GET["color_base"]); 
	 // $r = hexdec(substr($color,0,2));
  //   $g = hexdec(substr($color,2,2));
  //   $b = hexdec(substr($color,4,2)); 


      // if ( $colour[0] == '#' ) {
      //           $colour = substr( $colour, 1 );
      //   }
      //   if ( strlen( $colour ) == 6 ) {
      //           list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
      //   } elseif ( strlen( $colour ) == 3 ) {
      //           list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
      //   } else {
      //           return false;
      //   }
      //   $r = hexdec( $r );
      //   $g = hexdec( $g );
      //   $b = hexdec( $b ); 

	$color_2 = rawurldecode($smof_data['color_link']); ?>

<style type="text/css">
/*.button, button, input[type=submit], input[type=reset],input[type=button], .pagination .page-numbers, table caption, div.sep-big, .highlight, .flex-control-paging li a.flex-active, .panorama .info, .panorama .controls a, .accordion .active .accordion-title:before, .accordion .accordion-title:hover:before, .price-item.special .price-title, .dropcap.color, .filter a.active, #menu.mobile ul .current_page_item a { background-color: <?php echo $color; ?> }

::-moz-selection { background-color: <?php echo $color; ?> }
::selection { background-color: <?php echo $color; ?> }

.tabs li.active a, .alert, .alert.notice, .price-item.special, .price-item.special .price-title, .price-item.special .price-tag, .commentlist .bypostauthor { border-color: <?php echo $color; ?> }
*/

<!-- Main Color -->

/*.flatheader,.flatheader2,.flatslider,.flatvideo, .morestyle:hover, .pagination .page-numbers, #wp-calendar caption, #wp-calendar #today{background: <?php echo $color; ?>;}
.car_like2, .flex-direction-nav .flex-prev:hover , .flex-direction-nav .flex-next:hover, .price-item.special .price-tag{
    background-color: <?php echo $color; ?>;
}
.featlink{
    border:2px solid <?php echo $color; ?>;
    background-color: <?php echo $color; ?>;
}
.featlink:hover {
    color: <?php echo $color; ?>;
}
#menu a {  border-top: 6px solid <?php echo $color; ?>; }
#menu ul ul {  background: rgba(33,33,33, .95); }

<!-- End of Main Color -->
<!-- Seconde Color -->
.flatintro,.morestyle, #footer .widget_tag_cloud a:hover,.button, button, input[type=submit], input[type=reset], input[type=button] , .pagination .page-numbers:hover, div.sep-big , #calendar_wrap {background: <?php echo $color_2; ?>;}
.car_full, .car_fullport, .car_more,.introlink, .introlink, .pagination .current, .price-item.special .price-title, #calendar_wrap td {
    background-color: <?php echo $color_2; ?>;
}
#calendar_wrap th {background: <?php echo $color_2; ?>;border:1px solid <?php echo $color_2; ?>;}
#wp-calendar tr td {border:1px solid <?php echo $color_2; ?>;}


.introlink:hover, .introlink:hover  {
    color: <?php echo $color_2; ?>;
}
.simple .slides .info .flexlink:hover , .detailed .slides .info2 .flexlink:hover {
    border:2px solid <?php echo $color_2; ?>;
}
.commentlist .bypostauthor { border-top: 3px solid <?php echo $color_2; ?>; }
#menu a:hover, #menu li:hover a, #menu li.hover a, #menu li.current_page_item a {  border-top: 6px solid <?php echo $color_2; ?>; }

::-webkit-scrollbar-thumb {background: <?php echo $color_2; ?>;}


@media screen and (min-width: 768px) {
	#menu a:hover, #menu li:hover a, #menu li.hover a, #menu li.current_page_item a { border-top-color: <?php echo $color_2; ?> }
	#menu ul ul li.current_page_item a { background-color: <?php echo $color_2; ?> }
}*/
</style>
<?php endif; ?>
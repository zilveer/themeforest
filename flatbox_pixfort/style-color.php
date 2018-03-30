<?php
header('Content-Type: text/css; charset: UTF-8');
if (!empty($_GET["color_base"])) :
	$color = rawurldecode($_GET["color_base"]); 
?>
.button, button, input[type=submit], input[type=reset],input[type=button], .pagination .page-numbers, table caption, div.sep-big, .highlight, .flex-control-paging li a.flex-active, .panorama .info, .panorama .controls a, .accordion .active .accordion-title:before, .accordion .accordion-title:hover:before, .price-item.special .price-title, .dropcap.color, #menu.mobile ul .current_page_item a { background-color: <?php echo $color; ?> }


.alert,  .price-item.special, .price-item.special .price-title, .price-item.special .price-tag, .commentlist .bypostauthor { border-color: <?php echo $color; ?> }



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
 .filter a.active,.flatheader,.flatheader2,.flatslider,.flatvideo, .morestyle:hover, .pagination .page-numbers, #wp-calendar caption, #wp-calendar #today,.grid figcaption{background: <?php echo $color; ?>;}


@media screen and (min-width: 768px) {
	<!-- #menu a:hover, #menu li:hover a, #menu li.hover a, #menu li.current_page_item a { border-top-color: <?php echo $color; ?> }
	#menu ul ul li.current_page_item a { background-color: <?php echo $color; ?> } -->
}
<?php endif; ?>
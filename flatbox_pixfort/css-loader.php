<?php 
global $smof_data;

if(!empty($smof_data['color_base'])){ 
			
$color=$smof_data['color_base'];
			echo '<style>


 table caption, div.sep-big, .highlight, .flex-control-paging li a.flex-active, .panorama .info, .panorama .controls a, .accordion .active .accordion-title:before, .accordion .accordion-title:hover:before, .price-item.special .price-title, .dropcap.color, #menu.mobile ul .current_page_item a { background-color: '.$color.'; }
.pagination .page-numbers{background-color: '.$color.';box-shadow: '. alter_brightness($color,-50) .' 0px 3px 0px 0px;}

.searchform input[type="submit"]:hover,.button:hover, button:hover, input[type=submit]:hover, input[type=reset]:hover, input[type=button]:hover,.color2:hover,.new_intro_button:hover{ background:  '.$color.';box-shadow: '. alter_brightness($color,-50) .' 0px 3px 0px 0px;}

.alert,  .price-item.special, .price-item.special .price-title, .price-item.special .price-tag, .commentlist .bypostauthor { border-color: '.$color.' }

.newtogtitle{ color: '.$color.';}

#footer,.car_like2, .flex-direction-nav .flex-prev:hover , .flex-direction-nav .flex-next:hover, .price-item.special .price-tag{
    background-color: '.$color.';
}
.featlink{
    border:2px solid '.$color.';
    background-color: '.$color.';
}
.featlink:hover {
    color: '.$color.';
}
#menu a {  border-color: '.$color.'; }
#menu ul ul {  background: rgba(33,33,33, .95); }
 .filter a.active,.flatheader,.flatheader2,.flatslider,.flatvideo, .pagination .page-numbers, #wp-calendar caption, #wp-calendar #today,.grid figcaption{background: '.$color.';}


@media screen and (min-width: 768px) {
	
}



			';
				echo '</style>';  			
		}?>



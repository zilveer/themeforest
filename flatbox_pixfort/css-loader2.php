<?php 
global $smof_data;
if(!empty($smof_data['color_link'])){ 
			
$color2=$smof_data['color_link'];
			echo '<style>



input[type=submit], input[type=reset], input[type=button] {background:  '.$color2.';}
#calendar_wrap{background:  '.$color2.';}
.car_full, .car_fullport, .car_more,.introlink, .introlink,  .price-item.special .price-title, #calendar_wrap td ,.accordion .active .accordion-title:before, .accordion .accordion-title:hover:before,.highlight,.dropcap.color{
    background-color:  '.$color2.';
}
#calendar_wrap th {background:  '.$color2.';border:1px solid  '.$color2.';}
#wp-calendar tr td {border:1px solid  '.$color2.';}

.theicon_img:hover{box-shadow: '.$color2.' 0px 0px 0px 5px;}
.wtitle,.introlink:hover, .introlink:hover  {
    color:  '.$color2.';
}
.simple .slides .info .flexlink:hover , .detailed .slides .info2.flexlink:hover {
    border:2px solid  '.$color2.';
}
.commentlist .bypostauthor { border-top: 3px solid  '.$color2.'; }
#menu a:hover, #menu li:hover a, #menu li.hover a, #menu li.current_page_item a {  border-color:  '.$color2.'; }

.alert{  border-left: 3px solid  '.$color2.'; }
.tabs li.active a { border-top: 3px solid  '.$color2.';}
.searchform input[type="submit"] ,.button, button, input[type=submit], input[type=reset], input[type=button],.color2,.tile-button:hover ,.car_more,.car_full{ background-color:  '.$color2.';box-shadow: '. alter_brightness($color2,-50) .' 0px 3px 0px 0px;}

.pagination .current ,.pagination .page-numbers:hover{ background-color: '.$color2.'; color: #eee; box-shadow: '. alter_brightness($color2,-50) .' 0px 3px 0px 0px;}

::-webkit-scrollbar-thumb {background:  '.$color2.';}
::-moz-selection { background-color:  '.$color2.';}
::selection { background-color:  '.$color2.' ;}
input[type=text]:focus{border-color: '.$color2.' !important; }
#comments input[type="text"]:focus ,  input[type=password]:focus, input[type=email]:focus, textarea:focus, select:focus{
border: 3px solid  '.$color2.';}
input:focus:invalid, textarea:focus:invalid { border-color: #e55; }

#footer .widget_tag_cloud a:hover, .button, button, .widget_tag_cloud a:hover, div.sep-big {background:  '.$color2.';}
.morestyle{border-color: '.$color2.';color: '.$color2.' !important;}
.flatintro ,.black_button,.link_post{background:  '.$color2.';}

.slider_links .link2{background: '.$color2.'; border:2px solid '.$color2.' !important;
			';
				echo '</style>';  			
		}?>



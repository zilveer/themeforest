<?php
global $wp_query,$post;
$wp_query = jaw_template_get_data();
$is_custom = false;
if($wp_query->query["post_type"] == "custom") {
    $is_custom = true;
}
$size = jaw_template_get_var('size',4);
$info_opacity = (1 - (jaw_template_get_var("info_opacity") / 100));
$title_color = jaw_template_get_var("title_color");
$bigone = 1;
if($size >= 3){
	$bigone = 2;
}
$subitem=0;
$width = array(1);
$count = 0;
$bigOne = 2;
//col-lg sirka zakladni (mensi) dlazdice
$baseWidth = round(12/$size);
$rowSize = 0;
$end = false;
$cols=1;
//konfigurace - jak jdou velky a maly dlazdice za sebou
switch($size){
	case 1: $width = array(4);
        $cols = 1;
		break;
	case 12: $width = array(4,1,1,1,1,4); // zmena smeru (411 a pak 114)
        $cols = 3;
		break;
	case 13: $width = array(4,2,1,1,1,1,2,4);
        $cols = 4;
		break;
	case 14: $width = array(4,1,1,1,1,1,1,1,1,4);
        $cols = 4;
		break;
	case 141: $width = array(4,1,1,1,1,4);
        $cols = 6;
		break;
	case 2: $width = array(1,1);
        $cols = 2;
		break;
	case 21: $width = array(1,1,4,4,1,1);
        $cols = 3;
		break;
	case 3: $width = array(1,1,1);
        $cols = 3;
		break;
	case 31: $width = array(1,1,2,4,4,2,1,1);
        $cols = 4;
		break;
	case 4: $width = array(1,1,1,1);
        $cols = 4;
		break;
	case 41: $width = array(1,1,1,1,4,4,1,1,1,1);
        $cols = 4;
		break;
	default: 'This size is not supported';
}
jaw_template_set_var("cols",$cols);
jaw_template_set_var("subitem",$subitem);
jaw_template_set_var("width",$width);
jaw_template_set_var("count", $count);
jaw_template_set_var("end",$end);
jaw_template_set_var("rowSize",$rowSize);
?>
<div class="jw-grid">
<?php
if($is_custom) {
    echo do_shortcode(jaw_template_get_var("content"));
} else {
    if(!have_posts()){
        echo 'Too few posts, please chack your settings';
    }else{
        while(have_posts()){
            the_post();
            if(has_post_thumbnail()){
                jaw_template_set_var("img",get_post_thumbnail_id(get_the_ID()));
                jaw_template_set_var("link",get_the_permalink());
                jaw_template_set_var("title",get_the_title());
                jaw_template_set_var("description","");
                
                echo jaw_get_template_part("grid_item","sliders");
            }
        }
    }
}
if($end) {  ?>
        </div>
</div>
<?php
}
?>
</div>
<?php
wp_reset_query();
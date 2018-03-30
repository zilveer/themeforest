<?php
$img_id = jaw_template_get_var('img');
$link = jaw_template_get_var("link");
$title = jaw_template_get_var("title");
$desc = jaw_template_get_var("description");
$size = jaw_template_get_var('size',4);
$overlay_upper = jaw_template_get_var("overlay_upper");
$overlay_bottom = jaw_template_get_var("overlay_bottom");
$gradient = "background: -moz-linear-gradient(top,  ".$overlay_upper." 0%, ".$overlay_bottom." 100%);
background: -webkit-linear-gradient(top,  ".$overlay_upper." 0%,".$overlay_bottom." 100%);
background: linear-gradient(to bottom,  ".$overlay_upper." 0%,".$overlay_bottom." 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#a6000000',GradientType=0 );";
$title_color = jaw_template_get_var("title_color");
$cols = jaw_template_get_var("cols",1);
$count = jaw_template_get_var("count");
//col-lg sirka zakladni (mensi) dlazdice
if($size == "12" ||$size == "13" || $size == "14" || $size == "141" ||$size == "21" ||$size == "31") {
    $size = 6;
}
$baseWidth = round(12/$cols);
//konfigurace - jak jdou velky a maly dlazdice za sebou
$subitem = jaw_template_get_var("subitem");
$width = jaw_template_get_var("width");
$rowSize = jaw_template_get_var("rowSize");
$bigOne = $width[$count%sizeof($width)];
$thisSize = $baseWidth*round($width[$count%sizeof($width)]/2); // ze 4 (width) se stane 2 a z 1 se stane 0.5 -> round na 1
$class = array();
$class[] = 'size-'.$width[$count%sizeof($width)];
$class[] = 'size-col-'.$thisSize;
$end = jaw_template_get_var("end");

if($bigOne == 2 || $bigOne == 4 || ($bigOne == 1 && $subitem%2 == 0) || $size < 5 || !$end) {
    $rowSize = $rowSize+$thisSize;
    $subitem = 0;
    $end = true;
?>
<div class="jw-grid-one <?php echo implode(' ', $class); ?>">
    <div class="">
        <?php } ?>
        <div class="jw-grid-one-wrapper">
            <div class="jw-grid-one-inner">
                <div class="image">
                    <a href="<?php echo $link; ?>">
                    <?php
                    /*if(!empty($img_id)) {
                        echo '<img src="'.wp_get_attachment_image_src($img_id,"post-size-big")[0].'">';
                    }*/
                    // 23.3.2016 - fixed for older php versions
                    $imgsrc=wp_get_attachment_image_src($img_id,"post-size-big");
                    if(!empty($img_id) && $imgsrc) {
                        echo '<img src="'.$imgsrc[0].'">';
                    }
                    ?>
                    <div class="jaw-fadein" style="<?php echo $gradient; ?>"></div>
                    </a>
                </div> 
                <div class="jw-grid-one-content">
                    <div class="content-wrapper">
                        <h3>
                            <a href="<?php echo $link; ?>" style="<?php echo "color:".$title_color; ?>">
                                <?php echo jwUtils::crop_length($title, jaw_template_get_var('letter_excerpt_title', 60)); ?>
                            </a>
                        </h3>
                        <?php if(!empty($desc)) { ?>
                        <div class="gridline" style="<?php echo "border-color:".$title_color; ?>"></div>
                        <p class="desc" style="<?php echo "color:".$title_color; ?>"><?php echo $desc; ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        ?>
        </div>
<?php if($bigOne == 2 || $bigOne == 4 || ($bigOne == 1 && $subitem%2 == 1) || $size < 5) { ?>
    </div>
</div>
<?php
    $end = false; 
    if($rowSize >= 12){
        ?> 
        <div class="clear"></div>
        <?php	
        $rowSize = 0;
    }
}
$subitem++;
$count++;
if($bigOne == 2) {
    $subitem = 0;
}
jaw_template_set_var("count", $count);
jaw_template_set_var("subitem",$subitem);
jaw_template_set_var("end",$end);
jaw_template_set_var("rowSize",$rowSize);
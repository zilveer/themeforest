<?php
$path = pathinfo(__FILE__) ['dirname'];
include ($path . '/config.php');

$id = Mk_Static_Files::shortcode_id();
$txt_color = $txt_color ? (' style="color:'.$txt_color.'"') : '';
$font_size = $line_height * .6;


$app_styles = '#mk-skill-meter-'.$id.' .mk-progress-bar { height: '.$line_height.'px; }';
if($line_height > '18') {
    $app_styles.= '#mk-skill-meter-'.$id.' .progress-percent { line-height: '.$line_height.'px; font-size: '.$font_size.'px; }';
} else {
    $app_styles.= '#mk-skill-meter-'.$id.' .progress-percent { top: -22px; }';
}

Mk_Static_Files::addCSS($app_styles, $id);


?>

<div id="mk-skill-meter-<?php echo $id; ?>" class="mk-skill-meter <?php echo $el_class; ?>">
    <div class="mk-skill-meter-title"<?php echo $txt_color; ?>><?php echo $title; ?></div>
    <div class="mk-progress-bar" style="background-color:<?php echo $bar_color; ?>">
        <span class="progress-outer" data-width="<?php echo $percent; ?>" style="background-color:<?php echo $color; ?>;">
            <span class="progress-inner"></span>
        </span>
        <span class="progress-percent" style="color:<?php echo $percent_color; ?>"><?php echo $percent; ?>%</span>
    </div>
    <div class="clearboth"></div>
</div>
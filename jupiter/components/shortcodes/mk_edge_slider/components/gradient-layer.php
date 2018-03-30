<?php

$gradient_layer = $view_params['gradient_layer'];
$gr_start = $view_params['gr_start'];
$gr_end = $view_params['gr_end'];

if($gradient_layer == 'false') return false;

$id = Mk_Static_Files::shortcode_id();

$el = 'edge-gradient-'.$id;

echo '<div id="'.$el.'" class="edge-gradient-layer"></div>';

$vertical = $horizontal = $left_top = $left_bottom = $radial = '';

if($gradient_layer == 'vertical')
    $vertical = "
        background: ".$gr_start."; /* Old browsers */
        background: -moz-linear-gradient(top,  ".$gr_start." 0%, ".$gr_end." 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,".$gr_start."), color-stop(100%,".$gr_end.")); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  ".$gr_start." 0%,".$gr_end." 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  ".$gr_start." 0%,".$gr_end." 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  ".$gr_start." 0%,".$gr_end." 100%); /* IE10+ */
        background: linear-gradient(to bottom,  ".$gr_start." 0%,".$gr_end." 100%); /* W3C */
    ";

if($gradient_layer == 'horizontal')
    $horizontal = "
        background: ".$gr_start."; /* Old browsers */
        background: -moz-linear-gradient(left,  ".$gr_start." 0%, ".$gr_end." 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, right top, color-stop(0%,".$gr_start."), color-stop(100%,".$gr_end.")); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(left,  ".$gr_start." 0%,".$gr_end." 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(left,  ".$gr_start." 0%,".$gr_end." 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(left,  ".$gr_start." 0%,".$gr_end." 100%); /* IE10+ */
        background: linear-gradient(to right,  ".$gr_start." 0%,".$gr_end." 100%); /* W3C */
    ";

if($gradient_layer == 'left_top')
    $left_top = "
        background: ".$gr_start."; /* Old browsers */
        background: -moz-linear-gradient(-45deg,  ".$gr_start." 0%, ".$gr_end." 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,".$gr_start."), color-stop(100%,".$gr_end.")); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(-45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(-45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(-45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* IE10+ */
        background: linear-gradient(135deg,  ".$gr_start." 0%,".$gr_end." 100%); /* W3C */
    ";

if($gradient_layer == 'left_bottom')
    $left_bottom = "
        background: ".$gr_start."; /* Old browsers */
        background: -moz-linear-gradient(45deg,  ".$gr_start." 0%, ".$gr_end." 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,".$gr_start."), color-stop(100%,".$gr_end.")); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* IE10+ */
        background: linear-gradient(45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* W3C */
    ";

if($gradient_layer == 'radial')
    $radial = "
        background: ".$gr_start."; /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover,  ".$gr_start." 0%, ".$gr_end." 100%); /* FF3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,".$gr_start."), color-stop(100%,".$gr_end.")); /* Chrome,Safari4+ */
        background: -webkit-radial-gradient(center, ellipse cover,  ".$gr_start." 0%,".$gr_end." 100%); /* Chrome10+,Safari5.1+ */
        background: -o-radial-gradient(center, ellipse cover,  ".$gr_start." 0%,".$gr_end." 100%); /* Opera 12+ */
        background: -ms-radial-gradient(center, ellipse cover,  ".$gr_start." 0%,".$gr_end." 100%); /* IE10+ */
        background: radial-gradient(ellipse at center,  ".$gr_start." 0%,".$gr_end." 100%); /* W3C */
    ";


Mk_Static_Files::addCSS('#'.$el .'{'
    .$vertical
    .$horizontal
    .$left_top
    .$left_bottom
    .$radial
.'}', $id);
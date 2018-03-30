<?php

#Change this
$themename = "YellowProject";
$gt3_themeshort = "yellowproject_";

#ADD SUPPORT FOR CUSTOM FONTS (NOT GOOGLE)
$gt3_themeconfig['custom_fonts'] = true;
#JUST FILENAME WITHOUT EXT
$gt3_themeconfig['custom_fonts_array'] = array(
    array(
        "font_family" => "Arial",
        "font_file_name" => "default_font",
        "font_weight" => "normal",
        "font_style" => "normal",
        "svg_id" => "default_font",
    ),
);

?>
<?php

$verticalSplitSliderPage = new QodeAdminPage("11", "Vertical Split Slider", "fa fa-arrows-v");
$qodeFramework->qodeOptions->addAdminPage("verticalSplitSlider",$verticalSplitSliderPage);

// General Style

$panel10 = new QodePanel("General Style","general_style");
$verticalSplitSliderPage->addChild("panel10",$panel10);

    $vss_navigation_color = new QodeField("color","vss_navigation_color","","Navigation Color","Define color for navigation dots");
    $panel10->addChild("vss_navigation_color",$vss_navigation_color);

    $vss_navigation_size = new QodeField("text","vss_navigation_size","","Navigation Size (px)","Define size for navigation dots", array(), array("col_width" => 1));
    $panel10->addChild("vss_navigation_size",$vss_navigation_size);

    $vss_navigation_spacing_from_edge = new QodeField("text","vss_navigation_spacing_from_edge","","Navigation Position (px)","Define position of navigation from right/left edge of slider", array(), array("col_width" => 1));
    $panel10->addChild("vss_navigation_spacing_from_edge",$vss_navigation_spacing_from_edge);

    $vss_left_panel_size = new QodeField("text","vss_left_panel_size","","Left Slide Panel size (%)","Define size for left slide panel. Note that sum of left and right slide panel should be 100.", array(), array("col_width" => 1));
    $panel10->addChild("vss_left_panel_size",$vss_left_panel_size);

    $vss_right_panel_size = new QodeField("text","vss_right_panel_size","","Right Slide Panel size (%)","Define size for right slide panel. Note that sum of left and right slide panel should be 100.", array(), array("col_width" => 1));
    $panel10->addChild("vss_right_panel_size",$vss_right_panel_size);


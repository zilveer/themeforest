<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");


$of_options[] = array(
    "name" => "Description Text",
    "desc" => "Create your description for the Call To Action element.",
    "id" => "text",
    "std" => "",
    "type" => "tinymce_editor"
);

$of_options[] = array(
    'id' => 'button_type',
    'type' => 'toggle',
    'name' => 'Button Type',
    'desc' => 'Decide whether to use a button or an icon for the Call To Action feature.',
    'std' => 'button',
    "builder" => 'true',
    "options" => array("button" => "Button", "icon" => "Icon")
);

$of_options[] = array(
    'id' => 'cta_button_possition',
    'type' => 'toggle',
    'name' => 'Button Placement',
    'desc' => 'Select a placement of a button (icon).',
    'std' => 'right',
    "builder" => 'true',
    "options" => array("top" => "Top", "left" => "Left", "bottom" => "Bottom", "right" => "Right")
);

$of_options[] = array(
    "name" => "Button Label",
    "desc" => "Fill in the button label.",
    "id" => "title",
    "std" => "Button",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Icon",
    "desc" => 'Open this <a href="' . THEME_URI . '/help/icons/icons.html?amp;TB_iframe=true" class="thickbox" target="_blank">list of classes</a>, choose the icon you prefer and copy/paste or write down its class name to this field.',
    "id" => "icon",
    "std" => "icon-king",
    "type" => "icon"
);

$of_options[] = array(
    "name" => "Target Link",
    "desc" => "Insert a target URL for your button/icon.",
    "id" => "link",
    "std" => "http://",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'target',
    'type' => 'select',
    'name' => 'Link Target',
    'desc' => 'Specify where to open a target link.',
    'std' => '_self',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self")
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'fullwidth',
    'type' => 'toggle',
    'name' => 'Full Width',
    'desc' => 'Decide whether or not to set this element to full width.<br><br>Note: This element must not be resized otherwise some styling options below wouldn&acute;t work.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    "name" => "Fullwidth Background Color",
    "desc" => "Pick a color of background to be applied in full width mode (by default: #000000).",
    "id" => "full_back_color",
    "std" => "#000000",
    "type" => "color"
);

$of_options[] = array(
    "name" => "Background Color",
    "desc" => "Pick a color of the description&acute;s background around the button/icon (by default: #EFEFEF).",
    "id" => "color",
    "std" => "#EFEFEF",
    "type" => "color"
);


$of_options[] = array(
    'id' => 'border_type',
    'type' => 'toggle',
    'name' => 'Border Style',
    'desc' => 'Choose the element&acute;s border style.',
    'std' => 'none',
    "builder" => 'true',
    "options" => array("none" => "None", "solid" => "Solid", "dotted" => "Dotted", "dashed" => "Dashed")
);

$of_options[] = array(
    'id' => 'border_width',
    'type' => 'range',
    'name' => 'Border Width',
    'desc' => 'Set the element&acute;s border width in pixels.',
    'std' => '1',
    'min' => '0',
    'max' => '10',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    "name" => "Border Color",
    "desc" => "Pick a color of the element&acute;s border (by default: #EFEFEF).",
    "id" => "border_color",
    "std" => "#EFEFEF",
    "type" => "color"
);

$of_options[] = array(
    'id' => 'cta_button_size',
    'type' => 'toggle',
    'name' => 'Button Size',
    'desc' => 'Select a button size.',
    'std' => 'default',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("btn-xs" => "Extra small", "btn-sm" => "Small", "default" => "Default", "btn-lg" => "Large")
);

$of_options[] = array(
    'id' => 'cta_button_bg_color',
    'type' => 'color',
    'name' => 'Button Background Color',
    'desc' => 'Pick a background color for the button (by default: #EFEFEF).',
    'std' => '#EFEFEF',
    "builder" => 'true',
);

$of_options[] = array(
    'id' => 'cta_button_border_color',
    'type' => 'color',
    'name' => 'Button Border Color',
    'desc' => 'Pick a border color of the button (by default: #5E605F).',
    'std' => '#5E605F',
    "builder" => 'true',
);

$of_options[] = array(
    'id' => 'cta_button_font_color',
    'type' => 'color',
    'name' => 'Custom Button Font Color',
    'desc' => 'Pick a color of the button label text (by default: #5E605F).',
    'std' => '#5E605F',
    "builder" => 'true',
);

$of_options[] = array(
    'id' => 'class',
    'type' => 'text',
    'name' => 'Custom Class',
    'desc' => 'Insert your custom class for this element.',
    'std' => ''
);

$of_options[] = array(
    "type" => "sectionend");

/* ==== BAR ==== */
$of_options[] = array(
    "name" => "Bar",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'bar_type',
    'type' => 'toggle',
    'name' => 'Bar Type',
    'desc' => 'Select this element&acute;s header type.',
    'std' => 'big',
    "builder" => 'true',
    "options" => array("off"=>"Off", "space" => "Off without space",  "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");

 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['cta'] = $of_options; 
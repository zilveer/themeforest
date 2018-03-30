<?php

// This file contains new maps or map updates for the Visual Composer 

// Accordion




vc_map_update( 'vc_tta_accordion', array(
  "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Active tab", "krown"),
        "param_name" => "active_tab",
        "description" => __("Enter tab number to be active on load or enter false to collapse all tabs (0 is the first one).", "krown")
      ),
      array(
        "type" => 'dropdown',
        "heading" => __("Type", "krown"),
        "param_name" => "type",
           "value" => array("Accordion" => 'accordion', "Toggle" => 'toggle'),
           "description" => __("Inside accordions only one section can be visible at a time. With toggles the user can open all the sections at once.", "krown")
      ),
      array(
        "type" => 'dropdown',
        "heading" => __("Size", "krown"),
        "param_name" => "size",
           "value" => array("Large" => 'large', "Small" => 'small'),
           "description" => __("Choose the accordion's size.", "krown")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "krown"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
      )
  )

) );


// NEW - Icon Text Block

vc_map( array(
  "name" => __("Icon Text Block", "krown"),
  "base" => "vc_icon_text",
  "icon" => "icon-wpb-ui-textwic",
  "category" => __('Content', 'js_composer'),
  "description" => __('A text block with an icon', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "holder" => "h4",
      "heading" => __("Title", "krown"),
      "param_name" => "title",
      "value" => __("Title", "krown"),
      "description" => __("Text block title.", "krown")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Icon", "krown"),
      "param_name" => "icon",
      "value" => $icons_arr,
      "description" => __("Text block icon.", "krown")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Icon Size", "krown"),
      "param_name" => "size",
      "value" => array(__("Regular", "krown") => "fa-regular",__("Medium", "krown") => "fa-2x",__("Large", "krown") => "fa-3x",__("Larger", "krown") => "fa-4x",__("Extreme", "krown") => "fa-5x"),
      "description" => __("The icon's background style.", "krown")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Icon Position", "krown"),
      "param_name" => "style",
      "value" => array(__("Near the text", "krown") => "one",__("Above the text", "krown") => "two"),
      "description" => __("The icon's background style.", "krown")
    ),
    array(
      "type" => "colorpicker",
      "heading" => __("Icon Color", "krown"),
      "param_name" => "background",
      "value" => "#ffffff",
      "description" => __("The icon's color.", "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Icon URL (Link)", "krown"),
      "param_name" => "href",
      "description" => __("If you fill this in, the icon will transform into a clickable button. Otherwise it will remain simple.", "krown")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Icon URL (Target)", "krown"),
      "param_name" => "target",
      "value" => $target_arr,
      "dependency" => Array('element' => "href", 'not_empty' => true)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "krown"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
    )
  )
) );

// Button

vc_map_update( 'vc_button', array(
	"params" => array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Text on the button", "krown"),
	      "holder" => "button",
	      "class" => "wpb_button",
	      "param_name" => "title",
	      "value" => __("Text on the button", "krown"),
	      "description" => __("Text on the button.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("URL (Link)", "krown"),
	      "param_name" => "href",
	      "description" => __("Button link.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Target", "krown"),
	      "param_name" => "target",
	      "value" => $target_arr,
	      "dependency" => Array('element' => "href", 'not_empty' => true)
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Size", "krown"),
	      "param_name" => "size",
	      "value" => $size_arr,
	      "description" => __("Button size.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Style", "krown"),
	      "param_name" => "style",
	      "value" => array(__("Light", "krown") => "light", __("Dark", "krown") => "dark", __("Color", "krown") => "color"),
	      "description" => __("Button style.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Align", "krown"),
	      "param_name" => "align",
	      "value" => array(__("Align left", "krown") => "left", __("Align center", "krown") => "center"),
	      "description" => __("Button alignment.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)

) );

// Contact Form

wpb_map( array(
    "name"      => __("Contact Form", "krown"),
    "base"      => "vc_contact_form",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-contactf",
    "category"  => __('Content', 'krown'),
    "description"  => __('A simple contact form', 'krown'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("Name field label", "krown"),
            "param_name" => "label_name",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Email field label", "krown"),
            "param_name" => "label_email",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Subject field label", "krown"),
            "param_name" => "label_subject",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Message field label", "krown"),
            "param_name" => "label_message",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Send button label", "krown"),
            "param_name" => "label_send",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Recipent email", "krown"),
            "param_name" => "email",
            "value" => "",
            "description" => __("Write the email address where you want to receive all of the emails sent through this form.", "krown")
        ),
        array(
            "type" => "textarea",
            "heading" => __("Error message", "krown"),
            "param_name" => "error",
            "value" => "",
            "description" => __("This message will appear to the user whenever he tries to send the email with no info or with corrupted email addresses. Please <strong>don't write HTML</strong>. If you want line breaks use <strong>&#92;n</strong>", "krown")
        ),
        array(
            "type" => "textarea",
            "heading" => __("Success message", "krown"),
            "param_name" => "success",
            "value" => "",
            "description" => __("This message will appear to the user after the email has been sent. Please <strong>don't write HTML</strong>. If you want line breaks use <strong>&#92;n</strong>", "krown")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "krown"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.(you can use the 'lessMargin' class for example, to give a smaller bottom margin to this text block", "krown")
        )
    )
) );

// Flickr

vc_map_update( 'vc_flickr', array(
	"params" =>array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Flickr ID", "krown"),
	      "param_name" => "flickr_id",
	      'admin_label' => true,
	      "description" => sprintf(__('To find your flickID visit %s.', "krown"), '<a href="http://idgettr.com/" target="_blank">idGettr</a>')
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Number of photos", "krown"),
	      "param_name" => "count",
	      "value" => "",
	      "description" => __("Choose a number of items to display (between 1-20).", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Type", "krown"),
	      "param_name" => "type",
	      "value" => array(__("User", "krown") => "user", __("Group", "krown") => "group"),
	      "description" => __("Photo stream type.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Display", "krown"),
	      "param_name" => "display",
	      "value" => array(__("Latest", "krown") => "latest", __("Random", "krown") => "random"),
	      "description" => __("Photo order.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)
) );



// Message Box

vc_map_update( 'vc_message', array(
	"params" =>array(
	    array(
	      "type" => "dropdown",
	      "heading" => __("Message box type", "krown"),
	      "param_name" => "color",
	      "value" => array(__('Informational', "krown") => "alert-info", __('Warning', "krown") => "alert-block", __('Success', "krown") => "alert-success", __('Error', "krown") => "alert-error"),
	      "description" => __("Select message type.", "krown")
	    ),
	    array(
	      "type" => "textarea_html",
	      "holder" => "div",
	      "class" => "messagebox_text",
	      "heading" => __("Message text", "krown"),
	      "param_name" => "content",
	      "value" => __("<p>I am message box. Click edit button to change this text.</p>", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)
) );

// Pie


// Posts Grid

// Separator

vc_map_update( 'vc_separator', array(
	"description" => __('Divider', 'js_composer'),
	"show_settings_on_create" => true,
	//"controls"	=> 'popup_delete',
	"params" =>array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Top margin", "krown"),
	      "param_name" => "height_2",
	      "value" => "0",
	      "description" => __("Enter a numeric value for the top margin of this divider (in px).", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Bottom margin", "krown"),
	      "param_name" => "height",
	      "value" => "50",
	      "description" => __("Enter a numeric value for the bottom margin of this divider (in px).", "krown")
	    )
	)
) );

// Single Image

vc_map_update( 'vc_single_image', array(
	"description" => __('Simple image', 'js_composer'),
	"params" =>array(
	    array(
	      "type" => "attach_image",
	      "heading" => __("Image", "krown"),
	      "param_name" => "image",
	      "value" => "",
	      "description" => __("Select image from media library.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Image size", "krown"),
	      "param_name" => "img_size",
	      "description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'full' size.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Image alignment", "krown"),
	      "param_name" => "alignment",
	      "value" => array(__("Align left", "krown") => "", __("Align right", "krown") => "right", __("Align center", "krown") => "center"),
	      "description" => __("Select image alignment.", "krown")
	    ),
	    array(
	      "type" => 'checkbox',
	      "heading" => __("Link to large image?", "krown"),
	      "param_name" => "img_link_large",
	      "description" => __("If selected, image will be linked to the bigger image (only if the size isn't already 'full').", "krown"),
	      "value" => Array(__("Yes, please", "krown") => 'yes')
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Image link", "krown"),
	      "param_name" => "img_link_custom",
	      "description" => __("Enter url if you want this image to have link.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Link Target", "krown"),
	      "param_name" => "img_link_target",
	      "value" => $target_arr
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)
) );



// Tabs

$tab_id_1 = time() . '-1-' . rand( 0, 100 );
$tab_id_2 = time() . '-2-' . rand( 0, 100 );
vc_map_update( 'vc_tabs', array(
	"params" => array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	),
    "default_content" => '
    	[vc_tab title="'.__('Tab 1','js_composer').'" tab_id="'.$tab_id_1.'" icon="none"][/vc_tab]
  		[vc_tab title="'.__('Tab 2','js_composer').'" tab_id="'.$tab_id_2.'" icon="none"][/vc_tab]',
) );

vc_map_update( 'vc_tab', array(
	"params" => array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Title", "krown"),
	      "param_name" => "title",
	      "description" => __("Tab title - only works for tabs, not for tours.", "krown")
	    ),
	    array(
	      "type" => "tab_id",
	      "heading" => __("Tab ID", "krown"),
	      "param_name" => "tab_id"
	    ),
	    array(
	      "type" => "tab_id",
	      "heading" => __("Tab icon", "krown"),
	      "param_name" => "icon",
	      "value" => "none"
	    )
	)
) );



vc_map_update( 'vc_tta_tabs', array(
  "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "krown"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
      )
   )
) );

vc_map_update( 'vc_tta_section', array(
  "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Title", "krown"),
        "param_name" => "title",
        "description" => __("Tab title - ONLY FOR TABS & ACCORDIONS", "krown")
      ),
      array(
        "type" => "tab_id",
        "heading" => __("Tab ID", "krown"),
        "param_name" => "tab_id"
      )
  )
) );

// NEW - Team

vc_map( array(
  "name" => __("Team Member", "krown"),
  "base" => "vc_team",
  "icon" => "icon-wpb-ui-team",
  "category" => __('Content', 'js_composer'),
  "description" => __('Text block with image at top', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "holder" => "h4",
      "heading" => __("Title", "krown"),
      "param_name" => "title",
      "value" => __("Title", "krown"),
      "description" => __("Team member's title (name).", "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Subtitle", "krown"),
      "param_name" => "subtitle",
      "value" => __("Subtitle", "krown"),
      "description" => __("Team member's subtitle (position).", "krown")
    ),
    array(
      "type" => "attach_image",
      "heading" => __("Image", "krown"),
      "param_name" => "image",
      "description" => __("Team member's image (250px wide or double for retina).", "krown")
    ),
    array(
      "type" => "textarea_html",
      "heading" => __("Social Content", "krown"),
      "param_name" => "content",
      "value" => __('[vc_social_links facebook="#" twitter="#" behance="#" dribbble="#"]', "krown"),
      "description" => __("Team member's social links. Please use the social links shortcode (more info in the manual).", "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "krown"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
    )
  )
) );

// NEW - Testimonial
/*
vc_map( array(
  "name" => __("Testimonial", "krown"),
  "base" => "vc_testimonial",
  "icon" => "icon-wpb-ui-testimonial",
  "category" => __('Content', 'js_composer'),
  "description" => __('Simple testimonial block', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "holder" => "h4",
      "heading" => __("Title", "krown"),
      "param_name" => "client",
      "value" => __("Title", "krown"),
      "description" => __("Source name (eg. client).", "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Subtitle", "krown"),
      "param_name" => "position",
      "value" => __("Subtitle", "krown"),
      "description" => __("Source subtitle (eg. position or website).", "krown")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Style", "krown"),
      "param_name" => "nav_arrows",
      "value" => array(__("Style #1", "krown") => "one", __("Style #2", "krown") => "two"),
      "description" => __("Choose the style of the testimonial.", "krown")
    ),
    array(
      "type" => "textarea_html",
      "heading" => __("Content", "krown"),
      "param_name" => "content",
      "value" => __('<p>Write the contents of the testimonial here.', "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "krown"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
    )
  )
) );
*/
// Tour

vc_map_update( 'vc_tour', array(
    "name" => __("Content Slider", "krown"),
	"description" => __("Simple content slider", "krown"),
	"params" => array(
	    array(
	      "type" => "dropdown",
	      "heading" => __("Auto rotate slides", "krown"),
	      "param_name" => "interval",
	      "value" => array(__("Disable", "krown") => 0, 3, 5, 7, 10, 15),
	      "description" => __("Auto rotate slides each X seconds.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Navigation buttons", "krown"),
	      "param_name" => "nav_arrows",
	      "value" => array(__("Show", "krown") => "true", __("Hide", "krown") => "false"),
	      "description" => __("Show or hide the navigation buttons.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Navigation bullets", "krown"),
	      "param_name" => "nav_bullets",
	      "value" => array(__("Hide", "krown") => "none", __("Show above", "krown") => "top",  __("Show below", "krown") => "bottom"),
	      "description" => __("Show or hide the navigation bullets.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)
) );

// Tour

vc_map_update( 'vc_tour', array(
    "name" => __("Content Slider", "krown"),
	"description" => __("Simple content slider", "krown"),
	"params" => array(
	    array(
	      "type" => "dropdown",
	      "heading" => __("Auto rotate slides", "krown"),
	      "param_name" => "interval",
	      "value" => array(__("Disable", "krown") => 0, 3, 5, 7, 10, 15),
	      "description" => __("Auto rotate slides each X seconds.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Navigation buttons", "krown"),
	      "param_name" => "nav_arrows",
	      "value" => array(__("Show", "krown") => "true", __("Hide", "krown") => "false"),
	      "description" => __("Show or hide the navigation buttons.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)
) );



vc_map_update( 'vc_tta_tour', array(
    "name" => __("Content Slider", "krown"),
  "description" => __("Simple content slider", "krown"),
  "params" => array(
      array(
        "type" => "dropdown",
        "heading" => __("Auto rotate slides", "krown"),
        "param_name" => "interval",
        "value" => array(__("Disable", "krown") => 0, 3, 5, 7, 10, 15),
        "description" => __("Auto rotate slides each X seconds.", "krown")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Navigation buttons", "krown"),
        "param_name" => "nav_arrows",
        "value" => array(__("Show", "krown") => "true", __("Hide", "krown") => "false"),
        "description" => __("Show or hide the navigation buttons.", "krown")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Navigation bullets", "krown"),
        "param_name" => "nav_bullets",
        "value" => array(__("Hide", "krown") => "none", __("Show above", "krown") => "top",  __("Show below", "krown") => "bottom"),
        "description" => __("Show or hide the navigation bullets.", "krown")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "krown"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
      )
  )
) );


// Text Block

vc_map_update( 'vc_column_text', array(
  "params" => array(
      array(
        "type" => "textarea_html",
        "holder" => "div",
        "heading" => __("Text", "krown"),
        "param_name" => "content",
        "value" => __("<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>", "krown")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "krown"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
      )
  )

) );

vc_map_update( 'vc_column_inner', array(
  "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "krown"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
      )
  )

) );


vc_map_update( 'vc_row', array(
  "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "krown"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
      )
  )

) );

// Text Separator

vc_map_update( 'vc_text_separator', array(
	"name" => __('Section Titles', 'js_composer'),
	"params" => array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Title", "krown"),
	      "param_name" => "title",
	      "holder" => "div",
	      "value" => "",
	      "description" => __("Section title (H3).", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Subtitle", "krown"),
	      "param_name" => "subtitle",
	      "value" => "",
	      "description" => __("Section subtitle (H5).", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Style", "krown"),
	      "param_name" => "style",
	      "value" => array(__("Large", "krown") => "large", __("Small", "krown") => "small"),
	      "description" => __("Choose the style of the block.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Alignment", "krown"),
	      "param_name" => "align",
	      "value" => array(__("Left", "krown") => "left", __("Center", "krown") => "center", __("Right", "krown") => "right"),
	      "description" => __("Choose the alignment of the block.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Bottom margin", "krown"),
	      "param_name" => "margin",
	      "value" => "30",
	      "description" => __("Choose a bottom margin for the block.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)

) );

// NEW - Twitter

vc_map( array(
  "name" => __("Twitter Widget", "krown"),
  "base" => "vc_twitter",
  "icon" => 'icon-wpb-ui-twitter',
  "category" => __('Social', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Twitter username", "krown"),
      "param_name" => "twitter_name",
      "description" => __("Type in twitter profile name from which load tweets (without @).", "krown")
    ),
    array(
        "type" => "textfield",
        "heading" => __("Full Name", "krown"),
        "param_name" => "name",
        "value" => "Ruben Bristian",
        "description" => __("Enter your full name here, as in your twitter author name.", "krown")
    ),
    array(
        "type" => "attach_image",
        "heading" => __("Avatar", "krown"),
        "param_name" => "avatar",
        "value" => "",
        "description" => __("Choose an avatar for the widget.", "krown")
    ),
    array(
        "type" => "textfield",
        "heading" => __("Count", "krown"),
        "param_name" => "no",
        "value" => "3",
        "description" => __("Choose how many tweets you want to display.", "krown")
    ),
    array(
        "type" => "textfield",
        "heading" => __("'Reply' Text", "krown"),
        "param_name" => "text_reply",
        "value" => "Reply",
        "description" => __("This is the text for the reply button.", "krown")
    ),
    array(
        "type" => "textfield",
        "heading" => __("'Retweet' Text", "krown"),
        "param_name" => "text_retweet",
        "value" => "Retweet",
        "description" => __("This is the text for the retweet button.", "krown")
    ),
    array(
        "type" => "textfield",
        "heading" => __("'Favorite' Text", "krown"),
        "param_name" => "text_favorite",
        "value" => "Favorite",
        "description" => __("This is the text for the favorite button.", "krown")
    ),
    array(
        "type" => "dropdown",
        "heading" => __("Rotate", "krown"),
        "param_name" => "rotate",
        "value" => array("Rotate" => "enabled", "Static" => "disabled"),
        "description" => __("Choose if you want the tweets to rotate through js or to only display the latest tweet.", "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "krown"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
    )
  )
) );

?>
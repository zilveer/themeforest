<?php
// Custom for Composer
$target_arr = array(__("Same window", "homeShop") => "_self", __("New window", "homeShop") => "_blank");








//////////////////////////////vc_banner////////////////////////////////////////////////////////////////////////////////
function vc_banner_func( $atts, $content = null ) { // New function parameter $content is added!
    $type = $icon_fontawesome = '';
	
   extract( shortcode_atts( array(
    'title' => __("Title Banner", 'homeshop'),
    'custom_color' => '',
    'custom_color_hover' => '',
    'background_style' => '',
    'text_banner' => __("Text Banner", 'homeshop'),
    'text_btn' => '',
	'custom_link' => '',
	'custom_links_target' => '',
	'type' => 'fontawesome',
	'icon_fontawesome' => 'fa fa-adjust',
	'icon_style' => '',
    'css_animation' => ''
   ), $atts ) );
   
   // Enqueue needed icon font.
	vc_icon_element_fonts_enqueue( $type );
   
    $id = rand(1, 1000);
   
	$output  = '';
	$css_class =  '';
	$css_class .= $css_animation;
	
	$custom_class = '';
	$custom_color1 = '';
	
    if($background_style == 'custom') {
	   $custom_color1 = ' style=background:'.$custom_color.' ';
	} else {
		$custom_class = 'gray';
	}

	$output  .= '<a class="'. $css_class .'" href="'. $custom_link .'" target="'. $custom_links_target .'" >
					<div class="banner-item banner-item-'. $id .' '. $icon_style .' '. $custom_class .'" '. $custom_color1 .' >
						<h4>'. $title .'</h4>
						<p>'. $text_banner .'</p>';
						
					if($text_btn != '') {
					$output  .= '<span class="button">'. $text_btn .'</span>';
					}
					
	if($icon_style != '') {				
	$output  .= '<i class="icons '. esc_attr( ${"icon_" . $type} ) .'"></i>';
	}

	$output  .= '</div></a>';

					
					
	if($background_style == 'custom') {
	   $output  .= '<style type="text/css"> div.banner-item-'. $id .':hover{ background:'.$custom_color_hover.' !important; } div.banner-item-'. $id .':hover .button{ background:'.$custom_color.' !important; } div.banner-item-'. $id .' .button{ background:'.$custom_color_hover.' !important; }</style>';			
	}

		
   return $output;
}
add_shortcode('vc_banner', 'vc_banner_func');

vc_map( array(
   "name" => __("Home block Banner", 'homeshop'),
   "base" => "vc_banner",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'homeshop'),
	"description" => __('Home block of Banner', 'homeshop'),
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => __("Title Banner", 'homeshop'),
         "description" => __("Block title.", 'homeshop')
        ),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Background Style', 'homeshop' ),
			'param_name' => 'background_style',
			'value' => array(
				__( 'Default', 'homeshop' ) => '',
				__( 'Custom', 'homeshop' ) => 'custom',
			),
			'description' => __( 'Background style.', 'homeshop' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Custom Background Color', 'homeshop' ),
			'param_name' => 'custom_color',
			'description' => __( 'Select custom color.', 'homeshop' ),
			'dependency' => array(
				'element' => 'background_style',
				'value' => array( 'custom' ),
			),
		),

		array(
			'type' => 'colorpicker',
			'heading' => __( 'Custom Background Color Hover', 'homeshop' ),
			'param_name' => 'custom_color_hover',
			'description' => __( 'Select custom color.', 'homeshop' ),
			'dependency' => array(
				'element' => 'background_style',
				'value' => array( 'custom' ),
			),
		),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text Banner", 'homeshop'),
         "param_name" => "text_banner",
         "value" => __("Text Banner", 'homeshop'),
         "description" => __("Text Banner.", 'homeshop')
        ),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text Button", 'homeshop'),
         "param_name" => "text_btn",
         "value" => "",
         "description" => __("Text Button.", 'homeshop')
        ),
		array(
		  "type" => "dropdown",
		  "heading" => __("Style", 'homeshop'),
		  "param_name" => "icon_style",
		  "admin_label" => true,
		  "value" => array(__("Icon None", 'homeshop') => "", __("Icon Left", 'homeshop') => "icon-on-left", __("Icon Right", 'homeshop') => "icon-on-right"),
		  "description" => __("Select style type.", 'homeshop')
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'homeshop' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-adjust',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_style',
				'value' => array( 'icon-on-left', 'icon-on-right' ),
			),
			'description' => __( 'Select icon from library.', 'homeshop' ),
		),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("URL Link", 'homeshop'),
         "param_name" => "custom_link",
         "value" => "",
         "description" => __("URL Link.", 'homeshop')
        ),
		array(
            "type" => "dropdown",
            "heading" => __("Target Link", 'homeshop'),
            "param_name" => "custom_links_target",
            "description" => __('Select where to open  custom links.', 'homeshop'),
            'value' => $target_arr
        ),
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)

   )
) );






//////////////////////////////vs_contact_form1_func////////////////////////////////////////////////////////////////////////////////
function vs_contact_form1_func( $atts, $content = null ) { // New function parameter $content is added!
   extract(shortcode_atts(array(
		'title' => '',
		'contact_form' => '',
		'admin_email' => '',
		'css_animation' => ''
	), $atts));
	$fields = json_decode(str_replace('``', '"', $contact_form));

	$css_class =  '';
	$css_class .= $css_animation;
	
    $id = rand(1, 100);
	$output  = '';
	$output  .= '<div class="contact-form_custom '. $css_class .'">
                            <div class="carousel-heading no-margin">
                                <h4>'. $title .'</h4>
                            </div>
                            <div class="page-content contact-form">

	<form id="contact-form_'. $id .'" action="#" method="post" enctype="multipart/form-data" class="contact-form">
		<div class="success">Contact form submitted! <strong>We will be in touch soon.</strong></div>';
		
		if($admin_email != '') {
	$output  .= '<input type="hidden" name="form_mail_to" value="'.$admin_email.'"/>';
		}
	$output  .= '';
		foreach($fields as $line) {
		$req = $line->req ? __("(required)", "homeShop") : '';
		$req1 = $line->req ? __("(required)", "homeShop") : '';
	$output  .= '<label class="'. $line->type .'">'.$line->label.' '.$req1.'</label>';
					
					
					if($line->type == 'message') {
				$output  .= '<textarea name="'.$line->name.'" data-type="message" class="sense_input" '.$req.'></textarea>';
					} else {
				$output  .= '<input name="'.$line->name.'" type="'.$line->type.'" '.$req.' class="sense_input" />';
					}
					
	
		} 
	$output  .= '<input class="big submit" name="submit" type="submit" value="'. __("Send Message", 'homeshop') .'">
	</form></div></div>';

	
	
	$output  .= '<script type="text/javascript" >
			jQuery(document).ready(function($){
				var $this = $("#contact-form_'. $id .'");

				

				$this.validate({
					submitHandler: function(form) {
						var data = {},
							$submit = $(form).find(".submit").hide();

						$(form).find("[name]").each(function(){
							data[$(this).attr("name")] = $(this).val();
						});
						data["action"] = "send_contact_form";
						jQuery.ajax({
							"url": "'. admin_url("admin-ajax.php") .'",
							"type": "post",
							"dataType": "json",
							"data": data,
							"uccess": function(data) {
								if(data.status === "success"){
									$(form).find(".success").fadeIn();
								}
								$submit.show();
								form.reset();
							},
							"error": function(){
								$submit.show();
							}
						});

					}
				});

			});
		</script>';	

 
    return $output;
}
add_shortcode('vs_contact_form1', 'vs_contact_form1_func');


vc_map(array(
	"name" => __("Contact Form", 'homeshop'),
	"base" => "vs_contact_form1",
	"category" => __('Content', 'homeshop'),
	"params" => array(
	
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => '',
         "description" => __("Contact Form Title.", 'homeshop')
        ),
		
		
		array(
			"type" => "textfield",
			"heading" => __('Contact form e-mail', 'homeshop'),
			"param_name" => "admin_email",
			"value" => '',//get_option('admin_email'),
			"description" => __("You can specify custom e-mail for this form(WARNING: this e-mail will be visible in DOM)", 'homeshop')
		),
		array(
			"type" => "contact_form",
			"heading" => __("Form builder", 'homeshop'),
			"param_name" => "contact_form",
			"admin_label" => true,
			"description" => __("Contact form builder", 'homeshop')
		),
		
		
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)
	
	)
));





//////////////////////////////vc_contact_information////////////////////////////////////////////////////////////////////////////////
function vc_contact_information_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => __("CONTACT INFORMATION", 'homeshop'),
      'map_address' => '',
      'map_markers' => '',
      'image_markers' => '',
      'color_address' => '',
	  'color_mail' => '',
      'content_mail' => '',
	  'color_phones' => '',
      'content_phones' => '',
	  'color_working' => '',
      'content_working' => '',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	
	$img_id = preg_replace('/[^\d]/', '', $image_markers);
    $map_thumbnail = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => 'latest-post', 'class' => '' ));
	$map_thumbnail = $map_thumbnail['p_img_large'][0];  

	
	$id = rand(1, 100);
	
	$output  = '<div class="contact-info'.$id.' '. $css_class .'">
		<div class="carousel-heading no-margin">
				<h4>'. $title .'</h4>
		</div>
		<div class="page-content contact-info">
		    <div id="map-canvas" ></div>
		<div class="row">';

		

		
	
	if($content != '') {	
	$output  .= '<div class="col-lg-6 col-md-6 col-sm-12">
                                    	<div class="contact-item green">
                                            <i style="background: '. $color_address .';" class="icons icon-location-3"></i>';
        $output .= wpb_js_remove_wpautop( $content, true );
										
										
			$output  .= '</div>
                                    </div>';
									
	}
	

	
	$content_mail =  rawurldecode(base64_decode(strip_tags($content_mail)));
	if($content_mail != '') {									
	$output  .= '<div class="col-lg-6 col-md-6 col-sm-12">
                                    	<div class="contact-item green">
                                            <i style="background: '. $color_mail .';"  class="icons icon-mail"></i>
                                            '. $content_mail .'
										</div>
                                    </div>';								
	}								
	
	$content_phones =  rawurldecode(base64_decode(strip_tags($content_phones)));
	if($content_phones != '') {									
	$output  .= '<div class="col-lg-6 col-md-6 col-sm-12">
                                    	<div class="contact-item green">
                                            <i  style="background: '. $color_phones .';" class="icons icon-phone"></i>
                                             '. $content_phones .'
										</div>
                                    </div>';

	}

    $content_working =  rawurldecode(base64_decode(strip_tags($content_working)));
	if($content_working != '') {	
    $output  .= '<div class="col-lg-6 col-md-6 col-sm-12">
                                    	<div class="contact-item green">
                                            <i  style="background: '. $color_working .';" class="icons icon-clock"></i>
                                            '. $content_working .'
										</div>
                                    </div>';
	}								
									
		
	
	$output .=  '</div></div>
                    </div>';
 
 
	$output .=  '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script  type="text/javascript" >
		function initialize() {
		  var myLatlng = new google.maps.LatLng('. $map_address .');
		  var myLatlng2 = new google.maps.LatLng('. $map_markers .');
		  var image = "'. $map_thumbnail .'";
		  
		  
		  var mapOptions = {
			zoom: 14,
			center: myLatlng,
			mapTypeControl: false,
			scrollwheel: false,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
			navigationControl: false,
			navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  };
		  var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

		  var marker = new google.maps.Marker({
			  position: myLatlng2,
			  map: map,
			  icon: image
		  });
		}

		google.maps.event.addDomListener(window, "load", initialize);

    </script>
	<style type="text/css" >
			  body #map-canvas img {
				max-width: none !important;
			  }
			  #map-canvas {
				height: 300px;
				margin: 0px;
				padding: 0px
			  }
    </style>';
	
	
 
   return $output;
}
add_shortcode('vc_contact_information', 'vc_contact_information_func');

vc_map( array(
   "name" => __("Contact Information", 'homeshop'),
   "base" => "vc_contact_information",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'homeshop'),
	"description" => __('Contact Information block', 'homeshop'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => __("CONTACT INFORMATION", 'homeshop'),
         "description" => __("Block title.", 'homeshop')
        ),
		
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Google Map Address (51.451955,-0.055755)", 'homeshop'),
         "param_name" => "map_address",
         "value" => "",
         "description" => __("Google Map Address.", 'homeshop')
        ),
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Google Map Markers", 'homeshop'),
         "param_name" => "map_markers",
         "value" => "",
         "description" => ""
        ),
		
		array(
		  "type" => "attach_image",
		  "heading" => __("Marker image", 'homeshop'),
		  "param_name" => "image_markers",
		  "value" => "",
		  "description" => __("Select marker image from media library.", 'homeshop')
		),
	   
	   
	    array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => __("Address icon color", 'homeshop'),
         "param_name" => "color_address",
         "value" => '#1abc9c',
         "description" => __("Choose icon color", 'homeshop')
		  ),
		array(
			 "type" => "textarea_html",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Address", 'homeshop'),
			 "param_name" => "content",
			 "value" => __("8901 Marmora Road,<br>Glasgow, D04 89GR.", 'homeshop'),
			 "description" => __("Enter your content.", 'homeshop')
		  ),
	   
	    array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => __("Mail icon color", 'homeshop'),
         "param_name" => "color_mail",
         "value" => '#3498db', 
         "description" => __("Choose icon color", 'homeshop')
		  ),
		array(  
	        "type" => "textarea_raw_html",
			"holder" => "div",
			"heading" => __("Mail HTML", 'homeshop'),
			"param_name" => "content_mail",
			"value" => base64_encode("<p><a href='#'>info@companyname.com</a><br><a href='#'>sales@companyname.com</a></p>"),
			"description" => __("Enter your HTML content.", 'homeshop')
		),
	   
	    array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => __("Phones icon color", 'homeshop'),
         "param_name" => "color_phones",
         "value" => '#f5791f',
         "description" => __("Choose icon color", 'homeshop')
		  ),
		array(  
	        "type" => "textarea_raw_html",
			"holder" => "div",
			"heading" => __("Phones HTML", 'homeshop'),
			"param_name" => "content_phones",
			"value" => base64_encode("<p>800-559-65-80<br>800-603-60-35</p>"),
			"description" => __("Enter your HTML content.", 'homeshop')
		),  
		
	   
	    array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => __("Working hours icon color", 'homeshop'),
         "param_name" => "color_working",
         "value" => '#9b59b6',
         "description" => __("Choose icon color", 'homeshop')
		  ),
		array(  
	        "type" => "textarea_raw_html",
			"holder" => "div",
			"heading" => __("Working hours", 'homeshop'),
			"param_name" => "content_working",
			"value" => base64_encode("<p>Monday - Friday: 08.00-20.00<br>Saturday: 09.00-15.00<br>Sunday: closed</p>"),
			"description" => __("Enter your HTML content.", 'homeshop')
		),    
		
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		),

   )
) );








//////////////////////////////Ios Slider////////////////////////////////////////////////////////////////////////////////
function ios_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
 
 
	
	$args = array( 'post_type'=>'slideshow',
				   'orderby' => 'menu_order',
				   'order' => 'ASC',
				   'numberposts' => -1);
	$myposts = get_posts( $args );
	$output  = '<div class = "iosSlider">
						<div class = "slider  '. $css_class .'">';
	$count = 0;
	
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$count++;
			$title = get_the_title();		
			$content = get_the_content();		
				
	$output .=  '<div class = "item post-'. $post_id .' " id = "item'. $count .'">
								
								<div class = "image">'. get_the_post_thumbnail($post_id, 'post-full') .'
									
								</div>
								
								<div class = "text">
									
									<div class = "bg"></div>

									'. $content .'
									
								</div>
								
							</div>';
	
	
	
	endforeach; 	
	
	$output .=  '</div>
						<div class = "prevButton"></div>
						<div class = "nextButton"></div>
					</div>';
 
   return $output;
}
add_shortcode('ios', 'ios_func');

vc_map( array(
   "name" => __("Ios Slide", 'homeshop'),
   "base" => "ios",
    "wrapper_class" => "clearfix",
  "category" => __('Content', 'homeshop'),
  "description" => __('A block of ios slider', 'homeshop'),
   "params" => array(
      array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)
   )
) );





//////////////////////////////FlexSlider////////////////////////////////////////////////////////////////////////////////
function flexslider_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
 
 
	
	$args = array( 'post_type'=>'slideshow',
				   'orderby' => 'menu_order',
				   'order' => 'ASC',
				   'numberposts' => -1);
				   
	$myposts = get_posts( $args );
	$output  = '<div class="flexslider flexsliderBig  '. $css_class .'">
                        <ul class="slides">';
	$count = 0;
	
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$count++;
			$title = get_the_title();		
			$content = get_the_content();	
			
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

	$output .=  '<li id="slide'. $count .'" style="background: transparent url(' . $post_thumbnail_url . ') no-repeat;" >
								<div class = "text hidden-xs">
									
									<div class = "bg"></div>
									
									'. do_shortcode($content) .'
								</div>
                            </li>';
	
	
	endforeach; 	
	
	$output .=  '</ul>
                    </div>';
 
   return $output;
}
add_shortcode('vc_flexslider', 'flexslider_func');

vc_map( array(
   "name" => __("Flexslider Slide", 'homeshop'),
   "base" => "vc_flexslider",
    "wrapper_class" => "clearfix",
  "category" => __('Content', 'homeshop'),
  "description" => __('A block of flexslider', 'homeshop'),
   "params" => array(
      array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)
   )
) );







//////////////////////////////vc_category_product////////////////////////////////////////////////////////////////////////////////
function vc_featured_product_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => '',
      'my_product_cat' => '',
      'columns_count' => '',
      'num_items' => '',
      'slideshow_auto' => 'true',
      'slideshow_delay' => '9000',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	
	$term_slug = '';
	if($my_product_cat !='') {
	$term = get_term( $my_product_cat, 'product_cat' );
		if(!empty($term->slug)) {
	    $term_slug = $term->slug;
		}
	}
	
	$custom_class = '';
    $args = array(  
    'post_type' => 'product',  
	'product_cat' => $term_slug,
	'orderby' => 'menu_order',
    'order' => 'ASC',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );
	
	$id = rand(1, 100);
	
	if ($slideshow_auto == 'true') {
	$slideshow = $slideshow_delay;
	}else{
	$slideshow = 'false';
	}

	
	$output  = '<div class="products-row row  '. $css_class .'">
	        <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="carousel-heading" style="margin-bottom: 10px;" >
					<h4>'. $title .'</h4>';
					
					if( count($myposts) > 1 ) {
		$output .=  '<div class="carousel-arrows featured-product-arr">
						<i class="icons icon-left-dir"></i>
						<i class="icons icon-right-dir"></i>
					</div>';
					}
					
	$output .=  '</div>
				
			</div>
			<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
			<div class="owl-carousel owl-carousel'.$id.' " data-max-items="'. $columns_count .'">';

	$count = 0;
	$current_db_version = get_option( 'woocommerce_db_version', null );
	
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$product_id = $post_id;
			$count++;
			
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

			if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product = new WC_Product($post_id);
				} else {
					$current_product = get_product($post_id);
				}
				
			$product_price = $current_product->get_price_html();
			$product_name = get_the_title($post_id);
			$product_url = get_permalink($post_id);
			$num_rating = (int) $current_product->get_average_rating();
			
			
			$show_add_to_cart = true;
				if (class_exists('WC_CVO_Visibility_Options')) {
					global $wc_cvo;
					/**
					 * Check show or hide price
					 */
					 if (($wc_cvo->setting('wc_cvo_prices') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_prices') == 'disabled') {
						 $product_price = '';
					 }
					 
					 /**
					 * Check show or hide add to cart button
					 */
					 if (($wc_cvo->setting('wc_cvo_atc') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_atc') == 'disabled') {
						 $show_add_to_cart = false;
					 }
				}
				
			
	
	$output .=  '<div>
					<!-- Carousel Item -->
					<div class="product">
						
						<div class="product-image">
						<a href="'. esc_url($product_url) .'" >
							' . ( has_post_thumbnail($post_id) ? get_the_post_thumbnail( $post_id, 'th-shop' ) : woocommerce_placeholder_img( 'shop_thumbnail' ) ) . '
						</a>';	
						
					




						if ( $current_product->is_on_sale() ) : 

								$output .=  '<span class="onsale" style="margin-left: 0;" >'. __("Sale", 'homeshop') .'</span>'; 

						endif; 
						
						if ( !$current_product->is_in_stock() ) : 

								$output .=  '<span class="onsale labels_stock" style="margin-left: 0;" >'. __("Stock", 'homeshop') .'</span>'; 

						endif; 
			

						 if ( $current_product->is_featured() ) : 

							 $output .=  '<span class="onsale onfeatured">' . __( 'Hot', 'homeshop' ) . '</span>'; 

						 endif; 
			








					if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'hide') {		
						$output .=  '<a href="'. esc_url($product_url) .'" class="product-hover">
								<i class="icons icon-eye-1"></i> '. __("Quick View", 'homeshop') .'
							</a>';
						}	
							
						$output .=  '</div>
						
						<div class="product-info">
							<h5><a href="'. esc_url($product_url) .'">'. product_max_charlength_text($product_name, (int) get_option('sense_num_product_title')) .'</a></h5>';
							
							
							
							$output .=  categories_product1($product_id);
							
							
							$output .=  '<span class="price">'. $product_price .'</span>';
							
							if (get_option('woocommerce_enable_review_rating') != 'no') {
							$output .=  '<div class="rating readonly-rating" data-score="'. $num_rating .'"></div>';
							}
							
							
						$output .=  '</div>
				
				<div class="product-actions">';		
				
				
				
				
		$output .=  '<span class="add-to-cart">';
		$output .= apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class=" %s product_type_%s"><span class="action-wrapper"><i class="icons icon-basket-2"></i><span class="action-name">%s</span></span></a>',
		esc_url( $current_product->add_to_cart_url() ),
		esc_attr( $current_product->id ),
		esc_attr( $current_product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$current_product->is_purchasable() && $current_product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $current_product->product_type ),
		esc_html( $current_product->add_to_cart_text() )
	),
	$current_product );
		$output .=  '</span>';

		
		
		
		
		if( class_exists( 'YITH_WCWL_Shortcode' ) ) {				
		$output .=  do_shortcode('[yith_wcwl_add_to_wishlist]');		
		}
		
		
		if ( function_exists('woo_add_compare_button' ) && woo_add_compare_button($product_id) != '' ) { 

			$output .=  '<span class="add-to-compare">
								<span class="action-wrapper">
									<i class="icons icon-docs"></i>
									<span class="action-name">'. woo_add_compare_button($product_id) .'</span>
								</span>
							</span>';
			
		}
		
		$output .=  '</div>
					</div>
					<!-- /Carousel Item -->
				</div>';
	
	
	endforeach; 	
	
	$output .=  '</div></div>
                    </div>';
 
 
 
	
	
	$output .= '<script type="text/javascript">'."\n";
		$output .= ' jQuery(document).ready(function($){'."\n";
		
		
		$output .= 'var max_items = '. $columns_count.'; '."\n"; 
		$output .= 'var tablet_items = max_items;'."\n"; 
		$output .= 'if(max_items > 1){ tablet_items = max_items - 1; }'."\n"; 
		$output .= 'var mobile_items = 1;'."\n"; 
		
		$output .= 'var owl_carousel_'.$id.' = $(".owl-carousel'.$id.'");'."\n";
		$output .= 'owl_carousel_'.$id.'.owlCarousel({'."\n";
		$output .= '	autoPlay: '.$slideshow.','."\n";  
			if (is_rtl()) {
		$output .= '	direction:"rtl",'."\n"; 
			}	
		$output .= '	stopOnHover : true,'."\n";                 
		$output .= '	items:max_items,'."\n";                 
		$output .= '	pagination : false,'."\n";                 
		$output .= '	itemsDesktop : [1199,max_items],'."\n";                 
		$output .= '	itemsDesktopSmall : [1000,max_items],'."\n";                 
		$output .= '	itemsTablet: [920,tablet_items],'."\n";                 
		$output .= '	itemsMobile: [560,mobile_items],'."\n";                                 
		$output .= '	});'."\n";
		
		
		$output .= '	 });'."\n";
		$output .= '</script>'."\n";
 
 
 
	if( count($myposts) == 2  && $columns_count == '2' ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
    if( count($myposts) == 2  && $columns_count == '3' ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 2  && $columns_count == '4' ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 3 && $columns_count == '3' ) {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 3 && $columns_count == '4' ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 4 && $columns_count == '4') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
	if( count($myposts) <= 5 && $columns_count == '5') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
	if( count($myposts) <= 6 && $columns_count == '6') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
 
 
 
   return $output;
}
add_shortcode('vc_featured_prod', 'vc_featured_product_func');

vc_map( array(
   "name" => __("Home blocks Category Product", 'homeshop'),
   "base" => "vc_featured_prod",
    "wrapper_class" => "clearfix",
	"category" => __('Shop', 'homeshop'),
	"description" => __('Home blocks of Category Product', 'homeshop'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => '',
         "description" => __("Block title.",'homeshop')
        ),
		 array(
		  "type" => "dropdown",
		  "heading" => __("Columns count", 'homeshop'),
		  "param_name" => "columns_count",
		  "value" => array(6, 5, 4, 3, 2, 1),
		  "admin_label" => true,
		  "description" => __("Select columns count.", 'homeshop')
		),
		array(
            "type" => "my_category",
            "heading" => __("Select category", 'homeshop'),
            "param_name" => "my_product_cat",
            "description" => __("Select category.", 'homeshop')
        ),
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'homeshop'),
         "param_name" => "num_items",
         "value" => "4",
         "description" => __("Number of items in a carousel.",'homeshop')
        ),
   
		array(
		  "type" => "dropdown",
		  "heading" => __("Auto slideshow", 'homeshop'),
		  "param_name" => "slideshow_auto",
		  "value" => array(__("On", 'homeshop') => "true", __("Off", 'homeshop') => "false"),
		  "description" => ""
		),
	   
	    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Slideshow delay", 'homeshop'),
         "param_name" => "slideshow_delay",
         "value" => "9000",
         "description" => ""
        ),
	   
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)

   )
) );








//////////////////////////////vc_featured_product////////////////////////////////////////////////////////////////////////////////
function vc_featured_product_func1( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => '',
      'columns_count' => '',
      'num_items' => '',
      'slideshow_auto' => 'true',
      'slideshow_delay' => '9000',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	$custom_class = '';
    $args = array(  
    'post_type' => 'product',  
    'meta_key' => '_featured', 	
    'meta_value' => 'yes',  
	'orderby' => 'menu_order',
    'order' => 'ASC',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );
	
	$id = rand(1, 100);
	
	if ($slideshow_auto == 'true') {
	$slideshow = $slideshow_delay;
	}else{
	$slideshow = 'false';
	}

	
	$output  = '<div class="products-row row  '. $css_class .'">
	        <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="carousel-heading" style="margin-bottom: 10px;" >
					<h4>'. $title .'</h4>';
					
					if( count($myposts) > 1 ) {
		$output .=  '<div class="carousel-arrows featured-product-arr">
						<i class="icons icon-left-dir"></i>
						<i class="icons icon-right-dir"></i>
					</div>';
					}
					
	$output .=  '</div>
				
			</div>
			<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
			<div class="owl-carousel owl-carousel'.$id.' " data-max-items="'. $columns_count .'">';

	$count = 0;
	$current_db_version = get_option( 'woocommerce_db_version', null );
	
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$product_id = $post_id;
			$count++;
			
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

			if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product = new WC_Product($post_id);
				} else {
					$current_product = get_product($post_id);
				}
				
			$product_price = $current_product->get_price_html();
			$product_name = get_the_title($post_id);
			$product_url = get_permalink($post_id);
			$num_rating = (int) $current_product->get_average_rating();
			
			
			$show_add_to_cart = true;
				if (class_exists('WC_CVO_Visibility_Options')) {
					global $wc_cvo;
					/**
					 * Check show or hide price
					 */
					 if (($wc_cvo->setting('wc_cvo_prices') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_prices') == 'disabled') {
						 $product_price = '';
					 }
					 
					 /**
					 * Check show or hide add to cart button
					 */
					 if (($wc_cvo->setting('wc_cvo_atc') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_atc') == 'disabled') {
						 $show_add_to_cart = false;
					 }
				}
				
			
	
	$output .=  '<div>
					<!-- Carousel Item -->
					<div class="product">
						
						<div class="product-image">
						<a href="'. esc_url($product_url) .'" >
							' . ( has_post_thumbnail($post_id) ? get_the_post_thumbnail( $post_id, 'th-shop' ) : woocommerce_placeholder_img( 'shop_thumbnail' ) ) . '
						</a>';	
						
						
						
						
						
						if ( $current_product->is_on_sale() ) : 

								$output .=  '<span class="onsale" style="margin-left: 0;" >'. __("Sale",'homeshop') .'</span>'; 

						endif; 
						
						if ( !$current_product->is_in_stock() ) : 

								$output .=  '<span class="onsale labels_stock" style="margin-left: 0;" >'. __("Stock",'homeshop') .'</span>'; 

						endif; 
			
						
						if ( $current_product->is_featured() ) : 

							 $output .=  '<span class="onsale onfeatured">' . __( 'Hot', 'homeshop' ) . '</span>'; 

						 endif; 
						
						
						
						
						
						if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'hide') {		
						$output .=  '<a href="'. esc_url($product_url) .'" class="product-hover">
								<i class="icons icon-eye-1"></i> '. __("Quick View", 'homeshop') .'
							</a>';
						}	
							
						$output .=  '</div>
						
						<div class="product-info">
							<h5><a href="'. esc_url($product_url) .'">'. product_max_charlength_text($product_name, (int) get_option('sense_num_product_title')) .'</a></h5>';
							
							
							
							$output .=  categories_product1($product_id);
							
							
						$output .=  '<span class="price">'. $product_price .'</span>';
						
						   if (get_option('woocommerce_enable_review_rating') != 'no') {
							$output .=  '<div class="rating readonly-rating" data-score="'. $num_rating .'"></div>';
						   }
							
							
							
						$output .=  '</div>
						
						<div class="product-actions">';
						
						
			$output .=  '<span class="add-to-cart">';
		$output .= apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class=" %s product_type_%s"><span class="action-wrapper"><i class="icons icon-basket-2"></i><span class="action-name">%s</span></span></a>',
		esc_url( $current_product->add_to_cart_url() ),
		esc_attr( $current_product->id ),
		esc_attr( $current_product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$current_product->is_purchasable() && $current_product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $current_product->product_type ),
		esc_html( $current_product->add_to_cart_text() )
	),
	$current_product );
		$output .=  '</span>';


		
		if( class_exists( 'YITH_WCWL_Shortcode' ) ) {				
		$output .=  do_shortcode('[yith_wcwl_add_to_wishlist]');		
		}
		
		
		if ( function_exists('woo_add_compare_button' ) && woo_add_compare_button($product_id) != '' ) { 

			$output .=  '<span class="add-to-compare">
								<span class="action-wrapper">
									<i class="icons icon-docs"></i>
									<span class="action-name">'. woo_add_compare_button($product_id) .'</span>
								</span>
							</span>';
			
		}
		
		$output .=  '</div>
					</div>
					<!-- /Carousel Item -->
				</div>';
	
	
	endforeach; 	
	
	$output .=  '</div></div>
                    </div>';
 
 
 
	
	
	$output .= '<script type="text/javascript">'."\n";
		$output .= ' jQuery(document).ready(function($){'."\n";
		
		
		$output .= 'var max_items = '. $columns_count.'; '."\n"; 
		$output .= 'var tablet_items = max_items;'."\n"; 
		$output .= 'if(max_items > 1){ tablet_items = max_items - 1; }'."\n"; 
		$output .= 'var mobile_items = 1;'."\n"; 
		
		$output .= 'var owl_carousel_'.$id.' = $(".owl-carousel'.$id.'");'."\n";
		$output .= 'owl_carousel_'.$id.'.owlCarousel({'."\n";
		$output .= '	autoPlay: '.$slideshow.','."\n"; 
			if (is_rtl()) {
		$output .= '	direction:"rtl",'."\n"; 
			}			
		$output .= '	stopOnHover : true,'."\n";                 
		$output .= '	items:max_items,'."\n";                 
		$output .= '	pagination : false,'."\n";                 
		$output .= '	itemsDesktop : [1199,max_items],'."\n";                 
		$output .= '	itemsDesktopSmall : [1000,max_items],'."\n";                 
		$output .= '	itemsTablet: [920,tablet_items],'."\n";                 
		$output .= '	itemsMobile: [560,mobile_items],'."\n";                                 
		$output .= '	});'."\n";
		
		
		$output .= '	 });'."\n";
		$output .= '</script>'."\n";
 
 
 
	if( count($myposts) == 2  && $columns_count == '2' ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
    if( count($myposts) == 2  && $columns_count == '3' ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 2  && $columns_count == '4' ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 3 && $columns_count == '3' ) {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 3 && $columns_count == '4' ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 4 && $columns_count == '4') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
	if( count($myposts) <= 5 && $columns_count == '5') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
	if( count($myposts) <= 6 && $columns_count == '6') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .featured-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
 
 
 
   return $output;
}
add_shortcode('vc_featured_prod1', 'vc_featured_product_func1');

vc_map( array(
   "name" => __("Home blocks Featured Product", 'homeshop'),
   "base" => "vc_featured_prod1",
    "wrapper_class" => "clearfix",
	"category" => __('Shop', 'homeshop'),
	"description" => __('Home blocks of Featured Product', 'homeshop'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => '',
         "description" => __("Block title.",'homeshop')
        ),
		 array(
		  "type" => "dropdown",
		  "heading" => __("Columns count", 'homeshop'),
		  "param_name" => "columns_count",
		  "value" => array(6, 5, 4, 3, 2, 1),
		  "admin_label" => true,
		  "description" => __("Select columns count.", 'homeshop')
		),

   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'homeshop'),
         "param_name" => "num_items",
         "value" => "4",
         "description" => __("Number of items in a carousel.",'homeshop')
        ),
   
		array(
		  "type" => "dropdown",
		  "heading" => __("Auto slideshow", 'homeshop'),
		  "param_name" => "slideshow_auto",
		  "value" => array(__("On", 'homeshop') => "true", __("Off", 'homeshop') => "false"),
		  "description" => ""
		),
	   
	    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Slideshow delay", 'homeshop'),
         "param_name" => "slideshow_delay",
         "value" => "9000",
         "description" => ""
        ),
	   
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)

   )
) );








//////////////////////////////vc_new_collection////////////////////////////////////////////////////////////////////////////////
function vc_new_collection_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => '',
      'my_product_cat' => '',
      'columns_count' => '',
      'num_items' => '',
      'slideshow_auto' => 'true',
      'slideshow_delay' => '9000',
      'css_animation' => ''
   ), $atts ) );
 

    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	
	$term_slug = '';
	if($my_product_cat !='') {
	$term = get_term( $my_product_cat, 'product_cat' );
		if(!empty($term->slug)) {
		$term_slug = $term->slug;
		}
	}
	
	$custom_class = '';
    $args = array(  
    'post_type' => 'product',  
	'product_cat' => $term_slug, 	
	'orderby' => 'date',
    'order' => 'desc',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );
	
	$id = rand(1, 100);
	
	if ($slideshow_auto == 'true') {
	$slideshow = $slideshow_delay;
	}else{
	$slideshow = 'false';
	}

	
	$output  = '<div class="products-row row  '. $css_class .'">
	        <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="carousel-heading" style="margin-bottom: 10px;" >
					<h4>'. $title .'</h4>';
					
					if( count($myposts) > 1 ) {
			$output .=  '<div class="carousel-arrows new-product-arr">
						<i class="icons icon-left-dir"></i>
						<i class="icons icon-right-dir"></i>
					</div>';
					}
					
	$output .=  '</div>
				
			</div>
			<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
			<div class="owl-carousel owl-carousel'.$id.' " data-max-items="'. $columns_count .'">';

	$count = 0;
	$current_db_version = get_option( 'woocommerce_db_version', null );
	
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$product_id = $post_id;
			$count++;
			
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

			if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product = new WC_Product($post_id);
				} else {
					$current_product = get_product($post_id);
				}
				
			$product_price = $current_product->get_price_html();
			$product_name = get_the_title($post_id);
			$product_url = get_permalink($post_id);
			$num_rating = (int) $current_product->get_average_rating();
			$add_to_cart_button_class = 'add_to_cart_link_type';
			
			$show_add_to_cart = true;
				if (class_exists('WC_CVO_Visibility_Options')) {
					global $wc_cvo;
					/**
					 * Check show or hide price
					 */
					 if (($wc_cvo->setting('wc_cvo_prices') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_prices') == 'disabled') {
						 $product_price = '';
					 }
					 
					 /**
					 * Check show or hide add to cart button
					 */
					 if (($wc_cvo->setting('wc_cvo_atc') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_atc') == 'disabled') {
						 $show_add_to_cart = false;
					 }
				}
				
			
	
	
	$output .=  '<div  >
	
					<!-- Carousel Item -->
					<div class="product">
						
						<div class="product-image">
						<a href="'. esc_url($product_url) .'" >
						' . ( has_post_thumbnail($post_id) ? get_the_post_thumbnail( $post_id, 'th-shop' ) : woocommerce_placeholder_img( 'shop_thumbnail' ) ) . '
							
						</a>';
						
						
						
						
						
						if ( $current_product->is_on_sale() ) : 

								$output .=  '<span class="onsale" style="margin-left: 0;" >'. __("Sale",'homeshop') .'</span>'; 

						endif; 
						
						if ( !$current_product->is_in_stock() ) : 

								$output .=  '<span class="onsale labels_stock" style="margin-left: 0;" >'. __("Stock",'homeshop') .'</span>'; 

						endif; 
				
						
						if ( $current_product->is_featured() ) : 

							 $output .=  '<span class="onsale onfeatured">' . __( 'Hot', 'homeshop' ) . '</span>'; 

						 endif; 
						
						
						
						
						
						if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'hide') {
							$output .=  '<a href="'. esc_url($product_url) .'" class="product-hover">
								<i class="icons icon-eye-1"></i> '. __("Quick View", 'homeshop') .'
							</a>';
							}
							
						$output .=  '</div>
						
						<div class="product-info">
							<h3><a href="'. esc_url($product_url) .'">'. product_max_charlength_text($product_name, (int) get_option('sense_num_product_title')) .'</a></h3>';
							
							
							$output .=  categories_product1($product_id);
							
						$output .=  '<span class="price">'. $product_price .'</span>';
						
						if (get_option('woocommerce_enable_review_rating') != 'no') {
							$output .=  '<div class="rating readonly-rating" data-score="'. $num_rating .'"></div>';
						}	
							
							
						$output .=  '</div>
						
						<div class="product-actions">';
						
						
				$output .=  '<span class="add-to-cart">';
		$output .= apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class=" %s product_type_%s"><span class="action-wrapper"><i class="icons icon-basket-2"></i><span class="action-name">%s</span></span></a>',
		esc_url( $current_product->add_to_cart_url() ),
		esc_attr( $current_product->id ),
		esc_attr( $current_product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$current_product->is_purchasable() && $current_product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $current_product->product_type ),
		esc_html( $current_product->add_to_cart_text() )
	),
	$current_product );
		$output .=  '</span>';
		
						
		if( class_exists( 'YITH_WCWL_Shortcode' ) ) {				
		$output .=  do_shortcode('[yith_wcwl_add_to_wishlist]');		
		}
		
		
		if ( function_exists('woo_add_compare_button' ) && woo_add_compare_button($product_id) != '' ) { 

			$output .=  '<span class="add-to-compare">
								<span class="action-wrapper">
									<i class="icons icon-docs"></i>
									<span class="action-name">'. woo_add_compare_button($product_id) .'</span>
								</span>
							</span>';
			
		}
		
		$output .=  '</div>
					</div>
					<!-- /Carousel Item -->
					
				</div>';
	
	
	
	
	
	endforeach; 	
	
	$output .=  '</div></div>
                    </div>';
 
 
 
	
	
	$output .= '<script type="text/javascript">'."\n";
		$output .= ' jQuery(document).ready(function($){'."\n";
		
		
		$output .= 'var max_items = '. $columns_count.'; '."\n"; 
		$output .= 'var tablet_items = max_items;'."\n"; 
		$output .= 'if(max_items > 1){ tablet_items = max_items - 1; }'."\n"; 
		$output .= 'var mobile_items = 1;'."\n"; 
		
		$output .= 'var owl_carousel_'.$id.' = $(".owl-carousel'.$id.'");'."\n";
		$output .= 'owl_carousel_'.$id.'.owlCarousel({'."\n";
		$output .= '	autoPlay : '.$slideshow.','."\n"; 
			if (is_rtl()) {
		$output .= '	direction:"rtl",'."\n"; 
			}		
		$output .= '	stopOnHover : true,'."\n";                 
		$output .= '	items:max_items,'."\n";                 
		$output .= '	pagination : false,'."\n";                 
		$output .= '	itemsDesktop : [1199,max_items],'."\n";                 
		$output .= '	itemsDesktopSmall : [1000,max_items],'."\n";                 
		$output .= '	itemsTablet: [920,tablet_items],'."\n";                 
		$output .= '	itemsMobile: [560,mobile_items],'."\n";                                 
		$output .= '	});'."\n";
		
		
		$output .= '	 });'."\n";
		$output .= '</script>'."\n";
 
 
 
 
	if( count($myposts) == 2  && $columns_count == '2' ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
    if( count($myposts) == 2  && $columns_count == '3' ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 2  && $columns_count == '4' ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 3 && $columns_count == '3' ) {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 3 && $columns_count == '4' ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 4 && $columns_count == '4') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
 
 
	if( count($myposts) <= 5 && $columns_count == '5') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
 
	if( count($myposts) <= 6 && $columns_count == '6') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
   return $output;
}
add_shortcode('vc_new_collection', 'vc_new_collection_func');

vc_map( array(
   "name" => __("Home blocks New Collection", 'homeshop'),
   "base" => "vc_new_collection",
    "wrapper_class" => "clearfix",
	"category" => __('Shop', 'homeshop'),
	"description" => __('Home blocks of New Collection Product', 'homeshop'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => '',
         "description" => __("Block title.",'homeshop')
        ),
		 array(
		  "type" => "dropdown",
		  "heading" => __("Columns count", 'homeshop'),
		  "param_name" => "columns_count",
		  "value" => array(6, 5, 4, 3, 2, 1),
		  "admin_label" => true,
		  "description" => __("Select columns count.", 'homeshop')
		),
		array(
            "type" => "my_category_all",
            "heading" => __("Select category", 'homeshop'),
            "param_name" => "my_product_cat",
            "description" => __("Select category.", 'homeshop')
        ),
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'homeshop'),
         "param_name" => "num_items",
         "value" => "4",
         "description" => __("Number of items in a carousel.",'homeshop')
        ),
   
		array(
		  "type" => "dropdown",
		  "heading" => __("Auto slideshow", 'homeshop'),
		  "param_name" => "slideshow_auto",
		  "value" => array(__("On", 'homeshop') => "true", __("Off", 'homeshop') => "false"),
		  "description" => ""
		),
	   
	    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Slideshow delay", 'homeshop'),
         "param_name" => "slideshow_delay",
         "value" => "9000",
         "description" => ""
        ),
	   
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)

   )
) );












//////////////////////////////vc_random_product////////////////////////////////////////////////////////////////////////////////
function vc_random_product_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => '',
      'my_product_cat' => '',
      'columns_count' => '',
      'num_items' => '',
      'slideshow_auto' => 'true',
      'slideshow_delay' => '9000',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	
	
	
	$term_slug = '';
	if($my_product_cat !='') {
	$term = get_term( $my_product_cat, 'product_cat' );
		if(!empty($term->slug)) {
		$term_slug = $term->slug;
		}
	}
	
	
	$custom_class = '';
	
    $args = array(  
    'post_type' => 'product',  
	'product_cat' => $term_slug, 
	'orderby' => 'rand',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );
	
	$id = rand(1, 1000);
	
	if ($slideshow_auto == 'true') {
	$slideshow = $slideshow_delay;
	}else{
	$slideshow = 'false';
	}

	
	$output  = '<div class="products-row row  '. $css_class .'">
	        <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="carousel-heading" style="margin-bottom: 10px;" >
					<h4>'. $title .'</h4>';
					
					if( count($myposts) > 1 ) {
	$output .=  '<div class="carousel-arrows random-product-arr">
						<i class="icons icon-left-dir"></i>
						<i class="icons icon-right-dir"></i>
					</div>';
					}
					
					
	$output .=  '</div>
				
			</div>
			<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
			<div class="owl-carousel owl-carousel'.$id.' " data-max-items="'. $columns_count .'">';

	$count = 0;
	$current_db_version = get_option( 'woocommerce_db_version', null );
	
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$product_id = $post_id;
			$count++;
			
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

			if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product = new WC_Product($post_id);
				} else {
					$current_product = get_product($post_id);
				}
				
			$product_price = $current_product->get_price_html();
			$product_name = get_the_title($post_id);
			$product_url = get_permalink($post_id);
			$num_rating = (int) $current_product->get_average_rating();
			
			$add_to_cart_button_class = 'add_to_cart_link_type';
			
			$show_add_to_cart = true;
				if (class_exists('WC_CVO_Visibility_Options')) {
					global $wc_cvo;
					/**
					 * Check show or hide price
					 */
					 if (($wc_cvo->setting('wc_cvo_prices') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_prices') == 'disabled') {
						 $product_price = '';
					 }
					 
					 /**
					 * Check show or hide add to cart button
					 */
					 if (($wc_cvo->setting('wc_cvo_atc') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_atc') == 'disabled') {
						 $show_add_to_cart = false;
					 }
				}
				
			
			
	$output .=  '<div>
					<!-- Carousel Item -->
					<div class="product">
						
						<div class="product-image">
						<a href="'. esc_url($product_url) .'" >
						' . ( has_post_thumbnail($post_id) ? get_the_post_thumbnail( $post_id, 'th-shop' ) : woocommerce_placeholder_img( 'shop_thumbnail' ) ) . '
						</a>';	
							
							
							
							
							
							
							
							
						if ( $current_product->is_on_sale() ) : 

								$output .=  '<span class="onsale" style="margin-left: 0;" >'. __("Sale",'homeshop') .'</span>'; 

						endif; 
						
						if ( !$current_product->is_in_stock() ) : 

								$output .=  '<span class="onsale labels_stock" style="margin-left: 0;" >'. __("Stock",'homeshop') .'</span>'; 

						endif; 
				
							
						if ( $current_product->is_featured() ) : 

							 $output .=  '<span class="onsale onfeatured">' . __( 'Hot', 'homeshop' ) . '</span>'; 

						 endif; 	
							
							
							
							
							
							
							if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'hide') {
							$output .=  '<a href="'. esc_url($product_url) .'" class="product-hover">
								<i class="icons icon-eye-1"></i> '. __("Quick View",'homeshop') .'
							</a>';
							}
							
						$output .=  '</div>
						
						<div class="product-info">
							<h3><a href="'. esc_url($product_url) .'">'. product_max_charlength_text($product_name, (int) get_option('sense_num_product_title')) .'</a></h3>';
							
							
							$output .=  categories_product1($product_id);
							
							
							
							$output .=  '<span class="price">'. $product_price .'</span>';
							
							if (get_option('woocommerce_enable_review_rating') != 'no') {
							$output .=  '<div class="rating readonly-rating" data-score="'. $num_rating .'"></div>';
							}
							
						$output .=  '</div>
						
						<div class="product-actions">';
						
				$output .=  '<span class="add-to-cart">';
		$output .= apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class=" %s product_type_%s"><span class="action-wrapper"><i class="icons icon-basket-2"></i><span class="action-name">%s</span></span></a>',
		esc_url( $current_product->add_to_cart_url() ),
		esc_attr( $current_product->id ),
		esc_attr( $current_product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$current_product->is_purchasable() && $current_product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $current_product->product_type ),
		esc_html( $current_product->add_to_cart_text() )
	),
	$current_product );
		$output .=  '</span>';
	
						
		if( class_exists( 'YITH_WCWL_Shortcode' ) ) {				
		$output .=  do_shortcode('[yith_wcwl_add_to_wishlist]');		
		}
		
		
		if ( function_exists('woo_add_compare_button' ) && woo_add_compare_button($product_id) != '' ) { 

			$output .=  '<span class="add-to-compare">
								<span class="action-wrapper">
									<i class="icons icon-docs"></i>
									<span class="action-name">'. woo_add_compare_button($product_id) .'</span>
								</span>
							</span>';
			
		}
		
		$output .=  '</div>
					</div>
					<!-- /Carousel Item -->
				</div>';
	
	
	endforeach; 	
	
	$output .=  '</div></div>
                    </div>';
 
 
 
	
	
	$output .= '<script type="text/javascript">'."\n";
		$output .= ' jQuery(document).ready(function($){'."\n";
		
		
		$output .= 'var max_items = '. $columns_count.'; '."\n"; 
		$output .= 'var tablet_items = max_items;'."\n"; 
		$output .= 'if(max_items > 1){ tablet_items = max_items - 1; }'."\n"; 
		$output .= 'var mobile_items = 1;'."\n"; 
		
		$output .= 'var owl_carousel_'.$id.' = $(".owl-carousel'.$id.'");'."\n";
		$output .= 'owl_carousel_'.$id.'.owlCarousel({'."\n";
		$output .= '	autoPlay: '.$slideshow.','."\n";      
			if (is_rtl()) {
		$output .= '	direction:"rtl",'."\n"; 
			}	
		$output .= '	stopOnHover : true,'."\n";                 
		$output .= '	items:max_items,'."\n";                 
		$output .= '	pagination : false,'."\n";                 
		$output .= '	itemsDesktop : [1199,max_items],'."\n";                 
		$output .= '	itemsDesktopSmall : [1000,max_items],'."\n";                 
		$output .= '	itemsTablet: [920,tablet_items],'."\n";                 
		$output .= '	itemsMobile: [560,mobile_items],'."\n";                                 
		$output .= '	});'."\n";
		
		
		$output .= '	 });'."\n";
		$output .= '</script>'."\n";
 
 
 
 
	if( count($myposts) == 2  && $columns_count == '2' ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .random-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
    if( count($myposts) == 2  && $columns_count == '3' ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .random-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 2  && $columns_count == '4' ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .random-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 3 && $columns_count == '3' ) {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .random-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 3 && $columns_count == '4' ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .random-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 4 && $columns_count == '4') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .random-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) <= 5 && $columns_count == '5') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .random-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) <= 6 && $columns_count == '6') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .random-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	
	
   return $output;
}
add_shortcode('vc_random_product', 'vc_random_product_func');

vc_map( array(
   "name" => __("Home blocks Random Product", 'homeshop'),
   "base" => "vc_random_product",
    "wrapper_class" => "clearfix",
	"category" => __('Shop', 'homeshop'),
	"description" => __('Home blocks of Random Product', 'homeshop'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => '',
         "description" => __("Block title.",'homeshop')
        ),
		 array(
		  "type" => "dropdown",
		  "heading" => __("Columns count", 'homeshop'),
		  "param_name" => "columns_count",
		  "value" => array(6, 5, 4, 3, 2, 1),
		  "admin_label" => true,
		  "description" => __("Select columns count.", 'homeshop')
		),
		array(
            "type" => "my_category",
            "heading" => __("Select category", 'homeshop'),
            "param_name" => "my_product_cat",
            "description" => __("Select category.", 'homeshop')
        ),
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'homeshop'),
         "param_name" => "num_items",
         "value" => "4",
         "description" => __("Number of items in a carousel.",'homeshop')
        ),
   
		array(
		  "type" => "dropdown",
		  "heading" => __("Auto slideshow", 'homeshop'),
		  "param_name" => "slideshow_auto",
		  "value" => array(__("On", 'homeshop') => "true", __("Off", 'homeshop') => "false"),
		  "description" => ""
		),
	   
	    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Slideshow delay", 'homeshop'),
         "param_name" => "slideshow_delay",
         "value" => "9000",
         "description" => ""
        ),
	   
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)

   )
) );










//////////////////////////////vc_mylatest_post////////////////////////////////////////////////////////////////////////////////
function vc_mylatest_post_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => __("Latest news & Reviews",'homeshop'),
      'my_product_cat' => '',
      'columns_count' => '2',
      'num_items' => '',
      'slideshow_auto' => 'true',
      'slideshow_delay' => '9000',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	$term = get_term( $my_product_cat, 'category' );
	$custom_class = '';
	
    $args = array(  
    'post_type' => 'post',  
	'category' => $term->slug, 
	'orderby' => 'date',
	'order' => 'desc',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );
	
	$id = rand(1, 100);
	
	if ($slideshow_auto == 'true') {
	$slideshow = $slideshow_delay;
	}else{
	$slideshow = 'false';
	}

	
	$output  = '<div class="products-row row  '. $css_class .'">
	        <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="carousel-heading" style="margin-bottom: 10px;" >
					<h4>'. $title .'</h4>';
					
					if( count($myposts) > 2 ) {
		$output .=  '<div class="carousel-arrows">
						<i class="icons icon-left-dir"></i>
						<i class="icons icon-right-dir"></i>
					</div>';
					}
					
	$output .=  '</div>
				
			</div>
			<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
			<div class="owl-carousel owl-carousel'.$id.' " data-max-items="'. $columns_count .'">';

	$count = 0;
	
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$count++;
			
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

		
			
			
			
	$output .=  '<div>
					<!-- Carousel Item -->
					<article class="news">
						
						<div class="news-background">
						
							<div class="row">
								<div class="col-lg-5 col-md-5 col-sm-5 news-thumbnail">
									<a href="'. esc_url(get_permalink($post_id)) .'">'. get_the_post_thumbnail( $post_id, 'latest-post' ) .'</a>
								</div>
								<div class="col-lg-7 col-md-7 col-sm-7 news-content">
									<h5><a href="'. esc_url(get_permalink($post_id)) .'">'. get_the_title($post_id) .'</a></h5>
									<span class="date"><i class="icons icon-clock-1"></i> '. get_the_time('d M Y', $post_id) .'</span>
									<p>'. the_excerpt_max_charlength_text(get_the_excerpt(), 12) .'</p>
								</div>
							</div>
						
						</div>
						
					</article>
					<!-- /Carousel Item -->
				</div>';
	
	
	
	endforeach; 	
	
	$output .=  '</div></div>
                    </div>';
 
 
 
	
	
	$output .= '<script type="text/javascript">'."\n";
		$output .= ' jQuery(document).ready(function($){'."\n";
		
		
		$output .= 'var max_items = '. $columns_count.'; '."\n"; 
		$output .= 'var tablet_items = max_items;'."\n"; 
		$output .= 'if(max_items > 1){ tablet_items = max_items - 1; }'."\n"; 
		$output .= 'var mobile_items = 1;'."\n"; 
		
		$output .= 'var owl_carousel_'.$id.' = $(".owl-carousel'.$id.'");'."\n";
		$output .= 'owl_carousel_'.$id.'.owlCarousel({'."\n";
		$output .= '	autoPlay: '.$slideshow.','."\n";  
			if (is_rtl()) {
		$output .= '	direction:"rtl",'."\n"; 
			}	
		$output .= '	stopOnHover : true,'."\n";                 
		$output .= '	items:max_items,'."\n";                 
		$output .= '	pagination : false,'."\n";                 
		$output .= '	itemsDesktop : [1199,max_items],'."\n";                 
		$output .= '	itemsDesktopSmall : [1000,max_items],'."\n";                 
		$output .= '	itemsTablet: [920,tablet_items],'."\n";                 
		$output .= '	itemsMobile: [560,mobile_items],'."\n";                                 
		$output .= '	});'."\n";
		
		
		$output .= '	 });'."\n";
		$output .= '</script>'."\n";
 
 
 
 
 
 
   return $output;
}
add_shortcode('vc_mylatest_post', 'vc_mylatest_post_func');

vc_map( array(
   "name" => __("Home blocks Latest News", 'homeshop'),
   "base" => "vc_mylatest_post",
    "wrapper_class" => "clearfix",
	"category" => __('Content', 'homeshop'),
	"description" => __('Home blocks of Latest News', 'homeshop'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => __("Latest news & Reviews",'homeshop'),
         "description" => __("Block title.",'homeshop')
        ),
		
		array(
            "type" => "post_category",
            "heading" => __("Select category", 'homeshop'),
            "param_name" => "my_product_cat",
            "description" => __("Select category.", 'homeshop')
        ),
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'homeshop'),
         "param_name" => "num_items",
         "value" => "4",
         "description" => __("Number of items in a carousel.",'homeshop')
        ),
   
		array(
		  "type" => "dropdown",
		  "heading" => __("Auto slideshow", 'homeshop'),
		  "param_name" => "slideshow_auto",
		  "value" => array(__("On", 'homeshop') => "true", __("Off", 'homeshop') => "false"),
		  "description" => ""
		),
	   
	    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Slideshow delay", 'homeshop'),
         "param_name" => "slideshow_delay",
         "value" => "9000",
         "description" => ""
        ),
	   
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)

   )
) );





//////////////////////////////vc_brand_carousel///////////////////////////////////////////////
function vc_brand_carousel_func( $atts, $content = null ) { // New function parameter $content is added!
  $output = $images = $css_animation = $title = '';
  $img_size = "150*90";
  
  extract( shortcode_atts( array(
    'title' => __("Product Brands",'homeshop'),
    'onclick' => 'link_image',
    'custom_links' => '',
    'custom_links_target' => '',
    'images' => '',
    'slideshow_auto' => 'true',
    'slideshow_delay' => '9000',
    'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
    
 
	if ( $images == '' ) $images = '-1,-2,-3';
    if ( $onclick == 'custom_link' ) { $custom_links = explode( ',', $custom_links); }

	$images = explode( ',', $images);
	$i = -1;
	$carousel_id = rand();
	
	
	$columns_count = 5;
	if ($slideshow_auto == 'true') {
	$slideshow = $slideshow_delay;
	}else{
	$slideshow = 'false';
	}

	
	$output  = '<div class="products-row row  '. $css_class .'">
	        <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="carousel-heading" style="margin-bottom: 10px;" >
					<h4>'. $title .'</h4>';
					if( count($images) > 1 ) {
		$output .= '<div class="carousel-arrows brand-arr">
						<i class="icons icon-left-dir"></i>
						<i class="icons icon-right-dir"></i>
					</div>';
					}
					
	$output .= '</div>
				
			</div>
			<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
			<div class="owl-carousel brand-carousel brand-carousel'.$carousel_id.' " data-max-items="'. $columns_count .'">';

	foreach($images as $attach_id) {
		$i++;
		if ($attach_id > 0) {
			$post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ));
		}
		else {
			$post_thumbnail = array();
			$post_thumbnail['thumbnail'] = '<img src="'.$this->assetUrl('vc/no_image.png').'" />';
			$post_thumbnail['p_img_large'][0] = $this->assetUrl('vc/no_image.png');
		}
		$thumbnail = $post_thumbnail['thumbnail'];
		
		if($onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '') {
		$output  .= '<div>
						<div class="product">
							<a href="'. esc_url($custom_links[$i]) .'" '. (!empty($custom_links_target) ? ' target="'.$custom_links_target.'"' : '') .' >
							'. $thumbnail .'
							</a>
						</div>
					</div>';
	    } else {
		$output .= '<div>
						<div class="product">
							
							'. $thumbnail .'
							
						</div>
					</div>';
		}
		
		
	}
	
	$output .=  '</div>
					</div>
					</div>';
	
	
	
	
	
		$output .= '<script type="text/javascript">'."\n";
		$output .= ' jQuery(document).ready(function($){'."\n";
		
		
		$output .= 'var max_items = '. $columns_count.'; '."\n"; 
		$output .= 'var tablet_items = max_items;'."\n"; 
		$output .= 'if(max_items > 1){ tablet_items = max_items - 1; }'."\n"; 
		$output .= 'var mobile_items = 1;'."\n"; 
		
		$output .= 'var brand_carousel_'.$carousel_id.' = $(".brand-carousel'.$carousel_id.'");'."\n";
		$output .= 'brand_carousel_'.$carousel_id.'.owlCarousel({'."\n";
		$output .= '	autoPlay: '.$slideshow.','."\n";    
			if (is_rtl()) {
		$output .= '	direction:"rtl",'."\n"; 
			}	
		$output .= '	stopOnHover : true,'."\n";                 
		$output .= '	items:max_items,'."\n";                 
		$output .= '	pagination : false,'."\n";                 
		$output .= '	itemsDesktop : [1199,max_items],'."\n";                 
		$output .= '	itemsDesktopSmall : [1000,max_items],'."\n";                 
		$output .= '	itemsTablet: [920,tablet_items],'."\n";                 
		$output .= '	itemsMobile: [560,mobile_items],'."\n";                                 
		$output .= '	});'."\n";
		
		
		$output .= '	 });'."\n";
		$output .= '</script>'."\n";
	
	
	
	
	if( count($images) == 2 ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .brand-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($images) == 3 || count($images) == 4 ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .brand-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($images) == 5) {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .brand-arr {
				display: none;
			  }
		}
    </style>';
	}
	
   return $output;
}
add_shortcode('vc_brand_carousel', 'vc_brand_carousel_func');


/* Custom Images Carousel
---------------------------------------------------------- */
vc_map( array(
    "name" => __("Custom Images Carousel", 'homeshop'),
    "base" => "vc_brand_carousel",
    "icon" => "icon-wpb-images-carousel",
    "category" => __('Content', 'homeshop'),
    "class"		=> "",
    "is_container" => false,
    "params" => array(
        array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => __("Product Brands",'homeshop'),
         "description" => __("Block title.",'homeshop')
        ),
        array(
            "type" => "attach_images",
            "heading" => __("Images", 'homeshop'),
            "param_name" => "images",
            "value" => "",
            "description" => __("Select images from media library.", 'homeshop')
        ),
       
        array(
            "type" => "dropdown",
            "heading" => __("On click", 'homeshop'),
            "param_name" => "onclick",
            "value" => array(__("Do nothing", 'homeshop') => "link_no", __("Open custom link", 'homeshop') => "custom_link"),
            "description" => __("What to do when slide is clicked?", 'homeshop')
        ),
        array(
            "type" => "exploded_textarea",
            "heading" => __("Custom links", 'homeshop'),
            "param_name" => "custom_links",
            "description" => __('Enter links for each slide here. Divide links with linebreaks (Enter).', 'homeshop'),
            "dependency" => Array('element' => "onclick", 'value' => array('custom_link'))
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Custom link target", 'homeshop'),
            "param_name" => "custom_links_target",
            "description" => __('Select where to open  custom links.', 'homeshop'),
            "dependency" => Array('element' => "onclick", 'value' => array('custom_link')),
            'value' => $target_arr
        ),
       
        array(
		  "type" => "dropdown",
		  "heading" => __("Auto slideshow", 'homeshop'),
		  "param_name" => "slideshow_auto",
		  "value" => array(__("On", 'homeshop') => "true", __("Off", 'homeshop') => "false"),
		  "description" => ""
		),
	   
	    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Slideshow delay", 'homeshop'),
         "param_name" => "slideshow_delay",
         "value" => "9000",
         "description" => ""
        ),
       
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)
    )
) );





//////////////////////////////vc_new_brand////////////////////////////////////////////////////////////////////////////////
function vc_new_brand_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => __("New Collection",'homeshop'),
      'my_product_cat' => '',
      'columns_count' => '',
      'num_items' => '',
      'slideshow_auto' => 'true',
      'slideshow_delay' => '9000',
      'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
	$term = get_term( $my_product_cat, 'product_brand' );
	
	
	
	$custom_class = '';
    $args = array(  
    'post_type' => 'product',  
	'product_brand' => $term->slug, 	
	'orderby' => 'date',
    'order' => 'desc',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );
	
	$id = rand(1, 10000);
	
	if ($slideshow_auto == 'true') {
	$slideshow = $slideshow_delay;
	}else{
	$slideshow = 'false';
	}

	
	
	
	
	$output  = '<div class="products-row row  '. $css_class .'">
	        <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="carousel-heading" style="margin-bottom: 10px;" >
					<h4>'. $title .'</h4>';
					
					if( count($myposts) > $columns_count ) {
			$output .=  '<div class="carousel-arrows brand-product-arr">
						<i class="icons icon-left-dir"></i>
						<i class="icons icon-right-dir"></i>
					</div>';
					}
					
	$output .=  '</div>
				
			</div>
			<div class="carousel brands-carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
			<div class="owl-carousel owl-carousel'.$id.' " data-max-items="'. $columns_count .'">';

	$count = 0;
	$current_db_version = get_option( 'woocommerce_db_version', null );
	
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$product_id = $post_id;
			$count++;
			
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

			if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product = new WC_Product($post_id);
				} else {
					$current_product = get_product($post_id);
				}
				
			$product_price = $current_product->get_price_html();
			$product_name = get_the_title($post_id);
			$product_url = get_permalink($post_id);
			$num_rating = (int) $current_product->get_average_rating();
			$add_to_cart_button_class = 'add_to_cart_link_type';
			
			$show_add_to_cart = true;
				if (class_exists('WC_CVO_Visibility_Options')) {
					global $wc_cvo;
					/**
					 * Check show or hide price
					 */
					 if (($wc_cvo->setting('wc_cvo_prices') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_prices') == 'disabled') {
						 $product_price = '';
					 }
					 
					 /**
					 * Check show or hide add to cart button
					 */
					 if (($wc_cvo->setting('wc_cvo_atc') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_atc') == 'disabled') {
						 $show_add_to_cart = false;
					 }
				}
				
			
	
	
	$output .=  '<div  >
	
					<!-- Carousel Item -->
					<div class="product">
						
						<div class="product-image">
						<a href="'. esc_url($product_url) .'" >
						' . ( has_post_thumbnail($post_id) ? get_the_post_thumbnail( $post_id, 'th-shop' ) : woocommerce_placeholder_img( 'shop_thumbnail' ) ) . '
							
						</a>';
						
						if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'hide') {
							$output .=  '<a href="'. esc_url($product_url) .'" class="product-hover">
								<i class="icons icon-eye-1"></i> '. __("Quick View", 'homeshop') .'
							</a>';
							}
							
						$output .=  '</div>
						
						<div class="product-info">
							<h3><a href="'. esc_url($product_url) .'">'. product_max_charlength_text($product_name, (int) get_option('sense_num_product_title')) .'</a></h3>';
							
							
							$output .=  categories_product1($product_id);
							
						$output .=  '<span class="price">'. $product_price .'</span>';
						
							if (get_option('woocommerce_enable_review_rating') != 'no') {
							$output .=  '<div class="rating readonly-rating" data-score="'. $num_rating .'"></div>';
							}
							
						$output .=  '</div>
						
						<div class="product-actions">';
						
						
				$output .=  '<span class="add-to-cart">';
		$output .= apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class=" %s product_type_%s"><span class="action-wrapper"><i class="icons icon-basket-2"></i><span class="action-name">%s</span></span></a>',
		esc_url( $current_product->add_to_cart_url() ),
		esc_attr( $current_product->id ),
		esc_attr( $current_product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$current_product->is_purchasable() && $current_product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $current_product->product_type ),
		esc_html( $current_product->add_to_cart_text() )
	),
	$current_product );
		$output .=  '</span>';

						
		if( class_exists( 'YITH_WCWL_Shortcode' ) ) {				
		$output .=  do_shortcode('[yith_wcwl_add_to_wishlist]');		
		}
		
		
		if ( function_exists('woo_add_compare_button' ) && woo_add_compare_button($product_id) != '' ) { 

			$output .=  '<span class="add-to-compare">
								<span class="action-wrapper">
									<i class="icons icon-docs"></i>
									<span class="action-name">'. woo_add_compare_button($product_id) .'</span>
								</span>
							</span>';
			
		}
		
		$output .=  '</div>
					</div>
					<!-- /Carousel Item -->
					
				</div>';
	
	
	
	
	
	endforeach; 	
	
	$output .=  '</div></div>
                    </div>';
 
 
 
	
	
	$output .= '<script type="text/javascript">'."\n";
		$output .= ' jQuery(document).ready(function($){'."\n";
		
		
		$output .= 'var max_items = '. $columns_count.'; '."\n"; 
		$output .= 'var tablet_items = max_items;'."\n"; 
		$output .= 'if(max_items > 1){ tablet_items = max_items - 1; }'."\n"; 
		$output .= 'var mobile_items = 1;'."\n"; 
		
		$output .= 'var owl_carousel_'.$id.' = $(".owl-carousel'.$id.'");'."\n";
		$output .= 'owl_carousel_'.$id.'.owlCarousel({'."\n";
		$output .= '	autoPlay: '.$slideshow.','."\n";    
			if (is_rtl()) {
		$output .= '	direction:"rtl",'."\n"; 
			}	
		$output .= '	stopOnHover : true,'."\n";                 
		$output .= '	items:max_items,'."\n";                 
		$output .= '	pagination : false,'."\n";                 
		$output .= '	itemsDesktop : [1199,max_items],'."\n";                 
		$output .= '	itemsDesktopSmall : [1000,max_items],'."\n";                 
		$output .= '	itemsTablet: [920,tablet_items],'."\n";                 
		$output .= '	itemsMobile: [560,mobile_items],'."\n";                                 
		$output .= '	});'."\n";
		
		
		$output .= '	 });'."\n";
		$output .= '</script>'."\n";
 
 
 
 
	if( count($myposts) == 2  && $columns_count == '2' ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
    if( count($myposts) == 2  && $columns_count == '3' ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 2  && $columns_count == '4' ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 3 && $columns_count == '3' ) {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 3 && $columns_count == '4' ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($myposts) == 4 && $columns_count == '4') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
 
 
	if( count($myposts) <= 5 && $columns_count == '5') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
 
	if( count($myposts) <= 6 && $columns_count == '6') {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .new-product-arr {
				display: none;
			  }
		}
    </style>';
	}
 
   return $output;
}
add_shortcode('vc_new_brand', 'vc_new_brand_func');

vc_map( array(
   "name" => __("Home blocks Products by Brand Carousel", 'homeshop'),
   "base" => "vc_new_brand",
    "wrapper_class" => "clearfix",
	"category" => __('Shop', 'homeshop'),
	"description" => __('Home blocks of Products by Brand Carousel', 'homeshop'),
   "params" => array(
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => __("New Collection",'homeshop'),
         "description" => __("Block title.",'homeshop')
        ),
		 array(
		  "type" => "dropdown",
		  "heading" => __("Columns count", 'homeshop'),
		  "param_name" => "columns_count",
		  "value" => array(6, 5, 4, 3, 2, 1),
		  "admin_label" => true,
		  "description" => __("Select columns count.", 'homeshop')
		),
		array(
            "type" => "brand_category",
            "heading" => __("Select brand", 'homeshop'),
            "param_name" => "my_product_cat",
            "description" => __("Select brand.", 'homeshop')
        ),
   
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number items", 'homeshop'),
         "param_name" => "num_items",
         "value" => "4",
         "description" => __("Number of items in a carousel.",'homeshop')
        ),
   
		array(
		  "type" => "dropdown",
		  "heading" => __("Auto slideshow", 'homeshop'),
		  "param_name" => "slideshow_auto",
		  "value" => array(__("On", 'homeshop') => "true", __("Off", 'homeshop') => "false"),
		  "description" => ""
		),
	   
	    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Slideshow delay", 'homeshop'),
         "param_name" => "slideshow_delay",
         "value" => "9000",
         "description" => ""
        ),
	   
        array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)

   )
) );













//////////////////////////////vc_brand_img_carousel_custom_func///////////////////////////////////////////////
function vc_brand_img_carousel_custom_func( $atts, $content = null ) { // New function parameter $content is added!
  $output = $css_animation = $title = '';
  $img_size = "150*90";
  
  extract( shortcode_atts( array(
    'title' => __("Brands",'homeshop'),
    'slideshow_auto' => 'true',
    'slideshow_delay' => '9000',
    'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;
    
 
	$brands_list = get_terms( 'product_brand', array(
			'orderby'    => 'name',
			'order'             => 'ASC'
		));
 
	
	if ( is_wp_error($brands_list)) {
			return;
		}
	
	
	
	$i = -1;
	$carousel_id = rand(1, 10000);
	
	
	$columns_count = 5;
	if ($slideshow_auto == 'true') {
	$slideshow = $slideshow_delay;
	}else{
	$slideshow = 'false';
	}


	
	
	if ( !empty( $brands_list ) && !is_wp_error( $brands_list ) ){
		
		
	$output  .= '<div class="products-row row  '. $css_class .'">
	        <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="carousel-heading" style="margin-bottom: 10px;" >
					<h4>'. $title .'</h4>';
					if( count($brands_list) > 5 ) {
		$output .= '<div class="carousel-arrows brand-arr">
						<i class="icons icon-left-dir"></i>
						<i class="icons icon-right-dir"></i>
					</div>';
					}
					
	$output .= '</div>
				
			</div>
			<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
			<div class="owl-carousel brand-img brand-carousel brand-carousel'.$carousel_id.' " data-max-items="'. $columns_count .'">';

	foreach ( $brands_list as $brand_item ) {
		
		$i++;
		
		//if((get_tax_meta($brand_item->term_id, 'mgwb_image_brand_thumb'))) {
			$brand_image_src_term = get_tax_meta($brand_item->term_id, 'mgwb_image_brand_thumb');
			$brand_image_src = $brand_image_src_term['src'];
			$output .= '<div>
						<div class="product">
						<a href="'.get_term_link( $brand_item->slug, 'product_brand' ).'"><img src="'.$brand_image_src .'" alt="'.$brand_item->name.'"/></a>
						</div>
					</div>';
		//}
		

	}
	
	$output .=  '</div>
					</div>
					</div>';
	
	
	
	
	
	
	$output .= '<script type="text/javascript">'."\n";
		$output .= ' jQuery(document).ready(function($){'."\n";
		
		
		$output .= 'var max_items = '. $columns_count.'; '."\n"; 
		$output .= 'var tablet_items = max_items;'."\n"; 
		$output .= 'if(max_items > 1){ tablet_items = max_items - 1; }'."\n"; 
		$output .= 'var mobile_items = 1;'."\n"; 
		
		$output .= 'var brand_carousel_'.$carousel_id.' = $(".brand-carousel'.$carousel_id.'");'."\n";
		$output .= 'brand_carousel_'.$carousel_id.'.owlCarousel({'."\n";
		$output .= '	autoPlay: '.$slideshow.','."\n";   
			if (is_rtl()) {
		$output .= '	direction:"rtl",'."\n"; 
			}	
		$output .= '	stopOnHover : true,'."\n";                 
		$output .= '	items:max_items,'."\n";                 
		$output .= '	pagination : false,'."\n";                 
		$output .= '	itemsDesktop : [1199,max_items],'."\n";                 
		$output .= '	itemsDesktopSmall : [1000,max_items],'."\n";                 
		$output .= '	itemsTablet: [920,tablet_items],'."\n";                 
		$output .= '	itemsMobile: [560,mobile_items],'."\n";                                 
		$output .= '	});'."\n";
		
		
		$output .= '	 });'."\n";
		$output .= '</script>'."\n";
	
	
	
	if( count($brands_list) == 2 ) {
		$output .= '<style type="text/css" >
		@media(min-width:600px) {
			  body .brand-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($brands_list) == 3 || count($brands_list) == 4 ) {
		$output .= '<style type="text/css" >
		@media(min-width:767px) {
			  body .brand-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	if( count($brands_list) == 5) {
		$output .= '<style type="text/css" >
		@media(min-width:785px) {
			  body .brand-arr {
				display: none;
			  }
		}
    </style>';
	}
	
	
	}
   return $output;
}
add_shortcode('vc_brand_img_carousel_custom', 'vc_brand_img_carousel_custom_func');


/* Custom Brands Image Carousel
---------------------------------------------------------- */
vc_map( array(
    "name" => __("Brands Image Carousel", 'homeshop'),
    "base" => "vc_brand_img_carousel_custom",
    "icon" => "icon-wpb-images-carousel",
    "category" => __('Shop', 'homeshop'),
    "class"		=> "",
    "is_container" => false,
    "params" => array(
        array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => __("Brands",'homeshop'),
         "description" => __("Block title.",'homeshop')
        ),

        array(
		  "type" => "dropdown",
		  "heading" => __("Auto slideshow", 'homeshop'),
		  "param_name" => "slideshow_auto",
		  "value" => array(__("On", 'homeshop') => "true", __("Off", 'homeshop') => "false"),
		  "description" => ""
		),
	   
	    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Slideshow delay", 'homeshop'),
         "param_name" => "slideshow_delay",
         "value" => "9000",
         "description" => ""
        ),
       
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)
    )
) );





//////////////////////////////vc_custom_title/////////////////////////////////////////////////
function vc_custom_title_func( $atts, $content = null ) { 
  $output = $css_animation = $title = '';
  
  extract( shortcode_atts( array(
    'title' => __("My Title",'homeshop'),
    'css_animation' => ''
   ), $atts ) );
 
    $width_class = '';
	$css_class =  '';
	$css_class .= $css_animation;

	$output  = '<div class="products-row row  '. $css_class .'">
	        <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="carousel-heading" style="margin-bottom: 10px;" >
					<h4>'. $title .'</h4>';
	$output .= '</div>
				
			</div></div>';

   return $output;
}
add_shortcode('vc_custom_title', 'vc_custom_title_func');


/* custom_title
---------------------------------------------------------- */
vc_map( array(
    "name" => __("Custom Title", 'homeshop'),
    "base" => "vc_custom_title",
    "icon" => "icon-wpb-images-carousel",
    "category" => __('Content', 'homeshop'),
    "class"		=> "",
    "is_container" => false,
    "params" => array(
        array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title", 'homeshop'),
         "param_name" => "title",
         "value" => __("My Title",'homeshop'),
         "description" => __("Block title.",'homeshop')
        ),
       
		array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", 'homeshop'),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", 'homeshop') => '', __("Top to bottom", 'homeshop') => "top-to-bottom", __("Bottom to top", 'homeshop') => "bottom-to-top", __("Left to right", 'homeshop') => "left-to-right", __("Right to left", 'homeshop') => "right-to-left", __("Appear from center", 'homeshop') => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'homeshop')
		)
    )
) );












//////////////custom param///////////////////////////////////////////////////////////////////////
function homeshop_post_category_settings_field($param, $param_value) {
  // $dependency = vc_generate_dependencies_attributes($param);
   

				$entries = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=category');
				$param_line = '';
				$param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value dropdown wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';
                
				foreach($entries as $key => $entry) {
                    $selected = '';
                    if ( $entry->term_id == $param_value ) $selected = ' selected="selected"';
                    $sidebar_name = $entry->name;
                    $param_line .= '<option value="'.$entry->term_id.'"'.$selected.'>'.$sidebar_name.'</option>';
                }
                $param_line .= '</select>';
        
   
    return $param_line;
}
vc_add_shortcode_param('post_category', 'homeshop_post_category_settings_field');

function homeshop_category_settings_field($param, $param_value) {
 //  $dependency = vc_generate_dependencies_attributes($param);
   

				$entries = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=product_cat');
				$param_line = '';
				$param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value dropdown wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';
               
				foreach($entries as $key => $entry) {
                    $selected = '';
                    if ( $entry->term_id == $param_value ) $selected = ' selected="selected"';
                    $sidebar_name = $entry->name;
                    $param_line .= '<option value="'.$entry->term_id.'"'.$selected.'>'.$sidebar_name.'</option>';
                }
                $param_line .= '</select>';
        
   
    return $param_line;
}
vc_add_shortcode_param('my_category', 'homeshop_category_settings_field');



function homeshop_category_all_settings_field($param, $param_value) {
 //  $dependency = vc_generate_dependencies_attributes($param);
   

				$entries = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=product_cat');
				$param_line = '';
				$param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value dropdown wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';
                $param_line .= '<option value="">'.__("All", "homeShop").'</option>';
				foreach($entries as $key => $entry) {
                    $selected = '';
                    if ( $entry->term_id == $param_value ) $selected = ' selected="selected"';
                    $sidebar_name = $entry->name;
                    $param_line .= '<option value="'.$entry->term_id.'"'.$selected.'>'.$sidebar_name.'</option>';
                }
                $param_line .= '</select>';
        
   
    return $param_line;
}
vc_add_shortcode_param('my_category_all', 'homeshop_category_all_settings_field');






function homeshop_category_settings_brand($param, $param_value) {
 //  $dependency = vc_generate_dependencies_attributes($param);
   

				$entries = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=product_brand');
				$param_line = '';
				$param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value dropdown wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';
                
				foreach($entries as $key => $entry) {
                    $selected = '';
                    if ( $entry->term_id == $param_value ) $selected = ' selected="selected"';
                    $sidebar_name = $entry->name;
                    $param_line .= '<option value="'.$entry->term_id.'"'.$selected.'>'.$sidebar_name.'</option>';
                }
                $param_line .= '</select>';
        
   
    return $param_line;
}
vc_add_shortcode_param('brand_category', 'homeshop_category_settings_brand');




function homeshop_contact_form_field($param, $param_value) {
    //$dependency = vc_generate_dependencies_attributes($param);
   
    $param_line = '';
	$param_line .= '<div class="cf_wrapper">';
	$param_line .= '<input name="'.$param['param_name'].'" class="val wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="hidden" value="'.$param_value.'"/>';
	$param_line .= '<ul class="contact_fields"></ul>
					<div class="form">
						<label for="lb" style="width: 60px;float: left;">Label</label> <input id="lb" type="text" class="label" style="width: 200px; margin-bottom: 4px;" /><br>
						<label for="nm" style="width: 60px;float: left;">Name</label> <input id="nm" type="text" class="name" style="width: 200px; margin-bottom: 4px;" />
						<input type="button" class="add_cf_row" value="add new field"/>
					 </div>';
	$param_line .=  '<script> var builder = new cf_builder({"container": ".cf_wrapper"}); builder.init('.$param_value.');</script>';
	$param_line .= '</div>';
   

    return $param_line;
}
vc_add_shortcode_param('contact_form', 'homeshop_contact_form_field');







//////////////custom param///////////////////////////////////////////////////////////////////////

$icon_arr = array_flip(wm_fontello_classes());

$tag_taxonomies = array();
if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
	$taxonomies = get_taxonomies();
	if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {
		foreach ( $taxonomies as $taxonomy ) {
			$tax = get_taxonomy( $taxonomy );
			if ( ( is_object( $tax ) && ( ! $tax->show_tagcloud || empty( $tax->labels->name ) ) ) || ! is_object( $tax ) ) {
				continue;
			}
			$tag_taxonomies[ $tax->labels->name ] = esc_attr( $taxonomy );
		}
	}
}



vc_map( array(
	'name' => 'WP ' . esc_html__( 'Tag Cloud', 'homeshop' ),
	'base' => 'vc_wp_tagcloud',
	'icon' => 'icon-wpb-wp',
	'category' => esc_html__( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__( 'Your most used tags in cloud format', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' )
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Taxonomy', 'homeshop' ),
			'param_name' => 'taxonomy',
			'value' => $tag_taxonomies,
			'description' => esc_html__( 'Select source for tag cloud.', 'homeshop' ),
			'admin_label' => true
		),
		
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );



$custom_menus = array();
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
if ( is_array( $menus ) && ! empty( $menus ) ) {
	foreach ( $menus as $single_menu ) {
		if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
			$custom_menus[ $single_menu->name ] = $single_menu->term_id;
		}
	}
}

vc_map( array(
	'name' => 'WP ' . __( "Custom Menu" ),
	'base' => 'vc_wp_custommenu',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Use this widget to add one of your custom menus as a widget', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' )
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),
		
		array(
			'type' => 'dropdown',
			'heading' => __( 'Menu', 'homeshop' ),
			'param_name' => 'nav_menu',
			'value' => $custom_menus,
			'description' => empty( $custom_menus ) ? __( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'homeshop' ) : __( 'Select menu to display.', 'homeshop' ),
			'admin_label' => true,
			'save_always' => true,
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );





vc_map( array(
	'name' => 'WP ' . __( 'Text' ),
	'base' => 'vc_wp_text',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Arbitrary text or HTML', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' )
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),
		
		array(
			'type' => 'textarea',
			'heading' => __( 'Text', 'homeshop' ),
			'value' => '',
			'param_name' => 'text'
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );





vc_map( array(
	'name' => 'WP ' . __( 'Recent Posts' ),
	'base' => 'vc_wp_posts',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'The most recent posts on your site', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' ),
			'value' => __( 'Recent Posts', 'homeshop' ),
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),
		
		array(
			'type' => 'textfield',
			'heading' => __( 'Number of posts', 'homeshop' ),
			'description' => __( 'Enter number of posts to display.', 'homeshop' ),
			'param_name' => 'number',
			'value' => 5,
			'admin_label' => true
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Display post date?', 'homeshop' ),
			'param_name' => 'show_date',
			'value' => array( __( 'Yes', 'homeshop' ) => true ),
			'description' => __( 'If checked, date will be displayed.', 'homeshop' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );




vc_map( array(
	'name' => 'WP ' . __( 'Search' ),
	'base' => 'vc_wp_search',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'A search form for your site', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' )
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),
		
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );



vc_map( array(
	'name' => 'WP ' . __( 'Meta' ),
	'base' => 'vc_wp_meta',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Log in/out, admin, feed and WordPress links', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' ),
			'value' => __( 'Meta', 'homeshop' ),
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),
		
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );





vc_map( array(
	'name' => 'WP ' . __( 'Recent Comments' ),
	'base' => 'vc_wp_recentcomments',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'The most recent comments', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' ),
			'value' => __( 'Recent Comments', 'homeshop' ),
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),
		
		array(
			'type' => 'textfield',
			'heading' => __( 'Number of comments', 'homeshop' ),
			'description' => __( 'Enter number of comments to display.', 'homeshop' ),
			'param_name' => 'number',
			'value' => 5,
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );




vc_map( array(
	'name' => 'WP ' . __( 'Calendar' ),
	'base' => 'vc_wp_calendar',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'A calendar of your sites posts', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' )
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),
		
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );





vc_map( array(
	'name' => 'WP ' . __( 'Pages' ),
	'base' => 'vc_wp_pages',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Your sites WordPress Pages', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' ),
			'value' => __( 'Pages', 'homeshop' ),
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', 'homeshop' ),
			'param_name' => 'sortby',
			'value' => array(
				__( 'Page title', 'homeshop' ) => 'post_title',
				__( 'Page order', 'homeshop' ) => 'menu_order',
				__( 'Page ID', 'homeshop' ) => 'ID'
			),
			'description' => __( 'Select how to sort pages.', 'homeshop' ),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Exclude', 'homeshop' ),
			'param_name' => 'exclude',
			'description' => __( 'Enter page IDs to be excluded (Note: separate values by commas (,)).', 'homeshop' ),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );






vc_map( array(
	'name' => 'WP ' . __( 'Categories' ),
	'base' => 'vc_wp_categories',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'A list or dropdown of categories', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' ),
			'value' => __( 'Categories' ),
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),
		
		array(
			'type' => 'checkbox',
			'heading' => __( 'Display options', 'homeshop' ),
			'param_name' => 'options',
			'value' => array(
				__( 'Dropdown', 'homeshop' ) => 'dropdown',
				__( 'Show post counts', 'homeshop' ) => 'count',
				__( 'Show hierarchy', 'homeshop' ) => 'hierarchical'
			),
			'description' => __( 'Select display options for categories.', 'homeshop' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );






vc_map( array(
	'name' => 'WP ' . __( 'Archives', 'homeshop' ),
	'base' => 'vc_wp_archives',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'A monthly archive of your sites posts', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' ),
			'value' => __( 'Archives' ),
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),
		
		array(
			'type' => 'checkbox',
			'heading' => __( 'Display options', 'homeshop' ),
			'param_name' => 'options',
			'value' => array(
				__( 'Dropdown', 'homeshop' ) => 'dropdown',
				__( 'Show post counts', 'homeshop' ) => 'count'
			),
			'description' => __( 'Select display options for archives.', 'homeshop' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );







vc_map( array(
	'name' => 'WP ' . __( 'RSS' ),
	'base' => 'vc_wp_rss',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'homeshop' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Entries from any RSS or Atom feed', 'homeshop' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'homeshop' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'homeshop' )
		),
		
		array(
            "type" => "dropdown",
            "heading" => __("Select Icon", 'homeshop'),
            "param_name" => "icon",
            "description" => __('Select Icon.', 'homeshop'),
            'value' => $icon_arr
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'homeshop' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Default', 'homeshop' ) => 'default',
				esc_html__( 'Red', 'homeshop' ) => 'red',
				esc_html__( 'Green', 'homeshop' ) => 'green',
				esc_html__( 'Blue', 'homeshop' ) => 'blue',
				esc_html__( 'Orange', 'homeshop' ) => 'orange',
				esc_html__( 'Purple', 'homeshop' ) => 'purple'
			),
			'description' => esc_html__( 'Select color', 'homeshop' )
		),
		
		
		array(
			'type' => 'textfield',
			'heading' => __( 'RSS feed URL', 'homeshop' ),
			'param_name' => 'url',
			'description' => __( 'Enter the RSS feed URL.', 'homeshop' ),
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Items', 'homeshop' ),
			'param_name' => 'items',
			'value' => array(
				__( '10 - Default', 'homeshop' ) => 10,
				1,
				2,
				3,
				4,
				5,
				6,
				7,
				8,
				9,
				10,
				11,
				12,
				13,
				14,
				15,
				16,
				17,
				18,
				19,
				20
			),
			'description' => __( 'Select how many items to display.', 'homeshop' ),
			'admin_label' => true
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Options', 'homeshop' ),
			'param_name' => 'options',
			'value' => array(
				__( 'Item content', 'homeshop' ) => 'show_summary',
				__( 'Display item author if available?', 'homeshop' ) => 'show_author',
				__( 'Display item date?', 'homeshop' ) => 'show_date'
			),
			'description' => __( 'Select display options for RSS feeds.', 'homeshop' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'homeshop' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'homeshop' )
		)
	)
) );















/* remove
---------------------------------------------------------- */
vc_remove_element("vc_toggle");
vc_remove_element("vc_gallery");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_pie");




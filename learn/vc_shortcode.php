<?php 

// Buttons

if(function_exists('vc_map')){

   vc_map( array(

   "name" => esc_html__("OT Button", 'learn'),

   "base" => "button",

   "class" => "",

   "category" => 'Content',

   "icon" => "icon-st",

   "params" => array(

      array(

         "type" => "textfield",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Button Text", 'learn'),

         "param_name" => "btntext",

         "value" => "",

         "description" => esc_html__("", 'learn')

      ),
      array(

         "type" => "textfield",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Button Link", 'learn'),

         "param_name" => "btnlink",

         "value" => '',

         "description" => esc_html__("", 'learn')

      ),

      array(

         "type" => "dropdown",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Button Type", 'learn'),

         "param_name" => "type",

         "value" => array(   

                     esc_html__('Default', 'learn') => 'default',  

                     esc_html__('Primary', 'learn') => 'primary',

                     esc_html__('Info', 'learn') => 'info',

                     esc_html__('Success', 'learn') => 'success',  

                     esc_html__('Warning', 'learn') => 'warning',

                     esc_html__('Danger', 'learn') => 'danger',
                    ),

         "description" => esc_html__("", 'learn')

      ),
      array(

         "type" => "dropdown",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Button Size", 'learn'),

         "param_name" => "size",

         "value" => array( 

                     esc_html__('Regular size', 'learn') => 'default', 

                     esc_html__('Large', 'learn') => 'large',

                     esc_html__('Small', 'learn') => 'small',
                    ),

         "description" => esc_html__("", 'learn')

      ),
      array(

         "type" => "checkbox",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Not Radius ?", 'learn'),

         "param_name" => "radius",

         "description" => esc_html__("", 'learn')

      ),
    )
    ));

}


// Search Form Course

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Search Course", 'learn'),
   "base" => "searchform",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Placeholder",
         "param_name" => "place",
         "value" => "",
      ),
    )
    ));
}

// Latest Courses

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Latest Courses", 'learn'),
   "base" => "latestcourse",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Number Courses",
         "param_name" => "number",
         "value" => "",
      ),
      array(

         "type" => "dropdown",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Columns", 'learn'),

         "param_name" => "col",

         "value" => array(   

                     esc_html__('3 Columns', 'learn') => '3',
                     esc_html__('4 Columns', 'learn') => '4',
                     esc_html__('2 Columns', 'learn') => '2',
                     esc_html__('1 Columns', 'learn') => '1',
                    ),

      ),
      array(

         "type" => "textfield",

         "holder" => "div",

         "class" => "",

         "heading" => "Link Subscribe",

         "param_name" => "slink",

         "value" => "",

      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Label Button",
         "param_name" => "btn",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link Button",
         "param_name" => "link",
         "value" => "",
      ), 
    )
    ));
}

// Next Courses

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Next Courses", 'learn'),
   "base" => "nextcourse",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Number Courses",
         "param_name" => "number",
         "value" => "",
      ),
      array(

         "type" => "dropdown",

         "holder" => "div",

         "class" => "",

         "heading" => esc_html__("Columns", 'learn'),

         "param_name" => "col",

         "value" => array(   

                     esc_html__('3 Columns', 'learn') => '3',
                     esc_html__('4 Columns', 'learn') => '4',
                     esc_html__('2 Columns', 'learn') => '2',
                     esc_html__('1 Columns', 'learn') => '1',
                    ),

      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Label Button",
         "param_name" => "btn",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Link Button",
         "param_name" => "link",
         "value" => "",
      ), 
    )
    ));
}

// Pricing Table
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Pricing Table", 'learn'),
   "base" => "pricingtable",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title Pricing", 'learn'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title display in Pricing Table.", 'learn')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Price Pricing", 'learn'),
         "param_name" => "price",
         "value" => "",
         "description" => esc_html__("Price display in Pricing Table.", 'learn')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Time", 'learn'),
         "param_name" => "per",
         "value" => "",
         "description" => esc_html__("Per Month or Year display in Pricing Table.", 'learn')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Detail Pricing", 'learn'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Content Pricing Table.", 'learn')
      ),
     array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Label Button", 'learn'),
         "param_name" => "btn",
         "value" => "",
         "description" => esc_html__("Text display in button.", 'learn')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Link Button", 'learn'),
         "param_name" => "link",
         "value" => "",
         "description" => esc_html__("Link in button.", 'learn')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Featured?", 'learn'),
         "param_name" => "fea",
         "value" => "",
         "description" => esc_html__("Featured Plan.", 'learn')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Style 2?", 'learn'),
         "param_name" => "type",
         "value" => "",
         "description" => esc_html__("Plan style 2.", 'learn')
      ),
    )));
}


//Clients Logo 

if(function_exists('vc_map')){
   vc_map( array(
   "name"      => esc_html__("OT Client Logos", 'learn'),
   "base"      => "logos",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      array(
         "type" => "attach_images",
         "holder" => "div",
         "class" => "",
         "heading" => "Logo Client",
         "param_name" => "gallery",
         "value" => "",
      ), 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number", 'learn'),
         "param_name" => "number",
         "value" => "",
         "description" => esc_html__("Number Images Visible. Default: 6.", 'learn')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Carousel Speed", 'learn'),
         "param_name" => "speed",
         "value" => "",
         "description" => esc_html__("Default: 5000.", 'learn')
      )
    )));
}


// Services
if(function_exists('vc_map')){
	
	vc_map( array(
   "name" => esc_html__("OT Features", 'learn'),
   "base" => "services",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title", 'learn'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title display in box.", 'learn')
      ),
      array(
         "type" => "iconpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon Left", 'learn'),
         "param_name" => "icon",
         "value" => "",
         "description" => esc_html__("Icon left service.", 'learn')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Description", 'learn'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Detail in box.", 'learn')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Light Skin", 'learn'),
         "param_name" => "type",
         "value" => "",
      ),
    )
    ));
}


// Testimonial Slider

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Testimonials Slider", 'learn'),
   "base" => "testslide",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => "Light Text",
         "param_name" => "skin",
         "value" => "",
      ),
    )
    ));
}

// Our Team
if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Our Team", 'learn'),
   "base" => "ourteam",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Photo", 'learn'),
         "param_name" => "photo",
         "value" => "",
         "description" => esc_html__("Photo of Member.", 'learn')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Name", 'learn'),
         "param_name" => "name",
         "value" => "",
         "description" => esc_html__("Name of Member.", 'learn')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Job", 'learn'),
         "param_name" => "job",
         "value" => "",
         "description" => esc_html__("Job of Member.", 'learn')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Phone", 'learn'),
         "param_name" => "phone",
         "value" => "",
         "description" => esc_html__("Job of Member.", 'learn')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Description", 'learn'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("Description of Member.", 'learn')
      ),
      array(
         "type" => "vc_link",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Social 1", 'learn'),
         "param_name" => "soc1",
         "value" => "",
         "description" => esc_html__("Link and icon.", 'learn')
      ),
      array(
         "type" => "vc_link",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Social 2", 'learn'),
         "param_name" => "soc2",
         "value" => "",
         "description" => esc_html__("Link and icon.", 'learn')
      ),
      array(
         "type" => "vc_link",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Social 3", 'learn'),
         "param_name" => "soc3",
         "value" => "",
         "description" => esc_html__("Link and icon.", 'learn')
      ),
      array(
         "type" => "vc_link",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Social 4", 'learn'),
         "param_name" => "soc4",
         "value" => "",
         "description" => esc_html__("Link and icon.", 'learn')
      ),
      array(
         "type" => "vc_link",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Link", 'learn'),
         "param_name" => "btn",
         "value" => "",
         "description" => esc_html__("Link to profile.", 'learn')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => "Style 2",
         "param_name" => "type",
         "value" => "",
      ),
    )
    ));
}


// FAQs

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT FAQ", 'learn'),
   "base" => "otfaqs",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Question",
         "param_name" => "question",
         "value" => "",
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => "Answer",
         "param_name" => "content",
         "value" => "",
      ),
    )
    ));
}


// Photo & Video Gallery

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Photo, Video Gallery", 'learn'),
   "base" => "pavgallery",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => "Photo or Thumbnail Video",
         "param_name" => "image",
         "value" => "",
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => "Video Gallery?",
         "param_name" => "type",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Video Link",
         'dependency'  => array( 'element' => 'type', 'value' => array( 'true' ) ),
         "param_name" => "video",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Title",
         "param_name" => "title",
         "value" => "",
      ),
    )
    ));
}

// Get Directions

if(function_exists('vc_map')){
   
   vc_map( array(
   "name" => esc_html__("OT Get Directions", 'learn'),
   "base" => "getdirect",
   "class" => "",
   "category" => 'Content',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "End Point Address",
         "param_name" => "address",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => "Label Button",
         "param_name" => "btn",
         "value" => "",
      ),
    )
    ));
}

//Google Map

if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Google Map", 'learn'),
   "base" => "ggmap",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(  
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("ID Map", 'learn'),
         "param_name" => "idmap",
         "value" => "map-canvas",
         "description" => esc_html__("Please enter ID Map, map-canvas1, map-canvas2, map-canvas3, ..etc", 'learn')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Height Map", 'learn'),
         "param_name" => "height",
         "value" => 320,
         "description" => esc_html__("Please enter number height Map, 300, 350, 380, ..etc. Default: 420.", 'learn')
      ),    
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Latitude", 'learn'),
         "param_name" => "lat",
         "value" => -37.817,
         "description" => esc_html__("Please enter http://www.latlong.net/ google map", 'learn')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Longitude", 'learn'),
         "param_name" => "long",
         "value" => 144.962,
         "description" => esc_html__("Please enter http://www.latlong.net/ google map", 'learn')

      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Zoom Map", 'learn'),
         "param_name" => "zoom",
         "value" => 13,
         "description" => esc_html__("Please enter Zoom Map, Default: 15", 'learn')
      ),
    array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__("Map color", 'learn'),
            "param_name" => "mapcolor",
            "value" => '', //Default White color
            "description" => esc_html__("Choose Map color", 'learn')
         ),
     
    array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => "Icon Map marker",
         "param_name" => "icon",
         "value" => "",
         "description" => esc_html__("Icon Map marker, 47 x 68", 'learn')
      ),  
       
    )));

}

?>
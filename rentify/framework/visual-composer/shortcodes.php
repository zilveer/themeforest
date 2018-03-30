<?php

/*-------------------------------------------------------------------------
 RENTIFY OUR OFFER SHORTCODE START
------------------------------------------------------------------------- */


function rentify_about_us_offer_shortcode_with_vc(){
    vc_map( 

      array(

          "name" => __( "Rentify Listing Item", "rentify" ),
          "base" => "rentify_about_offer_list",
          "class" => "",
          "content_element" => true,
          "as_child" => array('only' => 'rentify_about_offer_wrapper'),
          "category" => __( "Renify ShortcodesRenify Shortcodes", "rentify"),
          
          "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __( "Listing Item Icon (font-awesome)", "rentify" ),
                "param_name" => "font_awesome_icon",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __( "Item Description", "rentify" ),
                "param_name" => "offer_name",              
            ),
                     
          )
      ) 
    );  


    vc_map( 
      array(
        "name" => __( "Rentify About Us Offer", "rentify" ),
        "base" => "rentify_about_offer_wrapper",
        "class" => "",
        "as_parent" => array('only' => 'rentify_about_offer_list'), 
        "content_element" => true,
        "show_settings_on_create" => false,
        "category" => __( "Renify Shortcodes", "rentify"),          
        "params" => array(
          array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Heading Title", "rentify" ),
            "param_name" => "heading_title",              
          ), 
          array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Choose Image Alignment", "sb" ),
            "param_name" => "image_align",
            "value" => array(
                'Choose..'=> '',
                'Left' => 'left',
                'Right' => 'right',              
              ),                         
           ),
           array(
              "type" => "attach_image",
              "holder" => "div",
              "class" => "",
              "heading" => __( "Offer Image", "sb" ),
              "param_name" => "image_id",              
          ), 
          array(
              "type" => "colorpicker",
              "holder" => "div",
              "class" => "",
              "heading" => __( "Choose background color", "sb" ),
              "param_name" => "bg_color",
          ),                  
        )
      ) 
    );


    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Rentify_About_Offer_Wrapper extends WPBakeryShortCodesContainer {
        }
    }

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Rentify_About_Offer_List extends WPBakeryShortCode {
        }
    }

}
add_action( 'vc_before_init', 'rentify_about_us_offer_shortcode_with_vc' );


/*-------------------------------------------------------------------------
 RENTIFY OUR OFFER SHORTCODE END
------------------------------------------------------------------------- */


function rentify_listing_info_shortcode_with_vc(){

    vc_map( 

      array(

          "name" => __( "Rentify Listing Item", "rentify" ),
          "base" => "rentify_listing_items",
          "class" => "",
          "content_element" => true,
          "as_child" => array('only' => 'rentify_listing_info_wrapper'),
          "category" => __( "Renify ShortcodesRenify Shortcodes", "rentify"),
          
          "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __( "Listing Item Icon (font-awesome)", "rentify" ),
                "param_name" => "font_awesome_icon",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __( "Item Description", "rentify" ),
                "param_name" => "item_desc",              
            ),
                     
          )
      ) 
    );  


    vc_map( 
    array(
      "name" => __( "Rentify Listing Info", "rentify" ),
      "base" => "rentify_listing_info_wrapper",
      "class" => "",
      "as_parent" => array('only' => 'rentify_listing_items'), 
      "content_element" => true,
      "show_settings_on_create" => false,
      "category" => __( "Renify Shortcodes", "rentify"),          
      "params" => array(
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Heading Title", "rentify" ),
          "param_name" => "heading_title",              
        ),                    
      )
    ) 
    );


    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Rentify_Listing_Info_Wrapper extends WPBakeryShortCodesContainer {
        }
    }

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Rentify_Listing_Items extends WPBakeryShortCode {
        }
    }

}
add_action( 'vc_before_init', 'rentify_listing_info_shortcode_with_vc' );


/*-------------------------------------------------------------------------
 CAR SEARCH FORM SHORTCODE FOR RENTIFY START
------------------------------------------------------------------------- */

add_action( 'vc_before_init', 'rentify_intergrate_car_rental_system' );

function rentify_intergrate_car_rental_system() {
  vc_map( 
    array(
      "name" => __( "Rentify - Car Rental Systems", "rentify" ),
      "base" => "car_rental_system",
      "class" => "",
      "category" => __( "Renify Shortcodes", "rentify"),       
      "params" => array(
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Choose Your Shortcode Type", "rentify" ),
            "param_name" => "display",
            "value" => array(
                'Car Search Form' => 'search',
                'Display Car Slider' => 'slider',
                'Car Listings' => 'list',
                'Car Rental Pricing System' => 'price_table',
                'Car Extras Pricing System' => 'extras_price_table',
                'Edit Existing Reservation' => 'edit',
                'Car Availability Calendar' => 'calendar',
                'Car Extras Availability Calendar' => 'extras_calendar',
              ),                         
         ),
        )
      )  
    );
}

/*-------------------------------------------------------------------------
 CAR SEARCH FORM SHORTCODE FOR RENTIFY START
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
 START PREAMBLE SHORTCODE
------------------------------------------------------------------------- */

add_action( 'vc_before_init', 'rentify_preamble' );

function rentify_preamble() {
   vc_map( array(
      "name" => __( "Rentify Preamble", "rentify" ), 
      "base" => "rentify_preamble", 
      "category" => __( "Renify Shortcodes", "rentify"),       
      "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "CTA Content", "rentify" ),
            "param_name" => "content",
            "value" => __( "", "rentify" ),
            "description" => __( "write your own formated content", "rentify" )
        ), 
      )
    ) );
}
 

/*-------------------------------------------------------------------------
 END PREAMBLE SHORTCODE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
 START PARTNER SHORTCODE INTIGRATE IN VC
------------------------------------------------------------------------- */


add_action( 'vc_before_init', 'rentify_our_partner' );

function rentify_our_partner() {
   vc_map( array(
      "name" => __( "Rentify Partners", "rentify" ), 
      "base" => "rentify_our_partner", 
      "category" => __( "Renify Shortcodes", "rentify"),       
      "params" => array(
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Choose background color", "rentify" ),
            "param_name" => "bg_color",
        ),
      )
   ) );
}


/*-------------------------------------------------------------------------
 END PARTNER SHORTCODE INTIGRATE IN VC
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
 End Visual Composer TWITTER Blockquotes Testimonial  SHORTCODE
------------------------------------------------------------------------- */
add_action( 'vc_before_init', 'rentify_company_stats_counter_with_vc' );

function rentify_company_stats_counter_with_vc() {
   vc_map( array(
      "name" => __( "Renify Company Statistics Counter", "rentify" ), //This name will be shown in the visual composer pop up.
      "base" => "rentify_company_stats_counter", // name of the shortcode. 
      "class" => "",
      "category" => __( "Renify Shortcodes", "rentify"), // in which tab it will appeared? there are several tabs: content, social etc.
      "params" => array(
          array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "active",
            "heading" => __( "No Of Company Statistics Show", "rentify" ),
            "param_name" => "no_of_info_show",
            "value" => __( "4", "rentify" ),
            "description" => __( "No of Testimonial to show.", "rentify" )
          ),
          array(
              "type" => "colorpicker",
              "holder" => "div",
              "class" => "",
              "heading" => __( "Choose background color", "sb" ),
              "param_name" => "bg_color",
          ), 
          array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Background Image", "rentify" ),
            "param_name" => "image_id",              
         ),

      )
   ) );
}


/*-------------------------------------------------------------------------
 START Visual Composer Construction Tons of Feature SHORTCODE
------------------------------------------------------------------------- */


add_action( 'vc_before_init', 'construction_service_with_visual' );

function construction_service_with_visual() {
   vc_map( array(
      "name" => __( "Rentify Company Feature Services", "rentify" ),
      "base" => "rentify_company_feature_services",
      "class" => "",
      "category" => __( "Renify Shortcodes", "rentify"),
      "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "active",
            "heading" => __( "Heading Title", "rentify" ),
            "param_name" => "title",            
         ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "active",
            "heading" => __( "Heading Subtitle", "rentify" ),
            "param_name" => "subtitle",            
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "active",
            "heading" => __( "No of feature services show", "rentify" ),
            "param_name" => "no_of_info_show",            
         ),
         array(
              "type" => "colorpicker",
              "holder" => "div",
              "class" => "",
              "heading" => __( "Choose background color", "sb" ),
              "param_name" => "service_bg_color",
          ), 
          array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Background Image", "rentify" ),
            "param_name" => "image_id",              
         ),
      )
   ) );
}

/*-------------------------------------------------------------------------
 End Visual Composer Construction Tons of Feature SHORTCODE
------------------------------------------------------------------------- */
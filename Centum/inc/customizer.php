<?php
/**
 * Centum Theme Customizer
 *
 * @package Centum
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function centum_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'centum_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function centum_customize_preview_js() {
	wp_enqueue_script( 'centum_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'centum_customize_preview_js' );



function phantom_generate_typo_css($typo){
   if($typo){
        $ot_google_fonts = get_theme_mod( 'ot_google_fonts', array() );
        foreach ($typo as  $key => $value) {
            if(isset($value) && !empty($value)) {
                if($key=='font-color') { $key = "color"; }
                if($key=='font-family') { 
                  if(in_array($value,array('arial','georgia','helvetica','palatino','tahoma','times','trebuchet','verdana'))) {
                      $families = array(
                        'arial'     => 'Arial',
                        'georgia'   => 'Georgia',
                        'helvetica' => 'Helvetica',
                        'palatino'  => 'Palatino',
                        'tahoma'    => 'Tahoma',
                        'times'     => '"Times New Roman", sans-serif',
                        'trebuchet' => 'Trebuchet',
                        'verdana'   => 'Verdana'
                      );
                      $value = $families[$value];  
                  } else {                  
                    $value = $ot_google_fonts[$value]['family']; 
                  }
                } 
                echo $key.":".$value.";";
                
            }
        }
    }
}


add_action('wp_head', 'custom_stylesheet_content');

function custom_stylesheet_content() {
 $ltopmar = ot_get_option( 'logo_top_margin' );
 $lbotmar = ot_get_option( 'logo_bottom_margin' );
 $taglinemar = ot_get_option( 'tagline_margin' );
 $logofont = ot_get_option('incr_logo_typo',array());
 $bodytypo = ot_get_option( 'centum_body_font');
 $menutypo = ot_get_option( 'centum_menu_font');
 $logotypo = ot_get_option( 'centum_logo_font');
 $headers1typo = ot_get_option( 'centum_headers_font');
 $headers2typo = ot_get_option( 'centum_headers2_font');
 $headers3typo = ot_get_option( 'centum_headers3_font');
 $headers4typo = ot_get_option( 'centum_headers4_font');
 $headers5typo = ot_get_option( 'centum_headers5_font');
 $headers6typo = ot_get_option( 'centum_headers6_font');
 $breakpoint = ot_get_option('pp_menu_breakpoint','767');
 global $post;


 ?>
 <style type="text/css">

  body { <?php phantom_generate_typo_css($bodytypo); ?> }
  h1{ <?php phantom_generate_typo_css($headers1typo); ?> }
  h2{ <?php phantom_generate_typo_css($headers2typo); ?> }
  h3{ <?php phantom_generate_typo_css($headers3typo); ?> }
  h4{ <?php phantom_generate_typo_css($headers4typo); ?> }
  h5{ <?php phantom_generate_typo_css($headers5typo); ?> }
  h6{ <?php phantom_generate_typo_css($headers6typo); ?> }
  h2.logo a,
  h1.logo a { <?php phantom_generate_typo_css($logotypo); ?> }
  #navigation ul li a {  <?php phantom_generate_typo_css($menutypo); ?>  }
  #logo {
    <?php if ( isset( $ltopmar[0] ) && $ltopmar[1] ) { echo 'margin-top:'.$ltopmar[0].$ltopmar[1].';'; } ?>
    <?php if ( isset( $lbotmar[0] ) && $lbotmar[1] ) { echo 'margin-bottom:'.$lbotmar[0].$lbotmar[1].';'; } ?>
  }

  #tagline {
    <?php if ( isset( $taglinemar[0] ) && $taglinemar[1] ) { echo 'margin-top:'.$taglinemar[0].$taglinemar[1].';'; } ?>
  }
  @media only screen and (max-width: 767px) {
    #tagline { margin-top: 5px;}
  }
  #header {
    min-height: <?php echo ot_get_option( 'centum_minhh','100' );?>px;
  }

  @media only screen and (max-width: <?php echo $breakpoint; ?>px) {
        #navigation {
          float: none;
        }
        
        .js .selectnav {
          display: block;
        }
        .js #nav,
        #navigation .dropmenu > li#search-in-menu,
        #navigation ul li a {
          display: none;
        }
    }
<?php
  if(ot_get_option('centum_blog_icons') =="disable") { ?>
    .post-icon { display: none; }
    .post-content { margin: 22px 0 0; }
    <?php }

    if(ot_get_option('color_on') =="yes") { ?>
      #footer {
        background: <?php echo ot_get_option( 'f_color' ); ?>;
        color:  <?php echo ot_get_option( 'f_text_color' ); ?>;
      }
      #footer-bottom {
        background: <?php echo ot_get_option( 'bgf_color' ); ?>;
        color:  <?php echo ot_get_option( 'bgf_text_color' ); ?>;
      }

      #footer h5 {
        border-bottom: 1px solid <?php echo ot_get_option( 'f_header_border_color' ); ?>;
        color: <?php echo ot_get_option( 'f_header_color' ); ?>;
      }
<?php } ?>

<?php  if(ot_get_option('incr_logofonts_on') =="yes") { ?>
      h2.logo,
      h1.logo {
        font-family: <?php echo str_replace("+", " ",  $logofont['font-family']); ?>;
      }
      h2.logo a,
      h1.logo a {
        color: <?php echo $logofont['font-color']; ?>;
        font-family: <?php  echo str_replace("+", " ",  $logofont['font-family']); ?>;
        font-style: <?php echo $logofont['font-style']; ?>;
        font-variant: <?php echo $logofont['font-variant']; ?>;
        font-weight: <?php echo $logofont['font-weight']; ?>;
        font-size: <?php echo $logofont['font-size']; ?>;
      }
<?php }

    if (ot_get_option('incr_main_color') != '#2da0ce') { ?>
       #backtotop a:hover,.feature-circle.blue,.prev:hover, .next:hover,.mr-rotato-prev:hover, .mr-rotato-next:hover { background-color: <?php echo ot_get_option('incr_main_color'); ?>; }
<?php }

    if (ot_get_option('incr_menuborder_color') != '#555555') {?>

    <?php } if (ot_get_option('incr_headers_color') != '#444444') { ?>
      h1, h2, h3, h4, h5, h6 {
        color:  <?php echo ot_get_option('incr_headers_color'); ?>
      }
    <?php } if (ot_get_option('incr_linkhover_color') != '#888888') { ?>
     a:hover, a:focus { color: <?php echo ot_get_option('incr_linkhover_color'); ?>; }

    <?php } if (ot_get_option('incr_link_color') != '#3f8faf') {?>
      a, a:visited { color:  <?php echo ot_get_option('incr_link_color'); ?>; }

    <?php }

    $bodysize = ot_get_option('incr_body_size');
    if ($bodysize) {  ?>
        body { font-size: <?php echo $bodysize[0].$bodysize[1]; ?> }
    <?php }


     $custom_main_color = get_theme_mod('centum_main_color','#72b626'); ?>
      #navigation ul li a:hover,
      #navigation ul li:hover > a,

      #bolded-line,

      .button.gray:hover,
      .button.light:hover,
      .shipping-calculator-form button.button:hover,
      table.cart-table .cart-btns input:hover,
      table.cart-table .cart-btns a,
      .stacktable.small-only .cart-btns a,
      .price_slider_wrapper .ui-slider-horizontal .ui-slider-range,
      .button.color,
      .checkout-button,
      .wc-proceed-to-checkout a.button.wc-forward,
      .button.checkout.wc-forward,
      .onsale,
      input[type="submit"] {
        background: <?php echo $custom_main_color;?>;
      }
      .blog-sidebar .widget #twitter-blog li a,
      a, a:hover,
      .testimonials-author,
      .shop-item span.price,
      .list-1 li:before, .list-2 li:before, .list-3 li:before, .list-4 li:before,
      a.post-entry {
        color: <?php echo $custom_main_color;?>
      }

      #navigation > div > ul > li.current-menu-item > a,
      #navigation > div > ul > li.current_page_parent > a,
      .pricing-table .color-3 h3, .color-3 .sign-up,
      #home-slider.rsDefault .rsArrowIcn:hover,
      .linking button.button,
      .slider .tp-leftarrow:hover,
      .slider .tp-rightarrow:hover,
      a.button.checkout.wc-forward:hover, 
      a.button.wc-forward:hover, 
      body .widget_price_filter .price_slider_amount button.button:hover, 
      .cart-btn .button.hovered, 
      .button.wc-backward:hover, 
      .magazine-lead figcaption:hover .button, 
      .wishlist_table .add_to_cart.button:hover, 
      .cart-btn .button:hover,
      .featured-box:hover > .circle,
      .featured-box:hover > .circle span,
      #home-slider.rsDefault .rsArrowIcn:hover, #portfolio-slider.rsDefault .rsArrowIcn:hover,
      #scroll-top-top a,
      .quantity .plus:hover,#content .quantity .plus:hover,.quantity .minus:hover,#content .quantity .minus:hover,
      .infobox,
      .post-icon {
        background-color:<?php echo $custom_main_color; ?>;
      }

      .mr-rotato-prev:hover,
      .mr-rotato-next:hover,
      .pagination .current:hover,
      .pagination a:hover, 
      .woocommerce-pagination a:hover,
      .widget_price_filter .button:hover, 
      span.page-numbers.current,
      li.current,
      .tagcloud a:hover {
        background-color: <?php echo $custom_main_color; ?>;
        border-color: <?php echo $custom_main_color; ?>;
      }

      #filters a:hover,
      .option-set .selected,
      .wp-pagenavi .current,
      .pagination .current,
      #portfolio-navi a:hover {
        background-color: <?php echo $custom_main_color; ?> !important;
        border: 1px solid <?php echo $custom_main_color; ?> !important;
      }
      .pricing-table .color-3 h4 {
        background-color:<?php echo $custom_main_color; ?>;
        opacity:0.8
      }

       <?php
        $custom_overlay_color = get_theme_mod('centum_overlay_color','#000000');
        $custom_overlay_opacity = get_theme_mod('centum_overlay_opacity','0.7');
       ?>
       .image-overlay-link, .image-overlay-zoom {
        background-color: rgba(<?php echo hex2RGB($custom_overlay_color, true) ?>,<?php echo $custom_overlay_opacity?>);
       }

 <?php $custom_menu_bg = get_theme_mod('centum_nav_bg','#303030');
    if($custom_menu_bg != '#303030') { ?>
      #navigation ul li a { background: none; }
      #navigation { background-color:<?php echo $custom_menu_bg; ?>; }
<?php } ?>



 <?php $custom_footer_bg = get_theme_mod('centum_footer_bg','#303030');
 if($custom_footer_bg != '#303030') { ?>
      #footer { background: <?php echo $custom_footer_bg; ?>; }
      #footer .headline, .footer-headline { background: none }
      #footer .headline h4, .footer-headline h4 { background-color:  <?php echo $custom_footer_bg; ?>; }
      #footer-bottom {
          border-top: 0px;
      }
<?php } ?>

  <?php
  $catalogmode = ot_get_option('pp_woo_catalog','off');
  if ($catalogmode == "on") { ?>
      .product-button,
      .add_to_cart_button,
      #cart { display: none;}

  <?php } ?>

      <?php echo ot_get_option( 'incr_custom_css' );  ?>
      </style>
      <?php

}   //eof custom_stylesheet_content




function custom_js() {
 ?>
 <script type="text/javascript">
 <?php echo ot_get_option( 'incr_analytics' );   ?>
 </script>
 <?php
}


//add_action('wp_footer', 'custom_js');
?>

<?php
/**
 * CookingPress Theme Customizer
 *
 * @package CookingPress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cookingpress_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  $wp_customize->add_setting( 'cp_tagline_switch', array(
    'default'  => 'show',
    'transport' => 'refresh'
    ));
  $wp_customize->add_control( 'cp_tagline_switch', array(
    'settings' => 'cp_tagline_switch',
    'label'    => __( 'Display Tagline','cookingpress' ),
    'section'  => 'title_tagline',
    'type'     => 'select',
    'choices'    => array(
      'show' => 'Show',
      'hide' => 'Hide',
      )
    ));

  $wp_customize->add_section( 'cp_layout_settings', array(
    'title'          => __('Layout','cookingpress'),
    'priority'       => 36,
    ));

  $wp_customize->add_setting( 'cp_layout_style', array(
    'default'  => 'light',
    'transport' => 'refresh'
    ));
  $wp_customize->add_control( 'cp_layout_choose', array(
    'label'    => __('Select layout style','cookingpress'),
    'section'  => 'cp_layout_settings',
    'settings' => 'cp_layout_style',
    'type'     => 'select',
    'choices'    => array(
      'default' => 'Default',
      'boxed' => 'Boxed',
     /* 'minimal' => 'Minimal',*/
      )
    ));

/*   $wp_customize->add_setting( 'cp_main_color', array(
    'default'        => '#73b819',
    'transport' =>'postMessage'
    ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cp_main_color', array(
    'label'   => __('Color Setting','purethemes'),
    'section' => 'colors',
    'settings'   => 'cp_main_color',
    )));*/

  $wp_customize->add_section( 'cp_footer_settings', array(
    'title'          => __('Footer','cookingpress'),
    'priority'       => 36,
    ));
  $wp_customize->add_setting( 'cp_footer_bg_img', array(
    'default'  => get_template_directory_uri() . '/images/pattern.jpg',
    'transport' => 'refresh'
    ));
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'upload_images', array(
    'label'        => __( 'Image Upload', 'cookingpress' ),
    'section'    => 'cp_footer_settings',
    'settings'   => 'cp_footer_bg_img',
    ) ) );

}
add_action( 'customize_register', 'cookingpress_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cookingpress_customize_preview_js() { ?>
<script type="text/javascript">
( function( $ ){
  function hex2rgb(hex) {
    if (hex[0]=="#") hex=hex.substr(1);
    if (hex.length==3) {
      var temp=hex; hex='';
      temp = /^([a-f0-9])([a-f0-9])([a-f0-9])$/i.exec(temp).slice(1);
      for (var i=0;i<3;i++) hex+=temp[i]+temp[i];
    }
  var triplets = /^([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})$/i.exec(hex).slice(1);
  return {
    red: parseInt(triplets[0],16),
    green: parseInt(triplets[1],16),
    blue: parseInt(triplets[2],16)
  }
}


wp.customize('cp_tagline_switch',function( value ) {
  value.bind(function(to) {
    if(to === 'hide') { $('.site-description').hide(); } else { $('.site-description').show(); }
  });
});




//.image-overlay-link, .image-overlay-zoom
} )( jQuery )
</script>
<?php
}
add_action( 'customize_preview_init', 'cookingpress_customize_preview_js' );



function pp_generate_typo_css($typo){
    if($typo){
        $ot_google_fonts = get_theme_mod( 'ot_google_fonts', array() );
        foreach ($typo as  $key => $value) {
            if(isset($value) && !empty($value)) {
                if($key=='font-color') { $key = "color"; }
                if($key=='font-family') { $value = $ot_google_fonts[$value]['family']; } 
                echo $key.":".$value.";";
                
            }
        }
    }
}



function custom_stylesheet_content() {
$ltopmar = ot_get_option( 'pp_logo_top_margin' );
$lbotmar = ot_get_option( 'pp_logo_bottom_margin' );
$menutopmar = ot_get_option( 'pp_menu_top_margin' );
   
$bodytypo = ot_get_option( 'cookingpress_body_font');
$menutypo = ot_get_option( 'cookingpress_menu_font');
$logotypo = ot_get_option( 'cookingpress_logo_font');
$taglinetypo = ot_get_option( 'cookingpress_tagline_font');
$slidertypo = ot_get_option( 'cookingpress_slider_font');
$headerstypo = ot_get_option( 'cookingpress_headers_font');

$footerbg = get_theme_mod('cp_footer_bg_img',get_template_directory_uri() . '/images/pattern.jpg');
$maincolor = get_theme_mod('cp_main_color','#dddddd');

?>
<style type="text/css">
body { <?php pp_generate_typo_css($bodytypo); ?> }
h1, h2, h3, h4, h5, h6  { <?php pp_generate_typo_css($headerstypo); ?> }
header .site-branding a { <?php pp_generate_typo_css($logotypo); ?> }
header .site-branding span { <?php pp_generate_typo_css($taglinetypo); ?> }
#site-navigation div.menu ul li a, #site-navigation ul.menu li a {  <?php pp_generate_typo_css($menutypo); ?>  }
.rsDefault  {  <?php pp_generate_typo_css($slidertypo); ?>  }

#header { height: <?php echo ot_get_option('pp_header_height',86);?>px; }

.site-title {
<?php if ( isset( $ltopmar[0] ) && $ltopmar[1] ) { echo 'margin-top:'.$ltopmar[0].$ltopmar[1].';'; } ?>
<?php if ( isset( $lbotmar[0] ) && $lbotmar[1] ) { echo 'margin-bottom:'.$lbotmar[0].$lbotmar[1].';'; } ?>
}
#site-navigation {
<?php if ( isset( $menutopmar[0] ) && $menutopmar[1] ) { echo 'margin-top:'.$menutopmar[0].$menutopmar[1].';'; } ?>
}

.mainfooter { background: url('<?php echo $footerbg; ?>')}

<?php echo ot_get_option( 'pp_custom_css' );  ?>
</style>
<?php
}   //eof custom_stylesheet_content
add_action('wp_head', 'custom_stylesheet_content');
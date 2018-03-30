<?php get_template_part('templates/head'); ?>

<?php
$boxed_div_open ="";
$boxed_div_close ="";
$boxed_class ="";
$themo_body_classes[] = false;
if ( function_exists( 'ot_get_option' ) ) {
  $full_width = ot_get_option( 'themo_wide_layout' );
  if ($full_width == 'off'){ 
  	$boxed_div_open = '<div id="boxed">';
	$boxed_div_close = '</div><!-- #boxed -->';
    $themo_body_classes[] = 'boxed-mode';
  }
}
?>

<body <?php body_class($themo_body_classes); ?>>
<!-- Preloader Start -->
<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>
<!-- Preloader End -->
<?php
//-----------------------------------------------------
// Boxed BG Image / stretched via backstretch js
//-----------------------------------------------------
global $body_backstretch_js;
if(isset($body_backstretch_js) && $body_backstretch_js > "" ){
  echo "\n<!-- Theme Custom JS for Full BG image via backstretch JS -->\n<script>\n";
  echo "jQuery(document).ready(function($) {\n";
  echo "\"use strict\"\n";
  echo sanitize_text_field($body_backstretch_js) ; // custom js sanitized earlier via sanitize_text_field()
  echo "});\n";
  echo "</script>\n";
}

//-----------------------------------------------------
// demo options
//-----------------------------------------------------
$is_demo = false;
if($is_demo){
	wp_register_script('demo_options', get_template_directory_uri() . '/demo/js/demo_options.js', array(), 1, true);
	wp_enqueue_script('demo_options');
    include( get_template_directory() . '/demo/demo_options.php');
}
?>

<?php
// jquery Animation Variable
global $themo_animation;
?>

<?php echo wp_kses_post($boxed_div_open); // Pre sanitized ?>

  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>
  <div class="wrap" role="document">
  
    <div class="content">

        <?php include roots_template_path(); ?>

    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>

<?php echo wp_kses_post($boxed_div_close); ?>

<?php 
//-----------------------------------------------------
// CSS3 Animation
//-----------------------------------------------------
themo_print_animation_js(); 
?>

</body>
</html>

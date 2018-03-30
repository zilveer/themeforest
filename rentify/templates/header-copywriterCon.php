<!doctype html>
<html <?php language_attributes(); ?> >

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php wp_title('|', true, 'right'); ?> </title>

<?php $rentify_option_data = rentify_option_data(); ?>

<?php if ( ! function_exists( 'has_site_icon' )|| !has_site_icon() ) {?>

      <!-- favicon  -->
    <?php if(isset($rentify_option_data['sb-favicon'])&& !empty($rentify_option_data['sb-favicon'])): ?>
    <link rel="shortcut icon" href="<?php echo esc_url($rentify_option_data['sb-favicon']['url']); ?>" type="image/x-icon" />
    <?php endif; ?>


    <?php if(isset($rentify_option_data['sb-favicon-iphone'])&& !empty($rentify_option_data['sb-favicon-iphone'])): ?>
    <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url($rentify_option_data['sb-favicon-iphone']['url']); ?>">
    <?php endif; ?>


    <?php if(isset($rentify_option_data['sb-favicon-ipad'])&&!empty($rentify_option_data['sb-favicon-ipad'])): ?>
    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url($rentify_option_data['sb-favicon-ipad']['url']); ?>">
    <?php endif; ?>

    <!-- end of favicon  -->
  
<?php } ?>    

  <?php wp_head(); ?>

</head>



<body <?php body_class(); ?> >

<!-- Start mobile sidebar -->

 <div class="uou-block-11a">
        <h5 class="title">Menu</h5>
        <a href="#" class="mobile-sidebar-close">&times;</a>
          
          <?php get_template_part('templates/header','menuMobile');?>

        <hr>
    
        <?php
          get_search_form();
         ?>

</div>
    <!-- end .uou-block-11a -->

<div id="main-wrapper">

  <div class ="copywrite-header">
    <div class = "demo-toolbar">
        <?php get_template_part('templates/topS/header','topbarChoose');?>
        <?php get_template_part('templates/headerS/header','choose');?>

    </div>
  </div>

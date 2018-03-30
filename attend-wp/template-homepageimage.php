<?php  
/* 
Template Name: Home-ImageFullWidth
*/  
?>

<?php get_header(); ?> 

<?php if ( get_theme_mod( 'cr3ativ_conference_homeimg1' ) ) : ?>

<?php $homebgrnd = ( get_theme_mod( 'cr3ativ_conference_homeimg1' ) ); ?>

<?php else : $homebgrnd =  esc_url_raw( get_stylesheet_directory_uri() . '/img/home_hero.jpg' ); ?>

<?php endif; ?>

<!-- Start of main image home -->
<div class="main_image_home big" style="background: url('<?php echo $homebgrnd; ?>') no-repeat scroll center center transparent; background-size:cover;height: 100%;">

    <!-- Start of home centered -->
    <div class="home_centered">

    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('home') ) : else : ?>		
    <?php endif; ?>

    </div>
    <!-- End of home centered -->

</div>
<!-- End of main image home -->

<?php get_footer('home'); ?>
<?php  
/* 
Template Name: Home-VideoFullWidth
*/  
?>

<?php get_header(); ?> 

<?php if ( get_theme_mod( 'cr3ativ_conference_videomp4' ) ) : ?>

<?php $videomp4 = ( get_theme_mod( 'cr3ativ_conference_videomp4' ) ); ?>

<?php $videowebm = ( get_theme_mod( 'cr3ativ_conference_videowebm' ) ); ?>

<?php $homebgrnd = ( get_theme_mod( 'cr3ativ_conference_homeimg1' ) ); ?>

<?php else : ?>

<?php endif; ?>

<!-- Start of video overlay -->
<div id="video_overlay">

    <video id="video_background" style="background: url('<?php echo $homebgrnd; ?>') no-repeat scroll center center transparent; background-size:cover;" poster="img/bg-pixel.png" autoplay loop muted>
        <source src="<?php echo ($videowebm);?>" type="video/webm">
        <source src="<?php echo ($videomp4);?>" type="video/mp4">
    </video>
    
</div>
<!-- End of video overlay -->

<!-- Start of home centered -->
<div class="home_centered">

    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('home') ) : else : ?>		
    <?php endif; ?>

</div>
<!-- End of home centered -->

<?php get_footer('home'); ?>

<!-- No Slider -->
<!--Intro-->
<section class="idy_noslider idy_box idy_image_bck idy_white_txt idy_fixed2 <?php if( !is_category() ){echo('idy_category');} ?>" data-stellar-background-ratio="0.4" data-color="#ec0201" data-image="<?php echo esc_attr($noslider_image); ?>" >


<div class="container">
    <h1 class="idy_lettering" data-0="opacity:1" data-top-bottom="opacity:0"><?php the_title();?></h1>
    <div class="idy_breadcrumbs"><?php if( function_exists('fw_ext_breadcrumbs') ) { fw_ext_breadcrumbs('/'); } ?></div>
</div>        
</section>
<!-- Intro End -->
<!-- No Slider End-->



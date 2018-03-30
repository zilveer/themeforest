<?php
// Template Name: Page Shop



get_header(); 

$sidebar_position_mobile = get_option('sense_settings_sidebar_mobile');


$sidebar_id = get_meta_option('custom_sidebar');
$sidebar_position = get_meta_option('sidebar_position_meta_box');
?>
   
   
   
   
       <?php 
	if( $sidebar_position != 'full'  && $sidebar_position_mobile == 'top' ) {
		if( $sidebar_position == 'left' ) { ?>
		<aside class="sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } if( $sidebar_position == 'right' ) { ?>
		<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } ?>
		
		<?php mm_sidebar('blog',$sidebar_id);?>
		</aside>
	<?php } ?>
   
   
   
   
   
   
   
   <?php if( $sidebar_position == 'left' ) { ?>
	<section class="main-content s-left col-lg-9 col-md-9 col-sm-9">
	<?php }
	if( $sidebar_position == 'right' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9">
	<?php }
	if( $sidebar_position == 'full' ) { ?>
	<section class="main-content col-lg-12 col-md-12 col-sm-12">
	<?php }  ?>
   
   
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   <?php the_content(); ?>
   <?php endwhile; ?>
   
    </section>
	<!-- /Main Content -->
   
   
   <?php 
	if( $sidebar_position != 'full'  && $sidebar_position_mobile != 'top' ) {
		if( $sidebar_position == 'left' ) { ?>
		<aside class="sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } if( $sidebar_position == 'right' ) { ?>
		<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } ?>
		
		<?php mm_sidebar('blog',$sidebar_id);?>
		</aside>
	<?php } ?>
   
   
   
   

<?php get_footer(); ?>
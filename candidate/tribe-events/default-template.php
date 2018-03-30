<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template' 
 * is selected in Events -> Settings -> Template -> Events Template.
 * 
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

get_header(); 

global $post_id; 
$post_id = $post->ID;

if( is_single() ) {
	$type_event = get_post_meta($post_id, 'mm_events_type_meta_box', true );
}
?>


<section id="content" class="page-events events_type_<?php  echo $type_event;  ?>">
	
			<?php if( is_single() ) { ?>
			
			<!-- Page Heading -->
			<section class="section page-heading animate-onscroll">
				<h1><?php the_title(); ?></h1>
				
				<?php if(get_option('sense_show_breadcrumb') == 'show') { ?>
				<?php candidat_the_breadcrumbs(); ?>
				<?php } ?>
				
			</section>
			<!-- Page Heading -->

					<?php 
					if( $type_event == 'style1' || $type_event == 'style12' ) {
					?>
					
					<?php 
					} else {
					$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'extended-portfolio'); 
						?>
						<!-- Event Map -->
						<section class="section full-width full-width-image animate-onscroll">
						
							<img src="<?php  echo $thumb_image_url[0];  ?>" alt="">
							
						</section>
						<!-- /Event Map -->
						<?php 
					
					}
			
			} else {
			?>
			
			<!-- Page Heading -->
			<section class="section page-heading animate-onscroll">
				<h1><?php echo get_option('sense_event_title1'); ?></h1>
				<p class="breadcrumb"><a href="<?php echo home_url('/'); ?>"><?php _e( 'Home', 'candidate' ); ?></a> / <?php _e( 'Events', 'candidate' ); ?></p>
			</section>
			<!-- Page Heading -->

			<?php } ?>
			
			

		<!-- Section full-width-bg-->
		<section class="section section_events_full full-width-bg gray-bg">
			
			<div class="row">
			
			
				<div class="col-lg-12 col-md-12 col-sm-12">	
			
	<?php tribe_events_before_html(); ?>
	<?php tribe_get_view(); ?>
	<?php tribe_events_after_html(); ?>

				</div>
					
				
			</div>
			
		</section>
		<!-- /Section full-width-bg-->
		
		
		
		<?php if( is_single() ) { ?>
		
		<!-- Related Events -->
			<section class="section full-width-bg">
				
				<div class="row related-events">
					
					<div class="col-lg-12 col-md-12 col-sm-12 animate-onscroll">
						<h3><?php _e( 'Related Events', 'candidate' ) ?></h3>
					</div>
		
					<!-- Related Articles -->
					<?php 
					$esclude_post  = get_the_ID();
					$category = candidat_get_events_category($esclude_post);
					
					candidat_the_related_events(3, $category, $esclude_post, 'col-lg-4 col-md-4 col-sm-4 animate-onscroll'); 
					
					?>
					<!-- /Related Articles -->
		
		
				</div>
				
			</section>
			<!-- /Related Events -->

		<?php } ?>
	
</section>
<!-- /Section content -->
		


<?php get_footer(); ?>
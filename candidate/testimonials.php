<?php
// Template Name: Testimonials
?>



<?php
get_header();

$sidebar_id = get_meta_option('custom_sidebar');
$sidebar_position = get_meta_option('sidebar_position_meta_box');
$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';

	if( $sidebar_position == 'left' ) { 
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4';
	 }
	if( $sidebar_position == 'right' ) { 
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8';
	 }
	if( $sidebar_position == 'full' ) {
	$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
	 }  
?>


<section id="content">	
			
			<!-- Page Heading -->
			<section class="section page-heading animate-onscroll">
				<h1 class="entry-title" ><?php echo esc_html(get_the_title()); ?></h1>
				
				<?php if(get_option('sense_show_breadcrumb') == 'show') { ?>
				<?php candidat_the_breadcrumbs(); ?>
				<?php } ?>
				
			</section>
			<!-- Page Heading -->

		<!-- Section -->
		<section class="section full-width-bg gray-bg">
			
			<div class="row">
			
				<div class="<?php echo esc_attr($sidebar_class); ?>">
				
				<h3 class="animate-onscroll no-margin-top"><?php echo esc_html(get_option('sense_testimonials_title')); ?></h3>

					<?php
					$pp = get_option('sense_testimonials_num');
					$query = array(
						'posts_per_page' => $pp,
						'post_type'=>'testimonial',
						'orderby' => 'post_date',
						'order'    => 'DESC',
						'paged' => ( get_query_var('paged') ? get_query_var('paged') : true ),
						'post_status'     => 'publish'
					  );
					query_posts($query);
					
					?>
 
 
 
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
						$des = get_the_content();
						$address = get_meta_option('address_testimonial_meta_box');
						$title1 = get_the_title();
						$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'th-sidebar'); 
				?>

					
				<!-- Testimonial -->
				<div class="testimonial animate-onscroll">
					
					<div class="testimonial-content">
						<p><?php the_content(); ?></p>
					</div>
					
					<div class="testimonial-author">
						<img src="<?php if(isset($thumb_image_url[0])) echo esc_url($thumb_image_url[0]); ?>" alt="">
						<div class="author-meta">
							<span class="name"><?php echo esc_attr($title1) ; ?>
							<?php if($address != '') {
								echo ',';
							} ?>
							</span>
							<span class="location"><?php echo esc_attr($address); ?></span>
						</div>
					</div>
					
				</div>
				<!-- /Testimonial -->	
				
				<div class="divider animate-onscroll"></div>
				
				<?php endwhile; 
				?>		

				<div class="animate-onscroll" style="margin-top:-14px;">

					<?php if ( $wp_query->max_num_pages > 1 ) { ?>
						<div class="numeric-pagination">
						<?php candidat_pagenavi(); ?> 
						</div>
					<?php } 
					wp_reset_query();
					
					?>

				</div>	
				
				</div>
			
		

				<!-- Sidebar -->
			    <?php 
				if( $sidebar_position != 'full' ) {
					if( $sidebar_position == 'left' ) { ?>
					<div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8 sidebar">
					<?php } if( $sidebar_position == 'right' ) { ?>
					<div class="col-lg-3 col-md-3 col-sm-4 sidebar">
					<?php } ?>
					
					<?php candidat_mm_sidebar('blog',$sidebar_id);?>
					</div>
				<?php } ?>

			</div>
		</section>
		<!-- /Section -->
		
	</section>

<?php get_footer(); ?>
<?php

get_header();

global $post_id; 
$post_id = $post->ID;
$sidebar_id = get_meta_option('custom_sidebar');

$sidebar_position = 'full';
if(get_meta_option('sidebar_position_meta_box') && get_meta_option('sidebar_position_meta_box') != '') {
$sidebar_position = get_meta_option('sidebar_position_meta_box');
}

	$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
	$full_class = 'fullwidth-post';
	$type = 'post-full';
	if( $sidebar_position == 'left' ) { 
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4';
	$full_class = '';
	$type = 'post-blog';
	 }
	if( $sidebar_position == 'right' ) { 
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8';
	$full_class = '';
	$type = 'post-blog';
	 }
	if( $sidebar_position == 'full' ) { 
	$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
	$full_class = 'fullwidth-post';
	$type = 'post-full';
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
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
		global $post;
		?>
		<div class="<?php echo esc_attr($sidebar_class); ?>">
				
			<!-- Portfolio Single -->
			<div class="portfolio-single">
	
				<?php if( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail($type); ?>
				<?php } ?>

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 animate-onscroll">
							
							<h6><?php esc_html_e( 'Issues', 'candidate' ); ?></h6>
							
							<?php the_content(); ?>
						</div>
					</div>
				
				
			</div>
			<!-- /Portfolio Single -->
		</div>	
		
		<?php endwhile; // end of the loop. ?>

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

<?php 
get_footer(); ?>
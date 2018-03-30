<?php 

/* 
Template Name: Full Width 
*/ 

?>

<?php get_header(); ?>

	<?php //Display Page Header
		global $wp_query;
		$postid = $wp_query->post->ID;
		echo page_header( get_post_meta($postid, 'qns_page_header_image', true) );
		wp_reset_query();
	?>
			
	<!-- BEGIN .section -->
	<div class="section">
		
		<ul class="columns-content page-content clearfix">
			
			<!-- BEGIN .full-width -->
			<li class="full-width">

				<h2 class="page-title page-title-full"><?php the_title(); ?></h2>
				<?php load_template( get_template_directory() . '/includes/loop.php' ); ?>
			
			</li>
		</ul>

	<!-- END .section -->
	</div>

<?php get_footer(); ?>
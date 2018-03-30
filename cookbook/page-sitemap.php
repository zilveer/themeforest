<?php /* Template Name: Sitemap*/ ?>

<?php get_header(); ?>

<?php
	
	//SETTTINGS
	$cmb_sitemap_location = get_post_meta($post->ID, 'cmb_sitemap_location', true);

?>

	<!-- BEGIN LOOP -->
	<?php while ( have_posts() ) : the_post(); ?>

	
    	<!-- Start Outter Wrapper -->
    	<div class="outter-wrapper body-wrapper">		
    		<div class="wrapper clearfix">

				<!-- Main Column -->
				<div class="col-3-4">
				
    				<!-- Start Page Heading -->
    				<div class="page-heading">
    					<i class="fa fa-map-marker"></i><?php the_title(); ?>
    				</div>
    				
    				
    				<div class="clearfix">
    					
    					
							<!-- SITEMAP-->
							<?php wp_nav_menu(array( 
								'theme_location'    => $cmb_sitemap_location,
								'menu_id'           => 'sitemap',
								'menu_class'        => 'sitemap',
								'container'         => 'false',
								'show_home'         => '1'
								));
							?>

    					
    				</div>

				</div>
				<!-- End Main Column -->    
				
				
                <!-- sidebar -->
                <?php get_sidebar("page"); ?>
                

    		</div>
    	</div>
		
	<?php endwhile; ?>
	<!-- END LOOP -->


<?php get_footer(); ?>
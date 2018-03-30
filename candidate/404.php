<?php
 // Template Name: 404

get_header(); 

$tt = '404';
if(get_option('sense_text_top') && get_option('sense_text_top') != '') {
$tt = get_option('sense_text_top');
}
?>


<section id="content">	
			
			<!-- Page Heading -->
			<section class="section page-heading animate-onscroll">
				<h1  class="entry-title" ><?php echo esc_html($tt); ?></h1>
				
			</section>
			<!-- Page Heading -->
			

			
		<!-- Section -->
		<section class="section full-width-bg gray-bg">
			
			<div class="row">
			
				<div class="main-content-page col-lg-12 col-md-12 col-sm-12">
				
					
					<?php echo stripslashes(get_option('sense_text_bottom'));?>
				

				</div>

			</div>
	
		</section>
		<!-- /Section -->
		
</section>

<?php get_footer(); ?>
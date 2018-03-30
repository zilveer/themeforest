<?php 
/*
Template Name: External Page
*/
	get_header();
	
	// Intro
	get_template_part('article', 'menu'); 

?>

<div class="blog-content wrap">
	<div class="container">
		<div class="blog-detail-header span12"></div>
			<div class="row clearfix">
			
				<?php 
			
					$blogClass = 'span9';
					
					if(opt('blog_sidebar_position') == 0)
						$blogClass = 'span12';

				?>
				
				<div class="<?php echo $blogClass; ?>">
					<!--post 1-->
					<div class="post blog-detail-post">
									
						<?php if ( have_posts() )
						
							{ 
								while ( have_posts() ) { 
									the_post(); 
									get_template_part( 'page_content', 'single' ); 
								} 
								
							} ?>
					
					</div>	
				</div>
					
				<!--  Side bar -->
				<?php  if( opt('sidebar_position') != 0) get_sidebar();  ?>
						
			</div>
		</div>
	</div>
</div>

<?php
	get_footer();
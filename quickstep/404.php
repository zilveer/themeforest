<?php get_header(); ?>
	
	<div id="container-<?php the_ID(); ?>" class="container first">	
    	
			<div id="content" class="row clearfix">
			
				<div id="main" class="" role="main">

					<article id="post-not-found" class="clearfix">
						
						<header>
							
							<h1><?php _e("Epic 404 - Article Not Found", "qs_framework"); ?></h1>
						
						</header> <!-- end article header -->
					
						<section class="post_content">
							
							<p><?php _e("The article you were looking for was not found, but maybe try looking again!", "qs_framework"); ?></p>
					
						</section> <!-- end article section -->
						
						<footer>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
			
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

	</div>
<?php get_footer(); ?>

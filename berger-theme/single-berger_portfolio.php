<?php

get_header();

while ( have_posts() ){

the_post();

?>

	<!-- Content -->
	<div id="content">

		<div id="content-ajax">

		<?php 
		
		$hero_type = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-type' );
		if( $hero_type != 'none' ){
		
			get_template_part('sections/hero_section'); 
		}
		
		?>
		
		<!-- Main --> 
        <div id="main">

			<!-- Container -->
            <div class="container">
			
				<?php
				if( redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-show-title' ) ){
				?>
				<!-- Page Title -->
                <div class="page-title text-align-center">                
                    <h3><?php the_title(); ?></h3>                        
                    <p class="monospace title-has-line"><?php echo redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-subtitle' ); ?></p>
                </div>
                <!-- Page Title -->
				<?php } ?>
					
				<?php the_content(); ?>
				
				<?php get_template_part("sections/project_navigation_section"); ?>
			</div>
			
		</div>
        <!--/Main -->
		
		<?php get_template_part("sections/scroll_top_section"); ?>
		            
		</div>
		<!-- /Container -->
		
    </div>
	<!--/Content -->

<?php

}
	
get_footer();

?>


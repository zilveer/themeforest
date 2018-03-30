<?php
/*
Template name: Blog Template
*/
get_header();

while ( have_posts() ){

the_post();

?>

	<!-- Content -->
	<div id="content">

		<div id="content-ajax">

		<?php 
		
		$hero_type = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-type' );
		if( $hero_type != 'none' ){
		
			get_template_part('sections/hero_section'); 
		}
		
		?>
		
		<!-- Main --> 
        <div id="main">

			<!-- Container -->
            <div class="container">

                <?php get_template_part('sections/search_section'); ?>
			
				<?php
				if( redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-show-title' ) ){
				?>
				<!-- Page Title -->
                <div class="page-title text-align-center">                
                    <h3><?php the_title(); ?></h3>                        
                    <p class="monospace title-has-line"><?php echo redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-subtitle' ); ?></p>
                </div>
                <!-- Page Title -->
				<?php } ?>
				
				<!-- Blog -->
                <div id="blog" class="text-align-center">
				
				<?php 
				
					$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
			
					$args = array(
						'post_type' => 'post',
						'paged' => $paged
					);
					$posts_query = new WP_Query( $args );

					// the loop
					while( $posts_query->have_posts() ){

						$posts_query->the_post();

						get_template_part( 'sections/blog_post_section' );

					}
					
				?>
				
				<!-- /Blog -->
                </div>

				<?php
				
					clapat_bg_pagination( $posts_query );

					wp_reset_postdata();
				?>
				
			</div>
			<!-- /Container -->
			
		</div>
        <!--/Main -->
		
		<?php get_template_part("sections/scroll_top_section"); ?>
		            
		</div>
		
    </div>
	<!--/Content -->

<?php

}
	
get_footer();

?>

<?php
/*
Template name: Portfolio Mixed Template
*/

get_header();

global $cpbg_hover_effect, $cpbg_show_empty_items, $cpbg_lightbox_popup;

while ( have_posts() ){

the_post();

$columns 				= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-portfolio-columns' );
$autoconstruct 			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-portfolio-autoconstruct' ) ? 'class="auto-construct"' : '';
$show_filters 			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-portfolio-show-filters' ) ? '' : 'class="filters-hide"';
$cpbg_hover_effect 		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-portfolio-hover-effect' );
$margins 				= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-portfolio-margins' ) ? '' : 'no-gutter';
$cpbg_lightbox_popup	= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-portfolio-enable-lightbox' );
$max_items				= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-portfolio-mixed-items' );
if( empty($max_items) ){
	$max_items = 1000;
}
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
			
			<!-- Portfolio Filters --> 
            <ul id="filters" <?php echo $show_filters; ?>>
                <li><a id="all" href="#" data-filter="*" class="active"><?php _e('all', THEME_LANGUAGE_DOMAIN); ?></a></li>	
				<?php
                $portfolio_category = get_terms('portfolio_category', array( 'hide_empty' => 0 ));

                if($portfolio_category){

					foreach($portfolio_category as $portfolio_cat){
                ?>
                <li><a href="#" data-filter=".<?php echo $portfolio_cat->slug; ?>"><?php echo  $portfolio_cat->name; ?></a></li>
                <?php
                    }
                }
                ?>
            </ul>
            <!--/Portfolio Filters -->
			
			<div id="portfolio-wrap" class="<?php echo $margins; ?>">
            
            	<div id="portfolio" <?php echo $autoconstruct; ?> data-col="<?php echo esc_attr( $columns ); ?>">
				
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
                    		'post_type' => THEME_ID . '_portfolio',
							'paged' => $paged,
							'posts_per_page' => $max_items,
                         );
            
				$pcats = get_post_meta(get_the_ID(), THEME_ID . '_portfolio_category', true);
				if( $pcats && $pcats[0] == 0 ) {
					unset($pcats[0]);
				}
            
				if( $pcats ){
					$args['tax_query'][] = array(
                			       			  	'taxonomy' => 'portfolio_category',
						  						'field' => 'ID',
						  						'terms' => $pcats
											);
				}
            
				$gallery = new WP_Query($args);

				while($gallery->have_posts()){
            	
					$gallery->the_post();
				
					get_template_part('sections/portfolio_section_item');
				
				}
			
				wp_reset_postdata();
				?>
			
				</div>
			
			</div>

			<div class="container">
				<?php the_content(); ?>
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

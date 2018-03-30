<?php

// archive template for portfolio categories

get_header();

global $cpbg_hover_effect, $cpbg_show_empty_items, $cpbg_lightbox_popup;

$columns 				= 3;
$autoconstruct 			= 'class="auto-construct"';
$cpbg_hover_effect 		= 'hover-black';
$margins 				= '';
$cpbg_lightbox_popup	= false;

?>

	<!-- Content -->
	<div id="content">

		<div id="content-ajax">

		<!-- Main --> 
        <div id="main">

			<!-- Page Title -->
            <div class="page-title text-align-center">                
                <h3><?php single_cat_title(); ?></h3>                        
            </div>
            <!-- Page Title -->
			
			<!-- Portfolio Filters --> 
            <ul id="filters" class="filters-hide">
                <li><a id="all" href="#" data-filter="*" class="active"><?php _e('all', THEME_LANGUAGE_DOMAIN); ?></a></li>	
            </ul>
            <!--/Portfolio Filters -->
			
			<div id="portfolio-wrap" class="<?php echo $margins; ?>">
            
            	<div id="portfolio" <?php echo $autoconstruct; ?> data-col="<?php echo esc_attr( $columns ); ?>">
				
				<?php
				
				if( have_posts() ){
				
					while( have_posts() ){
					
						the_post();
					
						get_template_part('sections/portfolio_section_item');
					
					}

				}
				?>
			
				</div>
			
			</div>
			
		</div>
        <!--/Main -->
		
		<?php get_template_part("sections/scroll_top_section"); ?>
		            
		</div>
		<!-- /Container -->
		
    </div>
	<!--/Content -->

<?php

	
get_footer();

?>

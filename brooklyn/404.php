<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package unitedthemes
 */

get_header(); 

$header_style = ot_get_option('ut_global_headline_style'); ?>
	
    <div class="grid-container">
		
        <div id="primary" class="grid-parent grid-100 tablet-grid-100 mobile-grid-100">
    	
        	<div class="grid-70 prefix-15 mobile-grid-100 tablet-grid-100">
        
            <header class="page-header <?php echo $header_style;?>">
                <h1 class="page-title"><span><?php _e( 'Oops! That page can&rsquo;t be found.', 'unitedthemes' ); ?></span></h1>  
                <p class="lead"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'unitedthemes' ); ?></p>
            </header>
            
            <?php get_search_form(); ?>
        	
            </div><!-- .page-header --> 
            
		</div><!-- .grid-100 mobile-grid-100 tablet-grid-100 -->
        
	</div><!-- .grid-container -->
    
<?php get_footer(); ?>
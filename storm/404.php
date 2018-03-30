<?php
/**
 * The template for 404 page (Not Found).
 *
 */
?>
<?php 
    get_header();
?>
<div class="bk-404-header">
    <section class="error-number">
        <h4>404</h4>
    </section>              
    <h1 class="bk-error-title"><?php _e('Page not found','bkninja'); ?></h1>
</div>

<div id="bk-404-wrap">
    
	<div class="entry-content">			
		
        <h2><?php _e("Oops! The page you were looking for was not found. Perhaps searching can help.", "bkninja"); ?></h2>
        
	</div>

	<div class="search">

	    <?php get_search_form(); ?>

	</div>
    
    <div class="redirect-home">
        <i class="fa fa-home"></i>
        <a href="<?php echo(home_url());?>"><?php _e('Back to Homepage','bkninja'); ?></a>
    </div>

	
</div> <!-- end #bk-404-wrap -->
    
<?php get_footer(); ?>

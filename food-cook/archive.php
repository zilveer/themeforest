<?php
/**
 * Archive Template
 *
 * The archive template is a placeholder for archives that don't have a template file. 
 * Ideally, all archives would be handled by a more appropriate template according to the
 * current page context (for example, `tag.php` for a `post_tag` archive).
 *
 * @package WooFramework
 * @subpackage Template
 */ ?>

<?php global $woo_options; ?>

<?php get_header(); ?>

    <!-- #content Starts -->
	<?php woo_content_before(); ?>

    <div id="content" class="col-full">
    
    	<div id="main-sidebar-container">    
		
            <!-- #main Starts -->
            <?php woo_main_before(); ?>

            <div id="main" class="col-left">
            	
    			<?php dahz_get_template( 'loop', 'loop-archive' ); ?>
                
            </div><!-- /#main -->

            <?php woo_main_after(); ?>
    
            <?php get_sidebar(); ?>
    
		</div><!-- /#main-sidebar-container -->         

        <?php dahz_get_sidebar( 'secondary' ); ?>

    </div><!-- /#content -->
    
	<?php woo_content_after(); ?>
		
<?php get_footer(); ?>
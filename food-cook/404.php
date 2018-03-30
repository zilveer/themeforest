<?php
/**
 * Template Name: 404 Template
 *
 * This template is displayed when the page being requested by the viewer cannot be found
 * or doesn't exist. From here, we'll try to assist the user and keep them browsing the website.
 * @link http://codex.wordpress.org/Pages
 *
 * @package WooFramework
 * @subpackage Template
 */ ?>

<?php get_header(); ?>

    <!-- #content Starts -->
	<?php woo_content_before(); ?>

    <div id="content" class="col-full">
		
    	<div id="main-sidebar-container">

            <!-- #main Starts -->
            <?php woo_main_before(); ?>

                <div id="main" class="full-width">

                    <?php woo_loop_before(); ?>

                    <?php dahz_get_template( 'content', 'content-404' ); ?>
                        
                	<?php woo_loop_after(); ?>

                </div><!-- /#main -->

            <?php woo_main_after(); ?>
    
		</div><!-- /#main-sidebar-container -->         

    </div><!-- /#content -->

	<?php woo_content_after(); ?>
		
<?php get_footer(); ?>
<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Template Name: Homepage
 *
 * The home page template displays the "home-style" template on a sub-page. 
 *
 * @package WooFramework
 * @subpackage Template
 */

 get_header();
 global $woo_options;


?> 

<!-- #content Starts -->
<?php woo_content_before(); ?>

<div id="content" class="col-full">
 			
    <div id="main-sidebar-container">    

         <!-- #main Starts -->
        <?php woo_main_before(); ?>

        <div id="main">

    		<?php if (have_posts()) : the_post(); ?>
            
            	<?php the_content(); ?>

                <?php echo do_shortcode('[post_edit]'); ?>               
                                                       
    		    <?php wp_reset_query(); else: ?>

            		<div <?php post_class(); ?>>

                    	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>

                    </div><!-- /.post -->

                <?php endif; ?>  
                	
    			<?php
                 //    if ( is_home() && is_active_sidebar( 'homepage' ) ) {
                 //        dynamic_sidebar( 'homepage' );
                 //    } else {
                 //        get_template_part( 'loop', 'index' );
               		// }
                ?>
        
        </div><!-- /#main -->

        <?php woo_main_after(); ?>

   
        <?php  get_sidebar();  ?>
    
	</div><!-- /#main-sidebar-container -->         

    <?php dahz_get_sidebar( 'secondary' ); ?>

</div><!-- /#content -->

<?php woo_content_after(); ?>

<?php get_footer(); ?>
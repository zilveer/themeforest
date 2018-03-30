<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) :
    die ( 'You do not have sufficient permissions to access this page!' );
endif;

/**
 * Index Template
 *
 * Here we setup all logic and XHTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package WooFramework
 * @subpackage Template
 */
get_header();

global $woo_options;

// set option homepage sidebar
$homepage_sidebar = isset( $woo_options['woo_homepage_sidebar'] ) ? $woo_options['woo_homepage_sidebar'] : NULL;

$layout_class = 'col-left';

if ( ( is_home() || is_front_page() ) && 'true' != $homepage_sidebar ) : 
    $layout_class = 'full-width'; 
endif; ?> 

    <!-- #content Starts -->
    <?php woo_content_before(); ?>
        
        <div id="content" class="col-full">
            
            <div id="main-sidebar-container">    

                <!-- #main Starts -->
                <?php woo_main_before(); ?>
                
                <div id="main" class="<?php echo esc_attr( $layout_class ); ?>">
                        
                    <?php if ( have_posts() ) : $count = 0; ?>

                        <?php while ( have_posts() ) : the_post(); $count++; ?>

                            <?php dahz_get_content_template(); // Loads the includes/templates/content/*.php template. ?>

                        <?php endwhile; // End WHILE Loop ?>

                    <?php endif; ?>
        
                </div><!-- /#main -->

                <?php woo_main_after(); ?>
        
                <?php if ( ( is_home() || is_front_page() ) && 'true' == $homepage_sidebar ) : ?> 

                    <?php get_sidebar(); ?> 

                <?php else : ?>

                    <?php get_sidebar(); ?> 
                    
                <?php endif; ?>
        
            </div><!-- /#main-sidebar-container -->         

            <?php if ( ( is_home() || is_front_page() ) && 'true' == $homepage_sidebar ) : ?>

                <?php dahz_get_sidebar( 'secondary' ); ?>

            <?php else : ?>   

                <?php dahz_get_sidebar( 'secondary' ); ?>

            <?php endif; ?>   

        </div><!-- /#content -->

    <?php woo_content_after(); ?>

<?php get_footer(); ?>
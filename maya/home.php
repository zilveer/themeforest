<?php        
/**
 * @package WordPress
 * @subpackage Sheeva
 * @since 1.0
 */
 
/*
Template Name: Home
*/

global $wp_query;      

if ( ( is_home() || is_front_page() ) && get_option( 'show_on_front' ) == 'posts' || $wp_query->is_posts_page ) {
    global $yiw_is_posts_page;
    $yiw_is_posts_page = true;
    get_template_part( 'blog' ); 
    die;
}       

if( ( is_home() || is_front_page() ) && get_option( 'show_on_front' ) == 'posts' || is_home() && get_option( 'page_for_posts' ) != '0' ) {
    $blog_type = yiw_get_option('blog_type');
    get_template_part( 'blog' ); 
    die;
}

get_header() ?>  
        
        <div id="primary" class="layout-<?php echo $layout_page_type = yiw_layout_page() ?>">    
		    <div class="inner group">
                <?php get_template_part('slogan') ?>
    
                <!-- START CONTENT -->
                <div id="content" class="group">
                    <?php 
                        if ( is_home() )
                            get_template_part( 'loop', 'index' ); 
                        else
                            get_template_part( 'loop', 'page' ); 
                    ?>
    
                </div>
                <!-- END CONTENT -->
                
                <!-- START LATEST NEWS -->
                <?php get_sidebar() ?>
                <!-- END LATEST NEWS -->  
                                  
                <!-- START EXTRA CONTENT -->
        		<?php get_template_part( 'extra-content' ) ?>      
                <!-- END EXTRA CONTENT -->   
            </div>
        </div>             
        
<?php get_footer() ?>
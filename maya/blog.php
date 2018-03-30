<?php       
/**
 * @package WordPress
 * @since 1.0
 */
 
/*
Template Name: Blog
*/                     

wp_enqueue_style( 'Oswald', 'http://fonts.googleapis.com/css?family=Oswald&v2' ); 

global $blog_type;

$paged = (get_query_var('paged')) ? get_query_var('paged') : ( (get_query_var('page')) ? get_query_var('page') : 1 );

$blog_type = yiw_get_option( 'blog_type' );
                                     
get_header() ?>           
        


        <div id="primary" class="layout-<?php echo yiw_layout_page() ?>">     
		    <div class="inner group">
                <?php get_template_part('slogan') ?>

                <!-- START CONTENT -->
                <div id="content" class="group">
                    <?php
                    $post_id = yiw_post_id();
                    if( get_post_meta( $post_id, '_show_breadcrumbs_page', true ) == 'yes' ) yiw_breadcrumb();


                    $_active_title = get_post_meta( $post->ID, '_show_title_page', true );

                    if( ( $_active_title == 'yes' || !$_active_title ) && $post->post_type == 'page' )
                        { the_title( '<h2>', '</h2>' ); }


                    query_posts('cat=' . yiw_get_exclude_categories() . '&posts_per_page=' . get_option('posts_per_page') . '&paged=' . $paged);

                    get_template_part('loop', 'index');
                    ?>
                </div>                       
                <!-- END CONTENT -->
                
                <!-- START LATEST NEWS -->
                <?php get_sidebar('blog') ?>
                <!-- END LATEST NEWS -->   
            
            </div>      
        </div>
        
<?php get_footer() ?>

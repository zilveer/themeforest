<?php
/** Template Name: Blog */
global $theme_option;
global $wp_query;

get_header(); 

$show_sidebar =  get_post_meta($wp_query->get_queried_object_id(), "_cmb_show_sidebar", true) ? get_post_meta($wp_query->get_queried_object_id(), "_cmb_show_sidebar", true) : 'yes';

?>        
        
        <?php if($show_sidebar == 'yes'){
            $main_col = 'col-sm-8 col-md-9';
            $sidebar_col = 'col-sm-4 col-md-3';
            
        }else{
            $main_col = 'col-sm-12';
        } ?>

        <!-- Page Blog -->
        <section class="page-section with-sidebar sidebar-right">
            <div class="container">
                <div class="row">

                    <!-- Content -->
                    <section id="content" class="content <?php echo esc_attr($main_col); ?>">

                    	<?php 
							$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	                        $args = array(    
	                            'paged' => $paged,
	                            'post_type' => 'post',
	                        );
	                        $a = new WP_Query($args);
			 			?>
			 			<?php  if($a->have_posts()) :
                                while($a->have_posts()) : $a->the_post(); 
                        ?>
                                    <?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>                
                                <?php endwhile; ?>
                        <?php else: ?>
                            <h1><?php _e('Nothing Found Here!', TEXT_DOMAIN); ?></h1>
                        <?php endif; ?>

                        <!-- Pagination -->
                        <div class="pagination-wrapper">                           

                            <ul class="pagination">
                                <li>
                                    <?php
                                        global $wp_query;

                                        $big = 999999999; // need an unlikely integer
                                        echo paginate_links(array(
                                                     'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                                     'format' => '?paged=%#%',
                                                     'current' => max(1, get_query_var('paged') ),
                                                     'total' => $a->max_num_pages,
                                                     'next_text'    => __('&raquo;', TEXT_DOMAIN),
                                                     'prev_text'    => __('&laquo;', TEXT_DOMAIN),
                                                 ) );
                                    ?>
                                </li>
                            </ul>

                        </div>
                        <!-- /Pagination -->

                    </section>
                    <!-- Content -->



                    <?php if($show_sidebar == 'yes'){ ?>
                        <hr class="page-divider transparent visible-xs"/>

                        <aside id="sidebar" class="sidebar <?php echo esc_attr($sidebar_col); ?>">
                            <?php dynamic_sidebar('sidebar-right' ); ?>
                        </aside>
                    <?php } ?>



                    

                </div>
            </div>
        </section>
        <!-- /Page Blog -->

    
    
<?php get_footer(); ?>
<?php
/*
Template Name: Home Page Blog Style
*/
?>

<?php get_header(); ?>
			
			<!-- BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed clearfix">			

            <?php 
            if ( get_query_var('paged') ) {
            	$paged = get_query_var('paged');
            } elseif ( get_query_var('page') ) {
            	$paged = get_query_var('page');
            } else {
            	$paged = 1;
            }

            $temp = $wp_query;
            $wp_query= null;

            $wp_query = new WP_Query( array(
                'post_type' => 'post',
                'paged' => $paged
            ) );

            // enable use of more tag on template page	
            global $more; $more = 0;
            	
            while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
            
            <?php zilla_post_before(); ?>
			<!-- BEGIN .hentry -->
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
			<?php zilla_post_start(); ?>
			
			<?php
			    $format = get_post_format();
			    $format = ($format) ? $format : 'standard';
			    				    
			    get_template_part( 'content', $format);
			    
			    if( $format == 'standard' || $format == 'gallery' || $format == 'video' || $format == 'audio' ) {
			        get_template_part( 'content', 'meta' ); 
			    }
			?>
				                
            <?php zilla_post_end(); ?>
			<!-- END .hentry-->  
			</div>
			<?php zilla_post_after(); ?>

			<?php endwhile; ?>
	
    		<?php 
    		$pagination = zilla_get_option('post_pagination_type');
            // force pagination in Opera
            global $is_opera;
    		if( $pagination == 'loadmore' && !$is_opera ) { 
    		    if( $wp_query->max_num_pages > 1 ) { ?>
    		        <a href="#" id="load-more" data-width="580"><?php _e('Load More', 'zilla'); ?></a>
    		    <?php }
    		} else { ?>
    		    <!-- BEGIN .navigation .page-navigation -->
        		<div class="navigation page-navigation">
    			    <div class="nav-next">
    				    <?php next_posts_link(__('Older Entries', 'framework')); ?>
    				</div>
    				<div class="nav-previous">
    				    <?php previous_posts_link(__('Newer Entries', 'framework')) ?>
    				</div>
    			<!-- END .navigation .page-navigation -->
        		</div>
    		<?php } ?>
			
				<!-- END #primary .hfeed-->
				</div>

            <?php get_sidebar(); ?>
			</div>

			
			<?php $wp_query = null; $wp_query = $temp;?>
            <?php get_footer(); ?>
<?php
/*
Template Name: Archives
*/
                                                                                               
$cat_not_in = $cat_in = array();  
$cats = yiw_get_option( 'yiw_categories_exclude', '' ); 
if ( ! empty( $cats ) ) {
    $cats = array_map( 'trim', explode( ',', $cats ) );
    foreach ( $cats as $cat ) {
        if ( $cat < 0 )
            $cat_not_in[] = $cat;
        else
            $cat_in[] = $cat;
    }
}

get_header(); ?>                        
        
		<div id="primary" class="layout-<?php echo yiw_layout_page() ?>">    
		    <div class="inner group">
                <?php get_template_part('slogan') ?>
    			
    			<?php get_template_part( 'accordion-slider' ) ?>  
    			
                <!-- START CONTENT -->
                <div id="content" class="group">
                    <?php
                    $post_id = yiw_post_id();
                    if( get_post_meta( $post_id, '_show_breadcrumbs_page', true ) == 'yes' ) yiw_breadcrumb();
                    ?>
                    
                    <div class="archive-list">
        				<?php 
        				    $args = array( 'posts_per_page' => 30 ); 
        				    if ( ! empty( $cat_not_in ) ) $args['category__not_in'] = $cat_not_in;
        				    if ( ! empty( $cat_in ) )     $args['category__in']     = $cat_in;
        					$lastposts = new WP_Query( $args ); 
        					
        					if ( $lastposts->have_posts() ) :
        				?>
        				<h3 class="no-cufon"><?php printf( __( 'Last %d posts', 'yiw' ), 30 ) ?>:</h3>    
        				<ul class="archive-posts group">
        					<?php while( $lastposts->have_posts() ) : $lastposts->the_post(); ?>
        					
        					<li>
        						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
        							<span class="comments_number"><?php comments_number( '0', '1', '%' ) ?></span>
        							<span class="archdate"><?php echo get_the_date( 'j.n.y' ) ?></span>
        							<?php the_title() ?>
        						</a>
        					</li>
        					
        					<?php endwhile; ?>	
        				</ul>
        				<?php endif; ?>
        				
        				<h3 class="no-cufon"><?php _e( 'Archives by Month', 'yiw' ) ?>:</h3>
        				<ul class="archive-monthly group">
        					<?php wp_get_archives('type=monthly'); ?>
        				</ul>
        				
        				<h3 class="no-cufon"><?php _e( 'Archives by Subject', 'yiw' ) ?>:</h3>
        				<ul class="archive-categories group">
        					 <?php wp_list_categories( 'title_li=&exclude=' . implode( ',', $cat_not_in ) . '&include=' . implode( ',', $cat_in ) ); ?>
        				</ul>
        			</div>
                </div>
                <!-- END CONTENT -->
                
                <!-- START SIDEBAR -->
                <?php get_sidebar() ?>
                <!-- END SIDEBAR -->    
                                  
                <!-- START EXTRA CONTENT -->
        		<?php get_template_part( 'extra-content' ) ?>      
                <!-- END EXTRA CONTENT -->
            </div>
        </div>       
        
<?php get_footer() ?>
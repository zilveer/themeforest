<div class="recent-portfolios full-width">

    <?php $number = get_option( 'icy_recent_work_slide_number' ); ?>

        <div class="work-car-controls">
            <a class="work-car-prev"><div class="work-car-prev-ico"></div></a>
            <a class="work-car-next"><div class="work-car-next-ico"></div></a>
        </div>

        <div class="work-carousel">

            <ul>

            <?php
                $recent_work = get_option('icy_recent_work_number');

                $args = array(
                    'post_type' => 'portfolios',
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'posts_per_page' => $recent_work
                );
                $recent = new WP_Query( $args );
                $i = 0;

                while( $recent->have_posts() ) : $recent->the_post(); 
            ?>
                <li class="portfolio-item portfolio columns no-bottom">
                    <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>                                                
                                            
                                            <?php $nonce = wp_create_nonce("portfolio-item-nonce"); ?>

                                            <?php // get the media elements
                                            $mediaType = get_post_meta($post->ID, 'icy_portfolio_type', true); 
                                            $postid = $post->ID; ?>

                                            <?php 
                                                $terms =  get_the_terms( $post->ID, 'skillset' ); 
                                                $term_list = '';
                                                if( is_array($terms) ) {
                                                    foreach( $terms as $term ) {
                                                        $term_list .= $term->slug;
                                                        $term_list .= ' ';
                                                    }
                                                }
                                            ?>
                                
                                            <figure class="portfolio-entry no-bottom">
                                                
                                                    <a class="image-link" href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" rel="bookmark" data-nonce="<?php echo $nonce; ?>" data-post_id="<?php echo $post->ID; ?>"><?php the_post_thumbnail('thumb-portfolio-home'); ?></a>

                                                    <div class="recent-port-entry">
                                                        
                                                        <h3><a class="project-link" href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" rel="bookmark" data-nonce="<?php echo $nonce; ?>" data-post_id="<?php echo $post->ID; ?>"><?php the_title(); ?></a></h3>
                                                        
                                                    </div>
                                            
                                            </figure>
                                            
                    <?php } ?>
        	
            	</li>	
            	<?php $i++; ?>		

            <?php endwhile; wp_reset_postdata(); ?>

            </ul>

        </div>

<!-- END .recent-work -->
</div>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>            
            <div class="portfolio-item four columns <?php portfolio_item_class(); ?>">            
				<div class="portfolio-thumbnail-holder <?php portfolio_holder_class(); ?>">
    
                    <a <?php portfolio_post_href(1); ?>>
                    
                        <div class="portfolio-thumbnail">
                        <?php the_post_thumbnail('one-half'); ?>
                        </div>
                                            
                        <span class="overlay-content">                    
                            <span class="overlay-link-alt"><span class="<?php portfolio_overlay_link(); ?>"></span></span>
                        </span>
                        
                    </a>                                
                    <?php lightbox_gallery_images(); ?>
                           
                </div>
                <div class="portfolio-summary <?php portfolio_holder_class(); ?>">
                    <h4><a <?php portfolio_post_href(2); ?>><?php the_title(); ?></a></h4>
                    <p><?php echo get_post_meta($post->ID, 'portfolio_summary', true) ?></p>
                </div>
            </div>        
        <?php endwhile; endif; wp_reset_query(); ?>  
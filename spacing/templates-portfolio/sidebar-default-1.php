		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>            
            <div class="portfolio-item twelve columns <?php portfolio_item_class(); ?>">
                 <div class="portfolio-thumbnail-holder <?php portfolio_holder_class(); ?>">
                 
                    <a <?php portfolio_post_href(1); ?>>
            
                        <div class="portfolio-thumbnail">
                        <?php the_post_thumbnail('content-wide'); ?>
                        </div>
                                            
                        <span class="overlay-content">                    
                            <span class="overlay-title"><?php the_title(); ?></span>
                            <span class="overlay-link"><span class="<?php portfolio_overlay_link(); ?>"></span></span>
                        </span>
                        
                    </a>                
                    <?php lightbox_gallery_images(); ?>  
                                                
                </div>
            </div>            
        <?php endwhile; endif; wp_reset_query(); ?>
<li <?php post_class(); ?>>

			<?php if ( has_post_thumbnail()) : ?>
                 <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" >
                 <?php the_post_thumbnail( 'item_archive',array('title' => "")); ?>
                 </a>
                 <?php echo tmnf_ribbon() ?>
            <?php endif; ?>

            <h3 class="leading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            
                <p class="widgetmeta sserif">
                
                      <?php the_time('M j') ?> | 
                      <?php the_category(', ') ?> | 
                      <?php the_author_posts_link(); ?> | 
                      <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
                      
                </p>
            <p class="teaser"><?php echo themnific_excerpt( get_the_excerpt(), '250'); ?></p>
             
            
</li>
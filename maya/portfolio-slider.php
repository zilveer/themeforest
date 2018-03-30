<?php                                                                  
    global $yiw_portfolio;                          
                                                       
    $post_type = yiw_get_portfolio_post_type(); 
    
    $categories_portfolio = get_terms( sanitize_title( $yiw_portfolio[$post_type]['tax'] ), 'hide_empty=1&orderby=name');
    foreach ($categories_portfolio as $category ) {
        $cat_slug = $category->slug;
        $cat_name = $category->name;
        $count_items = $category->count;      

        if( $count_items > 0 ) {
            global $paged;

            $args = array(
                        'post_type' => $post_type,
                        sanitize_title( $yiw_portfolio[$post_type]['tax'] ) => $cat_slug,
                        'paged' => $paged,
                        'posts_per_page' => -1
                    );

            //wp_reset_query();
            $portfolio_items = new WP_Query( $args );   
    
            echo "<h3>$cat_name</h3>\n";        
            echo '<div class="portfolio-slider">';
            echo '<ul>'."\n";
    
            while( $portfolio_items->have_posts() ) : $portfolio_items->the_post();
    
                if( $thumb = get_post_meta(get_the_ID(), '_portfolio_video', true) ) {
                    $class = 'video';
                } else {
                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                    $thumb = $thumb[0];
                    $class = 'img';
                }                                              
                        
                $click_event = yiw_get_option( 'portfolio_thumbnail_click', 'lightbox' );
                ?>                                                   

                <li class="post-<?php echo get_the_ID() ?>">
                    <?php if( has_post_thumbnail() ) : ?>
                        <?php if ( $click_event == 'lightbox' ) : ?>
                        <a class="thumb <?php echo $class ?>" href="<?php echo $thumb ?>" rel="prettyPhoto[<?php echo $cat_name ?>]" title="<?php the_title() ?>"><?php the_post_thumbnail('thumb_portfolio_slider') ?></a>
                        <?php elseif ( $click_event == 'item-page' ) : ?>
                        <a class="thumb" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail('thumb_portfolio_slider') ?></a>
                        <?php elseif ( $click_event == 'nothing' ) : ?>
                        <a class="thumb" title="<?php the_title() ?>"><?php the_post_thumbnail('thumb_portfolio_slider') ?></a>
                        <?php endif ?>
                    <?php endif ?>  
                </li>
                
                <?php
            endwhile;           
    
            echo '</ul>'."\n";
            echo '</div>';
            echo '<div class="clear"></div>'."\n";   
    
            unset( $portfolio_items );
        }
    }                   

    ?>

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('.portfolio-slider').jcarousel();
});
</script>

            <ul id="portfolio">         
                <?php
                    global $paged, $yiw_portfolio;
                    
                    $post_type = yiw_get_portfolio_post_type();
                    
                    $args = array(
                        'post_type' => $post_type,
                        'posts_per_page' => $yiw_portfolio[$post_type]['items'] ? $yiw_portfolio[$post_type]['items'] : '-1',
                        'paged' => $paged
                    );                                  
                    
                    if ( is_tax() )   
                       $args = wp_parse_args( $args, $wp_query->query );

                    $portfolio = new WP_Query( $args );
                    $i = 1;

                    while( $portfolio->have_posts() ) : $portfolio->the_post();  
                        global $more;
                        $more = 0;

                        if($i % 3 == 0) {
                            $classes = 'last group';
                        } elseif($i % 3 == 1) {
                            $classes = 'first';
                        } else {
                            $classes = '';
                        }
                        
                        
                        $classes .= " one-third";
                ?>     

                <li <?php post_class( $classes ) ?>>
                    <?php   
                        if( $thumb = get_post_meta(get_the_ID(), '_portfolio_video', true) ) {
                            $class = 'video';
                        } else {
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                            $thumb = $thumb[0];
                            $class = 'img';
                        }
                        
                        $click_event = yiw_get_option( 'portfolio_thumbnail_click', 'lightbox' );
                    ?>

                    <?php if( has_post_thumbnail() ) : ?>
                        <?php if ( $click_event == 'lightbox' ) : ?>
                        <a class="thumb <?php echo $class ?>" href="<?php echo $thumb ?>" rel="prettyPhoto[movies]"><?php the_post_thumbnail('thumb_portfolio_3cols') ?></a>
                        <?php elseif ( $click_event == 'item-page' ) : ?>
                        <a class="thumb" href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumb_portfolio_3cols') ?></a>
                        <?php elseif ( $click_event == 'nothing' ) : ?>
                        <a class="thumb"><?php the_post_thumbnail('thumb_portfolio_3cols') ?></a>
                        <?php endif ?>
                    <?php endif ?>  

                    <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                    <?php $read_more_button = ( yiw_get_option( 'portfolio_show_view_project' ) ) ? $yiw_portfolio[$post_type]['read_more'] : ''; ?>
                    <?php echo yiw_content('content', 25, $read_more_button ) ?>
                </li>       
                <?php $i++; endwhile ?>        
            </ul>                             

            <?php if(function_exists('yiw_pagination')) : yiw_pagination( $portfolio->max_num_pages ); else : ?> 
                <div class="navigation">
                    <div class="alignleft"><?php next_posts_link(__('Next &raquo;', 'yiw')) ?></div>
                    <div class="alignright"><?php previous_posts_link(__('&laquo; Back', 'yiw')) ?></div>
                </div>
            <?php endif; ?>

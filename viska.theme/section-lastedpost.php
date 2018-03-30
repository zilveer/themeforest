<!-- News -->
<?php
    global $customize,$is_customize_mode;
    if($customize['lastedpost']['show'] || $is_customize_mode): 
?>
    <section id="news" class="awe-section news awe-parallax" <?php display_background_css('lastedpost'); ?>>
        <div class="container">
            <div class="row">
                <?php displayHeader('lastedpost'); ?>
                <div class="clear"></div>

                <!-- AweTheme News -->
                <div class="awe-content js-awe-get-items">
                    <div class="awe-news wow fadeInUp" data-wow-delay="0.5s" data-animate="<?php animationContent('lastedpost'); ?>">
                        <div id="owl-news">
                            <!-- Item -->
                            <?php
                            $posts_per_page = $customize['lastedpost']['limit_display'];
                            $args = array('post_type'=>'post','posts_per_page'=>$posts_per_page);
                            $last_post = new WP_Query($args);
                            while ($last_post->have_posts()) : $last_post->the_post();
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'awe-last_post-thumb' );
                            ?>
                            <div class="item">
                                <div class="image">
                                    <div class="center">
                                        <a href="<?php the_permalink(); ?>" class="share"><i class="fa fa-link"></i></a>
                                    </div>
                                    <?php if(has_post_thumbnail()) : ?>
                                    <img src="<?php echo $thumb[0]; ?>" alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="ct">
                                    <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                
                                        <?php do_action('awe_lasted_post_content'); ?>
                                    
                                    <ul>
                                        <li class="news-date"><i class="awe-icon fa fa-calendar-o"></i><?php echo get_the_date(); ?></li>
                                        <li class="comment"><a href="<?php the_permalink(); ?>"><i class="awe-icon fa fa-comment-o"></i><?php comments_number( __('No comment',LANGUAGE), __('1 comment',LANGUAGE), __('% comments',LANGUAGE) ); ?></a></li>
                                        <!-- <li class="wish"><i class="awe-icon fa fa-heart"></i>12</li> -->
                                    </ul>
                                </div>
                            </div>
                            <!-- End Item -->
                            <?php endwhile; wp_reset_query(); ?>
                            <!-- Item -->
                        </div>
                    </div>
                </div>
                <!-- End Slide News -->
            </div>
            <?php sectionFooter('lastedpost'); ?>
        </div>
         <?php sectionOverLay('lastedpost'); ?>
    </section>
<?php endif; ?>
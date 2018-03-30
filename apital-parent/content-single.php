<?php
/**
 * The default template for displaying post details
 */
?>
<?php
    $permalink = get_permalink();
    $post_media_type = defined('FW') ? fw_get_db_post_option($post->ID, 'media_type') : '';
?>
<div class="blog-post">
    <div>
        <!--gallery media-->
        <?php if(isset($post_media_type['post_type']) && $post_media_type['post_type'] == 'gallery'):?>
                <?php if(!empty($post_media_type['gallery']['images'])):?>
                    <div>
                        <div class="w-slider carousel-project" data-animation="slide" data-duration="500" data-infinite="1" data-nav-spacing="5">
                            <div class="w-slider-mask">
                                <?php foreach($post_media_type['gallery']['images'] as $gallery_img):?>
                                    <div class="w-slide"><img src="<?php echo esc_url($gallery_img['url']);?>" alt=""></div>
                                <?php endforeach; ?>
                            </div>
                            <div class="w-slider-arrow-left ver-remove-spc">
                                <div class="w-icon-slider-left carousel-arrow"></div>
                            </div>
                            <div class="w-slider-arrow-right ver-remove-spc">
                                <div class="w-icon-slider-right carousel-arrow"></div>
                            </div>
                            <div class="w-slider-nav w-slider-nav-invert w-round carousel-dots"></div>
                        </div>
                    </div>
                <?php endif;?>
                <!--video media-->
            <?php elseif(isset($post_media_type['post_type']) && $post_media_type['post_type'] == 'video'):?>
                <?php if(!empty($post_media_type['video']['images'])):?>
                    <?php
                    global $wp_embed;
                    $iframe = $wp_embed->run_shortcode( '[embed  width="872" height="491"]' . trim( $post_media_type['video']['images'] ) . '[/embed]' );
                    ?>
                    <div>
                        <div data-ix="show-portfolio-overlay">
                            <div class="w-embed w-video" style="padding-top: 56.27659574468085%;">
                                <?php echo do_shortcode($iframe);?>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <!--audio media-->
            <?php elseif(isset($post_media_type['post_type']) && $post_media_type['post_type'] == 'audio'):?>
                <?php if(!empty($post_media_type['audio']['images'])):?>
                    <div>
                        <div data-ix="show-portfolio-overlay">
                            <div class="w-embed w-iframe">
                                <iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo esc_url($post_media_type['audio']['images']);?>&amp;color=0066cc"></iframe>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <!--image media-->
            <?php else:?>
                <?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID),'post-thumbnails');?>
                <?php if(!empty($image)):?>
                    <div class="blog-img" data-ix="show-portfolio-overlay">
                        <a class="w-inline-block portfolio-overlay" href="#">
                            <div class="pico-wrp pico-bg">
                                <div class="portfolio-ico" data-ix="zom-out-pico">
                                    <div class="w-embed"><i class="fa fa-pencil"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <img src="<?php echo esc_url($image);?>" alt="">
                    </div>
                <?php endif;?>
            <?php endif;?>
    </div>
    <div class="space">
        <h3 class="portfolio-tittle"><a class="blog-link" href="<?php echo esc_url($permalink); ?>"><?php the_title(); ?></a></h3>
        <div class="meta-tag">
            <div><?php _e('By','fw'); ?>
                <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="email"><?php echo get_the_author();?></a>
                <span class="blue">/</span> <?php echo get_the_date(); ?> <span class="blue">/</span>
                <?php
                $post_categories = wp_get_post_categories($post->ID);
                $cats = "";
                foreach ($post_categories as $c) {
                    $cat = get_category($c);
                    $cats .= '<a class="email" href="'.esc_url(get_category_link( $cat->term_id )).'">'.$cat->name . '</a>, ' ;
                }

                echo substr($cats, 0,  strlen($cats)-2);
                ?>
                <span class="blue">/</span> <?php comments_number( __( '0 Comments', 'fw' ), __( '1 Comment', 'fw' ), __( '% Comments', 'fw' ) ); ?>
            </div>
        </div>
        <?php
            the_content();
            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'fw' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
        ?>
        <div class="w-clearfix space x2">

            <div class="post_categories_tags"><?php the_tags(); ?></div>

            <div class="share-post">
                <div class="w-widget w-widget-gplus">
                    <div class="g-plusone" data-href="<?php echo esc_url($permalink); ?>" data-size="tall" data-annotation="bubble" data-width="120" data-recommendations="false" id="___plusone_0" style="width: 50px; height: 60px; text-indent: 0px; margin: 0px; padding: 0px; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; background: transparent;"></div>
                </div>
            </div>
            <div class="share-post">
                <div class="w-widget w-widget-twitter">
                    <iframe src="https://platform.twitter.com/widgets/tweet_button.html#url=<?php echo esc_url($permalink); ?>&amp;counturl=<?php echo esc_url($permalink); ?>&amp;text=Check%20out%20this%20post!&amp;count=vertical&amp;size=m&amp;dnt=true"  style="border: none; overflow: hidden; width: 60px;"></iframe>
                </div>
            </div>
            <div class="share-post">
                <div class="w-widget w-widget-facebook">
                    <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo esc_url($permalink); ?>&amp;layout=box_count&amp;locale=en_US&amp;action=like&amp;show_faces=false&amp;share=false" style="border: none; overflow: hidden; width: 48px; height: 65px;"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="divider-space less-space">
    <div class="divider-1-pattern"></div>
</div>
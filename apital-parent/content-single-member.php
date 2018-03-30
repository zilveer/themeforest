<?php
/**
 * The default template for displaying post details
 */
?>
<?php
    $permalink = get_permalink();
    $fb = fw_get_db_post_option($post->ID,'fb');
    $tw = fw_get_db_post_option($post->ID,'tw');
    $lk = fw_get_db_post_option($post->ID,'lk');
    $rss = fw_get_db_post_option($post->ID,'rss');
    $job = fw_get_db_post_option($post->ID,'job');
?>
<article class="single-member mix mix-3" data-ix="show-portfolio-overlay">
    <div class="tm-margin" data-ix="show-social-team">
        <div class="team-img-wrapper">
            <?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID),'post-thumbnails');?>
            <?php if(!empty($image)):?>
                <img src="<?php echo esc_url($image);?>" alt="<?php the_title(); ?>">
            <?php endif;?>

            <?php if(!empty($fb) || !empty($tw) || !empty($lk) || !empty($rss)):?>
                <div class="overlay-team" data-ix="move-social-team">
                    <?php if(!empty($fb)):?>
                        <a class="w-inline-block soc-team" href="<?php echo esc_url($fb);?>" target="_blank">
                            <div class="w-embed"><i class="fa fa-facebook"></i>
                            </div>
                        </a>
                    <?php endif;?>

                    <?php if(!empty($tw)):?>
                        <a class="w-inline-block soc-team" href="<?php echo esc_url($tw);?>" target="_blank">
                            <div class="w-embed"><i class="fa fa-twitter"></i>
                            </div>
                        </a>
                    <?php endif;?>

                    <?php if(!empty($lk)):?>
                        <a class="w-inline-block soc-team" href="<?php echo esc_url($lk);?>" target="_blank">
                            <div class="w-embed"><i class="fa fa-linkedin"></i>
                            </div>
                        </a>
                    <?php endif;?>

                    <?php if(!empty($rss)):?>
                        <a class="w-inline-block soc-team" href="<?php echo esc_url($rss);?>" target="_blank">
                            <div class="w-embed"><i class="fa fa-rss"></i>
                            </div>
                        </a>
                    <?php endif;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</article>
<div class="blog-post">
    <div class="space">
        <h3 class="portfolio-tittle"><a class="blog-link" href="<?php echo esc_url($permalink); ?>"><?php the_title(); ?></a></h3>
        <div class="meta-tag">
            <div><?php _e('By','fw'); ?>
                <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="email"><?php echo get_the_author();?></a>
                <span class="blue">/</span> <?php echo get_the_date(); ?> <span class="blue">/</span>
                <?php
                $post_categories = wp_get_post_terms($post->ID, 'fw-members');
                $cats = "";
                foreach ($post_categories as $cat) {
                    $cats .= '<a class="email" href="'.esc_url(get_term_link( $cat->term_id, 'fw-members' )).'">'.$cat->name . '</a>, ' ;
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
                    <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo esc_url($permalink); ?>&amp;layout=box_count&amp;locale=en_US&amp;action=like&amp;show_faces=false&amp;share=false" style="border: none; overflow: hidden; width: 50px; height: 65px;"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="divider-space less-space">
    <div class="divider-1-pattern"></div>
</div>
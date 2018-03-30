<?php
/**
 * The template for displaying sticky posts in the Image post format
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
<article class="mix mix-3" data-ix="show-portfolio-overlay">
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
        <div class="space hero-center-div">
            <a href="<?php echo esc_url($permalink); ?>"><h5><span class="blue"><?php the_title(); ?></span></h5></a>
            <?php if(!empty($job)):?>
                <div class="sub-tittle-team"><?php echo fw_theme_translate(esc_html($job));?></div>
            <?php endif;?>
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>
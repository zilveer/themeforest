<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$team = $atts['team'];
?>
<!--members type grid-->
<?php if($team['type'] == 'grid'):?>

    <!--show filter if enabled-->
    <?php if($team['grid']['filter'] == 'yes'):?>

        <?php $all_terms = get_terms(array('fw-members'), array("fields" => "all"));?>
        <?php if(!empty($all_terms)):?>
            <div class="filters">
                <ul class="w-list-unstyled filter-ul">
                    <li class="filter active" data-filter="all">
                        <a class="flt-lnk" href="#"><?php _e('All','fw');?></a>
                    </li>
                    <?php foreach($all_terms as $one_term): ?>
                        <li class="filter" data-filter=".<?php echo esc_attr($one_term->slug);?>">
                            <a class="flt-lnk" href="#">
                                <?php echo esc_attr($one_term->name) ;?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php
        $the_query = new WP_Query(array(
            'posts_per_page' => 50,
            'post_type' => 'fw-member'
        ));
    ?>
    <?php if ( $the_query->have_posts() ) : ?>
        <div class="w-clearfix grid <?php echo esc_attr($atts['class']);?>" id="Grid">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); global $post;?>
                <?php
                    $permalink = get_permalink();
                    $fb = fw_get_db_post_option($post->ID,'fb');
                    $tw = fw_get_db_post_option($post->ID,'tw');
                    $lk = fw_get_db_post_option($post->ID,'lk');
                    $rss = fw_get_db_post_option($post->ID,'rss');
                    $job = fw_get_db_post_option($post->ID,'job');

                    //get post terms to make the sort
                    $terms = wp_get_post_terms( $post->ID, 'fw-members', array('fields' => 'slugs') );
                    $terms = !empty($terms) ? implode(' ', $terms) : '';

                ?>
                <article class="mix mix-3 team-members <?php echo esc_attr($terms);?>" data-ix="show-portfolio-overlay">
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
            <?php endwhile;?>
        </div>
    <?php endif; wp_reset_postdata();?>
<!--//members type single-->
<?php else:?>
    <?php
        $post_id = (int)$team['single']['post'];

        if(empty($post_id) || $post_id == 0) return;

        //get post
        $post = get_post($post_id);
        $permalink = get_permalink($post_id);
        //get socials
        $fb = fw_get_db_post_option($post_id,'fb');
        $tw = fw_get_db_post_option($post_id,'tw');
        $lk = fw_get_db_post_option($post_id,'lk');
        $rss = fw_get_db_post_option($post_id,'rss');
        $job = fw_get_db_post_option($post_id,'job');
    ?>
    <div data-ix="show-social-team" class="team-members">
        <div class="team-img-wrapper">
            <?php $image = wp_get_attachment_url( get_post_thumbnail_id($post_id),'post-thumbnails');?>
            <?php if(!empty($image)):?>
                <img src="<?php echo esc_url($image);?>" alt="<?php get_the_title($post_id); ?>">
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
            <a href="<?php echo esc_url($permalink); ?>">
                <h5><span class="blue"><?php echo get_the_title($post_id); ?></span></h5>
            </a>
            <?php if(!empty($job)):?>
                <div class="sub-tittle-team"><?php echo fw_theme_translate(esc_html($job));?></div>
            <?php endif;?>
            <span class="like-p"><?php echo do_shortcode($post->post_excerpt); ?></span>
        </div>
    </div>
<?php endif;?>
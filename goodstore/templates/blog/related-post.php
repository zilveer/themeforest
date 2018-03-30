<?php
if (jwOpt::get_option('post_relatedpost', '1')) {

    list($tagargs, $catargs) = jwRender::get_related_post(get_the_ID());
    $query = new WP_Query($tagargs);


    if (!($query->have_posts())) {
        wp_reset_query();
        $query = new WP_Query($catargs);
    }
    if ($query->have_posts()) {
        ?>

        <div id="related" class="tab-post-row">

            <div class="row section-header box">
                <div class="section-big-wrapper">
                    <h3 class="section-big"><?php _e('Related Posts', 'jawtemplates'); ?></h3>
                </div>
            </div>

            <?php while ($query->have_posts()) : $query->the_post(); ?>

                <?php
                $class = 'no-thumbnail';
                if (jwUtils::has_post_thumbnail()) {
                    $class = 'has-thumbnail';
                }
                if (jwOpt::get_option('post_relatedpost_images', '1') == '0') {
                    $class = 'no-related-thumbnail';
                }
                ?>
                <div class="related-box <?php echo esc_attr($class); ?>">
                    <?php if (has_post_thumbnail() && jwOpt::get_option('post_relatedpost_images', '1') == '1') {
                        ?>

                        <div class="tab-post-widget-img">
                            <a href="<?php the_permalink(); ?>"><?php jwUtils::the_post_thumbnail('post-size'); ?></a>
                        </div>
                        <div class="tab-post-widget-content">
                            <h4> 
                                <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                            </h4>
                            <?php echo jwUtils::crop_length(jwRender::get_the_excerpt(), 95); ?>
                        </div>
                    <?php } else {
                        ?>
                        <div class="tab-post-widget-content">
                            <h4>
                                <a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a>
                            </h4>
                            <?php echo jwUtils::crop_length(jwRender::get_the_excerpt(), 95); ?>
                        </div>    
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            <?php endwhile;
            ?>
            <div class="clear"></div>
        </div>
        <?php
    } wp_reset_query();
}


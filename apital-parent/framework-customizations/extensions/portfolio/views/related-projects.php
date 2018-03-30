<?php
    $related_projects = fw_theme_related_articles();

    if(!empty($related_projects)): ?>
        <!-- RECENT PROJECT -->
        <section class="w-section section light-gray">
            <div class="w-container">
                <div class="tittle-line">
                    <h5><?php _e('related works','fw');?></h5>
                    <div class="divider-1 small">
                        <div class="divider-small"></div>
                    </div>
                </div>
                <div data-ix="show-carousel-pagination">
                    <div class="w-slider carousel-project" data-animation="slide" data-duration="500" data-infinite="1" data-nav-spacing="5">
                        <div class="w-slider-mask">

                            <?php
                            $cnt = 0; foreach($related_projects as $rel_post):  $cnt++;

                                $term_list = wp_get_post_terms($rel_post->ID, 'fw-portfolio-category', array("fields" => "names"));
                                $thumbnail_id = get_post_thumbnail_id($rel_post->ID);
                                if( !empty( $thumbnail_id ) ) {
                                    $thumbnail    = get_post( $thumbnail_id );
                                    $image        = wp_get_attachment_image_src($thumbnail->ID, array(283,227));
                                    $thumbnail_title = $thumbnail->post_title;
                                } else {
                                    $image = '';
                                    $thumbnail_title = '';
                                }
                                ?>

                                <?php if($cnt == 1 || ($cnt-1) % 4 == 0):?>
                                    <div class="w-slide w-clearfix">
                                <?php endif;?>

                                <article class="mix" data-ix="show-portfolio-overlay">
                                    <div class="portfolio-wrapper">
                                        <div>
                                            <?php if(!empty($image)):?>
                                                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr($thumbnail_title); ?>">
                                                <a class="w-inline-block portfolio-overlay" href="<?php echo esc_url(get_permalink($rel_post->ID)); ?>">
                                                    <div class="pico-wrp">
                                                        <div class="portfolio-ico" data-ix="zom-out-pico">
                                                            <div class="w-embed"><i class="fa fa-share"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <a class="w-inline-block portfolio-text-wrapper" href="<?php echo esc_url(get_permalink($rel_post->ID)); ?>">
                                        <h5 class="portfolio-tittle"><?php echo get_the_title($rel_post->ID); ?></h5>
                                        <?php if(!empty($term_list)):?>
                                            <div class="portfolio-sub">
                                                <?php $names = '';
                                                foreach($term_list as $term):
                                                    $names .= strtolower($term) . ', ';
                                                endforeach;

                                                echo substr($names, 0,  strlen($names)-2);
                                                ?>
                                            </div>
                                        <?php endif;?>
                                    </a>
                                </article>

                                <?php if($cnt % 4 == 0 || $cnt == count($related_projects)):?>
                                    </div>
                                <?php endif;?>

                            <?php endforeach;?>
                        </div>

                        <div class="w-slider-arrow-left w-hidden-medium w-hidden-small w-hidden-tiny vertical-pagination">
                            <div class="w-icon-slider-left carousel-arrow"></div>
                        </div>
                        <div class="w-slider-arrow-right w-hidden-medium w-hidden-small w-hidden-tiny vertical-pagination">
                            <div class="w-icon-slider-right carousel-arrow"></div>
                        </div>
                        <div class="w-slider-nav w-slider-nav-invert w-round carousel-dots"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END RECENT PROJECT -->
    <?php endif;
?>
<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$posts_per_page = $atts['posts_per_page'];

$the_query = new WP_Query(array(
    'posts_per_page' => $posts_per_page,
    'post_type' => 'fw-portfolio',
    'orderby' => 'date'
));

$count = count($the_query->get_posts());

//get projects view type
$portf_view = $atts['view_type'];
?>
<?php if ( $the_query->have_posts() ) : ?>

    <?php if($portf_view['view'] == 'desc'):?>
        <div class="portfolio-with-description <?php echo esc_attr($atts['class']);?>">
            <div class="w-col w-col-3">
                <div>
                    <p>
                        <?php echo fw_theme_translate(esc_html($portf_view['desc']['desc']));?>
                        <br>
                        <br>
                        <?php if(!empty($portf_view['desc']['link-text'])):?>
                            <a class="link" href="<?php echo esc_url($portf_view['desc']['url']);?>"><?php echo fw_theme_translate(esc_html($portf_view['desc']['link-text'])); ?> →</a>
                        <?php endif;?>
                    </p>
                </div>
            </div>
            <div class="w-col w-col-9 res-space">
                <div data-ix="show-carousel-pagination">
                    <div class="w-slider carousel-project" data-animation="slide" data-duration="500" data-infinite="1" data-nav-spacing="5">
                        <div class="w-slider-mask">
                            <?php $cnt = 0; while ( $the_query->have_posts() ) : $the_query->the_post(); $cnt++; global $post;?>
                                <?php
                                //get post thumbnail
                                $thumbnail_id = get_post_thumbnail_id();
                                if( !empty( $thumbnail_id ) ) {
                                    $thumbnail    = get_post( $thumbnail_id );
                                    $image        = wp_get_attachment_image_src($thumbnail->ID,array(1440,960));
                                    $thumbnail_title = $thumbnail->post_title;
                                } else {
                                    $image = '';
                                    $thumbnail_title = '';
                                }

                                $term_list = wp_get_post_terms($post->ID, 'fw-portfolio-category', array("fields" => "names"));
                                ?>

                                <?php if($cnt == 1 || ($cnt-1) % 3 == 0):?>
                                    <div class="w-slide w-clearfix">
                                <?php endif;?>

                                <article class="mix mix-3" data-ix="show-portfolio-overlay">
                                    <div class="portfolio-wrapper">
                                        <div>
                                            <?php if(!empty($image)):?>
                                                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr($thumbnail_title); ?>">
                                                <a class="w-inline-block portfolio-overlay" href="<?php the_permalink() ?>">
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
                                    <a class="w-inline-block portfolio-text-wrapper" href="<?php the_permalink() ?>">
                                        <h5 class="portfolio-tittle"><?php the_title(); ?></h5>
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

                                <?php if($cnt % 3 == 0 || $cnt == $count):?>
                                    </div>
                                <?php endif;?>
                            <?php endwhile; wp_reset_postdata();?>
                        </div>
                        <div class="w-slider-nav w-slider-nav-invert w-round carousel-dots"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php else:?>
        <div data-ix="show-carousel-pagination" class="<?php echo esc_attr($atts['class']);?>">
            <div class="w-slider carousel-project" data-animation="slide" data-duration="500" data-infinite="1" data-nav-spacing="5">
                <div class="w-slider-mask">
                    <?php $cnt = 0; while ( $the_query->have_posts() ) : $the_query->the_post(); $cnt++; global $post;?>
                        <?php
                            //get post thumbnail
                            $thumbnail_id = get_post_thumbnail_id();
                            if( !empty( $thumbnail_id ) ) {
                                $thumbnail    = get_post( $thumbnail_id );
                                $image        = wp_get_attachment_image_src($thumbnail->ID,array(1440,960));
                                $thumbnail_title = $thumbnail->post_title;
                            } else {
                                $image = '';
                                $thumbnail_title = '';
                            }

                            $term_list = wp_get_post_terms($post->ID, 'fw-portfolio-category', array("fields" => "names"));
                        ?>

                        <?php if($cnt == 1 || ($cnt-1) % 4 == 0):?>
                            <div class="w-slide w-clearfix">
                        <?php endif;?>

                                <article class="mix" data-ix="show-portfolio-overlay">
                                    <div class="portfolio-wrapper">
                                        <div>
                                            <?php if(!empty($image)):?>
                                                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr($thumbnail_title); ?>">
                                                <a class="w-inline-block portfolio-overlay" href="<?php the_permalink() ?>">
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
                                    <a class="w-inline-block portfolio-text-wrapper" href="<?php the_permalink() ?>">
                                        <h5 class="portfolio-tittle"><?php the_title(); ?></h5>
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

                        <?php if($cnt % 4 == 0 || $cnt == $count):?>
                            </div>
                        <?php endif;?>
                    <?php endwhile; wp_reset_postdata();?>
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

    <?php endif;?>

<?php endif;?>
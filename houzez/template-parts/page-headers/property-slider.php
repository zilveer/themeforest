<?php
/**
 * Property Slider
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 21/12/15
 * Time: 2:24 PM
 */
global $post, $adv_search_which_header_show, $adv_search_over_header_pages, $adv_search_selected_pages;
?>
<div class="header-media">
    <div id="banner-module" class="banner-module">
    <div class="container-fluid">
        <div class="service-blocks-main">
            <div class="row">
                <div class="col-sm-12 no-padding">
                    <div id="banner-slider" class="banner-slider slide-animated">
                        <?php
                        $args = array(
                            'post_type' => 'property',
                            'meta_key' => 'fave_prop_homeslider',
                            'meta_value' => 'yes',
                            'posts_per_page' => '-1'
                        );
                        $slider = new WP_Query( $args );

                        if( $slider->have_posts() ): while( $slider->have_posts() ): $slider->the_post();
                            $slider_img = get_post_meta( $post->ID, 'fave_prop_slider_image', true );
                            $prop_address       = get_post_meta( $post->ID, 'fave_property_map_address', true );
                            $prop_featured = get_post_meta( $post->ID, 'fave_featured', true );
                            $prop_agent_display = get_post_meta( get_the_ID(), 'fave_agent_display_option', true );

                            $prop_agent_num = $agent_num_call = $prop_agent = '';
                            if( $prop_agent_display != 'none' && $prop_agent_display != '' ) {
                                if( $prop_agent_display == 'agent_info' ) {
                                    $prop_agent_id = get_post_meta( get_the_ID(), 'fave_agents', true );
                                    $prop_agent_num = get_post_meta( $prop_agent_id, 'fave_agent_mobile', true );
                                    $agent_num_call = str_replace(array('(',')',' ','-'),'', $prop_agent_num);
                                    $prop_agent = get_the_title( $prop_agent_id );
                                }
                            }
                            $imag_url = wp_get_attachment_image_src( $slider_img, 'fave-prop_image1440_610', true );

                        ?>

                            <div class="item fave-screen-fix fave-mobile-screen-fix" style="background-image: url(<?php echo $imag_url[0];?>)">
                                <a href="<?php the_permalink(); ?>" class="banner-link"></a>
                                <div class="slider-caption caption-desktop hidden-xs">
                                    <?php if( $prop_featured != 0 ) { ?>
                                    <div class="label-featured label label-success"><?php esc_html_e( 'Featured', 'houzez' ); ?></div>
                                    <?php } ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-detail"><?php esc_html_e( 'Details', 'houzez' ); ?> <i class="fa fa-angle-right"></i></a>
                                    <div class="item-body">
                                        <div class="body-left">
                                            <div class="price">
                                                <?php echo houzez_listing_price_v1(); ?>
                                            </div>
                                            <div class="info-row">
                                                <?php get_template_part('template-parts/listing', 'rating' ); ?>

                                                <p class="property-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                                <?php
                                                if( !empty( $prop_address )) {
                                                    echo '<address class="property-address">'.esc_attr( $prop_address ).'</address>';
                                                }
                                                ?>
                                            </div>
                                            <div class="info-row amenities">
                                                <?php echo houzez_listing_meta_v1(); ?>
                                                <p><?php echo houzez_taxonomy_simple('property_type'); ?></p>
                                            </div>
                                            <div class="info-row date">
                                            <?php if( !empty( $prop_agent ) ) { ?>
                                                <p><i class="fa fa-user"></i> <a href="#"><?php echo esc_attr( $prop_agent ); ?></a></p>
                                            <?php } ?>
                                            <p><i class="fa fa-calendar"></i><?php printf( __( '%s ago', 'houzez' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider-caption caption-mobile visible-xs">
                                    <?php if( $prop_featured != 0 ) { ?>
                                        <div class="feature-label"><?php esc_html_e( 'Featured', 'houzez' ); ?></div>
                                    <?php } ?>
                                    <div class="item-body table-list">
                                        <div class="body-left table-cell">

                                            <div class="info-row">
                                                <?php get_template_part('template-parts/listing', 'rating' ); ?>

                                                <p class="property-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                                <?php
                                                if( !empty( $prop_address )) {
                                                    echo '<address class="property-address">'.esc_attr( $prop_address ).'</address>';
                                                }
                                                ?>
                                            </div>
                                            <div class="info-row price">
                                                <?php echo houzez_listing_price_v1(); ?>
                                            </div>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-detail table-cell"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                                <?php
                                if( !empty($slider_img) ) {
                                    ?>
                                    <a href="<?php the_permalink(); ?>">
                                    <?php //echo wp_get_attachment_image( $slider_img, 'fave-prop_image1440_610' );
                                    /*$imag_url = houzez_get_image_url( 'fave-prop_image1440_610');
                                        echo $imag_url[1];*/
                                    ?>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php houzez_image_placeholder( 'fave-prop_image1440_610' );?>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>

                        <?php endwhile; endif; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
    if( $adv_search_which_header_show['header_ps'] != 0 ) {
        if( $adv_search_over_header_pages == 'only_home' ) {
            if (is_front_page()) {
                get_template_part('template-parts/advanced-search/desktop', 'type2');
            }
        } else if( $adv_search_over_header_pages == 'all_pages' ) {
            get_template_part('template-parts/advanced-search/desktop', 'type2');

        } else if ( $adv_search_over_header_pages == 'only_innerpages' ){
            if (!is_front_page()) {
                get_template_part('template-parts/advanced-search/desktop', 'type2');
            }
        } else if( $adv_search_over_header_pages == 'specific_pages' ) {
            if( is_page( $adv_search_selected_pages ) ) {
                get_template_part('template-parts/advanced-search/desktop', 'type2');
            }
        }
    }
    ?>
</div>

<?php
global $porto_settings, $porto_layout;

$portfolio_layout = 'carousel';

$portfolio_info = get_post_meta($post->ID, 'portfolio_info', true);
$portfolio_link = get_post_meta($post->ID, 'portfolio_link', true);
$skill_list = get_the_term_list($post->ID, 'portfolio_skills', '', '</li><li><i class="fa fa-check-circle"></i> ', '');
$portfolio_location = get_post_meta($post->ID, 'portfolio_location', true);
$portfolio_client = get_post_meta($post->ID, 'portfolio_client', true);
$portfolio_client_link = get_post_meta($post->ID, 'portfolio_client_link', true);
$portfolio_author_quote = get_post_meta($post->ID, 'portfolio_author_quote', true);
$portfolio_author_name = get_post_meta($post->ID, 'portfolio_author_name', true);
$portfolio_author_image = get_post_meta($post->ID, 'portfolio_author_image', true);
$portfolio_author_role = get_post_meta($post->ID, 'portfolio_author_role', true);

$share = porto_get_meta_value('portfolio_share');

$post_class = array();
$post_class[] = 'portfolio-' . $portfolio_layout;
if (!$porto_settings['portfolio-page-nav'] && $porto_layout === 'fullwidth')
    $post_class[] = ' m-t-n-xl';

if ($porto_settings['post-title-style'] == 'without-icon')
    $post_class[] = 'post-title-simple';
?>

<article <?php post_class($post_class); ?>>

    <?php if ($porto_settings['portfolio-page-nav']) : ?>
    <div class="portfolio-title<?php echo ($porto_layout === 'widewidth' ? ' container m-t-lg' : '') ?>">
        <div class="row m-b-xl">
            <div class="portfolio-nav-all col-md-1">
                <a title="<?php _e('Back to list', 'porto') ?>" data-tooltip href="<?php echo get_post_type_archive_link( 'portfolio' ) ?>"><i class="fa fa-th"></i></a>
            </div>
            <div class="col-md-10 text-center">
                <h2 class="entry-title shorter"><?php the_title(); ?></h2>
            </div>
            <div class="portfolio-nav col-md-1">
                <?php previous_post_link('%link', '<div data-tooltip title="'.__('Previous', 'porto').'" class="portfolio-nav-prev"><i class="fa"></i></div>'); ?>
                <?php next_post_link('%link', '<div data-tooltip title="'.__('Next', 'porto').'" class="portfolio-nav-next"><i class="fa"></i></div>'); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php porto_render_rich_snippets( false ); ?>

    <?php
    // Portfolio Carousel
    $slideshow_type = get_post_meta($post->ID, 'slideshow_type', true);

    if (!$slideshow_type)
        $slideshow_type = 'images';

    if ($slideshow_type != 'none') : ?>
        <?php if ($slideshow_type == 'images') :
            $featured_images = porto_get_featured_images();
            $count = count($featured_images);
            $i = 1;

            if ($count) :
            ?>
            <div id="revolutionSliderCarouselContainer" class="rev_slider_wrapper fullwidthbanner-container m-b-none br-none" data-alias="" style="background: #f3f3f2;">
                <div id="revolutionSliderCarousel" class="rev_slider fullwidthabanner" data-version="5.2.1">
                    <ul>
                        <?php
                        foreach ($featured_images as $featured_image) {
                            $attachment = porto_get_attachment($featured_image['attachment_id']);
                            if ($attachment) {
                                ?>
                                <li data-index="rs-<?php echo $i++ ?>" data-transition="fade" data-slotamount="7" data-easein="default" data-easeout="default" data-masterspeed="300" data-rotate="0" data-saveperformance="off" data-title="" data-description="">
                                    <img width="<?php echo $attachment['width'] ?>" height="<?php echo $attachment['height'] ?>" src="<?php echo $attachment['src'] ?>" alt="<?php echo $attachment['alt'] ?>" data-bgposition="center center" data-bgfit="contain" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                </li>
                            <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                (function($) {
                    'use strict';
                    if ($.isFunction($.fn.revolution)) {
                        $("#revolutionSliderCarousel").show().revolution({
                            sliderType: "carousel",
                            sliderLayout: "<?php echo (porto_get_wrapper_type() == 'boxed' || $porto_settings['main-wrapper'] == 'boxed' || (porto_is_ajax() && isset($_POST['ajax_action']) && $_POST['ajax_action'] == 'portfolio_ajax_modal')) ? 'auto' : 'fullwidth' ?>",
                            dottedOverlay: "none",
                            delay: 4000,
                            navigation: {
                                keyboardNavigation: "off",
                                keyboard_direction: "horizontal",
                                mouseScrollNavigation: "off",
                                onHoverStop: "off",
                                arrows: {
                                    style: "tparrows-carousel",
                                    enable: true,
                                    hide_onmobile: false,
                                    hide_onleave: false,
                                    tmp: '',
                                    left: {
                                        h_align: "left",
                                        v_align: "center",
                                        h_offset: 30,
                                        v_offset: 0
                                    },
                                    right: {
                                        h_align: "right",
                                        v_align: "center",
                                        h_offset: 30,
                                        v_offset: 0
                                    }
                                }
                            },
                            carousel: {
                                maxRotation: 65,
                                vary_rotation: "on",
                                minScale: 55,
                                vary_scale: "off",
                                horizontal_align: "center",
                                vertical_align: "center",
                                fadeout: "on",
                                vary_fade: "on",
                                maxVisibleItems: 5,
                                infinity: "on",
                                space: -150,
                                stretch: "off"
                            },
                            gridwidth: 600,
                            gridheight: 600,
                            lazyType: "none",
                            shadow: 0,
                            spinner: "off",
                            stopLoop: "on",
                            stopAfterLoops: 0,
                            stopAtSlide: 3,
                            shuffle: "off",
                            autoHeight: "off",
                            disableProgressBar: "on",
                            hideThumbsOnMobile: "off",
                            hideSliderAtLimit: 0,
                            hideCaptionAtLimit: 0,
                            hideAllCaptionAtLilmit: 0,
                            debugMode: false,
                            fallbacks: {
                                simplifyAll: "off",
                                nextSlideOnWindowFocus: "off",
                                disableFocusListener: false
                            }
                        });
                    }
                }).apply(this, [jQuery]);
            </script>
            <?php
            endif;
        endif;
        ?>

        <?php
        if ($slideshow_type == 'video') {
            $video_code = get_post_meta($post->ID, 'video_code', true);
            if ($video_code) {
                ?>
                <div class="portfolio-image single">
                    <div class="img-thumbnail fit-video<?php if ($porto_layout === 'widewidth') echo ' img-thumbnail-no-borders' ?>">
                        <?php echo do_shortcode($video_code) ?>
                    </div>
                </div>
            <?php
            }
        }
    endif;
    ?>

    <div class="m-t-xl<?php echo ($porto_layout === 'widewidth' ? ' container' : '') ?>">
        <div class="portfolio-info pt-none">
            <ul>
                <?php if (in_array('like', $porto_settings['portfolio-metas'])) : ?>
                    <li>
                        <?php echo porto_portfolio_like() ?>
                    </li>
                <?php endif;
                if (in_array('date', $porto_settings['portfolio-metas'])) : ?>
                    <li>
                        <i class="fa fa-calendar"></i> <?php echo get_the_date() ?>
                    </li>
                <?php endif;
                $cat_list = get_the_term_list($post->ID, 'portfolio_cat', '', ', ', '');
                if (in_array('cats', $porto_settings['portfolio-metas']) && $cat_list) : ?>
                    <li>
                        <i class="fa fa-tags"></i> <?php echo $cat_list ?>
                    </li>
                <?php endif; ?>
                <?php
                if (function_exists('Post_Views_Counter') && Post_Views_Counter()->options['display']['position'] == 'manual') {
                    $post_count = do_shortcode('[post-views]');
                    if ($post_count) : ?>
                        <li>
                            <?php echo $post_count ?>
                        </li>
                    <?php endif;
                }
                ?>
            </ul>
        </div>

        <div class="row">
            <?php
            $show_related = false;
            if ($porto_settings['portfolio-related']) {
                $related_portfolios = porto_get_related_portfolios($post->ID);
                if ($related_portfolios->have_posts())
                    $show_related = true;
            }
            ?>
            <div class="col-md-<?php echo $show_related ? 9 : 12 ?> m-t-sm m-b-lg">
                <h5 class="portfolio-desc m-t-sm"><?php _e('Project Description', 'porto') ?></h5>

                <div class="post-content">

                    <?php
                    the_content();
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'porto' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'porto' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                    ?>

                    <div class="post-gap-small"></div>

                </div>

                <?php if ($portfolio_info) : ?>
                    <h5 class="m-t-sm"><?php _e('More Information', 'porto') ?></h5>
                    <div class="m-b-lg">
                        <?php echo do_shortcode(wpautop($portfolio_info)) ?>
                    </div>
                <?php endif; ?>

                <?php
                if ($portfolio_link) :
                    ?>
                    <div class="post-gap-small"></div>

                    <a target="_blank" class="btn btn-primary btn-icon" href="<?php echo esc_url($portfolio_link) ?>">
                        <i class="fa fa-external-link"></i><?php _e('Live Preview', 'porto') ?>
                    </a>

                    <span data-appear-animation-delay="800" data-appear-animation="rotateInUpLeft" class="dir-arrow <?php echo 'hlb' ?>"></span>

                    <div class="post-gap"></div>
                <?php endif; ?>

                <ul class="portfolio-details">
                    <?php
                    if (in_array('skills', $porto_settings['portfolio-metas']) && $skill_list) : ?>
                        <li>
                            <h5><?php _e('Skills', 'porto') ?></h5>
                            <ul class="list list-skills icons list-unstyled list-inline">
                                <li><i class="fa fa-check-circle"></i>
                                    <?php echo $skill_list ?>
                                </li>
                            </ul>
                        </li>
                    <?php
                    endif;
                    if (in_array('location', $porto_settings['portfolio-metas']) && $portfolio_location) : ?>
                        <li>
                            <h5 class="m-t-md"><?php _e('Location', 'porto') ?></h5>
                            <p><?php echo esc_html($portfolio_location); ?></p>
                        </li>
                    <?php
                    endif;
                    if (in_array('client', $porto_settings['portfolio-metas']) && $portfolio_client) : ?>
                        <li>
                            <h5 class="m-t-md"><?php _e('Client', 'porto') ?></h5>
                            <p><?php echo esc_html($portfolio_client); if ($portfolio_client_link): ?> - <a href="<?php echo $portfolio_client_link ?>" target="_blank"><i class="fa fa-external-link"></i> <?php echo $portfolio_client_link ?></a><?php endif; ?></p>
                        </li>
                    <?php
                    endif;
                    if (in_array('quote', $porto_settings['portfolio-metas']) && $portfolio_author_quote) :
                        ?>
                        <li>
                            <div class="testimonial testimonial-style-4">
                                <blockquote>
                                    <p><?php echo $portfolio_author_quote ?></p>
                                </blockquote>
                                <div class="testimonial-arrow-down"></div>
                                <div class="testimonial-author">
                                    <?php if ($portfolio_author_image) : ?>
                                        <div class="testimonial-author-thumbnail">
                                            <img alt="" class="img-responsive img-circle" src="<?php echo esc_url($portfolio_author_image) ?>">
                                        </div>
                                    <?php endif; ?>
                                    <p><strong><?php echo $portfolio_author_name ?></strong><span><?php echo $portfolio_author_role ?></span></p>
                                </div>
                            </div>
                        </li>
                    <?php
                    endif;
                    if ($porto_settings['share-enable'] && 'no' !== $share && ('yes' === $share || ('yes' !== $share && $porto_settings['portfolio-share']))) : ?>
                        <li>
                            <h5 class="m-t-md"><?php _e('Share', 'porto') ?></h5>
                            <?php get_template_part('share') ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php if ($show_related) : ?>
            <div class="col-md-3 m-t-sm">
                <?php
                $options = array();
                $options['themeConfig'] = true;
                $options['lg'] = 1;
                $options['md'] = 3;
                $options['sm'] = 2;
                $options = json_encode($options);
                if ($related_portfolios->have_posts()) : ?>
                    <div class="related-portfolios m-t-none <?php echo $porto_settings['portfolio-related-style'] ?>">
                        <h5 class="portfolio-desc m-t-sm"><?php echo __('Related <strong>Work</strong>', 'porto'); ?></h5>
                        <div class="row">
                            <div class="portfolio-carousel porto-carousel owl-carousel show-nav-title" data-plugin-options="<?php echo esc_attr($options) ?>">
                                <?php
                                while ($related_portfolios->have_posts()) {
                                    $related_portfolios->the_post();

                                    get_template_part('content', 'portfolio-item');
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif ?>
        </div>

        <?php if ($porto_settings['portfolio-author']) : ?>
            <div class="post-gap"></div>
            <div class="post-block post-author clearfix">
                <?php if ($porto_settings['post-title-style'] == 'without-icon') : ?>
                    <h4><?php _e('Author', 'porto') ?></h4>
                <?php else : ?>
                    <h3><i class="fa fa-user"></i><?php _e('Author', 'porto') ?></h3>
                <?php endif; ?>
                <div class="img-thumbnail">
                    <?php echo get_avatar(get_the_author_meta('email'), '80'); ?>
                </div>
                <p><strong class="name"><?php the_author_posts_link(); ?></strong></p>
                <p><?php the_author_meta("description"); ?></p>
            </div>
        <?php endif; ?>

        <?php if ($porto_settings['portfolio-comments']) : ?>
            <div class="post-gap"></div>
            <?php
            wp_reset_postdata();
            comments_template();
            ?>
        <?php endif; ?>

    </div>

</article>
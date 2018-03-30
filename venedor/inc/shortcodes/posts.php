<?php

// Posts
add_shortcode('posts', 'venedor_shortcode_posts');
add_shortcode('posts_slider', 'venedor_shortcode_posts_slider');
function venedor_shortcode_posts($atts, $content = null) {

    extract(shortcode_atts(array(
        'title' => '',
        'layout' => 'grid',
        'cat' => '',
        'post_in' => '',
        'count' => 10,
        'class' => ''
    ), $atts));

    ob_start();
    ?>
    <div class="<?php echo $class ?>">

    <?php
    $args = array(
        'posts_per_page'   => $count,
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'suppress_filters' => true );

    if ($cat)
        $args['cat'] = $cat;

    if ($post_in)
        $args['post__in'] = explode(',', $post_in);

    $posts = new WP_Query( $args );

    global $venedor_settings;
    ?>

    <?php if ( $posts->have_posts() ) : ?>

        <?php
        global $venedor_settings;

        $post_layout = $layout;
        $blog_layout = venedor_meta_layout();
        $blog_infinite = false;

        $wrap_class = '';
        $post_class = '';

        switch ($post_layout) {
            case 'large-alt': $post_class = "large-alt"; break;
            case 'medium-alt': $post_class = "medium-alt"; break;
            case 'small-alt': $post_class = "small-alt"; break;
            case 'grid': $post_class = "grid-post"; $wrap_class = 'grid-layout row'; break;
            case 'timeline': $post_class = "timeline-post"; $wrap_class = 'timeline-layout'; break;
            default: $post_layout = "medium-alt"; $post_class = "medium-alt"; break;
        }

        ?>

        <div class="blog-page-content <?php if ($blog_infinite) echo 'infinite-content' ?>">

            <?php if ($title) : ?><h2 class="page-title"><?php echo $title ?></h2><?php endif; ?>

            <?php if ($post_layout == 'timeline') : ?>
                <div class="timeline-icon"><span class="fa fa-comments-o"></span></div>
            <?php endif; ?>

            <div class="<?php if ($blog_infinite) echo 'posts-infinite' ?> posts-wrap <?php echo $wrap_class ?> clearfix">
                <?php if ($post_layout == 'timeline') : ?>
                    <div class="timeline-content-gap"></div>
                <?php endif; ?>

                <?php
                $post_count = 1;
                $prev_post_timestamp = null;
                $prev_post_month = null;
                $first_timeline_loop = false;
                while ( $posts->have_posts() ): $posts->the_post(); global $post;
                    global $post;
                    $post_timestamp = strtotime($post->post_date);
                    $post_month = date('n', $post_timestamp);
                    $post_year = get_the_date('o');
                    $current_date = get_the_date('o-n');
                    $slideshow_type = get_post_meta($post->ID, 'slideshow_type', true);
                    $classes = ' post-item';
                    global $previousday; unset($previousday);
                    ?>
                    <?php if ($post_layout == 'timeline' && $prev_post_month != $post_month) : $post_count = 1; ?>
                        <div class="timeline-date"><h3 class="timeline-title"><?php echo get_the_date('F Y'); ?></h3></div>
                    <?php endif; ?>

                    <?php if ($post_layout == 'grid') : ?>
                        <?php
                        if (($blog_layout == 'left-sidebar' || $blog_layout == 'right-sidebar'))
                            $classes .= ' col-md-6 col-sm-12';
                        else
                            $classes .= ' col-md-4 col-sm-6 col-xs-12';
                        ?>
                    <?php endif; ?>

                    <?php if ($post_layout == 'timeline') : ?>
                        <?php
                        if (($blog_layout == 'left-sidebar' || $blog_layout == 'right-sidebar'))
                            $classes .= ' col-md-6 col-sm-12'.($post_count % 2 == 1?' align-left':' align-right');
                        else
                            $classes .= ' col-sm-6 col-xs-12'.($post_count % 2 == 1?' align-left':' align-right');
                        ?>
                    <?php endif; ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class($post_class . $classes . ' clearfix'); ?>><div class="inner">

                            <?php // Post Slideshow ?>
                            <?php if ($post_layout == 'large-alt' || $post_layout == 'grid' || $post_layout == 'timeline') : ?>
                                <?php
                                $slideshow_type = get_post_meta($post->ID, 'slideshow_type', true);

                                if ($slideshow_type != 'none') :
                                    ?>
                                    <?php
                                    if ($slideshow_type == 'images' && has_post_thumbnail()) : ?>
                                        <div class="post-slideshow-wrap <?php echo $layout ?>">
                                            <div id="post-slideshow-<?php echo $post->ID ?>" class="post-slideshow owl-carousel">
                                                <?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                                                <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                                                <?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
                                                <div class="post-image">
                                                    <img src="<?php echo str_replace( array( 'http:', 'https:' ), '', $attachment_image[0] ); ?>" alt="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>" data-image="<?php echo $venedor_settings['post-zoom']?$full_image[0]:'' ?>" />
                                                </div>

                                                <?php
                                                $i = 2;
                                                while ($i <= $venedor_settings['post-slideshow-count']) :
                                                    $attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
                                                    if ($attachment_new_id) :
                                                        ?>
                                                        <?php $attachment_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
                                                        <?php $full_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
                                                        <?php $attachment_data = wp_get_attachment_metadata($attachment_new_id); ?>
                                                        <div class="post-image">
                                                            <img src="<?php echo str_replace( array( 'http:', 'https:' ), '', $attachment_image[0] ); ?>" alt="<?php echo get_post_field('post_content', $attachment_new_id); ?>" data-image="<?php echo $venedor_settings['post-zoom']?$full_image[0]:'' ?>" />
                                                        </div>
                                                    <?php endif; $i++; endwhile; ?>
                                            </div>
                                            <?php if ($venedor_settings['post-zoom']) : ?>
                                                <div class="figcaption">
                                                    <span class="btn btn-inverse zoom-button"><span class="fa fa-search"></span></span>
                                                    <a class="btn btn-inverse link-button" href="<?php the_permalink(); ?>"><span class="fa fa-link fa-rotate-90"></span></a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true)): ?>
                                        <div class="post-slideshow-wrap <?php echo $layout ?>">
                                            <div id="post-slideshow-<?php echo $post->ID ?>" class="post-slideshow">
                                                <div class="fit-video">
                                                    <?php echo get_post_meta($post->ID, 'video_code', true); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                endif;
                                ?>
                            <?php endif; ?>

                            <div class="post-content-wrap">

                                <?php if ($post_layout != 'timeline' && $post_layout != 'grid') : ?>
                                    <div class="post-info <?php echo $venedor_settings['post-layout'] ?><?php if (!($slideshow_type == 'images' && has_post_thumbnail()) || ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true))) echo ' none-slideshow' ?>">
                                        <a href="<?php the_permalink() ?>">
                                            <div class="post-date">
                                                <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span>
                                                <span class="post-date-month"><?php echo get_the_time('M', get_the_ID()); ?></span>
                                            </div>
                                            <?php
                                            $post_format = get_post_format();
                                            if ($venedor_settings['post-format'] && $post_format) :
                                            if ($post_format == 'link') {
                                            $ext_link = get_post_meta($post->ID, 'external_url', true);
                                            if ($ext_link) : ?>
                                        </a><a href="<?php echo $ext_link ?>">
                                            <?php else :
                                                $post_format = '';
                                            endif;
                                            }
                                            if ($post_format) : ?>
                                                <div class="post-format <?php echo $post_format ?>">
                                        <span class="fa fa-<?php
                                        switch ($post_format) {
                                            case 'aside': echo 'file-text'; break;
                                            case 'gallery': echo 'camera-retro'; break;
                                            case 'link': echo 'link'; break;
                                            case 'image': echo 'picture-o'; break;
                                            case 'quote': echo 'quote-left'; break;
                                            case 'video': echo 'film'; break;
                                            case 'audio': echo 'music'; break;
                                            case 'chat': echo 'comments'; break;
                                        }
                                        ?>"></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="post-content <?php echo $post_layout ?><?php if (!($slideshow_type == 'images' && has_post_thumbnail()) || ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true))) echo ' none-slideshow' ?>">

                                    <?php // Post Slideshow ?>
                                    <?php if ($post_layout == 'medium-alt' || $post_layout == 'small-alt') : ?>
                                        <?php
                                        $slideshow_type = get_post_meta($post->ID, 'slideshow_type', true);

                                        if ($slideshow_type != 'none') :
                                            ?>
                                            <?php
                                            if ($slideshow_type == 'images' && has_post_thumbnail()) : ?>
                                                <div class="post-slideshow-wrap <?php echo $layout ?>">
                                                    <div id="post-slideshow-<?php echo $post->ID ?>" class="post-slideshow owl-carousel">
                                                        <?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                                                        <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                                                        <?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
                                                        <div class="post-image">
                                                            <img src="<?php echo str_replace( array( 'http:', 'https:' ), '', $attachment_image[0] ); ?>" alt="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>" data-image="<?php echo $venedor_settings['post-zoom']?$full_image[0]:'' ?>" />
                                                        </div>

                                                        <?php
                                                        $i = 2;
                                                        while ($i <= $venedor_settings['post-slideshow-count']) :
                                                            $attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
                                                            if ($attachment_new_id) :
                                                                ?>
                                                                <?php $attachment_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
                                                                <?php $full_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
                                                                <?php $attachment_data = wp_get_attachment_metadata($attachment_new_id); ?>
                                                                <div class="post-image">
                                                                    <img src="<?php echo str_replace( array( 'http:', 'https:' ), '', $attachment_image[0] ); ?>" alt="<?php echo get_post_field('post_content', $attachment_new_id); ?>" data-image="<?php echo $venedor_settings['post-zoom']?$full_image[0]:'' ?>" />
                                                                </div>
                                                            <?php endif; $i++; endwhile; ?>
                                                    </div>
                                                    <?php if ($venedor_settings['post-zoom']) : ?>
                                                        <div class="figcaption">
                                                            <span class="btn btn-inverse zoom-button"><span class="fa fa-search"></span></span>
                                                            <a class="btn btn-inverse link-button" href="<?php the_permalink(); ?>"><span class="fa fa-link fa-rotate-90"></span></a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php
                                            if ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true)): ?>
                                                <div class="post-slideshow-wrap <?php echo $layout ?>">
                                                    <div id="post-slideshow-<?php echo $post->ID ?>" class="post-slideshow">
                                                        <div class="fit-video">
                                                            <?php echo get_post_meta($post->ID, 'video_code', true); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            endif;
                                        endif;
                                        ?>
                                    <?php endif; ?>

                                    <?php if ($post_layout == 'small-alt' && (($slideshow_type == 'images' && has_post_thumbnail()) || ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true)))) : ?>
                                    <div class="post-content-small">
                                        <?php endif; ?>

                                        <?php if ($post_layout == 'timeline') : ?>
                                            <div class="timeline-circle"></div><div class="timeline-arrow"></div>
                                        <?php endif; ?>

                                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                                        <div class="entry-meta">
                                            <?php if ($post_layout == 'timeline' || $post_layout == 'grid') : ?>
                                                <div class="meta-item meta-date"><div class="meta-inner"><span class="fa fa-calendar"></span> <?php the_date() ?> <?php the_time(); ?></div></div>
                                            <?php endif; ?>
                                            <div class="meta-item meta-author"><div class="meta-inner"><span class="fa fa-user"></span> <?php echo __('By', 'venedor'); ?> <?php the_author_posts_link(); ?></div></div>
                                            <div class="meta-item meta-comments"><div class="meta-inner"><span class="fa fa-comments"></span> <?php comments_popup_link(__('0 Comments', 'venedor'), __('1 Comment', 'venedor'), '% '.__('Comments', 'venedor')); ?></div></div>
                                            <div class="meta-item meta-cats"><div class="meta-inner"><span class="fa fa-folder-open"></span> <?php the_category(', '); ?></div></div>
                                        </div>

                                        <div class="entry-content">

                                            <?php
                                            if ($venedor_settings['blog-excerpt']) {
                                                echo venedor_excerpt( $venedor_settings['blog-excerpt-length'] );
                                            } else {
                                                the_content('');
                                            }
                                            ?>

                                            <?php if ($post_layout == 'small-alt' && (($slideshow_type == 'images' && has_post_thumbnail()) || ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true)))) : ?>
                                        </div>
                                    <?php endif; ?>

                                    </div>
                                </div>
                            </div>

                        </div></div>

                    <?php
                    $prev_post_timestamp = $post_timestamp;
                    $prev_post_month = $post_month;
                    $post_count++;
                endwhile;
                ?>
            </div>

        </div>

    <?php endif; ?>

    </div>
    <?php
    wp_reset_postdata();
    $str = ob_get_contents();
    ob_end_clean();

    return $str;
}

function venedor_shortcode_posts_slider($atts, $content = null) {

    extract(shortcode_atts(array(
        'title' => '',
        'desc' => '',
        'cat' => '',
        'post_in' => '',
        'count' => 6,
        'show_title' => 'true',
        'show_excerpt' => 'true',
        'show_meta' => 'true',
        'arrow_pos' => '',
        'animation_type' => '',
        'animation_duration' => '1',
        'animation_delay' => '0',
        'class' => ''
    ), $atts));

    ?>
    <div class="<?php echo $class ?>">

    <?php
    $args = array(
        'posts_per_page'   => $count,
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'suppress_filters' => true );

    if ($cat)
        $args['cat'] = $cat;

    if ($post_in)
        $args['post__in'] = explode(',', $post_in);

    $posts = new WP_Query( $args );

    global $venedor_settings;
    ?>
    <?php if ( $posts->have_posts() ) : ?>

        <?php $count = 0;
        ob_start(); ?>

        <?php while ($posts->have_posts()) : $posts->the_post(); global $post; ?>
            <?php if (has_post_thumbnail()) : $count++; ?>
                <div class="post-item">
                    <div class="inner">
                        <div class="post-image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('post-related'); ?></a>
                            <?php if ($venedor_settings['post-zoom']) : ?>
                                <div class="figcaption">
                                    <a class="btn btn-inverse zoom-button" href="<?php $thumbs = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $thumbs[0]; ?>"><span class="fa fa-search"></span></a>
                                    <a class="btn btn-inverse link-button" href="<?php the_permalink(); ?>"><span class="fa fa-link fa-rotate-90"></span></a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($show_title == 'true') : ?>
                            <div class="post-title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
                            </div>
                        <?php endif; ?>

                        <?php if ($show_excerpt == 'true') : ?>
                            <?php echo '<p>'.venedor_excerpt(15, false).'</p>'; ?>
                        <?php endif; ?>

                        <?php if ($show_meta == 'true') : ?>
                            <div class="entry-meta clearfix">
                                <div class="left">
                                    <a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('Read More', 'venedor') ?></a>
                                </div>
                                <div class="right">
                                    <span class="meta-date"><?php echo get_the_date('', $post) ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>

        <?php
        $html = ob_get_contents();
        ob_end_clean();

        ob_start();
        if ($count) : ?>
            <div class="entry-related related-slider <?php echo $class ?><?php if (!$title) echo ' notitle' ?> <?php if ($arrow_pos) echo $arrow_pos ?> <?php if ($desc) echo ' with-desc'; ?> <?php if ($animation_type) echo 'animated' ?>"
                <?php if ($animation_type) : ?>
                    animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
                <?php endif; ?>>
                <?php if ($title) : ?><h2 class="entry-title"><?php echo $title; ?></h2><?php endif; ?>
                <?php if ($desc) : ?><div class="slider-desc"><?php echo $desc; ?></div><?php endif; ?>
                <div class="row"><div class="post-carousel owl-carousel">
                        <?php echo $html ?>
                    </div></div>
            </div>
        <?php endif; ?>

    <?php endif; ?>
    </div>
    <?php
    wp_reset_postdata();

    $str = ob_get_contents();
    ob_end_clean();

    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_posts() {
        $vc_icon = venedor_vc_icon().'posts.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Posts",
            "base" => "posts",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "blog_layout",
                    "heading" => "Layout",
                    "param_name" => "layout",
                    "value" => "grid",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Category IDs",
                    "description" => "comma separated list of category ids",
                    "param_name" => "cat",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Post IDs",
                    "description" => "comma separated list of post ids",
                    "param_name" => "post_in",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Posts Count",
                    "param_name" => "count",
                    "value" => '10',
                    "admin_label" => true
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Arrow Position",
                    'param_name' => 'arrow_pos',
                    'value' => array("" => "", "Top" => "arrow-top", "Bottom" => "arrow-bottom"),
                    'description' => ''
                ),
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Posts extends WPBakeryShortCodes {
            }
        }

        $vc_icon = venedor_vc_icon().'posts_slider.png';

        vc_map( array(
            "name" => "Posts Slider",
            "base" => "posts_slider",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "textarea",
                    "heading" => "Description",
                    "param_name" => "desc",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Category IDs",
                    "description" => "comma separated list of category ids",
                    "param_name" => "cat",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Post IDs",
                    "description" => "comma separated list of post ids",
                    "param_name" => "post_in",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Posts Count",
                    "param_name" => "count",
                    "value" => '6',
                    "admin_label" => true
                ),
                array(
                    "type" => "boolean",
                    "heading" => __("Show Post Title", "venedor"),
                    "param_name" => "show_title",
                    "value" => "true"
                ),
                array(
                    "type" => "boolean",
                    "heading" => __("Show Post Excerpt", "venedor"),
                    "param_name" => "show_excerpt",
                    "value" => "true"
                ),
                array(
                    "type" => "boolean",
                    "heading" => __("Show Post Meta", "venedor"),
                    "param_name" => "show_meta",
                    "value" => "true"
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Posts_Slider extends WPBakeryShortCodes {
            }
        }
    }
}
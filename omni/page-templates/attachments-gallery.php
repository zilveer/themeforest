<?php
/**
 * Template Name: Attachments Gallery
 *
 * @package omni
 */

if (null === cs_get_customize_option('page_sidebar')) {
    $page_sidebar = 'none';
} else {
    $page_sidebar = cs_get_customize_option('page_sidebar');
}

$page_meta = get_post_meta(get_the_ID(), 'custom_sidebar_options', true);
if (isset($page_meta['custom_page_sidebar']) && !(empty($page_meta['custom_page_sidebar'])) && !('default' === $page_meta['custom_page_sidebar'])) {
    $page_sidebar = $page_meta['custom_page_sidebar'];
}

if (isset($page_sidebar) && ('left' === $page_sidebar)) {
    $sidebar_class = 'pull-right';
} else {
    $sidebar_class = '';
}

if (is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}

$taxonomies = array(
    'attachments_categories',
);

$terms = get_terms($taxonomies);

$gallery_page_meta = get_post_meta(get_the_ID(), '_gallery_template_options', true);
if (isset($gallery_page_meta['gallery_style']) && !empty($gallery_page_meta['gallery_style'])) {
    $gallery_type = $gallery_page_meta['gallery_style'];
} else {
    $gallery_type = 'style_1';
}

$image_width = '770';
$image_height = '770';

if ('style_2' === $gallery_type) {
    $gallery_style_class = 'borders';
} else {
    $gallery_style_class = '';
}

if (isset($gallery_page_meta['news_page_categories']) && !empty($gallery_page_meta['news_page_categories'])) {
    $gallery_categories = $gallery_page_meta['news_page_categories'];
    foreach ($gallery_categories as $gallery_category) {
        $selected_categories[] = $gallery_category['gallery_categories'];
    }
} elseif (!is_wp_error($terms)) {

    foreach ($terms as $single_term) {
        $selected_categories[] = $single_term->term_id;
    }

} else {
    $selected_categories = array();
}


if (isset($gallery_page_meta['gallery_page_posts_number']) && !empty($gallery_page_meta['gallery_page_posts_number'])) {
    $posts_number = $gallery_page_meta['gallery_page_posts_number'];
} else {
    $posts_number = '-1';
}

if (isset($gallery_page_meta['gallery_page_posts_order']) && !empty($gallery_page_meta['gallery_page_posts_order'])) {
    $posts_order = $gallery_page_meta['gallery_page_posts_order'];
} else {
    $posts_order = 'ASC';
}

$args = array(
    'post_type' => 'attachment',
    'paged' => $paged,
    'post_mime_type' => 'image',
    'post_status' => 'inherit',
    'posts_per_page' => $posts_number,
    'order' => $posts_order,
);

if (!empty($selected_categories)) {

    $args['tax_query'] = array(
        array(
            'taxonomy' => 'attachments_categories',
            'field' => 'term_id',
            'terms' => $selected_categories,
        ),
    );
}
?>

<?php get_header(); ?>

    <section class="blog-section">
        <div class="container">
            <?php if ( ! ( true === $page_meta['page_padding_disable'] ) && isset( $page_meta['page_padding_disable'] ) ){ ?>
            <div class="new-block">
                <?php } ?>
                <?php /* Start the Loop */ ?>
                <?php while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <?php the_content(); ?>

                    </article><!-- #post-## -->

                <?php endwhile; ?>
                <div class="row">

                    <?php
                    if (('none' === $page_sidebar) && isset($page_sidebar)) {

                        echo '<div class=" col-md-12 col-sm-12 col-xs-12">';

                    } else {

                        echo '<div class=" col-md-8 blog-content-column ' . esc_attr($sidebar_class) . '">';
                    } ?>

                    <?php if (empty($page_meta['page_title_hide'])) { ?>
                        <div class="row page-tagline">
                            <div class="col-md-6 col-md-offset-3">
                                <h2 class="title"><?php the_title(); ?></h2>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="sorting-menu wow flipInX" data-wow-delay="0.3s">
                        <div class="responsive-filtration-title"><?php esc_html_e('Filter by...', 'omni') ?>
                            <span aria-hidden="true" class="glyphicon glyphicon-chevron-down"></span></div>
                        <div class="responsive-filtration-toggle">
                            <a data-filter="*" class="active"><?php esc_html_e('All', 'omni'); ?></a>
                            <?php if (!is_wp_error($terms)) {
                                foreach ($terms as $single_attach_cat) {
                                    if (!empty($selected_categories) && is_array($selected_categories) && in_array($single_attach_cat->term_taxonomy_id, $selected_categories)) {
                                        echo '<a data-filter=".' . $single_attach_cat->slug . '">' . $single_attach_cat->name . '</a>';
                                    }
                                }
                            } ?>
                        </div>
                    </div>

                    <?php $text_attributes = array(
                        'data-close-text="' . esc_html__('Close', 'omni') . ' (Esc)"',
                        'data-prev-text="' . esc_html__('Previous (Left arrow key)', 'omni') . '"',
                        'data-next-text="' . esc_html__('Next (Right arrow key)', 'omni') . '"',
                        'data-counter-text="%curr% ' . esc_html__('of', 'omni') . ' %total%"',
                    );
                    $text_attributes = implode(' ', $text_attributes);

                    ?>

                    <div class="sorting-container full-page wow fadeInUp <?php echo esc_attr($gallery_style_class); ?> "
                        <?php echo $text_attributes ?>
                         data-wow-delay="0.3s"
                    >
                        <div class="grid-sizer"></div>

                        <?php

                        wp_reset_postdata();
                        $i = 0;
                        $attachments_query = new WP_Query($args);

                        if ($attachments_query->have_posts()) :

                            while ($attachments_query->have_posts()) : $attachments_query->the_post();

                                if ('style_1' === $gallery_type) {
                                    if ((0 === $i % 10) || (1 === $i % 10)) {
                                        $size_class = 'w2';
                                    } else {
                                        $size_class = '';
                                    }
                                }

                                $image_class = $categories = array();

                                $image_categories = wp_get_post_terms(get_the_ID(), 'attachments_categories');
                                if (!is_wp_error($image_categories)) {
                                    foreach ($image_categories as $single_category) {
                                        $image_class[] = $single_category->slug;
                                        $categories[] = $single_category->name;

                                    }
                                }
                                $image_class = implode(' ', $image_class);

                                $parsed = parse_url(wp_get_attachment_url(get_the_ID()));
                                $url = dirname($parsed ['path']) . '/' . rawurlencode(basename($parsed['path']));

                                if ('style_2' === $gallery_type) {
                                    $attachment_meta = get_post_meta(get_the_ID(), 'crum_gallery_image_size', true);

                                    if ('large' === $attachment_meta) {
                                        $image_width = '770';
                                        $image_height = '770';
                                        $size_class = 'w2';
                                    } elseif ('square_hor' === $attachment_meta) {
                                        $image_width = '584';
                                        $image_height = '292';
                                        $size_class = 'w2';
                                    } elseif ('square_vert' === $attachment_meta) {
                                        $image_width = '292';
                                        $image_height = '584';
                                        $size_class = '';
                                    } else {
                                        $image_width = '770';
                                        $image_height = '770';
                                        $size_class = '';
                                    }

                                } else {
                                    $attachment_meta = get_post_meta(get_the_ID(), 'crum_gallery_image_size_style1', true);
                                    if ('large' === $attachment_meta) {
                                        $image_width = '770';
                                        $image_height = '770';
                                        $size_class = 'w2';
                                    } elseif ('square_hor' === $attachment_meta) {
                                        $image_width = '584';
                                        $image_height = '292';
                                        $size_class = 'w2';
                                    } else {
                                        $image_width = '770';
                                        $image_height = '770';
                                        $size_class = '';
                                    }
                                }

                                echo '<div class="sorting-item ' . $size_class . ' open-popup ' . $image_class . '">';
                                echo '<img src="' . esc_url(crum_theme_thumb($url, $image_width, $image_height, true)) . '" height="' . $image_height . '" width="' . $image_width . '" alt="" />';
                                echo '<a class="zoom" href="' . esc_url($url) . '"></a>';
                                echo '<div class="tagline">';
                                echo '<div class="content">';
                                echo '<div class="title">' . get_the_title(get_the_ID()) . '</div>';
                                if (!empty($categories) && is_array($categories)) {
                                    echo '<div class="description">' . implode(', ', $categories) . '</div>';
                                }
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';//sorting-item

                                $i++;

                            endwhile;

                        endif;

                        wp_reset_query();

                        ?>

                    </div>
                    <!--.sorting-container-->

                </div>
                <!-- end columns -->

                <?php if (!('none' === $page_sidebar)) {
                    get_sidebar();
                }
                ?>
                <?php if ( ! ( true === $page_meta['page_padding_disable'] ) && isset( $page_meta['page_padding_disable'] ) ){ ?>
            </div>
        <?php } ?>
        </div>
        <!-- end row -->
        </div>
        <!-- end container -->
    </section><!-- end blog-section -->


    <script>
        jQuery(function () {
            jQuery(window).load(function () {
                var $container = jQuery('.sorting-container').isotope({
                    itemSelector: '.sorting-item',
                    masonry: {
                        columnWidth: '.grid-sizer'
                    }
                });

                jQuery('.sorting-menu a').click(function () {
                    if (jQuery(this).hasClass('active')) return false;
                    jQuery(this).parent().find('.active').removeClass('active');
                    jQuery(this).addClass('active');
                    var filterValue = jQuery(this).attr('data-filter');

                    $container.isotope({filter: filterValue});
                });
            });
        });
    </script>


<?php wp_enqueue_script('isotope-js', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '', true); ?>

<?php get_footer(); ?>
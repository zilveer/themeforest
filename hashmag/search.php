<?php $sidebar = hashmag_mikado_sidebar_layout(); ?>
<?php get_header(); ?>
<?php
$blog_page_range = hashmag_mikado_get_blog_page_range();
$max_number_of_pages = hashmag_mikado_get_max_number_of_pages();
$custom_thumb_image_width = 187;
$custom_thumb_image_height = 135;

if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}



$enable_search_page_sidebar = true;
if (hashmag_mikado_options()->getOptionValue('enable_search_page_sidebar') === "no") {
    $enable_search_page_sidebar = false;
}
?>
<?php hashmag_mikado_get_title(); ?>
    <div class="mkdf-container">
        <?php do_action('hashmag_mikado_after_container_open'); ?>
        <div class="mkdf-container-inner clearfix">
            <div class="mkdf-container">
                <?php do_action('hashmag_mikado_after_container_open'); ?>
                <div class="mkdf-container-inner">
                    <?php if ($enable_search_page_sidebar) { ?>
                    <div class="mkdf-two-columns-25-75 mkdf-content-has-sidebar clearfix">
                        <div class="mkdf-column1">
                            <?php get_sidebar(); ?>
                        </div>
                        <div class="mkdf-column2 mkdf-content-left-from-sidebar">
                            <div class="mkdf-column-inner">
                                <?php } ?>
                                <div class="mkdf-search-page-holder">

                                    <h1 class="mkdf-search-results-holder"><?php echo esc_html__('Search Results:', 'hashmag') . ' ' . get_search_query() ?> </h1>

                                    <form action="<?php echo esc_url(home_url('/')); ?>" class="mkdf-search-page-form" method="get">
                                        <div class="mkdf-form-holder">
                                            <div class="mkdf-column-left">
                                                <input type="text" name="s" placeholder="<?php esc_html_e("Type Here", 'hashmag'); ?>" class="mkdf-search-field" autocomplete="off"/>
                                            </div>
                                            <div class="mkdf-column-right">
                                                <button class="mkdf-search-submit mkdf-search-results" type="submit" value="Search">
                                                    <span class="ion-search"></span></button>
                                            </div>
                                        </div>
                                        <span class="mkdf-search-label"><?php esc_html_e("If you're not happy with the results, please do another search", 'hashmag'); ?></span>
                                    </form>

                                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                            <div class="mkdf-post-content">
                                                <div class="mkdf-pt-six-item mkdf-post-item">
                                                    <div class="mkdf-pt-six-item-inner">
                                                        <?php if (has_post_thumbnail()) { ?>
                                                            <div class="mkdf-pt-six-image-holder mkdf-bnl-image-holder">
                                                                <?php
                                                                hashmag_mikado_post_info_category(array(
                                                                    'category' => 'yes'
                                                                )); ?>
                                                                <a itemprop="url" class="mkdf-pt-six-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                                                                    <?php
                                                                    echo hashmag_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $custom_thumb_image_width, $custom_thumb_image_height);
                                                                    ?>
                                                                </a>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="mkdf-pt-six-content-holder">
                                                            <div class="mkdf-pt-six-content-holder-inner">
                                                                <div class="mkdf-pt-six-content-top-holder">
                                                                    <?php if (!has_post_thumbnail()) { ?>
                                                                    <?php
                                                                    hashmag_mikado_post_info_category(array(
                                                                        'category' => 'yes'
                                                                    )); ?>
                                                                    <?php } ?>
                                                                    <h3 class="mkdf-pt-six-title mkdf-pt-title">
                                                                        <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self">
                                                                            <?php echo hashmag_mikado_get_title_substring(get_the_title(), 60) ?>
                                                                        </a>
                                                                    </h3>
                                                                    <div class="mkdf-pt-six-excerpt <?php if (has_post_thumbnail()) { ?> mkdf-post-excerpt-with-margin <?php } ?>">
                                                                        <?php
                                                                        $my_excerpt = get_the_excerpt();

                                                                        if ($my_excerpt != '') {

                                                                            if ($my_excerpt != '') {
                                                                                $my_excerpt = rtrim(substr($my_excerpt, 0, 150));
                                                                            }
                                                                        ?>

                                                                            <p itemprop="description" class="mkdf-post-excerpt"><?php echo esc_html($my_excerpt); ?>...</p>
                                                                        <?php }
                                                                        ?>

                                                                        <?php // get_the_excerpt();
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="mkdf-pt-info-section <?php if (has_post_thumbnail()) { ?> stick-to-bottom <?php } ?>">
                                                                    <?php hashmag_mikado_post_info_date(array(
                                                                        'date' => 'yes',
                                                                        'date_format' => 'F d'
                                                                    )) ?>
                                                                    <?php hashmag_mikado_post_info_comments(array(
                                                                        'comments' => 'yes'
                                                                    )) ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </article>
                                    <?php endwhile; ?>
                                        <?php
                                        if (hashmag_mikado_options()->getOptionValue('pagination') == 'yes') {
                                            hashmag_mikado_pagination($max_number_of_pages, $blog_page_range, $paged);
                                        }
                                        ?>
                                    <?php else: ?>
                                        <div class="entry">
                                            <p><?php esc_html_e('No posts were found.', 'hashmag'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php do_action('hashmag_mikado_page_after_content'); ?>
                                <?php if ($enable_search_page_sidebar) { ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                    <?php do_action('hashmag_mikado_before_container_close'); ?>
                </div>
            </div>
        </div>
        <?php do_action('hashmag_mikado_before_container_close'); ?>
    </div>
<?php get_footer(); ?>
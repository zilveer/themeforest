<?php get_header() ?>

<?php
global $porto_settings, $portfolio_columns, $wp_query, $porto_layout, $porto_portfolio_view, $porto_portfolio_thumb, $porto_portfolio_thumb_bg, $porto_portfolio_thumb_image;

$term = $wp_query->queried_object;
$term_id = $term->term_id;

$portfolio_options = get_metadata($term->taxonomy, $term->term_id, 'portfolio_options', true) == 'portfolio_options' ? true : false;

$portfolio_layout = $portfolio_options ? get_metadata($term->taxonomy, $term->term_id, 'portfolio_layout', true) : $porto_settings['portfolio-layout'];
$portfolio_infinite = $portfolio_options ? (get_metadata($term->taxonomy, $term->term_id, 'portfolio_infinite', true) != 'portfolio_infinite' ? true : false ) : $porto_settings['portfolio-infinite'];

$portfolio_columns = '';
$portfolio_view = '';
if ($portfolio_layout == 'grid' || $portfolio_layout == 'masonry') {
    $portfolio_columns = $portfolio_options  ? get_metadata($term->taxonomy, $term->term_id, 'portfolio_grid_columns', true) : $porto_settings['portfolio-grid-columns'];
    $portfolio_view = $portfolio_options ? get_metadata($term->taxonomy, $term->term_id, 'portfolio_grid_view', true) : $porto_settings['portfolio-grid-view'];
}

if ($portfolio_infinite) {
    global $wp_rewrite, $wp_query;

    $page_num = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $page_link = get_pagenum_link();
    $page_max_num = $wp_query->max_num_pages;

    if ( !$wp_rewrite->using_permalinks() || is_admin() || strpos($page_link, '?') ) {
        if (strpos($page_link, '?') !== false)
            $page_path = apply_filters( 'get_pagenum_link', $page_link . '&amp;paged=');
        else
            $page_path = apply_filters( 'get_pagenum_link', $page_link . '?paged=');
    } else {
        $page_path = apply_filters( 'get_pagenum_link', $page_link . user_trailingslashit( $wp_rewrite->pagination_base . "/" ));
    }
}

$porto_portfolio_view = $portfolio_view;
$porto_portfolio_thumb = $portfolio_options ? get_metadata($term->taxonomy, $term->term_id, 'portfolio_archive_thumb', true) : $porto_settings['portfolio-archive-thumb'];
$porto_portfolio_thumb_bg = $portfolio_options ? get_metadata($term->taxonomy, $term->term_id, 'portfolio_archive_thumb_bg', true) : $porto_settings['portfolio-archive-thumb-bg'];
$porto_portfolio_thumb_image = $portfolio_options ? get_metadata($term->taxonomy, $term->term_id, 'portfolio_archive_thumb_image', true) : $porto_settings['portfolio-archive-thumb-image'];
?>

<div id="content" role="main" class="<?php if ($porto_layout === 'widewidth' || $porto_layout === 'wide-left-sidebar' || $porto_layout === 'wide-right-sidebar') { echo 'm-t-lg m-b-xl'; if (porto_get_wrapper_type() !=='boxed') echo ' m-r-md m-l-md'; } ?>">

    <?php if (category_description()) : ?>
        <div class="page-content">
            <?php echo category_description() ?>
        </div>
    <?php endif; ?>

    <?php if (have_posts()) : ?>

        <div class="page-portfolios portfolios-<?php echo $portfolio_layout ?><?php if ($portfolio_infinite) echo ' infinite-container' ?> clearfix">

            <?php if ($porto_settings['portfolio-archive-ajax'] && !$porto_settings['portfolio-archive-ajax-modal']) : ?>
                <div id="portfolioAjaxBox" class="ajax-box">
                    <div class="bounce-loader">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                    <div class="ajax-box-content" id="portfolioAjaxBoxContent"></div>
                </div>
            <?php endif; ?>

            <?php
            if ($porto_settings['portfolio-cat-sort-pos'] !== 'hide') {
                if ($porto_settings['portfolio-cat-sort-pos'] === 'sidebar' && !($porto_layout == 'widewidth' || $porto_layout == 'fullwidth')) {
                    add_action('porto_before_sidebar', 'porto_show_portfolio_tax_filter', 1);
                } else if ($porto_settings['portfolio-cat-sort-pos'] === 'content') {
                    $portfolio_taxs = array();

                    $taxs = get_categories(array(
                        'taxonomy' => 'portfolio_cat',
                        'child_of' => $term_id,
                        'orderby' => isset($porto_settings['portfolio-cat-orderby']) ? $porto_settings['portfolio-cat-orderby'] : 'name',
                        'order' => isset($porto_settings['portfolio-cat-order']) ? $porto_settings['portfolio-cat-order'] : 'asc'
                    ));

                    foreach ($taxs as $tax) {
                        $portfolio_taxs[urldecode($tax->slug)] = $tax->name;
                    }

                    if (!$portfolio_infinite) {
                        global $wp_query;
                        $posts_portfolio_taxs = array();
                        if (is_array($wp_query->posts) && !empty($wp_query->posts)) {
                            foreach($wp_query->posts as $post) {
                                $post_taxs = wp_get_post_terms($post->ID, 'portfolio_cat', array("fields" => "all"));
                                if (is_array($post_taxs) && !empty($post_taxs)) {
                                    foreach ($post_taxs as $post_tax) {
                                        $posts_portfolio_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                                    }
                                }
                            }
                        }
                        foreach ($portfolio_taxs as $key => $value) {
                            if (!isset($posts_portfolio_taxs[$key]))
                                unset($portfolio_taxs[$key]);
                        }
                    }

                    // Show Filters
                    if (is_array($portfolio_taxs) && !empty($portfolio_taxs)) : ?>
                        <ul class="portfolio-filter nav nav-pills sort-source">
                            <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
                            <?php foreach ($portfolio_taxs as $portfolio_tax_slug => $portfolio_tax_name) : ?>
                                <li data-filter="<?php echo esc_attr($portfolio_tax_slug) ?>"><a href="#"><?php echo esc_html($portfolio_tax_name) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php if ($portfolio_layout == 'grid' || $portfolio_layout == 'masonry') { ?>
                            <hr>
                        <?php } else if ($portfolio_layout == 'timeline') { ?>
                            <hr class="invisible">
                        <?php } else { ?>
                            <hr class="tall">
                        <?php } ?>
                    <?php endif;
                }
            }
            ?>

            <?php if ($portfolio_layout == 'timeline') :
                global $prev_post_year, $prev_post_month, $first_timeline_loop, $post_count;

                $prev_post_year = null;
                $prev_post_month = null;
                $first_timeline_loop = false;
                $post_count = 1;
                ?>

            <section class="timeline">

                <div class="timeline-body<?php if ($portfolio_infinite) echo ' portfolios-infinite' ?>"<?php if ($portfolio_infinite) : ?> data-pagenum="<?php echo esc_attr($page_num) ?>" data-pagemaxnum="<?php echo esc_attr($page_max_num) ?>" data-path="<?php echo esc_url($page_path) ?>"<?php endif; ?>>

            <?php else : ?>

            <div class="clearfix <?php if ($portfolio_infinite) : ?> portfolios-infinite<?php endif; ?>
                <?php if ($portfolio_layout == 'grid' || $portfolio_layout == 'masonry') : ?> portfolio-row portfolio-row-<?php echo $portfolio_columns ?> <?php echo $portfolio_view ?><?php endif; ?>"<?php if ($portfolio_infinite) : ?> data-pagenum="<?php echo esc_attr($page_num) ?>" data-pagemaxnum="<?php echo esc_attr($page_max_num) ?>" data-path="<?php echo esc_url($page_path) ?>"<?php endif; ?>>

            <?php endif; ?>

                <?php
                while (have_posts()) {
                    the_post();

                    get_template_part('content', 'archive-portfolio-'.$portfolio_layout);
                }
                ?>

            <?php if ($portfolio_layout == 'timeline') : ?>
                </div>
            </section>
            <?php else : ?>
            </div>
            <?php endif; ?>

            <?php porto_pagination(); ?>


        </div>

        <?php wp_reset_postdata(); ?>

    <?php else : ?>

        <p><?php _e('Apologies, but no results were found for the requested archive.', 'porto'); ?></p>

    <?php endif;

$porto_portfolio_view = $porto_portfolio_thumb = $porto_portfolio_thumb_bg = $porto_portfolio_thumb_image = '';
?>

</div>

<?php get_footer() ?>
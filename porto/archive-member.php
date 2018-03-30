<?php get_header() ?>

<?php

global $porto_settings, $porto_layout;

$member_infinite = $porto_settings['member-infinite'];

if ($member_infinite) {
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

$member_columns = $porto_settings['member-columns'];

?>

<div id="content" role="main" class="<?php if ($porto_layout === 'widewidth' || $porto_layout === 'wide-left-sidebar' || $porto_layout === 'wide-right-sidebar') { echo 'm-t-lg m-b-xl'; if (porto_get_wrapper_type() !=='boxed') echo ' m-r-md m-l-md'; } ?>">

    <?php if (!is_search() && $porto_settings['member-cat-sort-pos'] == 'content' && $porto_settings['member-title']) : ?>
        <?php if ($porto_layout === 'widewidth') : ?><div class="container"><?php endif; ?>
        <?php if ($porto_settings['member-sub-title']) : ?>
            <h2 class="m-b-xs"><?php echo force_balance_tags($porto_settings['member-title']) ?></h2>
            <p class="lead m-b-xl"><?php echo force_balance_tags($porto_settings['member-sub-title']) ?></p>
        <?php else : ?>
            <h2><?php echo force_balance_tags($porto_settings['member-title']) ?></h2>
        <?php endif; ?>
        <?php if ($porto_layout === 'widewidth') : ?></div><?php endif; ?>
    <?php endif; ?>

    <?php if (have_posts()) : ?>

        <div class="page-members <?php if ($member_infinite) echo ' infinite-container' ?> clearfix">

            <?php if ($porto_settings['member-archive-ajax']) : ?>
                <div id="memberAjaxBox" class="ajax-box">
                    <div class="bounce-loader">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                    <div class="ajax-box-content" id="memberAjaxBoxContent"></div>
                    <?php if (function_exists('porto_title_archive_name') && porto_title_archive_name('member')) : ?>
                        <div class="hide ajax-content-append"><h4 class="m-t-sm m-b-lg"><?php echo sprintf( __( 'More %s:', 'porto' ), porto_title_archive_name('member') ); ?></h4></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php
            if ($porto_settings['member-cat-sort-pos'] !== 'hide' && !is_search()) {
                if ($porto_settings['member-cat-sort-pos'] === 'sidebar' && !($porto_layout == 'widewidth' || $porto_layout == 'fullwidth')) {
                    add_action('porto_before_sidebar', 'porto_show_member_archive_filter', 1);
                } else if ($porto_settings['member-cat-sort-pos'] === 'content') {
                    $member_taxs = array();

                    $taxs = get_categories(array(
                        'taxonomy' => 'member_cat',
                        'orderby' => isset($porto_settings['member-cat-orderby']) ? $porto_settings['member-cat-orderby'] : 'name',
                        'order' => isset($porto_settings['member-cat-order']) ? $porto_settings['member-cat-order'] : 'asc'
                    ));

                    foreach ($taxs as $tax) {
                        $member_taxs[urldecode($tax->slug)] = $tax->name;
                    }

                    if (!$member_infinite) {
                        global $wp_query;
                        $posts_member_taxs = array();
                        if (is_array($wp_query->posts) && !empty($wp_query->posts)) {
                            foreach($wp_query->posts as $post) {
                                $post_taxs = wp_get_post_terms($post->ID, 'member_cat', array("fields" => "all"));
                                if (is_array($post_taxs) && !empty($post_taxs)) {
                                    foreach ($post_taxs as $post_tax) {
                                        $posts_member_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                                    }
                                }
                            }
                        }
                        foreach ($member_taxs as $key => $value) {
                            if (!isset($posts_member_taxs[$key]))
                                unset($member_taxs[$key]);
                        }
                    }

                    // Show Filters
                    if (is_array($member_taxs) && !empty($member_taxs)) : ?>
                        <?php if ($porto_layout === 'widewidth') : ?><div class="container"><?php endif; ?>
                        <ul class="member-filter nav nav-pills sort-source">
                            <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
                            <?php foreach ($member_taxs as $member_tax_slug => $member_tax_name) : ?>
                                <li data-filter="<?php echo esc_attr($member_tax_slug) ?>"><a href="#"><?php echo esc_html($member_tax_name) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <hr>
                        <?php if ($porto_layout === 'widewidth') : ?></div><?php endif; ?>
                    <?php endif;
                }
            }
            ?>

            <div class="member-row <?php if ($member_infinite) : ?> members-infinite<?php endif; ?> member-row-<?php echo $member_columns ?>"<?php if ($member_infinite) : ?> data-pagenum="<?php echo esc_attr($page_num) ?>" data-pagemaxnum="<?php echo esc_attr($page_max_num) ?>" data-path="<?php echo esc_url($page_path) ?>"<?php endif; ?>>
                <?php
                while (have_posts()) {
                    the_post();

                    get_template_part('content', 'archive-member');
                }
                ?>
            </div>

            <?php porto_pagination(); ?>

        </div>

        <?php wp_reset_postdata(); ?>

    <?php else : ?>

        <p><?php _e('Apologies, but no results were found for the requested archive.', 'porto'); ?></p>

    <?php endif; ?>

</div>

<?php get_footer() ?>
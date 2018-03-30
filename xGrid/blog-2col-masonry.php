<?php
// Template Name: Blog 2col Masonry With Out Sidebar

get_header();

if( bdayh_get_option( 'b_2col' ) ){
    $items_count    = bdayh_get_option( 'b_2col' );
} else {
    $items_count    = "12";
}

$cols           = "2cols";
require_once get_template_directory() . '/includes/filter.php'; // Filter ?>

    <div class="bd-container blog-grid-layout loading" style="width: 95%">
        <div class="blog-v1">
            <div class="posts-gird">
                <div id="container-grid" class="filterable-posts posts-gird-<?php echo $cols ?>" data-cols="<?php echo $cols ?>">
                    <?php
                    wp_enqueue_script( 'isotope' );
                    wp_enqueue_script( 'bd-isotope' );

                    if( is_front_page() ) {
                        $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
                    } else {
                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    }

                    $bdBlogCats = bdayh_get_option( 'custom_cat_2col' );
                    if( empty( $bdBlogCats ) ) $bdBlogCats = bd_get_all_category_ids();

                    query_posts( array( 'paged' => $paged , 'category__in' => $bdBlogCats, 'update_post_thumbnail_cache' => true, 'ignore_sticky_posts' => 1, 'no_found_rows' => false, 'cache_results' => false ) );

                    $format = get_post_format();
                    if( false === $format ) { $format = 'standard'; }
                    get_template_part( 'loop', $format );
                    wp_reset_postdata();
                    ?>
                </div><!-- #container-grid -->

                <div class="clear"></div>
                <?php bd_pagenavi( $pages = '', $range = 2 ); wp_reset_query();  ?>
            </div>
            <!-- .posts-gird -->
            <div id="loading" class="rotating-plane"></div> <!-- #loading -->
        </div>
    </div><!-- .blog-grid-layout -->
<?php get_footer(); ?>
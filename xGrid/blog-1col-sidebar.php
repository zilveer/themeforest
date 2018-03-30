<?php
// Template Name: Blog 1col With Sidebar
get_header();
?>
	<style type="text/css">body.page .article-formats { display: block !important; }</style>
    <div class="bd-container">
        <div class="bd-main">
            <?php bd_in( 'slider' ); ?>
            <div class="blog-v1 blog-v">
                <div id="containn">
					<?php
                    if( is_front_page() ) {
                        $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
                    } else {
                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    }

                    $bdBlogCats = bdayh_get_option( 'custom_cat_1col' );
                    if( empty( $bdBlogCats ) ) $bdBlogCats = bd_get_all_category_ids();

                    query_posts( array( 'paged' => $paged , 'category__in' => $bdBlogCats, 'update_post_thumbnail_cache' => true, 'ignore_sticky_posts' => 1, 'no_found_rows' => false, 'cache_results' => false ) );

                    $format = get_post_format();
                    if( false === $format ){
                        $format = 'standard';
                    }
                    get_template_part( 'loop', $format );
                    wp_reset_postdata();
					?>
				</div>
        	</div>
            <div class="clear"></div>
			<?php bd_pagenavi( $pages = '', $range = 2 ); wp_reset_query();  ?>
        </div>
        <!-- .bd-main-->
        <?php get_sidebar(); ?>
    </div>
    <!-- .bd-container -->
<?php get_footer(); ?>
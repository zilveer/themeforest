<?php
/*
    Template Name: All Stores
*/
get_header();
the_post();
get_template_part( 'includes/title' );

$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page
$letter = get_query_var( $couponxl_slugs['letter'] ) ? esc_sql( get_query_var( $couponxl_slugs['letter'] ) ) : '';
$stores_per_page = couponxl_get_option( 'stores_per_page' );

$args = array(
    'post_type' => 'store',
    'paged' => $cur_page,
    'posts_per_page' => $stores_per_page,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'asc'
);
if( !empty( $letter ) ){
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'letter',
            'field' => 'slug',
            'terms' => $letter
        )
    );
}

$stores = new WP_Query( $args );

$page_links_total =  $stores->max_num_pages;
$page_links = paginate_links( 
    array(
        'prev_next' => true,
        'end_size' => 2,
        'mid_size' => 2,
        'total' => $page_links_total,
        'current' => $cur_page, 
        'prev_next' => false,
        'type' => 'array'
    )
);

$pagination = couponxl_format_pagination( $page_links );
$letter_terms = get_terms( 'letter' );
$all_stores_link = couponxl_get_permalink_by_tpl( 'page-tpl_all_stores' );

?>
<section class="contact-page">
    <div class="container">

        <?php 
        $content = get_the_content();
        if( !empty( $content ) ):
        ?>
            <div class="white-block">
                <div class="white-block-content">
                    <div class="page-content clearfix">
                        <?php echo apply_filters( 'the_content', $content ) ?>
                    </div>
                </div>
            </div>
        <?php
        endif;
        ?>

        <div class="row">

            <div class="col-md-12">

                <ul class="list-unstyled pagination letter-filter">
                <li  class="<?php echo empty( $letter ) ? 'active' : '' ?>">
                    <a href="<?php echo esc_url( $all_stores_link ); ?>" class="<?php echo $letter == '' ? 'active' : '' ?>"><?php _e( 'ALL', 'couponxl' ) ?></a>
                </li>
                <?php
                    if( !empty( $letter_terms ) ){
                        foreach( $letter_terms as $letter_term ){
                            ?>
                            <li class="<?php echo $letter == $letter_term->slug ? 'active' : '' ?>">
                                <a href="<?php echo couponxl_append_query_string( couponxl_get_permalink_by_tpl( 'page-tpl_all_stores' ), array( 'letter' => $letter_term->slug ), array() ) ?>">
                                    <?php echo $letter_term->name ?>
                                </a>
                            </li>
                            <?php
                        }
                    }
                ?>
                </ul>

               <div class="row">
                    <?php
                    $counter = 0;
                    if( $stores->have_posts() ){
                        while( $stores->have_posts() ){
                            $stores->the_post();
                            if( $counter == 6 ){
                                $counter = 0;
                                echo '</div><div class="row">';
                            }
                            $counter++;
                            ?>
                            <div class="col-sm-2">
                                <div class="white-block">
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <div class="store-logo">
                                            <a href="<?php the_permalink() ?>">
                                                <?php couponxl_store_logo(); ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="store-name">
                                        <a href="<?php the_permalink() ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
               </div>

               <?php if( !empty( $pagination ) ): ?>
                    <ul class="pagination">
                        <?php echo $pagination ?>
                    </ul>
               <?php endif; ?>

            </div>

        </div>
    </div>
</section>
<?php get_footer(); ?>
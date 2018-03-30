<?php
/**
 * Template Name: Blog Masonry Template
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 25/01/16
 * Time: 9:12 PM
 */
get_header();
global $houzez_local, $wp_query, $paged;
if ( is_front_page()  ) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}
?>

<?php get_template_part('template-parts/page-title'); ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div id="content-area">

            <div id="post-card-masonry-module" class="post-card-masonry">
                <?php
                $number_of_posts = houzez_option('masorny_num_posts');
                if (!$number_of_posts) {
                    $number_of_posts = '12';
                }

                $wp_query_args = array(
                'post_type' => 'post',
                'posts_per_page' => $number_of_posts,
                'paged' => $paged,
                'post_status' => 'publish'
                );
                $the_query = New WP_Query($wp_query_args);
                ?>
                <div class="grid-block row">
                    <?php if( $the_query->have_posts() ): while( $the_query->have_posts() ): $the_query->the_post(); ?>
                        <div class="col-md-3 col-sm-4 col-xs-12 grid-item">
                            <div class="post-card-item">
                                <figure class="item-thumb">
                                    <a href="<?php the_permalink(); ?>" class="hover-effect">
                                        <?php the_post_thumbnail('houzez-image_masonry'); ?>
                                    </a>
                                    <figcaption class="thumb-caption clearfix">
                                        <div class="file-type pull-left"><i class="fa fa-file"></i></i></div>
                                        <?php if ( comments_open() ) { ?>
                                            <?php if( get_comments_number() != 0 ) { ?>
                                                <div class="comment-count pull-right">
                                                    <span class="count"><?php comments_number( '0', '1', '%' ); ?></span>
                                                    <i class="fa fa-comments-o"></i></i>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </figcaption>
                                </figure>
                                <div class="post-card-body">

                                    <div class="post-card-description">
                                        <ul class="list-inline">
                                            <li><i class="fa fa-calendar"></i> <?php esc_attr( the_time( get_option( 'date_format' ) ));?> </li>
                                            <li><i class="fa fa-bookmark-o"></i> <?php the_category(', '); ?></li>
                                        </ul>
                                        <h3><?php the_title(); ?></h3>
                                        <p><?php echo houzez_clean_excerpt( '100', 'false' ); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="read"><?php echo $houzez_local['continue_reading']; ?> <i class="fa fa-caret-right"></i></a>
                                    </div>
                                    <div class="post-card-author">
                                        <?php if( get_the_author_meta( 'fave_author_custom_picture' ) != '' ) { ?>
                                            <div class="author-image">
                                                <img width="40" height="40" src="<?php echo esc_url(get_the_author_meta( 'fave_author_custom_picture' )); ?>" class="img-circle">
                                            </div>
                                        <?php } ?>
                                        <div class="author-name">
                                            <span><?php echo $houzez_local['by_text']; ?> <?php the_author(); ?></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endwhile; endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>

            </div>
            <hr>
            <!--start Pagination-->
            <?php houzez_pagination( $the_query->max_num_pages, $range = 2 ); ?>
            <!--start Pagination-->

        </div>
    </div><!-- end container-content -->

</div>
<?php get_footer(); ?>
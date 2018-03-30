<?php
/*==================
 SINGLE BLOG POST
==================*/

get_header();
the_post();
get_template_part( 'includes/title' );
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-<?php echo is_active_sidebar( 'sidebar-blog' ) ? '9' : '12' ?>">
                <div class="white-block">
                    <?php
                    if( couponxl_has_media() ){
                        ?>
                        <div class="white-block-media">
                            <?php get_template_part( 'media/media', get_post_format() ); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="white-block-content blog-item-content">
                        <ul class="list-unstyled list-inline top-meta">
                            <li><i class="fa fa-calendar-o"></i><?php the_time( get_option( 'date_format' ) ) ?></li>
                            <li><i class="fa fa-user"></i><?php _e( 'By ', 'couponxl' ); the_author_meta( 'display_name' ); ?></li>
                            <?php
                            $categories = couponxl_categories_list();
                            if( !empty( $categories ) ):
                            ?>
                                <li><i class="fa fa-bars"></i><?php echo $categories; ?></li>
                            <?php
                            endif;
                            ?>
                            <li><i class="fa fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></li>
                        </ul>

                        <?php 
                        $show_breadcrumbs = couponxl_get_option( 'show_breadcrumbs' );
                        if( $show_breadcrumbs == 'yes' ){
                            ?>
                            <h1 class="blog-title size-h2"><?php the_title(); ?></h1>
                            <?php
                        }
                        else{
                            ?>
                            <h2 class="blog-title"><?php the_title(); ?></h2>
                            <?php
                        }
                        ?>

                        <?php the_content(); ?>
                    </div>

                    <div class="white-block-footer">
                        <?php get_template_part( 'includes/share' )?>
                    </div>

                </div>

                <?php
                $tags = couponxl_tags_list();
                if( !empty( $tags ) ):
                ?>
                    <div class="white-block tags-list">
                        <div class="white-block-content">
                            <i class="fa fa-tags icon-margin"></i>
                            <?php echo $tags; ?>
                        </div>
                    </div>
                <?php
                endif;
                ?>

                <div class="white-block author-box">
                    <div class="media">
                        <div class="media-left">
                            <?php
                            $avatar_url = couponxl_get_avatar_url( get_avatar( get_the_author_meta( 'ID' ), 140 ) ) ;
                            ?>
                            <img src="<?php echo esc_url( $avatar_url ) ?>" class="media-object"  alt="" />
                        </div>
                        <div class="media-body">
                            <h4><?php the_author_meta( 'display_name' ); ?></h4>
                            <p><?php the_author_meta( 'description' ); ?></p>
                        </div>
                    </div>
                </div>

                <?php comments_template( '', true ); ?>

            </div>

            <?php  get_sidebar(); ?>

        </div>
    </div>
</section>

<?php
get_footer();
?>
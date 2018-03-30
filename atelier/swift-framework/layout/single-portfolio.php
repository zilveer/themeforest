<?php
    /*
    *
    *	Single Portfolio
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *
    */
?>

<?php

    /* PORTFOLIO COMMENTS
    ================================================== */
    if ( ! function_exists( 'sf_portfolio_comments' ) ) {
        function sf_portfolio_comments() {

            $sf_options = sf_get_theme_opts();
            $disable_pagecomments = $sf_options['disable_pagecomments'];

            $comments_class = apply_filters( 'sf_post_comments_wrap_class', 'col-sm-8 col-sm-offset-2' );

            if ( comments_open() ) {
                ?>
                <div class="comments-wrap">
                    <div id="comment-area" class="<?php echo esc_attr($comments_class); ?>">
                        <?php comments_template( '', true ); ?>
                    </div>
                </div>
            <?php
            }
        }

        add_action( 'sf_portfolio_article_end', 'sf_portfolio_comments', 10 );
    }

?>

<?php while (have_posts()) : the_post(); ?>

    <?php
    sf_set_sidebar_global( 'no-sidebars' );
    $page_content_class = $content_wrap_class = "";
    $portfolio_data     = sf_get_post_meta( $post->ID, 'portfolio', true );
    $current_item_id    = $post->ID;
    $hide_details       = sf_get_post_meta( $post->ID, 'sf_hide_details', true );
    $pb_active          = sf_get_post_meta( $post->ID, '_spb_js_status', true );
    $fw_media_display   = sf_get_post_meta( $post->ID, 'sf_fw_media_display', true );
    if ( $pb_active != "true" ) {
        $page_content_class = "container";
    }
    if ( ! $hide_details && $pb_active != "true" ) {
        $content_wrap_class = "col-sm-9";
    }
    if ( $fw_media_display == "split" ) {
        $page_content_class = "col-sm-3";
        $content_wrap_class = "";
        add_action( 'sf_portfolio_article_start', 'sf_output_container_row_open', 5 );
        add_action( 'sf_portfolio_article_end', 'sf_output_container_row_close', 5 );
    }
    if ( $hide_details ) {
        remove_action( 'sf_after_portfolio_content', 'sf_portfolio_item_details', 0 );
    }
    ?>

    <?php do_action( 'sf_portfolio_before_article' ); ?>

    <!-- OPEN article -->
    <article <?php post_class( 'clearfix single-portfolio-' . $fw_media_display ); ?> id="<?php the_ID(); ?>" itemscope
                                                                                      itemtype="http://schema.org/CreativeWork">

        <?php
            /**
             * @hooked - sf_output_container_row_open - 5 (if media display is set to "split")
             * @hooked - sf_post_detail_media - 20
             **/
            do_action( 'sf_portfolio_article_start' );
        ?>

        <section class="page-content clearfix <?php echo esc_attr($page_content_class); ?>">

            <?php do_action( 'sf_before_portfolio_content' ); ?>

            <div class="content-wrap <?php echo esc_attr($content_wrap_class); ?> clearfix"
                 itemprop="description"><?php the_content(); ?></div>

            <?php
                /**
                 * @hooked - sf_portfolio_item_details - 0
                 **/
                do_action( 'sf_after_portfolio_content' );
            ?>

        </section>

        <?php
            /**
             * @hooked - sf_output_container_row_close - 5 (if media display is set to "split")
             **/
            do_action( 'sf_portfolio_article_end' );
        ?>

        <!-- CLOSE article -->
    </article>

    <?php
    /**
     * @hooked - sf_portfolio_related_projects - 0
     **/
    do_action( 'sf_portfolio_after_article' );
    ?>

<?php endwhile; ?>

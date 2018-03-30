<?php
    /*
    *
    *	Single Gallery
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *
    */

    /* PAGE BUILDER CHECK */
    $pb_active = sf_get_post_meta( $post->ID, '_spb_js_status', true );
    if ( $pb_active != "true" || ( $pb_active == "true" && $sidebar_config != "no-sidebars" ) ) {
        $page_content_class = "container";
    }

    /* SHARING */
    $gallery_share = sf_get_post_meta( $post->ID, 'sf_gallery_share', true );
    if ( $gallery_share ) {
        function sf_gallery_share() {
            $image      = wp_get_attachment_url( get_post_thumbnail_id() );
            $share_text = apply_filters( 'sf_post_share_text', __( "Share this", "swiftframework" ) );
            ?>
            <div class="gallery-share">
                <div class="article-divider"></div>
                <div class="article-share" data-buttontext="<?php echo esc_attr($share_text); ?>"
                     data-image="<?php echo esc_url($image); ?>"><share-button class="share-button"></share-button></div>
                <?php if ( function_exists( 'lip_love_it_link' ) ) {
                    lip_love_it_link( get_the_ID(), true, 'text' );
                } ?>
            </div>
        <?php
        }

        add_action( 'sf_after_gallery_content', 'sf_gallery_share', 10 );
    }

    /* COMMENTS */
    if ( comments_open() ) {
        function sf_gallery_comments() {
            $comments_class = apply_filters( 'sf_post_comments_wrap_class', 'col-sm-8 col-sm-offset-2' );
            ?>
            <section class="article-extras">
                <div class="comments-wrap container">
                    <div id="comment-area" class="<?php echo esc_attr($comments_class); ?>">
                        <?php comments_template( '', true ); ?>
                    </div>
                </div>
            </section>
        <?php
        }

        add_action( 'sf_after_gallery_content', 'sf_gallery_comments', 20 );
    }
?>

<?php while (have_posts()) : the_post(); ?>

    <?php
    $gallery_id = get_the_ID();
    ?>

    <?php do_action( 'sf_gallery_before_article' ); ?>

    <!-- OPEN article -->
    <article <?php post_class( 'clearfix single-team' ); ?> id="<?php the_ID(); ?>">

        <?php
            do_action( 'sf_gallery_article_start' );
        ?>

        <section class="page-content clearfix">

            <?php
                do_action( 'sf_before_gallery_content' );
            ?>

            <?php echo do_shortcode( '[spb_gallery gallery_id="' . $gallery_id . '" display_type="masonry" columns="3" fullwidth="no" gutters="yes" slider_transition="slide" show_thumbs="yes" autoplay="yes" show_captions="yes" enable_lightbox="yes" width="1/1" el_position="first last"]' ); ?>

            <div class="gallery-text <?php echo esc_attr($page_content_class); ?>">
                <?php the_content(); ?>
            </div>

            <?php
                do_action( 'sf_after_gallery_content' );
            ?>

        </section>

        <?php
            do_action( 'sf_gallery_article_end' );
        ?>

        <!-- CLOSE article -->
    </article>

    <?php
    do_action( 'sf_gallery_after_article' );
    ?>

<?php endwhile; ?>

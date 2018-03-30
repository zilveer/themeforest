<?php
    global $sf_options;

    $blog_type    = $sf_options['archive_display_type'];
    $blog_classes = sf_blog_classes( $blog_type );
?>

<?php if ( have_posts() ) : ?>

    <div class="blog-wrap blog-items-wrap blog-<?php echo esc_attr($blog_type); ?>">

        <?php if ( $blog_type == "timeline" ) { ?>
            <div class="timeline"></div>
        <?php } ?>

        <!-- OPEN .blog-items -->
        <ul class="blog-items row <?php echo esc_attr($blog_classes['list']); ?> clearfix"
            data-blog-type="<?php echo esc_attr($blog_type); ?>">

            <?php while ( have_posts() ) : the_post(); ?>
                <?php if ( class_exists( 'ATCF_Campaigns' ) ) { ?>
                    <?php echo sf_get_campaign_item( $blog_classes['item'] ); ?>
                <?php } else { ?>
                    <?php
                    $post_format = get_post_format( $post->ID );
                    if ( $post_format == "" ) {
                        $post_format = 'standard';
                    }
                    ?>
                    <li <?php post_class( 'blog-item ' . $blog_classes['item'] . ' format-' . $post_format ); ?> itemscope itemtype="http://schema.org/BlogPosting">
                        <?php echo sf_get_post_item( $post->ID, $blog_type ); ?>
                    </li>
                <?php } ?>

            <?php endwhile; ?>

            <!-- CLOSE .blog-items -->
        </ul>

    </div>

<?php else: ?>

    <h3><?php _e( "Sorry, there are no posts to display.", "swiftframework" ); ?></h3>

<?php endif; ?>

<div class="pagination-wrap"><?php echo pagenavi( $wp_query ); ?></div>
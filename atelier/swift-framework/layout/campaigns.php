<?php
    global $sf_options;

    $blog_type    = $sf_options['archive_display_type'];
    $blog_classes = sf_blog_classes( $blog_type );
?>

<?php if ( have_posts() ) : ?>

    <div class="campaigns-wrap campaigns-archive">

        <!-- OPEN .campaign-items -->
        <ul class="campaign-items masonry-items clearfix">

            <?php while ( have_posts() ) : the_post();
                echo sf_get_campaign_item( $blog_classes['item'] );
            endwhile; ?>

            <!-- CLOSE .campaign-items -->
        </ul>

    </div>

<?php else: ?>

    <h3><?php _e( "Sorry, there are no posts to display.", "swiftframework" ); ?></h3>

<?php endif; ?>

<div class="pagination-wrap"><?php echo pagenavi( $wp_query ); ?></div>
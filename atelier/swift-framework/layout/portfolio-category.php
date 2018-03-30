<?php
    global $sf_options;

    $portfolio_archive_display_type = $sf_options['portfolio_archive_display_type'];
    $portfolio_archive_columns      = $sf_options['portfolio_archive_columns'];
    $category_slug                  = get_query_var( 'portfolio-category' );
?>

<?php if ( have_posts() ) : ?>

    <div class="portfolio-wrap">

        <?php echo do_shortcode( '[spb_portfolio display_type="' . $portfolio_archive_display_type . '" fullwidth="no" gutters="yes" columns="' . $portfolio_archive_columns . '" show_title="yes" show_subtitle="yes" show_excerpt="no" hover_show_excerpt="no" excerpt_length="20" item_count="-1" category="' . $category_slug . '" portfolio_filter="no" pagination="no" button_enabled="no" width="1/1" el_position="first last"]' ); ?>

    </div>

<?php else: ?>

    <h3><?php _e( "Sorry, there are no posts to display.", "swiftframework" ); ?></h3>

<?php endif; ?>
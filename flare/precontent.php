<div id="precontent" class="<?php echo btp_content_get_class(); ?>">
    <?php
    /* Handle Revolution Slider */
    $btp_revslider_prefix = 'revslider_';
    $btp_revslider_alias = btp_elements_get( 'slider_id' );

    if ( 0 === strpos( $btp_revslider_alias, $btp_revslider_prefix ) ) {
        $btp_revslider_alias = sanitize_title( substr( $btp_revslider_alias, strlen( $btp_revslider_prefix ) ) );

        echo '<div id="revslider-wrapper">';
        echo do_shortcode( "[rev_slider $btp_revslider_alias]" );
        echo '</div>';
    }
    ?>

    <div id="precontent-inner">
        <?php btp_precontent(); ?>
        <?php get_template_part( 'content_header' ); ?>
    </div>
    <div class="background">
        <div class="shadow"></div>
        <div class="pattern"></div>
        <div class="flare">
            <div></div>
            <div></div>
        </div>
    </div>
</div>
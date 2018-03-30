<?php
global $porto_settings;

$footer_view = porto_get_meta_value('footer_view');

?>
<?php if ( is_active_sidebar( 'footer-top' ) && !$footer_view ) : ?>
    <div class="footer-top">
        <div class="container">
            <?php dynamic_sidebar( 'footer-top' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php
$cols = 0;
for ($i = 1; $i <= 4; $i++) {
    if ( is_active_sidebar( 'footer-column-'. $i ) )
        $cols++;
}
?>
<div id="footer" class="footer-2<?php if ($porto_settings['footer-ribbon']) echo ' show-ribbon' ?>">
    <?php if (!$footer_view && $cols) : ?>
        <div class="footer-main">
            <div class="container">
                <?php if ($porto_settings['footer-ribbon']) : ?>
                    <div class="footer-ribbon"><?php echo force_balance_tags($porto_settings['footer-ribbon']) ?></div>
                <?php endif; ?>

                <?php
                $cols = 0;
                for ($i = 1; $i <= 4; $i++) {
                    if ( is_active_sidebar( 'footer-column-'. $i ) )
                        $cols++;
                }
                if ($cols) :
                    $col_class = array();
                    switch ($cols) {
                        case 1:
                            $col_class[1] = 'col-md-' . (($porto_settings['footer-customize'] && $porto_settings['footer-widget1']) ? $porto_settings['footer-widget1'] : '12');
                            break;
                        case 2:
                            $col_class[1] = 'col-md-' . (($porto_settings['footer-customize'] && $porto_settings['footer-widget1']) ? $porto_settings['footer-widget1'] : '6');
                            $col_class[2] = 'col-md-' . (($porto_settings['footer-customize'] && $porto_settings['footer-widget2']) ? $porto_settings['footer-widget2'] : '6');
                            break;
                        case 3:
                            $col_class[1] = 'col-md-' . (($porto_settings['footer-customize'] && $porto_settings['footer-widget1']) ? $porto_settings['footer-widget1'] : '3');
                            $col_class[2] = 'col-md-' . (($porto_settings['footer-customize'] && $porto_settings['footer-widget2']) ? $porto_settings['footer-widget2'] : '3');
                            $col_class[3] = 'col-md-' . (($porto_settings['footer-customize'] && $porto_settings['footer-widget3']) ? $porto_settings['footer-widget3'] : '6');
                            break;
                        case 4:
                            $col_class[1] = 'col-md-' . (($porto_settings['footer-customize'] && $porto_settings['footer-widget1']) ? $porto_settings['footer-widget1'] : '3');
                            $col_class[2] = 'col-md-' . (($porto_settings['footer-customize'] && $porto_settings['footer-widget2']) ? $porto_settings['footer-widget2'] : '3');
                            $col_class[3] = 'col-md-' . (($porto_settings['footer-customize'] && $porto_settings['footer-widget3']) ? $porto_settings['footer-widget3'] : '4');
                            $col_class[4] = 'col-md-' . (($porto_settings['footer-customize'] && $porto_settings['footer-widget4']) ? $porto_settings['footer-widget4'] : '2');
                            break;
                    }
                    ?>
                    <div class="row">
                        <?php
                        $cols = 1;
                        for ($i = 1; $i <= 4; $i++) {
                            if ( is_active_sidebar( 'footer-column-'. $i ) ) {
                                ?>
                                <div class="<?php echo $col_class[$cols++] ?>">
                                    <?php dynamic_sidebar( 'footer-column-'. $i ); ?>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <?php
                get_template_part('footer/footer_tooltip');
                ?>
            </div>
        </div>
    <?php endif; ?>

    <?php
    if (($porto_settings['footer-logo'] && $porto_settings['footer-logo']['url']) || is_active_sidebar( 'footer-bottom' ) || $porto_settings['footer-copyright']) :
    ?>
    <div class="footer-bottom">
        <div class="container">
            <?php if (($porto_settings['footer-logo'] && $porto_settings['footer-logo']['url']) || $porto_settings['footer-copyright-pos'] == 'left' || ($porto_settings['footer-copyright-pos'] == 'right' && is_active_sidebar( 'footer-bottom' ))) : ?>
            <div class="footer-left">
                <?php
                // show logo
                if ($porto_settings['footer-logo'] && $porto_settings['footer-logo']['url']) : ?>
                    <span class="logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
                            <?php echo '<img class="img-responsive" src="' . esc_url(str_replace( array( 'http:', 'https:' ), '', $porto_settings['footer-logo']['url'])) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />'; ?>
                        </a>
                    </span>
                <?php endif; ?>
                <?php
                if ($porto_settings['footer-copyright-pos'] == 'left') {
                    echo force_balance_tags($porto_settings['footer-copyright']);
                } else if ($porto_settings['footer-copyright-pos'] == 'right' && is_active_sidebar( 'footer-bottom' )) {
                    dynamic_sidebar( 'footer-bottom' );
                }
                ?>
            </div>
            <?php endif; ?>

            <?php if (($porto_settings['footer-payments'] && $porto_settings['footer-payments-image'] && $porto_settings['footer-payments-image']['url']) || $porto_settings['footer-copyright-pos'] == 'center') : ?>
                <div class="footer-center">
                    <?php if ($porto_settings['footer-payments'] && $porto_settings['footer-payments-image'] && $porto_settings['footer-payments-image']['url']) : ?>
                        <?php if ($porto_settings['footer-payments-link']) : ?>
                        <a href="<?php echo esc_url($porto_settings['footer-payments-link']) ?>">
                        <?php endif; ?>
                            <img class="img-responsive" src="<?php echo esc_url(str_replace( array( 'http:', 'https:' ), '', $porto_settings['footer-payments-image']['url'])) ?>" alt="<?php echo esc_attr($porto_settings['footer-payments-image-alt']) ?>" />
                        <?php if ($porto_settings['footer-payments-link']) : ?>
                        </a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($porto_settings['footer-copyright-pos'] == 'center') {
                        echo force_balance_tags($porto_settings['footer-copyright']);
                        dynamic_sidebar( 'footer-bottom' );
                    } ?>
                </div>
            <?php endif; ?>

            <?php if ($porto_settings['footer-copyright-pos'] == 'right') { ?>
                <div class="footer-right"><?php echo force_balance_tags($porto_settings['footer-copyright']) ?></div>
            <?php } else if ($porto_settings['footer-copyright-pos'] == 'left' && is_active_sidebar( 'footer-bottom' )) { ?>
                <div class="footer-right"><?php dynamic_sidebar( 'footer-bottom' ); ?></div>
            <?php } ?>
        </div>
    </div>
    <?php endif; ?>
</div>


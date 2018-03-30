<?php

/**
 * Default Sidebar for Pages
 * by www.unitedthemes.com
 */

$ut_get_sidebar_settings = ut_get_sidebar_settings();

?>

<?php if( !empty( $ut_get_sidebar_settings ) && $ut_get_sidebar_settings['primary_sidebar'] != 'no_sidebar' && is_active_sidebar( $ut_get_sidebar_settings['primary_sidebar'] ) ) : ?>
    
    <div id="secondary" class="widget-area grid-25 mobile-grid-100 tablet-grid-25" role="complementary">
        <ul class="sidebar">
            <?php dynamic_sidebar( $ut_get_sidebar_settings['primary_sidebar'] ); ?>
        </ul>
    </div>
    
<?php endif; ?>
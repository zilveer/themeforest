<?php
global $sidebar_width, $ish_options;
$id_404 = ( isset( $ish_options['page_for_404'] ) ) ? $ish_options['page_for_404'] : '';
$sidebar_position = ishyoboy_get_sidebar_position($id_404);

if ( 'left' == $sidebar_position || 'right' == $sidebar_position){
?>
<div class="grid3 <?php echo $sidebar_position . '-sidebar' ?>" id="sidebar">
    <div class="row">
        <?php $sidebar_width = 3; // Used when displaying widgets ?>
        <?php $sidebar = ishyoboy_get_sidebar($id_404); ?>
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar)) : else : ?>

        <div class="pre-widget">
            <div class="space"></div>
            <p><strong>Widgetized Sidebar</strong></p>
            <p>This panel is active and ready for you to add some widgets via the WP Admin</p>
        </div>

        <?php endif; ?>

        <div class="space"></div>

    </div>
</div>
<?php
}
?>
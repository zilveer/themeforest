<!-- Slide Container begin -->
<div class="quick-menu-container">
    <div class="row">
        <!-- Quickmenu begin -->
        <div id="quickmenu" class="columns large-10 large-centered">
            <?php
            $secondMenuNumber = $smof_data['pkb_secondary_menu_number'];
            if ($secondMenuNumber == 2) {
                $secondMenuNumber = 'large-block-grid-2';
            } elseif ($secondMenuNumber == 3) {
                $secondMenuNumber = 'large-block-grid-3';
            } else {
                $secondMenuNumber = 'large-block-grid-4';
            };
            ?>


            <?php // custom walker
            $walker = new quickmenu_nav_walker;
            wp_nav_menu(array(
                'theme_location' => 'secondary',
                'menu_class' => 'overview small-block-grid-2 ' . $secondMenuNumber . '',
                'walker' => $walker,
                'container_class' => '',
                'depth' => 1,
                'fallback_cb' => false
            )); ?>

        </div>
        <!-- Quickmenu end -->
    </div>
</div>
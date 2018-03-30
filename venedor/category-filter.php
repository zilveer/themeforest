<?php
global $venedor_settings, $venedor_layout, $venedor_sidebar;
?>
<div class="category-filter left-sidebar">
    <div class="filter-toggle"><i class="fa fa-filter"></i></div>
    <div class="filter-content">
        <?php dynamic_sidebar( $venedor_sidebar ); ?>
    </div>
</div>

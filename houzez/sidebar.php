<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 16/12/15
 * Time: 5:02 PM
 */
?>
<aside id="sidebar" class="sidebar-white">
    <?php
    if( is_active_sidebar( 'default-sidebar' ) ) {
        dynamic_sidebar( 'default-sidebar' );
    }
    ?>
</aside>

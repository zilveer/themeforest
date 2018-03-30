<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 06/10/16
 * Time: 6:09 PM
 */
?>
<!--start compare panel-->
<div id="compare-controller" class="compare-panel">
    <div class="compare-panel-header">
        <h4 class="title"> <?php esc_html_e( 'Compare Listings', 'houzez' ); ?> <span class="panel-btn-close pull-right"><i class="fa fa-times"></i></span></h4>
    </div>
    <?php do_action('houzez_show_compare', $args = '' );  ?>
</div>
<!--end compare panel-->

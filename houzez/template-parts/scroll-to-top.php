<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 04/10/16
 * Time: 8:17 PM
 * Since v1.4.0
 */
$site_scroll_top = houzez_option('site_scroll_top');
if( $site_scroll_top != 0 ) {
?>
<button class="btn scrolltop-btn back-top"><i class="fa fa-angle-up"></i></button>
<?php } ?>

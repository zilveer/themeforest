<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 03/08/16
 * Time: 11:30 PM
 */
global $post;

$houzez_walkscore = houzez_option('houzez_walkscore');
$houzez_walkscore_api = houzez_option('houzez_walkscore_api');

if( $houzez_walkscore != 0 && $houzez_walkscore_api != '' ) {
?>
<div id="walkscore" class="detail-features detail-block">
    <div class="detail-title">
        <h2 class="title-left"><?php esc_html_e( 'WalkScore', 'houzez' ); ?></h2>
    </div>
    <div class="walkscore-block"> <?php houzez_walkscore($post->ID); ?></div>

</div>
<?php } ?>
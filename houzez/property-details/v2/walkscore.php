<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 27/09/16
 * Time: 5:04 PM
 * Since v1.4.0
 */
global $post;

$houzez_walkscore = houzez_option('houzez_walkscore');
$houzez_walkscore_api = houzez_option('houzez_walkscore_api');

if( $houzez_walkscore != 0 && $houzez_walkscore_api != '' ) {
    ?>
    <div id="walkscore" class="detail-walkscore detail-block">
        <div class="walkscore_details"> <?php houzez_walkscore($post->ID); ?></div>

    </div>
<?php } ?>
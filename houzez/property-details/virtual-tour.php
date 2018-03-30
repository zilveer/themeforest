<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/08/16
 * Time: 12:10 AM
 */
global $post;
$virtual_tour = get_post_meta( $post->ID, 'fave_virtual_tour', true );

if( !empty( $virtual_tour ) ) {
    ?>
    <div id="virtual_tour" class="property-virtual-tour detail-block">
        <div class="detail-title">
            <h2 class="title-left"><?php esc_html_e( '360° Virtual Tour', 'houzez' ); ?></h2>
        </div>
        <div class="virtual-tour-block">
            <?php echo $virtual_tour; ?>
        </div>
    </div>
<?php } ?>
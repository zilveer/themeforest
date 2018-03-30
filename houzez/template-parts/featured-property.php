<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 25/01/16
 * Time: 11:22 PM
 */
$prop_featured = get_post_meta( get_the_ID(), 'fave_featured', true );
?>
<?php if( $prop_featured != 0 ) { ?>
    <span class="label-featured label label-success"><?php esc_html_e( 'Featured', 'houzez' ); ?></span>
<?php } ?>

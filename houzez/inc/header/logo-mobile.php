<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 22/08/16
 * Time: 8:02 PM
 */
global $post;
$mobile_logo = houzez_option( 'mobile_logo', false, 'url' );
?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
    <?php if( !empty( $mobile_logo ) ) { ?>
       <img src="<?php echo esc_url( $mobile_logo ); ?>" alt="Mobile logo">
    <?php } ?>
</a>
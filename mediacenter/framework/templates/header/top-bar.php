<?php
/**
 * Top Bar
 *
 * @author      Ibrahim Ibn Dawood
 * @package     Framework/Templates
 * @version     1.0.6
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$top_bar_left_switch = apply_filters( 'mc_is_enable_top_bar_left_switch', true );
$top_bar_right_switch = apply_filters( 'mc_is_enable_top_bar_right_switch', true );
$hide_top_bar_on_mobile = apply_filters( 'mc_is_enable_top_bar_on_mobile', false );

$top_left_menu_dropdown_animation = apply_filters( 'mc_menu_dropdown_animation', 'none', 'top-left' );
$top_right_menu_dropdown_animation = apply_filters( 'mc_menu_dropdown_animation', 'none', 'top-right' );

$top_bar_class = 'top-bar';
if( $hide_top_bar_on_mobile ) {
    $top_bar_class .= ' hidden-xs';
}
?>

<nav class="<?php echo esc_attr( $top_bar_class ); ?>">
    <div class="container">
        <div class="col-xs-12 col-sm-6 no-margin <?php if( $top_left_menu_dropdown_animation != 'none' ) { echo 'animate-dropdown'; } ?>">
        <?php 
            if( $top_bar_left_switch ) {
                echo media_center_top_left_nav_menu();
            }
        ?>
        </div><!-- /.col -->
        
        
        <div class="col-xs-12 col-sm-6 no-margin <?php if( $top_right_menu_dropdown_animation != 'none' ) { echo 'animate-dropdown'; } ?>">
        <?php 
            if( $top_bar_right_switch ) {
                echo media_center_top_right_nav_menu();
            }
        ?>
        </div><!-- /.col -->
    </div><!-- /.container -->
</nav><!-- /.top-bar -->
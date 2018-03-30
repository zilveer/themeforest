<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 16/06/16
 * Time: 1:32 AM
 */
$top_bar_left = houzez_option('top_bar_left');
$top_bar_right = houzez_option('top_bar_right');
$top_bar_mobile = houzez_option('top_bar_mobile');
$top_bar_width = houzez_option('top_bar_width');

$nav_left_class = $nav_right_class = $top_bar_right_width = $top_bar_left_width = $top_has_nav = $hide_top_bar_mobile = $top_drop_downs_left = $top_drop_downs_right ='';

if( $top_bar_left == 'menu_bar' ) {
    $nav_left_class = 'top-nav-area';
    $top_has_nav = 'top-has-nav';

} elseif( $top_bar_right == 'menu_bar' ) {
    $nav_right_class = 'top-nav-area';
    $top_has_nav = 'top-has-nav';
}

if( $top_bar_left == 'none' ) {
    $top_bar_right_width = 'houzez-top-bar-full';
}

if( $top_bar_right == 'none' ) {
    $top_bar_left_width = 'houzez-top-bar-full';
}

if( $top_bar_mobile != 0 ) {
    $hide_top_bar_mobile = 'hide-top-bar-mobile';
}

if( $top_bar_left == 'houzez_switchers' ) {
    $top_drop_downs_left = 'top-drop-downs';
}
if( $top_bar_right == 'houzez_switchers' ) {
    $top_drop_downs_right = 'top-drop-downs';
}

?>
<div class="top-bar <?php echo esc_attr( $top_has_nav ).' '.esc_attr( $hide_top_bar_mobile );?>">
    <div class="<?php echo esc_attr($top_bar_width);?>">
        <div class="row">
            <div class="col-sm-12">

                <?php if( $top_bar_left != 'none' ) { ?>
                <div class="top-bar-left <?php echo esc_attr( $nav_left_class.' '.$top_bar_left_width ); ?>">
                    <?php if( $top_bar_left == 'social_icons' || $top_bar_left == 'contact_info' || $top_bar_left == 'contact_info_and_social_icons' || $top_bar_left == 'slogan' || $top_bar_left == 'houzez_switchers' ) { ?>
                        <div class="top-contact">
                            <ul class="<?php esc_attr_e($top_drop_downs_left);?>">
                                <?php
                                if( $top_bar_left == 'contact_info' ) {
                                    get_template_part( 'inc/header/top-bar-contact' );

                                } elseif ( $top_bar_left == 'social_icons' ) {
                                    get_template_part( 'inc/header/top-bar-social' );

                                } elseif ( $top_bar_left == 'contact_info_and_social_icons' ) {
                                    get_template_part( 'inc/header/top-bar-contact' );
                                    get_template_part( 'inc/header/top-bar-social' );

                                } elseif ( $top_bar_left == 'slogan' ) {
                                    get_template_part( 'inc/header/top-bar-slogan' );

                                } elseif ( $top_bar_left == 'houzez_switchers' ) {
                                    get_template_part( 'inc/header/top-bar-currency' );
                                    get_template_part( 'inc/header/top-bar-area' );
                                }
                                ?>
                            </ul>
                        </div>
                    <?php } //end top bar left social_icons || contact_info || contact_info_and_social_icons  ?>

                    <?php
                    if ( $top_bar_left == 'menu_bar' ) {
                        get_template_part( 'inc/header/top-bar-nav' );
                    } ?>
                </div>
                <?php } //end top bar left if ?>

                <?php if( $top_bar_right != 'none' ) { ?>
                <div class="top-bar-right <?php echo esc_attr( $nav_right_class.' '.$top_bar_right_width ); ?>">

                    <?php if( $top_bar_right == 'social_icons' || $top_bar_right == 'contact_info' || $top_bar_right == 'contact_info_and_social_icons' || $top_bar_right == 'slogan' || $top_bar_right == 'houzez_switchers' ) { ?>
                    <div class="top-contact">
                        <ul class="<?php esc_attr_e($top_drop_downs_right);?>">
                            <?php
                            if( $top_bar_right == 'contact_info' ) {
                                get_template_part( 'inc/header/top-bar-contact' );

                            } elseif ( $top_bar_right == 'social_icons' ) {
                                get_template_part( 'inc/header/top-bar-social' );

                            } elseif ( $top_bar_right == 'contact_info_and_social_icons' ) {
                                get_template_part( 'inc/header/top-bar-contact' );
                                get_template_part( 'inc/header/top-bar-social' );

                            } elseif ( $top_bar_right == 'slogan' ) {
                                get_template_part( 'inc/header/top-bar-slogan' );

                            } elseif ( $top_bar_right == 'houzez_switchers' ) {
                                get_template_part( 'inc/header/top-bar-currency' );
                                get_template_part( 'inc/header/top-bar-area' );
                            }
                            ?>
                        </ul>
                    </div>
                    <?php } //end top bar right social_icons || contact_info || contact_info_and_social_icons  ?>

                    <?php
                    if ( $top_bar_right == 'menu_bar' ) {
                        get_template_part( 'inc/header/top-bar-nav' );
                    } ?>

                </div>
                <?php } //end top bar right if ?>

            </div>
        </div>
    </div>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 27/09/16
 * Time: 5:03 PM
 * Since v1.4.0
 */
global $floor_plans;

$icon_rooms = houzez_option('icon_rooms', false, 'url' );
$icon_bathrooms = houzez_option('icon_bathrooms', false, 'url' );
$icon_prop_size = houzez_option('icon_prop_size', false, 'url' );

if( !empty( $floor_plans ) ) {
?>
<div class="property-plans detail-block">
    <div class="container">
        <div class="detail-title">
            <h2 class="title-left"><?php esc_html_e( 'Floor plans', 'houzez' ); ?></h2>
        </div>
        <div class="plan-tabber">
            <ul class="plan-tabs">
                <?php
                $i = 0;
                foreach( $floor_plans as $pln ):
                    $i++;
                    if( $i == 1 ) {
                        $active = 'class="active"';
                    } else {
                        $active = '';
                    }
                    echo '<li '.$active.'>'.esc_attr( $pln['fave_plan_title'] ).'</li>';
                endforeach;
                ?>
            </ul>
            <div class="tab-content">
                <?php
                $j = 0;
                foreach( $floor_plans as $plan ):
                    $j++;
                    if( $j == 1 ) {
                        $active_tab = 'active in';
                    } else {
                        $active_tab = '';
                    }
                    $price_postfix = '';
                    if( !empty( $plan['fave_plan_price_postfix'] ) ) {
                        $price_postfix = ' / '.$plan['fave_plan_price_postfix'];
                    }
                    ?>

                    <div class="tab-pane fade <?php echo esc_attr( $active_tab );?>">
                        <div class="col-sm-6 col-xs-12">
                            <div class="floor-image">
                                <?php if( !empty( $plan['fave_plan_image'] ) ) { ?>
                                    <img src="<?php echo esc_url( $plan['fave_plan_image'] ); ?>" alt="img" width="" height="">
                                <?php } ?>
                            </div>

                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="floor-content">
                                <div class="floor-title-block">
                                    <h2 class="floor-title"><?php echo esc_attr( $plan['fave_plan_title'] ); ?></h2>
                                    <h3 class="floor-price"> <?php esc_html_e( 'Price:', 'houzez' ); ?> <?php echo houzez_get_property_price( $plan['fave_plan_price'] ).$price_postfix; ?> </h3>
                                </div>

                                <?php if( !empty( $plan['fave_plan_description'] ) ) { ?>
                                    <p><?php echo esc_attr( $plan['fave_plan_description'] ); ?></p>
                                <?php } ?>

                                <div class="row">
                                    <ul class="detail-amenities-list">
                                        <li class="media">
                                            <?php if( !empty($icon_rooms) ) { ?>
                                                <div class="media-left media-middle"><img src="<?php echo esc_url($icon_rooms); ?>" width="50" height="34" alt="Icon"></div>
                                            <?php } ?>
                                            <div class="media-body media-middle"> <?php esc_html_e( 'Rooms:', 'houzez' ); ?><br> <?php echo esc_attr( $plan['fave_plan_rooms'] ); ?> </div>
                                        </li>
                                        <li class="media">
                                            <?php if( !empty($icon_bathrooms) ) { ?>
                                                <div class="media-left media-middle"><img src="<?php echo esc_url($icon_bathrooms); ?>" width="50" height="34" alt="Icon"></div>
                                            <?php } ?>
                                            <div class="media-body media-middle"> <?php esc_html_e( 'Baths:', 'houzez' ); ?><br> <?php echo esc_attr( $plan['fave_plan_bathrooms'] ); ?> </div>
                                        </li>
                                        <li class="media">
                                            <?php if( !empty($icon_prop_size) ) { ?>
                                                <div class="media-left media-middle"><img src="<?php echo esc_url($icon_prop_size); ?>" width="46" height="46" alt="Icon"></div>
                                            <?php } ?>
                                            <div class="media-body media-middle"> <?php esc_html_e( 'Size:', 'houzez' ); ?><br> <?php echo houzez_get_area_size( $plan['fave_plan_size'] ).' '.houzez_get_size_unit( '' ); //esc_attr( $plan['fave_plan_size'] ); ?> </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
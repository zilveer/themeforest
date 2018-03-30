<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/01/16
 * Time: 4:26 PM
 */
global $floor_plans;
?>

<?php if( !empty( $floor_plans ) ) { ?>
<div id="floor_plan" class="property-plans detail-block">
    <div class="detail-title">
        <h2 class="title-left"><?php esc_html_e( 'Floor plans', 'houzez' ); ?></h2>
    </div>
    <div class="accord-block">

        <?php foreach( $floor_plans as $plan ):
            $price_postfix = '';
            if( !empty( $plan['fave_plan_price_postfix'] ) ) {
                $price_postfix = ' / '.$plan['fave_plan_price_postfix'];
            }
            ?>
            <div class="accord-tab">
                <h3><?php echo esc_attr( $plan['fave_plan_title'] ); ?></h3>
                <ul>
                    <?php if( !empty( $plan['fave_plan_size'] ) ) { ?>
                        <li><?php esc_html_e( 'Size:', 'houzez' ); ?> <strong><?php echo houzez_get_area_size( $plan['fave_plan_size'] ).' '.houzez_get_size_unit( '' ); //esc_attr( $plan['fave_plan_size'] ); ?></strong></li>
                    <?php } ?>

                    <?php if( !empty( $plan['fave_plan_rooms'] ) ) { ?>
                        <li><?php esc_html_e( 'Rooms:', 'houzez' ); ?> <strong><?php echo esc_attr( $plan['fave_plan_rooms'] ); ?></strong></li>
                    <?php } ?>

                    <?php if( !empty( $plan['fave_plan_bathrooms'] ) ) { ?>
                        <li><?php esc_html_e( 'Baths:', 'houzez' ); ?> <strong><?php echo esc_attr( $plan['fave_plan_bathrooms'] ); ?></strong></li>
                    <?php } ?>

                    <?php if( !empty( $plan['fave_plan_price'] ) ) { ?>
                        <li><?php esc_html_e( 'Price:', 'houzez' ); ?> <strong><?php echo houzez_get_property_price( $plan['fave_plan_price'] ).$price_postfix; ?></strong></li>
                    <?php } ?>
                </ul>
                <div class="expand-icon"></div>
            </div>
            <div class="accord-content" style="display: none">
                <?php if( !empty( $plan['fave_plan_image'] ) ) { ?>
                    <img src="<?php echo esc_url( $plan['fave_plan_image'] ); ?>" alt="img" width="400" height="436">
                <?php } ?>

                <?php if( !empty( $plan['fave_plan_description'] ) ) { ?>
                    <p><?php echo esc_attr( $plan['fave_plan_description'] ); ?></p>
                <?php } ?>
            </div>
        <?php endforeach; ?>

    </div>

</div>
<?php } ?>

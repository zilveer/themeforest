<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 28/09/16
 * Time: 3:10 PM
 * Since v1.4.0
 */
global $enable_multi_units, $multi_units;
$mu_price_postfix = '';
if( $enable_multi_units != 'disable' && !empty( $enable_multi_units ) ) {

    if (!empty($multi_units)) {
        ?>
        <div class="detail-multi-properties detail-block">
            <div class="multi-properties-inner">
                <div class="table-wrapper">
                    <table class="table  table-striped table-multi-properties">
                        <thead>
                        <tr>
                            <th><?php esc_html_e('Title', 'houzez'); ?></th>
                            <th><?php esc_html_e('Property Type', 'houzez'); ?></th>
                            <th><?php esc_html_e('Price', 'houzez'); ?></th>
                            <th><?php esc_html_e('Beds', 'houzez'); ?></th>
                            <th><?php esc_html_e('Baths', 'houzez'); ?></th>
                            <th><?php esc_html_e('Property Size', 'houzez'); ?></th>
                            <th><?php esc_html_e('Availability Date', 'houzez'); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach( $multi_units as $mu ):

                            if( !empty( $mu['fave_mu_price_postfix'] ) ) {
                                $mu_price_postfix = ' / '.$mu['fave_mu_price_postfix'];
                            }
                            ?>

                            <tr>
                                <td class="title blue" width="25%">
                                    <p data-toggle="popover" data-content='
                                                <table class="table table-popover">
                                                    <tr>
                                                        <td class="table-popover-title"><?php esc_html_e('Title', 'houzez'); ?></td>
                                                        <td><a><?php echo esc_attr( $mu['fave_mu_title'] ); ?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-popover-title"><?php esc_html_e('Property Type', 'houzez'); ?></td>
                                                        <td><?php echo esc_attr( $mu['fave_mu_type'] ); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-popover-title"><?php esc_html_e('Price', 'houzez'); ?></td>
                                                        <td><?php echo houzez_get_property_price( $mu['fave_mu_price'] ).$mu_price_postfix; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-popover-title"><?php esc_html_e('Beds', 'houzez'); ?></td>
                                                        <td><?php echo esc_attr( $mu['fave_mu_beds'] ); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-popover-title"><?php esc_html_e('Baths', 'houzez'); ?></td>
                                                        <td><?php echo esc_attr( $mu['fave_mu_baths'] ); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-popover-title"><?php esc_html_e('Property Size', 'houzez'); ?></td>
                                                        <td><?php echo houzez_get_area_size($mu['fave_mu_size']).' '.houzez_get_size_unit( $mu['fave_mu_size_postfix'] ); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-popover-title"><?php esc_html_e('Availability Date', 'houzez'); ?></td>
                                                        <td><?php echo esc_attr( $mu['fave_mu_availability_date'] ); ?></td>
                                                    </tr>
                                                </table>
                                            '>
                                        <?php echo esc_attr( $mu['fave_mu_title'] ); ?>
                                    </p>
                                </td>
                                <td><?php echo esc_attr( $mu['fave_mu_type'] ); ?></td>
                                <td><?php echo houzez_get_property_price( $mu['fave_mu_price'] ).$mu_price_postfix; ?></td>
                                <td><?php echo esc_attr( $mu['fave_mu_beds'] ); ?></td>
                                <td><?php echo esc_attr( $mu['fave_mu_baths'] ); ?></td>
                                <td><?php echo houzez_get_area_size($mu['fave_mu_size']).' '.houzez_get_size_unit( $mu['fave_mu_size_postfix'] ); ?></td>
                                <td><?php echo esc_attr( $mu['fave_mu_availability_date'] ); ?></td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    }
}?>
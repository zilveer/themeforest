<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 21/01/16
 * Time: 7:17 PM
 */
global $post_meta_data;
$address = get_post_meta( get_the_ID(), 'fave_property_address', true );
$zipcode = get_post_meta( get_the_ID(), 'fave_property_zip', true );
$country = get_post_meta( get_the_ID(), 'fave_property_country', true );
$city = houzez_taxonomy_simple('property_city');
$state = houzez_taxonomy_simple('property_state');
$neighbourhood = houzez_taxonomy_simple('property_area');
$google_map_address = get_post_meta( get_the_ID(), 'fave_property_map_address', true );
$google_map_address_url = "http://maps.google.com/?q=".$google_map_address;
?>
<div id="address" class="detail-address detail-block">
    <div class="detail-title">
        <h2 class="title-left"><?php esc_html_e( 'Address', 'houzez' ); ?></h2>
        <?php if( !empty($google_map_address) ) { ?>
        <div class="title-right">
            <a target="_blank" href="<?php echo esc_url($google_map_address_url); ?>"><?php esc_html_e( 'Open on Google Maps', 'houzez' ); ?> <i class="fa fa-map-marker"></i></a>
        </div>
        <?php } ?>
    </div>
    <ul class="list-three-col">
        <?php
        if( !empty($address) ) {
            echo '<li class="detail-address"><strong>'.esc_html__('Address:', 'houzez').'</strong> '.esc_attr( $address ).'</li>';
        }
        if( !empty( $city ) ) {
            echo '<li class="detail-city"><strong>'.esc_html__('City:', 'houzez').'</strong> '.esc_attr( $city ).'</li>';
        }
        if( !empty( $state ) ) {
            echo '<li class="detail-state"><strong>'.esc_html__('State/county:', 'houzez').'</strong> '.esc_attr( $state ).'</li>';
        }
        if( !empty($zipcode) ) {
            echo '<li class="detail-zip"><strong>'.esc_html__('Zip/Postal Code:', 'houzez').'</strong> '.esc_attr( $zipcode ).'</li>';
        }
        if( !empty( $neighbourhood ) ) {
            echo '<li class="detail-area"><strong>'.esc_html__('Neighborhood:', 'houzez').'</strong> '.esc_attr( $neighbourhood ).'</li>';
        }
        if( !empty($country) ) {
            echo '<li class="detail-country"><strong>'.esc_html__('Country:', 'houzez').'</strong> '.houzez_country_code_to_country($country).'</li>';
        }
        ?>
    </ul>
</div>
<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 10/10/16
 * Time: 11:59 PM
 */
global $post,
       $prop_floor_plan,
       $enable_multi_units,
       $multi_units,
       $prop_video_img,
       $prop_video_url,
       $virtual_tour,
       $prop_features,
       $houzez_prop_detail,
       $prop_description;

$agent_display_option = get_post_meta( $post->ID, 'fave_agent_display_option', true );
$enableDisable_agent_forms = houzez_option('agent_forms');

$prop_detail_nav = houzez_option('prop-detail-nav');
$prop_content_layout = houzez_option('prop-content-layout');
$hide_yelp = houzez_option('houzez_yelp');

$layout = houzez_option('property_blocks');
$layout = $layout['enabled'];
if( isset( $_GET['prop_nav'] ) ) {
    $prop_detail_nav = $_GET['prop_nav'];
}
$prop_description = get_the_content();

if( $prop_detail_nav != 'no' && $prop_content_layout == "simple" ) { ?>
    <!--start property menu-->
    <div class="property-menu-wrap">
        <div class="container">
            <ul class="property-menu">
                <li><a class="back-top" href="#header-section"><i class="fa fa-long-arrow-up"></i></a></li>


                <?php
                if ($layout): foreach ($layout as $key=>$value) {

                    switch($key) {

                        case 'unit':
                            if( $enable_multi_units != 'disable' && !empty( $enable_multi_units ) ) {
                                echo '<li><a class="target" href="#sub_property">' . esc_html__('Sub listings', 'houzez') . '</a></li>';
                            }
                            break;

                        case 'description':
                            if( !empty($prop_description) ) {
                                echo '<li><a class="target" href="#description">' . esc_html__('Description', 'houzez') . '</a></li>';
                            }
                            break;

                        case 'address':
                            echo '<li><a class="target" href="#address">'.esc_html__('Address', 'houzez').'</a></li>';
                            break;

                        case 'details':
                            if( $houzez_prop_detail ) {
                                echo '<li><a class="target" href="#detail">' . esc_html__('Details', 'houzez') . '</a></li>';
                            }
                            break;

                        case 'features':
                            if( !empty($prop_features) ) {
                                echo '<li><a class="target" href="#features">' . esc_html__('Features', 'houzez') . '</a></li>';
                            }
                            break;

                        case 'floor_plans':
                            if( $prop_floor_plan != 'disable' && !empty( $prop_floor_plan ) ) {
                                echo '<li><a class="target" href="#floor_plan">'.esc_html__('Floor Plans', 'houzez').'</a></li>';
                            };
                            break;

                        case 'video':
                            if( !empty( $prop_video_url ) && !empty($prop_video_img)) {
                                echo '<li><a class="target" href="#video">' . esc_html__('Video', 'houzez') . '</a></li>';
                            }
                            break;

                        case 'virtual_tour':
                            if(!empty($virtual_tour)) {
                                echo '<li><a class="target" href="#virtual_tour">' . esc_html__('360° Virtual Tour', 'houzez') . '</a></li>';
                            }
                            break;

                        case 'walkscore':
                            echo '<li><a class="target" href="#walkscore">'.esc_html__('Walkscore', 'houzez').'</a></li>';
                            break;

                        case 'stats':
                            echo '<li><a class="target" href="#stats">'.esc_html__('Stats', 'houzez').'</a></li>';
                            break;

                        case 'yelp_nearby':
                            if( $hide_yelp ) {
                                echo '<li><a class="target" href="#yelp_nearby">' . esc_html__('Near by', 'houzez') . '</a></li>';
                            }
                            break;

                        case 'agent_bottom':
                            if( $enableDisable_agent_forms != 0 && $agent_display_option != 'none') {
                                echo '<li><a class="target" href="#agent_bottom">' . esc_html__('Contact', 'houzez') . '</a></li>';
                            }
                            break;

                    }

                }

                endif;
                ?>

            </ul>
        </div>
    </div>
    <!--end property menu-->
<?php } ?>
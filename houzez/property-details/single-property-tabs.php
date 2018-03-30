<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 21/01/16
 * Time: 7:26 PM
 */
global $prop_floor_plan, $prop_video_url, $prop_video_img, $virtual_tour, $prop_features, $prop_description, $houzez_prop_detail;
$layout = houzez_option('property_blocks_tabs');
$layout = $layout['enabled'];

$tab_end = '</div>';
$li_end = '</li>';
$prop_description = get_the_content();
?>

<?php get_template_part('property-details/multi', 'unit'); ?>

<!--start detail content tabber-->
<div class="detail-content-tabber">
    <!--start detail tabs-->
    <ul class="detail-tabs">
        <?php
        $i = 0;
        if ($layout): foreach ($layout as $key => $value) {

            if( $i == 1 ) { $li_start = '<li class="active">'; } else { $li_start = '<li>'; }

            switch($key) {

                case 'description':
                    if( !empty($prop_description) ) {
                        echo $li_start;
                        esc_html_e('Description', 'houzez');
                        echo $li_end;
                    }
                    break;

                case 'address':
                    echo $li_start;
                    esc_html_e( 'Address', 'houzez' );
                    echo $li_end;
                    break;

                case 'details':
                    if( $houzez_prop_detail ) {
                        echo $li_start;
                        esc_html_e('Details', 'houzez');
                        echo $li_end;
                    }
                    break;

                case 'features':
                    if( !empty($prop_features) ) {
                        echo $li_start;
                        esc_html_e('Features', 'houzez');
                        echo $li_end;
                    }
                    break;

                case 'floor_plans':
                    if( $prop_floor_plan != 'disable' && !empty( $prop_floor_plan ) ) {
                        echo $li_start;
                        esc_html_e( 'Floor Plan', 'houzez' );
                        echo $li_end;
                    };
                    break;

                case 'video':
                    if( !empty( $prop_video_url ) && !empty($prop_video_img)) {
                        echo $li_start;
                        esc_html_e( 'Video', 'houzez' );
                        echo $li_end;
                    }
                    break;

                case 'virtual_tour':
                    if( !empty( $virtual_tour ) ) {
                        echo $li_start;
                        esc_html_e('Virtual Tour', 'houzez');
                        echo $li_end;
                    }
                    break;

            }
            $i++;
        }

        endif;
        ?>

    </ul>
    <!--end detail tabs-->

    <!--start tab-content-->
    <div class="tab-content">
        <?php
        $j = 0;
        if ($layout): foreach ($layout as $key=>$value) {

            if( $j == 1 ) { $tab_start = '<div class="tab-pane fade in active">'; } else { $tab_start = '<div class="tab-pane fade">'; }

            switch($key) {

                case 'description':
                    if( !empty($prop_description) ) {
                        echo $tab_start;
                        get_template_part('property-details/property', 'description');
                        echo $tab_end;
                    }
                    break;

                case 'address':
                    echo $tab_start;
                        get_template_part( 'property-details/property', 'address' );
                    echo $tab_end;
                    break;

                case 'details':
                    if( $houzez_prop_detail ) {
                        echo $tab_start;
                        get_template_part('property-details/property', 'details');
                        echo $tab_end;
                    }
                    break;

                case 'features':
                    if( !empty($prop_features) ) {
                        echo $tab_start;
                        get_template_part('property-details/property', 'features');
                        echo $tab_end;
                    }
                    break;

                case 'floor_plans':
                    if( $prop_floor_plan != 'disable' && !empty( $prop_floor_plan ) ) {
                        echo $tab_start;
                            get_template_part('property-details/floor', 'plans');
                        echo $tab_end;
                    }
                    break;

                case 'video':
                    if( !empty( $prop_video_url ) && !empty($prop_video_img)) {
                        echo $tab_start;
                        get_template_part('property-details/property', 'video');
                        echo $tab_end;
                    }
                    break;

                case 'virtual_tour':
                    if( !empty( $virtual_tour ) ) {
                        echo $tab_start;
                        get_template_part('property-details/virtual', 'tour');
                        echo $tab_end;
                    }
                    break;
            }
            $j++;
        }

        endif;
        ?>

    </div>
    <!--end tab-content-->
</div>
<!--end detail content tabber-->

<?php get_template_part( 'property-details/walkscore' ); ?>

<?php get_template_part('property-details/yelp', 'nearby'); ?>

<?php get_template_part( 'property-details/property', 'stats' ); ?>

<?php get_template_part( 'property-details/agent', 'bottom' ); ?>
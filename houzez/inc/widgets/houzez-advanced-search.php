<?php
/**
 * Widget Name: Advanced Search
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 *
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 20/01/16
 * Time: 10:51 PM
 */

class HOUZEZ_advanced_search extends WP_Widget {

    /**
     * Register widget
     **/
    public function __construct() {

        parent::__construct(
            'houzez_advanced_search', // Base ID
            esc_html__( 'HOUZEZ: Advanced Search', 'houzez' ), // Name
            array( 'description' => esc_html__( 'Advanced Search', 'houzez' ), ) // Args
        );

    }


    /**
     * Front-end display of widget
     **/
    public function widget( $args, $instance ) {

        global $before_widget, $after_widget, $before_title, $after_title, $post;
        extract( $args );

        $allowed_html_array = array(
            'div' => array(
                'id' => array(),
                'class' => array()
            ),
            'h3' => array(
                'class' => array()
            )
        );

        $title = apply_filters('widget_title', $instance['title'] );

        echo wp_kses( $before_widget, $allowed_html_array );

        if ( $title ) echo wp_kses( $before_title, $allowed_html_array ) . $title . wp_kses( $after_title, $allowed_html_array );

        houzez_advanced_search_widget();

        echo wp_kses( $after_widget, $allowed_html_array );

    }


    /**
     * Sanitize widget form values as they are saved
     **/
    public function update( $new_instance, $old_instance ) {

        $instance = array();

        /* Strip tags to remove HTML. For text inputs and textarea. */
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;

    }


    /**
     * Back-end widget form
     **/
    public function form( $instance ) {

        /* Default widget settings. */
        $defaults = array(
            'title' => 'Find Your Home'
        );
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'houzez'); ?></label>
            <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
        </p>

        <?php
    }

}

if ( ! function_exists( 'HOUZEZ_advanced_search_loader' ) ) {
    function HOUZEZ_advanced_search_loader (){
        register_widget( 'HOUZEZ_advanced_search' );
    }
    add_action( 'widgets_init', 'HOUZEZ_advanced_search_loader' );
}

function houzez_advanced_search_widget() {

    $search_template = houzez_get_search_template_link();
    $adv_show_hide = houzez_option('adv_show_hide');
    $keyword_field = houzez_option('keyword_field');

    $houzez_local = houzez_get_localization();

    if( $keyword_field == 'prop_title' ) {
        $keyword_field_placeholder = $houzez_local['keyword_text'];

    } else if( $keyword_field == 'prop_city_state_county' ) {
        $keyword_field_placeholder = $houzez_local['city_state_area'];

    } else if( $keyword_field == 'prop_address' ) {
        $keyword_field_placeholder = $houzez_local['search_address'];

    } else {
        $keyword_field_placeholder = $houzez_local['enter_location'];
    }
    $location = $type = $status = $state = $searched_country = $area = '';

    if( isset( $_GET['status'] ) ) {
        $status = $_GET['status'];
    }
    if( isset( $_GET['type'] ) ) {
        $type = $_GET['type'];
    }
    if( isset( $_GET['area'] ) ) {
        $area = $_GET['area'];
    }
    if( isset( $_GET['location'] ) ) {
        $location = $_GET['location'];
    }

    if( isset( $_GET['state'] ) ) {
        $state = $_GET['state'];
    }
    if( isset( $_GET['country'] ) ) {
        $searched_country = $_GET['country'];
    }

    $keyword_field = houzez_option('keyword_field');
 ?>
    <div class="widget-range">
        <div class="widget-body">
            <form method="get" action="<?php echo esc_url( $search_template ); ?>">
                <div class="range-block rang-form-block">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 keyword_search">
                            <div class="form-group">
                                <input type="text" class="houzez_geocomplete form-control" value="<?php echo isset ( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>" name="keyword" placeholder="<?php echo $keyword_field_placeholder; ?>">
                            </div>
                        </div>

                        <?php if( $adv_show_hide['countries'] != 1 ) { ?>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <select name="country" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                                    <?php
                                    // All Option
                                    echo '<option value="">'.$houzez_local['all_countries'].'</option>';

                                    countries_dropdown( $searched_country );
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if( $adv_show_hide['states'] != 1 ) { ?>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <select name="state" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                                    <?php
                                    // All Option
                                    echo '<option value="">'.$houzez_local['all_states'].'</option>';

                                    $prop_state = get_terms (
                                        array(
                                            "property_state"
                                        ),
                                        array(
                                            'orderby' => 'name',
                                            'order' => 'ASC',
                                            'hide_empty' => true,
                                            'parent' => 0
                                        )
                                    );
                                    houzez_hirarchical_options('property_state', $prop_state, $state );
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if( $adv_show_hide['cities'] != 1 ) { ?>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <select name="location" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                    <?php
                                    // All Option
                                    echo '<option value="">'.$houzez_local['all_cities'].'</option>';

                                    $prop_city = get_terms (
                                        array(
                                            "property_city"
                                        ),
                                        array(
                                            'orderby' => 'name',
                                            'order' => 'ASC',
                                            'hide_empty' => true,
                                            'parent' => 0
                                        )
                                    );
                                    houzez_hirarchical_options('property_city', $prop_city, $location );
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if( $adv_show_hide['areas'] != 1 ) { ?>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <select name="area" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                        <?php
                                        // All Option
                                        echo '<option value="">'.$houzez_local['all_areas'].'</option>';

                                        $prop_area = get_terms (
                                            array(
                                                "property_area"
                                            ),
                                            array(
                                                'orderby' => 'name',
                                                'order' => 'ASC',
                                                'hide_empty' => true,
                                                'parent' => 0
                                            )
                                        );
                                        houzez_hirarchical_options('property_area', $prop_area, $area );
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if( $adv_show_hide['beds'] != 1 ) { ?>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <select name="bedrooms" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="">
                                    <option value=""><?php echo $houzez_local['beds']; ?></option>
                                    <?php houzez_number_list('bedrooms'); ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if( $adv_show_hide['baths'] != 1 ) { ?>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <select name="bathrooms" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="">
                                    <option value=""><?php echo $houzez_local['baths']; ?></option>
                                    <?php houzez_number_list('bathrooms'); ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if( $adv_show_hide['type'] != 1 ) { ?>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <select name="type" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                                    <?php
                                    // All Option
                                    echo '<option value="">'.$houzez_local['all_types'].'</option>';

                                    $prop_type = get_terms (
                                        array(
                                            "property_type"
                                        ),
                                        array(
                                            'orderby' => 'name',
                                            'order' => 'ASC',
                                            'hide_empty' => true,
                                            'parent' => 0
                                        )
                                    );
                                    houzez_hirarchical_options('property_type', $prop_type, $type );
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if( $adv_show_hide['status'] != 1 ) { ?>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <select class="selectpicker" id="widget_status" name="status" data-live-search="false" data-live-search-style="begins">
                                    <?php
                                    // All Option
                                    echo '<option value="">'.$houzez_local['all_status'].'</option>';

                                    $prop_status = get_terms (
                                        array(
                                            "property_status"
                                        ),
                                        array(
                                            'orderby' => 'name',
                                            'order' => 'ASC',
                                            'hide_empty' => false,
                                            'parent' => 0
                                        )
                                    );
                                    houzez_hirarchical_options('property_status', $prop_status, $status );
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>

                <?php if( $adv_show_hide['price_slider'] != 1 ) { ?>
                <div class="range-block">
                    <h4><?php echo $houzez_local['price_range']; ?></h4>
                    <div id="slider-price"></div>
                    <div class="clearfix range-text">
                        <input type="text" name="min-price" class="pull-left range-input text-left" id="min-price" readonly >
                        <input type="text" name="max-price" class="pull-right range-input text-right" id="max-price" readonly >
                    </div>
                </div>
                <?php } ?>

                <?php if( $adv_show_hide['area_slider'] != 1 ) { ?>
                <div class="range-block">
                    <h4><?php echo $houzez_local['area_size']; ?></h4>
                    <div id="slider-size"></div>
                    <div class="clearfix range-text">
                        <input type="text" name="min-area" class="pull-left range-input text-left" id="min-size" readonly >
                        <input type="text" name="max-area" class="pull-right range-input text-right" id="max-size" readonly >
                    </div>
                </div>
                <?php } ?>

                <?php if( $adv_show_hide['other_features'] != 1 ) { ?>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <label class="advance-trigger"><i class="fa fa-plus-square"></i> <?php echo $houzez_local['other_feature']; ?> </label>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="features-list field-expand">
                                <div class="clearfix"></div>
                                <?php get_template_part('template-parts/advanced-search/search-features'); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="range-block rang-form-block">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-orange btn-block"><i class="fa fa-search fa-left"></i><?php echo $houzez_local['search']; ?></button>
                        </div>
                     </div>
                </div>

            </form>
        </div>
    </div>
<?php
}
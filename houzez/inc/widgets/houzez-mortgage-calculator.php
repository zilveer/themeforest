<?php
/**
 * Widget Name: Mortgage Calculator
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 *
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 26/07/16
 * Time: 11:56 PM
 */
class HOUZEZ_mortgage_calculator extends WP_Widget {

    /**
     * Register widget
     **/
    public function __construct() {

        parent::__construct(
            'houzez_mortgage_calculator', // Base ID
            esc_html__( 'HOUZEZ: Mortgage Calculator', 'houzez' ), // Name
            array( 'description' => esc_html__( 'Add a responsive mortgage calculator widget', 'houzez' ), 'classname' => 'widget-calculate' ) // Args
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

        houzez_mortgage_calculator_widget();

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
            'title' => 'Mortgage Calculator'
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

if ( ! function_exists( 'HOUZEZ_mortgage_calculator_loader' ) ) {
    function HOUZEZ_mortgage_calculator_loader (){
        register_widget( 'HOUZEZ_mortgage_calculator' );
    }
    add_action( 'widgets_init', 'HOUZEZ_mortgage_calculator_loader' );
}

if( ! function_exists('houzez_mortgage_calculator_widget') ) {
    function houzez_mortgage_calculator_widget() {

        $currency_symbol = houzez_option('currency_symbol');
    ?>

        <div class="widget-body">
            <form method="" action="#">
                <div class="form-group icon-holder">
                    <input class="form-control" id="mc_total_amount" placeholder="<?php esc_html_e('Total Amount', 'houzez'); ?>" type="text">
                    <span class="field-icon"><?php esc_attr_e($currency_symbol);?></span>
                </div>
                <div class="form-group icon-holder">
                    <input class="form-control" id="mc_down_payment" placeholder="<?php esc_html_e('Down Payment', 'houzez'); ?>" type="text">
                    <span class="field-icon"><?php esc_attr_e($currency_symbol);?></span>
                </div>
                <div class="form-group icon-holder">
                    <input class="form-control" id="mc_interest_rate" placeholder="<?php esc_html_e('Interest Rate', 'houzez'); ?>" type="text">
                    <span class="field-icon">%</span>
                </div>
                <div class="form-group icon-holder">
                    <input class="form-control" id="mc_term_years" placeholder="<?php esc_html_e('Loan Term (Years)', 'houzez'); ?>" type="text">
                    <span class="field-icon"><i class="fa fa-calendar"></i></span>
                </div>
                <div class="form-group icon-holder">
                    <select class="selectpicker" id="mc_payment_period" data-live-search="false" data-live-search-style="begins">
                        <option value="12"><?php esc_html_e('Monthly', 'houzez'); ?></option>
                        <option value="26"><?php esc_html_e('Bi-Weekly', 'houzez'); ?></option>
                        <option value="52"><?php esc_html_e('Weekly', 'houzez'); ?></option>
                    </select>
                </div>
                <button id="houzez_mortgage_calculate" class="btn btn-orange btn-block"><?php esc_html_e('Calculate', 'houzez');?></button>
                <div class="morg-detail">
                    <div class="morg-result">
                        <div id="mortgage_mwbi"></div>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon_inspector.png" alt="icon inspector" class="show-morg">
                    </div>
                    <div class="morg-summery">
                        <div class="result-title">
                            <?php esc_html_e('Amount Financed:', 'houzez'); ?>
                        </div>
                        <div id="amount_financed" class="result-value"></div>

                        <div class="result-title">
                            <?php esc_html_e('Mortgage Payments:', 'houzez'); ?>
                        </div>
                        <div id="mortgage_pay" class="result-value"></div>

                        <div class="result-title">
                            <?php esc_html_e('Annual cost of Loan:', 'houzez'); ?>
                        </div>
                        <div id="annual_cost" class="result-value"></div>

                        <!--<div class="result-title">
                            <?php /*esc_html_e('Total Mortgage with Interest:', 'houzez'); */?>
                        </div>
                        <div id="total_mortgage_with_interest" class="result-value"></div>

                        <div class="result-title">
                            <?php /*esc_html_e('Total with Down Payment:', 'houzez'); */?>
                        </div>
                        <div id="total_with_downpayment" class="result-value"></div>-->

                    </div>
                </div>
            </form>
        </div>
        <?php
    }
}
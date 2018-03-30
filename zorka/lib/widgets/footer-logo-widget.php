<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/26/15
 * Time: 5:24 PM
 */
class Zorka_Footer_Logo extends  G5Plus_Widget {
    public function __construct() {
        $this->widget_cssclass    = 'widget-footer-logo';
        $this->widget_description = esc_html__("Logo and sub description", 'zorka' );
        $this->widget_id          = 'zorka-footer-logo';
        $this->widget_name        = esc_html__('Zorka: Footer Logo', 'zorka' );
        $this->settings           = array(
            'sub_description'  => array(
                'type'  => 'text-area',
                'std'   => '',
                'label' => esc_html__('Sub Description', 'zorka' )
            )
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        $sub_description  = empty( $instance['sub_description'] ) ? '' : apply_filters( 'widget_sub_description', $instance['sub_description'] );
        $class_custom   = empty( $instance['class_custom'] ) ? '' : apply_filters( 'widget_class_custom', $instance['class_custom'] );
        $widget_id = $args['widget_id'];
        echo wp_kses_post($before_widget);
        global $zorka_data;
        $zoka_footer_logo = '';
        if(isset($zorka_data['site-logo-white']))
            $zoka_footer_logo = $zorka_data['site-logo-white'];
        if(isset($zorka_data['footer-layout']) && $zorka_data['footer-layout']=='1')
            $zoka_footer_logo = $zorka_data['site-logo'];

        ?>
        <div class="footer-logo <?php echo esc_attr($class_custom) ?>">
            <?php if(isset($zoka_footer_logo) && $zoka_footer_logo!='') { ?>
                <a href="<?php echo get_home_url() ?>"><img src="<?php echo esc_url($zoka_footer_logo) ?>" alt="<?php esc_html_e('Zorka logo','zorka') ?>" /></a>
            <?php } ?>
            <div class="sub-description">
                <?php echo wp_kses_post($sub_description) ?>
            </div>
        </div>

        <?php
        echo wp_kses_post($after_widget);
    }
}
if (!function_exists('zorka_register_widget_footer_logo')) {
    function zorka_register_widget_footer_logo() {
        register_widget('Zorka_Footer_Logo');
    }
    add_action('widgets_init', 'zorka_register_widget_footer_logo', 1);
}
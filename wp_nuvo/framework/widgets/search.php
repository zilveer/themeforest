<?php
add_action('widgets_init', 'cs_search_popup_widgets');

function cs_search_popup_widgets() {
    register_widget('CS_Search_Popup_Widget');
}

class CS_Search_Popup_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'cs_search_popup', esc_html__('CS Search Popup','wp_nuvo'), array('description' => esc_html__('Search Popup.', 'wp_nuvo'),)
        );
        add_action('wp_enqueue_scripts', array($this, 'widget_scripts'));
    }

    public function widget_scripts() {
        wp_enqueue_script('cs-search', get_template_directory_uri() . '/framework/widgets/search.js');
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        ?>
        <?php if($instance['style'] == '1'): ?>
        <div class="cs-search search-popup">
            <a href="#" data-toggle="modal" data-target="#search-popup"><i class="fa fa-search"></i></a>
            <div id="search-popup" class="modal fade" role="dialog">
                <?php echo get_search_form( true ); ?>
            </div>
        </div>
        <?php else : ?>
        <div class="cs-search search-slider">
            <a href="javascript:void(0)"><i class="fa fa-search"></i></a>
            <div id="search-slider" class="hide">
                <?php echo get_search_form( true ); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['style'] = strip_tags($new_instance['style']);
        return $instance;
    }

    function form($instance) {
        $defaults = array('style' => '1');
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        <p>
            <label for="<?php echo $this->get_field_id('style'); ?>"><?php esc_html_e('Style', 'wp_nuvo'); ?></label>
			<select id="<?php echo $this->get_field_id('style'); ?>" class="widefat" name="<?php echo $this->get_field_name('style'); ?>">
				<option value="1" <?php if($instance['style'] == '1'){ echo "selected='selected'"; } ?>><?php echo esc_html__('Popup','wp_nuvo'); ?></option>
				<option value="2" <?php if($instance['style'] == '2'){ echo "selected='selected'"; } ?>><?php echo esc_html__('Slide','wp_nuvo'); ?></option>
			</select>
        </p>
        <?php
    }
}
?>
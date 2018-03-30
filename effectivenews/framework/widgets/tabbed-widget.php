<?php

/*
 froked from : D4P Smashing Tabber (http://www.dev4press.com/plugins/)
*/

class mom_tabbed_widget extends WP_Widget {
    var $defaults = array(
        'sidebar' => '',
        'class' => ''
    );

    public function __construct($id_base = false, $name = '', $widget_options = array(), $control_options = array()) {
        parent::__construct('MomizatTabber', __('Momizat - Tabbed Widget', 'theme'), array('description' => __('Sidebar into tabbed widget.', 'theme')));
    }

    public function widget($args, $instance) {
        add_filter('dynamic_sidebar_params', array(&$this, 'widget_sidebar_params'));

        extract($args, EXTR_SKIP);

        echo $before_widget;
            if ($args['id'] != $instance['sidebar']) {
                ?>
                        <div class="main_tabs">
                            <ul class="tabs"></ul>
                            <div class="tabs-content-wrap">
                                <?php dynamic_sidebar($instance["sidebar"]); ?>
                            </div>
                        </div> <!--main tabs-->

            <?php
            } else {
                _e('Tabbed widget is not properly configured.', 'theme');
            }
        echo $after_widget;

        remove_filter('dynamic_sidebar_params', array(&$this, 'widget_sidebar_params'));
    }

    public function form($instance) {
        global $wp_registered_sidebars;

        $instance = wp_parse_args((array)$instance, $this->defaults);

        ?>

        <p><label>Sidebar:</label>
            <select style="background-color: white;" class="widefat d4p-tabber-sidebars" id="<?php echo $this->get_field_id('sidebar'); ?>" name="<?php echo $this->get_field_name('sidebar'); ?>">
                <?php

                foreach ($wp_registered_sidebars as $id => $sidebar) {
                    if ($id != 'wp_inactive_widgets') {
                        $selected = $instance['sidebar'] == $id ? ' selected="selected"' : '';
                        echo sprintf('<option value="%s"%s>%s</option>', $id, $selected, $sidebar['name']);
                    }
                }

                ?>
            </select><br/>
            <em>Make sure not to select Sidebar holding this widget. If you do that, Tabber will not be visible.</em>
        </p>
        <p><label>CSS Class:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" type="text" value="<?php echo $instance['class']; ?>" />
        </p>

        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['sidebar'] = strip_tags(stripslashes($new_instance['sidebar']));
        $instance['class'] = strip_tags(stripslashes($new_instance['class']));

        return $instance;
    }

    public function widget_sidebar_params($params) {
        $params[0]['before_widget'] = '<div class="tab-content">';
        $params[0]['after_widget'] = '</div>';
        $params[0]['before_title'] = '<a href="#" class="mom-tw-title">';
        $params[0]['after_title'] = '</a>';

        return $params;
    }
}

add_action('init', 'mom_tabbed_init');
add_action('widgets_init', 'mom_tabbed_widget_init');

function mom_tabbed_init() {
            global $wp_registered_sidebars;
            $n = count($wp_registered_sidebars);
    register_sidebar(array('name' => 'Tabbed Widget','id' => 'sidebar-' . ++$n, 'description' => 'Default Tabbed Widget sidebar, you can add you custom one with custom sidebars.', 'class' => 'mom_tabbed_widget_container'));

    if (!is_admin()) {
        //wp_enqueue_script('mom_tabbed_widget', get_template_directory_uri() . '/framework/widgets/js/tabbed-widget.js', array('jquery'), false, true); //main.js
    }
}

function mom_tabbed_widget_init() {
    register_widget('mom_tabbed_widget');
}

?>
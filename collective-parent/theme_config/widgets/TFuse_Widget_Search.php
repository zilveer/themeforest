<?php
// =============================== Search widget ======================================

class TFuse_Widget_Search extends WP_Widget {

	function TFuse_Widget_Search() {
        $widget_ops = array('classname' => 'widget_search', 'description' => __( "A search form for your site","tfuse") );
        $this->WP_Widget('search', __('TFuse Search','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
        extract($args);
        $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Search','tfuse' ) : $instance['title'], $instance, $this->id_base);
        $title = tfuse_qtranslate($title);
        $color = empty( $instance['color'] ) ? 'black' : $instance['color'];
        ?>
        <div class="widget_container widget_search">
            <form method="get" id="searchform" class="clearfix" action="<?php echo home_url( '/' ) ?>">
                <input type="text" value="<?php echo $title; ?>" onfocus="if (this.value == '<?php echo $title; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $title; ?>';}" name="s" id="s" class="input_text <?php echo $color; ?>" />
                <input type="submit" id="searchsubmit" class="btn_send" value=""/>
            </form>
        </div>
        <?php
    }

	function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
        $instance['title'] = $new_instance['title'];
        if ( in_array( $new_instance['color'], array( 'black', 'white' ) ) ) {
            $instance['color'] = $new_instance['color'];
        } else {
            $instance['color'] = 'black';
        }
        return $instance;
	}

	function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'color' => '') );
        $title = $instance['title'];
        $color = $instance['color'];
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
        <p>
            <label for="<?php echo $this->get_field_id('color'); ?>"><?php _e( 'Color:','tfuse' ); ?></label>
            <select name="<?php echo $this->get_field_name('color'); ?>" id="<?php echo $this->get_field_id('color'); ?>" class="widefat">
                <option value="black"<?php selected( $instance['color'], 'black' ); ?>><?php _e('Black','tfuse'); ?></option>
                <option value="white"<?php selected( $instance['color'], 'white' ); ?>><?php _e('White','tfuse'); ?></option>
            </select>
        </p>
<?php
	}
}

function TFuse_Unregister_WP_Widget_Search() {
	unregister_widget('WP_Widget_Search');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Search');

register_widget('TFuse_Widget_Search');
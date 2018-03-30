<?php
// =============================== Flickr widget ======================================
class TFuse_flickr extends WP_Widget {

	function TFuse_flickr() {
        $widget_ops = array('description' => '' );
        parent::WP_Widget(false, __('TFuse - Flickr', 'tfuse'),$widget_ops);
	}

    function widget($args, $instance) {
        extract( $args );
        $flickr_id = esc_attr($instance['flickr_id']);
        $instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        $number = esc_attr($instance['number']);
		$instance['title'] = tfuse_qtranslate($instance['title']); ?>
		
		<div class="widget-container flickr clearfix">
            <?php if ( !empty($instance['title']) )
            { ?>
                <div class="widget_title clearfix"><h3 class="clearfix"><?php echo $instance['title']; ?></h3></div>
            <?php } ?>
                    
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_id; ?>"></script>
			<div class="clear"></div>
        </div>
	   <?php
    }

    function update($new_instance, $old_instance) {
        $instance['title'] =  $new_instance['title'] ;
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'flickr_id' => '', 'number' => '') );
		$flickr = esc_attr($instance['flickr_id']);
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$number = esc_attr($instance['number']);
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		
        <p>
            <label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:','tfuse'); ?> (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):</label>
            <input type="text" name="<?php echo $this->get_field_name('flickr_id'); ?>" value="<?php echo $flickr; ?>" class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos','tfuse'); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" />
        </p>
		<?php
	}
}

register_widget('TFuse_flickr');
<?php

class SG_Widget_Flickr extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_flickr', 'description' => __('Flickr photos', SG_TDN));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('sg-flickr', __('SG - Flickr', SG_TDN), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Flickr Feed', SG_TDN) : __($instance['title']), $instance, $this->id_base);
		$text = empty( $instance['text'] ) ? '' : apply_filters( 'widget_text', __($instance['text']), $instance );
		$flickr_id = empty( $instance['flickr_id'] ) ? '' : $instance['flickr_id'];
		$tags = empty( $instance['tags'] ) ? '' : $instance['tags'];
		$pictures = empty( $instance['pictures'] ) ? 6 : (int) $instance['pictures'];

		$mt = microtime(1);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title; ?>
			<ul class="jflickr" rel="<?php echo $mt; ?>"></ul>
<script type='text/javascript'>
/* <![CDATA[ */
jQuery('.jflickr[rel="<?php echo $mt; ?>"]').jflickrfeed({
        limit: <?php echo $pictures; ?>,
        qstrings: {
            id: '<?php echo $flickr_id; ?>',
			tags: '<?php echo $tags; ?>'
        },
        itemTemplate: '<li>' + '<a href="{{image}}" title="{{title}}">' + '<img src="{{image_s}}" alt="{{title}}" />' + '<span></span>' + '</a>' + '</li>'
    }, function(data) {});
/* ]]> */
</script>
		<?php if (!empty($text)) { ?>
			<div class="textwidget"><?php echo !empty($instance['filter']) ? wpautop($text) : $text; ?></div>
		<?php
			}
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['tags'] = strip_tags($new_instance['tags']);

		if ( in_array( $new_instance['pictures'], array( '4', '8', '12', '16' ) ) ) {
			$instance['pictures'] = $new_instance['pictures'];
		} else {
			$instance['pictures'] = '8';
		}

		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
		$instance['filter'] = isset($new_instance['filter']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'flickr_id' => '', 'tags' => '', 'pictures' => '8', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$flickr_id = strip_tags($instance['flickr_id']);
		$tags = strip_tags($instance['tags']);
		$text = esc_textarea($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', SG_TDN); ?></label><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:', SG_TDN); ?></label><input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo esc_attr($flickr_id); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Flickr Tags:', SG_TDN); ?></label><input class="widefat" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" type="text" value="<?php echo esc_attr($tags); ?>" /></p>

		<p>
			<label for="<?php echo $this->get_field_id('pictures'); ?>"><?php _e('Pictures Count:', SG_TDN); ?></label>
			<select name="<?php echo $this->get_field_name('pictures'); ?>" id="<?php echo $this->get_field_id('pictures'); ?>" class="widefat">
				<option value="4"<?php selected( $instance['pictures'], '4' ); ?>>4</option>
				<option value="8"<?php selected( $instance['pictures'], '8' ); ?>>8</option>
				<option value="12"<?php selected( $instance['pictures'], '12' ); ?>>12</option>
				<option value="16"<?php selected( $instance['pictures'], '16' ); ?>>16</option>
			</select>
		</p>

		<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', SG_TDN); ?></label>
		<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs', SG_TDN); ?></label></p>
<?php
	}
}
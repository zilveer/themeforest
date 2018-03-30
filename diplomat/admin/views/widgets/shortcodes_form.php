<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo esc_attr($widget->get_field_id('title')); ?>"><?php esc_html_e('Title', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('title')); ?>" name="<?php echo esc_attr($widget->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>
<input type="hidden" id="<?php echo $widget->get_field_id('content'); ?>" name="<?php echo $widget->get_field_name( 'content' ); ?>" value="<?php echo esc_attr($instance['content']); ?>">
<p>
   <a href="javascript:TMM_EDITOR_WIDGET.showEditor('<?php echo $widget->get_field_id( 'content' ); ?>');" class="button"><?php _e( 'Edit content', 'diplomat' ) ?></a>
</p>
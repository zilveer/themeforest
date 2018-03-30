<?php
class TFuse_Widget_Selected_Pages extends WP_Widget {

	function TFuse_Widget_Selected_Pages() {
		$widget_ops = array('description' => __( 'Show Selected Pages', 'tfuse') );
		parent::WP_Widget(false, __('TFuse Selected Pages', 'tfuse'),$widget_ops);      
	}

	function widget($args, $instance) {
        global $post;
		extract( $args );
		$title = esc_attr($instance['title']);
        $title = tfuse_qtranslate($title);
		$pages = isset($instance['pages']) ? $instance['pages'] : '';

		$before_widget = '<div class="widget-container widget_pages">';
		$after_widget = '</div>';
		$before_title = '<div class="widget_title clearfix"><h3 class="clearfix">';
		$after_title = '</h3></div>';

        echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;

        if ( is_array($pages) ) { ?>
            <ul>
                <?php $k=0;
                foreach ($pages as $key=>$val) {
                    $k++;
                    if ($k==1)             $first = ' first '; else $first = '';
                    if ($k==count($pages)) $last  = ' last ';  else $last  = '';
                    if ($key == get_query_var('page_id')) {$active = ' current-menu-item ';} else $active='';

                    $page = get_post($key);
                    echo '<li class="'.$first.$last.$active.'"><a href="' . get_page_link($key) . '"><span>' . $page->post_title . '</span></a></li>';
                    $page = get_post($key);
                } ?>
            </ul>
        <?php }

        echo $after_widget;
    }

    function update($new_instance,$old_instance) {
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array(  'title' => '', 'pages' => '',) );
		$title = esc_attr($instance['title']);
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('pages'); ?>"><?php _e('Select Pages List','tfuse'); ?></label>
            <?php
				$tfuse_pages = array();
				$tfuse_pages_obj = get_pages();
				if (is_array($tfuse_pages_obj)) {
					foreach ($tfuse_pages_obj as $tfuse_page) { ?>
                    	<br /><br />
                        <?php
                        if ( esc_attr(@$instance['pages'][$tfuse_page->ID]) ) $checked = ' checked="checked" '; else $checked = '';
						?>

						<input <?php echo $checked; ?> type="checkbox" name="<?php echo $this->get_field_name('pages'); ?>[<?php echo $tfuse_page->ID;?>]" value="1" id="<?php echo $this->get_field_id('pages'); ?>" />&nbsp;&nbsp;<?php echo $tfuse_page->post_title; ?>
                        <?php
 					}
				}
			?>
        </p>
		<?php
    }
}

register_widget('TFuse_Widget_Selected_Pages');
<?php
class TFuse_Widget_Recent_Comments extends WP_Widget {

	function TFuse_Widget_Recent_Comments() {
		$widget_ops = array('classname' => 'widget_recent_comments', 'description' => __( 'The most recent comments','tfuse' ) );
		$this->WP_Widget('recent-comments', __('TFuse Recent Comments','tfuse'), $widget_ops);
		$this->alt_option_name = 'widget_recent_comments';

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array(&$this, 'recent_comments_style') );

		add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
	}

	function recent_comments_style() { ?>
	    <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
    <?php }

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_comments', 'widget');
	}

	function widget( $args, $instance ) {
		global $comments, $comment;
		$cache = wp_cache_get('widget_recent_comments', 'widget');
		if ( ! is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		extract($args, EXTR_SKIP);
		$output = '';
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments','tfuse') : $instance['title']);
		$before_widget = '<div class="widget-container widget_recent_comments widget_recent_posts">';
		$after_widget = '</div>';
		$before_title = '<div class="widget_title clearfix"><h3 class="clearfix">';
		$after_title = '</h3></div>';

		if ( ! $number = (int) $instance['number'] )
			$number = 5;
		else if ( $number < 1 )
			$number = 1;

		$comments = get_comments( array( 'number' => $number, 'status' => 'approve' ) );
		$output .= $before_widget;
		$title = tfuse_qtranslate($title);
		if ( $title )
			$output .= $before_title . $title . $after_title;

        $output .= '<ul id="recentcomments">';
		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
                $id_post = $comment->comment_post_ID;
                if(tfuse_page_options('thumbnail_image','', $id_post)!='') $post_image_src = tfuse_page_options('thumbnail_image','', $id_post);
                else $post_image_src = tfuse_page_options('single_image','', $id_post);
                $img ='';
                if (!empty($post_image_src)) {
                    $get_image = new TF_GET_IMAGE();
                    $img = $get_image->properties(array( 'class' => 'thumbnail', 'alt' => get_the_title($id_post)))->width(54)->height(54)->src($post_image_src)->resize(true)->get_img();
                }
                $commnent_link = esc_url( get_comment_link($comment->comment_ID) );
				$output .= '<li class="recentcomments">'.
                    '<a href="' .$commnent_link. '">'.$img.'</a>'.
                    '<span class="recent_comment">'.
                        '<a href="' .$commnent_link. '">'.get_comment_author_link().': '. '</a>'
                    .$comment->comment_content.'</span>' .
                    '<span class="clear"></span></li>';
			}
		}
		$output .= '</ul>';
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set('widget_recent_comments', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_comments']) )
			delete_option('widget_recent_comments');

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(  'title' => '','position' => '') );
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
        ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show:','tfuse'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}

function TFuse_Unregister_WP_Widget_Recent_Comments() {
	unregister_widget('WP_Widget_Recent_Comments');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Recent_Comments');

register_widget('TFuse_Widget_Recent_Comments');
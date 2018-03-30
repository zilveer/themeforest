<?php 

add_action('widgets_init','mom_widget_recent_comments');

function mom_widget_recent_comments() {
	register_widget('mom_widget_recent_comments');
	
	}

class mom_widget_recent_comments extends WP_Widget {
	function mom_widget_recent_comments() {
			
		$widget_ops = array('classname' => 'momizat-recent_comments','description' => __('Widget display Recent comments','theme'));
		parent::__construct('momizatRecentComments',__('Effective - Recent Comments','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$count = $instance['count'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
  <div class="mom-recent-comments">
                            <ul>
<?php
		global $wpdb;

		$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,70) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $count";
		$comments = $wpdb->get_results($sql);
		foreach ($comments as $comment) :
		//print_r($comment);
		?>				
                                <li>
                                    <div class="author_avatar border-box">
                                        <a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> <?php _e('on ', 'framework'); ?><?php echo $comment->post_title; ?>"><?php echo get_avatar( $comment, '60' ); ?></a>
                                    </div>
                                    <div class="author_comment">
                                    <h4><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> <?php _e('on ', 'framework'); ?><?php echo $comment->post_title; ?>"><?php echo strip_tags($comment->comment_author); ?></a> <time><?php _e('on', 'theme'); ?> <?php echo date_i18n('d M', strtotime($comment->comment_date_gmt)); ?> </time><span class="rc-post"><?php _e('in', 'theme'); ?>: <a href="<?php echo get_permalink($comment->ID); ?>"><?php echo $comment->post_title; ?></a></span></h4>
                                    <p><?php 
			$excerpt = $comment->com_excerpt;
			echo wp_html_excerpt($excerpt,80);
                        ?> ... </p>
                                    </div>
                                </li>
                          <?php endforeach; ?>

                            </ul>
        </div>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = $new_instance['count'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
				  'title' => __('Recent Comments','theme'),
				  'count' => 5
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
	<script>
		jQuery(document).ready(function($) {
			$('#<?php echo $this->get_field_id( 'display' ); ?>').change( function () {
				if ($(this).val() === 'cats') {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeIn();
				} else {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeOut();
				}
				
			});
				if ($('#<?php echo $this->get_field_id( 'display' ); ?>').val() === 'cats') {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeIn();
				} else {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeOut();
				}
		});
	</script>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number Of Comments:','theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" class="widefat" />
		</p>

   <?php 
}
	} //end class
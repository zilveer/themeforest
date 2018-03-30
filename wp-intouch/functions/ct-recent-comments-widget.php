<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Recent Comments Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show recent comments.
 	Version: 1.0
 	Author: ZERGE
 	Author URI: http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','ct_comments_widget');

function ct_comments_widget() {
	register_widget("CT_comments_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_comments_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_comments_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname'	=> 'ct-comments-widget',
							 'description'	=> __( 'Recent Comments' , 'color-theme-framework' )
							);

		/* Widget control settings. */
		$control_ops = array( 'width'		=> 255,
							  'height'		=> 350,
							  'id_base'		=> 'ct-comments-widget'
							);
		
		/* Create the widget. */
		parent::__construct( 'ct-comments-widget', __( 'CT: Recent Comments Widget' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);

		$title = apply_filters ('widget_title', $instance ['title']);
		$num_comments = $instance['num_comments'];
		$comment_len = $instance['comment_len'];		
		$show_avatar = isset($instance['show_avatar']) ? '1' : '0';
		$background_title = $instance['background_title'];

		/* Before widget (defined by themes). */
		echo "\n<!-- START RECENT COMMENTS WIDGET -->\n";
		echo $before_widget;

		if ( $title ) :
			echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
		endif;
		?>
		
		<?php
		global $post;

		$recent_comments = get_comments( array(	'number'	=> $num_comments,
												'status'	=> 'approve'
											));
		?>

		<ul>
			<?php foreach( $recent_comments as $comment ) { ?>
				<li class="ct-border-bottom clearfix">
					<?php if( $show_avatar ) :
						echo get_avatar( $comment, $size='65', $default='', get_comment_author($comment) );
					endif; ?>

					<div class="author-name">
						<h4>
							<?php echo ct_get_comment_author($comment); ?>
						</h4>
					</div>

					<div class="comment-text">
						<?php printf( '<a href="%1$s">', esc_url( get_comment_link( $comment->comment_ID ) ) ); ?>
							<?php 
							if (is_rtl()) :
								echo strip_tags(mb_substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len ) ) . ' ... <span class="ct-rm-arrow">&larr;</span>';
							else :
								echo strip_tags(mb_substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len ) ) . ' ... <span class="ct-rm-arrow">&rarr;</span>';
							endif;
							?>
						</a>
					</div><!-- .comment-text -->

					<div class="comment-time ct-google-font">
						<?php echo ct_get_time_ago( $comment ); ?>
					</div><!-- .comment-time -->
				</li>
			<?php } ?>
		</ul>

	<?php
		// Restor original Query & Post Data
		wp_reset_postdata();

		/* After widget (defined by themes). */
		echo $after_widget;
		echo "\n<!-- END RECENT COMMENTS WIDGET -->\n";
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_comments'] = $new_instance['num_comments'];
		$instance['comment_len'] = $new_instance['comment_len'];		
		$instance['show_avatar'] = $new_instance['show_avatar'];
		$instance['background_title'] = strip_tags($new_instance['background_title']);

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){ ?>
		<?php
		$defaults = array(	'title'				=> __( 'Recent Comments' , 'color-theme-framework' ),
							'num_comments'		=> 3,
							'comment_len'		=> 30,
							'show_avatar'		=> 'on',
							'background_title'	=> '#2b373f'
						);

		$instance = wp_parse_args((array) $instance, $defaults); 
		$background_title = $instance['background_title'];
		?>


		<script type="text/javascript">
		//<![CDATA[
			jQuery(document).ready(function($) {  
				$('.ct-color-picker').wpColorPicker();
			});
		//]]>   
		</script>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_comments'); ?>"><?php _e( 'Number of comments:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('num_comments'); ?>" name="<?php echo $this->get_field_name('num_comments'); ?>" value="<?php echo $instance['num_comments']; ?>" />
			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('comment_len'); ?>"><?php _e( 'Length of comments:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('comment_len'); ?>" name="<?php echo $this->get_field_name('comment_len'); ?>" value="<?php echo $instance['comment_len']; ?>" />
			
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_avatar'], 'on'); ?> id="<?php echo $this->get_field_id('show_avatar'); ?>" name="<?php echo $this->get_field_name('show_avatar'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_avatar'); ?>"><?php _e( 'Show user avatar' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Title Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" data-default-color="#2b373f" />
		</p>
		<?php

	}
}
?>
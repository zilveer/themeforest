<?php
// thb Subscribe Widget
class thb_subscribe_widget extends WP_Widget {
	
	function __construct() {
		
		$widget_ops = array(
			'classname'   => 'widget_subscribe_widget',
			'description' => __('A widget that gathers email addresses.','north')
		);
	
		parent::__construct(
			'thb_subscribe_widget',
			__( 'Fuel Themes - Subscribe Widget' , 'north' ),
			$widget_ops
		);
				
		$this->defaults = array( 'title' => '', 'desc' => '' );
		
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$desc = $instance['desc'];

		echo $before_widget;


		?>
        	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$("#newsletter-form").submit(function() {	
					$('.result').load('<?php echo THB_THEME_ROOT; ?>/inc/subscribe_save.php', {email: $('#widget_subscribe').val()},
					function() {
						$(this).fadeIn(200).delay(3000).fadeOut(200);
					});
					return false;
				});
			});
			</script>
			
                
                <?php 
					echo $before_title . $title . $after_title;
				?>
                
                <p><?php echo $desc; ?></p>

                <form id="newsletter-form" action="#" method="post" class="row" data-target="<?php echo THB_THEME_ROOT; ?>/inc/subscribe_save.php'; ?>">   
                	<div class="small-9 columns"><input placeholder="<?php _e("YOUR E-MAIL",'north'); ?>" type="text" name="widget_subscribe" id="widget_subscribe"></div>
									<div class="small-3 columns"><button type="submit" name="submit" class="btn white"><?php _e("GO",'north'); ?></button></div>
                </form>
                <div class="result"></div>
		
		<?php

		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['desc'] = stripslashes( $new_instance['desc']);

		return $instance;
	}
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>">Short Description: </label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
		</p>
		
		<p>
			<?php _e('You can find the collected emails <a href="'.THB_THEME_ROOT.'/inc/subscribers.csv" target="_blank">here</a>', 'north'); ?>
		</p>
	<?php
	}
}
add_action( 'widgets_init', 'thb_subscribe_widgets' );

function thb_subscribe_widgets() {
	register_widget( 'thb_subscribe_widget' );
}

?>
<?php

/*
	Subscription Form
*/

class Artbees_Widget_Subscription_Form extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_subscription_form', 'description' => 'Subscription form.' );
		WP_Widget::__construct( 'subscription_form', THEME_SLUG.' - '.'Subscription Form', $widget_ops );
	}



	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$action= $instance['action'];
		$skin= $instance['skin'];

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

			$id = mt_rand( 99, 999 );
			$tabindex_1 = $id;
			$tabindex_2 = $id + 1;
			$placeholder_str = __( 'Enter your Email address', 'mk_framework' );
			$submit_str = __( 'SIGN UP', 'mk_framework' );

		?>

	<div class="mk-subscription-form-wrapper <?php echo $skin; ?>-skin">
    <form class="mk-subscription-form" method="post" target="_blank" action="<?php echo $action ?>">
        <div class="mk-form-row">
        	<input placeholder="<?php echo $placeholder_str ;?>" type="email" name="EMAIL" id="mce-EMAIL" required="required" class="text-input" value="" tabindex="<?php echo $tabindex_1 ;?>" />
        	<button tabindex="<?php echo $tabindex_2 ;?>" name="subscribe" id="mc-embedded-subscribe" class="mk-progress-button mk-subscription-button"><?php echo $submit_str ;?></button>
        </div>
    </form>
    <div class="clearboth"></div>

</div>
<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['action'] = $new_instance['action'];
		$instance['skin'] = $new_instance['skin'];
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$action = isset( $instance['action'] ) ? $instance['action'] : '';
		$skin = isset( $instance['skin'] ) ? $instance['skin'] : 'dark';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'action' ); ?>">Mailchimp Action URL:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'action' ); ?>" name="<?php echo $this->get_field_name( 'action' ); ?>" type="text" value="<?php echo $action; ?>" /></p>
		<em><a href="http://support.artbees.net/solution/articles/1000093892-how-to-get-your-mailchimp-form-url">Click here</a> on how to get mailchimp URL</em>

		<p><label for="<?php echo $this->get_field_id( 'skin' ); ?>">Skin</label>
		<select id="<?php echo $this->get_field_id( 'skin' ); ?>" name="<?php echo $this->get_field_name( 'skin' ); ?>">
			<option<?php if ( $skin == 'dark' ) echo ' selected="selected"'?> value="dark">Dark</option>
			<option<?php if ( $skin == 'light' ) echo ' selected="selected"'?> value="light">Light</option>
		</select>
		</p>

<?php

	}

}
/***************************************************/
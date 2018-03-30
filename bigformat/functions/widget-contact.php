<?php



/*******************************************************
*
*	Custom Contact Widget
*	By: Andre Gagnon
*	http://www.designcirc.us
*
*******************************************************/



// Initialize widget
add_action( 'widgets_init', 'ag_contact_widgets' );



// Register widget
function ag_contact_widgets() {
	register_widget( 'ag_contact_widget' );
}

// Widget class
class ag_contact_widget extends WP_Widget {



/*----------------------------------------------------------*/
/*	Set up the Widget
/*----------------------------------------------------------*/

	function __construct() {

		/* General widget settings */
		$widget_ops = array( 'classname' => 'ag_contact_widget', 'description' => __('A widget that displays a contact form.', 'framework') );

		/* Widget control settings */
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'ag_contact_widget' );

		/* Create widget */
		parent::__construct( 'ag_contact_widget', __('Custom Quick Contact Widget', 'framework'), $widget_ops, $control_ops );
	}

/*----------------------------------------------------------*/
/*	Display The Widget 
/*----------------------------------------------------------*/	

	function widget( $args, $instance ) {
		extract( $args );		

		$title = apply_filters('widget_title', $instance['title'] );

		/* Variables from settings. */

		$url = $instance['url']; 
		$buttontext = $instance['buttontext'];

		/* Before widget (defined in functions.php). */

		echo $before_widget;

		/* Display The Widget */

		?>
<?php 

/* Display the widget title & subtitle if one was input (before and after defined by themes). */

if ( $title ) echo ' 
            <h3>'.$title.'</h3>'
?>
<?php 

echo " <form action='".$url."' method='post' class='subForm' id='quickform' >
                <input type='text' name='c_name' id='c_name' value='".__('Name', 'framework')."' class='required' onfocus='if(this.value==&quot;".__('Name', 'framework')."&quot;)this.value=&quot;&quot;;' onblur='if(this.value==&quot;&quot;)this.value=&quot;".__('Name', 'framework')."&quot;;'/>
                <input type='text' name='c_email' id='c_email' value='".__('Email Address', 'framework')."' class='required email' onfocus='if(this.value==&quot;".__('Email Address', 'framework')."&quot;)this.value=&quot;&quot;;' onblur='if(this.value==&quot;&quot;)this.value=&quot;".__('Email Address', 'framework')."&quot;;'/>
                <textarea name='c_message' id='c_message' rows='8' cols='5' class='required' onfocus='if(this.value==&quot;".__('Your Message', 'framework')."&quot;)this.value=&quot;&quot;;' onblur='if(this.value==&quot;&quot;)this.value=&quot;".__('Your Message', 'framework')."&quot;;'>".__('Your Message', 'framework')."</textarea>
                                            <input type='submit' name='c_submit' id='c_submit' class='button small light' value='";
											if ( $buttontext ) { echo $buttontext; } else { echo 'Send'; }
											echo "'/>                                      
                                        <input type='hidden' name='c_submitted' id='c_submitted' value='true' />
        </form>"

?>
<?php

		/* After widget (defined by themes). */

		echo $after_widget;

	}



/*----------------------------------------------------------*/

/*	Update the Widget

/*----------------------------------------------------------*/

	

	function update( $new_instance, $old_instance ) {

		

		$instance = $old_instance;

		

		/* Remove HTML: */

		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['url'] = strip_tags( $new_instance['url'] );

		$instance['buttontext'] = strip_tags( $new_instance['buttontext'] );

	

		return $instance;

	}

	



/*----------------------------------------------------------*/

/*	Widget Settings

/*----------------------------------------------------------*/

	 

	function form( $instance ) {



		/* Default widget settings */

		$defaults = array(

		'title' => '',
		'url' => '',
		'buttontext' => '',

		

		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<!-- Widget Title: Text Input -->

<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e('Contact Title (Optional):', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'url' ); ?>">
        <?php _e('Contact Page URL:', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'buttontext' ); ?>">
        <?php _e('Button Text:', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'buttontext' ); ?>" name="<?php echo $this->get_field_name( 'buttontext' ); ?>" value="<?php echo $instance['buttontext']; ?>" />
</p>
<?php

	}
}

?>
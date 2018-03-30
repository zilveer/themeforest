<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
class yit_quick_contact extends WP_Widget {
    public function __construct() {
		$widget_ops = array( 
            'classname' => 'yit_quick_contact', 
            'description' => __('Quick contact form', 'yit' )
        );

		$control_ops = array( 'id_base' => 'yit_quick_contact' );

		WP_Widget::__construct( 'yit_quick_contact', 'Quick Contact Form', $widget_ops, $control_ops );
	}
    
    public function widget( $args, $instance ) {
        extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$text = wpautop( $instance['text'] );

        echo $before_widget;

        echo '<div>';
        
        if ( $title ) echo $before_title . $title . $after_title;
        if ( $text ) echo $text;
        
        echo do_shortcode( '[contact_form name="' . $instance['id_form'] . '"]' );

        echo '</div>';
        
        echo $after_widget;
    }
    
    public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = strip_tags( $new_instance['text'] );

		$instance['id_form'] = $new_instance['id_form'];

		return $instance;
	}

    public function form( $instance ) {
		$defaults = array( 
            'title' => __( 'Quick Contact', 'yit' ), 
            'text' => __( 'Need a quick reply to your questions? Fill the form, we will reply in max 24h.', 'yit' ), 
            'id_form' => ''
        );
        
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>  
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'yit' ) ?>:
			     <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		    </label>
        </p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text', 'yit' ) ?>:
			     <textarea id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" class="widefat"><?php echo $instance['text']; ?></textarea>
		    </label>
        </p>
		
		<p>
			<?php _e( 'Select here the form that you have created and configurated on Theme Options panel.', 'yit' ) ?>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'label_name' ); ?>">Label Name:
			     <select id="<?php echo $this->get_field_id( 'id_form' ); ?>" name="<?php echo $this->get_field_name( 'id_form' ); ?>">
			     	<?php 
						$forms = $this->get_contact_form();
						
						foreach( $forms as $id_form => $form )
							echo "<option value=\"$id_form\"" . ( ( $instance['id_form'] == $id_form ) ? ' selected="selected"' : '' ) . ">$form</option>\n"; 
					?>
			     </select>
		    </label>
        </p>
    <?php
    }
    
    /**
	 * Get contact form to show in select menu
	 * 
	 */
	public function get_contact_form(){			
		$contact = yit_get_model('cpt_unlimited')->get_posts_types('contactform');
		$c = array();
		foreach( $contact as $cont ): 
			 $c[$cont->post_name] = ($cont->post_title) ? $cont->post_title : 'Form ID: '. $cont->ID;
		endforeach;
		return $c;
	}
}
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

if( !class_exists( 'cta' ) ) :
class cta extends WP_Widget
{
    function __construct() {
        $widget_ops = array( 
            'classname' => 'cta', 
            'description' => __( 'A simple Call to action with image.', 'yit' )
        );

        $control_ops = array( 'id_base' => 'cta', 'width' => 430 );

        WP_Widget::__construct( 'cta', __( 'Call to action', 'yit' ), $widget_ops, $control_ops );

        if ( is_admin() ){
            wp_enqueue_style( 'thickbox' );
            wp_enqueue_script( 'thickbox' );
            wp_enqueue_script( 'media-upload' );
        }
        add_action( 'admin_print_footer_scripts', array( &$this, 'add_script_cta' ), 999 );
    }
    
    function add_script_cta() {   
	    global $pagenow;
	    
	    if ( $pagenow != 'widgets.php' )
	       { return; }
        ?>   
        
        <?php
    }
    
    function form( $instance ) {
        global $icons_name;
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => '',
            'text' => '',
            'autop' => false,
            'image' => '',
            'image_link' => '',
            'align' => '',
            'incipit' => '',
            'email' => 'Your Email',
            'button' => 'ADD ME'
            
            
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label>
                <strong><?php _e( 'Title', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </label>
        </p>                  
        
        <p>
            <label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" cols="20" rows="16"><?php echo $instance['text']; ?></textarea>
            </label>
        </p>
        <p>
            <label>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'autop' ); ?>" name="<?php echo $this->get_field_name( 'autop' ); ?>" value="1"<?php if( $instance['autop'] ) echo ' checked="checked"' ?> />
                <?php _e( 'Automatically add paragraphs', 'yit' ) ?>
            </label>
        </p> 
        
        <p>
            <label><?php _e( 'Image', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" class="upload-image button-secondary">Upload</a>
            </label>
        </p>
        
        <p>
            <label><?php _e( 'Image Link', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'image_link' ); ?>" name="<?php echo $this->get_field_name( 'image_link' ); ?>" value="<?php echo $instance['image_link']; ?>" />
            </label>
        </p>

        <p>
            <label><?php _e( 'Image Alignment', 'yit' ) ?>:
                <select id="<?php echo $this->get_field_id( 'align' ); ?>" name="<?php echo $this->get_field_name( 'align' ); ?>">
                    <option value="left"<?php if($instance['align']=='left'): ?>selected="selected"<?php endif ?>>Left</option>
                    <option value="center"<?php if($instance['align']=='center'): ?>selected="selected"<?php endif ?>>Center</option>
                    <option value="right"<?php if($instance['align']=='right'): ?>selected="selected"<?php endif ?>>Right</option>
                </select>
            </label>
        </p>


        <p>
            <label>
                <strong><?php _e( 'Incipit', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'incipit' ); ?>" name="<?php echo $this->get_field_name( 'incipit' ); ?>" value="<?php echo $instance['incipit']; ?>" />
            </label>
        </p>
        
        <p>
            <label>
                <strong><?php _e( 'E-mail text', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" />
            </label>
        </p>
        
        <p>
            <label>
                <strong><?php _e( 'Button text', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'button' ); ?>" name="<?php echo $this->get_field_name( 'button' ); ?>" value="<?php echo $instance['button']; ?>" />
            </label>
        </p>
        <?php
    }
    
    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
        
        echo $before_widget;
		echo '<div class="border-1 border">';
		echo '<div class="border-2 border">';                   

        if ( $title ) echo $before_title . yit_decode_title( $title ) . $after_title;
        
        if( $instance['autop'] )
            $instance['text'] = wpautop( $instance['text'] );
        
		if( $instance['text'] ) echo $instance['text'];
		
        $text = '<div class="text-image" style="text-align:'. $instance['align'] .'">';
        if (isset($instance['image']) && $instance['image'] != '') :
            if( isset($instance['image_link']) && $instance['image_link'] != '' )
                { $text.= '<a href="' . $instance['image_link'] . '">'; }
                
        	$text .= '<img src="' . $instance['image'] . '" alt="' . $instance['title'] . '" />';
            
            if( isset($instance['image_link']) && $instance['image_link'] != '' )
                { $text.= '</a>'; }
		endif;
		$text .= '</div>';
		
		  
        
        if ( $instance['incipit'] ) $text .= '<h6>' . yit_decode_title( $instance['incipit'] ) . '</h6>';
		
		$hidden = yit_get_option( 'newsletter-hidden');
		$hidden_field = '';
		if ( isset ( $hidden ) && $hidden != '' ) :
			$options = explode('&', $hidden);
			foreach ($options as $o) :
				$temp = explode('=', $o);				
				$hidden_field .= '<input type="hidden" name="' . $temp[0] . '" value="' . $temp[1] . '" />';
			endforeach;
		endif;
        
		$text .= '                                 
    		<form action="' . yit_get_option( 'newsletter-action' ) . '" method="' . yit_get_option( 'newsletter-request' ) . '">
    			<div class="newsletter-call3 group">
	    			<!--<div class="newsletter-icon"><label for="email"></label></div>-->
	    			<div class="newsletter-input">
	    				<input type="text" class="email-field text-field autoclear" placeholder="'.$instance['email'].'" id="email" name="' . yit_get_option( 'newsletter-email-name' ) . '">
	    			</div>
	    		</div>
	    		<div class="newsletter-submit">' .
                $hidden_field . //Hidden Fields
                wp_nonce_field( 'mc_submit_signup_form', '_mc_submit_signup_form_nonce', false, false ) . //MailChimp Nonce 
                wp_nonce_field( 'mymail_form_nonce', '_wpnonce', false, false ) . //MyMail nonce
                '<input type="submit" class="submit-field" value="'.$instance['button'].'">
    			</div>
    		</form>
    	<div class="clear"></div>';
		
		echo apply_filters( 'widget_text', $text );
        echo "</div></div>" . $after_widget;
    }                     

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['image'] = $new_instance['image'];
        
        $instance['image_link'] = esc_url( $new_instance['image_link'] );
        
        $instance['align'] = $new_instance['align'];

        $instance['text'] = $new_instance['text'];

        $instance['autop'] = $new_instance['autop'];
		
		$instance['incipit'] = $new_instance['incipit'];
		
		$instance['email'] = $new_instance['email'];

		$instance['button'] = $new_instance['button'];
		
        return $instance;
    }
    
}     
endif;
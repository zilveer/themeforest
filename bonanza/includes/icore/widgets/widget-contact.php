<?php class ContactWidget extends WP_Widget
{
    function ContactWidget(){
		$widget_ops = array('description' => 'Display your social icons and contact information');
		$control_ops = array('width' => 300, 'height' => 300);
		parent::WP_Widget(false,$name='UFO Contact',$widget_ops,$control_ops);
    }

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$contactTitle = empty($instance['contactTitle']) ? '' : $instance['contactTitle'];
		
		$contactFB = empty($instance['contactFB']) ? '' : $instance['contactFB'];
		$contactTwitter = empty($instance['contactTwitter']) ? '' : $instance['contactTwitter'];
		$contactGoogle = empty($instance['contactGoogle']) ? '' : $instance['contactGoogle'];
		$contactYT = empty($instance['contactYT']) ? '' : $instance['contactYT'];
		$contactVimeo = empty($instance['contactVimeo']) ? '' : $instance['contactVimeo'];
		$contactRSS = empty($instance['contactRSS']) ? '' : $instance['contactRSS'];
		
		$contactPhone = empty($instance['contactPhone']) ? '' : $instance['contactPhone'];
		$contactAdd = empty($instance['contactAdd']) ? '' : $instance['contactAdd'];

		
	echo $before_widget;
		
?>	
<div class="contact">
	<?php echo $before_title; ?>          
	<?php echo $contactTitle; ?>
	<?php echo $after_title; ?>
	<?php global $theme_options; ?>
	<!-- Print Social Icons -->
    <ul class="social">
	
		<?php if ( ! empty( $contactFB ) ) { ?>
			<li class="social icon-facebook"><a href="<?php echo $contactFB; ?>" target="_blank">facebook</a></li>
		<?php } ?>
		
		<?php if ( ! empty( $contactTwitter ) ) { ?>
			<li class="social icon-twitter"><a href="<?php echo $contactTwitter; ?>" target="_blank">twitter</a></li>
		<?php } ?>
		
		<?php if ( ! empty( $contactGoogle ) ) { ?>
			<li class="social icon-google-plus"><a href="<?php echo $contactGoogle; ?>" target="_blank">GooglePlus</a></li>
		<?php } ?>
		
		<?php if ( ! empty( $contactYT ) ) { ?>
			<li class="social icon-youtube"><a href="<?php echo $contactYT; ?>" target="_blank">youTube</a></li>
		<?php } ?>
		
		<?php if ( ! empty( $contactVimeo ) ) { ?>
			<li class="social icon-vimeo"><a href="<?php echo $contactVimeo; ?>" target="_blank">Vimeo</a></li>
		<?php } ?>
		
		<?php if ( ! empty( $contactRSS ) ) { ?>
			<li class="social icon-feed"><a href="<?php echo $contactRSS; ?>" target="_blank">RSS</a></li>
		<?php } ?>
		
		<?php if ( ! empty( $contactPhone ) ) { ?>
			<li class="social phone icon-phone"><?php _e('Phone: ', 'bonanza'); ?><?php echo $contactPhone; ?></li>
		<?php } ?>
		
		<?php if ( ! empty( $contactAdd ) ) { ?>
			<li class="social address icon-phone"><?php _e('Address: ', 'bonanza'); ?><?php echo $contactAdd; ?></li>
		<?php } ?>
		
	
	</ul> <!--  #social  -->
      
</div> <!-- .contact  -->

<?php
		echo $after_widget;
	}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['contactTitle'] = stripslashes($new_instance['contactTitle']);
		
		$instance['contactFB'] = stripslashes($new_instance['contactFB']);
		$instance['contactTwitter'] = stripslashes($new_instance['contactTwitter']);
		$instance['contactGoogle'] = stripslashes($new_instance['contactGoogle']);
		$instance['contactYT'] = stripslashes($new_instance['contactYT']);
		$instance['contactVimeo'] = stripslashes($new_instance['contactVimeo']);
		$instance['contactRSS'] = stripslashes($new_instance['contactRSS']);
		
		$instance['contactPhone'] = stripslashes($new_instance['contactPhone']);
		$instance['contactAdd'] = stripslashes($new_instance['contactAdd']);

		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('contactTitle'=>'Contact us', 'contactFB' => '', 'contactTwitter' => '', 'contactGoogle' => '', 'contactYT' => '', 'contactVimeo' => '', 'contactRSS' => '', 'contactPhone' => '' ) );

		$contactTitle = htmlspecialchars($instance['contactTitle']);
		
		$contactFB = htmlspecialchars($instance['contactFB']);
		$contactTwitter = htmlspecialchars($instance['contactTwitter']);
		$contactGoogle = htmlspecialchars($instance['contactGoogle']);
		$contactYT = htmlspecialchars($instance['contactYT']);
		$contactVimeo = htmlspecialchars($instance['contactVimeo']);
		$contactRSS = htmlspecialchars($instance['contactRSS']);
		
		$contactPhone = htmlspecialchars($instance['contactPhone']);
		$contactAdd = htmlspecialchars($instance['contactAdd']);

		# Title
		echo '<p><label for="' . $this->get_field_id('contactTitle') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('contactTitle') . '" name="' . $this->get_field_name('contactTitle') . '" type="text" value="' . $contactTitle . '" /></p>';
		
		# Facebook Link
		echo '<p><label for="' . $this->get_field_id('contactFB') . '">' . 'Facebook URL:' . '</label><textarea cols="10" rows="2" class="widefat" id="' . $this->get_field_id('contactFB') . '" name="' . $this->get_field_name('contactFB') . '" >'. $contactFB .'</textarea></p>';
		
		# Twitter Link
		echo '<p><label for="' . $this->get_field_id('contactTwitter') . '">' . 'Twitter URL:' . '</label><textarea cols="10" rows="2" class="widefat" id="' . $this->get_field_id('contactTwitter') . '" name="' . $this->get_field_name('contactTwitter') . '" >'. $contactTwitter .'</textarea></p>';
		
		# Google+ Link
		echo '<p><label for="' . $this->get_field_id('contactGoogle') . '">' . 'Google Plus URL:' . '</label><textarea cols="10" rows="2" class="widefat" id="' . $this->get_field_id('contactGoogle') . '" name="' . $this->get_field_name('contactGoogle') . '" >'. $contactGoogle .'</textarea></p>';
		
		# youTube Link
		echo '<p><label for="' . $this->get_field_id('contactYT') . '">' . 'YouTube URL:' . '</label><textarea cols="10" rows="2" class="widefat" id="' . $this->get_field_id('contactYT') . '" name="' . $this->get_field_name('contactYT') . '" >'. $contactYT .'</textarea></p>';
		
		# Vimeo Link
		echo '<p><label for="' . $this->get_field_id('contactVimeo') . '">' . 'Vimeo URL:' . '</label><textarea cols="10" rows="2" class="widefat" id="' . $this->get_field_id('contactVimeo') . '" name="' . $this->get_field_name('contactVimeo') . '" >'. $contactVimeo .'</textarea></p>';
		
		# RSS Link
		echo '<p><label for="' . $this->get_field_id('contactRSS') . '">' . 'RSS Feed URL:' . '</label><textarea cols="10" rows="2" class="widefat" id="' . $this->get_field_id('contactRSS') . '" name="' . $this->get_field_name('contactRSS') . '" >'. $contactRSS .'</textarea></p>';
		
		# Phone
		echo '<p><label for="' . $this->get_field_id('contactPhone') . '">' . 'Phone number:' . '</label><textarea cols="10" rows="2" class="widefat" id="' . $this->get_field_id('contactPhone') . '" name="' . $this->get_field_name('contactPhone') . '" >'. $contactPhone .'</textarea></p>';
		
		# Address
		echo '<p><label for="' . $this->get_field_id('contactAdd') . '">' . 'Address:' . '</label><textarea cols="10" rows="2" class="widefat" id="' . $this->get_field_id('contactAdd') . '" name="' . $this->get_field_name('contactAdd') . '" >'. $contactAdd .'</textarea></p>';
	}

}// end ContactWidget class

function ContactWidgetInit() {
  register_widget('ContactWidget');
}

add_action('widgets_init', 'ContactWidgetInit');

?>
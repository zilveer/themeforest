<?php 

/* Royal Banner Widget */

class Royal_AdvWidget extends WP_Widget
{
    function Royal_AdvWidget(){
	    global $themename;
		$widget_ops = array('description' => 'Banners');
		$control_ops = array('width' => 400, 'height' => 500);
		$this->WP_Widget('Banners', __('13) Royal Banner Widget', 'my-text-domain' ), $widget_ops, $control_ops);
	}

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Title' : $instance['title']);
		$use_relpath = isset($instance['use_relpath']) ? $instance['use_relpath'] : false;
		$new_window = isset($instance['new_window']) ? $instance['new_window'] : false;
		$bannerPath[1] = empty($instance['bannerOnePath']) ? '' : $instance['bannerOnePath'];
		$bannerUrl[1] = empty($instance['bannerOneUrl']) ? '' : $instance['bannerOneUrl'];
		$bannerTitle[1] = empty($instance['bannerOneTitle']) ? '' : $instance['bannerOneTitle'];
		$bannerAlt[1] = empty($instance['bannerOneAlt']) ? '' : $instance['bannerOneAlt'];
		$bannerPath[2] = empty($instance['bannerTwoPath']) ? '' : $instance['bannerTwoPath'];
		$bannerUrl[2] = empty($instance['bannerTwoUrl']) ? '' : $instance['bannerTwoUrl'];
		$bannerTitle[2] = empty($instance['bannerTwoTitle']) ? '' : $instance['bannerTwoTitle'];
		$bannerAlt[2] = empty($instance['bannerTwoAlt']) ? '' : $instance['bannerTwoAlt'];
		$bannerPath[3] = empty($instance['bannerThreePath']) ? '' : $instance['bannerThreePath'];
		$bannerUrl[3] = empty($instance['bannerThreeUrl']) ? '' : $instance['bannerThreeUrl'];
		$bannerTitle[3] = empty($instance['bannerThreeTitle']) ? '' : $instance['bannerThreeTitle'];
		$bannerAlt[3] = empty($instance['bannerThreeAlt']) ? '' : $instance['bannerThreeAlt'];
		$bannerPath[4] = empty($instance['bannerFourPath']) ? '' : $instance['bannerFourPath'];
		$bannerUrl[4] = empty($instance['bannerFourUrl']) ? '' : $instance['bannerFourUrl'];
		$bannerTitle[4] = empty($instance['bannerFourTitle']) ? '' : $instance['bannerFourTitle'];
		$bannerAlt[4] = empty($instance['bannerFourAlt']) ? '' : $instance['bannerFourAlt'];
		$bannerPath[5] = empty($instance['bannerFivePath']) ? '' : $instance['bannerFivePath'];
		$bannerUrl[5] = empty($instance['bannerFiveUrl']) ? '' : $instance['bannerFiveUrl'];
		$bannerTitle[5] = empty($instance['bannerFiveTitle']) ? '' : $instance['bannerFiveTitle'];
		$bannerAlt[5] = empty($instance['bannerFiveAlt']) ? '' : $instance['bannerFiveAlt'];
		$bannerPath[6] = empty($instance['bannerSixPath']) ? '' : $instance['bannerSixPath'];
		$bannerUrl[6] = empty($instance['bannerSixUrl']) ? '' : $instance['bannerSixUrl'];
		$bannerTitle[6] = empty($instance['bannerSixTitle']) ? '' : $instance['bannerSixTitle'];
		$bannerAlt[6] = empty($instance['bannerSixAlt']) ? '' : $instance['bannerSixAlt'];

		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title;
?>	
<div class="banners">
<?php $i = 1; 
while ($i <= 6):
if ($bannerPath[$i] <> '') { ?>
<?php if ($bannerTitle[$i] == '') $bannerTitle[$i] = "";
	  if ($bannerAlt[$i] == '') $bannerAlt[$i] = ""; ?>
	<a href="<?php echo $bannerUrl[$i] ?>" target="_blank"><img src="<?php if ($use_relpath == 1) echo home_url(); else echo $bannerPath[$i]; ?><?php if ($use_relpath == 1 ) echo ("/" . $bannerPath[$i]); ?>" alt="<?php echo $bannerAlt[$i]; ?>" title="<?php echo $bannerTitle[$i]; ?>" /></a>
<?php }; $i++;
endwhile; ?>
</div> 
<?php
		echo $after_widget;
	}

    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['use_relpath'] = 0;
		$instance['new_window'] = 0;
		if ( isset($new_instance['use_relpath']) ) $instance['use_relpath'] = 1;
		if ( isset($new_instance['new_window']) ) $instance['new_window'] = 1;
		$instance['bannerOnePath'] = stripslashes($new_instance['bannerOnePath']);
		$instance['bannerOneUrl'] = stripslashes($new_instance['bannerOneUrl']);
		$instance['bannerOneTitle'] = stripslashes($new_instance['bannerOneTitle']);
		$instance['bannerOneAlt'] = stripslashes($new_instance['bannerOneAlt']);
		$instance['bannerTwoPath'] = stripslashes($new_instance['bannerTwoPath']);
		$instance['bannerTwoUrl'] = stripslashes($new_instance['bannerTwoUrl']);
		$instance['bannerTwoTitle'] = stripslashes($new_instance['bannerTwoTitle']);
		$instance['bannerTwoAlt'] = stripslashes($new_instance['bannerTwoAlt']);
		$instance['bannerThreePath'] = stripslashes($new_instance['bannerThreePath']);
		$instance['bannerThreeUrl'] = stripslashes($new_instance['bannerThreeUrl']);
		$instance['bannerThreeTitle'] = stripslashes($new_instance['bannerThreeTitle']);
		$instance['bannerThreeAlt'] = stripslashes($new_instance['bannerThreeAlt']);
		$instance['bannerFourPath'] = stripslashes($new_instance['bannerFourPath']);
		$instance['bannerFourUrl'] = stripslashes($new_instance['bannerFourUrl']);
		$instance['bannerFourTitle'] = stripslashes($new_instance['bannerFourTitle']);
		$instance['bannerFourAlt'] = stripslashes($new_instance['bannerFourAlt']);
		$instance['bannerFivePath'] = stripslashes($new_instance['bannerFivePath']);
		$instance['bannerFiveUrl'] = stripslashes($new_instance['bannerFiveUrl']);
		$instance['bannerFiveTitle'] = stripslashes($new_instance['bannerFiveTitle']);
		$instance['bannerFiveAlt'] = stripslashes($new_instance['bannerFiveAlt']);
		$instance['bannerSixPath'] = stripslashes($new_instance['bannerSixPath']);
		$instance['bannerSixUrl'] = stripslashes($new_instance['bannerSixUrl']);
		$instance['bannerSixTitle'] = stripslashes($new_instance['bannerSixTitle']);
		$instance['bannerSixAlt'] = stripslashes($new_instance['bannerSixAlt']);

		return $instance;
	}

    function form($instance){
		
		$instance = wp_parse_args( (array) $instance, array('title'=>'Banners', 'use_relpath' => false, 'new_window' => true, 'bannerOnePath'=>'', 'bannerOneUrl'=>'', 'bannerOneTitle'=>'', 'bannerOneAlt'=>'', 'bannerTwoPath'=>'', 'bannerTwoUrl'=>'', 'bannerTwoTitle'=>'', 'bannerTwoAlt'=>'','bannerThreePath'=>'', 'bannerThreeUrl'=>'','bannerThreeTitle'=>'', 'bannerThreeAlt'=>'','bannerFourPath'=>'', 'bannerFourUrl'=>'','bannerFourTitle'=>'', 'bannerFourAlt'=>'','bannerFivePath'=>'', 'bannerFiveUrl'=>'','bannerFiveTitle'=>'', 'bannerFiveAlt'=>'','bannerSixPath'=>'', 'bannerSixUrl'=>'','bannerSixTitle'=>'','bannerSixAlt'=>'', 'bannerSevenPath'=>'', 'bannerSevenUrl'=>'','bannerSevenTitle'=>'','bannerSevenAlt'=>'','bannerEightPath'=>'', 'bannerEightUrl'=>'','bannerEightTitle'=>'','bannerEightAlt'=>'') );

		$title = htmlspecialchars($instance['title']);
		$bannerPath[1] = htmlspecialchars($instance['bannerOnePath']);
		$bannerUrl[1] = htmlspecialchars($instance['bannerOneUrl']);
		$bannerTitle[1] = htmlspecialchars($instance['bannerOneTitle']);
		$bannerAlt[1] = htmlspecialchars($instance['bannerOneAlt']);
		$bannerPath[2] = htmlspecialchars($instance['bannerTwoPath']);
		$bannerUrl[2] = htmlspecialchars($instance['bannerTwoUrl']);
		$bannerTitle[2] = htmlspecialchars($instance['bannerTwoTitle']);
		$bannerAlt[2] = htmlspecialchars($instance['bannerTwoAlt']);
		$bannerPath[3] = htmlspecialchars($instance['bannerThreePath']);
		$bannerUrl[3] = htmlspecialchars($instance['bannerThreeUrl']);
		$bannerTitle[3] = htmlspecialchars($instance['bannerThreeTitle']);
		$bannerAlt[3] = htmlspecialchars($instance['bannerThreeAlt']);
		$bannerPath[4] = htmlspecialchars($instance['bannerFourPath']);
		$bannerUrl[4] = htmlspecialchars($instance['bannerFourUrl']);
		$bannerTitle[4] = htmlspecialchars($instance['bannerFourTitle']);
		$bannerAlt[4] = htmlspecialchars($instance['bannerFourAlt']);
		$bannerPath[5] = htmlspecialchars($instance['bannerFivePath']);
		$bannerUrl[5] = htmlspecialchars($instance['bannerFiveUrl']);
		$bannerTitle[5] = htmlspecialchars($instance['bannerFiveTitle']);
		$bannerAlt[5] = htmlspecialchars($instance['bannerFiveAlt']);
		$bannerPath[6] = htmlspecialchars($instance['bannerSixPath']);
		$bannerUrl[6] = htmlspecialchars($instance['bannerSixUrl']);
		$bannerTitle[6] = htmlspecialchars($instance['bannerSixTitle']);
		$bannerAlt[6] = htmlspecialchars($instance['bannerSixAlt']);

	
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>'; ?>
			
		<?php
		echo '<p><label for="' . $this->get_field_id('bannerOnePath') . '">' . 'Banner image path №1:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerOnePath') . '" name="' . $this->get_field_name('bannerOnePath') . '" type="text" value="' . $bannerPath[1] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerOneUrl') . '">' . 'Banner link №1:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneUrl') . '" name="' . $this->get_field_name('bannerOneUrl') . '" type="text" value="' . $bannerUrl[1] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerOneTitle') . '">' . 'Banner Title №1:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneTitle') . '" name="' . $this->get_field_name('bannerOneTitle') . '" type="text" value="' . $bannerTitle[1] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerOneAlt') . '">' . 'Banner Alt Title №1:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneAlt') . '" name="' . $this->get_field_name('bannerOneAlt') . '" type="text" value="' . $bannerAlt[1] . '" /></p>';

		echo '<p><label for="' . $this->get_field_id('bannerTwoPath') . '">' . 'Banner image path №2:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerTwoPath') . '" name="' . $this->get_field_name('bannerTwoPath') . '" type="text" value="' . $bannerPath[2] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerTwoUrl') . '">' . 'Banner link №2:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerTwoUrl') . '" name="' . $this->get_field_name('bannerTwoUrl') . '" type="text" value="' . $bannerUrl[2] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerTwoTitle') . '">' . 'Banner Title №2:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerTwoTitle') . '" name="' . $this->get_field_name('bannerTwoTitle') . '" type="text" value="' . $bannerTitle[2] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerTwoAlt') . '">' . 'Banner Alt Title №2:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerTwoAlt') . '" name="' . $this->get_field_name('bannerTwoAlt') . '" type="text" value="' . $bannerAlt[2] . '" /></p>';

		echo '<p><label for="' . $this->get_field_id('bannerThreePath') . '">' . 'Banner image path №3:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerThreePath') . '" name="' . $this->get_field_name('bannerThreePath') . '" type="text" value="' . $bannerPath[3] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerThreeUrl') . '">' . 'Banner link №3:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerThreeUrl') . '" name="' . $this->get_field_name('bannerThreeUrl') . '" type="text" value="' . $bannerUrl[3] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerThreeTitle') . '">' . 'Banner Title №3:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerThreeTitle') . '" name="' . $this->get_field_name('bannerThreeTitle') . '" type="text" value="' . $bannerTitle[3] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerThreeAlt') . '">' . 'Banner Alt Title №3:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerThreeAlt') . '" name="' . $this->get_field_name('bannerThreeAlt') . '" type="text" value="' . $bannerAlt[3] . '" /></p>';

		echo '<p><label for="' . $this->get_field_id('bannerFourPath') . '">' . 'Banner image path №4:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerFourPath') . '" name="' . $this->get_field_name('bannerFourPath') . '" type="text" value="' . $bannerPath[4] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerFourUrl') . '">' . 'Banner link №4:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerFourUrl') . '" name="' . $this->get_field_name('bannerFourUrl') . '" type="text" value="' . $bannerUrl[4] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerFourTitle') . '">' . 'Banner Title №4:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerFourTitle') . '" name="' . $this->get_field_name('bannerFourTitle') . '" type="text" value="' . $bannerTitle[4] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerFourAlt') . '">' . 'Banner Alt Title №4:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerFourAlt') . '" name="' . $this->get_field_name('bannerFourAlt') . '" type="text" value="' . $bannerAlt[4] . '" /></p>';

		echo '<p><label for="' . $this->get_field_id('bannerFivePath') . '">' . 'Banner image path №5:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerFivePath') . '" name="' . $this->get_field_name('bannerFivePath') . '" type="text" value="' . $bannerPath[5] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerFiveUrl') . '">' . 'Banner link №5:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerFiveUrl') . '" name="' . $this->get_field_name('bannerFiveUrl') . '" type="text" value="' . $bannerUrl[5] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerFiveTitle') . '">' . 'Banner Title №5:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerFiveTitle') . '" name="' . $this->get_field_name('bannerFiveTitle') . '" type="text" value="' . $bannerTitle[5] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerFiveAlt') . '">' . 'Banner Alt Title №5:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerFiveAlt') . '" name="' . $this->get_field_name('bannerFiveAlt') . '" type="text" value="' . $bannerAlt[5] . '" /></p>';

		echo '<p><label for="' . $this->get_field_id('bannerSixPath') . '">' . 'Banner image path №6:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerSixPath') . '" name="' . $this->get_field_name('bannerSixPath') . '" type="text" value="' . $bannerPath[6] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerSixUrl') . '">' . 'Banner link №6:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerSixUrl') . '" name="' . $this->get_field_name('bannerSixUrl') . '" type="text" value="' . $bannerUrl[6] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerSixTitle') . '">' . 'Banner Title №6:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerSixTitle') . '" name="' . $this->get_field_name('bannerSixTitle') . '" type="text" value="' . $bannerTitle[6] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id('bannerSixAlt') . '">' . 'Banner Alt Title №6:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerSixAlt') . '" name="' . $this->get_field_name('bannerSixAlt') . '" type="text" value="' . $bannerAlt[6] . '" /></p>';
		
	}
}

function Royal_AdvWidgetInit() {
	register_widget('Royal_AdvWidget');
}

add_action('widgets_init', 'Royal_AdvWidgetInit');

?>
<?php
/** My Twitter Widget
  * Objective:
  *		1.To list out the latest tweets
**/
class MY_Mailchimp extends WP_Widget {
	
	#1.constructor
	function MY_Mailchimp() {
		$widget_options = array("classname"=>'mailchimp', 'description'=>'Use this widget to add a mailchimp newsletter to your site.');
		parent::__construct(false,IAMD_THEME_NAME.__(' Mailchimp Newsletter Widget','dt_themes'),$widget_options);
	}
	
	
	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance,array( 'title' => "", "list_id" => "") );
		
		$title 		= 	empty($instance['title']) ?	'' : strip_tags($instance['title']);
		$desc 		= 	empty($instance['title']) ?	'' : strip_tags($instance['desc']);
		$list_id 	=	empty($instance['list_id']) ? '' : strip_tags($instance['list_id']);
		
		if( esc_html(dttheme_option('general','mailchimp-key')) ):
			require_once(IAMD_FW."theme_widgets/mailchimp/MCAPI.class.php");
			$mcapi = new MCAPI( esc_html(dttheme_option('general','mailchimp-key')) );
			$lists = $mcapi->lists();?>
            
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','dt_themes');?> 
               <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>"  
                      type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

            <p><label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Description:','dt_themes');?>
               <textarea class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" ><?php echo esc_attr($desc); ?></textarea>	 
               </label></p>
                      
            <p><label for="<?php echo $this->get_field_id('list_id'); ?>"><?php _e('Select List:','dt_themes'); ?></label>
               <select id="<?php echo $this->get_field_id('list_id'); ?>" name="<?php echo $this->get_field_name('list_id'); ?>">
               <?php foreach ($lists['data'] as $key => $value):
			   			$id = $value['id'];
						$name = $value['name'];
						$selected = ( $list_id == $id ) ? ' selected="selected" ' : '';
						echo "<option $selected value='$id'>$name</option>";
					 endforeach;?></select></p>
                      
<?php   else:
			echo "<p>".__("Paste your mailchimp api key in BPanel at General Settings tab",'dt_themes')."</p>";
		endif;
	}
	
	#3.processes & saves the mailchimp widget option
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['desc'] = strip_tags($new_instance['desc']);
		$instance['list_id'] = strip_tags($new_instance['list_id']);
		return $instance;
	}
	
	#4.output in front-end
	function widget($args, $instance) {
		extract($args);
		echo $before_widget;
		$title = empty($instance['title']) ? '' : strip_tags($instance['title']);
		$title = apply_filters( 'widget_title', $title );

		$desc = empty($instance['desc']) ? '' : strip_tags($instance['desc']);

		$list_id = isset($instance['list_id']) ? $instance['list_id'] : '';
		
		if ( !empty( $title ) ) echo $before_title.$title.$after_title;
		
		if ( !empty( $desc ) ) echo "<p>$desc</p>";
		
		if( isset( $_REQUEST['mythem_mc_emailid']) ):
			require_once(IAMD_FW."theme_widgets/mailchimp/MCAPI.class.php");
			$mcapi = new MCAPI( dttheme_option('general','mailchimp-key') );
			
			$merge_vars = Array( 'EMAIL' => $_REQUEST['mythem_mc_emailid']);
			$list_id = $instance['list_id'];

			if($mcapi->listSubscribe($list_id, $_REQUEST['mythem_mc_emailid'], $merge_vars ) ):
				// It worked!   
				$msg = '<span class="success-msg">'.__('Success!&nbsp; Please check your inbox or spam folder.','dt_themes').'</span>';
			else:
				// An error ocurred, return error message   
				$msg = '<span class="error-msg"><b>'.__('Error:','dt_themes').'</b>&nbsp; ' . $mcapi->errorMessage.'</span>';
			endif;
			
		endif;
		
		echo '<form method="post" class="mailchimp-form">';
		echo '	<input type="email" placeholder="'.__('Enter Email Address','dt_themes').'" name="mythem_mc_emailid" value="" required/>';
		echo "	<input type='hidden' name='mythem_mc_listid' value='$list_id' />";
		echo '	<input type="submit" name="submit" class="nl-submit" value="Signup" />';
		echo '</form>';

		if ( isset ( $msg ) ) echo '<span class="zn_mailchimp_result">'.$msg.'</span>';
		
		echo $after_widget;		
	}
}?>
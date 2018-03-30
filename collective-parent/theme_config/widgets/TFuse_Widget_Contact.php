<?php
class TFuse_Widget_Contact extends WP_Widget {

	function TFuse_Widget_Contact() {
		$widget_ops = array('classname' => 'widget_contact', 'description' => __('Contact widget','tfuse'));
		$control_ops = array('width' => 300, 'height' => 200);
		$this->WP_Widget('contact', __('TFuse Contact','tfuse'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$text = apply_filters( 'widget_text', $instance['text'], $instance );
        $title_contacts = $instance['title_contacts'];
		$title = tfuse_qtranslate($title); ?>

        <div class="widget_container widget_contacts">
            <?php if( !empty( $title ) || $text!='' ){ ?>
                <div class="company_adress">
                    <span class="adress_ico ico"></span>
                    <?php
                        if( !empty( $title ) ) echo '<span>'.$title.'</span>';
                        echo $text;
                    ?>
                </div>
            <?php } ?>
            <?php if($instance['title_contacts']!='' || $instance['name1']!='' || $instance['phone1']!='' || $instance['email1']!=''){ ?>
                <div class="contact">
                    <span class="contact_ico ico"></span>
                    <?php if($instance['title_contacts']!='') echo '<span>'.$instance['title_contacts'].'</span>';
                    if($instance['name1']!='') echo '<p>'.$instance['name1'].'</p>';
                    if($instance['phone1']!='') echo '<p>'.$instance['phone1'].'</p>';
                    if($instance['email1']!='') echo '<a href="mailto:'.$instance['email1'].'" target="_top">'.$instance['email1'].'</a>';
                    echo '<br/> <br/>';
                    if($instance['name2']!='') echo '<p>'.$instance['name2'].'</p>';
                    if($instance['phone2']!='') echo '<p>'.$instance['phone2'].'</p>';
                    if($instance['email2']!='') echo '<a href="mailto:'.$instance['email2'].'" target="_top">'.$instance['email2'].'</a>';
                ?>
                </div>
            <?php } ?>
        </div>

        <?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed

        $instance['title_contacts'] = $new_instance['title_contacts'];
        $instance['name1'] = $new_instance['name1'];
        $instance['phone1'] = $new_instance['phone1'];
        $instance['email1'] = $new_instance['email1'];
        $instance['name2'] = $new_instance['name2'];
        $instance['phone2'] = $new_instance['phone2'];
        $instance['email2'] = $new_instance['email2'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'title_contacts' => '', 'name1'=>'','phone1'=>'','email1'=>'','name2'=>'','phone2'=>'','email2'=>''  ) );
		$title = $instance['title'];
        $title_contacts = $instance['title_contacts'];
		$text = format_to_edit($instance['text']);
        $name1 = $instance['name1'];
        $phone1 = $instance['phone1'];
        $email1 = $instance['email1'];
        $name2 = $instance['name2'];
        $phone2 = $instance['phone2'];
        $email2 = $instance['email2']; ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title for company address:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

        <p><label for="<?php echo $this->get_field_id('title_contacts'); ?>"><?php _e('Title for contacts:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title_contacts'); ?>" name="<?php echo $this->get_field_name('title_contacts'); ?>" type="text" value="<?php echo esc_attr($title_contacts); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('name1'); ?>"><?php _e('Name 1:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('name1'); ?>" name="<?php echo $this->get_field_name('name1'); ?>" type="text" value="<?php echo esc_attr($name1); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('phone1'); ?>"><?php _e('Phone 1:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('phone1'); ?>" name="<?php echo $this->get_field_name('phone1'); ?>" type="text" value="<?php echo esc_attr($phone1); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('email1'); ?>"><?php _e('Email 1:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('email1'); ?>" name="<?php echo $this->get_field_name('email1'); ?>" type="text" value="<?php echo esc_attr($email1); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('name2'); ?>"><?php _e('Name 2:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('name2'); ?>" name="<?php echo $this->get_field_name('name2'); ?>" type="text" value="<?php echo esc_attr($name2); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('phone2'); ?>"><?php _e('Phone 2:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('phone2'); ?>" name="<?php echo $this->get_field_name('phone2'); ?>" type="text" value="<?php echo esc_attr($phone2); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('email2'); ?>"><?php _e('Email 2:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('email2'); ?>" name="<?php echo $this->get_field_name('email2'); ?>" type="text" value="<?php echo esc_attr($email2); ?>" /></p>
<?php
	}
}

register_widget('TFuse_Widget_Contact');
<?php

class sds_widget_address_info extends WP_Widget

{

     public function __construct() {

        parent::__construct(

                'sds_widget_address_info', // Base ID  

                'Sellya Address Info', // Name  

                array(

                    'description' => __('This widget will show Address.','sellya')

                )

        );

    }

	

	function form( $instance )

	{

            $defaults = array( 

            'title' => __( 'Our Location', 'sellya' ),

			'mobile_phone' => 'Call us FREE!',
			'mobile_phone2'=>'0123 123 1234',
             
			'land_phone' => '0123 123 1234',
			'land_phone2' => '0123 123 1234',
			
			'email' => 'info@321cart.com',
			'email2' => 'office@321cart.com',
		  

	      	'skype'=>"your.sellya",			
			'skype2'=>"sellya.info",

            'address' => '135 South Park Avenue',
			'address2' => 'Los Angeles, CA 90024. USA ',

            'hours' => ' 9:00 a.m. to 5:00 p.m.'

          

        );

        

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		

		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>">

				<strong><?php _e( 'Title', 'sellya' ) ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />

			</label>

		</p> 

                <p>

                     <label for="<?php echo $this->get_field_id('mobile_phone'); ?>"><?php _e( 'Mobile Phone', 'sellya' ) ?></label>

                         <input type="text"  class="widefat" id="<?php echo $this->get_field_id('mobile_phone'); ?>" name="<?php echo $this->get_field_name('mobile_phone'); ?>" value="<?php echo $instance['mobile_phone']; ?>" /><input type="text"  class="widefat" id="<?php echo $this->get_field_id('mobile_phone2'); ?>" name="<?php echo $this->get_field_name('mobile_phone2'); ?>" value="<?php echo $instance['mobile_phone2']; ?>" />

                </p> 

                <p>

                     <label for="<?php echo $this->get_field_id('land_phone'); ?>"><?php _e( 'Land Phone', 'sellya' ) ?></label>

                         <input type="text"  class="widefat" id="<?php echo $this->get_field_id('land_phone'); ?>" name="<?php echo $this->get_field_name('land_phone'); ?>" value="<?php echo $instance['land_phone']; ?>" /><input type="text"  class="widefat" id="<?php echo $this->get_field_id('land_phone2'); ?>" name="<?php echo $this->get_field_name('land_phone2'); ?>" value="<?php echo $instance['land_phone2']; ?>" />

                </p>

	       <p>

                     <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e( 'Email', 'sellya' ) ?></label>

                        <input type="text"  class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" /><input type="text"  class="widefat" id="<?php echo $this->get_field_id('email2'); ?>" name="<?php echo $this->get_field_name('email2'); ?>" value="<?php echo $instance['email2']; ?>" />

	       </p>

	       	       <p>

                     <label for="<?php echo $this->get_field_id('skype'); ?>"><?php _e( 'Skype', 'sellya' ) ?></label>

                        <input type="text"  class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" value="<?php echo $instance['skype']; ?>" /><input type="text"  class="widefat" id="<?php echo $this->get_field_id('skype2'); ?>" name="<?php echo $this->get_field_name('skype2'); ?>" value="<?php echo $instance['skype2']; ?>" />

	       </p>   

		<p>

                     <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e( 'Address', 'sellya' ) ?></label>

                        <textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo $instance['address']; ?></textarea><textarea class="widefat" id="<?php echo $this->get_field_id('address2'); ?>" name="<?php echo $this->get_field_name('address2'); ?>"><?php echo $instance['address2']; ?></textarea>

                </p> 

		<p>

                    <label for="<?php echo $this->get_field_id('hours'); ?>"><?php _e( 'Hours', 'sellya' ) ?></label>

                    <textarea class="widefat" id="<?php echo $this->get_field_id('hours'); ?>" name="<?php echo $this->get_field_name('hours'); ?>"><?php echo $instance['hours']; ?></textarea>

                

        </p>             



<?php

	}



	function widget( $args, $instance )

	{
		global $smof_data;

		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );


		 echo $before_widget;

		echo "<div class='contacts'>";

                $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

                if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; 



                ?>

				<?php
				if(!empty($instance['mobile_phone']) or !empty($instance['mobile_phone2']) ):
				?>

                  <span class="c_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_footer/icon_contact_mphone_<?php echo $smof_data['sellya_contact_icon']?>.png" alt="Mobile Phone" title="Mobile Phone"></span>     

		        <span><?php echo $instance['mobile_phone']; ?></span><br />
                <span><?php echo $instance['mobile_phone2']; ?></span>

		<br /><br />         

                  <?php endif;?>    
    
    		<?php
			if(!empty($instance['land_phone']) or !empty($instance['land_phone2']) ):
			?>
    
            <span class="c_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_footer/icon_contact_sphone_<?php echo $smof_data['sellya_contact_icon']?>.png" alt="Static Phone" title="Static Phone"></span>                     
    
                  <span><?php echo $instance['land_phone']; ?></span><br />
                  <span><?php echo $instance['land_phone2']; ?></span>
    
            <br /><br />   
			<?php endif;?> 
                      
			<?php
			if(!empty($instance['email']) or !empty($instance['email2']) ):
			?>


        <span class="c_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_footer/icon_contact_email_<?php echo $smof_data['sellya_contact_icon']?>.png" alt="E-mail" title="E-mail"></span>           

		      <span><a href="mailto:<?php echo trim($instance['email']); ?>"><?php echo $instance['email']; ?></a></span><br />
              <span><a href="mailto:<?php echo trim($instance['email2']); ?>"><?php echo $instance['email2']; ?></a></span>

		<br /><br />

        <?php endif;?>               


		<?php
		if(!empty($instance['skype']) or !empty($instance['skype2']) ):
		?>

        <span class="c_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_footer/icon_contact_skype_<?php echo $smof_data['sellya_contact_icon']?>.png" alt="Skype" title="Skype"></span>         

		      <span><?php echo $instance['skype']; ?></span><br />

              <span><?php echo $instance['skype2']; ?></span>
              

        <br /><br />        

		<?php endif;?>           


		<?php
		if(!empty($instance['address']) or !empty($instance['address2']) ):
		?>

        <span class="c_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_footer/icon_contact_location_<?php echo $smof_data['sellya_contact_icon']?>.png" alt="Address" title="Address"></span>         

		     <span><?php echo $instance['address']; ?></span><br /> 

			<span><?php echo $instance['address2']; ?></span>

        <br /><br />

		<?php endif;?>
        
        <?php
		if(!empty($instance['hours'])):
		?>        
        <span class="c_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_footer/icon_contact_hours_<?php echo $smof_data['sellya_contact_icon']?>.png" alt="Hours" title="Hours"></span>         

        <span><pre><?php echo $instance['hours']; ?></pre>
        </span>
		<?php endif;?>

		</div>
 <?php

		

		echo $after_widget;

	}                     



    function update( $new_instance, $old_instance ) 

    {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['address'] = $new_instance['address'];
		
		$instance['address2'] = $new_instance['address2'];

		$instance['mobile_phone'] = $new_instance['mobile_phone'];
		
		$instance['mobile_phone2'] = $new_instance['mobile_phone2'];

		$instance['skype'] = $new_instance['skype'];
		
		$instance['skype2'] = $new_instance['skype2'];

		$instance['land_phone'] = $new_instance['land_phone'];
		
		$instance['land_phone2'] = $new_instance['land_phone2'];                

		$instance['email'] = $new_instance['email'];

		$instance['email2'] = $new_instance['email2'];

		$instance['hours'] = $new_instance['hours'];



		return $instance;

	}

	

}    

add_action('widgets_init', create_function('', 'register_widget( "sds_widget_address_info" );'));

?>
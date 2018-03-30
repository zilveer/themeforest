<?php

 

function sdsTwitterScript() {

	

	if( !is_admin() ){

              

	//	wp_register_script('twitter-script', get_template_directory_uri() .'/'.SWPF_FREAMWORK_DIRECTORY. '/widgets/js/jquery.tweet.js',array('jquery'));

	//	wp_enqueue_script('twitter-script');

	}

}

add_action('init', 'sdsTwitterScript');





class SWPF_Tweets_Widget extends WP_Widget {



    public function __construct() {

        parent::__construct(

                'SWPF_Tweets_Widget', // Base ID  

                'Sellya Tweets', // Name  

                array(

                    'description' => __('This widget will show tweets.','sellya')

                )

        );

    }

    public function form($instance){

        global $SWPF_FREAMWORK_DIRECTORY; 

        $defaults = array(

            'title' => 'Sellya Tweets', 

            'account' => '321cart_com',
			'widget_id' =>'344798604503969792',
			'data_theme'=>'dark',
            'show' => 4

            ); 

        $instance = wp_parse_args((array) $instance, $defaults);

        $account= esc_attr($instance['account']);
		
		$widget_id= esc_attr($instance['widget_id']);
		$data_theme= esc_attr($instance['data_theme']);

        $show=esc_attr($instance['show']);

?>



		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'sellya') ?></label><BR/>

			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"style="width:224px;" />

		</p>





		<p>

			<label for="<?php echo $this->get_field_id( 'account' ); ?>"><?php _e('Twitter Username:', 'sellya') ?></label>

			<input type="text" id="<?php echo $this->get_field_id( 'account' ); ?>" name="<?php echo $this->get_field_name( 'account' ); ?>" value="<?php echo $account; ?>" style="width:224px;" />

		</p>

                <p>

			<label for="<?php echo $this->get_field_id( 'widget_id' ); ?>"><?php _e('Widget Id:', 'sellya') ?></label>

			<input type="text" id="<?php echo $this->get_field_id( 'widget_id' ); ?>" name="<?php echo $this->get_field_name( 'widget_id' ); ?>" value="<?php echo $widget_id; ?>" style="width:224px;" />

		</p>
     <p>

			<label for="<?php echo $this->get_field_id( 'data_theme' ); ?>"><?php _e('Theme:', 'sellya') ?></label>

            <select id="<?php echo $this->get_field_id( 'data_theme' ); ?>" name="<?php echo $this->get_field_name( 'data_theme' ); ?>" style="width:224px;">
            
            	<option value="dark" <?php if($data_theme == 'dark') echo 'selected="selected"'; ?>>Dark</option>
                
                <option value="light" <?php if($data_theme == 'light') echo 'selected="selected"'; ?>>Light</option>
            
            </select>

		</p>
                <p>

			<label for="<?php echo $this->get_field_id( 'Show' ); ?>"><?php _e('Show:', 'sellya') ?></label>

			<input type="text" id="<?php echo $this->get_field_id( 'show' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" value="<?php echo $show; ?>" style="width:224px;" />

		</p>
		

        <?php

    }

    public function update($new_instance, $old_instance) {

        $instance['title'] = strip_tags($new_instance['title']);

        $instance['account'] = strip_tags($new_instance['account']);

        $instance['widget_id'] = strip_tags($new_instance['widget_id']);
		  $instance['data_theme'] = strip_tags($new_instance['data_theme']);
		    $instance['show'] = strip_tags($new_instance['show']);

        return $instance;

    }

    public function widget($args, $instance) {

        $account=$instance['account'];

        $show=$instance['show'];

  $widget_id=$instance['widget_id'];
    $data_theme=$instance['data_theme'];
	
         extract($args, EXTR_SKIP);

	 

         	$title = apply_filters('widget_title', $instance['title'] );

		



		 echo $before_widget;

                $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

                if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; 



		 $id = rand(0,9999);

	?>
    <div class="twitter">
    		           
				<p><a class="twitter-timeline"  href="https://twitter.com/@<?php echo $account; ?>" data-chrome="noheader nofooter noborders noscrollbar transparent" data-tweet-limit="<?php echo $show; ?>"  data-widget-id="<?php echo $widget_id; ?>" data-theme="<?php echo $data_theme; ?>" data-related="twitterapi,twitter" data-aria-polite="assertive">Tweets by <?php echo $account; ?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>
	
 </div>
    <?php

            echo $after_widget;

         

    }



}

add_action('widgets_init', create_function('', 'register_widget( "SWPF_Tweets_Widget" );'));

?>
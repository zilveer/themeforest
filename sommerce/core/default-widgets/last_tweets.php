<?php
class last_tweets extends WP_Widget
{
    function __construct()
    {
		$widget_ops = array( 
            'classname' => 'last-tweets', 
            'description' => __('Retrieve the last tweets.', 'yiw') 
        );

		$control_ops = array( 'id_base' => 'last-tweets' );

		WP_Widget::__construct( 'last-tweets', 'Last Tweets', $widget_ops, $control_ops );
	}
	
	function form( $instance )
	{
        /* Impostazioni di default del widget */
		$defaults = array( 
            'title' => 'Last Tweets',
            'username' => '',
            'limit' => 3,
            'time' => 'true',
            'replies' => 'true'
        );
        
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label>
                <?php _e('Title', 'yiw'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php _e('Username', 'yiw'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php _e('Consumer key', 'yiw'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" value="<?php echo $instance['consumer_key']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php _e('Consumer secret', 'yiw'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" value="<?php echo $instance['consumer_secret']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php _e('Access token', 'yiw'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" value="<?php echo $instance['access_token']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php _e('Access token secret', 'yiw'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'access_token_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_token_secret' ); ?>" value="<?php echo $instance['access_token_secret']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php _e('Limit', 'yiw'); ?>:
                <select id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>">

                    <?php for( $i = 1; $i <= 10; $i++ ) : $selected = ( $instance['limit'] == $i ) ? ' selected="selected"' : '' ?>
                        <option value="<?php echo $i ?>"<?php echo $selected ?>><?php echo $i ?></option>
                    <?php endfor ?>

                </select>
            </label>
        </p>

        <p>
            <label>
                <?php $checked = ( $instance['time'] == 'true' ) ? ' checked=""' : '' ?>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'time' ); ?>" name="<?php echo $this->get_field_name( 'time' ); ?>" value="true"<?php echo $checked ?> />
                <?php _e('Show Time', 'yiw'); ?>
            </label>
        </p>
		<?php
	}
	
	function widget( $args, $instance )
	{
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		echo '<div class="list-tweets' . '-' . $this->number . '"></div>';

        $access_token = ( $instance['access_token'] != '' ) ? $instance['access_token'] : yiw_get_option( 'twitter_access_token' ) ;
        $access_token_secret = ( $instance['access_token_secret'] != '' ) ? $instance['access_token_secret'] : yiw_get_option( 'twitter_access_token_secret' ) ;
        $consumer_key = ( $instance['consumer_key'] != '' ) ? $instance['consumer_key'] : yiw_get_option( 'twitter_consumer_key' ) ;
        $consumer_secret = ( $instance['consumer_secret'] != '' ) ? $instance['consumer_secret'] : yiw_get_option( 'twitter_consumer_secret' ) ;

        $twitter_data = yit_get_tweets( $access_token, $access_token_secret, $consumer_key, $consumer_secret, $instance['limit']);

        if ( !isset($twitter_data->errors) ) :
            echo '<ul class="last-tweets">';
            $i = 1;
            foreach ($twitter_data as $tweet){
                if (!empty($tweet)) {
                    $text = $tweet->text;
                    $text_in_tooltip = str_replace('"', '', $text); // replace " to avoid conflicts with title="" opening tags
                    $id = $tweet->id;
                    $time = strftime('%d/%m/%Y %H:%M:%S', strtotime($tweet->created_at));
                    //$username = $tweet->user->name;
                }
                echo '<li class="tweet_' . $i . '"><p><span class="text">' . $text . '</span><br />';
                if ( $instance['time'] ) echo '<span class="meta">' . $time . '</span>';
                echo '</p></li>';

                ?>
                <script type="text/javascript">
                    jQuery(function($){
                        var test = twttr.txt.autoLink("<?php echo addslashes( str_replace( "\n", " ", $text ) ) ?>");
                        $('ul.last-tweets li.tweet_<?php echo $i ?> span.text').replaceWith(test);
                    });
                </script>
                <?php $i++;
            }
            echo '</ul>';
        endif;
        echo '</div>';

		echo $after_widget;
	}                     

    function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['username'] = strip_tags( $new_instance['username'] );

        $instance['consumer_key'] = strip_tags( $new_instance['consumer_key'] );

        $instance['consumer_secret'] = strip_tags( $new_instance['consumer_secret'] );

        $instance['access_token'] = strip_tags( $new_instance['access_token'] );

        $instance['access_token_secret'] = strip_tags( $new_instance['access_token_secret'] );

		$instance['time'] = strip_tags( $new_instance['time'] );

		$instance['limit'] = strip_tags( $new_instance['limit'] );

		$instance['replies'] = strip_tags( $new_instance['replies'] );

		return $instance;
	}
	
}   
?>

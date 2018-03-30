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

if( !class_exists( 'last_tweets' ) ) :
class last_tweets extends WP_Widget
{
    function __construct() {
		$widget_ops = array( 
            'classname' => 'last-tweets', 
            'description' => __('Retrieve the last tweets.', 'yit') 
        );

		$control_ops = array( 'id_base' => 'last-tweets' );

		WP_Widget::__construct( 'last-tweets', __('Last Tweets', 'yit'), $widget_ops, $control_ops );
	}
	
	function form( $instance ) {
        /* Impostazioni di default del widget */
		$defaults = array( 
            'title' => __('Last Tweets', 'yit'),
            'username' => '',
            'consumer_key' => '',
            'consumer_secret' => '',
            'access_token' => '',
            'access_token_secret' => '',
            'limit' => 3,
            'time' => 'true',
            'follow' => 'true'
        );
        
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label>
				<?php _e('Title', 'yit'); ?>:<br />
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>

        <p>
            <label>
                <?php _e('Username', 'yit'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php _e('Consumer key', 'yit'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" value="<?php echo $instance['consumer_key']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php _e('Consumer secret', 'yit'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" value="<?php echo $instance['consumer_secret']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php _e('Access token', 'yit'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" value="<?php echo $instance['access_token']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php _e('Access token secret', 'yit'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'access_token_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_token_secret' ); ?>" value="<?php echo $instance['access_token_secret']; ?>" />
            </label>
        </p>
		
		<p>
			<label>
				<?php _e('Limit', 'yit'); ?>:
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
				<?php _e('Show Time', 'yit'); ?>
			</label>
		</p>
        
        <p>
			<label>
				<?php $checked = ( $instance['follow'] == 'true' ) ? ' checked=""' : '' ?>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'follow' ); ?>" name="<?php echo $this->get_field_name( 'follow' ); ?>" value="true"<?php echo $checked ?> />
				<?php _e('Show Follow link', 'yit'); ?>
			</label>
		</p>
		<?php
	}
	
	function widget( $args, $instance )	{
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		//echo '<img src="' . YIT_IMAGES_URL . '/last-tweets-arrow.png" class="arrow" />';
		echo '<div class="list-tweets' . '-' . $this->number . '">';

        $username = ( isset($instance['username']) && $instance['username'] != '' ) ? $instance['username'] : yit_get_option('twitter-username');
        $access_token = ( isset($instance['access_token']) && $instance['access_token'] != '' ) ? $instance['access_token'] : yit_get_option('twitter-access-token');
        $access_token_secret = ( isset($instance['access_token_secret']) && $instance['access_token_secret'] != '' ) ? $instance['access_token_secret'] : yit_get_option('twitter-access-token-secret');
        $consumer_key = ( isset($instance['consumer_key']) && $instance['consumer_key'] != '' ) ? $instance['consumer_key'] : yit_get_option('twitter-consumer-key');
        $consumer_secret = ( isset($instance['consumer_secret']) && $instance['consumer_secret'] != '' ) ? $instance['consumer_secret'] : yit_get_option('twitter-consumer-secret');

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

        if( isset($instance['follow']) && $instance['follow'] == 'true' ){
            echo '<p id="follow-twitter"><a href="https://twitter.com/intent/user?screen_name=' . $username . '" target="_blank">' . apply_filters( 'yit_follow_us_twitter_widget', __( 'Follow us on Twitter &rarr;', 'yit' ) ) . '</a>';
        }

		echo $after_widget;
	}                     

    function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

        $instance['username'] = strip_tags( $new_instance['username'] );

        $instance['consumer_key'] = $new_instance['consumer_key'];

        $instance['consumer_secret'] = $new_instance['consumer_secret'];

        $instance['access_token'] = $new_instance['access_token'];

        $instance['access_token_secret'] = $new_instance['access_token_secret'];

		$instance['time'] = $new_instance['time'];

		$instance['limit'] = strip_tags( $new_instance['limit'] );

        $instance['follow'] = $new_instance['follow'];

		return $instance;
	}
	
}   
endif;
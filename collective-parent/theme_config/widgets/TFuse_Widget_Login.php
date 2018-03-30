<?php
// =============================== Recent Reviews Widget ======================================
class TFuse_Login extends WP_Widget {

    function TFuse_Login() {
        $widget_ops = array('description' => '' );
        parent::WP_Widget(false, __('TFuse - Login', 'tfuse'),$widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        $title = tfuse_qtranslate($instance['title']);
        
        $return_html = '';
        if ( ! is_user_logged_in() )
        {
            $return_html = '<div class="widget-container widget_login">';
            if($title != '') $return_html .= '<div class="widget_title clearfix"><h3 class="clearfix">'.$instance['title'].'</h3></div>';
            $return_html .= '<form action="'. home_url().'/wp-login.php" method="post" name="loginform" id="loginform"  class="loginform">
                    <p><label>'. __('Username', 'tfuse').'</label>
                        <input name="log" id="user_login" class="input inputField" value="" size="20" tabindex="10" type="text"></p>
                    <p><label>'. __('Password', 'tfuse').'</label>
                        <input name="pwd" id="user_pass" class="input inputField" value="" size="20" tabindex="20" type="password"></p>
                            <div class="forgetmenot checklist">
                                <input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" />
                                <label for="rememberme">'. __('Remember Me', 'tfuse').'</label>
                            </div>
                        <div class="forget_password"><a href="'. home_url().'/wp-login.php?action=lostpassword">'. __('Forgot Password?', 'tfuse').'</a></div>
                    <div class="clear"></div>
                    <div class="submit submit_login">
                        <div class="button large pink login_btn">
                            <input type="submit" name="wp-submit" id="wp-submit" class="btn-submit" value="'.__('LOG IN','tfuse').'" tabindex="100" />
                        </div>
                        <input type="hidden" name="redirect_to" value="'. home_url().'/wp-admin/" />
                        <input type="hidden" name="testcookie" value="1" />
                    </div>
                </form>
            </div>';
        }
        echo $return_html;
    }

    function update($new_instance, $old_instance) {
	    $instance = $old_instance;
        $instance = wp_parse_args( (array) $instance, array('title' => '') );
        $instance['title'] =  $new_instance['title'] ;
        return $instance;
    }

    function form($instance) {
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        ?>
       
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <?php
    }
}
function TFuse_Unregister_WP_Widget_Login() {
    unregister_widget('WP_Widget_Login');
}

add_action('widgets_init','TFuse_Unregister_WP_Widget_Login');

register_widget('TFuse_Login');
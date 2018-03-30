<?php

/**
 * Plugin Name: Peekaboo Social Media Widget
 * Version: 1.0
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/


add_action('widgets_init', 'pkb_widget_social');

function pkb_widget_social()
{
    register_widget('pkb_widget_social');
}

class pkb_widget_social extends WP_Widget
{

    function pkb_widget_social()
    {

        $widget_ops = array(
            'classname' => 'pkb_widget_social',
            'description' => __('Display social media icons', 'peekaboo')
        );

        parent::__construct('pkb_widget_social', __('Peekaboo Social Media', 'peekaboo'), $widget_ops);
    }


//	Outputs the options form on admin
    function form($instance)
    {

        $defaults = array(
            'title' => '',
            'rss' => '',
            'email' => '',
            'facebook' => '',
            'flickr' => '',
            'twitter' => '',
            'vimeo' => '',
            'youtube' => '',
            'iconurl1' => '',
            'icontitle1' => '',
            'iconimage1' => '',
            'iconurl2' => '',
            'icontitle2' => '',
            'iconimage2' => ''
        );
        $instance = wp_parse_args((array)$instance, $defaults); ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'peekaboo') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"
                   type="text"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email URL:', 'peekaboo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>"
                   name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>"
                   type="text"/>
        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:', 'peekaboo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>"
                   name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $instance['facebook']; ?>"
                   type="text"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr URL:', 'peekaboo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>"
                   name="<?php echo $this->get_field_name('flickr'); ?>" value="<?php echo $instance['flickr']; ?>"
                   type="text"/>
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id('googleplus'); ?>"><?php _e('Google + URL:', 'peekaboo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>"
                   name="<?php echo $this->get_field_name('googleplus'); ?>"
                   value="<?php echo $instance['googleplus']; ?>" type="text"/>
        </p>
		<p>
			<label
				for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram URL:', 'peekaboo'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>"
				   name="<?php echo $this->get_field_name('instagram'); ?>"
				   value="<?php echo $instance['instagram']; ?>" type="text"/>
		</p>


        <p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS URL:', 'peekaboo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>"
                   name="<?php echo $this->get_field_name('rss'); ?>" value="<?php echo $instance['rss']; ?>"
                   type="text"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:', 'peekaboo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>"
                   name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $instance['twitter']; ?>"
                   type="text"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo URL:', 'peekaboo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>"
                   name="<?php echo $this->get_field_name('vimeo'); ?>" value="<?php echo $instance['vimeo']; ?>"
                   type="text"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('Youtube URL:', 'peekaboo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>"
                   name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $instance['youtube']; ?>"
                   type="text"/>
        </p>

    <?php
    }


//	Processes widget options to be saved

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['rss'] = strip_tags($new_instance['rss']);
        $instance['email'] = strip_tags($new_instance['email']);
        $instance['facebook'] = strip_tags($new_instance['facebook']);
        $instance['flickr'] = strip_tags($new_instance['flickr']);
        $instance['googleplus'] = strip_tags($new_instance['googleplus']);
        $instance['instagram'] = strip_tags($new_instance['instagram']);
        $instance['twitter'] = strip_tags($new_instance['twitter']);
        $instance['vimeo'] = strip_tags($new_instance['vimeo']);
        $instance['youtube'] = strip_tags($new_instance['youtube']);
        return $instance;
    }


//	Outputs the content of the widget
    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $rss = $instance['rss'];
        $email = $instance['email'];
        $facebook = $instance['facebook'];
        $flickr = $instance['flickr'];
        $googleplus = $instance['googleplus'];
        $instagram = $instance['instagram'];
        $twitter = $instance['twitter'];
        $vimeo = $instance['vimeo'];
        $youtube = $instance['youtube'];

        echo $before_widget;

        if ($title)
            echo $before_title . $title . $after_title;
        echo '<ul class="social_icons">';
        ?>
        <?php
        if ($rss != '') {
            ?>
            <li><a href="<?php echo $rss; ?>" target="_blank">
                <i class="elusive-rss"></i>
            </a></li><?php
        } else {
            echo '';
        }

        if ($email != '') {
            ?>
            <li><a href="<?php echo $email; ?>" target="_blank">
                <i class="elusive-mail"></i>
            </a></li><?php
        } else {
            echo ''; //If no URL inputed
        }

        if ($facebook != '') {
            ?>
            <li><a href="<?php echo $facebook; ?>" target="_blank">
                <i class="elusive-facebook"></i>
            </a></li><?php
        } else {
            echo ''; //If no URL inputed
        }

        if ($flickr != '') {
            ?>
            <li><a href="<?php echo $flickr; ?>" target="_blank">
                <i class="elusive-flickr"></i>
            </a></li><?php
        } else {
            echo ''; //If no URL inputed
        }

        if ($googleplus != '') {
            ?>
            <li><a href="<?php echo $googleplus; ?>" target="_blank">
                <i class="elusive-googleplus"></i>
            </a></li><?php
        } else {
            echo ''; //If no URL inputed
        }
		if ($instagram != '') {
			?>
			<li><a href="<?php echo $instagram; ?>" target="_blank">
				<i class="elusive-instagram"></i>
			</a></li><?php
		} else {
			echo ''; //If no URL inputed
		}
        if ($twitter != '') {
            ?>
            <li><a href="<?php echo $twitter; ?>" target="_blank">
                <i class="elusive-twitter"></i>
            </a></li><?php
        } else {
            echo ''; //If no URL inputed
        }

        if ($vimeo != '') {
            ?>
            <li><a href="<?php echo $vimeo; ?>" target="_blank">
                <i class="elusive-vimeo"></i>
            </a></li><?php
        } else {
            echo ''; //If no URL inputed
        }

        if ($youtube != '') {
            ?>
            <li><a href="<?php echo $youtube; ?>" target="_blank">
                <i class="elusive-youtube"></i>
            </a></li><?php
        } else {
            echo ''; //If no URL inputed
        }
        echo '</ul>';
        echo $after_widget;
    }
}

?>
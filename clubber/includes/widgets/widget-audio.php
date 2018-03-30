<?php
class Audio_Widget extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function Audio_Widget() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'audio_widget',
            'description' => __('Display your Audio Player.', 'clubber')
        );
        parent::__construct('audio-widget', esc_html__('CLUBBER - Audio Player', 'clubber'), $widget_opts);
    }
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
    /* outputs the content of the widget
     * @args --> The array of form elements*/
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = apply_filters('widget_title', $instance['title']);
        $id    = $instance['id_post'];
        /* before widget */
        echo $before_widget;
        /* display title */
        if ($title)
            echo $before_title . $title . $after_title;
        /* display the widget */
?>
		
	<?php
        global $post;
        $query = new WP_Query();
        $query->query('post_type=audio&p=' . $id . '&posts_per_page=1');
        echo '
    <div class="widgets-col">';
        while ($query->have_posts()):
            $query->the_post();
            $custom         = get_post_custom($post->ID);
            $image_id       = get_post_thumbnail_id();
            $cover          = wp_get_attachment_image_src($image_id, 'audio-widget');
            $genre          = $custom["audio_genre"][0];
            $itunes         = $custom["audio_itunes"][0];
            $amazon         = $custom["audio_amazon"][0];
            $beatport       = $custom["audio_beatport"][0];
            $other          = $custom["audio_other"][0];
            $other_text     = $custom["audio_other_text"][0];
            $soundcloud     = $instance['soundcloud_api'];
            $data_audio     = get_post_meta($post->ID, 'release_date', true);
            $time           = strtotime($data_audio);
            $pretty_date_yy = date('Y', $time);
            $pretty_date_M  = date('M', $time);
            $pretty_date_d  = date('d', $time);
            $args           = array(
                'post_type' => 'attachment',
                'numberposts' => -1,
                'post_status' => null,
                'post_parent' => $post->ID
            );
            $attachments    = get_posts($args);
            $arrImages =& get_children('post_type=attachment&orderby=menu_order&order=DESC&post_mime_type=audio/mpeg&post_parent=' . get_the_ID());
?>

      <div class="widget-audio-cover">
<?php
            if ($image_id) {
                echo '
        <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
            } else {
                echo '
        <img src="' . get_template_directory_uri() . '/images/no-featured/audio-widget.png" alt="no image" />';
            }
?>  

        </div><!-- end .widget-audio-cover -->
      <div class="widget-audio-title">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php if (strlen($post->post_title) > 20) {
echo substr(the_title($before = '', $after = '', FALSE), 0, 20) . '...'; } else { 
the_title();} ?></a>
      </div>

<?php
            echo '
      <ul class="widget-audio-meta">';
            if ($genre != null) {
                echo '
        <li>' . __('Genre', 'clubber') . ': ' . $genre . '</li>';
            }
            if ($data_audio != null) {
                echo '
        <li>' . __('Release date', 'clubber') . ': ' . $pretty_date_d . ' ' . $pretty_date_M . '  ' . $pretty_date_yy . '</li>';
            }
            echo '
      </ul>';
?> 
  
<?php
            if ($amazon != null) {
                echo '
      <div class="widget-audio-buy"><a href="' . $amazon . '">Amazon</a></div>';
            }
            if ($itunes != null) {
                echo '
      <div class="widget-audio-buy"><a href="' . $itunes . '">iTunes</a></div>';
            }
            if ($beatport != null) {
                echo '
      <div class="widget-audio-buy"><a href="' . $beatport . '">Beatport</a></div>';
            }
            if ($other != null) {
                echo '
      <div class="widget-audio-buy"><a href="' . $other . '">' . $other_text . '</a></div>';
            }
?> 
<?php
            $player =null;
            $playlist =null;
            $player .= '
      <div class="audiojsW">
        <audio></audio>
        <div class="play-pauseW">
          <p class="playW"></p>
          <p class="pauseW"></p>
          <p class="loadingW"></p>
          <p class="errorW"></p>
        </div>
        <div class="scrubberW">
          <div class="progressW"></div>
          <div class="loadedW"></div>
        </div>
        <div class="timeW"><em class="playedW">00:00</em>/<strong class="durationW">00:00</strong></div>
        <div class="error-messageW"></div>
      </div><!-- end .audiojsW -->';
            if ($arrImages) {
                foreach ($arrImages as $attachment) {
                    $playlist .= '
          <li><a href="#" data-src="' . wp_get_attachment_url($attachment->ID) . '">' . $attachment->post_title . '</a></li>';
                }
            }
?>

<?php
            if ($playlist != null) {
                echo '' . $player . '
      <div class="widget-play-list">
        <ol>' . $playlist . '
        </ol>
      </div><!-- end .widget-play-list -->';
            }
?>
<?php
            if ($soundcloud != null) {
                echo '
      <div class="widget-soundcloud">
<iframe width="100%" height="166" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F' . $soundcloud . '&show_artwork=true"></iframe>
      </div><!-- end .widget-soundcloud -->';
            }
?>
<?php
            if (have_posts())
                while (have_posts()):
                    the_post();
?>
<?php
                endwhile;
?>
<?php
        endwhile;
        echo '
    </div><!-- .event-widgets-col-->';
        wp_reset_query();
?>

		<?php
        /* after widget */
        echo $after_widget;
    }
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
    function update($new_instance, $old_instance) {
        $instance                   = $old_instance;
        $instance['title']          = strip_tags($new_instance['title']);
        $instance['id_post']        = strip_tags($new_instance['id_post']);
        $instance['soundcloud_api'] = strip_tags($new_instance['soundcloud_api']);
        return $instance;
    }
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
    /* @instance	The array of keys and values for the widget. */
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Audio Player',
            'id_post' => null,
            'soundcloud_api' => null
        ));
        // Display the admin form
?>
        <p>
		<label for="<?php
        echo $this->get_field_id('title');
?>"><?php
        _e('Title:', 'clubber');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('title');
?>" name="<?php
        echo $this->get_field_name('title');
?>" value="<?php
        echo $instance['title'];
?>" />
	</p>
		
	<p>
		<label for="<?php
        echo $this->get_field_id('id_post');
?>"><?php
        _e('Post ID:', 'clubber');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('id_post');
?>" name="<?php
        echo $this->get_field_name('id_post');
?>" value="<?php echo $instance['id_post']; ?>" />
	</p>
	
	<p>
		<label for="<?php
        echo $this->get_field_id('title');
?>"><?php
        _e('(optional) SoundCloud API:', 'clubber');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('soundcloud_api');
?>" name="<?php
        echo $this->get_field_name('soundcloud_api');
?>" value="<?php
        echo $instance['soundcloud_api'];
?>" />
	</p>
	
	<?php
    } // end form
} // end class
add_action('widgets_init', create_function('', 'register_widget("Audio_Widget");'));
?>
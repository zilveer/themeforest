<?php
class Audio_Widget extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function Audio_Widget() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'audio_widget',
            'description' => __('Display your Audio Player.', 'wizedesign')
        );
        $this->WP_Widget('audio-widget', __('SOUNDWAVE - Audio Player', 'wizedesign'), $widget_opts);
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
		$text  = $instance['text'];
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
<div class="widgets-col-player">';
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
			$artist          = $custom["audio_artist"][0];
            $soundcloud     = $instance['soundcloud_api'];
            $data_audio     = get_post_meta($post->ID, 'release_date', true);
            $time           = strtotime($data_audio);
            $pretty_date_yy = date('Y', $time);
            $pretty_date_M  = date('M', $time);
            $pretty_date_d  = date('d', $time);
			$no_cover = get_template_directory_uri();
            $args           = array(
                'post_type' => 'attachment',
                'numberposts' => -1,
                'post_status' => null,
                'post_parent' => $post->ID
            );
            $attachments    = get_posts($args);
            $arrImages =& get_children('post_type=attachment&orderby=menu_order&order=DESC&post_mime_type=audio/mpeg&post_parent=' . get_the_ID());
?>

	<div class="adwdg-cover">
<?php
            if ($image_id) {
                echo '
		<img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
            } else {
                echo '
        <img src="' . $no_cover . '/images/no-cover/audio-wdg.png" alt="no image" />';
            }
?>  
	</div><!-- end .adwdg-cover -->
	<div class="adwdg-title">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php if (strlen($post->post_title) > 23) {
echo substr(the_title($before = '', $after = '', FALSE), 0, 23) . '...'; } else { 
the_title();} ?></a>
	</div>

<?php
            echo '
    <div class="adwdg-info">';
	  	    if ($artist != null) {
                echo '
		<div class="adwdg-artist">' . $artist . '</div>';
            }
			
            if ($genre != null) {
                echo '
        <div class="adwdg-genre">' . $genre . '</div>';
            }
            if ($data_audio != null) {
                echo '
        <div class="adwdg-data">' . $pretty_date_d . ' ' . $pretty_date_M . '  ' . $pretty_date_yy . '</div>';
            }
            echo '
    </div>';
?> 
  
<?php
$player = null;
$playlist = null;
$args        = array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'post_status' => null,
    'post_parent' => $post->ID
);
$attachments = get_posts($args);
$arrImages =& get_children('post_type=attachment&orderby=menu_order&order=DESC&post_mime_type=audio/mpeg&post_parent=' . get_the_ID());

if ($arrImages) {
    foreach ($arrImages as $attachment) {
        $playlist .= '
		<li><a href="' . wp_get_attachment_url($attachment->ID) . '" title="' . $attachment->post_title . '" rel="' . $cover[0] . '" data-meta="#player-meta-widget" class="no-ajax">' . $attachment->post_title . '</a></li>';
    }
}

echo '
    <ul class="fap-my-playlist"> 
' . $playlist . ' 
    </ul>';
?>

	<span id="player-meta-widget">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<div><?php echo ' ' . $pretty_date_d . ' ' . $pretty_date_M . '  ' . $pretty_date_yy . ' | '.$genre.' '; ?></div>
	</span>

<?php
            if ($soundcloud != null) {
                echo '
	<div class="widget-soundcloud">
		<iframe width="100%" height="166" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F' . $soundcloud . '&show_artwork=true"></iframe>
	</div><!-- end .widget-soundcloud -->';
            }
			
            if (have_posts())
                while (have_posts()):
                    the_post();
					
                endwhile;

        endwhile;
		
echo '
	<div class="adwdg-buy-now">
		<div class="adwdg-now">' . $text . '</div>';
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
		echo '
    </div></div><!-- .adwdg-buy-now-->';
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
		$instance['text'] 			= strip_tags($new_instance['text']);
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
        _e('Title:', 'wizedesign');
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
        _e('Post ID:', 'wizedesign');
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
        _e('Text (eg. Buy Now): ', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('text');
?>" name="<?php
        echo $this->get_field_name('text');
?>" value="<?php
        echo $instance['text'];
?>" />
	</p>
	
	<?php
    } // end form
} // end class
add_action('widgets_init', create_function('', 'register_widget("Audio_Widget");'));
?>
<?php

include_once(ABSPATH . WPINC . '/feed.php');

// Defaults
define('PINTEREST_PINBOARD_DEFAULT_USERNAME', 'pinterest');
define('PINTEREST_PINBOARD_DEFAULT_ROWS', 2);
define('PINTEREST_PINBOARD_DEFAULT_COLS', 3);
define('PINTEREST_PINBOARD_DEFAULT_NEW_WINDOW', 0);

// Shortcode definition
define('PINTEREST_PINBOARD_SHORTCODE', 'pinterest_pinboard');

/**
 * Pinterest pinboard class to fetch the pinterest feed
 * and render the HTML pinboard.
 */
class Pinterest_Pinboard {

    // Pinterest url
    var $pinterest_feed_url = 'https://pinterest.com/%s/feed.rss';
    
    // RSS cache lifetime in seconds
    var $cache_lifetime = 900;
    
    var $start_time;

    function Pinterest_Pinboard() {
        $this->start_time = microtime(true);
    }

    // Render the pinboard and output



    function render($username, $rows, $cols, $new_window) {
        $nr_pins = $rows * $cols;
        $pins = $this->get_pins($username, $nr_pins);
        if (is_null($pins)) {
            echo("Unable to load Pinterest pins for '$username'\n");
        } else {
            echo("<div class=\"pinboard\">\n");
            $row = 0;
            $col = 0;
            foreach ($pins as $pin) {
                if ($col == 0) {
                    echo("<div class=\"pin-three clearfix\"><ul>\n");
                }
                $title = $pin['title'];
                $url = $pin['url'];
                $image = $pin['image'];
                echo "<li style=\"background:url($image) no-repeat;\"><a href=\"$url\"";
                if ($new_window) {
                    echo(" target=\"_blank\"");
                }
                echo("></a></li>");
                $col++;
                if ($col >= $cols) {
                    echo("</ul></div>\n");
                    $col = 0;
                    $row++;
                }
            }
        }
        ?>
        </div>
        <div class="pin_link">
            <a class="pin_logo" href="http://pinterest.com/<?php echo($username) ?>/">
                <i class="fa fa-pinterest"></i>
            </a>
            <span class="pin_text"><a href="http://pinterest.com/<?php echo($username) ?>/" <?php if ($new_window) { ?>target="_blank"<?php } ?>><?php echo __("More Pins","2035Themes-fm") ?></a></span>
        </div>
        <?php
        echo($this->get_footer());
    }
    /**
     * Retrieve RSS feed for username, and parse the data needed from it.
     * Returns null on error, otherwise a hash of pins.
     */
    function get_pins($username, $nrpins) {

        // Set caching.
        add_filter('wp_feed_cache_transient_lifetime', create_function('$a', 'return '. $this->cache_lifetime .';'));

        // Get the RSS feed.
        $url = sprintf($this->pinterest_feed_url, $username);
        $rss = fetch_feed($url);
        if (is_wp_error($rss)) {
            return null;
        }
        
        $maxitems = $rss->get_item_quantity($nrpins);
        $rss_items = $rss->get_items(0, $maxitems);
        
        $pins;
        if (is_null($rss_items)) {
            $pins = null;
        } else {
            
            // Build patterns to search/replace in the image urls.
            // Pattern to replace for the images.
            $search = array('_b.jpg');
            $replace = array('_t.jpg');
            // Make urls protocol relative
            array_push($search, 'https://');
            array_push($replace, '//');
            
            $pins = array();
            foreach ($rss_items as $item) {
                $title = $item->get_title();
                $description = $item->get_description();
                $url = $item->get_permalink();
                if (preg_match_all('/<img src="([^"]*)".*>/i', $description, $matches)) {
                    $image = str_replace($search, $replace, $matches[1][0]);
                }
                array_push($pins, array(
                    'title' => $title,
                    'image' => $image,
                    'url' => $url
                ));
            }
        }
        return $pins;
    }
    
    /**
     * Determine the running plugin's version.
     */
    function get_version() {
        $headers = array(
            'Version' => 'Version'
        );
        $plugin_data = get_file_data(__FILE__, $headers);
        $plugin_version = $plugin_data['Version'];
        return $plugin_version;
    }

    /**
     * Render HTML comment footer for debugging purposes.
     */
    function get_footer() {
        $execution_time = (microtime(true) - $this->start_time) * 1e6;
        return '<!-- '.
               'Version: '. $this->get_version() .' // '.
               'Execution Time: '. $execution_time .' (ms) '.
               "-->\n";
    }
    
}

class Pinterest_Pinboard_Widget extends WP_Widget {

    /**
     * Widget settings.
     */
    protected $widget = array(
            // Default title for the widget in the sidebar.
            'title' => 'Recent pins',

            // Default widget settings.
            'username' => PINTEREST_PINBOARD_DEFAULT_USERNAME,
            'rows' => PINTEREST_PINBOARD_DEFAULT_ROWS,
            'cols' => PINTEREST_PINBOARD_DEFAULT_COLS,
            'new_window' => PINTEREST_PINBOARD_DEFAULT_NEW_WINDOW,

            // The widget description used in the admin area.
            'description' => 'Adds a Pinterest Pinboard widget to your sidebar'
    );

    function Pinterest_Pinboard_Widget() {
        $id = str_replace('_', '-', get_class($this));
        parent::WP_Widget(
                $id,
                '[ CUSTOM ] Pinterest Pinboard',
                $options = array(
                    'description' => $this->widget['description']
                )
        );
    }
    
    function form($instance) {
        // load current values or set to default.
        $title = array_key_exists('title', $instance) ? esc_attr($instance['title']) : $this->widget['title'];
        $username = array_key_exists('username', $instance) ? esc_attr($instance['username']) : $this->widget['username'];
        $cols = array_key_exists('cols', $instance) ? esc_attr($instance['cols']) : $this->widget['cols'];
        $rows = array_key_exists('rows', $instance) ? esc_attr($instance['rows']) : $this->widget['rows'];
        $new_window = array_key_exists('new_window', $instance) ? esc_attr($instance['new_window']) : $this->widget['new_window'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:','2035Themes-fm'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('username'); ?>"><?php echo __('Username:','2035Themes-fm'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('cols'); ?>"><?php echo __('Nr. of pins wide:','2035Themes-fm'); ?></label>
            <input id="<?php echo $this->get_field_id('cols'); ?>" name="<?php echo $this->get_field_name('cols'); ?>" type="text" value="<?php echo $cols; ?>" size="3" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('rows'); ?>"><?php echo __('Nr. of pins tall:','2035Themes-fm'); ?></label>
            <input id="<?php echo $this->get_field_id('rows'); ?>" name="<?php echo $this->get_field_name('rows'); ?>" type="text" value="<?php echo $rows; ?>" size="3" />
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('new_window'); ?>" name="<?php echo $this->get_field_name('new_window'); ?>" type="checkbox" <?php if ($new_window) { ?>checked="checked" <?php } ?> />
            <label for="<?php echo $this->get_field_id('new_window'); ?>"><?php echo __('Open links in a new window?','2035Themes-fm'); ?></label>
        </p>        
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['username'] = strip_tags($new_instance['username']);
        $instance['rows'] = strip_tags($new_instance['rows']);
        $instance['cols'] = strip_tags($new_instance['cols']);
        $instance['new_window'] = isset($new_instance['new_window']) ? 1 : 0;
        return $instance;
    }
    
    function widget($args, $instance) {
        extract($args);
        echo($before_widget);
        $title = apply_filters('widget_title', $instance['title']);
        echo($before_title . __($title) . $after_title);
        echo("<div id=\"pinterest-pinboard-widget-container\">\n");

        // Render the pinboard from the widget settings.
        $username = $instance['username'];
        $rows = $instance['rows'];
        $cols = $instance['cols'];
        $new_window = $instance['new_window'];
    
        $pinboard = new Pinterest_Pinboard();
        $pinboard->render($username, $rows, $cols, $new_window);

        echo("</div>");
        echo($after_widget);
    }

}

// Register the widget.
add_action('widgets_init', create_function('', 'return register_widget("Pinterest_Pinboard_Widget");'));


// Register shortcode
function pinterest_pinboard_widget_shortcode($atts) {

    $a = shortcode_atts(array(
            'username'     => PINTEREST_PINBOARD_DEFAULT_USERNAME,
            'rows'         => PINTEREST_PINBOARD_DEFAULT_ROWS,
            'cols'         => PINTEREST_PINBOARD_DEFAULT_COLS,
            'new_window'   => PINTEREST_PINBOARD_DEFAULT_NEW_WINDOW
        ), $atts, PINTEREST_PINBOARD_SHORTCODE
    );

    ob_start();
    $pinboard = new Pinterest_Pinboard();
    $pinboard->render($a['username'], $a['rows'], $a['cols'], $a['new_window']);
    $html = ob_get_clean();
    return "<div id=\"pinterest-pinboard-container\">$html</div>\n";
}
add_shortcode(PINTEREST_PINBOARD_SHORTCODE, 'pinterest_pinboard_widget_shortcode');

?>

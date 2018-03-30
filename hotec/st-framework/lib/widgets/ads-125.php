<?php

/**
 * @author Kien T. - http://www.smooththemes.com
 * @copyright 2012
 */

class STWidget125 extends WP_Widget {
    
       public static $NUM_ADS = 8;

    function __construct()
    {

        parent::__construct(
            'stwidget125', // Base ID
            __('ST Ads 125x125', 'smooththemes'), // Name
            array('description' => __('A widget that allows the display of ads 125x125', 'smooththemes'),) // Args
        );

    }

    function widget($args, $instance)
    {
        // prints the widget
        extract($args);

        //variables from widget setting
        $title = apply_filters('widget_title', $instance['title']);

        // Ads 125x125 Images Link
        $ads_img1 = $instance['ads_img1'];
        $ads_img2 = $instance['ads_img2'];
        $ads_img3 = $instance['ads_img3'];
        $ads_img4 = $instance['ads_img4'];
        $ads_img5 = $instance['ads_img5'];
        $ads_img6 = $instance['ads_img6'];
        $ads_img7 = $instance['ads_img7'];
        $ads_img8 = $instance['ads_img8'];

        // Ads link
        $link1 = $instance['link1'];
        $link2 = $instance['link2'];
        $link3 = $instance['link3'];
        $link4 = $instance['link4'];
        $link5 = $instance['link5'];
        $link6 = $instance['link6'];
        $link7 = $instance['link7'];
        $link8 = $instance['link8'];

        // Random ads
        $randomize = $instance['random'];


        // Before Widget :
        echo $before_widget;

        // Display Widget Title if one was input .
        if ($title)
            echo $before_title . $title . $after_title; // Before_title and After_title define by theme .

        // Randomize ads
        $random_ads = array();

        // Display Ads
        echo '<div class="ads125"><ul>'; // Containing DIV

        for ($i = 1; $i <= self::$NUM_ADS; $i++) {
            if ($instance['ads_img' . $i] != '') {
                if ($instance['link' . $i] != '') {
                    $random_ads[] = '<li><a href="' . esc_attr($instance['link' . $i]) . '"><img src="' . esc_attr($instance['ads_img' . $i]) . '" width="125" height="125" alt="" /></a></li>';
                } else {
                    $random_ads[] = '<li><img src="' . esc_attr($instance['ads_img' . $i]) . '" width="125" height="125" alt="" /></li>';
                }
            }
        }

        //Randomize order if user want it
        if ($randomize) {
            shuffle($random_ads);
        }

        //Display ads
        foreach ($random_ads as $random_ad) {
            echo $random_ad;
        }

        echo '</ul></div><div class="clear"></div>'; // end Containing DIV

        // After Widget
        echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        //save the widget
        $instance = $old_instance;

        // Only text inputs
        $instance['title'] = strip_tags($new_instance['title']);

        for ($i = 1; $i <= self::$NUM_ADS; $i++) {
            $instance['ads_img' . $i] = $new_instance['ads_img' . $i];
            $instance['link' . $i] = $new_instance['link' . $i];
        }

        $instance['random'] = $new_instance['random'];

        return $instance;
    }
          
    function form($instance) {
        //widgetform in backend

        //default widget settings.
        $defaults_setting = array(
        'title' => '',
        'random' => false
        );

        for($i=1; $i<=self::$NUM_ADS; $i++){
            $defaults_setting['ads_img'.$i]='';
            $defaults_setting['link'.$i]='';
        }

        $instance = wp_parse_args( (array) $instance, $defaults_setting );
        ?>

        <!-- Widget Title -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'smooththemes') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        <?php for($i=1; $i<=self::$NUM_ADS; $i++){
        ?>
        <div  style="border: 1px solid #ccc; padding: 5px; margin: 7px 0px;">
            <div>
                <label for="<?php echo $this->get_field_id( 'ads_img'.$i ); ?>"><?php printf(__('Ads %d image url:','smooththemes'),$i); ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'ads_img'.$i ); ?>" name="<?php echo $this->get_field_name( 'ads_img'.$i ); ?>" value="<?php echo esc_attr($instance['ads_img'.$i]); ?>" />
            </div>
            <div>
                <label for="<?php echo $this->get_field_id( 'link'.$i ); ?>"><?php  printf(__('Ads %d link:','smooththemes'),$i) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'link'.$i ); ?>" name="<?php echo $this->get_field_name( 'link'.$i ); ?>" value="<?php echo esc_attr($instance['link'.$i]); ?>" />
            </div>
        </div>
        <?php
    } ?>

    <!-- Randomize -->
    <p>
        <?php if ($instance['random']){ ?>
        <input type="checkbox" id="<?php echo $this->get_field_id( 'random' ); ?>" name="<?php echo $this->get_field_name( 'random' ); ?>" checked="checked" />
        <?php } else { ?>
        <input type="checkbox" id="<?php echo $this->get_field_id( 'random' ); ?>" name="<?php echo $this->get_field_name( 'random' ); ?>"  />
        <?php } ?>
        <label for="<?php echo $this->get_field_id( 'random' ); ?>"><?php _e('Randomize ads ?', 'smooththemes') ?></label>
    </p>

    <?php
    }
}
     
    
register_widget( 'STWidget125' );

<?php
/**
 * Custom widgets for astrum theme
 *
 *
 * @package CP
 * @since Astrum 1.0
 */

add_action('widgets_init', 'purepress_load_widgets'); // Loads widgets here

function purepress_load_widgets() {
    register_widget('purepress_recent');
    register_widget('purepress_share');
}

class purepress_recent extends WP_Widget {

    function purepress_recent() {
        $widget_ops = array('classname' => 'purepress-recent', 'description' => 'CP Recent posts');
        $control_ops = array('width' => 300, 'height' => 350);
        $this->WP_Widget('purepress_recent', 'CP Recent posts', $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $category = $instance['category'];
        $orderby = $instance['orderby'];
        $number = $instance['number'];
        echo $before_widget;

        if ( !empty( $title ) ) {
            echo $before_title . $title . $after_title;
        };
        echo "<ul>";
        echo self::showLatest($number, $orderby, $category);
        echo "</ul>";
        echo $after_widget;
    }


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['category'] = strip_tags($new_instance['category']);
        $instance['orderby'] = strip_tags($new_instance['orderby']);
        $instance['number'] = strip_tags($new_instance['number']);

        return $instance;
    }

    function form($instance) {
       $instance = wp_parse_args(
        (array) $instance
        );
       $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
       $category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
       $orderby = isset( $instance['orderby'] ) ? esc_attr( $instance['orderby'] ) : '';
       $number = isset( $instance['number'] ) ? esc_attr( $instance['number'] ) : '';
       ?>
       <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">Title:
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">How many posts? (type only number):
                <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" /></label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('orderby'); ?>">Order posts by:
                    <select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
                        <option <?php if($orderby == 'date') echo 'selected="selected"'; ?> value="date">Date</option>
                        <option <?php if($orderby == 'rand') echo 'selected="selected"'; ?> value="rand">Random</option>
                        <option <?php if($orderby == 'title') echo 'selected="selected"'; ?> value="title">Title</option>
                    </select>
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('category'); ?>">Choose category:
                 <select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
                    <?php
                    $categories = get_categories();
                    $cats = self::get_cats($categories);
                    foreach ($cats as $cat=>$catnr) { ?>
                    <option <?php if ($category == $cat)  echo 'selected="selected"';  ?> value="<?php echo $cat; ?>"><?php echo $catnr; ?></option>
                    <?php } ?>
                    <option <?php if ($category == 'all')  echo ' selected="selected"';  ?> value="all">All categories</option>
                </select>
            </label>
        </p>
        <?php
    }

    /**
     * Display Latest posts
     */
    static function showLatest( $posts = 3, $orderby = 'post_date', $category = 'all' ) {
        global $post;
        if($category=='all'){
            $latest = get_posts(
                array(
                    'suppress_filters' => false,
                    'ignore_sticky_posts' => 1,
                    'orderby' => $orderby,
                    'order' => 'desc',
                    'numberposts' => $posts )
                );
        } else {
            $latest = get_posts(
                array(
                    'cat' => $category,
                    'suppress_filters' => false,
                    'ignore_sticky_posts' => 1,
                    'orderby' => $orderby,
                    'order' => 'desc',
                    'numberposts' => $posts )
                );
        }
        ob_start();

        $date_format = get_option('date_format');
        foreach($latest as $post) :
            setup_postdata($post);
        ?>

        <!-- Post #1 -->
        <li>
            <?php if ( has_post_thumbnail() ) { ?>
            <div class="widget-thumb">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('slider-thumb'); ?></a>
            </div>
            <?php } ?>

            <div class="widget-text">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <span><?php echo get_the_date(); ?></span>
            </div>
            <div class="clearfix"></div>
        </li>

        <?php endforeach;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

    static function get_cats($val) {
        $result = array();
        $result[] = "None";
        foreach ($val as $key => $object) {
            $result[$object->cat_ID] = $object->category_nicename;
        }
        return $result;
    }

} //eof purepress_recent



class purepress_share extends WP_Widget {

    function purepress_share() {
        $widget_ops = array('classname' => 'purepress-share', 'description' => 'CP Share widget');
        $control_ops = array('width' => 300, 'height' => 350);
        $this->WP_Widget('purepress_share', 'CP Share widget', $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $gplus = $instance['gplus'];
        $twitter = $instance['twitter'];
        $pinterest = $instance['pinterest'];
        $facebook = $instance['facebook'];
        $short = $instance['short'];

        echo $before_widget;
        if ( !empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }; ?>
        <?php if($short) { ?>
        <div>
           <?php _e( 'Shortlink:', 'purepress' ); ?>
                <input type='text' value='<?php echo wp_get_shortlink(get_the_ID()); ?>' onclick='this.focus(); this.select();' />

        </div>
        <?php } ?>
        <ul>
            <?php if($gplus) { ?>
            <li id="share-gplus">
                <div class="g-plusone" data-size="tall"></div>
                <!-- Place this tag after the last +1 button tag. -->
                <script type="text/javascript">
                  (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/platform.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                  })();
                </script>
            </li>
            <?php } ?>
            <?php if($twitter) { ?>
            <li id="share-twitter">
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php if (is_single()) { the_permalink(); } else { echo home_url(); } ?>" data-via="<?php bloginfo('name') ?>" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </li>
            <?php } ?>
            <?php if($pinterest) { ?>
            <li id="share-pinterest">
                <a href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" data-pin-height="40" data-pin-config="above"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
                <script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
            </li>
            <?php } ?>
            <?php if($facebook) { ?>
            <li id="share-facebook">
                <div class="fb-like" data-href="<?php if (is_single()) { the_permalink(); } else { echo home_url(); } ?>" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>
            </li>
            <?php } ?>
        </ul>

        <?php echo $after_widget;
    }


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['gplus'] = ! empty($new_instance['gplus']);
        $instance['twitter'] = ! empty($new_instance['twitter']);
        $instance['pinterest'] = ! empty($new_instance['pinterest']);
        $instance['facebook'] = ! empty($new_instance['facebook']);
        $instance['short'] = ! empty($new_instance['short']);


        return $instance;
    }

    function form($instance) {
       $instance = wp_parse_args(
        (array) $instance
        );
       $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
       $gplus = isset( $instance['gplus'] ) ? esc_attr( $instance['gplus'] ) : '';
       $twitter = isset( $instance['twitter'] ) ? esc_attr( $instance['twitter'] ) : '';
       $pinterest = isset( $instance['pinterest'] ) ? esc_attr( $instance['pinterest'] ) : '';
       $facebook = isset( $instance['facebook'] ) ? esc_attr( $instance['facebook'] ) : '';
       $short = isset( $instance['short'] ) ? esc_attr( $instance['short'] ) : '';

       ?>
        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">Title:
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
        </p>
       <p> Select which social elements should be displayed in this widget: <br/>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('short'); ?>" name="<?php echo $this->get_field_name('short'); ?>" <?php echo  checked($short, true, false); ?> />
            <label for="<?php echo $this->get_field_id('short'); ?>"><?php echo  __('URL shortener.', 'purepress'); ?></label>
            <br/>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('gplus'); ?>" name="<?php echo $this->get_field_name('gplus'); ?>" <?php echo  checked($gplus, true, false); ?> />
            <label for="<?php echo $this->get_field_id('gplus'); ?>"><?php echo  __('Google plus button.', 'purepress'); ?></label>
            <br/>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" <?php echo  checked($twitter, true, false); ?> />
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php echo  __('Twitter button.', 'purepress'); ?></label>
            <br/>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" <?php echo  checked($pinterest, true, false); ?> />
            <label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php echo  __('Pinterest button.', 'purepress'); ?></label>
            <br/>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" <?php echo  checked($facebook, true, false); ?> />
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php echo  __('Facebook button.', 'purepress'); ?></label>
       </p>

        <?php
    }

} //eof purepress_recent
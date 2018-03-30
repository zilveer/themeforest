<?php

//TODO latest posts with thumbnail


add_action('widgets_init', 'centum_load_widgets');

    function centum_load_widgets() {

        register_widget('incredible_flickr');
       // register_widget('incredible_popular');
        register_widget('incredible_latest');
        register_widget('centum_twitter_widget');

        //register_widget('incredible_followers_widget');

    }

    function image_from_description($data) {
        preg_match_all('/<img src="([^"]*)"([^>]*)>/i', $data, $matches);
        return $matches[1][0];
    }

     function select_image($img, $size) {
        $img = explode('/', $img);
        $filename = array_pop($img);

    // The sizes listed here are the ones Flickr provides by default.  Pass the array index in the        $size variable to selct one.
    // 0 for square, 1 for thumb, 2 for small, etc.
            $s = array(
                        '_s.', // square
                        '_t.', // thumb
                        '_m.', // small
                        '.',   // medium
                        '_b.'  // large
                );

            $img[] = preg_replace('/(_(s|t|m|b))?\./i', $s[$size], $filename);
            return implode('/', $img);
        }

class incredible_flickr extends WP_Widget {

    function incredible_flickr() {
        $widget_ops = array('classname' => 'incredible-flickr', 'description' => 'Widget for popular posts');
        $control_ops = array('width' => 300);
        parent::__construct('incredible_flickr', 'Centum Flickr', $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        echo $before_widget;
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $count = $instance['count'];
       
        if (!empty($title)) {
            echo '<div class="headline no-margin"><h4>'.$title.'</h4></div>' ;
        };

        if ($instance['type'] == "user") { 
            if(!empty($instance['tags'])){
                $rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?id=' . $instance['id'] . '&format=rss_200'; 
            } else {
                $rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?id=' . $instance['id'] . '&tags=' . $instance['tags'] . '&format=rss_200'; 
            }
        } elseif ($instance['type'] == "favorite") { 
            $rss_url = 'http://api.flickr.com/services/feeds/photos_faves.gne?id=' . $instance['id'] . '&format=rss_200'; 
        } elseif ($instance['type'] == "set") { 
            $rss_url = 'http://api.flickr.com/services/feeds/photoset.gne?set=' . $instance['set'] . '&nsid=' . $instance['id'] . '&format=rss_200'; 
        } elseif ($instance['type'] == "group") { 
            $rss_url = 'http://api.flickr.com/services/feeds/groups_pool.gne?id=' . $instance['id'] . '&format=rss_200'; 
        } elseif ($instance['type'] == "public" || $instance['type'] == "community") {
            $rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?tags=' . $instance['tags'] . '&format=rss_200'; 
        } else {
            echo '<strong>No "type" parameter has been setup. Check your flickr widget settings.</strong>';
        }


            // Check if another plugin is using RSS, may not work
        include_once (ABSPATH . WPINC . '/class-simplepie.php');
        error_reporting(E_ERROR);
        $feed = new SimplePie($rss_url);
        $feed->handle_content_type();

        //$items = array_slice($rss->items, 0, $instance['count']);

        $print_flickr = '<div class="flickr-widget"><ul>';

        $i = 0;
        foreach ($feed->get_items() as $item):

        if(++$i > $count)
            break;

        if ($enclosure = $item->get_enclosure()) {
            $img = image_from_description($item->get_description());
            $thumb_url = select_image($img, 0);
            $full_url = select_image($img, 4);
            $print_flickr .= '<li><a  href="' .$item->get_link() . '" title="'. $enclosure->get_title(). '"><img alt="'. $enclosure->get_title().'" id="photo_' . $i . '" src="' . $thumb_url . '" /></a></li>'."\n";
        }
        endforeach;



        echo $print_flickr.'</ul></div>';
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['count'] = $new_instance['count'];
        $instance['type'] = $new_instance['type'];
        $instance['id'] = $new_instance['id'];
        $instance['set'] = $new_instance['set'];
        $instance['tags'] = $new_instance['tags'];


        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => ''));
        $title = strip_tags($instance['title']);
        $count = $instance['count'];
        $type = $instance['type'];
        $id = $instance['id'];
        $set = $instance['set'];
        $tags = $instance['tags'];

        ?>


        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('type'); ?>">Display photos from</label>
            <select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" id="type">
                <option <?php if($instance['type'] == 'user') { echo 'selected'; } ?> value="user">user</option>
                <option <?php if($instance['type'] == 'set') { echo 'selected'; } ?> value="set">set</option>
                <option <?php if($instance['type'] == 'favorite') { echo 'selected'; } ?> value="favorite">favorite</option>
                <option <?php if($instance['type'] == 'group') { echo 'selected'; } ?> value="group">group</option>
                <option <?php if($instance['type'] == 'public') { echo 'selected'; } ?> value="public">community</option>
            </select>
        </p>


        <p>
            <label for="<?php echo $this->get_field_id('id'); ?>">User or Group ID (<a href="http://idgettr.com/">find ID</a>)</label>
            <input  id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" size="20" />

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('set'); ?>">Set ID (<a href="http://idgettr.com/">find your ID</a> )</label>
            <input  id="<?php echo $this->get_field_id('set'); ?>" name="<?php echo $this->get_field_name('set'); ?>"  type="text"  value="<?php echo $set; ?>" size="40" />

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('tags'); ?>">Tags (optional) <small>Comma separated, no spaces</small> </label>
            <input  id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>"  type="text" value="<?php echo $tags; ?>" size="40" />

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>">How many photos?
                <select class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" >
                    <?php for ($i=1; $i<=20; $i++) { ?>
                    <option <?php if ($count == $i) { echo 'selected'; } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </label>
        </p>

        <?php
    }

}







/**
 * Twitter widget Nevia
 *
 * @since 1.0
 * TODO: update for API 1.1
 */
class centum_twitter_widget extends WP_Widget {

//  class pu_tweet_widget extends WP_Widget {
    private $twitter_title = "Twitter";
    private $twitter_username = "purethemes";
    private $twitter_postcount = "1";
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'centum_twitter_widget',      // Base ID
            'Centum Twitter Widget',       // Name
            array(
                'classname'     =>  'centum_twitter_widget',
                'description'   =>  __('A widget that displays your latest tweets.', 'framework')
            )
        );
        // Load JavaScript and stylesheets
        $this->register_scripts_and_styles();
    } // end constructor
    /**
     * Registers and enqueues stylesheets for the administration panel and the
     * public facing site.
     */
    public function register_scripts_and_styles() {
    } // end register_scripts_and_styles

    function retrieve_tweets( $widget_id, $instance ) {
        global $cb;
        $timeline = $cb->statuses_userTimeline( 'screen_name=' . $instance['username']. '&count=' . $instance['postcount'] . '&exclude_replies=true' );
        return $timeline;
    }
    function save_tweets( $widget_id, $instance ) {
        $timeline = $this->retrieve_tweets( $widget_id, $instance );
        $tweets = array( 'tweets' => $timeline, 'update_time' => time() + ( 60 * 5 ) );
        update_option( 'nevia_tweets_' . $widget_id, $tweets );
        return $tweets;
    }
    function get_tweets( $widget_id, $instance ) {
        $tweets = get_option( 'nevia_tweets_' . $widget_id );
        if( empty( $tweets ) OR time() > $tweets['update_time'] ) {
            $tweets = $this->save_tweets( $widget_id, $instance );
        }
        return $tweets;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
         extract( $args );
        /* Our variables from the widget settings. */
        $this->twitter_title = apply_filters('widget_title', $instance['title'] );
        $this->twitter_username = $instance['username'];
        $this->twitter_postcount = $instance['postcount'];
        //$this->twitter_follow_text = $instance['tweettext'];
        $transName = 'list_tweets';
        $cacheTime = 20;

        /* Before widget (defined by themes). */
        echo $before_widget;
         if ( $this->twitter_title )
            echo $before_title . $this->twitter_title . $after_title;
        $consumer_key = ot_get_option('pp_twitter_ck');
        if(!empty($consumer_key)){
            echo ' <div class="twitter_box">';
            $tweets = $this->get_tweets( $args['widget_id'], $instance );
            if( !empty( $tweets['tweets'] ) AND empty( $tweets['tweets']->errors ) ) {

                $user = current( $tweets['tweets'] );
                $user = $user->user;
              /*echo '
                    <div class="twitter-profile">
                    <img id="twitter-av" src="' . $user->profile_image_url . '">
                    <h3><a class="heading-text-color" href="http://twitter.com/' . $user->screen_name . '">' . $user->screen_name . '</a></h3>
                    <div class="description content">' . $user->description . '</div>
                    </div>  ';*/

                echo '<ul id="twitter">';
                foreach( $tweets['tweets'] as $tweet ) {
                    if( is_object( $tweet ) ) {
                        $tweet_text = htmlentities($tweet->text, ENT_QUOTES);
                        $tweet_text = preg_replace( '/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', 'http://$1', $tweet_text );
                        echo '
                            <li class="twitter-item">
                                <span class="content">' . $this->encode_tweet($this->hyperlinks($tweet_text)) . '</span></br>
                                <b class="date"><a>' . human_time_diff( strtotime( $tweet->created_at ) ) . ' ago </a></b>
                            </li>';
                    }
                }
                echo '</ul><div class="clearfix"></div>';
            }
            echo '</div>';
        } else {
            echo "Please first add your API keys in Theme Options -> Twitter oAuth.";
        }
        /* After widget (defined by themes). */
        echo $after_widget;

    }
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        // Strip tags to remove HTML (important for text inputs)
        foreach($new_instance as $k => $v){
            $instance[$k] = strip_tags($v);
        }
        return $instance;
    }
    /**
     * Create the form for the Widget admin
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    function form( $instance ) {
        /* Set up some default widget settings. */
        $defaults = array(
        'title' => $this->twitter_title,
        'username' => $this->twitter_username,
        'postcount' => $this->twitter_postcount,
        //'tweettext' => $this->twitter_follow_text,
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <!-- Widget Title: Text Input -->

            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />

        <!-- Username: Text Input -->

            <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username e.g. purethemes', 'framework') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />

        <!-- Postcount: Text Input -->

            <label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of tweets (max 20)', 'framework') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />

        <!-- Tweettext: Text Input -->


    <?php
    }
    /**
     * Find links and create the hyperlinks
     */
    private function hyperlinks($text) {
        $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
        $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
        // match name@address
        $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
            //mach #trendingtopics. Props to Michael Voigt
        $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
        return $text;
    }
    /**
     * Find twitter usernames and link to them
     */
    private function twitter_users($text) {
           $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
           return $text;
    }
        /**
         * Encode single quotes in your tweets
         */
        private function encode_tweet($text) {
                $text = mb_convert_encoding( $text, "HTML-ENTITIES", "UTF-8");
                return $text;
        }
 }



    class incredible_followers_widget extends WP_Widget {

        function incredible_followers_widget() {
            $widget_ops = array('classname' => 'inc-followers', 'description' => 'Displays number of twitter and feedburner followers');
            $control_ops = array('width' => 300, 'height' => 350);
            parent::__construct('incredible_followers_widget', 'IncredibleWP Followers Widget', $widget_ops, $control_ops);
        }

        function widget($args, $instance) {
            extract($args, EXTR_SKIP);

            $twitter = $instance['twitter'];
            $rss = $instance['rss'];
            $rssman = $instance['rssman'];


            echo $before_widget;
            ?>

            <?php if($twitter) { ?>
            <div class="widget social">
                <div class="social-blog tooltips">
                    <a href="https://twitter.com/#!/<?php echo $twitter; ?>" rel="tooltip" title="Follow on Twitter" class="feed">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/social_icons/twitter.png" alt="Twitter" />
                        <p><?php echo rarst_twitter_user($twitter, 'followers_count'); ?> <br/><span>Followers</span></p>
                    </a>
                </div>
                <?php }

                if($rss) { ?>
                <div class="social-blog tooltips">
                    <a href="http://feeds.feedburner.com/<?php echo $rss; ?>" rel="tooltip" title="Join RSS Feed" class="feed">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/social_icons/rss.png" alt="RSS" />

                        <p><?php if($rssman) { echo $rssman; } else { echo getRssCount($rss); } ?> <br/><span>Subscribers</span></p>

                    </a>
                </div>
            </div>



            <?php
        }
        echo $after_widget;
    }


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['twitter'] = $new_instance['twitter'];
        $instance['rss'] = $new_instance['rss'];
        $instance['rssman'] = $new_instance['rssman'];

        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => ''));
        $twitter = strip_tags($instance['twitter']);
        $rss = strip_tags($instance['rss']);
        $rssman = strip_tags($instance['rssman']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter', 'cloudfw'); ?>:
                <input  id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" size="20" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('Feedburner', 'cloudfw'); ?>:
                <input  id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $rss; ?>" size="20" />
            </label>
        </p>
        <p>It could happened for many reasons that you're hosting won't allow cURL or any other way to get data from Feedburner, in that case you might want to put number of followers manually</p>
        <p>
            <label for="<?php echo $this->get_field_id('rssman'); ?>"><?php _e('Feedburner manual number', 'cloudfw'); ?>:
                <input  id="<?php echo $this->get_field_id('rssman'); ?>" name="<?php echo $this->get_field_name('rssman'); ?>" type="text" value="<?php echo $rssman; ?>" size="20" />
            </label>
        </p>


        <?php
    }


}



class incredible_popular extends WP_Widget {

    function incredible_popular() {
        $widget_ops = array('classname' => 'incredible-popular', 'description' => 'IncredibleWP popular/recent posts');
        $control_ops = array('width' => 300);
        parent::__construct('incredible_popular', 'IncredibleWP Popular Posts', $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        echo $before_widget;
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $title2 = $instance['title2'];
        $count = $instance['count'];
        $orderby = $instance['orderby'];

        wp_reset_query();
        rewind_posts();
        query_posts(
            array(
                'posts_per_page' => $count,
                'post_status' => 'publish',
                'gdsr_sort' => 'rating',
                'nopaging' => 0,
                'post__not_in' => get_option('sticky_posts'),
                'gdsr_order' => 'desc'
                )
            );
            ?>
            <ul class="tabs-nav">
                <li class="active"><a href="#tab1"><?php if($title) {echo $title;} else { echo "Popular";} ?></a></li>
                <li><a href="#tab2"><?php if($title2) {echo $title2;} else { echo "Recent";} ?></a></li>
            </ul>
            <?php
            $postnum = 0;
            echo '<div class="tabs-container">
            <div class="tab-content" id="tab1">';
            if (have_posts()) :while (have_posts()) : the_post();

            $postnum++;
            $class = ( $postnum % 2 ) ? ' even' : ' odd';
            ?>
            <div class="latest-post-blog">
                <a href="<?php the_permalink() ?>"> <?php the_post_thumbnail('small-thumb'); ?></a>
                <p><a class="link" href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
                <span><?php echo get_the_date();?></span>
            </div>
            <?php
            endwhile;
            endif;
            wp_reset_query();
            rewind_posts();
            echo '</div><div class="tab-content" id="tab2">';
            $recent_posts = new WP_Query(
                array(
                    'posts_per_page' => $count,
                    'post_status' => 'publish',
                    'nopaging' => 0,
                    'post__not_in' => get_option('sticky_posts')
                    )
                );
            $postnum = 0;
            if ($recent_posts->have_posts()) :while ($recent_posts->have_posts()) : $recent_posts->the_post();
            $postnum++;
            $class = ( $postnum % 2 ) ? ' even' : ' odd';
            ?>
            <div class="latest-post-blog">
                <a href="<?php the_permalink() ?>"> <?php the_post_thumbnail('small-thumb'); ?></a>
                <p><a class="link" href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
                <span><?php echo get_the_date();?></span>
            </div>
            <?php
            endwhile;
            endif;
            wp_reset_query();
            rewind_posts();
            echo '</div></div>';
            echo $after_widget;
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['title2'] = $new_instance['title2'];
            $instance['count'] = $new_instance['count'];

            return $instance;
        }

        function form($instance) {
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $title = strip_tags($instance['title']);
            $title2 = $instance['title2'];
            $count = $instance['count'];
            ?>


            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">Recent posts title:
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('title2'); ?>">Popular posts title:
                    <input class="widefat" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo esc_attr($title2); ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('count'); ?>">How many posts? (type only number):
                    <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
                </label>
            </p>

            <?php
        }

    }


    class incredible_latest extends WP_Widget {

        function incredible_latest() {
            $widget_ops = array('classname' => 'incredible-latest', 'description' => 'CentumWP recent posts');
            $control_ops = array('width' => 300);
            parent::__construct('incredible_latest', 'CentumWP Recent Posts', $widget_ops, $control_ops);
        }

        function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            echo $before_widget;
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
            $count = $instance['count'];

            echo $before_title . $title . $after_title;
            wp_reset_query();
            rewind_posts();

            $recent_posts = new WP_Query(
                array(
                    'posts_per_page' => $count,
                    'post_status' => 'publish',
                    'nopaging' => 0,
                    'post__not_in' => get_option('sticky_posts')
                    )
                );
            $postnum = 0;
            if ($recent_posts->have_posts()) :while ($recent_posts->have_posts()) : $recent_posts->the_post();
            $postnum++;
            $class = ( $postnum % 2 ) ? ' even' : ' odd';
            ?>

            <div class="latest-post-blog <?php if(!has_post_thumbnail()) echo "no-thumb" ?>">
                <a href="<?php the_permalink() ?>"> <?php the_post_thumbnail('small-thumb'); ?></a>
                <p><a class="link" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                    <span><?php echo get_the_date();?></span></p>
                </div>
                <?php
                endwhile;
                endif;
                wp_reset_query();
                rewind_posts();

                echo $after_widget;
            }

            function update($new_instance, $old_instance) {
                $instance = $old_instance;
                $instance['title'] = strip_tags($new_instance['title']);

                $instance['count'] = $new_instance['count'];

                return $instance;
            }

            function form($instance) {
                $instance = wp_parse_args((array) $instance, array('title' => ''));
                $title = strip_tags($instance['title']);

                $count = $instance['count'];
                ?>


                <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>">Title:
                        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                    </label>
                </p>

                <p>
                    <label for="<?php echo $this->get_field_id('count'); ?>">How many posts? (type only number):
                        <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
                    </label>
                </p>

                <?php
            }

        }

        ?>
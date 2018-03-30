<?php

   /**
    *
    * load internationalizations
    * 
    */

    load_theme_textdomain( 'martanian', get_template_directory() .'/_lang' );
    
   /**
    *
    * add some elements to wp_head()
    * 
    */  
    
    add_action( 'wp_enqueue_scripts', 'martanian_script_enqueuer' );
    function martanian_script_enqueuer() {
        
        # jQuery
        wp_enqueue_script( 'jquery' );
        
        # jQuery UI
        wp_register_script( 'jquery-ui', get_template_directory_uri() .'/_assets/_libs/jquery-ui/js/jquery-ui-1.10.3.custom.js', array(), '', true );
        wp_enqueue_script( 'jquery-ui' );
    
        # easing
        wp_register_script( 'easing', get_template_directory_uri() .'/_assets/_libs/easing/easing.js', array(), '', true );
        wp_enqueue_script( 'easing' );
        
        # jQuery cycle
        wp_register_script( 'jquery-cycle', get_template_directory_uri() .'/_assets/_libs/cycle/cycle.js', array(), '', true );
        wp_enqueue_script( 'jquery-cycle' );
    
        # jQuery cycle
        wp_register_script( 'isotope', get_template_directory_uri() .'/_assets/_libs/isotope/isotope.js', array(), '', true );
        wp_enqueue_script( 'isotope' );
        
        # custom gallery plugin
        wp_register_script( 'martanian-gallery', get_template_directory_uri() .'/_assets/_js/gallery.js', array(), '', true );
        wp_enqueue_script( 'martanian-gallery' );

        # other custom functions
        wp_register_script( 'martanian-functions', get_template_directory_uri() .'/_assets/_js/functions.js', array(), '', true );
        wp_enqueue_script( 'martanian-functions' ); 

  		  # main css style
        wp_register_style( 'martanian-css-style', get_stylesheet_directory_uri() .'/style.css' );
        wp_enqueue_style( 'martanian-css-style' );
        
        # raleway google font
        wp_register_style( 'google-font-raleway', 'http://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900' );
        wp_enqueue_style( 'google-font-raleway' );
        
        # animate.css stylesheet
        wp_register_style( 'animate-css', get_stylesheet_directory_uri() .'/_assets/_libs/animate/animate.css' );
        wp_enqueue_style( 'animate-css' );
        
        # jquery ui stylesheet
        wp_register_style( 'jquery-ui-css', get_stylesheet_directory_uri() .'/_assets/_libs/jquery-ui/css/frisieur/jquery-ui-1.10.3.custom.css' );
        wp_enqueue_style( 'jquery-ui-css' );
        
        # font awesome
        wp_register_style( 'font-awesome-css', get_stylesheet_directory_uri() .'/_assets/_libs/font-awesome/css/font-awesome.min.css' );
        wp_enqueue_style( 'font-awesome-css' );
        
        # isotope
        wp_register_style( 'isotope-css', get_stylesheet_directory_uri() .'/_assets/_libs/isotope/isotope.css' );
        wp_enqueue_style( 'isotope-css' );
  	}
    
   /**
    *
    * and some elements to wp_footer()
    * 
    */
    
    add_action( 'wp_enqueue_scripts', 'martanian_script_enqueuer_footer' );
    function martanian_script_enqueuer_footer() {
    
        # scrollable menu
        wp_register_script( 'martanian-menu', get_template_directory_uri() .'/_assets/_js/menu-scroll.js', array(), false, true );
        wp_enqueue_script( 'martanian-menu' );
        
        # google maps
        wp_register_script( 'google-maps', get_template_directory_uri() .'/_assets/_js/google-map.js', array(), false, true );
        wp_enqueue_script( 'google-maps' );
    }    
    
   /**
    *
    * support automatic feed links
    * 
    */
    
    add_theme_support( 'automatic-feed-links' );                            
    
   /**
    *
    * getting colors
    * 
    */
    
    function martanian_get_colors() {
    
        # get options
        $options = get_option( 'martanian_theme_options' );
        $user_colors = is_array( $options ) && isset( $options['colors'] ) && is_array( $options['colors'] ) ? $options['colors'] : false;
        
        # require styles
        require_once( dirname( __FILE__ ) .'/_assets/colors.php' );
    }               
   
   /**
    *
    * register wp_nav menus
    * 
    */
  
    if( function_exists( 'register_nav_menus' ) ) {
    	
        register_nav_menus( array(
            'martanian_main_left_menu' => __( 'Frisieur - top left navigation menu', 'martanian' ),
            'martanian_main_right_menu' => __( 'Frisieur - top right navigation menu', 'martanian' ),
            'martanian_responsive_menu' => __( 'Frisieur - responsive menu (for mobile devices)', 'martanian' ),
            'martanian_scrollable_menu' => __( 'Frisieur - scrollable menu', 'martanian' )
      	));
    }
  
   /**
    *
    * register sidebar
    *
    */
  
    if( function_exists( 'register_sidebar' ) ) {
    
        register_sidebar( array(
            'name' => __( 'Right Sidebar', 'martanian' ),
            'id' => 'right-sidebar',
            'description' => __( 'Sidebar in blog on right-hand side', 'martanian' ),
            'before_title' => '<h3>',
            'after_title' => '</h3><div class="header-line"><div class="gray-line"></div><div class="color-line"></div></div>',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>'
        ));
    }
    
   /**
    *
    * search form widget
    * 
    */ 
  
    add_filter( 'get_search_form', 'martanian_search_form' );
    function martanian_search_form( $form ) {

        $result = '<form role="search" method="get" id="searchform" action="'. home_url( '/' ) .'" >
                       
                       <input type="text" placeholder="'. __( 'Type and hit enter...', 'martanian' ) .'" value="'. get_search_query() .'" name="s" id="search-form" />
                   
                   </form>';
        
        return( $result );
    } 
    
   /**
    *
    * most commented posts widget
    *
    */                

    add_action( 'widgets_init', 'martanian_register_widgets' );
    function martanian_register_widgets() {
    
        register_widget( 'martanian_most_commented_posts' );
    }
    
    class martanian_most_commented_posts extends WP_Widget {
    
        # widget constructor
        public function __construct() {
        
            $widget_ops = array(
                'classname' => 'martanian-most-commented-posts-widget',
                'description' => __( 'Most commented blog posts', 'martanian' )
            );       
                
            parent::__construct(
                'martanian_most_commented_posts',
                __( 'Martanian: Most commented posts', 'martanian' ),
                $widget_ops
            );
        }
        
        public function form( $instance ) {
               
            $instance = wp_parse_args( ( array ) $instance, array( 'posts' => 3, 'title' => 'Most commented posts' ) );
            
            $title = $instance['title'];
            $posts = $instance['posts'];
            
            ?>
            <p>
            
                <?php _e( 'How many posts to display?', 'martanian' ) ?>
                <input class="widefat" name="<?php echo $this -> get_field_name( 'posts' ); ?>" type="text" value="<?php echo esc_attr( $posts ); ?>" />
            
            </p>
            
            <p>
            
                <?php _e( 'Widget title', 'martanian' ) ?>
                <input class="widefat" name="<?php echo $this -> get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            
            </p>
            <?php
        }
        
        public function update( $new_instance, $instance ) {

            $instance['posts'] = is_numeric( $new_instance['posts'] ) ? $new_instance['posts'] : 3;
            $instance['title'] = $new_instance['title'] == '' ? __( 'Most commented posts', 'martanian' ) : strip_tags( $new_instance['title'] );
            
            return( $instance );
        }
        
        public function widget( $args, $instance ) {
            
            # before widget
            echo $args['before_widget'];
            
            # prepare widget title
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
            
            # get most commented posts
            $popular = new WP_Query( 'orderby=comment_count&posts_per_page='. $instance['posts'] );
            if( isset( $popular -> posts ) && is_array( $popular -> posts ) && count( $popular -> posts ) > 0 ) {

                echo '<div class="small-posts-list">';
                foreach( $popular -> posts as $single_post ) {

                    echo '<div class="single-post">

                              <span class="title"><a href="'. get_permalink( $single_post -> ID ) .'">'. $single_post -> post_title .'</a></span>
                              <span class="when">'. human_time_diff( get_the_time( 'U', $single_post -> ID ), current_time( 'timestamp' ) ) . ' '. __( 'ago', 'martanian' ) .'</span>
                              <span class="value">'. $single_post -> comment_count .'</span>
                          
                          </div>';
                }
                
                echo '</div>';
            }

            # after widget
            echo $args['after_widget'];
        }                                                        
    } 
    
   /**
    *
    * get post content excerpt
    * 
    */
    
    function martanian_get_excerpt( $content ) {

        # remove "strong" because of more errors
        $content = str_replace( '<strong>', '', str_replace( '</strong>', '', $content ) );
        
        # max excerpt size
        $charlength = 200;
        
        # declare result
        $result = '';
        
        # operations
        if( mb_strlen( $content ) <= $charlength ) $result .= $content;
        else {

        		$subex = mb_substr( $content, 0, $charlength - 5 );
        		$exwords = explode( ' ', $subex );
        		$excut = -( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        		
            $result .= $excut < 0 ? mb_substr( $subex, 0, $excut ) : $subex;
        		$result .= '[...]';
      	}
        
        # return result
        return $result;
    }               

   /**
    *
    * load admin page functions
    * 
    */
    
    require_once( dirname( __FILE__ ) .'/_admin/index.php' );                 
    
   /**
    *
    * blog post thumbnails
    * 
    */
    
    add_theme_support( 'post-thumbnails' );
    
    require_once( dirname( __FILE__ ) .'/_assets/_libs/multiple-post-thumbnails/multi-post-thumbnails.php' );
    if( class_exists( 'MultiPostThumbnails' ) ) {
    
        new MultiPostThumbnails(
            array(
                'label' => __( '2nd Feature Image', 'martanian' ),
                'id' => 'feature-image-2',
                'post_type' => 'post'
            )
        );    
           
        new MultiPostThumbnails(
            array(
                'label' => __( '3rd Feature Image', 'martanian' ),
                'id' => 'feature-image-3',
                'post_type' => 'post'
            )
        );
        
        new MultiPostThumbnails(
            array(
                'label' => __( '4th Feature Image', 'martanian' ),
                'id' => 'feature-image-4',
                'post_type' => 'post'
            )
        );
        
        new MultiPostThumbnails(
            array(
                'label' => __( '5th Feature Image', 'martanian' ),
                'id' => 'feature-image-5',
                'post_type' => 'post'
            )
        );      
    };
    
    add_image_size( 'martanian-blog-post-image', 724, 9999 );  
    
   /**
    *
    * getting all post featured images
    * 
    */
    
    function martanian_get_post_images( $post_id ) {
        
        # init images array
        $images = array();
        
        # get standard featured image
        if( has_post_thumbnail( $post_id ) ) {
        
            $image = wp_get_attachment_image_src(
                get_post_thumbnail_id( $post_id ),
                'martanian-blog-post-image'
            );     
                                       
            if( isset( $image[0] ) && $image[0] != '' ) {
             
                $images_array[] = $image[0];
            }
        }
        
        # get other featured images
        if( class_exists( 'MultiPostThumbnails' ) ) {
         
            $images_array[] = MultiPostThumbnails::get_post_thumbnail_url(
                get_post_type(),
                'feature-image-2',
                $post_id,
                'martanian-blog-post-image'
            );
            
            $images_array[] = MultiPostThumbnails::get_post_thumbnail_url(
                get_post_type(),
                'feature-image-3',
                $post_id,
                'martanian-blog-post-image'
            );
            
            $images_array[] = MultiPostThumbnails::get_post_thumbnail_url(
                get_post_type(),
                'feature-image-4',
                $post_id,
                'martanian-blog-post-image'
            );
            
            $images_array[] = MultiPostThumbnails::get_post_thumbnail_url(
                get_post_type(),
                'feature-image-5',
                $post_id,
                'martanian-blog-post-image'
            );
        }
        
        # clear array
        $result = array();
        for( $i = 0; $i < count( $images_array ); $i++ ) {
        
            if( isset( $images_array[$i] ) && $images_array[$i] != '' ) $result[] = $images_array[$i];
        }
        
        # return
        return( count( $result ) == 0 ? false : $result );
    }                     
   
   /**
    *
    * get last twitter tweet
    * 
    */
    
    class martanian_tweets {
        
       /**
        *
        * get last tweet
        * 
        */
        
        public function getLastTweet( $options ) {

            require_once( dirname( __FILE__ ) .'/_assets/_libs/twitter-oauth/index.php' );
            
            $twitter_api = new Wp_Twitter_Api( $options['settings'] );
            $query = 'screen_name='. $options['username'] .'&count=1';
           
            $last_tweet = $twitter_api -> query( $query );
            if( isset( $last_tweet[0] -> text ) ) {

                $last_tweet = $last_tweet[0];
                return array(
                    'id' => $last_tweet -> id,
                    'content' => $this -> translateContent( $last_tweet -> text, $last_tweet -> entities ),
                    'date' => $this -> translateDate( $last_tweet -> created_at ),
                    'tweets_count' => number_format( $last_tweet -> user -> statuses_count, 0, '', '.' ),
                    'following_count' => number_format( $last_tweet -> user -> friends_count, 0, '', '.' ),
                    'followers_count' => number_format( $last_tweet -> user -> followers_count, 0, '', '.' )
                );
            }
        }
        
       /**
        *
        * translate content
        * 
        */
        
        private function translateContent( $content, $data ) {

            # replace hashtags
            if( count( $data -> hashtags ) > 0 ) {
            
                foreach( $data -> hashtags as $hashtag ) {

                    $content = str_replace( '#'. $hashtag -> text, '<a href="https://twitter.com/search?q=%23'. $hashtag -> text .'&src=hash">#'. $hashtag -> text .'</a>', $content );
                }
            }
            
            # replace urls
            if( count( $data -> urls ) > 0 ) {

                foreach( $data -> urls as $url ) {

                    $content = str_replace( $url -> url, '<a href="'. $url -> expanded_url .'">'. $url -> display_url .'</a>', $content );
                }
            }
            
            # replace user mentions
            if( count( $data -> user_mentions ) > 0 ) {
            
                foreach( $data -> user_mentions as $user ) {

                    $content = str_replace( '@'. $user -> screen_name, '<a href="https://twitter.com/'. $user -> screen_name .'">@'. $user -> screen_name .'</a>', $content );
                }
            }
            
            # return content
            return $content;
        }
        
       /**
        *
        * translate date
        * 
        */
        
        private function translateDate( $date ) {
        
            $pubDate = new DateTime( $date );
            $uDate = $pubDate -> format( 'U' );
            
            return human_time_diff( $uDate, current_time( 'timestamp' ) ) .' '. __( 'ago', 'martanian' );
        }                                                                
        
       /**
        *
        * end of methods
        * 
        */                                                                
    }  
    
   /**
    *
    * get map position (lat and lng)
    * 
    */
    
    function martanian_get_map_position( $address ) {
    
        $address_hash = md5( $address );

	      $url_encode_address = str_replace( ' ', '+', $address );
        $url = 'http://maps.google.com/maps/api/geocode/xml?address='. $url_encode_address .'&sensor=false';

        $response = wp_remote_get( $url );
 	      if( is_wp_error( $response ) ) return;

 	      $xml = wp_remote_retrieve_body( $response );
 	      if( is_wp_error( $xml ) ) return;

        if( $response['response']['code'] != 200 ) return false;
        else {

	          $data = new SimpleXMLElement( $xml );
            if( $data -> status == 'OK' ) {

                return array(
                    'lat' => ( string ) $data -> result -> geometry -> location -> lat,
                    'lng' => ( string ) $data -> result -> geometry -> location -> lng
                );
            }
        }

        return false;
    }   
    
   /**
    *
    * "line" shortcode     
    * 
    */
  
    add_shortcode( 'line', 'martanian_shortcode_line' );
    function martanian_shortcode_line() {

        return( '<div class="header-line"><div class="gray-line"></div><div class="color-line"></div></div>' );
    }
    
   /**
    *
    * "color" shortcode     
    * 
    */
  
    add_shortcode( 'color', 'martanian_shortcode_color' );
    function martanian_shortcode_color( $attr, $content = null ) {

        return( '<span>'. $content .'</span>' );
    } 
    
   /**
    *
    * "title" shortcode
    * 
    */
    
    add_shortcode( 'title', 'martanian_shortcode_title' );
    function martanian_shortcode_title( $attr, $content = null ) {
    
        return( '<h3>'. do_shortcode( $content ) .'</h3><div class="header-line"><div class="gray-line"></div><div class="color-line"></div></div>' );
    } 
    
   /**
    *
    * "p" shortcode
    * 
    */
    
    add_shortcode( 'p', 'martanian_shortcode_p' );
    function martanian_shortcode_p( $attr, $content = null ) {
    
        return( '<p>'. do_shortcode( $content ) .'</p>' );
    }                               
    
   /**
    *
    * "appointment link" shortcode
    * 
    */  
    
    add_shortcode( 'appointment-link', 'martanian_shortcode_appointment_link' );
    function martanian_shortcode_appointment_link( $attr, $content = null ) {
    
        return( '<a class="open-appointment-box">'. $content .'</a>' );
    }               
   
   /**
    *
    * "button" shortcode
    * 
    */
    
    add_shortcode( 'button', 'martanian_shortcode_button' );
    function martanian_shortcode_button( $attr, $content = null ) {

        $color = isset( $attr['type'] ) && $attr['type'] == 'gray' ? 'gray' : 'brown';
        return( '<button type="button" class="button button-'. $color .'">'. $content .'</button>' );
    }    
    
   /**
    *
    * "pricing table" shortcodes
    * 
    */  
    
    add_shortcode( 'pricing_table', 'martanian_shortcode_pricing_table' );
    function martanian_shortcode_pricing_table( $attr, $content = null ) {

        $name = isset( $attr['name'] ) && $attr['name'] != '' ? $attr['name'] : '';
        $first = isset( $attr['first'] ) && $attr['first'] != '' ? $attr['first'] : '';
        $second = isset( $attr['second'] ) && $attr['second'] != '' ? $attr['second'] : '';
        
        return( '<table class="pricing-table"><tr class="head"><td>'. $name .'</td><td>'. $first .'</td><td>'. $second .'</td></tr>'. do_shortcode( $content ) .'</table>' );
    }    
    
    add_shortcode( 'pricing_element', 'martanian_shortcode_pricing_element' );
    function martanian_shortcode_pricing_element( $attr, $content = null ) {

        $name = isset( $attr['name'] ) && $attr['name'] != '' ? $attr['name'] : '';
        $first = isset( $attr['first'] ) && $attr['first'] != '' ? $attr['first'] : '-';
        $second = isset( $attr['second'] ) && $attr['second'] != '' ? $attr['second'] : '-';
        
        $recommended = '';
        $icon = '';
        if( isset( $attr['type'] ) && $attr['type'] == 'recommended' ) {
        
            $recommended = ' class="recommended"';
            $icon = '<i class="icon-ok" style="margin-right: 10px"></i> ';
        }

        if( $name == '' && $first == '-' && $second == '-' ) return( '' );
        else {
        
            return( '<tr'. $recommended .'><td class="name">'. $icon . $name .'</td><td class="first">'. $first .'</td><td class="second">'. $second .'</td></tr>' );
        }
    } 
    
   /**
    *
    * "alert" shortcode
    * 
    */  
    
    add_shortcode( 'alert', 'martanian_shortcode_alert' );
    function martanian_shortcode_alert( $attr, $content = null ) {

        $color = isset( $attr['type'] ) && in_array( $attr['type'], array( 'blue', 'green', 'red' ) ) ? 'alert-'. $attr['type'] : 'alert-yellow'; 
        return( '<div class="alert-box '. $color .'" style="margin-bottom: 20px"><i class="icon-remove"></i><p>'. $content .'</p></div>' );
    }  
    
   /**
    *
    * "half" shortcode
    * 
    */
    
    add_shortcode( 'half_container', 'martanian_shortcode_half_container' );
    function martanian_shortcode_half_container( $attr, $content = null ) {
    
        return( '<ul class="half-container">'. do_shortcode( $content ) .'</ul>' );
    }      
    
    add_shortcode( 'half', 'martanian_shortcode_half_element' );
    function martanian_shortcode_half_element( $attr, $content = null ) {
    
        return( '<li class="half-element">'. do_shortcode( $content ) .'</li>' );
    }  
    
   /**
    *
    * "video" shortcode     
    * 
    */
  
    add_shortcode( 'video', 'martanian_shortcode_video' );
    function martanian_shortcode_video( $attr ) {
    
        if( !isset( $attr['from'] ) || $attr['from'] == '' || !in_array( $attr['from'], array( 'youtube', 'vimeo' ) ) || !isset( $attr['id'] ) || $attr['id'] == '' ) return false;
        else {
        
            switch( $attr['from'] ) {
            
                case 'youtube': $src = 'http://www.youtube.com/embed/'. $attr['id'] .'?vq=hd1080;rel=0;showinfo=0'; break;
                case 'vimeo': $src = 'http://player.vimeo.com/video/'. $attr['id'] .'?autoplay=&amp;title=0&amp;byline=0&amp;portrait=0'; break;
            }
            
            return( '<div class="video"><iframe src="'. $src .'" style="border: none;"></iframe></div>' );
        }
    }                       

   /**
    *
    * dashboard widget
    *   
    */
  
    add_action( 'wp_dashboard_setup', 'martanian_dashboard_widget_init' );
    function martanian_dashboard_widget_init() {
    
        wp_add_dashboard_widget( 'dashboard_custom_feed', __( 'New informations from Martanian Design', 'martanian' ), 'martanian_dashboard_widget' );
    }
      
    function martanian_dashboard_widget() {
    
        $response = wp_remote_get( 'http://dev.martanian.com/_themes-news/index.php?product_key=24d0f275e29823c4718651e484b1a4b4' );
        if( is_wp_error ( $response ) ) {
        
            $error = $response -> get_error_message();
            echo '<p>'. $error .'</p>';
        }
        
        else if( wp_remote_retrieve_response_code( $response ) == '404' ) echo '<p>'. __( 'A little bit problem with connect to Martanian Support Server - please try again later.', 'martanian' ) .'</p>';
        else echo wp_remote_retrieve_body( $response );
    }   
    
   /**
    *
    * message after theme activation
    * 
    */
    
    if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == "themes.php" ) {

  	    add_action( 'admin_notices', 'martanian_theme_activated' );
    } 
    
    function martanian_theme_activated() {
    
        $theme_options_url = get_admin_url( null, 'admin.php?page=martanian_admin' );
        
        ?>
        
        <script>
        
          	jQuery( document ).ready( function( $ ) {
          		
                $( '#message2' ).html( '<p>Thank you for purchase Frisieur WordPress Theme! This theme is now active, you can go to <a href="<?php echo $theme_options_url; ?>">theme options page</a> and customize it! If you have technical problems or other questions, feel free to contact me: <a href="mailto:support@martanian.com">support@martanian.com</a>.</p>' );
            });
        
        </script>
        
        <?php
    }                         
   
   /**
    *
    * end of file.
    * 
    */                
    
?>
<?php

   /**
    *    
    * Template Name: Single Page          
    *
    */
     
    # load header
    get_header();

    # get options
    $options = get_option( 'martanian_theme_options' );
    
    # section number
    $section_number = 0;
    
    # display all sections
    if( isset( $options['sections'] ) && is_array( $options['sections'] ) && isset( $options['sections']['data'] ) && is_array( $options['sections']['data'] ) && count( $options['sections']['data'] ) > 0 ) {

        foreach( $options['sections']['data'] as $section_id => $section_data ) {
        
            switch( $section_data['type'] ) {
            
               /**
                *
                * small appointment section
                * 
                */                                                                
                
                case 'small-appointment': 
                
                    # next section number
                    $section_number++;
                    
                    # animations
                    $animationType = $section_number == 1 || $section_number == 2 ? 'waitForLoad' : 'waitForScroll';

                    # display section
                    echo '<section id="small-appointment">
                              
                              <div class="appointment-title '. $animationType .' fadeInUp">
                              
                                  <h3>'. do_shortcode( $section_data['title'] ) .'</span></h3>
                                  
                                  <div class="header-line">
                                      
                                      <div class="gray-line"></div>
                                      <div class="color-line"></div>
                                  
                                  </div>
                                  
                              </div>
                              
                              <div class="appointment-form">
                              
                                  <form method="get">
                                  
                                      <div class="input">
                                      
                                          <div class="input-helper"><i class="icon-calendar"></i></div>
                                          <input type="text" placeholder="'. __( 'Appointment date', 'martanian' ) .'" class="appointment-datepicker" readonly />
                                          
                                          <div class="clear">
                                          </div>
                                      
                                      </div>
                                      
                                      <div class="input approximate-time-input">
                                      
                                          <div class="input-helper"><i class="icon-time"></i></div>
                                          <input type="text" placeholder="'. __( 'Approximate time', 'martanian' ) .'" class="approximate-time" readonly data-timebox-id="2" />
                                          
                                          <div class="clear">
                                          </div>
                                          
                                          <div class="approximate-time-box animated fadeInDown '. ( $section_data['time_type'] == '24h' ? 'approximate-time-box-24h' : '' ) .'" data-timebox-id="2">
                                          
                                              <div class="approximate-time-box-arrow"></div>
                                              <div class="element element-first">
                                              
                                                  <i class="icon-chevron-up element-up hours hours-up time-change-action-event"></i>
                                                  <span class="element-value time-selector-hours" data-value="8">8</span>
                                                  <i class="icon-chevron-down element-down hours hours-down time-change-action-event"></i>
                                              
                                              </div>
                                              
                                              <div class="element">
                                              
                                                  <i class="icon-chevron-up element-up mins mins-up time-change-action-event"></i>
                                                  <span class="element-value time-selector-mins" data-value="0">00</span>
                                                  <i class="icon-chevron-down element-down mins mins-down time-change-action-event"></i>
                                              
                                              </div>
                                              
                                              '. ( $section_data['time_type'] == '12h' ? '<div class="element"><i class="icon-chevron-up element-up time-change-action-event time-type"></i><span class="element-value time-selector-type" data-value="am">am</span><i class="icon-chevron-down element-down time-change-action-event time-type"></i></div>' : '' ) .'
                                          
                                          </div>
                                      
                                      </div>
                                      
                                      <input type="button" value="'. __( 'Next step', 'martanian' ) .'" class="button button-brown open-appointment-box-with-data" />
                                  
                                  </form>
                                  
                              </div>
                              
                              <div class="clear">
                              </div>
                          
                          </section>';
                
                break;
                
               /**
                *
                * presentation with image section
                * 
                */
                
                case 'presentation-with-image':
                
                    # next section number
                    $section_number++;
                    
                    # animations
                    $animationType = $section_number == 1 || $section_number == 2 ? 'waitForLoad' : 'waitForScroll';
                    
                    # create slides
                    $slides = '';
                    if( isset( $section_data['slides'] ) && is_array( $section_data['slides'] ) ) {
                    
                        foreach( $section_data['slides'] as $slide_id => $slide_data ) {

                            # complet slide
                            $slides .= '<div class="single-presentation">
                                        
                                            <div class="presentation-left '. $animationType .' fadeInRight">
                                            
                                                <img src="'. ( isset( $slide_data['slider_image_url'] ) && $slide_data['slider_image_url'] != '' ? $slide_data['slider_image_url'] : get_template_directory_uri() .'/_assets/_img/empty549x549.png' ) .'" class="main-image" alt="'. $slide_data['title'] .'" />

                                            </div>
                                            
                                            <div class="presentation-right '. $animationType .' fadeInUp">
                                            
                                                '. do_shortcode( $slide_data['content'] ) .'
                                            
                                            </div>
                                        
                                        </div>';
                        }
                    }

                    # display section
                    echo '<section class="presentation-v1 standard-border" data-section-name="'. $section_data['prefix'] .'">
                              
                              <div class="single-presentations make-slideshow">
                              
                                  '. ( isset( $section_data['slides'] ) && is_array( $section_data['slides'] ) && count( $section_data['slides'] ) > 1 ? '<i class="icon-chevron-left presentation-prev-button"></i><i class="icon-chevron-right presentation-next-button"></i>' : '' )
                                   . $slides .'
                              
                              </div>
                          
                          </section>';
                
                break;
                
               /**
                *
                * about us section
                *
                */                
                
                case 'about-us':

                    # next section number
                    $section_number++;
                    
                    # animations
                    $animationType = $section_number == 1 || $section_number == 2 ? 'waitForLoad' : 'waitForScroll';
     
                    # persons
                    $persons = '';
                    if( isset( $section_data['persons'] ) && is_array( $section_data['persons'] ) ) {
                    
                        $persons .= '<div class="team-box"><div class="header">'. __( 'Our team', 'martanian' ) .'</div><div class="team-box-profiles">';
                        $person_id = 1;
                        
                        foreach( $section_data['persons'] as $person_id => $person_data ) {
                        
                            $person_skills = '';
                            if( isset( $person_data['skills'] ) && is_array( $person_data['skills'] ) ) {
                            
                                foreach( $person_data['skills'] as $skill_id => $skill_data ) {
                                
                                    $person_skills .= '<div class="progress-bar">
                                                       
                                                           <span class="progress-bar-name">'. $skill_data['name'] .'</span>
                                                           <span class="progress-value" data-value="'. $skill_data['value'] .'"></span>
                                                        
                                                       </div>';
                                }
                            }

                            $persons .= '<div class="single-profile" data-profile-id="'. $person_id .'">
                                             
                                             <div class="profile">
                                                 
                                                 <div class="image">
                                                 
                                                     '. ( isset( $person_data['person_image_url'] ) && $person_data['person_image_url'] != '' ? '<img src="'. $person_data['person_image_url'] .'" alt="'. $person_data['name'] .'" />' : '<img src="'. get_template_directory_uri() .'/_assets/_img/person.png" alt="'. $person_data['name'] .'" />' ) .'
                                                 
                                                 </div>
                                                 
                                                 <span class="name">'. $person_data['name'] .'</span>
                                                 <span class="specialization">'. $person_data['profession'] .'</span>
                                                 <span class="social">
                                                 
                                                     '. ( $person_data['facebook'] != '' ? '<a href="'. $person_data['facebook'] .'" class="facebook"><i class="icon-facebook"></i></a> ' : '' )
                                                      . ( $person_data['google-plus'] != '' ? '<a href="'. $person_data['google-plus'] .'" class="google-plus"><i class="icon-google-plus"></i></a>' : '' ) .'
                                                 
                                                 </span>
                                              
                                             </div>
                                             
                                             <div class="skills">
                                             
                                                 <p>'. $person_data['description'] .'</p>
                                                 '. $person_skills .'
                                             
                                             </div>
                                          
                                         </div>';
                                         
                            $person_id++;
                        }
                        
                        $persons_switch = count( $section_data['persons'] ) > 1 ? '<div class="persons-switch"><span class="prev"><i class="icon-angle-left"></i> '. __( 'Previous stylist', 'martanian' ) .'</span><span class="next">'. __( 'Next stylist', 'martanian' ) .' <i class="icon-angle-right"></i></span><div class="clear"></div></div>' : '';
                        $persons .= '</div>'. $persons_switch .'</div>';
                    }

                    # display section
                    echo '<section id="about-us" class="presentation-v2 standard-border" data-section-name="'. __( 'our-team', 'martanian' ) .'">
                          
                              <div class="presentation-container">
                                  
                                  <div class="content-left '. $animationType .' fadeInLeft">'. do_shortcode( $section_data['content'] ) .'</div>
                                  <div class="content-right '. $animationType .' fadeInUp">'. $persons .'</div>
                              
                              </div>
                              
                              <div class="clear">
                              </div>
                          
                          </section>';
                
                break;
                
               /**
                *
                * opening hours section
                * 
                */
                
                case 'opening-hours':

                    # next section number
                    $section_number++;
                    
                    # animations
                    $animationType = $section_number == 1 || $section_number == 2 ? 'waitForLoad' : 'waitForScroll';

                    # display section
                    echo '<section id="opening-hours" class="standard-border" data-section-name="'. __( 'opening-hours', 'martanian' ) .'">
                              
                              <img src="'. ( isset( $section_data['background_image_url'] ) && $section_data['background_image_url'] != '' ? $section_data['background_image_url'] : get_template_directory_uri() .'/_assets/_img/clock.png' ) .'" class="'. $animationType .' fadeInLeft" alt="" />
                              <div class="opening-hours-container '. $animationType .' fadeInUp">
                              
                                  <h3>'. do_shortcode( $section_data['title'] ) .'</h3>
                                  <table class="opening-hours-table">
                                  
                                      <tr class="head">
                                      
                                          <td><span class="standard-name">'. __( 'Monday', 'martanian' ) .'</span><span class="responsive-name">'. __( 'Mon', 'martanian' ) .'</span></td>
                                          <td><span class="standard-name">'. __( 'Tuesday', 'martanian' ) .'</span><span class="responsive-name">'. __( 'Tue', 'martanian' ) .'</span></td>
                                          <td><span class="standard-name">'. __( 'Wednesday', 'martanian' ) .'</span><span class="responsive-name">'. __( 'Wed', 'martanian' ) .'</span></td>
                                          <td><span class="standard-name">'. __( 'Thursday', 'martanian' ) .'</span><span class="responsive-name">'. __( 'Thu', 'martanian' ) .'</span></td>
                                          <td><span class="standard-name">'. __( 'Friday', 'martanian' ) .'</span><span class="responsive-name">'. __( 'Fri', 'martanian' ) .'</span></td>
                                          <td><span class="standard-name">'. __( 'Saturday', 'martanian' ) .'</span><span class="responsive-name">'. __( 'Sat', 'martanian' ) .'</span></td>
                                          <td><span class="standard-name">'. __( 'Sunday', 'martanian' ) .'</span><span class="responsive-name">'. __( 'Sun', 'martanian' ) .'</span></td>
                                      
                                      </tr>
                                      
                                      <tr class="hours-from">
                                      
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['monday']['open'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['tuesday']['open'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['wednesday']['open'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['thursday']['open'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['friday']['open'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['saturday']['open'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['sunday']['open'] ) ) .'</td>
                                      
                                      </tr>
                                      
                                      <tr class="hours-to">
                                      
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['monday']['close'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['tuesday']['close'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['wednesday']['close'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['thursday']['close'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['friday']['close'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['saturday']['close'] ) ) .'</td>
                                          <td>'. str_replace( 'am', '<span class="type">am</span>', str_replace( 'pm', '<span class="type">pm</span>', $section_data['sunday']['close'] ) ) .'</td>
                                      
                                      </tr>
                                  
                                  </table>
                                  
                                  <table class="opening-hours-table-mobile">
                                  
                                      <tr>
                                      
                                          <td class="head">'. __( 'Mon', 'martanian' ) .'</td>
                                          <td class="hours-from">'. $section_data['monday']['open'] .'</td>
                                          <td class="hours-to">'. $section_data['monday']['close'] .'</td>
                                      
                                      </tr>
                                      
                                      <tr>
                                      
                                          <td class="head">'. __( 'Tue', 'martanian' ) .'</td>
                                          <td class="hours-from">'. $section_data['tuesday']['open'] .'</td>
                                          <td class="hours-to">'. $section_data['tuesday']['close'] .'</td>
                                      
                                      </tr>
                                      
                                      <tr>
                                      
                                          <td class="head">'. __( 'Wed', 'martanian' ) .'</td>
                                          <td class="hours-from">'. $section_data['wednesday']['open'] .'</td>
                                          <td class="hours-to">'. $section_data['wednesday']['close'] .'</td>
                                      
                                      </tr>
                                      
                                      <tr>
                                      
                                          <td class="head">'. __( 'Thu', 'martanian' ) .'</td>
                                          <td class="hours-from">'. $section_data['thursday']['open'] .'</td>
                                          <td class="hours-to">'. $section_data['thursday']['close'] .'</td>
                                      
                                      </tr>
                                      
                                      <tr>
                                      
                                          <td class="head">'. __( 'Fri', 'martanian' ) .'</td>
                                          <td class="hours-from">'. $section_data['friday']['open'] .'</td>
                                          <td class="hours-to">'. $section_data['friday']['close'] .'</td>
                                      
                                      </tr>
                                      
                                      <tr>
                                      
                                          <td class="head">'. __( 'Sat', 'martanian' ) .'</td>
                                          <td class="hours-from">'. $section_data['saturday']['open'] .'</td>
                                          <td class="hours-to">'. $section_data['saturday']['close'] .'</td>
                                      
                                      </tr>
                                      
                                      <tr>
                                      
                                          <td class="head">'. __( 'Sun', 'martanian' ) .'</td>
                                          <td class="hours-from">'. $section_data['sunday']['open'] .'</td>
                                          <td class="hours-to">'. $section_data['sunday']['close'] .'</td>

                                      </tr>
                                  
                                  </table>
                                  
                                  <div class="appointment-button">
                                  
                                      <button type="button" class="button button-brown open-appointment-box">'. __( 'Make an appointment!', 'martanian' ) .'</button>
                                  
                                  </div>
                              
                              </div>
                              
                              <div class="clear">
                              </div>
                              
                          </section>';
                
                break;  
                
               /**
                *
                * twitter / last blog post section
                * 
                */
                
                case 'twitter-last-blog-post':

                    # next section number
                    $section_number++;
                    
                    # animations
                    $animationType = $section_number == 1 || $section_number == 2 ? 'waitForLoad' : 'waitForScroll';
                    
                    # get last post
                    $last_post = wp_get_recent_posts( array( 'numberposts' => 1 ) );
                    $last_post = isset( $last_post[0] ) ? $last_post[0] : false;

                    # create post html
                    $last_post_html = '';
                    
                    # create last post box html
                    if( $last_post != false ) {
                    
                        # get author username
                        $username = get_userdata( $last_post['post_author'] );

                        # create post hmtl
                        $last_post_html = '<div class="single-post special-content-element '. $animationType .' fadeInRight">
                                               
                                               <h4><a href="'. get_permalink( $last_post['ID'] ) .'">'. $last_post['post_title'] .'</a></h4>
                                               <div class="blog-post-info">
                                               
                                                   <span class="blog-post-date">
                                                   
                                                       <i class="icon-time"></i> '. human_time_diff( get_the_time( 'U', $last_post['ID'] ), current_time( 'timestamp' ) ) . ' '. __( 'ago', 'martanian' ) .'
                                                   
                                                   </span>
                                                   
                                                   <span class="divider">&middot;</span>
                                                   
                                                   <span class="blog-post-author">
                                                   
                                                       <a href="'. get_author_posts_url( $last_post['post_author'] ) .'"><i class="icon-pencil"></i> '. $username -> display_name .'</a>
                                                   
                                                   </span>
                                               
                                               </div>
                                               
                                               <div class="header-line">
                                               
                                                   <div class="gray-line"></div>
                                                   <div class="color-line"></div>
                                               
                                               </div>
                                               
                                               <div class="blog-post-content">
                                               
                                                   <p>'. martanian_get_excerpt( $last_post['post_content'] ) .'</p>
                                                   <p><a href="'. get_permalink( $last_post['ID'] ) .'">'. __( 'Read more...', 'martanian' ) .'</a></p>
                                               
                                               </div>
                                           
                                           </div>';
                    }

                    # define twitter box content
                    $twitter_box_content = '';
                    
                    # get last tweet
                    if( isset( $section_data['twitter-username'] ) && $section_data['twitter-username'] != '' ) {

                        # connect with twitter class
                        $twitter = new martanian_tweets();

                        # options
                        if( isset( $section_data['oauth-consumer-key'] ) && $section_data['oauth-consumer-key'] != '' && isset( $section_data['oauth-consumer-secret'] ) && $section_data['oauth-consumer-secret'] != '' ) {
                        
                            $class_options = array(
                                'username' => $section_data['twitter-username'],
                                'settings' => array(
                                    'consumer_key' => $section_data['oauth-consumer-key'],
                                    'consumer_secret' => $section_data['oauth-consumer-secret']
                                )
                            );
                            
                            # get last tweet
                            $last_tweet = $twitter -> getLastTweet( $class_options );
                            
                            # display last tweet, if exists
                            $twitter_box_content = '';
                            if( $last_tweet != false ) {
                            
                                # redeclare content
                                $twitter_box_content = '<div class="twitter-box special-content-element '. $animationType .' flipInX">
                                                            
                                                            <div class="twitter-header-border">
                                                            
                                                                <div class="twitter-box-header">
                                                                
                                                                    <i class="icon-twitter"></i>
                                                                    <span class="title">Twitter</span>
                                                                    <span class="follow"><a href="https://twitter.com/'. $section_data['twitter-username'] .'">@</a></span>
                                                                
                                                                </div>
                                                            
                                                            </div>
                                                            
                                                            <div class="twitter-content-border">
                                                            
                                                                <div class="twitter-stats">
                                                                
                                                                    <div class="stat">
                                                                    
                                                                        <span class="name">Tweets</span>
                                                                        <span class="count">'. $last_tweet['tweets_count'] .'</span>
                                                                    
                                                                    </div>
                                                                    
                                                                    <div class="stat">
                                                                    
                                                                        <span class="name">Following</span>
                                                                        <span class="count">'. $last_tweet['following_count'] .'</span>
                                                                    
                                                                    </div>
                                                                    
                                                                    <div class="stat">
                                                                    
                                                                        <span class="name">Followers</span>
                                                                        <span class="count">'. $last_tweet['followers_count'] .'</span>
                                                                    
                                                                    </div>
                                                                
                                                                </div>
                                                                
                                                                <div class="tweet-content">'. $last_tweet['content'] .'</div>
                                                                <div class="tweet-time">
                                                                
                                                                    <i class="icon-time"></i>
                                                                    <a href="https://twitter.com/'. $section_data['twitter-username'] .'/status/'. $last_tweet['id'] .'">'. $last_tweet['date'] .'</a>
                                                                
                                                                </div>
                                                            
                                                            </div>
                                                        
                                                        </div>';
                            }
                        }
                    }

                    # display section
                    echo '<section class="special-content standard-border">
                              
                              <i class="background-icon icon-file-text-alt"></i>
                              <div class="box">'. $twitter_box_content . $last_post_html .'</div>
                          
                          </section>';
                             
                break;
                
               /**
                *
                * facebook / last blog post section
                * 
                */
                
                case 'facebook-last-blog-post':

                    # next section number
                    $section_number++;
                    
                    # animations
                    $animationType = $section_number == 1 || $section_number == 2 ? 'waitForLoad' : 'waitForScroll';
                    
                    # get last post
                    $last_post = wp_get_recent_posts( array( 'numberposts' => 1 ) );
                    $last_post = isset( $last_post[0] ) ? $last_post[0] : false;

                    # create post html
                    $last_post_html = '';
                    
                    # create last post box html
                    if( $last_post != false ) {
                    
                        # get author username
                        $username = get_userdata( $last_post['post_author'] );

                        # create post hmtl
                        $last_post_html = '<div class="single-post special-content-element '. $animationType .' fadeInRight">
                                               
                                               <h4><a href="'. get_permalink( $last_post['ID'] ) .'">'. $last_post['post_title'] .'</a></h4>
                                               <div class="blog-post-info">
                                               
                                                   <span class="blog-post-date">
                                                   
                                                       <i class="icon-time"></i> '. human_time_diff( get_the_time( 'U', $last_post['ID'] ), current_time( 'timestamp' ) ) . ' '. __( 'ago', 'martanian' ) .'
                                                   
                                                   </span>
                                                   
                                                   <span class="divider">&middot;</span>
                                                   
                                                   <span class="blog-post-author">
                                                   
                                                       <a href="'. get_author_posts_url( $last_post['post_author'] ) .'"><i class="icon-pencil"></i> '. $username -> display_name .'</a>
                                                   
                                                   </span>
                                               
                                               </div>
                                               
                                               <div class="header-line">
                                               
                                                   <div class="gray-line"></div>
                                                   <div class="color-line"></div>
                                               
                                               </div>
                                               
                                               <div class="blog-post-content">
                                               
                                                   <p>'. martanian_get_excerpt( $last_post['post_content'] ) .'</p>
                                                   <p><a href="'. get_permalink( $last_post['ID'] ) .'">'. __( 'Read more...', 'martanian' ) .'</a></p>
                                               
                                               </div>
                                           
                                           </div>';
                    }

                    # define twitter box content
                    $facebook_box_content = '';
                    
                    # create facebook box
                    if( isset( $section_data['facebook-fanpage'] ) && $section_data['facebook-fanpage'] != '' ) {

                        $facebook_box_content = '<div class="special-content-element special-content-element-left '. $animationType .' flipInX">
                                                 
                                                     <div class="fb-like-box" data-href="http://www.facebook.com/ThemeForest"
                                                                              data-width="292"
                                                                              data-show-faces="true"
                                                                              data-stream="false"
                                                                              data-header="true"
                                                                              data-show-border="true"></div>
                                                 
                                                 </div>';
                    }

                    # display section
                    echo '<section class="special-content standard-border">
                              
                              <i class="background-icon icon-file-text-alt"></i>
                              <div class="box">'. $facebook_box_content . $last_post_html .'</div>
                          
                          </section>';
                             
                break;                                                                                                                                                                                                                              
                
               /**
                *
                * gallery section
                *
                */       
                
                case 'gallery':
                
                    # next section number
                    $section_number++;
                    
                    # animations
                    $animationType = $section_number == 1 || $section_number == 2 ? 'waitForLoad' : 'waitForScroll';
                    
                    # filters
                    $filters = array();
                    $filters_html = '';
                    
                    # gallery images
                    $gallery_images = '';
                    
                    # is there any images?
                    if( isset( $section_data['gallery_images'] ) && is_array( $section_data['gallery_images'] ) ) {
                    
                        # create filters and images list
                        foreach( $section_data['gallery_images'] as $image ) {
                        
                            # image exists?
                            if( $image['image_url'] == '' ) $image['image_url'] = get_template_directory_uri() .'/_assets/_img/empty549x549.png';
                            
                            # item categories
                            $item_categories = '';
                            
                            # is there any tags?
                            if( isset( $image['tags'] ) && is_array( $image['tags'] ) ) {
                            
                                # filters
                                foreach( $image['tags'] as $tag ) {
                                
                                    if( !in_array( $tag, $filters ) ) {
                                    
                                        $filters[] = $tag;
                                        $filters_html .= ' <button type="button" class="button button-gray" data-filter=".category-'. strtolower( preg_replace( '/[^a-zA-Z]/s', '', $tag ) ) .'">'. $tag .'</button>';
                                    }
                                    
                                    $item_categories .= ' category-'. strtolower( preg_replace( '/[^a-zA-Z]/s', '', $tag ) );
                                }
                            }
                            
                            # gallery image
                            $gallery_images .= '<div class="gallery-item'. $item_categories .'" style="background-image: url( '. $image['image_url'] .' );">
                                                    
                                                    <div class="item-background">
                                                    
                                                        <span class="icon-box">
                                                            
                                                            <i class="icon-eye-open"></i>
                                                        
                                                        </span>
                                                    
                                                    </div>
                                                
                                                </div>';
                        }
                    }
                    
                    # display section
                    echo '<section id="gallery" class="standard-border" data-section-name="'. __( 'gallery', 'martanian' ) .'">
                          
                              <h4 class="'. $animationType .' fadeInUp">'. $section_data['color_title'] .'</h4>
                              <h3 class="'. $animationType .' fadeInUp">'. $section_data['title'] .'</h3>
                              
                              <div class="haircut-line '. $animationType .' fadeInUp">
                                  
                                  <div class="left-line">
                                  </div>
                                  
                                  <i class="icon-cut"></i>
                                  
                                  <div class="right-line">
                                  </div>
                                  
                                  <div class="clear">
                                  </div>
                              
                              </div>
                              
                              <p class="description '. $animationType .' fadeInUp">'. $section_data['description'] .'</p>
                              <div class="gallery-filters '. $animationType .' fadeIn">
                              
                                  <button type="button" class="button button-brown" data-filter="*">'. __( 'All', 'martanian' ) .'</button>
                                  '. $filters_html .'
                              
                              </div>
                              
                              <div class="gallery-items '. $animationType .' fadeIn">
                              
                                  '. $gallery_images .'
                              
                              </div>
                          
                          </section>';
                
                break;                                                        
               
               /**
                *
                * contact section
                * 
                */
                
                case 'contact-form':

                    # next section number
                    $section_number++;
                    
                    # animations
                    $animationType = $section_number == 1 || $section_number == 2 ? 'waitForLoad' : 'waitForScroll';

                    # display section
                    echo '<section id="contact-form" class="standard-border" data-section-name="'. __( 'contact', 'martanian' ) .'">
                              
                              <div class="map-box" id="map-canvas"></div>
                              <form method="post" id="contact-form-section-form" class="'. $animationType .' fadeInUp">
                              
                                  <h3>'. do_shortcode( $section_data['title'] ) .'</h3>
                                  <div class="header-line">
                                      
                                      <div class="gray-line"></div>
                                      <div class="color-line"></div>
                                  
                                  </div>
                                  
                                  <div id="contact-form-fields">
                                      
                                      <div class="input">
                                      
                                          <div class="input-helper"><i class="icon-male"></i></div>
                                          <input type="text" name="name" placeholder="'. __( 'Name...', 'martanian' ) .'" />
                                          
                                          <div class="clear">
                                          </div>
                                      
                                      </div>
                                      
                                      <div class="input">
                                      
                                          <div class="input-helper"><i class="icon-envelope"></i></div>
                                          <input type="text" name="email" placeholder="'. __( 'Mail...', 'martanian' ) .'" />
                                          
                                          <div class="clear">
                                          </div>
                                      
                                      </div>
                                      
                                      <div class="input">
                                      
                                          <div class="input-helper"><i class="icon-phone"></i></div>
                                          <input type="text" name="phone" placeholder="'. __( 'Phone...', 'martanian' ) .'" />
                                          
                                          <div class="clear">
                                          </div>
                                          
                                      </div>
                                      
                                      <div class="input">
                                      
                                          <div class="input-helper"><i class="icon-tasks"></i></div>
                                          <input type="text" name="subject" placeholder="'. __( 'Subject...', 'martanian' ) .'" />
                                          
                                          <div class="clear">
                                          </div>
                                          
                                      </div>
                                      
                                      <div class="textarea">
                                      
                                          <textarea placeholder="'. __( 'Message...', 'martanian' ) .'" name="message"></textarea>
                                      
                                      </div>
                                      
                                      <button name="send" type="button" class="button button-brown"><i class="icon-envelope-alt"></i>'. __( 'Send message!', 'martanian' ) .'</button>
                                  
                                  </div>
                                  
                                  <div class="contact-form-thanks">'. __( 'Thank you!', 'martanian' ) .'</div>
                              
                              </form>
                          
                          </section>';
                
                break;
                
               /**
                *
                * address and contact data
                * 
                */
                
                case 'address-data':
                
                    # next section number
                    $section_number++;
                    
                    # display section
                    echo '<section class="standard-border address" data-section-name="'. __( 'address', 'martanian' ) .'">
                    
                              <div class="contact-data">
                              
                                  <h4>'. $section_data['salon-name'] .'</h4>
                                  <p>'. $section_data['street'] .'<br />'. $section_data['city'] .'</p>
                                  <p>'. ( $section_data['phone-number'] != '' ? __( 'Phone', 'martanian' ) .': <span>'. $section_data['phone-number'] .'</span><br />' : '' ) . ( $section_data['email'] != '' ? __( 'Mail', 'martanian' ) .': <span>'. $section_data['email'] .'</span><br />' : '' ) . ( $section_data['website'] != '' ? __( 'Web', 'martanian' ) .': <span>'. $section_data['website'] .'</span>' : '' ) .'</p>
                              
                              </div>
                              
                              '. ( $section_data['fanpage-url'] != '' ? '<div class="facebook"><h4>'. __( 'Like us on Facebook!', 'martanian' ) .'</h4><div class="fb-follow" data-href="'. $section_data['fanpage-url'] .'" data-colorscheme="light" data-layout="standard" data-show-faces="true"></div></div>' : '' ) .'
                              
                              <div class="clear">
                              </div>
                          
                          </section>';
                
                break;                                                                 
                
               /**
                *
                * custom html section
                * 
                */
                
                case 'your-html':

                    # next section number
                    $section_number++;
                    
                    # display section
                    echo '<section class="standard-border custom-html-'. $section_data['background_color'] .'" data-section-name="'. $section_data['prefix'] .'">
                    
                              '. do_shortcode( $section_data['html'] ) .'
                          
                          </section>';
                                    
                break;                                                                                                                              
               
               /**
                *
                * end
                * 
                */                                                                
            } 
        }
    }
    
    else { ?>
<section id="not-found">
                
    <h3><?php _e( 'Page <span>not found</span>', 'martanian' ); ?></h3>
    <div class="header-line">
                                
        <div class="gray-line"></div>
        <div class="color-line"></div>
    
    </div>
    
    <p class="space"><?php _e( 'It looks like nothing was found here.', 'martanian' ); ?></p>
    <p><?php _e( 'Please try one of the links below or use this search form:', 'martanian' ); ?></p>
    
    <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                       
        <input type="text" placeholder="<?php _e( 'Type and hit enter...', 'martanian' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="search-form" />
     
    </form>

</section>
    <?php
    
    }

    # load footer
    get_footer();

?>
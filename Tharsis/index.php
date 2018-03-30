<?php 
global $tharsis;
if(isset($_POST['submit']))
{
    if( !$_POST['name'] || !$_POST['email'] || !$_POST['comment'] || $_POST['name'] == '' || $_POST['email'] == ''|| $_POST['comment'] == '')
    {
        $error = 'Please fill in all the required fields';
    }
    else 
    {
            $absolute_path = __FILE__;
            $path_to_file = explode( 'wp-content', $absolute_path );
            $path_to_wp = $path_to_file[0];

            // Access WordPress
            require_once( $path_to_wp . '/wp-load.php' );
            $tharsis = get_option('Tharsis');
            $name = esc_html($_POST['name']);
            $email = esc_html($_POST['email']);
            $comment = esc_html($_POST['comment']);
            $msg = esc_attr('Name: ', 'Tharsis') . $name . PHP_EOL;
            $msg .= esc_attr('E-mail: ', 'Tharsis') . $email . PHP_EOL;
            $msg .= esc_attr('Message: ', 'Tharsis') . $comment;
            $to = $tharsis['email'];
            $sitename = is_multisite() ? $current_site->site_name : get_bloginfo('name');
            $subject = '[' . $sitename . ']' . ' New Message';
            $headers = 'From: ' . $name . ' <' . $email . '>' . PHP_EOL;
           // wp_mail($to, $subject, $msg, $headers);
    }
}
get_header(); ?>    
    <?php 
    if ( ( $locations = get_nav_menu_locations() ) && $locations['top-menu'] ) {
        $menu = wp_get_nav_menu_object( $locations['top-menu'] );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $include = array();
        foreach($menu_items as $item) {
            if($item->object == 'page')
                $include[] = $item->object_id;
        }
        query_posts( array( 'post_type' => 'page', 'post__in' => $include, 'posts_per_page' => count($include), 'orderby' => 'post__in' ) );
    }
    else
    {
        if(isset($tharsis['pages_topmenu']) && $tharsis['pages_topmenu'] != '' )
            query_posts(array( 'post_type' => 'page', 'post__in' => $tharsis['pages_topmenu'], 'posts_per_page' => count($tharsis['pages_topmenu']), 'orderby' => 'menu_order', 'order' => 'ASC' ) );
        else
            query_posts(array( 'post_type' => 'page', 'posts_per_page' => 4, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
    }
    $i = 1;
    while(have_posts() ) : the_post(); ?>
        <div class="bg" id="<?php echo $post->post_name;?>">
            <div class="container">
                <div class="sixteen columns">
                    <div class="headline">
                        <div style="height: 68px">
                            <?php $icon = get_post_meta($post->ID, 'icon', true); if($icon != '') { ?>
                            <img src="<?php echo $icon;?>" />
                            <?php } ?>
                        </div>
                        <h2><?php $top_title = get_post_meta($post->ID, 'top_title', true); if($top_title != '') echo $top_title; else the_title();?></h2>
                        <p><?php echo get_post_meta($post->ID, 'headline', true);?></p>
                    </div>
                 </div> <!-- end sixteen columns -->
                 <div class="clear"></div>

            <?php the_content('');?>
                
            </div> <!-- end container -->
        </div> <!-- end bg -->
        <div class="jagged2" id="work-hook"></div>
        <div class="separator">
            <?php $headline = get_post_meta($post->ID, 'slogan', true); if($headline != '') { ?>
                <p>“<?php echo $headline;?>”</p>
            <?php } else echo '<p>&nbsp;</p>';?>
        </div>
        <div class="jagged3"></div>
    <?php $i++; endwhile; wp_reset_query(); ?>
    

    <div id="contact-layout">
        <div class="container">
        
            <div class="sixteen columns">
                <div class="headline">
                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-contact.png" alt="" />
                    <h2><?php _e('Contact', 'Tharsis');?></h2>
                    <?php if(isset($tharsis['contact_description'])) { ?><p><?php echo $tharsis['contact_description'];?></p><?php } ?>
                </div> <!-- end headline -->
            </div> <!-- end sixteen columns -->
            
            <div class="clear"></div>
            
            <div class="sixteen columns">
                <?php if(isset($tharsis['googlemaps']) && $tharsis['googlemaps'] != '') { ?>
                <iframe class="map" width="932" height="292" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $tharsis['googlemaps'];?>"></iframe>
                <?php } ?>
            </div> <!-- end sixteen columns -->
            
            <div class="ten columns">
                <div class="contact-form">
                    
                    <div class="done">
                        <?php _e('<b>Thank you!</b> We have received your message.', 'Tharsis');?>
                    </div>
                
                    <form method="post" action="process.php">
                        <p><?php _e('name', 'Tharsis');?></p>
                        <input type="text" name="name" class="text" />
                        
                        <p><?php _e('email', 'Tharsis');?></p>
                        <input type="text" name="email" class="text" id="email" />

                        <p><?php _e('message', 'Tharsis');?></p>
                        <textarea name="comment" class="text"></textarea>

                        <input type="submit" id="submit" value="<?php _e('send', 'Tharsis');?>" class="submit-button" />
                    </form>
                        
                </div> <!-- end contact-form -->
            </div> <!-- end ten columns -->
            
            <div class="six columns">
            
                <div class="contact-info">
                    <h5><?php _e('Contact Info', 'Tharsis');?></h5>
                     <?php if(isset($tharsis['email']) && $tharsis['email'] != '') { ?><p><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-email.png" alt="" /> <?php echo encEmail($tharsis['email']);?></p><?php } ?>
                    <?php if(isset($tharsis['phone']) && $tharsis['phone'] != '') { ?><p><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-phone.png" alt="" /> <?php echo $tharsis['phone'];?></p><?php } ?>
                    <?php if(isset($tharsis['location']) && $tharsis['location'] != '') { ?><p><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-address.png" alt="" /> <?php echo $tharsis['location'];?></p><?php } ?>
                </div> <!-- end contact-info -->
                
                <div class="social-bottom">
                    <ul>
                        <?php if(isset($tharsis['skype_url']) && $tharsis['skype_url'] != '') { ?><li><a href="<?php echo $tharsis['skype_url'];?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-skype2.png" alt="" /></a></li><?php } ?>
                        <?php if(isset($tharsis['facebook_url']) && $tharsis['facebook_url'] != '') { ?><li><a href="<?php echo $tharsis['facebook_url'];?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-facebook2.png" alt="" /></a></li><?php } ?>
                        <?php if(isset($tharsis['linkedin_url']) && $tharsis['linkedin_url'] != '') { ?><li><a href="<?php echo $tharsis['linkedin_url'];?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-linkedin.png" alt="" /></a></li><?php } ?>
                        <?php if(isset($tharsis['gplus_url']) && $tharsis['gplus_url'] != '') { ?><li><a href="<?php echo $tharsis['gplus_url'];?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-gplus.png" alt="" /></a></li><?php } ?>
                        <?php if(isset($tharsis['pinterest_url']) && $tharsis['pinterest_url'] != '') { ?><li><a href="<?php echo $tharsis['pinterest_url'];?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-pinterest.png" alt="" /></a></li><?php } ?>
                        <?php if(isset($tharsis['dribble_url']) && $tharsis['dribble_url'] != '') { ?><li><a href="<?php echo $tharsis['dribble_url'];?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-dribbble.png" alt="" /></a></li><?php } ?>
                        <?php if(isset($tharsis['twitter_username']) && $tharsis['twitter_username'] != '') { ?><li><a href="http://twitter.com/<?php echo $tharsis['twitter_username'];?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/icn-twitter2.png" alt="" /></a></li><?php } ?>
                    </ul>
                </div>
                
            </div> <!-- end six columns -->
    
        </div> <!-- end container -->
    </div> <!-- end contact -->
    
    
    <div class="jagged2"></div>
<?php get_footer();?>
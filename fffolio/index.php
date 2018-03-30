<?php 
global $fffolio;
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
            $scrn = get_option('scrn');
            $name = esc_html($_POST['name']);
            $email = esc_html($_POST['email']);
            $comment = esc_html($_POST['comment']);
            $msg = esc_attr('Name: ', 'SCRN') . $name . PHP_EOL;
            $msg .= esc_attr('E-mail: ', 'SCRN') . $email . PHP_EOL;
            $msg .= esc_attr('Message: ', 'SCRN') . $comment;
            $to = $scrn['email'];
            $sitename = get_bloginfo('name');
            $subject = '[' . $sitename . ']' . ' New Message';
            $headers = 'From: ' . $name . ' <' . $email . '>' . PHP_EOL;
            wp_mail($to, $subject, $msg, $headers);
    }
}
get_header();
    if ( ( $locations = get_nav_menu_locations() ) && $locations['top-menu'] ) {
        $menu = wp_get_nav_menu_object( $locations['top-menu'] );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $include = array();
        foreach($menu_items as $item) {
            if($item->object == 'page')
                $include[] = $item->object_id;
        }
        query_posts( array( 'post_type' => 'page', 'post__in' => $include, 'posts_per_page' => count($include), 'orderby' => 'post__in' ) );
        $numposts = count($include);
    }
    else
    {
        if(isset($scrn['pages_topmenu']) && $scrn['pages_topmenu'] != '' ) {
            query_posts(array( 'post_type' => 'page', 'post__in' => $scrn['pages_topmenu'], 'posts_per_page' => count($scrn['pages_topmenu']), 'orderby' => 'menu_order', 'order' => 'ASC' ) );
            $numposts = count($scrn['pages_topmenu']);
        }
        else {
            query_posts(array( 'post_type' => 'page', 'posts_per_page' => 4, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
            $numposts = 4;
        }
    }
    $i = 1;
    while(have_posts() ) : the_post(); ?>  
        <?php if($i != 1) { ?>
            <div id="<?php echo $post->post_name;?>-menu"></div> <!-- nav bar anchor -->
            <div class="jagged"></div>
            <div class="separator"></div>
            <div class="jagged_bottom"></div>
            
        <?php } ?>
         <div class="clear"></div>

        <div id="home_<?php echo $i;?>" class="page_bg" <?php if($i == 1) echo ' style="margin-top: -70px"';?>>
            <div class="container">
                <div class="sixteen columns">
                    <h2 <?php if($i == 1) echo ' style="margin-top: 30px"';?>>
                        <?php the_title();?>
                    </h2>
                    <?php
                    $subtitle = get_post_meta($post->ID, 'subtitle', true);
                    if($subtitle != '') 
                        echo '<p>' . $subtitle . '</p>';
                    ?>
                </div>
                <div class="clear"></div>
                <?php the_content('');?>            
            </div> <!-- end container -->
        </div> <!-- end services -->
    <?php 
    $i++;
    endwhile; wp_reset_postdata();
    ?>
    <div id="contact-menu"></div> <!-- nav bar anchor -->
    <div class="jagged"></div>
    <div class="separator"></div>
    <div class="jagged_bottom_color"></div>
    
    
    <div id="contact">
        <div class="container">
            <div class="sixteen columns">
                <h2><?php _e('CONTACT', 'fffolio');?></h2>
                <p><?php if(isset($fffolio['contact_description']) && $fffolio['contact_description'] != '') echo esc_attr($fffolio['contact_description']);?></p>
            </div> <!-- end sixteen columns -->
            
            <div class="eight columns">
                <div class="contact_form">
                    
                    <div class="done">
                        <b><?php _e('Thank you!', 'fffolio');?></b> <?php _e('I have received your message.', 'fffolio');?>
                    </div>
                
                    <form method="post" action="#">
                        <p><?php _e('name', 'fffolio');?></p>
                        <input type="text" name="name" class="text" />
                        
                        <p><?php _e('email', 'fffolio');?></p>
                        <input type="text" name="email" class="text" id="email" />

                        <p><?php _e('message', 'fffolio');?></p>
                        <textarea name="comment" class="text"></textarea>

                        <input type="submit" id="submit" value="<?php _e('send', 'fffolio');?>" class="submit-button" />
                    </form>
                        
                </div> <!-- end contact_form -->
            </div> <!-- end eight columns -->
            
            <div class="eight columns">
            
                <?php if(isset($fffolio['google_map']) && $fffolio['google_map'] != '') echo $fffolio['google_map'];?>
                
                <div class="contact_info">
                    <?php if( (isset($fffolio['phone']) && $fffolio['phone'] != '') ||
                            ( isset($fffolio['email']) && $fffolio['email'] != '') ) { ?>
                        <div class="four columns alpha">
                            <?php if(isset($fffolio['phone']) && $fffolio['phone'] != '') { ?>
                                <p>
                                    <img src="<?php echo get_template_directory_uri() . '/';?>images/icn_phone.png" alt="phone icon" /> 
                                     <?php echo $fffolio['phone'];?>
                                </p>
                            <?php } ?>

                            <?php if(isset($fffolio['email']) && $fffolio['email'] != '') { ?>
                                <p>
                                    <img src="<?php echo get_template_directory_uri() . '/';?>images/icn_mail.png" alt="email icon" /> 
                                    <?php echo encEmail($fffolio['email']);?>
                                </p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php if(isset($fffolio['address']) && $fffolio['address'] != '') { ?>
                        <div class="four columns omega">
                            <p>
                                <img src="<?php echo get_template_directory_uri() . '/';?>images/icn_address.png" alt="" /> 
                                <?php echo $fffolio['address'];?>
                            </p>
                        </div>
                    <?php } ?>
                </div>
                
            </div> <!-- end eight columns -->
            
        </div> <!-- end container -->
    </div> <!-- end contact -->
    
<?php get_footer();?>
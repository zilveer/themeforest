<?php
/* 
Template name: Home Template
*/
global $lb_opc;
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
            $lb_opc_opc = get_option('lb_opc');
            $name = esc_html($_POST['name']);
            $email = esc_html($_POST['email']);
            $comment = esc_html($_POST['comment']);
            $msg = esc_attr('Name: ', 'LB') . $name . PHP_EOL;
            $msg .= esc_attr('E-mail: ', 'LB') . $email . PHP_EOL;
            $msg .= esc_attr('Message: ', 'LB') . $comment;
            $to = $lb_opc_opc['email'];
            $sitename = get_bloginfo('name');
            $subject = '[' . $sitename . ']' . ' New Message';
            $headers = 'From: ' . $name . ' <' . $email . '>' . PHP_EOL;
            wp_mail($to, $subject, $msg, $headers);
    }
}
get_header(); ?>

<!-- Header Page -->
    <a id="home-top"></a>
    <div id="intro">
    
        <div class="fundoum"></div>
        
        <div class="title">
            <?php if(isset($lb_opc['logo']) && $lb_opc['logo'] != '') { ?>
                <img src="<?php echo esc_url($lb_opc['logo']);?>" alt="<?php bloginfo('name');?>" />
            <?php } 
            else { ?>
                <div class="intro-header-space"></div>
                <?php if(isset($lb_opc['logo_header']) && $lb_opc['logo_header']) { ?>
                    <img src="<?php echo $lb_opc['logo_header'];?>" alt="logo" />
                <?php } ?>
                <div class="intro-header-space"></div>
            <?php } ?>
            <?php if(isset($lb_opc['topheader_smallertext']) && $lb_opc['topheader_smallertext']) { ?>
                <p><?php echo $lb_opc['topheader_smallertext'];?></p>
            <?php } ?>
            <div class="social-intro">
                <ul>
                    <?php if(isset($lb_opc['facebook_url']) && $lb_opc['facebook_url'] != '') { ?><li><a target="_blank" href="<?php echo $lb_opc['facebook_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-facebook-top.png" alt="Facebook" /></a></li><?php } ?>
                    <?php if(isset($lb_opc['twitter_username']) && $lb_opc['twitter_username'] != '') { ?><li><a target="_blank" href="http://twitter.com/<?php echo $lb_opc['twitter_username'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-twitter-top.png" alt="Twitter" /></a></li><?php } ?>
                    <?php if(isset($lb_opc['gplus_url']) && $lb_opc['gplus_url'] != '') { ?><li><a target="_blank" href="<?php echo $lb_opc['gplus_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-gplus-top.png" alt="Google+ icon" /></a></li><?php } ?>
                    <?php if(isset($lb_opc['linkedin_url']) && $lb_opc['linkedin_url'] != '') { ?><li><a target="_blank" href="<?php echo $lb_opc['linkedin_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-linkedin-top.png" alt="Linkedin" /></a></li><?php } ?>
                    <?php if(isset($lb_opc['flickr_url']) && $lb_opc['flickr_url'] != '') { ?><li><a target="_blank" href="<?php echo $lb_opc['flickr_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-flickr-top.png" alt="Flickr" /></a></li><?php } ?>
                    <?php if(isset($lb_opc['soundcloud_url']) && $lb_opc['soundcloud_url'] != '') { ?><li><a target="_blank" href="<?php echo $lb_opc['soundcloud_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-soundcloud-top.png" alt="SoundCloud" /></a></li><?php } ?>
                    <?php if(isset($lb_opc['dribble_url']) && $lb_opc['dribble_url'] != '') { ?><li><a target="_blank" href="<?php echo $lb_opc['dribble_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-dribbble-top.png" alt="Dribbble" /></a></li><?php } ?>
                    <?php if(isset($lb_opc['vimeo_url']) && $lb_opc['vimeo_url'] != '') { ?><li><a target="_blank" href="<?php echo $lb_opc['vimeo_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-vimeo-top.png" alt="Vimeo" /></a></li><?php } ?>
                    <?php if(isset($lb_opc['pinterest_url']) && $lb_opc['pinterest_url'] != '') { ?><li><a target="_blank" href="<?php echo $lb_opc['pinterest_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-pinterest-top.png" alt="Pinterest" /></a></li><?php } ?>
                    <?php if(isset($lb_opc['youtube_url']) && $lb_opc['youtube_url'] != '') { ?><li><a target="_blank" href="<?php echo $lb_opc['youtube_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-youtube-top.png" alt="Youtube" /></a></li><?php } ?>
                    <?php if(isset($lb_opc['instagram_url']) && $lb_opc['instagram_url'] != '') { ?><li><a target="_blank" href="<?php echo $lb_opc['instagram_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-instagram-top.png" alt="Instagram" /></a></li><?php } ?>
                    <?php if(isset($lb_opc['behance_url']) && $lb_opc['behance_url'] != '') { ?><li><a target="_blank" href="<?php echo $lb_opc['behance_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/s-behance-top.png" alt="Behance" /></a></li><?php } ?>
                </ul>
            </div> <!-- end social -->
        </div> <!-- end title -->
    </div> <!-- end header page -->
  
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
        if(isset($lb_opc['pages_topmenu']) && $lb_opc['pages_topmenu'] != '' )
            query_posts(array( 'post_type' => 'page', 'post__in' => $lb_opc['pages_topmenu'], 'posts_per_page' => count($lb_opc['pages_topmenu']), 'orderby' => 'menu_order', 'order' => 'ASC' ) );
        else
            query_posts(array( 'post_type' => 'page', 'posts_per_page' => 4, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
    }
    $i = 1;
    while(have_posts() ) : the_post();
    ?>
        <div class="bg section" id="<?php echo $post->post_name;?>">
            <div class="container">
                <div class="sixteen columns">
                        <h2>
                            <span class="page-titles">
                                <?php $top_title = get_post_meta($post->ID, 'top_title', true); 
                                if($top_title != '') echo $top_title; else the_title();?>
                            </span>
                        </h2>
                 </div> <!-- end sixteen columns -->

                 <div class="clear"></div>

            <?php global $more; $more = 0; the_content('');?>
                
            </div> <!-- end container -->
        </div> <!-- end bg -->
        <div id="divisor-<?php echo $i;?>" class="divisor-first">
            <div class="bg<?php echo ($i+1); echo ' bg';?>" style="<?php if($sloganimg != '') echo 'background-image: url(\'' . $sloganimg . '\')';?> "></div>

        </div>
    <?php $i++; endwhile; wp_reset_query(); ?>

    <div id="contact">
        <div class="container">
        
            <div class="sixteen columns">
                <h2 class="white"><span class="page-titles"><?php _e('Contact', 'LB');?></span></h2>
            </div> <!-- end sixteen columns -->

            <?php if(isset($lb_opc['contact_description']) && $lb_opc['contact_description'] != '') { ?>
                <div class="sixteen columns">
                    <p><?php echo esc_attr($lb_opc['contact_description']);?></p>
                </div> <!-- end sixteen columns -->
            <?php } ?>
            
            <div class="clear"></div>

            <div class="five columns">

                <h5><?php _e('Contact Info', 'LB');?></h5>
                
                <div class="contact-info">

								<ul>
									<?php if(isset($lb_opc['phone']) && $lb_opc['phone'] != '') { ?>
                                        <li class="contact-info-subtitle">-<span>Telephone</span></li>
									    <li class="contact-info-content"><?php echo $lb_opc['phone'];?></li>
                                    <?php } ?>
                                    <?php if(isset($lb_opc['email']) && $lb_opc['email'] != '') { ?>
									    <li class="contact-info-subtitle">-<span>E-mail</span></li>
									    <li class="contact-info-content"><a href="mailto:<?php echo $lb_opc['email'];?>"><?php echo encEmail($lb_opc['email']);?></a></li>
                                    <?php } ?>
                                    <?php if(isset($lb_opc['location']) && $lb_opc['location'] != '') { ?>
									    <li class="contact-info-subtitle">-<span>Address</span></li>
									    <li class="contact-info-content"><?php echo $lb_opc['location'];?></li>
                                    <?php } ?>
								</ul>

                </div> <!-- end contact-info -->
                
                <div class="social"></div>
                
            </div> <!-- end eight columns -->
            
            <div class="eleven columns">
                <div class="contact-form">
                    
					<?php //echo do_shortcode( '[contact-form-7 id="1234" title="Contact form 1"]' ); ?>
                    <?php echo do_shortcode( $lb_opc['contactseven'] ); ?>
                        
                </div> <!-- end contact-form -->
            </div> <!-- end eight columns -->
            
            <div class="clear"></div>
            
            
        </div> <!-- end container -->
        
    </div> <!-- end contact -->

    
    
<?php get_footer();?>
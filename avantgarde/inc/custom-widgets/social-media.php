<?php  

    add_action( 'widgets_init', 'init_social_widget' );
    function init_social_widget() { return register_widget('social_widget'); }
    
    class social_widget extends WP_Widget {
        function social_widget() {
            parent::WP_Widget( 'init_social_widget', $name = '[ CUSTOM ] Social Media ');
        }

	
	function widget( $args, $instance ) {
		extract( $args );
    $title = $instance['title'];
    ?>
        <?php echo $before_widget; ?>

        <?php if($title != ""){ ?>           
        <h6><?php echo $title; ?></h6>
        <hr>
        <?php } ?>
        <div class="social-widget    pos-center clearfix">
            <ul>
                <?php 
                global $theme_prefix; 

                if ($theme_prefix['behance-header'] != "") { ?><li class="behance"><a title="<?php echo __("behance","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['behance-header']); ?>"><i class="fa fa-behance "></i><?php echo __("Behance","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['deviantart-header'] != "") { ?><li class="deviantart"><a title="<?php echo __("deviantart","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['deviantart-header']); ?>"><i class="fa fa-deviantart "></i><?php echo __("Deviantart","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['dribbble-header'] != "") { ?><li class="dribbble"><a title="<?php echo __("dribbble","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['dribbble-header']); ?>"><i class="fa fa-dribbble "></i><?php echo __("Dribbble","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['facebook-header'] != "") { ?><li class="facebook"><a title="<?php echo __("Facebook","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['facebook-header']); ?>"><i class="fa fa-facebook "></i><?php echo __("Facebook","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['github-header'] != "") { ?><li class="github"><a title="<?php echo __("github","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['github-header']); ?>"><i class="fa fa-github "></i><?php echo __("Github","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['flickr-header'] != "") { ?><li class="flickr"><a title="<?php echo __("Flickr","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['flickr-header']); ?>"><i class="fa fa-flickr "></i><?php echo __("Flickr","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['foursquare-header'] != "") { ?><li class="foursquare"><a title="<?php echo __("Foursquare","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['foursquare-header']); ?>"><i class="fa fa-foursquare "></i><?php echo __("Foursquare","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['google-plus-header'] != "") { ?><li class="google-plus"><a title="<?php echo __("Google +","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['google-plus-header']); ?>"><i class="fa fa-google-plus "></i><?php echo __("Google Plus","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['instagram-header'] != "") { ?><li class="instagram"><a title="<?php echo __("Instagram","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['instagram-header']); ?>"><i class="fa fa-instagram "></i><?php echo __("Instagram","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['linkedin-header'] != "") { ?><li class="linkedin"><a title="<?php echo __("Linkedin","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['linkedin-header']); ?>"><i class="fa fa-linkedin "></i><?php echo __("Linkedin","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['medium-header'] != "") { ?><li class="medium"><a title="<?php echo __("medium","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['medium-header']); ?>"><i class="fa fa-medium"></i><?php echo __("Medium","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['pinterest-header'] != "") { ?><li class="pinterest"><a title="<?php echo __("Pinterest","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['pinterest-header']); ?>"><i class="fa fa-pinterest "></i><?php echo __("Pinterest","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['reddit-header'] != "") { ?><li class="reddit"><a title="<?php echo __("reddit","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['reddit-header']); ?>"><i class="fa fa-reddit "></i><?php echo __("Reddit","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['stumbleupon-header'] != "") { ?><li class="stumbleupon"><a title="<?php echo __("stumbleupon","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['stumbleupon-header']); ?>"><i class="fa fa-stumbleupon "></i><?php echo __("Stumbleupon","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['tumblr-header'] != "") { ?><li class="tumblr"><a title="<?php echo __("Tumblr","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['tumblr-header']); ?>"><i class="fa fa-tumblr "></i><?php echo __("Tumblr","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['twitter-header'] != "") { ?><li class="twitter"><a title="<?php echo __("Twitter","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['twitter-header']); ?>"><i class="fa fa-twitter "></i><?php echo __("Twitter","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['vimeo-header'] != "") { ?><li class="vimeo"><a title="<?php echo __("Vimeo","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['vimeo-header']); ?>"><i class="fa fa-vimeo-square"></i><?php echo __("Vimeo","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['vine-header'] != "") { ?><li class="vine"><a title="<?php echo __("vine","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['vine-header']); ?>"><i class="fa fa-vine"></i><?php echo __("Vine","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['vk-header'] != "") { ?><li class="vk"><a title="<?php echo __("vk","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['vk-header']); ?>"><i class="fa fa-vk"></i><?php echo __("Vk","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['whatsapp-header'] != "") { ?><li class="whatsapp"><a title="<?php echo __("whatsapp","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['whatsapp-header']); ?>"><i class="fa fa-whatsapp"></i><?php echo __("Whatsapp","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['wordpress-header'] != "") { ?><li class="wordpress"><a title="<?php echo __("wordpress","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['wordpress-header']); ?>"><i class="fa fa-wordpress"></i><?php echo __("Wordpress","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['youtube-header'] != "") { ?><li class="youtube"><a title="<?php echo __("Youtube","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['youtube-header']); ?>"><i class="fa fa-youtube "></i><?php echo __("Youtube","theme2035"); ?></a></li><?php } ?>
                <?php if ($theme_prefix['custom-site-name-1'] != "") { ?><li class="custom-logo custom-site-name-1"><a title="<?php echo __("custom-site-name-1","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['custom-site-url-1']); ?>"><img alt="<?php echo esc_attr($theme_prefix['custom-site-name-1']); ?>" src="<?php echo esc_attr($theme_prefix['custom-site-logo-1']['url']); ?>"><?php echo esc_attr($theme_prefix['custom-site-name-1']); ?></a></li><?php } ?>
                <?php if ($theme_prefix['custom-site-name-2'] != "") { ?><li class="custom-logo custom-site-name-2"><a title="<?php echo __("custom-site-name-2","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['custom-site-url-2']); ?>"><img alt="<?php echo esc_attr($theme_prefix['custom-site-name-2']); ?>" src="<?php echo esc_attr($theme_prefix['custom-site-logo-2']['url']); ?>"><?php echo esc_attr($theme_prefix['custom-site-name-2']); ?></a></li><?php } ?>
                <?php if ($theme_prefix['custom-site-name-3'] != "") { ?><li class="custom-logo custom-site-name-3"><a title="<?php echo __("custom-site-name-3","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['custom-site-url-3']); ?>"><img alt="<?php echo esc_attr($theme_prefix['custom-site-name-3']); ?>" src="<?php echo esc_attr($theme_prefix['custom-site-logo-3']['url']); ?>"><?php echo esc_attr($theme_prefix['custom-site-name-3']); ?></a></li><?php } ?>
            </ul>                   
        </div>
        <?php echo $after_widget; ?>
        <?php 
	    }
	
	function update( $new_instance, $old_instance ) {
		    $instance = $old_instance;
            $instance['title'] = strip_tags( $new_instance['title'] );
		    return $instance;
	}
	
    function form( $instance ) {

		$defaults = array(
            'title' => 'Social Media',
 			);
		    $instance = wp_parse_args( (array) $instance, $defaults );?>

  

        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __('Title:', 'theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
        </p>




            

   <?php }} 
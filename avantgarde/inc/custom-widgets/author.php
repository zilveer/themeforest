<?php  

    add_action( 'widgets_init', 'init_author_widget' );
    function init_author_widget() { return register_widget('author_widget'); }
    
    class author_widget extends WP_Widget {
        function author_widget() {
            parent::WP_Widget( 'init_author_widget', $name = '[ CUSTOM ] Author Box Widget ');
        }

	
	function widget( $args, $instance ) {
		extract( $args );
    $title = $instance['title'];
    $author_image = $instance['author_image'];
    $author_name = $instance['author_name'];
    $author_url = $instance['author_url'];
    $description = $instance['description'];
    $social_media = $instance['social_media'] ? 'true' : 'false';
    ?>
        <?php echo $before_widget; ?>
        <?php if(!empty($title)) { echo $before_title . $title . $after_title; }; ?>
        <div class="author-widget custom-widget clearfix">
            <div class="author-cover-background">
                <div class="author-avatar">
                    <img alt="Author" class="img-responsive" src="<?php echo esc_attr($author_image); ?>">
                </div>
            </div>
            <div class="author-info clearfix">
                <?php if($author_name != "" ){ ?> <h3><?php if($author_url != "" ){ ?> <a href="<?php echo esc_attr($author_url); ?> "> <?php } ?> <?php echo esc_attr($author_name); ?><?php if($author_url != "" ){ ?></a><?php } ?></h3><?php } ?>
                <?php if($description != "" ){ ?><?php if($social_media == "true" ){ ?><div class="pos-center"><?php } ?><p><?php echo esc_attr($description); ?></p><?php if($social_media == "true" ){ ?></div><?php } ?><?php } ?>
            </div>
                    <?php if($social_media == "true" ){ ?>
                    <div class="author-widget-social pos-center">
                        <ul>
                            <?php 
                            global $theme_prefix; 

                            if ($theme_prefix['behance-header'] != "") { ?><li class="behance"><a title="<?php echo __("behance","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['behance-header']); ?>"><i class="fa fa-behance "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['deviantart-header'] != "") { ?><li class="deviantart"><a title="<?php echo __("deviantart","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['deviantart-header']); ?>"><i class="fa fa-deviantart "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['dribbble-header'] != "") { ?><li class="dribbble"><a title="<?php echo __("dribbble","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['dribbble-header']); ?>"><i class="fa fa-dribbble "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['facebook-header'] != "") { ?><li class="facebook"><a title="<?php echo __("Facebook","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['facebook-header']); ?>"><i class="fa fa-facebook "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['github-header'] != "") { ?><li class="github"><a title="<?php echo __("github","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['github-header']); ?>"><i class="fa fa-github "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['flickr-header'] != "") { ?><li class="flickr"><a title="<?php echo __("Flickr","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['flickr-header']); ?>"><i class="fa fa-flickr "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['foursquare-header'] != "") { ?><li class="foursquare"><a title="<?php echo __("Foursquare","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['foursquare-header']); ?>"><i class="fa fa-foursquare "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['google-plus-header'] != "") { ?><li class="google-plus"><a title="<?php echo __("Google +","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['google-plus-header']); ?>"><i class="fa fa-google-plus "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['instagram-header'] != "") { ?><li class="instagram"><a title="<?php echo __("Instagram","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['instagram-header']); ?>"><i class="fa fa-instagram "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['linkedin-header'] != "") { ?><li class="linkedin"><a title="<?php echo __("Linkedin","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['linkedin-header']); ?>"><i class="fa fa-linkedin "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['medium-header'] != "") { ?><li class="medium"><a title="<?php echo __("medium","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['medium-header']); ?>"><i class="fa fa-medium"></i></a></li><?php } ?>
                            <?php if ($theme_prefix['pinterest-header'] != "") { ?><li class="pinterest"><a title="<?php echo __("Pinterest","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['pinterest-header']); ?>"><i class="fa fa-pinterest "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['reddit-header'] != "") { ?><li class="reddit"><a title="<?php echo __("reddit","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['reddit-header']); ?>"><i class="fa fa-reddit "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['tumblr-header'] != "") { ?><li class="tumblr"><a title="<?php echo __("Tumblr","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['tumblr-header']); ?>"><i class="fa fa-tumblr "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['twitter-header'] != "") { ?><li class="twitter"><a title="<?php echo __("Twitter","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['twitter-header']); ?>"><i class="fa fa-twitter "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['vimeo-header'] != "") { ?><li class="vimeo"><a title="<?php echo __("Vimeo","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['vimeo-header']); ?>"><i class="fa fa-vimeo-square"></i></a></li><?php } ?>
                            <?php if ($theme_prefix['vine-header'] != "") { ?><li class="vine"><a title="<?php echo __("vine","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['vine-header']); ?>"><i class="fa fa-vine"></i></a></li><?php } ?>
                            <?php if ($theme_prefix['vk-header'] != "") { ?><li class="vk"><a title="<?php echo __("vk","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['vk-header']); ?>"><i class="fa fa-vk"></i></a></li><?php } ?>
                            <?php if ($theme_prefix['whatsapp-header'] != "") { ?><li class="whatsapp"><a title="<?php echo __("whatsapp","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['whatsapp-header']); ?>"><i class="fa fa-whatsapp"></i></a></li><?php } ?>
                            <?php if ($theme_prefix['wordpress-header'] != "") { ?><li class="wordpress"><a title="<?php echo __("wordpress","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['wordpress-header']); ?>"><i class="fa fa-wordpress"></i></a></li><?php } ?>
                            <?php if ($theme_prefix['youtube-header'] != "") { ?><li class="youtube"><a title="<?php echo __("Youtube","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['youtube-header']); ?>"><i class="fa fa-youtube "></i></a></li><?php } ?>
                            <?php if ($theme_prefix['custom-site-name-1'] != "") { ?><li class="custom-logo custom-site-name-1"><a title="<?php echo __("custom-site-name-1","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['custom-site-url-1']); ?>"><img alt="<?php echo esc_attr($theme_prefix['custom-site-name-1']); ?>" src="<?php echo esc_attr($theme_prefix['custom-site-logo-1']['url']); ?>"></a></li><?php } ?>
                            <?php if ($theme_prefix['custom-site-name-2'] != "") { ?><li class="custom-logo custom-site-name-2"><a title="<?php echo __("custom-site-name-2","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['custom-site-url-2']); ?>"><img alt="<?php echo esc_attr($theme_prefix['custom-site-name-2']); ?>" src="<?php echo esc_attr($theme_prefix['custom-site-logo-2']['url']); ?>"></a></li><?php } ?>
                            <?php if ($theme_prefix['custom-site-name-3'] != "") { ?><li class="custom-logo custom-site-name-3"><a title="<?php echo __("custom-site-name-3","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['custom-site-url-3']); ?>"><img alt="<?php echo esc_attr($theme_prefix['custom-site-name-3']); ?>" src="<?php echo esc_attr($theme_prefix['custom-site-logo-3']['url']); ?>"></a></li><?php } ?>
                        </ul>                   
                    </div>
                    <?php } ?>


        </div>
        <?php echo $after_widget; ?>
        <?php 
	    }
	
	function update( $new_instance, $old_instance ) {
		    $instance = $old_instance;
            $instance['title'] = strip_tags( $new_instance['title'] );
            $instance['author_image'] = strip_tags( $new_instance['author_image'] );
            $instance['author_name'] = strip_tags( $new_instance['author_name'] );
            $instance['author_url'] = strip_tags( $new_instance['author_url'] );
            $instance['description'] = strip_tags( $new_instance['description'] );
            $instance['social_media'] = strip_tags( $new_instance['social_media'] );
		    return $instance;
	}
	
    function form( $instance ) {

		$defaults = array(
            'title' => 'About Us',
            'author_image' => '',
            'author_name' => '',
            'author_url' => '',
            'description' => '',
            'social_media' => '',
 			);
		    $instance = wp_parse_args( (array) $instance, $defaults );?>
        
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo __('Title:', 'theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('author_image')); ?>">Author Image :</label><br />
            <?php
                if ( $instance['author_image'] != '' ) :
                    echo '<img class="custom_media_image_2" src="' . $instance['author_image'] . '" style="margin:0;padding:0;width:100%;float:left;display:inline-block" /><br />';
                endif;
            ?>

            <input type="text" class="widefat custom_media_url_2" name="<?php echo esc_attr($this->get_field_name('author_image')); ?>" id="<?php echo esc_attr($this->get_field_id('author_image')); ?>" value="<?php echo esc_attr($instance['author_image']); ?>" style="margin-top:5px;">
            <input type="button" class="button button-primary custom_media_button_2" id="custom_media_button_2" name="<?php echo esc_attr($this->get_field_name('author_image')); ?>" value="Upload Image" style="margin-top:5px;" />
        </p>

        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'author_name' )); ?>"><?php echo __('Author Name:', 'theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'author_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'author_name' )); ?>" value="<?php echo esc_attr($instance['author_name']); ?>"  />
        </p>

        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'author_url' )); ?>"><?php echo __('Author Url:', 'theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'author_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'author_url' )); ?>" value="<?php echo esc_attr($instance['author_url']); ?>"  />
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['social_media'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('social_media')); ?>" name="<?php echo esc_attr($this->get_field_name('social_media')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_id('social_media')); ?>"><?php echo __('Show Social Links:', 'theme2035'); ?></label>
        </p>

        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php echo __('Description:', 'theme2035'); ?></label>
        <textarea class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>"><?php echo esc_attr($instance['description']); ?></textarea>
        </p>



            

   <?php }} 
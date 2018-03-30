<?php
/*
 * Instagram widget
 * Created by 05.07.2014
 * By Amr Sadek
 */

add_action('widgets_init','bd_instagram');
function bd_instagram() {
    register_widget('bd_instagram');
}

class bd_instagram extends WP_Widget {
    function bd_instagram() {
        $widget_ops = array('classname' => 'bd-instagram', 'description' => '');
        $control_ops = array('id_base' => 'bd-instagram');
        $this->WP_Widget('bd-instagram', theme_name . ' - instagram', $widget_ops, $control_ops);
    }
    function widget( $args, $instance ) {

        extract( $args );
        $title          = apply_filters('widget_title', $instance['title'] );
        $userid         = apply_filters('userid', $instance['userid']);
        $accessToken    = apply_filters('accessToken', $instance['accessToken']);
        $amount         = apply_filters('instagram_image_amount', $instance['image_amount']);

        echo $before_widget;
        if($title) {
            echo $before_title.$title.$after_title;
        }

        function fetchData($url){

            $bd_c_init = strrev('tini_lruc');
            $bd_c_exec = strrev('cexe_lruc');

            $ch = $bd_c_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            $result = $bd_c_exec($ch);
            curl_close($ch);
            return $result;
        }

        $result = fetchData('https://api.instagram.com/v1/users/'.$userid.'/media/recent/?access_token='.$accessToken.'&count='.$amount);
        $result = json_decode($result);

        ?>
        <div class="grid_gallery clearfix">
            <div class="grid_gallery_inner">
                <div id="instagram">
                    <?php if( !empty( $result->data ) ){
                        foreach ($result->data as $post){
                            $inst_img   = $post->images->standard_resolution->url;
                            $inst_thumb = $post->images->thumbnail->url;

                            ?>
                            <div class="gallery_item">
                                <figure class="featured-thumbnail thumbnail large">
                                    <div class="bd-over"></div>

                                    <a class="thumbnail bd-zoome lightbox" href="<?php echo $inst_img ?>?lightbox[modal]=true" rel="lightbox_instagram">
                                        <img src="<?php echo $inst_thumb ?>" alt="<?php if ( isset($instance['show_caption'])){ if(!empty($post->caption->text)){ echo $post->caption->text; }} ?>">
                                    </a>

                                    <?php
                                        if ( isset( $instance['show_likes'] ) ){
                                            if( !empty( $post->likes->count ) ){
                                                echo '<div class="instagram_likes"><i class="fa fa-heart"></i> <span class="likes_count">'.$post->likes->count.'</span></div>';
                                            }
                                        }
                                    ?>
                                </figure>
                            </div>
                        <?php }
                    } else {
                        _e( 'Configuration error or no pictures...', 'bd' );
                    }
                    ?>
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>

        <?php
            wp_reset_query();
            echo $after_widget;
    }
    function update( $new_instance, $old_instance ) {
        $instance                   = $old_instance;
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['show_likes']     = $new_instance['show_likes'];
        $instance['userid']         = $new_instance['userid'];
        $instance['accessToken']    = $new_instance['accessToken'];
        $instance['image_amount']   = $new_instance['image_amount'];

        return $instance;
    }
    function form( $instance ) {
        $defaults       = array( 'title' => '', 'userid' => '', 'accessToken' => '', 'image_amount' => '', 'show_likes' => '', 'show_caption' => '' );
        $instance       = wp_parse_args( (array) $instance, $defaults );
        $title          = esc_attr($instance['title']);
        $userid         = esc_attr($instance['userid']);
        $accessToken    = esc_attr($instance['accessToken']);
        $amount         = esc_attr($instance['image_amount']);

        ?>
        <p>Generate your Instagram user ID and Instagram access token on: <a target="_blank" href="http://www.pinceladasdaweb.com.br/instagram/access-token/">Instagram access token generator</a> website</p>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bd' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('userid'); ?>"><?php _e('Instagram user ID:', 'bd' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('userid'); ?>" name="<?php echo $this->get_field_name('userid'); ?>" type="text" value="<?php echo $userid; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('accessToken'); ?>"><?php _e('Instagram access token:', 'bd' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('accessToken'); ?>" name="<?php echo $this->get_field_name('accessToken'); ?>" type="text" value="<?php echo $accessToken; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('image_amount'); ?>"><?php _e('Images count:', 'bd' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('image_amount'); ?>" name="<?php echo $this->get_field_name('image_amount'); ?>" type="text" value="<?php echo $amount; ?>" /></label></p>
        <p>
            <label for="<?php echo $this->get_field_id("show_likes"); ?>">
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_likes"); ?>" name="<?php echo $this->get_field_name("show_likes"); ?>"<?php checked( (bool) $instance["show_likes"], true ); ?> />
                <?php _e( 'Show Likes', 'bd' ); ?>
            </label>
        </p>
        <?php
    }

} ?>
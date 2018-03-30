<?php
/*
 * About me widget
 * Created by 05.07.2014
 * By Amr Sadek
 */

add_action( 'widgets_init', 'bd_aboutme_widget' );
function bd_aboutme_widget() {
    register_widget( 'bd_aboutme_widget' );
}

class bd_aboutme_widget extends WP_Widget {
    function bd_aboutme_widget() {
        $widget_ops = array('classname' => 'bd-aboutme-widget', 'description' => '');
        $control_ops = array('id_base' => 'bd-aboutme-widget');
        $this->WP_Widget('bd-aboutme-widget', theme_name . ' - About Me', $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {

        extract( $args );
        $title      = apply_filters( 'widget_title', $instance['title'] );
        $me_text    = $instance['me_text'];
        $me_image    = $instance['me_image'];

        echo $before_widget;
        if($title) {
            echo $before_title.$title.$after_title;
        }

        ?>

        <?php if( $me_image ){ ?>
            <div class="about-me-img">
                <figure class="featured-thumbnail thumbnail large">
                    <a class="thumbnail bd-zoome lightbox" href="<?php echo $me_image ?>?lightbox[modal]=true">
                        <img src="<?php echo $me_image ?>" alt="">
                    </a>
                </figure>
            </div><br>
        <?php } ?>

        <?php if( $me_text ){ ?>
            <div class="about-me-text"><?php echo $me_text ?></div>
        <?php } ?>

        <?php
        echo $after_widget;
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['me_image']   = $new_instance['me_image'];
        $instance['me_text']   = $new_instance['me_text'];

        return $instance;
    }
    function form( $instance ) {
        $defaults = array( 'title' =>__( 'About Me' , 'bd'));
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'me_image' ); ?>">Image : </label>
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    if(jQuery('.st_upload_button').length >= 1)
                    {
                        window.bd_uploadfield = '';
                        jQuery('.st_upload_button').live('click', function()
                        {
                            window.bd_uploadfield = jQuery('.upload-url', jQuery(this).parent());
                            tb_show('Upload', 'media-upload.php?type=image&TB_iframe=true', false);
                            return false;
                        });

                        window.bd_send_to_editor_backup = window.send_to_editor;
                        window.send_to_editor = function(html)
                        {
                            if(window.bd_uploadfield) {
                                var image_url = jQuery('img', html).attr('src');
                                jQuery(window.bd_uploadfield).val(image_url);
                                window.bd_uploadfield = '';

                                tb_remove();
                            } else {
                                window.bd_send_to_editor_backup(html);
                            }
                        }
                    }
                });            </script>

            <input id="<?php echo $this->get_field_id( 'me_image' ); ?>" name="<?php echo $this->get_field_name( 'me_image' ); ?>" value="<?php echo $instance['me_image']; ?>" class="widefat img-path upload-url bd-upload-url" type="text" />
            <input id="<?php echo $this->get_field_id( 'me_image' ); ?>_button" type="button" class="btn st_upload_button" value="Upload">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'me_text' ); ?>">Text : </label>
            <textarea rows="15" id="<?php echo $this->get_field_id( 'me_text' ); ?>" name="<?php echo $this->get_field_name( 'me_text' ); ?>" class="widefat" ><?php echo $instance['me_text']; ?></textarea>
        </p>
    <?php
    }

}
?>
<?php
class text_image extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array(
            'classname' => 'text-image',
            'description' => __( 'Arbitrary text or HTML, with a simple image above text.', 'yiw' )
        );

        $control_ops = array( 'id_base' => 'text-image', 'width' => 430 );

        WP_Widget::__construct( 'text-image', __( 'Text With Image', 'yiw' ), $widget_ops, $control_ops );


        if( is_admin() ) {
            wp_enqueue_style( 'thickbox' );
            wp_enqueue_script( 'thickbox' );
            wp_enqueue_script( 'media-upload' );
            add_action( 'admin_print_footer_scripts', array( &$this, 'add_script_textimage' ), 999 );
        }
    }

    function add_script_textimage()
    {

        ?>
        <script type="text/javascript">

            jQuery(document).ready(function($){

                $('.upload-image').live('click', function(){
                    var yiw_this_object = $(this).prev();

                    tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');

                    window.send_to_editor = function(html) {
                        imgurl = $('img', html).attr('src');
                        yiw_this_object.val(imgurl);

                        tb_remove();
                    }

                    return false;
                });

//                 var yiw_this_object = null;
//                 
//                 $('.upload-image').click(function(){
//                     yiw_this_object = $(this).prev();
//                     alert(yiw_this_object + ' + ' + $(this).prev());
//                 });
//                     
//                 window.send_to_editor = function(html) {
//                  imgurl = $('img', html).attr('src');
//                  yiw_this_object.val(imgurl);
//                  yiw_this_object = null;
//                  
//                  tb_remove();
//              }          
            });
        </script>
    <?php
    }

    function form( $instance )
    {
        global $icons_name;

        /* Impostazioni di default del widget */
        $defaults = array(
            'title' => '',
            'image' => '',
            'align' => '',
            'text' => '',
            'autop' => false
        );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label>
                <strong><?php _e( 'Title', 'yiw' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </label>
        </p>

        <p>
            <label><?php _e( 'Image', 'yiw' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" class="upload-image button-secondary">Upload</a>
            </label>
        </p>

        <p>
            <label><?php _e( 'Image Alignment', 'yiw' ) ?>:
                <select id="<?php echo $this->get_field_id( 'align' ); ?>" name="<?php echo $this->get_field_name( 'align' ); ?>">
                    <option value="left"<?php if($instance['align']=='left'): ?>selected="selected"<?php endif ?>>Left</option>
                    <option value="center"<?php if($instance['align']=='center'): ?>selected="selected"<?php endif ?>>Center</option>
                    <option value="right"<?php if($instance['align']=='right'): ?>selected="selected"<?php endif ?>>Right</option>
                </select>
            </label>
        </p>


        <p>
            <label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" cols="20" rows="16"><?php echo $instance['text']; ?></textarea>
            </label>
        </p>

        <p>
            <label>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'autop' ); ?>" name="<?php echo $this->get_field_name( 'autop' ); ?>" value="1"<?php if( $instance['autop'] ) echo ' checked="checked"' ?> />
                <?php _e( 'Automatically add paragraphs', 'yiw' ) ?>
            </label>
        </p>
    <?php
    }

    function widget( $args, $instance )
    {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );

        echo $before_widget;

        if ( $title ) echo $before_title . $title . $after_title;

        if( $instance['autop'] )
            $instance['text'] = wpautop( $instance['text'] );

        $clear_text = apply_filters( 'widget_text', yit_wpml_string_translate( 'Widgets', 'widget_text_image' . sanitize_title( $instance['text'] ), $instance['text'] ), $instance );

        $text = '<div class="text-image" style="text-align:'. $instance['align'] .'"><img src="' . $instance['image'] . '" alt="' . $instance['title'] . '" /></div>' . $clear_text;
        echo apply_filters( 'widget_text', $text );

        echo $after_widget;
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['image'] = $new_instance['image'];

        $instance['align'] = $new_instance['align'];

        $instance['text'] = $new_instance['text'];

        $instance['autop'] = $new_instance['autop'];

        return $instance;
    }

}
?>

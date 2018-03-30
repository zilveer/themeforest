<?php
class icon_text extends WP_Widget
{
    var $icons;
    var $path_icons = 'images/icons/widget/';

    function __construct() {
        $widget_ops = array(
            'classname'   => 'icon-text group',
            'description' => __( 'Arbitrary text or HTML, with a simple icon near title.', 'yiw' )
        );

        $control_ops = array( 'id_base' => 'icon-text', 'width' => 430 );

        WP_Widget::__construct( 'icon-text', 'Icon Text Widget', $widget_ops, $control_ops );

        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        //wp_enqueue_script( 'media-upload' );
        add_action( 'admin_print_footer_scripts', array( &$this, 'add_script_textimage' ), 999 );

        $this->path_icons = dirname( __FILE__ ) . '/../../' . $this->path_icons;
        foreach ( glob( $this->path_icons . '*.png' ) as $icon ) {
            $icon          = explode( '.', basename( $icon ) );
            $this->icons[] = $icon[0];
        }
    }

    function form( $instance ) {
        global $icons_name;

        /* Impostazioni di default del widget */
        $defaults = array(
            'title'    => '',
            'icon_img' => '',
            'text'     => '',
            'img_url'  => ''
        );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label>
                <strong><?php _e( 'Title', 'yiw' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </label>
        </p>

        <p>
            <label><?php _e( 'Icon', 'yiw' ) ?>:
                <select id="<?php echo $this->get_field_id( 'icon_img' ); ?>" name="<?php echo $this->get_field_name( 'icon_img' ); ?>">
                    <option value="0"></option>
                    <?php foreach ( $this->icons as $icon ) {
                        echo '<option value="' . $icon . '"' . selected( $icon, $instance['icon_img'], false ) . '>' . $icon . '</option>';
                    } ?>
                </select>
                <?php _e( 'or upload your icon:', 'yiw' ) ?>
                <input type="text" id="<?php echo $this->get_field_id( 'img_url' ); ?>" name="<?php echo $this->get_field_name( 'img_url' ); ?>" value="<?php echo $instance['img_url']; ?>" />
                <a href="#" class="upload-image button-secondary">Upload</a>
            </label>
        </p>

        <p>
            <label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" cols="20" rows="5"><?php echo $instance['text']; ?></textarea>
            </label>
        </p>
    <?php
    }

    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters( 'widget_title', $instance['title'] );

        $img_url = '';
        if ( ! empty( $instance['icon_img'] ) ) {
            $img_url = get_template_directory_uri() . '/images/icons/widget/' . $instance['icon_img'] . '.png';
        }
        else {
            if ( ! empty( $instance['img_url'] ) ) {
                $img_url = $instance['img_url'];
            }
        }

        echo $before_widget;

        $clear_text = yit_icl_translate( 'Widgets' , 'yiw' , 'widget_icon_text_' .sanitize_title( $instance['text'] ) , apply_filters( 'widget_text', $instance['text'], $instance )  );

        ?>

        <img src="<?php echo $img_url ?>" alt="" />

        <h3><?php echo $title; ?></h3>
        <p><?php echo do_shortcode( $clear_text ) ?></p>

        <?php echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['icon_img'] = $new_instance['icon_img'];

        $instance['img_url'] = $new_instance['img_url'];

        $instance['text'] = $new_instance['text'];

        return $instance;
    }

function add_script_textimage()
{
    ?>
    <script type="text/javascript">

        jQuery(document).ready(function ($) {

            $('.upload-image').live('click', function () {
                var yiw_this_object = $(this).prev();

                tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');

                window.send_to_editor = function (html) {
                    imgurl = $('img', html).attr('src');
                    yiw_this_object.val(imgurl);

                    tb_remove();
                }

                return false;
            });
        });
    </script>
<?php
}

}
?>
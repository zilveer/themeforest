<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Simple_Sliders_Module
 * @since G1_Simple_Sliders_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

require_once G1_LIB_DIR.'/g1-sliders/admin/slider-tools.php';
require_once G1_FRAMEWORK_DIR.'/lib/misc.php';

add_action('g1_ui_widget_manager_register', 'g1_simple_slider_image_upload_register');

/**
 * @param G1_UI_Widget_Manager $manager
 */
function g1_simple_slider_image_upload_register($manager) {
    $js_config = array(
        'success_callback' => 'g1_simple_slider_slide_added'
    );

    $manager->add(new G1_UI_Widget_Ajax_Image_Upload('g1_simple_slider_image_upload_1', array(), $js_config));
}

add_action( 'add_meta_boxes', 'g1_simple_slider_add_slides_meta_box' );
add_action('admin_enqueue_scripts', 'g1_simple_slider_enqueue_scripts');
add_action('admin_enqueue_scripts', 'g1_simple_slider_enqueue_styles');

function g1_simple_slider_add_slides_meta_box() {
    add_meta_box(
        'g1_simple_slider_slides',
        __('Slides', 'g1_theme'),
        'g1_simple_slider_render_slides_meta_box',
        'g1_simple_slider'
    );
}

function g1_simple_slider_render_slides_meta_box( $post ) {
    $slider = G1_Slider_Factory::get_simple_slider($post);
    $slider->render_slides();

    $widget = G1_UI_Widget_Manager()->get('g1_simple_slider_image_upload_1');
    $widget->render();
}

function g1_simple_slider_enqueue_scripts() {
    wp_enqueue_script('jquery-ui-sortable');

    wp_register_script( 'g1_simple_slider_manager', get_template_directory_uri().'/lib/g1-simple-sliders/admin/js/g1_simple_slider_manager.js', array('jquery', 'wp-ajax-response'));
    wp_enqueue_script( 'g1_simple_slider_manager' );

    $config = array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'i18n' => array(
            'confirm_delete_slide' => __('Are you sure you want to delete this slide?', 'g1_theme'),
            'error_delete_slide' => __('An error occured while deleting slide', 'g1_theme'),
            'error_add_slide' => __('An error occured while adding slide', 'g1_theme'),
            'error_move_slide' => __('An error occured while moving slide', 'g1_theme')
        )
    );
    wp_localize_script('g1_simple_slider_manager', 'g1_simple_slider_manager_config', json_encode($config) );
}

function g1_simple_slider_enqueue_styles() {
    wp_register_style( 'g1_simple_slider_manager', get_template_directory_uri().'/lib/g1-simple-sliders/admin/css/g1_simple_slider_manager.css');
    wp_enqueue_style( 'g1_simple_slider_manager' );
}

add_action('save_post', 'g1_simple_slider_save_post');

function g1_simple_slider_save_post($post_id) {
    $post = get_post($post_id);

    if (get_post_type($post) === 'g1_simple_slider' && isset($_POST['simple_sliders'])) {
        $slider = G1_Slider_Factory::get_simple_slider($post);

        if (isset($_POST['simple_sliders'][$slider->get_id()])) {
            $slider->update_slides_from_array($_POST['simple_sliders'][$slider->get_id()]);
            $slider->save();
        }
    }
}

add_action('wp_ajax_g1_simple_slider_add_new_slide', 'g1_simple_slider_add_new_slide');

function g1_simple_slider_add_new_slide() {
    $ajax_data = $_POST['ajax_data'];
    $post_parent = get_post($ajax_data['parent_id']);
    $slide = get_post($ajax_data['attachment_id']);

    $error_response = $success_response = new WP_Ajax_Response();
    $errors = new WP_Error();

    if (!$post_parent || !$slide) {
        $errors->add('incorrect_input_data', 'Slide or parent post does not exist!');
    }

    if (count($errors->get_error_codes()) > 0) {
        $error_response->add(array(
            'what' => 'errors',
            'id' => $errors
        ));

        $error_response->send();
        exit;
    }

    // attach slide to simple_slider
    wp_update_post(array(
        'ID' => $slide->ID,
        'post_parent' => $post_parent->ID
    ));

    $slider = G1_Slider_Factory::get_simple_slider($post_parent);
    $last_slide = $slider->get_last_slide();

    $new_slide = new G1_Simple_Slider_Slide($slide);
    $new_slide->set_order($last_slide->get_order() + 1);
    $new_slide->save();

    $view = new G1_Simple_Slider_Slide_Html_Renderer($new_slide, $slider->get_id());

    $success_response->add(array(
        'what' => 'slide_html',
        'id' => 1,
        'data' => $view->capture()
    ));
    $success_response->send();
    exit;
}

add_action('wp_ajax_g1_simple_slider_remove_slide', 'g1_simple_slider_remove_slide');

function g1_simple_slider_remove_slide() {
    check_ajax_referer('g1_simple_slider-remove_slide'.$_POST['ajax_data']['slide_id']);

    $error_response = $success_response = new WP_Ajax_Response();
    $errors = new WP_Error();

    $ajax_data = $_POST['ajax_data'];
    $slide = get_post($ajax_data['slide_id']);

    if (!$slide) {
        $errors->add('incorrect_slide_id', sprintf('Slide with id %d does not exist!', $ajax_data['slide_id']));
    }


    if (!wp_delete_post($slide->ID)) {
        $errors->add('delete_post_failed', sprintf('An error occured while deleting post with id %d', $ajax_data['slide_id']));
    }

    if (count($errors->get_error_codes()) > 0) {
        $error_response->add(array(
            'what' => 'errors',
            'id' => $errors
        ));

        $error_response->send();
    } else {
        $success_response->add(array(
            'what' => 'slide_id',
            'id' => 1,
            'data' => $slide->ID
        ));
        $success_response->send();
    }
    exit;
}

add_action('wp_ajax_g1_simple_slider_move_slide', 'g1_simple_slider_move_slide');

function g1_simple_slider_move_slide() {
    $ajax_data = $_POST['ajax_data'];

    check_ajax_referer('g1_simple_slider-move_slide'.$ajax_data['slide_id']);

    $error_response = $success_response = new WP_Ajax_Response();
    $errors = new WP_Error();

    $post = get_post(absint($ajax_data['post_id']));
    $slide_id = absint($ajax_data['slide_id']);
    $after_slide_id = absint($ajax_data['after_slide_id']);
    $after_slide_post = $after_slide_id ? get_post($after_slide_id) : null;

    $slide_post = get_post($slide_id);

    if (!$post || !$slide_post || ($after_slide_id && !$after_slide_post)) {
        $errors->add('incorrect_input_data', 'At least one of the slides does not exist!');
    }

    if (count($errors->get_error_codes()) > 0) {
        $error_response->add(array(
            'what' => 'errors',
            'id' => $errors
        ));

        $error_response->send();
        exit;
    }

    $slider = G1_Slider_Factory::get_simple_slider($post);
    $slide = $slider->get_slide($slide_post->ID);

    if ($after_slide_post) {
        $after_slide = $slider->get_slide($after_slide_post->ID);

        $slider->move_slide_after_slide($slide, $after_slide);
    } else {
        $first_slide = $slider->get_first_slide();

        $slider->move_slide_before_slide($slide, $first_slide);
    }

    $slider->save();

    $success_response->add(array(
        'what' => 'success',
        'id' => 1
    ));
    $success_response->send();
    exit;
}


/**
 * Collection of simple slides
 */
class G1_Simple_Slider extends G1_Slider {
    private $post;

    public function __construct($post) {
        parent::__construct();

        $this->post = $post;

        $this->load_slides();
    }

    public function get_id() {
        return $this->post->ID;
    }

    public function capture_slides() {
        $out = '<div class="g1-simple-slide-container">';

        foreach ($this->get_slides() as $slide) {
            $out .= (string)(new G1_Simple_Slider_Slide_Html_Renderer($slide, $this->get_id(), array('collapsed')));
        }

        $out .= '</div>';

        return $out;
    }

    public function save() {
        /** @var G1_Slide_Interface $slide */
        foreach ($this->get_slides() as $slide) {
            $slide->save();
        }
    }

    public function update_slides_from_array(array $data) {
        if (empty($data)) {
            return;
        }

        foreach ($data as $slide_id => $slide_data) {
            $slide = $this->get_slide($slide_id);
            $slide->update_from_array($data[$slide_id]);
        }
    }

    private function load_slides() {
        $attachments = $this->fetchPostAttachments();

        /* @var WP_Post $post */
        foreach ($attachments as $post) {
            $this->add_slide(new G1_Simple_Slider_Slide($post));
        }
    }

    private function fetchPostAttachments() {
        $query_args = array(
            'post_type'			=> 'attachment',
            'post_parent'		=> $this->post->ID,
            'numberposts'     	=> 50,
            'order'				=> 'ASC',
            'orderby'			=> 'menu_order ID'
        );

        return get_posts( $query_args );
    }
}



class G1_Simple_Slider_Slide extends G1_Slide {
    private $caption;
    private $description;
    private $image_alt;
    private $link;
    private $linking;
    private $layout;

    private $post_data_map;
    private $meta_data_map;

    public function __construct($post) {
        $this->post_data_map = array(
            'id' => 'ID',
            'order' => 'menu_order',
            'caption' => 'post_excerpt',
            'description' => 'post_content',
        );

        $this->meta_data_map = array(
            'image_alt' => '_g1_image_alt',
            'link' => '_g1_alt_link',
            'linking' => '_g1_alt_linking',
            'layout' => '_g1_layout'
        );

        $data = array_merge(
            $this->get_post_config_data($post),
            $this->get_meta_data($post)
        );
        $this->update_from_array($data);
    }

    private function get_post_config_data($post) {
        $data = array(
            'id' => $post->ID,
            'order' => $post->menu_order,
            'caption' => $post->post_excerpt,
            'description' => $post->post_content,
        );

        return $data;
    }

    private function get_meta_data($post) {
        $data = array();

        foreach ($this->get_meta_data_map() as $key => $meta_key) {
            $data[$key] = get_post_meta( $post->ID, $meta_key, true );
        }

        return $data;
    }

    public function get_caption() {
        return $this->caption;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_image_alt() {
        return $this->image_alt;
    }

    public function get_link() {
        return $this->link;
    }

    public function get_linking() {
        return $this->linking;
    }

    public function get_layout() {
        return $this->layout;
    }

    public function set_caption($caption)
    {
        $this->caption = $caption;
    }

    public function set_description($description)
    {
        $this->description = $description;
    }

    public function set_image_alt($image_alt)
    {
        $this->image_alt = $image_alt;
    }

    public function set_link($link)
    {
        $this->link = $link;
    }

    public function set_linking($linking)
    {
        $this->linking = $linking;
    }

    public function set_layout($layout)
    {
        $this->layout = $layout;
    }

    public function save() {
        global $wpdb;
        $data = array();

        $data[ 'post_excerpt' ] = stripslashes_deep($this->get_caption());
        $data[ 'post_content' ] = stripslashes_deep($this->get_description());
        $data[ 'menu_order' ]   = stripslashes_deep($this->get_order());

        $wpdb->update(
            $wpdb->posts,
            $data,
            array('ID' => $this->get_id()),
            array( '%s', '%s', '%d'	),
            array( '%d' )
        );

        clean_post_cache( $this->get_id() );

        foreach ($this->get_meta_data_map() as $key => $meta_key) {
            $method_name = sprintf('get_%s', $key);
            $value = $this->$method_name();

            if ( $value ) {
                update_post_meta( $this->get_id(), $meta_key, stripslashes_deep( $value ) );
            } else {
                delete_post_meta( $this->get_id(), $meta_key);
            }
        }
    }

    public function update_from_array(array $data) {
        foreach ($data as $key => $value) {
            $method_name = sprintf('set_%s', $key);

            if (method_exists($this, $method_name)) {
                $this->$method_name($value);
            }
        }
    }

    private function get_meta_data_map() {
        return $this->meta_data_map;
    }

    private function get_post_data_map() {
        return $this->post_data_map;
    }
}

class G1_Simple_Slider_Slide_Html_Renderer extends G1_Slide_Renderer {
    private $prefix;
    private $classes;

    public function __construct(G1_Slide_Interface $slide, $prefix, $classes = array()) {
        parent::__construct($slide);

        $this->prefix = sprintf('simple_sliders[%s][%d]', $prefix, $this->slide->get_id());
        $this->classes = $classes;
    }

    public function get_prefix() {
        return $this->prefix;
    }

    public function capture() {
        $this->classes[] = 'g1-simple-slide';
        $class = implode(' ', $this->classes);
        $move_action_nonce = sprintf('g1_simple_slider-move_slide%d', $this->slide->get_id());
        $remove_action_nonce = sprintf('g1_simple_slider-remove_slide%d', $this->slide->get_id());

        $out = '';
        $out .= '<div id="' . esc_attr( 'g1-simple-slide-' . $this->slide->get_id() ) . '" class="'.$class.'">';
        $out .= wp_nonce_field($move_action_nonce, 'move_wpnonce', false, false);
        $out .= wp_nonce_field($remove_action_nonce, 'remove_wpnonce', false, false);
        $out .= '<input name="' . esc_attr( $this->get_prefix() . '[menu_order]' ) . '" type="hidden" value="' . esc_attr( $this->slide->get_order() ) . '" />';
        $out .= '<input name="' . esc_attr( $this->get_prefix() . '[delete_simple_slide_nonce]' ) . '" type="hidden" value="' . esc_attr( wp_create_nonce( 'delete_simple_slide_' . $this->slide->get_id() ) ) . '" />';

        $out .= '<ul class="g1-toolbar">';
        $out .= '<li><a title="' . __( 'Drag', 'g1_theme' ) . '" class="g1-handle" href="#"></a></li>';
        $out .= '<li><a title="' . __( 'Move Up', 'g1_theme' ) . '" class="g1-move-up" href="#"></a></li>';
        $out .= '<li><a title="' . __( 'Move Down', 'g1_theme' ) . '" class="g1-move-down" href="#"></a></li>';
        $out .= '<li><a title="' . __( 'Delete', 'g1_theme' ) . '" class="g1-delete-slide" href="#" rel="' . esc_attr( $this->slide->get_id() ) . '">' . __( 'Delete', 'g1_theme' ) . '</a></li>';
        $out .= '</ul>';

        $out .= '<div class="g1-essentials">';
        $out .= '<div class="g1-media">';
        $out .= wp_get_attachment_image( $this->slide->get_id(), 'thumbnail' );
        $out .= '</div><!-- .g1-media -->';

        $out .= '<div class="g1-nonmedia">';
        $out .= '<ul>';

        $out .= $this->captureCaption();
        $out .= $this->captureDescription();
        $out .= $this->captureImageAlt();
        $out .= $this->captureLink();
        $out .= $this->captureLinking();
        $out .= $this->captureLayout();

        $out .= '</ul>';

        $out .= '</div><!-- .g1-nonmedia -->';
        $out .= '</div><!-- .g1-essentials -->';
        $out .= '</div><!-- .g1-simple-slide -->';

        return $out;
    }

    protected function captureCaption() {
        $id = $this->get_prefix() . '[caption]';
        $args = array(
            'label' => __( 'Caption', 'g1_theme' ),
            'name'  => $this->get_prefix() . '[caption]'
        );

        $obj = G1_Form_Control_Factory::create($id, $args, G1_Form_Control_Factory::TYPE_TEXT);
        $obj->set_value($this->slide->get_caption());

        return $obj->capture();
    }

    protected function captureDescription() {
        $id = $this->get_prefix() . '[description]';
        $args = array(
            'label'		=> __( 'Description', 'g1_theme' ),
            'name'		=> $this->get_prefix() . '[description]'
        );

        $obj = G1_Form_Control_Factory::create($id, $args, G1_Form_Control_Factory::TYPE_LONG_TEXT);
        $obj->set_value($this->slide->get_description());

        return $obj->capture();
    }

    protected function captureImageAlt() {
        $id = $this->get_prefix() . '[image_alt]';
        $args = array(
            'label'		=> __( 'Alternate image text', 'g1_theme' ),
            'name'		=> $this->get_prefix() . '[image_alt]'
        );

        $obj = G1_Form_Control_Factory::create($id, $args, G1_Form_Control_Factory::TYPE_TEXT);
        $obj->set_value($this->slide->get_image_alt());

        return $obj->capture();
    }

    protected function captureLink() {
        $id = $this->get_prefix() . '[link]';
        $args = array(
            'label'		=> __( 'Link', 'g1_theme' ),
            'name'		=> $this->get_prefix() . '[link]'
        );

        $obj = G1_Form_Control_Factory::create($id, $args, G1_Form_Control_Factory::TYPE_LONG_TEXT);
        $obj->set_value($this->slide->get_link());

        return $obj->capture();
    }

    protected function captureLinking() {
        $id = $this->get_prefix() . '[linking]';
        $args = array(
            'label'		=> __( 'Linking', 'g1_theme' ),
            'hint'		=> __( 'What to do when user clicks the slide?', 'g1_theme' ),
            'name'		=> $this->get_prefix() . '[linking]',
            'choices'	=> array(
                'standard'		=> 'open the link in the same window',
                'new-window'	=> 'open the link in a new window',
                'lightbox'		=> 'open the link in a lightbox',
                'none'			=> 'none',
            ),
        );

        $obj = G1_Form_Control_Factory::create($id, $args, G1_Form_Control_Factory::TYPE_CHOICE);
        $obj->set_value($this->slide->get_linking());

        return $obj->capture();
    }

    protected function captureLayout() {
        $id = $this->get_prefix() . '[layout]';
        $args = array(
            'label'		=> __( 'Layout', 'g1_theme' ),
            'hint'		=> __( 'Position of the description', 'g1_theme' ),
            'name'		=> $this->get_prefix() . '[layout]',
            'choices'	=> array(
                'bubble-top-left'		=> 'top-left',
                'bubble-top-center'		=> 'top-center',
                'bubble-top-right'		=> 'top-right',
                'bubble-bottom-left'	=> 'bottom-left',
                'bubble-bottom-center'	=> 'bottom-center',
                'bubble-bottom-right'	=> 'bottom-right',
            ),
        );

        $obj = G1_Form_Control_Factory::create($id, $args, G1_Form_Control_Factory::TYPE_CHOICE);
        $obj->set_value($this->slide->get_layout());

        return $obj->capture();
    }
}
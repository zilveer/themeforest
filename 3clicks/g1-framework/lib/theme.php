<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme
 * @since G1_Theme 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

class G1_Image_Sizes_Manager {
    public function __construct() {
        $this->hook_after_setup_theme();
    }

    /**
     * Gets all registered image sizes with the "g1_" prefix
     *
     * @return array
     */
    protected function get_sizes() {
        global $_wp_additional_image_sizes;

        $result = array();

        foreach ( $_wp_additional_image_sizes as $name => $args ) {
            if ( 0 === strpos( $name, 'g1_' ) ) {
                $result[$name] = $args;
            }
        }

        return $result;
    }


    protected function hook_after_setup_theme() {
        add_action( get_redux_opts_sections_filter_name(), array( $this, 'register_image_sizes_options' ) );
        add_action( 'init', array( $this, 'bind_image_sizes' ), 999 );
    }


    public function bind_image_sizes() {
        global $_wp_additional_image_sizes;

        foreach ( $_wp_additional_image_sizes as $name => $args ) {
            if ( 0 !== strpos( $name, 'g1_' ) )
                continue;

            $options = get_option( G1_Theme()->get_id() . '_image_sizes', array() );

            if ( isset( $options[ $name ] ) ) {
                $height = isset( $options[ $name ]['height'] ) ? absint( $options[ $name ]['height'] ) : 0;
                if ( $height )
                    $_wp_additional_image_sizes[ $name ]['height'] = $height;
            }
        }
    }



    public function register_image_sizes_options( $sections ) {
        if ( !count( $this->get_sizes() ) ) {
            return $sections;
        }

        $fields = array();
        $field_priority = 10;
        $default_crops = G1_Theme()->default_post_thumbnails_sizes_crops();

        foreach ( $this->get_sizes() as $size => $args ) {
            $title = str_replace('g1_', '', $size);
            $title = str_replace('_', ' ', $title);
            $title = ucwords($title);

            $fields[] = array(
                'id'        => 'image_size_' . $size,
                'priority'  => $field_priority,
                'type'      => 'g1_image_size',
                'title'     => $title,
                'std'       => !empty($default_crops[$size]) ? $default_crops[$size] : false
            );

            $field_priority += 10;
        }

        $sections['style_images'] = array(
            'priority'   => 55,
            'icon'       => 'picture',
            'icon_class' => 'icon-large',
            'title'      => __( 'Image Sizes', Redux_TEXT_DOMAIN ),
            'fields'     => $fields
        );

        return $sections;
    }


    /**
     * Renders our section
     */
    public function render_section() {
        $out =  '<p>' . __( 'Set up the dimensions of the images on the site.', 'g1_theme' ) . '</p>' .
            '<p>' .
            __( 'Keep in mind, that only newly uploaded images will take into account these changes.', 'g1_theme' ) . ' ' .
            sprintf(__( 'Older images can be rescaled with the <a href="%s">Regenerate Thumbnails Plugin</a>', 'g1_theme' ), esc_url( 'http://wordpress.org/extend/plugins/regenerate-thumbnails/ ') ) .
            '</p>';

        echo $out;
    }


    /**
     * Renders a single field
     *
     * @param       array $args
     */
    public function render_field( $args ) {
        $size_name = $args['size'];

        $image_sizes = get_option( G1_Theme()->get_id() . '_image_sizes', array() );
        $size_args = isset ( $image_sizes[ $size_name ] ) ? $image_sizes[ $size_name ] : array();

        $height = isset ( $size_args['height'] ) && 0 !== $size_args['height'] ? absint( $size_args['height'] ) : '';

        echo    '<label for="g1_image_size_height_' . $size_name . '">' . __( 'Height', 'g1_theme' ) . '</label>' .
                ' ' .
                '<input id="g1_image_size_height_' .$size_name . '" class="small-text" type="number" value="' . esc_attr( $height ) . '" min="0" step="1" name="' . G1_Theme()->get_id() . '_image_sizes[' . $size_name .'][height]" />';
    }



    /**
     * Sanitizes the input value before saving it to a database
     *
     * @return array
     */
    public function sanitize( $input ) {
        $value = get_option( G1_Theme()->get_id() . '_image_sizes', array() );

        $sizes = $this->get_sizes();

        // Create proper structure if needed
        foreach( $sizes as $size_name => $args ) {
            if ( !isset ( $value[ $size_name ] ) || !is_array( $value[ $size_name ] ) ) {
                $value[ $size_name ] = array();
            }
        }

        // Replace values from theme options with values from input
        foreach( $sizes as $size_name ) {
            if (    isset ( $input[ $size_name ] )
                &&  isset ( $input[ $size_name ]['height'] )
            ) {
                $value[ $size_name ]['height'] = absint( $input[ $size_name ]['height'] );
            }
        }

        return $value;
    }
}
/**
 * Quasi-singleton for our manager
 *
 * @return G1_Image_Sizes_Manager
 */
function G1_Image_Sizes_Manager() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Image_Sizes_Manager();

    return $instance;
}
// Fire in the hole :)
G1_Image_Sizes_Manager();
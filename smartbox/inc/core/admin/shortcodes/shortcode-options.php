<?php
/**
 * Builds the shortcode option accordion
 *
 * @package Smartbox
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

class OxyShortcodeOptions
{
    private $shortcode;
    private $options;
    private $show_preview;

    function __construct( $preview = true ) {
        $this->shortcode = $_GET['shortcode'];
        $this->options = include_once OPTIONS_DIR . 'shortcodes/shortcode-options.php';
        $this->show_preview = $preview;

        // add action to enqueue scripts for each option
        add_action( 'admin_enqueue_scripts', array(&$this, 'enqueue_scripts') );
    }

    function enqueue_scripts( $hook ) {
        $shortcode = $this->get_shortcode_options( $this->options );
        if( $shortcode !== null ) {
            foreach( $shortcode['sections'] as $section ) {
                foreach( $section['fields'] as $field ) {
                    $option = OxyOptions::create_option( $field );
                    if( $option != false ) {
                        $option->enqueue();
                    }
                }
            }
        }
    }

    private function get_shortcode_options( $options ) {
        $shortcode = null;
        foreach( $options as $item ) {
            if( isset( $item['members'] ) ) {
                if( ($shortcode = $this->get_shortcode_options( $item['members'] ) ) !== null ) {
                    break;
                }
            }
            else {
                if( $this->shortcode == $item['shortcode'] ) {
                    $shortcode = $item;
                    break;
                }
            }
        }
        return $shortcode;
    }

    private function render_options() {
        $shortcode = $this->get_shortcode_options( $this->options );
        if( $shortcode !== null ) {
            echo '<div id="accordion" class="accordion">';
            foreach( $shortcode['sections'] as $section ) {
                echo '<h3><a href="#">'. $section['title'] .'</a></h3>';
                echo '<div>';
                foreach( $section['fields'] as $field ) {
                    $attr = array();
                    $attr = isset( $field['attr'] )? $field['attr'] : null;
                    // prefix name with shortcode so shortcode generator can work
                    $attr['name'] = $this->shortcode . '_' . $field['id'];;
                    if( isset($field['desc'] ) ) {
                        $attr['desc'] = $field['desc'];
                    }
                    if( isset( $field['id'] ) ) {
                        $attr['id'] = $field['id'];
                    }
                    $value = '';
                    if( isset( $field['default'] ) ) {
                        // set value to default
                        $value =  $field['default'];
                        // also set data-default for shortcode generator ;)
                        $attr['data-default'] = $field['default'];
                    }
                    $option = OxyOptions::create_option( $field, $value, $attr );
                    if( $option !== false ) {
                        echo '<div class="option">';
                        echo '<label for="' . $field['id'] . '">'. $field['name'] . '</label>';
                        $option->render();
                        echo '</div>';
                    }
                    if( isset( $field['desc'] ) ) {
                        echo '<p>' . $field['desc'] . '</p>';
                    }
                }
                echo '</div>';
            }
            echo '</div>';
        }
    }

    public function display() { ?>
        <form id="shortcode_form" action="#">
            <input type="hidden" id="shortcode" value="<?php echo $this->shortcode; ?>" />

        <?php if( $this->show_preview ) : ?>
                <div id="preview_panel">
                    <iframe id="preview">
                    </iframe>
                </div>
                <div id="options_panel">
                    <?php $this->render_options(); ?>
                    <div id="buttons_panel">
                        <input  class="button button-primary" type="submit" id="insert" name="insert" value="<?php _e('Insert', THEME_ADMIN_TD); ?>" />
                        <input  class="button button-right" type="button" id="cancel" name="cancel" value="<?php _e('Close', THEME_ADMIN_TD); ?>" />
                    </div>
                </div>

        <?php else : ?>
                <div id="preview_panel" class="no-preview">
                    <div>
                        <p><?php _e('No Preview For This Shortcode', THEME_ADMIN_TD); ?></p>
                    </div>
                </div>
                <div id="options_panel">
                    <?php $this->render_options(); ?>
                    <div id="buttons_panel">
                        <input  class="button button-primary" type="submit" id="insert" name="insert" value="<?php _e('Insert', THEME_ADMIN_TD); ?>" />
                        <input  class="button button-right" type="button" id="cancel" name="cancel" value="<?php _e('Close', THEME_ADMIN_TD); ?>" />
                    </div>
                </div>
        <?php endif; ?>
        </form>
    <?php
    }
}

return new OxyShortcodeOptions();
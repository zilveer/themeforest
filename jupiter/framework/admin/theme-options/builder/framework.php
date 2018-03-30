<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * This class will constrcut the theme options.
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0
 * @package     artbees
 */

class Mk_Options_Framework
{
    
    var $options;
    var $saved_options;
    var $_renderState;
    
    function __construct($options) {
        $this->options = $options;
        $this->render();    

        
    }
    
    function render() {
        
        $saved_options = get_option(THEME_OPTIONS);
        $compatibility = new Compatibility();
        $compatibility->setSchedule('off');
        $compatibility_response = $compatibility->compatibilityCheck();
        echo $compatibility_response;
        ?>
        <div class="mk-options-container">
        <form action="" type="post" name="masterkey_settings" id="masterkey_settings">

        <div id="mk-are-u-sure" class="mk-message-box ">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/warning-icon.png" />
        <span class="mk-message-text"><?php _e( 'Are you sure you want to reset to default?', 'mk_framework' ); ?></span>
        <a href="#" style="padding: 11px 35px;" class="primary-button blue-button mk_reset_ok" id="mk_reset_ok"><?php _e( 'OK', 'mk_framework' ); ?></a>
        <a href="#" class="secondary-button full-rounded popup-toggle-close"><?php _e( 'Cancel', 'mk_framework' ); ?></a>
        </div>

        <div id="mk-success-reset" class="mk-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/success-icon.png" />
        <span class="mk-message-text"><?php _e( 'All options restored to defaults', 'mk_framework' ); ?></span>
        <a href="#" class="primary-button blue-button popup-toggle-close"><?php _e( 'Got it!', 'mk_framework' ); ?></a>
        </div>

        <div id="mk-success-import" class="mk-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/success-icon.png" />
        <span class="mk-message-text"><?php _e( 'All options have been imported successfully', 'mk_framework' ); ?></span>
        </div>

        <div id="mk-fail-import" class="mk-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/warning-icon.png" />
        <span class="mk-message-text"><?php _e( 'Nothing has been imported...', 'mk_framework' ); ?></span>
        </div>

        <div class="main-top-section">
        <span class="masterkey-branding">
        
        <svg width="22.833px" height="18.392px" viewBox="0 0 22.833 18.392" enable-background="new 0 0 22.833 18.392" xml:space="preserve">
                    <g>
                        <defs>
                            <rect width="22.833" height="18.392"/>
                        </defs>
                        <clipPath>
                            <use xlink:href="#SVGID_1_"  overflow="visible"/>
                        </clipPath>
                            <polygon clip-path="url(#SVGID_2_)" fill="none" stroke="#1C2021" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="
                            0.5,17.892 5.958,0.5 11.417,17.892  "/>
                        
                            <polygon clip-path="url(#SVGID_2_)" fill="none" stroke="#1C2021" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="
                            11.417,17.892 19.446,4.841 22.334,17.892    "/>
                        
                            <line clip-path="url(#SVGID_2_)" fill="none" stroke="#1C2021" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="5.958" y1="0.5" x2="22.333" y2="17.892"/>
                        
                            <line clip-path="url(#SVGID_2_)" fill="none" stroke="#1C2021" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="19.446" y1="4.841" x2="0.5" y2="17.892"/>
                    </g>
                    </svg>
        
        <span title="Theme Version" class="mk-theme-version"><strong>MasterKey</strong> version <?php echo get_option('mk_jupiter_theme_current_version'); ?></span></span>
        
        <ul class="mk-main-navigator">
        
        <li><a href="#mk_options_general">
        <svg width="22.005px" height="30px" viewBox="0 0 22.005 28.497" enable-background="new 0 0 22.005 28.497" xml:space="preserve">
                    <g>

                        <path d="M3.005,12.497c0,5.246,4.253,9.5,9.5,9.5s9.5-4.254,9.5-9.5
                            c0-5.248-4.253-9.501-9.5-9.501S3.005,7.249,3.005,12.497 M12.505,3.997c4.687,0,8.5,3.813,8.5,8.5c0,4.686-3.813,8.5-8.5,8.5
                            c-4.687,0-8.5-3.814-8.5-8.5C4.005,7.81,7.818,3.997,12.505,3.997"/>
                        <path d="M18.168,23.649l0.483,0.973l0.895-0.443l-1.359-2.744l-0.896,0.443l0.433,0.874
                            c-1.608,0.819-3.399,1.255-5.219,1.255C6.161,24.007,1,18.843,1,12.498C1,8.172,3.449,4.208,7.275,2.25l0.464,0.939l0.897-0.444
                            L7.276,0L6.38,0.443l0.451,0.911C2.667,3.48,0,7.794,0,12.498c0,6.729,5.341,12.232,12.005,12.496v1.521
                            c-2.308,0.091-4.459,0.802-6.282,1.982h2.091c1.432-0.641,3.016-1,4.684-1c1.639,0,3.227,0.354,4.674,1h2.102
                            c-1.848-1.189-4.006-1.889-6.269-1.982v-1.525C14.807,24.917,16.57,24.461,18.168,23.649"/>
                    </g>
                    </svg>
        <span><?php echo _e('General', 'mk_framework'); ?></span></a></li>
        
        <li><a href="#mk_options_skining">
        <svg width="27px" height="30px" viewBox="0 0 25.974 28" enable-background="new 0 0 25.974 28" xml:space="preserve">
                    <g>
                        <path d="M20.962,12.883L20.962,12.883l-9.784-9.786l-0.174,0.172V3c0-1.656-1.342-3-3-3
                            c-1.656,0-3,1.344-3,3v6.269l-4.142,4.143c-1.15,1.15-1.15,3.014,0,4.164l5.622,5.621c0.575,0.575,1.328,0.863,2.081,0.863
                            c0.754,0,1.508-0.288,2.082-0.863l7.206-7.204L24.004,16L20.962,12.883z M6.004,3c0-1.103,0.898-2,2-2c1.104,0,2,0.897,2,2v1.269
                            l-4,4V3z M17.438,14.992l-0.293,0.294L9.94,22.49c-0.367,0.367-0.856,0.57-1.375,0.57c-0.519,0-1.007-0.203-1.374-0.57
                            l-5.622-5.621c-0.758-0.758-0.758-1.991,0-2.75l8.435-8.435V12h1V4.684l0.174-0.172l9.069,9.069l1.382,1.416l-3.775-0.004
                            L17.438,14.992z"/>
                        <path d="M25.944,24.618c-0.296-2.496-2.959-5.801-2.959-5.801s-2.73,3.347-2.957,5.848
                            c-0.015,0.115-0.023,0.231-0.023,0.351c0,1.648,1.337,2.984,2.984,2.984s2.983-1.336,2.983-2.984
                            C25.973,24.881,25.962,24.748,25.944,24.618 M22.989,27c-1.095,0-1.984-0.891-1.984-1.984c0-0.08,0.007-0.159,0.02-0.26
                            c0.116-1.306,1.137-3.06,1.957-4.253c0.807,1.187,1.815,2.928,1.972,4.249c0.012,0.086,0.02,0.174,0.02,0.264
                            C24.973,26.109,24.084,27,22.989,27"/>
                    </g>
                    </svg>
        <span><?php echo _e('Styling', 'mk_framework'); ?></span></a></li>
        
        <li><a href="#mk_options_typography">
        <svg width="25px" height="30px" viewBox="0 0 23.667 23.44" enable-background="new 0 0 23.667 23.44" xml:space="preserve">
                    <g>
                        
                            <polygon stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="
                            0.5,7.884 0.5,0.5 5.083,0.5     "/>
                        
                            <polygon stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="
                            23.167,7.884 23.167,0.5 18.584,0.5  "/>
                        
                            <line stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="3.667" y1="0.5" x2="20.5" y2="0.5"/>
                        
                            <line stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="11.833" y1="0.5" x2="11.833" y2="19.393"/>
                        
                            <polygon stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="
                            6.417,22.94 11.833,19.393 17.25,22.94   "/>
                    </g>
                    </svg>
                    
        <span><?php echo _e('Typography', 'mk_framework'); ?></span></a></li>
        
        <li><a href="#mk_options_portfolio">
        <svg  width="25px" height="30px" viewBox="0 0 25 23.436" enable-background="new 0 0 25 23.436" xml:space="preserve">
                    <path d="M1,1h23v15.999H1V1z M0,0v18h12v1.934l-4.742,2.627l0.484,0.875l4.758-2.634l4.758,2.634l0.485-0.875
                        L13,19.934V18h12V0H0z"/>
                    </svg>
                    
        <span><?php echo _e('Portfolio', 'mk_framework'); ?></span></a></li>
        
        <li><a href="#mk_options_blog">
        <svg width="25px" height="30px" viewBox="0 0 25 25" enable-background="new 0 0 25 25" xml:space="preserve">
                    <g>
                        <path d="M6,0v14H0v8.177C0,24.174,1.859,25,3.237,25H22c1.516,0,3-1.475,3-3V0H6z
                             M3.237,24C2.615,24,1,23.673,1,22.177V15h5v6.746C6,22.415,5.125,24,3.746,24H3.237z M24,22c0,0.972-1.028,2-2,2H5.935
                            C6.611,23.298,7,22.38,7,21.746V15v-0.717V14V1h17V22z"/>
                        <rect x="9" y="3" width="13" height="1"/>
                        <rect x="9" y="16" width="13" height="1"/>
                        <rect x="9" y="19" width="13" height="1"/>
                        <path d="M22,6.5H9V14h13V6.5z M21,13H10V7.5h11V13z"/>
                    </g>
                    </svg>
                    
        <span><?php echo _e('Blog / News', 'mk_framework'); ?></span></span></a></li>
        
        <li><a href="#mk_options_woocommrce">
        <svg  width="28px" height="30px" viewBox="0 0 27.427 26" enable-background="new 0 0 27.427 26" xml:space="preserve">
                    <g>
                        <path d="M27.427,7H6.412L4.715,0H0v1h3.929l4.875,20.11C7.764,21.413,7,22.361,7,23.5
                            C7,24.88,8.119,26,9.5,26s2.5-1.12,2.5-2.5c0-0.565-0.194-1.081-0.511-1.5h7.021C18.194,22.419,18,22.935,18,23.5
                            c0,1.38,1.119,2.5,2.5,2.5s2.5-1.12,2.5-2.5c0-1.382-1.119-2.5-2.5-2.5H9.806L9.32,19h14.038L27.427,7z M11,23.5
                            c0,0.827-0.673,1.5-1.5,1.5C8.673,25,8,24.327,8,23.5S8.673,22,9.5,22C10.327,22,11,22.673,11,23.5 M22,23.5
                            c0,0.827-0.673,1.5-1.5,1.5S19,24.327,19,23.5s0.673-1.5,1.5-1.5S22,22.673,22,23.5 M9.078,18L6.654,8h19.378l-3.39,10H9.078z"/>
                    </g>
                    </svg>
        <span><?php echo _e('E-commerce', 'mk_framework'); ?></span></a></li>
        
        <li><a href="#mk_options_advanced">
        <svg  width="18px" height="30px" viewBox="0 0 18 30" enable-background="new 0 0 18 30" xml:space="preserve">
                    <path d="M11.557,3.532l-1.151,9.345L10.266,14h1.133h4.578L6.443,26.467l1.152-9.345L7.734,16H6.602H2.023
                        L11.557,3.532z M0,17h6.602L5,30l13-17h-6.602L13,0L0,17z"/>
                    </svg>
                    
        <span><?php echo _e('Advanced', 'mk_framework'); ?></span></a></li>
        
        </ul>
        
        </div>
        <div class="mk-main-panes hidden-view">
        <?php 
        if(is_array($this->options) && !empty($this->options)) {
            foreach ($this->options as $option) {
                echo $this->build_fields($option, $saved_options = false);
            }
        }
        ?>
        
        </div>

        <div id="save_theme_options_top">

              <figure class="progress-circle">
                <div class="progress-msg"></div>
                <svg width="46" height="46">
                  <circle class="progress-circle__line inner" cx="23" cy="23" r="20" />
                  <circle class="progress-circle__line outer" cx="23" cy="23" r="20" />
                </svg>
                <svg class="success-icon" width="30" height="30">
                    <path d="M13.786,19.144l5.464-8.286"/>
                    <path d="M13.786,19.144l-4.313-3.812"/>
                </svg>
                <svg class="error-icon" width="30" height="30">
                    <path d="M15,15L9.433,9.434"/>
                    <path d="M15,15l5.567,5.566"/>
                    <path d="M15,15l-5.566,5.566"/>
                    <path d="M15,15l5.567-5.566"/>
                </svg>
              </figure>

            <button type="submit" name="save_theme_options_top" class="primary-button blue-button"><span><?php echo _e('Save Settings', 'mk_framework'); ?></span></button>
        </div>

        <div class="mk-footer-buttons">
            <a type="submit" id="mk_reset_confirm" href="#" class="primary-button outline-button">
                <span><?php echo _e('Restore Defaults', 'mk_framework'); ?></span>
            </a>
            <button type="submit" id="reset_theme_options" name="reset_theme_options" class="visuallyhidden"></button>

              <figure class="progress-circle">
                <div class="progress-msg"></div>
                <svg width="46" height="46">
                  <circle class="progress-circle__line inner" cx="23" cy="23" r="20" />
                  <circle class="progress-circle__line outer" cx="23" cy="23" r="20" />
                </svg>
                <svg class="success-icon" width="30" height="30">
                    <path d="M13.786,19.144l5.464-8.286"/>
                    <path d="M13.786,19.144l-4.313-3.812"/>
                </svg>
                <svg class="error-icon" width="30" height="30">
                    <path d="M15,15L9.433,9.434"/>
                    <path d="M15,15l5.567,5.566"/>
                    <path d="M15,15l-5.566,5.566"/>
                    <path d="M15,15l5.567-5.566"/>
                </svg>
              </figure>

            <button type="submit" id="save_theme_options_bottom" name="save_theme_options_bottom" class="primary-button blue-button"><span><?php echo _e('Save Settings', 'mk_framework'); ?></span></button>
        </div>
        
        <div class="clearboth"></div>
        <?php wp_nonce_field('mk-ajax-theme-options', 'security'); ?>
        <input type="hidden" name="action" value="mk_theme_save" />
        </form>
        </div>
      <?php   

      $this->_renderState = true;
    }
    
    public function build_fields($option, $saved_options = false) {
        
        //if(!isset($option['type'])) return false;
        
        $field_type = $option['type'];
        
        //echo $field_type ."\n";
        
        // Getting Field type class name
        $field_class = "Mk_Options_Framework_fields_$field_type";
        
        // getting the field file directory
        $class_file = THEME_FIELDS . "/field_$field_type.php";
        
        // run the requested field from the fields directory
        if (!class_exists($field_class)) {
            if (file_exists($class_file)) {
                require_once ($class_file);
            }
        }
        
        // Instantiate the field class and pass $option array.
        $field = new $field_class($option, $saved_options);
        
        // Render and output the field data
        return $field->render();
        
        // Enqueue scripts or styles if there are any to print.
        /*if (method_exists($field_class, 'enqueue')) {
            $field->enqueue();
        }*/
        
        unset($field);
    }
    
    // Return saved option if any otherwise it will return default value set for specific option.
    public function saved_default_value($id, $default) {
        $saved_options = get_option(THEME_OPTIONS);
        if (isset($saved_options[$id])) {
            return $saved_options[$id];
        } 
        else {
            return $default;
        }
    }
    
    public function field_wrapper($id, $name, $desc, $option_output, $dependency = false) {
        $output = '<div class="mk-single-option" id="' . $id . '_wrapper"'.$dependency.'>';
        
        $output.= '<label for="' . $id . '"><span>' . $name . '</label>';
        
        if (isset($desc)) {
            $output.= '<span class="option-desc">' . $desc . '</span>';
        }
        
        $output.= $option_output;
        
        $output.= '</div>';
        
        return $output;
    }


    public function dependency_builder($val) 
    {
        if(!isset($val) && empty($val)) return false;


        $output  = isset($val['element']) ? ' data-dependency-mother="'.$val['element'].'" ' : '';
        $output .= isset($val['value']) ? ' data-dependency-value=\''.json_encode($val['value']).'\' ' : '';


        return $output;
    }


    public static function get_post_types() {
        $post_type = get_post_types();

        unset(
            $post_type['post'],
            $post_type['page'],
            $post_type['attachment'],
            $post_type['nav_menu_item'],
            $post_type['revision'],
            $post_type['clients'],
            $post_type['animated-columns'],
            $post_type['edge'],
            $post_type['portfolio'],
            $post_type['shop_order'],
            $post_type['shop_order_refund'],
            $post_type['shop_coupon'],
            $post_type['shop_webhook'],
            $post_type['banner_builder'],
            $post_type['banner_builder']
            );
        return $post_type;
    }

}


<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
if (!defined('YIT')) exit('Direct access forbidden.');

/**
 *
 */
class YIT_Splash extends YIT_Object{
    public function __construct(){
        $this->init();
    }

    public function init(){
        if( $this->_is_splash_enabled() ){
            add_action( 'login_head', array( $this, 'add_splash_google_fonts' ), 5 );
            add_action( 'login_head', array( $this, 'add_splash_style'), 15 );
            add_action( 'login_head', array( $this, 'add_splash_script'), 15 );
            add_action( 'login_headerurl', array( $this, 'change_logo_url' ) );
            add_action( 'login_headertitle', array( $this, 'change_logo_title' ) );
            add_action( 'login_enqueue_scripts',    array( $this, 'add_jquery_lib' ), 1 );
        }
    }

    /**
    */
    public function add_splash_google_fonts(){
        $assets = $this->getModel( 'asset' )->get(); 

        if( isset( $assets['style']['google-fonts'] ) ){
            echo '<link rel="stylesheet" id="google-fonts-css" href="' . $assets["style"]["google-fonts"]["src"] . '?ver=3.9" type="text/css" media="all">';
            echo '<link rel="stylesheet" id="font-awesome-css" href="' . $assets["style"]["font-awesome"]["src"] . '?ver=3.9" type="text/css" media="all">';
        }

         if( isset( $assets["style"]["font-awesome"] ) ){
            echo '<link rel="stylesheet" id="font-awesome-css" href="' . $assets["style"]["font-awesome"]["src"] . '?ver=3.9" type="text/css" media="all">';
        }
    }

    /**
    */
    protected function _is_splash_enabled(){
        return ( yit_get_option( 'enable-custom-login' ) == 'yes' );
    }

    /**
    */
    public function change_logo_url(){
        return home_url();
    }

    /**
    */
    public function change_logo_title(){
        return get_bloginfo('name');
    }

    /**
     * Add Splash Style
     *
     * Return the HTML code and Css rules for Custom Login Screen
     *
     * @access public
     * @since 2.0.0
     * @return void
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     *
    */
    public function add_splash_style(){
        $bg_color = yit_get_option('background-color-custom-login');
        $bg_image = yit_get_option('background-custom-login');
        $bg_repeat = yit_get_option('background-repeat-custom-login');
        $bg_position = yit_get_option('background-position-custom-login');
        $bg_attachment = yit_get_option('background-attachment-custom-login');

        $submit_hover_color = yit_get_option( 'container-submit-hover-custom-login' );
        $submit_bg_colors = yit_get_option( 'container-submit-color-custom-login' );
        $submit_border_colors = yit_get_option( 'container-submit-border-custom-login' );

        $links_hover = yit_get_option( 'container-links-hover-custom-login' );

        $container_width = yit_get_option( 'container-width-custom-login' );
        $container_height = yit_get_option( 'container-min-height-custom-login' );
        $container_bg_color = yit_get_option( 'container-color-custom-login' );

        $logo_bg_image = yit_get_option( 'logo-custom-login' );
        $logo_bg_color = yit_get_option( 'logo-color-custom-login' );

        $custom_style = yit_get_option('style-custom-login');

        /* === Typography Options === */
        $typography = array(
            'label'         => yit_get_option('container-labels-typograhpy-custom-login'),
            'links'         => yit_get_option('container-links-typograhpy-custom-login'),
            'submit'        => yit_get_option('container-submit-typograhpy-custom-login'),
            'remember_me'   => yit_get_option('container-labels-typograhpy-custom-login-p-font'),
        );

        foreach ( $typography as $section => $options ) {
            $typography[ $section ] = $this->typography_style_parser( $options );
        }

        extract( $typography );

        ?>
        <style>
            body.login, html{
                background: <?php echo $bg_color['color'] ?> <?php if( ! empty( $bg_image ) ): ?>url('<?php echo $bg_image ?>') <?php echo $bg_repeat ?> <?php echo $bg_position ?> <?php echo $bg_attachment ?> <?php endif; ?>;/**/
            }

            body.login:before{
                content: '';
                width: 100%;
                height: 120px;
                display: block;
            }

            #login{
                background: <?php echo $container_bg_color['color'] ?>;
                box-sizing: border-box;
                width: <?php echo $container_width ?>px;
                min-height: <?php echo $container_height?>px;
                padding: 0;
                margin-left: auto;
                margin-right: auto;
                border-top: 4px solid #f7f7f7;
                border-left: 7px solid #f7f7f7;
                border-right: 7px solid #f7f7f7;
                border-bottom: 7px solid #f7f7f7;

                -webkit-box-shadow: 4px 4px 5px 0px rgba(50, 50, 50, 0.5);
                -moz-box-shadow:    4px 4px 5px 0px rgba(50, 50, 50, 0.5);
                box-shadow:         4px 4px 5px 0px rgba(50, 50, 50, 0.5);
            }

            .login h1 a{
                width: 100%;
                margin: 30px 0 0 0;
                background: <?php echo $logo_bg_color['color'] ?> <?php if( !empty( $logo_bg_image ) ): ?> url('<?php echo $logo_bg_image ?>') no-repeat center center <?php endif;?>;
                background-size: auto;
            }

            #loginform{
                background: <?php echo $container_bg_color['color'] ?>;
                box-shadow: none;
                margin-top: 0;
                padding-bottom: 28px;
            }

            #loginform h3{
                font-family: '<?php echo $label['family'] ?>', serif;
                font-size: <?php echo $label['size'] ?><?php echo $label['unit']?>;
                font-weight: <?php echo $label['font-weight']?>;
                text-transform: <?php echo $label['transform'] ?>;
            }

            #loginform .newsociallogins .new-fb-1, .new-fb-1 .new-fb-1-1, .new-fb-1 .new-fb-1-1-1{
                background: none;
                padding: 0;
                text-shadow: none;
            }

            #loginform .newsociallogins .new-fb-1-1-1{
                padding: 0 6px;
                background-color: transparent;
                border: 1px solid;
                border-color: <?php echo $submit_border_colors['color']['hover'] ?>;
                border-radius: 1px;
                box-shadow: none;

                font-family: '<?php echo $submit['family']?>', serif;
                font-weight: <?php echo $submit['font-weight']?>;
                font-size: <?php echo $submit['size']?><?php echo $submit['unit']?>;
                color: <?php echo $submit['color']?>;
                text-transform: <?php echo $submit['transform']?>;
            }

            #loginform .newsociallogins .new-fb-1-1-1:before{
                font-size: 16px;
                margin-right: 10px;
                margin-top: 2px;
                font-family: 'FontAwesome';
                content: "\f09a"
            }

            #loginform .newsociallogins .new-fb-1-1-1:after{
                content: ' FACEBOOK';
            }

            #loginform .newsociallogins .new-fb-1-1-1:hover{
                background-color: <?php echo $submit_bg_colors['color']['hover'] ?>;
                border-color: <?php echo $submit_border_colors['color']['hover'] ?>;
            }

            #loginform .newsociallogins .new-fb-1-1-1:hover{
                color: <?php echo $submit_hover_color['color']?>;
            }

            #loginform label,
            .login-box .wp-social-login-widget #wp-social-login-connect-with,
            .wp-social-login-widget .wp-social-login-connect-with, .ywsl-label{
                font-family: '<?php echo $label['family'] ?>', serif;
                font-size: <?php echo $label['size'] ?><?php echo $label['unit']?>;
                font-weight: <?php echo $label['font-weight']?>;
                text-transform: <?php echo $label['transform'] ?>;
                color: <?php echo $label['color'] ?>;
                z-index: 10;
                position: relative;
                display: block;
                width: 100%;
            }

            #loginform .forgetmenot label{
               font-family: '<?php echo $remember_me['family'] ?>', serif;
               font-size: <?php echo $remember_me['size'] ?><?php echo $label['unit']?>;
               font-weight: <?php echo $remember_me['font-weight']?>;
               text-transform: <?php echo $remember_me['transform'] ?>;
               color: <?php echo $remember_me['color'] ?>;
            }

            #loginform input[type='text'], #loginform input[type='password']{
                background: transparent;
                border-radius: 1px;
                box-shadow: none;
                border-color: #cdcdcd;
                padding-left: 10px;
                padding-top: 4px;
                font-size: 16px;
                height: 38px;

            }

            #loginform input[type='text']:before, #loginform input[type='password']:before{
                content: '';
                height: 30px;
                width: 100%;
                border: 1px solid #000000;
                z-index: -1;
            }

            #loginform input[type='checkbox'], #loginform input[type='checkbox']:focus{
                border-color: #cdcdcd;
                background: #ffffff;
                margin-top: -2px;
                margin-right: 5px;
            }

            #loginform input:active, #loginform input:focus{
                border-color: #d1d1d1;
                box-shadow: none;
            }

            #loginform input{
                outline: none;
            }

            #loginform .forgetmenot label{
                text-transform: none;
                font-size: 14px;
            }

            #loginform .forgetmenot label:before{
                display: none;
            }

            .forgetmenot input[type=checkbox]:checked:before{
                font-size: 40px;
                margin: -4px 0 0 -12px;
                color: <?php echo $submit_bg_colors['color']['normal'] ?>;
                line-height: 0.5;
            }

            #login #wp-submit{
                padding: 2px 20px 0 20px;
                height: 32px;
                line-height: 0;
            }

            .login .button-primary{
                background: <?php echo $submit_bg_colors['color']['normal'] ?>;
                border-color: <?php echo $submit_border_colors['color']['normal'] ?>;
                border-radius: 1px;
                box-shadow: none;

                font-family: '<?php echo $submit['family']?>', serif;
                font-weight: <?php echo $submit['font-weight']?>;
                font-size: <?php echo $submit['size']?><?php echo $submit['unit']?>;
                color: <?php echo $submit['color']?>;
                text-transform: <?php echo $submit['transform']?>;
                -webkit-transition: all 0.3s;
                -moz-transition: all 0.3s;
                transition: all 0.3s;
            }

            .login .button-primary:hover, .login .button-primary:active, .login .button-primary:visited, .login .button-primary:focus{
                background-color: <?php echo $submit_bg_colors['color']['hover'] ?>;
                box-shadow: none;
                border-color: <?php echo $submit_border_colors['color']['hover'] ?>;
                color: <?php echo $submit_hover_color['color']?>;
            }

            .login #nav, .login #backtoblog{
                text-align: center;
                margin-top: 0;
            }

            .login #backtoblog{
                margin-bottom: 15px;
            }

            .login #nav a, .login #backtoblog a{
                font-family: '<?php echo $links['family']?>';
                font-size: <?php echo $links['size']?><?php echo $links['unit']?>;
                font-weight: <?php echo $links['font-weight']?>;
                color: <?php echo $links['color']?>;
            }

            .login #nav a:hover, .login  #backtoblog a:hover{
                color: <?php echo $links_hover['color'] ?>;
            }
            .login #wp-social-login-connect-options{
                padding: 10px 0px;
            }

            .login .wp-social-login-widget .wp-social-login-provider-list {
                padding-left: 0;
            }

            .login .wp-social-login-widget .wp-social-login-provider-list i{
                margin-right: 3px;
            }

            <?php echo $custom_style ?>

        </style>
        <?php
    }

    /**
    */
    public function add_splash_script(){
        ?>
        <script type="text/javascript">
            jQuery(function($){
                $('#login h1, form').wrapAll('<div id="login-container" />');

                $('#login_error, p.message').prependTo('#login');
            });
        </script>
        <?php
    }

    /**
     * Typography style parser
     *
     * Return the font-weight and the font-style from Custom Login typography option
     *
     * @access public
     * @param $typography Array ! Array option to parse
     * @return void
     * @since 2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function typography_style_parser( $typography ){
        switch ( $typography['style'] ) {
            case 'bold' :
                $typography['font-style']  = 'normal';
                $typography['font-weight'] = '700';
                break;
            case 'extra-bold' :
                $typography['font-style']  = 'normal';
                $typography['font-weight'] = '800';
                break;
            case 'italic' :
                $typography['font-style']  = 'italic';
                $typography['font-weight'] = 'normal';
                break;
            case 'bold-italic' :
                $typography['font-style']  = 'italic';
                $typography['font-weight'] = '700';
                break;
            case 'regular' :
                $typography['font-style']  = 'normal';
                $typography['font-weight'] = '400';
                break;

            default:
                if( is_numeric( $typography['style'] ) ) {
                    $typography['font-style']  = 'normal';
                    $typography['font-weight'] = $typography['style'];
                }else {
                    $typography['font-style']  = 'italic';
                    $typography['font-weight'] = str_replace( 'italic', '', $typography['style'] );
                }
                break;
        }

        return $typography;
    }

    /**
     * add jQuery lib
     *
     * add jquery lib to custom login page
     *
     * @access public
     * @return void
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function add_jquery_lib(){
        wp_enqueue_script( 'jquery' );
    }
}
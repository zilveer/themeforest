<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Manage Custom Splash Screen
 * 
 * @since 1.0.0
 */
class YIT_Splash {
	


	/**
	 * Constructor
	 */
	public function __construct() {}
	
	/**
	 * Init
	 * 
	 */
	public function init() {
		if( $this->_isSplashEnabled() ) {
			add_action( 'login_head', array( $this, 'add_splash_google_fonts'), 5 );
			add_action( 'login_head', array( $this, 'add_splash_style'), 15 );
			add_action( 'login_head', array( $this, 'add_splash_script'), 15 );
            add_action( 'login_headerurl', array( $this, 'change_logo_url' ) );
            add_action( 'login_headertitle', array( $this, 'change_logo_title' ) );
		}
	}

	/**
	 * Is the login screen enabled?
	 * 
	 * @return bool
	 * @since 1.0.0
	 */
	protected function _isSplashEnabled() {
		return yit_get_option('enable-splash');
	}
	
	/**
	 * Load the Google Fonts
	 * 
	 * @return void
	 * @since 1.0.0
	 */
	public function add_splash_google_fonts() {
		$options = array(
			yit_get_option('splash-container-label_font'),
			yit_get_option('splash-container-submit_font'),
			yit_get_option('splash-container-lostback_font')
		);
		
		$fonts = array();
		foreach( $options as $option ) {
			yit_get_model('google_font')->add_google_font( $option['family'] );
		}
	}

    /**
     * Change the logo URL to the home URL.
     *
     * @return string|void
     */
    public function change_logo_url() {
        return home_url();
    }

    /**
     * Change the logo Title.
     *
     * @return string
     */
    public function change_logo_title() {
        return get_bloginfo( 'name' );
    }
	
	/**
	 * Add custom style to login screen
	 * 
	 * @return void
	 * @since 1.0.0
	 */
	public function add_splash_style() {
		$bg_color = yit_get_option('splash-bg_color');
		$bg_image = yit_get_option('splash-bg_image');
		$bg_repeat = yit_get_option('splash-bg_image_repeat');
		$bg_position = yit_get_option('splash-bg_image_position');
		$bg_attachment = yit_get_option('splash-bg_image_attachment');
		
		$label = yit_get_option('splash-container-label_font');
        switch ( $label['style'] ) { 
	        case 'bold' :
		        $label['font-style']  = 'normal';
		        $label['font-weight'] = '700';  
		        break;
	        case 'extra-bold' :
		        $label['font-style']  = 'normal';
		        $label['font-weight'] = '800';  
		        break;  
	        case 'italic' :
		        $label['font-style']  = 'italic';
		        $label['font-weight'] = 'normal'; 
		        break;        
	        case 'bold-italic' :
		        $label['font-style']  = 'italic';
		        $label['font-weight'] = '700';   
		        break;            
	        case 'regular' :
		        $label['font-style']  = 'normal';
		        $label['font-weight'] = '400';   
		        break;
        }          
		
		$submit = yit_get_option('splash-container-submit_font');
        switch ( $submit['style'] ) { 
	        case 'bold' :
		        $submit['font-style']  = 'normal';
		        $submit['font-weight'] = '700';  
		        break;
	        case 'extra-bold' :
		        $submit['font-style']  = 'normal';
		        $submit['font-weight'] = '800';  
		        break;  
	        case 'italic' :
		        $submit['font-style']  = 'italic';
		        $submit['font-weight'] = 'normal'; 
		        break;        
	        case 'bold-italic' :
		        $submit['font-style']  = 'italic';
		        $submit['font-weight'] = '700';   
		        break;            
	        case 'regular' :
		        $submit['font-style']  = 'normal';
		        $submit['font-weight'] = '400';
		        break;
        }
		
		$links = yit_get_option('splash-container-lostback_font');
        switch ( $links['style'] ) { 
	        case 'bold' :
		        $links['font-style']  = 'normal';
		        $links['font-weight'] = '700';  
		        break;
	        case 'extra-bold' :
		        $links['font-style']  = 'normal';
		        $links['font-weight'] = '800';  
		        break;  
	        case 'italic' :
		        $links['font-style']  = 'italic';
		        $links['font-weight'] = 'normal'; 
		        break;        
	        case 'bold-italic' :
		        $links['font-style']  = 'italic';
		        $links['font-weight'] = '700';   
		        break;            
	        case 'regular' :
		        $links['font-style']  = 'normal';
		        $links['font-weight'] = '400';
		        break;
        }  
		
		$custom_style = yit_get_option('splash-custom-style');	
?>
<style type="text/css">
body.login, html {
	background: <?php echo $bg_color ?> <?php if($bg_image): ?>url('<?php echo $bg_image ?>') <?php echo $bg_repeat ?> <?php echo $bg_position ?> <?php echo $bg_attachment ?><?php endif ?>;
}

#login {
	width: <?php echo yit_get_option('splash-container_width') ?>px;
}

.login form {
	border: none;
	background: transparent;
	margin: 0 auto;
	padding: 0;
	width: 340px;
	
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}

.login form .input, .login input[type="text"] {
	margin: 15px 0;
	background: transparent;
	height: 45px;
	border: 1px solid #d1d1cf;
	
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
}

.login label, .login form .input, .login input[type="text"] {
	font-size: <?php echo $label['size'] . $label['unit'] ?>;
	font-family: "<?php echo $label['family']; ?>", Verdana, sans-serif;
	font-style: <?php echo $label['font-style'] ?>;
	font-weight: <?php echo $label['font-weight'] ?>;
	color: <?php echo $label['color']; ?>;
}


.login form .input:focus, .login input[type="text"]:focus {
	-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 3px rgba(0, 0, 0, 0.2) !important;
	-moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 3px rgba(0, 0, 0, 0.2) !important;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 3px rgba(0, 0, 0, 0.2) !important;
	border-color: rgba(0, 0, 0, 0.2) !important;
}

.login form .forgetmenot label {
	color: <?php echo $label['color']; ?>;
	font-size: 11px;
	line-height: 31px 
}

#forgetmenot { margin-top: 6px; }
#rememberme { margin-right: 10px; margin-top: 0 }

input#wp-submit.button-primary, /* WP 3.4 */
.wp-core-ui .button.button-large, .wp-core-ui .button-group.button-large .button, .wp-core-ui .button-primary, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:hover, .wp-core-ui .button-primary.focus, .wp-core-ui .button-primary:focus {
	background-image: none;
	background-color: <?php echo yit_get_option('splash-container-submit_bg_color') ?>;
	
	font-size: <?php echo $submit['size'] . $submit['unit'] ?> !important;
	font-family: "<?php echo $submit['family']; ?>", Verdana, sans-serif;
	font-style: <?php echo $submit['font-style'] ?>;
	font-weight: <?php echo $submit['font-weight'] ?>;
	color: <?php echo $submit['color']; ?>;
	border: none;
	
	height: 29px;
	line-height: 22px;
	padding-left: 20px;
	padding-right: 20px;
	padding-top: 0px;
	
	text-transform: uppercase;
	text-shadow: #000 0 0px 0px !important;
	
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
	
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	box-shadow: none;
}

input#wp-submit.button-primary:hover, /* WP 3.4 */
.wp-core-ui .button-primary:hover {
	background-color: <?php echo yit_get_option('splash-container-submit_bg_color_hover') ?>;
}

.login #nav, .login #backtoblog {
	text-align: center;
	text-shadow: #623806 0 1px 1px !important;
	margin: 0;
	padding: 0;
	color: <?php echo $links['color']; ?> !important;
}

.login #nav a:hover, .login #backtoblog a:hover {
	text-shadow: none !important;
	color: #000 !important;
}

.login #nav {
	margin-top: 23px;
}

.login #nav a, .login #backtoblog a {
	font-size: <?php echo $links['size'] . $links['unit'] ?>;
	font-family: "<?php echo $links['family']; ?>", Verdana, sans-serif;
	font-style: <?php echo $links['font-style'] ?>;
	font-weight: <?php echo $links['font-weight'] ?>;
	color: <?php echo $links['color']; ?> !important;
	text-decoration: none;
}

#login-container {
	background-color: <?php echo yit_get_option('splash-container-bg_color'); ?>;
	background-image: <?php echo yit_get_option('splash-container-bg_image') ? 'url("' . yit_get_option('splash-container-bg_image') . '")' : 'none'; ?>;
	background-repeat: no-repeat;
	background-position: center;
	height: <?php echo yit_get_option('splash-container_height') ?>px;
}

#login_error, .login .message {
	margin: 0 0 16px 0px
}

<?php if( yit_get_option('splash-logo_image') ): $upload_dir = wp_upload_dir(); list($width, $height, $type, $attr) = getimagesize( str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], yit_get_option('splash-logo_image') ) ); ?>
.login h1 a {
	background-image: url('<?php echo yit_get_option('splash-logo_image') ?>');
	background-color: <?php echo yit_get_option('splash-logo_color') ? yit_get_option('splash-logo_color') : 'transparent' ?>;
	background-size: auto;
	background-position: top center;
	width: <?php echo yit_get_option('splash-container_width') ?>px;
	height: <?php echo $height ?>px;
	float: left;
}
<?php endif ?>

.mobile #login h1 a { width: 100% }
.mobile #login form, .mobile #login .message, .mobile #login_error { margin-left: auto }

<?php echo $custom_style ?>
</style>
<?php	
	}
	
	/**
	 * Add custom script to login screen
	 * 
	 * @return void
	 * @since 1.0.0
	 */
	public function add_splash_script() {
?>
<script type="text/javascript">
jQuery(function($){
	$('#login h1, form').wrapAll('<div id="login-container" />');
	
	$('#login_error, p.message').prependTo('#login');
});
</script>
<?php
	}
}
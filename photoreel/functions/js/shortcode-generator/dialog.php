<?php
if ( ! isset( $_GET['tmnf-shortcodes-nonce'] ) || ( $_GET['tmnf-shortcodes-nonce'] == '' ) ) die( 'Security check' );

// Get the path to the root.
$full_path = __FILE__;

$path_bits = explode( 'wp-content', $full_path );

$url = $path_bits[0];

// Require WordPress bootstrap.
require_once( $url . '/wp-load.php' );

// Nonce security check.    
$nonce = $_GET['tmnf-shortcodes-nonce'];
if ( ! wp_verify_nonce( $nonce, 'framework-shortcode-generator' ) ) die( 'Security check' );

$tmnf_framework_version = '3.9';

$MIN_VERSION = '2.9';

$meetsMinVersion = version_compare($tmnf_framework_version, $MIN_VERSION) >= 0;

$tmnf_framework_path = dirname(__FILE__) .  '/../../';

$tmnf_framework_url = get_template_directory_uri() . '/functions/';

$tmnf_shortcode_css = $tmnf_framework_path . 'css/shortcodes.css';
                                  
$isThemnificTheme = file_exists($tmnf_shortcode_css);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<div id="tmnf-dialog">

<?php if ( $meetsMinVersion && $isThemnificTheme ) { ?>
<div id="tmnf-options-buttons" class="clear">
	<div class="alignleft">
	
	    <input type="button" id="tmnf-btn-cancel" class="button" name="cancel" value="Cancel" accesskey="C" />
	    
	</div>
	<div class="alignright">
	    <input type="button" id="tmnf-btn-insert" class="button-primary" name="insert" value="Insert" accesskey="I" />  
	</div>
	<div class="clear"></div><!--/.clear-->
</div><!--/#tmnf-options-buttons .clear-->

<div id="tmnf-options" class="alignleft">
    <h3><?php echo __( 'Customize the Shortcode', 'Themnific' ); ?></h3>
    
	<table id="tmnf-options-table">
	</table>

</div>
<div class="clear"></div>


<script type="text/javascript" src="<?php echo esc_url( $tmnf_framework_url . 'js/shortcode-generator/js/column-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( $tmnf_framework_url . 'js/shortcode-generator/js/tab-control.js' ); ?>"></script>
<?php  }  else { ?>

<div id="tmnf-options-error">

    <h3><?php echo __( 'Ninja Trouble', 'Themnific' ); ?></h3>
    
    <?php if ( $isThemnificTheme && ( ! $meetsMinVersion ) ) { ?>
    <p><?php echo sprinf ( __( 'Your version of the framework (%s) does not yet support shortcodes. Shortcodes were introduced with version %s of the framework.', 'Themnific' ), $tmnf_framework_version, $MIN_VERSION ); ?></p>
    
    <h4><?php echo __( 'What to do now?', 'Themnific' ); ?></h4>
    
    <p><?php echo __( 'Upgrading your theme, or rather the framework portion of it, will do the trick.', 'Themnific' ); ?></p>

	<p><?php echo sprintf( __( 'The framework is a collection of functionality that all Themnific have in common. In most cases you can update the framework even if you have modified your theme, because the framework resides in a separate location (under %s).', 'Themnific' ), '<code>/functions/</code>' ); ?></p>
	
	<p><?php echo sprintf ( __( 'There\'s a tutorial on how to do this on Themnific.com: %sHow to upgradeyour theme%s.', 'Themnific' ), '<a title="Themnific Tutorial" target="_blank" href="http://www.Themnific.com/2009/08/how-to-upgrade-your-theme/">', '</a>' ); ?></p>
	
	<p><?php echo __( '<strong>Remember:</strong> Every Ninja has a backup plan. Safe or not, always backup your theme before you update it or make changes to it.', 'Themnific' ); ?></p>

<?php } else { ?>

    <p><?php echo __( 'Looks like your active theme is not from Themnific. The shortcode generator only works with themes from Themnific.', 'Themnific' ); ?></p>
    
    <h4><?php echo __( 'What to do now?', 'Themnific' ); ?></h4>

	<p><?php echo __( 'Pick a fight: (1) If you already have a theme from Themnific, install and activate it or (2) if you don\'t yet have one of the awesome Themnific head over to the <a href="http://www.Themnific.com/themes/" target="_blank" title="Themnific Gallery">Themnific Gallery</a> and get one.', 'Themnific' ); ?></p>

<?php } ?>

<div style="float: right"><input type="button" id="tmnf-btn-cancel"
	class="button" name="cancel" value="Cancel" accesskey="C" /></div>
</div>

<?php  } ?>

<script type="text/javascript" src="<?php echo esc_url( $tmnf_framework_url . 'js/shortcode-generator/js/dialog-js.php' ); ?>"></script>
</div>
</body>
</html>
<?php 
// Get the path to the root.
$full_path = __FILE__;

$path_bits = explode( 'wp-content', $full_path );

$url = $path_bits[0];

// Require WordPress bootstrap.
require_once( $url . '/wp-load.php' );
                                   
$des_framework_version = get_option( 'des_framework_version' );

$MIN_VERSION = '2.9';

$meetsMinVersion = version_compare($des_framework_version, $MIN_VERSION) >= 0;

$des_framework_path = dirname(__FILE__) .  '/../../';

$des_framework_url = get_template_directory_uri() . '/functions/';

$des_shortcode_css = $des_framework_path . 'css/shortcodes.css';
                                  
$isDesTheme = file_exists($des_shortcode_css);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<div id="des-dialog">

<?php if ( $meetsMinVersion && $isDesTheme ) { ?>

<div id="des-options-buttons" class="clear">
	<div class="alignleft">
	
	    <input type="button" id="des-btn-cancel" class="button" name="cancel" value="Cancel" accesskey="C" />
	    
	</div>
	<div class="alignright">
	
	    <input type="button" id="des-btn-insert" class="button-primary" name="insert" value="Insert" accesskey="I" />
	    
	</div>
	<div class="clear"></div><!--/.clear-->
</div><!--/#des-options-buttons .clear-->

<div id="des-options" class="alignleft">
    <h3><?php echo __( 'Customize the Shortcode', 'smartbox' ); ?></h3>
    
	<table id="des-options-table">
	</table>

</div>

<div class="clear"></div>

<?php  }  else { ?>

<div id="des-options-error">

    <h3><?php echo __( 'Ninja Trouble', 'smartbox' ); ?></h3>
    
    <?php if ( $isDesTheme && ( ! $meetsMinVersion ) ) { ?>
    <p><?php echo sprintf ( __( 'Your version of the DesFramework (%s) does not yet support shortcodes. Shortcodes were introduced with version %s of the framework.', 'smartbox' ), $des_framework_version, $MIN_VERSION ); ?></p>
    
    <h4><?php echo __( 'What to do now?', 'smartbox' ); ?></h4>
    
    <p><?php echo __( 'Upgrading your theme, or rather the DesFramework portion of it, will do the trick.', 'smartbox' ); ?></p>

	<p><?php echo sprintf( __( 'The framework is a collection of functionality that all DesThemes have in common. In most cases you can update the framework even if you have modified your theme, because the framework resides in a separate location (under %s).', 'smartbox' ), '<code>/functions/</code>' ); ?></p>
	
	<p><?php echo sprintf ( __( 'There\'s a tutorial on how to do this on DesThemes.com: %sHow to upgradeyour theme%s.', 'smartbox' ), '<a title="DesThemes Tutorial" target="_blank" href="http://www.desthemes.com/2009/08/how-to-upgrade-your-theme/">', '</a>' ); ?></p>
	
	<p><?php echo __( '<strong>Remember:</strong> Every Ninja has a backup plan. Safe or not, always backup your theme before you update it or make changes to it.', 'smartbox' ); ?></p>

<?php } else { ?>

    <p><?php echo __( 'Looks like your active theme is not from DesThemes. The shortcode generator only works with themes from DesThemes.', 'smartbox' ); ?></p>
    
    <h4><?php echo __( 'What to do now?', 'smartbox' ); ?></h4>

	<p><?php echo __( 'Pick a fight: (1) If you already have a theme from DesThemes, install and activate it or (2) if you don\'t yet have one of the awesome DesThemes head over to the <a href="http://www.designare.com/themes/" target="_blank" title="DesThemes Gallery">DesThemes Gallery</a> and get one.', 'smartbox' ); ?></p>

<?php } ?>

<div style="float: right"><input type="button" id="des-btn-cancel"
	class="button" name="cancel" value="Cancel" accesskey="C" /></div>
</div>

<?php  } ?>

<script type="text/javascript" src="<?php echo $des_framework_url; ?>js/shortcode-generator/js/dialog-js.php"></script>

</div>

<ul style="display:none;" class="designare_testimonials_categories">
	<?php
		// GET Categories	
		$args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'testimonials_category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		
		$categories = get_categories( $args );
		
		foreach($categories as $c){		
			echo "<li>".$c->slug."|*|".$c->name."</li>";
		}
	?>
</ul>
<ul style="display:none;" class="designare_portfolio_categories">
	<?php
		// GET Categories	
		$args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'portfolio_category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		
		$categories = get_categories( $args );
		
		foreach($categories as $c){		
			echo "<li>".$c->slug."|*|".$c->name."</li>";
		}
	?>
</ul>
<ul style="display:none;" class="designare_team_categories">
	<?php
		// GET Categories	
		$args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'team_category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		
		$categories = get_categories( $args );
		
		foreach($categories as $c){		
			echo "<li>".$c->slug."|*|".$c->name."</li>";
		}
	?>
</ul>
<ul style="display:none;" class="designare_partners_categories">
	<?php
		// GET Categories	
		$args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'partners_category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		
		$categories = get_categories( $args );
		
		foreach($categories as $c){		
			echo "<li>".$c->slug."|*|".$c->name."</li>";
		}
	?>
</ul>
<ul style="display:none;" class="designare_post_categories">
	<?php
		// GET Categories	
		$args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		
		$categories = get_categories( $args );
		
		foreach($categories as $c){		
			echo "<li>".$c->slug."|*|".$c->name."</li>";
		}
	?>
</ul>


</body>
</html>
<?php
$settings = 'mods_'.get_current_theme(); // do not change!

$defaults = array( // define our defaults
		'featured_portfolio' => 1,
		'blog_cat_num' => 10 // <-- no comma after the last option
);

//	push the defaults to the options database,
//	if options don't yet exist there.
add_option($settings, $defaults, '', 'yes');

/*
///////////////////////////////////////////////
This section hooks the proper functions
to the proper actions in WordPress
\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
*/
//	this function registers our settings in the db
add_action('admin_init', 'register_theme_settings');
function register_theme_settings() {
	global $settings;
	register_setting($settings, $settings);
}
//	this function adds the settings page to the Appearance tab
add_action('admin_menu', 'add_theme_options_menu');
function add_theme_options_menu() {
	add_submenu_page('themes.php', 'BVD Page Options', 'BVD Page Options', 8, 'theme-options', 'theme_settings_admin');
}

/*
///////////////////////////////////////////////
This section handles all the admin page
output (forms, update notifications, etc.)
\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
*/
function theme_settings_admin() { ?>
<?php theme_options_css_js(); ?>

<div class="wrap">
  <?php
	// display the proper notification if Saved/Reset
	global $settings, $defaults;
	if(get_theme_mod('reset')) {
		echo '<div class="updated fade" id="message"><p>'.__('Theme Options', 'BVD ').' <strong>'.__('RESET TO DEFAULTS', 'BVD ').'</strong></p></div>';
		update_option($settings, $defaults);
	} elseif($_REQUEST['updated'] == 'true') {
		echo '<div class="updated fade" id="message"><p>'.__('Theme Options', 'BVD ').' <strong>'.__('SAVED', 'BVD ').'</strong></p></div>';
	}
	// display icon next to page title
	screen_icon('options-general');
?>
  <h2><?php echo get_current_theme() . ' '; _e('Theme Options', 'BVD '); ?></h2>
  <form method="post" action="options.php">
    <?php settings_fields($settings); // important! ?>
    <!--first column-->
    <div class="metabox-holder">
      <div class="postbox">
        <h3>
          <?php _e("Portfolio Page Settings", 'BVD '); ?>
        </h3>
        <div class="inside">
          <p>
            <?php _e("Select which category you want displayed", 'BVD '); ?>
            :<br />
            <?php wp_dropdown_categories(array('selected' => get_theme_mod('featured_portfolio'), 'name' => $settings.'[featured_portfolio]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>
          </p>
          
          
        </div>
      </div>
      <div class="metabox-holder">
        <p class="submit">
          <input type="submit" class="button-primary" value="<?php _e('Save Settings', 'BVD ') ?>" />
          <input type="submit" class="button-highlighted" name="<?php echo $settings; ?>[reset]" value="<?php _e('Reset Settings', 'BVD '); ?>" />
        </p>
      </div>
    </div>
    <!--end first column-->
    <!--second column-->
    <!--end second column-->
  </form>
</div>
<!--end .wrap-->
<?php }

// add CSS and JS if necessary
function theme_options_css_js() {
echo <<<CSS

<style type="text/css">
	.metabox-holder { 
		width: 350px; float: left;
		margin: 0; padding: 0 10px 0 0;
	}
	.metabox-holder .postbox .inside {
		padding: 0 10px;
	}
</style>

CSS;
echo <<<JS

<script type="text/javascript">
jQuery(document).ready(function($) {
	$(".fade").fadeIn(1000).fadeTo(1000, 1).fadeOut(1000);
});
</script>

JS;
}
?>

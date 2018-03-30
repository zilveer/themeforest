<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

function theme_options_init()
{
	register_setting( LANGUAGE_ZONE.'_options', LANGUAGE_ZONE.'_theme_options', 'theme_options_validate' );
}

function theme_options_add_page()
{	
   $slug = LANGUAGE_ZONE;
   add_menu_page(THEME_TITLE, THEME_TITLE, 'manage_options', $slug, 'theme_menu_options', get_template_directory_uri().'/images/theme_icon.png', 1000);
   add_submenu_page($slug, "Appearance", "Appearance", 'manage_options', $slug, 'theme_menu_options');
   add_submenu_page($slug, "Social links", "Social links", 'manage_options', $slug.'_social', 'theme_social_options');
   add_submenu_page($slug, "Like buttons", "Like buttons", 'manage_options', $slug.'_like_buttons', 'theme_like_buttons');
   add_submenu_page($slug, "Analytics", "Analytics", 'manage_options', $slug.'_analytics', 'theme_analytics_options');
   add_submenu_page($slug, "Captcha", "Captcha", 'manage_options', $slug.'_captcha', 'theme_captcha_options');
}

function theme_header()
{
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
   ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/colorpicker/js/colorpicker.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/colorpicker/js/eye.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/colorpicker/js/utils.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/admin.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/colorpicker/css/colorpicker.css" type="text/css" />	
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/colorpicker/css/style.css" type="text/css" />	
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/admin.css" type="text/css" />	

<div class="wrap">

	<?php screen_icon(); echo "<h2>" . __( THEME_TITLE.' &mdash; '.get_admin_page_title() ) . "</h2>"; ?>

	<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
	<div class="updated fade"><p><strong><?php echo __( 'Options saved', LANGUAGE_ZONE ); ?></strong></p></div>
	<?php endif; ?>

	<form method="post" action="options.php" enctype="multipart/form-data" id="f_1">
		<?php settings_fields( LANGUAGE_ZONE.'_options' ); ?>
   <?php
}

function theme_footer()
{
   ?>
	   <p class="submit">
		   <input type="submit" class="button-primary" value="<?php echo ( 'Save Options' ); ?>" />
	   </p>
   </form>
</div>
   <?php
}

function echo_u($opt)
{
	$options = get_option( LANGUAGE_ZONE.'_theme_options' );
	$up_dir = wp_upload_dir();
	$dir = $up_dir['baseurl'].'/dt_uploads/';
	foreach ($opt as $id=>$title) {
		$current_option = empty( $options[ $id ] ) ? '' : $options[ $id ];
	?>
	<tr valign="top"><th scope="row"><?php _e( $title ); ?></th>
		<td>
			<div id="<?php echo LANGUAGE_ZONE; ?>_theme_options[<?php echo $id; ?>]_upl"<?php if ( !empty( $current_option ) ) echo ' style="display: none;"' ?> class="upload">
			<input id="<?php echo LANGUAGE_ZONE; ?>_theme_options[<?php echo $id; ?>]" class="regular-text" type="file" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[<?php echo $id; ?>]" />
			<input id="<?php echo LANGUAGE_ZONE; ?>_theme_options[<?php echo $id; ?>]_del" type="hidden" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[del_<?php echo $id; ?>]" value="0" />
			<input id="<?php echo LANGUAGE_ZONE; ?>_theme_options[<?php echo $id; ?>]_prev" type="hidden" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[prev_<?php echo $id; ?>]" value="<?php echo $current_option; ?>" />
			<a href="#" id="<?php echo LANGUAGE_ZONE; ?>_theme_options[<?php echo $id; ?>]_cancel"<?php if ( empty( $current_option ) ) echo ' style="display: none;"' ?>>Cancel</a>
			<label class="description" for="<?php echo LANGUAGE_ZONE; ?>_theme_options[<?php echo $id; ?>]"></label>
			</div>
			<div id="<?php echo LANGUAGE_ZONE; ?>_theme_options[<?php echo $id; ?>]_ok"<?php if ( empty( $current_option ) ) echo ' style="display: none;"' ?>>
				<a href="<?php if ( $current_option ) { echo $dir . $current_option; } else { echo 'javascript: void(0);'; } ?>" target="_blank">View</a> | <a href="#" id="<?php echo LANGUAGE_ZONE; ?>_theme_options[<?php echo $id; ?>]_new">Upload</a> | <a href="#" id="<?php echo LANGUAGE_ZONE; ?>_theme_options[<?php echo $id; ?>]_del">Delete</a>
			</div>
		</td>
	</tr>
	<?php }
}

function theme_options_validate( $input ) {

	$up_dir = wp_upload_dir();
	$dir = $up_dir['basedir'].'/dt_uploads';
	if( !file_exists($dir)) {
		@mkdir($dir);
	}
	
	foreach (array('logo', 'mobile_logo', 'custom_cufon', 'custom_bg1', 'custom_bg2', 'favicon') as $id)
	{
	
	   $im   = isset( $_FILES[LANGUAGE_ZONE.'_theme_options']['tmp_name'][$id] ) ? $_FILES[LANGUAGE_ZONE.'_theme_options']['tmp_name'][$id] : '';
	   
	   if ($im)
	   {
			$type = $_FILES[LANGUAGE_ZONE.'_theme_options']['type'][$id];
	      $type = str_replace(
			array( "image/", "application/x-javascript", "application/javascript" ),
			array( "", "js", "js" ),
			$type
		  );

	      $fname=time()."_".$id.".".$type;
	      if ( $id == "favicon" )
	         $fname = "favicon.ico";
	      $input[$id]=$fname;
	      move_uploaded_file($im, $dir.'/'.$fname);
	   }
	   else
	   {
			if ( ! empty( $input['del_'.$id] ) ) {
				$input[ $id ] = "";
			} elseif ( isset( $input[ 'prev_' . $id ] ) ) {
				$input[ $id ] = $input[ 'prev_' . $id ];
			}
	   }
	
	}

	if ( ! empty( $_POST["save_chkboxes"] ) ) {
		foreach ( array(
			  'use_custom_cufon', 'hide_sidebar_in_mobile', 'bg1_repeat_x', 'bg1_repeat_y', 'bg1_center', 'bg1_fixed',
			  'bg2_repeat_x', 'bg2_repeat_y', 'bg2_center', 'bg2_fixed',
			  'cufon_enabled', 'menu_cl', 'show_credits', 'hide_post_formats', 'hide_search', 'turn_off_responsivness'
		) as $opt )
		{
		   $input[ $opt ] = ( isset($input[ $opt ]) && $input[ $opt ] == "on" ? 1 : 0);
		}
	}
	
	if ( ! empty( $_POST["save_captcha_checkboxes"] ) ) {
		foreach ( array(
			'captcha_hide_register',
			'captcha_math_action_minus',
			'captcha_math_action_increase',
			'captcha_difficulty_number',
			'captcha_difficulty_word' ) as $opt )
		{
	   		$input[ $opt ] = ( isset($input[ $opt ]) && $input[ $opt ] == "on" ? 1 : 0);
		}
	}

	if ( ! empty( $_POST["save_like_buttons_checkboxes"] ) ) {
		foreach ( array('enable_in_album', 'enable_in_photos', 'enable_in_blog', 'enable_in_portfolio', 'twitter_lb', 'faceboock_lb', 'google_plus_lb', 'use_custom_likes') as $opt ) {
	   		$input[ $opt ] = ( isset($input[ $opt ]) && $input[ $opt ] == "on" ? 1 : 0);
		}
	}

   $options = get_option( LANGUAGE_ZONE.'_theme_options' );
   foreach ($options as $k=>$v)
   {
      if ( !isset($input[$k]) )
         $input[ $k ] = $v;
   }
	//var_dump($input);
	return $input;
}

//print_r( get_option(LANGUAGE_ZONE.'_theme_options') );

?>

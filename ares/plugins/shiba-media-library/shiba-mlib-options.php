<?php
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

if (!is_admin()) exit();

global $shiba_mlib;
$location = wp_get_referer(); //'upload.php?page=shiba_media_options';

if (isset($_POST['save_options'])) {
	check_admin_referer('shiba_media_options');
	unset($_POST['_wpnonce'], $_POST['_wp_http_referer'], $_POST['save_theme_options']);
	update_option('shiba_mlib_options', $_POST);
//	$location = add_query_arg('message', 1, $location);
			
	$shiba_mlib->javascript_redirect($location);
	exit;
}

$options = get_option('shiba_mlib_options');


$messages[1] = __('Shiba Media Library settings updated.', 'shiba_mlib');

if ( isset($_GET['message']) && (int) $_GET['message'] ) {
	$message = $messages[$_GET['message']];
	$_SERVER['REQUEST_URI'] = remove_query_arg(array('message'), $_SERVER['REQUEST_URI']);
}

$title = __('Shiba Media Options', THEMEDOMAIN);
$shortcode = (isset($options['shortcode'])) ? stripcslashes($options['shortcode']) : '[gallery]';
?>
<div class="wrap">   
    <?php screen_icon(); ?>
    <h2><?php echo esc_html( $title ); ?></h2>
    <div style="height:30px;"></div>

    <form name="validate_links" id="validate_links" method="post" action="" class="">
        <?php wp_nonce_field('shiba_media_options'); ?> 

        <div style="clear:both; width:590px;">
		<div class="shiba-field">
			<h3>Customize Gallery Page</h3>
			<input style="width:100%;"  type="text" name="shortcode" value='<?php echo esc_attr($shortcode);?>'/> 
           <small><p>Customize the default gallery object page. Uses <a href="http://codex.wordpress.org/Gallery_Shortcode" target="_blank">WordPress gallery shortcode syntax</a>.</p></small>
		</div>
 		<p><input type="checkbox" name="show_description" <?php if (isset($options['show_description'])) echo 'checked';?>/>  Show Gallery Description</p>
       
        <input type="submit" class="button" name="save_options" value="<?php esc_attr_e('Save Options'); ?>" />
<!--        <input type="submit" class="button" name="clear_cache" value="<?php esc_attr_e('Clear Cache'); ?>" /> -->

    </form>
    <div style="height:50px;clear:both;"></div>
	
</div>



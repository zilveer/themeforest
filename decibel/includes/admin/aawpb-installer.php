<?php

function wolf_wpb_get_plugins( $plugin )
{
	$args = array(
		'path' => ABSPATH . 'wp-content/plugins/',
		'preserve_zip' => false
	);

	if ( ! is_dir( ABSPATH.'wp-content/plugins/' . $plugin['name'] ) ) {
		wolf_wpb_plugin_download( $plugin['path'], $args['path'].$plugin['name'].'.zip');
		wolf_wpb_plugin_unpack( $args, $args['path'].$plugin['name'].'.zip');
	}

	wolf_wpb_plugin_activate( $plugin['install'] );
}
function wolf_wpb_plugin_download( $url, $path ) 
{

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	if(file_put_contents($path, $data))
		return true;
	else
		return false;
}
function wolf_wpb_plugin_unpack($args, $target)
{
	$zip = new ZipArchive;
	$res = $zip->open($target );
	if ($res === TRUE) {
		$zip->extractTo($args['path']);
		$zip->close();
		unlink( $target );
		echo 'woot!';
	} else {
		echo 'doh!';
       	 }
}
function wolf_wpb_plugin_activate( $installer )
{
    $current = get_option('active_plugins');
    $plugin = plugin_basename( trim( $installer ) );

    if(!in_array($plugin, $current))
    {
            $current[] = $plugin;
            sort($current);
            do_action('activate_plugin', trim($plugin));
            update_option('active_plugins', $current);
            do_action('activate_'.trim($plugin));
            do_action('activated_plugin', trim($plugin));
            return true;
    }
    else
            return false;
}
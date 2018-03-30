<?php


















namespace Drone;



if (defined('\Drone\VERSION')) {
	return \Drone\VERSION;
}








const VERSION = '5.6.7';






const DIRECTORY = 'drone';














function apply_filters($tag, $value)
{
	$args = array_slice(func_get_args(), 2);
	$value = call_user_func_array('\apply_filters', array_merge(array('drone_'.$tag, $value), $args));
	$value = call_user_func_array('\apply_filters', array_merge(array(Theme::getInstance()->base_theme->id_.'_'.$tag, $value), $args));
	return $value;
}












function do_action($tag)
{
	$args = array_slice(func_get_args(), 1);
	call_user_func_array('\do_action', array_merge(array('drone_'.$tag), $args));
	call_user_func_array('\do_action', array_merge(array(Theme::getInstance()->base_theme->id_.'_'.$tag), $args));
}



$drone_dir = get_template_directory().'/'.DIRECTORY;
require $drone_dir.'/func.php';
require $drone_dir.'/html.php';
require $drone_dir.'/options.php';
require $drone_dir.'/shortcodes.php';
require $drone_dir.'/theme.php';
require $drone_dir.'/widgets.php';



return \Drone\VERSION;
<?php
global $zorka_data;
//$zorka_data['header-layout'] = 7;
$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
	$header_layout =  $zorka_data['header-layout'];
}
?>
<?php get_template_part('templates/header/header',$header_layout ); ?>
<?php get_template_part('templates/header/search'); ?>
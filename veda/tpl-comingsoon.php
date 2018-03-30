<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php veda_viewport(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>
<?php
$type = veda_opts_get('comingsoon-style', 'type1');

$bg = veda_option('pageoptions','comingsoon-bg');
$opacity = veda_opts_get('comingsoon-bg-opacity', '1');
$position = veda_opts_get('comingsoon-bg-position', 'center center');
$repeat = veda_opts_get('comingsoon-bg-repeat', 'no-repeat');
$color = veda_option('pageoptions','comingsoon-bg-color');
$showcolor = veda_option('pageoptions','show-comingsoon-bg-color');

$estyle = veda_option('pageoptions','comingsoon-bg-style');

$color = !empty($color) ? veda_hex2rgb($color) : array('f', 'f', 'f');
$style = !empty($bg) ? "background:url($bg) $position $repeat;" : '';
$style .= (!empty($color) && isset($showcolor) ) ? "background-color:rgba(  $color[0],  $color[1],  $color[2], {$opacity});" : '';
$style .= !empty($estyle) ? $estyle : ''; ?>

<body <?php body_class('under-construction'.' '.$type); ?> style="<?php echo esc_attr($style); ?>">

<div class="wrapper"><?php
	$pageid = veda_option('pageoptions','comingsoon-pageid');
	if( !empty($pageid) ):
		$page = get_post( $pageid, ARRAY_A );
		echo DTCoreShortcodesDefination::dtShortcodeHelper ( stripslashes($page['post_content']) );
	endif; ?>
</div>
</body>
<?php wp_footer(); ?>
</html>
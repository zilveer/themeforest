<?php 

$link_after = $link_before = '';

if ($view_params['permalink_icon'] == 'true') {
	$link_before = '<a target="' . $view_params['target'] . '" href="' . mk_get_super_link(get_post_meta(get_the_ID(), '_portfolio_permalink', true)) . '">';
	$link_after = '</a>';
}
?>
<h3 class="the-title"><?php echo $link_before; the_title(); echo $link_after; ?></h3><div class="clearboth"></div>
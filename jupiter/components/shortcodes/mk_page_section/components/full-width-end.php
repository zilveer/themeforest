<?php

$post_id = global_get_post_id();
$layout = get_post_meta($post_id, '_layout', true);
$layout = !empty($layout) ? $layout : 'full';
if (isset($_REQUEST['layout']) && !empty($_REQUEST['layout'])) {
    $layout = esc_html($_REQUEST['layout']);
}
$padding = get_post_meta($post_id, '_padding', true );
$padding = 
$padding = !empty($padding) ? (($padding == 'true') ? 'no-padding' : '') : 'no-padding';

?>
<div class="mk-main-wrapper-holder">
	<div class="theme-page-wrapper <?php echo $padding; ?> <?php echo $layout; ?>-layout mk-grid vc_row-fluid">
		<div class="theme-content <?php echo $padding; ?>">

			<?php
			/* Fixes page section for blog single post */
			if(is_singular('post')) { ?>
			    <div class="single-content">
			<?php }
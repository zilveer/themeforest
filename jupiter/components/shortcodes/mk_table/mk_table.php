<?php
$path = pathinfo(__FILE__) ['dirname'];
include ($path . '/config.php');
?>

<div class="mk-fancy-table table-<?php echo $style; ?> <?php echo $el_class; ?> <?php echo $visibility; ?>">

	<?php mk_get_view('global', 'shortcode-heading', false, ['title' => $title]); ?>

	<?php echo wpb_js_remove_wpautop( $content ); ?>

</div>

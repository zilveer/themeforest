<?php
/**
 * Messages
 */
if ( ! $messages ) return;
?>

<?php foreach ( $messages as $message ) : ?>
	<div class="msg notice"><p><?php echo $message; ?></p></div>
<?php endforeach; ?>

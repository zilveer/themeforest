<?php
/**
 * Error messages
 */
if ( ! $errors ) return;
?>
<ul class="msg fail">
	<?php foreach ( $errors as $error ) : ?>
		<li><?php echo $error; ?></li>
	<?php endforeach; ?>
</ul>
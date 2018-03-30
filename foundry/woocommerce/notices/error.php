<?php
	/**
	 * @package Foundry
	 * @author TommusRhodus
	 * @version 3.0.0
	 */
	if ( ! $messages ){
		return;
	}
?>

<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <?php foreach ( $messages as $message ) : ?>
    	<li><?php echo wp_kses_post( $message ); ?></li>
    <?php endforeach; ?>
</div>
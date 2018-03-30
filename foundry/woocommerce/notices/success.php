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

<?php foreach ( $messages as $message ) : ?>
	<div class="alert alert-success alert-dismissible" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	    </button>
	    <?php echo wp_kses_post( $message ); ?>
	</div>
<?php endforeach; ?>

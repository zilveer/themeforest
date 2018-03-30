<?php $t =& peTheme(); ?>
<?php list($data,$bid) = $t->template->data(); ?>

<?php $boxed = ( 'yes' === $data->boxed ) ? true : false; ?>

<?php if ( $boxed ) : ?>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">

<?php endif; ?>

<?php if ( ! empty( $data->slider ) && function_exists( 'putRevSlider' ) ) : ?>

	<?php putRevSlider( $data->slider ); ?>

<?php endif; ?>

<?php if ( $boxed ) : ?>

			</div>
		</div>
	</div>

<?php endif; ?>
<?php defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call ?>

<div class="mental_meta_control">
	<p>
		<?php $mb->the_field( 'double_size' ); ?>
		<label>
			<input type="checkbox" name="<?php $metabox->the_name(); ?>"
			       value="1"<?php if ( $metabox->get_the_value() ) { echo ' checked="checked"'; } ?>>
			<?php _e( 'Double size item <span>(for nomral gallery style only)</span>', 'mental' ) ?>
		</label>
	</p>
</div>

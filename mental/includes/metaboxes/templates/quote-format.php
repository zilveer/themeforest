<?php defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call ?>

<div class="mental_meta_control">
	<p>
		<?php $mb->the_field( 'author' ); ?>
		<label><?php _e( 'Author Name <span>(optional)', 'mental' ) ?></span></label>
		<input type="text" class="widefat" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
		<span><?php _e( 'Enter Author name for current quote', 'mental' ) ?></span>
	</p>
</div>

<!-- Show metabox only for quote format-->
<script type="text/javascript">
	jQuery(document).ready(function(){
		metabox_format_switcher('quote', '#quote_format_metabox');
	});
</script>
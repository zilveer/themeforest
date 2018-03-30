<script type="text/html" data-tpl="block_create">
	<div class="thb-block" data-data="{{ data }}" data-type="{{ type }}">
		<a href="#" class="thb-small-btn thb-block-clone tt" title="<?php _e( 'Clone', 'thb_text_domain' ); ?>">$</a>
		<a href="#" class="thb-small-btn thb-block-edit tt" title="<?php _e( 'Edit', 'thb_text_domain' ); ?>">$</a>
		<a href="#" class="thb-small-btn thb-block-remove">&times;</a>

		<div class="thb-block-description">
			<span>{{ title.replace(/(<([^>]+)>)/ig,"") }}</span>

			<# if ( nicetype && nicetype != '' ) { #>
				<em>{{ nicetype.replace(/(<([^>]+)>)/ig,"") }}</em>
			<# } #>
		</div>
	</div>
</script>
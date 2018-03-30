<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$client_name = get_post_meta(get_the_ID(), 'folio_client_name', true);

	if (!empty($client_name)) { ?>
	<div class="folio-info-field">
		<div class="folio-client">
			<div class="entry-title"><?php _e('Client:', 'dfd'); ?> <span><?php echo $client_name; ?></span></div>
		</div>
	</div>
	<?php }
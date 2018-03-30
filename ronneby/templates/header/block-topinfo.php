<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
if (isset($dfd_ronneby['top_adress_field']) && $dfd_ronneby['top_adress_field']): ?>
	<div class="top-info"><?php echo $dfd_ronneby['top_adress_field']; ?></div>
<?php endif;

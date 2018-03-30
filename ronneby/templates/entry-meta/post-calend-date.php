<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="calend_date">
	<div class="calend_date__day">
		<?php echo get_the_date('d'); ?>
	</div>
	<div class="calend_date__month">
		<?php echo get_the_date('M, Y'); ?>
	</div>
</div>
<form class="wcv-form" method="post">
	<p>
		<label for="from"><?php _e( 'From:', 'flatastic' ); ?></label>
		<input class="date-pick" type="date" name="start_date" id="from"
			   value="<?php echo esc_attr( date( 'Y-m-d', $start_date ) ); ?>"/>

		<label for="to"><?php _e( 'To:', 'flatastic' ); ?></label>
		<input type="date" class="date-pick" name="end_date" id="to"
			   value="<?php echo esc_attr( date( 'Y-m-d', $end_date ) ); ?>"/>

		<input type="submit" class="button" style="float:none;"
			   value="<?php _e( 'Show', 'flatastic' ); ?>"/>
	</p>
</form>
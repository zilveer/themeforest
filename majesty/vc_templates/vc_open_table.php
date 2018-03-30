<?php
/**
 * Shortcode attributes
 * @var $restaurantid
 * @var $partysize
 * @var $time
 * @var $el_class
 */

$output = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
if( empty( $restaurantid )) {
	return;
}

wp_enqueue_script('datetimepicker');
?>
<div class="open-table-widget">
<form method="get" class="otw-widget-form used-datepicker" action="http://www.opentable.com/restaurant-search.aspx" target="_blank">
	
		<div class="col-md-4 col-sm-4 col-sx-12 datepicker">
			<label for="rtb-date"><?php esc_html_e('DATE', 'theme-majesty'); ?></label>
			<input type="text" class="form-control" name="startDate" id="datetimepicker" placeholder="<?php esc_html_e('Date', 'theme-majesty'); ?>" autocomplete="off">
			<i class="fa fa-calendar"></i>
		</div>
		<div class="col-md-4 col-sm-4 col-sx-12">
			<label for="rtb-time"><?php esc_html_e('TIME', 'theme-majesty'); ?></label>
			<div class="select_wrap">
				<select id="time-open-table" name="ResTime" class="form-control">
					<?php
						$times = explode( ',', $time );
						$default = '8:00 AM';
						foreach ( $times as $hour ) {
							$hour = esc_attr($hour);
							echo "<option value=\"$hour\" " . ( ( $hour == $default ) ? ' selected="selected" ' : "" ) . ">$hour</option>" . PHP_EOL;
						}
					?>
				</select>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-sx-12">
			<label for="rtb-party"><?php esc_html_e('Party', 'theme-majesty'); ?></label>
			<div class="select_wrap">
				<select id="party-open-table" name="partySize" class="form-control">
					<?php
						$partysize = absint( $partysize );
						$default_size = 4;
						if( absint( $partysize ) && $partysize > 1 && $partysize <= 20 ) {
							
						} else {
							$partysize = 20;
						}
						for ($x = 1; $x <= $partysize; $x++) {
							$selected_html = '';
							if( $x == $default_size ) {
								$selected_html = ' selected="selected"';
							}
							echo '<option value="'. absint($x) .'"'. $selected_html .'>'. absint($x) .'</option>';
						} 
					?>
				</select>
			</div>
		</div>
		<div class="col-md-12 text-center">
			<input type="submit" value="<?php esc_html_e( 'Find a Table', 'theme-majesty' ); ?>" />
		</div>
		<input type="hidden" name="RestaurantID" class="RestaurantID" value="<?php echo esc_attr($restaurantid); ?>">
		<input type="hidden" name="rid" class="rid" value="<?php echo esc_attr($restaurantid); ?>">
		<input type="hidden" name="GeoID" class="GeoID" value="15">
		<input type="hidden" name="txtDateFormat" class="txtDateFormat" value="MM/dd/yyyy">
		<input type="hidden" name="RestaurantReferralID" class="RestaurantReferralID" value="<?php echo esc_attr($restaurantid); ?>">
	
</form>
</div>
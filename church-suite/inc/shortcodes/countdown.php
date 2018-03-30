<?php
include_once(ABSPATH.'wp-admin/includes/plugin.php');
if ( is_plugin_active('the-events-calendar/the-events-calendar.php') ) {
function webnus_countdown( $attributes, $content = null ) {
	extract(shortcode_atts(array(
	'type'=>'modern',
	'details'=>'',
		), $attributes));
	ob_start();
	$events = tribe_get_events(array('posts_per_page'=>1, 'eventDisplay'=>'list' ) );
	foreach($events as $event){
	current_time(get_option('timezone_string'));
	$data_until = strtotime(tribe_get_start_date($event,false,'d.m.Y H:i'));
	$data_future = tribe_get_start_date($event,false,'Y/m/d H:i');
	}
	$label = array(
		'day' => esc_html__('Days', 'webnus_framework'),
		'hours' => esc_html__('Hours', 'webnus_framework'),
		'minutes' => esc_html__('Minutes', 'webnus_framework'),
		'seconds' => esc_html__('Seconds', 'webnus_framework')
	);
	$display = (($type == 'modern') OR (($type == 'minimal') && $details))?'full':'';
	?>
	<div class="container countdown-wrapper">
		<?php if($events){
			if ($type=='modern'){?>
				<div class="col-md-6 col-sm-12 countdown-clock" data-future="<?php echo $data_future; ?>" data-done="<?php esc_attr_e( 'EVENT IS LIVE NOW', 'webnus_framework' ) ?>">
				</div>
			<?php }else{ ?>
				<?php if ($display=='full'){
					echo'<div class="col-md-6 col-sm-12">';
				}
				?>
				<div class="countdown-w <?php echo ($type=='minimal')?'cd-minimal':''; ?>" data-until="<?php echo $data_until ?>" data-done="<?php esc_attr_e( 'EVENT IS LIVE NOW', 'webnus_framework' ) ?>" data-respond>
				<?php if (empty($display)){?>
					<h3 class="countdown-message"><?php esc_attr_e( 'NEXT UPCOMING EVENT', 'webnus_framework' ) ?></h3>
				<?php } ?>
					<div class="days-w block-w"><div class="count-w"></div><div class="label-w"><?php echo $label['day'] ?></div></div><div class="div-d">:</div>
					<div class="hours-w block-w"><div class="count-w"></div><div class="label-w"><?php echo $label['hours'] ?></div></div><div class="div-d">:</div>
					<div class="minutes-w block-w"><div class="count-w"></div><div class="label-w"><?php echo $label['minutes'] ?></div></div><div class="div-d">:</div>
					<div class="seconds-w block-w"><div class="count-w"></div><div class="label-w"><?php echo $label['seconds'] ?></div></div>
				</div>
				<?php if ($display=='full'){
					echo '</div>';
				}
			}
		if($display=='full'){ ?>
			<div class="col-md-4 col-sm-7">
				<h5 class="countdown-message"><?php esc_attr_e( 'NEXT UPCOMING EVENT', 'webnus_framework' ) ?></h5>
				<p><?php echo $event->post_title ?></p>
			</div>
			<div class="col-md-2 col-sm-5 btn-wrapper">
				<a class="button black medium" href= "<?php tribe_event_link($event) ?>"><?php esc_attr_e( 'EVENT DETAIL', 'webnus_framework' ) ?></a>
			</div>
		<?php }
		} else { ?>
			<div class="col-md-12 col-sm-12">
				<h3 class="countdown-message btn-wrapper"><?php esc_attr_e( 'THERE IS NO UPCOMING EVENT NOW!', 'webnus_framework' ) ?></h3>
			</div>
		<?php } ?>
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	wp_reset_postdata();
	return $out;
}
add_shortcode('countdown', 'webnus_countdown');
}
?>
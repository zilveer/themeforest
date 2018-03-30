<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

$show_map           = get_field('show_map');
$map_coordinates    = get_field('map_coordinates');

if($show_map)
{
	global $wp_scripts;
	
	wp_enqueue_script('google-maps');
	
	// Set Icon Sizes
	if ( ! is_array( $map_coordinates ) ) {
		$map_coordinates = array();
	}
	
	foreach ( $map_coordinates as $i => $pin ) {

		if ( $pin['pin_image'] ) {
			$image_size = @getimagesize( str_replace( site_url( '/' ), '', $pin['pin_image'] ) );
			
			if ( is_array( $image_size ) && count( $image_size ) >= 2 ) {
				$map_coordinates[ $i ]['size'] = array( $image_size[0], $image_size[1] );
			}
		}
	}

	?>
	<script>
		var mapChords = <?php echo json_encode($map_coordinates); ?>;
	</script>
	<div id="map"></div>
	<?php
}

$form_position 			= get_field('form_position');

$form_title             = get_field('form_title');
$form_sub_title         = get_field('form_sub_title');

$required_fields		= get_field('required_fields');
$submit_button_text     = get_field('submit_button_text');
$success_message        = get_field('success_message');

if( ! is_array($required_fields))
	$required_fields = array();

$is_required_name		= in_array('name', $required_fields);
$is_required_subject	= in_array('subject', $required_fields);
$is_required_email		= in_array('email', $required_fields);
$is_required_message	= in_array('message', $required_fields);

$address_title          = get_field('address_title');
$address_sub_title      = get_field('address_sub_title');
$address_description    = get_field('address_description');

?>
<form id="contact-form" method="post" enctype="application/x-www-form-urlencoded" action="" novalidate="">

	<input type="hidden" name="id" value="<?php the_id(); ?>" />

	<div class="container contact-page">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-6<?php echo $form_position == 'right' ? ' pull-right-md' : ''; ?>">
				<div class="page-title">
					<h3>
						<?php echo $form_title; ?>
						<small><?php echo $form_sub_title; ?></small>
					</h3>
				</div>

				<div class="form-success-message hidden">
					<div class="alert alert-success" role="alert"><?php echo $success_message; ?></div>
				</div>

				<div class="contact-form">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<input type="text" name="name" placeholder="<?php _e('Name', 'aurum'); echo $is_required_name ? ' *' : ''; ?>" class="form-control<?php echo $is_required_name ? ' required' : ''; ?>">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<input type="text" name="subject" placeholder="<?php _e('Subject', 'aurum'); echo $is_required_subject ? ' *' : ''; ?>" class="form-control<?php echo $is_required_subject ? ' required' : ''; ?>">
							</div>

						</div>
					</div>

					<div class="form-group">
						<input type="email" name="email" placeholder="<?php _e('E-mail', 'aurum'); echo $is_required_email ? ' *' : ''; ?>" class="form-control<?php echo $is_required_email ? ' required' : ''; ?>">
					</div>

					<div class="form-group">
						<textarea name="message" placeholder="<?php _e('Message', 'aurum'); echo $is_required_message ? ' *' : ''; ?>" class="form-control<?php echo $is_required_message ? ' required' : ''; ?>" rows="5"></textarea>
					</div>

					<button type="submit" class="btn btn-primary send-message pull-right"><?php echo $submit_button_text; ?></button>
				</div>
			</div>
			<div class="col-lg-5 col-md-5 col-sm-6 contact-information">
				<div class="page-title">
					<h3>
						<?php echo $address_title; ?>
						<small><?php echo $address_sub_title; ?></small>
					</h3>
				</div>

				<?php echo $address_description; ?>

			</div>
		</div>
	</div>
</form>
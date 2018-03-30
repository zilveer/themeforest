<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct access allowed' );
}
/*
  Template Name: User Profile
 */


if ( ! is_user_logged_in() ) {
	$redirect_to = get_permalink( TMM::get_option( 'user_login_page', TMM_APP_CARDEALER_PREFIX ) );
	if ( TMM::get_option( 'user_profile_page', TMM_APP_CARDEALER_PREFIX ) ) {
		$redirect_to .= '?redirect=' . urlencode( get_permalink( TMM::get_option( 'user_profile_page', TMM_APP_CARDEALER_PREFIX ) ) );
	}
	wp_redirect( $redirect_to, 302 );

	return;
}

wp_enqueue_script( 'app_carsealer_user_profiles', TMM_Ext_Car_Dealer::get_application_uri() . '/js/user_profile.min.js', array(
		'jquery',
		'jquery-ui-sortable'
	) );
wp_enqueue_script( 'tmm_theme_map_api_js', 'https://maps.googleapis.com/maps/api/js?sensor=false' );

get_header();
$profileuser = wp_get_current_user();
?>

<?php if ( is_user_logged_in() ): ?>

	<form id="user_data" name="user_data" method="post">

	<div class="form-account">

	<div class="form-heading">
		<h3><?php _e( 'Edit Your Profile', 'cardealer' ); ?></h3>
	</div>
	<!--/ .form-heading-->

	<div class="form-entry clearfix">


	<div class="form-title">
		<h5><?php _e( 'Personal Data', 'cardealer' ); ?></h5>
	</div>
	<!--/ .form-title-->

	<div class="section-options clearfix">

		<div class="row">
			<div class="col-xs-12 col-md-8">

				<div class="row">
					<div class="col-xs-6">

						<!-- First and Last Name -->
						<div class="row">
							<div class="col-xs-6">

								<p>
									<label for="first_name"><strong><?php _e( 'First Name', 'cardealer' ); ?></strong></label>
									<input id="first_name" name="first_name" type="text" value="<?php echo $profileuser->first_name ?>"/>
								</p>

							</div>
							<div class="col-xs-6">

								<p>
									<label for="last_name"><strong><?php _e( 'Last Name', 'cardealer' ); ?></strong></label>
									<input id="last_name" name="last_name" type="text" value="<?php echo $profileuser->last_name ?>"/>
								</p>

							</div>
						</div>

						<div class="row">
							<div class="col-xs-6">

								<!-- Username -->
								<p>
									<label for="user_login"><strong><?php _e( 'Username', 'cardealer' ); ?>
											<small>(<?php _e( 'cant be changed', 'cardealer' ); ?>)</small></strong></label>
									<input id="user_login" disabled="" type="text"
									       value="<?php echo( esc_attr( $profileuser->user_login ) ); ?>"/>
								</p>

							</div>
							<div class="col-xs-6">

								<!-- Nickname or Company Name -->
								<p>
									<label for="nickname"><strong><?php _e( 'Company Name', 'cardealer' ); ?></strong></label>
									<input id="nickname" name="nickname" type="text" value="<?php echo $profileuser->nickname ?>"/>
								</p>

							</div>
						</div>

					</div>
					<div class="col-xs-6">

							<p class="type">
								<label for="password1"><strong><?php _e( 'New Password', 'cardealer' ); ?> <small><?php _e( 'Leave blank if you do not want to change it.', 'cardealer' ); ?></small></strong></label>
								<input id="password1" type="password" name="password1"/>
							</p>

							<p class="type">
								<label for="password2"><strong><?php _e( 'Retype Your New Password', 'cardealer' ); ?></strong></label>
								<input id="password2" type="password" name="password2"/>
							</p>

					</div>
				</div>

				<!-- Company Info -->
				<p>
					<label for="description"><strong><?php _e( 'Company Info', 'cardealer' ); ?></strong></label>
					<textarea id="description" name="description"><?php echo $profileuser->description ?></textarea>
					<i class="description"><?php _e( 'Share a little biographical information to fill out your profile. This may be shown publicly.', 'cardealer' ); ?></i>
				</p>

			</div>
			<div class="col-xs-6 col-md-4">

				<!-- Display Name publicly as -->
				<p>
					<label
						for="display_name"><strong><?php _e( 'Display name publicly as', 'cardealer' ); ?></strong></label>
					<select id="display_name" name="display_name">
						<?php
						$public_display                     = array();
						$public_display['display_nickname'] = $profileuser->nickname;
						$public_display['display_username'] = $profileuser->user_login;

						if ( ! empty( $profileuser->first_name ) ) {
							$public_display['display_firstname'] = $profileuser->first_name;
						}

						if ( ! empty( $profileuser->last_name ) ) {
							$public_display['display_lastname'] = $profileuser->last_name;
						}

						if ( ! empty( $profileuser->first_name ) && ! empty( $profileuser->last_name ) ) {
							$public_display['display_firstlast'] = $profileuser->first_name . ' ' . $profileuser->last_name;
							$public_display['display_lastfirst'] = $profileuser->last_name . ' ' . $profileuser->first_name;
						}

						if ( ! in_array( $profileuser->display_name, $public_display ) ) // Only add this if it isn't duplicated elsewhere
						{
							$public_display = array( 'display_displayname' => $profileuser->display_name ) + $public_display;
						}

						$public_display = array_map( 'trim', $public_display );
						$public_display = array_unique( $public_display );

						foreach ( $public_display as $id => $item ) {
							?>
							<option <?php selected( $profileuser->display_name, $item ); ?>><?php echo $item; ?></option>
						<?php
						}
						?>
					</select>
				</p>

				<!-- Edit Logo -->
				<label for="display_name"><strong><?php _e( 'Edit Company Logo', 'cardealer' ); ?></strong></label>

				<?php
				TMM_Car_Image::get_cardealer_logo_upload_template();
				?>

			</div>
		</div>

	</div>
	<!--/ .section-options-->

	<div class="form-title">
		<h5><?php _e( 'Contact Info', 'cardealer' ); ?></h5>
	</div>
	<!--/ .form-title-->

	<div class="section-options clearfix">

		<div class="row">
			<div class="col-xs-6 col-md-4">

				<!-- Contacts -->
				<p>
					<label for="phone"><strong><?php _e( 'Work Phone', 'cardealer' ); ?></strong></label>
					<input id="phone" name="phone" type="text" value="<?php echo $profileuser->phone ?>"/>
				</p>

				<p>
					<label for="mobile"><strong><?php _e( 'Cell Phone', 'cardealer' ); ?></strong></label>
					<input id="mobile" name="mobile" type="text" value="<?php echo $profileuser->mobile ?>"/>
				</p>

				<p>
					<label for="fax"><strong><?php _e( 'Fax', 'cardealer' ); ?></strong></label>
					<input id="fax" name="fax" type="text" value="<?php echo $profileuser->fax ?>"/>
				</p>

				<p>
					<label for="user_email"><strong><?php _e( 'E-mail', 'cardealer' ); ?></strong></label>
					<input id="user_email" name="user_email" type="text" value="<?php echo $profileuser->user_email ?>"/>
				</p>

				<p>
					<label for="skype"><strong><?php _e( 'Skype', 'cardealer' ); ?></strong></label>
					<input id="skype" name="skype" type="text" value="<?php echo $profileuser->skype ?>"/>
				</p>

				<p>
					<label for="user_url"><strong><?php _e( 'Company Website', 'cardealer' ); ?></strong></label>
					<input id="user_url" name="user_url" type="text" value="<?php echo $profileuser->user_url ?>"/>
				</p>

				<p>
					<label for="address"><strong><?php _e( 'Address', 'cardealer' ); ?></strong></label>
					<input id="address" name="address" type="text" value="<?php echo $profileuser->address ?>"/>
				</p>

			</div>
			<div class="col-xs-12 col-md-8">

				<div class="row set_location">

					<?php $map_data = TMM_Cardealer_User::get_user_map_data( $profileuser->data->ID ); ?>

					<div class="col-xs-12 col-md-8">

						<!-- Set Location -->
						<p>
							<label for="location_address"><strong><?php _e( 'Set Map Location', 'cardealer' ); ?></strong></label>
							<input type="text" placeholder="12 Street, Los Angeles, CA, 94101"
							       value="<?php echo $map_data['location_address'] ?>" id="location_address"
							       name="location_address"/>

							<a href="#" id="set_location" class="button orange"><?php _e( 'Set Location', 'cardealer' ); ?></a>
						</p>

					</div>
					<div class="col-xs-6 col-md-4">

						<!-- Show Map Checkbox -->
						<p class="feature-check no-label">
							<input type="checkbox" id="optionCheckbox"
							       class="js_option_checkbox" <?php echo( (int) @$map_data['show_map_to_visitors'] ? "checked" : "" ) ?>
							       value="<?php echo (int) $map_data['show_map_to_visitors'] ?>" name="show_map_to_visitors"/>
							<label for="optionCheckbox" class="check"><strong><?php _e( 'Show map to visitors', 'cardealer' ); ?></strong></label>
						</p>

					</div>
				</div>

				<div class="section-options clearfix">

					<!-- Google Map -->
					<div id="google_map" class="google_map" style="width: 100%; height: 326px;"></div>

				</div>
				<!--/ .section-options-->

				<div class="row">
					<div class="col-xs-6 col-md-4">

						<!-- Map Zoom -->
						<p>
							<label for="map_zoom"><strong><?php _e( 'Map Zoom', 'cardealer' ); ?></strong></label>
							<select name="map_zoom" id="map_zoom">
								<?php for ( $i = 1; $i <= 30; $i ++ ): ?>
									<option
										value="<?php echo $i ?>" <?php echo( $map_data['map_zoom'] == $i ? 'selected' : '' ) ?>><?php echo( $i < 10 ? "0" . $i : $i ); ?></option>
								<?php endfor; ?>
							</select>
						</p>

					</div>
					<div class="col-xs-6 col-md-4">

						<!-- Map Latitude -->
						<p>
							<label for="map_latitude">
								<strong><?php _e( 'Map Latitude', 'cardealer' ); ?></strong>
							</label>
							<input type="text" value="<?php echo $map_data['map_latitude'] ?>" id="map_latitude"
							       name="map_latitude"/><br/>
						</p>

					</div>
					<div class="col-xs-6 col-md-4">

						<!-- Map Longitude -->
						<p>
							<label for="map_longitude">
								<strong><?php _e( 'Map Longitude', 'cardealer' ); ?></strong>
							</label>
							<input type="text" value="<?php echo $map_data['map_longitude'] ?>" id="map_longitude"
							       name="map_longitude"/><br/>
						</p>

					</div>
				</div>

			</div>
		</div>

	</div>
	<!--/ .section-options-->

	<div class="form-title">
		<h5><?php _e( 'Email Notifications', 'cardealer' ); ?></h5>
	</div>
	<!--/ .form-title-->

	<div class="section-options clearfix">

		<div class="row">
			<div class="col-xs-6 col-md-4">

				<?php
				$account_emails = tmm_allow_user_email($profileuser->data->ID, 'account_emails');
				$user_posts_emails = tmm_allow_user_email($profileuser->data->ID, 'user_posts_emails');
				?>

				<p class="feature-check no-label">
					<input id="account_emails" name="account_emails" type="checkbox" value="<?php echo $account_emails ?>" <?php checked($account_emails, 1) ?> class="js_option_checkbox" />
					<label for="account_emails" class="check"><strong><?php _e( 'Account changes (upgrading, purchasing featured points)', 'cardealer' ); ?></strong></label>
				</p>

				<p class="feature-check no-label">
					<input id="user_posts_emails" name="user_posts_emails" type="checkbox" value="<?php echo $user_posts_emails ?>" <?php checked($user_posts_emails, 1) ?> class="js_option_checkbox" />
					<label for="user_posts_emails" class="check"><strong><?php _e( 'Creating cars', 'cardealer' ); ?></strong></label>
				</p>

			</div>

		</div>

	</div>
	<!--/ .section-options-->

	<div class="section-options clearfix">

		<div class="clear"></div>

		<p id="update_user_errors" class="error" style="display: none"></p>

		<p id="update_user_success" class="success" style="display: none;">
			<strong><i><?php _e( 'Your Profile Data was updated successfully', 'cardealer' ); ?></i></strong></p>

		<input type="submit" class="button big orange" id="update_user_profile"
		       value="<?php _e( 'Update Profile', 'cardealer' ); ?>">

	</div>
	<!--/ .section-options-->

	</div>
	<!--/ .form-entry-->

	</div>
	<!--/ .form-account-->

	</form>

<?php endif; ?>

<?php get_footer(); ?>


<?php
/*
	Template name: Contact page
*/
?>
<?php
	$error_name  = false;
	$error_email = false;
	$error_msg   = false;

	if(isset($_GET['contact-submit'])) {
		header("Content-type: application/json");
		$name = '';
		$email = '';
		$website = '';
		$message = '';
		$reciever_email = '';
		$return = array();

		if(trim($_GET['contact-name']) === '') {
			$error_name = true;
		} else{
			$name = trim($_GET['contact-name']);
		}

		if(trim($_GET['contact-email']) === '' || !isValidEmail($_GET['contact-email'])) {
			$error_email = true;
		} else{
			$email = trim($_GET['contact-email']);
		}

		if(trim($_GET['contact-msg']) === '') {
			$error_msg = true;
		} else{
			$message = trim($_GET['contact-msg']);
		}

		$website = stripslashes(trim($_GET['contact-website']));

		// Check if we have errors

		if(!$error_name && !$error_email && !$error_msg) {
			// Get the received email
			$reciever_email = etheme_get_option('contacts_email');

			$subject = 'You have been contacted by ' . $name;

			$body = "You have been contacted by $name. Their message is: " . PHP_EOL . PHP_EOL;
			$body .= $message . PHP_EOL . PHP_EOL;
			$body .= "You can contact $name via email at $email";
			if ($website != '') {
				$body .= " and visit their website at $website" . PHP_EOL . PHP_EOL;
			}
			$body .= PHP_EOL . PHP_EOL;

			$headers = "From $email ". PHP_EOL;
			$headers .= "Reply-To: $email". PHP_EOL;
			$headers .= "MIME-Version: 1.0". PHP_EOL;
			$headers .= "Content-type: text/plain; charset=utf-8". PHP_EOL;
			$headers .= "Content-Transfer-Encoding: quoted-printable". PHP_EOL;

			if(wp_mail($reciever_email, $subject, $body, $headers)) {
				$return['status'] = 'success';
				$return['msg'] = __('All is well, your email has been sent.', ETHEME_DOMAIN);
			} else{
				$return['status'] = 'error';
				$return['msg'] = __('Error while sending a message!', ETHEME_DOMAIN);
			}

		}else{
			// Return errors
			$return['status'] = 'error';
			$return['msg'] = __('Please, fill in the required fields!', ETHEME_DOMAIN);
		}

		echo json_encode($return);
		die();
	}

?>

<?php
	get_header();
?>

<?php
	$contact_page = etheme_get_option('contact_page_type');
	$googleMap = etheme_get_option('google_map_enable');
	if(isset($_GET['cont']) && $_GET['cont'] == 2) {
		$contact_page = 'custom';
	}
?>


<?php et_page_heading(); ?>

<div class="container">
	<div class="page-content contact-page-<?php echo $contact_page; ?>">
		<?php if ($contact_page == 'default' && $googleMap): ?>
			<div id="map" class="google-map googlemap-wide">
			    <p>Enable your JavaScript!</p>
			</div>
		<?php endif ?>
		<div class="row-fluid">
			<?php if(have_posts()): while(have_posts()) : the_post(); ?>
				<?php if($contact_page == 'default'): ?>
					<div class="span12">
						<div class="row-fluid">
							<div class="span7">
								<h3 class="contact-form-title"><?php _e('Contact Form', ETHEME_DOMAIN) ?></h3>
								<div id="contactsMsgs"></div>
								<form action="<?php the_permalink(); ?>" method="post" id="contact-form">

										<div class="row-fluid">

											<div class="span6">
												<p class="form-name">
													<label for="name"><?php _e('Name and Surname', ETHEME_DOMAIN) ?> <span class="required">*</span></label>
													<input type="text" name="contact-name" class="required-field" id="contact-name">
												</p>
											</div>
											<div class="span6">
												<p class="form-name">
													<label for="name"><?php _e('Email', ETHEME_DOMAIN) ?> <span class="required">*</span></label>
													<input type="text" name="contact-email" class="required-field" id="contact-email">
												</p>
											</div>

										</div>

										<p class="form-name hidden">
											<label for="name"><?php _e('Website', ETHEME_DOMAIN) ?></label>
											<input type="text" name="contact-website" id="contact-website">
										</p>

										<p class="form-textarea">
											<label for="contact_msg"><?php _e('Message', ETHEME_DOMAIN); ?> <span class="required">*</span></label>
											<textarea name="contact-msg" id="contact-msg" class="required-field" cols="30" rows="7"></textarea>
										</p>

										<?php
											$captcha_instance = new ReallySimpleCaptcha();
											$activeColor = (etheme_get_option('activecol')) ? etheme_get_option('activecol') : '#d7a200';
											$captcha_instance->bg = $rgb = hex2rgb($activeColor);
											$word = $captcha_instance->generate_random_word();
											$prefix = mt_rand();
											$img_name = $captcha_instance->generate_image( $prefix, $word );
											$captcha_img = ETHEME_CODE_URL.'/inc/really-simple-captcha/tmp/'.$img_name;
										?>

										<div class="captcha-block">
											<img src="<?php echo $captcha_img; ?>">
											<input type="text" name="captcha-word" class="captcha-input">
											<input type="hidden" name="captcha-prefix" value="<?php echo $prefix; ?>">
										</div>

										<p class="a-right">
											<input type="hidden" name="contact-submit" id="contact-submit" value="true" >
											<span class="spinner"><?php _e('Sending...', ETHEME_DOMAIN) ?></span>
											<button class="button" id="submit" type="submit"><?php _e('Send message', ETHEME_DOMAIN) ?></button>
										</p>
									<div class="clear"></div>
								</form>
							</div>
							<div class="span5">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
					<?php if ($googleMap): ?>
						<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
						<script type="text/javascript">

						    function etheme_google_map() {
						        var styles = {};

						        var myLatlng = new google.maps.LatLng(<?php etheme_option('google_map') ?>);
						        var myOptions = {
						            zoom: 17,
						            center: myLatlng,
						            mapTypeId: google.maps.MapTypeId.ROADMAP,
						            disableDefaultUI: true,
						            mapTypeId: '8theme',
						            draggable: true,
						            zoomControl: true,
									panControl: false,
									mapTypeControl: true,
									scaleControl: true,
									streetViewControl: true,
									overviewMapControl: true,
						            scrollwheel: false,
						            disableDoubleClickZoom: false
						        }
						        var map = new google.maps.Map(document.getElementById("map"), myOptions);
						        var styledMapType = new google.maps.StyledMapType(styles['8theme'], {name: '8theme'});
						        map.mapTypes.set('8theme', styledMapType);

						        var marker = new google.maps.Marker({
						            position: myLatlng,
						            map: map,
						            title:""
						        });
						    }

						    jQuery(document).ready(function(){
							    etheme_google_map();
						    });

						    jQuery(document).resize(function(){
							    etheme_google_map();
						    });
						</script>
					<?php endif ?>
				<?php else: ?>
					<div class="span8">
						<?php the_content(); ?>
					</div>
					<div class="span4">
						<h3 class="contact-form-title"><?php _e('Contact Form', ETHEME_DOMAIN) ?></h3>
						<div id="contactsMsgs"></div>
						<form action="<?php the_permalink(); ?>" method="post" id="contact-form">
							<p class="form-name">
								<label for="name"><?php _e('Name and Surname', ETHEME_DOMAIN) ?> <span class="required">*</span></label>
								<input type="text" name="contact-name" class="required-field" id="contact-name">
							</p>

							<p class="form-name">
								<label for="name"><?php _e('Email', ETHEME_DOMAIN) ?> <span class="required">*</span></label>
								<input type="text" name="contact-email" class="required-field" id="contact-email">
							</p>

							<p class="form-name">
								<label for="name"><?php _e('Website', ETHEME_DOMAIN) ?></label>
								<input type="text" name="contact-website" id="contact-website">
							</p>
							<p class="form-textarea">
								<label for="contact_msg"><?php _e('Message', ETHEME_DOMAIN); ?> <span class="required">*</span></label>
								<textarea name="contact-msg" id="contact-msg" class="required-field" cols="30" rows="7"></textarea>
							</p>
							<?php
								$captcha_instance = new ReallySimpleCaptcha();
								$activeColor = (etheme_get_option('activecol')) ? etheme_get_option('activecol') : '#d7a200';
								$captcha_instance->bg = $rgb = hex2rgb($activeColor);
								$word = $captcha_instance->generate_random_word();
								$prefix = mt_rand();
								$img_name = $captcha_instance->generate_image( $prefix, $word );
								$captcha_img = ETHEME_CODE_URL.'/inc/really-simple-captcha/tmp/'.$img_name;
							?>

							<div class="captcha-block">
								<img src="<?php echo $captcha_img; ?>">
								<input type="text" name="captcha-word" class="captcha-input">
								<input type="hidden" name="captcha-prefix" value="<?php echo $prefix; ?>">
							</div>

							<div class="clear"></div>
							<p class="a-right">
								<input type="hidden" name="contact-submit" id="contact-submit" value="true" >
								<span class="spinner"><?php _e('Sending...', ETHEME_DOMAIN) ?></span>
								<button class="button" id="submit" type="submit"><?php _e('Send message', ETHEME_DOMAIN) ?></button>
							</p>
							<div class="clear"></div>
						</form>
					</div>
				<?php endif; ?>

			<?php endwhile; else: ?>

				<h1><?php _e('No pages were found!', ETHEME_DOMAIN) ?></h1>

			<?php endif; ?>
		</div>

	</div>
</div>


<?php
	get_footer();
?>

<?php

add_action( 'admin_menu', 'us_add_demo_import_page', 40 );

if ( ! function_exists( 'us_add_demo_import_page' ) ) {
	function us_add_demo_import_page() {
		add_submenu_page( 'us-home', 'Grata: Demo Import', 'Demo Import', 'manage_options', 'us-demo-import', 'us_demo_import' );
	}
}

$us_import_config = array(
	'agency' => array(
		'title' => 'Agency Demo',
		'image' => 'demo-import/agency-preview.png',
		'preview_url' => 'http://grata1.us-themes.com/',
		'nav_menu_locations' => array(
			'Grata Main Menu' => 'grata-main-menu',
		),
		'front_page' => 'Grata Home',
		'sliders' => array(
			'demo-import/agency-slider-home.zip',
			'demo-import/agency-slider-portfolio.zip',
		),
	),
	'mobile' => array(
		'title' => 'Mobile App Demo',
		'image' => 'demo-import/mobile-preview.png',
		'preview_url' => 'http://grata2.us-themes.com/',
		'nav_menu_locations' => array(
			'Grata Main Menu' => 'grata-main-menu',
		),
		'front_page' => 'Grata Home',
	),
	'personal' => array(
		'title' => 'Personal Page Demo',
		'image' => 'demo-import/personal-preview.png',
		'preview_url' => 'http://grata3.us-themes.com/',
		'nav_menu_locations' => array(
			'Grata Main Menu' => 'grata-main-menu',
		),
		'front_page' => 'Grata Home',
	),
	'event' => array(
		'title' => 'Event Demo',
		'image' => 'demo-import/event-preview.png',
		'preview_url' => 'http://grata4.us-themes.com/',
		'nav_menu_locations' => array(
			'Grata Main Menu' => 'grata-main-menu',
		),
		'front_page' => 'Grata Home',
	),
	'startup' => array(
		'title' => 'Startup Demo',
		'image' => 'demo-import/startup-preview.png',
		'preview_url' => 'http://grata5.us-themes.com/',
		'nav_menu_locations' => array(
			'Grata Main Menu' => 'grata-main-menu',
		),
		'front_page' => 'Grata Home',
	),
);

if ( ! function_exists( 'us_demo_import' ) ) {
	function us_demo_import() {
		global $us_import_config;
		reset( $us_import_config );
		$default_demo = key( $us_import_config );
		?>
		<div class="w-message content" style="display:none;">
			<img src="<?php echo get_template_directory_uri(); ?>/functions/assets/img/spinner.gif" alt="spinner">

			<h1 class="w-message-title">Importing Demo Content...</h1>

			<p class="w-message-text">Please be patient and do not navigate away from this page while the import is in&nbsp;progress.
				This can take a while if your server is slow (inexpensive hosting).<br>You will be notified via this
				page when the import is completed.</p>
		</div>

		<div class="w-message success" style="display:none;">
			<h1 class="w-message-title">Import completed successfully!</h1>

			<p class="w-message-text">Now you can see the result at <a href="<?php echo site_url(); ?>" target="_blank">your
					site</a><br>or start customize via <a
					href="<?php echo admin_url( 'themes.php?page=optionsframework' ); ?>">Theme Options</a>.
		</div>

		<form class="w-importer demos_5" action="?page=us-demo-import" method="post">

			<h1 class="w-importer-title">Choose the demo which you want to import</h1>

			<div class="w-importer-list">

				<?php foreach ( $us_import_config as $name => $import ): ?>
					<div class="w-importer-item">
						<input class="w-importer-item-radio" id="demo_<?php echo $name; ?>" type="radio"
						       value="<?php echo $name; ?>" name="demo">
						<label class="w-importer-item-preview" for="demo_<?php echo $name; ?>" title="Click to choose this demo">
							<h2 class="w-importer-item-title"><?php echo $import['title']; ?></h2>
							<img src="<?php echo get_template_directory_uri() . '/' . $import['image']; ?>"
							     alt="<?php echo $import['title']; ?>">
						</label>

						<div class="w-importer-item-btn">
							<a class="button" href="<?php echo $import['preview_url']; ?>" target="_blank">Preview</a>
						</div>
					</div>
				<?php endforeach; ?>

			</div>

			<div class="w-importer-options">

				<div class="w-importer-option theme-options">
					<label class="w-importer-option-check">
						<input id="demo_content" type="checkbox" value="ON" name="demo_content" checked="checked">
						<span class="w-importer-option-title">Import Demo Content</span>
					</label>
				</div>
				<div class="w-importer-option theme-options">
					<label class="w-importer-option-check">
						<input id="theme_options" type="checkbox" value="ON" name="theme_options" checked="checked">
						<span class="w-importer-option-title">Import Theme Options</span>
					</label>
				</div>
				<div class="w-importer-option rev-slider">
					<label class="w-importer-option-check">
						<input id="rev_slider" type="checkbox" value="ON"
						       name="rev_slider"<?php if ( ! class_exists( 'RevSlider' ) ) {
							echo ' disabled="disabled"';
						} ?>>
						<span class="w-importer-option-title">Import Revolution Sliders</span>
						<?php
						$sliders_avaliable_for = array();
						foreach ( $us_import_config as $name => $import ) {
							if ( isset( $import['sliders'] ) AND is_array( $import['sliders'] ) AND ! empty ( $import['sliders'] ) ) {
								$sliders_avaliable_for[ $name ] = $import['title'];
							}
						}
						// Sliders are available only for some particular demos, so we notify user about it
						if ( 0 < count( $sliders_avaliable_for ) AND count( $sliders_avaliable_for ) < count( $us_import_config ) ) {
							?><span class="w-importer-option-desc">(available for
							<?php echo implode( ', ', $sliders_avaliable_for ); ?> only)</span><?php
						}
						?>
					</label>
				</div>

				<?php if ( count( $sliders_avaliable_for ) > 0 AND ! class_exists( 'RevSlider' ) ) {
					echo '<div class="w-importer-note"><p><strong>Revolution Slider</strong> plugin is not active. Please activate it if you want Sliders to be imported.</p></div>';
				} ?>

				<div class="w-importer-note">
					<strong>Important Notes:</strong>
					<ol>
						<li>We recommend to run Demo Import on a clean WordPress installation.</li>
						<li>To reset your installation we recommend
							<a href="http://wordpress.org/plugins/wordpress-database-reset/" target="_blank">Wordpress
								Database Reset</a> plugin.
						</li>
						<li>The Demo Import will not import the images we have used in our live demos, due to copyright
							/ license reasons.
						</li>
						<li>Do not run the Demo Import multiple times one after another, it will result in double
							content.
						</li>
					</ol>
				</div>

				<input type="hidden" name="action" value="perform_import">
				<input class="button-primary size_big" type="submit" value="Import" id="import_demo_data">

			</div>

		</form>
		<script>
			jQuery(function($){
				var import_running = false,
					slidersAvailableFor = <?php echo json_encode(array_keys($sliders_avaliable_for)); ?>;
				$('#import_demo_data').click(function(){
					if (import_running) return false;
					$("html, body").animate({
						scrollTop: 0
					}, {
						duration: 300
					});
					var demo = $('input[name=demo]:checked').val() || '<?php echo $default_demo; ?>',
						importQueue = [],
						processQueue = function(){
							if (importQueue.length != 0) {
								// Importing something
								var importAction = importQueue.shift();
								$.ajax({
									type   : 'POST',
									url    : '<?php echo admin_url('admin-ajax.php'); ?>',
									data   : {
										action: importAction,
										demo  : demo
									},
									success: processQueue
								});
							}
							else {
								// Import is completed
								$('.w-message.content, .w-message.options, .w-message.sliders').slideUp();
								$('.w-message.success').slideDown();
								import_running = false;
							}
						};
					if ($('#demo_content').is(':checked')) importQueue.push('us_demo_import_content');
					if ($('#theme_options').is(':checked')) importQueue.push('us_demo_import_options');
					if ($('#rev_slider').is(':checked') && $.inArray(demo, slidersAvailableFor) !== -1) importQueue.push('us_demo_import_sliders');

					if (importQueue.length == 0) return false;

					import_running = true;
					$('.w-importer').slideUp(null, function(){
						$('.w-message.content').slideDown();
					});

					processQueue();

					return false;
				});
			});
		</script>
	<?php
	}

	// Content Import
	function us_demo_import_content() {
		global $us_import_config;

		set_time_limit( 0 );

		if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
			define( 'WP_LOAD_IMPORTERS', TRUE );
		}

		require_once( get_template_directory() . '/vendor/wordpress-importer/wordpress-importer.php' );

		//select which files to import
		$aviable_demos = array_keys( $us_import_config );
		$demo_version = $aviable_demos[0];
		if ( in_array( $_POST['demo'], $aviable_demos ) ) {
			$demo_version = $_POST['demo'];
		}

		$wp_import = new WP_Import();
		$wp_import->fetch_attachments = TRUE;

		ob_start();
		$wp_import->import( get_template_directory() . '/demo-import/' . $demo_version . '-data.xml' );
		ob_end_clean();

		// Set menu
		if ( isset( $us_import_config[ $demo_version ]['nav_menu_locations'] ) ) {
			$locations = get_theme_mod( 'nav_menu_locations' );
			$menus = wp_get_nav_menus();

			if ( ! empty( $menus ) ) {
				foreach ( $menus as $menu ) {
					if ( is_object( $menu ) AND isset( $us_import_config[ $demo_version ]['nav_menu_locations'][ $menu->name ] ) ) {
						$nav_location_key = $us_import_config[ $demo_version ]['nav_menu_locations'][ $menu->name ];
						$locations[ $nav_location_key ] = $menu->term_id;
					}
				}
			}

			set_theme_mod( 'nav_menu_locations', $locations );
		}

		// Set Front Page
		if ( isset( $us_import_config[ $demo_version ]['front_page'] ) ) {
			$front_page = get_page_by_title( $us_import_config[ $demo_version ]['front_page'] );

			if ( isset( $front_page->ID ) ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $front_page->ID );
			}
		}

		echo 'ok';
		die();
	}

	add_action( 'wp_ajax_us_demo_import_content', 'us_demo_import_content' );

	//Import Options
	function us_demo_import_options() {
		global $us_import_config;

		//select which files to import
		$aviable_demos = array_keys( $us_import_config );
		$demo_version = $aviable_demos[0];
		if ( in_array( $_POST['demo'], $aviable_demos ) ) {
			$demo_version = $_POST['demo'];
		}

		$smof_data = unserialize( base64_decode( file_get_contents( get_template_directory() . '/demo-import/' . $demo_version . '-options.txt' ) ) ); //100% safe - ignore theme check nag
		of_save_options( $smof_data );
		us_save_styles( $smof_data );

		echo 'ok';
		die();
	}

	add_action( 'wp_ajax_us_demo_import_options', 'us_demo_import_options' );

	//Import Slider
	function us_demo_import_sliders() {
		global $us_import_config;

		//select which files to import
		$aviable_demos = array_keys( $us_import_config );
		$demo_version = $aviable_demos[0];
		if ( in_array( $_POST['demo'], $aviable_demos ) ) {
			$demo_version = $_POST['demo'];
		}

		if ( ! class_exists( 'RevSlider' ) OR ! isset( $us_import_config[ $demo_version ]['sliders'] ) OR empty( $us_import_config[ $demo_version ]['sliders'] ) ) {
			return FALSE;
		}

		ob_start();
		foreach ( $us_import_config[ $demo_version ]['sliders'] as $slider ) {
			$_FILES["import_file"]["tmp_name"] = get_template_directory() . '/' . $slider;
			$slider = new RevSlider();
			$response = $slider->importSliderFromPost();
			unset( $slider );
		}
		ob_end_clean();

		echo 'ok';
		die();
	}

	add_action( 'wp_ajax_us_demo_import_sliders', 'us_demo_import_sliders' );
}

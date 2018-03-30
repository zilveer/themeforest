	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("Settings", "loc_canon")), esc_attr(__("Help Center", "loc_canon")) ); ?></h2>

		<?php 
			//delete_option('INSPIRE_OPTIONS');
			$INSPIRE_OPTIONS = get_option('INSPIRE_OPTIONS'); 

			//RESET (ONLY IN GENERAL OPTIONS. DELETE FROM REST OF OPTIONS PAGES)
			if ($INSPIRE_OPTIONS['reset_all'] == 'RESET') {
				delete_option('INSPIRE_OPTIONS');
				delete_option('INSPIRE_OPTIONS_hp');
				delete_option('INSPIRE_OPTIONS_post');
				delete_option('INSPIRE_OPTIONS_appearance');
				echo "<script>alert('All theme settings have been reset!'); window.location.reload();</script>";
			}

			var_dump($INSPIRE_OPTIONS);
		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_INSPIRE_OPTIONS'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_INSPIRE_OPTIONS'); ?>		

				<!-- TABS -->		
					<div class="tab_control">
					
						<input type="hidden" id="show_tab" name="INSPIRE_OPTIONS[show_tab]" value="<?php if (isset($INSPIRE_OPTIONS['show_tab'])) {echo esc_attr($INSPIRE_OPTIONS['show_tab']);} else {echo "basic";} ?>">

						<div class="basic settings_tab current_tab" data-tab="basic">
							Basic
						</div>

						<div class="advanced settings_tab" data-tab="advanced">
							Advanced
						</div>

						<div class="all settings_tab last_tab" data-tab="all">
							Show All
						</div>

						<div class="tab_divider">
							<hr>
						</div>

					</div>

					<?php submit_button(); ?>
					
				<!--
				***************************************************

					BASIC SETTINGS 
					
				***************************************************
				-->		
					<div class="basic all tab_section">


					<!-- SLIDER ORDER-->

						<h3>BASIC SETTINGS</h3>

						<table class='form-table'>

						</table>


					</div>

				<!--
				***************************************************

					ADVANCED SETTINGS 

				***************************************************
				-->		
					<div class="advanced all tab_section">

					<!-- SLIDER ORDER-->

						<h3>ADVANCED SETTINGS</h3>

						<table class='form-table'>

						</table>

					</div>

					<?php submit_button(); ?>
					<button id="reset_all_button" name="reset_all_button" class="button-primary">Reset</button>
					<input type="hidden" id="reset_all" name="INSPIRE_OPTIONS[reset_all]" value="">

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>


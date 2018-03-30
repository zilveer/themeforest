	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2>INSPIRE - General Settings</h2>

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
		
		<div class="options_wrapper">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_INSPIRE_OPTIONS'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_INSPIRE_OPTIONS'); ?>		

					<?php submit_button(); ?>

				<!-- SLIDER ORDER-->

					<h3>Slider order</h3>

					<table class='form-table'>

					</table>

					<?php submit_button(); ?>
					<button id="reset_all_button" name="reset_all_button" class="button-primary">Reset</button>
					<input type="hidden" id="reset_all" name="INSPIRE_OPTIONS[reset_all]" value="">

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>


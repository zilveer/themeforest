	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2>INSPIRE - General Settings</h2>

		<?php 
			//delete_option('inspire_options_hooks');
			$inspire_options_hooks = get_option('inspire_options_hooks'); 

			//var_dump($inspire_options_hooks);
		?>

		<br>
		
		<div class="options_wrapper">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_inspire_options_hooks'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_inspire_options_hooks'); ?>		

					<?php submit_button(); ?>

				<!-- USE HOOKS-->

					<h3>Hooks General <img src="<?php echo get_template_directory_uri() . '/images/help.png' ?>"></h3>

					<div class='help'>
						<b>Hooks in general </b> <br>
						<span>
							Hooks can be used to insert content different places on your homepage. <br>
							Write (or copy/paste) your code in the HTML field and then use the CSS field to style your content.
						</span>	
						<br><br>

						<b>Location: </b> <br>
						<span>
							Each section header describes where your content will be displayed.
						</span>	
						<br><br>

						<b>HTML </b> <br>
						<span>
							Write text or HTML here.
						</span>	
						<br><br>

						<b>CSS </b> <br>
						<span>
							Write CSS. Do not include the &lt;style&gt; tags.
						</span>	
						<br><br>

						<b>Disclaimer </b> <br>
						<span>
							Be aware that incorrect HTML code can break your page. Choose unique class/id names to avoid conflicts. <br>
							It is advised you make use of namespaces: instead of class="myclass" use class="mynamespace_myclass".	
						</span>	
						<br><br>

					</div>

					<table class='form-table'>

						<tr valign='top'>
							<td>
								<input class="checkbox" type="checkbox" id="use_hooks" name="inspire_options_hooks[use_hooks]" value="checked" <?php checked(isset($inspire_options_hooks['use_hooks'])) ?>/> Use hooks?
							</td>
						</tr>


					</table>

				<!-- HOOK: ABOVE SLIDER-->

					<h3>Above slider</h3>

					<table class='form-table'>

						<tr valign='top'>
							<td>
								HTML
								<textarea id='hook_html_above_slider' name='inspire_options_hooks[hook_html_above_slider]' rows='15' cols='100'><?php if (isset($inspire_options_hooks['hook_html_above_slider'])) echo htmlentities($inspire_options_hooks['hook_html_above_slider']); ?></textarea>
							</td>
							<td>
								CSS
								<textarea id='hook_css_above_slider' name='inspire_options_hooks[hook_css_above_slider]' rows='15' cols='100'><?php if (isset($inspire_options_hooks['hook_css_above_slider'])) echo $inspire_options_hooks['hook_css_above_slider']; ?></textarea>
							</td>
						</tr>

					</table>

				<!-- HOOK: BELOW SLIDER-->

					<h3>Below slider</h3>

					<table class='form-table'>

						<tr valign='top'>
							<td>
								HTML
								<textarea id='hook_html_below_slider' name='inspire_options_hooks[hook_html_below_slider]' rows='15' cols='100'><?php if (isset($inspire_options_hooks['hook_html_below_slider'])) echo htmlentities($inspire_options_hooks['hook_html_below_slider']); ?></textarea>
							</td>
							<td>
								CSS
								<textarea id='hook_css_below_slider' name='inspire_options_hooks[hook_css_below_slider]' rows='15' cols='100'><?php if (isset($inspire_options_hooks['hook_css_below_slider'])) echo $inspire_options_hooks['hook_css_below_slider']; ?></textarea>
							</td>
						</tr>

					</table>

				<!-- HOOK: BELOW FILTER MENU-->

					<h3>Below filter menu</h3>

					<table class='form-table'>

						<tr valign='top'>
							<td>
								HTML
								<textarea id='hook_html_below_filter_menu' name='inspire_options_hooks[hook_html_below_filter_menu]' rows='15' cols='100'><?php if (isset($inspire_options_hooks['hook_html_below_filter_menu'])) echo htmlentities($inspire_options_hooks['hook_html_below_filter_menu']); ?></textarea>
							</td>
							<td>
								CSS
								<textarea id='hook_css_below_filter_menu' name='inspire_options_hooks[hook_css_below_filter_menu]' rows='15' cols='100'><?php if (isset($inspire_options_hooks['hook_css_below_filter_menu'])) echo $inspire_options_hooks['hook_css_below_filter_menu']; ?></textarea>
							</td>
						</tr>

					</table>

				<!-- HOOK: ABOVE FOOTER-->

					<h3>Above footer</h3>

					<table class='form-table'>

						<tr valign='top'>
							<td>
								HTML
								<textarea id='hook_html_above_footer' name='inspire_options_hooks[hook_html_above_footer]' rows='15' cols='100'><?php if (isset($inspire_options_hooks['hook_html_above_footer'])) echo htmlentities($inspire_options_hooks['hook_html_above_footer']); ?></textarea>
							</td>
							<td>
								CSS
								<textarea id='hook_css_above_footer' name='inspire_options_hooks[hook_css_above_footer]' rows='15' cols='100'><?php if (isset($inspire_options_hooks['hook_css_above_footer'])) echo $inspire_options_hooks['hook_css_above_footer']; ?></textarea>
							</td>
						</tr>

					</table>

					<?php submit_button(); ?>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>


<?php
if ( of_get_option('general_theme_style')=="dark" ) $dark_theme=true;
if (DEMO_STATUS) {
	if ( isset( $_GET['demo_theme_style'] ) ) $_SESSION['demo_theme_style']=$_GET['demo_theme_style'];
	if ( isset($_SESSION['demo_theme_style'] )) $demo_theme_style = $_SESSION['demo_theme_style'];
}
?>
<section>
	<div class="section-wrap clearfix">
		<div class="grid-content-portfolio">
			<h2><?php echo of_get_option('service_title'); ?></h2>
		</div>
		<div class="grid-list-home-columns">
		<?php
		if ( of_get_option('services_section1_status') ) {
		?>
			<ul class="clearfix">
				<li>
					<?php
					if ( of_get_option('service_1_icon') ) {
						echo '<img src="' . of_get_option('service_1_icon') .'" alt="step_icon" />';
					} else {
						if ($dark_theme || ( DEMO_STATUS && $_SESSION['demo_theme_style'] == "dark" )) {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_books_white.png" alt="step_icon" />';
						} else {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_books.png" alt="step_icon" />';
						}
					}
					?>
					<h3>
						<a href="<?php echo of_get_option('service_1_link'); ?>">
							<?php echo of_get_option('service_1_title'); ?>
						</a>
					</h3>
					<p class="description entry-content">
						<?php echo stripslashes_deep ( do_shortcode ( of_get_option('service_1_desc') ) ); ?>
					</p>
					<div class="readmore readmore-align">
						<a href="<?php echo of_get_option('service_1_link'); ?>">
						<?php echo of_get_option('service_1_button_text'); ?>
						</a>
					</div>
				</li>
				<li>
					<?php
					if ( of_get_option('service_2_icon') ) {
						echo '<img src="' . of_get_option('service_2_icon') .'" alt="step_icon" />';
					} else {
						if ($dark_theme || ( DEMO_STATUS && $_SESSION['demo_theme_style'] == "dark" )) {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_time_white.png" alt="step_icon" />';
						} else {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_time.png" alt="step_icon" />';
						}
					}
					?>
					<h3>
						<a href="<?php echo of_get_option('service_2_link'); ?>">
							<?php echo of_get_option('service_2_title'); ?>
						</a>
					</h3>
					<p class="description entry-content">
						<?php echo stripslashes_deep ( do_shortcode ( of_get_option('service_2_desc') ) ); ?>
					</p>
					<div class="readmore readmore-align">
						<a href="<?php echo of_get_option('service_2_link'); ?>">
						<?php echo of_get_option('service_2_button_text'); ?>
						</a>
					</div>
				</li>
				<li>
					<?php
					if ( of_get_option('service_3_icon') ) {
						echo '<img src="' . of_get_option('service_3_icon') .'" alt="step_icon" />';
					} else {
						if ($dark_theme || ( DEMO_STATUS && $_SESSION['demo_theme_style'] == "dark" )) {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_settings_white.png" alt="step_icon" />';
						} else {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_settings.png" alt="step_icon" />';
						}
					}
					?>
					<h3>
						<a href="<?php echo of_get_option('service_3_link'); ?>">
							<?php echo of_get_option('service_3_title'); ?>
						</a>
					</h3>
					<p class="description entry-content">
						<?php echo stripslashes_deep ( do_shortcode ( of_get_option('service_3_desc') ) ); ?>
					</p>
					<div class="readmore readmore-align">
						<a href="<?php echo of_get_option('service_3_link'); ?>">
						<?php echo of_get_option('service_3_button_text'); ?>
						</a>
					</div>
				</li>
			</ul>
			<?php
			}
			?>
			<?php
			if ( of_get_option('services_section2_status') ) {
			?>
			<ul class="clearfix">
				<li>
					<?php
					if ( of_get_option('service_4_icon') ) {
						echo '<img src="' . of_get_option('service_4_icon') .'" alt="step_icon" />';
					} else {
						if ($dark_theme || ( DEMO_STATUS && $_SESSION['demo_theme_style'] == "dark" )) {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_download_white.png" alt="step_icon" />';
						} else {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_download.png" alt="step_icon" />';
						}
					}
					?>
					<h3>
						<a href="<?php echo of_get_option('service_4_link'); ?>">
							<?php echo of_get_option('service_4_title'); ?>
						</a>
					</h3>
					<p class="description entry-content">
						<?php echo stripslashes_deep ( do_shortcode ( of_get_option('service_4_desc') ) ); ?>
					</p>
					<div class="readmore readmore-align">
						<a href="<?php echo of_get_option('service_4_link'); ?>">
						<?php echo of_get_option('service_4_button_text'); ?>
						</a>
					</div>
				</li>
				<li>
					<?php
					if ( of_get_option('service_5_icon') ) {
						echo '<img src="' . of_get_option('service_5_icon') .'" alt="step_icon" />';
					} else {
						if ($dark_theme || ( DEMO_STATUS && $_SESSION['demo_theme_style'] == "dark" )) {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_help_white.png" alt="step_icon" />';
						} else {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_help.png" alt="step_icon" />';
						}
					}
					?>
					<h3>
						<a href="<?php echo of_get_option('service_5_link'); ?>">
							<?php echo of_get_option('service_5_title'); ?>
						</a>
					</h3>
					<p class="description entry-content">
						<?php echo stripslashes_deep ( do_shortcode ( of_get_option('service_5_desc') ) ); ?>
					</p>
					<div class="readmore readmore-align">
						<a href="<?php echo of_get_option('service_5_link'); ?>">
						<?php echo of_get_option('service_5_button_text'); ?>
						</a>
					</div>
				</li>
				<li>
					<?php
					if ( of_get_option('service_6_icon') ) {
						echo '<img src="' . of_get_option('service_6_icon') .'" alt="step_icon" />';
					} else {
						if ($dark_theme || ( DEMO_STATUS && $_SESSION['demo_theme_style'] == "dark" )) {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_bells_white.png" alt="step_icon" />';
						} else {
							echo '<img src="'.MTHEME_PATH.'/images/icons/home_bells.png" alt="step_icon" />';
						}
					}
					?>
					<h3>
						<a href="<?php echo of_get_option('service_6_link'); ?>">
							<?php echo of_get_option('service_6_title'); ?>
						</a>
					</h3>
					<p class="description entry-content">
						<?php echo stripslashes_deep ( do_shortcode ( of_get_option('service_6_desc') ) ); ?>
					</p>
					<div class="readmore readmore-align">
						<a href="<?php echo of_get_option('service_6_link'); ?>">
						<?php echo of_get_option('service_6_button_text'); ?>
						</a>
					</div>
				</li>
			</ul>
			<?php
			}
			?>
		</div>
	</div>
</section>
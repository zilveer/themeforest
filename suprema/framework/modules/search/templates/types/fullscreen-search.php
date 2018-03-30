<div class="qodef-fullscreen-search-holder">
	<div class="qodef-fullscreen-search-close-container">
		<div class="qodef-search-close-holder">
			<a class="qodef-fullscreen-search-close" href="javascript:void(0)">
				<?php print $search_icon_close; ?>
			</a>
		</div>
	</div>
	<div class="qodef-fullscreen-search-shader"></div>
	<div class="qodef-fullscreen-search-table">
		<div class="qodef-fullscreen-search-cell">
			<div class="qodef-fullscreen-search-inner">
				<div class="qodef-container-inner">
					<span class="qodef-search-label"><?php esc_html_e('Type what you are searching for:', 'suprema'); ?></span>
					<form action="<?php echo esc_url(home_url('/')); ?>" class="qodef-fullscreen-search-form" method="get">
						<div class="qodef-form-holder">
							<div class="qodef-field-holder">
								<input type="text" placeholder="<?php esc_html_e('Type Here', 'suprema'); ?>" name="s" class="qodef-search-field" autocomplete="off" />
								<div class="qodef-line"></div>
								<div class="qodef-line2"></div>
								<div class="qodef-line3"></div>
								<div class="qodef-line4"></div>
							</div>
							<input type="submit" class="qodef-search-submit" value="&#x55;" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<form action="<?php echo esc_url(home_url('/')); ?>" class="mkd-search-cover" method="get">
	<?php if($search_in_grid) { ?>
	<div class="mkd-container">
		<div class="mkd-container-inner clearfix">
			<?php } ?>
			<div class="mkd-form-holder-outer">
				<div class="mkd-form-holder">
					<div class="mkd-form-holder-inner">
						<input type="text" placeholder="<?php esc_html_e('Search', 'hue'); ?>" name="s" class="mkd_search_field" autocomplete="off"/>

						<div class="mkd-search-close">
							<a href="#">
								<?php print $search_icon_close; ?>
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php if($search_in_grid) { ?>
		</div>
	</div>
<?php } ?>
</form>
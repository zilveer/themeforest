<form action="<?php echo esc_url(home_url('/')); ?>" class="mkd-search-cover" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="mkd-container">
		<div class="mkd-container-inner clearfix">
			<?php } ?>
			<div class="mkd-form-holder-outer" role="search">
				<div class="mkd-form-holder">
					<div class="mkd-form-holder-inner">
						<input type="text" placeholder="<?php esc_html_e('Search', 'libero'); ?>" name="s" class="mkd-search-field" autocomplete="off" />
						<a class="mkd-search-submit" href="javascript:void(0)">
							<span class="arrow_carrot-right"></span>
						</a>
					</div>
				</div>
			</div>
			<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
	<div class="mkd-search-close">
		<a href="#">
			<?php print $search_icon_close; ?>
		</a>
	</div>
</form>
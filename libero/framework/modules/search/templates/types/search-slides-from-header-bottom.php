<form action="<?php echo esc_url(home_url('/')); ?>" class="mkd-search-slide-header-bottom" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="mkd-container">
		<div class="mkd-container-inner clearfix">
			<?php } ?>
			<div class="mkd-form-holder-outer" role="search">
				<div class="mkd-form-holder">
					<input type="text" placeholder="<?php esc_html_e('Search', 'libero'); ?>" name="s" class="mkd-search-field" autocomplete="off" />
					<a class="mkd-search-submit" href="javascript:void(0)">
						<?php print $search_icon ?>
					</a>
				</div>
			</div>
			<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>
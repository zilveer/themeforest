<?php ?>
<form action="<?php echo esc_url(home_url('/')); ?>" class="mkd-search-slide-window-top" method="get">
	<?php if($search_in_grid) { ?>
	<div class="mkd-container">
		<div class="mkd-container-inner clearfix">
			<?php } ?>
			<div class="form-inner">
				<i class="fa fa-search"></i>
				<input type="text" placeholder="<?php esc_html_e('Search', 'hue'); ?>" name="s" class="mkd-search-field" autocomplete="off"/>
				<input type="submit" value="Search"/>

				<div class="mkd-search-close">
					<a href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
			<?php if($search_in_grid) { ?>
		</div>
	</div>
<?php } ?>
</form>
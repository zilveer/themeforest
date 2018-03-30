<?php
global $g5plus_options;
?>
<?php if (isset($g5plus_options['search_box_type']) && ($g5plus_options['search_box_type'] == 'ajax')): ?>
	<div id="g5plus-modal-search" tabindex="-1" role="dialog" aria-hidden="false" class="modal fade">
		<div class="modal-backdrop fade in"></div>
		<div class="g5plus-modal-dialog g5plus-modal-search fade in">
			<div data-dismiss="modal" class="g5plus-dismiss-modal"><i class="wicon fa fa-close"></i></div>
			<div class="g5plus-search-wrapper">
				<input id="search-ajax" type="search" placeholder="<?php echo esc_html__('Type at least 3 characters to search','g5plus-handmade') ?>">
				<button><i class="ajax-search-icon fa fa-search"></i></button>
			</div>
			<div class="ajax-search-result"></div>
		</div>
	</div>
<?php else: ?>
	<div id="search_popup_wrapper" class="dialog">
		<div class="dialog__overlay"></div>
		<div class="dialog__content">
			<div class="morph-shape">
				<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 520 280"
				     preserveAspectRatio="none">
					<rect x="3" y="3" fill="none" width="516" height="276"/>
				</svg>
			</div>
			<div class="dialog-inner">
				<h2><?php esc_html_e('Enter your keyword','g5plus-handmade'); ?></h2>
				<form  method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-popup-inner">
					<input type="text" name="s" placeholder="<?php esc_html_e('Search...','g5plus-handmade'); ?>">
					<button type="submit"><?php esc_html_e('Search','g5plus-handmade'); ?></button>
				</form>
				<div><button class="action" data-dialog-close="close" type="button"><i class="fa fa-close"></i></button></div>
			</div>
		</div>
	</div>
<?php endif;?>
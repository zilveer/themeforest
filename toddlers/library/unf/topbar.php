<?php global $unf_options; ?>
<div id="topbar" class="row clearfix hidden-xs">
	<div class="col-md-6 column">
		<?php if( $unf_options['unf_showtopnav'] == "1") {?>
			<div class="topmenu">
				<?php unf_top_menu(); ?>
			</div>
		<?php } ?>
	</div>
	<div class="col-md-6 column">

		<?php if( $unf_options['unf_shopbutton'] == "1") {?>
		<div class="headcart">
           <?php get_template_part( 'library/unf/minicart' );?>
		</div>
		<?php } ?>

		<?php if( $unf_options['unf_searchheader'] == "1") {?>
		<div class="headsearch">
			<?php get_search_form(); ?>
		</div>
		<?php } ?>

		 <?php if( $unf_options['unf_socialheader'] == "1") {
            get_template_part( 'library/unf/social' );
           }?>
	</div>
</div>
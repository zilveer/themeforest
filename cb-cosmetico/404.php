<?php /* 404 - not found template */
get_header(); ?>
</div>

</div>
<!-- bg_head end -->

<div id="middle">
	<div class="wrapper_p" style="text-align: center;">
		<div class="not_found">
			<h1 class="nft">404</h1>
			<h1>
			<?php echo get_option('cb5_not_error'); ?>
			</h1>
			<h2>
			<?php echo get_option('cb5_not_desc'); ?>
			</h2>
			<br /> <br /> <a class="bttn_big" href="javascript:history.back();"><?php _e('go back','cb-cosmetico');?>
			</a>

		</div>
	</div>

	<div class="cl"></div>

</div>
<!-- wrapper #end -->
</div>
<!-- middle #end -->

			<?php get_footer(); ?>
<?php if ( of_get_option ('sd_row_a_status') ) { ?>
<div class="mblock-block-extra">
	<div class="mblockwrap-one">
		<div class="mblockbox">
			<img class="mblockicon" src="<?php echo of_get_option ('sd_col_extra_a_icon' ); ?>" alt="icon" />
			<div class="mblocktext">
				<div class="mblocktitle"><a href="<?php echo of_get_option ('sd_col_extra_a_link' ); ?>"><?php echo stripslashes_deep( of_get_option ('sd_col_extra_a_title' ) ); ?></a></div>
			<?php echo stripslashes_deep( of_get_option ('sd_col_extra_a_desc' ) ); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<?php } ?>
<?php if ( of_get_option ('sd_row_b_status') ) { ?>
<div class="mblock-block-extra">
	<div class="mblockwrap-extra">
		<div class="mblockbox">
			<img class="mblockicon" src="<?php echo of_get_option ('sd_col_extra_b_icon' ); ?>" alt="icon" />
			<div class="mblocktext">
				<div class="mblocktitle"><a href="<?php echo of_get_option ('sd_col_extra_b_link' ); ?>"><?php echo stripslashes_deep( of_get_option ('sd_col_extra_b_title' ) ); ?></a></div>
			<?php echo stripslashes_deep( of_get_option ('sd_col_extra_b_desc' ) ); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<?php } ?>
<div class="mblock-block">
	<?php if ( of_get_option ('sd_row_a_status') ) { ?>
	<div class="mblockwrap-one">
		<div class="mblockbox">
			<img class="mblockicon" src="<?php echo of_get_option ('sd_col_a_icon' ); ?>" alt="icon" />
			<div class="mblocktext">
				<div class="mblocktitle"><a href="<?php echo of_get_option ('sd_col_a_link' ); ?>"><?php echo stripslashes_deep( of_get_option ('sd_col_a_title' ) ); ?></a></div>
			<?php echo stripslashes_deep( of_get_option ('sd_col_a_desc' ) ); ?>
			</div>
		</div>

		<div class="mblockbox mblockspace">
			<img class="mblockicon" src="<?php echo of_get_option ('sd_col_b_icon' ); ?>" alt="icon" />
			<div class="mblocktext">
				<div class="mblocktitle"><a href="<?php echo of_get_option ('sd_col_b_link' ); ?>"><?php echo stripslashes_deep( of_get_option ('sd_col_b_title' ) ); ?></a></div>
			<?php echo stripslashes_deep( of_get_option ('sd_col_b_desc' ) ); ?>
			</div>
		</div>

		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<?php } ?>

	<?php if ( of_get_option ('sd_row_b_status') ) { ?>
	<div class="mblockwrap-two">
		<div class="mblockbox">
			<img class="mblockicon" src="<?php echo of_get_option ('sd_col_c_icon' ); ?>" alt="icon" />
			<div class="mblocktext">
				<div class="mblocktitle"><a href="<?php echo of_get_option ('sd_col_c_link' ); ?>"><?php echo stripslashes_deep( of_get_option ('sd_col_c_title' ) ); ?></a></div>
			<?php echo stripslashes_deep( of_get_option ('sd_col_c_desc' ) ); ?>
			</div>
		</div>

		<div class="mblockbox mblockspace">
			<img class="mblockicon" src="<?php echo of_get_option ('sd_col_d_icon' ); ?>" alt="icon" />
			<div class="mblocktext">
				<div class="mblocktitle"><a href="<?php echo of_get_option ('sd_col_d_link' ); ?>"><?php echo stripslashes_deep( of_get_option ('sd_col_d_title' ) ); ?></a></div>
			<?php echo stripslashes_deep( of_get_option ('sd_col_d_desc' ) ); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<?php } ?>
</div>
<?php global $unf_options; ?>

<div class="opentimes-content">
	<?php if ( !empty( $unf_options['unf_showrow1']) ) {?>
	<div class="openday">
		<span class="times"><?php echo wp_kses_post($unf_options['unf_ot_row1times']);?></span><br/>
		<span class="days"><?php echo wp_kses_post($unf_options['unf_ot_row1title']);?></span>
	</div>
	<?php }?>
	<?php if ( !empty( $unf_options['unf_showrow2']) ) {?>
	<div class="openday">
		<span class="times"><?php echo wp_kses_post($unf_options['unf_ot_row2times']);?></span><br/>
		<span class="days"><?php echo wp_kses_post($unf_options['unf_ot_row2title']);?></span>
	</div>
	<?php }?>
	<?php if ( !empty( $unf_options['unf_showrow3']) ) {?>
	<div class="openday">
		<span class="times"><?php echo wp_kses_post($unf_options['unf_ot_row3times']);?></span><br/>
		<span class="days"><?php echo wp_kses_post($unf_options['unf_ot_row3title']);?></span>
	</div>
	<?php }?>
	<?php if ( !empty( $unf_options['unf_showrow4']) ) {?>
	<div class="openday">
		<span class="times"><?php echo wp_kses_post($unf_options['unf_ot_row4times']);?></span><br/>
		<span class="days"><?php echo wp_kses_post($unf_options['unf_ot_row4title']);?></span>
	</div>
	<?php }?>
	<?php if ( !empty( $unf_options['unf_showrow5']) ) {?>
	<div class="openday">
		<span class="times"><?php echo wp_kses_post($unf_options['unf_ot_row5times']);?></span><br/>
		<span class="days"><?php echo wp_kses_post($unf_options['unf_ot_row5title']);?></span>
	</div>
	<?php }?>
	<?php if ( !empty( $unf_options['unf_showrow6']) ) {?>
	<div class="openday">
		<span class="times"><?php echo wp_kses_post($unf_options['unf_ot_row6times']);?></span><br/>
		<span class="days"><?php echo wp_kses_post($unf_options['unf_ot_row6title']);?></span>
	</div>
	<?php }?>
	<?php if ( !empty( $unf_options['unf_showrow7']) ) {?>
	<div class="openday">
		<span class="times"><?php echo wp_kses_post($unf_options['unf_ot_row7times']);?></span><br/>
		<span class="days"><?php echo wp_kses_post($unf_options['unf_ot_row7title']);?></span>
	</div>
	<?php }?>
</div>
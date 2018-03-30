<?php
	if ( !isset($columns) && $columns == '' ) $columns = 1;
?>
<?php if ( (isset($first) && strcmp($first, 'yes') == 0) ) : ?><div class="row"><?php endif ?>
	<span class="span<?php echo $columns ?>">
		<?php echo do_shortcode($content) ?>
	</span>
<?php if ( (isset($last) && strcmp($last, 'yes') == 0) ) : ?></div><?php endif ?>
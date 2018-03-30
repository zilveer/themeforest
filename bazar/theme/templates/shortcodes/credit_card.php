<?php
	$card = explode(',', str_replace(' ', '',$type));
?>
<?php foreach ($card as $type) : 
	if ($type != '') : ?>
	<div class="credit_card <?php echo $type ?>"></div>
<?php endif;
endforeach ?>
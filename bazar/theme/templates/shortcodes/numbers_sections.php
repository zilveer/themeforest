<?php
	if (isset($number) && $number != ''):
		if ( strlen($number) == 1 ) :
			$left = 'zero';
			$right = substr($number, 0, 1);
		else :
			$left = substr($number, 0, 1);
			$left = ($left == 0) ? 'zero' : $left;
			$right = substr($number, 1, 1);
			$right = ($right == 0) ? 'zero' : $right;
		endif;
	else :
		$left = $right = 'zero';
	endif;
	
	$last_class = (isset($last) && strcmp($last, 'yes') == 0) ? ' last' : '';
?>

<div class="box-sections numbers-sections margin-bottom <?php echo $last_class ?>">
	<div class="number number-left number-<?php echo $left ?>"></div>
	<div class="number number-right number-<?php echo $right ?>"></div>
	<?php if( !empty( $title ) ) yit_string( '<h4>', yit_decode_title($title), '</h4>' ); ?>
	<?php echo yit_addp($content) ?>
</div>
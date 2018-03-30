<?php 
	$style = '';
    if( is_null( $incipit ) )
        $style = ' style="margin-top:0;line-height:101px;"';
    else
        $incipit = '<p>' . $incipit . '</p>';
?>    
<div class="<?php echo $class; ?>">
    <div class="incipit">
        <h2<?php echo $style; ?>><?php echo $title; ?></h2>
        <?php echo $incipit; ?>
    </div>
    <div class="separate-phone"></div>
    <div class="number-phone"><?php echo $phone; ?></div>
    <div class="clear"></div>
    <div class="decoration-image"></div>
</div>
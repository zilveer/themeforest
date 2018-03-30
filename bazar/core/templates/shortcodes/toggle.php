<?php
    if ( isset($opened) && strcmp($opened, 'yes') == 0 ) :
		$class = 'opened';
        $title_link = __( 'Close', 'yit' );
		$class_icon = 'icon-minus-sign';
	else : 
		$class = 'closed';
        $title_link = __( 'Open', 'yit' );
		$class_icon = 'icon-plus-sign';
	endif;			
?>
<div class="toggle">
    <h4 class="tab-index tab-<?php echo $class; ?>"><a href="#" title="<?php echo $title_link ?>"><span class="<?php echo $class_icon; ?>"></span> <?php echo $title; ?></a></h4>
    <div class="content-tab <?php echo $class; ?>">
        <?php echo wpautop($content); ?>
    </div>  
</div>
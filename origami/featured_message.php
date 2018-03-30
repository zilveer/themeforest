<?php
	$slider_type = get_option('themeteam_origami_message_layout'); 
 	switch($slider_type){
		case 'single':
?>

		<div id="origami-messages" class="clearfix">
	      <div class="container_12">
	        <?php if(get_option('themeteam_origami_individual_link')) { ?>
	        <div class="grid_9"><?php echo stripslashes(get_option('themeteam_origami_individual_message_text')); ?></div>
	        <div class="prefix_9"><a class="button medium <?php echo $GLOBALS['button_css'];?>" href="<?php echo get_option('themeteam_origami_individual_link'); ?>"><span><span><?php echo stripslashes(get_option('themeteam_origami_individual_button_text')); ?></span></span></a></div>
	      	<?php } else {?>
	      	<div class="grid_12"><?php echo stripslashes(get_option('themeteam_origami_individual_message_text')); ?></div>
	      	<?php } ?>
	      </div>
	    </div>
<?php
		break;
		case 'none':
		
		break;
	}
?>
<?php global $theme_options; ?>
<div id="quote">
	<span class="top-border"></span>
    <p class="quote"><?php echo $theme_options['call_to_action_one']; ?></p>
    <p class="quote-second"><?php echo $theme_options['call_to_action_two']; ?></p>
	<?php if ( ! empty($theme_options['call_to_action_link']) ) { ?> 
    	<a href="<?php echo $theme_options['call_to_action_link']; ?>" class="action-button"><span><?php echo $theme_options['call_to_action_button']; ?></span></a>
	<?php } ?>
	<span class="bottom-border"></span>
</div> <!--  #quote  -->
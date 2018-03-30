<?php
/**
 * Template: Opening times 
 *
 * @since  1.0.0
 * @version 1.0.0
 */
?>
<?php echo do_action('before_opening_times_widget', $params); ?>

<ul class="wprm-opening-times" id="wprm-opening-times">
	<?php if($params['monday']) : ?>
		<li class="monday"><?php _e('Monday','wprm', 'smartfood');?>: <span><?php echo $params['monday']; ?></span></li>
	<?php endif; ?>
	<?php if($params['tuesday']) : ?>
		<li class="tuesday"><?php _e('Tuesday','wprm', 'smartfood');?>: <span><?php echo $params['tuesday']; ?></span></li>
	<?php endif; ?>
	<?php if($params['wednesday']) : ?>
		<li class="wednesday"><?php _e('Wednesday','wprm', 'smartfood');?>: <span><?php echo $params['wednesday']; ?></span></li>
	<?php endif; ?>
	<?php if($params['thursday']) : ?>
		<li class="thursday"><?php _e('Thursday','wprm', 'smartfood');?>: <span><?php echo $params['thursday']; ?></span></li>
	<?php endif; ?>
	<?php if($params['friday']) : ?>
		<li class="friday"><?php _e('Friday','wprm', 'smartfood');?>: <span><?php echo $params['friday']; ?></span></li>
	<?php endif; ?>
	<?php if($params['saturday']) : ?>
		<li class="saturday"><?php _e('Saturday','wprm', 'smartfood');?>: <span><?php echo $params['saturday']; ?></span></li>
	<?php endif; ?>
	<?php if($params['sunday']) : ?>
		<li class="sunday"><?php _e('Sunday','wprm', 'smartfood');?>: <span><?php echo $params['sunday']; ?></span></li>
	<?php endif; ?>
</ul>

<?php echo do_action('after_opening_times_widget', $params); ?>
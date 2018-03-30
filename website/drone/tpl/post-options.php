<?php







?>

<?php wp_nonce_field($group->attr_name, $group->attr_name.'_wpnonce'); ?>

<div class="drone-post-options">
	<?php echo $group->html(); ?>
	<?php if (!empty($group->description)): ?>
		<p class="description drone-description"><?php echo $group->description; ?></p>
	<?php endif; ?>
</div>
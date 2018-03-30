<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" name="tmm_meta_saving" value="1" />
<ul class="post_type_selector">
	<?php foreach ($post_pod_types as $post_pod_type => $post_type_name): ?>

		<li class="post_type_<?php echo $post_pod_type ?>"><input type="radio" name="post_pod_type" value="<?php echo $post_pod_type ?>" <?php if ($current_post_pod_type == $post_pod_type) echo 'checked=""' ?> post-type="<?php echo $post_pod_type ?>" id="<?php echo $post_pod_type ?>" /> <label for="<?php echo $post_pod_type ?>"><span></span><?php echo $post_type_name ?></label></li>

	<?php endforeach; ?>
</ul>


<script type="text/javascript">

	jQuery(function(){
		jQuery('[name=post_pod_type]').click(function(){
			var post_pod_type=jQuery(this).attr('post-type'); 
			jQuery('.post_type_conrainer').hide(400);
			jQuery('.post_type_'+post_pod_type+'_conrainer').show(400);
		});
	 
	})

</script>
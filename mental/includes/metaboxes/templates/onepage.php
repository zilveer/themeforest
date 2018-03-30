<?php defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call ?>

<div class="mental_meta_control">
	<p>
		<?php $mb->the_field('top_content'); ?>
		<label><?php _e( 'Top section content (above Main Menu, shows only if gallery is empty)', 'mental' ) ?></label>
		<textarea name="<?php $mb->the_name(); ?>" rows="7"><?php $mb->the_value(); ?></textarea>
	</p>

	<p>
		<?php $mb->the_field('top_content_height'); ?>
		<label><?php _e( 'Top section height', 'mental' ) ?></label>
		<select name="<?php $mb->the_name(); ?>">
			<option value="auto" <?php if($mb->get_the_value() == 'auto') echo 'selected'; ?>><?php _e( 'Auto', 'mental' ) ?></option>
			<option value="100" <?php if($mb->get_the_value() == '100') echo 'selected'; ?>><?php _e( 'As screen', 'mental' ) ?></option>
			<option value="100-menu" <?php if($mb->get_the_value() == '100-menu') echo 'selected'; ?>><?php _e( 'As screen minus Menu', 'mental' ) ?></option>
		</select>
	</p>
</div>

<!-- Show metabox only for page-onepage.php template-->
<script type="text/javascript">
	jQuery(document).ready(function($){
		metabox_template_switcher('page-onepage.php', '#onepage_metabox');
	});
</script>
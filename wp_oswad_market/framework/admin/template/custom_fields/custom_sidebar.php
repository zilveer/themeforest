<?php
/* Add Custom Sidebar for post, portfolio */
global $post;
$sidebar = get_post_meta($post->ID,THEME_SLUG.'custom_sidebar',true);
$custom_sidebar_str = get_option(THEME_SLUG.'areas');
$custom_sidebar_arr = array('Default');
if($custom_sidebar_str)
	$custom_sidebar_arr = array_merge($custom_sidebar_arr,json_decode($custom_sidebar_str));
?>	
<?php if(!empty($custom_sidebar_arr)):?>
<select class="select-sidebar" name="custom_sidebar">
	<?php foreach($custom_sidebar_arr as $cs):?>
		<?php if($cs == 'Default'):?>
		<option value=""><?php echo $cs; ?></option>
		<?php else:?>
		<option value="<?php echo $cs; ?>" <?php if($sidebar == $cs) echo 'selected';?>><?php echo $cs; ?></option>
		<?php endif;?>
	<?php endforeach;?>
</select>
<?php endif; ?>
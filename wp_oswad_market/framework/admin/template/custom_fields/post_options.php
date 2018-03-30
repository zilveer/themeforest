<?php 
global $post;
	$datas = unserialize(get_post_meta($post->ID,THEME_SLUG.'post_options',true));
	$video_url = get_post_meta($post->ID, '_video_url', true);
	$video_width = get_post_meta($post->ID, '_video_width', true);
	$video_height = get_post_meta($post->ID, '_video_height', true);
	if( !$video_width ){
		$video_width = 700;
	}
	if( !$video_height ){
		$video_height = 400;
	}
	$datas = wd_array_atts(array(
										"post_column"					=> '0'
										,"left_sidebar" 				=> '0'
										,"right_sidebar" 				=> '0'
								),$datas);
?>

<div class="page_config_wrapper">
	<div class="page_config_wrapper_inner">
		<input type="hidden" value="1" name="_post_options">
		<?php wp_nonce_field( "_update_post_options", "nonce_post_options" ); ?>
		<ul class="page_config_list">
			<li class="" >
				<p>
					<label><?php _e('Post Layout','wpdance');?> </label>
					<select name="post_column" id="post_column">
						<option value="0" <?php if( strcmp($datas['post_column'],'0') == 0 ) echo "selected";?>>Default</option>
						<option value="0-1-0" <?php if( strcmp($datas['post_column'],'0-1-0') == 0 ) echo "selected";?>>Fullwidth</option>
						<option value="1-1-0" <?php if( strcmp($datas['post_column'],'1-1-0') == 0 ) echo "selected";?>>Left Sidebar</option>
						<option value="0-1-1" <?php if( strcmp($datas['post_column'],'0-1-1') == 0 ) echo "selected";?>>Right Sidebar</option>
						<option value="1-1-1" <?php if( strcmp($datas['post_column'],'1-1-1') == 0 ) echo "selected";?>>Left & Right Sidebar</option>
					</select>
				</p> 
			</li>
			<li class="">
				<p>
					<label><?php _e('Left Sidebar','wpdance');?> </label>
					<select name="left_sidebar" id="_left_sidebar">
						<option value="0" <?php selected($datas["left_sidebar"], 0); ?>>Default</option>
						<?php
							global $default_sidebars;
							foreach( $default_sidebars as $key => $_sidebar ){
								$_selected_str = ( strcmp($datas["left_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
								echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
							}
						?>
					</select>
				</p> 
			</li>
			<li class="">
				<p>
					<label><?php _e('Right Sidebar','wpdance');?> </label>
					<select name="right_sidebar" id="_right_sidebar">
						<option value="0" <?php selected($datas["right_sidebar"], 0); ?>>Default</option>
						<?php
							global $default_sidebars;
							foreach( $default_sidebars as $key => $_sidebar ){
								$_selected_str = ( strcmp($datas["right_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
								echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
							}
						?>
					</select>
				</p> 
			</li>
			
			<li class="">
				<p>
					<label><?php _e('Video URL','wpdance');?> </label>
					<input type="text" name="video_url" id="video_url" value="<?php echo $video_url; ?>" />
					<span class="description"><?php _e('Input Youtube, Vimeo or Dailymotion video URL. This video shows on the single post instead of the post thumbnail', 'wpdance'); ?></span>
				</p>
			</li>
			<li class="">
				<p>
					<label><?php _e('Video width','wpdance');?> </label>
					<input type="text" name="video_width" id="video_width" value="<?php echo $video_width; ?>" />
				</p>
			</li>
			<li class="">
				<p>
					<label><?php _e('Video height','wpdance');?></label>
					<input type="text" name="video_height" id="video_height" value="<?php echo $video_height; ?>" />
				</p>
			</li>
		</ul>
	</div>
</div>
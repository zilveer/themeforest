<?php 
$post_id_post = isset($_POST['post_ID']) ? $_POST['post_ID'] : '' ;
$post_id = isset($_GET['post']) ? $_GET['post'] : $post_id_post ;

if ( ! function_exists( 'ABdevFW_post_add_meta' ) ){
	function ABdevFW_post_add_meta(){  
		add_meta_box("post-meta", "Featured Media", "ABdevFW_post_meta_options", "post", "side", "low");   
		add_meta_box("post-sidebar", "Select Sidebar", "ABdevFW_post_sidebar_meta_box", "post");   
	}
}
add_action("admin_init", "ABdevFW_post_add_meta");  


//Create area for extra fields
if ( ! function_exists( 'ABdevFW_post_meta_options' ) ){
	function ABdevFW_post_meta_options($post_id){  
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
			return $post_id;
		}
		$custom = get_post_custom();
		$ABdevFW_youtube_id = isset($custom["ABdevFW_youtube_id"][0])?$custom["ABdevFW_youtube_id"][0]:''; 
		$ABdevFW_vimeo_id = isset($custom["ABdevFW_vimeo_id"][0])?$custom["ABdevFW_vimeo_id"][0]:''; 
		$ABdevFW_soundcloud = isset($custom["ABdevFW_soundcloud"][0])?$custom["ABdevFW_soundcloud"][0]:''; 
		$ABdevFW_selected_media = isset($custom["ABdevFW_selected_media"][0])?$custom["ABdevFW_selected_media"][0]:''; 
		?>  
		<style type="text/css">
			.post_meta_extras div{margin: 10px;}
			.post_meta_extras .input-field{width: 100%;}
			.post_meta_extras div label{display:block;}	
		</style>

		<div class="post_meta_extras">
			<div>
				<small><?php _e('Here you can set other media to be shown instead of featured image.', 'ABdev_aeron' ); ?></small>
			</div>
			<div>
				<label>
					<input type="radio" name="ABdevFW_selected_media" value="youtube" <?php checked($ABdevFW_selected_media, 'youtube') ?>> 
					<?php _e('Youtube Video ID:', 'ABdev_aeron' ); ?>
					<input class="input-field" name="ABdevFW_youtube_id" value="<?php echo $ABdevFW_youtube_id; ?>" />
				</label>
			</div>
			<div>
				<label>
					<input type="radio" name="ABdevFW_selected_media" value="vimeo" <?php checked($ABdevFW_selected_media, 'vimeo') ?>> 
					<?php _e('Vimeo Video ID:', 'ABdev_aeron' ); ?>
					<input class="input-field" name="ABdevFW_vimeo_id" value="<?php echo $ABdevFW_vimeo_id; ?>" />
				</label>
			</div>
			<div>
				<label>
					<input type="radio" name="ABdevFW_selected_media" value="soundcloud" <?php checked($ABdevFW_selected_media, 'soundcloud') ?>> 
					<?php _e('SoundCloud ID:', 'ABdev_aeron' ); ?>
					<input class="input-field" name="ABdevFW_soundcloud" value="<?php echo $ABdevFW_soundcloud; ?>" />
				</label>
			</div>
			<div>
				<label>
					<input type="radio" name="ABdevFW_selected_media" value="" <?php checked($ABdevFW_selected_media, '') ?>> 
					<?php _e('None - Use Featured Image', 'ABdev_aeron' ); ?>
				</label>
			</div>
		</div>   
		<?php  
	} 
}
if ( ! function_exists( 'ABdevFW_post_save_extras' ) ){
	function ABdevFW_post_save_extras($post_id){  
		global $post;  
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){ 
			return $post_id;
		}else{
			if( isset( $_POST['ABdevFW_youtube_id'] ) ) {
				update_post_meta( $post_id, 'ABdevFW_youtube_id', esc_attr( $_POST['ABdevFW_youtube_id'] ) );  
			}
			
			if( isset( $_POST['ABdevFW_vimeo_id'] ) ) {
				update_post_meta( $post_id, 'ABdevFW_vimeo_id', esc_attr( $_POST['ABdevFW_vimeo_id'] ) ); 
			}

			if( isset( $_POST['ABdevFW_soundcloud'] ) ) {
				update_post_meta( $post_id, 'ABdevFW_soundcloud', esc_attr( $_POST['ABdevFW_soundcloud'] ) ); 
			}

			if( isset( $_POST['ABdevFW_selected_media'] ) ) {
				update_post_meta( $post_id, 'ABdevFW_selected_media', esc_attr( $_POST['ABdevFW_selected_media'] ) ); 
			}
		} 
	}  
}
add_action('save_post', 'ABdevFW_post_save_extras'); 



if ( ! function_exists( 'ABdevFW_post_sidebar_meta_box' ) ){
	function ABdevFW_post_sidebar_meta_box( $post ){ 
		global $aeron_options;
		
		$aeron_user_sidebars = (isset($aeron_options['sidebars']) && is_array($aeron_options['sidebars'])) ? $aeron_options['sidebars'] : array();
		$values = get_post_custom( $post->ID );
		$custom_sidebar = (isset($values['custom_sidebar'])) ? $values['custom_sidebar'][0] : '';
		wp_nonce_field( 'my_meta_box_sidebar_nonce', 'meta_box_sidebar_nonce' );
		?>  
		<p>  
			<select name="custom_sidebar" id="custom_sidebar">  
					<option value=""><?php _e('Default', 'ABdev_aeron') ?></option> ';
				<?php foreach ($aeron_user_sidebars as $sidebar) {
					echo '<option value="'.$sidebar.'" '. selected( $custom_sidebar, $sidebar, false ) . '>' . $sidebar . '</option> ';
				}
				?>
			</select>  
		</p>

		<?php
	}
}

if ( ! function_exists( 'ABdevFW_post_save_sidebar_meta_box' ) ){
	function ABdevFW_post_save_sidebar_meta_box( $post_id ){ 
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){ 
			return; 
		}
		if( !isset( $_POST['custom_sidebar'] ) || !wp_verify_nonce( $_POST['meta_box_sidebar_nonce'], 'my_meta_box_sidebar_nonce' ) ) {
			return; 
		}
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		if( isset( $_POST['custom_sidebar'] ) ){
			update_post_meta( $post_id, 'custom_sidebar', wp_kses( $_POST['custom_sidebar'] ,'') );  
		}
	}
}
add_action( 'save_post', 'ABdevFW_post_save_sidebar_meta_box' );  



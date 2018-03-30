<?php

/**
* User Profile functions  . 
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

function van_user_social_networks($user){
	?>
	<h3><?php _e( 'Social Networks', 'van' ) ?></h3>
	<table class="form-table">
      		 <tr>
			<th><label for="facebook">Facebook url:</label></th>
			<td><input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
        		<tr>
			<th><label for="twitter">Twitter url:</label></th>
			<td><input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="goplus">Google+ url:</label></th>
			<td><input type="text" name="goplus" id="goplus" value="<?php echo esc_attr( get_the_author_meta( 'goplus', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
        		<tr>
			<th><label for="youtube">YouTube url:</label></th>
			<td><input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
       		 <tr>
			<th><label for="youtube">Vimeo url:</label></th>
			<td><input type="text" name="vimeo" id="vimeo" value="<?php echo esc_attr( get_the_author_meta( 'vimeo', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="linkedin">LinkedIn url:</label></th>
			<td><input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="flickr">Flickr url:</label></th>
			<td><input type="text" name="flickr" id="flickr" value="<?php echo esc_attr( get_the_author_meta( 'flickr', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="pinterest">Pinterest url:</label></th>
			<td><input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
	</table>
<?php
}
add_action( 'show_user_profile', 'van_user_social_networks' );
add_action( 'edit_user_profile', 'van_user_social_networks' );

function van_save_profile($user_id) {
	if ( !current_user_can( 'edit_user', $user_id ) ) return false;
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'goplus', $_POST['goplus'] );
	update_user_meta( $user_id, 'youtube', $_POST['youtube'] );
	update_user_meta( $user_id, 'vimeo', $_POST['vimeo'] );
	update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_user_meta( $user_id, 'flickr', $_POST['flickr'] );
	update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
}
add_action( 'personal_options_update', 'van_save_profile' );
add_action( 'edit_user_profile_update', 'van_save_profile' );
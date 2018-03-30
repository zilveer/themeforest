<?php
function get_ocmx_gplus_authorship_link ( $gplus_return = '' ) {

	$ocmx_gplus_author_url = esc_attr( get_the_author_meta( 'ocmx_gplus_author_url' ) );
	if( '' != $ocmx_gplus_author_url ) {
		$gplus_return = '<a href="'.$ocmx_gplus_author_url.'?rel=author" rel="author" title="Google Plus Profile for '.get_the_author().'">+</a>' . $gplus_return;
	}

	return $gplus_return;
}
function ocmx_gplus_authorship_link($gplus_return='') {
	echo get_ocmx_gplus_authorship_link ($gplus_return);
}

add_filter( 'the_author_link' , 'ocmx_gplus_authorship_link' , 10, 10 );
add_filter( 'the_author_posts_link' , 'ocmx_gplus_authorship_link' , 10, 10 );
add_filter( 'get_the_author_posts_link' , 'get_ocmx_gplus_authorship_link' , 10, 10 );

add_action( 'show_user_profile', 'ocmx_gplus_authorship_profile_fields' );
add_action( 'edit_user_profile', 'ocmx_gplus_authorship_profile_fields' );

function ocmx_gplus_authorship_profile_fields( $user ) {
	global $current_user;

	get_currentuserinfo();
	$ocmx_gplus_author_url = esc_attr( get_the_author_meta( 'ocmx_gplus_author_url', $current_user->ID ) ); ?>
	<h3><?php _e( 'Google Plus profile information' , 'ocmx' ); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="ocmx_gplus_author_url"><?php _e( 'Google Plus Profile URL' , 'ocmx' ); ?></label></th>

			<td>
				<input type="text" name="ocmx_gplus_author_url" id="ocmx_gplus_author_url" value="<?php echo esc_attr( get_the_author_meta( 'ocmx_gplus_author_url', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e( 'Please enter your Google Plus Profile URL. (with "https://plus.google.com/u/0/117507203608817059139")' , 'ocmx' ); ?></span>
			</td>
		</tr>
	</table>
<?php }

add_action( 'profile_update', 'ocmx_gplus_authorship_profile_save' );

function ocmx_gplus_authorship_profile_save( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ){
		echo "You can't edit this user";
		return false;
	}
	update_user_meta( $user_id , 'ocmx_gplus_author_url' , $_POST['ocmx_gplus_author_url'] );
}
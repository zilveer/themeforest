<?php
//
// discography post type related functions.
//
add_action( 'init', 'ci_create_cpt_discography' );

if( !function_exists('ci_create_cpt_discography') ):
function ci_create_cpt_discography()
{
	$labels = array(
		'name'               => _x( 'Discography', 'post type general name', 'ci_theme' ),
		'singular_name'      => _x( 'Discography Item', 'post type singular name', 'ci_theme' ),
		'add_new'            => __( 'New Discography Item', 'ci_theme' ),
		'add_new_item'       => __( 'Add New Discography Item', 'ci_theme' ),
		'edit_item'          => __( 'Edit Discography Item', 'ci_theme' ),
		'new_item'           => __( 'New Discography Item', 'ci_theme' ),
		'view_item'          => __( 'View Discography Item', 'ci_theme' ),
		'search_items'       => __( 'Search Discography Items', 'ci_theme' ),
		'not_found'          => __( 'No Discography Items found', 'ci_theme' ),
		'not_found_in_trash' => __( 'No Discography Items found in the trash', 'ci_theme' ),
		'parent_item_colon'  => __( 'Parent Discography Item:', 'ci_theme' )
	);

	$args = array(
		'labels'          => $labels,
		'singular_label'  => __( 'Discography Item', 'ci_theme' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => _x( 'discography', 'post type archive slug', 'ci_theme' ),
		'rewrite'         => array( 'slug' => _x( 'discography', 'post type slug', 'ci_theme' ) ),
		'menu_position'   => 5,
		'supports'        => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'       => 'dashicons-format-audio'
	);

	register_post_type( 'cpt_discography' , $args );

}
endif;

add_action( 'load-post.php', 'discography_meta_boxes_setup' );
add_action( 'load-post-new.php', 'discography_meta_boxes_setup' ); 

if( !function_exists('discography_meta_boxes_setup') ):
function discography_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'discography_add_meta_boxes' );
	add_action( 'save_post', 'discography_save_meta', 10, 2 );
}
endif;

if( !function_exists('discography_add_meta_boxes') ):
function discography_add_meta_boxes() {
	add_meta_box( 'discography-box', __( 'Discography Settings', 'ci_theme' ), 'discography_score_meta_box', 'cpt_discography', 'normal', 'high' );
}
endif;

if( !function_exists('discography_score_meta_box') ):
function discography_score_meta_box( $object, $box )
{
	ci_prepare_metabox('cpt_discography');

	?><div class="ci-cf-wrap"><?php
		ci_metabox_open_tab( __( 'Album Details', 'ci_theme' ) );
			ci_metabox_input( 'ci_cpt_discography_date', __( 'Release Date.', 'ci_theme' ) );
			ci_metabox_input( 'ci_cpt_discography_label', __( 'Recording Label.', 'ci_theme' ) );
			ci_metabox_input( 'ci_cpt_discography_cat_no', __( 'Catalog Number.', 'ci_theme' ) );
		ci_metabox_close_tab();

		ci_metabox_open_tab( __( 'Purchase Details', 'ci_theme' ) );
			ci_metabox_input( 'ci_cpt_discography_status', __( 'Album Status. For example: "This album is now available"', 'ci_theme' ) );
			ci_metabox_input( 'ci_cpt_discography_purchase_text', __( 'Purchase text. For example: "You can purchase this album from" OR "Pre-order this album now"', 'ci_theme' ) );
			ci_metabox_input( 'ci_cpt_discography_purchase_text_from1', __( 'Purchase from text #1. For example: "iTunes"', 'ci_theme' ) );
			ci_metabox_input( 'ci_cpt_discography_purchase_text_url1', __( 'Purchase from URL #1.', 'ci_theme' ), array( 'esc_func' => 'esc_url' ) );
			ci_metabox_input( 'ci_cpt_discography_purchase_text_from2', __( 'Purchase from text #2. For example: "Amazon"', 'ci_theme' ) );
			ci_metabox_input( 'ci_cpt_discography_purchase_text_url2', __( 'Purchase from URL #2.', 'ci_theme' ), array( 'esc_func' => 'esc_url' ) );
		ci_metabox_close_tab();

		ci_metabox_open_tab( __( 'Tracks Details', 'ci_theme' ) );
			ci_metabox_guide( array(
				__( 'You may add the tracks of your release, along with related information such as a Download URL, Buy URL and lyrics. Press the <em>Add Track</em> button to add a new track, and individually the <em>Remove me</em> button to delete a track.', 'ci_theme' ),
				sprintf( __( 'You can use a SoundCloud URL in place of the Play URL, assuming you have the SoundCloud shortcode available by installing the <a href="%s">SoundCloud Shortcode plugin</a>.', 'ci_theme' ), 'http://wordpress.org/plugins/soundcloud-shortcode/' ),
			), array( 'type' => 'p' ) );

			?>
			<div id="ci_repeating_tracks" class="ci-repeating-fields">
				<a href="#" class="ci-repeating-add-field button"><i class="dashicons dashicons-plus-alt"></i><?php _e('Add Track', 'ci_theme'); ?></a>
				<table class="tracks inner">
					<thead>
						<tr>
							<th class="tracks-no"><?php _e( '#', 'ci_theme' ); ?></th>
							<th><?php _e( 'Title', 'ci_theme' ); ?></th>
							<th><?php _e( 'Subtitle', 'ci_theme' ); ?></th>
							<th><?php _e( 'Buy URL', 'ci_theme' ); ?></th>
							<th><?php _e( 'Play URL', 'ci_theme' ); ?></th>
							<th><?php _e( 'Download URL', 'ci_theme' ); ?></th>
							<th class="tracks-action"></th>
						</tr>
					</thead>
					<?php
						$fields = get_post_meta( $object->ID, 'ci_cpt_discography_tracks', true );
						$fields = ci_theme_convert_discography_tracks_from_unnamed( $fields );

						if ( ! empty( $fields ) ) {
							$i = 0;
							foreach ( $fields as $field ) {
								$i++;
								?>
								<tbody class="track-group post-field">
									<tr>
										<td class="tracks-no" rowspan="2"><span class="dashicons dashicons-sort"></span><?php _ex('#', 'track number', 'ci_theme'); ?><span class="track-num"><?php echo $i; ?></span></td>
										<td class="tracks-field"><input type="text" name="ci_cpt_discography_tracks_repeatable_title[]" placeholder="<?php esc_attr_e('Title', 'ci_theme'); ?>" value="<?php echo esc_attr($field['title']); ?>" /></td>
										<td class="tracks-field"><input type="text" name="ci_cpt_discography_tracks_repeatable_subtitle[]" placeholder="<?php esc_attr_e('Subtitle', 'ci_theme'); ?>" value="<?php echo esc_attr($field['subtitle']); ?>" /></td>
										<td class="tracks-field"><input type="text" name="ci_cpt_discography_tracks_repeatable_buy_url[]" placeholder="<?php esc_attr_e('Buy URL', 'ci_theme'); ?>" value="<?php echo esc_url($field['buy_url']); ?>" /></td>
										<td class="tracks-field"><div class="wp-media-buttons"><input type="text" name="ci_cpt_discography_tracks_repeatable_play_url[]" placeholder="<?php esc_attr_e('Play URL', 'ci_theme'); ?>" value="<?php echo esc_url($field['play_url']); ?>" class="uploaded with-button" /><a href="#" class="ci-upload ci-upload-track button add_media"><span class="wp-media-buttons-icon"></span></a></div></td>
										<td class="tracks-field"><input type="text" name="ci_cpt_discography_tracks_repeatable_download_url[]" placeholder="<?php esc_attr_e('Download URL', 'ci_theme'); ?>" value="<?php echo esc_url($field['download_url']); ?>" /></td>
										<td class="tracks-action"><a href="#" class="ci-repeating-remove-field"><span class="dashicons dashicons-no"></span></a></td>
									</tr>
									<tr>
										<td class="tracks-field" colspan="6"><textarea placeholder="<?php esc_attr_e('Song Lyrics', 'ci_theme'); ?>" name="ci_cpt_discography_tracks_repeatable_lyrics[]"><?php echo esc_textarea($field['lyrics']); ?></textarea></td>
									</tr>
								</tbody>
								<?php
							}
						}
					?>
					<tbody class="track-group post-field field-prototype" style="display: none;">
						<tr>
							<td class="tracks-no" rowspan="2"><span class="dashicons dashicons-sort"></span><?php _ex('#', 'track number', 'ci_theme'); ?><span class="track-num"></span></td>
							<td class="tracks-field"><input type="text" name="ci_cpt_discography_tracks_repeatable_title[]" placeholder="<?php esc_attr_e('Title', 'ci_theme'); ?>" value="" /></td>
							<td class="tracks-field"><input type="text" name="ci_cpt_discography_tracks_repeatable_subtitle[]" placeholder="<?php esc_attr_e('Subtitle', 'ci_theme'); ?>" value="" /></td>
							<td class="tracks-field"><input type="text" name="ci_cpt_discography_tracks_repeatable_buy_url[]" placeholder="<?php esc_attr_e('Buy URL', 'ci_theme'); ?>" value="" /></td>
							<td class="tracks-field"><div class="wp-media-buttons"><input type="text" name="ci_cpt_discography_tracks_repeatable_play_url[]" placeholder="<?php esc_attr_e('Play URL', 'ci_theme'); ?>" value="" class="uploaded with-button" /><a href="#" class="ci-upload ci-upload-track button add_media"><span class="wp-media-buttons-icon"></span></a></div></td>
							<td class="tracks-field"><input type="text" name="ci_cpt_discography_tracks_repeatable_download_url[]" placeholder="<?php esc_attr_e('Download URL', 'ci_theme'); ?>" value="" /></td>
							<td class="tracks-action"><a href="#" class="ci-repeating-remove-field"><span class="dashicons dashicons-no"></span></a></td>
						</tr>
						<tr>
							<td class="tracks-field" colspan="6"><textarea placeholder="<?php esc_attr_e('Song Lyrics', 'ci_theme'); ?>" name="ci_cpt_discography_tracks_repeatable_lyrics[]"></textarea></td>
						</tr>
					</tbody>
				</table>
				<a href="#" class="ci-repeating-add-field button"><i class="dashicons dashicons-plus-alt"></i><?php _e('Add Track', 'ci_theme'); ?></a>

			</div>
			<p><?php _e('Once you add your tracks you may display them by using the <strong>[tracklisting]</strong> shortcode. By default, it will display the tracks of the current discography item. You may also display the track listing of any discography item in any other post/page or widget (that supports shortcodes) by passing the <em>ID</em> or <em>slug</em> parameter to the shortcode. E.g. <strong>[tracklisting id="25"]</strong> or <strong>[tracklisting slug="the-division-bell"]</strong>', 'ci_theme'); ?></p>
			<p><?php _e('You can also selectively display tracks, by passing their track number (counting from 1), separated by a comma, like this <strong>[tracklisting tracks="2,5,8"]</strong> and can limit the total number of tracks displayed like <strong>[tracklisting limit="3"]</strong>', 'ci_theme'); ?></p>
			<p><?php _e('Of course, you can mix and match the parameters, so the following is totally valid: <strong>[tracklisting slug="the-division-bell" tracks="2,5,8" limit="2"]</strong>', 'ci_theme'); ?></p>
			<?php
		ci_metabox_close_tab();
	?></div><?php

}
endif;

if( !function_exists('discography_save_meta') ):
function discography_save_meta( $post_id, $post ) {
	
	if ( !ci_can_save_meta('cpt_discography') ) return;

	update_post_meta( $post_id, 'ci_cpt_discography_date', sanitize_text_field( $_POST['ci_cpt_discography_date'] ) );
	update_post_meta( $post_id, 'ci_cpt_discography_label', sanitize_text_field( $_POST['ci_cpt_discography_label'] ) );
	update_post_meta( $post_id, 'ci_cpt_discography_cat_no', sanitize_text_field( $_POST['ci_cpt_discography_cat_no'] ) );
	update_post_meta( $post_id, 'ci_cpt_discography_status', sanitize_text_field( $_POST['ci_cpt_discography_status'] ) );
	update_post_meta( $post_id, 'ci_cpt_discography_purchase_text', sanitize_text_field( $_POST['ci_cpt_discography_purchase_text'] ) );
	update_post_meta( $post_id, 'ci_cpt_discography_purchase_text_from1', sanitize_text_field( $_POST['ci_cpt_discography_purchase_text_from1'] ) );
	update_post_meta( $post_id, 'ci_cpt_discography_purchase_text_from2', sanitize_text_field( $_POST['ci_cpt_discography_purchase_text_from2'] ) );

	update_post_meta( $post_id, 'ci_cpt_discography_purchase_text_url1', esc_url_raw( $_POST['ci_cpt_discography_purchase_text_url1'] ) );
	update_post_meta( $post_id, 'ci_cpt_discography_purchase_text_url2', esc_url_raw( $_POST['ci_cpt_discography_purchase_text_url2'] ) );

	update_post_meta( $post_id, 'ci_cpt_discography_tracks', ci_theme_sanitize_discography_tracks_repeating( $_POST ) );

}
endif;

if ( ! function_exists( 'ci_theme_sanitize_discography_tracks_repeating' ) ) :
function ci_theme_sanitize_discography_tracks_repeating( $POST_array ) {
	if ( empty( $POST_array ) || !is_array( $POST_array ) ) {
		return array();
	}

	$titles        = $POST_array['ci_cpt_discography_tracks_repeatable_title'];
	$subtitles     = $POST_array['ci_cpt_discography_tracks_repeatable_subtitle'];
	$buy_urls      = $POST_array['ci_cpt_discography_tracks_repeatable_buy_url'];
	$play_urls     = $POST_array['ci_cpt_discography_tracks_repeatable_play_url'];
	$download_urls = $POST_array['ci_cpt_discography_tracks_repeatable_download_url'];
	$lyrics        = $POST_array['ci_cpt_discography_tracks_repeatable_lyrics'];

	$count = max(
		count( $titles ),
		count( $subtitles ),
		count( $buy_urls ),
		count( $download_urls ),
		count( $play_urls ),
		count( $lyrics )
	);

	$new_fields = array();

	$records_count = 0;

	for ( $i = 0; $i < $count; $i++ ) {
		if ( empty( $titles[$i] )
			&& empty( $subtitles[$i] )
			&& empty( $buy_urls[$i] )
			&& empty( $download_urls[$i] )
			&& empty( $play_urls[$i] )
			&& empty( $lyrics[$i] )
		) {
			continue;
		}

		$new_fields[ $records_count ]['title']        = sanitize_text_field( $titles[ $i ] );
		$new_fields[ $records_count ]['subtitle']     = sanitize_text_field( $subtitles[ $i ] );
		$new_fields[ $records_count ]['buy_url']      = esc_url_raw( $buy_urls[ $i ] );
		$new_fields[ $records_count ]['play_url']     = esc_url_raw( $play_urls[ $i ] );
		$new_fields[ $records_count ]['download_url'] = esc_url_raw( $download_urls[ $i ] );
		$new_fields[ $records_count ]['lyrics']       = wp_kses_post( $lyrics[ $i ] );

		$records_count++;
	}
	return $new_fields;
}
endif;

if ( ! function_exists( 'ci_theme_convert_discography_tracks_from_unnamed' ) ) :
function ci_theme_convert_discography_tracks_from_unnamed( $fields ) {

	// This array must match the order of the old numeric parameters, e.g. [0] will map to 'title', etc.
	$names = array( 'title', 'subtitle', 'buy_url', 'play_url', 'download_url', 'lyrics' );

	if( ! is_array( $fields ) ) {
		return $fields;
	}

	$first_value = reset( $fields );
	$key = key( $fields );

	if( ! is_array( $first_value ) && !empty( $fields ) ) {
		$new_fields = array();

		for( $t = 0; $t < count( $fields ); $t += count( $names ) ) {
			$new_track = array();

			for( $tf = 0; $tf < count( $names ); $tf++ ) {
				if( isset( $fields[ $t + $tf ] ) ) {
					$new_track[ $names[ $tf ] ] = $fields[ $t + $tf ];
				}
			}
			$new_fields[] = $new_track;
		}
		$fields = $new_fields;
	}

	return $fields;
}
endif;

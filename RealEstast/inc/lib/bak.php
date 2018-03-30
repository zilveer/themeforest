<?php


function add_datelog_box() {
	add_meta_box( 'estate-date-log', 'Date setting', 'datelog_metabox', 'estate',
		'normal', 'low' );

	add_action( 'save_post', 'datelog_save' );
}

add_action( 'admin_init', 'add_datelog_box' );

function datelog_metabox() {
	/**
	 * @var $wpdb wpdb
	 */
	global $wpdb;
	global $post;
	$datelogs = $wpdb->get_results( "select * from {$wpdb->prefix}datelog WHERE post_id={$post->ID}", ARRAY_A );

	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_style( 'jquery-ui-css', 'http:code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' );
	wp_enqueue_script( 'datelog-script', get_stylesheet_directory_uri() .
			'/assets/js/datelog.js' );
	?>
		<div class="datelog_container">
			<table id="datelog_tbl">
				<tr>
					<td colspan="3">
						<input id="btn_datelog_add" type="button" value="Add new available date" />
					</td>
				</tr>
				<?php
			$n = count( $datelogs );
			if ( $n ) {
				for ( $i = 0; $i < $n; $i ++ ) {
					?>
						<tr>
							<td>
								<label for="dp_from_<?php echo $i; ?>">From
	<input type="text" value="<?php echo date('Y/m/d', strtotime($datelogs[$i]['from_date'])); ?>" class="dp" data-target="storage_dp_from_<?php echo $i; ?>" /></label>
							<input type="hidden" name="datelog[<?php echo $i; ?>][from]" id="storage_dp_from_<?php echo $i; ?>" value="<?php echo $datelogs[$i]['from_date']; ?>" />
							</td>
							<td>
								<label for="dp_to_<?php echo $i; ?>">To
	<input class="dp" type="text" value="<?php echo date('Y/m/d', strtotime($datelogs[$i]['to_date'])); ?>" data-target="storage_dp_to_<?php echo $i; ?>" />
								</label>
								<input type="hidden" name="date[<?php echo $i; ?>][to]" id="storage_dp_to_<?php echo $i; ?>" value="<?php echo $datelogs[$i]['to_date']; ?>" />
							</td>
							<td><a href="#" class="dl_rm">Remove</a></td>
						</tr>
					<?php
				}
			}
			?>
			</table>
		</div>
<?php
}

function datelog_save() {
	/**
	 * @var $wpdb wpdb
	 */
	global $post;
	global $wpdb;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post->ID;
	}
	if ( is_null( $post ) )
		return NULL;
	if ( $post->post_type != 'estate' ) {
		return NULL;
	}

	if ( isset( $_POST['datelog'] ) && ! empty( $_POST['datelog'] ) ) {
		$query = "DELETE FROM {$wpdb->prefix}datelog WHERE post_id={$post->ID}";
		$wpdb->query( $query );
		foreach ( $_POST['datelog'] as $date ) {
			$wpdb->insert( $wpdb->prefix . 'datelog', array(
					'post_id'   => $post->ID,
					'from_date' => intval( $date['from'] ),
					'to_date'   => intval( $date['to'] )
				),
				array( '%d', '%d', '%d' ) );
		}
	}

	return $post;
}

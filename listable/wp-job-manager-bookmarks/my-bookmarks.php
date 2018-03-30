<div id="job-manager-bookmarks">
	<table class="job-manager-bookmarks">
		<thead>
			<tr>
				<th><?php _e( 'Bookmark', 'listable' ); ?></th>
				<th><?php _e( 'Notes', 'listable' ); ?></th>
				<th><span style="display: none"><?php _e( 'Actions', 'listable' ); ?></span></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $bookmarks as $bookmark ) :
				if ( get_post_status( $bookmark->post_id ) !== 'publish' ) {
					continue;
				}
				$has_bookmark = true;
				?>
				<tr>
					<td data-label="<?php _e( 'Bookmark', 'listable' ); ?>" width="30%">
						<?php echo '<a href="' . get_permalink( $bookmark->post_id ) . '">' . get_the_title( $bookmark->post_id ) . '</a>'; ?>
					</td>
					<td data-label="<?php _e( 'Notes', 'listable' ); ?>" width="50%"><?php echo wpautop( wp_kses_post( $bookmark->bookmark_note ) ); ?></td>
					<td>
						<ul class="job-manager-bookmark-actions">
							<?php
								$actions = apply_filters( 'job_manager_bookmark_actions', array(
									'delete' => array(
										'label' => __( 'Delete', 'wp-job-manager-bookmarks' ),
										'url'   =>  wp_nonce_url( add_query_arg( 'remove_bookmark', $bookmark->post_id ), 'remove_bookmark' )
									)
								), $bookmark );

								foreach ( $actions as $action => $value ) {
									echo '<li><a href="' . esc_url( $value['url'] ) . '" class="job-manager-bookmark-action-' . $action . '">' . $value['label'] . '</a></li>';
								}
							?>
						</ul>
					</td>
				</tr>
			<?php endforeach; ?>

			<?php if ( empty( $has_bookmark ) ) : ?>
				<tr>
					<td colspan="2"><?php _e( 'You currently have no bookmarks', 'wp-job-manager-bookmarks' ); ?></td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
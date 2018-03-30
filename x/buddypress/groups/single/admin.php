<?php

if ( bp_is_group_admin_screen( 'group-avatar' ) ) :
	$form_class = 'standard-form x-avatar-upload-form cf';
elseif ( bp_is_group_admin_screen( 'manage-members' ) ) :
	$form_class = 'standard-form x-manage-members-form cf';
elseif ( bp_is_group_admin_screen( 'forum' ) ) :
	$form_class = 'standard-form x-manage-forums-form cf';
else :
	$form_class = 'standard-form cf';
endif;

?>

<div class="x-item-list-tabs-subnav item-list-tabs no-ajax" id="subnav" role="navigation">
	<ul>
		<?php bp_group_admin_tabs(); ?>
	</ul>
</div><!-- .item-list-tabs -->

<form action="<?php bp_group_admin_form_action(); ?>" name="group-settings-form" id="group-settings-form" class="<?php echo $form_class; ?>" method="post" enctype="multipart/form-data" role="main">

<?php do_action( 'bp_before_group_admin_content' ); ?>

<?php /* Edit Group Details */ ?>
<?php if ( bp_is_group_admin_screen( 'edit-details' ) ) : ?>

	<?php do_action( 'bp_before_group_details_admin' ); ?>

	<label for="group-name"><?php _e( 'Group Name (required)', '__x__' ); ?></label>
	<input type="text" name="group-name" id="group-name" value="<?php bp_group_name(); ?>" aria-required="true" />

	<label for="group-desc"><?php _e( 'Group Description (required)', '__x__' ); ?></label>
	<textarea name="group-desc" id="group-desc" aria-required="true"><?php bp_group_description_editable(); ?></textarea>

	<?php do_action( 'groups_custom_group_fields_editable' ); ?>

	<p>
		<label for="group-notifiy-members">
			<input type="checkbox" name="group-notify-members" value="1" /> <?php _e( 'Notify group members of these changes via email', '__x__' ); ?>
		</label>
	</p>

	<?php do_action( 'bp_after_group_details_admin' ); ?>

	<input type="submit" value="<?php esc_attr_e( 'Save', '__x__' ); ?>" id="save" name="save" />
	<?php wp_nonce_field( 'groups_edit_group_details' ); ?>

<?php endif; ?>

<?php /* Manage Group Settings */ ?>
<?php if ( bp_is_group_admin_screen( 'group-settings' ) ) : ?>

	<?php do_action( 'bp_before_group_settings_admin' ); ?>

	<?php if ( bp_is_active( 'forums' ) ) : ?>

		<?php if ( bp_forums_is_installed_correctly() ) : ?>

			<div class="checkbox">
				<label><input type="checkbox" name="group-show-forum" id="group-show-forum" value="1"<?php bp_group_show_forum_setting(); ?> /> <?php _e( 'Enable discussion forum', '__x__' ); ?></label>
			</div>

			<hr />

		<?php endif; ?>

	<?php endif; ?>

	<h4><?php _e( 'Privacy Options', '__x__' ); ?></h4>

	<div class="radio">
		<label>
			<input type="radio" name="group-status" value="public"<?php bp_group_show_status_setting( 'public' ); ?> />
			<strong><?php _e( 'This is a public group', '__x__' ); ?></strong>
			<ul>
				<li><?php _e( 'Any site member can join this group.', '__x__' ); ?></li>
				<li><?php _e( 'This group will be listed in the groups directory and in search results.', '__x__' ); ?></li>
				<li><?php _e( 'Group content and activity will be visible to any site member.', '__x__' ); ?></li>
			</ul>
		</label>

		<label>
			<input type="radio" name="group-status" value="private"<?php bp_group_show_status_setting( 'private' ); ?> />
			<strong><?php _e( 'This is a private group', '__x__' ); ?></strong>
			<ul>
				<li><?php _e( 'Only users who request membership and are accepted can join the group.', '__x__' ); ?></li>
				<li><?php _e( 'This group will be listed in the groups directory and in search results.', '__x__' ); ?></li>
				<li><?php _e( 'Group content and activity will only be visible to members of the group.', '__x__' ); ?></li>
			</ul>
		</label>

		<label>
			<input type="radio" name="group-status" value="hidden"<?php bp_group_show_status_setting( 'hidden' ); ?> />
			<strong><?php _e( 'This is a hidden group', '__x__' ); ?></strong>
			<ul>
				<li><?php _e( 'Only users who are invited can join the group.', '__x__' ); ?></li>
				<li><?php _e( 'This group will not be listed in the groups directory or search results.', '__x__' ); ?></li>
				<li><?php _e( 'Group content and activity will only be visible to members of the group.', '__x__' ); ?></li>
			</ul>
		</label>
	</div>

	<h4><?php _e( 'Group Invitations', '__x__' ); ?></h4>

	<p><?php _e( 'Which members of this group are allowed to invite others?', '__x__' ); ?></p>

	<div class="radio">
		<label>
			<input type="radio" name="group-invite-status" value="members"<?php bp_group_show_invite_status_setting( 'members' ); ?> />
			<strong><?php _e( 'All group members', '__x__' ); ?></strong>
		</label>

		<label>
			<input type="radio" name="group-invite-status" value="mods"<?php bp_group_show_invite_status_setting( 'mods' ); ?> />
			<strong><?php _e( 'Group admins and mods only', '__x__' ); ?></strong>
		</label>

		<label>
			<input type="radio" name="group-invite-status" value="admins"<?php bp_group_show_invite_status_setting( 'admins' ); ?> />
			<strong><?php _e( 'Group admins only', '__x__' ); ?></strong>
		</label>
 	</div>

	<?php do_action( 'bp_after_group_settings_admin' ); ?>

	<input type="submit" value="<?php esc_attr_e( 'Save', '__x__' ); ?>" id="save" name="save" />
	<?php wp_nonce_field( 'groups_edit_group_settings' ); ?>

<?php endif; ?>

<?php /* Group Avatar Settings */ ?>
<?php if ( bp_is_group_admin_screen( 'group-avatar' ) ) : ?>

	<?php if ( 'upload-image' == bp_get_avatar_admin_step() ) : ?>

			<p><?php _e("Upload an image to use as an avatar for this group. The image will be shown on the main group page, and in search results.", '__x__' ); ?></p>

      <p>
			  <input type="file" name="file" id="file" />
			  <input type="submit" name="upload" id="upload" value="<?php esc_attr_e( 'Upload', '__x__' ); ?>" />
			  <input type="hidden" name="action" id="action" value="bp_avatar_upload" />
			</p>

			<?php if ( bp_get_group_has_avatar() ) : ?>

				<div class="x-group-delete-avatar-action">
					<?php _e( "If you'd like to remove the existing avatar but not upload a new one, please use the following link:", '__x__' ); ?>
					<?php bp_button( array( 'id' => 'delete_group_avatar', 'component' => 'groups', 'wrapper_id' => 'delete-group-avatar-button', 'link_class' => 'edit', 'link_href' => bp_get_group_avatar_delete_link(), 'link_title' => __( 'Delete Avatar', '__x__' ), 'link_text' => __( 'Delete Avatar', '__x__' ) ) ); ?>
				</div>

			<?php endif; ?>

			<?php wp_nonce_field( 'bp_avatar_upload' ); ?>

	<?php endif; ?>

	<?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>

		<h4><?php _e( 'Crop Avatar', '__x__' ); ?></h4>

		<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-to-crop" class="avatar" alt="<?php esc_attr_e( 'Avatar to crop', '__x__' ); ?>" />

		<div id="avatar-crop-pane">
			<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-crop-preview" class="avatar" alt="<?php esc_attr_e( 'Avatar preview', '__x__' ); ?>" />
		</div>

		<input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php esc_attr_e( 'Crop', '__x__' ); ?>" />

		<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src(); ?>" />
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />

		<?php wp_nonce_field( 'bp_avatar_cropstore' ); ?>

	<?php endif; ?>

<?php endif; ?>

<?php /* Manage Group Members */ ?>
<?php if ( bp_is_group_admin_screen( 'manage-members' ) ) : ?>

	<?php do_action( 'bp_before_group_manage_members_admin' ); ?>

	<div class="bp-widget">
		<h4><?php _e( 'Administrators', '__x__' ); ?></h4>

		<?php if ( bp_has_members( '&include='. bp_group_admin_ids() ) ) : ?>

		<ul id="admins-list" class="item-list single-line">

			<?php while ( bp_members() ) : bp_the_member(); ?>
			<li>

				<?php x_buddypress_members_list_item_header(); ?>

				<div class="x-list-item-meta action">
					<div class="x-list-item-meta-inner">
						<a href="<?php bp_member_permalink(); ?>"><?php _e( 'View Activity', '__x__' ); ?></a>

						<?php if ( count( bp_group_admin_ids( false, 'array' ) ) > 1 ) : ?>
							<a class="confirm admin-demote-to-member" href="<?php bp_group_member_demote_link( bp_get_member_user_id() ); ?>"><?php _e( 'Demote to Member', '__x__' ); ?></a>
						<?php endif; ?>

					</div>
				</div>
			</li>
			<?php endwhile; ?>

		</ul>

		<?php endif; ?>

	</div>

	<?php if ( bp_group_has_moderators() ) : ?>
		<div class="bp-widget">
			<h4><?php _e( 'Moderators', '__x__' ); ?></h4>

			<?php if ( bp_has_members( '&include=' . bp_group_mod_ids() ) ) : ?>
				<ul id="mods-list" class="item-list single-line">

					<?php while ( bp_members() ) : bp_the_member(); ?>
					<li>

						<?php x_buddypress_members_list_item_header(); ?>

						<div class="x-list-item-meta action">
							<div class="x-list-item-meta-inner">
								<a href="<?php bp_group_member_promote_admin_link( array( 'user_id' => bp_get_member_user_id() ) ); ?>" class="confirm mod-promote-to-admin" title="<?php esc_attr_e( 'Promote to Admin', '__x__' ); ?>"><?php _e( 'Promote to Admin', '__x__' ); ?></a>
								<a class="confirm mod-demote-to-member" href="<?php bp_group_member_demote_link( bp_get_member_user_id() ); ?>"><?php _e( 'Demote to Member', '__x__' ); ?></a>
							</div>
						</div>
					</li>
					<?php endwhile; ?>

				</ul>

			<?php endif; ?>
		</div>
	<?php endif ?>


	<div class="bp-widget">
		<h4><?php _e("Members", "__x__"); ?></h4>

		<?php if ( bp_group_has_members( 'per_page=15&exclude_banned=false' ) ) : ?>

			<?php if ( bp_group_member_needs_pagination() ) : ?>

				<div class="x-pagination pagination no-ajax">

					<div id="member-count" class="pag-count">
						<?php bp_group_member_pagination_count(); ?>
					</div>

					<div id="member-admin-pagination" class="pagination-links">
						<?php bp_group_member_admin_pagination(); ?>
					</div>

				</div>

			<?php endif; ?>

			<ul id="members-list" class="item-list single-line">
				<?php while ( bp_group_members() ) : bp_group_the_member(); ?>

					<li class="<?php bp_group_member_css_class(); ?>">

						<?php x_buddypress_members_list_item_header(); ?>

						<div class="x-list-item-meta action">
							<div class="x-list-item-meta-inner">

								<?php if ( bp_get_group_member_is_banned() ) : ?>

									<a href="<?php bp_group_member_unban_link(); ?>" class="confirm member-unban" title="<?php esc_attr_e( 'Unban this member', '__x__' ); ?>"><?php _e( 'Remove Ban', '__x__' ); ?></a>

								<?php else : ?>

									<a href="<?php bp_group_member_ban_link(); ?>" class="confirm member-ban" title="<?php esc_attr_e( 'Kick and ban this member', '__x__' ); ?>"><?php _e( 'Kick &amp; Ban', '__x__' ); ?></a>
									<a href="<?php bp_group_member_promote_mod_link(); ?>" class="confirm member-promote-to-mod" title="<?php esc_attr_e( 'Promote to Mod', '__x__' ); ?>"><?php _e( 'Promote to Mod', '__x__' ); ?></a>
									<a href="<?php bp_group_member_promote_admin_link(); ?>" class="confirm member-promote-to-admin" title="<?php esc_attr_e( 'Promote to Admin', '__x__' ); ?>"><?php _e( 'Promote to Admin', '__x__' ); ?></a>

								<?php endif; ?>

									<a href="<?php bp_group_member_remove_link(); ?>" class="confirm" title="<?php esc_attr_e( 'Remove this member', '__x__' ); ?>"><?php _e( 'Remove from group', '__x__' ); ?></a>

									<?php do_action( 'bp_group_manage_members_admin_item' ); ?>

							</div>
						</div>
					</li>

				<?php endwhile; ?>
			</ul>

		<?php else: ?>

			<div id="message" class="info mbn">
				<p><?php _e( 'This group has no members.', '__x__' ); ?></p>
			</div>

		<?php endif; ?>

	</div>

	<?php do_action( 'bp_after_group_manage_members_admin' ); ?>

<?php endif; ?>

<?php /* Manage Membership Requests */ ?>
<?php if ( bp_is_group_admin_screen( 'membership-requests' ) ) : ?>

	<?php do_action( 'bp_before_group_membership_requests_admin' ); ?>

		<div class="requests">

			<?php bp_get_template_part( 'groups/single/requests-loop' ); ?>

		</div>

	<?php do_action( 'bp_after_group_membership_requests_admin' ); ?>

<?php endif; ?>

<?php do_action( 'groups_custom_edit_steps' ) // Allow plugins to add custom group edit screens ?>

<?php /* Delete Group Option */ ?>
<?php if ( bp_is_group_admin_screen( 'delete-group' ) ) : ?>

	<?php do_action( 'bp_before_group_delete_admin' ); ?>

	<div id="message" class="error">
		<p><?php _e( 'WARNING: Deleting this group will completely remove ALL content associated with it. There is no way back, please be careful with this option.', '__x__' ); ?></p>
	</div>

	<p><label><input type="checkbox" name="delete-group-understand" id="delete-group-understand" value="1" onclick="if(this.checked) { document.getElementById('delete-group-button').disabled = ''; } else { document.getElementById('delete-group-button').disabled = 'disabled'; }" /> <?php _e( 'I understand the consequences of deleting this group.', '__x__' ); ?></label></p>

	<?php do_action( 'bp_after_group_delete_admin' ); ?>

	<input type="submit" disabled="disabled" value="<?php esc_attr_e( 'Delete', '__x__' ); ?>" id="delete-group-button" name="delete-group-button" />

	<?php wp_nonce_field( 'groups_delete_group' ); ?>

<?php endif; ?>

<?php /* This is important, don't forget it */ ?>
	<input type="hidden" name="group-id" id="group-id" value="<?php bp_group_id(); ?>" />

<?php do_action( 'bp_after_group_admin_content' ); ?>

</form><!-- #group-settings-form -->


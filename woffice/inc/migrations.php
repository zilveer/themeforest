<?php
/**
 * MIGRATIONS FILE
 * There will be placed all functions that handle the migrations from one older version to a more recent one.
 * Every function put an int incremental value starting from 1, in this way is possible to check how much functions have to be runned
 *
 */

/**
 * This function handle the migrations functions, in this way we get the value from the db only one time
 * also if we have many migrations functions to run
 */
function woffice_handle_migrations(){

    //Get the flag from the db
    $migration_flag = get_option('woffice_migration_flag');

    //if the flag doesn't exist
    if($migration_flag == false) {
        woffice_migration_to_v19_permission_changes();
    }

    if($migration_flag < 2) {
        woffice_migration_to_v191_permission_changes();
    }

}
add_action('after_setup_theme', 'woffice_handle_migrations');

/**
* Handle the migration to Woffice 1.9, many settings about permission are changed and this function handle the old settings
* for users who already use a verion older then 1.9
*/
function woffice_migration_to_v19_permission_changes(){

    /* Start section "Who can edit this post" */
    $wiki_create = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('wiki_create') : '';
    $post_create = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('post_create') : '';

    if(function_exists( 'fw_set_db_settings_option' ) ) {
        fw_set_db_settings_option('wiki_edit', $wiki_create);
        fw_set_db_settings_option('post_edit', $post_create);
    }
    /* End section "Who can edit this post" */

    /* Start section: add specific capabilities*/

    $wiki_caps_flag = get_option('woffice_wiki_caps_flag');

    //Check if the caps are assigned already one time, in order to avoid to override the changes of the user
    //Should be impossible here because in this migration is the first time that the caps are added, but always check it to be more safe)
    if($wiki_caps_flag != 1) {
        //Assign caps to Editor
        $role = get_role('editor');

        $role->add_cap('woffice_edit_wikies');
        $role->add_cap('woffice_edit_others_wikies');
        $role->add_cap('woffice_edit_private_wikies');
        $role->add_cap('woffice_edit_published_wikies');
        $role->add_cap('woffice_delete_wikies');
        $role->add_cap('woffice_delete_others_wikies');
        $role->add_cap('woffice_delete_private_wikies');
        $role->add_cap('woffice_delete_published_wikies');
        $role->add_cap('woffice_publish_wikies');
        $role->add_cap('woffice_read_private_wikies');

        //Assign caps to Author
        $role = get_role('author');

        $role->add_cap('woffice_delete_wikies');
        $role->add_cap('woffice_delete_published_wikies');
        $role->add_cap('woffice_edit_wikies');
        $role->add_cap('woffice_edit_published_wikies');
        $role->add_cap('woffice_publish_wikies');

        //Assign caps to Contributor
        $role = get_role('contributor');

        $role->add_cap('woffice_edit_wikies');
        $role->add_cap('woffice_delete_wikies');

        //Add/Update the flag
        update_option('woffice_wiki_caps_flag', 1);
    }
    /* End section: add specific capabilities*/

    //Add/Update the flag
    update_option('woffice_migration_flag', 1);

}

/**
 * Handle the migration to Woffice 1.9.1, here is added the capability woffice_read_wikies
 */
function woffice_migration_to_v191_permission_changes(){

    //Assign caps to Administrator
    $role = get_role('administrator');
	//This prevent a fatal error. Should never happens, but one time is happened for one customer
	if(!empty($role)) {
		$role->add_cap( 'woffice_read_wikies' );
		$role->add_cap( 'woffice_edit_wikies' );
		$role->add_cap( 'woffice_edit_others_wikies' );
		$role->add_cap( 'woffice_edit_private_wikies' );
		$role->add_cap( 'woffice_edit_published_wikies' );
		$role->add_cap( 'woffice_delete_wikies' );
		$role->add_cap( 'woffice_delete_others_wikies' );
		$role->add_cap( 'woffice_delete_private_wikies' );
		$role->add_cap( 'woffice_delete_published_wikies' );
		$role->add_cap( 'woffice_publish_wikies' );
		$role->add_cap( 'woffice_read_private_wikies' );
	}

    //Assign caps to Editor
    $role = get_role('editor');
	if(!empty($role))
        $role->add_cap('woffice_read_wikies');

    //Assign caps to Author
    $role = get_role('author');
	if(!empty($role))
        $role->add_cap('woffice_read_wikies');

    //Assign caps to Contributor
    $role = get_role('contributor');
	if(!empty($role))
        $role->add_cap('woffice_read_wikies');

    update_option('woffice_wiki_caps_flag', 1);

    update_option('woffice_migration_flag', 2);
}

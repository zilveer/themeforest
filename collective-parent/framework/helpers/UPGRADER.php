<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

if (!class_exists('WP_Upgrader'))
    require ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

class TF_Bulk_Theme_Upgrader_Skin extends Bulk_Theme_Upgrader_Skin {
    function before($title = '') {
        Bulk_Upgrader_Skin::before( $this->pk_name );
    }

    function after($title = '') {
        Bulk_Upgrader_Skin::after( $this->pk_name );
    }
}

class TF_Theme_Upgrader extends Theme_Upgrader {

    function upgrade_strings() {
        parent::upgrade_strings();
        $this->strings['skin_before_update_header'] = __('Updating %1$s (%2$d/%3$d)', 'tfuse');
        $this->strings['up_to_date'] = __('The package is at the latest version.', 'tfuse');
        $this->strings['remove_old'] = __('Removing the old version of the %s&#8230;', 'tfuse');
        $this->strings['remove_old_failed'] = __('Could not remove the old version of the ', 'tfuse');
        $this->strings['process_failed'] = __('Update failed.', 'tfuse');
        $this->strings['process_success'] = __('Package updated successfully.', 'tfuse');
        $this->strings['tf_backup'] = __('Backing up files&#8230;', 'tfuse');
        $this->strings['tf_bk_mkdir_failed'] = __('Could not create backup directory.', 'tfuse');
    }

    function bulk_footer() {
        $update_actions = array(
            'framework_page' => '<a href="' . self_admin_url('admin.php?page=themefuse') . '" title="' . esc_attr__('Go to framework page', 'tfuse') . '" target="_parent">' . __('Return to Framework page', 'tfuse') . '</a>',
        );
        return $update_actions;
    }

    function fs_connect($directories = array()) {
        global $wp_filesystem;
        if (false === ($credentials = $this->skin->request_filesystem_credentials()))
            return false;
        if (!WP_Filesystem($credentials)) {
            $error = true;
            if (is_object($wp_filesystem) && $wp_filesystem->errors->get_error_code())
                $error = $wp_filesystem->errors;
            $this->skin->request_filesystem_credentials($error); //Failed to connect, Error and request again
            return false;
        }

        if (!is_object($wp_filesystem))
            return new WP_Error('fs_unavailable', $this->strings['fs_unavailable']);

        if (is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->get_error_code())
            return new WP_Error('fs_error', $this->strings['fs_error'], $wp_filesystem->errors);

        foreach ((array) $directories as $dir) {
            switch ($dir) {
                case ABSPATH:
                    if (!$wp_filesystem->abspath())
                        return new WP_Error('fs_no_root_dir', $this->strings['fs_no_root_dir']);
                    break;
                case WP_CONTENT_DIR:
                    if (!$wp_filesystem->wp_content_dir())
                        return new WP_Error('fs_no_content_dir', $this->strings['fs_no_content_dir']);
                    break;
                case WP_PLUGIN_DIR:
                    if (!$wp_filesystem->wp_plugins_dir())
                        return new WP_Error('fs_no_plugins_dir', $this->strings['fs_no_plugins_dir']);
                    break;
                case WP_CONTENT_DIR . '/themes':
                    if (!$wp_filesystem->find_folder(WP_CONTENT_DIR . '/themes'))
                        return new WP_Error('fs_no_themes_dir', $this->strings['fs_no_themes_dir']);
                    break;
                default:
                    //error here
                    if (!$wp_filesystem->find_folder($dir))
                        if (!$wp_filesystem->mkdir($dir, FS_CHMOD_DIR))
                            return new WP_Error('fs_no_folder', sprintf($this->strings['fs_no_folder'], $dir));
                    break;
            }
        }
        return true;
    }

    function install_package($args = array()) {
        global $wp_filesystem;

        $defaults = array('source' => '', 'destination' => '', //Please always pass these
            'clear_destination' => false, 'clear_working' => false,
            'hook_extra' => array());

        $args = wp_parse_args($args, $defaults);
        extract($args);

        @set_time_limit(300);

        if (empty($source) || empty($destination))
            return new WP_Error('bad_request', $this->strings['bad_request']);

        $this->skin->feedback('installing_package');

        $res = apply_filters('upgrader_pre_install', true, $hook_extra);
        if (is_wp_error($res))
            return $res;

        //Retain the Original source and destinations
        $remote_source = $source;
        $local_destination = $destination;

        $source_files = array_keys($wp_filesystem->dirlist($remote_source));
        $remote_destination = $wp_filesystem->find_folder($local_destination);

        //Locate which directory to copy to the new folder, This is based on the actual folder holding the files.
        if (1 == count($source_files) && $wp_filesystem->is_dir(trailingslashit($source) . $source_files[0] . '/')) //Only one folder? Then we want its contents.
            $source = trailingslashit($source) . trailingslashit($source_files[0]);
        elseif (count($source_files) == 0)
            return new WP_Error('incompatible_archive', $this->strings['incompatible_archive']); //There are no files?
        //else //Its only a single file, The upgrader will use the foldername of this file as the destination folder. foldername is based on zip filename.
        //Hook ability to change the source file location..
        $source = apply_filters('upgrader_source_selection', $source, $remote_source, $this);
        if (is_wp_error($source))
            return $source;
        //Has the source location changed? If so, we need a new source_files list.
        if ($source !== $remote_source)
            $source_files = array_keys($wp_filesystem->dirlist($source));

        //Protection against deleting files in any important base directories.
        if (in_array($destination, array(ABSPATH, WP_CONTENT_DIR, WP_PLUGIN_DIR, WP_CONTENT_DIR . '/themes'))) {
            $remote_destination = trailingslashit($remote_destination) . trailingslashit(basename($source));
            $destination = trailingslashit($destination) . trailingslashit(basename($source));
        }

        // ThemeFuse Note: permitem stergea folderlelor framework, theme_config ...
        // dar nu permitem stergerea fisiereleor din tema, templaturile le vom scri peste, fara sa le stergem

        $template_location = trailingslashit($wp_filesystem->find_folder(WP_CONTENT_DIR . '/themes/' . get_template()));
        if ($clear_destination && $remote_destination !== $template_location) {
            //We're going to clear the destination if there's something there
            $this->skin->feedback('remove_old', $hook_extra['theme']);
            $removed = true;
            if ($wp_filesystem->exists($remote_destination))
                $removed = $wp_filesystem->delete($remote_destination, true);
            $removed = apply_filters('upgrader_clear_destination', $removed, $local_destination, $remote_destination, $hook_extra);

            if (is_wp_error($removed))
                return $removed;
            else if (!$removed)
                return new WP_Error('remove_old_failed', $this->strings['remove_old_failed']);
        } elseif ($wp_filesystem->exists($remote_destination) && $remote_destination != $template_location) {
            //If we're not clearing the destination folder and something exists there already, Bail.
            //But first check to see if there are actually any files in the folder.
            $_files = $wp_filesystem->dirlist($remote_destination);
            if (!empty($_files)) {
                $wp_filesystem->delete($remote_source, true); //Clear out the source files.
                return new WP_Error('folder_exists', $this->strings['folder_exists'], $remote_destination);
            }
        }
        //Create destination if needed
        if (!$wp_filesystem->exists($remote_destination)) {
        //if (!$wp_filesystem->find_folder(untrailingslashit($remote_destination))) {
            if (!$wp_filesystem->mkdir($remote_destination, FS_CHMOD_DIR)) {
                return new WP_Error('mkdir_failed', $this->strings['mkdir_failed'], $remote_destination);
            }
        }

        // Copy new version of item into place.
        $result = copy_dir($source, $remote_destination);
        if (is_wp_error($result)) {
            if ($clear_working)
                $wp_filesystem->delete($remote_source, true);
            return $result;
        }

        //Clear the Working folder?
        if ($clear_working)
            $wp_filesystem->delete($remote_source, true);

        $destination_name = basename(str_replace($local_destination, '', $destination));
        if ('.' == $destination_name)
            $destination_name = '';

        $this->result = compact('local_source', 'source', 'source_name', 'source_files', 'destination', 'destination_name', 'local_destination', 'remote_destination', 'clear_destination', 'delete_source_dir');

        $res = apply_filters('upgrader_post_install', true, $hook_extra, $this->result);
        if (is_wp_error($res)) {
            $this->result = $res;
            return $res;
        }

        //Bombard the calling function will all the info which we've just used.
        return $this->result;
    }

    function bulk_upgrade($updates, $args = array()) {

        $this->init();
        $this->bulk = true;
        $this->upgrade_strings();

        $current = get_site_transient('themefuse-update');

        add_filter('update_bulk_theme_complete_actions', array($this, 'bulk_footer'));

        $this->skin->header();
        // Connect to the Filesystem first.
        $res = $this->fs_connect(array(WP_CONTENT_DIR));
        if (!$res) {
            $this->skin->footer();
            return false;
        }

        $this->skin->bulk_header();
        $this->maintenance_mode(true);

        // TFUSE: bakup files before update
        add_filter('upgrader_pre_install', array($this, 'tfuse_backup_before_update'));

        $results = array();

        $this->update_count = count($updates);
        $this->update_current = 0;
        foreach ($updates as $update) {
            $this->update_current++;

            if (!isset($current->response[TF_THEME_PREFIX][$update])) {
                $this->skin->set_result(false);
                $this->skin->before();
                $this->skin->error('up_to_date');
                $this->skin->after();
                $results[$update] = false;
                continue;
            }

            $theme = get_template();
            $this->skin->theme_info = $this->theme_info($theme);
            $this->skin->pk_name = $update;

            // Get the URL to the zip file
            $r = $current->response[TF_THEME_PREFIX][$update];

            $dest = !empty($r['dest']) ? $r['dest'] : '';

            $options = array(
                'package' => $r['package'],
                'destination' => WP_CONTENT_DIR . '/themes/' . $theme . $dest,
                'clear_destination' => true,
                'clear_working' => true,
                'hook_extra' => array(
                    'theme' => $update
                )
            );

            $result = $this->run($options);

            $results[$update] = $this->result;
            unset($this->skin->result);

            // Prevent credentials auth screen from displaying multiple times
            if (false === $result)
                break;
        } //end foreach $plugins

        $this->maintenance_mode(false);

        $this->skin->bulk_footer();

        $this->skin->footer();

        // Force refresh of theme update information
        delete_site_transient('themefuse-update');

        return $results;
    }

    function tfuse_backup_before_update () {
        global $wp_filesystem, $tf_bk_created;

        if($tf_bk_created)
            return true;

        $this->skin->feedback('tf_backup');
        $template = get_template();
        $source_folder = $wp_filesystem->wp_content_dir() . 'themes/' . $template;
        //in cazul cind get_template() returneaza medica/medica-parent nu poate crea 2 nivele de foldere
        $template_folders = explode('/',$template);
        $template = !empty($template_folders[0]) ? $template_folders[0] : $template;
        $tf_bk_folder = $wp_filesystem->wp_content_dir() . 'tfuse_bk_' . $template . '_' . date('Y-m-d');

        //Create destination if needed
        if (!$wp_filesystem->exists($tf_bk_folder)) {
        //if (!$wp_filesystem->find_folder(untrailingslashit($tf_bk_folder))) {
            if (!$wp_filesystem->mkdir($tf_bk_folder, FS_CHMOD_DIR)) {
                return new WP_Error('mkdir_failed', $this->strings['tf_bk_mkdir_failed'], $tf_bk_folder);
            }
        }

        // Backup files.
        $result = copy_dir($source_folder, $tf_bk_folder, array('cache','install'));
        if (is_wp_error($result))
            return $result;

        $tf_bk_created = true;
        return true;
    }

}

?>
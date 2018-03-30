<?php

/**
 * Demo importer. Import all settings post page and images 
 * @time-author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
define('debug', false);
/**
 * Demo importer
 *
 * @author JaW Templates
 * @version 1.0
 * 
 * Pro export WIDGETŮ  použít http://wordpress.org/extend/plugins/widget-settings-importexport/
 * více v readme
 */
if (!class_exists('jwDemoImport')) {

    class jwDemoImport {

        private $widgets = array();
        private $_ids_cat = array();
        private $_ids_menus = array();
        private $_ids_nav_menu = array();

        function __construct($filename = 'default') {
            // Load Importer API
            if (!defined('FS_METHOD')) {
                define('FS_METHOD', 'direct');
            }

            load_template(ABSPATH . 'wp-admin/includes/import.php');
            load_template(ABSPATH . 'wp-admin/includes/post.php');
            load_template(ABSPATH . 'wp-admin/includes/comment.php');
            load_template(ABSPATH . 'wp-admin/includes/taxonomy.php');
            load_template(ABSPATH . 'wp-admin/includes/file.php');

            if (!class_exists('WP_Importer')) {
                $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
                if (file_exists($class_wp_importer))
                    require $class_wp_importer;
            }

            $this->fetch_attachments = true;

            $this->import($filename);
        }

        function bindWidgets($widget) {
            $this->widgets[] = $widget;
        }

        function import($filename) {
            $post_skip = 0;
            if (isset($_POST['post_skip'])) {
                $post_skip = $_POST['post_skip'];
            }

            if (get_option('demo-' . THEMENAME) == null || isset($_GET['post_skip'])) {
                $type = "data";
            } else {
                $type = "preset";
            }

            $file = get_template_directory() . '/demo/' . $filename . '.xml';


            add_filter('import_post_meta_key', array(&$this, 'is_valid_meta_key'));
            add_filter('http_request_timeout', array(&$this, 'bump_request_timeout'));

            if ($type == 'data') {
                $this->import_checker();
            }

            $this->import_start($file);

            if ($type == 'data') {
                if ($post_skip == 0) {
                    $this->get_author_mapping();
                    wp_suspend_cache_invalidation(true);
                    $this->process_categories();
                    $this->process_tags();
                    $this->process_terms();
                    $this->process_term_locations();
                    $this->process_posts($post_skip);
                } else {
                    $this->process_posts($post_skip);
                }

                wp_suspend_cache_invalidation(false);

                // update incorrect/missing information in the DB
                $this->backfill_parents();

                $this->backfill_attachment_urls();
                $this->remap_featured_images();
                //echo 'Done - DATA.';
            }

            $this->process_options();

            $this->import_data_end();

            if ($type == 'data') {
                //IMPORT WIDGET
                $this->json = $this->get_widget_settings_json(get_template_directory() . '/demo/' . $filename . '.json');
                $this->json_data = $this->json[0];
                $this->json_file = $this->json[1];
                $this->parse_import_data($this->json_data);
                //echo '<p>Widgets done.</p>';

                echo 'done';
                if (is_plugin_active('revslider/revslider.php')) {
                    $this->import_revslider();
                    // echo '<p>Revolution slider done.</p>';
                } else {
                    // echo '<p>Plugin: Revolution slider isn`t installed</p>';
                }
            }

            $this->import_end($filename);
        }

        function import_checker() {
            $memory_limit = $this->convertPHPSizeToBytes(ini_get('memory_limit'));
            $max_execution_time = $this->convertPHPSizeToBytes(ini_get('max_execution_time'));
            $upload_max_filesize = $this->convertPHPSizeToBytes(ini_get('upload_max_filesize'));
            $err = false;
            if ($memory_limit < 50000000) {
                if ($memory_limit == (int)-1) {
                    $err = false;
                } else {
                    $err = true;
                    echo 'WARNING: PHP value "memory_limit" in your php.ini file is too low. Please contact your hosting service to increase this value to 64M at least. Actual value is: ' . $memory_limit;
                    echo '\\n\\n';
                }
            }
            if ($max_execution_time < 30) {
                if ($max_execution_time == (int)-1 || $max_execution_time == (int) 0) {
                    $err = false;
                } else {
                    $err = true;
                    echo 'WARNING: PHP value "max_execution_time" in your php.ini file is too low. Please contact your hosting service to increase this value to 30 at least. Actual value is: ' . $max_execution_time;
                    echo '\\n\\n';
                }
            }
            if ($upload_max_filesize < 6000000) {
                $err = true;
                echo 'WARNING: PHP value "upload_max_filesize" in your php.ini file is too low. Please contact your hosting service to increase this value to 6M at least. Actual value is: ' . $upload_max_filesize;
                echo '\\n\\n';
            }
            if ($err) {
                die();
            }
        }

        function convertPHPSizeToBytes($sSize) {
            if (is_numeric($sSize)) {
                return $sSize;
            }
            $sSuffix = substr($sSize, -1);
            $iValue = substr($sSize, 0, -1);
            switch (strtoupper($sSuffix)) {
                case 'P':
                    $iValue *= 1024;
                case 'T':
                    $iValue *= 1024;
                case 'G':
                    $iValue *= 1024;
                case 'M':
                    $iValue *= 1024;
                case 'K':
                    $iValue *= 1024;
                    break;
            }
            return $iValue;
        }

        /**
         * Parses the WXR file and prepares us for the task of processing parsed data
         *
         * @param string $file Path to the WXR file for importing
         */
        function import_start($file) {
            if (!is_file($file)) {
                echo 'Sorry, there has been an error.\n';
                echo 'The file does not exist, please try again.';
                $this->footer();
                die('error');
            }

            $import_data = $this->parse($file);


            if (is_wp_error($import_data)) {

                echo 'Sorry, there has been an error.\n';
                echo esc_html($import_data->get_error_message()) . '';
                $this->footer();
                die('error');
            }
            $this->version = $import_data['version'];
            $this->get_authors_from_import($import_data);
            $this->posts = $import_data['posts'];
            $this->terms = $import_data['terms'];
            $this->term_locations = $import_data['term_locations'];
            $this->categories = $import_data['categories'];
            $this->tags = $import_data['tags'];
            $this->base_url = esc_url($import_data['base_url']);
            $this->opt_categories = $import_data['opt_categories'];
            $this->opt_menus = $import_data['opt_menus'];
            $this->opt_options = $import_data['opt_options'];
            $this->opt_builder = $import_data['opt_builder'];
            $this->opt_menu_location = $import_data['opt_menu_location'];
            $this->revslider = $import_data['revslider'];
            $this->front_page = $import_data['front_page'];

            wp_defer_term_counting(true);
            wp_defer_comment_counting(true);

            do_action('import_start');
        }

        function import_data_end() {

            wp_cache_flush();
            foreach (get_taxonomies() as $tax) {
                delete_option("{$tax}_children");
                _get_term_hierarchy($tax);
            }

            wp_defer_term_counting(false);
            wp_defer_comment_counting(false);
        }

        /**
         * Performs post-import cleanup of files and the cache
         */
        function import_end($filename) {

            jwOpt::refresh_options();

            $jwStyle = new jwStyle();
            $jwStyle->get_static();

            echo 'done';


            update_option('demo-' . THEMENAME, $filename);
            if (debug) {
                $type = "data";
            }

            do_action('import_end');
            die('end');
        }

        /**
         * Retrieve authors from parsed WXR data
         *
         * Uses the provided author information from WXR 1.1 files
         * or extracts info from each post for WXR 1.0 files
         *
         * @param array $import_data Data returned by a WXR parser
         */
        function get_authors_from_import($import_data) {
            if (!empty($import_data['authors'])) {
                $this->authors = $import_data['authors'];
                // no author information, grab it from the posts
            } else {
                foreach ($import_data['posts'] as $post) {
                    $login = sanitize_user($post['post_author'], true);
                    if (empty($login)) {
                        if (debug == true) {
                            printf('Failed to import author %s. Their posts will be attributed to the current user.', esc_html($post['post_author']));

                            continue;
                        }
                    }

                    if (!isset($this->authors[$login]))
                        $this->authors[$login] = array(
                            'author_login' => $login,
                            'author_display_name' => $post['post_author']
                        );
                }
            }
        }

        /**
         * Map old author logins to local user IDs based on decisions made
         * in import options form. Can map to an existing user, create a new user
         * or falls back to the current user in case of error with either of the previous
         */
        function get_author_mapping() {
            if (!isset($_POST['imported_authors']))
                return;

            $create_users = $this->allow_create_users();

            foreach ((array) $_POST['imported_authors'] as $i => $old_login) {
                // Multisite adds strtolower to sanitize_user. Need to sanitize here to stop breakage in process_posts.
                $santized_old_login = sanitize_user($old_login, true);
                $old_id = isset($this->authors[$old_login]['author_id']) ? intval($this->authors[$old_login]['author_id']) : false;

                if (!empty($_POST['user_map'][$i])) {
                    $user = get_userdata(intval($_POST['user_map'][$i]));
                    if (isset($user->ID)) {
                        if ($old_id)
                            $this->processed_authors[$old_id] = $user->ID;
                        $this->author_mapping[$santized_old_login] = $user->ID;
                    }
                } else if ($create_users) {
                    if (!empty($_POST['user_new'][$i])) {
                        $user_id = wp_create_user($_POST['user_new'][$i], wp_generate_password());
                    } else if ($this->version != '1.0') {
                        $user_data = array(
                            'user_login' => $old_login,
                            'user_pass' => wp_generate_password(),
                            'user_email' => isset($this->authors[$old_login]['author_email']) ? $this->authors[$old_login]['author_email'] : '',
                            'display_name' => $this->authors[$old_login]['author_display_name'],
                            'first_name' => isset($this->authors[$old_login]['author_first_name']) ? $this->authors[$old_login]['author_first_name'] : '',
                            'last_name' => isset($this->authors[$old_login]['author_last_name']) ? $this->authors[$old_login]['author_last_name'] : '',
                        );
                        $user_id = wp_insert_user($user_data);
                    }

                    if (!is_wp_error($user_id)) {
                        if ($old_id)
                            $this->processed_authors[$old_id] = $user_id;
                        $this->author_mapping[$santized_old_login] = $user_id;
                    } else {
                        if (debug == true) {
                            printf('Failed to create new user for %s. Their posts will be attributed to the current user.', esc_html($this->authors[$old_login]['author_display_name']));
                            if (defined('IMPORT_DEBUG') && IMPORT_DEBUG)
                                echo ' ' . $user_id->get_error_message();
                        }
                    }
                }

                // failsafe: if the user_id was invalid, default to the current user
                if (!isset($this->author_mapping[$santized_old_login])) {
                    if ($old_id)
                        $this->processed_authors[$old_id] = (int) get_current_user_id();
                    $this->author_mapping[$santized_old_login] = (int) get_current_user_id();
                }
            }
        }

        /**
         * Create new categories based on import information
         *
         * Doesn't create a new category if its slug already exists
         */
        function process_categories() {
            if (empty($this->categories))
                return;

            foreach ($this->categories as $cat) {
                // if the category already exists leave it alone
                $term_id = term_exists($cat['category_nicename'], 'category');
                if ($term_id) {
                    if (is_array($term_id))
                        $term_id = $term_id['term_id'];
                    if (isset($cat['term_id']))
                        $this->processed_terms[intval($cat['term_id'])] = (int) $term_id;
                    $this->_ids_cat[$cat['term_id']] = (int) $term_id;
                    continue;
                }

                $category_parent = empty($cat['category_parent']) ? 0 : category_exists($cat['category_parent']);
                $category_description = isset($cat['category_description']) ? $cat['category_description'] : '';
                $catarr = array(
                    'category_nicename' => $cat['category_nicename'],
                    'category_parent' => $category_parent,
                    'cat_name' => $cat['cat_name'],
                    'category_description' => $category_description
                );

                $id = wp_insert_category($catarr);
                $this->_ids_cat[$cat['term_id']] = $id;

                if (!is_wp_error($id)) {
                    if (isset($cat['term_id']))
                        $this->processed_terms[intval($cat['term_id'])] = $id;
                } else {
                    if (debug == true) {
                        printf('Failed to import category %s', esc_html($cat['category_nicename']));
                        if (defined('IMPORT_DEBUG') && IMPORT_DEBUG)
                            echo ': ' . $id->get_error_message();
                        echo '<br />';
                        continue;
                    }
                }
            }
        }

        function process_options() {
            // categories 

            if (!empty($this->_ids_cat)) {
                update_option('_ids_cat', serialize($this->_ids_cat));
            } else {
                $this->_ids_cat = unserialize(get_option('_ids_cat'));
            }
            if (!empty($this->_ids_nav_menu)) {
                update_option('_ids_nav_menu', serialize($this->_ids_nav_menu));
            } else {
                $this->_ids_nav_menu = unserialize(get_option('_ids_nav_menu'));
            }



            if (isset($this->opt_categories[0])) {
                $cat = get_option(CATEGORIES);
                $cat['backup_log'] = date('r');
                update_option(CATEGORIES . BACKUPS, $cat);


                $otp_cat_unserial = unserialize($this->opt_categories[0]);
                $opt_cat_new = array();

                foreach ($otp_cat_unserial as $key => $cat) {
                    $id = str_replace('category_', '', $key);
                    if (isset($this->_ids_cat[$id])) {
                        $opt_cat_new["category_" . $this->_ids_cat[$id]] = $cat;
                    }
                }

                update_option(CATEGORIES, $opt_cat_new);
            }

            // theme 
            if (isset($this->opt_options[0])) {
                $cat = get_option(OPTIONS);
                $cat['backup_log'] = date('r');
                update_option(OPTIONS . BACKUPS, $cat);
                update_option(OPTIONS, unserialize($this->opt_options[0]));
            }

            //PageBuilder presets
            if (isset($this->opt_builder[0])) {
                $cat = get_option(BUILDER);

                update_option(BUILDER . BACKUPS, $cat);
                update_option(BUILDER, unserialize($this->opt_builder[0]));
            }

            //Jaw menu location
            if (isset($this->opt_menu_location[0])) {
                $cat = get_option('jaw-menu-location');
                $cat['backup_log'] = date('r');
                update_option('jaw-menu-location' . BACKUPS, $cat);
                update_option('jaw-menu-location', unserialize($this->opt_menu_location[0]));
            }
            if (isset($this->front_page[0])) {
                foreach ($this->front_page[0] as $key => $val) {

                    update_option($key, (string) $val);
                }
            }


            // echo '<p>Presets done.</p>';
        }

        /**
         * Create new post tags based on import information
         *
         * Doesn't create a tag if its slug already exists
         */
        function process_tags() {
            if (empty($this->tags))
                return;

            foreach ($this->tags as $tag) {
                // if the tag already exists leave it alone
                $term_id = term_exists($tag['tag_slug'], 'post_tag');
                if ($term_id) {
                    if (is_array($term_id))
                        $term_id = $term_id['term_id'];
                    if (isset($tag['term_id']))
                        $this->processed_terms[intval($tag['term_id'])] = (int) $term_id;
                    continue;
                }

                $tag_desc = isset($tag['tag_description']) ? $tag['tag_description'] : '';
                $tagarr = array('slug' => $tag['tag_slug'], 'description' => $tag_desc);

                $id = wp_insert_term($tag['tag_name'], 'post_tag', $tagarr);
                if (!is_wp_error($id)) {
                    if (isset($tag['term_id']))
                        $this->processed_terms[intval($tag['term_id'])] = $id['term_id'];
                } else {
                    if (debug == true) {
                        printf('Failed to import post tag %s', esc_html($tag['tag_name']));
                        if (defined('IMPORT_DEBUG') && IMPORT_DEBUG)
                            echo ': ' . $id->get_error_message();
                        echo '<br />';
                        continue;
                    }
                }
            }

            unset($this->tags);
        }

        /**
         * Create new terms based on import information
         *
         * Doesn't create a term its slug already exists
         */
        function process_terms() {
            if (debug == true) {
                echo 'Terms: ';
            }
            if (empty($this->terms)) {
                return;
            }

            if ($this->terms instanceof WP_Error) {
                return;
            }

            foreach ($this->terms as $term) {
                // if the term already exists in the correct taxonomy leave it alone
                if (!taxonomy_exists($term['term_taxonomy'])) {
                    continue;
                }

                $term_id = term_exists($term['slug'], $term['term_taxonomy']);

                $this->_ids_menus[$term['term_id']] = $term_id['term_id'];
                if ($term_id) {
                    if (is_array($term_id))
                        $term_id = $term_id['term_id'];
                    if (isset($term['term_id']))
                        $this->processed_terms[intval($term['term_id'])] = (int) $term_id;
                    $this->_ids_cat[$term['term_id']] = $term['term_id'];
                    continue;
                }


                if (empty($term['term_parent'])) {
                    $parent = 0;
                } else {
                    $parent = term_exists($term['term_parent'], $term['term_taxonomy']);
                    if (is_array($parent))
                        $parent = $parent['term_id'];
                }
                $description = isset($term['term_description']) ? $term['term_description'] : '';
                $termarr = array('slug' => $term['slug'], 'description' => $description, 'parent' => intval($parent));

                $id = wp_insert_term($term['term_name'], $term['term_taxonomy'], $termarr);
                $this->_ids_cat[$term['term_id']] = $id['term_id'];

                if (debug) {
                    echo 'New term: ' . $id['term_id'];
                    echo '<br>';
                }

                $this->_ids_menus[$term['term_id']] = $id['term_id'];
                if (!is_wp_error($id)) {
                    if (isset($term['term_id']))
                        $this->processed_terms[intval($term['term_id'])] = $id['term_id'];
                } else {
                    if (debug == true) {
                        printf('Failed to import %s %s', esc_html($term['term_taxonomy']), esc_html($term['term_name']));
                        if (defined('IMPORT_DEBUG') && IMPORT_DEBUG)
                            echo ': ' . $id->get_error_message();
                        echo '<br />';
                        continue;
                    }
                }
            }

            unset($this->terms);
        }

        /**
         * Change term location 
         *
         */
        function process_term_locations() {

            if (empty($this->term_locations))
                return;

            foreach ($this->term_locations as $term_key => $term_loc_id) {
                if (isset($this->_ids_menus[$term_loc_id])) {
                    $array_term_loc[$term_key] = (int) $this->_ids_menus[$term_loc_id];
                    set_theme_mod('nav_menu_locations', $array_term_loc);
                }
            }

            unset($this->term_locations);
        }

        /**
         * Create new posts based on import information
         *
         * Posts marked as having a parent which doesn't exist will become top level items.
         * Doesn't create a new post if: the post type doesn't exist, the given post ID
         * is already noted as imported or a post with the same title and date already exists.
         * Note that new/updated terms, comments and meta are imported for the last of the above.
         */
        function process_posts($post_skip) {

            $number_of_posts = sizeof($this->posts);
            $i = 0;


            foreach ($this->posts as $post) {
                if ($i < $post_skip) {
                    $i++;
                    continue;
                }

                if (($i != $post_skip) && ($i % round($number_of_posts / 1) == 0)) {
                    echo $i;
                    die();
                }
                $i++;

                if (!post_type_exists($post['post_type'])) {
                    if (debug == true) {
                        printf('Failed to import &#8220;%s&#8221;: Invalid post type %s', esc_html($post['post_title']), esc_html($post['post_type']));
                        echo '<br />';
                        continue;
                    }
                }

                if (isset($this->processed_posts[$post['post_id']]) && !empty($post['post_id']))
                    continue;
                if ($post['status'] == 'auto-draft')
                    continue;

                if ('nav_menu_item' == $post['post_type']) {

                    $this->process_menu_item($post);
                    continue;
                }

                $post_type_object = get_post_type_object($post['post_type']);

                $post_exists = post_exists($post['post_title'], '', $post['post_date']);
                if ($post_exists && get_post_type($post_exists) == $post['post_type']) {
                    if (debug == true) {
                        printf('%s &#8220;%s&#8221; already exists.', $post_type_object->labels->singular_name, esc_html($post['post_title']));
                        echo '<br />';
                        $comment_post_ID = $post_id = $post_exists;
                    }
                } else {

                    $post_parent = (int) $post['post_parent'];
                    if ($post_parent) {
                        // if we already know the parent, map it to the new local ID
                        if (isset($this->processed_posts[$post_parent])) {
                            $post_parent = $this->processed_posts[$post_parent];
                            // otherwise record the parent for later
                        } else {
                            $this->post_orphans[intval($post['post_id'])] = $post_parent;
                            $post_parent = 0;
                        }
                    }

                    // map the post author
                    $author = sanitize_user($post['post_author'], true);
                    if (isset($this->author_mapping[$author]))
                        $author = $this->author_mapping[$author];
                    else
                        $author = (int) get_current_user_id();

                    $postdata = array(
                        'import_id' => $post['post_id'], 'post_author' => $author, 'post_date' => $post['post_date'],
                        'post_date_gmt' => $post['post_date_gmt'], 'post_content' => $post['post_content'],
                        'post_excerpt' => $post['post_excerpt'], 'post_title' => $post['post_title'],
                        'post_status' => $post['status'], 'post_name' => $post['post_name'],
                        'comment_status' => $post['comment_status'], 'ping_status' => $post['ping_status'],
                        'guid' => $post['guid'], 'post_parent' => $post_parent, 'menu_order' => $post['menu_order'],
                        'post_type' => $post['post_type'], 'post_password' => $post['post_password']
                    );

                    if ('attachment' == $postdata['post_type']) {
                        $remote_url = !empty($post['attachment_url']) ? $post['attachment_url'] : $post['guid'];

                        // try to use _wp_attached file for upload folder placement to ensure the same location as the export site
                        // e.g. location is 2003/05/image.jpg but the attachment post_date is 2010/09, see media_handle_upload()
                        $postdata['upload_date'] = 'demo';
                        if (debug == true) {
                            print_r("Importing atachment: ");
                            print_r($postdata["guid"]);
                        }

                        //OBRAZKY ZAKAZANY
                        $comment_post_ID = $post_id = $this->process_attachment($postdata, $remote_url);
                    } else {

                        if ($postdata['post_type'] != 'options') {
                            $comment_post_ID = $post_id = wp_insert_post($postdata, true);
                        }
                    }

                    if (is_wp_error($post_id)) {
                        if (debug == true) {
                                printf('Failed to import %s &#8220;%s&#8221;', $post_type_object->labels->singular_name, esc_html($post['post_title']));
                                if (defined('IMPORT_DEBUG') && IMPORT_DEBUG)
                                    echo ': ' . $post_id->get_error_message();
                                echo '<br />';
                                continue;
                        }
                    }

                    if ($post['is_sticky'] == 1)
                        stick_post($post_id);
                }

                // map pre-import ID to local ID

                if (isset($post_id) && !is_wp_error($post_id)) {
                    $this->processed_posts[intval($post['post_id'])] = (int) $post_id;
                }



                // add categories, tags and other terms
                if (!empty($post['terms'])) {
                    $terms_to_set = array();
                    ;
                    foreach ($post['terms'] as $term) {
                        // back compat with WXR 1.0 map 'tag' to 'post_tag'
                        $taxonomy = ( 'tag' == $term['domain'] ) ? 'post_tag' : $term['domain'];
                        $term_exists = term_exists($term['slug'], $taxonomy);
                        $term_id = is_array($term_exists) ? $term_exists['term_id'] : $term_exists;
                        if (!$term_id) {
                            $t = wp_insert_term($term['name'], $taxonomy, array('slug' => $term['slug']));
                            if (!is_wp_error($t)) {
                                $term_id = $t['term_id'];
                            } else {
                                if (debug == true) {
                                    if (debug == true) {
                                        printf('Failed to import %s %s', esc_html($taxonomy), esc_html($term['name']));
                                        if (defined('IMPORT_DEBUG') && IMPORT_DEBUG)
                                            echo ': ' . $t->get_error_message();
                                        echo '<br />';
                                        continue;
                                    }
                                }
                            }
                        }
                        $terms_to_set[$taxonomy][] = intval($term_id);
                    }

                    foreach ($terms_to_set as $tax => $ids) {
                        if (isset($post_id)) {
                            if($post_id instanceof WP_Error){
                                if(isset($post_id->errors['import_file_error'][0])){
                                    print_r('Error:' . $post_id->errors['import_file_error'][0]);
                                }
                                continue;
                            }
                            $tt_ids = wp_set_post_terms($post_id, $ids, $tax);
                        }
                    }
                    unset($post['terms'], $terms_to_set);
                }

                // add/update comments
                if (!empty($post['comments'])) {
                    if (isset($comment_post_ID)) {
                        $num_comments = 0;
                        $inserted_comments = array();
                        foreach ($post['comments'] as $comment) {
                            $comment_id = $comment['comment_id'];

                            $newcomments[$comment_id]['comment_post_ID'] = $comment_post_ID;
                            $newcomments[$comment_id]['comment_author'] = $comment['comment_author'];
                            $newcomments[$comment_id]['comment_author_email'] = $comment['comment_author_email'];
                            $newcomments[$comment_id]['comment_author_IP'] = $comment['comment_author_IP'];
                            $newcomments[$comment_id]['comment_author_url'] = $comment['comment_author_url'];
                            $newcomments[$comment_id]['comment_date'] = $comment['comment_date'];
                            $newcomments[$comment_id]['comment_date_gmt'] = $comment['comment_date_gmt'];
                            $newcomments[$comment_id]['comment_content'] = $comment['comment_content'];
                            $newcomments[$comment_id]['comment_approved'] = $comment['comment_approved'];
                            $newcomments[$comment_id]['comment_type'] = $comment['comment_type'];
                            $newcomments[$comment_id]['comment_parent'] = $comment['comment_parent'];
                            $newcomments[$comment_id]['commentmeta'] = isset($comment['commentmeta']) ? $comment['commentmeta'] : array();
                            if (isset($this->processed_authors[$comment['comment_user_id']]))
                                $newcomments[$comment_id]['user_id'] = $this->processed_authors[$comment['comment_user_id']];
                        }
                        ksort($newcomments);

                        foreach ($newcomments as $key => $comment) {
                            // if this is a new post we can skip the comment_exists() check
                            if (!$post_exists || !comment_exists($comment['comment_author'], $comment['comment_date'])) {
                                if (isset($inserted_comments[$comment['comment_parent']]))
                                    $comment['comment_parent'] = $inserted_comments[$comment['comment_parent']];
                                $comment = wp_filter_comment($comment);
                                $inserted_comments[$key] = wp_insert_comment($comment);

                                foreach ($comment['commentmeta'] as $meta) {
                                    $value = maybe_unserialize($meta['value']);
                                    add_comment_meta($inserted_comments[$key], $meta['key'], $value);
                                }

                                $num_comments++;
                            }
                        }
                        unset($newcomments, $inserted_comments, $post['comments']);
                    }
                }

                // add/update post meta

                if (isset($post['postmeta'])) {

                    foreach ((array) $post['postmeta'] as $meta) {
                        if (strlen($meta['value']) == 0) {
                            continue;
                        }
                        $key = apply_filters('import_post_meta_key', $meta['key']);
                        $value = false;

                        if ('_edit_last' == $key) {
                            if (isset($this->processed_authors[intval($meta['value'])]))
                                $value = $this->processed_authors[intval($meta['value'])];
                            else
                                $key = false;
                        }

                        if ($key) {
                            // export gets meta straight from the DB so could have a serialized string
                            if($post_id instanceof WP_Error){
                                if(isset($post_id->errors['import_file_error'][0])){
                                    print_r('Error:' . $post_id->errors['import_file_error'][0]);
                                }
                                continue;
                            }
                            if (!$value)
                                $value = maybe_unserialize($meta['value']);
                            if (isset($post_id)) {
                                add_post_meta($post_id, $key, $value);
                                do_action('import_post_meta', $post_id, $key, $value);
                                // if the post has a featured image, take note of this in case of remap
                                if ('_thumbnail_id' == $key)
                                    $this->featured_images[$post_id] = (int) $value;
                            }else {
                                //echo 'Imorted post already exist!<br>';
                            }
                        }
                    }
                }
            }

            unset($this->posts);
        }

        /**
         * Attempt to create a new menu item from import data
         *
         * Fails for draft, orphaned menu items and those without an associated nav_menu
         * or an invalid nav_menu term. If the post type or term object which the menu item
         * represents doesn't exist then the menu item will not be imported (waits until the
         * end of the import to retry again before discarding).
         *
         * @param array $item Menu item details from WXR file
         */
        function process_menu_item($item) {

            if (debug) {
                echo 'Import menu...<br>';
            }
            // skip draft, orphaned menu items
            if ('draft' == $item['status'])
                return;

            $menu_slug = false;


            if (isset($item['terms'])) {
                // loop through terms, assume first nav_menu term is correct menu
                foreach ($item['terms'] as $term) {
                    if ('nav_menu' == $term['domain']) {
                        $menu_slug = $term['slug'];
                        break;
                    }
                }
            }

            if (debug) {
                echo 'Possition: ' . $term['slug'] . '<br>';
                echo 'Status: ' . $item['status'] . '<br>';
            }

            // no nav_menu term associated with this menu item
            if (!$menu_slug) {
                // echo('Menu item skipped due to missing menu slug');
                // echo '<br />';
                return;
            }

            $menu_id = term_exists($menu_slug, 'nav_menu');

            if (!$menu_id) {
                if (debug == true) {
                    printf('Menu item skipped due to invalid menu slug: %s', esc_html($menu_slug));
                    echo '<br />';
                    return;
                }
            } else {
                $menu_id = is_array($menu_id) ? $menu_id['term_id'] : $menu_id;
            }

            foreach ($item['postmeta'] as $meta)
                $$meta['key'] = $meta['value'];

            if ('taxonomy' == $_menu_item_type && isset($this->processed_terms[intval($_menu_item_object_id)])) {
                $_menu_item_object_id = $this->processed_terms[intval($_menu_item_object_id)];
            } else if ('post_type' == $_menu_item_type && isset($this->processed_posts[intval($_menu_item_object_id)])) {
                $_menu_item_object_id = $this->processed_posts[intval($_menu_item_object_id)];
            } else if ('custom' != $_menu_item_type) {
                // associated object is missing or not imported yet, we'll retry later
                $this->missing_menu_items[] = $item;
                return;
            }

            if (isset($this->processed_menu_items[intval($_menu_item_menu_item_parent)])) {
                $_menu_item_menu_item_parent = $this->processed_menu_items[intval($_menu_item_menu_item_parent)];
            } else if ($_menu_item_menu_item_parent) {
                $this->menu_item_orphans[intval($item['post_id'])] = (int) $_menu_item_menu_item_parent;
                $_menu_item_menu_item_parent = 0;
            }

            // wp_update_nav_menu_item expects CSS classes as a space separated string
            $_menu_item_classes = maybe_unserialize($_menu_item_classes);
            if (is_array($_menu_item_classes))
                $_menu_item_classes = implode(' ', $_menu_item_classes);

            foreach ($item['postmeta'] as $meta) {
                if ($meta['key'] == 'jaw-menu-item-options') {
                    $jaw_menu_item_options = $meta['value'];
                }
            }


            $args = array(
                'menu-item-object-id' => $_menu_item_object_id,
                'menu-item-object' => $_menu_item_object,
                'menu-item-parent-id' => $_menu_item_menu_item_parent,
                'menu-item-position' => intval($item['menu_order']),
                'menu-item-type' => $_menu_item_type,
                'menu-item-title' => $item['post_title'],
                'menu-item-url' => $_menu_item_url,
                'menu-item-description' => $item['post_content'],
                'menu-item-attr-title' => $item['post_excerpt'],
                'menu-item-target' => $_menu_item_target,
                'menu-item-classes' => $_menu_item_classes,
                'menu-item-xfn' => $_menu_item_xfn,
                'menu-item-status' => $item['status']
            );


            if (isset($menu_id)) {
                $id = wp_update_nav_menu_item($menu_id, 0, $args);
                if ($_menu_item_object == 'category') {
                    $this->_ids_nav_menu[$id] = $_menu_item_object_id;
                }
            }




            if (isset($id) && $id && !is_wp_error($id)) {
                $this->processed_menu_items[intval($item['post_id'])] = (int) $id;
                if (isset($jaw_menu_item_options)) {
                    update_post_meta($id, 'jaw-menu-item-options', maybe_unserialize($jaw_menu_item_options));
                }
            }
        }

        /**
         * If fetching attachments is enabled then attempt to create a new attachment
         *
         * @param array $post Attachment post details from WXR
         * @param string $url URL to fetch attachment from
         * @return int|WP_Error Post ID on success, WP_Error otherwise
         */
        function process_attachment($post, $url) {
            if (!$this->fetch_attachments)
                return new WP_Error('attachment_processing_error', 'Fetching attachments is not enabled');

            // if the URL is absolute, but does not contain address, then upload it assuming base_site_url
            if (preg_match('|^/[\w\W]+$|', $url))
                $url = rtrim($this->base_url, '/') . $url;


            $upload = $this->fetch_remote_file($url, $post);
            if (is_wp_error($upload))
                return $upload;

            if ($info = wp_check_filetype($upload['file']))
                $post['post_mime_type'] = $info['type'];
            else
                return new WP_Error('attachment_processing_error', 'Invalid file type');

            $post['guid'] = $upload['url'];

            // as per wp-admin/includes/upload.php
            $post_id = wp_insert_attachment($post, $upload['file']);
            //load_template(ABSPATH . 'wp-admin/includes/image.php');
            // remap resized image URLs, works by stripping the extension and remapping the URL stub.
            if (preg_match('!^image/!', $info['type'])) {
                $parts = pathinfo($url);
                $name = basename($parts['basename'], ".{$parts['extension']}"); // PATHINFO_FILENAME in PHP 5.2

                $parts_new = pathinfo($upload['url']);
                $name_new = basename($parts_new['basename'], ".{$parts_new['extension']}");

                $this->url_remap[$parts['dirname'] . '/' . $name] = $parts_new['dirname'] . '/' . $name_new;
            }

            return $post_id;
        }

        /**
         * Attempt to download a remote file attachment
         *
         * @param string $url URL of item to fetch
         * @param array $post Attachment details
         * @return array|WP_Error Local file location details on success, WP_Error otherwise
         */
        function fetch_remote_file( $url, $post ) {
            // extract the file name and extension from the url
            $file_name = basename( $url );

            // get placeholder file in the upload dir with a unique, sanitized filename
            $upload = wp_upload_bits( $file_name, 0, '', $post['upload_date'] );
            if ( $upload['error'] )
                return new WP_Error( 'upload_dir_error', $upload['error'] );

            // fetch the remote url and write it to the placeholder file
            $response = wp_remote_get( $url, array(
                'stream' => true,
                'filename' => $upload['file']
            ) );

            // request failed
            if ( is_wp_error( $response ) ) {
                @unlink( $upload['file'] );
                return $response;
            }

            $code = (int) wp_remote_retrieve_response_code( $response );

            // make sure the fetch was successful
            if ( $code !== 200 ) {
                @unlink( $upload['file'] );
                return new WP_Error(
                    'import_file_error',
                    sprintf(
                        __('Remote server returned %1$d %2$s for %3$s', 'wordpress-importer'),
                        $code,
                        get_status_header_desc( $code ),
                        $url
                    )
                );
            }

            $filesize = filesize( $upload['file'] );
            $headers = wp_remote_retrieve_headers( $response );

            if ( isset( $headers['content-length'] ) && $filesize != $headers['content-length'] ) {
                @unlink( $upload['file'] );
                return new WP_Error( 'import_file_error', __('Remote file is incorrect size', 'wordpress-importer') );
            }

            if ( 0 == $filesize ) {
                @unlink( $upload['file'] );
                return new WP_Error( 'import_file_error', __('Zero size file downloaded', 'wordpress-importer') );
            }

            $max_size = (int) $this->max_attachment_size();
            if ( ! empty( $max_size ) && $filesize > $max_size ) {
                @unlink( $upload['file'] );
                return new WP_Error( 'import_file_error', sprintf(__('Remote file is too large, limit is %s', 'wordpress-importer'), size_format($max_size) ) );
            }

            // keep track of the old and new urls so we can substitute them later
            $this->url_remap[$url] = $upload['url'];
            $this->url_remap[$post['guid']] = $upload['url']; // r13735, really needed?
            // keep track of the destination if the remote url is redirected somewhere else
            if ( isset($headers['x-final-location']) && $headers['x-final-location'] != $url ){
                $this->url_remap[$headers['x-final-location']] = $upload['url'];
            }

            return $upload;
        }

        /**
         * Attempt to associate posts and menu items with previously missing parents
         *
         * An imported post's parent may not have been imported when it was first created
         * so try again. Similarly for child menu items and menu items which were missing
         * the object (e.g. post) they represent in the menu
         */
        function backfill_parents() {
            global $wpdb;

            // find parents for post orphans
            if (isset($this->post_orphans)) {
                foreach ((array) $this->post_orphans as $child_id => $parent_id) {
                    $local_child_id = $local_parent_id = false;
                    if (isset($this->processed_posts[$child_id]))
                        $local_child_id = $this->processed_posts[$child_id];
                    if (isset($this->processed_posts[$parent_id]))
                        $local_parent_id = $this->processed_posts[$parent_id];

                    if ($local_child_id && $local_parent_id)
                        $wpdb->update($wpdb->posts, array('post_parent' => $local_parent_id), array('ID' => $local_child_id), '%d', '%d');
                }
            }

            // all other posts/terms are imported, retry menu items with missing associated object
            if (isset($this->missing_menu_items)) {
                $missing_menu_items = $this->missing_menu_items;
                foreach ((array) $missing_menu_items as $item)
                    $this->process_menu_item($item);
            }


            // find parents for menu item orphans
            if (isset($this->menu_item_orphans)) {
                foreach ((array) $this->menu_item_orphans as $child_id => $parent_id) {
                    $local_child_id = $local_parent_id = 0;
                    if (isset($this->processed_menu_items[$child_id]))
                        $local_child_id = $this->processed_menu_items[$child_id];
                    if (isset($this->processed_menu_items[$parent_id]))
                        $local_parent_id = $this->processed_menu_items[$parent_id];

                    if ($local_child_id && $local_parent_id)
                        update_post_meta($local_child_id, '_menu_item_menu_item_parent', (int) $local_parent_id);
                }
            }
        }

        /**
         * Use stored mapping information to update old attachment URLs
         */
        function backfill_attachment_urls() {
            global $wpdb;
            // make sure we do the longest urls first, in case one is a substring of another

            if (isset($this->url_remap)) {
                foreach ((array) $this->url_remap as $from_url => $to_url) {
                    // remap urls in post_content
                    $wpdb->query($wpdb->prepare("UPDATE {$wpdb->posts} SET post_content = REPLACE(post_content, %s, %s)", $from_url, $to_url));
                    // remap enclosure urls
                    $result = $wpdb->query($wpdb->prepare("UPDATE {$wpdb->postmeta} SET meta_value = REPLACE(meta_value, %s, %s) WHERE meta_key='enclosure'", $from_url, $to_url));
                }
            }
        }

        /**
         * Update _thumbnail_id meta to new, imported attachment IDs
         */
        function remap_featured_images() {
            // cycle through posts that have a featured image
            if (isset($this->featured_images)) {
                foreach ((array) $this->featured_images as $post_id => $value) {
                    if (isset($this->processed_posts[$value])) {
                        $new_id = $this->processed_posts[$value];
                        // only update if there's a difference
                        if ($new_id != $value)
                            update_post_meta($post_id, '_thumbnail_id', $new_id);
                    }
                }
            }
        }

        // Display import page title
        function header() {
            echo '<div class="wrap">';

            echo '<h2>Import WordPress</h2>';

            $updates = get_plugin_updates();
            $basename = plugin_basename(__FILE__);
            if (isset($updates[$basename])) {
                $update = $updates[$basename];
                echo '<div class="error"><p><strong>';
                if (debug == true) {
                    printf('A new version of this importer is available. Please update to version %s to ensure compatibility with newer export files.', $update->update->new_version);
                }
                echo '</strong></p></div>';
            }
        }

        // Close div.wrap
        function footer() {
            echo '</div>';
        }

        function parse($file) {
            $parser = new WXR_Parser_2();

            return $parser->parse($file);
        }

        /**
         * Decide if the given meta key maps to information we will want to import
         *
         * @param string $key The meta key to check
         * @return string|bool The key if we do want to import, false if not
         */
        function is_valid_meta_key($key) {
            // skip attachment metadata since we'll regenerate it from scratch
            // skip _edit_lock as not relevant for import
            if (in_array($key, array('_wp_attached_file', '_wp_attachment_metadata', '_edit_lock')))
                return false;
            return $key;
        }

        /**
         * Decide whether or not the importer is allowed to create users.
         * Default is true, can be filtered via import_allow_create_users
         *
         * @return bool True if creating users is allowed
         */
        function allow_create_users() {
            return apply_filters('import_allow_create_users', true);
        }

        /**
         * Decide whether or not the importer should attempt to download attachment files.
         * Default is true, can be filtered via import_allow_fetch_attachments. The choice
         * made at the import options screen must also be true, false here hides that checkbox.
         *
         * @return bool True if downloading attachments is allowed
         */
        function allow_fetch_attachments() {
            return apply_filters('import_allow_fetch_attachments', true);
        }

        /**
         * Decide what the maximum file size for downloaded attachments is.
         * Default is 0 (unlimited), can be filtered via import_attachment_size_limit
         *
         * @return int Maximum attachment file size to import
         */
        function max_attachment_size() {
            return apply_filters('import_attachment_size_limit', 0);
        }

        /**
         * Added to http_request_timeout filter to force timeout at 60 seconds during import
         * @return int 60
         */
        function bump_request_timeout() {
            return 60;
        }

        // return the difference in length between two strings
        function cmpr_strlen($a, $b) {
            return strlen($b) - strlen($a);
        }

        //IMPORT WIDGETŮ
        /*
          Name: Widget Data - Setting Import/Export
          Description: Adds functionality to export and import widget data
          Authors: Kevin Langley and Sean McCafferty
          Version: 0.4
         * ******************************************************************
          Copyright 2011-2011 Kevin Langley & Sean McCafferty  (email : klangley@voceconnect.com & smccafferty@voceconnect.com)

          This program is free software: you can redistribute it and/or modify
          it under the terms of the GNU General Public License as published by
          the Free Software Foundation, either version 3 of the License, or
          (at your option) any later version.

          This program is distributed in the hope that it will be useful,
          but WITHOUT ANY WARRANTY; without even the implied warranty of
          MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
          GNU General Public License for more details.

          You should have received a copy of the GNU General Public License
          along with this program.  If not, see <http://www.gnu.org/licenses/>.
         * ******************************************************************
         */
        function get_widget_settings_json($file) {
            $widget_settings = $this->upload_widget_settings_file($file);


            $file_contents = json_decode($widget_settings, true);

            return array($file_contents, $widget_settings);
        }

        function upload_widget_settings_file($file) {
            global $wp_filesystem;
            WP_Filesystem(null);
            $overrides = array('test_form' => false);
            $string = $wp_filesystem->get_contents($file);

            return $string;
        }

        function parse_import_data($import_array) {

            if (!isset($import_array[0]) && !isset($import_array[1])) {
                return false;
            }
            $sidebars_data = $import_array[0];
            $widget_data = $import_array[1];

            $current_sidebars = get_option('sidebars_widgets');
            $new_widgets = array();
            if (debug) {
                echo('Importing data:<br>');
                echo '<br><br>';
            }
            $fly_opt = get_option(OPTIONS);
            foreach ((array) $fly_opt['sidebars'] as $one_sidebar) {
                register_sidebar($one_sidebar);
                $current_sidebars[$one_sidebar['id']] = array();
            }



            foreach ((array) $sidebars_data as $import_sidebar => $import_widgets) :
                if (debug) {
                    echo '<br>';
                    echo('SIDEBAR: ' . $import_sidebar . '<br>');
                    echo 'WIDGET(s): <br>';
                }
                foreach ($import_widgets as $import_widget) :



                    if (!isset($current_sidebars[$import_sidebar])) {
                        $current_sidebars[$import_sidebar] = array();
                    }
                    $title = trim(substr($import_widget, 0, strrpos($import_widget, '-')));
                    $index = trim(substr($import_widget, strrpos($import_widget, '-') + 1));
                    $current_widget_data = get_option('widget_' . $title);
                    $new_widget_name = $this->get_new_widget_name($title, $index);
                    $new_index = trim(substr($new_widget_name, strrpos($new_widget_name, '-') + 1));
                    if (debug) {
                        echo($title . '<br>');
                    }
                    if (isset($new_widgets[$title]) && is_array($new_widgets[$title])) {
                        while (array_key_exists($new_index, $new_widgets[$title])) {
                            $new_index++;
                        }
                    }
                    $current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
                    if (array_key_exists($title, $new_widgets)) {
                        $new_widgets[$title][$new_index] = $widget_data[$title][$index];
                        $multiwidget = $new_widgets[$title]['_multiwidget'];
                        unset($new_widgets[$title]['_multiwidget']);
                        $new_widgets[$title]['_multiwidget'] = $multiwidget;
                    } else {
                        $current_widget_data[$new_index] = $widget_data[$title][$index];
                        if (isset($current_widget_data['_multiwidget'])) {
                            $current_multiwidget = $current_widget_data['_multiwidget'];
                        }
                        $new_multiwidget = $widget_data[$title]['_multiwidget'];
                        if (isset($current_multiwidget)) {
                            $multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
                        } else {
                            $multiwidget = 1;
                        }
                        unset($current_widget_data['_multiwidget']);
                        $current_widget_data['_multiwidget'] = $multiwidget;
                        $new_widgets[$title] = $current_widget_data;
                    }


                endforeach;
            endforeach;

            if (isset($new_widgets) && isset($current_sidebars)) {
                update_option('sidebars_widgets', $current_sidebars);
                foreach ($new_widgets as $title => $content) {
                    update_option('widget_' . $title, $content);
                }

                return true;
            } else {
                return false;
            }
        }

        function get_new_widget_name($widget_name, $widget_index) {
            $current_sidebars = get_option('sidebars_widgets');
            $all_widget_array = array();
            foreach ($current_sidebars as $sidebar => $widgets) {
                if (!empty($widgets) && is_array($widgets) && $sidebar != 'wp_inactive_widgets') {
                    foreach ($widgets as $w) {
                        $all_widget_array[] = $w;
                    }
                }
            }
            while (in_array($widget_name . '-' . $widget_index, $all_widget_array)) {
                $widget_index++;
            }
            $new_widget_name = $widget_name . '-' . $widget_index;
            return $new_widget_name;
        }

        function import_revslider() {
            global $wpdb;

            foreach ($this->revslider as $id => $rev) {

                $options = array("id" => (int) 0,
                    "title" => $id,
                    "alias" => $id,
                    "params" => '');

                $_FILES["import_file"]["tmp_name"] = THEME_DIR . '/demo/revslider/' . $rev;
                $_POST['sliderid'] = $options['id'];
                $rev = new RevSlider();
                $rev->initByDBData($options);
                $ret = $rev->importSliderFromPost();

                echo 'Import of ' . $id . ' ';

                if ($ret['success']) {
                    echo 'successful.<br>';
                } else {
                    echo $ret['error'] . ' ';
                    echo 'failed!!!<br>';
                }
            }
            return true;
        }

    }

}

/**
 * WordPress eXtended RSS file parser implementations
 *
 * @package WordPress
 * @subpackage Importer
 */
/**
 * WordPress Importer class for managing parsing of WXR files.
 */
if (!class_exists('WXR_Parser_2')) {

    class WXR_Parser_2 {

        function parse($file) {


            // Attempt to use proper XML parsers first
            if (extension_loaded('simplexml')) {

                $parser = new WXR_Parser_SimpleXML;

                $result = $parser->parse($file);


                // If SimpleXML succeeds or this is an invalid WXR file then return the results
                if (!is_wp_error($result) || 'SimpleXML_parse_error' != $result->get_error_code())
                    return $result;
            } else if (extension_loaded('xml')) {

                $parser = new WXR_Parser_XML;
                $result = $parser->parse($file);

                // If XMLParser succeeds or this is an invalid WXR file then return the results
                if (!is_wp_error($result) || 'XML_parse_error' != $result->get_error_code())
                    return $result;
            }

            // We have a malformed XML file, so display the error and fallthrough to regex
            if (isset($result) && defined('IMPORT_DEBUG') && IMPORT_DEBUG) {
                echo '<pre>';
                if ('SimpleXML_parse_error' == $result->get_error_code()) {
                    foreach ($result->get_error_data() as $error)
                        echo $error->line . ':' . $error->column . ' ' . esc_html($error->message) . "\n";
                } else if ('XML_parse_error' == $result->get_error_code()) {
                    $error = $result->get_error_data();
                    echo $error[0] . ':' . $error[1] . ' ' . esc_html($error[2]);
                }
                echo '</pre>';
                echo '<p><strong>' . 'There was an error when reading this WXR file' . '</strong><br />';
                echo 'Details are shown above. The importer will now try again with a different parser...' . '</p>';
            }

            // use regular expressions if nothing else available or this is bad XML
            $parser = new WXR_Parser_Regex;

            return $parser->parse($file);
        }

    }

}
/**
 * WXR Parser that makes use of the SimpleXML PHP extension.
 */
if (!class_exists('WXR_Parser_SimpleXML')) {

    class WXR_Parser_SimpleXML {

        function parse($file) {
            global $wp_filesystem;
            WP_Filesystem(null);
            $authors = $posts = $categories = $tags = $terms = array();

            $internal_errors = libxml_use_internal_errors(true);
            $xml = $wp_filesystem->get_contents($file);
            $xml = str_replace("@JaW_SITE_URL@", get_template_directory_uri(), $xml);
            $xml = simplexml_load_string($xml);


            // halt if loading produces an error
            if (!$xml)
                return new WP_Error('SimpleXML_parse_error', 'There was an error when reading this WXR file', libxml_get_errors());


            $wxr_version = $xml->xpath('/rss/channel/wp:wxr_version');
            if (!$wxr_version)
                return new WP_Error('WXR_parse_error', 'This does not appear to be a WXR file, missing/invalid WXR version number');

            $wxr_version = (string) trim($wxr_version[0]);
            // confirm that we are dealing with the correct file format
            if (!preg_match('/^\d+\.\d+$/', $wxr_version))
                return new WP_Error('WXR_parse_error', 'This does not appear to be a WXR file, missing/invalid WXR version number');

            $base_url = $xml->xpath('/rss/channel/wp:base_site_url');
            $base_url = (string) trim($base_url[0]);

            $namespaces = $xml->getDocNamespaces();
            if (!isset($namespaces['wp']))
                $namespaces['wp'] = 'http://wordpress.org/export/1.2/';
            if (!isset($namespaces['excerpt']))
                $namespaces['excerpt'] = 'http://wordpress.org/export/1.2/excerpt/';

            // grab authors
            foreach ($xml->xpath('/rss/channel/wp:author') as $author_arr) {
                $a = $author_arr->children($namespaces['wp']);
                $login = (string) $a->author_login;
                $authors[$login] = array(
                    'author_id' => (int) $a->author_id,
                    'author_login' => $login,
                    'author_email' => (string) $a->author_email,
                    'author_display_name' => (string) $a->author_display_name,
                    'author_first_name' => (string) $a->author_first_name,
                    'author_last_name' => (string) $a->author_last_name
                );
            }

            // grab cats, tags and terms
            foreach ($xml->xpath('/rss/channel/wp:category') as $term_arr) {
                $t = $term_arr->children($namespaces['wp']);
                $categories[] = array(
                    'term_id' => (int) $t->term_id,
                    'category_nicename' => (string) $t->category_nicename,
                    'category_parent' => (string) $t->category_parent,
                    'cat_name' => (string) $t->cat_name,
                    'category_description' => (string) $t->category_description
                );
            }

            foreach ($xml->xpath('/rss/channel/wp:tag') as $term_arr) {
                $t = $term_arr->children($namespaces['wp']);
                $tags[] = array(
                    'term_id' => (int) $t->term_id,
                    'tag_slug' => (string) $t->tag_slug,
                    'tag_name' => (string) $t->tag_name,
                    'tag_description' => (string) $t->tag_description
                );
            }
            foreach ($xml->xpath('/rss/channel/wp:term') as $term_arr) {
                $t = $term_arr->children($namespaces['wp']);

                $terms[] = array(
                    'term_id' => (int) $t->term_id,
                    'term_taxonomy' => (string) $t->term_taxonomy,
                    'slug' => (string) $t->term_slug,
                    'term_parent' => (string) $t->term_parent,
                    'term_name' => (string) $t->term_name,
                    'term_description' => (string) $t->term_description
                );
            }



            // grab term_location_arr
            $terms_locations = null;
            foreach ($xml->xpath('/rss/channel/wp:term_locations') as $term_location_arr) {
                $tl = $term_location_arr->children($namespaces['wp']);
                $terms_locations["" . (string) $tl->menu_location . ""] = (int) $tl->menu_location_id;
            }


            $xml_categories = $xml->xpath('/rss/channel/wp:categories');
            $xml_menus = $xml->xpath('/rss/channel/wp:menus');
            $xml_options = $xml->xpath('/rss/channel/wp:options');
            $xml_builder = $xml->xpath('/rss/channel/wp:builder');
            $xml_menu_location = $xml->xpath('/rss/channel/wp:menu_location');

            $xml_front_page = $xml->xpath('/rss/channel/wp:front_page');


            $revslider = array();
            foreach ($xml->xpath('/rss/channel/wp:revslider') as $rev) {
                $tl = $rev->children($namespaces['wp']);
                $revslider["" . (string) $tl->title . ""] = (string) $tl->file;
            }


            // grab posts
            foreach ($xml->channel->item as $item) {

                $post = array(
                    'post_title' => (string) $item->title,
                    'guid' => (string) $item->guid,
                );

                $dc = $item->children('http://purl.org/dc/elements/1.1/');
                $post['post_author'] = (string) $dc->creator;

                $content = $item->children('http://purl.org/rss/1.0/modules/content/');
                $excerpt = $item->children($namespaces['excerpt']);
                $post['post_content'] = (string) $content->encoded;
                $post['post_excerpt'] = (string) $excerpt->encoded;

                $wp = $item->children($namespaces['wp']);
                $post['post_id'] = (int) $wp->post_id;
                $post['post_date'] = (string) $wp->post_date;
                $post['post_date_gmt'] = (string) $wp->post_date_gmt;
                $post['comment_status'] = (string) $wp->comment_status;
                $post['ping_status'] = (string) $wp->ping_status;
                $post['post_name'] = (string) $wp->post_name;
                $post['status'] = (string) $wp->status;
                $post['post_parent'] = (int) $wp->post_parent;
                $post['menu_order'] = (int) $wp->menu_order;
                $post['post_type'] = (string) $wp->post_type;
                $post['post_password'] = (string) $wp->post_password;
                $post['is_sticky'] = (int) $wp->is_sticky;

                if (isset($wp->attachment_url))
                    $post['attachment_url'] = (string) $wp->attachment_url;

                foreach ($item->category as $c) {
                    $att = $c->attributes();
                    if (isset($att['nicename']))
                        $post['terms'][] = array(
                            'name' => (string) $c,
                            'slug' => (string) $att['nicename'],
                            'domain' => (string) $att['domain']
                        );
                }

                foreach ($wp->postmeta as $meta) {
                    $post['postmeta'][] = array(
                        'key' => (string) $meta->meta_key,
                        'value' => (string) $meta->meta_value
                    );
                }

                foreach ($wp->comment as $comment) {
                    $meta = array();
                    if (isset($comment->commentmeta)) {
                        foreach ($comment->commentmeta as $m) {
                            $meta[] = array(
                                'key' => (string) $m->meta_key,
                                'value' => (string) $m->meta_value
                            );
                        }
                    }

                    $post['comments'][] = array(
                        'comment_id' => (int) $comment->comment_id,
                        'comment_author' => (string) $comment->comment_author,
                        'comment_author_email' => (string) $comment->comment_author_email,
                        'comment_author_IP' => (string) $comment->comment_author_IP,
                        'comment_author_url' => (string) $comment->comment_author_url,
                        'comment_date' => (string) $comment->comment_date,
                        'comment_date_gmt' => (string) $comment->comment_date_gmt,
                        'comment_content' => (string) $comment->comment_content,
                        'comment_approved' => (string) $comment->comment_approved,
                        'comment_type' => (string) $comment->comment_type,
                        'comment_parent' => (string) $comment->comment_parent,
                        'comment_user_id' => (int) $comment->comment_user_id,
                        'commentmeta' => $meta,
                    );
                }

                $posts[] = $post;
            }

            return array(
                'authors' => $authors,
                'posts' => $posts,
                'categories' => $categories,
                'tags' => $tags,
                'terms' => $terms,
                'term_locations' => $terms_locations,
                'base_url' => $base_url,
                'version' => $wxr_version,
                'opt_categories' => $xml_categories,
                'opt_menus' => $xml_menus,
                'opt_options' => $xml_options,
                'opt_builder' => $xml_builder,
                'opt_menu_location' => $xml_menu_location,
                'revslider' => $revslider,
                'front_page' => $xml_front_page
            );
        }

    }

}
/**
 * WXR Parser that makes use of the XML Parser PHP extension.
 */
if (!class_exists('WXR_Parser_XML')) {

    class WXR_Parser_XML {

        var $wp_tags = array(
            'wp:post_id', 'wp:post_date', 'wp:post_date_gmt', 'wp:comment_status', 'wp:ping_status', 'wp:attachment_url',
            'wp:status', 'wp:post_name', 'wp:post_parent', 'wp:menu_order', 'wp:post_type', 'wp:post_password',
            'wp:is_sticky', 'wp:term_id', 'wp:category_nicename', 'wp:category_parent', 'wp:cat_name', 'wp:category_description',
            'wp:tag_slug', 'wp:tag_name', 'wp:tag_description', 'wp:term_taxonomy', 'wp:term_parent',
            'wp:term_name', 'wp:term_description', 'wp:author_id', 'wp:author_login', 'wp:author_email', 'wp:author_display_name',
            'wp:author_first_name', 'wp:author_last_name',
        );
        var $wp_sub_tags = array(
            'wp:comment_id', 'wp:comment_author', 'wp:comment_author_email', 'wp:comment_author_url',
            'wp:comment_author_IP', 'wp:comment_date', 'wp:comment_date_gmt', 'wp:comment_content',
            'wp:comment_approved', 'wp:comment_type', 'wp:comment_parent', 'wp:comment_user_id',
        );

        function parse($file) {
            $this->wxr_version = $this->in_post = $this->cdata = $this->data = $this->sub_data = $this->in_tag = $this->in_sub_tag = false;
            $this->authors = $this->posts = $this->term = $this->terms_locations = $this->category = $this->tag = array();

            $xml = xml_parser_create('UTF-8');
            xml_parser_set_option($xml, XML_OPTION_SKIP_WHITE, 1);
            xml_parser_set_option($xml, XML_OPTION_CASE_FOLDING, 0);
            xml_set_object($xml, $this);
            xml_set_character_data_handler($xml, 'cdata');
            xml_set_element_handler($xml, 'tag_open', 'tag_close');
            global $wp_filesystem;
            WP_Filesystem(null);
            if (!xml_parse($xml, $wp_filesystem->get_contents($file), true)) {
                $current_line = xml_get_current_line_number($xml);
                $current_column = xml_get_current_column_number($xml);
                $error_code = xml_get_error_code($xml);
                $error_string = xml_error_string($error_code);
                return new WP_Error('XML_parse_error', 'There was an error when reading this WXR file', array($current_line, $current_column, $error_string));
            }


            xml_parser_free($xml);

            if (!preg_match('/^\d+\.\d+$/', $this->wxr_version))
                return new WP_Error('WXR_parse_error', 'This does not appear to be a WXR file, missing/invalid WXR version number');

            return array(
                'authors' => $this->authors,
                'posts' => $this->posts,
                'categories' => $this->category,
                'tags' => $this->tag,
                'terms' => $this->term,
                'term_locations' => $this->terms_locations,
                'base_url' => $this->base_url,
                'version' => $this->wxr_version
            );
        }

        function tag_open($parse, $tag, $attr) {
            if (in_array($tag, $this->wp_tags)) {
                $this->in_tag = substr($tag, 3);
                return;
            }

            if (in_array($tag, $this->wp_sub_tags)) {
                $this->in_sub_tag = substr($tag, 3);
                return;
            }

            switch ($tag) {
                case 'category':
                    if (isset($attr['domain'], $attr['nicename'])) {
                        $this->sub_data['domain'] = $attr['domain'];
                        $this->sub_data['slug'] = $attr['nicename'];
                    }
                    break;
                case 'item': $this->in_post = true;
                case 'title': if ($this->in_post)
                        $this->in_tag = 'post_title';
                    break;
                case 'guid': $this->in_tag = 'guid';
                    break;
                case 'dc:creator': $this->in_tag = 'post_author';
                    break;
                case 'content:encoded': $this->in_tag = 'post_content';
                    break;
                case 'excerpt:encoded': $this->in_tag = 'post_excerpt';
                    break;

                case 'wp:term_slug': $this->in_tag = 'slug';
                    break;
                case 'wp:meta_key': $this->in_sub_tag = 'key';
                    break;
                case 'wp:meta_value': $this->in_sub_tag = 'value';
                    break;
            }
        }

        function cdata($parser, $cdata) {
            if (!trim($cdata))
                return;

            $this->cdata .= trim($cdata);
        }

        function tag_close($parser, $tag) {
            switch ($tag) {
                case 'wp:comment':
                    unset($this->sub_data['key'], $this->sub_data['value']); // remove meta sub_data
                    if (!empty($this->sub_data))
                        $this->data['comments'][] = $this->sub_data;
                    $this->sub_data = false;
                    break;
                case 'wp:commentmeta':
                    $this->sub_data['commentmeta'][] = array(
                        'key' => $this->sub_data['key'],
                        'value' => $this->sub_data['value']
                    );
                    break;
                case 'category':
                    if (!empty($this->sub_data)) {
                        $this->sub_data['name'] = $this->cdata;
                        $this->data['terms'][] = $this->sub_data;
                    }
                    $this->sub_data = false;
                    break;
                case 'wp:postmeta':
                    if (!empty($this->sub_data))
                        $this->data['postmeta'][] = $this->sub_data;
                    $this->sub_data = false;
                    break;
                case 'item':
                    $this->posts[] = $this->data;
                    $this->data = false;
                    break;
                case 'wp:category':
                case 'wp:tag':
                case 'wp:term':
                    $n = substr($tag, 3);
                    array_push($this->$n, $this->data);
                    $this->data = false;
                    break;
                case 'wp:author':
                    if (!empty($this->data['author_login']))
                        $this->authors[$this->data['author_login']] = $this->data;
                    $this->data = false;
                    break;
                case 'wp:base_site_url':
                    $this->base_url = $this->cdata;
                    break;
                case 'wp:wxr_version':
                    $this->wxr_version = $this->cdata;
                    break;

                default:
                    if ($this->in_sub_tag) {
                        $this->sub_data[$this->in_sub_tag] = !empty($this->cdata) ? $this->cdata : '';
                        $this->in_sub_tag = false;
                    } else if ($this->in_tag) {
                        $this->data[$this->in_tag] = !empty($this->cdata) ? $this->cdata : '';
                        $this->in_tag = false;
                    }
            }

            $this->cdata = false;
        }

    }

}

/**
 * WXR Parser that uses regular expressions. Fallback for installs without an XML parser.
 */
if (!class_exists('WXR_Parser_Regex')) {

    class WXR_Parser_Regex {

        var $authors = array();
        var $posts = array();
        var $categories = array();
        var $tags = array();
        var $terms = array();
        var $terms_locations = array();
        var $base_url = '';

        function __construct() {
            $this->has_gzip = is_callable('gzopen');
        }

        function parse($file) {
            global $wp_filesystem;
            WP_Filesystem(null);

            $wxr_version = $in_post = false;

            if (file_exists($file)) {
                $FileContent = $wp_filesystem->get_contents($file);
                $FileContent = explode("\n", $FileContent);

                foreach ($FileContent as $importline) {

                    if (!$wxr_version && preg_match('|<wp:wxr_version>(\d+\.\d+)</wp:wxr_version>|', $importline, $version))
                        $wxr_version = $version[1];

                    if (false !== strpos($importline, '<wp:base_site_url>')) {
                        preg_match('|<wp:base_site_url>(.*?)</wp:base_site_url>|is', $importline, $url);
                        $this->base_url = $url[1];
                        continue;
                    }
                    if (false !== strpos($importline, '<wp:category>')) {
                        preg_match('|<wp:category>(.*?)</wp:category>|is', $importline, $category);
                        $this->categories[] = $this->process_category($category[1]);
                        continue;
                    }

                    if (false !== strpos($importline, '<wp:tag>')) {
                        preg_match('|<wp:tag>(.*?)</wp:tag>|is', $importline, $tag);
                        $this->tags[] = $this->process_tag($tag[1]);
                        continue;
                    }
                    if (false !== strpos($importline, '<wp:term>')) {
                        preg_match('|<wp:term>(.*?)</wp:term>|is', $importline, $term);
                        $this->terms[] = $this->process_term($term[1]);
                        continue;
                    }
                    if (false !== strpos($importline, '<wp:author>')) {
                        preg_match('|<wp:author>(.*?)</wp:author>|is', $importline, $author);
                        $a = $this->process_author($author[1]);
                        $this->authors[$a['author_login']] = $a;
                        continue;
                    }
                    if (false !== strpos($importline, '<item>')) {
                        $post = '';
                        $in_post = true;
                        continue;
                    }
                    if (false !== strpos($importline, '</item>')) {
                        $in_post = false;
                        $this->posts[] = $this->process_post($post);
                        continue;
                    }
                    if ($in_post) {
                        $post .= $importline . "\n";
                    }
                }
            }

            if (!$wxr_version)
                return new WP_Error('WXR_parse_error', 'This does not appear to be a WXR file, missing/invalid WXR version number');

            return array(
                'authors' => $this->authors,
                'posts' => $this->posts,
                'categories' => $this->categories,
                'tags' => $this->tags,
                'terms' => $this->terms,
                'base_url' => $this->base_url,
                'version' => $wxr_version
            );
        }

        function get_tag($string, $tag) {
            preg_match("|<$tag.*?>(.*?)</$tag>|is", $string, $return);
            if (isset($return[1])) {
                if (substr($return[1], 0, 9) == '<![CDATA[') {
                    if (strpos($return[1], ']]]]><![CDATA[>') !== false) {
                        preg_match_all('|<!\[CDATA\[(.*?)\]\]>|s', $return[1], $matches);
                        $return = '';
                        foreach ($matches[1] as $match)
                            $return .= $match;
                    } else {
                        $return = preg_replace('|^<!\[CDATA\[(.*)\]\]>$|s', '$1', $return[1]);
                    }
                } else {
                    $return = $return[1];
                }
            } else {
                $return = '';
            }
            return $return;
        }

        function process_category($c) {
            return array(
                'term_id' => $this->get_tag($c, 'wp:term_id'),
                'cat_name' => $this->get_tag($c, 'wp:cat_name'),
                'category_nicename' => $this->get_tag($c, 'wp:category_nicename'),
                'category_parent' => $this->get_tag($c, 'wp:category_parent'),
                'category_description' => $this->get_tag($c, 'wp:category_description'),
            );
        }

        function process_tag($t) {
            return array(
                'term_id' => $this->get_tag($t, 'wp:term_id'),
                'tag_name' => $this->get_tag($t, 'wp:tag_name'),
                'tag_slug' => $this->get_tag($t, 'wp:tag_slug'),
                'tag_description' => $this->get_tag($t, 'wp:tag_description'),
            );
        }

        function process_term($t) {
            return array(
                'term_id' => $this->get_tag($t, 'wp:term_id'),
                'term_taxonomy' => $this->get_tag($t, 'wp:term_taxonomy'),
                'slug' => $this->get_tag($t, 'wp:term_slug'),
                'term_parent' => $this->get_tag($t, 'wp:term_parent'),
                'term_name' => $this->get_tag($t, 'wp:term_name'),
                'term_description' => $this->get_tag($t, 'wp:term_description'),
            );
        }

        function process_author($a) {
            return array(
                'author_id' => $this->get_tag($a, 'wp:author_id'),
                'author_login' => $this->get_tag($a, 'wp:author_login'),
                'author_email' => $this->get_tag($a, 'wp:author_email'),
                'author_display_name' => $this->get_tag($a, 'wp:author_display_name'),
                'author_first_name' => $this->get_tag($a, 'wp:author_first_name'),
                'author_last_name' => $this->get_tag($a, 'wp:author_last_name'),
            );
        }

        function process_post($post) {
            $post_id = $this->get_tag($post, 'wp:post_id');
            $post_title = $this->get_tag($post, 'title');
            $post_date = $this->get_tag($post, 'wp:post_date');
            $post_date_gmt = $this->get_tag($post, 'wp:post_date_gmt');
            $comment_status = $this->get_tag($post, 'wp:comment_status');
            $ping_status = $this->get_tag($post, 'wp:ping_status');
            $status = $this->get_tag($post, 'wp:status');
            $post_name = $this->get_tag($post, 'wp:post_name');
            $post_parent = $this->get_tag($post, 'wp:post_parent');
            $menu_order = $this->get_tag($post, 'wp:menu_order');
            $post_type = $this->get_tag($post, 'wp:post_type');
            $post_password = $this->get_tag($post, 'wp:post_password');
            $is_sticky = $this->get_tag($post, 'wp:is_sticky');
            $guid = $this->get_tag($post, 'guid');
            $post_author = $this->get_tag($post, 'dc:creator');

            $post_excerpt = $this->get_tag($post, 'excerpt:encoded');
            $post_excerpt = preg_replace_callback('|<(/?[A-Z]+)|', array(&$this, '_normalize_tag'), $post_excerpt);
            $post_excerpt = str_replace('<br>', '<br />', $post_excerpt);
            $post_excerpt = str_replace('<hr>', '<hr />', $post_excerpt);

            $post_content = $this->get_tag($post, 'content:encoded');
            $post_content = preg_replace_callback('|<(/?[A-Z]+)|', array(&$this, '_normalize_tag'), $post_content);
            $post_content = str_replace('<br>', '<br />', $post_content);
            $post_content = str_replace('<hr>', '<hr />', $post_content);

            $postdata = compact('post_id', 'post_author', 'post_date', 'post_date_gmt', 'post_content', 'post_excerpt', 'post_title', 'status', 'post_name', 'comment_status', 'ping_status', 'guid', 'post_parent', 'menu_order', 'post_type', 'post_password', 'is_sticky'
            );

            $attachment_url = $this->get_tag($post, 'wp:attachment_url');
            if ($attachment_url)
                $postdata['attachment_url'] = $attachment_url;

            preg_match_all('|<category domain="([^"]+?)" nicename="([^"]+?)">(.+?)</category>|is', $post, $terms, PREG_SET_ORDER);
            foreach ($terms as $t) {
                $post_terms[] = array(
                    'slug' => $t[2],
                    'domain' => $t[1],
                    'name' => str_replace(array('<![CDATA[', ']]>'), '', $t[3]),
                );
            }
            if (!empty($post_terms))
                $postdata['terms'] = $post_terms;

            preg_match_all('|<wp:comment>(.+?)</wp:comment>|is', $post, $comments);
            $comments = $comments[1];
            if ($comments) {
                foreach ($comments as $comment) {
                    preg_match_all('|<wp:commentmeta>(.+?)</wp:commentmeta>|is', $comment, $commentmeta);
                    $commentmeta = $commentmeta[1];
                    $c_meta = array();
                    foreach ($commentmeta as $m) {
                        $c_meta[] = array(
                            'key' => $this->get_tag($m, 'wp:meta_key'),
                            'value' => $this->get_tag($m, 'wp:meta_value'),
                        );
                    }

                    $post_comments[] = array(
                        'comment_id' => $this->get_tag($comment, 'wp:comment_id'),
                        'comment_author' => $this->get_tag($comment, 'wp:comment_author'),
                        'comment_author_email' => $this->get_tag($comment, 'wp:comment_author_email'),
                        'comment_author_IP' => $this->get_tag($comment, 'wp:comment_author_IP'),
                        'comment_author_url' => $this->get_tag($comment, 'wp:comment_author_url'),
                        'comment_date' => $this->get_tag($comment, 'wp:comment_date'),
                        'comment_date_gmt' => $this->get_tag($comment, 'wp:comment_date_gmt'),
                        'comment_content' => $this->get_tag($comment, 'wp:comment_content'),
                        'comment_approved' => $this->get_tag($comment, 'wp:comment_approved'),
                        'comment_type' => $this->get_tag($comment, 'wp:comment_type'),
                        'comment_parent' => $this->get_tag($comment, 'wp:comment_parent'),
                        'comment_user_id' => $this->get_tag($comment, 'wp:comment_user_id'),
                        'commentmeta' => $c_meta,
                    );
                }
            }
            if (!empty($post_comments))
                $postdata['comments'] = $post_comments;

            preg_match_all('|<wp:postmeta>(.+?)</wp:postmeta>|is', $post, $postmeta);
            $postmeta = $postmeta[1];
            if ($postmeta) {
                foreach ($postmeta as $p) {
                    $post_postmeta[] = array(
                        'key' => $this->get_tag($p, 'wp:meta_key'),
                        'value' => $this->get_tag($p, 'wp:meta_value'),
                    );
                }
            }
            if (!empty($post_postmeta))
                $postdata['postmeta'] = $post_postmeta;

            return $postdata;
        }

        function _normalize_tag($matches) {
            return '<' . strtolower($matches[1]);
        }

        function feof($fp) {
            if ($this->has_gzip)
                return gzeof($fp);
            return feof($fp);
        }

        function fgets($fp, $len = 8192) {
            if ($this->has_gzip)
                return gzgets($fp, $len);
            return fgets($fp, $len);
        }

    }

}


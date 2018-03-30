<?php
/**
 * This class is main manager for all options theme option
 *
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
if (!class_exists('jwOpt')) {

    class jwOpt {

        private static $_rawOptions = array(); // binds options
        private static $_options = null; // key(id) = value (value can bt array]
        private static $_categories = null;
        private static $_menus = null;
        private static $_builder = null;
        private static $_builder_element = null;
        private static $_panelmenu = null;
        private static $_xml = null;

        public function __construct() {
          
            jwOpt::_getConfig();
            
            self::$_options = get_option(OPTIONS);
            self::$_categories = get_option(CATEGORIES);
            self::$_menus = get_option(MENUS);
            
            if (empty(self::$_options)) {
                self::$_options = self::getRawOptions ();
            }
        }

        
        /**
         * Docasne ulozeni/presani hodnoty. Hodnoty nejsou ulozeny do DB.
         * @param string $name variable name
         * @param mixed $value
         * @param string $type namespace
         * @param int $id (optional) 
         */
        public static function set_option($name, $value, $type = 'opt', $id = '') {
            switch ($type) {
                case 'category':
                    self::$_categories['category_' . $id][$name] = $value;
                    break;
                case 'menus':
                    self::$_menus[$id][$name] = $value;
                    break;
                default:
                    self::$_options[$name] = $value;
                    break;
            }
        }

        private static function getDefault($opt) {
            if (isset($opt['std']))
                return $opt['std'];
            else
                return null;
        }

        private static function getValue($opt, $data = null) {
            if (!is_null($data) && isset($data[$opt['id']])) {
                return $data[$opt['id']];
            } else if (isset($opt['std'])) {
                return $opt['std'];
            } else
                return null;
        }

        private static function _load_file_options(){
            if ( empty(self::$_rawOptions) ) {
                 require THEME_ADMIN . '/options/themeoptions.php';
                 self::$_panelmenu = &$menu;
                 self::$_rawOptions = &$options; 
            }
            
        }
        
        public static function getRawOptions() {
                 self::_load_file_options();
                 
                 return self::$_rawOptions;
        }

// get item options
        public static function get_option($name, $default = null, $type = 'opt', $id = '') {

            switch ($type) {
                case 'category':
                    if (isset(self::$_categories['category_' . $id][$name]))
                        return (self::$_categories['category_' . $id][$name]);
                    else
                        return $default;
                    break;
                case 'menus':
                    if (isset(self::$_menus[$id][$name]))
                        return (self::$_menus[$id][$name]);
                    else
                        return $default;
                    break;
                default:
                    if (isset(self::$_options[$name]))
                        return (self::$_options[$name]);
                    else
                        return $default;
                    break;
            }
        }

// get all options
        public static function get_options($type = 'opt') {
            switch ($type) {
                case 'category':
                    if (is_null(self::$_categories))
                        return get_option(CATEGORIES);
                    else
                        return self::$_categories;
                    break;
                case 'menus':
                    if (is_null(self::$_menus))
                        return get_option(MENUS);
                    else
                        return self::$_menus;
                    break;
                case 'builder':
                    if (is_null(self::$_builder))
                        return get_option(BUILDER);
                    else
                        return self::$_builder;
                    break;
                case 'builder_element':
                    if (is_null(self::$_builder_element))
                        return get_option(BUILDER_ELEMENT);
                    else
                        return self::$_builder_element;
                    break;

                default:
                    if (is_null(self::$_options))
                        return get_option(OPTIONS);
                    else
                        return self::$_options;
                    break;
            }
        }

        /**
         * ulozeni/presani hodnoty. Hodnoty JSOU ulozeny do DB.
          old update_option
         */
        public static function update_one_option($name, $value, $type = 'opt', $id = '') {
            switch ($type) {
                case 'category':
                    self::$_categories['category_' . $id][$name] = $value;
                    self::update_option(self::$_categories, $type);
                    break;
                case 'menus':
                    self::$_menus[$id][$name] = $value;
                    self::update_option(self::$_menus, $type);
                    break;
                default:
                    self::$_options[$name] = $value;
                    self::update_option(self::$_options, $type);
                    break;
            }
        }

        // update type options  old update_options
        public static function update_option($data, $type = 'opt') {
            switch ($type) {
                case 'category':
                    update_option(CATEGORIES, $data);
                    break;
                case 'menus':
                    update_option(MENUS, $data);
                    break;
                case 'builder':
                    update_option(BUILDER, $data);
                    break;
                case 'builder_element':
                    update_option(BUILDER_ELEMENT, $data);
                    break;
                default:
                    update_option(OPTIONS, $data);
                    break;
            }
            self::refresh_options();
        }

        public static function refresh_options() {
            self::$_options = get_option(OPTIONS);
            self::$_categories = get_option(CATEGORIES);
            self::$_menus = get_option(MENUS);
        }

        public static function update_backups() {
            $data_opt = jwOpt::get_options();
            $data_opt['backup_log'] = date('r');
            $data_cat = jwOpt::get_options('category');
            $data_cat['backup_log'] = date('r');
            $data_men = jwOpt::get_options('menus');
            $data_men['backup_log'] = date('r');

            update_option(OPTIONS . BACKUPS, $data_opt);
            update_option(CATEGORIES . BACKUPS, $data_cat);
            update_option(MENUS . BACKUPS, $data_men);
        }

        public static function get_backups($type = OPTIONS) {
            $prom = get_option($type . BACKUPS);
            return $prom;
        }

        public static function getDefaults() {
            self::_load_file_options();
            $default = array();
            
            if (!empty(self::$_rawOptions)) {
                foreach (self::$_rawOptions as $opt) {
                    if (isset($opt['id'])) {
                        //do $_default jsou všechny defaultní hodnoty, kromě sidebarů
                        if ($opt['id'] != 'sidebars') {
                            $default[$opt['id']] = self::getDefault($opt);
                        } else {
                            $default[$opt['id']] = self::get_option($opt['id'], null);
                        }
                    }
                }
                return $default;
            } else {
                return array();
            }     
        }

        public static function getPanelMenu() {
            self::_load_file_options();
            return self::$_panelmenu;
        }

        public static function beforeSave($data) {
            wp_parse_str(stripslashes($data), $data);
            unset($data['security']);
            unset($data['of_save']);
            return $data;
        }

        public static function is($data) {
            if (isset($data) && !empty($data))
                return true;
            else
                return false;
        }

        public static function create_backup_files() {
            global $wp_filesystem;

            $backup_things = array('category', 'menus', 'builder', 'opt');
            $content = '';
            $path = THEME_DIR . '/';
            $filename = $path . 'opt_backup-' . get_current_blog_id() . '.txt';
            foreach ($backup_things as $bck) {
                $content .= strtoupper(get_bloginfo('name') . '-' . $bck) . '_BACKUP' . "\n\n";
                $content .= base64_encode(serialize(jwOpt::get_options($bck)));
                $content .= "\n\n\n\n";
            }
            if (is_writable($path)) {
                WP_Filesystem(null);
                $wp_filesystem->put_contents($filename, $content);
            }
        }

        /* ====================== CONFIG XML ===================== */

        /**
         * Load the config file theme in root direcotry theme
         */
        private function _getConfig() {
            if (is_null(self::$_options)) {

                if (file_exists(locate_template('/config.xml', false, false))) {
                    //if (file_exists(get_template_directory() . '/config.xml')) {
                    self::$_xml = @simplexml_load_file(locate_template('/config.xml', false, false));
                    if (self::$_xml === false) {
                        add_action('admin_notices', array($this, 'adminNoticeXMLError'));
                    }
                    return true;
                }
                add_action('admin_notices', array($this, 'adminNoticeNoexist'));
                return false;
            }
        }

        /**
         * @param string $query xpath query
         * @return array of simplexmlelement objects 
         */
        public static function getXmlSpaceXpath($query = '//options') {
            return self::$_xml->xpath($query);
        }

        /**
         * @param string (direct access over objects) 
         * @return simplexmlelement objects 
         */
        public static function getXmlSpace($namespace) {
            if (isset(self::$_xml->$namespace))
                return self::$_xml->$namespace;
            else
                return null;
        }

        public function adminNoticeNoexist() {
            ?>
            <div class="updated">
                <p>Config file "config.xml" no exists! </p>
            </div>
            <?php
        }

        public function adminNoticeXMLError() {
            ?>
            <div class="updated">
                <p>XML parse error. Please reupload config.xml file in root theme.</p>
            </div>
            <?php
        }

    }

}

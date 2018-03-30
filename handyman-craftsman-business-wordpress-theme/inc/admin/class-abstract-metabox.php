<?php
namespace Handyman\Admin\Metabox;

use Handyman\Core;
use Handyman\Core\Ui;


/**
 * Class AbstractMetaBox
 * @package Roots\Sage\Metaboxes
 */
class Abstract_Metabox
{

    /**
     * Contains the current instance of this class
     * @var object
     */
    protected static $instances = null;


    /**
     * HTML 'id' attribute of the edit screen section.
     * Post ID
     * @var string
     */
    public $id;


    /**
     * Title of the edit screen section, visible to user
     * Default: None
     * @var string
     */
    public $title;


    /**
     * (optional) The type of writing screen on which to show the edit screen section
     * (examples include 'post','page','dashboard','link','attachment','custom_post_type' where custom_post_type is the
     *  custom post type slug)
     *  Default: null
     * @var string
     */
    public $screens = null;


    /**
     * (optional) Show metabox if we are at edit screen for a certain template page.
     *
     * @var array
     */
    public $page_templates = null;


    /**
     * Function that prints out the HTML for the edit screen section. Pass
     * function name as a string. Within a class, you can instead pass an
     * array to call one of the class's methods. See the second example under
     * Example below.
     * Default: None
     * @var callback
     */
    public $callback = null;


    /**
     * The part of the page where the edit screen section should be shown
     * ('normal', 'advanced', or 'side'). (Note that 'side' doesn't exist before 2.7)
     * Default: 'advanced'
     * @var string
     */
    public $context = 'normal';


    /**
     * The priority within the context where the boxes should show
     * ('high', 'core', 'default' or 'low')
     * Default: 'default'
     * @var string
     */
    public $priority = 'default';


    /**
     * Arguments to pass into your callback function. The callback will receive the
     * $post object and whatever parameters are passed through this variable.
     * Default: null
     * @var array
     */
    public $callback_args;


    /**
     * Metabox fields map
     *
     * @var array
     */
    protected $map;


    /**
     * Save the form fields here that will be displayed to the user
     *
     * @var array
     */
    public $fields;


    /**
     * ????
     * @var
     */
    public $category_name = '';


    /**
     * Scripts to enqueue
     *
     * @var array
     */
    public $scripts = array();


    /**
     * @param $options
     */
    protected function __construct($options)
    {
        $this->setProperties($options);

        if (!$this->callback) {
            $this->callback = array(&$this, 'show');
        }

        if (!$this->title) {
            $this->title = ucfirst($this->id);
        }

        // Registering this metabox
        add_action('add_meta_boxes' , array(&$this, 'register'));
        add_action('save_post'      , array(&$this, 'save'));

        // Add Css/Js for metabox
        add_action('admin_print_styles-post.php', array($this, 'enqueue'));
        add_action('admin_print_styles-post-new.php', array($this, 'enqueue'));

        // Filters to add custom classes to the particular metabox
        add_filter('postbox_classes_post_' . $this->id, array($this, 'addClassToMetabox'));
        add_filter('postbox_classes_page_' . $this->id, array($this, 'addClassToMetabox'));

        // Filter request. Leave only fields defined in metabox map
        add_filter('metabox-requests-' . $this->id, array($this, 'filterRequest'));
        add_action('metabox-save-' . $this->id, array(&$this, 'saveAsPostMeta'), 10, 2);
    }


    /**
     * Register metabox
     */
    public function register()
    {
        global $post;

        // this metabox is to be displayed for a certain object type only
        if (!empty($this->screens) && !in_array($this->getCurrentPostType(), $this->screens)) {
            return;
        }

        //Remove metabox for Layers builder template
        if($this->getCurrentPageTemplate() == 'builder.php'){
            return;
        }

        // If set particular page template for this metabox, show metabox ONLY if page has this particular template
        if (!empty($this->page_templates) && !in_array($this->getCurrentPageTemplate(), $this->page_templates)) {
            return;
        }

        // The $callback_args array will be passed to the callback function as the second argument.
        // The first argument is the post's $post object.
        if (!$this->callback_args) {
            $this->callback_args = $this->getFields();
        }

        add_action('metabox-show-' . $this->id, array(&$this, 'renderForm'), 20);

        //@check do we need this here
        //add_action('metabox-save-' . $this->id, [&$this, 'saveAsPostMeta'], 10, 2);

        add_meta_box(
            $this->id,
            $this->title,
            $this->callback,
            $this->getCurrentPostType(),
            $this->context,
            $this->priority,
            $this->callback_args
        );
    }


    /**
     * Do something with the data entered
     *
     * @param $post_id
     *
     * @return bool|void
     */
    function save($post_id)
    {
        // Bail out if running an autosave, ajax, cron or revision.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (defined('DOING_AJAX') && DOING_AJAX) {
            return;
        }

        if (defined('DOING_CRON') && DOING_CRON) {
            return;
        }

        if (wp_is_post_revision($post_id)) {
            return;
        }

        //initializing
        $post = get_post($post_id);

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if (!isset($_REQUEST[str_replace('\\', '', get_class()) . $this->id])) {
            return;
        }

        if (!wp_verify_nonce($_REQUEST[str_replace('\\', '', get_class()) . $this->id], plugin_basename(__FILE__))) {
            return;
        }

        // this metabox is to be displayed for a certain object type only/ on certain screens only
        if (!in_array($post->post_type, $this->screens)) {
            return;
        }

        // Check permissions
        if ('page' == $post->post_type) {
            if (!current_user_can('edit_page', $post->ID)) {
                return;
            }
        } else {
            if (!current_user_can('edit_post', $post->ID)) {
                return;
            }
        }

        do_action('metabox-save-' . $this->id, $this->getRequestPostMetas(), $post->ID);
        return true;
    }


    /**
     * Method is called when we need to instantiate this class
     *
     * @param array $options
     */
    public static function single($id, $options = array())
    {
        if (!isset(self::$instances[$id])) {
            $class = get_called_class();
            $options['class'] = $class; // WTF is this?
            $options['id'] = $id;

            self::$instances[$id] = new $class($options);
        }
        return self::$instances[$id];
    }


    /**
     * Leave only values defined in the map.
     * If map is empty, return request as it is.
     *
     * @param $request
     */
    public function filterRequest($request)
    {
        if (empty($this->map)) {
            return $request;
        } else {

            $fields = array();
            foreach ($this->map as $f) {
                if (isset($f['name'])) {
                    $fields[] = $f['name'];
                }
            }

            foreach ((array)$request as $k => $f) {
                if (!in_array($k, $fields)) {
                    unset($request[$k]);
                }
            }
        }
        return $request;
    }


    /**
     * Set the object properties based on a named array/hash.
     *
     * @param   mixed $properties Either an associative array or another object.
     *
     * @return  boolean
     *
     * @see     set()
     */
    public function setProperties($properties)
    {
        if (is_array($properties) || is_object($properties)) {
            foreach ((array)$properties as $k => $v) {
                $this->_set($k, $v);
            }
            return true;
        }
        return false;
    }


    /**
     * Modifies a property of the object, creating it if it does not already exist.
     *
     * @param   string $property The name of the property.
     * @param   mixed $value The value of the property to set.
     *
     * @return $this
     */
    protected function _set($property, $value = null)
    {
        $_property = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $property)));
        if (method_exists($this, $_property)) {
            return $this->$_property($value);
        }
        $this->$property = $value;
        return $this;
    }


    /**
     * Returns an associative array of object properties.
     *
     * @param   boolean $public If true, returns only the public properties.
     *
     * @return  array
     */
    public function getProperties($public = true)
    {
        $reflect = new ReflectionClass($this);
        $filter = null;

        if ($public) {
            $filter = ReflectionProperty::IS_PUBLIC;
        }
        $props = $reflect->getProperties($filter);
        return $props;
    }


    /**
     * Add single script
     *
     * @param $script_data
     */
    public function addScript($script_data)
    {
        $this->scripts[] = $script_data;
    }


    /**
     * @param $args
     */
    public function renderForm($args)
    {
        global $post;
        $fields = $args['args'];
        echo \Handyman\Admin\Ui\Ui_Factory::single()->renderGroup($fields);
    }


    /**
     * Method saves the data provided as post meta values
     *
     * @param $source
     * @param $post_id
     *
     * @return bool
     */
    public function saveAsPostMeta($source, $post_id)
    {
        $type    = 'post';
        $post_id = (int) $post_id;

        // get the ID of this meta set
        $id = false;
        if (isset($source[$this->id . '_metaid']) && $source[$this->id . '_metaid']) {
            $id = $source[$this->id . '_metaid'];
        }

        // Saving only the specially prefixed items
        foreach ((array)$source as $property => $new) {
            //skip everything but the specially prefixed
            if (strpos($property, $this->id) !== 0) {
                continue;
            }

            //each meta set has it's own ID
            $property = str_replace($this->id, $this->category_name . '_' . $id, $property);
            $property = sanitize_key($property);

            $old = get_metadata($type, $post_id, $property, true);
            if ($new && $new != $old) {
                $new = trim($new);
                update_metadata($type, $post_id, $property, $new);
            } elseif (!$new) {
                delete_metadata($type, $post_id, $property, $old);
            }
        }

        // maybe there's a last id
        if (!$id) {
            if (!$id = get_metadata($type, $post_id, '_metaidlast', true)) {
                $id = 0;
            }
            $id++;
            update_metadata($type, $post_id, '_metaidlast', $id);
        }

        // saving all of the standard items
        foreach ((array)$source as $property => $new) {

            $property = sanitize_key($property);

            //skip special properties that are prefixed with the id
            if (strpos($property, $this->id) === 0) {
                continue;
            }
            $old = get_metadata($type, $post_id, $property, true);

            if ($new === null) {
                delete_metadata($type, $post_id, $property, $old);
            } else {
                $new = trim($new);
                update_metadata($type, $post_id, $property, $new);
            }
        }
        return true;
    }


    /**
     * @return array
     */
    public function getFields()
    {
        global $post;

        if (empty($this->fields)) {

            $custom = isset($post) ? get_post_custom($post->ID) : null;

            $defaults = array(
                'id'        => '',                 // unique
                'name'      => '',                 // unique
                'label'     => '',
                'desc'      => '',
                'type'      => 'text',
                'choices'   => array(),
                'default'   => '',                 //default value
                'value'     => '',
                'attrs'     => array(),                 // (ex. ['class="some classes"', 'multiple="multiple"')
            );

            foreach ((array)$this->map as $key => $field) {
                // Merge defaults with map
                $field = wp_parse_args($field, $defaults);

                // Get predefined options
                if (empty($field['choices']) && in_array($field['type'], [
                        'selectSidebar',
                    ])
                ) {
                    $method = 'getOptions' . substr($field['type'], 6);
                    if (method_exists($this, $method)) {
                        $field['choices'] = $this->{$method}() + $field['choices']; //<-- this is empty WHY we are append it???
                    }
                }

                // SAVED VALUE
                if (is_array($custom) && array_key_exists($field['name'], $custom)) {
                    if (isset($custom[$field['name']][0])) {
                        $field['value'] = maybe_unserialize($custom[$field['name']][0]);
                    } else {
                        $field['value'] = maybe_unserialize($custom[$field['name']]);
                    }
                } elseif ($field['default'] || is_bool($field['default'])) {
                    if (strtolower($field['default']) == 'true') {
                        $field['value'] = true;
                    } elseif (strtolower($field['default']) == 'false') {
                        $field['value'] = false;
                    } else {
                        $field['value'] = $field['default'];
                    }
                } else {
                    // SELECT BOX
                    if (substr($field['type'], 0, 6) == 'select') {
                        if (is_array($field['choices'])) {
                            $field['value'] = key($field['choices']);
                        }
                    } // CHECKBOX TO BOOLEAN
                    elseif (in_array($field['type'], array('checkbox', 'radio'))) {
                        if (!$field['default']) {
                            $field['value'] = false;
                        }
                    }
                }

                // rebuild the fields
                $this->fields[$key] = $field;
            }
        }

        return $this->fields;
    }


    /**
     * Return a list of user defined sidebars
     *
     * @todo this should be in subclass
     */
    /*protected function getOptionsSidebar()
    {

        $sidebars = array();
        $sidebar_keys = Core\Storage::single()->get('user_sidebar');

        if (is_array($sidebar_keys)) {
            foreach ($sidebar_keys as $k) {
                $sidebars[$k] = ucwords(str_replace('_', ' ', $k));
            }
            $sidebars = array_merge(array('none' => __('No Sidebar', TL_DOMAIN)), $sidebars);
        }
        return $sidebars;
    }*/


    /**
     * Display the inner contents of the metabox
     *
     * @param object $post
     * @param mixed $args
     */
    function show($post, $args)
    {
        // Use nonce for verification
        wp_nonce_field(plugin_basename(__FILE__), str_replace('\\', '', get_class()) . $this->id);
        do_action('metabox-show-' . $this->id, $args);
    }


    public function getCurrentPageTemplate()
    {
        global $post;
        if (!$post) {
            return;
        }
        return get_post_meta($post->ID, '_wp_page_template', true);
    }


    /**
     * Method returns the post meta
     */
    public function getRequestPostMetas()
    {
        $ignores = array(
            'post_title',
            'post_name',
            'post_content',
            'post_excerpt',
            'post',
            'post_status',
            'post_type',
            'post_author',
            'ping_status',
            'post_parent',
            'message',
            'post_category',
            'comment_status',
            'menu_order',
            'to_ping',
            'pinged',
            'post_password',
            'guid',
            'post_content_filtered',
            'import_id',
            'post_date',
            'post_date_gmt',
            'tags_input',
            'action'
        );


        // Get field names related to this metabox only
        $fields = array();
        foreach ((array)$this->getFields() as $field) {
            if (!array_key_exists('name', $field)) {
                continue;
            }
            $fields[] = $field['name'];
        }


        // Filter request
        $requests = $_REQUEST;
        foreach ((array)$requests as $k => $request) {
            if ((!empty($fields) && !in_array($k, $fields)) || (in_array($k, $ignores) || strpos($k, 'nounce') !== false)) {
                unset($requests[$k]);
            }
        }

        return apply_filters('metabox-requests-' . $this->id, $requests);
    }


    /**
     * Method is designed to return the currently visible post type
     */
    protected function getCurrentPostType()
    {
        global $post;
        $post_type = false;

        if (isset($post->post_type)) {
            $post_type = $post->post_type;
        }
        return $post_type;
    }


    /**
     * @param $classes
     *
     * @return array
     */
    public function addClassToMetabox($classes)
    {
       $defaults = array('tl-metabox');
       $classes  = array_merge($classes, $defaults);

        return $classes;
    }


    /**
     * handle, file, deps, ver, in_footer
     */
    public function enqueue()
    {
        foreach ($this->scripts as $s) {
            if (is_array($s)) {
                if (substr($s['file'], -3) == '.js') {
                    wp_enqueue_script($s['handle'], $s['file'], $s['deps'], $s['version'], $s['in_footer']);
                } else {
                    wp_enqueue_style($s['handle'], $s['file'], $s['deps'], $s['version']);
                }
            } else {
                if (substr($s, -3) == '.js') {
                    wp_enqueue_script($s);
                }else{
                    wp_enqueue_style($s);
                }
            }
        }
    }
}
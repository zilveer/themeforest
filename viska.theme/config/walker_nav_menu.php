<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 4/16/14
 * Time: 2:55 PM
 */

add_action('register_nav_menu','awe_main_nav');



/*
author:pirates
*/
add_action('wp_ajax_chulan_add_menu', 'wo_chulan_add_menu');
// add_action('wp_ajax_nopriv_chulan_add_menu', 'wo_chulan_add_menu');
add_action('admin_head', 'awe_chulan_nav_menu_edit_area');
add_action('admin_enqueue_scripts', 'wo_enqueue_backbone_js');


// add_filter('nav_menu_css_class','remove_nav_menu_classes');
function remove_nav_menu_classes($classes) {

    if (isset($classes))
    {
        foreach ($classes as $k => $v)
        {
            if ($v == 'current-menu-item')
            {
                unset($classes[$k]);
            }
        }
    }
    return $classes;
}

/**
 * Return RS edit walker class name.
 * @return string
 */
function awe_walker_nav_menu_edit( $walker, $menu_id ) {
    return 'wo_Walker_Nav_Menu_Edit';
}

function wo_chulan_add_menu()
{   
    $data = isset($_POST['data']) ? $_POST['data'] : '';

    // $aChulanMenu = array();
    @parse_str(json_decode(stripslashes($data), TRUE ), $datacontent);
    // $data = unserialize($data);


    $aChulanMenu = isset($datacontent['chulan']) ? $datacontent['chulan'] : array();
    

    $item_ids = array();
   

    $menu_id = 2;
    $_actual_db_id = 0;

    require_once( dirname(__FILE__) . '/wo-nav-edit-menu-item.php' );

    if ( !empty($aChulanMenu) )
    {
        foreach ($aChulanMenu as $k => $getChecked)
        {
            if ( isset($getChecked['menu-item-checked']) && !empty($getChecked['menu-item-checked']) )
            {
                $args = array(
                   'menu-item-object-id'    => ( isset( $getChecked['menu-item-checked'] ) ? $getChecked['menu-item-checked'] : '' ),
                    'menu-item-object'      => ( isset( $getChecked['menu-item-object'] ) ? $getChecked['menu-item-object'] : '' ),
                    'menu-item-db-id'       => ( isset( $getChecked['menu-item-db-id'] ) ? $getChecked['menu-item-db-id'] : '' ),
                    'menu-item-title'       => ( isset( $getChecked['menu-item-title'] ) ? $getChecked['menu-item-title'] : '' ),
                    'menu-item-url'         => ( isset( $getChecked['menu-item-url'] ) ? $getChecked['menu-item-url'] : '' ),
                    'menu-item-type'        => 'custom',
                    // 'menu-item-object'       => ( isset( $getChecked['menu-item-object'] ) ? $getChecked['menu-item-object'] : '' ),
                    'menu-item-parent-id'   => ( isset( $getChecked['menu-item-parent-id'] ) ? $getChecked['menu-item-parent-id'] : '' ),
                    'menu-item-attr-title'  => ( isset( $getChecked['menu-item-attr-title'] ) ? $getChecked['menu-item-attr-title'] : '' ),
                    'menu-item-classes'     => '',
                    'menu-item-xfn'         => ( isset( $getChecked['menu-item-xfn'] ) ? $getChecked['menu-item-xfn'] : '' ),
                    'menu-item-section-name'=> ( isset( $getChecked['menu-item-section-name'] ) ? $getChecked['menu-item-section-name'] : '' ),
                );
                $item_ids[] = $args;
            }
        }
        $item_ids = wo_wp_save_nav_menu_items( 0, $item_ids );
        if ( is_wp_error( $item_ids ) )
            wp_die( 0 );

        $menu_items = array();

        foreach ( (array) $item_ids as $menu_item_id )
        {
            $menu_obj = get_post( $menu_item_id );
            if ( ! empty( $menu_obj->ID ) ) {
                $menu_obj = wp_setup_nav_menu_item( $menu_obj );
                $menu_obj->label = $menu_obj->title; // don't show "(pending)" in ajax-added items
                $menu_items[] = $menu_obj;
            }
        }
        $walker_class_name = apply_filters( 'wp_edit_nav_menu_walker', 'wo_Walker_Nav_Menu_Edit', $_POST['menu'] );

        if ( ! class_exists( $walker_class_name ) )
            wp_die(0);

        if ( ! empty( $menu_items ) ) {
            $args = array(
                'after' => '',
                'before' => '',
                'link_after' => '',
                'link_before' => '',
                'walker' => new $walker_class_name,
            );
            echo walk_nav_menu_tree( $menu_items, 0, (object) $args );
        }
    }


    die();
}


function wo_wp_save_nav_menu_items( $menu_id = 0, $menu_data = array() ) {
    $menu_id = (int) $menu_id;
    $items_saved = array();

    if ( 0 == $menu_id || is_nav_menu( $menu_id ) ) {

        // Loop through all the menu items' POST values
        foreach( (array) $menu_data as $_possible_db_id => $_item_object_data ) {
            if (
                empty( $_item_object_data['menu-item-object-id'] ) && // checkbox is not checked
                (
                    ! isset( $_item_object_data['menu-item-type'] ) || // and item type either isn't set
                    in_array( $_item_object_data['menu-item-url'], array( 'http://', '' ) ) || // or URL is the default
                    ! ( 'custom' == $_item_object_data['menu-item-type'] && ! isset( $_item_object_data['menu-item-db-id'] ) ) || // or it's not a custom menu item (but not the custom home page)
                    ! empty( $_item_object_data['menu-item-db-id'] ) // or it *is* a custom menu item that already exists
                )
            ) {
                continue; // then this potential menu item is not getting added to this menu
            }

            // if this possible menu item doesn't actually have a menu database ID yet
            if (
                empty( $_item_object_data['menu-item-db-id'] ) ||
                ( 0 > $_possible_db_id ) ||
                $_possible_db_id != $_item_object_data['menu-item-db-id']
            ) {
                $_actual_db_id = 0;
            } else {
                $_actual_db_id = (int) $_item_object_data['menu-item-db-id'];
            }

            $args = array(
//                'menu-item-object-id' => ( isset( $_item_object_data['menu-item-object-id'] ) ? $_item_object_data['menu-item-object-id']: '' ),
                    'menu-item-db-id'       => ( isset( $_item_object_data['menu-item-db-id'] ) ? $_item_object_data['menu-item-db-id'] : '' ),
                    'menu-item-object'      => ( isset( $_item_object_data['menu-item-object'] ) ? $_item_object_data['menu-item-object'] : '' ),
                    'menu-item-parent-id'   => ( isset( $_item_object_data['menu-item-parent-id'] ) ? $_item_object_data['menu-item-parent-id'] : '' ),
                    'menu-item-type'        => ( isset( $_item_object_data['menu-item-type'] ) ? $_item_object_data['menu-item-type'] : '' ),
                    'menu-item-title'       => ( isset( $_item_object_data['menu-item-title'] ) ? $_item_object_data['menu-item-title'] : '' ),
                    'menu-item-url'         => ( isset( $_item_object_data['menu-item-url'] ) ? $_item_object_data['menu-item-url'] : '' ),
                    'menu-item-attr-title'  => ( isset( $_item_object_data['menu-item-attr-title'] ) ? $_item_object_data['menu-item-attr-title'] : '' ),
                    'menu-item-classes'     => '',
                    'menu-item-xfn'         => ( isset( $_item_object_data['menu-item-xfn'] ) ? $_item_object_data['menu-item-xfn'] : '' ),
            );

            $items_saved[] = wp_update_nav_menu_item( $menu_id, $_actual_db_id, $args );

        }
    }
    return $items_saved;
}

function wo_enqueue_backbone_js()
{
    $screens = get_current_screen();

    if ( $screens->id == 'nav-menus' )
    {
        wp_register_script('fproject_with_backbone', get_template_directory_uri() . '/assets/js/jquery.pirates_backbone.js', array('jquery-form'), '1.0', false);

        wp_enqueue_script('jquery-form');
        wp_enqueue_script('fproject_with_backbone');
        wp_localize_script('fproject_with_backbone', 'WILOKE', array('ajaxurl'=>admin_url('admin-ajax.php')));
    }
}

function awe_chulan_nav_menu_edit_area()
{

    add_meta_box( 'nav-menu-mega-config', 'Viska Menu', 'showMegaConfigBoxx' , 'nav-menus', 'side', 'high' );
}

/*
 * @reference wp-include/nav-menu
 */
function showMegaConfigBoxx()
{
    $_nav_menu_placeholder = 1000;


    $homeUrl = home_url();
    $aSetting = array('#home'=>'Home','#banner'=>'Home Hidden','#about'=>'About Us','#skill'=>'Skills', '#team'=>'Team','#funfacts'=>'Fun Facts', '#work'=>'Work','#process'=>'Our Process','#twitter'=>'Twitter', '#testimonial'=>'Testimonial', '#plans'=>'Pricing','#services'=>'Services','#news'=>'Lasted Posts','#client'=>'Client', '#contact'=>'Contact','#map' => 'Map');
?>

<div id="posttype-edit-menu-item" class="posttypediv">
    <ul class="categorychecklist form-no-clear">
        <?php foreach ($aSetting as $k => $v) : ?>
        <li>
            <label class="menu-item-title">
                <input type="checkbox" name="chulan[<?php echo $_nav_menu_placeholder ?>][menu-item-checked]" value="1" class="code pirates-chulan-menu menu-item-textbox"/>
                <input  name="chulan[<?php echo $_nav_menu_placeholder ?>][menu-item-url]" type="hidden" class="code pirates-chulan-menu menu-item-textbox" value="<?php echo $homeUrl . '/' . $k; ?>" />
                <input  name="chulan[<?php echo $_nav_menu_placeholder ?>][menu-item-title]" type="hidden" class="pirates-chulan-menu regular-text menu-item-textbox input-with-default-title" title="<?php esc_attr_e($v); ?>"  value="<?php echo $v; ?>"/>
                <?php  echo $v ?>
            </label>
        </li>
        <?php
            ++$_nav_menu_placeholder;
           endforeach;
        ?>
    </ul>
    <p class="button-controls">
			<span class="add-to-menu">
				<input type="submit" class="button-secondary right" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-custom-menu-item" id="submit-chulanmenu" />
				<span class="spinner"></span>
			</span>
    </p>
</div>

<?php
}


function awe_main_nav($args=false)
{
    $class = array(
        "ul"    =>  "",
        "li"    =>  "",
        "a"     =>  "",
        "children"  =>""
    );

    $args  = array(
        'menu' => 'main_menu', /* menu name */
        'menu_class' => 'menu-nav ',
        'container' => 'false', /* container class */
        'fallback_cb' => '', /* menu fallback */
        'menu_id' => 'main-menu',
        'theme_location'    => 'main_menu',
        'walker' => new AWE_Walker_Nav_Menu($class)
    );
    wp_nav_menu($args);
}

function awe_top_nav($args=false){
    $class = array(
        "ul"    =>  "",
        "li"    =>  "",
        "a"     =>  "",
    );

    $args  = array(
        'menu' => 'top_menu', /* menu name */
        'menu_class' => 'menu-top',
        'container' => 'false', /* container class */
        'fallback_cb' => '', /* menu fallback */
        'menu_id' => 'menu-top',
        'theme_location'    => 'top_menu',
        'walker' => new AWE_Walker_Nav_Menu($class)
    );
    wp_nav_menu($args);
}


function awe_menu_left($args=false){
    $class = array(
        "ul"    =>  "",
        "li"    =>  "",
        "a"     =>  "",
    );

    $args  = array(
        'menu' => 'left_menu', /* menu name */
        'menu_class' => '',
        'container' => 'false', /* container class */
        'fallback_cb' => '', /* menu fallback */
        'menu_id' => '',
        'theme_location'    => 'left_menu',
        'walker' => new AWE_Walker_Nav_Menu($class)
    );
    wp_nav_menu($args);
}

class AWE_Walker_Nav_Menu extends Walker_Nav_Menu
{
    public $add_class;
    public $insert_current=false;
    function __construct($add_class)
    {

        $this->add_class = $add_class;
    }
    function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        // If the item has children, add the dropdown class for bootstrap
        if ( $args->has_children ) {
            $class_names = $this->add_class['li'];
        }
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;
        $class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
        if ( $args->has_children ) {
            $class_names .= " ". isset($this->add_class['children']) ? $this->add_class['children'] : '';
        }
        $class_names = ' class="'. esc_attr( $class_names ) . '"';
        $output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';
        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

        if ( $args->has_children ) {
         $attributes .= $this->add_class['a'];
         }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
        $item_output .= $args->link_after;

        // if the item has children add the caret just before closing the anchor tag
        // if ( $args->has_children ) {
        //     $item_output .= '<b class="caret"></b></a>';
        // }
        // else {
        //     $item_output .= '</a>';
        // }
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
    } // end start_el function

    function end_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){
        $output .= '</li>';
    }

    function start_lvl(&$output, $depth = 0, $args = Array()) {
        //var_dump($output);
        $indent = str_repeat("\t", $depth);
        $output .= "<ul class='sub-menu'>";
    }
    function end_lvl(&$output, $depth = 0, $args = Array()){
        $output .= '</ul>';
    }

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
        $current_element_markers = array( 'current-menu-item');
        $current_class = array_intersect( $current_element_markers, $element->classes );
        if($current_class && !in_array('menu-item-home',$element->classes))
            $element->classes[] = 'current-page-item';
//        else
//            $element->classes = array('transition');
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}

// menu width title attribute 


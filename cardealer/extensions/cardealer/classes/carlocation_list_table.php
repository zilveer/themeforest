<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class Carlocation_List_Table extends WP_List_Table {

    /**
     * Constructor, we override the parent to pass our own arguments
     * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
     */
    function __construct() {
		$hook_suffix = isset($GLOBALS['hook_suffix']) ? $GLOBALS['hook_suffix'] : 'car_page_tmm_cardealer_carlocation';
        parent::__construct(array(
            'singular' => 'wp_list_carlocation', //Singular label
            'plural' => 'wp_list_carlocations', //plural label, also this well be one of the table css class
            'ajax' => true, //We won't support Ajax for this table
			'screen' => $hook_suffix,
        ));
    }

    public static function build_table() {
        $LocationListTable = new Carlocation_List_Table();

        if (isset($_GET['s'])) {
            $LocationListTable->prepare_items($_GET['s']);
        } else {
            $LocationListTable->prepare_items();
        }
        echo '<form method="get" action=""> <input type="hidden" name="page" value="tmm_cardealer_carlocation" /><input type="hidden" name="post_type" value="car" />';
        $LocationListTable->search_box('search', 'search_id');
        echo '</form>';
        $LocationListTable->display();
    }

    public static function add_new_cars_location() {
        $name = $_REQUEST['name'];
        $parent_id = (int) $_REQUEST['parent_id'];
        $slug = $_REQUEST['slug'];
        if (empty($slug)) {
            $slug = str_replace(' ', '', mb_strtolower($name));
        }
        global $wpdb;
        $wpdb->query($wpdb->prepare("INSERT INTO tmm_cars_locations (`name`, `slug`, `parent_id`) VALUES (%s, %s, %d)", $name, $slug, $parent_id));
        Carlocation_List_Table::build_table();
        exit;
    }

    public static function delete_cars_location() {
        $id = $_REQUEST['id'];
        global $wpdb;
        $wpdb->query($wpdb->prepare("DELETE FROM tmm_cars_locations WHERE id = '%d'", $id));
        Carlocation_List_Table::build_table();
        exit;
    }

    public static function update_cars_location() {
        global $wpdb;
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $name = trim($name);
        $slug = $_REQUEST['slug'];
        $wpdb->update( 'tmm_cars_locations', array('name' => $name, 'slug' => $slug), array('id' => $id), array('%s', '%s'), array('%d') );
        Carlocation_List_Table::build_table();
        exit;
    }
    
    public static function doaction_delete_cars_locations(){
        global $wpdb;
        $ids = trim($_REQUEST['ids'], ',');
        $ids = array_map( 'intval', explode(',', $ids) );        
        $query="DELETE FROM tmm_cars_locations WHERE id in (".implode(',', $ids).")";
        $wpdb->query($query);                       
        Carlocation_List_Table::build_table();
        exit;
    }
    
	public static function doaction_delete_cars_state($state_ids = array()){
        global $wpdb;
        if(is_array($state_ids) && count($state_ids)){
			$ids = $state_ids;
		}else{//if ajax
			$ids = trim($_REQUEST['ids'], ',');
			$ids = array_map( 'intval', explode(',', $ids) );
		}
		/* remove cities related to state */
		$city_ids = self::get_children_items_ids($ids);
		if(is_array($city_ids) && count($city_ids)){
			$query="DELETE FROM tmm_cars_locations WHERE id in (".implode(',', $city_ids).")";
			$wpdb->query($query);
		}
		/* remove state */
        $query="DELETE FROM tmm_cars_locations WHERE id in (".implode(',', $ids).")";
        $wpdb->query($query);
		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'doaction_delete_cars_state'){//if ajax
			Carlocation_List_Table::build_table();
			exit;
		}
    }
	
	public static function doaction_delete_cars_country(){
        global $wpdb;
        $ids = trim($_REQUEST['ids'], ',');
        $ids = array_map( 'intval', explode(',', $ids) );
		/* remove states related to country */
		$state_ids = self::get_children_items_ids($ids);
		if(is_array($state_ids) && count($state_ids)){
			self::doaction_delete_cars_state($state_ids);
		}
		/* remove country */
        $query="DELETE FROM tmm_cars_locations WHERE id in (".implode(',', $ids).")";
        $wpdb->query($query);
		
        Carlocation_List_Table::build_table();
        exit;
    }

    public static function get_children_items_ids($ids = array()) {
        global $wpdb;
        $items = array();
        if (count($ids)) {
            $query = "SELECT `id` FROM tmm_cars_locations WHERE parent_id in (" . implode(',', $ids) . ") ORDER BY `name`";
            $items = $wpdb->get_col($query);
        }
        return $items;
    }
	
    public static function get_children_items($ids = array()) {
        global $wpdb;
        $items = array();
        if (count($ids)) {
            $query = "SELECT * FROM tmm_cars_locations WHERE parent_id in (" . implode(',', $ids) . ") ORDER BY `name`";
            $items = $wpdb->get_results($query);
        }
        return $items;
    }
	
    public static function get_children_items_count($ids = array()) {
        global $wpdb;
        $count = 0;
        if (count($ids)) {
            $query = "SELECT count(*) FROM tmm_cars_locations WHERE parent_id in (" . implode(',', $ids) . ")";
            $count = (int) $wpdb->get_var($query);
        }
        return $count;
    }

    public static function get_serch_locations($s) {
        global $wpdb;
        $items = array();
        $result = array();

        if ($s == '') {
            return $items;
        }

        $query = "SELECT * FROM tmm_cars_locations WHERE `name` LIKE '%" . trim($s) . "%'";
        $items = $wpdb->get_results($query);

        foreach ($items as $item) {
            $result[] = array('id' => $item->id, 'name' => $item->name, 'slug' => $item->slug);
        }

        return $result;
    }

    public static function get_all_locations($page, $max_count=20) {
		$limit = ($page - 1) * $max_count;
		$result = array();
		$count = 0;
		
		$countries = Carlocation_List_Table::get_children_items(array(0));
		
		foreach ($countries as $country) {
			$count++;
			if($count > $limit+$max_count){
				break;
			}
			if($count > $limit){
				$result[$country->id] = array(
					'name' => $country->name,
					'slug' => $country->slug,
					'id' => $country->id
				);
			}
			
			$states = Carlocation_List_Table::get_children_items(array($country->id));
			foreach ($states as $state) {
				$count++;
				if($count > $limit+$max_count){
					break;
				}
				if($count > $limit){
					$result[$state->id] = array(
					   'name' => '&#8212; ' . $state->name,
					   'slug' => $state->slug,
					   'id' => $state->id
					);
				}
				
				$cities_count = Carlocation_List_Table::get_children_items_count(array($state->id));
				if( ($count + $cities_count) > $limit){
					$cities = Carlocation_List_Table::get_children_items(array($state->id));
					foreach ($cities as $city) {
						$count++;
						if($count > $limit+$max_count){
							break;
						}
						if($count > $limit){
							$result[$city->id] = array(
								'name' => '&#8212; ' . '&#8212; ' . $city->name,
								'slug' => $city->slug,
								'id' => $city->id
							);
						}
					}
				}else{
					$count = $count+$cities_count;
				}
			}
		}
		
		return $result;
    }

    function get_columns() {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug'
        );
        return $columns;
    }

    public function get_sortable_columns() {
        return $sortable = array(
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug'
        );
    }

    function get_bulk_actions() {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function column_cb($item) {
        return sprintf(
                '<input type="checkbox" name="book[]" value="%s" />', $item['ID']
        );
    }

    /**
     * Prepare the table with different parameters, pagination, columns and table elements
     */
    function prepare_items() {
        global $wpdb, $_wp_column_headers;
        $screen = get_current_screen();
        $carlocations = array();
		
		//How many to display per page?
        $perpage = 20;
        //Which page is this?
        $paged = !empty($_GET["paged"]) ? intval($_GET["paged"]) : '';
        //Page Number
        if (empty($paged) || !is_numeric($paged) || $paged <= 0) {
            $paged = 1;
        }
		
        $totalitems = (int) $wpdb->get_var("SELECT count(*) FROM tmm_cars_locations");
        //How many pages do we have in total?
        $totalpages = ceil($totalitems / $perpage);
        $current_page = $this->get_pagenum();

        if (isset($_GET['s'])) {
            $allitems_data = $this->get_serch_locations($_GET['s']);
			$data = array_slice($allitems_data, ( ( $current_page - 1 ) * $perpage), $perpage);
        } else {
            $data = $this->get_all_locations($paged, $perpage);
        }

        /* -- Register the pagination -- */
        $this->set_pagination_args(array(
            "total_items" => $totalitems,
            "total_pages" => $totalpages,
            "per_page" => $perpage,
        ));


        list( $columns, $hidden, $sortable ) = $this->get_column_info();
        $columns = $this->get_columns();

        $this->_column_headers = array($columns, $hidden, $sortable);
        /* -- Fetch the items -- */

        $this->items = $data;
    }

    function display_rows() {

        //Get the records registered in the prepare_items method
        $records = $this->items;

        //Get the columns registered in the get_columns and get_sortable_columns methods
        list( $columns, $hidden ) = $this->get_column_info();
        $columns = $this->get_columns();

        //Loop for each record
        if (count($records)) {
            foreach ($records as $key => $country) {
                
                //Open the line
                ?>
                <tr id="record_<?php echo $country['id'] ?>">
                <?php
                foreach ($columns as $column_name => $column_display_name) {

                    //Style attributes for each col
                    $class = "class='$column_name column-$column_name'";
                    $style = "";
                    if (in_array($column_name, $hidden))
                        $style = ' style="display:none;"';
                    $attributes = $class . $style;

                    //edit link
                    $editlink = '/wp-admin/link.php?action=edit&link_id=' . $country['id'];

                    //Display the cell
                    switch ($column_name) {
                        case "id":
                            ?><td <?php echo $attributes ?>><?php echo stripslashes($country['id']) ?> </td><?php
                                break;
                            case "name":
                                ?><td <?php echo $attributes ?>><strong><span class="row-title" href="<?php echo $editlink ?>"><?php echo stripslashes($country['name']) ?> </span></strong><br>
                                <div class="row-actions">
                                    <span class="inline hide-if-no-js">
                                        <a class="editinline" data-slug="<?php echo stripslashes($country['slug']) ?>" data-name="<?php echo stripslashes($country['name']) ?>" data-id="<?php echo stripslashes($country['id']) ?>" href="#">Edit</a> |
                                    </span>
                                    <span class="delete">
                                        <a class="delete-tag" data-name="<?php echo stripslashes($country['name']) ?>" data-id="<?php echo stripslashes($country['id']) ?>" href="#">Delete</a>
                                    </span>                                    
                                </div>                
                            </td><?php
                            break;
                        case "slug":
                            ?><td <?php echo $attributes ?>><?php echo stripslashes($country['slug']) ?></td><?php
                            break;
                        case "cb" :
                            ?><th class="check-column" scope="row">
                                <label class="screen-reader-text" for="cb-select-<?php echo $country['id'] ?>">Select <?php echo $country['name'] ?></label>
                                <input id="cb-select-<?php echo $country['id'] ?>" type="checkbox" value="<?php echo $country['id'] ?>" name="delete_tags[]">
                            </th><?php
                            break;
                    }
                }

                //Close the line
                ?>
                </tr>
                <?php
                // $states = $country['states'];
            }
        }
    }

}

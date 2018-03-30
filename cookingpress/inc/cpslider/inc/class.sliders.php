<?php
/**
 * Class for slider object
 */
class CPSliders
{
    public $slug;
    public $name;
    function __construct($name,$type)
    {
        $this->slug = sanitize_title_with_dashes($name);
        $this->name = $name;
        $this->type = $type;
    }

    public function save() {
        if ( ! get_option('cp_sliders' ) ) {
            // create option
            add_option( 'cp_sliders', array(), '', 'yes' );
        }
        $current_sliders = get_option( 'cp_sliders');
        $current_sliders[] = $this;
        update_option( 'cp_sliders', $current_sliders );
    }



    public function delete() {
        if ( ! get_option('cp_sliders' ) ) {
            return false;
        }

        // get the current slide groups
        $current_sliders = get_option( 'cp_sliders' );

        $id = false;

        // loop through to find one with this original slug
        foreach( $current_sliders as $key => $sliders ) {
            if ( $sliders->slug == $this->slug ) {
                $id = $key;
                break;
            }
        }

        if ( false === $id )
        {
            return false;
        }
        else {
            // remove this group at $theIndex
            unset($current_sliders[$id]);
        }

        // save the groups list
        update_option( 'cp_sliders', $current_sliders );
    }
}




if(!class_exists('WP_List_Table')) :
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
endif;

class CPSliders_Sliders_Table extends WP_List_Table {

 function __construct(){

    return parent::__construct( array(
            'singular'  => __( 'slider', 'chow' ),     //singular name of the listed records
            'plural'    => __( 'sliders', 'chow' ),   //plural name of the listed records
            'ajax'      => false        //does this table support ajax?

            ) );
}

function get_columns(){
  $columns = array(
                'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
                'name'      =>  __('Name', 'chow'),
                'slug'      =>  __('Slug', 'chow'),
                'type'      =>  __('Type', 'chow'),
                'slides_count'      =>  __('Slides', 'chow')
                );
  return $columns;
}


public function get_sortable_columns() {
    /*
        Return the list of columns, and associated entries
        within the result record, that by which the user
        can sort the table.
    */

        return array();

    }

    public function column_name($item)
    {
    /*
        Display handler for the group name, first column.

        We need to display the name, as well as Edit/Delete inline links for this SG.
    */

        echo esc_html( stripslashes( $item->name ) );
        ?><br/><div class="row-actions">
        <span class="edit"><a href="admin.php?page=cp-slider&amp;slider=<?php echo esc_attr( $item->slug ); ?>"><?php _e( 'Edit', 'chow' ); ?></a></span> |
        <span class="trash"><a class="submitdelete" href="admin.php?page=cp-slider&amp;action=remove&amp;slider=<?php echo esc_attr( $item->slug ); ?>&amp;_wpnonce=<?php echo wp_create_nonce( 'remove_slider' );?>"
            onclick="return confirm('<?php _e( 'Are you sure you want to delete this slide group?\n\nThis action cannot be undone.', 'chow' ); ?>');"
            ><?php _e( 'Remove', 'chow' ); ?></a></span>
            </div><?php
        }

        public function column_slides_count( $item ) {
    /*
        Gather a count of this slide group for the column.
    */

       // return count( get_option( 'total_slider_slides_' . esc_attr( $item->slug ) ) );

    }


    public function column_default( $item, $col_name ) {
    /*
        The default display handler for any column that does
        not have its own column_name() handler in the class.

        We should return the item for display.
    */

        return esc_html( stripslashes( $item->$col_name ) );
    }


    public function column_slug( $item ) {
    /*
        The default display handler for any column that does
        not have its own column_name() handler in the class.

        We should return the item for display.
    */

        return esc_html( stripslashes( $item->slug ) );
    }
  public function column_type( $item ) {
    /*
        The default display handler for any column that does
        not have its own column_name() handler in the class.

        We should return the item for display.
    */

        return esc_html( stripslashes( $item->type ) );
    }

    public function column_cb( $item ) {
        return sprintf(
            '<input class="slide-group-checkbox" type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],
            /*$2%s*/ $item->slug
            );
    }

    public function get_bulk_actions() {
    /*
        Define the bulk actions that can be performed
        against the table data.
    */

        $actions = array(
            'remove'            => __('Remove', 'chow')
            );


        return $actions;
    }


    public function get_total_items()
    {
    /*
        Quickly get a count for the total number of items
        so that we can do pagination properly.
    */

        return count( get_option( 'cp_sliders' ) );

    }

    public function get_sliders()
    {
    /*
        Get the slide groups from the options table, so
        we can display them in the table.
    */

        $sliders = get_option( 'cp_sliders' );
        return $sliders;

    }

    public function prepare_items()
    {
    /*
        Prepare data for display -- getting the data and returning
        the data for the table.
    */

        $per_page = 10;

        $columns = $this->get_columns();
        $hidden = array();
        $sortable_columns = $this->get_sortable_columns();

        $this->_column_headers = array($columns, $hidden, $sortable_columns);

        // pagination
        $current_page = $this->get_pagenum();

        $total_items = $this->get_total_items();
        $data = $this->get_sliders();

        // get the data

        $this->items = $data;

        $this->set_pagination_args(array(

            'total_items'   =>  $total_items,
            'per_page'      =>  $per_page,
            'total_pages'   =>  ceil( $total_items / $per_page )

            ));

    }

    public function no_items()
    {
    /*
        Return the text to display when there are no items.
    */

        echo __( 'Click &lsquo;Add New&rsquo; to create a new slider.', 'chow' );

    }
}

?>
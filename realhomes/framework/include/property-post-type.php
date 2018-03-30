<?php
/* Property Custom Post Type */
if( !function_exists( 'create_property_post_type' ) ){
    function create_property_post_type(){

      $labels = array(
            'name' => __( 'Properties','framework'),
            'singular_name' => __( 'Property','framework' ),
            'add_new' => __('Add New','framework'),
            'add_new_item' => __('Add New Property','framework'),
            'edit_item' => __('Edit Property','framework'),
            'new_item' => __('New Property','framework'),
            'view_item' => __('View Property','framework'),
            'search_items' => __('Search Property','framework'),
            'not_found' =>  __('No Property found','framework'),
            'not_found_in_trash' => __('No Property found in Trash','framework'),
            'parent_item_colon' => ''
          );

      $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'has_archive' => true,
            'capability_type' => 'post',
            'hierarchical' => true,
            'menu_icon' => 'dashicons-building',
            'menu_position' => 5,
            'supports' => array('title','editor','thumbnail','revisions','author','page-attributes','excerpt'),
            'rewrite' => array( 'slug' => __('property', 'framework') )
      );

      register_post_type('property',$args);

    }
}
add_action('init', 'create_property_post_type');


/* Create Property Taxonomies */
if( !function_exists( 'build_taxonomies' ) ){
    function build_taxonomies(){
        $labels = array(
            'name' => __( 'Property Features', 'framework' ),
            'singular_name' => __( 'Property Features', 'framework' ),
            'search_items' =>  __( 'Search Property Features', 'framework' ),
            'popular_items' => __( 'Popular Property Features', 'framework' ),
            'all_items' => __( 'All Property Features', 'framework' ),
            'parent_item' => __( 'Parent Property Feature', 'framework' ),
            'parent_item_colon' => __( 'Parent Property Feature:', 'framework' ),
            'edit_item' => __( 'Edit Property Feature', 'framework' ),
            'update_item' => __( 'Update Property Feature', 'framework' ),
            'add_new_item' => __( 'Add New Property Feature', 'framework' ),
            'new_item_name' => __( 'New Property Feature Name', 'framework' ),
            'separate_items_with_commas' => __( 'Separate Property Features with commas', 'framework' ),
            'add_or_remove_items' => __( 'Add or remove Property Features', 'framework' ),
            'choose_from_most_used' => __( 'Choose from the most used Property Features', 'framework' ),
            'menu_name' => __( 'Property Features', 'framework' )
        );

        register_taxonomy(
            'property-feature',
            array('property'),
            array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => __('property-feature', 'framework'))
            )
        );


        $type_labels = array(
            'name' => __( 'Property Type', 'framework' ),
            'singular_name' => __( 'Property Type', 'framework' ),
            'search_items' =>  __( 'Search Property Types', 'framework' ),
            'popular_items' => __( 'Popular Property Types', 'framework' ),
            'all_items' => __( 'All Property Types', 'framework' ),
            'parent_item' => __( 'Parent Property Type', 'framework' ),
            'parent_item_colon' => __( 'Parent Property Type:', 'framework' ),
            'edit_item' => __( 'Edit Property Type', 'framework' ),
            'update_item' => __( 'Update Property Type', 'framework' ),
            'add_new_item' => __( 'Add New Property Type', 'framework' ),
            'new_item_name' => __( 'New Property Type Name', 'framework' ),
            'separate_items_with_commas' => __( 'Separate Property Types with commas', 'framework' ),
            'add_or_remove_items' => __( 'Add or remove Property Types', 'framework' ),
            'choose_from_most_used' => __( 'Choose from the most used Property Types', 'framework' ),
            'menu_name' => __( 'Property Types', 'framework' )
        );

        register_taxonomy(
            'property-type',
            array( 'property' ),
            array(
                'hierarchical' => true,
                'labels' => $type_labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => __('property-type', 'framework'))
            )
        );

        $city_labels = array(
            'name' => __( 'Property City', 'framework' ),
            'singular_name' => __( 'Property City', 'framework' ),
            'search_items' =>  __( 'Search Property Cities', 'framework' ),
            'popular_items' => __( 'Popular Property Cities', 'framework' ),
            'all_items' => __( 'All Property Cities', 'framework' ),
            'parent_item' => __( 'Parent Property City', 'framework' ),
            'parent_item_colon' => __( 'Parent Property City:', 'framework' ),
            'edit_item' => __( 'Edit Property City', 'framework' ),
            'update_item' => __( 'Update Property City', 'framework' ),
            'add_new_item' => __( 'Add New Property City', 'framework' ),
            'new_item_name' => __( 'New Property City Name', 'framework' ),
            'separate_items_with_commas' => __( 'Separate Property Cities with commas', 'framework' ),
            'add_or_remove_items' => __( 'Add or remove Property Cities', 'framework' ),
            'choose_from_most_used' => __( 'Choose from the most used Property Cities', 'framework' ),
            'menu_name' => __( 'Property Cities', 'framework' )
        );

        register_taxonomy(
            'property-city',
            array( 'property' ),
            array(
                'hierarchical' => true,
                'labels' => $city_labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => __('property-city', 'framework'))
            )
        );


        $status_labels = array(
            'name' => __( 'Property Status', 'framework' ),
            'singular_name' => __( 'Property Status', 'framework' ),
            'search_items' =>  __( 'Search Property Status', 'framework' ),
            'popular_items' => __( 'Popular Property Status', 'framework' ),
            'all_items' => __( 'All Property Status', 'framework' ),
            'parent_item' => __( 'Parent Property Status', 'framework' ),
            'parent_item_colon' => __( 'Parent Property Status:', 'framework' ),
            'edit_item' => __( 'Edit Property Status', 'framework' ),
            'update_item' => __( 'Update Property Status', 'framework' ),
            'add_new_item' => __( 'Add New Property Status', 'framework' ),
            'new_item_name' => __( 'New Property Status Name', 'framework' ),
            'separate_items_with_commas' => __( 'Separate Property Status with commas', 'framework' ),
            'add_or_remove_items' => __( 'Add or remove Property Status', 'framework' ),
            'choose_from_most_used' => __( 'Choose from the most used Property Status', 'framework' ),
            'menu_name' => __( 'Property Status', 'framework' )
        );

        register_taxonomy(
            'property-status',
            array( 'property' ),
            array(
                'hierarchical' => true,
                'labels' => $status_labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => __('property-status', 'framework'))
            )
        );
    }
}
add_action( 'init', 'build_taxonomies', 0 );


/* Add Custom Columns */
if( !function_exists( 'property_edit_columns' ) ){
    function property_edit_columns($columns)
    {

        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __( 'Property Title','framework' ),
            "thumb" => __( 'Thumbnail','framework' ),
            //"address" => __('Address','framework'),
            "city" => __( 'City','framework' ),
            "type" => __('Type','framework'),
            "status" => __('Status','framework'),
            "price" => __('Price','framework'),
            "id" => __( 'Property ID','framework' ),
            /*
            "agent" => __( 'Property Agent','framework' ),
            "bed" => __('Beds','framework'),
            "bath" => __('Baths','framework'),
            "garage" => __('Garages','framework'),
            "features" => __('Features','framework'),
            */
            "date" => __( 'Publish Time','framework' )
        );

        //WPML support
        if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
            global $sitepress;
            $columns = $sitepress->add_posts_management_column( $columns );
        }

        return $columns;
    }
}
add_filter("manage_edit-property_columns", "property_edit_columns");

if( !function_exists( 'property_custom_columns' ) ){
    function property_custom_columns($column){
        global $post;
        switch ($column)
        {
            case 'thumb':
                if(has_post_thumbnail($post->ID)){
                    ?>
                    <a href="<?php the_permalink(); ?>" target="_blank">
                        <?php the_post_thumbnail( array( 130, 130 ) );?>
                    </a>
                    <?php
                }
                else{
                    _e('No Thumbnail','framework');
                }
                break;
            case 'id':
                $Prop_id = get_post_meta($post->ID,'REAL_HOMES_property_id',true);
                if(!empty($Prop_id)){
                    echo $Prop_id;
                }
                else{
                    _e('NA','framework');
                }
                break;
            case 'agent':
	            $agents_id = get_post_meta( $post->ID, 'REAL_HOMES_agents' );
	            if ( ! empty( $agents_id ) ) {
		            $agents_title = array();
		            foreach ( $agents_id as $agent_id ) {
			            $agents_title[] = get_the_title( $agent_id );
		            }
		            echo implode( ', ', $agents_title );
	            } else {
		            _e( 'NA', 'framework' );
	            }
                break;
            case 'city':
                echo inspiry_admin_taxonomy_terms ( $post->ID, 'property-city', 'property' );
                break;
            case 'address':
                $address = get_post_meta($post->ID,'REAL_HOMES_property_address',true);
                if(!empty($address)){
                    echo $address;
                }
                else{
                    _e('No Address Provided!','framework');
                }
                break;
            case 'type':
                echo inspiry_admin_taxonomy_terms ( $post->ID, 'property-type', 'property' );
                break;
            case 'status':
                echo inspiry_admin_taxonomy_terms ( $post->ID, 'property-status', 'property' );
                break;
            case 'price':
                property_price();
                break;
            case 'bed':
                $bed = get_post_meta($post->ID,'REAL_HOMES_property_bedrooms',true);
                if(!empty($bed)){
                    echo $bed;
                }
                else{
                    _e('NA','framework');
                }
                break;
            case 'bath':
                $bath = get_post_meta($post->ID,'REAL_HOMES_property_bathrooms',true);
                if(!empty($bath)){
                    echo $bath;
                }
                else{
                    _e('NA','framework');
                }
                break;
            case 'garage':
                $garage = get_post_meta($post->ID,'REAL_HOMES_property_garage',true);
                if(!empty($garage)){
                    echo $garage;
                }
                else{
                    _e('NA','framework');
                }
                break;
            case 'features':
                echo get_the_term_list($post->ID,'property-feature', '', ', ','');
                break;
        }
    }
}
add_action("manage_pages_custom_column", "property_custom_columns");


/*-----------------------------------------------------------------------------------*/
/*	Add Metabox to Display Property Payment Information
/*-----------------------------------------------------------------------------------*/
add_action( 'add_meta_boxes', 'add_payment_meta_box' );

if( !function_exists( 'add_payment_meta_box' ) ){
    function add_payment_meta_box(){
        add_meta_box( 'payment-meta-box', __('Payment Information', 'framework'), 'payment_meta_box', 'property', 'normal', 'default' );
    }
}

if( !function_exists( 'payment_meta_box' ) ){
    function payment_meta_box( $post ){

        $values = get_post_custom( $post->ID );
        $not_available  = __('Not Available','framework');

        $txn_id         = isset( $values['txn_id'] ) ? esc_attr( $values['txn_id'][0] ) : $not_available;
        $payment_date   = isset( $values['payment_date'] ) ? esc_attr( $values['payment_date'][0] ) : $not_available;
        $payer_email    = isset( $values['payer_email'] ) ? esc_attr( $values['payer_email'][0] ) : $not_available;
        $first_name     = isset( $values['first_name'] ) ? esc_attr( $values['first_name'][0] ) : $not_available;
        $last_name      = isset( $values['last_name'] ) ? esc_attr( $values['last_name'][0] ) : $not_available;
        $payment_status = isset( $values['payment_status'] ) ? esc_attr( $values['payment_status'][0] ) : $not_available;
        $payment_gross  = isset( $values['payment_gross'] ) ? esc_attr( $values['payment_gross'][0] ) : $not_available;
        $payment_currency  = isset( $values['mc_currency'] ) ? esc_attr( $values['mc_currency'][0] ) : $not_available;

        ?>
        <table style="width:100%;">
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php _e('Transaction ID','framework');?></strong></td>
                <td style="width:75%;"><?php echo $txn_id; ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php _e('Payment Date','framework');?></strong></td>
                <td style="width:75%;"><?php echo $payment_date; ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php _e('First Name','framework');?></strong></td>
                <td style="width:75%;"><?php echo $first_name; ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php _e('Last Name','framework');?></strong></td>
                <td style="width:75%;"><?php echo $last_name; ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php _e('Payer Email','framework');?></strong></td>
                <td style="width:75%;"><?php echo $payer_email; ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php _e('Payment Status','framework');?></strong></td>
                <td style="width:75%;"><?php echo $payment_status; ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php _e('Payment Amount','framework');?></strong></td>
                <td style="width:75%;"><?php echo $payment_gross; ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php _e('Payment Currency','framework');?></strong></td>
                <td style="width:75%;"><?php echo $payment_currency; ?></td>
            </tr>
        </table>
        <?php
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Search support for Property ID on its index page (backend)
/*-----------------------------------------------------------------------------------*/

// Confirm page
function is_prop_index(){
    global $pagenow;
    return ( is_admin() && $pagenow == 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] == 'property' && isset($_GET['s']) );
}

// Join the Post Meta table
function inspiry_search_join($join) {
    global $wpdb;
    if ( is_prop_index() ) {
        $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    return $join;
}

// Add the Property ID in search
function inspiry_search_where($where) {
    global $wpdb;
    if (is_prop_index()) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_key = 'REAL_HOMES_property_id') AND (".$wpdb->postmeta.".meta_value LIKE $1)",
            $where );
    }
    return $where;
}

// Group the Properties
function inspiry_prop_limits($groupby) {
    global $wpdb;
    if (is_prop_index()) { $groupby = "$wpdb->posts.ID"; }
    return $groupby;
}

add_filter('posts_join', 'inspiry_search_join' );
add_filter( 'posts_where', 'inspiry_search_where' );
add_filter( 'posts_groupby', 'inspiry_prop_limits' );


/*-----------------------------------------------------------------------------------*/
/*	Comma separated taxonomy terms with admin side links
/*-----------------------------------------------------------------------------------*/
if( ! function_exists ( 'inspiry_admin_taxonomy_terms' ) ) {
    function inspiry_admin_taxonomy_terms( $post_id, $taxonomy, $post_type ) {

        $terms = get_the_terms( $post_id, $taxonomy );

        if ( ! empty ( $terms ) ) {
            $out = array();
            /* Loop through each term, linking to the 'edit posts' page for the specific term. */
            foreach ( $terms as $term ) {
                $out[] = sprintf( '<a href="%s">%s</a>',
                    esc_url( add_query_arg( array( 'post_type' => $post_type, $taxonomy => $term->slug ), 'edit.php' ) ),
                    esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, $taxonomy, 'display' ) )
                );
            }
            /* Join the terms, separating them with a comma. */
            return join( ', ', $out );
        }

        return false;
    }
}
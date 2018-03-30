<?php
/*
    Extension Name: Portfolio Post Type
    Extension URI:
    Version: 1.0
    Description: Include a custom post type for creating portfolio items.
    Author: Parallelus
    Author URI: http://para.llel.us
*/

#-----------------------------------------------------------------
# Add Portfolio Post Type
#-----------------------------------------------------------------

// Create the Portfolio Custom Post Type
//...............................................
function theme_create_post_type_portfolio() {
	$labels = array(
		'name' => __( 'Portfolios','framework'),
		'singular_name' => __( 'Portfolio','framework' ),
		'add_new' => __('Add New','framework'),
		'add_new_item' => __('Add New Portfolio','framework'),
		'edit_item' => __('Edit Portfolio','framework'),
		'new_item' => __('New Portfolio','framework'),
		'view_item' => __('View Portfolio','framework'),
		'search_items' => __('Search Portfolio','framework'),
		'not_found' =>  __('No portfolio found','framework'),
		'not_found_in_trash' => __('No portfolio found in Trash','framework'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		// Uncomment the following line to change the slug; 
		// You must also save your permalink structure to prevent 404 errors
		//'rewrite' => array( 'slug' => 'portfolio-slug' ),
		'rewrite' => array('with_front' => false), 
		'supports' => array('title','editor','thumbnail','excerpt','page-attributes','post-formats','revisions') /* ,'custom-fields' */
	  ); 
	  
	  register_post_type(__( 'portfolio', 'framework' ),$args);

	  // This just uses WP to store some information that we're going to reference later so we can emulate 
	  // different post FORMAT support for different post TYPES
	  add_post_type_support( 'portfolio', 'post-formats', array( 'audio', 'gallery', 'image', 'video' ) );  
}

// Create the Portfolio Category Taxonomy
//...............................................
function theme_build_taxonomies(){
    $labels = array(
        'name' => __( 'Portfolio Category', 'framework' ),
        'singular_name' => __( 'Portfolio Category', 'framework' ),
        'search_items' =>  __( 'Search Portfolio Categories', 'framework' ),
        'popular_items' => __( 'Popular Portfolio Categories', 'framework' ),
        'all_items' => __( 'All Portfolio Categories', 'framework' ),
        'parent_item' => __( 'Parent Portfolio Category', 'framework' ),
        'parent_item_colon' => __( 'Parent Portfolio Category:', 'framework' ),
        'edit_item' => __( 'Edit Portfolio Category', 'framework' ), 
        'update_item' => __( 'Update Portfolio Category', 'framework' ),
        'add_new_item' => __( 'Add New Portfolio Category', 'framework' ),
        'new_item_name' => __( 'New Portfolio Category Name', 'framework' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'framework' ),
        'add_or_remove_items' => __( 'Add or remove categories', 'framework' ),
        'choose_from_most_used' => __( 'Choose from the most frequent portfolio categories', 'framework' ),
        'menu_name' => __( 'Portfolio Categories', 'framework' )
    );
    
	register_taxonomy(
	    'portfolio-category', 
	    array( __( 'portfolio', 'framework' )), 
	    array(
	        'hierarchical' => true, 
	        'labels' => $labels,
	        'show_ui' => true,
	        'query_var' => true,
	        'rewrite' => array('slug' => 'portfolio-category', 'hierarchical' => true)
	    )
	); 
}


// Enable Sorting of the Portfolio
//...............................................
function theme_create_portfolio_sort_page() {
    $theme_sort_page = add_submenu_page('edit.php?post_type=portfolio', 'Sort Items', __('Sort Items', 'framework'), 'edit_posts', basename(__FILE__), 'theme_portfolio_sort');
    
    add_action('admin_print_styles-' . $theme_sort_page, 'theme_print_sort_styles');
    add_action('admin_print_scripts-' . $theme_sort_page, 'theme_print_sort_scripts');
}

function theme_portfolio_sort() {
    $portfolios = new WP_Query('post_type=portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');
?>
    <div class="wrap">
        <div id="icon-tools" class="icon32"><br /></div>
        <h2><?php _e('Sort Portfolio Items', 'framework'); ?></h2>
        <p><?php _e('Drag portfolio items to organize.', 'framework'); ?></p>

        <ul id="portfolio_list">
            <?php while( $portfolios->have_posts() ) : $portfolios->the_post(); ?>
                <?php if( get_post_status() == 'publish' ) { ?>
                    <li id="<?php the_id(); ?>" class="menu-item">
                        <dl class="menu-item-bar">
                            <dt class="menu-item-handle">
                                <span class="menu-item-title"><?php the_title(); ?></span>
                            </dt>
                        </dl>
                        <ul class="menu-item-transport"></ul>
                    </li>
                <?php } ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </div>
<?php }

function theme_save_portfolio_sorted_order() {
    global $wpdb;
    
    $order = explode(',', $_POST['order']);
    $counter = 0;
    
    foreach($order as $portfolio_id) {
        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $portfolio_id));
        $counter++;
    }
    die(1);
}

function theme_print_sort_scripts() {
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('theme_portfolio_sort', get_template_directory_uri() . '/extensions/theme-portfolio/js/portfolio-sort.js');
}

function theme_print_sort_styles() {
    wp_enqueue_style('nav-menu');
}


/* Add Custom Columns ------------------------------------------------------*/
function theme_portfolio_edit_columns($columns){  

        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => __( 'Portfolio Item Title', 'framework' ),
            "type" => __( 'type', 'framework' )
        );  
  
        return $columns;  
}  
  
function theme_portfolio_custom_columns($column){  
        global $post;  
        switch ($column)  
        {    
            case __( 'type', 'framework' ):  
                echo get_the_term_list($post->ID, __( 'portfolio-category', 'framework' ), '', ', ','');  
                break;
        }  
}  

// Call our custom functions
//...............................................
add_action( 'init', 'theme_create_post_type_portfolio' );
add_action( 'init', 'theme_build_taxonomies', 0 );

add_action('admin_menu', 'theme_create_portfolio_sort_page');
add_action('wp_ajax_portfolio_sort', 'theme_save_portfolio_sorted_order');

add_filter("manage_edit-portfolio_columns", "theme_portfolio_edit_columns");  
add_action("manage_posts_custom_column",  "theme_portfolio_custom_columns");

// update permalinks for new rewrite rules
add_action("after_switch_theme", "flush_rewrite_rules", 10 ,  2); 


#-----------------------------------------------------------------
# Portfolio Metabox Fields
#-----------------------------------------------------------------

$meta_box_portfolio = array(
	'id' => 'theme-meta-box-portfolio',
	'title' =>  __('Portfolio Detail Settings', 'framework'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'default',
	'fields' => array(
		array(
			'name' => __('Title Display', 'framework'),
			'desc' => __('Show the item title above or below the featured image.', 'framework'),
			'id' => 'theme_portfolio_title',
			'type' => 'select',
			'std' => '',
			'options' => array(
				'below' => 'Below Image',
				'above' => 'Above Image'
			)
		),
		array(
			'name' => __('Project Date', 'framework'),
			'desc' => __('The project completion date.', 'framework'),
			'id' => 'theme_portfolio_date',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Client', 'framework'),
			'desc' => __('The client for this project.', 'framework'),
			'id' => 'theme_portfolio_client',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('URL', 'framework'),
			'desc' => __('A link for the project, such as completed website developments.', 'framework'),
			'id' => 'theme_portfolio_url',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Other Details', 'framework'),
			'desc' => __('Use this area for additional details specific to this project.', 'framework'),
			'id' => 'theme_portfolio_details',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => __('Click Image Action', 'framework'),
			'desc' => __('Clicking the featured image in portfolio lists can open the item details or show the media in a lightbox.', 'framework'),
			'id' => 'theme_portfolio_lightbox',
			'type' => 'select',
			'std' => '',
			'options' => array(
				'item' => 'Open item details page',
				'lightbox' => 'Show media in lightbox'
			)
		),
	)
);


#-----------------------------------------------------------------
# Add metabox to Portfolio Edit Page
#-----------------------------------------------------------------

function theme_add_box_portfolio() {
	global $meta_box_portfolio;
	
	add_meta_box(
		$meta_box_portfolio['id'], 
		$meta_box_portfolio['title'], 
		'theme_show_box_portfolio', 
		$meta_box_portfolio['page'], 
		$meta_box_portfolio['context'], 
		$meta_box_portfolio['priority']
	);

}

add_action('add_meta_boxes', 'theme_add_box_portfolio');


#-----------------------------------------------------------------
# Callback function to show fields in meta box
#-----------------------------------------------------------------

function theme_show_box_portfolio() {
	global $meta_box_portfolio, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__('Enter the details that apply to this item.', 'framework').'</p>';
	echo '<input type="hidden" name="theme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<table class="form-table">';
 
	foreach ($meta_box_portfolio['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			// Select box		
			case 'select':
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong></label></th>',
				'<td>';
				echo '<div class="metaField_field_wrapper metaField_field_'.$field['id'].'">',
				     '<select class="metaField_select" id="'.$field['id'].'"  name="'.$field['id'].'">';
				$count = 0;
				foreach ($field['options'] as $key => $label) {
					$selected = ($meta == $key || (!$meta && !$count)) ? 'selected="selected"' : '';
					echo '<option value="'.$key.'" '.$selected.'>'.$label.'</option>';
					$count++;
				}
				echo '</select>';
				if ($field['desc']) { echo '<p class="metaField_caption" style="color:#999">'.$field['desc'].'</p>'; }
				echo '</div>';
			echo '</td></tr>';
			break; 
			
			// Text		
			case 'text':
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			echo '</td></tr>';
			break;

			// Textarea		
			case 'textarea':
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
			echo '</td></tr>';
			break;           
			
		}
	}
	echo '</table>';
}



#-----------------------------------------------------------------
# Save data when post is edited
#-----------------------------------------------------------------

function theme_save_data_portfolio($post_id) {
	global $meta_box_portfolio;
	// global $meta_box_portfolio, $meta_box_portfolio_video, $meta_box_portfolio_audio, $meta_box_portfolio_image, $meta_box_portfolio_background;
 
	// verify nonce
	if ( !isset($_POST['theme_meta_box_nonce']) || !wp_verify_nonce($_POST['theme_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check permissions
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($meta_box_portfolio['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
}
add_action('save_post', 'theme_save_data_portfolio');


#-----------------------------------------------------------------
# Custom Walker for wp_list_categories in Portfolio templates
#-----------------------------------------------------------------

class Portfolio_Category_Walker extends Walker_Category {
    function start_el(&$output, $category, $depth = 0, $args = array(), $current_object_id = 0) {
            extract($args);

            $cat_name = esc_attr( $category->name );
            $cat_name = apply_filters( 'list_cats', $cat_name, $category );
            $link = '<a href="' . esc_attr( get_term_link($category) ) . '" ';
            $link .= 'data-filter="' . urldecode($category->slug) . '" ';
            if ( $use_desc_for_title == 0 || empty($category->description) )
                    $link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s', 'framework' ), $cat_name) ) . '"';
            else
                    $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
            $link .= '>';
            $link .= $cat_name . '</a>';

            if ( !empty($feed_image) || !empty($feed) ) {
                    $link .= ' ';

                    if ( empty($feed_image) )
                            $link .= '(';

                    $link .= '<a href="' . get_term_feed_link( $category->term_id, $category->taxonomy, $feed_type ) . '"';

                    if ( empty($feed) ) {
                            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'framework' ), $cat_name ) . '"';
                    } else {
                            $title = ' title="' . $feed . '"';
                            $alt = ' alt="' . $feed . '"';
                            $name = $feed;
                            $link .= $title;
                    }

                    $link .= '>';

                    if ( empty($feed_image) )
                            $link .= $name;
                    else
                            $link .= "<img src='$feed_image'$alt$title" . ' />';

                    $link .= '</a>';

                    if ( empty($feed_image) )
                            $link .= ')';
            }

            if ( !empty($show_count) )
                    $link .= ' (' . intval($category->count) . ')';

            if ( !empty($show_date) )
                    $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);

            if ( 'list' == $args['style'] ) {
                    $output .= "\t<li";
                    $class = 'cat-item cat-item-' . $category->term_id;
                    if ( !empty($current_category) ) {
                            $_current_category = get_term( $current_category, $category->taxonomy );
                            if ( $category->term_id == $current_category )
                                    $class .=  ' current-cat';
                            elseif ( $category->term_id == $_current_category->parent )
                                    $class .=  ' current-cat-parent';
                    }
                    $output .=  ' class="' . $class . '"';
                    $output .= ">$link\n";
            } else {
                    $output .= "\t$link<br />\n";
            }
    }
}


#-----------------------------------------------------------------
# Custom filter - Add layout manager options to portfolio items
#-----------------------------------------------------------------

// Not saving settngs for layouts... needs to be looked at

/*function theme_portfolio_layout_manager_meta( $post_types ) {
	// Add portfolio to post types
	$post_types[] = 'portfolio';
	return $post_types;
}
add_filter( 'layout_manager_post_types', 'theme_portfolio_layout_manager_meta' );*/


#-----------------------------------------------------------------
# Custom filter for next/previous portfolio items (sorted by menu order)
#-----------------------------------------------------------------

function theme_next_previous_portfolio_item( $text = false, $direction = 'next' ) {

	// Get the portfolio items
	$portfolios = get_posts(array(
		'post_type'=>'portfolio',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => -1
	));
	$direction = ($direction == 'previous' || $direction == 'prev') ? 'prev' : 'next';
	$text = ($text) ? $text : ucwords($direction);

	// Add all portfolio ID's to an array
	$items = array();
	foreach ($portfolios as $item) {
	   $items[] += $item->ID;
	}

	// Curent item ID
	$current = array_search(get_the_ID(), $items);

	// we don't "loop" front to end so if it's the first or last we're done.
	if ( ($current === 0 && $direction == 'prev') || ($current == count($items)-1 && $direction == 'next') || $current === false) {
		return; 
	}

	// Get the next/previous item in the array
	$navID = ($direction == 'prev') ? $items[$current-1] : $items[$current+1];		

	// Make the link
	$link = '<a href="'.get_permalink($navID).'" rel="'.$direction.'"><span class="meta-nav">'.$text.'</span></a>';

	// send it back
	return $link;

}

function theme_next_portfolio_item( $text = '&rsaquo;', $direction = 'next' ) {
	echo theme_next_previous_portfolio_item( $text, $direction);
}
function theme_prev_portfolio_item( $text = '&lsaquo;', $direction = 'prev' ) {
	echo theme_next_previous_portfolio_item( $text, $direction);
}

?>
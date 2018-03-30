<?php

add_action( 'init', 'create_gallery_plus_type' );
function create_gallery_plus_type() {
	register_post_type( 'dt_gallery_plus',
		array(
			'labels' => array(
				'name' => __( 'Photo Albums', LANGUAGE_ZONE ),
				'singular_name' => __( 'Album', LANGUAGE_ZONE ),
				'edit_item' => __( 'Edit Album', LANGUAGE_ZONE ),
				'add_new_item' => __( 'Add New Album', LANGUAGE_ZONE ),
				'new_item_name' => __( 'New Album Name', LANGUAGE_ZONE ),
			),
        	'public' => true,
        	//'exclude_from_search' => false,
        	'show_ui' => true,
        	'taxonomies' => array('dt_gallery_plus'),
        	'capability_type' => 'post',
        	'hierarchical' => false,
        	'rewrite' => array('slug' => 'gallery_plus'),
			'has_archive' => true,
			'menu_icon' => get_template_directory_uri() . '/images/gallery.png',
			'supports' => array(
		      'title', 
		      'thumbnail',
			  'excerpt'
			)
		)
	);
	
	// taxonomy
	$labels = array(
		'name' => _x( 'Categories', 'taxonomy general name', LANGUAGE_ZONE ),
		'singular_name' => _x( 'Category', 'taxonomy singular name', LANGUAGE_ZONE ),
		'search_items' =>  __( 'Search in Category', LANGUAGE_ZONE ),
		'all_items' => __( 'Categories', LANGUAGE_ZONE ),
		'parent_item' => __( 'Parent Category', LANGUAGE_ZONE ),
		'parent_item_colon' => __( 'Parent Category:', LANGUAGE_ZONE ),
		'edit_item' => __( 'Edit Category', LANGUAGE_ZONE ), 
		'update_item' => __( 'Update Category', LANGUAGE_ZONE ),
		'add_new_item' => __( 'Add New Category', LANGUAGE_ZONE ),
		'new_item_name' => __( 'New Category Name', LANGUAGE_ZONE ),
		'menu_name' => __( 'Categories', LANGUAGE_ZONE ),
	); 	
			
	/* TAXONOMY for gallery */
	register_taxonomy('dt_gallery-category',array('dt_gallery_plus'), array(
		'hierarchical' => true,
		'show_in_nav_menus ' => false,
		'public' => false,
		'show_tagcloud' => false,
		'labels' => $labels,
		'show_ui' => true,
		'rewrite' => false,
	));
}


add_action( 'add_meta_boxes', 'dt_gallery_ct_meta_box' );
add_action( 'save_post', 'dt_gallery_ct_save' );

function dt_gallery_ct_meta_box() {
	add_meta_box(
		'dt_page_box-gallery_ct',
		__( 'Gallery Options', LANGUAGE_ZONE ),
		'dt_gallery_ct_options',
		'dt_gallery_plus'
	);

    add_meta_box(
        'gallery-admin',
        _x( 'Gallery', 'backend albums metabox uploader', LANGUAGE_ZONE ),
        'dt_gallery_admin_box',
        'dt_gallery_plus',
        'advanced',
        'high'
    );
}

function dt_gallery_ct_options( $post ) {
	// NAME OF THE BOX !
	$box_name = 'gallery_ct';

	$data = get_post_meta( $post->ID, 'dt_'.$box_name.'_options', true );
	$defaults = array(
		'dt_exclude_from'	=> false,
		'orderby'			=> 'menu_order',
		'order'				=> 'ASC'
	);
	$data = wp_parse_args( $data, $defaults );

    $p_orderby = array(
   		'ID'        => __( 'Order by ID', LANGUAGE_ZONE ),
        'author'    => __( 'Order by author', LANGUAGE_ZONE ),
        'title'     => __( 'Order by title', LANGUAGE_ZONE ),
        'date'      => __( 'Order by date', LANGUAGE_ZONE ),
        'modified'  => __( 'Order by modified', LANGUAGE_ZONE ),
        'rand'      => __( 'Order by rand', LANGUAGE_ZONE ),
        'menu_order'=> __( 'Order by menu', LANGUAGE_ZONE )
    );
	
	$p_order = array(
		'ASC'	=> __( 'Ascending ', LANGUAGE_ZONE ),
		'DESC'	=> __( 'Descending ', LANGUAGE_ZONE )
	);

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), $box_name.'_noncename' );
	?>
	<p>
		<input type="checkbox" id="dt_exclude_from_<?php echo $box_name; ?>" name="dt_exclude_from_<?php echo $box_name; ?>"<?php checked($data['dt_exclude_from']); ?>/>
		<label for="dt_exclude_from_<?php echo $box_name; ?>"><?php _e("exclude featured image from gallery", LANGUAGE_ZONE ); ?></label>
	</p>
	<p><?php _e('Gallery order options: ', LANGUAGE_ZONE); ?></p>
	<p>
		<?php foreach( $p_order as $value=>$title ): ?>
		<label><?php echo $title; ?><input type="radio" name="<?php echo $box_name; ?>_order" value="<?php echo $value; ?>"<?php checked($value, $data['order']); ?>/></label>
		<?php endforeach; ?>
	</p>
	<p>
		<select name="<?php echo $box_name; ?>_orderby">
		<?php foreach( $p_orderby as $value=>$title ): ?>
		<option value="<?php echo $value; ?>" <?php selected($data['orderby'], $value); ?>><?php echo $title; ?></option>
		<?php endforeach;?>
		</select>
	</p>
	<?php
}

function dt_gallery_ct_save( $post_id ) {
	// NAME OF THE BOX !
	$box_name = 'gallery_ct';
	
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( !isset( $_POST[$box_name.'_noncename'] ) || !wp_verify_nonce( $_POST[$box_name.'_noncename'], plugin_basename( __FILE__ ) ) )
		return;

	if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	
	// OK, we're authenticated: we need to find and save the data
	$mydata = array();

	$mydata['dt_exclude_from'] = isset($_POST['dt_exclude_from_'.$box_name]);

	if( isset($_POST[$box_name.'_orderby']) )
		$mydata['orderby'] = $_POST[$box_name.'_orderby'];

	if( isset($_POST[$box_name.'_order']) )
		$mydata['order'] = $_POST[$box_name.'_order'];

	update_post_meta( $post_id, 'dt_'.$box_name.'_options', $mydata );
}

//gallery iframe
function dt_gallery_admin_box( $post ) {

    $tab = 'type';
    $args = array(
        'post_type'			=>'attachment',
        'post_status'		=>'inherit',
        'post_parent'		=>$post->ID,
        'posts_per_page'	=>1
    );
    $attachments = new Wp_Query( $args );

    if( !empty($attachments->posts) ) {
        $tab = 'dt_gallery_media';
    }
    
    $u_href = get_admin_url();
    $u_href .= '/media-upload.php?post_id='. $post->ID;
    $u_href .= '&width=670&height=400&tab='.$tab;
?>
    <iframe src="<?php echo esc_url($u_href); ?>" width="100%" height="560">The Error!!!</iframe>
<?php
}

function dt_album_media_form( $errors ) {
    global $redir_tab, $type;

    $redir_tab = 'dt_gallery_media';
    media_upload_header();
    
    $post_id = intval($_REQUEST['post_id']);
    $form_action_url = admin_url("media-upload.php?type=$type&tab=dt_gallery_media&post_id=$post_id");
    $form_action_url = apply_filters('media_upload_form_url', $form_action_url, $type);
    $form_class = 'media-upload-form validate';
    
    if ( get_user_setting('uploader') )
        $form_class .= ' html-uploader';
?>	
    <script type="text/javascript">
    <!--
    jQuery(function($){
        var preloaded = $(".media-item.preloaded");
        if ( preloaded.length > 0 ) {
            preloaded.each(function(){prepareMediaItem({id:this.id.replace(/[^0-9]/g, '')},'');});
            updateMediaForm();
        }
    });
    -->
    </script>
    <div id="sort-buttons" class="hide-if-no-js">
    <span>
    <?php _e('All Tabs:', LANGUAGE_ZONE); ?>
    <a href="#" id="showall"><?php _e('Show', LANGUAGE_ZONE); ?></a>
    <a href="#" id="hideall" style="display:none;"><?php _e('Hide', LANGUAGE_ZONE); ?></a>
    </span>
    <?php _e('Sort Order:', LANGUAGE_ZONE); ?>
    <a href="#" id="asc"><?php _e('Ascending', LANGUAGE_ZONE); ?></a> |
    <a href="#" id="desc"><?php _e('Descending', LANGUAGE_ZONE); ?></a> |
    <a href="#" id="clear"><?php _ex('Clear', 'verb', LANGUAGE_ZONE); ?></a>
    </div>
    <form enctype="multipart/form-data" method="post" action="<?php echo esc_attr($form_action_url); ?>" class="<?php echo $form_class; ?>" id="gallery-form">
    <?php wp_nonce_field('media-form'); ?>
    <?php //media_upload_form( $errors ); ?>
    <table class="widefat" cellspacing="0">
    <thead><tr>
    <th><?php _e('Media', LANGUAGE_ZONE); ?></th>
    <th class="order-head"><?php _e('Order', LANGUAGE_ZONE); ?></th>
    <th class="actions-head"><?php _e('Actions', LANGUAGE_ZONE); ?></th>
    </tr></thead>
    </table>
    <div id="media-items">
    <?php add_filter('attachment_fields_to_edit', 'media_post_single_attachment_fields_to_edit', 10, 2); ?>
	<?php
	$_REQUEST['tab'] = 'gallery';
	add_filter( 'get_media_item_args', 'dt_media_item_remove_insert_in_to_post' );
	?>
    <?php echo get_media_items($post_id, $errors); ?>
	<?php
	remove_filter( 'get_media_item_args', 'dt_media_item_remove_insert_in_to_post' );
	$_REQUEST['tab'] = 'dt_gallery_media';
	?>
    </div>

    <p class="ml-submit">
    <?php submit_button( __( 'Save all changes', LANGUAGE_ZONE ), 'button savebutton', 'save', false, array( 'id' => 'save-all', 'style' => 'display: none;' ) ); ?>
    <input type="hidden" name="post_id" id="post_id" value="<?php echo (int) $post_id; ?>" />
    <input type="hidden" name="type" value="<?php echo esc_attr( $GLOBALS['type'] ); ?>" />
    <input type="hidden" name="tab" value="<?php echo esc_attr( $GLOBALS['tab'] ); ?>" />
    </p>

  </form>
	<div style="display: none;">
    <input type="radio" name="linkto" id="linkto-file" value="file" />
    <input type="radio" checked="checked" name="linkto" id="linkto-post" value="post" />
    <select id="orderby" name="orderby">
    	<option value="menu_order" selected="selected"><?php _e('Menu order', LANGUAGE_ZONE); ?></option>
        <option value="title"><?php _e('Title', LANGUAGE_ZONE); ?></option>
        <option value="post_date"><?php _e('Date/Time', LANGUAGE_ZONE); ?></option>
        <option value="rand"><?php _e('Random', LANGUAGE_ZONE); ?></option>
    </select>
    <input type="radio" checked="checked" name="order" id="order-asc" value="asc" />
    <input type="radio" name="order" id="order-desc" value="desc" />
    <select id="columns" name="columns">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3" selected="selected">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
   	</select>
	</div>
<?php
}


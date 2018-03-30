<?php 
/**
 * Adds the flowthemes Settings meta box on the Write Post/Page screeens
 */

/**
 * Function for adding meta boxes to the admin.
 * Separate the post and page meta boxes.
 */
function flowthemes_create_meta_box() {
	global $theme_name;

	add_meta_box( 'post-meta-boxes', __('Post Options', 'flowthemes'), 'post_meta_boxes', 'post', 'normal', 'high' );
	add_meta_box( 'page-meta-boxes', __('Page Options', 'flowthemes'), 'page_meta_boxes', 'page', 'normal', 'high' );
	add_meta_box( 'portfolio-meta-boxes', __('Project Settings', 'flowthemes'), 'portfolio_meta_boxes', 'portfolio', 'normal', 'high' );
}

/**
 * Array of variables for post meta boxes.  Make the 
 * function filterable to add options through child themes.
 *
 * @return array $meta_boxes
 */
function flowthemes_post_meta_boxes() {

	/* Array of the meta box options. */
	$meta_boxes = array(
		'flow_post_description' => array( 'name' => 'flow_post_description', 'title' => __('Description', 'flowthemes'), 'desc' => __('You can add description to your post using this custom field. It will be displayed below the title. It\'s optional.', 'flowthemes'), 'type' => 'textarea' ),
		'flow_post_layout' => array( 'name' => 'flow_post_layout', 'title' => __( 'Layout:', 'flowthemes' ), 'options' => array( 'no-sidebar' => __('No Sidebar', 'flowthemes'), 'sidebar-left' => __('Left Sidebar', 'flowthemes'), 'sidebar-right' => __('Right Sidebar', 'flowthemes') ), 'desc' => __( 'Pick post layout here.', 'flowthemes' ), 'type' => 'select' )
	);

	return apply_filters( 'flowthemes_post_meta_boxes', $meta_boxes );
}

function flowthemes_portfolio_meta_boxes() {

	$list_of_pages_raw = get_pages();
	$list_of_pages['none'] = __('(main portfolio page)', 'flowthemes');
	foreach($list_of_pages_raw as $single_page){
		$list_of_pages[$single_page->ID] = $single_page->post_title; /* Must be [ID] => [display name] */
	}
	/* Array of the meta box options. */
	$meta_boxes = array(
		//'slides' => array( 'name' => 'slides', 'title' => __('Thumbnail image:', 'flowthemes'), 'desc' => __('Manage your slides here.', 'flowthemes'), 'type' => 'slidemanager' ),
		'300-160-image' => array( 'name' => '300-160-image', 'title' => __('Thumbnail', 'flowthemes'), 'desc' => __('Thumbnail link and mouse over color. See available sizes below. You can upload larger images for high pixel density displays.', 'flowthemes'), 'type' => 'imagesmapler' ),
		'thumbnail_hover_color' => array( 'name' => 'thumbnail_hover_color', 'title' => __('Thumbnail mouse over color:', 'flowthemes'), 'desc' => __('Pick some color that will be used as mouse over color for this project\'s thumbnail on front page.', 'flowthemes'), 'type' => 'imagesamplerhidden' ),
		'thumbnail_size' => array( 'name' => 'thumbnail_size', 'title' => __('Thumbnail size', 'flowthemes'), 'options' => array('0' => __('Random', 'flowthemes'), '1' => __('Large (670x305px)', 'flowthemes'), '2' => __('Medium (445x305px)', 'flowthemes'), '3' => __('Vertical (220x305px)', 'flowthemes'), '4' => __('Horizontal (445x150px)', 'flowthemes'), '5' => __('Small (220x150px)', 'flowthemes')), 'desc' => __('To avoid having empty gaps please use many small thumbnails.', 'flowthemes'), 'type' => 'select' ),
		'thumbnail_meta' => array( 'name' => 'thumbnail_meta', 'title' => __('Thumbnail meta data', 'flowthemes'), 'options' => array('0' => __('Don\'t display', 'flowthemes'), '1' => __('Display', 'flowthemes')), 'desc' => __('You can display thumbnail\'s meta data all the time. This is useful for solid color thumbnails.', 'flowthemes'), 'type' => 'select' ),
		'flow_post_description' => array( 'name' => 'flow_post_description', 'title' => __('Project description', 'flowthemes'), 'desc' => '', 'type' => 'textarea' ),
		'portfolio_date' => array( 'name' => 'portfolio_date', 'title' => __('Project date', 'flowthemes'), 'desc' => __('It will be displayed in the project description. Suggested format: dd.mm.yyyy (like 22.07.2013).', 'flowthemes'), 'type' => 'text' ),
		'portfolio_client' => array( 'name' => 'portfolio_client', 'title' => __('Project client', 'flowthemes'), 'desc' => __('It will be displayed in the project description.', 'flowthemes'), 'type' => 'text' ),
		'portfolio_agency' => array( 'name' => 'portfolio_agency', 'title' => __('Project agency', 'flowthemes'), 'desc' => __('It will be displayed in the project description.', 'flowthemes'), 'type' => 'text' ),
		'portfolio_ourrole' => array( 'name' => 'portfolio_ourrole', 'title' => __('Project role', 'flowthemes'), 'desc' => __('It will be displayed in the project description. Please use &lt;br&gt; HTML tag to add multiline roles.', 'flowthemes'), 'type' => 'text' ),
		'thumbnail_link' => array( 'name' => 'thumbnail_link', 'title' => __('Thumbnail External Link (optional)', 'flowthemes'), 'desc' => __('You can make the thumbnail link somewhere else (like a blog post or external website). Specifying a link here will exclude this project from being viewable.', 'flowthemes'), 'type' => 'text' ),
		'thumbnail_link_newwindow' => array( 'name' => 'thumbnail_link_newwindow', 'title' => __('Open link in a new window?', 'flowthemes'), 'desc' => __('This option works only if you have specified external link for this thumbnail.', 'flowthemes'), 'options' => array('0' => __('Same window', 'flowthemes'), '1' => __('New window', 'flowthemes')), 'type' => 'select' ),
		'portfolio_back_button' => array( 'name' => 'portfolio_back_button', 'title' => __('Parent portfolio', 'flowthemes'), 'desc' => __('Parent portfolio page for this project. Defaults to your main portfolio page.', 'flowthemes'), 'type' => 'select', 'options' => $list_of_pages )
	);

	return apply_filters( 'flowthemes_portfolio_meta_boxes', $meta_boxes );
}

/**
 * Array of variables for page meta boxes.  Make the 
 * function filterable to add options through child themes.
 *
 * @return array $meta_boxes
 */
function flowthemes_page_meta_boxes() {

	/* Array of the meta box options. */
	$meta_boxes = array(

	);
	
	$page_portfolio_orderby = array('date' => 'date', 'none' => 'none', 'ID' => 'ID', 'author' => 'author', 'title' => 'title', 'modified' => 'modified', 'parent' => 'parent', 'rand' => 'rand', 'comment_count' => 'comment_count', 'menu_order' => 'menu_order');
	$page_portfolio_order = array('DESC' => 'DESC', 'ASC' => 'ASC');
	$page_portfolio_post_id = isset( $_GET['post'] ) ? $_GET['post'] : $_POST['post_ID'];
	$page_portfolio_templatefile = get_post_meta($page_portfolio_post_id, '_wp_page_template', true); // boolean false for new pages without IDs

	if($page_portfolio_templatefile && in_array(strtolower($page_portfolio_templatefile), array('template-portfolio.php'))){
		$page_portfolio_options = array();
		$page_portfolio_categories = get_terms( 'portfolio_category', 'hide_empty=0' );
		//for($h=0;$h<count($page_portfolio_categories);$h++){
			//$page_portfolio_options[$page_portfolio_categories[$h]->slug] = $page_portfolio_categories[$h]->name;
		//}
		// One person had indexes like 9001, 9002, 9003, 9004 instead of 0, 1, 2, 3. See #6926.
		foreach($page_portfolio_categories as $key => $value){
			$page_portfolio_options[$page_portfolio_categories[$key]->slug] = $page_portfolio_categories[$key]->name;
		}
		$meta_boxes = array_merge($meta_boxes, array(
			'page_portfolio_tax_query_operator' => array( 'name' => 'page_portfolio_tax_query_operator', 'title' => __('Operator for categories box', 'flowthemes'), 'desc' => __('You can make below box INCLUDE only selected categories or EXCLUDE selected categories. When you\'re using INCLUDE you must select at least two categories. If you will not select any categories it\'s going to display everything.', 'flowthemes'), 'options' => array(false => __('Exclude', 'flowthemes'), true => __('Include', 'flowthemes')), 'type' => 'select'),
			'page_portfolio_exclude' => array( 'name' => 'page_portfolio_exclude', 'title' => __('Exclude portfolio categories', 'flowthemes'), 'desc' => __('Select categories that should be excluded from this portfolio page. You can select multiple categories if you hold Ctrl / CMD and click on them.', 'flowthemes'), 'type' => 'select', 'is_multiple' => true, 'options' => $page_portfolio_options),
			'page_portfolio_orderby' => array( 'name' => 'page_portfolio_orderby', 'title' => __('Thumbnails order by', 'flowthemes'), 'desc' => __('Default: date.', 'flowthemes'), 'type' => 'select', 'is_multiple' => false, 'options' => $page_portfolio_orderby),
			'page_portfolio_order' => array( 'name' => 'page_portfolio_order', 'title' => __('Thumbnails order', 'flowthemes'), 'desc' => __('Default: DESC.', 'flowthemes'), 'type' => 'select', 'is_multiple' => false, 'options' => $page_portfolio_order),
			'page_portfolio_shuffle' => array( 'name' => 'page_portfolio_shuffle', 'title' => __('Shuffle button', 'flowthemes'), 'options' => array(false => __('Disable', 'flowthemes'), true => __('Enable', 'flowthemes')), 'desc' => __('Enable or disable the shuffle button on this page.', 'flowthemes'), 'type' => 'select'),
			'page_portfolio_welcome_text' => array( 'name' => 'page_portfolio_welcome_text', 'title' => __('Welcome text', 'flowthemes'), 'desc' => __('Set welcome text for this portfolio page.', 'flowthemes'), 'type' => 'textarea'),
			'page_portfolio_loop_through' => array( 'name' => 'page_portfolio_loop_through', 'title' => __('Browse projects in selected category', 'flowthemes'), 'options' => array(false => __('No', 'flowthemes'), true => __('Yes', 'flowthemes')), 'desc' => __('By default entering a project will make left/right arrows go to the previous or next project regardless of the category it is in. You can make it go to the next project from the currently selected category instead.', 'flowthemes'), 'type' => 'select'),
			'page_portfolio_boundary_arrows' => array( 'name' => 'page_portfolio_boundary_arrows', 'title' => __('Boundary arrows', 'flowthemes'), 'options' => array(false => __('Loop projects', 'flowthemes'), true => __('Do not loop projects', 'flowthemes')), 'desc' => __('When an user sees the first/last project in the current projects set should the first/last arrows disappear or should it be looped?', 'flowthemes'), 'type' => 'select')
		));
	}else{
		$meta_boxes = array_merge($meta_boxes, array(
			'flow_post_description' => array( 'name' => 'flow_post_description', 'title' => __('Description', 'flowthemes'), 'desc' => __('You can add description to your page using this custom field. It will be displayed above page. It\'s optional.', 'flowthemes'), 'type' => 'textarea' ),
			'flow_post_layout' => array( 'name' => 'flow_post_layout', 'title' => __( 'Layout:', 'flowthemes' ), 'options' => array( 'no-sidebar' => __('No Sidebar', 'flowthemes'), 'sidebar-left' => __('Left Sidebar', 'flowthemes'), 'sidebar-right' => __('Right Sidebar', 'flowthemes'), 'no-boundaries' => __('No boundaries', 'flowthemes') ), 'desc' => __( 'Pick page layout here.', 'flowthemes' ), 'type' => 'select' )
		));
	}

	return apply_filters( 'flowthemes_page_meta_boxes', $meta_boxes );
}

/**
 * Displays meta boxes on the Write Post panel.  Loops 
 * through each meta box in the $meta_boxes variable.
 * Gets array from flowthemes_post_meta_boxes().
 */
function post_meta_boxes() {
	global $post;
	$meta_boxes = flowthemes_post_meta_boxes(); ?>

	<table class="form-table meta-boxes-table">
	<?php foreach ( $meta_boxes as $meta ) :
	
		// $value = get_post_meta( $post->ID, $meta['name'], true ); // original - no stripslashes()
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if(is_array($value)){
			//foreach($value as $k => $v){
				//$value[$k] = stripslashes( $v );
			//}
		}else{
			$value = stripslashes( $value );
		}

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'upload' )
			get_meta_text_upload( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'imagesampler' )
			get_meta_imagesampler( $meta, $value );
		elseif ( $meta['type'] == 'imagesamplerhidden' )
			get_meta_imagesamplerhidden( $meta, $value );
		elseif ( $meta['type'] == 'slidemanager' )
			get_meta_slidemanager( $meta, $value );

	endforeach; ?>
	</table>
<?php 
}

/**
 * Displays meta boxes on the Write Page panel.  Loops 
 * through each meta box in the $meta_boxes variable.
 * Gets array from flowthemes_page_meta_boxes()
 */
function page_meta_boxes() {
	global $post;
	$meta_boxes = flowthemes_page_meta_boxes(); ?>

	<table class="form-table meta-boxes-table">
	<?php foreach ( $meta_boxes as $meta ) :
	
		// $value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) ); // original
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if(is_array($value)){
			//foreach($value as $k => $v){
				//$value[$k] = stripslashes( $v );
			//}
		}else{
			$value = stripslashes( $value );
		}

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'upload' )
			get_meta_text_upload( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'colorpicker' )
			get_meta_colorpicker( $meta, $value );
		elseif ( $meta['type'] == 'imagesampler' )
			get_meta_imagesampler( $meta, $value );
		elseif ( $meta['type'] == 'imagesamplerhidden' )
			get_meta_imagesamplerhidden( $meta, $value );
		elseif ( $meta['type'] == 'slidemanager' )
			get_meta_slidemanager( $meta, $value );

	endforeach; ?>
	</table>
<?php 
}

/**
 * Displays meta boxes on the Write Page panel.  Loops 
 * through each meta box in the $meta_boxes variable.
 * Gets array from flowthemes_page_meta_boxes()
 */
function portfolio_meta_boxes() {
	global $post;
	$meta_boxes = flowthemes_portfolio_meta_boxes(); ?>

	<table class="form-table meta-boxes-table">
	<?php foreach ( $meta_boxes as $meta ) :

		// $value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) ); // original
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if(is_array($value)){
			//foreach($value as $k => $v){
				//$value[$k] = stripslashes( $v );
			//}
		}else{
			$value = stripslashes( $value );
		}

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'upload' )
			get_meta_text_upload( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'colorpicker' )
			get_meta_colorpicker( $meta, $value );
		elseif ( $meta['type'] == 'imagesmapler' )
			get_meta_imagesampler( $meta, $value );
		elseif ( $meta['type'] == 'imagesamplerhidden' )
			get_meta_imagesamplerhidden( $meta, $value );
		elseif ( $meta['type'] == 'slidemanager' )
			get_meta_slidemanager( $meta, $value );

	endforeach; ?>
	</table>
<?php 
}

function get_meta_text_input( $args = array(), $value = false ) {
	extract( $args ); ?>

	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value ); ?>" size="30" tabindex="30" style="width: 97%;" />
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<p><?php echo $desc; ?></p>
		</td>
	</tr>
	<?php 
}

function get_meta_text_upload( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<div class="flowuploader">
				<input class="flowuploader_media_url" type="text" name="<?php echo $name; ?>" value="<?php echo esc_html( $value ); ?>" />
				<span class="flowuploader_upload_button button">Upload</span>
				<div class="flowuploader_media_preview_image"></div>
			</div>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<p><?php echo $desc; ?></p>
		</td>
	</tr>
	<?php 
}

function get_meta_colorpicker( $args = array(), $value = false ){
	extract( $args ); ?>
	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>						
			<input id="<?php echo $name; ?>" type="text" class="" name="<?php echo $name; ?>" value="<?php echo esc_html( $value ); ?>">
			<script type="text/javascript">
				jQuery(document).ready(function(){
					if(typeof jQuery.wp === "object" && typeof jQuery.wp.wpColorPicker === "function"){
						var options = {
							palettes: false
						};
						jQuery('#<?php echo $name; ?>').wpColorPicker(options);
					}
				});
			</script>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<p>
				<?php echo $desc; ?>
			</p>
		</td>
	</tr>
	<?php 
}

function get_meta_imagesamplerhidden( $args = array(), $value = false ){
	extract( $args ); ?>
	<tr style="display:none;">
		<th></th>
		<td>
			<input id="<?php echo $name; ?>" type="text" name="<?php echo $name; ?>" value="<?php echo esc_html( $value ); ?>">
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php 
}

function get_meta_imagesampler( $args = array(), $value = false ){
	extract($args);
	?>
	<tr>
	<th style="width:20%;">
		<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
	</th>
	<td>
		<div class="imagesampler-uploader" style="position:relative;">
			<div class="flowuploader">
				<input class="flowuploader_media_url" type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value ); ?>" />
				<span class="flowuploader_upload_button button">Select image</span>
				<!-- <div class="flowuploader_media_preview_image"></div> -->
			</div>
			
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />

			<div class="ims_canvas_wrapper" style="width: 100%;">
				<div class="ims_column1">
					<div class="img_preview"></div>
					<canvas id="panel" width="400" height="300"></canvas>
					<div class="empty-canvas image-missing"><p><?php _e('An image could not be found under the provided URL.', 'flowthemes'); ?></p></div>
					<div class="empty-canvas image-loading"><p><?php _e('Loading...', 'flowthemes'); ?></p></div>
				</div>
				<div class="ims_column2">
					<input class="ims_color" type="text" name="<?php echo 'thumbnail_hover_color'; ?>" placeholder="" value="" />
					<p>(Mouse over color.)</p>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		<p><?php echo $desc; ?></p>
	</td>
	</tr>
<?php }

function get_meta_select( $args = array(), $value = false ) {
	extract( $args );
		if(isset($is_multiple) && $is_multiple){
			$page_portfolio_post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
			if($page_portfolio_post_id){
				$value = get_post_meta($page_portfolio_post_id, $name, true);
			}
		}else{
			$is_multiple = false;
		}
	?>
	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<select <?php if($is_multiple){ echo ' multiple="multiple"'; } ?> name="<?php echo $name; if($is_multiple){ echo '[]'; } ?>" id="<?php echo $name; ?>">
				<?php foreach( $options as $optionkey => $optionval ){ ?>
					<option value="<?php echo $optionkey; ?>" <?php if((is_array($value) && in_array($optionkey, $value)) || (is_string($value) && $optionkey == $value)){ echo ' selected="selected"'; } ?>><?php echo $optionval; ?></option>
				<?php } ?>
			</select>
			<p>
				<?php echo $desc; ?>
			</p>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php 
}

function get_meta_textarea( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo esc_html( $value ); ?></textarea>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<p>
				<?php echo $desc; ?>
			</p>
		</td>
	</tr>
	<?php 
}

/* Add a new meta box to the admin menu. */
add_action( 'admin_menu', 'flowthemes_create_meta_box' );

/* Saves the meta box data. */
add_action( 'save_post', 'flowthemes_save_meta_data' );

/**
 * Loops through each meta box's set of variables.
 * Saves them to the database as custom fields.
 *
 * @param int $post_id
 */
function flowthemes_save_meta_data( $post_id ) {
	global $post;
	$i = 0;

	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		$meta_boxes = array_merge( flowthemes_page_meta_boxes() );
	} elseif ( isset( $_POST['post_type'] ) && 'portfolio' == $_POST['post_type'] ) {
		$meta_boxes = array_merge( flowthemes_portfolio_meta_boxes() );
	} else {
		$meta_boxes = array_merge( flowthemes_post_meta_boxes() );
	}
		
	foreach ( $meta_boxes as $meta_box ) :
		
		if ( isset( $_POST[$meta_box['name'] . '_noncename'] ) && !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) )
			return $post_id;

		if ( ! isset( $_POST['post_type'] ) || ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) ) ) {
			return $post_id;
		} else if ( ! isset( $_POST['post_type'] ) || ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) ) ) {
			return $post_id;
		}

		$data = isset( $_POST[$meta_box['name']] ) ? $_POST[$meta_box['name']] : '';
		if(!is_array($data)){
			$data = stripslashes($data);
		}

		// Update post		 
		if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
			add_post_meta( $post_id, $meta_box['name'], $data, true );

		elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
			update_post_meta( $post_id, $meta_box['name'], $data );

		elseif ( $data == '' )
			delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );

	endforeach;
}

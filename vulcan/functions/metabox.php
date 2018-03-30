<?php

/* Add Meta Box for Portfolio */
function vulcan_portfolio_meta_boxes() {
  $meta_boxes = array(
    "portfolio_link" => array(
      "name" => "_portfolio_link",
      "title" => "Preview link",
      "description" => "please enter image or video url if you want to create video post.<br/>Images : <br />http://localhost/ovum/wp-content/uploads/2010/07/image.jpg<br/> Video : <br />
      http://www.youtube.com/watch?v=tESK9RcyexU<br />
      http://vimeo.com/12816548<br />
      http://localhost/vulcan/wp-content/uploads/2010/07/sample.3gp<br />
      http://localhost/vulcan/wp-content/uploads/2010/07/sample.mp4<br />
      http://localhost/vulcan/wp-content/uploads/2010/07/sample.mov<br />
      http://www.adobe.com/jp/events/cs3_web_edition_tour/swfs/perform.swf?width=680&height=405<br />
      Note : for swf movie, you need to specify the width and height for movie, as above example",
      "type" => "text"
    ),
    "portfolio_url" => array(
      "name" => "_portfolio_url",
      "title" => "Custom URL",
      "description" => "Add link / custom URL for your portfolio items, eg. link to external url.",
      "type" => "text"
    )    
  );
  
  return apply_filters( 'vulcan_portfolio_meta_boxes', $meta_boxes );
}

function vulcan_post_meta_boxes() {

  $meta_boxes = array(
    "video_image_link" => array(
      "name" => "_video_image_link",
      "title" => "Images / Video link",
      "description" => "please enter image or video url if you want to create video post.<br/>Images : <br />http://localhost/ovum/wp-content/uploads/2010/07/image.jpg<br/> Video : <br />
      http://www.youtube.com/watch?v=tESK9RcyexU<br />
      http://vimeo.com/12816548<br />
      http://localhost/vulcan/wp-content/uploads/2010/07/sample.3gp<br />
      http://localhost/vulcan/wp-content/uploads/2010/07/sample.mp4<br />
      http://localhost/vulcan/wp-content/uploads/2010/07/sample.mov<br />
      http://www.adobe.com/jp/events/cs3_web_edition_tour/swfs/perform.swf?width=680&height=405<br />
      Note : for swf movie, you need to specify the width and height for movie, as above example",
      "type" => "text"
    )   
  );

	return apply_filters( 'vulcan_post_meta_boxes', $meta_boxes );
}

function vulcan_page_meta_boxes() {

  $meta_boxes = array(
    "short_desc" => array(
      "name" => "_short_desc",
      "title" => "Short Description",
      "description" => "Add short description to your pages.",
      "type" => "textarea"
    ),
    "page_sidebar_widget" => array(
      "name" => "_page_sidebar_widget",
      "title" => __("Sidebar Position",'vulcan'),
      "description" => __("Select default page sidebar widget",'vulcan'),
      "std" => "None",
      "type" => "select_sidebar_widget"
    )
  );

	return apply_filters( 'vulcan_page_meta_boxes', $meta_boxes );
}

function vulcan_slideshow_meta_boxes() {

  $meta_boxes = array(
    "slideshow_url" => array(
      "name" => "_slideshow_url",
      "title" => "Slideshow Url",
      "description" => "Link url for slideshow.",
      "type" => "text"
    ),
    "slideshow_readmore" => array(
      "name" => "_slideshow_readmore",
      "title" => "Slideshow Read More Text",
      "description" => "Please enter the read more text for slideshow, eg : Continue Reading, Read More.",
      "type" => "text"
    ),
    "slideshow_style" => array(
      "name" => "_slideshow_style",
      "title" => "Slideshow Stage Style",
      "description" => "Please one style of them for each image slideshow.",
      "type" => "select",
      "options" => array("full image","with right description","with left description","with bottom description")
    )     
  );

	return apply_filters( 'vulcan_slideshow_meta_boxes', $meta_boxes );
}

function vulcan_client_meta_boxes() {

  $meta_boxes = array(
    "custom_url" => array(
      "name" => "_custom_url",
      "title" => "Custom URL",
      "description" => "Add cusotm URL for client items.",
      "type" => "text"
    )
  );

	return apply_filters( 'vulcan_client_meta_boxes', $meta_boxes );
}

function  client_meta_boxes() {
  global $post;
  $meta_boxes = vulcan_client_meta_boxes();
  ?>

  <table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = get_post_meta( $post->ID, $meta['name'], true );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
  </table>
  <?php
}


function  portfolio_meta_boxes() {
  global $post;
  $meta_boxes = vulcan_portfolio_meta_boxes();
  ?>

  <table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = get_post_meta( $post->ID, $meta['name'], true );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
  </table>
  <?php
}

function post_meta_boxes() {
	global $post;
	$meta_boxes = vulcan_post_meta_boxes(); ?>

	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = get_post_meta( $post->ID, $meta['name'], true );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
	</table>
<?php
}

function page_meta_boxes() {
	global $post;
	$meta_boxes = vulcan_page_meta_boxes(); ?>

	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
    elseif ( $meta['type'] == 'select_sidebar_widget' )
			get_meta_select_sidebar_widget( $meta, $value );

	endforeach; ?>
	</table>
<?php
}

function slideshow_meta_boxes() {
	global $post;
	$meta_boxes = vulcan_slideshow_meta_boxes(); ?>

	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
	</table>
<?php
}

function get_meta_select_sidebar_widget( $args = array(), $value = false ) {
    global $wp_registered_sidebars;
	extract( $args ); 
    
    $sidebar_options = array();
    if (!empty($wp_registered_sidebars)) {
        foreach ( $wp_registered_sidebars as $sidebar_wdgt) {
            $sidebar_options[$sidebar_wdgt['id']] = $sidebar_wdgt['name'];
        }   
    }  
  ?>
	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
			<?php foreach ( $sidebar_options as $option ) : ?>
				<option <?php if ( htmlentities( $value, ENT_QUOTES ) == $option) echo ' selected="selected"'; ?>>
					<?php echo $option; ?>
				</option>
			<?php endforeach; ?>
			</select><br /><small><?php echo $args['description']; ?></small>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}


function get_meta_text_input( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value, 1 ); ?>" size="30" tabindex="30" style="width: 97%;" /><br /><small><?php echo $args['description']; ?></small>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

function get_meta_select( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
			<?php foreach ( $options as $option ) : ?>
				<option <?php if ( htmlentities( $value, ENT_QUOTES ) == $option ) echo ' selected="selected"'; ?>>
					<?php echo $option; ?>
				</option>
			<?php endforeach; ?>
			</select><br /><small><?php echo $args['description']; ?></small>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}


function get_meta_textarea( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo esc_html( $value, 1 ); ?></textarea><br /><small><?php echo $args['description']; ?></small>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

function vulcan_create_meta_box() {
	global $theme_name;

	add_meta_box( 'post-meta-boxes', __('Post options','vulcan'), 'post_meta_boxes', 'post', 'normal', 'high' );
	add_meta_box( 'page-meta-boxes', __('Page options','vulcan'), 'page_meta_boxes', 'page', 'normal', 'high' );
	add_meta_box( 'slideshow-meta-boxes', __('Slideshow options','vulcan'), 'slideshow_meta_boxes', 'slideshow', 'normal', 'high' );
	add_meta_box( 'portfolio-meta-boxes', __('Portfolio options','vulcan'), 'portfolio_meta_boxes', 'portfolio', 'normal', 'high' );
  add_meta_box( 'client-meta-boxes', __('Client options','vulcan'), 'client_meta_boxes', 'client', 'normal', 'high' );
}

function vulcan_save_meta_data( $post_id ) {
	global $post;

	if ( 'page' == $_POST['post_type'] )
		$meta_boxes = array_merge( vulcan_page_meta_boxes() );
	else if ( 'post' == $_POST['post_type'] )
		$meta_boxes = array_merge( vulcan_post_meta_boxes() );
  else if ( 'slideshow' == $_POST['post_type'] )
    $meta_boxes = array_merge( vulcan_slideshow_meta_boxes() );
  else if ( 'portfolio' == $_POST['post_type'] )
    $meta_boxes = array_merge( vulcan_portfolio_meta_boxes() );
  else
    $meta_boxes = array_merge( vulcan_client_meta_boxes() );
  
  foreach ( $meta_boxes as $meta_box ) :

		if ( !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) )
			return $post_id;

		if ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) )
			return $post_id;

		elseif ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;

		elseif ( 'slideshow' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;

		elseif ( 'portfolio' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
      
    elseif ( 'client' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;

		$data = stripslashes( $_POST[$meta_box['name']] );

		if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
			add_post_meta( $post_id, $meta_box['name'], $data, true );

		elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
			update_post_meta( $post_id, $meta_box['name'], $data );

		elseif ( $data == '' )
			delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );

	endforeach;
}



/* Add a new meta box to the admin menu. */
	add_action( 'admin_menu', 'vulcan_create_meta_box' );

/* Saves the meta box data. */
	add_action( 'save_post', 'vulcan_save_meta_data' );

?>
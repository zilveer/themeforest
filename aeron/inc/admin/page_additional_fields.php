<?php  
$post_id_post = isset($_POST['post_ID']) ? $_POST['post_ID'] : '' ;
$post_id = isset($_GET['post']) ? $_GET['post'] : $post_id_post ;

$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

if ( ! function_exists( 'ABdev_showhide_metabox_script_enqueuer' ) ){
function ABdev_showhide_metabox_script_enqueuer() {
	global $current_screen;
	if('page' != $current_screen->id){
		return;
	}

	echo <<<HTML
		<script type="text/javascript">
		jQuery(document).ready( function($) {
			if($('#page_template').val() == 'page-front-page.php') {
				$('#front-page-metabox-options').show();
			} else {
				$('#front-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'page-front-page.php') {
					$('#front-page-metabox-options').show();
				} else {
					$('#front-page-metabox-options').hide();
				}
			}); 

			if($('#page_template').val() == 'page-contact.php') {
				$('#contact-page-metabox-options').show();
			} else {
				$('#contact-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'page-contact.php') {
					$('#contact-page-metabox-options').show();
				} else {
					$('#contact-page-metabox-options').hide();
				}
			});                 
			

			if($('#page_template').val() == 'coming-soon.php') {
				$('#coming-soon-page-metabox-options').show();
			} else {
				$('#coming-soon-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'coming-soon.php') {
					$('#coming-soon-page-metabox-options').show();
				} else {
					$('#coming-soon-page-metabox-options').hide();
				}
			});                 
			

			if($('#page_template').val() == 'page-contact-streetview.php') {
				$('#contact-streetview-page-metabox-options').show();
			} else {
				$('#contact-streetview-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'page-contact-streetview.php') {
					$('#contact-streetview-page-metabox-options').show();
				} else {
					$('#contact-streetview-page-metabox-options').hide();
				}
			});                 
			

			if($('#page_template').val() == 'page-portfolio-1col.php' || $('#page_template').val() == 'page-portfolio-3col.php' || $('#page_template').val() == 'page-portfolio-4col.php') {
				$('#portfolio-page-metabox-options').show();
			} else {
				$('#portfolio-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'page-portfolio-1col.php' || $(this).val() == 'page-portfolio-3col.php' || $(this).val() == 'page-portfolio-4col.php') {
					$('#portfolio-page-metabox-options').show();
				} else {
					$('#portfolio-page-metabox-options').hide();
				}
			});                 
			

			if($('#page_template').val() == 'default' || $('#page_template').val() == 'page-left-sidebar.php') {
				$('#sidebar-page-metabox-options').show();
			} else {
				$('#sidebar-page-metabox-options').hide();
			}
			$('#page_template').live('change', function(){
				if($(this).val() == 'default' || $(this).val() == 'page-left-sidebar.php') {
					$('#sidebar-page-metabox-options').show();
				} else {
					$('#sidebar-page-metabox-options').hide();
				}
			});                 
			

			if($('#page_template').val() != 'coming-soon.php') {
				$('#postimagediv').hide();
			} 
			$('#page_template').live('change', function(){
				if($(this).val() != 'coming-soon.php') {
					$('#postimagediv').hide();
				}
				else{
					$('#postimagediv').show();
				}
			});                 
			
		});    
		</script>
HTML;
}
}
add_action('admin_head', 'ABdev_showhide_metabox_script_enqueuer');

if ( ! function_exists( 'ABdevFW_add_meta_box' ) ){
	function ABdevFW_add_meta_box(){  
		add_meta_box( 'front-page-metabox-options', __('Frontpage options', 'ABdev_aeron' ), 'ABdevFW_construct_meta_box', 'page', 'normal', 'high' );  
		add_meta_box( 'contact-page-metabox-options', __('Google Map Options', 'ABdev_aeron' ), 'ABdevFW_construct_contact_meta_box', 'page', 'normal', 'high' );  
		add_meta_box( 'contact-streetview-page-metabox-options', __('Google Street View Options', 'ABdev_aeron' ), 'ABdevFW_construct_contact_streetview_meta_box', 'page', 'normal', 'high' );  
		add_meta_box( 'coming-soon-page-metabox-options', __('Counter Options', 'ABdev_aeron' ), 'ABdevFW_construct_coming_soon_meta_box', 'page', 'normal', 'high' );  
		add_meta_box( 'portfolio-page-metabox-options', __('Display categories', 'ABdev_aeron' ), 'ABdevFW_construct_portfolio_meta_box', 'page', 'normal', 'high' );  
		add_meta_box( 'sidebar-page-metabox-options', __('Select Sidebar', 'ABdev_aeron' ), 'ABdevFW_construct_sidebar_meta_box', 'page', 'normal', 'high' );  
	}
}
add_action( 'add_meta_boxes', 'ABdevFW_add_meta_box' );  



if ( ! function_exists( 'ABdevFW_construct_sidebar_meta_box' ) ){
	function ABdevFW_construct_sidebar_meta_box( $post ){ 
		global $aeron_options;

		$aeron_user_sidebars = (isset($aeron_options['sidebars']) && is_array($aeron_options['sidebars'])) ? $aeron_options['sidebars'] : array();
		$values = get_post_custom( $post->ID );
		$custom_sidebar = (isset($values['custom_sidebar'])) ? $values['custom_sidebar'][0] : '';
		wp_nonce_field( 'my_meta_box_sidebar_nonce', 'meta_box_sidebar_nonce' );
		?>  
		<p>  
			<select name="custom_sidebar" id="custom_sidebar">  
					<option value=""><?php _e('Default', 'ABdev_aeron') ?></option> ';
				<?php foreach ($aeron_user_sidebars as $sidebar) {
					echo '<option value="'.$sidebar.'" '. selected( $custom_sidebar, $sidebar, false ) . '>' . $sidebar . '</option> ';
				}
				?>
			</select>  
		</p>
		<?php
	}
}

if ( ! function_exists( 'ABdevFW_save_sidebar_meta_box' ) ){
	function ABdevFW_save_sidebar_meta_box( $post_id ){ 
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){ 
			return; 
		}
		if( !isset( $_POST['custom_sidebar'] ) || !wp_verify_nonce( $_POST['meta_box_sidebar_nonce'], 'my_meta_box_sidebar_nonce' ) ) {
			return; 
		}
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		if( isset( $_POST['custom_sidebar'] ) ){
			update_post_meta( $post_id, 'custom_sidebar', wp_kses( $_POST['custom_sidebar'] ,'') );  
		}
	}
}
add_action( 'save_post', 'ABdevFW_save_sidebar_meta_box' );  



if ( ! function_exists( 'ABdevFW_construct_portfolio_meta_box' ) ){
	function ABdevFW_construct_portfolio_meta_box( $post ){ 
		$tax_terms = get_terms('portfolio-category');
		if(is_array($tax_terms)){
			foreach ($tax_terms as $tax_term) {
				$slugs[] = $tax_term->slug;
			}
			$values = get_post_custom( $post->ID ); 
			$categories = isset( $values['categories'] ) ? esc_attr( $values['categories'][0] ) : '';
			$categories = explode(',',$categories);
			if(empty($categories[0])){
				$categories=$slugs;
			}
			wp_nonce_field( 'my_meta_box_portfolio_nonce', 'meta_box_portfolio_nonce' );
			?>  
			<p>
				<?php
				foreach ($tax_terms as $tax_term) {
					echo '<label for="categories['.$tax_term->slug.']"><input type="checkbox" id="categories['.$tax_term->slug.']" name="categories['.$tax_term->slug.']" value="'.$tax_term->slug.'" '; 
					if(in_array($tax_term->slug , $categories)){
						echo 'checked';
					}
					echo'> '.$tax_term->name .' ('.$tax_term->count.')</label><br>';
				}
				?>
			</p><?php
		}
		else{
			_e('Portfolio plugin must be installed and at least one portfolio category created', 'ABdev_aeron');
		}
	}
}

if ( ! function_exists( 'ABdevFW_save_portfolio_meta_box' ) ){
	function ABdevFW_save_portfolio_meta_box( $post_id ){ 
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){ 
			return; 
		}
		if( !isset( $_POST['categories'] ) || !wp_verify_nonce( $_POST['meta_box_portfolio_nonce'], 'my_meta_box_portfolio_nonce' ) ) {
			return; 
		}
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		if( isset( $_POST['categories'] ) ){
			$categories=implode(',',$_POST['categories']);
			update_post_meta( $post_id, 'categories', wp_kses( $categories ,'') );  
		}
	}
}
add_action( 'save_post', 'ABdevFW_save_portfolio_meta_box' );  


if ( ! function_exists( 'ABdevFW_construct_coming_soon_meta_box' ) ){
	function ABdevFW_construct_coming_soon_meta_box( $post ){  
		$values = get_post_custom( $post->ID ); 
		$datetime = (isset( $values['datetime']) && $values['datetime'][0]!='') ? esc_attr( $values['datetime'][0] ) : date("F j, Y H:i:s", strtotime("+1 month"));

		wp_nonce_field( 'my_meta_box_contact_nonce', 'meta_box_contact_nonce' );
		?>  
		<p>
			<label for="datetime"><?php _e('Countdown Target Date and Time','ABdev_aeron'); ?></label> 
			<input type="text" name="datetime" id="datetime" value="<?php echo $datetime; ?>" style="width:100%;" />
		</p>
		<?php
	}
}

if ( ! function_exists( 'ABdevFW_save_coming_soon_meta_box' ) ){
	function ABdevFW_save_coming_soon_meta_box( $post_id ){  
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return; 
		}
		if( !isset( $_POST['meta_box_contact_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_contact_nonce'], 'my_meta_box_contact_nonce' ) ) {
			return; 
		}
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		$allowed = array(   
			'a' => array( 
				'href' => array() 
			)  
		);  

		if( isset( $_POST['datetime'] ) ){
			update_post_meta( $post_id, 'datetime', wp_kses( $_POST['datetime'], $allowed ) );  
		}
	}
}
add_action( 'save_post', 'ABdevFW_save_coming_soon_meta_box' );  


if ( ! function_exists( 'ABdevFW_construct_contact_meta_box' ) ){
	function ABdevFW_construct_contact_meta_box( $post ){  
		$values = get_post_custom( $post->ID ); 
		$map_type = isset( $values['map_type'] ) ? esc_attr( $values['map_type'][0] ) : 'ROADMAP';
		$lat = isset( $values['lat'] ) ? esc_attr( $values['lat'][0] ) : '40.7782201';
		$lng = isset( $values['lng'] ) ? esc_attr( $values['lng'][0] ) : '-73.9733317';
		$zoom = isset( $values['zoom'] ) ? esc_attr( $values['zoom'][0] ) : '16';
		$scrollwheel = (isset( $values['scrollwheel'] ) && $values['scrollwheel'][0]==1) ? 'checked="checked"' : '';
		$mapTypeControl = (isset( $values['mapTypeControl'] ) && $values['mapTypeControl'][0]==1) ? 'checked="checked"' : '';
		$panControl = (isset( $values['panControl'] ) && $values['panControl'][0]==1) ? 'checked="checked"' : '';
		$zoomControl = (isset( $values['zoomControl'] ) && $values['zoomControl'][0]==1) ? 'checked="checked"' : '';
		$scaleControl = (isset( $values['scaleControl'] ) && $values['scaleControl'][0]==1) ? 'checked="checked"' : '';
		$markerTitle = isset( $values['markerTitle'] ) ? esc_attr( $values['markerTitle'][0] ) : 'Our Company';
		$markerContent = isset( $values['markerContent'] ) ? esc_attr( $values['markerContent'][0] ) : 'Our Address';
		$markerLat = isset( $values['markerLat'] ) ? esc_attr( $values['markerLat'][0] ) : '40.7782201';
		$markerLng = isset( $values['markerLng'] ) ? esc_attr( $values['markerLng'][0] ) : '-73.9733317';
		wp_nonce_field( 'my_meta_box_contact_nonce', 'meta_box_contact_nonce' );
		?>  
		<p>  
			<label for="map_type">Map Type</label>  
			<select name="map_type" id="map_type">  
				<option value="ROADMAP" <?php selected( $map_type, 'ROADMAP' ); ?>><?php _e('ROADMAP', 'ABdev_aeron' ); ?></option>  
				<option value="SATELLITE" <?php selected( $map_type, 'SATELLITE' ); ?>><?php _e('SATELLITE', 'ABdev_aeron' ); ?></option>  
				<option value="HYBRID" <?php selected( $map_type, 'HYBRID' ); ?>><?php _e('HYBRID', 'ABdev_aeron' ); ?></option>  
				<option value="TERRAIN" <?php selected( $map_type, 'TERRAIN' ); ?>><?php _e('TERRAIN', 'ABdev_aeron' ); ?></option>  
			</select>  
		</p>
		<p>
			<label for="lat"><?php _e('Map Center Latitude','ABdev_aeron'); ?></label> 
			<input type="text" name="lat" id="lat" value="<?php echo $lat; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="lng"><?php _e('Map Center Longitude','ABdev_aeron'); ?></label> 
			<input type="text" name="lng" id="lng" value="<?php echo $lng; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="zoom"><?php _e('Initial Zoom Level (0 - 21)','ABdev_aeron'); ?></label> 
			<input type="text" name="zoom" id="zoom" value="<?php echo $zoom; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="scrollwheel" class="selectit"><input name="scrollwheel" type="checkbox" id="scrollwheel" value="1" <?php echo $scrollwheel; ?>> <?php _e('Enable Mouse Scroll Wheel for Map Zoom','ABdev_aeron'); ?></label>
		</p>
		<p>
			<label for="mapTypeControl" class="selectit"><input name="mapTypeControl" type="checkbox" id="mapTypeControl" value="1" <?php echo $mapTypeControl; ?>> <?php _e('Show Map Type Control','ABdev_aeron'); ?></label>
		</p>
		<p>
			<label for="panControl" class="selectit"><input name="panControl" type="checkbox" id="panControl" value="1" <?php echo $panControl; ?>> <?php _e('Show Map Pan Control','ABdev_aeron'); ?></label>
		</p>
		<p>
			<label for="zoomControl" class="selectit"><input name="zoomControl" type="checkbox" id="zoomControl" value="1" <?php echo $zoomControl; ?>> <?php _e('Show Map Zoom Control','ABdev_aeron'); ?></label>
		</p>
		<p>
			<label for="scaleControl" class="selectit"><input name="scaleControl" type="checkbox" id="scaleControl" value="1" <?php echo $scaleControl; ?>> <?php _e('Show Map Scale Control','ABdev_aeron'); ?></label>
		</p>
		<p>
			<strong><?php _e('Marker Options','ABdev_aeron'); ?></strong>
		</p>
		<p>
			<label for="markerTitle"><?php _e('Marker Title','ABdev_aeron'); ?></label> 
			<input type="text" name="markerTitle" id="markerTitle" value="<?php echo $markerTitle; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="markerContent"><?php _e('Marker Popup Content','ABdev_aeron'); ?></label> 
			<input type="text" name="markerContent" id="markerContent" value="<?php echo $markerContent; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="markerLat"><?php _e('Marker Latitude','ABdev_aeron'); ?></label> 
			<input type="text" name="markerLat" id="markerLat" value="<?php echo $markerLat; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="markerLng"><?php _e('Marker Longitude','ABdev_aeron'); ?></label> 
			<input type="text" name="markerLng" id="markerLng" value="<?php echo $markerLng; ?>" style="width:100%;" />
		</p>
		<?php
	}
}

if ( ! function_exists( 'ABdevFW_save_contact_meta_box' ) ){
	function ABdevFW_save_contact_meta_box( $post_id ){  
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return; 
		}
		if( !isset( $_POST['meta_box_contact_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_contact_nonce'], 'my_meta_box_contact_nonce' ) ) {
			return; 
		}
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		$allowed = array(   
			'a' => array( 
				'href' => array() 
			)  
		);  

		if( isset( $_POST['map_type'] ) ){
			update_post_meta( $post_id, 'map_type', wp_kses( $_POST['map_type'], $allowed ) );  
		}
		if( isset( $_POST['lat'] ) ){
			update_post_meta( $post_id, 'lat', wp_kses( $_POST['lat'], $allowed ) );  
		}
		if( isset( $_POST['lng'] ) ){
			update_post_meta( $post_id, 'lng', wp_kses( $_POST['lng'], $allowed ) );  
		}
		if( isset( $_POST['zoom'] ) ){
			update_post_meta( $post_id, 'zoom', wp_kses( $_POST['zoom'], $allowed ) );  
		}

		$scrollwheel = ( isset( $_POST['scrollwheel']) && $_POST['scrollwheel']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'scrollwheel', $scrollwheel );  
		
		$mapTypeControl = ( isset( $_POST['mapTypeControl']) && $_POST['mapTypeControl']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'mapTypeControl', $mapTypeControl );  
		
		$panControl = ( isset( $_POST['panControl']) && $_POST['panControl']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'panControl', $panControl );  
		
		$zoomControl = ( isset( $_POST['zoomControl']) && $_POST['zoomControl']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'zoomControl', $zoomControl );  

		$scaleControl = ( isset( $_POST['scaleControl']) && $_POST['scaleControl']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'scaleControl', $scaleControl );  
		
		if( isset( $_POST['markerTitle'] ) ){
			update_post_meta( $post_id, 'markerTitle', wp_kses( $_POST['markerTitle'], $allowed ) );  
		}
		if( isset( $_POST['markerContent'] ) ){
			update_post_meta( $post_id, 'markerContent', wp_kses( $_POST['markerContent'], $allowed ) );  
		}
		if( isset( $_POST['markerLat'] ) ){
			update_post_meta( $post_id, 'markerLat', wp_kses( $_POST['markerLat'], $allowed ) );  
		}
		if( isset( $_POST['markerLng'] ) ){
			update_post_meta( $post_id, 'markerLng', wp_kses( $_POST['markerLng'], $allowed ) );  
		}
	}
}
add_action( 'save_post', 'ABdevFW_save_contact_meta_box' );  


if ( ! function_exists( 'ABdevFW_construct_contact_streetview_meta_box' ) ){
	function ABdevFW_construct_contact_streetview_meta_box( $post ){  
		$values = get_post_custom( $post->ID ); 
		$sV_lat = isset( $values['sV_lat'] ) ? esc_attr( $values['sV_lat'][0] ) : '40.7782201';
		$sV_lng = isset( $values['sV_lng'] ) ? esc_attr( $values['sV_lng'][0] ) : '-73.9733317';
		$heading = isset( $values['heading'] ) ? esc_attr( $values['heading'][0] ) : '0';
		$pitch = isset( $values['pitch'] ) ? esc_attr( $values['pitch'][0] ) : '0';
		$sV_zoom = isset( $values['sV_zoom'] ) ? esc_attr( $values['sV_zoom'][0] ) : '1';
		$rotationStep = isset( $values['rotationStep'] ) ? esc_attr( $values['rotationStep'][0] ) : '0.05';
		$clickToGo = (isset( $values['clickToGo'] ) && $values['clickToGo'][0]==1) ? 'checked="checked"' : '';
		$disableDoubleClickZoom = (isset( $values['disableDoubleClickZoom'] ) && $values['disableDoubleClickZoom'][0]==1) ? 'checked="checked"' : '';
		$linksControl = (isset( $values['linksControl'] ) && $values['linksControl'][0]==1) ? 'checked="checked"' : '';
		$sV_scrollwheel = (isset( $values['sV_scrollwheel'] ) && $values['sV_scrollwheel'][0]==1) ? 'checked="checked"' : '';
		$sV_panControl = (isset( $values['sV_panControl'] ) && $values['sV_panControl'][0]==1) ? 'checked="checked"' : '';
		$sV_zoomControl = (isset( $values['sV_zoomControl'] ) && $values['sV_zoomControl'][0]==1) ? 'checked="checked"' : '';
		$rotation = (isset( $values['rotation'] ) && $values['rotation'][0]==1) ? 'checked="checked"' : '';
		wp_nonce_field( 'my_meta_box_contact_nonce', 'meta_box_contact_nonce' );
		?>  
		<p>
			<label for="sV_lat"><?php _e('Street View Latitude','ABdev_aeron'); ?></label> 
			<input type="text" name="sV_lat" id="sV_lat" value="<?php echo $sV_lat; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="sV_lng"><?php _e('Street View Longitude','ABdev_aeron'); ?></label> 
			<input type="text" name="sV_lng" id="sV_lng" value="<?php echo $sV_lng; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="heading"><?php _e('Heading','ABdev_aeron'); ?></label> 
			<input type="text" name="heading" id="heading" value="<?php echo $heading; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="pitch"><?php _e('Pitch','ABdev_aeron'); ?></label> 
			<input type="text" name="pitch" id="pitch" value="<?php echo $pitch; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="sV_zoom"><?php _e('Initial Zoom Level','ABdev_aeron'); ?></label> 
			<input type="text" name="sV_zoom" id="sV_zoom" value="<?php echo $sV_zoom; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="clickToGo" class="selectit"><input name="clickToGo" type="checkbox" id="clickToGo" value="1" <?php echo $clickToGo; ?>> <?php _e('Click to Go','ABdev_aeron'); ?></label>
		</p>
		<p>
			<label for="disableDoubleClickZoom" class="selectit"><input name="disableDoubleClickZoom" type="checkbox" id="disableDoubleClickZoom" value="1" <?php echo $disableDoubleClickZoom; ?>> <?php _e('Disable Double Click Zoom','ABdev_aeron'); ?></label>
		</p>
		<p>
			<label for="linksControl" class="selectit"><input name="linksControl" type="checkbox" id="linksControl" value="1" <?php echo $linksControl; ?>> <?php _e('Links Control','ABdev_aeron'); ?></label>
		</p>
		<p>
			<label for="sV_scrollwheel" class="selectit"><input name="sV_scrollwheel" type="checkbox" id="sV_scrollwheel" value="1" <?php echo $sV_scrollwheel; ?>> <?php _e('Scroll Wheel Zoom','ABdev_aeron'); ?></label>
		</p>
		<p>
			<label for="sV_panControl" class="selectit"><input name="sV_panControl" type="checkbox" id="sV_panControl" value="1" <?php echo $sV_panControl; ?>> <?php _e('Pan Control','ABdev_aeron'); ?></label>
		</p>
		<p>
			<label for="sV_zoomControl" class="selectit"><input name="sV_zoomControl" type="checkbox" id="sV_zoomControl" value="1" <?php echo $sV_zoomControl; ?>> <?php _e('Zoom Control','ABdev_aeron'); ?></label>
		</p>
		<p>
			<label for="rotation" class="selectit"><input name="rotation" type="checkbox" id="rotation" value="1" <?php echo $rotation; ?>> <?php _e('Rotation','ABdev_aeron'); ?></label>
		</p>
		<p>
			<label for="rotationStep"><?php _e('Rotation Step','ABdev_aeron'); ?></label> 
			<input type="text" name="rotationStep" id="rotationStep" value="<?php echo $rotationStep; ?>" style="width:100%;" />
		</p>
		<?php
	}
}
if ( ! function_exists( 'ABdevFW_save_contact_streetview_meta_box' ) ){
	function ABdevFW_save_contact_streetview_meta_box( $post_id ){  
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return; 
		}
		if( !isset( $_POST['meta_box_contact_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_contact_nonce'], 'my_meta_box_contact_nonce' ) ) {
			return; 
		}
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		$allowed = array(   
			'a' => array( 
				'href' => array() 
			)  
		);  

		if( isset( $_POST['sV_lat'] ) ){
			update_post_meta( $post_id, 'sV_lat', wp_kses( $_POST['sV_lat'], $allowed ) );  
		}
		if( isset( $_POST['sV_lng'] ) ){
			update_post_meta( $post_id, 'sV_lng', wp_kses( $_POST['sV_lng'], $allowed ) );  
		}
		if( isset( $_POST['heading'] ) ){
			update_post_meta( $post_id, 'heading', wp_kses( $_POST['heading'], $allowed ) );  
		}
		if( isset( $_POST['pitch'] ) ){
			update_post_meta( $post_id, 'pitch', wp_kses( $_POST['pitch'], $allowed ) );  
		}
		if( isset( $_POST['sV_zoom'] ) ){
			update_post_meta( $post_id, 'sV_zoom', wp_kses( $_POST['sV_zoom'], $allowed ) );  
		}
		if( isset( $_POST['rotationStep'] ) ){
			update_post_meta( $post_id, 'rotationStep', wp_kses( $_POST['rotationStep'], $allowed ) );  
		}

		$clickToGo = ( isset( $_POST['clickToGo']) && $_POST['clickToGo']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'clickToGo', $clickToGo );  
		$disableDoubleClickZoom = ( isset( $_POST['disableDoubleClickZoom']) && $_POST['disableDoubleClickZoom']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'disableDoubleClickZoom', $disableDoubleClickZoom );  
		$linksControl = ( isset( $_POST['linksControl']) && $_POST['linksControl']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'linksControl', $linksControl );  
		$sV_scrollwheel = ( isset( $_POST['sV_scrollwheel']) && $_POST['sV_scrollwheel']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'sV_scrollwheel', $sV_scrollwheel );  
		$sV_panControl = ( isset( $_POST['sV_panControl']) && $_POST['sV_panControl']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'sV_panControl', $sV_panControl );  
		$sV_zoomControl = ( isset( $_POST['sV_zoomControl']) && $_POST['sV_zoomControl']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'sV_zoomControl', $sV_zoomControl );  
		$rotation = ( isset( $_POST['rotation']) && $_POST['rotation']==1 ) ? 1 : 0;
		update_post_meta( $post_id, 'rotation', $rotation );  
		
	}
}
add_action( 'save_post', 'ABdevFW_save_contact_streetview_meta_box' );  




if ( ! function_exists( 'ABdevFW_construct_meta_box' ) ){
	function ABdevFW_construct_meta_box( $post ){  
		$values = get_post_custom( $post->ID );  
		$revslider_alias = isset( $values['revslider_alias'] ) ? esc_attr( $values['revslider_alias'][0] ) : ''; 
		
		// We'll use this nonce field later on when saving.  
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
		?>  
		
		<div id='revslider_options'>
			<h4><?php _e('Revolution Slider Options', 'ABdev_aeron' ); ?></h4>
			<?php 
			if(class_exists('RevSlider')){
				$slider = new RevSlider();
				$arrSliders = $slider->getArrSlidersShort();
						
				if(empty($arrSliders)){
					_e('No sliders found, Please create a slider', 'ABdev_aeron');
				}
				else{
					$select = UniteFunctionsRev::getHTMLSelect($arrSliders,$revslider_alias,'name="revslider_alias" id="revslider_alias"',true);
					?>
					<p>
					<label for="revslider_alias"><?php _e('Choose Slider', 'ABdev_aeron' ); ?></label> 
					<?php echo $select; ?>
					</p><?php
				}
			}
			else{
				_e('Slider Revolution plugin not installed', 'ABdev_aeron');
			}
				?>
		</div>
		<?php 
	}
}
if ( ! function_exists( 'ABdevFW_save_meta_box' ) ){
	function ABdevFW_save_meta_box( $post_id ){  
		// Bail if we're doing an auto save  
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return; 
		}
		// if our nonce isn't there, or we can't verify it, bail 
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) {
			return; 
		}
		// if our current user can't edit this post, bail  
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		// now we can actually save the data  
		
		if( isset( $_POST['revslider_alias'] ) )  {
			update_post_meta( $post_id, 'revslider_alias', esc_attr( $_POST['revslider_alias'] ) ); 
		}
	}
}
add_action( 'save_post', 'ABdevFW_save_meta_box' );  

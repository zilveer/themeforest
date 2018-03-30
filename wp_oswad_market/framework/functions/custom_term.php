<?php

	add_action( 'product_cat_add_form_fields', 'wd_add_category_fields',19 );
	add_action( 'product_cat_edit_form_fields', 'wd_edit_category_fields', 10,2 );
	add_action( 'created_term', 'wd_category_fields_save', 10,3 );
	add_action( 'edit_term', 'wd_category_fields_save', 10,3 );
	add_action( 'delete_term', 'wd_category_fields_remove', 10,3 );

function wd_add_category_fields(){
?>

	<div class="form-field">
		<label for="display_type"><?php _e( 'Product Columns', 'wpdance' ); ?></label>
		<select name="cat_columns" id="_prod_cat_columns" class="postform">
			<option value="0"> Default </option>
			<option value="2"> 2 Columns </option>
			<option value="3"> 3 Columns </option>
			<option value="4"> 4 Columns </option>
			<option value="6"> 6 Columns </option>
		</select>
	</div>

	<div class="form-field">
		<label for="display_type"><?php _e( 'Category Layout', 'wpdance' ); ?></label>
		<select name="cat_layout" id="_prod_cat_layout" class="postform">
			<option value="0"> Default </option>
			<option value="0-1-0"> Fullwidth </option>
			<option value="0-1-1"> Right Sidebar </option>
			<option value="1-1-0"> Left Sidebar </option>
			<option value="1-1-1"> Left & Right Sidebar </option>
		</select>
	</div>


	<div class="form-field">
		<label for="display_type"><?php _e( 'Custom Informations', 'wpdance' ); ?></label>
		<hr />
		<?php wp_editor( stripslashes(htmlspecialchars_decode('')), 'cat_custom_content' );	?>			
	</div>	


<?php							
}

function wd_edit_category_fields( $term, $taxonomy ){
		
	$datas = get_metadata( 'woocommerce_term', $term->term_id, "cat_config", true );
	if( strlen($datas) > 0 ){
		$datas = unserialize($datas);	
	}else{
		$datas = get_option(THEME_SLUG.'category_product_config','');
		$datas = unserialize($datas);
		
		$datas = wd_array_atts(
			array(
						'cat_columns' 				=> 0
						,'cat_layout' 				=> "0"
						,'cat_left_sidebar' 		=> "0"
						,'cat_right_sidebar' 		=> "0"
						,'cat_custom_content'		=> ''
				)
			,$datas);		
	}
?>

	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Product Columns', 'wpdance' ); ?></label></th>
		<td>
			<select name="cat_columns" id="_prod_cat_columns" class="postform">
				<option value="0" <?php if( strcmp($datas["cat_columns"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<option value="2" <?php if( strcmp($datas["cat_columns"],'2') == 0 ) echo "selected='selected'";?>> 2 Columns </option>
				<option value="3" <?php if( strcmp($datas["cat_columns"],'3') == 0 ) echo "selected='selected'";?>> 3 Columns </option>
				<option value="4" <?php if( strcmp($datas["cat_columns"],'4') == 0 ) echo "selected='selected'";?>> 4 Columns </option>
				<option value="6" <?php if( strcmp($datas["cat_columns"],'6') == 0 ) echo "selected='selected'";?>> 6 Columns </option>
			</select>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Category Layout', 'wpdance' ); ?></label></th>
		<td>
			<select name="cat_layout" id="_prod_cat_layout" class="postform">
				<option value="0" <?php if( strcmp($datas["cat_layout"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<option value="0-1-0" <?php if( strcmp($datas["cat_layout"],'0-1-0') == 0 ) echo "selected='selected'";?>> Fullwidth </option>
				<option value="0-1-1" <?php if( strcmp($datas["cat_layout"],'0-1-1') == 0 ) echo "selected='selected'";?>> Right Sidebar </option>
				<option value="1-1-0" <?php if( strcmp($datas["cat_layout"],'1-1-0') == 0 ) echo "selected='selected'";?>> Left Sidebar </option>
				<option value="1-1-1" <?php if( strcmp($datas["cat_layout"],'1-1-1') == 0 ) echo "selected='selected'";?>> Left & Right Sidebar </option>
			</select>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Left SideBar', 'wpdance' ); ?></label></th>
		<td>
			<select name="cat_left_sidebar" id="_prod_cat_left_sidebar" class="postform">
				<option value="0" <?php if( strcmp($datas["cat_left_sidebar"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<?php
					global $default_sidebars;
					foreach( $default_sidebars as $key => $_sidebar ){
						$_selected_str = ( strcmp($datas["cat_left_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
						echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
					}
				?>
			</select>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Right Sidebar', 'wpdance' ); ?></label></th>
		<td>
			<select name="cat_right_sidebar" id="_prod_cat_right_sidebar" class="postform">
				<option value="0" <?php if( strcmp($datas["cat_right_sidebar"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<?php
					global $default_sidebars;
					foreach( $default_sidebars as $key => $_sidebar ){
						$_selected_str = ( strcmp($datas["cat_right_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
						echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
					}
				?>
			</select>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Custom Informations', 'wpdance' ); ?></label></th>
		<td>
			<?php wp_editor( stripslashes(htmlspecialchars_decode( base64_decode($datas['cat_custom_content']) )), 'cat_custom_content' );	?>			
		</td>
	</tr>
<?php
}
function wd_category_fields_save( $term_id, $tt_id, $taxonomy ){
	
	if( isset($_POST['_inline_edit']) ) {
        return $term_id;	
	}	
	
	$_term_config = array();
	
	$_term_config["cat_columns"] = isset( $_POST['cat_columns'] ) ? absint( $_POST['cat_columns'] ) : 0 ;
	$_term_config["cat_layout"] = isset( $_POST['cat_layout'] ) ? wp_kses_data( $_POST['cat_layout'] ) : "0" ;
	$_term_config["cat_left_sidebar"] = isset( $_POST['cat_left_sidebar'] ) ? wp_kses_data( $_POST['cat_left_sidebar'] ) : "0" ;
	$_term_config["cat_right_sidebar"] = isset( $_POST['cat_right_sidebar'] ) ? wp_kses_data( $_POST['cat_right_sidebar'] ) : "0" ;
	$_term_config["cat_custom_content"] = isset( $_POST['cat_custom_content'] ) ? base64_encode( htmlspecialchars( $_POST['cat_custom_content'] ) ) : "" ;
	
	$_term_config_str = serialize($_term_config);
	
	$result = update_metadata( 'woocommerce_term',$term_id,"cat_config",$_term_config_str );

}

function wd_category_fields_remove( $term_id, $tt_id, $taxonomy ){
	delete_metadata( 'woocommerce_term',$term_id,"cat_config" );
}

/** CUSTOM TAG FIELDS **/
	add_action( 'product_tag_add_form_fields', 'wd_add_tag_fields',19 );
	add_action( 'product_tag_edit_form_fields', 'wd_edit_tag_fields', 10,2 );
	add_action( 'created_term', 'wd_tag_fields_save', 10,3 );
	add_action( 'edit_term', 'wd_tag_fields_save', 10,3 );
	add_action( 'delete_term', 'wd_tag_fields_remove', 10,3 );

function wd_add_tag_fields(){
?>

	<div class="form-field">
		<label for="display_type"><?php _e( 'Product Columns', 'wpdance' ); ?></label>
		<select name="tag_columns" id="_prod_tag_columns" class="postform">
			<option value="0"> Default </option>
			<option value="2"> 2 Columns </option>
			<option value="3"> 3 Columns </option>
			<option value="4"> 4 Columns </option>
			<option value="6"> 6 Columns </option>
		</select>
	</div>

	<div class="form-field">
		<label for="display_type"><?php _e( 'Tag Layout', 'wpdance' ); ?></label>
		<select name="tag_layout" id="_prod_tag_layout" class="postform">
			<option value="0"> Default </option>
			<option value="0-1-0"> Fullwidth </option>
			<option value="0-1-1"> Right Sidebar </option>
			<option value="1-1-0"> Left Sidebar </option>
			<option value="1-1-1"> Left & Right Sidebar </option>
		</select>
	</div>


	<div class="form-field">
		<label for="display_type"><?php _e( 'Custom Informations', 'wpdance' ); ?></label>
		<hr />
		<?php wp_editor( stripslashes(htmlspecialchars_decode('')), 'tag_custom_content' );	?>			
	</div>	


<?php							
}

function wd_edit_tag_fields( $term, $taxonomy ){
		
	$datas = get_metadata( 'woocommerce_term', $term->term_id, "tag_config", true );
	if( strlen($datas) > 0 ){
		$datas = unserialize($datas);	
	}
	else{
		$datas = array();
	}
	$datas = wd_array_atts(
		array(
					'tag_columns' 				=> 0
					,'tag_layout' 				=> "0"
					,'tag_left_sidebar' 		=> "0"
					,'tag_right_sidebar' 		=> "0"
					,'tag_custom_content'		=> ''
			)
		,$datas);		
?>

	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Product Columns', 'wpdance' ); ?></label></th>
		<td>
			<select name="tag_columns" id="_prod_tag_columns" class="postform">
				<option value="0" <?php if( strcmp($datas["tag_columns"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<option value="2" <?php if( strcmp($datas["tag_columns"],'2') == 0 ) echo "selected='selected'";?>> 2 Columns </option>
				<option value="3" <?php if( strcmp($datas["tag_columns"],'3') == 0 ) echo "selected='selected'";?>> 3 Columns </option>
				<option value="4" <?php if( strcmp($datas["tag_columns"],'4') == 0 ) echo "selected='selected'";?>> 4 Columns </option>
				<option value="6" <?php if( strcmp($datas["tag_columns"],'6') == 0 ) echo "selected='selected'";?>> 6 Columns </option>
			</select>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Tag Layout', 'wpdance' ); ?></label></th>
		<td>
			<select name="tag_layout" id="_prod_tag_layout" class="postform">
				<option value="0" <?php if( strcmp($datas["tag_layout"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<option value="0-1-0" <?php if( strcmp($datas["tag_layout"],'0-1-0') == 0 ) echo "selected='selected'";?>> Fullwidth </option>
				<option value="0-1-1" <?php if( strcmp($datas["tag_layout"],'0-1-1') == 0 ) echo "selected='selected'";?>> Right Sidebar </option>
				<option value="1-1-0" <?php if( strcmp($datas["tag_layout"],'1-1-0') == 0 ) echo "selected='selected'";?>> Left Sidebar </option>
				<option value="1-1-1" <?php if( strcmp($datas["tag_layout"],'1-1-1') == 0 ) echo "selected='selected'";?>> Left & Right Sidebar </option>
			</select>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Left SideBar', 'wpdance' ); ?></label></th>
		<td>
			<select name="tag_left_sidebar" id="_prod_tag_left_sidebar" class="postform">
				<option value="0" <?php if( strcmp($datas["tag_left_sidebar"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<?php
					global $default_sidebars;
					foreach( $default_sidebars as $key => $_sidebar ){
						$_selected_str = ( strcmp($datas["tag_left_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
						echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
					}
				?>
			</select>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Right Sidebar', 'wpdance' ); ?></label></th>
		<td>
			<select name="tag_right_sidebar" id="_prod_tag_right_sidebar" class="postform">
				<option value="0" <?php if( strcmp($datas["tag_right_sidebar"],'0') == 0 ) echo "selected='selected'";?>> Default </option>
				<?php
					global $default_sidebars;
					foreach( $default_sidebars as $key => $_sidebar ){
						$_selected_str = ( strcmp($datas["tag_right_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
						echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
					}
				?>
			</select>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Custom Informations', 'wpdance' ); ?></label></th>
		<td>
			<?php wp_editor( stripslashes(htmlspecialchars_decode( base64_decode($datas['tag_custom_content']) )), 'tag_custom_content' );	?>			
		</td>
	</tr>
<?php
}
function wd_tag_fields_save( $term_id, $tt_id, $taxonomy ){
	
	if( isset($_POST['_inline_edit']) ) {
        return $term_id;	
	}	
	
	$_term_config = array();
	
	$_term_config["tag_columns"] = isset( $_POST['tag_columns'] ) ? absint( $_POST['tag_columns'] ) : 0 ;
	$_term_config["tag_layout"] = isset( $_POST['tag_layout'] ) ? wp_kses_data( $_POST['tag_layout'] ) : "0" ;
	$_term_config["tag_left_sidebar"] = isset( $_POST['tag_left_sidebar'] ) ? wp_kses_data( $_POST['tag_left_sidebar'] ) : "0" ;
	$_term_config["tag_right_sidebar"] = isset( $_POST['tag_right_sidebar'] ) ? wp_kses_data( $_POST['tag_right_sidebar'] ) : "0" ;
	$_term_config["tag_custom_content"] = isset( $_POST['tag_custom_content'] ) ? base64_encode( htmlspecialchars( $_POST['tag_custom_content'] ) ) : "" ;
	
	$_term_config_str = serialize($_term_config);
	
	$result = update_metadata( 'woocommerce_term',$term_id,"tag_config",$_term_config_str );

}

function wd_tag_fields_remove( $term_id, $tt_id, $taxonomy ){
	delete_metadata( 'woocommerce_term',$term_id,"tag_config" );
}

?>
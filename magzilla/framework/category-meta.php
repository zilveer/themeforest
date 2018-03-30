<?php


/* Add metaboxes to category */

if ( !function_exists( 'fave_category_add_meta_fields' ) ) :
	function fave_category_add_meta_fields() {
		$fave_meta = fave_get_category_meta(); 
		$sidebars_lay = fave_get_sidebar_layouts( );
		$post_layouts = fave_get_main_layouts( true );
		$sidebars = fave_get_sidebars_list();
		$cat_excerpt = fave_get_cat_excerpt();
		$show_child_cat = fave_show_child_cat();
		$pagination = fave_get_pagination( true );
			
?>
	
	<div class="form-field">
	  	<label><?php _e( 'Posts main layout', 'magzilla' ); ?></label>
	  	<ul class="fave-img-select-wrap next-hide">
	  	<?php foreach ( $post_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = fave_compare( $fave_meta['layout'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url( $layout['img'] ); ?>" title="<?php echo esc_attr( $layout['title'] ); ?>" class="fave-img-select<?php echo esc_attr( $selected_class ); ?>">
	  			<input type="radio" class="fave-hidden" name="fave[layout]" value="<?php echo esc_attr( $id ); ?>" <?php checked( $id, $fave_meta['layout'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>
	   <p class="description"><?php _e( 'Choose posts layout for this category', 'magzilla' ); ?></p>
	 </div>

	<div class="form-field">
	  	<label><?php _e( 'Sidebar layout', 'magzilla' ); ?></label>
	  	<ul class="fave-img-select-wrap">
	  	<?php foreach ( $sidebars_lay as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = fave_compare( $fave_meta['use_sidebar'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
	  			<input type="radio" class="fave-hidden" name="fave[use_sidebar]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['use_sidebar'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>
	   <p class="description"><?php _e( 'Choose sidebar layout', 'magzilla' ); ?></p>
	</div>

	<div class="form-field">
	  	<label><?php _e( 'Posts Excerpt', 'magzilla' ); ?></label>
	  	<select name="fave[p_excerpt]" class="widefat">
		  	<?php foreach ( $cat_excerpt as $val => $title ): ?>
		  		<option value="<?php echo $val; ?>" <?php selected( $val, $fave_meta['p_excerpt'] );?>><?php echo $title['title']; ?></option>
		  	<?php endforeach; ?>
		</select>
	   <p class="description"><?php _e( 'Enable/Disable posts excerpt', 'magzilla' ); ?></p>
	</div>

	<div class="form-field">
	  	<label><?php _e( 'Show child categories menu:', 'magzilla' ); ?></label>
	  	<select name="fave[show_child_cat]" class="widefat">
		  	<?php foreach ( $show_child_cat as $val => $title ): ?>
		  		<option value="<?php echo $val; ?>" <?php selected( $val, $fave_meta['show_child_cat'] );?>><?php echo $title['title']; ?></option>
		  	<?php endforeach; ?>
		</select>
	   <p class="description"><?php _e( 'This will show a menu at the top of the block that contains the child categories of the selected category.', 'magzilla' ); ?></p>
	</div>

	<?php if ( !empty( $sidebars ) ): ?>
	  <div class="form-field">
	  <label><?php _e( 'Standard sidebar', 'magzilla' ); ?></label>
	  	<select name="fave[sidebar]" class="widefat">
		    <option value=""><?php _e( 'None', 'magzilla' ); ?></option>
	  	<?php foreach ( $sidebars as $id => $name ): ?>
	  		<option value="<?php echo $id; ?>" <?php selected( $id, $fave_meta['sidebar'] );?>><?php echo $name; ?></option>
	  	<?php endforeach; ?>
	  </select>
	  <p class="description"><?php _e( 'Choose standard sidebar to display', 'magzilla' ); ?></p>
	  </div>
	  
	<?php endif; ?>

	<div class="form-field">
	  	<label><?php _e( 'Pagination Style', 'magzilla' ); ?></label>
	  	<ul class="fave-img-select-wrap">
	  	<?php foreach ( $pagination as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = fave_compare( $fave_meta['pagination'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
	  			<input type="radio" class="fave-hidden" name="fave[pagination]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['pagination'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>
	   <p class="description"><?php _e( 'Choose pagination style', 'magzilla' ); ?></p>
	</div>

	<div class="form-field">
		 <label for="Color"><?php _e( 'Global Color', 'magzilla'); ?></label><br/>
		 <label><input type="radio" name="fave[color_type]" value="inherit" class="fave-radio color-type" <?php checked( $fave_meta['color_type'], 'inherit' );?>> <?php _e( 'Inherit from default accent color', 'magzilla' ); ?></label>
		 <label><input type="radio" name="fave[color_type]" value="custom" class="fave-radio color-type" <?php checked( $fave_meta['color_type'], 'custom' );?>> <?php _e( 'Custom', 'magzilla' ); ?></label>
		 <div id="fave_color_wrap">
		 <p>
		   	<input name="fave[color]" type="text" class="fave_colorpicker" value="<?php echo $fave_meta['color']; ?>" data-default-color="<?php echo $fave_meta['color']; ?>"/>
		 </p>
		 <?php if ( !empty( $colors ) ) { echo $colors; } ?>
		 </div>
		 <div class="clear"></div>
		 <p class="howto"><?php _e( 'Choose color', 'magzilla' ); ?></p>
	</div>



	<?php
	}
endif;

add_action( 'category_add_form_fields', 'fave_category_add_meta_fields', 10, 2 );


/**
*   ----------------------------------------------------------------------------------------------------------------------------------------------------
*   2.0 - Edit Category meta field
*   ----------------------------------------------------------------------------------------------------------------------------------------------------
*/

if ( !function_exists( 'fave_category_edit_meta_fields' ) ) :
	function fave_category_edit_meta_fields( $term ) {
		$fave_meta = fave_get_category_meta( $term->term_id );
		$sidebars_lay = fave_get_sidebar_layouts( );
		$post_layouts = fave_get_main_layouts( true );
		$sidebars = fave_get_sidebars_list();
		$cat_excerpt = fave_get_cat_excerpt();
		$show_child_cat = fave_show_child_cat();
		$pagination = fave_get_pagination( true );
		
?>
	  

	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php _e( 'Posts main layout', 'magzilla' ); ?></label>
	  	</th>
	  	<td>
		  	<ul class="fave-img-select-wrap next-hide">
	  		<?php foreach ( $post_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = fave_compare( $fave_meta['layout'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
	  			<input type="radio" class="fave-hidden" name="fave[layout]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['layout'] );?>/> </label>
	  		</li>
	  		<?php endforeach; ?>
	   		</ul>
		   	<p class="description"><?php _e( 'Choose posts layout for this category', 'magzilla' ); ?></p>
	 	</td>
	  </tr>

	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php _e( 'Sidebar layout', 'magzilla' ); ?></label>
	  	</th>
	  	<td>
		  	<ul class="fave-img-select-wrap">
	  		<?php foreach ( $sidebars_lay as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = fave_compare( $fave_meta['use_sidebar'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
	  			<input type="radio" class="fave-hidden" name="fave[use_sidebar]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['use_sidebar'] );?>/> </label>
	  		</li>
	  		<?php endforeach; ?>
	   </ul>
		   	<p class="description"><?php _e( 'Choose sidebar layout', 'magzilla' ); ?></p>
	 	</td>
	  </tr>

	  <tr class="form-field">
	  	 <th scope="row" valign="top"><label><?php _e( 'Posts Excerpt', 'magzilla' ); ?></label></th>
	  	 <td>
	  	 <select name="fave[p_excerpt]" class="widefat">
		  	 <?php foreach ( $cat_excerpt as $val => $title ): ?>
		  		 <option value="<?php echo $val; ?>" <?php selected( $val, $fave_meta['p_excerpt'] );?>><?php echo $title['title']; ?></option>
		  	 <?php endforeach; ?>
		 </select>
	    <p class="description"><?php _e( 'Enable/Disable posts excerpt', 'magzilla' ); ?></p>
		</td>
	 </tr>

	 <tr class="form-field">
	  	<th scope="row" valign="top"><label><?php _e( 'Show child categories menu:', 'magzilla' ); ?></label></td>
	  	<td>
	  	<select name="fave[show_child_cat]" class="widefat">
		  	<?php foreach ( $show_child_cat as $val => $title ): ?>
		  		<option value="<?php echo $val; ?>" <?php selected( $val, $fave_meta['show_child_cat'] );?>><?php echo $title['title']; ?></option>
		  	<?php endforeach; ?>
		</select>
	   <p class="description"><?php _e( 'This will show a menu at the top of the block that contains the child categories of the selected category.', 'magzilla' ); ?></p>
	  </td>
	</tr>

	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php _e( 'Standard sidebar', 'magzilla' ); ?></label>
	  	</th>
	  	<td>
			<select name="fave[sidebar]" class="widefat">
			<?php foreach ( $sidebars as $id => $name ): ?>
				<option value="<?php echo $id; ?>" <?php selected( $id, $fave_meta['sidebar'] );?>><?php echo $name; ?></option>
			<?php endforeach; ?>
			</select>
			<p class="description"><?php _e( 'Choose standard sidebar to display', 'magzilla' ); ?></p>
	  	</td>
	  </tr>

	  <tr class="form-field">
	  	<th scope="row" valign="top">
	  		<label><?php _e( 'Pagination Style', 'magzilla' ); ?></label>
	  	</th>
	  	
	  	<td>
	  	<ul class="fave-img-select-wrap">
	  	<?php foreach ( $pagination as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = fave_compare( $fave_meta['pagination'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
	  			<input type="radio" class="fave-hidden" name="fave[pagination]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['pagination'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>
	   <p class="description"><?php _e( 'Choose pagination style', 'magzilla' ); ?></p>
		</td>
	</tr>

	  <?php

		$most_used = get_option( 'fave_recent_cat_colors' );

		$colors = '';

		if ( !empty( $most_used ) ) {
			$colors .= '<p>'.__( 'Recently used', 'magzilla' ).': <br/>';
			foreach ( $most_used as $color ) {
				$colors .= '<a href="#" style="width: 20px; height: 20px; background: '.$color.'; float: left; margin-right:3px; border: 1px solid #aaa;" class="fave_colorpick" data-color="'.$color.'"></a>';
			}
			$colors .= '</p>';
		}

	?>

	 <tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Color', 'magzilla' ); ?></label></th>
			<td>
				<label><input type="radio" name="fave[color_type]" value="inherit" class="fave-radio color-type" <?php checked( $fave_meta['color_type'], 'inherit' );?>> <?php _e( 'Inherit from default accent color', 'magzilla' ); ?></label> <br/>
				<label><input type="radio" name="fave[color_type]" value="custom" class="fave-radio color-type" <?php checked( $fave_meta['color_type'], 'custom' );?>> <?php _e( 'Custom', 'magzilla' ); ?></label>
			  <div id="fave_color_wrap">
			  <p>
			    	<input name="fave[color]" type="text" class="fave_colorpicker" value="<?php echo $fave_meta['color']; ?>" data-default-color="<?php echo $fave_meta['color']; ?>"/>
			  </p>
			  <?php if ( !empty( $colors ) ) { echo $colors; } ?>
				</div>
				<div class="clear"></div>
				<p class="howto"><?php _e( 'Choose color', 'magzilla' ); ?></p>
			</td>
		</tr>

	<?php
	}
endif;

add_action( 'category_edit_form_fields', 'fave_category_edit_meta_fields', 10, 2 );


if ( !function_exists( 'fave_save_category_meta_fields' ) ) :
	function fave_save_category_meta_fields( $term_id ) {

		if ( isset( $_POST['fave'] ) ) {

			$fave_meta = array();
			
			$fave_meta['layout'] = isset( $_POST['fave']['layout'] ) ? $_POST['fave']['layout'] : 0;
			$fave_meta['use_sidebar'] = isset( $_POST['fave']['use_sidebar'] ) ? $_POST['fave']['use_sidebar'] : 0;
			$fave_meta['sidebar'] = isset( $_POST['fave']['sidebar'] ) ? $_POST['fave']['sidebar'] : 0;
			$fave_meta['p_excerpt'] = isset( $_POST['fave']['p_excerpt'] ) ? $_POST['fave']['p_excerpt'] : 0;
			$fave_meta['show_child_cat'] = isset( $_POST['fave']['show_child_cat'] ) ? $_POST['fave']['show_child_cat'] : 0;
			$fave_meta['pagination'] = isset( $_POST['fave']['sidebar'] ) ? $_POST['fave']['pagination'] : 0;
			$fave_meta['color_type'] = isset( $_POST['fave']['color_type'] ) ? $_POST['fave']['color_type'] : 0;
			$fave_meta['color'] = isset( $_POST['fave']['color'] ) ? $_POST['fave']['color'] : 0;

			update_option( '_fave_category_'.$term_id, $fave_meta );

			if ( $fave_meta['color_type'] == 'custom' ) {
				fave_update_recent_cat_colors( $fave_meta['color'] );
			}

			fave_update_cat_colors( $term_id, $fave_meta['color'], $fave_meta['color_type'] );
		}

	}
endif;

add_action( 'edited_category', 'fave_save_category_meta_fields', 10, 2 );
add_action( 'create_category', 'fave_save_category_meta_fields', 10, 2 );

?>
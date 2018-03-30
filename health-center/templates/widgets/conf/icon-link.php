<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'health-center' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'custom_count' ); ?>"><?php _e( 'How many links to show?', 'health-center' ); ?></label>
	<select id="<?php echo $this->get_field_id( 'custom_count' ); ?>" class="num_shown" name="<?php echo $this->get_field_name( 'custom_count' ); ?>">
		<option <?php selected( 0, $custom_count ) ?>>0</option>
		<?php for ( $i=1; $i<=$this->max_custom; $i++ ): ?>
			<option <?php selected( $i, $custom_count ) ?>><?php echo $i ?></option>
		<?php endfor ?>
	</select>
</p>

<div class="hidden_wrap">
	<?php for ( $i=1; $i<=$this->max_custom; $i++ ):
		$custom_name = "custom_name_$i";
		$custom_url = "custom_url_$i";
		$custom_icon = "custom_icon_$i"; ?>
		<div class="hidden_el" <?php if ( $i > $custom_count ):?>style="display:none"<?php endif; ?>>

			<p>
				<label for="<?php echo $this->get_field_id( $custom_name ); ?>"><?php printf( __( 'Name:', 'health-center' ) , $i ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $custom_name ); ?>" name="<?php echo $this->get_field_name( $custom_name ); ?>" type="text" value="<?php echo $custom_names[$i]; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( $custom_url ); ?>"><?php printf( __( 'URL:', 'health-center' ) , $i ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $custom_url ); ?>" name="<?php echo $this->get_field_name( $custom_url ); ?>" type="text" value="<?php echo $custom_urls[$i]; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( $custom_icon ); ?>"><?php printf( __( 'Icon:', 'health-center' ) , $i ); ?></label>
				<a href="#" class="wpv-icon-selector-trigger vamtam-icon <?php echo esc_attr( wpv_get_icon_type( $custom_icons[$i] ) ) ?> <?php if ( empty( $custom_icons[$i] ) ) echo 'no-icon' // xss ok ?>" data-icon-name="<?php echo esc_attr( $custom_icons[$i] ) ?>" title="<?php esc_attr_e( 'Change Icon', 'health-center' ) ?>"><?php wpv_icon( $custom_icons[$i] ) ?></a>
				<input type="hidden" id="<?php echo $this->get_field_id( $custom_icon ); ?>" name="<?php echo $this->get_field_name( $custom_icon ); ?>" value="<?php echo $custom_icons[$i]; ?>" />
			</p>
		</div>

	<?php endfor; ?>
</div>
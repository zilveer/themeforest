<?php $mb->the_group_open(); ?>
		
<?php $mb->the_field( 'about' ); ?>

<h2><?php _e( 'Column 1', 'openframe' ); ?></h2>

<p>
	<label>
	<input type="checkbox" name="<?php $mb->the_name( 'show-column-one' ); ?>" value="1"<?php if ($mb->get_the_value( 'show-column-one' )) echo ' checked="checked"'; ?> />
		<?php _e( 'Show column', 'openframe' ); ?>
	</label>
</p>

<h4><?php _e( 'Select icon', 'openframe' ); ?></h4>
<p>
	<div class="radiopic">
		<ul class="radiopic-list"></ul>
		<select name="<?php $mb->the_name( 'icon-one' ); ?>" class="hidden">

			<option value="icon retroicon-prohibited"><?php _e( 'Don&rsquo;t show icon', 'openframe' ); ?></option>

			<?php foreach ( get_retro_icons() as $name => $value ) : ?>

			<option value="<?php esc_attr_e( $value ); ?>" <?php selected( $mb->get_the_value( 'icon-one' ), $value ); ?>><?php esc_attr_e( $name ); ?></option>

			<?php endforeach; ?>

		</select>
	</div>
</p>

<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'icon-link-one' ); ?>" value="<?php echo $mb->get_the_value( 'icon-link-one' ); ?>" placeholder="<?php esc_attr_e( __( 'http://', 'openframe' ) ); ?>" />
	</label>
</p>
<p class="description"><?php _e( 'Type a URL here if you want to use the icon as link.', 'openframe' ); ?></p>

<h4><?php _e( 'Column title', 'openframe' ); ?></h4>
<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'column-one-title' ); ?>" value="<?php echo $mb->get_the_value( 'column-one-title' ); ?>" placeholder="Movies" />
	</label>
</p>

<h4><?php _e( 'Column subline', 'openframe' ); ?></h4>
<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'column-one-subline' ); ?>" value="<?php echo $mb->get_the_value( 'column-one-subline' ); ?>" placeholder="What I watch" />
	</label>
</p>

<h4><?php _e( 'Column content', 'openframe' ); ?></h4>
<p>
	<label>
		<textarea rows="6" class="large-text" name="<?php $mb->the_name( 'column-one-content' ); ?>" placeholder="<?php esc_attr_e( __( 'Type here the column content', 'openframe' ) ); ?>"><?php echo $mb->get_the_value( 'column-one-content' ); ?></textarea>	
	</label>
</p>

<h2><?php _e( 'Column 2', 'openframe' ); ?></h2>

<p>
	<label>
	<input type="checkbox" name="<?php $mb->the_name( 'show-column-two' ); ?>" value="1"<?php if ($mb->get_the_value( 'show-column-two' )) echo ' checked="checked"'; ?> />
		<?php _e( 'Show column', 'openframe' ); ?>
	</label>
</p>

<h4><?php _e( 'Select icon', 'openframe' ); ?></h4>
<p>
	<div class="radiopic">
		<ul class="radiopic-list"></ul>
		<select name="<?php $mb->the_name( 'icon-two' ); ?>" class="hidden">

			<option value="icon retroicon-prohibited"><?php _e( 'Don\'t show icon', 'openframe' ); ?></option>

			<?php foreach ( get_retro_icons() as $name => $value ) : ?>

			<option value="<?php esc_attr_e( $value ); ?>" <?php selected( $mb->get_the_value( 'icon-two' ), $value ); ?>><?php esc_attr_e( $name ); ?></option>

			<?php endforeach; ?>

		</select>
	</div>
</p>

<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'icon-link-two' ); ?>" value="<?php echo $mb->get_the_value( 'icon-link-two' ); ?>" placeholder="<?php esc_attr_e( __( 'http://', 'openframe' ) ); ?>" />
	</label>
</p>
<p class="description"><?php _e( 'Type a URL here if you want to use the icon as link.', 'openframe' ); ?></p>

<h4><?php _e( 'Column title', 'openframe' ); ?></h4>
<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'column-two-title' ); ?>" value="<?php echo $mb->get_the_value( 'column-two-title' ); ?>" placeholder="Movies" />
	</label>
</p>

<h4><?php _e( 'Column subline', 'openframe' ); ?></h4>
<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'column-two-subline' ); ?>" value="<?php echo $mb->get_the_value( 'column-two-subline' ); ?>" placeholder="What I watch" />
	</label>
</p>

<h4><?php _e( 'Column content', 'openframe' ); ?></h4>
<p>
	<label>
		<textarea rows="6" class="large-text" name="<?php $mb->the_name( 'column-two-content' ); ?>" placeholder="<?php esc_attr_e( __( 'Type here the column content', 'openframe' ) ); ?>"><?php echo $mb->get_the_value( 'column-two-content' ); ?></textarea>	
	</label>
</p>

<h2><?php _e( 'Column 3', 'openframe' ); ?></h2>

<p>
	<label>
	<input type="checkbox" name="<?php $mb->the_name( 'show-column-three' ); ?>" value="1"<?php if ($mb->get_the_value( 'show-column-three' )) echo ' checked="checked"'; ?> />
		<?php _e( 'Show column', 'openframe' ); ?>
	</label>
</p>

<h4><?php _e( 'Select icon', 'openframe' ); ?></h4>
<p>
	<div class="radiopic">
		<ul class="radiopic-list"></ul>
		<select name="<?php $mb->the_name( 'icon-three' ); ?>" class="hidden">

			<option value="icon retroicon-prohibited"><?php _e( 'Don\'t show icon', 'openframe' ); ?></option>

			<?php foreach ( get_retro_icons() as $name => $value ) : ?>

			<option value="<?php esc_attr_e( $value ); ?>" <?php selected( $mb->get_the_value( 'icon-three' ), $value ); ?>><?php esc_attr_e( $name ); ?></option>

			<?php endforeach; ?>

		</select>
	</div>
</p>

<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'icon-link-three' ); ?>" value="<?php echo $mb->get_the_value( 'icon-link-three' ); ?>" placeholder="<?php esc_attr_e( __( 'http://', 'openframe' ) ); ?>" />
	</label>
</p>
<p class="description"><?php _e( 'Type a URL here if you want to use the icon as link.', 'openframe' ); ?></p>

<h4><?php _e( 'Column title', 'openframe' ); ?></h4>
<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'column-three-title' ); ?>" value="<?php echo $mb->get_the_value( 'column-three-title' ); ?>" placeholder="Movies" />
	</label>
</p>

<h4><?php _e( 'Column subline', 'openframe' ); ?></h4>
<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'column-three-subline' ); ?>" value="<?php echo $mb->get_the_value( 'column-three-subline' ); ?>" placeholder="What I watch" />
	</label>
</p>

<h4><?php _e( 'Column content', 'openframe' ); ?></h4>
<p>
	<label>
		<textarea rows="6" class="large-text" name="<?php $mb->the_name( 'column-three-content' ); ?>" placeholder="<?php esc_attr_e( __( 'Type here the column content', 'openframe' ) ); ?>"><?php echo $mb->get_the_value( 'column-three-content' ); ?></textarea>	
	</label>
</p>

<h2><?php _e( 'Column 4', 'openframe' ); ?></h2>

<p>
	<label>
	<input type="checkbox" name="<?php $mb->the_name( 'show-column-four' ); ?>" value="1"<?php if ($mb->get_the_value( 'show-column-four' )) echo ' checked="checked"'; ?> />
		<?php _e( 'Show column', 'openframe' ); ?>
	</label>
</p>

<h4><?php _e( 'Select icon', 'openframe' ); ?></h4>
<p>
	<div class="radiopic">
		<ul class="radiopic-list"></ul>
		<select name="<?php $mb->the_name( 'icon-four' ); ?>" class="hidden">

			<option value="icon retroicon-prohibited"><?php _e( 'Don\'t show icon', 'openframe' ); ?></option>

			<?php foreach ( get_retro_icons() as $name => $value ) : ?>

			<option value="<?php esc_attr_e( $value ); ?>" <?php selected( $mb->get_the_value( 'icon-four' ), $value ); ?>><?php esc_attr_e( $name ); ?></option>

			<?php endforeach; ?>

		</select>
	</div>
</p>

<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'icon-link-four' ); ?>" value="<?php echo $mb->get_the_value( 'icon-link-four' ); ?>" placeholder="<?php esc_attr_e( __( 'http://', 'openframe' ) ); ?>" />
	</label>
</p>
<p class="description"><?php _e( 'Type a URL here if you want to use the icon as link.', 'openframe' ); ?></p>

<h4><?php _e( 'Column title', 'openframe' ); ?></h4>
<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'column-four-title' ); ?>" value="<?php echo $mb->get_the_value( 'column-four-title' ); ?>" placeholder="Movies" />
	</label>
</p>

<h4><?php _e( 'Column subline', 'openframe' ); ?></h4>
<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'column-four-subline' ); ?>" value="<?php echo $mb->get_the_value( 'column-four-subline' ); ?>" placeholder="What I watch" />
	</label>
</p>

<h4><?php _e( 'Column content', 'openframe' ); ?></h4>
<p>
	<label>
		<textarea rows="6" class="large-text" name="<?php $mb->the_name( 'column-four-content' ); ?>" placeholder="<?php esc_attr_e( __( 'Type here the column content', 'openframe' ) ); ?>"><?php echo $mb->get_the_value( 'column-four-content' ); ?></textarea>	
	</label>
</p>

<h2><?php _e( 'Other Setting', 'openframe' ); ?></h2>
<p><strong><?php _e( 'Icons Background Color', 'openframe' ); ?></strong></p>
<p>
	<label>
		<input type="text" class="retro-iris-picker large-text code" name="<?php $mb->the_name( 'icons-bg-color' ); ?>" value="<?php $mb->the_value( 'icons-bg-color' ); ?>" placeholder="<?php esc_attr_e( retro_get_icons_background_color( isset( $_GET['post'] ) && intval( $_GET['post'] ) ? $_GET['post'] : null ) ); ?>" />
	</label>
</p>

<?php $mb->the_group_close(); ?>
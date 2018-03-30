<?php
if (class_exists('WP_Customize_Control')) {

	class Category_Dropdown_Control extends WP_Customize_Control {
		public function render_content() {
		?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>
			<select <?php $this->link(); ?>>
			<option value="0">Don't use featured posts</option>
				<?php
					$args = array();
					$cats = get_categories($args);
					foreach ( $cats as $cat ) {
						echo '<option value="'.$cat->term_id.'"'.selected($this->value(), $cat->term_id).'>'.$cat->name.'</option>';
					}
				?>
			</select>
		<?php
		}
	}
}
?>
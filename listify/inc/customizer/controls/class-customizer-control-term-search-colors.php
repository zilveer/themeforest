<?php
/**
 * Search for terms and associate colors with them.
 *
 * @since Listify 1.5.0
 */
class 
	Listify_Customize_Control_TermSearch_Colors
extends 
	Listify_Customize_Control_TermSearch {

	/**
	 * Set our custom arguments to class properties, and other things.
	 *
	 * @since 1.5.0
	 * @param oject $manager WP_Customize_Manager
	 * @param string $id
	 * @param array $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$this->type = 'TermColors';

		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render custom control markup.
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function render_content() {
?>
	<p>
		<label>
			<span class="customize-control-title"><?php _e( 'Add Colors', 'listify' ); ?></span>
			
			<select class="search-terms" multiple="multiple">
			</select>
		</label>
	</p>

	<p>
		<label>
			<input type="text" class="color-picker-hex" value="<?php echo esc_attr( listify_theme_color( 'color-primary' ) ); ?>" <?php $this->link(); ?> data-default-color="<?php echo esc_attr( listify_theme_color( 'color-primary' ) ); ?>" data-hide="false" />
		</label>
	</p>
		
	<p>
		<a href="#" class="js-listify-add-term button"><?php _e( 'Add Color', 'listify' ); ?></a>
	</p>

<?php
	}

	/**
	 * Custom term color JS underscore template.
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function edit_term_content_template() {
?>

<script type="text/html" id="tmpl-customize-control-edit-term-<?php echo esc_attr( $this->type ); ?>-content">
	<label>
		<span class="customize-control-title">{{{data.label}}}</span>
		<div class="customize-control-content">
			<input class="color-picker-hex" type="text" value="{{{data.value}}}" data-customize-setting-link="{{{data.key}}}" maxlength="7" />
			<a class="js-listify-remove-term button button-secondary button-small"><?php _e( 'Remove', 'listify' ); ?></a>
		</div>
	</label>
</script>

<?php
	}

}

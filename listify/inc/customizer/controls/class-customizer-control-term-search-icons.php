<?php
/**
 *
 * @since Listify 1.5.0
 */
class 
	Listify_Customize_Control_TermSearch_Icons
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
		$this->type = 'TermIcons';

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
		<span class="description"><?php echo wp_kses_post( $this->description ); ?></span>
	</p>

	<p class="search-terms-wrapper">
		<label>
			<span class="customize-control-title"><?php _e( 'Add Icons', 'listify' ); ?></span>
			
			<select class="search-terms" multiple="multiple"></select>
		</label>
	</p>

	<p>
		<select class="search-icons-<?php echo esc_attr( $this->taxonomy ); ?>"></select>
	</p>
		
	<p>
		<a href="#" class="js-listify-add-term button"><?php _e( 'Add Icon', 'listify' ); ?></a>
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
			<select class="search-icons" data-customize-setting-link="{{{data.key}}}"></select>
			<a class="js-listify-remove-term button button-secondary button-small"><?php _e( 'Remove', 'listify' ); ?></a>
		</div>
	</label>
</script>

<?php
	}

}

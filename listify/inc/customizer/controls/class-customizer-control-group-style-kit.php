<?php
/**
 * Style Kit
 *
 * @since 1.3.0
 */
class 
	Listify_Customize_Control_ControlGroup_StyleKit 
extends 
	Listify_Customize_Control_ControlGroup {

	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Output the control HTML
	 *
	 * @since 1.3.0
	 * @return void
	 */
    public function render_content() {
        $name = '_customize-radio-' . $this->id;
?>

<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

<p><span class="description"><?php _e( 'A style kit automatically updates multiple customization options to provide ready-made design options to help get you started quickly.', 'listify' ); ?></span></p>

<?php foreach ( $this->group as $group_id => $group_data ) : ?>

	<p>
		<label>
			<input <?php $this->link(); ?> name="<?php echo esc_attr( $name ); ?>" value="<?php echo $group_id; ?>" type="radio" <?php echo $this->generate_group_data( $group_data[ 'controls' ] ); ?> <?php checked( $group_id, sanitize_title( $this->value() ) ); ?> />
			<span class="label"><?php echo esc_attr( $group_data[ 'title' ] ); ?></span>
			<img src="<?php echo get_template_directory_uri() ; ?>/inc/customizer/assets/images/style-kits/<?php echo esc_attr( $group_id ); ?>.jpg" alt="" class="style-kit-preview" />
		</label>
	</p>

<?php endforeach; ?>

<style>
.style-kit-preview {
    box-shadow: 0 0 0 3px transparent, 0px 2px 5px -1px rgba(0, 0, 0, 0.08);
    border-radius: 3px;
}
#customize-control-style-kit input {
    visibility: hidden;
}
#customize-control-style-kit label {
    margin-left: 0;
}
#customize-control-style-kit .label {
    display: none;
}
#customize-control-style-kit input:checked ~ img {
    box-shadow: 0 0 0 3px #00a0d4;
}
</style>

<?php
    }

}

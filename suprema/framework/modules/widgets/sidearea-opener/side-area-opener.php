<?php

class SupremaQodefSideAreaOpener extends SupremaQodefWidget {
    public function __construct() {
        parent::__construct(
            'qodef_side_area_opener', // Base ID
            'Select Side Area Opener' // Name
        );

        $this->setParams();
    }

    protected function setParams() {

		$this->params = array(
			array(
				'name'			=> 'side_area_opener_icon_color',
				'type'			=> 'textfield',
				'title'			=> 'Icon Color',
				'description'	=> 'Define color for Side Area opener icon'
			)
		);

    }


    public function widget($args, $instance) {
		
		$sidearea_icon_styles = array();

		if ( !empty($instance['side_area_opener_icon_color']) ) {
			$sidearea_icon_styles[] = 'color: ' . $instance['side_area_opener_icon_color'];
		}
		
		$icon_size = '';
		if ( suprema_qodef_options()->getOptionValue('side_area_predefined_icon_size') ) {
			$icon_size = suprema_qodef_options()->getOptionValue('side_area_predefined_icon_size');
		}
		?>
        <a class="qodef-side-menu-button-opener <?php echo esc_attr( $icon_size ); ?>" <?php suprema_qodef_inline_style($sidearea_icon_styles) ?> href="javascript:void(0)">
            <?php echo suprema_qodef_get_side_menu_icon_html(); ?>
        </a>

    <?php }

}
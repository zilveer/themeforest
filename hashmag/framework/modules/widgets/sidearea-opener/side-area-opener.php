<?php

class HashmagMikadoSideAreaOpener extends HashmagMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkdf_side_area_opener', // Base ID
            'Mikado Side Area Opener' // Name
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
			),
            array(
                'name'			=> 'side_area_opener_label',
                'type'			=> 'textfield',
                'title'			=> 'Icon Label',
                'description'	=> 'Define color for Side Area opener icon'
            )
		);

    }


    public function widget($args, $instance) {
		
		$sidearea_icon_styles = array();
        $sidearea_close_styles = array();

		if ( !empty($instance['side_area_opener_icon_color']) ) {
			$sidearea_icon_styles[] = 'color: ' . $instance['side_area_opener_icon_color'];
            $sidearea_close_styles[] = 'border-color:' . $instance['side_area_opener_icon_color'];
		}
		
		$icon_size = '';
		if ( hashmag_mikado_options()->getOptionValue('side_area_predefined_icon_size') ) {
			$icon_size = hashmag_mikado_options()->getOptionValue('side_area_predefined_icon_size');
		}
		?>
        <div class="mkdf-side-menu-button-opener-holder" <?php hashmag_mikado_inline_style($sidearea_icon_styles) ?>>
            <a class="mkdf-side-menu-button-opener <?php echo esc_attr( $icon_size ); ?>" <?php hashmag_mikado_inline_style($sidearea_icon_styles) ?> href="javascript:void(0)">
                <?php echo hashmag_mikado_get_side_menu_icon_html(); ?>
                 <span class="mkdf-side-menu-close">
                    <span class="mkdf-close-1" <?php hashmag_mikado_inline_style($sidearea_close_styles) ?>></span>
                    <span class="mkdf-close-2" <?php hashmag_mikado_inline_style($sidearea_close_styles) ?>></span>
                 </span>
            </a>
            <?php if ( !empty($instance['side_area_opener_label']) ) {
                echo '<label>'.esc_html($instance['side_area_opener_label']).'</label>';
             } ?>
        </div>

    <?php }

}
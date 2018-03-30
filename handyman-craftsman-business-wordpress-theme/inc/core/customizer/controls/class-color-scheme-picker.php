<?php
namespace Handyman\Core;

if(!class_exists('\Handyman\Core\Color_Scheme_Picker')){

    /**
     * Class Color_Scheme_Picker
     * @package Handyman\Core
     */
    class Color_Scheme_Picker extends \WP_Customize_Control
    {
        public $type = 'tl-color-scheme-picker';

        public function enqueue()
        {
            wp_enqueue_script( 'color-scheme-picker', TL_BASE_URL_CHILD . '/inc/core/customizer/controls/customize.js', array('jquery'), false, true );

            $schemes = '';
            wp_enqueue_style( 'color-scheme-picker-css', TL_BASE_URL_CHILD . '/inc/core/customizer/controls/customize.css');

            $colors = \Handyman\Admin\Admin_Init::getColorSchemes();
            wp_localize_script('color-scheme-picker', 'CS', $colors);
        }


        /**
         *
         */
        public function render_content()
        {?>
            <div id="layers-customize-control-<?php echo esc_attr( $this->id ); ?>" class="layers-customize-control layers-customize-control-<?php echo esc_attr( str_replace( 'layers-', '', $this->type ) ); ?>">

                <div class="layers-customize-control layers-customize-control-heading ">
					<span class="customize-control-title">Presets</span>
                    <div class="description customize-control-description">Complete Color schemes. Pick one of these and RESET Side Wide Colors.</div>
                </div>

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
                <div class="layers-form-item">
                    <div class="<?php echo esc_attr( $this->id ); ?>-wrapper layers-form-item">
                        <ul>
                        <?php
                        $colors = $this->getColorSchemes();
                        foreach($colors as $label => $cs): ?>
                            <li>
                                <a style="background-color: <?php echo esc_attr($cs['s'])?>;" class="color-scheme btn <?php echo esc_attr($cs['key']) ?>" data-cs="<?php echo esc_attr($cs['key']) ?>">
                                    <span style="border-left-color: <?php echo esc_attr($cs['p'])?>; border-top-color: <?php echo esc_attr($cs['p'])?>;"><?php echo esc_html($label); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <?php if ( '' != $this->description ) : ?>
                    <div class="description customize-control-description">
                        <?php echo $this->description; ?>
                    </div>
                <?php endif; ?>

            </div>
        <?php
        }


        /**
         * @return array
         */
        public function getColorSchemes()
        {
            return array(
                'Yellow / Dark Blue'       => array('key'=> 'yb'  , 'p'=>'#f2a71f', 's'=>'#003368'),
                'Cherry / Dark Grey'       => array('key'=> 'cdg' , 'p'=>'#ff5a51', 's'=>'#444444'),
                'Light Blue / Dark Blue'   => array('key'=> 'lbdb', 'p'=>'#4fc0e8', 's'=>'#003668'),
                'Light Blue / Dark Grey'   => array('key'=> 'lbdg', 'p'=>'#4fc0e8', 's'=>'#222527'),
                'Light Red / Dark Blue'    => array('key'=> 'lrdb', 'p'=>'#d63767', 's'=>'#061d2f'),
                'Golden / Dark Grey'       => array('key'=> 'gdg' , 'p'=>'#c7a156', 's'=>'#2c3138'),
                'Green / Brown'            => array('key'=> 'gbr' , 'p'=>'#8aa177', 's'=>'#8e5043'),
                'Green / Purple'           => array('key'=> 'gp'  , 'p'=>'#b2bb49', 's'=>'#6a5f85'),
                'Dark Purple'              => array('key'=> 'dp'  , 'p'=>'#daad00', 's'=>'#252432'),
                'Light Green / Dark Grey'  => array('key'=> 'lgdg', 'p'=>'#28b491', 's'=>'#222527'),
                'Light Orange / Dark Grey' => array('key'=> 'odg', 'p'=>'#f57a20', 's'=>'#222527'),
            );
        }
    }
}

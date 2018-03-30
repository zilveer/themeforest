<?php

/**
 * Custom controls
 */


function kleo_add_customizer_custom_controls($wp_customize)
{

    class KLEO_Customize_Control_Text extends WP_Customize_Control
    {
        public $type = 'text';
        public $condition = NULL;

        public function render_content()
        {
            if ( ! empty( $this->condition ) ) {
                $condition = 'class="condition-me" data-cond-option="'  . $this->condition[0] . '"' . ' data-cond-value="' . $this->condition[1] . '"' ;
            } else {
                $condition = '';
            }

            ?>
            <label <?php echo $condition; ?>>
                <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif;
                if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
                <?php endif; ?>
                <input type="<?php echo esc_attr( $this->type ); ?>" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
        <?php
        }
    }

    class KLEO_Customize_Control_Textarea extends WP_Customize_Control
    {
        public $type = 'textarea';
        public $condition = NULL;

        public function render_content()
        {
            if ( ! empty( $this->condition ) ) {
                $condition = 'class="condition-me" data-cond-option="'  . $this->condition[0] . '"' . ' data-cond-value="' . $this->condition[1] . '"' ;
            } else {
                $condition = '';
            }

            ?>
            <label <?php echo $condition; ?>>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea <?php $this->link(); ?> rows="10"
                                                  style="width: 98%;"><?php echo esc_textarea($this->value()); ?></textarea>
            </label>
        <?php
        }
    }

    class KLEO_Customize_Control_Slider extends WP_Customize_Control
    {
        public $type = 'slider';
        public $condition = NULL;

        public function enqueue()
        {
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-slider');
        }

        public function render_content()
        {
            if ( ! empty( $this->condition ) ) {
                $condition = 'class="condition-me" data-cond-option="'  . $this->condition[0] . '"' . ' data-cond-value="' . $this->condition[1] . '"' ;
            } else {
                $condition = '';
            }

            ?>
            <label <?php echo $condition; ?>>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                    <?php if ( ! empty( $this->description ) ) : ?>
                        <span class="description customize-control-description"><?php echo wp_kses_post($this->description); ?></span>
                    <?php endif; ?>
                </span>
                <input type="text" id="input_<?php echo esc_attr($this->id); ?>"
                       value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?>/>
            </label>
            <div id="slider_<?php echo esc_attr($this->id); ?>" class="kleo-slider"></div>
            <script>
                jQuery(document).ready(function ($) {
                    $("#slider_<?php echo esc_attr($this->id); ?>").slider({
                        value: <?php echo esc_attr($this->value()); ?>,
                        min: <?php echo esc_attr($this->choices['min']); ?>,
                        max: <?php echo esc_attr($this->choices['max']); ?>,
                        step: <?php echo esc_attr($this->choices['step']); ?>,
                        slide: function (event, ui) {
                            $("#input_<?php echo esc_attr($this->id); ?>").val(ui.value).keyup();
                        },
                        change: function (event, ui) {
                            $("#input_<?php echo esc_attr($this->id); ?>").change();
                        }
                    });
                    $("#input_<?php echo esc_attr($this->id); ?>").val($("#slider_<?php echo esc_attr($this->id); ?>").slider("value"));
                });
            </script>
        <?php }
    }

    class KLEO_Customize_Control_Switch extends WP_Customize_Control
    {

        public $type = 'switch';
        public $condition = NULL;

        /**
         * Render the control's content.
         */
        protected function render_content()
        {
            if ( ! empty( $this->condition ) ) {
                $condition = 'class="condition-me" data-cond-option="'  . $this->condition[0] . '"' . ' data-cond-value="' . $this->condition[1] . '"' ;
            } else {
                $condition = '';
            }

            ?>
            <label <?php echo $condition; ?>>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                    <?php if (!empty($this->description)) : ?>
                        <span class="description customize-control-description"><?php echo wp_kses_post($this->description); ?></span>
                    <?php endif; ?>
                </span>
                <div class="switch-info">
                    <input style="display: none;" type="checkbox" value="" <?php $this->link(); checked($this->value()); ?> />
                </div>
                <?php $classes = esc_attr($this->value()) ? ' On' : ' Off'; ?>
                <div class="Switch <?php echo esc_attr($classes); ?>">
                    <div class="Toggle"></div>
                    <span class="On">ON</span>
                    <span class="Off">OFF</span>
                </div>
            </label>
        <?php
        }
    }

    class KLEO_Customize_Control_Radio_Image extends WP_Customize_Control {

        public $type = 'radio-image';
        public $condition = NULL;

        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-button' );
        }

        public function render_content() {

            if ( empty( $this->choices ) ) {
                return;
            }

            if ( ! empty( $this->condition ) ) {
                $condition = 'class="condition-me" data-cond-option="'  . $this->condition[0] . '"' . ' data-cond-value="' . $this->condition[1] . '"' ;
            } else {
                $condition = '';
            }

            $name = '_customize-radio-' . $this->id;

            ?>
            <label <?php echo $condition; ?>>
                <span class="customize-control-title">
                    <?php echo esc_html( $this->label ); ?>
                    <?php if ( ! empty( $this->description ) ) : ?>
                        <span class="description customize-control-description"><?php echo wp_kses_post($this->description); ?></span>
                    <?php endif; ?>
                </span>
            </label>

            <div id="input_<?php echo esc_attr($this->id); ?>" class="image">
                <?php foreach ( $this->choices as $value => $label ) : ?>
				<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $this->id . $value ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
					<label for="<?php echo esc_attr($this->id . $value); ?>">
						<img title="<?php echo esc_attr( $value ); ?>" alt="<?php echo esc_attr( $value ); ?>" src="<?php echo esc_html( $label ); ?>">
					</label>
				</input>
			<?php endforeach; ?>
            </div>
            <script>jQuery(document).ready(function($) { $( '[id="input_<?php echo esc_attr($this->id); ?>"]' ).buttonset(); });</script>
        <?php
        }

    }


    /**
     * A class to create a dropdown for all google fonts
     */
    class KLEO_Customize_Google_Font_Select extends WP_Customize_Control
    {
        private $fonts = false;
        public $type = 'gfont';
        public function __construct($manager, $id, $args = array(), $options = array())
        {
            $this->fonts = $this->get_fonts('all');
            parent::__construct( $manager, $id, $args );
        }
        /**
         * Render the content of the category dropdown
         *
         * @return HTML
         */
        public function render_content()
        {
            if( ! empty($this->fonts))
            {
                ?>
                <label>
                    <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                    <select class="google-font-select" <?php $this->link(); ?>>
                        <option value=""><?php esc_html_e("Default", "buddyapp");?></option>
                        <?php
                        $standard_fonts = kleo_get_standard_fonts();
                        echo '<optgroup label="'. esc_html__('Standard Fonts','buddyapp') .'">';
                        foreach ( $standard_fonts as $v )
                        {
                            printf('<option value="%s" %s>%s</option>', $v, selected($this->value(), $v, false), $v);
                        }
                        echo '</optgroup>';
                        echo '<optgroup label="'. esc_html__('Google Fonts','buddyapp') .'">';

                        foreach ( $this->fonts as $k => $v )
                        {
                            printf('<option data-id="%d" value="%s" %s>%s</option>', $k, $v->family, selected($this->value(), $v->family, false), $v->family);
                        }
                        echo '</optgroup>';
                        ?>
                    </select>

                </label>
                <script>
                    if (typeof variable === 'undefined') {
                        var gFonts = <?php echo json_encode(kleo_get_google_fonts()); ?>;
                    }
                    jQuery(".google-font-select").on('change', function() {

                        var attr = jQuery(this).find('option:selected').attr('data-id');
                        if (typeof attr !== typeof undefined && attr !== false) {

                            //console.log(gFonts.items[jQuery(this).find('option:selected').data('id')]);
                        }
                    });

                </script>
                <?php
            }
        }
        /**
         * Get the google fonts from the API or in the cache
         *
         * @param  integer $amount
         *
         * @return String
         */
        public function get_fonts( $amount = 30 )
        {
            $content = kleo_get_google_fonts();

            if( $amount == 'all' )
            {
                return $content->items;
            } else {
                return array_slice($content->items, 0, $amount);
            }
        }
    }


    class KLEO_Customize_MultiSelect extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         */
        public $type = 'multiple-select';
        public $condition = NULL;

        /**
         * Displays the multiple select on the customize screen.
         *
         */
        public function render_content() {
            if ( empty( $this->choices ) ) {
                return;
            }

            if ( ! empty( $this->condition ) ) {
                $condition = 'class="condition-me" data-cond-option="'  . $this->condition[0] . '"' . ' data-cond-value="' . $this->condition[1] . '"' ;
            } else {
                $condition = '';
            }

            ?>
            <label <?php echo $condition; ?>>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select <?php $this->link(); ?> multiple="multiple">
                    <?php
                    foreach ( $this->choices as $value => $label ) {
                        $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                        echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
                    }
                    ?>
                </select>
            </label>
            <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo wp_kses_data($this->description); ?></span>
            <?php endif; ?>
        <?php
        }
    }

    class KLEO_Customize_Select extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         */
        public $type = 'select';
        public $condition = NULL;

        /**
         * Displays the multiple select on the customize screen.
         *
         */
        public function render_content() {
            if ( empty( $this->choices ) ) {
                return;
            }

            if ( ! empty( $this->condition ) ) {
                $condition = 'class="condition-me" data-cond-option="'  . $this->condition[0] . '"' . ' data-cond-value="' . $this->condition[1] . '"' ;
            } else {
                $condition = '';
            }

            ?>
            <label <?php echo $condition; ?>>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label )
                        echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
                    ?>
                </select>
            </label>
            <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo wp_kses_data($this->description); ?></span>
            <?php endif; ?>
            <?php
        }
    }

}

add_action( 'customize_register', 'kleo_add_customizer_custom_controls' );

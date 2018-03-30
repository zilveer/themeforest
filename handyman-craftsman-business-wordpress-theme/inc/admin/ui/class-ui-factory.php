<?php
namespace Handyman\Admin\Ui;


/**
 * Simple class for rendering
 *
 * Class Ui_Factory
 * @package Handyman\Admin\Ui
 *
 * @desc
 *
 */
class Ui_Factory
{

    /**
     * @var
     */
    protected static $_instance;


    /**
     * @var string
     */
    public $control_wrapper = '<div class="tl-control %s">%s</div>';


    private function __construct(){}
    private function __clone(){}


    /**
     * @return Ui_Factory
     */
    public static function single()
    {
        if (self::$_instance === null) {
            self::$_instance = new Ui_Factory();
        }

        return self::$_instance;
    }


    /**
     * Output HMTL code
     *
     * @param array $params
     * @return string
     *
     * @desc input params
     *
     *  [ 'name', 'id', 'value', 'default', 'choices', 'title', 'desc',  ]
     */
    public function render($params, $wrap = false, $echo = false)
    {
        $control = '';
        $defaults = array(
            'name' => null,
            'id' => null,
            'value' => null,
            'default' => null,
            'choices' => array(),
            'label' => null,
            'desc' => null,
            'type' => null,
            'attrs' => array()
        );
        $params = wp_parse_args($params, $defaults);
        extract($params);

        if (!$type) return '';

        $attrs_str = '';
        foreach ((array)$attrs as $k => $v) {
            $attrs_str .= $k . '="' . esc_attr($v) . '" ';
        }

        switch ($type) {

            case 'title':
                $control .= '<h4 id="' . esc_attr($id) . '" ' . $attrs_str . '>' . esc_html($label) . '</h4>';
                break;

            case 'heading':

                $control .= '<h3 id="' . esc_attr($id) . '" ' . $attrs_str . '>' . esc_html($label) . '</h3>';
                $control .= $this->_description($desc);
                break;

            case 'text':

                $control .= $this->_label($label, $id);
                $control .= '<input type="text" id="' . esc_attr($id) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" ' . $attrs_str . ' />';
                $control .= $this->_description($desc);
                break;

            case 'hidden':

                $control .= '<input name="' . esc_attr($name) . '" id="' . esc_attr($id) . '" value="' . esc_attr($value) . '" ' . $attrs_str . ' />';
                break;

            case 'textarea':

                $control .= $this->_label($label, $id);
                $control .= '<textarea id="' . esc_attr($id) . '" name="' . esc_attr($name) . '" ' . $attrs_str . '>' . esc_textarea($value) . '</textarea>';
                $control .= $this->_description($desc);
                break;

            case 'select':
            case 'multiselect':
            case 'selectSidebar':

                if ($label)
                    $control .= '<label for="' . esc_attr($id) . '" class="customize-control-title">' . esc_html($label) . '</label>';
                $is_multi = isset($attrs['multiple']);
                $value = is_array($value) ? $value : (array)$value;
                $control .= '<select name="' . esc_attr($name) . ($is_multi ? '[]' : '') . '" id="' . esc_attr($id) . '" ' . $attrs_str . '>';
                foreach ($choices as $k => $v) {
                    $checked = (in_array($k, $value)) ? 'selected="selected"' : '';
                    $control .= '<option value="' . esc_attr($k) . '" ' . $checked . ' >' . esc_html($v) . '</option>';
                }
                $control .= '</select>';
                $control .= $this->_description($desc);
                break;

            case 'radio':

                $this->_label($label);

                foreach ($choices as $k => $opt) {
                    $idk = $name . '_' . $k . '_id';
                    $checked = ($value == $k) ? 'checked="checked"' : '';

                    $control .= '<div class="row">';
                    $control .= '<div class="switch">
						<input id="' . esc_attr($idk) . '" type="radio" name="' . esc_attr($name) . '" value="' . esc_attr($k) . '" ' . $checked . ' ' . $attrs_str . ' />
						<label for="' . esc_attr($idk) . '" class="radio circle">
							<span class="big">
								<span class="small"></span>
							</span>
						</label>
					 </div>';
                    $control .= '<div class="question"><b>' . esc_html($opt) . '</b></div>';
                    $control .= '</div><!-- .row -->';
                }
                $control .= $this->_description($desc);
                break;

            case 'checkbox':

                $cheched = ($value == 1) ? 'checked="checked"' : '';

                $this->_label($label);

                $control .= '<div class="switch">';
                $control .= '<!-- first hidden input forces this item to be submitted when it is not checked -->
				 <input type="hidden" name="' . esc_attr($name) . '" value="0" />
				 <input type="checkbox" id="' . esc_attr($id) . '" name="' . esc_attr($name) . '" value="1" ' . $cheched . ' ' . $attrs_str . ' />
				 <label for="' . $id . '">'.$label.'</label>';
                $control .= '</div><!-- .switch -->';

                $control .= $this->_description($desc);
                break;

            case 'image':

                $control .= $this->_label($label);

                $control .= '<div></div>';
                $control .= '<input id="' . esc_attr($id) . '" type="hidden" name="'.esc_attr($name).'" value="'.(isset($value) ? esc_attr($value):'').'" />';
                $control .= '<input id="meta-image-button" type="button" class="button"  value="Choose or Upload an Header Image" />';

                if($value){
                    $image = wp_get_attachment_image_src($value, 'layers-landscape-medium');
                    $control .= '<div class="image" style="background-image: url(' . esc_url($image[0]) . ');">
                                    <a data-attachment-id="' . esc_attr($value) . '" class="remove"><i class="icon-ti-close"></i></a>
                                 </div>';
                }
                break;
            case 'datepicker':
                $control .= '<div class="datepicker"></div>';
                break;
            case 'colorpicker':

                $control .= $this->_label($label);
                $control .= '<input class="tl-color-picker" name="'.esc_attr($name).'" id="'.esc_attr($id).'" value="'.esc_attr($value).'" '.$attrs_str.' />';
                $control .= $this->_description($desc);
                break;
        }

        $control_class = $type .'_control';

        if($wrap){
            $control = sprintf($this->control_wrapper, $control_class, $control);
        }

        if ($echo)
            echo $control;
        else
            return $control;
    }


    /**
     * Render list of controls and wrap each control with control wrapper
     *
     * @param $fields
     * @return string
     */
    public function renderGroup($fields)
    {
        $controls = '';
        foreach($fields as $f){
            $controls .= sprintf($this->control_wrapper, '', $this->render($f));
        }

        return $controls;
    }


    /**
     * Set Wrapper format
     *
     * @param $wrapper
     */
    public function setControlWrapper($wrapper)
    {
        $this->control_wrapper = $wrapper;
    }


    /**
     * Render field label
     *
     * @param $label
     * @return string
     */
    protected function _label($label, $id = '')
    {
        return ($label != '') ? '<label for="' . esc_attr($id) . '">' . esc_html($label) . '</label>' : '';
    }


    /**
     * Render field description
     *
     * @param $desc
     * @return string
     */
    protected function _description($desc)
    {
        return ($desc != '') ? '<span class="howto">' . esc_html($desc) . '</span>' : '';
    }
}

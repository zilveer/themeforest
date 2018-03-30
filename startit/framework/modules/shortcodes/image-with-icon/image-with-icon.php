<?php
namespace QodeStartit\Modules\Shortcodes\ImageWithIcon;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ImageWithIcon
 * @package QodeStartit\Modules\Shortcodes\ImageWithIcon
 */
class ImageWithIcon implements ShortcodeInterface {

    /**
     * @var string
     */
    private $base;

    /**
     *
     */
    public function __construct() {
        $this->base = 'qodef_image_with_icon';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     *
     */

    public function vcMap()
    {
        vc_map(array(
                'name' => 'Image With Icon',
                'base' => $this->base,
                'icon' => 'icon-wpb-image-with-icon extended-custom-icon',
                'category' => 'by SELECT',
                'allowed_container_element' => 'vc_row',
                'params' => array_merge(
                    qode_startit_icon_collections()->getVCParamsArray(),
                    array(
                        array(
                            'type'       => 'attach_image',
                            'heading'    => 'Image',
                            'param_name' => 'image'
                        ),
                    )
                )
            )
        );
    }

    /**
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'image' => ''
        );

        $default_atts = array_merge($default_atts, qode_startit_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        $params['icon_parameters'] = $this->getIconParameters($params);
        $params['image'] = $this->getImageSrc($params);

        $html = qode_startit_get_shortcode_module_template_part('templates/image-with-icon-template', 'image-with-icon', '', $params);

        return $html;
    }

    private function getIconParameters($params) {
        $iconPackName = qode_startit_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        $params_array['icon_pack']   = $params['icon_pack'];
        $params_array['type']   = 'circle';
        $params_array[$iconPackName] = $params[$iconPackName];

        return $params_array;
    }

    private function getImageSrc($params) {

        if (is_numeric($params['image'])) {
            $image_src = wp_get_attachment_url($params['image']);
        } else {
            $image_src = $params['image'];
        }

        return $image_src;

    }

}
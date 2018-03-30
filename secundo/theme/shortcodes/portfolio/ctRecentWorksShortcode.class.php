<?php

/**
 * Recent Works
 */
class ctRecentWorksShortcode extends ctShortcodeQueryable
{

    /**
     * Returns name
     * @return string|void
     */
    public function getName()
    {
        return 'Recent Works';
    }

    /**
     * Shortcode name
     * @return string
     */
    public function getShortcodeName()
    {
        return 'recent_works';
    }

    /**
     * Handles shortcode
     * @param $atts
     * @param null $content
     * @return string
     */

    public function handle($atts, $content = null)
    {
        $attributes = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);
        extract($attributes);

        $recentposts = $this->getCollection($attributes, array('post_type' => 'portfolio'));

        $html = '<div class="row-fluid">';
        $counter = 0;
        foreach ($recentposts as $p) {
            $counter++;
            $imgsrc = ct_get_feature_image_src($p->ID, 'thumbnail');
            $categories = ct_get_categories_string($p->ID, ',', 'portfolio_category');

            $html .= ('[half_column]' . $this->embedShortcode('work_box', array(
                    'title' => $p->post_title,
                    'summary' => $p->post_excerpt,
                    'link' => get_permalink($p),
                    'imgsrc' => $imgsrc,
                    'categories' => $categories,
                )) . '[/half_column]');
            if ($counter == 2) {
                $html .= '</div><div class="row-fluid">';
                $counter = 0;
            }
        }
        $html .= '</div>';

        return do_shortcode($html);

    }

    /**
     * Shortcode type
     * @return string
     */
    public function getShortcodeType()
    {
        return self::TYPE_SHORTCODE_SELF_CLOSING;
    }

    /**
     * Returns config
     * @return null
     */
    public function getAttributes()
    {
        $atts = $this->getAttributesWithQuery(array(
            'limit' => array('label' => __('limit', 'ct_theme'), 'default' => 4, 'type' => 'input'),
        ));

        if (isset($atts['cat'])) {
            unset($atts['cat']);
        }
        return $atts;
    }
}

new ctRecentWorksShortcode();
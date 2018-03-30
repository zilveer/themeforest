<?php

/**
 * Widget that adds additional styling and has free content
 *
 * Class LiberoHolder
 */
class LiberoHolder extends LiberoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_holder', // Base ID
            'Mikado Widget Holder' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
			array(
				'name'			=> 'icon_pack',
				'type'			=> 'dropdown',
				'title'			=> 'Choose Icon Pack',
				'options'		=> libero_mikado_icon_collections()->getIconCollections()
			),
			array(
				'name'        => 'icon',
				'type'        => 'textfield',
				'title'       => 'Icon',
				'description' => 'Enter icon class'
			),
			array(
				'name'        => 'title',
				'type'        => 'textfield',
				'title'       => 'Title'
			),
			array(
				'name'        => 'subtitle',
				'type'        => 'textfield',
				'title'       => 'Subtitle'
			),
			array(
				'name'        => 'link',
				'type'        => 'textfield',
				'title'       => 'Link'
			),
			array(
				'name'        => 'link_text',
				'type'        => 'textfield',
				'title'       => 'Link Text'
			),
			array(
				'name'			=> 'content_background',
				'type'			=> 'textfield',
				'title'			=> 'Content Background Color'
			),
			array(
				'name'			=> 'content_padding',
				'type'			=> 'textfield',
				'title'			=> 'Content Padding (in form 0px 1px 0px 0px)'
			),
			array(
				'name'        => 'content',
				'type'        => 'textarea',
				'title'       => 'Content'
			)
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        global $libero_mikado_options, $libero_mikado_IconCollections;
        extract($instance);

        $show_icon = false;
        $holder_classes = '';
        $content_style = '';
        $icon_params = array();

        $icon_params['icon_pack'] = $icon_pack;
		$icon_pack_name = libero_mikado_icon_collections()->getIconCollectionParamNameByKey($icon_pack);
		$icon_params[$icon_pack_name] = $icon;
		$icon_params['type'] = 'circle';
		if ($icon !== ''){
			$show_icon = true;
			$holder_classes = 'mkd-holder-has-icon';
		}

		if ($content_background !== ''){
			$content_style .= 'background-color:'.$content_background.';';
		}

		if ($content_padding !== ''){
			$content_style .= 'padding: '.$content_padding.';';
		}

        ?>

		<div class="widget mkd-holder-widget <?php echo esc_attr($holder_classes);?>">
			<?php if ($show_icon){ ?>
			<div class="mkd-holder-icon">
				<?php
					echo libero_mikado_execute_shortcode('mkd_icon',$icon_params);
				?>
			</div>
			<?php } ?>
			<div class="mkd-holder-content-outer">
				<div class="mkd-holder-titles">
					<?php if ($title !== ''){ ?>
					<h4><?php echo esc_html($title) ?></h4>
					<?php } ?>
					<?php if ($subtitle !== ''){ ?>
					<h5><?php echo esc_html($subtitle) ?></h5>
					<?php } ?>
				</div>
				<div class="mkd-holder-content" <?php libero_mikado_inline_style($content_style);?>>
					<?php echo do_shortcode($content); ?>
				</div>
				<?php if ($link !== ''){ ?>
					<div class="mkd-holder-link">
						<a href="<?php echo esc_url($link); ?>" target="_blank">
							<span> <?php echo esc_html($link_text); ?> </span>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
    <?php }
}
<?php global $smof_data; ?>
<div class='cs_metabox'>
	<div id="cs-tab-blog" class='categorydiv'>
	<ul class='category-tabs'>
	   <li class='cs-tab'><a href="#tabs-price"><i class="dashicons dashicons dashicons-cart"></i> <?php echo esc_html__('PRICE','wp_nuvo'); ?></a></li>
	   <li class='cs-tab'><a href="#tabs-field"><i class="dashicons dashicons dashicons-awards"></i> <?php echo esc_html__('TAGS','wp_nuvo'); ?></a></li>
 	</ul>
 	<div class='cs-tabs-panel'>
	 	<div id="tabs-price">
		<?php
    		cs_options(array(
        		'id' => 'menu_price',
        		'label' => esc_html__('Price','wp_nuvo'),
        		'type' => 'text'
		    ));
    		cs_options(array(
        		'id' => 'price_unit',
        		'label' => esc_html__('Unit ($)','wp_nuvo'),
        		'value' => $smof_data['restaurant_menu_price'],
        		'type' => 'text'
    		));
    		cs_options(array(
        		'id' => 'menu_special',
        		'label' => esc_html__('CHEFS SPECIAL','wp_nuvo'),
        		'options' => array('no' => 'No', 'yes' => 'Yes'),
        		'type' => 'select'
    		));
		?>
		</div>
		<div id="tabs-field">
		<?php
		cs_options(array(
    		'id' => 'menu_custom_field_1',
    		'label' => esc_html__('Text 1', 'wp_nuvo'),
    		'type' => 'text'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_icon_1',
    		'label' => esc_html__('Icon 1', 'wp_nuvo'),
    		'type' => 'icon'
		 ));
		cs_options(array(
    		'id' => 'menu_custom_field_desc_1',
    		'label' => esc_html__('Desc Field 1', 'wp_nuvo'),
    		'type' => 'text'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_2',
    		'label' => esc_html__('Text 2', 'wp_nuvo'),
    		'type' => 'text'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_icon_2',
    		'label' => esc_html__('Icon 2', 'wp_nuvo'),
    		'type' => 'icon'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_desc_2',
    		'label' => esc_html__('Desc Field 2', 'wp_nuvo'),
    		'type' => 'text'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_3',
    		'label' => esc_html__('Text 3', 'wp_nuvo'),
    		'type' => 'text'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_icon_3',
    		'label' => esc_html__('Icon 3', 'wp_nuvo'),
    		'type' => 'icon'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_desc_3',
    		'label' => esc_html__('Desc Field 3', 'wp_nuvo'),
    		'type' => 'text'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_4',
    		'label' => esc_html__('Text 4', 'wp_nuvo'),
    		'type' => 'text'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_icon_4',
    		'label' => esc_html__('Icon 4', 'wp_nuvo'),
    		'type' => 'icon'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_desc_4',
    		'label' => esc_html__('Desc Field 4', 'wp_nuvo'),
    		'type' => 'text'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_5',
    		'label' => esc_html__('Text 5', 'wp_nuvo'),
    		'type' => 'text'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_icon_5',
    		'label' => esc_html__('Icon 5', 'wp_nuvo'),
    		'type' => 'icon'
		));
		cs_options(array(
    		'id' => 'menu_custom_field_desc_5',
    		'label' => esc_html__('Desc Field 5', 'wp_nuvo'),
    		'type' => 'text'
		));
		?>
		</div>
	</div>
	</div>
</div>
<div id="field_icon" style="display: none;"></div>
<?php
TMM_OptionsHelper::draw_theme_option(array(
    'name' => 'watermark_on_image',
    'type' => 'checkbox',
    'default_value' => 1,
    'title' => __('Enable watermark on image', 'cardealer'),
    'description' => '',
    'css_class' => '',
        ), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider"/>

<?php
TMM_OptionsHelper::draw_theme_option(array(
    'id' => 'watermark_image',
    'name' => 'watermark_image',
    'type' => 'upload',
    'default_value' => '',
    'title' => __('Watermark image', 'cardealer'),
    'description' => __("Watermark image (png only)", 'cardealer'),
    'css_class' => '',
        ), TMM_APP_CARDEALER_PREFIX);
?>

<?php
$watermark_image = TMM::get_option('watermark_image', TMM_APP_CARDEALER_PREFIX);
if (empty($watermark_image)) {
    $watermark_image = TMM_Ext_Car_Dealer::get_application_uri() . '/images/default_watermark.png';
}
?>
<img class="watermark_image" data-default="<?php echo $watermark_image; ?>" src="<?php echo $watermark_image ?>" alt="<?php _e('Watermark image', 'cardealer') ?>" style="width: 100%;" /><br/>

<hr class="sep-divider"/>

<?php
TMM_OptionsHelper::draw_theme_option(array(
    'name' => 'alpha_level',
    'type' => 'slider',
    'title' => '',
    'description' => __('Watermark Opacity', 'cardealer'),
    'default_value' => 70,
    'max' => 100,
    'min' => 1,
    'css_class' => '',
), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider"/>

<?php
TMM_OptionsHelper::draw_theme_option(array(
    'name' => 'watermark_size_percent',
    'type' => 'slider',
	'title' => '',
    'description' => __('Watermark size in %', 'cardealer'),
    'default_value' => 25,
    'max' => 100,
    'min' => 1,
    'css_class' => '',
        ), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider"/>

<?php
TMM_OptionsHelper::draw_theme_option(array(
    'name' => 'watermark_position',
    'type' => 'select',
	'title' => '',
    'default_value' => 'left_top',
    'values' => TMM_Cardealer_Watermark::$watermark_positions,
    'description' => __('Watermark position', 'cardealer'),
    'css_class' => '',
    'hide_item_html' => 1
        ), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider"/>

<a href="#" class="cardealer_update_sample admin-button button-gray button-medium"
   title=""><?php _e('Update sample', 'cardealer'); ?></a>
<br/>

<div id="watermark_sample_preview">
    <?php
    if (!file_exists(TMM_Ext_PostType_Car::get_image_upload_folder() . '/sample.jpg')) {
        copy(TMM_Ext_Car_Dealer::get_application_path() . '/images/sample.jpg', TMM_Ext_PostType_Car::get_image_upload_folder() . '/sample.jpg');
    }
    ?>
    <?php if (file_exists(TMM_Ext_PostType_Car::get_image_upload_folder() . '/sample.jpg')): ?>
        <img src="<?php echo TMM_Ext_PostType_Car::get_image_upload_folder_uri() ?>/sample.jpg"
             alt="<?php _e("Sample", 'cardealer') ?>"/>
         <?php endif; ?>
</div>



<input type="hidden" id="slider_design_type" name="slider_design_type" />
<?php
foreach ($slider_types as $slider_type) {
    ?>
    <div value="<?php echo $slider_type['design']; ?>" class="selectable_option slider_image_preview" preview="<?php echo tf_config_extimage($ext_name . '/designs/' . $slider_type['design'], 'preview.jpg') ?>">
        <div class="over_thumb"></div>
        <img src="<?php echo tf_config_extimage($ext_name . '/designs/' . $slider_type['design'], 'preview_small.jpg') ?>" alt="<?php echo $slider_type['name']; ?>" border="0" />
    </div>
    <?php
}
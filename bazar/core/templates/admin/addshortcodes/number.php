<div class="fieldset number">
    <label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php echo $var[1]['title']; ?></label>
    <input type="text" id="<?php echo $var[0].'-'.$var[2]; ?>" class="number" name="shortcode-<?php echo $var[0]; ?>" value="<?php echo $var[1]['std']; ?>" data-std="<?php if ($var[1]['std'] != '') echo $var[1]['std']; else echo 1; ?>" data-min="<?php echo ( isset($var[1]['min']) ) ? $var[1]['min'] : '-1' ?>" data-max="<?php echo ( isset($var[1]['max']) ) ? $var[1]['max'] : '1000' ?>" />
    <?php if (isset($var[1]['description']) && $var[1]['description'] != '') : ?>
        <span class="description"><?php echo $var[1]['description']; ?></span>
    <?php endif; ?>
</div>
<?php
$tf_post_types = tf_get_post_types();
foreach ($tf_post_types as $key => $name) {
    $taxonomy = tf_custom_post_category($key);
    ?>
    <select placeholders="<?php echo get_placeholders_number($key); ?>" class="sidebars_subtype sidebar_box_<?php echo $key; ?>">
        <option value=""><?php _e('Select subtype', 'tfuse') ?></option>
        <option value="default_<?php echo $key; ?>"><?php _e('Default settings for', 'tfuse'); ?> <?php echo $key; ?></option>
        <?php
        if ($taxonomy) {
            ?>
            <option value="by_category_<?php echo $key; ?>"><?php _e('From specific', 'tfuse'); ?> <?php echo $taxonomy; ?></option>
        <?php } ?>
        <option value="by_id_<?php echo $key; ?>"><?php _e('Choose by name', 'tfuse'); ?></option>
    </select>
<?php } ?>
<select placeholders="<?php echo get_placeholders_number('post'); ?>" class="sidebars_subtype sidebar_box_post">
    <option value="">
        <?php _e('Select subtype', 'tfuse'); ?>
    </option>
    <option value="default_post">
        <?php _e('Defaults settings for post', 'tfuse'); ?>
    </option>
    <option value="by_category_post">
        <?php _e('From specific category', 'tfuse'); ?>
    </option>
    <option value="by_id_post">
        <?php _e('Choose by name', 'tfuse'); ?>
    </option>
</select>

<select placeholders="<?php echo get_placeholders_number('page'); ?>" class="sidebars_subtype sidebar_box_page">
    <option value="">
        <?php _e('Select subtype', 'tfuse'); ?>
    </option>
    <option value="default_page">
        <?php _e('Defaults settings for page', 'tfuse'); ?>
    </option>
    <!--<option value="by_template_page">
        From specific template
    </option>-->
    <option value="by_id_page">
        <?php _e('Choose by name', 'tfuse') ?>
    </option>
</select>

<select placeholders="<?php echo get_placeholders_number('category'); ?>" class="sidebars_subtype sidebar_box_category">
    <option value="">
        <?php _e('Select subtype', 'tfuse'); ?>
    </option>
    <option value="default_category">
        <?php _e('Defaults settings for category', 'tfuse'); ?>
    </option>
    <option value="by_id_category">
        <?php _e('Choose by name', 'tfuse'); ?>
    </option>
</select>

<?php
$tf_taxonomies = tf_get_taxonomies();
foreach ($tf_taxonomies as $key => $name) {
    ?>
    <select placeholders="<?php echo get_placeholders_number($key); ?>" class="sidebars_subtype sidebar_box_<?php echo $key; ?>">
        <option value="">
            <?php _e('Select subtype', 'tfuse'); ?>
        </option>
        <option value="default_<?php echo $key; ?>">
            <?php _e('Defaults settings for', 'tfuse'); ?> <?php echo $key; ?>
        </option>
        <option value="by_id_<?php echo $key; ?>">
            <?php _e('Choose by name', 'tfuse'); ?>
        </option>
    </select>
<?php } ?>

<select placeholders="<?php echo get_placeholders_number('is_default'); ?>" class="sidebars_subtype sidebar_box_is_default">
    <option value="">
        <?php _e('Select subtype', 'tfuse'); ?>
    </option>
    <option value="default_is_default">
        <?php _e('Global default settings', 'tfuse'); ?>
    </option>
</select>

<select placeholders="<?php echo get_placeholders_number('is_archive'); ?>" class="sidebars_subtype sidebar_box_is_archive">
    <option value="">
        <?php _e('Select subtype', 'tfuse'); ?>
    </option>
    <option value="default_is_archive">
        <?php _e('Default settings for archive pages', 'tfuse'); ?>
    </option>
</select>

<select placeholders="<?php echo get_placeholders_number('is_front_page'); ?>" class="sidebars_subtype sidebar_box_is_front_page">
    <option value="">
        <?php _e('Select subtype', 'tfuse'); ?>
    </option>
    <option value="default_is_front_page">
        <?php _e('Default settings for front page', 'tfuse'); ?>
    </option>
</select>

<select placeholders="<?php echo get_placeholders_number('is_search'); ?>" class="sidebars_subtype sidebar_box_is_search">
    <option value="">
        <?php _e('Select subtype', 'tfuse'); ?>
    </option>
    <option value="default_is_search">
        <?php _e('Default settings for search page', 'tfuse'); ?>
    </option>
</select>

<select placeholders="<?php echo get_placeholders_number('is_blogpage'); ?>" class="sidebars_subtype sidebar_box_is_blogpage">
    <option value="">
        e<?php _e('Select subtyp', 'tfuse'); ?>
    </option>
    <option value="default_is_blogpage">
        <?php _e('Default settings for Blog Page', 'tfuse'); ?>
    </option>
</select>

<select placeholders="<?php echo get_placeholders_number('is_404'); ?>" class="sidebars_subtype sidebar_box_is_404">
    <option value="">
        <?php _e('Select subtype', 'tfuse'); ?>
    </option>
    <option value="default_is_404">
        <?php _e('Default settings for 404 error page', 'tfuse'); ?>
    </option>
</select>

<div id="sidebar_manager_container">
    <?php
    for ($i = 1; $i <= $max_placeholders; $i++) {
        ?>
        <div class="sidebar_placeholder" id="sidebar_placeholder_<?php echo $i; ?>">
            <span class="placeholder_name"><?php _e('Placeholder', 'tfuse'); ?> <?php echo $i; ?></span>
        </div>
    <?php } ?>
    <br class="clear">
    <input type="button" id="sidebar_settings_save" value="<?php _e('Save', 'tfuse'); ?>"/>
</div>
<br class="clear">
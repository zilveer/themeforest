<?php
$tf_post_types = tf_get_post_types();
foreach ($tf_post_types as $key => $name) {
    $taxonomy = tf_custom_post_category($key);
    ?>
    <?php if ($taxonomy) { ?>
        <div class="multi_options multi_by_category_<?php echo $key; ?>">
            <?php echo $this->optigen->multi(change_option_id_custom($taxonomy, $multi_options['custom_category'], 'sidebar_multi_select_' . $key . '_category')); ?>
        </div>
    <?php } ?>
    <div class="multi_options multi_by_id_<?php echo $key; ?>">
        <?php echo $this->optigen->multi(change_option_id_custom($key, $multi_options['custom_post'], 'sidebar_multi_select_' . $key . '_' . $key)); ?>
    </div>
<?php } ?>

<div class="multi_options multi_by_category_post">
    <?php echo $this->optigen->multi(change_option_id($multi_options['category'], 'sidebar_multi_select_post_category')); ?>
</div>
<div class="multi_options multi_by_id_post">
    <?php echo $this->optigen->multi(change_option_id($multi_options['post'], 'sidebar_multi_select_post_post')); ?>
</div>

<div class="multi_options multi_by_template_page">
    <?php echo $this->optigen->select($multi_options['templates']); ?>
</div>
<div class="multi_options multi_by_id_page">
    <?php echo $this->optigen->multi(change_option_id($multi_options['page'], 'sidebar_multi_select_page_page')); ?>
</div>

<div class="multi_options multi_by_id_category">
    <?php echo $this->optigen->multi(change_option_id($multi_options['category'], 'sidebar_multi_select_category_category')); ?>
</div>

<?php
$tf_taxonomies = tf_get_taxonomies();
foreach ($tf_taxonomies as $key => $name) {
    ?>
    <div class="multi_options multi_by_id_<?php echo $key; ?>">
        <?php echo $this->optigen->multi(change_option_id_custom($key, $multi_options['custom_category'], 'sidebar_multi_select_' . $key . '_category')); ?>
    </div>
<?php } ?>
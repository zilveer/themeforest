<?php
$display_category = 'yes';
if(hashmag_mikado_options()->getOptionValue('blog_single_category') !== ''){
    $display_category = hashmag_mikado_options()->getOptionValue('blog_single_category');
}
?>

<div class="mkdf-post-content-featured">
	<?php hashmag_mikado_get_module_template_part('templates/single/parts/gallery', 'blog'); ?>
    <?php hashmag_mikado_post_info_category(array(
        'category' => $display_category
    )) ?>
</div>
<?php if(hashmag_mikado_options()->getOptionValue('blog_single_tags') == 'yes' || hashmag_mikado_options()->getOptionValue('blog_single_share') == 'yes'){ ?>
<div class="mkdf-single-tags-share-holder">
<?php } ?>

<?php if(hashmag_mikado_options()->getOptionValue('blog_single_share') == 'yes'){ ?>
	<?php hashmag_mikado_get_module_template_part('templates/single/parts/share', 'blog'); ?>
<?php } ?>
<?php if(hashmag_mikado_options()->getOptionValue('blog_single_tags') == 'yes' && has_tag()){ ?>
    <div class="mkdf-single-tags-holder">
        <h5 class="mkdf-single-tags-title"><?php esc_html_e('Post Tags', 'hashmag'); ?></h5>
        <div class="mkdf-tags">
            <?php the_tags('', '', ''); ?>
        </div>
    </div>
<?php } ?>
<?php if(hashmag_mikado_options()->getOptionValue('blog_single_tags') == 'yes' || hashmag_mikado_options()->getOptionValue('blog_single_share') == 'yes'){ ?>
</div>
<?php } ?>
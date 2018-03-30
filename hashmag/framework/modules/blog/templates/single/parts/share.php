<?php if(hashmag_mikado_options()->getOptionValue('blog_list_share') == 'yes' && hashmag_mikado_options()->getOptionValue('enable_social_share') == 'yes' && hashmag_mikado_options()->getOptionValue('enable_social_share_on_post') == 'yes'){ ?>
    <div class ="mkdf-blog-single-share">
    <?php echo hashmag_mikado_get_social_share_html(array('type'=>'dropdown')); ?>
    </div>
<?php }
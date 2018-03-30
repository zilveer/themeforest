<?php if (libero_mikado_options()->getOptionValue('enable_social_share_on_post') == 'yes'){ ?>
<div class ="mkd-blog-share">
	<?php echo libero_mikado_get_social_share_html(array('type' => 'dropdown')); ?>
</div>
<?php } ?>
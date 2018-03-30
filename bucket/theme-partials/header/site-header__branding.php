<?php if (wpgrade::option_image_src('main_logo')): ?>
    <a class="site-logo  site-logo--image  <?php if (wpgrade::option('use_retina_logo')) echo "  site-logo--image-2x"; ?>" href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name') ?>">
        <?php $data_retina_logo = wpgrade::option('use_retina_logo') ? 'data-logo2x="'.wpgrade::option_image_src('retina_main_logo').'"' : ''; ?>
        <img src="<?php echo wpgrade::option_image_src('main_logo'); ?>" <?php echo $data_retina_logo; ?> rel="logo" alt="<?php echo get_bloginfo('name') ?>"/>
    </a>

<?php else: ?>

    <a class="site-logo  site-logo--text" href="<?php echo home_url() ?>">
        <h1 class="site-home-title  flush--bottom  flush--top">
           <?php echo get_bloginfo('name') ?>
        </h1>
    </a>

<?php endif; ?>
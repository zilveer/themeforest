<?php global $post;

if ( $post->post_content ) : ?>
	<li class="description_tab"><a href="#tab-description"><?php _e('Description', 'woocommerce'); ?></a></li>
<?php endif; ?>
<?php if (etheme_get_option('custom_tab_title') && etheme_get_option('custom_tab_title') != '' ) : ?>
    <li class="custom_tab">
        <a href="#custom"><?php  etheme_option('custom_tab_title'); ?></a>
    </li>
<?php endif; ?>	 
<?php if ( etheme_get_custom_field('_etheme_custom_tab1_title') ) : ?>
    <li class="custom_tab">
        <a href="#custom2"><?php etheme_custom_field('_etheme_custom_tab1_title'); ?></a>
    </li>
<?php endif; ?>	 
<?php if ( etheme_get_custom_field('_etheme_custom_tab2_title') ) : ?>
    <li class="custom_tab">
        <a href="#custom3"><?php etheme_custom_field('_etheme_custom_tab2_title'); ?></a>
    </li>
<?php endif; ?>	 
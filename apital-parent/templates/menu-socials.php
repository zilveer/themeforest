<?php
    $menu_bar = fw_get_db_settings_option('menubar');
?>

<?php if($menu_bar['enable-menubar'] == 'socials'):?>
    <div class="w-hidden-medium w-hidden-small w-hidden-tiny social-full">
        <?php foreach($menu_bar['socials']['header-socials'] as $social): ?>
            <?php if(!empty($social['icon'])):?>
                <a class="w-inline-block social-ico social-gray" target="_blank" href="<?php echo esc_url($social['url']); ?>">
                    <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif;?>
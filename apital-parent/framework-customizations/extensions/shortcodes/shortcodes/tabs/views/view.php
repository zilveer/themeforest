<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$id = uniqid( 'tab-cont-' );
if ( empty( $atts['tabs'] ) ) {
	return;
}

$tabs = $atts['tabs'];
?>
<?php if(!empty($tabs)):?>
    <div class="w-tabs" data-duration-in="300" data-duration-out="100">
        <div class="w-tab-menu <?php echo ($atts['tabs_type'] == 'vertical' ? 'vertical-menu' : '')?>">
            <?php $cnt = 1; foreach($tabs as $tab):?>
                <?php $icon = ($tab['icon_box']['icon_type'] == 'awesome') ? $tab['icon_box']['awesome']['icon'] : $tab['icon_box']['custom']['icon']; ?>
                <a class="w-tab-link w--current w-clearfix w-inline-block tab <?php echo ($atts['tabs_type'] == 'vertical' ? 't-vertical' : '')?>" data-w-tab="Tab <?php echo esc_attr($cnt);?>">

                    <?php if(!empty($icon)):?>
                        <div class="li-ico tab-ico">
                            <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                            </div>
                        </div>
                    <?php endif;?>

                    <div class="tab-txt"><?php echo fw_theme_translate(esc_html($tab['tab_title']));?></div>
                </a>
            <?php $cnt++; endforeach;?>
        </div>
        <div class="w-tab-content <?php echo ($atts['tabs_type'] == 'vertical' ? '' : 'tab-content')?>">
            <?php $count = 1; foreach($tabs as $tab):?>
                <div class="w-tab-pane w--tab-active" data-w-tab="Tab <?php echo esc_attr($count);?>">
                    <?php echo fw_theme_translate(esc_html($tab['tab_content']));?>
                </div>
            <?php $count++; endforeach;?>
        </div>
    </div>
<?php endif;?>
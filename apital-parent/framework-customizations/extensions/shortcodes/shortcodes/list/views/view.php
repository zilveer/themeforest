<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );

	/**
	 * @var array $atts
	 */
} ?>
<?php
    $lists = $atts['list_items'];
?>

<?php if(!empty($lists)):?>
    <ul class="w-list-unstyled <?php echo esc_attr($atts['class']);?>">
        <?php foreach($lists as $list): ?>
            <?php $icon = ($list['icon_box']['icon_type'] == 'awesome') ? $list['icon_box']['awesome']['icon'] : $list['icon_box']['custom']['icon']; ?>
            <li class="w-clearfix li-list">
                <div class="li-ico li-current">
                    <?php if(!empty($icon)):?>
                        <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i></div>
                    <?php endif;?>
                </div>
                <p><?php echo esc_html($list['item']);?></p>

                <?php if(!empty($list['sublist_items'])):?>

                    <ul class="w-list-unstyled">
                        <?php foreach($list['sublist_items'] as $sublist):?>
                            <?php $subicon = ($sublist['icon_box']['icon_type'] == 'awesome') ? $sublist['icon_box']['awesome']['icon'] : $sublist['icon_box']['custom']['icon']; ?>
                            <li class="w-clearfix li-list">
                                <div class="li-ico li-current">
                                    <?php if(!empty($subicon)):?>
                                        <div class="w-embed"><i class="<?php echo esc_attr($subicon);?>"></i></div>
                                    <?php endif;?>
                                </div>
                                <p><?php echo esc_html($sublist['subitem']);?></p>

                            </li>
                        <?php endforeach; ?>
                    </ul>

                <?php endif;?>

            </li>
        <?php endforeach; ?>
    </ul>
<?php endif;?>
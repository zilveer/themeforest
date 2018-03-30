<?php
$sb = get_post_meta($post->ID, 'sidebarss_position', 1);
$title = get_post_meta($post->ID, 'page_title', 1) 
?>

<div class="oi_page_holder <?php if ( isset($sb)  && $sb =='No'){?>oi_without_sidebar<?php };?> <?php if( get_post_meta($post->ID, 'cont_lay', 1) =="Without Paddings"){?>oi_page_without_paddings<?php };?> <?php if(get_post_meta($post->ID, 'cont_lay', 1)=='Full Page Raw Scroller'){echo 'oi_full_port_page_raw_scroller oi_page_without_paddings ';};?>">
    <div class="oi_just_page oi_sections_holder">
            <div class="row">
                <div class="<?php if ($oi_qoon_options['oi_shop_layout']=='shop_full'){ echo 'col-md-12';}elseif($oi_qoon_options['oi_shop_layout'] =='shop_rs'){echo 'col-md-8';}elseif($oi_qoon_options['oi_shop_layout'] =='shop_ls'){echo 'col-md-8 col-md-push-4';}?>">
                <?php woocommerce_content(); ?>
                </div>
                <?php if ($oi_qoon_options['oi_shop_layout']!='shop_full'){?>
                <div class="col-md-4 oi_shop_sidebar oi_widget_area <?php if ($oi_qoon_options['oi_shop_layout']=='shop_ls'){echo 'col-md-pull-8 oi_left_sb';}?>">
					<?php if ( is_active_sidebar( 'qoon_shop_sidebar' ) ) { ?>
                        <?php dynamic_sidebar( 'qoon_shop_sidebar' ); ?>
                    <?php }; ?>
                </div>
                <?php }; ?>
            </div>
    </div>
</div>

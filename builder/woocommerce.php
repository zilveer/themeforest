<?php get_header(); ?>
<?php global $oi_options;?>
<div class="oi_vc_page_holder">
    <div class="container">
        <div class="oi_page_holder_custom oi_shop_page">
        	<div class="row">
            	<div class="<?php if ($oi_options['oi_shop_layout']=='shop_full'){ echo 'col-md-12';}elseif($oi_options['oi_shop_layout'] =='shop_rs'){echo 'col-md-8';}elseif($oi_options['oi_shop_layout'] =='shop_ls'){echo 'col-md-8 col-md-push-4';}?>">
                <?php woocommerce_content(); ?>
                </div>
				<?php if ($oi_options['oi_shop_layout']!='shop_full'){?>
                <div class="col-md-4 oi_widget_area <?php if ($oi_options['oi_shop_layout']=='shop_ls'){echo 'col-md-pull-8 oi_left_sb';}?>">
					<?php if ( is_active_sidebar( 'oi_shop_sidebar' ) ) { ?>
                        <?php dynamic_sidebar( 'oi_shop_sidebar' ); ?>
                    <?php }; ?>
                </div>
                <?php }; ?>
            </div>
        </div>
    </div>
</div>
<?php  get_footer(); ?>
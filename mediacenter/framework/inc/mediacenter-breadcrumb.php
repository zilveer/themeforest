<?php 
if ( ! function_exists( 'media_center_display_breadcrumb' ) ):
function media_center_display_breadcrumb( $header_style ){

    if( is_woocommerce_activated() ) :

    	ob_start();
    	mediacenter_breadcrumb( array(
    		'before'      => '<li><span>',
    		'after'       => '</span></li>',
    		'delimiter'   => '',
            'wrap_before' => '',
            'wrap_after'  => '',
    	) );
    	$woocommerce_breadcrumb_output = ob_get_contents();
    	ob_end_clean();
    	if ( ! empty( $woocommerce_breadcrumb_output ) ) :

    		if( $header_style == 'header-style-1') :
?>
<?php
    $departments_dropdown_trigger = apply_filters( 'mc_departments_dropdown_trigger', 'click', 'departments' );
    if( isset( $departments_dropdown_trigger ) && $departments_dropdown_trigger == 'hover' ){
        $data_hover = 'data-hover="dropdown"';
    }else{
        $data_hover = '';
    }
    $main_menu_dropdown_animation = apply_filters( 'mc_menu_dropdown_animation', 'none', 'primary' );
?>
<div id="top-mega-nav" class="yamm breadcrumb-menu <?php if( $main_menu_dropdown_animation != 'none' ) { echo 'animate-dropdown'; } ?>">
    <div class="container">
        <nav>
            <ul class="inline">
                <li class="dropdown le-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" <?php echo $data_hover; ?>>
                        <i class="fa fa-list"></i> <?php echo apply_filters( 'mc_shop_by_department', __( 'Shop by Department' , 'mediacenter' ) ); ?>
                    </a>
                    <?php echo media_center_department_nav_menu(); ?>
                </li>

                <li class="breadcrumb-nav-holder"> 
                	<ul class="mc-breadcrumb">
                		<?php echo $woocommerce_breadcrumb_output; ?>
                	</ul>
                </li><!-- /.breadcrumb-nav-holder -->
            </ul>
        </nav>
    </div><!-- /.container -->
</div>
	<?php else : ?>
<div id="breadcrumb-alt" class="yamm">
    <div class="container">
        <div class="breadcrumb-nav-holder minimal">
            <ul class="mc-breadcrumb">
                <li class="dropdown le-le-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php echo apply_filters( 'mc_breadcrumb_site_title', get_bloginfo( 'name' ) ); ?>
                    </a>
                    <?php echo media_center_department_nav_menu(); ?>
                </li>
                <?php echo $woocommerce_breadcrumb_output; ?>
            </ul>
        </div><!-- /.breadcrumb-nav-holder -->
    </div><!-- /.container -->
</div><!-- /#breadcrumb-alt -->
<?php 
            endif;
		endif; 
	endif;
}
endif;
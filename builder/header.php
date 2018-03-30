<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php global $oi_options;?>
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {?>
    <link rel="shortcut icon" href="<?php  echo esc_url(stripslashes($oi_options['oi_header_favicon']['url']));?>">
    <?php };?>
    <?php wp_head(); ?>
</head>

<body  <?php body_class(); ?>>
<div id="preloader">
  <div id="status">
  </div>
</div>
<!-- Content Area -->
    <!-- Container for math -->
    <div class="container"></div>
    <!-- Do not delete this container -->
    <div class="oi_head_holder nav-down">
    	<?php get_template_part( 'framework/topline/topline', $oi_options['oi_top_line_layout'] );?>
        <div class="oi_logo_holder logo-menu_wide_<?php echo esc_attr($oi_options['oi_logo-menu_wide']) ?>">
        	<div class="container oi_logo-menu_container">
        	<div class="row vertical-align">
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="oi_logo"><img src="<?php echo esc_url($oi_options['oi_logo_upload']['url'])?>" alt="<?php echo esc_attr(bloginfo('name'));?>"></a>
                </div>
                <div class="clearfix visible-xs"></div>
                <div class="col-md-10 col-sm-12 oi_main_menu <?php if ( class_exists( 'WooCommerce' ) ) {echo 'oi_woo_heder';};?>">
					<?php if($oi_options['oi_shop_cart']==1){ ?>
					<?php if ( class_exists( 'WooCommerce' ) ) {?>
                    <div class="oi_head_holder_inner">
                    <div class="oi_head_cart">
                        <a class="" href="<?php echo WC()->cart->get_cart_url(); ?>"><span class="oi_cart_icon"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'orangeidea' ), WC()->cart->cart_contents_count ); ?></span></a>
                    </div>
                    </div>
                    <div class="oi_cart_widget">
						<?php the_widget( 'WC_Widget_Cart', 'title=' );?>
                    </div>
                    <?php };?>
                    <?php };?>
                    
                   	<a class="oi_xs_menu" href="#"><span></span></a>
                    <?php wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'oi_header_menu_fixed')); ?>
                </div>
            </div>
            <div class="oi_sm_menu">
				<?php wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'oi_header_menu_mobile oi_header_menu_fixed')); ?>
            </div>

            </div>
        </div>
    </div>
<div class="oi_content_holder">
<?php if ( is_front_page()) {?>
	<div class="oi_tag_line tagline_wide_<?php echo esc_attr($oi_options['oi_tagline_wide']) ?>">
        <div class="container oi_tagline_container">
			<div class="row vertical-align">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="welcome">
                    	<?php echo $oi_options['oi_tagline-welocme']?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php };?>

<?php if(!is_search()) {?>
<?php if ( !is_front_page()) {?>
<?php if(!is_404()) {?>
	<?php if ( get_post_meta($post->ID, 'oi_tagline', 1) !='no'){ ?>
    <div class="oi_tag_line tagline_wide_<?php echo esc_attr($oi_options['oi_tagline_wide']) ?>">
        <div class="container oi_tagline_container">
			<div class="row vertical-align">
                <div class="col-md-6 col-sm-6 col-xs-12">
                	<?php if (is_page()){?>
                    	<h4 class="oi_tag_line_title"><?php the_title()?></h4>
                    <?php }elseif (is_blog()){
						if(is_archive()){?> 
                        <h4 class="oi_tag_line_title">
						<?php single_cat_title() ?>
                        </h4>
						<?php }else{
						$blog_page_id = get_option('page_for_posts');
						echo '<h4 class="oi_tag_line_title">'.get_page($blog_page_id)->post_title.'</h4>';};
					 }elseif (class_exists( 'WooCommerce' ) && is_woocommerce()){ ?>
                        <h4 class="oi_tag_line_title"><?php woocommerce_page_title(); ?></h4>
                    <?php }elseif (is_single()){ ?>
                    <h4 class="oi_tag_line_title"><?php the_title()?></h4>
                    <?php };?>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 text-right oi_breadcrumbs">
                    <?php if (class_exists( 'WooCommerce' ) && is_woocommerce()){
							woocommerce_breadcrumb();
						}else{
							oi_breadcrumbs();
						}?>
                </div>
            </div>
        </div>
    </div>
    <?php };?>
    <?php };?>
<?php };?>
<?php }else{?>
<div class="oi_tag_line tagline_wide_<?php echo esc_attr($oi_options['oi_tagline_wide']) ?>">
        <div class="container oi_tagline_container">
			<div class="row vertical-align">
                <div class="col-md-12"><h4 class="oi_tag_line_title">
                    <?php printf( __( 'Search Results for: <span class="colored">%s</span>', 'orangeidea' ), get_search_query() ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php };?>
<?php 
	$oi_qoon_options = get_option('oi_qoon_options');
	$allowed_html_array = wp_kses_allowed_html( 'post' );
	$oi_blog_page_id = get_option( 'page_for_posts' );
?>
<body  <?php body_class(); ?>>
<div class="oi_layout_<?php echo $oi_qoon_options['site-layout'];?>">
<?php
if (qoon_is_blog() || is_search()){
	$add_blog_class='need_emptyspace';
	$feat_image =  wp_get_attachment_url(get_post_thumbnail_id( get_option( 'page_for_posts' ) ));
	$feat_image_single =  wp_get_attachment_url(get_post_thumbnail_id( $post->ID ));
	
	$pp = get_option( 'page_for_posts' );
}else{
	$add_blog_class='';
	if ( class_exists( 'WooCommerce' ) ) {
		if (is_shop()){
			$pp = get_option( 'woocommerce_shop_page_id' );
		}else{
			$pp = $post->ID;
		}
	}else{
		$pp = $post->ID;
	}
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($pp));
};
$feat_image_position =  get_post_meta($pp, 'feat_h_pos', 1);
?>
<?php if (($feat_image !='')&& (get_post_meta($pp, 'feat_h', 1) !='Do Not Show') && (get_post_meta($pp, 'feat_h', 1) !='')){?>
    <div id="totop" class="oi_head_feat_image_holder <?php echo $add_blog_class?>" style="background-position:<?php echo $feat_image_position;?>; background-image:url('<?php if(is_single() && get_post_type() == 'post'){if($feat_image_single !=''){ echo $feat_image_single; }else{echo $feat_image;} }else{ echo $feat_image;} ?>'); ">
	<?php 
	if(is_single() && get_post_type() == 'post'){
	if($oi_qoon_options['single_heading-image'] =='style_ii'){?>
	<style>
	.oi_fh_f_image { display:none;}.oi_blog_post_single_descr { margin-bottom:0px;}
	</style>	
	<?php }else{
		if((get_post_meta($pp, 'rev_s', 1) !='') && (get_post_meta($pp, 'rev_s', 1) !='Do not use Slider')){ echo do_shortcode('[rev_slider ' . get_post_meta($pp, 'rev_s', 1) . ']');}
	}}else{
		if((get_post_meta($pp, 'rev_s', 1) !='') && (get_post_meta($pp, 'rev_s', 1) !='Do not use Slider')){ echo do_shortcode('[rev_slider ' . get_post_meta($pp, 'rev_s', 1) . ']');}
	}
	?>
	<script>
	jQuery.noConflict()(function($){
		<?php 
		$f_height='';
		if(is_single() && get_post_type() == 'post'){?>
			fh = $(window).height()/2;
		<?php }else{
				if(get_post_meta($pp, 'feat_h', 1) == '1/3'){?>
				fh = $(window).height()/3;
			<?php }else if(get_post_meta($pp, 'feat_h', 1) == '1/2'){?>
				fh = $(window).height()/2;
			<?php }else if(get_post_meta($pp, 'feat_h', 1) == '2/3'){?>
				fh = $(window).height()*2/3;
			<?php }else{?>
				fh = $(window).height();
			<?php };?>
		<?php }; ?>
		$('.oi_head_feat_image_holder').css('height',fh)
		$('.scroll-icon').click(function(){
			$("html, body").animate({ scrollTop: fh-$('.oi_logo_holder').height() }, 1000);
		});
		
	});
    </script>
    	<div class="container">
       	  <div class="oi_standard_tagline">
			<?php if (qoon_is_blog() || is_search()){echo wp_kses(get_post_meta($oi_blog_page_id, 'page-d', true), $allowed_html_array);}else{?>
            <?php echo wp_kses(get_post_meta($post->ID, 'page-d', true), $allowed_html_array); ?>
            <?php  };?>
          </div>
      </div>
        <?php if(get_post_meta($pp, 'feat_h', 1) == 'Full Screen'){?>
            <div class="oi_fh_f_image">
                <div class="scroll-icon">
                    <a href="#end_header">
                        <svg version="1.1" id="icn" fill="#fff" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="30px" height="20px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                        <polygon opacity="0" points="19.9,21 0,1.3 1.4,0 19.9,18.3 38.6,0 40,1.3 "><animate id="first" attributeName="opacity" attributeType="XML" dur="3s" from="1" to="0" repeatCount="indefinite"  begin="0"/></polygon>
                        <polygon id="arrow-two" opacity="0"  points="19.9,30.9 0,11.2 1.4,9.9 19.9,28.2 38.6,9.8 40,11.2 "><animate id="second" attributeName="opacity" attributeType="XML" dur="3s" from="1" to="0" repeatCount="indefinite"  begin="1s" /></polygon>
                        <polygon id="arrow-three"  opacity="0" points="19.9,40 0,20.3 1.4,19 19.9,37.3 38.6,19 40,20.3 "><animate id="third" attributeName="opacity" attributeType="XML" dur="3s" from="1" to="0" repeatCount="indefinite"  begin="2s"  /></polygon>
                        </svg>
                    </a>
                </div>
            </div>
        <?php };?>
</div>
<?php };?>

    <div class="oi_menu_overlay"></div>
    <div id="menu_slide_xs"><a id="nav-toggle" href="#"><span></span></a></div>
    <div class="oi_xs_menu visible-xs">
        <?php $locations = get_nav_menu_locations();
        if (!empty($locations)){
            if (!empty($locations['main_menu'])){
            wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'oi_main_menu'));
            };
        }else{ esc_html_e('Please setup your menu','qoon-creative-wordpress-portfolio-theme');};
        ?>
    </div>
    
    <div class="oi_logo_holder">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <?php if($oi_qoon_options['oi_logo_style']== true){ ?>
                    <div class="oi_text_logo"><a href="<?php echo esc_url(home_url('/')); ?>" class="oi_text_logo_a"><?php if(isset($oi_qoon_options['oi_logo_text'])){ echo esc_attr($oi_qoon_options['oi_logo_text']);};?></a><span class="oi_site_description"><?php if(isset($oi_qoon_options['oi_logo_descr'])){ echo esc_attr($oi_qoon_options['oi_logo_descr']);}; ?></span></div>
                    <?php }else{?>
                    <div class="oi_image_logo"><a href="<?php echo esc_url(home_url('/')); ?>" class="oi_text_logo_img"><img src="<?php echo esc_url($oi_qoon_options['oi_logo_upload']['url'])?>" alt="<?php echo esc_attr(bloginfo('name'));?>" /></a></div>
                    <?php };?>
                </div>
                <div class="col-md-9 col-sm-9 hidden-xs">
                	<?php if ($oi_qoon_options['logo-menu_burger']=='1'){?>
                    <div id="menu_slide_xs"><a id="nav-toggle" href="#"><span></span></a></div>
                    <?php $locations = get_nav_menu_locations();
                    if (!empty($locations)){
                        if (!empty($locations['main_menu'])){
                        wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'oi_main_menu'));
                        };
                    }else{ _e('<div class="text-right oi_alert"><span>Please setup your menu<span></div>','qoon-creative-wordpress-portfolio-theme');};
                    ?>
                    <?php if ( class_exists( 'WooCommerce' ) ) {?>
                    <div class="oi_woo_cart">
                    <div class="oi_head_holder_inner">
                    <div class="oi_head_cart">
                        <a class="" href="<?php echo WC()->cart->get_cart_url(); ?>"><span class="oi_cart_icon"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'orangeidea' ), WC()->cart->cart_contents_count ); ?></span></a>
                    </div>
                    </div>
                    <div class="oi_cart_widget">
						<?php the_widget( 'WC_Widget_Cart', 'title=' );?>
                    </div>
                    </div>
                    <?php };?>
                    <?php }else{?>
                    	<div class="oi_burger_normal_holder"><a class="oi_burger_normal" href="#"><span></span></a></div>
                        <div class="oi_menu_overlay_normal">
                        <?php $locations = get_nav_menu_locations();
						if (!empty($locations)){
							if (!empty($locations['main_menu'])){
							wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'oi_main_menu'));
							};
						}else{ _e('<div class="text-right oi_alert"><span>Please setup your menu<span></div>','qoon-creative-wordpress-portfolio-theme');};
						?>
                        </div>
                        
   					<?php };?>
                </div>
            </div>
        </div>
    </div>

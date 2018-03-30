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
	$pp = get_option( 'page_for_posts' );
	$feat_image =  wp_get_attachment_url(get_post_thumbnail_id( get_option( 'page_for_posts' ) ));}
else{
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
	$add_blog_class='';
	$pp = $post->ID;
}
?>
<div class="oi_right_half" style=" background:url('<?php echo $feat_image; ?>') #f1f1f1">
<?php if((get_post_meta($pp, 'rev_s', 1) !='') && (get_post_meta($pp, 'rev_s', 1) !='Do not use Slider')){ echo do_shortcode('[rev_slider ' . get_post_meta($pp, 'rev_s', 1) . ']');}?>
</div>
<div class="oi_left_half">
<div class="oi_logo_holder">
        <div class="halfs_container">
       
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?php if($oi_qoon_options['oi_logo_style']== true){ ?>
                    <div class="oi_text_logo"><a href="<?php echo esc_url(home_url('/')); ?>" class="oi_text_logo_a"><?php if(isset($oi_qoon_options['oi_logo_text'])){ echo esc_attr($oi_qoon_options['oi_logo_text']);};?></a><span class="oi_site_description"><?php if(isset($oi_qoon_options['oi_logo_descr'])){ echo esc_attr($oi_qoon_options['oi_logo_descr']);}; ?></span></div>
                    <?php }else{?>
                    <div class="oi_image_logo"><a href="<?php echo esc_url(home_url('/')); ?>" class="oi_text_logo_img"><img src="<?php echo esc_url($oi_qoon_options['oi_logo_upload']['url'])?>" alt="<?php echo esc_attr(bloginfo('name'));?>" /></a></div>
                    <?php };?>
                </div>
                <div class="col-md-12 col-sm-12">
                	<?php if ($oi_qoon_options['logo-menu_burger']=='1'){?>
                    <div id="menu_slide_xs"><a id="nav-toggle" href="#"><span></span></a></div>
                    <?php $locations = get_nav_menu_locations();
                    if (!empty($locations)){
                        if (!empty($locations['main_menu'])){
                        wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'oi_main_menu'));
                        };
                    }else{ esc_html_e('Please setup your menu','qoon-creative-wordpress-portfolio-theme');};
                    ?>
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

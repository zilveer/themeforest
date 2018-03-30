<?php $oi_qoon_options = get_option('oi_qoon_options'); $allowed_html_array = wp_kses_allowed_html( 'post' )?>
<?php $oi_blog_page_id = get_option( 'page_for_posts' );?>
<?php
if ( is_admin_bar_showing() ) {
?>
<style>
html.fp-enabled { margin:0 !important; padding-top:32px !important;}
</style>
<?php }?>
<body  <?php body_class(); ?>>
<div class="oi_layout_<?php echo $oi_qoon_options['site-layout'];?>">
<div id="menu_slide_xs"><a id="nav-toggle" href="#"><span></span></a></div>
<?php get_template_part( 'framework/loader' )?>
<div class="oi_header_side oi_full_page">
	<div id="oi_current_image" class="oi_bg_img" style=" background:url('<?php
	if (qoon_is_blog() || is_search()){
		if($oi_blog_page_id !=='0'){
			$feat_image =  wp_get_attachment_url(get_post_thumbnail_id( $oi_blog_page_id ));
		}else{
			if(isset($oi_qoon_options['oi_blog_home']['background-image']) ){
			$feat_image = $oi_qoon_options['oi_blog_home']['background-image'];
			}else{$feat_image ='';}
		}
	}elseif((get_post_meta($post->ID, 'oi_ps', 1) =='creative') || (get_post_meta($post->ID, 'oi_ps', 1) =='modern')){
		$e_tag = get_post_meta($post->ID, 'oi_tag', 1);
		$p_tag = "";
		if  ($e_tag !='All'){
		$p_tag = get_term_by('name', $e_tag, 'portfolio-tags');
		};
		if($p_tag !=''){
		$args = array(
			'post_type' 		=> 'portfolio',
			'posts_per_page' 	=> 1,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio-tags',
					'terms'    => $p_tag->term_id,
				),
			),
		);
		$next_args = array(
			'post_type' 		=> 'portfolio',
			'posts_per_page' 	=> 1,
			'offset'           => 1,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio-tags',
					'terms'    => $p_tag->term_id,
				),
			),
		);
		$last_args = array(
			'post_type' 		=> 'portfolio',
			'posts_per_page' 	=> 1,
			'offset'           => 0,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
			'order' 			=> 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio-tags',
					'terms'    => $p_tag->term_id,
				),
			),
		);
		
		}else{
		$args = array(
			'post_type' 		=> 'portfolio',
			'posts_per_page' 	=> 1,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
			);
		
		$next_args = array(
			'post_type' 		=> 'portfolio',
			'posts_per_page' 	=> 1,
			'offset'           => 1,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
		);
		$last_args = array(
			'post_type' 		=> 'portfolio',
			'posts_per_page' 	=> 1,
			'offset'           => 0,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
			'order' 			=> 'ASC',
		);
		}
		$last_post = get_posts($last_args);
		$next_post = get_posts($next_args);
		$this_post = get_posts($args);
		$thisid = $this_post[0]->ID;
		$nextid = $next_post[0]->ID;
		$lastid = $last_post[0]->ID;

		
		if ((get_post_meta($post->ID, 'oi_ps', 1) =='creative')){
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($thisid) );
		}else{
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
			wp_reset_postdata();
			global $post;
			$p_p = get_previous_post();
			$n_p = get_next_post();
			if($p_p!=''){
				$n_id = $p_p->ID;
			};
			if($n_p!=''){
				$p_id = $n_p->ID;
			}
			wp_reset_postdata();
		}
	}else{ 
		$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
	}
	echo esc_url($feat_image);?>')"></div>
    <?php if (!is_search()){ ?>
    <?php if((get_post_meta($post->ID, 'oi_ps', 1) =='creative')){?>
    	<?php if(post_password_required()){?>
        		<div class="oi_creative_p_content pwd_protect">
				<?php echo qoon_password_form(); ?>
                </div>
			<?php }else{?>
            <div class="oi_creative_p_content" data-tags=<?php if  ($e_tag !='All'){ echo $e_tag; }else{echo 'all';}?> data-first="<?php echo esc_attr($thisid);?>" data-last="<?php echo esc_attr($lastid);?>">
        	<div class="oi_creative_p_holder">
                <div class="oi_c_resize"><span>↑</span><span></span>↓</div>
                <?php 
                $cat = get_the_terms( $thisid, 'portfolio-category' );
                if (isset($cat) && ($cat!='')){
                    $cat_name = ''; 
                    foreach($cat  as $vallue=>$key){
                        $cat_name  .= ''.$key->name.', ';
                    }
                };
                $this_date = get_the_date( get_option( 'date_format' ), $thisid );
                $next_post = get_next_post(true);
                ?>
                <p class="oi_creative_p_date"><span class="oi_c_date"><?php echo esc_attr($this_date);?></span>  <span class="oi_c_cats"><?php echo esc_attr(substr($cat_name, '0', '-2'));?></span></p>
                <h3 class="oi_c_title"><a data-menu="no"  data-id="<?php echo esc_attr($thisid) ?>" href="<?php echo get_permalink($thisid)?>"><?php echo get_the_title($thisid)?></a></h3>
                <a data-offset="0" data-id="<?php echo esc_attr($lastid);?>" class="oi_crea_a oi_prev_c_p" href="#">←</a>
                <a data-offset="1" data-id="<?php echo esc_attr($nextid);?>" class="oi_crea_a oi_next_c_p" href="#">→</a>
                <div class="oi_c_description">
                	<hr>
                    <div class="oi_c_description_content">
						<?php
                        $allowed_html_array = wp_kses_allowed_html( 'post' );
                        echo do_shortcode(wp_kses(get_post_meta($thisid, 'port-description', true), $allowed_html_array ));
                        ?>
                    </div>
                    <a class="oi_c_details" data-menu="no" data-id="<?php echo esc_attr($thisid); ?>" href="<?php echo get_permalink($thisid)?>"><?php echo esc_html__('Read More','qoon-creative-wordpress-portfolio-theme');?></a>
                </div>
        	</div>
        </div>
        <?php } ?>
	<?php };?>
    <?php if((get_post_meta($post->ID, 'oi_ps', 1) =='modern')){?>
		<script>jQuery.noConflict()(function($){if($('body').outerWidth()< 768){ location.href ='<?php echo esc_url(home_url('/')); ?>' }});</script>
		<?php 
            $cat = get_the_terms( $thisid, 'portfolio-category' );
            if (isset($cat) && ($cat!='')){
                $cat_name = ''; 
                foreach($cat  as $vallue=>$key){
                    $cat_name  .= ''.$key->name.', ';
                }
            };
            $this_date = get_the_date( get_option( 'date_format' ), $thisid );
            $next_post = get_next_post(true);
        ?>
        <?php if(post_password_required()){?>
        		<div class="oi_pwd_modern pwd_protect">
				<?php echo qoon_password_form(); ?>
                </div>
			<?php }else{?>
            <div class="oi_m_holder">
        <div class="oi_modern_p_content" data-tags=<?php if  ($e_tag !='All'){ echo $e_tag; }else{echo 'all';}?> data-id="<?php echo esc_attr($thisid);?>" data-last="<?php echo esc_attr($lastid);?>">
        	<div class="oi_modern_p_item" style="background-image:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($thisid) );?>')">
            </div>
            <div class="oi_modern_p_arrows">
                <a data-offset="0" data-id="<?php echo esc_attr($lastid);?>" class="oi_modern_a oi_prev_m_p" href="#">←</a>
                <a data-offset="1" data-id="<?php echo esc_attr($nextid);?>" class="oi_modern_a oi_next_m_p" href="#">→</a>
            </div>
            <div class="oi_m_description_content_mobile">
            	 <h3 class="oi_c_title">
                 <span class="oi_creative_p_date"><span class="oi_c_date"><?php echo esc_attr($this_date);?></span>  <span class="oi_c_cats"><?php echo esc_attr(substr($cat_name, '0', '-2'));?></span></span>
                 <a class="oi_cm_links"  data-link-id="<?php echo esc_attr($thisid);?>" href="<?php echo get_permalink($thisid)?>"><?php echo get_the_title($thisid)?></a>
                 </h3>
            </div>
            <div class="oi_m_description_content">
            	 <h3 class="oi_c_title">
                 <span class="oi_creative_p_date"><span class="oi_c_date"><?php echo esc_attr($this_date);?></span>  <span class="oi_c_cats"><?php echo esc_attr(substr($cat_name, '0', '-2'));?></span></span>
                 <a class="oi_cm_links"  data-link-id="<?php echo esc_attr($thisid);?>" href="<?php echo get_permalink($thisid)?>"><?php echo get_the_title($thisid)?></a>
                 </h3>
				<span class="oi_mp_d"><?php
                $allowed_html_array = wp_kses_allowed_html( 'post' );
                echo do_shortcode(wp_kses(get_post_meta($thisid, 'port-description', true), $allowed_html_array ));
                ?>
                </span>
                <a data-link-id="<?php echo esc_attr($thisid);?>" class="oi_c_details oi_cm_links" href="<?php echo get_permalink($thisid)?>"><?php echo esc_attr(__('Read More','qoon-creative-wordpress-portfolio-theme'));?></a>
            </div>
        </div>
        </div>
            <?php }?>
        
	<?php };?>
    <?php };?>
	<div id="oi_next_image" class="oi_bg_img"></div>
	<?php if($oi_qoon_options['oi_logo_style']== true){ ?>
	<div class="oi_text_logo"><a href="<?php echo esc_url(home_url('/')); ?>" class="oi_text_logo_a"><?php if(isset($oi_qoon_options['oi_logo_text'])){ echo esc_attr($oi_qoon_options['oi_logo_text']);};?></a><span class="oi_site_description"><?php if(isset($oi_qoon_options['oi_logo_descr'])){ echo esc_attr($oi_qoon_options['oi_logo_descr']);}; ?></span></div>
    <?php }else{?>
    <div class="oi_image_logo"><a href="<?php echo esc_url(home_url('/')); ?>" class="oi_text_logo_img"><img src="<?php echo esc_url($oi_qoon_options['oi_logo_upload']['url'])?>" alt="<?php echo esc_attr(bloginfo('name'));?>" /></a></div>
    <?php };?>
	<?php $locations = get_nav_menu_locations();
    if (!empty($locations)){
		if (!empty($locations['main_menu'])){
		wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'oi_main_menu'));
		};
	}else{ esc_html_e('Please setup your menu','qoon-creative-wordpress-portfolio-theme');};
	?>
    <a href="#" class="oi_slide_header_side"><i class="fa fa-fw fa-chevron-right"></i></a>
   		
	<div class="oi_tag_line_holder">
        <div class="oi_tag_line">
        <?php if (qoon_is_blog() || is_search()){echo wp_kses(get_post_meta($oi_blog_page_id, 'page-d', true), $allowed_html_array);}else{?>
		<?php echo wp_kses(get_post_meta($post->ID, 'page-d', true), $allowed_html_array); ?>
        <?php  };?>
        </div>
    </div>
    <div class="oi_footer">
    	<?php echo $oi_qoon_options['oi_bottom_copyy'];?>
        <?php $locations = get_nav_menu_locations();?>
		<?php
            if (!empty($locations['footer_menu'])){
                wp_nav_menu( array('theme_location' => 'footer_menu', 'menu_class' => 'oi_right_menu oi_footer_menu'));
            };
        ?>
    </div>
</div>
<?php if(get_page_template_slug( get_the_ID() )!='portfolio.php') {?>

<?php if (qoon_is_blog() || is_search()){?>
<?php if (get_post_meta($oi_blog_page_id, 'sidebarss_position', 1) !='Disabled'){?>
<div class="oi_sub_header_side">
	<?php dynamic_sidebar( 'qoon_blog_sidebar' );?>
</div>
<?php };?>
<?php }else{?>
<?php if (get_post_meta($post->ID, 'sidebarss_position', 1) !='Disabled'){?>
<div class="oi_sub_header_side">
	<?php 
		dynamic_sidebar( get_post_meta($post->ID, 'sidebarss', 1) ); 
	 ?>
</div>
<?php };};};?>
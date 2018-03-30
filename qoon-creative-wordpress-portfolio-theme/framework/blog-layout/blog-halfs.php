<?php $oi_qoon_options = get_option('oi_qoon_options'); $allowed_html_array = wp_kses_allowed_html( 'post' )?>
<?php if(is_page_template( 'blog.php' )){$pp = $post->ID;}else{$pp = get_option( 'page_for_posts' );}?>
<?php if ($oi_qoon_options['blog_style']=='masonry'){ $sb_position = 'Disabled';}else{$sb_position = get_post_meta($pp, 'sidebarss_position', 1);}?>
<div class="oi_page_holder oi_page_will_be_<?php echo $oi_qoon_options['blog_style'];?>">
    <div class="c_container">
    	<div class="row">
        	<div class="col-md-12">
            	<?php echo qoon_breadcrumbs()?>
                <?php if ($pp !=0){ echo do_shortcode(get_post_field('post_content', $pp));}?>
            	<?php  if($oi_qoon_options['oi_cats_show']=='1'){?>
                <ul class="oi_list_cats">
                    <li class="oi_all_cats cat-item current-cat"><a href="<?php echo get_permalink( $pp ); ?>"><?php esc_html_e('Everything','qoon-creative-wordpress-portfolio-theme')?></a></li>
                    <?php 
                        $args = array('title_li' =>'', 'depth' => 1, 'order' => 'DESC', 'orderby' => 'count', 'number' => $oi_qoon_options['oi_cats-number']);
						wp_list_categories( $args ); 
                    ?>
                </ul>
                <?php };?>
            </div>
        	<div class="<?php if ($sb_position =='Disabled'){echo 'col-md-12';}elseif($sb_position =='Right Sidebar'){echo 'col-md-8';}else{echo 'col-md-8 col-md-push-4';};?>">
                <ul class="oi_posts_ul oi_ul_will_be_<?php echo $oi_qoon_options['blog_style'];?>">
						<?php if ( !is_archive() ) { 
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts('paged='.$paged.'&cat='.$cat); 	
                        } 
                        if (!(have_posts())) { ?><h3 class="page_title"><?php esc_html_e('Nothing was found','qoon-creative-wordpress-portfolio-theme')?></h3><?php }   
                        if ( have_posts() ) : while ( have_posts() ) : the_post();?>
                        <li class="oi_format_will_be_<?php echo $oi_qoon_options['blog_style'];?>">
                        <span <?php post_class('oi_post oi_post_format_style_'.$oi_qoon_options['blog_style']); ?> id="post-<?php the_ID(); ?>">
                            <?php $format = get_post_format(); get_template_part( 'framework/post-format/'.$oi_qoon_options['blog_style'].'_format', $format );   ?>
                        </span>
                        </li>
                    <?php endwhile; endif;?>
                </ul>
                <div class="clearfix"></div>
                <?php if (function_exists('the_posts_pagination')) { ?><div class="oi_pg oi_chess_pg"><?php the_posts_pagination(); ?></div><?php }?>
        	</div>
            <?php if ($sb_position !='Disabled'){?>
            <div class="<?php if ($sb_position =='Right Sidebar'){echo 'col-md-4 right_sb';}else{echo 'col-md-4 col-md-pull-8 left_sb';}?>">
                <div class="widget_area">
                    <?php dynamic_sidebar( get_post_meta($pp, 'sidebarss', 1) ); ?>
                </div>
        	</div>
            <?php };?>
        </div>
    </div>
</div>

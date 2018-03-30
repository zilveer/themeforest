<?php $oi_qoon_options = get_option('oi_qoon_options'); $allowed_html_array = wp_kses_allowed_html( 'post' )?>
<?php if(is_page_template( 'blog.php' )){$pp = $post->ID;}else{$pp = get_option( 'page_for_posts' );}?>
<?php if ($oi_qoon_options['blog_style']=='masonry'){ $sb_position = 'Disabled';}else{$sb_position = get_post_meta($pp, 'sidebarss_position', 1);}?>
<div class="oi_page_holder oi_page_will_be_<?php echo $oi_qoon_options['blog_style'];?>">
	<div class="container">
   <?php  if($oi_qoon_options['oi_cats_show']=='1'){?>
    <ul class="oi_list_cats">
        <li class="oi_all_cats cat-item current-cat"><a href="<?php echo get_permalink( $pp ); ?>">Everything</a></li>
        <?php 
            $args = array('title_li' =>'', 'depth' => 1, 'order' => 'DESC', 'orderby' => 'count', 'number' => $oi_qoon_options['oi_cats-number']);
			wp_list_categories( $args ); 
        ?>
    </ul>
    <?php };?>
    <p><?php esc_html_e('Search for:','qoon-creative-wordpress-portfolio-theme')?> <?php echo get_search_query();?></p> 
    <ul class="oi_posts_ul oi_ul_will_be_<?php echo $oi_qoon_options['blog_style'];?>">
        <?php 
        if (!(have_posts())) { ?>
        <style>.oi_pg { display:none;}</style>
        <h3 class="page_title uppercase"><?php esc_html_e('Nothing was found','qoon-creative-wordpress-portfolio-theme')?></h3>
        <h5 style="margin-bottom:40px"><?php esc_html_e('Please change query and try again','qoon-creative-wordpress-portfolio-theme')?></h5>
        <div class="row">
            <div class="col-md-4">
                <?php get_search_form();?>
            </div>
        </div>
		<?php } if ( have_posts() ) : while ( have_posts() ) : the_post();?>
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
</div>

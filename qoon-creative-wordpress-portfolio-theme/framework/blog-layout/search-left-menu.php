<?php $oi_qoon_options = get_option('oi_qoon_options'); $allowed_html_array = wp_kses_allowed_html( 'post' )?>
<?php if(is_page_template( 'blog.php' )){$pp = $post->ID;}else{$pp = get_option( 'page_for_posts' ) ;}?>

<div class="oi_page_holder">
	<?php  if($oi_qoon_options['oi_cats_show']=='1'){?>
    <ul class="oi_list_cats">
    <li class="oi_all_cats cat-item current-cat"><a href="<?php echo get_permalink( $pp ); ?>">everything</a></li>
	<?php 
		$args = array('title_li' =>'', 'depth' => 1, 'order' => 'DESC', 'orderby' => 'count', 'number' => $oi_qoon_options['oi_cats-number']);
		wp_list_categories( $args ); 
	?>
    
    </ul>
	<?php };?>
    <ul class="oi_posts_ul">
        <?php 
        if (!(have_posts())) { ?><h3 class="page_title text-center uppercase" style=" margin-bottom:40px;"><?php _e('Nothing was found','qoon-creative-wordpress-portfolio-theme')?></h3><?php }   
        if ( have_posts() ) : while ( have_posts() ) : the_post();?>
        <li>
         <div <?php post_class('oi_post oi_post_format_style_'.$oi_qoon_options['blog_style']); ?> id="post-<?php the_ID(); ?>">
            <?php $format = get_post_format(); get_template_part( 'framework/post-format/'.$oi_qoon_options['blog_style'].'_format', $format );   ?>
        </div>
        </li>
    <?php endwhile; endif;?>
    </ul>
    <?php if (function_exists('the_posts_pagination')) { ?><div class="oi_pg oi_chess_pg"><?php the_posts_pagination(); ?></div><?php }?>
</div>

<div class="oi_page_holder">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-4">
                <ul class="oi_posts_ul">
                    <?php if ( !is_archive() ) { 
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts('paged='.$paged.'&cat='.$cat); 	
                    } 
                    if (!(have_posts())) { ?><h3 class="page_title"><?php _e('Nothing was found','orangeidea')?></h3><?php }   
                    if ( have_posts() ) : while ( have_posts() ) : the_post();?>
                    <li>
                    <div <?php post_class('oi_post oi_mini_post'); ?> id="post-<?php the_ID(); ?>">
                        <?php $format = get_post_format(); get_template_part( 'framework/post-format/format-mini', $format );   ?>
                    </div>
                    </li>
                <?php endwhile; endif;?>
                </ul>
				<?php if (function_exists('wp_corenavi')) { ?> <div class="oi_pg  oi_left_sb"><?php wp_corenavi(); ?></div><?php }?>
            </div>
            <div class="col-md-4 col-md-pull-8 oi_left_sb oi_widget_area">
				<?php if ( is_active_sidebar( 'oi_blog_sidebar' ) ) { ?>
                    <?php dynamic_sidebar( 'oi_blog_sidebar' ); ?>
                <?php }; ?>
            </div>
        </div>
    </div>
</div>

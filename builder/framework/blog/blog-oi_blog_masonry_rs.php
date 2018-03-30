<div class="oi_page_holder">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="oi_mas_container row">
                    <?php if ( !is_archive() ) { 
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts('paged='.$paged.'&cat='.$cat); 	
                    } 
                    if (!(have_posts())) { ?><h3 class="page_title"><?php _e('Nothing was found','orangeidea')?></h3><?php }   
                    if ( have_posts() ) : while ( have_posts() ) : the_post();?>
                    
                    <div class="oi_mas_item col-md-6 col-sm-6">
                    <div <?php post_class('oi_post'); ?> id="post-<?php the_ID(); ?>">
                        <?php $format = get_post_format(); get_template_part( 'framework/post-format/format-mas-3col', $format );   ?>
                    </div>
                    </div>
                <?php endwhile; endif;?>
                </ul>
				
            </div>
				<?php if (function_exists('wp_corenavi')) { ?> <div class="oi_pg"><?php wp_corenavi(); ?></div><?php }?>
            </div>
            <div class="col-md-4 oi_widget_area">
				<?php if ( is_active_sidebar( 'oi_blog_sidebar' ) ) { ?>
                    <?php dynamic_sidebar( 'oi_blog_sidebar' ); ?>
                <?php }; ?>
            </div>
        </div>
    </div>
</div>

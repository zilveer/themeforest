<?php get_header(); ?>

<?php
    $sidebar_output = false;
?>
	<!-- Homepage content -->
    <div class="container homepage-content">
        <?php
        if(plsh_gs('show_featured_articles') == 'on' && plsh_gs('featured_article_size') === 'large')
        {
            get_template_part( 'theme/templates/featured-posts-large');
        }
        
        if(plsh_gs('sidebar_position') === 'left')
        {
            get_sidebar();
            $sidebar_output = true;
        }
        ?>
        
        <div class="main-content-column-1<?php if(plsh_gs('sidebar_position') === 'left') { echo ' right'; } ?>">    
            <?php 
            if(plsh_gs('show_featured_articles') == 'on' && plsh_gs('featured_article_size') === 'small')
            {   
                get_template_part( 'theme/templates/featured-posts-small');
            }
            
            if(plsh_gs('blog_item_style') === 'compact')
            {
                $blog_block = 1;
            }
            else
            {
                $blog_block = 2;
            }
            ?>
             
            <!-- Blog list 1 -->
            <div class="blog-block-<?php echo esc_attr($blog_block); ?>">
                <div class="title-default">
                    <a href="<?php get_post_type_archive_link('post'); ?>" class="active"><?php echo archive_title( plsh_gs('blog_title') ); ?></a>
                </div>
                <div class="items">
                    <?php get_template_part( 'theme/templates/loop'); ?>
                </div>
            </div>
            
            <?php get_template_part( 'theme/templates/pagination' ); ?>
            
            <?php echo $banner = plsh_get_banner_by_location('blog_ad'); ?>
            
        </div>

        <?php
            if(plsh_gs('sidebar_position') === 'right' && !$sidebar_output)
            {
                get_sidebar();
            }
        ?>

    </div>
		
<?php get_footer(); ?>
<?php get_header(); ?>
<?php wp_reset_postdata(); ?>

<!-- Homepage content -->
<div class="container homepage-content">

    <?php
        if(plsh_gs('sidebar_position') === 'left')
        {
            get_sidebar();
        }
    ?>
    
    <div class="main-content-column-1 <?php if(plsh_gs('sidebar_position') === 'left') { echo ' right'; } ?>">

        <!-- Post -->
        <div <?php post_class('post-1'); ?>>
                                
            <div class="title">
                <h1 id="intro"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            </div>
            <div class="post"><?php the_content(); ?></div>

        </div>
                   
        <?php echo $banner = plsh_get_banner_by_location('post_ad'); ?>

    </div>
    
    <?php
        if(plsh_gs('sidebar_position') === 'right')
        {
            get_sidebar();
        }
    ?>
        
</div>

<?php get_footer(); ?>
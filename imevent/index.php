<?php

global $theme_option;

get_header(); 

$col = 'col-sm-12 col-md-12';
if(is_active_sidebar('sidebar-right')){ 
    $col = 'col-sm-8 col-md-9';
}

?>

<section class="page-section with-sidebar">
    <div class="container">
        <div class="row">

            <!-- Content -->

            <section id="content" class="content <?php echo esc_attr($col); ?>">
                
                <?php  if(have_posts()) :
                        while(have_posts()) : the_post(); 
                ?>
                            <?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>                
                        <?php endwhile; ?>
                <?php else: ?>
                    <h1><?php _e('Nothing Found Here!', TEXT_DOMAIN); ?></h1>
                <?php endif; ?>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                   <?php ova_numeric_posts_nav(); ?>
                </div>
                <!-- /Pagination -->

            </section>
            <!-- Content -->

            <hr class="page-divider transparent visible-xs"/>

            <!-- Sidebar -->
            <?php if(is_active_sidebar('sidebar-right')){ ?>
                <aside id="sidebar" class="sidebar col-sm-4 col-md-3">               
                  <?php dynamic_sidebar('sidebar-right' ); ?>
                </aside>
            <?php } ?>
            <!-- Sidebar -->

        </div>
    </div>
</section>

<?php get_footer(); ?>
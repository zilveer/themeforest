<?php

/*
Template Name: Blog Homepage - Light
*/
?>
<?php
$customize = get_options();
if($customize == ''){
    global $options_extra;
    $customize = $options_extra;
}
$is_customize_mode =  (has_action( 'customize_controls_init' )) ? true : false;
?>
<?php 
get_header();

    $page_id = get_the_ID(); 
    
    if ( apply_filters('awe_is_blog_header', $page_id) )
    {
        get_template_part('section','introduction-blog');
    }

    $main_class = layout_class('main');
    $left = layout_class('left'); 
    $right = layout_class('right');
    
    $post_per_page =(get_option('posts_per_page '))?get_option('posts_per_page '):5;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    query_posts('post_type=post&posts_per_page='.$post_per_page.'&showposts='.$post_per_page.'&paged='.$paged );
?>
<!-- Blog -->
    <div id="main">
        <!-- Content Blog -->
            <div id="content-blog">
                <div class="container">
                    <div class="row">
                    <?php if($main_class == 'col-md-12') : ?>
                        <div class="col-md-12">
                        <?php get_template_part('content','loop'); ?>
                        <?php get_template_part('pages_nav');?>
                            <!-- End Page Navigation --> 
                        </div>
                        <div class="col-md-12">
                        <?php dynamic_sidebar('sidebar'); ?>
                        </div>
                    <?php endif; ?>
                    <?php // end full with layer // ?>
                    <?php  
                        if($left != '') { ?>
                            <div class="col-md-3 blog-list-right">
                                <?php dynamic_sidebar('sidebar'); ?>
                            </div>
                           <div class="col-md-8 col-md-offset-1">
                            <?php get_template_part('content','loop'); ?>
                            <?php get_template_part('pages_nav');?>
                            </div>
                            
                    <?php  }
                        if($right != '') { ?>
                            <div class="col-md-8 ">
                            <?php get_template_part('content','loop'); ?>
                            <?php get_template_part('pages_nav');?>
                            </div>
                            <div class="col-md-3 col-md-offset-1 blog-list-right">
                                <?php dynamic_sidebar('sidebar'); ?>
                            </div>
                        <?php
                        }
                    ?>
                        
                    </div>
                </div>
            </div>
        <!-- End Content Blog -->
    </div>
    <!-- ENd Main -->
    <!-- End Blog -->

<?php get_footer(); ?>
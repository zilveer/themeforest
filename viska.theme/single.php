<?php
$customize = get_options();
if($customize == ''){
    global $options_extra;
    $customize = $options_extra;
}
$is_customize_mode =  (has_action( 'customize_controls_init' )) ? true : false;
?>
<?php get_header();?>
<?php get_template_part('section','introduction-blog');?>
<?php 
    $main_class = layout_class('main');
    $left = layout_class('left');
    $right = layout_class('right');
?>
    <!--=============== wrapper ===============-->
    <div id="main">
        <!-- Blog Singer-->
        <div id="content-blog">
            <div class="container">
                <div class="row">
                    <!-- Blog Left -->
                    
                <?php if($main_class == 'col-md-12') : ?>
                    <div class="col-md-12">
                    <?php get_template_part('single','content');?>
                    <!-- Blog Right -->
                    </div>
                    <div class="col-md-12 blog-list-right">
                    <?php dynamic_sidebar('sidebar'); ?>
                    </div>
                <?php endif; ?>
                <?php if($left != '') : ?>
                    <div class="col-md-3 blog-list-right">
                    <?php dynamic_sidebar('sidebar'); ?>
                    </div>
                    <div class="col-md-8 col-md-offset-1">
                    <?php get_template_part('single','content');?>
                    <!-- Blog Right -->
                    </div>
                <?php endif; ?>
                <?php if($right != '') : ?>
                    <div class="col-md-8">
                    <?php get_template_part('single','content');?>
                    <!-- Blog Right -->
                    </div>
                    <div class="col-md-3 col-md-offset-1 blog-list-right">
                    <?php dynamic_sidebar('sidebar'); ?>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- End Blog Singer-->
    </div>
    <!-- ENd Main -->

<?php get_footer(); ?>
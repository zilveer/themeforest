<?php
$post_sidebar_layout=get_post_meta(get_the_ID(), '_cmb_post_sidebar_layout', true);

$sidebar_position = "right";
if($post_sidebar_layout == 'default'){
$sidebar_position=th_theme_data('home_sidebar_position','right');
}elseif($post_sidebar_layout == 'fullwidth'){
$sidebar_position = 'no';
}elseif($post_sidebar_layout == 'sidebar_left'){
$sidebar_position = 'left';
}elseif($post_sidebar_layout == 'sidebar_right'){
$sidebar_position = 'right';
}

if($sidebar_position == "no"){
$page_class="col-lg-12 col-md-12";
}else{
$page_class="col-lg-9";
}
if($sidebar_position == "left"){
$page_class .=' pull-right';
}
?>

<?php get_header(); ?>
    <section style="padding: 50px 0">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h1>
                        <small><?php bloginfo('name')?></small>
                        <br>
                        <strong><?php the_title()?></strong>
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <?php while(have_posts()) : the_post(); ?>
                    <div class="<?php echo esc_attr($page_class); ?>">
                        <?php the_content();
							comments_template(); ?>
                    </div><!-- single-post-wrapper -->
                <?php endwhile; ?>
                <?php if($sidebar_position != "no"){ ?>
                    <div id="sidebar" class="col-lg-3">
                        <?php get_sidebar(); ?>
                    </div><!-- end sidebar -->
                <?php } ?>
            </div>
        </div><!-- end container -->
    </section><!-- end section-single -->
<?php get_footer(); ?>
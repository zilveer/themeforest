<?php
global $zorka_data;
$use_custom_layout = get_post_meta(get_the_ID(),'use-custom-layout',true);

$layout_style = get_post_meta(get_the_ID(),'layout-style',true);
if (!isset($layout_style) || empty($layout_style) || $layout_style == 'none' || $use_custom_layout == '0'){
    $layout_style = $zorka_data['layout-style'];
}

$page_layout = get_post_meta(get_the_ID(),'page-layout',true);
if (!isset($page_layout) || empty($page_layout) || $page_layout == 'none' || $use_custom_layout == '0') {
    $page_layout = $zorka_data['page-layout'];
}
$class_col = 'col-md-12';

if ($page_layout == 'left-sidebar' || $page_layout == 'right-sidebar' ){
    $class_col = 'col-md-9';
}

if ($page_layout == 'left-sidebar') {
    $class_col .= ' col-md-push-3';
}
?>
<?php if ($page_layout == 'full-content'): ?>
    <main role="main" class="site-content">
        <?php
        // Start the Loop.
        while ( have_posts() ) : the_post();
            // Include the page content template.
            get_template_part( 'content', 'page' );
        endwhile;
        ?>
    </main>
<?php else: ?>
    <main role="main" class="site-content site-content-page">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="<?php echo esc_attr($class_col); ?>">
                    <div class="page-content">
                        <?php
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            // Include the page content template.
                            get_template_part( 'content', 'page' );
                        endwhile;
                        ?>
                    </div>
                    <?php comments_template(); ?>
                </div>
                <?php if ($page_layout == 'left-sidebar') :
                    get_sidebar('left');
                endif;
                ?>
                <?php if ($page_layout == 'right-sidebar') :
                    get_sidebar();
                endif;
                ?>
            </div>
        </div>
    </main>
<?php endif; ?>
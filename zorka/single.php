<?php get_header(); ?>
<?php
global $zorka_data,$zorka_archive_loop;
$use_custom_layout = get_post_meta(get_the_ID(),'use-custom-layout',true);
$archive_layout = get_post_meta(get_the_ID(),'page-layout',true);

if (!isset($archive_layout) || empty($archive_layout) || $archive_layout == 'none' || $use_custom_layout == '0') {
    $archive_layout = $zorka_data['post-archive-layout'];
}

$class_col = 'col-md-12';
if ($archive_layout == 'left-sidebar' || $archive_layout == 'right-sidebar' ){
    $class_col = 'col-md-9';
}

if ($archive_layout == 'left-sidebar') {
    $class_col .= ' col-md-push-3';
}

if (get_post_format() == 'audio') {
    wp_enqueue_style( 'zorka-jplayer-pixel-industry', get_template_directory_uri() . '/assets/plugins/jquery.jPlayer/skin/zorka/skin.css', array(), true );
    wp_enqueue_script( 'zorka-jplayer', get_template_directory_uri() . '/assets/plugins/jquery.jPlayer/jquery.jplayer.min.js', array( 'jquery' ), false, true );
}

$page_title_background = get_post_meta(get_the_ID(),'custom-page-title-background',true);

if (empty($page_title_background)) {
    $page_title_background = $zorka_data['page-title-background'];
}
$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
    $header_layout =  $zorka_data['header-layout'];
}

?>
<?php if ((!empty($page_title_background)) && ($header_layout == 4 || $header_layout == 8) && is_home() || is_singular('post')) :
   get_template_part('content','top');
 endif; ?>

<?php zorka_the_breadcrumb();?>
<main role="main" class="site-content-archive">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="<?php echo esc_attr($class_col); ?>">
                <div class="blog-wrapper">
                    <div  class="blog-inner blog-single clearfix">
                        <?php
                        if ( have_posts() ) :
                            // Start the Loop.
                            while ( have_posts() ) : the_post();
                                /*
                                 * Include the post format-specific template for the content. If you want to
                                 * use this in a child theme, then include a file called called content-___.php
                                 * (where ___ is the post format) and that will be used instead.
                                 */
                                get_template_part( 'content', get_post_format() );
                            endwhile;
                        else :
                            // If no content, include the "No posts found" template.
                            get_template_part( 'content', 'none' );
                        endif;
                        ?>
                    </div>
                </div>
                <?php comments_template(); ?>
            </div>
            <?php if ($archive_layout == 'left-sidebar') :
                get_sidebar('left');
            endif;
            ?>
            <?php if ($archive_layout == 'right-sidebar') :
                get_sidebar();
            endif;
            ?>
        </div>
    </div>
</main>


<?php get_footer(); ?>


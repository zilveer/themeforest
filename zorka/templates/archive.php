<?php
global $zorka_data,$zorka_archive_loop;

$archive_layout = $zorka_data['post-archive-layout'];


$class_col = 'col-md-12';

if ($archive_layout == 'left-sidebar' || $archive_layout == 'right-sidebar' ){
    $class_col = 'col-md-9';
}

if ($archive_layout == 'left-sidebar') {
    $class_col .= ' col-md-push-3';
}

$post_archive_paging_style = $zorka_data['post-archive-paging-style'];

wp_enqueue_style( 'zorka-jplayer-pixel-industry', get_template_directory_uri() . '/assets/plugins/jquery.jPlayer/skin/zorka/skin.css', array(), true );
wp_enqueue_script( 'zorka-jplayer', get_template_directory_uri() . '/assets/plugins/jquery.jPlayer/jquery.jplayer.min.js', array( 'jquery' ), '', true );

$page_title_background = get_post_meta(get_the_ID(),'custom-page-title-background',true);

if (empty($page_title_background)) {
    $page_title_background = $zorka_data['page-title-background'];
}
$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
    $header_layout =  $zorka_data['header-layout'];
}

?>
<?php if ((!empty($page_title_background)) && ($header_layout == 4 || $header_layout == 8)) :
    get_template_part('archive','top');
endif; ?>
<?php zorka_the_breadcrumb();?>
<main role="main" class="site-content-archive">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="<?php echo esc_attr($class_col); ?>">
                <div class="blog-wrapper">
                    <div class="blog-inner clearfix">
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
                    <?php
                    global $wp_query;
                    if ( $wp_query->max_num_pages > 1 ) :
                        ?>
                        <div class="blog-paging-wrapper blog-paging-<?php echo esc_attr($post_archive_paging_style); ?>">
                                <?php
                                switch($post_archive_paging_style) {
                                    case 'load-more':
                                        zorka_paging_load_more();
                                        break;
                                    case 'infinite-scroll':
                                        zorka_paging_infinitescroll();
                                        break;
                                    default:
                                        echo zorka_paging_nav();
                                        zorka_paging_load_more();
                                        break;
                                }
                                ?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <?php
                if ($archive_layout == 'left-sidebar') {
                    get_sidebar('left');
                }
                if ($archive_layout == 'right-sidebar') {
                    get_sidebar();
                }
            ?>
        </div>
    </div>
</main>


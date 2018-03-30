<?php
/**
 * The template for displaying Author pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CookingPress
 */
get_header();
$thumbstyle = ot_get_option('pp_blog_style','grid');
?>
<?php if (have_posts()) the_post();
$bloglayout = ot_get_option('pp_blog_layout','left-sidebar');
 switch ($bloglayout) {
    case 'left-sidebar':
        $classes = 'col-md-8 col-md-push-3 col-md-offset-1';
        break;

    case 'right-sidebar':
        $classes = 'col-md-8';
        break;

    default:
        $classes = 'col-md-8 col-md-push-3 col-md-offset-1';
        break;
}
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $bloglayout=='left-sidebar' ) { $classes = 'col-md-9 col-md-push-3'; }
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $bloglayout=='right-sidebar' ) { $classes = 'col-md-9'; }
?>
<div id="primary" class="<?php echo $classes; ?>">
    <header class="page-header">

        <h1 class="page-title">
            <span>
                <?php printf(__('Author Archives: %s', 'cookingpress'), "<a class='url fn n' href='" . get_author_posts_url(get_the_author_meta('ID')) . "' title='" . esc_attr(get_the_author()) . "' rel='me'>" . get_the_author() . "</a>"); ?>
            </span>
        </h1>
        <?php if (get_the_author_meta('description')) : ?>
        <aside id="author-info">
            <div id="author-data">
                <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('cookingpress_author_bio_avatar_size', 85)); ?>
                <h4><?php printf(__('About %s', 'cookingpress'), get_the_author()); ?></h4>
            </div>
            <div id="author-desc"><?php the_author_meta('description'); ?></div>
        </aside>
    <?php endif; ?>

    <?php
    rewind_posts(); ?>
</header><!-- .page-header -->
<div class="<?php echo $thumbstyle; ?>" >
    <?php if ( have_posts() ) : ?>
    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post();
        /* Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        $format = get_post_format();
        $formatslist = array('status','aside','quote','audio','chat','link');
        if( false === $format  )  $format = 'standard';

        if (in_array($format, $formatslist))  $format = 'standard';

        if($thumbstyle == 'full') {
         get_template_part( 'postformats/'.$format , 'full' );
     } else if($thumbstyle == 'excerpt') {
        get_template_part( 'postformats/'.$format , 'excerpt' );
    } else {
        get_template_part( 'postformats/'.$format );
    }
    endwhile;
    else :
        get_template_part( 'no-results', 'index' ); ?>
<?php endif; ?>
</div>
<?php if(function_exists('wp_pagenavi')) {
        wp_pagenavi();
    } else {
        cookingpress_content_nav( 'nav-below' );
    }
?>


</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>


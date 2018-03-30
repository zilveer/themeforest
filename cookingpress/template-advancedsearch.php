<?php
/**
 * Template Name: Advanced Search Page
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage cookingpress
 * @since cookingpress 1.0
 */
get_header();
$layout  = get_post_meta($post->ID, 'pp_sidebar_layout', true); ?>
<?php switch ($layout) {
    case 'full-width':
    $classes = 'col-md-12 ';
    break;

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
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $layout=='left-sidebar' ) { $classes = 'col-md-9 col-md-push-3'; }
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $layout=='right-sidebar' ) { $classes = 'col-md-9'; }
?>
<div id="primary" class="<?php echo $classes; ?>">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php printf('<a href="%1$s" class="published-time" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>', get_permalink(), esc_attr(get_the_time()), get_the_date()); ?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'cookingpress'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php the_content(); ?>
                <?php get_template_part( 'searchformadv' ) ?>
                <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'cookingpress' ),
                    'after'  => '</div>',
                    ) );
                    ?>
                </div><!-- .entry-content -->
                <?php edit_post_link( __( 'Edit', 'cookingpress' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
            </article><!-- #post-## -->


            <?php
                    // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || '0' != get_comments_number() )
                comments_template();
            ?>

        <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php if($layout != 'full-width')  { get_sidebar(); } ?>
<?php get_footer(); ?>
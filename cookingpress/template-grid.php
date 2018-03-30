<?php
/**
 * Template Name: Grid loop Page
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage purepress
 * @since purepress 1.0
 */
get_header();
$thumbstyle = 'grid'; get_template_part('slider');
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
    <div class="<?php echo $thumbstyle; ?>" >
        <?php
        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $temp = $wp_query;
        $wp_query = null;
        $wp_query = new WP_Query();
        $wp_query -> query('post_type=post&showposts='.get_option('posts_per_page').'&paged='.$paged);
        while ($wp_query->have_posts()) : $wp_query->the_post();

        $format = get_post_format();
        $formatslist = array('status','aside','quote','audio','chat','link');
        if( false === $format  )  $format = 'standard';

        if (in_array($format, $formatslist))  $format = 'standard';

        get_template_part( 'postformats/'.$format , 'grid' );

        endwhile;
        ?>
    </div>

    <?php if(function_exists('wp_pagenavi')) {
                wp_pagenavi();
            } else {
                cookingpress_content_nav( 'nav-below' );
            }
    ?>
</div><!-- #primary -->

<?php $wp_query = null; $wp_query = $temp;
get_sidebar();
?>
<?php get_footer(); ?>
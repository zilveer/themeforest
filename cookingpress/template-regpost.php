<?php
/**
* Template Name: Add Recipe by registered user
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
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {

    // Do some minor form validation to make sure there is content

    $hasError = false;

    if (empty($_POST['title'])) {
        $hasError = true;
        $titleError = true;
    }

    $title = $_POST['title'];
    $description = $_POST['description'];
    $summary = $_POST['cookingpresssummary'];

    $tags = $_POST['cookingpressingridients_name'];

    $ingredients = array();
    foreach ($_POST['cookingpressingridients_name'] as $k => $v) {
        $ingredients[] = array(
            'name' => $v,
            'note' => mysql_real_escape_string($_POST['cookingpressingridients_note'][$k]),
            );
    }

    $instructions = $_POST['cookingpressinstructions'];

    if (empty($_POST['cookingpressinstructions']) || $_POST['cookingpressinstructions']==' ') {
        $hasError = true;
        $instructionsError = true;
    }


        $recipeoptions = array(
            mysql_real_escape_string($_POST['cookingpressrecipeoptions_preptime']),
            mysql_real_escape_string($_POST['cookingpressrecipeoptions_cooktime']),
            mysql_real_escape_string($_POST['cookingpressrecipeoptions_yield']),
            );

        $ntfacts = $_POST['cookingpressntfacts'];
        $serving = mysql_real_escape_string($_POST['serving']);
        $level = mysql_real_escape_string($_POST['level']);
        if(isset($_POST['allergens'])) {
            $allergens = $_POST['allergens'];
        }

    // ADD THE FORM INPUT TO $new_post ARRAY
        $new_post = array(
            'post_title'    =>  $title,
            'post_content'  =>  $description,
            'post_category' =>  array($_POST['cat']),  // Usable for custom taxonomies too
            'post_status'   =>  'draft',           // Choose: publish, preview, future, draft, etc.
            'post_type' =>  'post'  //'post',page' or use a custom post type if you want to
            );

    //SAVE THE POST
        if($hasError==false) {
            $pid = wp_insert_post($new_post);

            add_post_meta($pid, 'cookingpressingridients', $ingredients, true);
            add_post_meta($pid, 'cookingpressinstructions', $instructions, true);
            add_post_meta($pid, 'cookingpressrecipeoptions', $recipeoptions, true);
            add_post_meta($pid, 'cookingpressntfacts', $ntfacts, true);
            add_post_meta($pid, 'cookingpresssummary', $summary, true);

        //SET OUR TAGS UP PROPERLY
            wp_set_object_terms($pid, $tags, 'level');
            wp_set_object_terms($pid, $level, 'level');
            wp_set_object_terms($pid, $serving, 'serving');
            if(isset($allergens)) {
                wp_set_object_terms($pid, $allergens, 'allergen');
            }


            do_action('wp_insert_post', 'wp_insert_post');

            $postAdded = true;
        }

    }
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
                    <?php if ( is_user_logged_in() ) {
                        include(locate_template('submitpost.php'));
                    } else {
                        get_template_part( 'loginform');

                    }?>
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
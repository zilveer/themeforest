<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Trizzy
 */

get_header(); ?>
<section class="titlebar">
    <div class="container">
        <div class="sixteen columns">
            <h1><?php the_title(); ?></h1>

            <nav id="breadcrumbs">
                 <?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
            </nav>
        </div>
    </div>
</section>

<!-- Container -->
<div class="container single-team-container">

    <div class="sixteen columns">

        <?php while ( have_posts() ) : the_post();
        $position = get_post_meta($id, 'pp_position', true);
        $social = get_post_meta($id, 'pp_socialicons', true);
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('the-team single'); ?>>
            <div class="eight alpha columns">
                <?php if(has_post_thumbnail()) {
                    $fullimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                    ?>
                <figure class="post-img">
                    <a href="<?php echo $fullimage[0]; ?>" class="mfp-image"><?php the_post_thumbnail();  ?>
                        <div class="hover-icon"></div>
                    </a>
                </figure>
                <?php } ?>
            </div>
            <div class="eight columns omega">
                <section class="the-team-content">
                    <header class="meta">
                        <?php the_title( '<h5 class="entry-title">', '</h5>' ); echo '<i>'.$position.'</i>'; ?>

                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php
                        $output = '';
                        if(!empty($social)){
                            $output .= '<ul class="social-icons the-team-social">';
                            foreach ($social as $icon) {
                                $output .= '<li><a class="'.$icon['icons_service'].' tooltip top" href="'.esc_url($icon['icons_url']).'" title="'.esc_attr($icon['title']).'"><i class="icon-'.$icon['icons_service'].'"></i></a></li>';
                            }
                            $output .= '</ul><div class="clearfix"></div>';
                        }
                        echo $output;
                        ?>
                    </div><!-- .entry-content -->
                </section>
            </div>
            <div class="clearfix"></div>
        </article><!-- #post-## -->

        <?php trizzy_post_nav(); ?>



    <?php endwhile; // end of the loop. ?>

    </div>
</div>


<?php get_footer(); ?>
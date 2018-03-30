<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astrum
 * @since Astrum 1.0
 */

get_header(); ?>
<!-- Titlebar
================================================== -->
<section class="titlebar">
    <div class="container">
      <div class="sixteen columns">
        <h2><?php _e('The Team','trizzy'); ?></h2>
        <nav id="breadcrumbs">
          <?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
        </nav>
      </div>
    </div>
</section>

<!-- Container -->
<div class="container team-container">

<div class="twelve columns">
    <?php if ( have_posts() ) : ?>

        <?php /* Start the Loop */ ?>
        <?php while ( have_posts() ) : the_post();
        $position = get_post_meta($id, 'pp_position', true);
        $social = get_post_meta($id, 'pp_socialicons', true);
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('the-team post'); ?>>
            <div class="six alpha columns">
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
            <div class="six columns omega">
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
        </article><!-- #post-## -->
    <div class="clearfix"></div>
    <?php endwhile; ?>
    <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>
        <div class="clearfix"></div>

        <!-- Pagination -->
        <div class="pagination-container">
            <?php if(function_exists('wp_pagenavi')) { ?>
            <nav class="pagination">
                 <?php wp_pagenavi(); ?>
            </nav>
            <?php
            } else {
            if ( get_next_posts_link() ||  get_previous_posts_link() ) : ?>
            <nav class="pagination-next-prev">
                <ul>
                    <?php if ( get_previous_posts_link() ) : ?>
                        <li><?php previous_posts_link( ' '); ?></li>
                    <?php  endif; ?>
                    <?php if ( get_next_posts_link() ) : ?>
                        <li><?php next_posts_link(' '); ?></li>
                        <!-- <li><a href="#" class="next"></a></li> -->
                     <?php endif; ?>
                </ul>
            </nav>
           <?php endif;
           } ?>
        </div>


</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

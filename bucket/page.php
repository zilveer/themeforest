<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 */

get_header(); ?>

<div class="container container--main">

    <div class="grid">

        <?php 

        // let's get to know this post a little better
        $full_width_featured_image = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_full_width_featured_image', true);
        $disable_sidebar = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_disable_sidebar', true);

        // let's use what we know
        $the_content_width = $disable_sidebar == 'on' ? 'one-whole' : 'lap-and-up-two-thirds';
        $featured_image_width = ($full_width_featured_image == 'on' || $disable_sidebar == 'on') ? 'one-whole' : 'two-thirds  palm-and-up-one-whole';
        ?>

        <?php get_template_part('theme-partials/post-templates/header-single', get_post_format()); ?>

        <div class="grid__item  main  float--left  <?php echo $the_content_width; ?>">

            <?php while (have_posts()): the_post(); ?>
                <article <?php post_class(); ?>>
                <h1 class="article__title  article__title--single"><?php the_title(); ?></h1>
                <?php
		        the_content();

	            $args = array(
		            'before' => "<ol class=\"nav pagination\"><!--",
		            'after' => "\n--></ol>",
		            'next_or_number' => 'next_and_number',
		            'previouspagelink' => __('Previous', 'bucket'),
		            'nextpagelink' => __('Next', 'bucket')
	            );
	            wp_link_pages( $args ); ?>

                <hr class="separator  separator--section">
				
                <?php
                // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                ?>
                </article>
            <?php endwhile; ?>

        </div><!--
        
        <?php if ($disable_sidebar != 'on'): ?>
         --><div class="grid__item  one-third  palm-one-whole  sidebar">
                <?php get_sidebar(); ?>
            </div>
        <?php else: // ugly ?>
         -->
        <?php endif; ?>

    </div>

</div>
    
<?php get_footer(); ?>
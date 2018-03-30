<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package News Stand
 */

get_header(); ?>

<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

<div class="contact-block hasMap">

    <div class="container">
    	<?php if (has_post_thumbnail()): ?>
    		<div id="contact-map" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"></div>
    	<?php else: ?>
    		<div id="contact-map" style="height: 150px; background-color: #ddd;"></div>
    	<?php endif ?>


        <div class="contact-content">
            <div class="cc-title"><?php the_title(); ?></div>
            <div class="cc-content">
                <div class="whitepart">
                    <?php while(have_posts()): the_post();?>
                    	<?php the_content(); ?>
                    <?php endwhile; ?>

                    <?php
                    	if (comments_open() || get_comments_number()) { ?>
                    		<div class="styled-comments">
                    			<?php comments_template(); ?>
                    		</div>
                    	<?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

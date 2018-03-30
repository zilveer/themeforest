<?php get_header(); ?>
<!--Start Top Section -->

<div class="subsection fullwidth">
    <div class="pagename">
        <h3 class="alignleft">
        <?php _e('Page Not Found', 'framework'); ?><span><?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?></span>
        </h3>
        <div class="clear"></div>
    </div>
    <div class="subheading">
        <div class="subcontainer full">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
            <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
            <?php endwhile; else :?>
            <!-- Else nothing found -->
<h2><?php _e('Error 404 - Not found.', 'framework'); ?></h2>
            <p><?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?></p>
            <?php include('searchform.php'); ?>
            <br />
            <!--BEGIN .navigation .page-navigation -->
            <?php endif; ?>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>

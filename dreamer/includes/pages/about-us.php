<!-- About Us Page -->
<div class="page-container pattern-1" id="about-us">
    <div class="row">
        <div class="twelve columns page-content">
            <h1 class="page-title"><?php global $smof_data; $dreamer_about_page_title = $smof_data['about_page_title']; echo $dreamer_about_page_title ?></h1>
            <h2 class="page-subtitle"><?php global $smof_data; $dreamer_about_page_description = $smof_data['about_page_description']; echo $dreamer_about_page_description ?></h2>
        </div>
		<?php $args = array('post_type' => 'about-us','paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),); query_posts($args); while (have_posts()) : the_post(); ?>
        <div class="four columns about mobile-three-one">
            <?php the_post_thumbnail('about-thumbnail'); ?> 
            <h3 class="about-us-title"><?php the_title(); ?></h3>
            <div class="about-us-text"><?php the_content(); ?></div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
<?php wp_reset_query(); ?>
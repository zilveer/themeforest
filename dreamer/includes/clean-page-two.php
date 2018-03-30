
<div class="page-container pattern-1" id="about-us">
    <div class="row" id="clean-page-two">

    <?php

    global $smof_data; //fetch options stored in $smof_data

    //fetch first page data
    $dreamer_content_page = $smof_data['second_content_page'];
    $dreamer_page_id = smof_get_ID_by_page_name($dreamer_content_page); ?>

        <?php query_posts('page_id=' .$dreamer_page_id). '' ?>
        <?php while (have_posts()) : the_post(); ?>



        <div class="twelve columns clean-page-content page-content">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>

        <div class="twelve columns about mobile-three-one">
            <div class="about-us-text"><?php the_content(); ?></div>
        </div>

        <?php endwhile; ?>

    </div>
</div>

<?php wp_reset_query(); ?>
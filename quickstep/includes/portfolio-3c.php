<div class="row">

    <?php if (qs_get_meta('qs_remove_page_title', get_the_ID()) != '1') { ?>
        <header class="twelve columns entry-title">
            <h1 class="">  
                <?php
                $page_title = qs_get_meta('qs_page_title', get_the_ID()) ? qs_get_meta('qs_page_title', get_the_ID()) : get_the_title();
                echo $page_title;
                ?>
            </h1>
            <h2 class="subtitle"><?php echo qs_get_meta('qs_page_subtitle', get_the_ID()); ?></h2>
        </header>
    <?php } ?>

    <section class="twelve columns">

        <div id="portfolio-loader" class="twelve columns"><span id="portfolio-close"></span><div class="content"></div></div>

        <ul id="filter" class="filter clearfix" data-option-key="filter">
            <li><a href="#" class="all" data-filter="*" ><?php _e('All', 'qs_framework'); ?></a></li>

            <?php
            // Get the taxonomy
            $terms = get_terms('filter');
            $count = count($terms);
            $i = 0;

            // test if the count has any categories
            if ($count > 0) {

                // break each of the categories into individual elements
                $term_list = '';
                foreach ($terms as $term) {

                    $i++;
                    $term_list .= '<li><a href="javascript:void(0)" data-filter=".' . $term->slug . '">' . $term->name . '</a></li>';

                    if ($count != $i) {
                        $term_list .= '';
                    } else {
                        $term_list .= '';
                    }
                }


                echo $term_list;
            }
            ?>
        </ul>


        <div id="portfolio-container" class="portfolio3c">


<?php
// Set the page to be pagination
$paged = get_query_var('paged') ? get_query_var('paged') : 1;


$args = array(
    'post_type' => 'portfolio',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'posts_per_page' => '100',
);


$portfolio = get_posts($args);


foreach ($portfolio as $project) : setup_postdata($project);
    ?>


                <?php
                // Get The Taxonomy 'Filter' Categories
                $terms = get_the_terms($project->ID, 'filter');
                ?>

                <?php
                $large_image = wp_get_attachment_image_src(get_post_thumbnail_id($project->ID), 'full');
                ?>


                <div data-id="id-<?php echo $count; ?>" class="element <?php if ($terms) foreach ($terms as $term) {
                    echo $term->slug . ' ';
                } ?>">



    <?php // Output the featured image  ?>
                    <?php $prettyphoto_enabled = of_get_option('qs_portfolio_prettyphoto'); ?>
                    <?php if ($prettyphoto_enabled == '1') : ?>
                        <a rel="prettyPhoto[gallery]" href="<?php echo $large_image[0] ?>">
                    <?php else: ?>
                            <a class="portfolio-link" href="<?php echo get_permalink($project->ID);
                ; ?>">
                            <?php endif; ?>

                            <?php $src = wp_get_attachment_image_src(get_post_thumbnail_id($project->ID), 'portfolio3c'); ?>
                            <img src="<?php echo $src[0]; ?>" class="portfolio-image" alt="<?php echo $project->post_title; ?>" />

                            </a>							



                        <?php // Output the title of each portfolio item  ?>
                        <div class="caption">
                            <h4 class="project-title"><a class="portfolio-link" href="<?php echo get_permalink($project->ID);
                        ; ?>"><?php echo $project->post_title; ?></a></h4>
                            <br /><br />
                            <span class="project-desc">
                                <?php echo qs_get_meta('qs_project_description', $project->ID); ?>
                            </span>
                        </div>

                </div>

                <?php $count++; // Increase the count by 1 ?>		
            <?php endforeach;
            wp_reset_postdata(); ?>

        </div>

        <div class="entry-content">

            <?php
            the_content();

            edit_post_link(__('Edit', 'qs_framework'), '<span class="edit-link">', '</span>')
            ?>

<?php comments_template(); // calling the comments template ?>

        </div>

    </section>

</div>
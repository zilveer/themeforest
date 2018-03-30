<!-- Our Services Page -->
<div class="page-container pattern-1" id="services">

	<div class="row">
        <div class="twelve columns page-content">
        <h1 class="page-title"><?php global $smof_data; $dreamer_services_page_title = $smof_data['services_page_title']; echo $dreamer_services_page_title ?></h1>
        <h2 class="page-subtitle"><?php global $smof_data; $dreamer_services_page_description = $smof_data['services_page_description']; echo $dreamer_services_page_description ?></h2>
        </div>
    </div>
    
    <div class="row services-wide-banner">
    	<div class="twelve columns"><img src="<?php global $smof_data; $dreamer_services_banner_image = $smof_data['services_banner_image']; echo $dreamer_services_banner_image ?>" alt="<?php global $smof_data; $dreamer_services_page_title = $smof_data['services_page_title']; echo $dreamer_services_page_title ?>"></div>
    </div>
    
    <div class="row">
    	<div class="twelve columns services-top">
        	<?php
                                     $args = array(
                                        'post_type' => 'services',
                                        'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
                                    );

                                    query_posts($args);

                                    while (have_posts()) : the_post();
                                ?>
            <div class="four columns services first-column mobile-two">
                <h3 class="services-title"><?php the_title(); ?></h3>
                    <div class="services-image">
                        <div class="services-divider-top"></div>
                        <?php the_post_thumbnail('services-thumbnail'); ?> 
                        <div class="services-divider-bottom"></div>
                    </div>
                <p class="services-text"><?php echo get_the_content(); ?></p>
            </div>
            <?php endwhile; ?>
        </div>
	</div>
</div>


<?php wp_reset_query(); ?>
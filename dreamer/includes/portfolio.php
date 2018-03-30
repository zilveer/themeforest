<?php global $smof_data; ?>

<!-- Our Portfolio Page -->
<div class="page-container pattern-2" id="portfolio">

    <div class="row">

        <div class="twelve columns page-content">
            <h1 class="page-title">
                <?php $dreamer_portfolio_page_title=$smof_data[ 'portfolio_page_title']; echo $dreamer_portfolio_page_title ?>
            </h1>
            <h2 class="page-subtitle">
                <?php $dreamer_portfolio_page_description=$smof_data[ 'portfolio_page_description']; echo $dreamer_portfolio_page_description ?>
            </h2>
        </div>

        <div class="twelve columns portfolio-filter hide-for-760">
            <ul id="portfolio-filter" class="filterOptions clear-fix">

                <li class="active">
                    <a href="#" data-filter="*">
                        <span>All Projects</span>
                    </a>
                </li>

                <?php $args=array( 'post_type'=>'portfolios', 'posts_per_page' => 100 ); $loop = new WP_Query( $args ); while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <?php $terms=get_the_terms($post->id,"project-type"); $project_cats = NULL; if ( !empty($terms) ){ foreach ( $terms as $term ) { $project_cats .= strtolower($term->name) . ' '; } } ?>

                <li>
                    <a href="#" data-filter=".<?php echo $term->slug ?>">
                        <span>
                            <?php echo $term->name; ?></span>
                    </a>
                </li>

                <?php endwhile; ?>



            </ul>
        </div>

        <div class="twelve columns portfolio">
            <ul id="portfolio-list" class="ourHolder portfolioHolder">

                <?php $args=array( 'post_type'=>'portfolios', 'posts_per_page' => 100 ); $loop = new WP_Query( $args ); while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <?php $terms=get_the_terms($post->id,"project-type"); $project_cats = NULL; if ( !empty($terms) ){ foreach ( $terms as $term ) { $project_cats .= strtolower($term->name) . ' '; } } ?>

                <li class="item mobile-two <?php echo $term->slug ?>" data-id="id-1">
                    <div class="portfolio-item">
                        <div class="portfolio-cat-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/
images/icons/40px/white/96.png" alt="Portfolio Category Image">
                        </div>
                        <div class="portfolio-hover-details hide-for-small">
                            <div class="open-portfolio">
                                <a href="<?php $image_id = get_post_thumbnail_id();
                      $image_url = wp_get_attachment_image_src($image_id,'large', true);
                      echo $image_url[0];  ?>" class="open-portfolio-large" rel="prettyPhoto"></a>
                                <a href="<?php the_permalink(); ?>" class="open-portfolio-link"></a>
                            </div>
                        </div>
                        <a href="<?php $image_id = get_post_thumbnail_id();
                      $image_url = wp_get_attachment_image_src($image_id,'large', true);
                      echo $image_url[0];  ?>" class="photo-link" rel="prettyPhoto">
                            <?php if(has_post_thumbnail()) { the_post_thumbnail( 'portfolio-thumbnail'); }?>
                        </a>
                        <div class="portfolio-details">
                            <h4 class="portfolio-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <div class="portfolio-divider"></div>
                            <p class="portfolio-categories">
                                <?php echo $term->slug ?></p>
                        </div>
                    </div>
                </li>


                <?php endwhile; ?>



            </ul>
        </div>

    </div>
</div>



<?php wp_reset_query(); ?>
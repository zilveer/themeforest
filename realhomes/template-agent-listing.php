<?php
/*
*   Template Name: Agent Listing Template
*/
get_header();
?>

        <!-- Page Head -->
        <?php get_template_part("banners/default_page_banner"); ?>

        <!-- Content -->
        <div class="container contents listing-grid-layout">

            <div class="row">

                <div class="span9 main-wrap">

                    <!-- Main Content -->
                    <div class="main">

                        <section class="listing-layout">
                            <?php
                            $title_display = get_post_meta( $post->ID, 'REAL_HOMES_page_title_display', true );
                            if( $title_display != 'hide' ){
                                ?>
                                <h3 class="title-heading"><?php the_title(); ?></h3>
                                <?php
                            }
                            ?>

                            <div class="list-container">
                                <?php
                                $number_of_posts = intval(get_option('theme_number_posts_agent'));
                                if(!$number_of_posts){
                                    $number_of_posts = 3;
                                }

                                $agents_query = array(
                                                    'post_type' => 'agent',
                                                    'posts_per_page' => $number_of_posts,
                                                    'paged' => $paged
                                                );

                                $agent_listing_query = new WP_Query( $agents_query );

                                if ( $agent_listing_query->have_posts() ) :
                                    while ( $agent_listing_query->have_posts() ) :
                                        $agent_listing_query->the_post();
                                        ?>
                                        <article class="about-agent clearfix">
                                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                                <div class="row-fluid">

                                                    <div class="span3">
                                                        <?php
                                                        if(has_post_thumbnail()){
                                                            ?>
                                                            <figure class="agent-pic">
                                                                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                                                    <?php the_post_thumbnail('agent-image'); ?>
                                                                </a>
                                                            </figure>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="span9">

                                                        <div class="agent-content">
                                                            <p><?php framework_excerpt(45); ?></p>
                                                        </div>

                                                        <?php
                                                        /* Agent Contact Info */
                                                        $agent_mobile = get_post_meta($post->ID, 'REAL_HOMES_mobile_number',true);
                                                        $agent_office_phone = get_post_meta($post->ID, 'REAL_HOMES_office_number',true);
                                                        $agent_office_fax = get_post_meta($post->ID, 'REAL_HOMES_fax_number',true);

                                                        if( !empty( $agent_office_phone ) || !empty( $agent_mobile ) || !empty( $agent_office_fax ) ) {
                                                            ?>
                                                            <ul class="contacts-list">
                                                                <?php
                                                                if(!empty($agent_office_phone)){
                                                                    ?><li class="office"><?php include( get_template_directory() . '/images/icon-phone.svg' ); _e('Office', 'framework'); ?> : <?php echo $agent_office_phone; ?></li><?php
                                                                }
                                                                if(!empty($agent_mobile)){
                                                                    ?><li class="mobile"><?php include( get_template_directory() . '/images/icon-mobile.svg' ); _e('Mobile', 'framework'); ?> : <?php echo $agent_mobile; ?></li><?php
                                                                }
                                                                if(!empty($agent_office_fax)){
                                                                    ?><li class="fax"><?php include( get_template_directory() . '/images/icon-printer.svg' ); _e('Fax', 'framework'); ?>  : <?php echo $agent_office_fax; ?></li><?php
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?php
                                                        }
                                                        ?>

                                                    </div>

                                                </div><!-- end of .row-fluid -->

                                            <div class="follow-agent clearfix">
                                                <a class="real-btn btn" href="<?php the_permalink(); ?>"><?php _e('More Details','framework'); ?></a>
                                                <?php

                                                $facebook_url = get_post_meta($post->ID, 'REAL_HOMES_facebook_url',true);
                                                $twitter_url = get_post_meta($post->ID, 'REAL_HOMES_twitter_url',true);
                                                $google_plus_url = get_post_meta($post->ID, 'REAL_HOMES_google_plus_url',true);
                                                $linked_in_url = get_post_meta($post->ID, 'REAL_HOMES_linked_in_url',true);

                                                if(!empty($facebook_url) || !empty($twitter_url) || !empty($google_plus_url) || !empty($linked_in_url)){
                                                    ?>
                                                    <!-- Agent's Social Navigation -->
                                                    <ul class="social_networks clearfix">
                                                        <?php
                                                        if(!empty($facebook_url)){
                                                            ?>
                                                            <li class="facebook">
                                                                <a target="_blank" href="<?php echo $facebook_url; ?>"><i class="fa fa-facebook fa-lg"></i></a>
                                                            </li>
                                                            <?php
                                                        }
                                                        if(!empty($twitter_url)){
                                                            ?>
                                                            <li class="twitter">
                                                                <a target="_blank" href="<?php echo $twitter_url; ?>" ><i class="fa fa-twitter fa-lg"></i></a>
                                                            </li>
                                                            <?php
                                                        }
                                                        if(!empty($linked_in_url)){
                                                            ?>
                                                            <li class="linkedin">
                                                                <a target="_blank" href="<?php echo $linked_in_url; ?>"><i class="fa fa-linkedin fa-lg"></i></a>
                                                            </li>
                                                            <?php
                                                        }

                                                        if(!empty($google_plus_url)){
                                                            ?>
                                                            <li class="gplus">
                                                                <a target="_blank" href="<?php echo $google_plus_url; ?>"><i class="fa fa-google-plus fa-lg"></i></a>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                ?>
                                            </div>

                                        </article>
                                        <?php
                                    endwhile;
                                    wp_reset_query();
                                else:
                                    ?>
                                    <h4><?php _e('Sorry No Results Found', 'framework') ?></h4>
                                <?php
                                endif;
                                ?>
                            </div>

                            <?php theme_pagination( $agent_listing_query->max_num_pages); ?>

                        </section>

                    </div><!-- End Main Content -->

                </div> <!-- End span9 -->

                <?php get_sidebar('pages'); ?>

            </div><!-- End contents row -->

        </div><!-- End Content -->

<?php get_footer(); ?>
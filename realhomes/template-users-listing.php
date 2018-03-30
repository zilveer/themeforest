<?php
/*
*   Template Name: Users Listing Template
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
                                ?><h3 class="title-heading"><?php the_title(); ?></h3><?php
                            }
                            ?>

                            <div class="list-container">
                                <?php
                                // Number of users to display based on number of agents from theme options
                                $number_of_posts = intval( get_option( 'theme_number_posts_agent' ) );
                                if(!$number_of_posts){
                                    $number_of_posts = 3;
                                }

                                //$paged variable
                                $paged = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;

                                // offset for users query
                                $offset = 0;
                                if( $paged > 1 ) {
                                    $offset = $number_of_posts * ( $paged - 1 );
                                }

                                // users query arguments
                                $users_args = array(
                                    'number' => $number_of_posts,
                                    'offset' => $offset
                                );

                                // Users Query
                                $user_query = new WP_User_Query( $users_args );

                                if ( $user_query->results ) :
                                    // users loop
                                    foreach ( $user_query->results as $user ) :
                                        // get user meta
                                        $user_meta = get_user_meta( $user->ID );
                                        $author_page_url = get_author_posts_url( $user->ID );
                                        ?>
                                        <article class="about-agent clearfix">

                                            <!-- user name -->
                                            <h4><a href="<?php echo $author_page_url; ?>"><?php echo $user->display_name; ?></a></h4>

                                            <div class="row-fluid">

                                                <div class="span3">
                                                    <?php
                                                    // User Profile Image
                                                    if( isset( $user_meta['profile_image_id'] ) ) {
                                                        $profile_image_id = intval( $user_meta['profile_image_id'][0] );
                                                        if ( $profile_image_id ) {
                                                            ?>
                                                            <!-- user profile image -->
                                                            <figure class="agent-pic">
                                                                <a title="<?php $user->display_name; ?>" href="<?php echo $author_page_url; ?>">
                                                                    <?php echo wp_get_attachment_image( $profile_image_id, 'agent-image' ); ?>
                                                                </a>
                                                            </figure>
                                                        <?php
                                                        }
                                                    } else if( function_exists( 'get_avatar' ) ) {
                                                        ?>
                                                        <!-- user avatar -->
                                                        <figure class="agent-pic">
                                                            <a title="<?php $user->display_name; ?>" href="<?php echo $author_page_url; ?>">
                                                                <?php echo get_avatar( $user->user_email, '180' ); ?>
                                                            </a>
                                                        </figure>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>


                                                <div class="span9">

                                                    <div class="agent-content">
                                                        <?php
                                                        // Author Description
                                                        if( isset( $user_meta['description'] ) ) {
                                                            echo '<p>';
                                                            echo get_framework_custom_excerpt( $user_meta['description'][0], 45 );
                                                            echo '</p>';
                                                        }
                                                        ?>
                                                    </div>

                                                    <?php
                                                    // Author Contact Info
                                                    if( isset( $user_meta['mobile_number'] ) || isset( $user_meta['office_number'] ) || isset( $user_meta['fax_number'] ) ){
                                                        ?>
                                                        <ul class="contacts-list">
                                                            <?php
                                                            if ( !empty( $user_meta['office_number'][0] ) ) {
                                                                ?><li class="office"><?php include( get_template_directory() . '/images/icon-phone.svg' ); _e('Office', 'framework'); ?> : <?php echo $user_meta['office_number'][0]; ?></li><?php
                                                            }
                                                            if ( !empty( $user_meta['mobile_number'][0] ) ) {
                                                                ?><li class="mobile"><?php include( get_template_directory() . '/images/icon-mobile.svg' ); _e('Mobile', 'framework'); ?> : <?php echo $user_meta['mobile_number'][0]; ?></li><?php
                                                            }
                                                            if( !empty( $user_meta['fax_number'][0] ) ) {
                                                                ?><li class="fax"><?php include( get_template_directory() . '/images/icon-printer.svg' ); _e('Fax', 'framework'); ?>  : <?php echo $user_meta['fax_number'][0]; ?></li><?php
                                                            }
                                                            ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                    ?>

                                                </div>

                                            </div>

                                            <div class="follow-agent clearfix">
                                                <a class="real-btn btn" href="<?php  echo $author_page_url; ?>"><?php _e('More Details','framework'); ?></a>
                                                <?php
                                                // Author social links
                                                if( isset( $user_meta['facebook_url'] ) || isset( $user_meta['twitter_url'] ) || isset( $user_meta['google_plus_url'] ) || isset( $user_meta['linkedin_url'] ) ) {
                                                    ?>
                                                    <!-- Agent's Social Navigation -->
                                                    <ul class="social_networks clearfix">
                                                        <?php
                                                        if( !empty( $user_meta['facebook_url'][0] ) ) {
                                                            ?>
                                                            <li class="facebook">
                                                                <a target="_blank" href="<?php echo $user_meta['facebook_url'][0]; ?>"><i class="fa fa-facebook fa-lg"></i></a>
                                                            </li>
                                                            <?php
                                                        }

                                                        if( !empty( $user_meta['twitter_url'][0] ) ) {
                                                            ?>
                                                            <li class="twitter">
                                                                <a target="_blank" href="<?php echo $user_meta['twitter_url'][0]; ?>" ><i class="fa fa-twitter fa-lg"></i></a>
                                                            </li>
                                                            <?php
                                                        }

                                                        if( !empty( $user_meta['linkedin_url'][0] ) ) {
                                                            ?>
                                                            <li class="linkedin">
                                                                <a target="_blank" href="<?php echo $user_meta['linkedin_url'][0]; ?>"><i class="fa fa-linkedin fa-lg"></i></a>
                                                            </li>
                                                            <?php
                                                        }

                                                        if( !empty( $user_meta['google_plus_url'][0] ) ) {
                                                            ?>
                                                            <li class="gplus">
                                                                <a target="_blank" href="<?php echo $user_meta['google_plus_url'][0]; ?>"><i class="fa fa-google-plus fa-lg"></i></a>
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
                                    endforeach;
                                else:
                                    ?><h4><?php _e( 'No Users Found!', 'framework' ) ?></h4><?php
                                endif;
                                ?>
                            </div>

                            <?php
                            // users pagination
                            $total_user = $user_query->total_users;
                            $total_pages = ceil( $total_user / $number_of_posts );
                            inspiry_users_pagination( $total_pages );
                            ?>

                        </section>

                    </div><!-- End Main Content -->

                </div><!-- End span9 -->

                <?php get_sidebar('pages'); ?>

            </div><!-- End contents row -->

        </div><!-- End Content -->

<?php get_footer(); ?>
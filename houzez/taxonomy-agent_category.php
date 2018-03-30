<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 04/10/16
 * Time: 12:42 AM
 * Since v1.4.0
 */
get_header();

global $post, $taxonomy_title, $taxonomy_name, $houzez_local;
$sticky_sidebar = houzez_option('sticky_sidebar');
// Title
$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$taxonomy_title = $current_term->name;
$sticky_sidebar = houzez_option('sticky_sidebar');
$taxonomy_name = get_query_var( 'taxonomy' );
?>

    <div class="page-title breadcrumb-top">
        <div class="row">
            <div class="col-sm-12">
                <?php get_template_part( 'inc/breadcrumb' ); ?>
                <div class="page-title-left">
                    <h2><?php echo esc_attr( $taxonomy_title ); ?></h2>
                </div>
                <div class="page-title-right">
                </div>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 list-grid-area container-contentbar">
        <div id="content-area">


            <!--start featured property items-->
            <?php
            global $wp_query, $paged;
            if ( is_front_page()  ) {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }

            ?>
            <div class="agent-listing">

                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        $agent_position = get_post_meta( get_the_ID(), 'fave_agent_position', true );
                        $agent_company = get_post_meta( get_the_ID(), 'fave_agent_company', true );
                        $agent_mobile = get_post_meta( get_the_ID(), 'fave_agent_mobile', true );
                        $agent_office_num = get_post_meta( get_the_ID(), 'fave_agent_office_num', true );
                        $agent_fax = get_post_meta( get_the_ID(), 'fave_agent_fax', true );
                        $agent_email = get_post_meta( get_the_ID(), 'fave_agent_email', true );
                        $des = get_post_meta( get_the_ID(), 'fave_agent_des', true );

                        $agent_mobile_call = str_replace(array('(',')',' ','-'),'', $agent_mobile);
                        $agent_office_call = str_replace(array('(',')',' ','-'),'', $agent_office_num);

                        $agent_facebook = get_post_meta( get_the_ID(), 'fave_agent_facebook', true );
                        $agent_twitter = get_post_meta( get_the_ID(), 'fave_agent_twitter', true );
                        $agent_linkedin = get_post_meta( get_the_ID(), 'fave_agent_linkedin', true );
                        $agent_googleplus = get_post_meta( get_the_ID(), 'fave_agent_googleplus', true );
                        $agent_youtube = get_post_meta( get_the_ID(), 'fave_agent_youtube', true );
                        $agent_pinterest = get_post_meta( get_the_ID(), 'fave_agent_pinterest', true );
                        $agent_instagram = get_post_meta( get_the_ID(), 'fave_agent_instagram', true );
                        $agent_vimeo = get_post_meta( get_the_ID(), 'fave_agent_vimeo', true );
                        ?>

                        <div class="profile-detail-block">
                            <div class="media">
                                <div class="media-left">
                                    <figure>
                                        <?php
                                        if( has_post_thumbnail( $post->ID ) ) {
                                            ?>
                                            <a href="#">
                                                <?php
                                                the_post_thumbnail( 'houzez-image350_350' );
                                                ?>
                                            </a>
                                            <?php
                                        }else{
                                            ?>
                                            <a href="#">
                                                <?php
                                                houzez_image_placeholder( 'houzez-image350_350' );
                                                ?>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </figure>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block hidden-xs"><?php echo $houzez_local['view_my_prop']; ?></a>
                                </div>
                                <div class="media-body">
                                    <div class="profile-description">
                                        <h2 class="agent-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <p class="position">
                                            <?php
                                            if( !empty( $agent_position) ) { echo esc_attr( $agent_position ).' '; }

                                            if( !empty( $agent_company) ) {
                                                echo $houzez_local['at_text'];
                                                echo ' ' . esc_attr( $agent_company );
                                            }
                                            ?>
                                        </p>
                                        <p><?php echo wp_kses_post( $des ); ?></p>
                                        <ul class="profile-contact">
                                            <?php if( !empty($agent_office_num) ) { ?>
                                                <li><span><?php echo $houzez_local['office_colon']; ?></span> <a href="tel:<?php echo esc_attr( $agent_office_call ); ?>"><?php echo esc_attr( $agent_office_num ); ?></a></li>
                                            <?php } ?>

                                            <?php if( !empty( $agent_mobile ) ) { ?>
                                                <li><span><?php echo $houzez_local['mobile_colon']; ?></span> <a href="tel:<?php echo esc_attr( $agent_mobile_call ); ?>"><?php echo esc_attr( $agent_mobile ); ?></a></li>
                                            <?php } ?>

                                            <?php if( !empty( $agent_fax ) ) { ?>
                                                <li><span><?php echo $houzez_local['fax_colon']; ?></span> <a><?php echo esc_attr( $agent_fax ); ?></a></li>
                                            <?php } ?>

                                            <?php if( !empty( $agent_email ) ) { ?>
                                                <li class="email"><span><?php echo $houzez_local['email_colon']; ?></span> <a href="mailto:<?php echo esc_attr( $agent_email ); ?>"><?php echo esc_attr( $agent_email ); ?></a></li>
                                            <?php } ?>

                                        </ul>
                                        <ul class="profile-social">
                                            <?php if( !empty( $agent_mobile ) ) { ?>
                                                <li><a href="#"><i class="fa fa-phone-square"></i></a></li>
                                            <?php } ?>

                                            <?php if( !empty( $agent_facebook ) ) { ?>
                                                <li><a class="btn-facebook" href="<?php echo esc_url( $agent_facebook ); ?>" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                                            <?php } ?>

                                            <?php if( !empty( $agent_twitter ) ) { ?>
                                                <li><a class="btn-twitter" href="<?php echo esc_url( $agent_twitter ); ?>" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                                            <?php } ?>

                                            <?php if( !empty( $agent_linkedin ) ) { ?>
                                                <li><a class="btn-linkedin" href="<?php echo esc_url( $agent_linkedin ); ?>" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
                                            <?php } ?>

                                            <?php if( !empty( $agent_googleplus ) ) { ?>
                                                <li><a class="btn-google-plus" href="<?php echo esc_url( $agent_googleplus ); ?>" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
                                            <?php } ?>

                                            <?php if( !empty( $agent_youtube ) ) { ?>
                                                <li><a class="btn-youtube" href="<?php echo esc_url( $agent_youtube ); ?>" target="_blank"><i class="fa fa-youtube-square"></i></a></li>
                                            <?php } ?>

                                            <?php if( !empty( $agent_instagram ) ) { ?>
                                                <li><a class="btn-instagram" href="<?php echo esc_url( $agent_instagram ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                            <?php } ?>

                                            <?php if( !empty( $agent_pinterest ) ) { ?>
                                                <li><a class="btn-pinterest" href="<?php echo esc_url( $agent_pinterest ); ?>" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>
                                            <?php } ?>

                                            <?php if( !empty( $agent_vimeo ) ) { ?>
                                                <li><a class="btn-vimeo" href="<?php echo esc_url( $agent_vimeo ); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
                                            <?php } ?>

                                        </ul>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block visible-xs"><?php echo $houzez_local['view_my_prop']; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    ?>
                    <h4><?php esc_html_e('Sorry No Result Found', 'houzez') ?></h4>
                    <?php
                endif;
                ?>

            </div>

            <hr>

            <!--start Pagination-->
            <?php houzez_pagination( $wp_query->max_num_pages, $range = 2 ); ?>
            <!--start Pagination-->

        </div>
    </div><!-- end container-content -->

    <div class="col-lg-4 col-md-4 col-sm-6 col-md-offset-0 col-sm-offset-3 container-sidebar <?php if( $sticky_sidebar['agent_sidebar'] != 0 ){ echo 'houzez_sticky'; }?>">
        <?php get_sidebar('houzez_agents'); ?>
    </div> <!-- end container-sidebar -->
</div>
<?php
get_footer();
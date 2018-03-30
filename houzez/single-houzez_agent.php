<?php
get_header();

global $post, $houzez_local;
$post_meta_data  = get_post_custom($post->ID);
$agent_position = get_post_meta( get_the_ID(), 'fave_agent_position', true );
$agent_company = get_post_meta( get_the_ID(), 'fave_agent_company', true );
$agent_mobile = get_post_meta( get_the_ID(), 'fave_agent_mobile', true );
$agent_office_num = get_post_meta( get_the_ID(), 'fave_agent_office_num', true );
$agent_fax = get_post_meta( get_the_ID(), 'fave_agent_fax', true );
$agent_email = get_post_meta( get_the_ID(), 'fave_agent_email', true );

$agent_mobile_call = str_replace(array('(',')',' ','-'),'', $agent_mobile);
$agent_office_call = str_replace(array('(',')',' ','-'),'', $agent_office_num);

$agent_facebook = get_post_meta( get_the_ID(), 'fave_agent_facebook', true );
$agent_twitter = get_post_meta( get_the_ID(), 'fave_agent_twitter', true );
$agent_linkedin = get_post_meta( get_the_ID(), 'fave_agent_linkedin', true );
$agent_googleplus = get_post_meta( get_the_ID(), 'fave_agent_googleplus', true );
$agent_pinterest = get_post_meta( get_the_ID(), 'fave_agent_pinterest', true );
$agent_instagram = get_post_meta( get_the_ID(), 'fave_agent_instagram', true );
$agent_vimeo = get_post_meta( get_the_ID(), 'fave_agent_vimeo', true );
$agent_youtube = get_post_meta( get_the_ID(), 'fave_agent_youtube', true );
$agent_company_logo = get_post_meta( get_the_ID(), 'fave_agent_logo', true );
$fave_agent_website = get_post_meta( get_the_ID(), 'fave_agent_website', true );
$sticky_sidebar = houzez_option('sticky_sidebar');
?>

<?php get_template_part('template-parts/page', 'title' ); ?>

<div class="row">
    <div class="col-sm-12">
        <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
            <div class="profile-detail-block">
                <div class="row">
                    <div class="col-sm-4 col-xs-12">
                        <div class="profile-image">
                            <?php
                            if( has_post_thumbnail( $post->ID ) ) {
                                the_post_thumbnail( 'houzez-image350_350' );
                            }else{
                                houzez_image_placeholder( 'houzez-image350_350' );
                            }
                            ?>

                            <?php if( !empty( $agent_company_logo ) ) {
                                $logo_url = wp_get_attachment_url( $agent_company_logo );
                                ?>
                            <div class="company-logo">
                                <img src="<?php echo esc_url( $logo_url ); ?>" alt="" width="105" height="75">
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-8 col-xs-12">
                        <div class="profile-description">
                            <p class="agent-title"><?php the_title(); ?></p>
                            <p class="position">
                                <?php
                                if( !empty( $agent_position) ) { echo esc_attr( $agent_position ).' '; }

                                if( !empty( $agent_company) ) {
                                    echo $houzez_local['at'];
                                    echo ' ' . esc_attr( $agent_company );
                                }
                                ?>
                            </p>

                            <?php the_content(); ?>

                            <ul class="profile-contact">
                                <?php if( !empty($agent_office_num) ) { ?>
                                    <li><span><?php echo $houzez_local['office']; ?></span> <a href="tel:<?php echo esc_attr( $agent_office_call ); ?>"><?php echo esc_attr( $agent_office_num ); ?></a></li>
                                <?php } ?>

                                <?php if( !empty( $agent_mobile ) ) { ?>
                                    <li><span><?php echo $houzez_local['mobile']; ?></span> <a href="tel:<?php echo esc_attr( $agent_mobile_call ); ?>"><?php echo esc_attr( $agent_mobile ); ?></a></li>
                                <?php } ?>

                                <?php if( !empty( $agent_fax ) ) { ?>
                                    <li><span><?php echo $houzez_local['fax']; ?></span> <a><?php echo esc_attr( $agent_fax ); ?></a></li>
                                <?php } ?>

                                <?php if( !empty( $agent_email ) ) { ?>
                                    <li class="email"><span><?php echo $houzez_local['email']; ?></span> <a href="mailto:<?php echo esc_attr( $agent_email ); ?>"><?php echo esc_attr( $agent_email ); ?></a></li>
                                <?php } ?>

                                <?php if( !empty( $fave_agent_website ) ) { ?>
                                    <li><span><?php echo $houzez_local['website']; ?></span> <a target="_blank" href="<?php echo esc_url( $fave_agent_website ); ?>"><?php echo esc_url( $fave_agent_website ); ?></a></li>
                                <?php } ?>
                            </ul>
                            <ul class="profile-social">
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
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">

                        <?php get_template_part( 'template-parts/agent-detail-contact'); ?>

                    </div>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 list-grid-area container-contentbar">
        <div id="content-area">

            <!--start property items-->
            <div class="property-listing list-view">
                <div class="row">
                    <?php
                    global $wp_query;

                    $agent_id = $post->ID;
                    $agent_listing_args = array(
                        'post_type' => 'property',
                        'posts_per_page' => '-1',
                        'meta_query' => array(
                            array(
                                'key' => 'fave_agents',
                                'value' => $agent_id,
                                'compare' => '='
                            )
                        )
                    );

                    $wp_query = new WP_Query( $agent_listing_args );

                    if ( $wp_query->have_posts() ) :
                        while ( $wp_query->have_posts() ) : $wp_query->the_post();

                            get_template_part('template-parts/property-for-listing');

                        endwhile;
                        wp_reset_postdata();
                    else:
                        get_template_part('template-parts/property', 'none');
                    endif;
                    ?>
                </div>
            </div>
            <!--end property items-->

            <hr>

        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-md-offset-0 col-sm-offset-3 container-sidebar <?php if( $sticky_sidebar['agent_sidebar'] != 0 ){ echo 'houzez_sticky'; }?>">
        <?php get_sidebar('houzez_agents'); ?>
    </div>
</div>

<?php get_footer(); ?>

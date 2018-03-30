<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 29/09/16
 * Time: 5:10 PM
 * Since v1.4.0
 */
get_header();

global $post, $houzez_local;
$post_meta_data  = get_post_custom($post->ID);
$agency_address = get_post_meta( get_the_ID(), 'fave_agency_address', true );
$agency_mobile = get_post_meta( get_the_ID(), 'fave_agency_mobile', true );
$agency_phone = get_post_meta( get_the_ID(), 'fave_agency_phone', true );
$agency_fax = get_post_meta( get_the_ID(), 'fave_agency_fax', true );
$agency_email = get_post_meta( get_the_ID(), 'fave_agency_email', true );
$agency_licenses = get_post_meta( get_the_ID(), 'fave_agency_licenses', true );
$agency_location = get_post_meta( get_the_ID(), 'fave_agency_location', true );
$agency_location = explode(',', $agency_location);
$agency_latitude = $agency_location[0];
$agency_longitude = $agency_location[1];

$agency_mobile_call = str_replace(array('(',')',' ','-'),'', $agency_mobile);
$agency_phone_call = str_replace(array('(',')',' ','-'),'', $agency_phone);

$agency_facebook = get_post_meta( get_the_ID(), 'fave_agency_facebook', true );
$agency_twitter = get_post_meta( get_the_ID(), 'fave_agency_twitter', true );
$agency_linkedin = get_post_meta( get_the_ID(), 'fave_agency_linkedin', true );
$agency_googleplus = get_post_meta( get_the_ID(), 'fave_agency_googleplus', true );
$agency_pinterest = get_post_meta( get_the_ID(), 'fave_agency_pinterest', true );
$agency_instagram = get_post_meta( get_the_ID(), 'fave_agency_instagram', true );
$agency_vimeo = get_post_meta( get_the_ID(), 'fave_agency_vimeo', true );
$agency_youtube = get_post_meta( get_the_ID(), 'fave_agency_youtube', true );
$agency_website = get_post_meta( get_the_ID(), 'fave_agency_web', true );
$agency_name = get_the_title();

$agents_IDs = Houzez_Query::get_agency_agents_ids();
if( !empty( $agents_IDs ) ) {
    $agency_qry = Houzez_Query::loop_get_agency_agents_properties($agents_IDs);
}

?>

<?php get_template_part('template-parts/page', 'title' ); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="profile-detail-block company-detail">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="profile-image">
                        <?php
                        if( has_post_thumbnail( $post->ID ) ) {
                            the_post_thumbnail( 'houzez-image350_350' );
                        }else{
                            houzez_image_placeholder( 'houzez-image350_350' );
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <div class="profile-description">
                        <h3><?php the_title(); ?></h3>
                        <h4 class="position"><?php if( !empty( $agency_address) ) { echo esc_attr( $agency_address ).' '; } ?></h4>
                        <!--<div class="rating">
                                        <span data-title="Average Rate: 4.67 / 5" class="bottom-ratings tip"><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span style="width: 93.4%" class="top-ratings"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></span>
                                        </span>
                            <span class="star-text-right">15 Ratings</span>
                        </div>-->
                        <ul class="profile-contact">
                            <?php if( !empty($agency_phone) ) { ?>
                                <li><span><?php echo $houzez_local['office']; ?></span> <a href="tel:<?php echo esc_attr( $agency_phone_call ); ?>"><?php echo esc_attr( $agency_phone ); ?></a></li>
                            <?php } ?>

                            <?php if( !empty( $agency_mobile ) ) { ?>
                                <li><span><?php echo $houzez_local['mobile']; ?></span> <a href="tel:<?php echo esc_attr( $agency_mobile_call ); ?>"><?php echo esc_attr( $agency_mobile ); ?></a></li>
                            <?php } ?>

                            <?php if( !empty( $agency_fax ) ) { ?>
                                <li><span><?php echo $houzez_local['fax']; ?></span> <a><?php echo esc_attr( $agency_fax ); ?></a></li>
                            <?php } ?>

                            <?php if( !empty( $agency_email ) ) { ?>
                                <li class="email"><span><?php echo $houzez_local['email']; ?></span> <a href="mailto:<?php echo esc_attr( $agency_email ); ?>"><?php echo esc_attr( $agency_email ); ?></a></li>
                            <?php } ?>

                            <?php if( !empty( $agency_website ) ) { ?>
                                <li><span><?php echo $houzez_local['website']; ?></span> <a target="_blank" href="<?php echo esc_url( $agency_website ); ?>"><?php echo esc_url( $agency_website ); ?></a></li>
                            <?php } ?>
                        </ul>
                        <ul class="profile-social">
                            <?php if( !empty( $agency_facebook ) ) { ?>
                                <li><a class="btn-facebook" href="<?php echo esc_url( $agency_facebook ); ?>" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                            <?php } ?>

                            <?php if( !empty( $agency_twitter ) ) { ?>
                                <li><a class="btn-twitter" href="<?php echo esc_url( $agency_twitter ); ?>" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                            <?php } ?>

                            <?php if( !empty( $agency_linkedin ) ) { ?>
                                <li><a class="btn-linkedin" href="<?php echo esc_url( $agency_linkedin ); ?>" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
                            <?php } ?>

                            <?php if( !empty( $agency_googleplus ) ) { ?>
                                <li><a class="btn-google-plus" href="<?php echo esc_url( $agency_googleplus ); ?>" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
                            <?php } ?>

                            <?php if( !empty( $agency_youtube ) ) { ?>
                                <li><a class="btn-youtube" href="<?php echo esc_url( $agency_youtube ); ?>" target="_blank"><i class="fa fa-youtube-square"></i></a></li>
                            <?php } ?>

                            <?php if( !empty( $agency_instagram ) ) { ?>
                                <li><a class="btn-instagram" href="<?php echo esc_url( $agency_instagram ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <?php } ?>

                            <?php if( !empty( $agency_pinterest ) ) { ?>
                                <li><a class="btn-pinterest" href="<?php echo esc_url( $agency_pinterest ); ?>" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>
                            <?php } ?>

                            <?php if( !empty( $agency_vimeo ) ) { ?>
                                <li><a class="btn-vimeo" href="<?php echo esc_url( $agency_vimeo ); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
                            <?php } ?>
                        </ul>
                        <ul class="profile-rating">
                            <li>
                                <span><?php echo $houzez_local['agency_properties']; ?></span>
                                <?php
                                if( !empty( $agents_IDs ) ) {
                                    echo esc_attr( $agency_qry->post_count );
                                } ?>
                            </li>
                            <li><span><?php echo $houzez_local['agency_agents']; ?> </span>
                            <?php
                            $agents_count = Houzez_Query::get_agency_agents( $post_id = get_the_ID() )->post_count;
                            echo esc_attr( $agents_count );
                            ?>
                            </li>
                            <?php if( !empty($agency_licenses) ) { ?>
                            <li><span><?php echo $houzez_local['licenses']; ?> </span> <?php echo esc_attr( $agency_licenses ); ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <?php get_template_part( 'template-parts/agency-detail-contact'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div id="content-area">
            <div class="profile-tab-area">
                <ul class="profile-tabs">
                    <li class="active"><?php esc_html_e('OVERVIEW', 'houzez'); ?></li>
                    <li><?php esc_html_e('Listings', 'houzez'); ?></li>
                    <li><?php esc_html_e('AGENTS', 'houzez'); ?></li>
                    <li id="mapTab"><?php esc_html_e('MAP', 'houzez'); ?></li>
                    <!--<li><?php /*esc_html_e('REVIEWS', 'houzez'); */?></li>-->
                </ul>
                <div class="tab-content">
                    <div class="profile-tab-pane tab-pane fade active in">
                        <div class="profile-tab-content profile-overview">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="profile-tab-pane tab-pane fade">
                        <div class="profile-tab-content profile-properties">
                            <div class="property-filter-wrap">
                                <h4 class="filter-title"> <?php esc_html_e('Listings', 'houzez'); ?> </h4>
                                <!--<form class="filter-inputs">
                                    <ul>
                                        <li><label> Filter by </label></li>
                                        <li>
                                            <select class="selectpicker" data-live-search="false" data-live-search-style="begins" title="Status">
                                                <option>Status 1</option>
                                                <option>Status 2</option>
                                                <option>Status 3</option>
                                                <option>Status 4</option>
                                                <option>Status 5</option>
                                            </select>
                                        </li>
                                        <li>
                                            <select class="selectpicker" data-live-search="false" data-live-search-style="begins" title="Agents">
                                                <option>Agent 1</option>
                                                <option>Agent 2</option>
                                                <option>Agent 3</option>
                                                <option>Agent 4</option>
                                                <option>Agent 5</option>
                                            </select>
                                        </li>
                                    </ul>
                                </form>-->
                            </div>
                            <!--start property items-->
                            <div class="property-listing grid-view">
                                <div class="row">
                                    <?php
                                    if( !empty( $agents_IDs ) ) {
                                        if ($agency_qry->have_posts()) :

                                            while ($agency_qry->have_posts()) : $agency_qry->the_post();

                                                get_template_part('template-parts/property-for-listing');

                                            endwhile;
                                        endif;
                                        Houzez_Query::loop_reset_postdata();
                                    }
                                    ?>
                                </div>
                            </div>
                            <!--end property items-->
                        </div>
                    </div>
                    <div class="profile-tab-pane tab-pane fade">
                        <div class="profile-tab-content profile-agents">
                            <div class="agent-listing">
                                <!-- Agency's agents -->
                                <?php
                                Houzez_Query::loop_agency_agents( );

                                if ( have_posts() ) :

                                    while ( have_posts() ) : the_post();

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

                                    <div class="profile-detail-block">
                                        <div class="media">
                                            <div class="media-left">
                                                <figure>
                                                    <?php
                                                    if( has_post_thumbnail( $post->ID ) ) {
                                                        the_post_thumbnail( 'houzez-image350_350' );
                                                    }else{
                                                        houzez_image_placeholder( 'houzez-image350_350' );
                                                    }
                                                    ?>
                                                </figure>
                                            </div>
                                            <div class="media-body">
                                                <div class="profile-description">
                                                    <div class="profile-description-top">
                                                        <h3><?php the_title(); ?></h3>
                                                        <h4 class="position">
                                                            <?php
                                                            if( !empty( $agent_position) ) { echo esc_attr( $agent_position ).' '; }
                                                            echo $houzez_local['at'];
                                                            echo ' ' . esc_attr( $agency_name );
                                                            ?>
                                                        </h4>
                                                    </div>
                                                    <div class="profile-description-left">
                                                        <p><?php the_excerpt(); ?></p>
                                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary hidden-sm hidden-xs"><?php echo $houzez_local['view_my_prop']; ?></a>
                                                    </div>
                                                    <div class="profile-description-right">
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
                                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block visible-sm visible-xs"><?php echo $houzez_local['view_my_prop']; ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                    endwhile;
                                endif;
                                Houzez_Query::loop_reset();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="profile-tab-pane tab-pane fade">
                        <div class="profile-tab-content profile-map">
                            <div id="houzez-simple-map"
                                 data-latitude="<?php echo esc_attr( $agency_latitude ); ?>"
                                 data-longitude="<?php echo esc_attr( $agency_longitude ); ?>"
                                 data-zoom="15">
                            </div>
                        </div>
                    </div>
                    <div class="profile-tab-pane tab-pane fade">
                        <!--<div class="profile-tab-content profile-review">
                            <h3 class="title">2 Reviews for Real Estate Inc.</h3>
                            <div class="reviews-list">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object img-circle" src="http://placehold.it/60x60" alt="Thumb" height="60" width="60">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="review-top">
                                            <h3 class="media-heading"><a href="#">John Doe</a></h3>
                                            <div class="rating">
                                                <span class="bottom-ratings"><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span style="width: 70%" class="top-ratings"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></span></span>
                                            </div>
                                        </div>
                                        <p class="review-date">February 6, 2014 </p>

                                        <p>Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit. Etiam
                                            risus tortor, accumsan at nisi et,
                                        </p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object img-circle" src="http://placehold.it/60x60" alt="Thumb" height="60" width="60">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="review-top">
                                            <h3 class="media-heading"><a href="#">John Doe</a></h3>
                                            <div class="rating">
                                                <span data-title="Average Rate: 4.67 / 5" class="bottom-ratings tip"><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span style="width: 70%" class="top-ratings"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></span></span>
                                            </div>
                                        </div>
                                        <p class="review-date">February 6, 2014 </p>

                                        <p>Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit. Etiam
                                            risus tortor, accumsan at nisi et,
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="add-review-block">
                                <h4 class="review-title">Add a review</h4>
                                <form>
                                    <div class="add-rating">
                                        <label>Your rating</label>
                                        <div class="rating">
                                            <span class="bottom-ratings"><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span style="width: 70%" class="top-ratings"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></span></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Your name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Email address">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" placeholder="Your review"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <button class="btn btn-secondary">Submit Review</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
<?php
    /*
    *
    *	Single Team
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *
    */
?>

<?php while (have_posts()) : the_post(); ?>

    <?php
    $member_position    = sf_get_post_meta( $post->ID, 'sf_team_member_position', true );
    $member_email       = sf_get_post_meta( $post->ID, 'sf_team_member_email', true );
    $member_phone       = sf_get_post_meta( $post->ID, 'sf_team_member_phone_number', true );
    $member_twitter     = sf_get_post_meta( $post->ID, 'sf_team_member_twitter', true );
    $member_facebook    = sf_get_post_meta( $post->ID, 'sf_team_member_facebook', true );
    $member_linkedin    = sf_get_post_meta( $post->ID, 'sf_team_member_linkedin', true );
    $member_skype       = sf_get_post_meta( $post->ID, 'sf_team_member_skype', true );
    $member_google_plus = sf_get_post_meta( $post->ID, 'sf_team_member_google_plus', true );
    $member_instagram   = sf_get_post_meta( $post->ID, 'sf_team_member_instagram', true );
    $member_dribbble    = sf_get_post_meta( $post->ID, 'sf_team_member_dribbble', true );
    $member_image_url   = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
    $contact_icon 	 	= apply_filters( 'sf_mail_icon', '<i class="ss-mail"></i>' );
    $phone_icon			= apply_filters( 'sf_phone_icon', '<i class="ss-phone"></i>' );
    ?>

    <?php do_action( 'sf_team_before_article' ); ?>

    <!-- OPEN article -->
    <article <?php post_class( 'clearfix single-team' ); ?> id="<?php the_ID(); ?>">

        <?php
            do_action( 'sf_team_article_start' );
        ?>

        <section class="page-content container clearfix">

            <?php
                do_action( 'sf_before_team_content' );
            ?>

            <figure class="profile-image-wrap">
                <?php $detail_image = sf_aq_resize( $member_image_url, 700, null, true, false ); ?>

                <?php if ( $detail_image ) { ?>

                    <img itemprop="image" src="<?php echo esc_url($detail_image[0]); ?>" width="<?php echo esc_attr($detail_image[1]); ?>"
                         height="<?php echo esc_attr($detail_image[2]); ?>" alt="<?php the_title(); ?>"/>

                <?php } ?>
            </figure>

            <section class="article-body-wrap">
                <div class="body-text">
                    <h4 class="member-position" itemscope="jobTitle"><?php echo $member_position; ?></h4>
                    <?php the_content(); ?>
                    <ul class="member-contact">
                        <?php if ( $member_email ) { ?>
                            <li><?php echo $contact_icon; ?><span itemscope="email"><a href="mailto:<?php echo sanitize_email($member_email); ?>"><?php echo $member_email; ?></a></span>
                            </li><?php } ?>
                        <?php if ( $member_phone ) { ?>
                            <li><?php echo $phone_icon; ?><span itemscope="telephone"><?php echo esc_attr($member_phone); ?></span>
                            </li><?php } ?>
                    </ul>
                    <ul class="social-icons">
                        <?php if ( $member_twitter ) { ?>
                            <li class="twitter"><a href="http://www.twitter.com/<?php echo esc_attr($member_twitter); ?>" target="_blank"><i class="fa-twitter"></i><i class="fa-twitter"></i></a>
                            </li><?php } ?>
                        <?php if ( $member_facebook ) { ?>
                            <li class="facebook"><a href="<?php echo esc_url($member_facebook); ?>" target="_blank"><i class="fa-facebook"></i><i class="fa-facebook"></i></a></li><?php } ?>
                        <?php if ( $member_linkedin ) { ?>
                            <li class="linkedin"><a href="<?php echo esc_url($member_linkedin); ?>" target="_blank"><i class="fa-linkedin"></i><i class="fa-linkedin"></i></a></li><?php } ?>
                        <?php if ( $member_google_plus ) { ?>
                            <li class="googleplus"><a href="<?php echo esc_url($member_google_plus); ?>" target="_blank"><i class="fa-google-plus"></i><i class="fa-google-plus"></i></a></li><?php } ?>
                        <?php if ( $member_skype ) { ?>
                            <li class="skype"><a href="skype:<?php echo esc_attr($member_skype); ?>" target="_blank"><i class="fa-skype"></i><i class="fa-skype"></i></a></li><?php } ?>
                        <?php if ( $member_instagram ) { ?>
                            <li class="instagram"><a href="<?php echo esc_url($member_instagram); ?>" target="_blank"><i class="fa-instagram"></i><i class="fa-instagram"></i></a></li><?php } ?>
                        <?php if ( $member_dribbble ) { ?>
                            <li class="dribbble"><a href="http://www.dribbble.com/<?php echo esc_attr($member_dribbble); ?>" target="_blank"><i class="fa-dribbble"></i><i class="fa-dribbble"></i></a></li><?php } ?>
                    </ul>
                </div>
            </section>

            <?php
                do_action( 'sf_after_team_content' );
            ?>

        </section>

        <?php
            do_action( 'sf_team_article_end' );
        ?>

        <!-- CLOSE article -->
    </article>

    <?php
    do_action( 'sf_team_after_article' );
    ?>

<?php endwhile; ?>
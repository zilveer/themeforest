<?php
    $author_image = get_the_author_meta('fave_author_custom_picture');
    $facebook = get_the_author_meta('fave_author_facebook');
    $twitter = get_the_author_meta('fave_author_twitter');
    $linkedin = get_the_author_meta('fave_author_linkedin');
    $googleplus = get_the_author_meta('fave_author_googleplus');
    $youtube = get_the_author_meta('fave_author_youtube');

    if( empty($author_image) ) {
        $author_image = houzez_get_avatar_url(get_avatar( get_the_author_meta( 'ID' ), 60 ));
    }
?>
<div class="blog-section">
    <div class="author-detail-block">
        <div class="media">
            <div class="media-left">
                <figure>
                    <a><img src="<?php echo esc_url( $author_image ); ?>" alt="img" width="60" height="60" class="img-circle"></a>
                </figure>
            </div>
            <div class="media-body">
                <h4 class="heading"><?php esc_attr( the_author_meta( 'display_name' )); ?></h4>
                <p><?php esc_attr( the_author_meta( 'description' )); ?> </p>
                <ul class="profile-social">

                        <?php if( !empty( $facebook ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url( $facebook ); ?>"><i class="fa fa-facebook-square"></i></a></li>
                        <?php } ?>

                        <?php if( !empty( $twitter ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter-square"></i></a></li>
                        <?php } ?>

                        <?php if( !empty( $linkedin ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url( $linkedin ); ?>"><i class="fa fa-linkedin-square"></i></a></li>
                        <?php } ?>

                        <?php if( !empty( $googleplus ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url( $googleplus ); ?>"><i class="fa fa-google-plus-square"></i></a></li>
                        <?php } ?>

                        <?php if( !empty( $youtube ) ) { ?>
                            <li><a target="_blank" href="<?php echo esc_url( $youtube ); ?>"><i class="fa fa-youtube-square"></i></a></li>
                        <?php } ?>

                </ul>
            </div>
        </div>
    </div>
</div>
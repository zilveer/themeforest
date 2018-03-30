<?php
//Template Name: Authors
get_header();
global $bd_data;

/* Sidebar */
if(get_post_meta($post->ID, 'bd_full_width', true)){
    $post_full      = ' post_full_width';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'left'){
    $post_po        = ' post_sidebar_left';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'right'){
    $post_po        = ' post_sidebar_right';
}

$bd_criteria_display = get_post_meta(get_the_ID(), 'bd_criteria_display', true); ?>

    <div class="bd-container <?php echo $post_po; echo $post_full; ?>">
        <div class="bd-main">
            <div class="page-title"><h2> <?php the_title();?> </h2></div>
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <article <?php post_class('article'); ?> id="post-<?php the_ID(); ?>">
                    <div class="post-entry bottom40">
                        <?php the_content(); ?>
                        <ul class="authors-wrap">
                            <?php
                            $users = get_users('blog_id=1&orderby=post_count&order=DESC');
                            global $user_ID, $user_identity, $user_level;
                            foreach ($users as $user)
                            {
                                ?>
                                <li class="post-warpper clear">

                                    <div class="box-title">
                                        <h2>
                                            <?php _e( 'Author', 'bd' ) ?> <a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo $user->display_name ?> </a>
                                        </h2>
                                    </div>

                                    <div class="taxonomy-description">
                                    <div class="avatar">
                                        <?php echo get_avatar( get_the_author_meta( 'user_email' , $user->ID ), apply_filters( 'MFW_author_bio_avatar_size', 80 ) ); ?>
                                    </div>

                                    <div class="post-caption">

                                        <p class="bio-author-desc">
                                            <?php the_author_meta( 'description'  , $user->ID ); ?>
                                        </p>

                                        <div class="social-icons icon-12 bio-author-social">

                                            <?php if ( get_the_author_meta( 'url', $user->ID ) ) : ?>
                                                <a class="ttip" href="<?php the_author_meta( 'url', $user->ID ); ?>" title="<?php echo $user->display_name ?><?php _e( "'s site", 'bd' ); ?>"><i class="icon-home"></i></a>
                                            <?php endif ?>

                                            <?php if ( get_the_author_meta( 'facebook', $user->ID ) ) : ?>
                                                <a class="ttip" href="<?php the_author_meta( 'facebook', $user->ID ); ?>" title="<?php echo $user->display_name ?> <?php _e( '  on Facebook', 'bd' ); ?>"><i class="social_icon-facebook"></i></a>
                                            <?php endif ?>

                                            <?php if ( get_the_author_meta( 'twitter', $user->ID ) ) : ?>
                                                <a class="ttip" href="http://twitter.com/<?php the_author_meta( 'twitter', $user->ID ); ?>" title="<?php echo $user->display_name ?><?php _e( '  on Twitter', 'bd' ); ?>"><i class="social_icon-twitter"></i></a>
                                            <?php endif ?>

                                            <?php if ( get_the_author_meta( 'google', $user->ID ) ) : ?>
                                                <a class="ttip" href="<?php the_author_meta( 'google', $user->ID ); ?>" title="<?php echo $user->display_name ?> <?php _e( '  on Google+', 'bd' ); ?>"><i class="social_icon-google"></i></a>
                                            <?php endif ?>

                                            <?php if ( get_the_author_meta( 'linkedin', $user->ID ) ) : ?>
                                                <a class="ttip" href="<?php the_author_meta( 'linkedin', $user->ID ); ?>" title="<?php echo $user->display_name ?> <?php _e( '  on Linkedin', 'bd' ); ?>"><i class="social_icon-linkedin"></i></a>
                                            <?php endif ?>

                                            <?php if ( get_the_author_meta( 'flickr', $user->ID ) ) : ?>
                                                <a class="ttip" href="<?php the_author_meta( 'flickr', $user->ID ); ?>" title="<?php echo $user->display_name ?><?php _e( '  on Flickr', 'bd' ); ?>"><i class="social_icon-flickr"></i></a>
                                            <?php endif ?>

                                            <?php if ( get_the_author_meta( 'youtube', $user->ID ) ) : ?>
                                                <a class="ttip" href="<?php the_author_meta( 'youtube', $user->ID ); ?>" title="<?php echo $user->display_name ?><?php _e( '  on YouTube', 'bd' ); ?>"><i class="social_icon-youtube"></i></a>
                                            <?php endif ?>

                                            <?php if ( get_the_author_meta( 'pinterest', $user->ID ) ) : ?>
                                                <a class="ttip" href="<?php the_author_meta( 'pinterest', $user->ID ); ?>" title="<?php echo $user->display_name ?><?php _e( '  on Pinterest', 'bd' ); ?>"><i class="social_icon-pinterest"></i></a>
                                            <?php endif ?>
                                        </div>

                                    </div>
                                    </div>
                                    <div class="divider"></div>
                                </li>
                            <?php } ?>
                        </ul>

                    </div>
                </article>
            <?php endwhile; ?>

        </div><!-- .bd-main-->

        <?php get_sidebar(); ?>
    </div><!-- .bd-container -->

<?php
get_footer();
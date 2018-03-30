<?php
get_header();
global $bd_data;

setPostViews( get_the_ID() );
wp_reset_query();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
query_posts( $query_string.'&paged='.$paged );

/*
 *  Project info
 */
global $post;
$project_url            = get_post_meta($post->ID, 'new_bd_project_url', true);
$project_url_text       = get_post_meta($post->ID, 'new_bd_project_url_text', true);
$copy_url               = get_post_meta($post->ID, 'new_bd_copy_url', true);
$copy_url_text          = get_post_meta($post->ID, 'new_bd_copy_url_text', true);
$address                = get_post_meta($post->ID, 'new_bd_address', true);
$phone                  = get_post_meta($post->ID, 'new_bd_phone', true);
$hos                    = get_post_meta($post->ID, 'new_bd_hours_of_service', true);
$mail                   = get_post_meta($post->ID, 'new_bd_mail', true);
$site                   = get_post_meta($post->ID, 'new_bd_site', true); ?>

<div id="page-title">
    <div class="bd-container">
        <div class="bd-page-title">
            <h1><?php the_title(); ?></h1>
            <div class="folio-like">
                <?php
                    if( bdayh_get_option( 'folio_like' ) ) {
                        echo getPostLikeLink( get_the_ID() );
                    }
                ?>
            </div>
        </div>
        <!-- .bd-page-title -->
        <div id="crumbs">
            <?php bd_crumbs(); ?>
        </div>
        <!-- #crumbs -->
    </div>
</div>
<!-- #page-title -->
<div class="folio-container loading">
    <div id="folio-main">
        <div class="bd-container">
            <div class="folio-single">
            <?php if(have_posts()): the_post(); ?>
                <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <div class="folio-media">
                        <?php
                        if(get_post_meta(get_the_ID(), 'new_bd_wportfolio_post_type', true)){

                            $post_type = get_post_meta(get_the_ID(), 'new_bd_wportfolio_post_type', true);
                            if($post_type == 'post_image'){

                                bd_wp_thumb( '770', '500', 'lightbox', '' );

                            } elseif($post_type == 'post_slider'){

                                bd_wp_gallery( '770', '500' );

                            } elseif($post_type == 'post_video'){

                                $img_w          = '770';
                                $img_h          = '500';
                                $type           = get_post_meta($post->ID, 'new_bd_wportfolio_video_type', true);
                                $id             = get_post_meta($post->ID, 'new_bd_video_url', true);
                                if($type == 'youtube'){
                                    echo '<div class="post-image video-box"><iframe src="http://www.youtube.com/embed/'. $id .'?rel=0" frameborder="0" allowfullscreen></iframe></div>'."\n";
                                } elseif($type == 'vimeo') {
                                    echo '<div class="post-image video-box"><iframe src="http://player.vimeo.com/video/'. $id .'?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>'."\n";
                                } elseif($type == 'daily') {
                                    echo '<div class="post-image video-box"><iframe frameborder="0" src="http://www.dailymotion.com/embed/video/'. $id .'?logo=0"></iframe></div>'."\n";
                                }

                            } else { }
                        }
                        ?>
                        <?php
                            if( bdayh_get_option( 'folio_social_sharing' ) ) {
                                bd_in ('social-sharing');
                            }
                        ?>
                    </div><!-- .folio-media -->

                    <div class="folio-content bbox">
                        <h3><?php _e( 'Project Description ', 'bd' ) ?></h3>
                        <div class="folio-entry"><?php the_content(); ?></div>

                        <div class="folio-info">
                            <h3><?php _e( 'Project info ', 'bd' ) ?></h3>
                            <ul>
                                <?php
                                if( $address ) {
                                    echo '<li><strong>'. __( 'Address', 'bd' ) .'</strong> : <span> '. stripslashes( $address ) .' </span> </li>' ."\n";
                                }

                                if( $phone ) {
                                    echo '<li><strong>'. __( 'Phone', 'bd' ) .'</strong> : <span> '. stripslashes( $phone ) .' </span> </li>' ."\n";
                                }

                                if( $hos ) {
                                    echo '<li><strong>'. __( 'Hours of Service', 'bd' ) .'</strong> : <span> '. stripslashes( $hos ) .' </span> </li>' ."\n";
                                }

                                if( $mail ) {
                                    echo '<li><strong>'. __( 'e-mail', 'bd' ) .'</strong> : <span> '. stripslashes( $mail ) .' </span> </li>' ."\n";
                                }

                                if( $site ) {
                                    echo '<li><strong>'. __( 'website', 'bd' ) .'</strong> : <span> '. stripslashes( $site ) .' </span> </li>' ."\n";
                                }

                                if( get_the_term_list($post->ID, 'portfolio_skills', '', '', '') && bdayh_get_option( 'folio_skills' ) ) {
                                    echo '<li class="folio-cat"><strong>'. __( 'Skills Needed', 'bd' ) .'</strong> : <span> '. get_the_term_list($post->ID, 'portfolio_skills', '', ', ', '') .' </span> </li>' ."\n";
                                }

                                if( get_the_term_list($post->ID, 'portfolio_category', '', '', '') && bdayh_get_option( 'folio_categories' ) ) {
                                    echo '<li class="folio-cat"><strong>'. __( 'Categories', 'bd' ) .'</strong> : <span> '. get_the_term_list($post->ID, 'portfolio_category', '', ', ', '') .' </span> </li>' ."\n";
                                }

                                if( get_the_term_list($post->ID, 'portfolio_tags', '', '', '') && bdayh_get_option( 'wportfolio_tags' ) ) {
                                    echo '<li class="folio-tag"><strong>'. __( 'Tags', 'bd' ) .'</strong> : <span> '. get_the_term_list($post->ID, 'portfolio_tags', '', '', '') .' </span> </li>' ."\n";
                                }

                                if( bdayh_get_option( 'wportfolio_author' ) ) {
                                    echo '<li><strong>'. __( 'By', 'bd' ) .'</strong> : <span> <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author_meta( 'display_name' ) .'</a> </span> </li>' ."\n";
                                }

                                if( $copy_url_text && $copy_url ) {
                                    echo '<li><strong>'. __( 'Copyright', 'bd' ) .'</strong> : <span> <a href="'. stripslashes( $copy_url ) .'" target="_blank">'. stripslashes( $copy_url_text ) .'</a> </span> </li>' ."\n";
                                }

                                if( $project_url ) {

                                    if($project_url_text){
                                        $live_url = $project_url_text;
                                    } else {
                                        $live_url = __( 'Live preview', 'bd' );
                                    }

                                    echo '<li><a class="btn-link" href="'. $project_url .'" target="_blank">'. $live_url .'</a> </li>' ."\n";
                                }

                                ?>
                            </ul>
                        </div>
                    </div><!-- .folio-content -->
                </article>
                <?php endif;?>

                <?php $projects = get_related_projects( $post->ID ); ?>
                <?php if( $projects->have_posts() && bdayh_get_option( 'folio_related' ) ){ ?>
                    <div class="folio-related">
                        <div class="box-title"> <h2><?php _e( 'Related Portfolio item', 'bd' ) ?></h2> </div>
                    </div><!-- .folio-related -->
                    <div id="contain" class="folio-4col folio-items">
                        <?php while($projects->have_posts()): $projects->the_post(); ?>
                            <div class="folio-item portfolio-item <?php echo $item_classes; ?>" data-categories="<?php echo $item_classes; ?>">
                                <div class="inner-media">
                                    <?php
                                    if( get_post_meta( get_the_ID(), 'new_bd_wportfolio_post_type', true ) ){
                                        $post_type = get_post_meta(get_the_ID(), 'new_bd_wportfolio_post_type', true);
                                        if( $post_type == 'post_image' ) { bd_wp_thumb( '400', '300', 'lightbox', '' );
                                        } elseif( $post_type == 'post_slider' ) { bd_wp_gallery( '400', '300' );
                                        } elseif( $post_type == 'post_video' ) {
                                            $img_w          = '400';
                                            $img_h          = '300';
                                            $type           = get_post_meta($post->ID, 'new_bd_wportfolio_video_type', true);
                                            $id             = get_post_meta($post->ID, 'new_bd_video_url', true);
                                            if($type == 'youtube'){ echo '<div class="post-image video-box"><iframe src="http://www.youtube.com/embed/'. $id .'?rel=0" frameborder="0" allowfullscreen></iframe></div>'."\n";
                                            } elseif($type == 'vimeo') { echo '<div class="post-image video-box"><iframe src="http://player.vimeo.com/video/'. $id .'?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>'."\n";
                                            } elseif($type == 'daily') { echo '<div class="post-image video-box"><iframe frameborder="0" src="http://www.dailymotion.com/embed/video/'. $id .'?logo=0"></iframe></div>'."\n"; }
                                        } else { }
                                    }
                                    ?>
                                </div><!-- .inner-media -->
                                <div class="inner-desc">
                                    <h3 class="tite"><a href="<?php the_permalink()?>" title="<?php printf(__( '%s', 'bd' ), the_title_attribute( 'echo=0' )); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                                </div><!-- .inner-desc -->
                            </div><!-- .folio-item -->
                        <?php endwhile; ?>
                    </div><!-- .folio-items -->
                <?php } ?>

                <?php
                if( bdayh_get_option( 'wportfolio_comments' ) ){
                    wp_reset_query();
                	comments_template();
                }
                ?>

            </div><!-- folio-single -->
        </div>
    </div><!-- #folio-main -->
    <div id="loading" class="rotating-plane"></div>
</div>
<!-- .folio-container -->
<div class="clear"></div>
<?php
get_footer();
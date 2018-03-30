<?php
/**
 * @package commercegurus
 */
$website = '';
$shdesc = '';

get_header();
?>
<?php cg_get_page_title(); ?>
<div class="container">
    <div class="content content-area">

        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="full-width">
                    <main id="main" class="site-main" role="main">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content clearfix">
                                <?php
                                if ( have_posts() ) : while ( have_posts() ) : the_post();
                                        global $post;
                                        $website = get_post_meta( $post->ID, '_cg_showcase_url', true );
                                        $shdesc = get_post_meta( $post->ID, '_cg_showcase_url_desc', true );
                                        if ( get_post_meta( get_the_ID(), '_cg_showcase_video_embed', true ) == "" ) {
                                            ?>
                                            <div id="showcaseimg">
                                                <section class="slides">
                                                    <div class="flexslider scase preloading carousel">
                                                        <ul class="slides">    

                                                            <?php
                                                            $gallery_images = get_post_meta( get_the_ID(), '_cg_showcase_gallery', true );
                                                            ?>

                                                            <?php if ( !empty( $gallery_images ) ) : ?>
                                                                <?php foreach ( $gallery_images as $gallery_image ) : ?>
                                                                    <li><?php echo wp_get_attachment_image( $gallery_image, 'showcase-page' ); ?></li>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>

                                                        </ul>
                                                    </div>
                                                </section>    
                                            </div>                
                                        <?php } else { ?>
                                            <div id="showcaseimg">
                                                <?php
                                                $videosource = get_post_meta( get_the_ID(), '_cg_showcase_video_source', true );
                                                $videoembedcode = get_post_meta( get_the_ID(), '_cg_showcase_video_embed', true );
                                                if ( $videosource == 'vimeo' ) {
                                                    echo '<div class="cg-folio-video-responsive"><iframe src="//player.vimeo.com/video/' . $videoembedcode . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="920" height="518" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
                                                } else if ( $videosource == 'youtube' ) {
                                                    echo '<div class="cg-folio-video-responsive"><iframe width="920" height="518" src="//www.youtube.com/embed/' . $videoembedcode . '?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe></div>';
                                                } else {
                                                    echo "Video embed code is missing";
                                                }
                                                ?>
                                            </div>
                                        <?php } ?>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                            </div><!-- .entry-content -->
                        </article><!-- #post-## -->
                        <?php
                        $cg_comments_status = $cg_options['cg_page_comments'];
                        if ( $cg_comments_status == 'yes' ) {
                            if ( comments_open() || '0' != get_comments_number() ) {
                                comments_template();
                            }
                        }
                        ?>  
                    </main>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="row">
                    <div id="showcasecontent" class="col-lg-12 col-md-12">
                        <h4><?php _e( 'About this Project', 'commercegurus' ); ?></h4>
                        <?php the_content(); ?>
                    </div>
                </div>
                <div class="row">
                    <div id="showcasedetails" class="col-lg-12 col-md-12">
                        <h4><?php _e( 'Date', 'commercegurus' ); ?></h4>
                        <?php the_time( 'F jS, Y' ) ?>
                        <?php if ( $website ) { ?>
                            <div class="scwebsite clearfix">
                                <a href="<?php echo $website; ?>">
                                    <?php
                                    if ( $shdesc ) {
                                        echo $shdesc;
                                    } else {
                                        _e( ' Visit Website', 'commercegurus' );
                                    }
                                    ?>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="cg-more-work col-lg-12 col-md-12">
                <h2>Related items</h2>
            </div>
        </div>


        <div class="row">
            <div id="cg-folio-recent" class="clearfix">
                <div id="sclist-wrap">
                    <?php
                    $args = array(
                        'post_type' => 'showcases',
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                        'posts_per_page' => 4
                    );
                    $query = new WP_Query( $args );

                    while ( $query->have_posts() ) : $query->the_post();
                        ?>
                        <?php
                        $terms = get_the_terms( $post->ID, 'cg_showcasecategory' );
                        $term_list = '';
                        $term_list_sep = '';
                        if ( is_array( $terms ) ) {
                            foreach ( $terms as $term ) {
                                $term_list .= $term->slug;
                                $term_list .= ' ';
                            }

                            $arraysep = array();
                            foreach ( $terms as $termsep ) {
                                $arraysep[] = '<span>' . $termsep->slug . '</span>';
                            }
                        }
                        ?>
                        <div <?php post_class( "element-item $term_list col-lg-3 col-md-3 col-sm-3 col-xs-12" ); ?> id="post-<?php the_ID(); ?>">

                            <div class="img slideUp">    
                                <a href="<?php the_permalink(); ?>"><?php cg_folio_recentthumb( get_the_ID() ); ?></a>
                                <div class="caption">
                                    <div class="heading">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( __( 'Permanent Link to %s', 'commercegurus' ), get_the_title() ); ?>"> 
                                            <?php the_title(); ?></a></div>
                                    <p>
                                        <?php
                                        if ( !empty( $arraysep ) ) {
                                            echo implode( ', ', $arraysep );
                                        }
                                        ?> 
                                    </p>
                                </div>   
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>